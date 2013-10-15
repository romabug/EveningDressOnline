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
  class linkListingBox extends tableBox {
    function linkListingBox($contents) {
      $this->table_parameters = 'class="linkListing"';
      $this->tableBox($contents, true);
    }
  }

  $listing_split = new splitPageResults($listing_sql, MAX_DISPLAY_SEARCH_RESULTS, 'l.links_id');

  if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td class="smallText"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_LINKS); ?></td>
    <td class="smallText" align="right"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
  </tr>
</table>
<?php
  }

  $list_box_contents = array();

  for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
    switch ($column_list[$col]) {
      case 'LINK_LIST_IMAGE':
        $lc_text = TABLE_HEADING_LINKS_IMAGE;
        $lc_align = 'center';
        break;
      case 'LINK_LIST_DESCRIPTION':
        $lc_text = TABLE_HEADING_LINKS_DESCRIPTION;
        $lc_align = 'center';
        break;
      case 'LINK_LIST_COUNT':
        $lc_text = TABLE_HEADING_LINKS_COUNT;
        $lc_align = '';
        break;
      case 'LINK_LIST_EDIT':
        $lc_text = '';
        $lc_align = '';
        break;
		    }

    if ($column_list[$col] != 'LINK_LIST_IMAGE') {
      $lc_text = zen_create_sort_heading($HTTP_GET_VARS['sort'], $col+1, $lc_text);
    }

    $list_box_contents[0][] = array('align' => $lc_align,
                                    'params' => 'class="productListing-heading"',
                                    'text' => '&nbsp;' . $lc_text . '&nbsp;');
  }

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
            $lc_align = 'center';

           if (DISPLAY_LINK_DESCRIPTION_AS_LINK == 'true') {
            $lc_text = '<a href="' . zen_get_links_url($listing_query->fields['links_id']) . '" target="_blank">' . $listing_query->fields['links_description'] . '</a>';
             } else {
           $lc_text = $listing_query->fields['links_description']; }
            break;
          case 'LINK_LIST_IMAGE':
            $lc_align = 'center';
            if (zen_not_null($listing_query->fields['links_image_url'])) {
              $lc_text = '<a href="' . zen_get_links_url($listing_query->fields['links_id']) . '" target="_blank">' . zen_links_image($listing_query->fields['links_image_url'], $listing_query->fields['links_title'], LINKS_IMAGE_WIDTH, LINKS_IMAGE_HEIGHT) . '</a><br><a href="' . zen_get_links_url($listing_query->fields['links_id']) . '" target="_blank"></a>';
            } else {
              $lc_text = '<a href="' . zen_get_links_url($listing_query->fields['links_id']) . '" target="_blank">' . $listing_query->fields['links_title'] . '</a>';
            }
            break;
          case 'LINK_LIST_COUNT':
            $lc_align = 'right';
            $lc_text = $listing_query->fields['links_clicked'];
            break;
           case 'LINK_LIST_EDIT':
            $lc_align = 'right';
        if ($_SESSION['customer_id'] == $listing_query->fields['links_owner']) {
            $lc_text = '<a href="' . zen_href_link(FILENAME_LINKS_EDIT, 'links_id=' . $listing_query->fields['links_id']) . '">' . EDIT_LINK . '</a>';
                                                   
         } else { $lc_text = ''; }
            break;
        }


        $list_box_contents[$cur_row][] = array('align' => $lc_align,
                                               'params' => 'class="linkListing-data"',
                                               'text'  => $lc_text);
      }
       	 $listing_query->MoveNext();
    }

    new linkListingBox($list_box_contents);
  } else {
    $list_box_contents = array();

    $list_box_contents[0] = array('params' => 'class="linkListing-odd"');
    $list_box_contents[0][] = array('params' => 'class="linkListing-data"',
                                   'text' => TEXT_NO_LINKS);

    new linkListingBox($list_box_contents);
  }

  if ( ($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td class="smallText"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_LINKS); ?></td>
    <td class="smallText" align="right"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
  </tr>
</table>
<?php
  }
?>
