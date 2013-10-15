<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_privacy_default.php 3464 2006-04-19 00:07:26Z ajeh $
 */
?>
<div class="minframe fl">
<?php
 //require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/box_contact_us.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/ezpages.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/subscribe.php'));
?>
</div>
<div class="right_big_con margin_t" >
<h2 class="border_b line_30px pad_l_10px"><?php echo HEADING_TITLE; ?></h2>

<?php if (DEFINE_PRIVACY_STATUS >= 1 and DEFINE_PRIVACY_STATUS <= 2) { ?>
<div class="clear">
<?php
/**
 * require the html_define for the privacy page
 */
  require($define_page);
?>
</div>
<?php } ?>
</div>