<?php
/**
 * Links Listing
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_links_listing.php 3.4.0 3/27/2008 Clyde Jones $
 */
  class linkListingBox extends tableBox {
    function linkListingBox($contents) {
      $this->table_parameters = 'class="linkListing"';
      $this->table_cellspacing = '5';
      $this->table_cellpadding = '0';
      $this->tableBox($contents, true);
    }
  }

  $listing_split = new splitPageResults($listing_sql, MAX_DISPLAY_SEARCH_RESULTS, 'l.links_id');

  if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {
?>
<div class="pad_5 border_b gray_bg ">
  <div class="fr"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></div>
  <div class="fl"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_LINKS); ?></div>
  <div class="clear"></div>
</div>
<?php
  }

  $list_box_contents = array();

/*  for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
    switch ($column_list[$col]) {
      case 'LINK_LIST_IMAGE':
        $lc_text = TABLE_HEADING_LINKS_TITLE;
        $lc_align = 'center';
        break;
      case 'LINK_LIST_DESCRIPTION':
        $lc_text = TABLE_HEADING_LINKS_DESCRIPTION;
        $lc_align = 'left';
        break;
      case 'LINK_LIST_COUNT':
        $lc_text = TABLE_HEADING_LINKS_COUNT;
        $lc_align = 'right';
        break;
    }
    if ($column_list[$col] != 'LINK_LIST_IMAGE') {
      $lc_text = zen_create_sort_heading($HTTP_GET_VARS['sort'], $col+1, $lc_text);
    }
    $list_box_contents[0][] = array('align' => $lc_align,
                                    'params' => 'class="productListing-heading"',
                                    'text' => '&nbsp;' . $lc_text . '&nbsp;');
  }*/

  if ($listing_split->number_of_rows > 0) {
    $rows = 0;
    $listing_query = $db->Execute($listing_split->sql_query);
	 while (!$listing_query->EOF) {
      $rows++;
      if (($rows/2) == floor($rows/2)) {
        $list_box_contents[] = array('params' => 'class="productListing-even"');
      } else {
        $list_box_contents[] = array('params' => 'class="productListing-odd"');
      }
      $cur_row = sizeof($list_box_contents) - 1;
      for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
        $lc_align = '';
        switch ($column_list[$col]) {
          case 'LINK_LIST_DESCRIPTION':
            $lc_align = 'left';

           if (DISPLAY_LINK_DESCRIPTION_AS_LINK == 'true') {
            $lc_text = '<a href="' . zen_get_links_url($listing_query->fields['links_id']) . '" target="_blank">' . $listing_query->fields['links_title'] . '</a><br /><a href="' . zen_get_links_url($listing_query->fields['links_id']) . '" target="_blank">' . $listing_query->fields['links_description'] . '</a>';
             } else {
           $lc_text = '<a href="' . zen_get_links_url($listing_query->fields['links_id']) . '" target="_blank">' . $listing_query->fields['links_title'] . '</a><br />' . $listing_query->fields['links_description']; }
            break;
          case 'LINK_LIST_IMAGE':
            $lc_align = 'center';
            if (zen_not_null($listing_query->fields['links_image_url'])) {
              $lc_text = '<a href="' . zen_get_links_url($listing_query->fields['links_id']) . '" target="_blank">' . zen_links_image(DIR_WS_IMAGES . $listing_query->fields['links_image_url'], $listing_query->fields['links_title'], LINK_IMAGE_WIDTH, LINK_IMAGE_HEIGHT) . '</a>';
            } else {
              $lc_text = TABLE_HEADING_LINKS_IMAGE;
            }
            break;
          case 'LINK_LIST_COUNT':
            $lc_align = 'right';
            $lc_text = $listing_query->fields['links_clicked'];
            break;
        }

        $list_box_contents[$cur_row][] = array('align' => $lc_align,
                                               'params' => 'class="linkListing-data col' . ($col+1) . '"',
                                               'text'  => $lc_text);
      }
       	 $listing_query->MoveNext();
    }

    new linkListingBox($list_box_contents);
  } else {
    $list_box_contents = array();

    $list_box_contents[0] = array('params' => 'class="linkListing-odd col' . ($col+1) . '"');
    $list_box_contents[0][] = array('params' => 'class="linkListing-data col' . ($col+1) . '"',
                                   'text' => TEXT_NO_LINKS);

    new linkListingBox($list_box_contents);
  }

  if ( ($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>
<div class="pad_5 border_t gray_bg ">
    <div class="fr"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></div>
    <div class="fl"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_LINKS); ?></div>
    <div class="clear"></div>
</div>
<?php
  }
?>
