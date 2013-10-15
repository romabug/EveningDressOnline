<?php
/**
 * Module Template
 *
 * Displays address-book details/selection
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_address_book_details.php 5924 2007-02-28 08:25:15Z drbyte $
 */
?>
<h4 class="pad_l_28px margin_t">
<?php 
if (isset($_GET['edit'])) { 
  echo HEADING_TITLE_MODIFY_ENTRY; 
} elseif (isset($_GET['delete'])) {
  echo HEADING_TITLE_DELETE_ENTRY;
} else {
  echo HEADING_TITLE_ADD_ENTRY; 
} 
?>
</h4>
<div class="pad_l_28px"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
<?php echo zen_draw_form('addressbook', zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, (isset($_GET['url']) ? 'url=' . $_GET['url'].'&' : '').(isset($_GET['edit']) ? 'edit=' . $_GET['edit'] : ''), 'SSL'), 'post', 'id="addressbook" onsubmit="return(fmChk(this))"'); ?>
<table class="margin_t address_tb" cellspacing="0" cellpadding="0" width="500" border="0" align="center">
<?php
  if (ACCOUNT_GENDER == 'true') {
  	echo '<tr><td class="g_t_r b">'.ENTRY_GENDER.(zen_not_null(ENTRY_GENDER_TEXT) ? '&nbsp;<span class="red">' . ENTRY_GENDER_TEXT . '</span>': '').'</td>';
  	echo '<td colspan="3">';
    $genderArray = array();
		$genderArray[] = array('id'=> '-1','text'=> 'please select ...');
		$genderArray[] = array('id'=> 'm','text'=> MALE);
		$genderArray[] = array('id'=> 'f','text'=> FEMALE);
		
    echo zen_draw_pull_down_menu('gender',$genderArray,$entry->fields['entry_gender'],'chkname="Gender" chkrule="isselect" class="s_select" id="gender"');
    echo'<td></tr>';    
  }
