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
//  $Id: links_manager.php 2004-11-19 dave@open-operations.com
//
define('NAVBAR_TITLE_1', 'Question Submission');
define('NAVBAR_TITLE_2', 'Success');
define('HEADING_TITLE', 'Your Question Has Been Submitted!');
define('TEXT_FAQ_SUBMITTED', 'Your question has been successfully submitted! It will be answered as soon as we review it. If you have <small><b>ANY</b></small> questions, please <a href="' . zen_href_link(FILENAME_CONTACT_US) . '">email us</a>.<br><br>You will receive an email confirming your submittal. If you have not received it within the hour, please <a href="' . zen_href_link(FILENAME_CONTACT_US) . '">contact us</a>. Also, you will receive an email as soon as your question has been answered.');
define('TEXT_FAQ_SUBMITTED_APPROVED', 'Your question has been successfully submitted and is now live on our site!. If you have <small><b>ANY</b></small> questions, please <a href="' . zen_href_link(FILENAME_CONTACT_US) . '">email us</a>.<br><br>You will receive an email confirming your submittal. If you have not received it within the hour, please <a href="' . zen_href_link(FILENAME_CONTACT_US) . '">contact us</a>.');
?>