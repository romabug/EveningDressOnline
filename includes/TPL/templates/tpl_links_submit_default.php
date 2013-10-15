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
?>
<div class="minframe fl">
<?php
 //require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/box_contact_us.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/ezpages.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/subscribe.php'));
?>
</div>
<div class="right_big_con margin_t">
<?php
  echo '<h3 class="line_30px border_b">'.HEADING_TITLE.'</h3>';
  echo zen_draw_form('submit_link', zen_href_link(FILENAME_LINKS_SUBMIT, 'action=send', 'SSL'), 'post',  'enctype="multipart/form-data"');
  ?>
<?php
  if (isset($_GET['action']) && ($_GET['action'] == 'success')) {
  ?>
	<div class="mainContent success"><?php echo LINKS_SUCCESS; ?></div>
	<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) .'</a>'; ?></div>
  <?php
  } else {
?>
	<?php if (DEFINE_LINKS_STATUS >= '1' and DEFINE_LINKS_STATUS <= '2') { ?>
	<div id="pageThreeMainContent">
	<?php
	require($define_page);
	?>
	</div>
	<?php } ?>

<?php if ($messageStack->size('submit_link') > 0) echo $messageStack->output('submit_link'); ?>

<div class="pad_10px line_180">
<div class="hr_d clear g_t_c" style="width: 600px;"> </div>
<h4><?php echo NAVBAR_TITLE_2; ?></h4>
<table class="margin_t address_tb" width="600">
<tr>
<td align="right"><?php echo '<b>'.ENTRY_LINKS_CONTACT_NAME.'</b>&nbsp;<span class="red">' . ENTRY_LINKS_CONTACT_NAME_TEXT . '</span>'; ?></td>
<td><?php echo zen_draw_input_field('links_contact_name', $name, 'size="18" id="links_contact_name" class="l_input"'); ?></td>
</tr>
<tr>
<td align="right"><?php echo '<b>'.ENTRY_EMAIL_ADDRESS.'</b>&nbsp;<span class="red">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>'; ?></td>
<td><?php echo zen_draw_input_field('links_contact_email', $email, 'size="18" id="links_contact_email" class="l_input"'); ?></td>
</tr>
<tr>
<td align="right"><?php echo '<b>'.ENTRY_LINKS_TITLE.'</b>&nbsp;<span class="red">' . ENTRY_LINKS_URL_TEXT . '</span>'; ?></td>
<td><?php echo zen_draw_input_field('links_title', '', 'size="18" id="links_title" class="l_input"'); ?></td>
</tr>
<tr>
<td align="right"><?php echo '<b>'.ENTRY_LINKS_URL.'</b>&nbsp;<span class="red">' . ENTRY_LINKS_URL_TEXT . '</span>'; ?></td>
<td><?php echo zen_draw_input_field('links_url', 'http://', 'size="18" id="links_url" class="l_input"') ; ?></td>
</tr>
<?php
  //link category drop-down list
  $categories_array = array();
  $categories_values = $db->Execute("select lcd.link_categories_id, lcd.link_categories_name from " . TABLE_LINK_CATEGORIES_DESCRIPTION . " lcd where lcd.language_id = '" . (int)$_SESSION['languages_id'] . "' order by lcd.link_categories_name");
	while (!$categories_values->EOF) {
	 $categories_array[] = array('id' => $categories_values->fields['link_categories_name'], 'text' => $categories_values->fields['link_categories_name']);
	 $categories_values->MoveNext();
	 }
  if (isset($_GET['lPath'])) {
    $current_categories_id = $_GET['lPath'];
    $categories = $db->Execute("select link_categories_name from " . TABLE_LINK_CATEGORIES_DESCRIPTION . " where link_categories_id ='" . (int)$current_categories_id . "' and language_id ='" . (int)$_SESSION['languages_id'] . "'");
    $default_category = $categories->fields['link_categories_name'];
    } else {
      $default_category = '';
    }
?>
<tr>
<td align="right"><?php echo '<b>'.ENTRY_LINKS_CATEGORY.'</b>&nbsp;<span class="red">' . ENTRY_LINKS_CATEGORY_TEXT . '</span>'; ?></td>
<td><?php echo zen_draw_pull_down_menu('links_category', $categories_array, $default_category);?></td>
</tr>
<tr>
<td align="right"><?php echo '<b>'.ENTRY_LINKS_DESCRIPTION.'</b>&nbsp;<span class="red">' . ENTRY_LINKS_DESCRIPTION_TEXT . '</span>'; ?></td>
<td><?php echo zen_draw_textarea_field('links_description', '20', '5');?></td>
</tr>
<tr>
<td align="right"><?php echo '<b>'.ENTRY_LINKS_BANNER.'</b>&nbsp;<span class="red">' . ENTRY_LINKS_CATEGORY_TEXT . '</span>'; ?></td>
<td><?php echo zen_draw_file_field('links_image_url', '','size="18" class="l_input"'); ?></td>
</tr>
<?php
  if (SUBMIT_LINK_REQUIRE_RECIPROCAL == 'true') { ?>
	<tr>
	<td align="right"><?php echo ENTRY_LINKS_RECIPROCAL_URL.'<span class="red">' . ENTRY_LINKS_RECIPROCAL_URL_TEXT . '</span>'; ?></td>
	<td><?php echo zen_draw_input_field('links_reciprocal_url', 'http://', 'size="18" id="links_reciprocal_url" class="l_input"')?>
	</td>
	</tr>
<?php
  }
?>

<tr>
<td colspan="2" align="center"><?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT_LINK, BUTTON_SUBMIT_LINK_ALT); ?></td>
</tr>
</table>
</div>
<?php
  }
 echo '</form>';
?>
<div class="clear" />
</div>
