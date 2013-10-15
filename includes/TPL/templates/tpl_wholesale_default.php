<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=wholesale.<br />
 * Displays conditions page.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_about_us_default.php  v1.3 $
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
<div id="wholesaleMainContent" class="content">
<h3 class="line_30px border_b"><?php echo HEADING_TITLE; ?></h3>
<?php echo TEXT_INFORMATION; ?>
<?php staticCategoriesList(WHOLESALE_CATEGORIES_LIST,'Wholesale'); ?>
<br class="clear"/>
<?php
/**
 * require the html_define for the wholesale page
 */
  require($define_page);
?>
</div>
</div>
