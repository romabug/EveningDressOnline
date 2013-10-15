<?php
  $display_num = 12;
  $subCategoriesArray = array();
	if(isset($_GET['products_id'])){
		$relatedCategoriesParentId = zen_get_products_category_id($_GET['products_id']);
    $relatedCategoriesId = zen_get_categories_parent_id($relatedCategoriesParentId);
    zen_get_subcategoriesarray(&$subCategoriesArray,$relatedCategoriesId);
	}else {
	  if(isset($current_category_id)){
	  	$parent_id = zen_get_categories_parent_id($current_category_id);
      zen_get_subcategoriesarray(&$subCategoriesArray,$relatedCategoriesId);
    }
	}
  $relatedCategoriesTotalNum = count($subCategoriesArray);
?>
<div class="fl allborder line_180" id="relate_cate">
	<h4 class="red line_30px in_1em">Related Categories</h4>
	<ul>
	<?php if ($relatedCategoriesTotalNum>0) {
			for($i = 0 ; $i < $display_num; $i++){
				echo '<li><a href="'.zen_href_link(FILENAME_DEFAULT,'cPath='.$subCategoriesArray[$i]['categories_id']).'" title="'.SEO_COMMON_KEYWORDS.$subCategoriesArray[$i]['categories_name'].'">'.zen_clipped_string($subCategoriesArray[$i]['categories_name']).'</a></li>';
			}
	}
	unset($row,$display,$subCategoriesArray,$related_categories_query);
	 ?>
	</ul>
</div>
