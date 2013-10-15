<?php

define('NAVBAR_TITLE', 'Submit A Question');
define('NAVBAR_TITLE_1', 'Question\'s & Answer\'s');
define('NAVBAR_TITLE_2', 'Submit A Question');
define('HEADING_TITLE', 'Question Information');
define('HEADING_DESCRIPTION','<p class="big">Please complete the form below detailing your requests. We will reply you within 24hrs in working days.<br/>
	<span class="red">*</span> Indicates required fields</p>');
define('TEXT_INFORMATION', '');
define('TEXT_MAIN', 'Please fill out the following form to submit your faq.');
define('EMAIL_SUBJECT', 'Your Faq Submission At ' . STORE_NAME . '');
define('EMAIL_GREET_NONE', 'Dear %s' . "\n\n");
define('EMAIL_WELCOME', 'Thanks for your question submission at <b>' . STORE_NAME . '</b> .' . "\n\n");
define('EMAIL_TEXT', 'Your question has been successfully submitted at ' . STORE_NAME . '. It will be answered as soon as we receive it. You will receive an email about the status of your submittal. If you have not received it within the next 48 hours, please contact us before submitting your question again.' . "\n\n");
define('EMAIL_TEXT_APPROVED', 'Your question has been successfully submitted at ' . STORE_NAME . ' and will be answered as soon as we review it.' . "\n\n");
define('EMAIL_CONTACT', 'For help with your question, please email the store-owner: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Note:</b> This email address was given to us during a question submittal. If you have a problem, please send an email to ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");
define('EMAIL_OWNER_SUBJECT', 'Question submittal at ' . STORE_NAME);
define('SEND_EXTRA_SUBMIT_FAQ_TO_SUBJECT', 'Question Submission');
define('EMAIL_OWNER_TEXT', 'A new question was submitted at ' . STORE_NAME . '. It is not yet been answered or approved. Please answer the quesion and activate.' . "\n\n");
define('EMAIL_GV_CLOSURE','Sincerely,' . "\n\n" . STORE_OWNER . "\nStore Owner\n\n". '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'.HTTP_SERVER . DIR_WS_CATALOG ."</a>\n\n");
define('EMAIL_DISCLAIMER_NEW_CUSTOMER', 'This question was submitted to us by you or by one of our users. If you did not submit a question, or feel that you have received this email in error, please send an email to %s ');
define('TEXT_FAQS_HELP_LINK', '&nbsp;Help&nbsp;[?]');
define('HEADING_FAQS_HELP', 'Question Help');
define('TEXT_URL_HELP', '<b>Site Title:</b> A descriptive title for your URL.<br><br><b>URL:</b> The absolute web address of your URL, including the \'http://\'.<br><br><b>Category:</b> Most appropriate category under which your question falls.<br><br><b>Question Description:</b> A brief description of your question.<br><br><b>Image URL:</b> The absolute URL of the image you wish to submit, including the \'http://\'. This image will be displayed along with your question.<br>Eg: http://your-domain.com/path/to/your/image.gif <br><br>');
define('TEXT_CLOSE_WINDOW', '<u>Close Window</u> [x]');
define('CATEGORY_HEADING', 'Question Details');
define('ENTRY_FAQS_NAME', 'Question Title:');
define('ENTRY_FAQS_NAME_TEXT', '*');
define('ENTRY_FAQS_CATEGORY', 'Category:');
define('ENTRY_FAQS_CATEGORY_2', 'Category 2:');
define('ENTRY_FAQS_CATEGORY_TEXT', '*');
define('ENTRY_FAQS_CONTACT_NAME', 'Your Name:');
define('ENTRY_FAQS_CONTACT_MAIL', 'Email Address:');
define('ENTRY_FAQS_DESCRIPTION', 'Write a inquiry:');
define('ENTRY_FAQS_DESCRIPTION_ERROR', 'Description must contain a minimum of ' . ENTRY_FAQS_DESCRIPTION_MIN_LENGTH . ' characters.');
define('ENTRY_FAQS_DESCRIPTION_TEXT', '*');
define('ENTRY_FAQS_IMAGE', 'Image:');
define('ENTRY_FAQS_IMAGE_TEXT', '');
define('ENTRY_FAQS_URL', 'URL:');

define('TEXT_TOP', 'Please Choose');
define('FAQ_IMAGE', 'Image');
define('FAQ_IMAGE_NOTE', 'Images are currently displayed at ' . IMAGE_FAQ_ALL_LISTING_HEIGHT . ' x ' . IMAGE_FAQ_ALL_LISTING_WIDTH . 'pixels, for best results, please scale your image to these dimensions before uploading.');

?>