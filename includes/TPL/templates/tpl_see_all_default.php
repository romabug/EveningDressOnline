<?php
/**
 * Page Template
 *
 * Loaded by index.php?main_page=site_map <br />
 * Displays site-map and some hard-coded navigation components
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_site_map_default.php 3259 2006-03-25 22:07:54Z ajeh $
 */
?>
<div class="minframe fl">
<?php
 //require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/box_contact_us.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/ezpages.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/subscribe.php'));
?>
</div>
<div class="right_big_con">
<h2 class="border_b line_30px pad_l_10px"><?php echo HEADING_TITLE; ?></h2>
<div class="margin_t site_map line_120"><?php echo $zen_SiteMapTree->buildTree(); ?>
<?php if (SHOW_ACCOUNT_LINKS_ON_SITE_MAP=='Yes') { ?>
	  <ul>
        <li><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . PAGE_ACCOUNT . '</a>'; ?>
        <ul>
          <li><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL') . '">' . PAGE_ACCOUNT_EDIT . '</a>'; ?></li>
          <li><?php echo '<a href="' . zen_href_link(FILENAME_MANAGER_ADDRESS, '', 'SSL') . '">' . PAGE_ADDRESS_BOOK . '</a>'; ?></li>
          <li><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">' . PAGE_ACCOUNT_HISTORY . '</a>'; ?></li>
          <li><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL') . '">' . PAGE_ACCOUNT_NOTIFICATIONS . '</a>'; ?></li>
        </ul></li>
          <li><?php echo '<a href="' . zen_href_link(FILENAME_SHOPPING_CART) . '">' . PAGE_SHOPPING_CART . '</a>'; ?></li>
          <li><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . PAGE_CHECKOUT_SHIPPING . '</a>'; ?></li>
<?php } //endif ?>
<!--<ul>
-->         <li><?php //echo '<a href="' . zen_href_link(FILENAME_ADVANCED_SEARCH) . '">' . PAGE_ADVANCED_SEARCH . '</a>'; ?></li>
         <li><?php //echo '<a href="' . zen_href_link(FILENAME_PRODUCTS_NEW) . '">' . PAGE_PRODUCTS_NEW . '</a>'; ?></li>
         <li><?php //echo '<a href="' . zen_href_link(FILENAME_SPECIALS) . '">' . PAGE_SPECIALS . '</a>'; ?></li>
         <li><?php //echo '<a href="' . zen_href_link(FILENAME_REVIEWS) . '">' . PAGE_REVIEWS . '</a>'; ?></li>
<!--</ul>
-->
<!-- BOF: EZ-PAGES to Sitemap -->
<?php
/*$boxes = array('ezpages.php');
$column_box_default='tpl_box_default_sitemap.php';
for($ib=0,$nb=sizeof($boxes);$ib<$nb;$ib++){
$require_file = "";
if ( file_exists(DIR_WS_MODULES . 'sideboxes/' . $template_dir . '/' . $boxes[$ib]) ) {
$require_file = DIR_WS_MODULES . 'sideboxes/' . $template_dir . '/' . $boxes[$ib];
} elseif ( file_exists(DIR_WS_MODULES . 'sideboxes/' . $boxes[$ib]) ) {
$require_file = DIR_WS_MODULES . 'sideboxes/' . $boxes[$ib];
}
if ($require_file != "") {
$box_id = zen_get_box_id($boxes[$ib]);
require($require_file);
}
}
*/?>
<!-- EOF: EZ-PAGES to Sitemap -->
<!--</ul>
--></div>

<br class="clear" />
<?php if($define_page){ ?>
<div id="siteMapMainContent">
<?php
/**
 * require the html_define for the site_map page
 */
  require($define_page);
?>
</div>
<?php } ?>

<?php //echo '<div class="pad_10px fl">'.zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a></div>'; ?>
<br class="clear" />

</div>
<?php require(DIR_WS_MODULES.zen_get_module_directory('sideboxes/recommendations.php')); ?>

