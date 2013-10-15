<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=adress_book.<br />
 * Allows customer to manage entries in their address book
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_address_book_default.php 5369 2006-12-23 10:55:52Z drbyte $
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
	<li><a href="<?php echo zen_href_link(FILENAME_ACCOUNT_EDIT,'','SSL'); ?>">Account Settings</a></li>
	<li><a class="red b" href="<?php echo zen_href_link(FILENAME_MANAGER_ADDRESS,'','SSL');?>">Manage Address Book</a></li>
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

<div class="right_big_con margin_t">
<?php if ($messageStack->size('manager_address') > 0) echo $messageStack->output('manager_address'); ?>
<h2 class="border_b line_30px"><?php echo HEADING_TITLE; ?></h2>
<div class="clear"></div>
<?php if(isset($_GET['edit'])) {?>
<h4 class="pad_1em"><?php echo HEADING_TEXT_EDIT_ADDRESS; ?></h4>
<?php 
  echo zen_draw_form('checkout_address',zen_href_link(FILENAME_MANAGER_ADDRESS,'', 'SSL'),'post',' onsubmit="return(fmChk(this))" id="checkout_address"');
  echo zen_draw_hidden_field('edit',$_GET['edit']);
  echo zen_draw_hidden_field('action','update'); 
?>
<input type="hidden" value="0" name="address"/>
<input type="hidden" value="0" name="save"/>
<input type="hidden" value="1" name="flgflg"/>

  <table width="500" cellspacing="0" cellpadding="0" border="0" align="center" class="margin_t address_tb">
  <tbody>
  <tr>
    <td width="123" align="right"><strong>Gender: </strong><span class="red">*</span></td>
    <td colspan="3">
    <?php echo zen_draw_pull_down_menu('gender',$genderArray,$entry->fields['entry_gender'],'chkname="Gender" chkrule="isselect" class="s_select" id="gender"'); ?>
    </td>
  </tr>
  <tr>
     <td align="right"><strong>First name:</strong><span class="red">*</span></td>
     <td colspan="3">
      <div style="width: 120px;" class="fl"><?php echo zen_draw_input_field('firstname',$entry->fields['entry_firstname'], 'id="firstname" chkrule="nnull/min2" chkname="firstname" class="s_input"  maxlength="32"'); ?></div>
      <div style="width: 110px;" class="fl g_t_r"><strong>Last name:</strong> <span class="red">*</span>  </div>
      <div style="width: 120px;" class="fl"><?php echo zen_draw_input_field('lastname', $entry->fields['entry_lastname'], 'id="lastname" chkrule="nnull/min2" chkname="lastname" class="s_input"  maxlength="32"'); ?></div>
    </td>    
  </tr>
    <tr>
    <td align="right"><strong><?php echo ENTRY_STREET_ADDRESS; ?></strong> <span class="red">*</span></td>
    <td colspan="3">
    <?php echo zen_draw_input_field('street_address', $entry->fields['entry_street_address'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_street_address', '40') . ' chkrule="nnull/min5" chkname="Street Address" class="l_input" id="street-address" maxlength="64"') ; ?>
    </td>
  </tr>
  <tr>
     <td align="right"><strong><?php echo ENTRY_SUBURB; ?></strong></td>     
     <td colspan="3">
     <?php echo zen_draw_input_field('suburb',$entry->fields['entry_suburb'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_suburb', '64') . ' id="suburb"  class="l_input"') ; ?>
     </td>
  </tr>
    <tr>
    <td align="right"><strong><?php echo ENTRY_CITY; ?></strong> <span class="red">*</span></td>
    <td colspan="3">
    <label class="inputLabel" for="city"></label>
    <?php echo zen_draw_input_field('city',$entry->fields['entry_city'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_city', '40') . ' chkrule="nnull/min3" chkname="City" class="l_input" id="city" maxlength="32"') ; ?>
  </tr>   
  <tr>
    <td align="right"><strong><?php echo ENTRY_COUNTRY; ?></strong><span class="red">*</span>
    </td>
    <td colspan="3">
      <?php echo zen_get_country_list('zone_country_id', $entry->fields['entry_country_id'], 'id="country" ' . '  onchange="update_zone(this.form);" class="l_select" chkname="Country / Region" chkrule="isselect"  id="country"'); ?>
     </td>
  </tr>
    <tr id="zone_id_tr" style="display: none;">
    <td align="right"><strong><?php echo ENTRY_STATE; ?></strong></td>
    <td colspan="3">
      <select class="l_select" chkname="State/Province/Region" chkrule="isselect" id="stateZone" name="zone_id">  </select>
      </td></tr>
      <tr id="zone_id_tr1" style="dispaly:block" >
       <td align="right"><strong><?php echo ENTRY_STATE; ?></strong></td>
       <td colspan="3">
         <input type="text" id="state" class="l_input" maxlength="40" value="<?php echo $entry->fields['entry_zone_id']; ?>" name="state"/>
         </td>
    </tr>
        <tr>
       <td align="right"><strong><?php echo ENTRY_POST_CODE; ?></strong><span class="red">*</span></td>
       <td colspan="3">
       <?php echo zen_draw_input_field('postcode', $entry->fields['entry_postcode'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_postcode', '40') . ' chkrule="nnull/min4" chkname="Post/ZIP Code" class="s_input" maxlength="10" id="postcode"'); ?>
       </td>
    </tr>   
    <tr>
      <td align="right"><strong><?php echo ENTRY_PHONE_NUMBER; ?></strong> <span class="red">*</span></td>
      <td colspan="3">
       <?php echo zen_draw_input_field('phone', $entry->fields['entry_phone'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_phone', '40') . ' chkrule="nnull/min4/tel" chkname="Phone" class="s_input" maxlength="10" id="phone"'); ?>
      </td>
    </tr> 
    <tr>
      <td align="left" colspan="4">
      <div style="width: 470px;" class="g_t_r">
      <input type="image" style="border: medium none ; padding: 0pt;" title=" Add " alt="Add" src="includes/templates/<?php echo $template_dir; ?>/images/button/btn_save.gif"/></div>
      </td>
    </tr>
    </tbody></table>
    </form>
    <script type="text/javascript"> initForm('checkout_address'); </script>

<?php }else{ ?>
<div class="pad_l_28px margin_t big">
  <h4><?php echo PRIMARY_ADDRESS_TITLE; ?></h4>
<ul class="pad_10px">
<b></b>
<?php echo zen_address_label($_SESSION['customer_id'], $_SESSION['customer_default_address_id'], true, ' ', '<br />'); ?>
<div class="margin_t">
<a href="#">
<?php echo '<a href="'.zen_href_link(FILENAME_MANAGER_ADDRESS,'edit='.$addressArray[0]['address_book_id'].'','SSL').'">'.zen_image($template->get_template_dir('btn_edit.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/btn_edit.gif').'</a>'; ?>
</div>
</ul>
<h4><?php echo SHIPPING_ADDRESS_TITLE; ?></h4>
<ul class="pad_10px">
<?php
/**
 * Used to loop thru and display address book entries
 */
  foreach ($addressArray as $addresses) {
  	if ($addresses['address_book_id'] == $_SESSION['customer_default_address_id']){
  		// nothing  
  	}else{
?>
<div style="overflow: hidden; height: 130px;" class="fl halfwidth">
<?php echo zen_address_format($addresses['format_id'], $addresses['address'], true, ' ', '<br />'); ?>
<div class="margin_t">
<?php echo '<a href="' . zen_href_link(FILENAME_MANAGER_ADDRESS, 'edit=' . $addresses['address_book_id'], 'SSL') . '">' . zen_image($template->get_template_dir('btn_edit.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/btn_edit.gif') . '</a> <a href="javascript:if(confirm(\'Are you sure deleting this shipping address?\')){window.location.href=\''. zen_href_link(FILENAME_MANAGER_ADDRESS, 'delete=' . $addresses['address_book_id'], 'SSL') . '\'}">' . zen_image($template->get_template_dir('btn_delete.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/btn_delete.gif') . '</a>'; ?>
</div>
</div>
<?php
		}
  }
?>
 <div style="width: 600px;" class="hr_d fl"> </div>
</ul>
<div class="clear"></div>
<?php
  if (zen_count_customer_address_book_entries()-1 < MAX_ADDRESS_BOOK_ENTRIES) {
?>
<h4 class="pad_1em"><?php echo HEADING_TEXT_NEW_SHIPPING_ADDRESS; ?></h4>
<?php 
  echo zen_draw_form('checkout_address',zen_href_link(FILENAME_MANAGER_ADDRESS,'', 'SSL'),'post',' onsubmit="return(fmChk(this))" id="checkout_address"');
  echo zen_draw_hidden_field('action','createShipping'); 
?>
<input type="hidden" value="0" name="address"/>
<input type="hidden" value="0" name="save"/>
<input type="hidden" value="1" name="flgflg"/>

	<table width="500" cellspacing="0" cellpadding="0" border="0" align="center" class="margin_t address_tb">
	<tbody>
	<tr>
		<td width="123" align="right"><strong>Gender: </strong><span class="red">*</span></td>
		<td colspan="3">
		<?php echo zen_draw_pull_down_menu('gender',$genderArray,' ','chkname="Gender" chkrule="isselect" class="s_select" id="gender"'); ?>
		</td>
	</tr>
	<tr>
	   <td align="right"><strong>First name:</strong><span class="red">*</span></td>
	   <td colspan="3">
	   	<div style="width: 120px;" class="fl"><?php echo zen_draw_input_field('firstname','', 'id="firstname" chkrule="nnull/min2" chkname="firstname" class="s_input"  maxlength="32"'); ?></div>
	   	<div style="width: 110px;" class="fl g_t_r"><strong>Last name:</strong> <span class="red">*</span>  </div>
	   	<div style="width: 120px;" class="fl"><?php echo zen_draw_input_field('lastname', '', 'id="lastname" chkrule="nnull/min2" chkname="lastname" class="s_input"  maxlength="32"'); ?></div>
	  </td>	   
	</tr>
    <tr>
		<td align="right"><strong><?php echo ENTRY_STREET_ADDRESS; ?></strong> <span class="red">*</span></td>
		<td colspan="3">
		<?php echo zen_draw_input_field('street_address', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_street_address', '40') . ' chkrule="nnull/min5" chkname="Street Address" class="l_input" id="street-address" maxlength="64"') ; ?>
		</td>
	</tr>
	<tr>
	   <td align="right"><strong><?php echo ENTRY_SUBURB; ?></strong></td>		 
	   <td colspan="3">
		 <?php echo zen_draw_input_field('suburb', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_suburb', '64') . ' id="suburb"  class="l_input"') ; ?>
	   </td>
	</tr>
    <tr>
	  <td align="right"><strong><?php echo ENTRY_CITY; ?></strong> <span class="red">*</span></td>
	  <td colspan="3">
	  <label class="inputLabel" for="city"></label>
		<?php echo zen_draw_input_field('city','', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_city', '40') . ' chkrule="nnull/min3" chkname="City" class="l_input" id="city" maxlength="32"') ; ?>
	</tr>		
	<tr>
	  <td align="right"><strong><?php echo ENTRY_COUNTRY; ?></strong><span class="red">*</span>
	  </td>
	  <td colspan="3">
	  	<?php echo zen_get_country_list('zone_country_id', $entry->fields['entry_country_id'], 'id="country" onchange="update_zone(this.form);" class="l_select" chkname="Country / Region" chkrule="isselect"  id="country"'); ?>
     </td>
	</tr>
		<tr id="zone_id_tr" style="display: none;">
		<td align="right"><strong><?php echo ENTRY_STATE; ?></strong></td>
		<td colspan="3">
			<select class="l_select" chkname="State/Province/Region" chkrule="isselect" id="stateZone" name="zone_id">  </select>
			</td></tr>
	    <tr id="zone_id_tr1" style="" >
		   <td align="right"><strong><?php echo ENTRY_STATE; ?></strong></td>
		   <td colspan="3">
		     <input type="text" id="state" class="l_input" maxlength="40" value="" name="state"/>
		     </td>
		</tr>
				<tr>
		   <td align="right"><strong><?php echo ENTRY_POST_CODE; ?></strong><span class="red">*</span></td>
		   <td colspan="3">
		   <?php echo zen_draw_input_field('postcode', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_postcode', '40') . ' chkrule="nnull/min4" chkname="Post/ZIP Code" class="s_input" maxlength="10" id="postcode"'); ?>
		   </td>
		</tr>		
		<tr>
			<td align="right"><strong><?php echo ENTRY_PHONE_NUMBER; ?></strong> <span class="red">*</span></td>
			<td colspan="3">
		   <?php echo zen_draw_input_field('phone', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_phone', '40') . ' chkrule="nnull/min4/tel" chkname="Phone" class="s_input" maxlength="10" id="phone"'); ?>
			</td>
		</tr>	
		<tr>
			<td align="left" colspan="4">
			<div style="width: 470px;" class="g_t_r">
			<input type="image" style="border: medium none ; padding: 0pt;" title=" Add " alt="Add" src="includes/templates/<?php echo $template_dir; ?>/images/button/btn_save.gif"/></div>
			</td>
		</tr>
	  </tbody></table>
	  </form>
	  <script type="text/javascript"> initForm('checkout_address'); </script>
<?php  }?>
<?php } ?>



<br class="clear" />
</div>
