<?php

/**

 * Page Template

 *

 * Loaded automatically by index.php?main_page=account_edit.<br />

 * View or change Customer Account Information

 *

 * @package templateSystem

 * @copyright Copyright 2003-2005 Zen Cart Development Team

 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0

 * @version $Id: tpl_account_edit_default.php 3848 2006-06-25 20:33:42Z drbyte $

 * @copyright Portions Copyright 2003 osCommerce

 */

?>

<div class="minframe fl">

<?php

 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/box_contact_us.php'));

?>

<div class="bg_box_gray margin_t allborder clear">

<h3 class="in_1em line_30px">My Account</h3>

	<div class="pad_10px pad_t">

	<ul class="red_arrow_list">

	<li><a href="<?php echo zen_href_link(FILENAME_ACCOUNT,'','SSL'); ?>">View Orders</a></li>

	<li><a class="red b" href="<?php echo zen_href_link(FILENAME_ACCOUNT_EDIT,'','SSL'); ?>">Account Settings</a></li>

	<li><a href="<?php echo zen_href_link(FILENAME_MANAGER_ADDRESS,'','SSL');?>">Manage Address Book</a></li>

	</ul>

	</div>

</div>

<?

 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/account_order_search.php'));

?>

<div class="bg_box_gray margin_t allborder clear">

	<h3 class="in_1em line_30px">Need help</h3>

		<span class="pad_10px pad_t block">If you have questions or need help with your account, you may <a class="u" href="<?php echo zen_href_link(FILENAME_FAQS,'','SSL') ?>">contact us</a> to assist you.	</span>

</div>

</div>

<div id="layer_switch" class="nl_layer allborder right_big_con margin_t bg_none">

	<div evt="click" id="boxswitch" class="">

	<?php

		switch ($switchbox){

			case 'email_information':

				$informationBox = TRUE;

				$mailBox = FALSE;

				$passwordBox = FALSE;

				break;

			case 'email_edit':

				$informationBox = FALSE;

				$mailBox = TRUE;

				$passwordBox = FALSE;

				break;

			case 'password_edit':

				$informationBox = FALSE;

				$mailBox = FALSE;

				$passwordBox = TRUE;

				break;

			

		}

	?>

  <div title="ChangeInformation" class="<?php echo $informationBox?'on':'off'; ?>"><span><?php echo TEXT_SWITCH_CHANGE_PROFILE; ?></span></div>

	<div id="border_left" title="ChangeMail" class="<?php echo $mailBox?'on':'off'; ?>"><span><?php echo TEXT_SWITCH_CHANGE_EMAIL; ?></span></div>

	<div id="border_left" title="ChangePassword" class="<?php echo $passwordBox?'on':'off'; ?>"><span><?php echo TEXT_SWITCH_CHANGE_PASSWORD; ?></span></div>

</div>

