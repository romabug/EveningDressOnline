<?php
/**
 * jscript_addr_pulldowns
 *
 * handles pulldown menu dependencies for state/country selection
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: jscript_addr_pulldowns.php 4830 2006-10-24 21:58:27Z drbyte $
 */
?>
<script language="javascript" type="text/javascript">
<!--
function update_zone(theForm) {
  // set initial values
  var SelectedCountry = theForm.zone_country_id.options[theForm.zone_country_id.selectedIndex].value;
  var SelectedZone = theForm.elements["state"].value;
 
  var NumState = theForm.zone_id.options.length;
  while(NumState > 0) {
    NumState = NumState - 1;
    theForm.zone_id.options[NumState] = null;
  }
  <?php echo zen_js_zone_list('SelectedCountry', 'theForm', 'zone_id'); ?>
  // add build dynamic list of countries/zones for pulldown

  // if we had a value before reset, set it again
  if (SelectedZone != "") theForm.elements["zone_id"].value = SelectedZone;
}

  
function update_billing_zone(theForm) {
    // set initial values
    var SelectedCountry = theForm.b_zone_country_id.options[theForm.b_zone_country_id.selectedIndex].value;
    if(SelectedCountry=='30'){//Brazil
      show("b_tax_code_block");
    }else{
      hide("b_tax_code_block");
      theForm.b_tax_code.value="";
    }
    var SelectedZone = theForm.elements["b_zone_id"].value;
    // reset the array of pulldown options so it can be repopulated
    var NumState = theForm.b_zone_id.options.length;
    while(NumState > 0) {
      NumState = NumState - 1;
      theForm.b_zone_id.options[NumState] = null;
    }
    // build dynamic list of countries/zones for pulldown
    <?php echo zen_js_zone_list('SelectedCountry', 'theForm', 'zone_id'); ?>
    
    // if we had a value before reset, set it again
    if (SelectedZone != "") theForm.elements["b_zone_id"].value = SelectedZone;
  }
//--></script>