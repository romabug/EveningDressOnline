<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  Original contrib by Vijay Immanuel for osCommerce, converted to zen by dave@open-operations.com - http://www.open-operations.com
//  $Id: links_manager.php 2006-12-22 Clyde Jones
//
?>
<script type="text/javascript"><!--
var form = "";
var submitted = false;
var error = false;
var error_message = "";
function check_input(field_name, field_size, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;
    if (field_value == '' || field_value.length < field_size) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}
function check_form(form_name) {
  if (submitted == true) {
    alert("<?php echo JS_ERROR_SUBMITTED; ?>");
    return false;
  }
  error = false;
  form = form_name;
  error_message = "<?php echo JS_ERROR; ?>";
  check_input("links_title", <?php echo ENTRY_LINKS_TITLE_MIN_LENGTH; ?>, "<?php echo ENTRY_LINKS_TITLE_ERROR; ?>");
  check_input("links_url", <?php echo ENTRY_LINKS_URL_MIN_LENGTH; ?>, "<?php echo ENTRY_LINKS_URL_ERROR; ?>");
  check_input("links_description", <?php echo ENTRY_LINKS_DESCRIPTION_MIN_LENGTH; ?>, "<?php echo ENTRY_LINKS_DESCRIPTION_ERROR; ?>");
  check_input("links_contact_name", <?php echo ENTRY_LINKS_CONTACT_NAME_MIN_LENGTH; ?>, "<?php echo ENTRY_LINKS_CONTACT_NAME_ERROR; ?>");
  check_input("links_contact_email", <?php echo ENTRY_EMAIL_ADDRESS_MIN_LENGTH; ?>, "<?php echo ENTRY_EMAIL_ADDRESS_ERROR; ?>");
<?php if (SUBMIT_LINK_REQUIRE_RECIPROCAL == 'true') echo ' check_input("links_reciprocal_url", ' . ENTRY_LINKS_URL_MIN_LENGTH . ', "' . ENTRY_LINKS_RECIPROCAL_URL_ERROR . '");' . "\n"; ?>


  if (error == true) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}
function popupWindow(url) {
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=450,height=320,screenX=150,screenY=150,top=150,left=150')
}
//--></script>