<div class="clear">

 <div class="<?php echo $informationBox?'show':'hide'; ?>" id="ChangeInformation"><?php //account_edit ?>

 		<?php if ($messageStack->size('email_information') > 0) echo $messageStack->output('email_information'); ?>

 		<?php if ($account->fields['customers_firstname'] =='' || $account->fields['customers_firstname'] == 'New Customer'){

 		         echo '<div class="error_box">'.COMPLATE_TEXT.'</div>';

 		         }

 			?>

    <?php echo zen_draw_form('email_information', zen_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'), 'post', ' id="email_information" onsubmit="return(fmChk(this))"') . zen_draw_hidden_field('action', 'email_information' ,' id="action"'); ?>

		<strong>Update your profile</strong><br/>

		<br/>

		<span class="red">*</span> Indicates required fields

		<table width="550" cellspacing="0" cellpadding="0" border="0">

		  <tbody><tr>

		    <td width="180" align="right"><?php echo ENTRY_GENDER; ?> <span class="red">*</span></td>

		    <td class="pad_l_10px">

				<?php echo zen_draw_pull_down_menu('gender',$genderArray,$account->fields['customers_gender'],'chkname="Gender" chkrule="isselect" id="gender"'); ?>

		  </tr>

		  <tr>

		    <td align="right"><?php echo ENTRY_FIRST_NAME.(zen_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="red">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?></td>

		    <td class="pad_l_10px">

		    <?php echo zen_draw_input_field('firstname', $account->fields['customers_firstname'], 'id="firstname" chkrule="nnull/min2" chkname="firstname" class="input_5"  maxlength="32"'); ?>

		    </td>		   

		  </tr> 

		  <tr>



		     <td align="right"><?php echo ENTRY_LAST_NAME . (zen_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="red">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?></td>

		    <td class="pad_l_10px">

		    <?php echo zen_draw_input_field('lastname',($account->fields['customers_lastname'] == 'New Customer' ? '':$account->fields['customers_lastname']), 'id="lastname"  chkrule="nnull/min2" chkname="lastname" class="input_5" maxlength="32"'); ?>

		    </td>

		  </tr> 

		  <tr>

		    <td align="right"><?php echo TEXT_WHICH_DESCRIBES; ?><span class="red">*</span></td>

		    <td class="pad_l_10px">

				<?php echo zen_draw_pull_down_menu('customers_describes',$bestYouArray,$account->fields['customers_describes'],' chkrule="isselect" chkname="Which one describes you the best?" '); ?>



		  </tr>

<tr>

    <td align="right"><?php echo ENTRY_STREET_ADDRESS; ?><span class="red">*</span></td>

    <td class="pad_l_10px">

    <?php echo zen_draw_input_field('street_address', $account->fields['entry_street_address'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_street_address', '40') . ' chkrule="nnull/min5" chkname="Street Address" class="input_5" id="street-address" maxlength="64"') ; ?>

   

    <!--  <br> Notice: P.O. boxes addresses are not available for shipping. --> </td>

  </tr>

  <tr>

     <td align="right"><?php echo ENTRY_SUBURB; ?></td>     

     <td class="pad_l_10px">

     <?php echo zen_draw_input_field('suburb',$account->fields['entry_suburb'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_suburb', '64') . ' id="suburb"  class="input_5"') ; ?>

     </td>

  </tr>

    <tr>

    <td align="right"><?php echo ENTRY_CITY; ?> <span class="red">*</span></td>

    <td class="pad_l_10px">

    <label class="inputLabel" for="city"></label>

    <?php echo zen_draw_input_field('city',$account->fields['entry_city'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_city', '40') . ' chkrule="nnull/min3" chkname="City" class="input_5" id="city" maxlength="32"') ; ?>

  </tr>   

  <tr>

    <td align="right"><?php echo ENTRY_COUNTRY; ?><span class="red">*</span></td>

    <td class="pad_l_10px">

      <?php echo zen_get_country_list('zone_country_id', $account->fields['entry_country_id'], 'id="country" ' . '  onchange="update_zone(this.form);" class="l_select" chkname="Country / Region" chkrule="isselect"  id="country"'); ?>

     </td>

  </tr>

    <tr id="zone_id_tr" style="display: none;"><td align="right"><?php echo ENTRY_STATE; ?></td>

    <td  class="pad_l_10px">

      <select class="l_select" chkname="State/Province/Region" chkrule="isselect" id="stateZone" name="zone_id">  </select>

      </td></tr>

      <tr id="zone_id_tr1" style="dispaly:block" >

       <td align="right"><?php echo ENTRY_STATE; ?></td>

       <td class="pad_l_10px">

         <input type="text" id="state" class="l_input" maxlength="40" value="<?php echo ($account->fields['entry_zone_id'] == '0'? $account->fields['entry_state'] :$account->fields['entry_zone_id']); ?>" name="state"/>

         </td>

    </tr>

        <tr>

       <td align="right"><?php echo ENTRY_POST_CODE; ?><span class="red">*</span></td>

       <td class="pad_l_10px">

       <?php echo zen_draw_input_field('postcode', $account->fields['entry_postcode'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_postcode', '40') . ' chkrule="nnull/min4" chkname="Post/ZIP Code" class="input_5" maxlength="10" id="postcode"'); ?>

       </td>

    </tr>   

    <tr>

      <td align="right"><?php echo ENTRY_PHONE_NUMBER; ?> <span class="red">*</span></td>

      <td class="pad_l_10px">

       <?php echo zen_draw_input_field('customers_telephone', $account->fields['customers_telephone'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'customers_telephone', '40') . ' chkrule="nnull/min4/tel" chkname="Phone" class="input_5" maxlength="10" id="customers_telephone"'); ?>

      </td>

    </tr> 

    <tr>

      <td align="right">

	  

	  <?php // 删除输入传真，用WEDDING DATE代替公司  echo ENTRY_FAX_NUMBER; ?></td>

      <td class="pad_l_10px">

       <?php // echo zen_draw_input_field('customers_fax', $account->fields['customers_fax'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'customers_fax', '40') . ' class="s_input" maxlength="10" id="customers_fax"'); ?>    

      </td>

    </tr>  

		

		

		  <tr>

		     <td align="right"><?php   ?></td>

		     <td class="pad_l_10px">

		     <?php //  echo zen_draw_input_field('customers_company', $account->fields['entry_company'], 'id="customers_company" class="input_5"'); ?>     

		<!--    if applicable   -->

			 </td>		     	

		  </tr>

		  

		  

		  <tr>

		  

		 <!--以下删除选择邮件格式选项 ENTRY_EMAIL_PREFERENCE-->

		  

		  <td align="right"><?php echo ENTRY_EMAIL_PREFERENCE; ?></td>

		  <td class="pad_l_10px"><?php echo zen_draw_radio_field('email_format', 'HTML', $email_pref_html,'id="email-format-html"') . '<label class="radioButtonLabel" for="email-format-html">' . ENTRY_EMAIL_HTML_DISPLAY . '</label>' . zen_draw_radio_field('email_format', 'TEXT', $email_pref_text, 'id="email-format-text"') . '<label  class="radioButtonLabel" for="email-format-text">' . ENTRY_EMAIL_TEXT_DISPLAY . '</label>'; ?></td>

		  </tr>

		  

		  

		</tbody></table>

				

		<br/>	

		



		    

		<ul class="midframe g_t_r margin_t">

	<button onclick="if($('gender').value==''){alert('You must select gender.');$('gender').focus();}else{if(fmChk(this.form)){this.form.submit();}}" type="button">

		   <span>Save for change</span>

		</button>

		</ul>

		

<!--  下面加了一个 CHECKOUT 按钮-->		

 	<ul class="midframe g_t_r margin_t"> save your information first, then 	<?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL') . '" class=" ">Continue Checkout</a><br/>'; ?> </ul>

		

	  </form>

	  



	  

   </div>

   

	<div class="<?php echo $mailBox?'show':'hide'; ?>" id="ChangeMail">

		<?php if ($messageStack->size('email_edit') > 0) echo $messageStack->output('email_edit'); ?>

    <?php echo zen_draw_form('email_edit', zen_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'), 'post', ' id="email_edit" onsubmit="return(fmChk(this))"') . zen_draw_hidden_field('action', 'email_edit' ,' id="action"'); ?>	

    <strong>Update your account</strong><br/>

		<br/>

		<span class="red">*</span> Indicates required fields

		<table width="490" cellspacing="0" cellpadding="0" border="0">

		  <tbody><tr>

		    <td width="180" align="right"><?php echo TEXT_EXISTING_PASSWORD; ?><span class="red">*</span></td>

		    <td class="pad_l_10px">

		    <?php echo zen_draw_password_field('existing_password','', ' chkrule="nnull/min5" chkname="Existing password" class="input_5"'); ?></td>

		  </tr>

		  <tr>

		    <td align="right"><?php echo TEXT_NEW_EMAIL_ADDRESS; ?><span class="red">*</span></td>

		    <td class="pad_l_10px"><?php //email_address ?>

		    <?php echo zen_draw_input_field('email', $account->fields['customers_email_address'], 'id="email" chkrule="nnull/min6/eml" chkname="New e-mail address" class="input_5"'); ?>

		  </tr>

		</tbody></table>

				

		<br/>	    

		<ul class="midframe g_t_r margin_t">

		<button type="submit">

		   <span>Save for change</span>

		</button>

		</ul>

	  </form>

   </div>

   

   <div class="<?php echo $passwordBox?'show':'hide'; ?>" id="ChangePassword">

   <?php if ($messageStack->size('password_edit') > 0) echo $messageStack->output('password_edit'); ?>

   <?php echo zen_draw_form('password_edit', zen_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'), 'post', ' onsubmit="return(fmChk(this))" id="password_edit"') . zen_draw_hidden_field('action', 'password_edit' ,' id="action"'); ?>

    <strong>Update your password</strong><br/><br/>

		<span class="red">*</span> Indicates required fields

		<table width="490" cellspacing="0" cellpadding="0" border="0">

		  <tbody><tr>

		    <td width="180" align="right"><?php echo TEXT_EXISTING_PASSWORD; ?><span class="red">*</span></td>

		    <td class="pad_l_10px">

		    <?php echo zen_draw_password_field('existing_password_1','', ' chkrule="nnull/min5" chkname="Existing password" class="input_5"'); ?></td>

		  </tr>		 

		  <tr>

		    <td align="right"><?php echo TEXT_NEW_PASSWORD; ?><span class="red">*</span></td>

		    <td class="pad_l_10px">

		    <?php echo zen_draw_password_field('password','', ' chkrule="nnull/min5" chkname="ew password" class="input_5" id="login-password1"'); ?></td>

		  </tr>

		  <tr>

		    <td align="right"><?php echo TEXT_REENTER_PASSWORD; ?><span class="red">*</span></td>

		    <td class="pad_l_10px">

		    <?php echo zen_draw_password_field('confirmation','', ' chkrule="nnull/cpwd/#login-password1" chkname="Re-enter password" class="input_5"'); ?></td>

		  </tr>		  

		</tbody></table>

		

		<br/>

		<ul class="midframe g_t_r margin_t">

		<button type="submit">

		   <span>Save for change</span>

		</button>

		</ul>

	   </form>

 	 </div>			

</div>

<script>

    layerswich();

    initForm('email_information');

		initForm('email_edit');

		initForm('password_edit');

</script>	</div>



