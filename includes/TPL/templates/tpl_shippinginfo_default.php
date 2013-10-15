<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_shippinginfo_default.php 3464 2006-04-19 00:07:26Z ajeh $
 */
?>
<div class="minframe fl">
<?php
 //require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/box_contact_us.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/ezpages.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/subscribe.php'));
?>
</div>
<div class="right_big_con margin_t" id="shippinginfo">
<h3 class="line_30px border_b"><?php echo HEADING_TITLE; ?></h3>
<?php echo TEXT_INFORMATION; ?>
<?php staticCategoriesList(DROPSHIP_CATEGORIES_LIST,'Dropship'); ?>
<br class="clear"/>
<?php if (DEFINE_SHIPPINGINFO_STATUS >= 1 and DEFINE_SHIPPINGINFO_STATUS <= 2) { ?>
<div id="shippingInfoMainContent" class="content">
<?php
/**
 * require the html_define for the shippinginfo page
 */
  require($define_page);
?>
</div>
<?php } ?>

</div>
