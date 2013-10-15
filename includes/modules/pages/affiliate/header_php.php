<?php
/**
 * affiliate Page
 * 
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 1.3 $
 */

  $_SESSION['navigation']->remove_current_page();

  require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

// include template specific file name defines
  $define_page = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_AFFILIATE, 'false');

  $breadcrumb->add(NAVBAR_TITLE);
  if (isset($_POST['action']) && $_POST['action'] == 'register'){
  	
  	$name =$_POST['userName'];
    $userEmail =$_POST['userEmail'];
    $userWeb =$_POST['userWeb'];
    $userPhone =$_POST['userPhone'];
    $userComments =$_POST['userComments'];  
    // add in regular email welcome text
    $email_text .= "\n\n" . $userWeb .'<br/>'. $userPhone .'<br/>'. $userComments;

    $html_msg['EMAIL_MESSAGE_HTML']  = str_replace('\n','',EMAIL_TEXT);
    $html_msg['EMAIL_CONTACT_OWNER'] = str_replace('\n','',EMAIL_CONTACT);
    $html_msg['EMAIL_CLOSURE']       = nl2br(EMAIL_GV_CLOSURE);

    // include create-account-specific disclaimer
    $email_text .= "\n\n" . sprintf(EMAIL_DISCLAIMER_NEW_CUSTOMER, STORE_OWNER_EMAIL_ADDRESS). "\n\n";
    $html_msg['EMAIL_DISCLAIMER'] = sprintf(EMAIL_DISCLAIMER_NEW_CUSTOMER, '<a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS .' </a>');

    // send welcome email
    zen_mail(STORE_NAME, EMAIL_FROM, 'Affiliate programe', $email_text, $name, $email_address, $html_msg, '');
    
  	$messageStack->add('affi',TEXT_AFFILIATE_SUCCESS,'success');
  }

?>
