<?php
/**
 * site_map.php
 *
 * @package general
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: site_map.php 3041 2006-02-15 21:56:45Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
/**
 * site_map.php
 *
 * @package general
 */
 class zen_SiteMapTree {
   var $root_category_id = 0,
       $max_level = 2,
       $data = array(),
       $root_start_string = '',
       $root_end_string = '',
       $parent_start_string = '',
       $parent_end_string = '',
       $parent_group_start_string = "\n<ul class='border_r'>",
       $parent_group_end_string = "</ul>\n",
       $child_start_string = '',
       $child_end_string = "\n",
			 $totalNum = '',
			 $colNum = 4,
			 $rowNum = 1,
			 $rowPerNum = '',
			 $perNum = 1,
//       $child_start_string = '<li>',
//       $child_end_string = "</li>\n",
       $spacer_string = '',
       $spacer_multiplier = 1;

   function zen_SiteMapTree($load_from_database = true) {
     global $languages_id, $db;
  $this->data = array();
 $categories_query = "select c.categories_id, cd.categories_name, c.parent_id
                      from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
                      where c.categories_id = cd.categories_id
                      and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                      and c.categories_status != '0' and (c.parent_id = 0 or (select parent_id from categories where categories_id = (select nc.parent_id from categories nc where nc.categories_id = c.categories_id)) = 0)
                      order by c.sort_order, cd.categories_name";
     		 $categories = $db->Execute($categories_query);
         while (!$categories->EOF) {
           $this->data[$categories->fields['parent_id']][$categories->fields['categories_id']] = array('name' => $categories->fields['categories_name'], 'count' => 0);
           $categories->MoveNext();
         }
			$this->totalNum = $categories->RecordCount();
			$this->rowPerNum = ($this->totalNum + ($this->colNum - $this->totalNum %$this->colNum)) / $this->colNum;
   }
	 
   function buildBranch($parent_id, $level = 0, $parent_link = '') {
     // added global $db for inclusion of product level and metatag titles for links
     global $db;
		if($parent_id == 0){
			$result = $this->parent_group_start_string;
    }
    if (isset($this->data[$parent_id])) {
      foreach ($this->data[$parent_id] as $category_id => $category) {
        $category_link = $category_id;
        $result .= $this->child_start_string;
        if (isset($this->data[$category_id])) {
          $result .= $this->parent_start_string;
        }

        if ($level == 0) {
          $result .= $this->root_start_string;
        }

        // modified to include title attribute in link
        // get category title metatag and use it in link if it exists, else use category name
        $category_title_sql = "select metatags_title from " . TABLE_METATAGS_CATEGORIES_DESCRIPTION . " where categories_id = '" . $category_id . "'";
        $category_title_query = $db->Execute($category_title_sql);
        $category_link_title = ($category_title_query->RecordCount() > 0 ? $category_title_query->fields['metatags_title'] : $category['name']);
				if($parent_id == 0){
				$result .= '<h4 class="in_1em">';
        $result .= str_repeat($this->spacer_string, $this->spacer_multiplier * $level) . '<a href="' .zen_href_link(FILENAME_DEFAULT, 'cPath=' . $category_link) . '" title="' . $category_link_title . '"  class="red">';
        // end modification
        $result .= $category['name'];
        $result .= '</a>';
				$result .= '</h4>';
				}else{
        $result .= str_repeat($this->spacer_string, $this->spacer_multiplier * $level) . '<a href="' . zen_href_link(FILENAME_DEFAULT, 'cPath=' . $category_link) . '" title="' . $category_link_title . '" class="pad_l_28px block">';
        // end modification
        $result .= $category['name'];
        $result .= '</a>';
				}
        if ($level == 0) {
          $result .= $this->root_end_string;
        }

        if (isset($this->data[$category_id])) {
          $result .= $this->parent_end_string;
        }

//        $result .= $this->child_end_string;
			if($this->rowPerNum * $this->rowNum == $this->perNum  ){
				$result .='</ul>';
				if($this->rowPerNum * ($this->rowNum+1) < $this->totalNum){
					$result .= '<ul class="border_r">';
				}else{
					$result .= '<ul>';
				}
				$this->rowNum ++ ;
			}
				$this->perNum++;
				
      if (isset($this->data[$category_id]) && (($this->max_level == '0') || ($this->max_level > $level+1))) {
        $result .= $this->buildBranch($category_id, $level+1, $category_link . '_');
      }
			 
       // add product links
       if (SHOW_PRODUCT_LINKS_ON_SITE_MAP == 'Yes') {
         $product_sql = "select p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " .
                       TABLE_PRODUCTS_TO_CATEGORIES . " p2c 
                       where p.products_id = pd.products_id 
                       and p.products_id = p2c.products_id 
                       and p2c.categories_id = '" . $category_id . "' 
                       order by p.products_sort_order, pd.products_name";
       
         $product_query = $db->Execute($product_sql);
       
         if ($product_query->RecordCount() > 0) {
       
           $result .= $this->parent_group_start_string;
         
           while(!$product_query->EOF) {
           
             // get product title metatag and use it in link if it exists, else use product name
             $product_title_sql = "select metatags_title from " . TABLE_META_TAGS_PRODUCTS_DESCRIPTION . " where products_id = '" . $product_query->fields['products_id'] . "'";
             $product_title_query = $db->Execute($product_title_sql);
             $product_link_title = ($product_title_query->RecordCount() > 0 ? $product_title_query->fields['metatags_title'] : $product_query->fields['products_name']);
             
             $result .= $this->child_start_string;
             $result .= '<a href="' . zen_href_link(zen_get_info_page($product_query->fields['products_id']), 'cPath=' . $category_link . '&products_id=' . $product_query->fields['products_id']) . '" title="' . $product_link_title . '">' . $product_query->fields['products_name'] . '</a>';
             $result .= $this->child_end_string;
           
             $product_query->MoveNext();
           } // end while(!$product_query->EOF)
         
           $result .= $this->parent_group_end_string;
         } // end if ($product_query->RecordCount() > 0)
       
       } // end if(SHOW_PRODUCT_LINKS_ON_SITE_MAP == 'Yes')
       
       // end add product links

       
       $result .= $this->child_end_string;

     }
   }
		if($parent_id == 0){
    	$result .= $this->parent_group_end_string;
		}
    return $result;
  }
   function buildTree() {
     return $this->buildBranch($this->root_category_id);
   }
 }
?>