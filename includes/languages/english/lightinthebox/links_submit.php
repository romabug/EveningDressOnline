<?php
/**
 * Links Submit Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_links_submit_default.php 3.4.0 3/27/2008 Clyde Jones $
 */
define('NAVBAR_TITLE', 'Submit A Link');
define('NAVBAR_TITLE_1', 'Links');
define('NAVBAR_TITLE_2', 'Submit A Link');
define('HEADING_TITLE', 'Links Submission');
define('SUBMIT_RULE', '<p>Please choose the most appropriate category for your link. <strong>' . STORE_NAME . '</strong> reserves the right to change the category or edit your description, if needed.</p>');
define('LINKS_SUCCESS', 'Your link has been successfully submitted! It will be added to our listing as soon as we approve it.<br>You will receive an email confirming your submittal. If you have not received it within the hour, please <a href="' . zen_href_link(FILENAME_CONTACT_US) . '">contact us</a>. Also, you will receive an email as soon as your link is approved.');
define('TEXT_MAIN', 'Please fill out the following form to submit your website.');
define('EMAIL_SUBJECT', 'Welcome to ' . STORE_NAME . ' link exchange.');
define('EMAIL_GREET_NONE', 'Dear %s,' . "\n\n");
define('EMAIL_WELCOME', 'Welcome to <b>' . STORE_NAME . '</b> link exchange program.' . "\n\n");
define('EMAIL_TEXT', 'Your link has been successfully submitted at ' . STORE_NAME . '. It will be added to our listing as soon as we approve it.' ."\n". 'You will receive an email about the status of your submittal. If you have not received it within the next 48 hours, please contact us before submitting your link again.' . "\n\n");
define('EMAIL_CONTACT', 'For help with our link exchange program, please email the store-owner: ' . STORE_OWNER_EMAIL_ADDRESS . "\n\n");
define('EMAIL_WARNING', '<b>Note:</b> This email address was given to us during a link submittal. If you have a problem, please send an email to ' . STORE_OWNER_EMAIL_ADDRESS . "\n\n");
define('EMAIL_OWNER_SUBJECT', 'Link submittal at ' . STORE_NAME);
define('EMAIL_OWNER_TEXT', 'A new link was submitted at ' . STORE_NAME . '. It is not yet approved. Please verify this link and activate.' . "\n\n");
define('TEXT_LINKS_HELP_LINK', '&nbsp;Help&nbsp;[?]');
define('HEADING_LINKS_HELP', 'Links Help');
define('TEXT_LINKS_HELP', '<b>Site Title:</b> A descriptive title for your website.<br><br><b>URL:</b> The absolute web address of your website, including the \'http://\'.<br><br><b>Category:</b> Most appropriate category under which your website falls.<br><br><b>Description:</b> A brief description of your website.<br><br><b>Image URL:</b> The absolute URL of the image you wish to submit, including the \'http://\'. This image will be displayed along with your website link.<br>Eg: http://your-domain.com/path/to/your/image.gif <br><br><b>Full Name:</b> Your full name.<br><br><b>Email:</b> Your email address. Please enter a valid email, as you will be notified via email.<br><br><b>Reciprocal Page:</b> The absolute URL of your links page, where a link to our website will be listed/displayed.<br>Eg: http://your-domain.com/path/to/your/links_page.php');
define('TEXT_CLOSE_WINDOW', '<u>Close Window</u> [x]');


?>