<?php

/**

 * @package languageDefines

 * @copyright Copyright 2003-2006 Zen Cart Development Team

 * @copyright Portions Copyright 2003 osCommerce

 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0

 * @version $Id: create_account.php 5745 2007-02-01 00:52:06Z ajeh $

 */



// define('TABLE_HEADING_LOGIN_DETAILS', 'Login Details');



define('NAVBAR_TITLE', 'Create an Account');



define('HEADING_TITLE', 'My Account Information');



define('TEXT_ORIGIN_LOGIN', '<strong class="note">NOTE:</strong> If you already have an account with us, please login at the <a href="%s">login page</a>.');



// greeting salutation

define('EMAIL_SUBJECT', 'Welcome to ' . STORE_NAME);

define('EMAIL_GREET_MR', 'Dear Mr. %s,' . "\n\n");

define('EMAIL_GREET_MS', 'Dear Customer' . "\n\n");

define('EMAIL_GREET_NONE', 'Dear %s' . "\n\n");



// First line of the greeting

define('EMAIL_WELCOME',  'Welcome to australian owned ' . STORE_NAME . '.');

define('EMAIL_SEPARATOR', '--------------------');

define('EMAIL_COUPON_INCENTIVE_HEADER', 'Congratulations! To make your next visit to our online shop a more rewarding experience, listed below are details for a Discount Coupon created just for you!' . "\n\n");

// your Discount Coupon Description will be inserted before this next define

define('EMAIL_COUPON_REDEEM', 'To use the Discount Coupon, enter the ' . TEXT_GV_REDEEM . ' code during checkout:  <strong>%s</strong>' . "\n\n");

define('TEXT_COUPON_HELP_DATE', '<p>The coupon is valid between %s and %s</p>');



define('EMAIL_GV_INCENTIVE_HEADER', 'Just for stopping by today, we have sent you a ' . TEXT_GV_NAME . ' for %s!' . "\n");

define('EMAIL_GV_REDEEM', 'The ' . TEXT_GV_NAME . ' ' . TEXT_GV_REDEEM . ' is: %s ' . "\n\n" . 'You can enter the ' . TEXT_GV_REDEEM . ' during Checkout, after making your selections in the store. ');

define('EMAIL_GV_LINK', ' Or, you may redeem it now by following this link: ' . "\n");

// GV link will automatically be included before this line



define('EMAIL_GV_LINK_OTHER','Once you have added the ' . TEXT_GV_NAME . ' to your account, you may use the ' . TEXT_GV_NAME . ' for yourself, or send it to a friend!' . "\n\n");



define('EMAIL_TEXT', 'The account you just set up allows you to securely store all your ordering information, so that your purchase on our website is simple and safe as well as much pleasures. With your account, you can now take part in the various services we have to offer you. Some of these services include: <strong>Permanent Cart,</strong>  <strong>Address Book,</strong>  <strong>Order History,</strong>  <strong>Products Reviews etc..</strong> </br>' . "\n\n" . '  </br>'. "\n\n" . '</br> 1. Evening Dresses Online was founded to give our customer the lowest price and the best quality evening cocktail dresses, online prices are about 70% off of traditional store prices.' . "\n" .' </br> 2.The pictures of this dress are authentic and original,the materials used in all our dress are of the highest quality, the details on the dress will leave you astounded.'  . "\n" .' </br> 3. Shopping with our online store is safe and convenient. With sales consultants standing by 12 hours a day, 6 days a week.' . "\n\n");







/*  congratulations on your upcoming wedding! 



define('EMAIL_TEXT', 'The account you just set up allows you to securely store all your ordering information, so that your purchase on our website is simple and safe as well as much pleasures. With your account, you can now take part in the <strong>various services</strong> we have to offer you. Some of these services include:' . "\n\n" . '<li><strong>Permanent Cart</strong> - Any products added to your online cart remain there until you remove them, or check them out.' . "\n\n" . '<li><strong>Address Book</strong> - We can now deliver your wedding dresses to another address other than yours! ' . "\n\n" . '<li><strong>Order History</strong> - View your history of purchases that you have made with us.' . "\n\n" . '<li><strong>Products Reviews</strong> - Share your opinions on products with our other customers.' . "\n\n");



*/



define('EMAIL_CONTACT', 'For help with any of our online services, please email to: <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS ." </a>\n\n");

define('EMAIL_GV_CLOSURE','</br></br>Kind Regards,' . "\n\n" . STORE_OWNER . "  \n". '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'.HTTP_SERVER . DIR_WS_CATALOG ."</a>\n\n");



// email disclaimer - this disclaimer is separate from all other email disclaimers

 define('EMAIL_DISCLAIMER_NEW_CUSTOMER', ' ');  



//moved definitions to english.php

//define('TABLE_HEADING_PRIVACY_CONDITIONS', 'Privacy Statement');

//define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION', 'Please acknowledge you agree with our privacy statement by ticking the following box. The privacy statement can be read <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><span class="pseudolink">here</span></a>.');

//define('TEXT_PRIVACY_CONDITIONS_CONFIRM', 'I have read and agreed to your privacy statement.');

//define('TABLE_HEADING_ADDRESS_DETAILS', 'Address Details');

//define('TABLE_HEADING_PHONE_FAX_DETAILS', 'Additional Contact Details');

//define('TABLE_HEADING_DATE_OF_BIRTH', 'Verify Your Age');

//define('TABLE_HEADING_LOGIN_DETAILS', 'Login Details');

//define('TABLE_HEADING_REFERRAL_DETAILS', 'Were You Referred to Us?');

?>

