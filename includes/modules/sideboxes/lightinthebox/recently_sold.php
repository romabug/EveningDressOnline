<!-- BOF Recently Sold items-->
<?php
 $recently_sold_query = "SELECT distinct o.`products_id`, o.`products_name` ,p.`products_image`
                         FROM orders_products o, orders o1, products p
                         WHERE o1.orders_id=o.orders_id 
                         AND p.products_id=o.products_id 
                         AND p.`products_status`=1 
                         ORDER BY o1.`date_purchased` DESC LIMIT 30";
 $recently_sold = $db->Execute($recently_sold_query);
 if ($recently_sold->RecordCount()>0){
 	  echo '<div class="allborder"><h3 class="pad_10px">Recently Sold Dresses</h3>';
 	  echo zen_image($template->get_template_dir('go_up.gif', DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . 'go_up.gif','','','',' id="goup" class="hand"');
 	  echo '<div id="recently_sold_items" style="overflow: hidden; height: 500px;">';
 	  echo '<ul id="recently_sold_items_a" class="top_selling pad_10px pad_t" >';
 	  while (!$recently_sold->EOF){
      echo '<li class="clear"><a href="'.zen_href_link(zen_get_info_page($recently_sold->fields['products_id']),'products_id='.$recently_sold->fields['products_id']).'">'.zen_image_OLD(DIR_WS_IMAGES . $recently_sold->fields['products_image'],$recently_sold->fields['products_name'],42,42,' class="fl"').'</a>';
      echo '<span><a href="'.zen_href_link(zen_get_info_page($recently_sold->fields['products_id']),'products_id='.$recently_sold->fields['products_id']).'">'.substr($recently_sold->fields['products_name'],0,20).'...'.'</a><br/><strong class="red">'.$currencies->display_price(zen_get_products_base_price($recently_sold->fields['products_id']),zen_get_tax_rate($products_tax_class_id)).'</strong></span></li>';
 	  	$recently_sold->MoveNext();
 	  }
 	  echo '</ul>';
 	  echo '<ul id="recently_sold_items_b" class="top_selling pad_10px pad_t" ></ul></div>';
 	  echo zen_image($template->get_template_dir('go_down.gif', DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . 'go_down.gif','','','',' id="godown" class="hand"');
    echo '</div>';?>
    <script type="text/javascript">
<!--
      var layerHeight = 500;
      var iFrame = 1;
      var iFrequency = 50;
      var speed = 10;
      var timer;
      var n1 = $("recently_sold_items");
      var n2 = $("recently_sold_items_a");
      var n3 = $("recently_sold_items_b");
      var goup = $("goup");
      var godown = $("godown")
      var h1 = n2.offsetHeight-layerHeight; 
        if(n2.offsetHeight >= layerHeight)
          n1.style.height = layerHeight+'px';
        else
          n1.style.height = n2.offsetHeight+'px';
          n3.innerHTML = n2.innerHTML;
        function move(){
            if(n1.scrollTop >= n2.offsetHeight)
              n1.scrollTop -= (n2.offsetHeight - iFrame);
            else        
              n1.scrollTop += iFrame;
              if(n1.scrollTop<=0) n1.scrollTop=h1-n1.scrollTop;
          
        }   
        goup.onmousedown = function (){iFrame = +speed;return false;};
        goup.onmouseup = function(){iFrame=1};
        godown.onmousedown = function (){iFrame = -speed;return false;};
        godown.onmouseup = function(){iFrame=1};
    
        timer = setInterval("move()",iFrequency);
        n1.onmouseover=function() {clearInterval(timer);}
        n1.onmouseout=function() {timer=setInterval("move()",iFrequency);iFrame=1;}
//-->
</script>
<?php
 }
?>
<!-- EOF Recently Sold items-->