?>
<tr><td class="g_t_r b"><?php echo ENTRY_FIRST_NAME. (zen_not_null(ENTRY_FIRST_NAME_TEXT) ? '&nbsp;<span class="red">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?></td>
<td colspan="3">
<div class="fl" style="width: 120px;"><?php echo zen_draw_input_field('firstname', $entry->fields['entry_firstname'], zen_set_field_length(TABLE_CUSTOMERS, 'customers_firstname', '40') . 'chkname="firstname" chkrule="nnull/min2" id="firstname" class="s_input"') ; ?></div>
<div class="fl g_t_r b" style="width: 100px;"><?php echo ENTRY_LAST_NAME . (zen_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="red">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?></div>
<div class="fl" style="width: 110px;"><?php echo zen_draw_input_field('lastname', $entry->fields['entry_lastname'], zen_set_field_length(TABLE_CUSTOMERS, 'customers_lastname', '40') . 'chkname="lastname" chkrule="nnull/min2" id="lastname" class="s_input"'); ?></div>
</td></tr>

<?php
  if (ACCOUNT_COMPANY == 'true' AND FALSE) {
?>
<tr><td class="g_t_r b"><?php echo ENTRY_COMPANY . (zen_not_null(ENTRY_COMPANY_TEXT) ? '&nbsp;<span class="red">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?></td>
<td colspan="3"><?php echo zen_draw_input_field('company', $entry->fields['entry_company'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_company', '40') . ' id="company" class="l_input"'); ?>
</td></tr>
<?php
  }
?>

<tr><td class="g_t_r b"><?php echo ENTRY_STREET_ADDRESS. (zen_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '&nbsp;<span class="red">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?></td>
<td colspan="3"><?php echo zen_draw_input_field('street_address', $entry->fields['entry_street_address'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_street_address', '40') . 'chkname="Street Address" chkrule="nnull/min5" id="street-address" class="l_input"') ; ?>
</td></tr>
<?php
  if (ACCOUNT_SUBURB == 'true') {
?>
<tr><td class="g_t_r b"><?php echo ENTRY_SUBURB. (zen_not_null(ENTRY_SUBURB_TEXT) ? '&nbsp;<span class="red">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?></td>
<td colspan="3"><?php echo zen_draw_input_field('suburb', $entry->fields['entry_suburb'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_suburb', '40') . 'id="suburb" class="l_input"') ; ?>
</td></tr>
<?php
  }
?>

<tr><td class="g_t_r b"><?php echo ENTRY_CITY . (zen_not_null(ENTRY_CITY_TEXT) ? '&nbsp;<span class="red">' . ENTRY_CITY_TEXT . '</span>': ''); ?></td>
<td colspan="3"><?php echo zen_draw_input_field('city', $entry->fields['entry_city'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_city', '40') . 'chkname="City" chkrule="nnull/min3" id="city" class="l_input"'); ?>
</td></tr>
<tr><td class="g_t_r b"><?php echo ENTRY_COUNTRY . (zen_not_null(ENTRY_COUNTRY_TEXT) ? '&nbsp;<span class="red">' . ENTRY_COUNTRY_TEXT . '</span>': ''); ?></td>
<td colspan="3"><?php echo zen_get_country_list('zone_country_id', $entry->fields['entry_country_id'], 'chkrule="isselect" chkname="Country / Region" id="country" class="l_select" onchange="update_zone(this.form);"'); ?>
</td></tr>

<tr id="zone_id_tr">
  <td class="g_t_r b"><?php echo ENTRY_STATE.(zen_not_null(ENTRY_STATE_TEXT)?'&nbsp;<span class="red">' . ENTRY_STATE_TEXT . '</span>':''); ?></td>
  <td colspan="3"><select id="stateZone" class="l_select" chkname="State/Province/Region" chkrule="isselect"  name="zone_id">  </select>
</td></tr>
<tr id="zone_id_tr1" style="display:none;">
  <td align="right"><strong><?php echo ENTRY_STATE.(zen_not_null(ENTRY_STATE_TEXT)?'&nbsp;<span class="red">' . ENTRY_STATE_TEXT . '</span>':''); ?></strong></td>
  <td colspan="3"><input id="state" type="text" class="l_input" maxlength="40" value="<?php echo ($entry->fields['entry_zone_id']==0)?$entry->fields['entry_state']:$entry->fields['entry_zone_id']; ?>" name="state"/></td>
  </tr>

<tr><td class="g_t_r b"><?php echo ENTRY_POST_CODE . (zen_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="red">' . ENTRY_POST_CODE_TEXT . '</span>': ''); ?></td>
<td colspan="3"><?php echo zen_draw_input_field('postcode', $entry->fields['entry_postcode'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_postcode', '40') . ' chkname="Post/ZIP Code" chkrule="nnull/min4" id="postcode" class="s_input"'); ?>
</td></tr>
<tr><td class="g_t_r b"><?php echo ENTRY_PHONE_NUMBER . (zen_not_null(ENTRY_PHONE_NUMBER_TEXT) ? '<span class="red">' . ENTRY_PHONE_NUMBER_TEXT . '</span>': ''); ?></td>
<td colspan="3"><?php echo zen_draw_input_field('phone', $entry->fields['entry_phone'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_phone', '40') . 'chkname="Phone" chkrule="nnull/min4/tel" class="s_input" id="phone"'); ?>
</td></tr>
<tr>
<td></td>
<td align="left" colspan="3">
<div style="width: 324px;">
Please make sure that the telephone number you typed is correct, during the shipping process, the shipping company might contact you for the delivery. </div>
</td></tr>
<?php
  //if ((isset($_GET['edit']) && ($_SESSION['customer_default_address_id'] != $_GET['edit'])) || (isset($_GET['edit']) == false) ) {
    //echo zen_draw_checkbox_field('primary', 'on', false, 'id="primary"') . ' <label class="checkboxLabel" for="primary">' . SET_AS_PRIMARY . '</label>';
  //}
?>
<tr><td align="right" colspan="4">
<?php
  if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    echo zen_draw_hidden_field('action', 'update') . zen_draw_hidden_field('edit', $_GET['edit']);
    echo '<input class="saveBtn" type="image" title=" Sign In " alt="Sign In" src="'.$template->get_template_dir('btn_save.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button').'/btn_save.gif'.'"/>';zen_image_submit(BUTTON_IMAGE_UPDATE, BUTTON_UPDATE_ALT);
  }
?>
</table>
<?php echo '</form>'; ?>
<script type="text/javascript"> initForm('addressbook'); </script>