<div id="popular_searches" class="blue_con margin_t line_180">

  <h3 class="g_t_c"><?php echo TEXT_BOX_POPULAR_SEARCHES;?></h3>

  <p class="g_t_c"><a href="http://wedding-dresses-sydney.com.au/unusual-wedding-dresses_p615.html"> </a><a href="http://wedding-dresses-sydney.com.au/wedding-dresses-sydney_p369.html"></a> </p>

  <p style="word-break:break-all;font-size-adjust:none;">

  

  

  

  

  

  

<?php /*

	$popularSearches = $db->Execute('select search,freq from customers_searches limit 12');

	$popularContent_i = 0;

	while(!$popularSearches->EOF){

		 $popularContent ='';

     $popularContent .= '<a href="'.zen_href_link(FILENAME_ADVANCED_SEARCH_RESULT,'keyword='.$popularSearches->fields['search'], 'NONSSL').'">';

		 if($popularSearches->fields['freq'] >10){

		 		$popularContent .= '<strong>';

		 }

		 $popularContent .= $popularSearches->fields['search'];

		 if($popularSearches->fields['freq']>10){

		 		$popularContent .= '</strong>';

		 }

		 $popularContent .= '</a>';

		 if($popularContent_i < $popularSearches->RecordCount()){

			 $popularContent .= ', ';

		   $popularContent_i++;		

			  }



		 echo $popularContent;

		 $popularSearches->MoveNext();

	} */

?>

</p>

</div>