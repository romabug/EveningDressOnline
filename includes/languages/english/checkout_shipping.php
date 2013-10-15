<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: checkout_shipping.php 4042 2006-07-30 23:05:39Z drbyte $
 */

define('NAVBAR_TITLE_1', 'Checkout');
define('NAVBAR_TITLE_2', 'Shipping Method');

define('HEADING_TITLE', 'Billing, Shipping & Review');

define('TABLE_HEADING_SHIPPING_ADDRESS', 'Shipping Address');
define('TABLE_HEADING_BILLING_ADDRESS', 'Billing Address');
define('TEXT_CHOOSE_SHIPPING_DESTINATION', '<span class="red">Please double check the address</span> ');
//define('TEXT_SELECTED_BILLING_DESTINATION', 'Your billing address is shown to the left. The billing address should match the address on your credit card statement. You can change the billing address by clicking the <em>Change Address</em> button.');
define('TITLE_SHIPPING_ADDRESS', 'Shipping Information:');

define('TABLE_HEADING_SHIPPING_METHOD', 'Shipping Method:');
define('TABLE_HEADING_PAYMENT_METHOD', 'Payment Method');
define('TEXT_CHOOSE_SHIPPING_METHOD', 'Please select the preferred shipping method to use on this order.');
define('TEXT_SELECT_PAYMENT_METHOD', 'Please select a payment method for this order.');
define('TITLE_PLEASE_SELECT', 'Please Select');
define('TEXT_ENTER_SHIPPING_INFORMATION', 'By Express of TNT / EMS, currently the only shipping method available to use on this order.');
define('TITLE_NO_SHIPPING_AVAILABLE', 'Not Available At This Time');
define('TEXT_NO_SHIPPING_AVAILABLE','<span class="alert">Sorry, we are not shipping to your region at this time.</span><br />Please contact us for alternate arrangements.');

define('TABLE_HEADING_COMMENTS', 'Instructions or Comments ( Important !! ) ');

define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', 'Continue to Step 2');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', '- choose your payment method.');


define('TEXT_YOUR_TOTAL','Your Total');

// when free shipping   for orders over $XX.00 is active
  define('FREE_SHIPPING_TITLE', 'Free Shipping');
  define('FREE_SHIPPING_DESCRIPTION', 'Free shipping for orders over %s');
?>
