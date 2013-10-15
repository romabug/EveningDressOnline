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
    if (SelectedCountry == "13") {
    theForm.b_zone_id.options[0] = new Option("Please select ...", "-1");
    theForm.b_zone_id.options[1] = new Option("Australian Capital Territory", "182");
    theForm.b_zone_id.options[2] = new Option("New South Wales", "183");
    theForm.b_zone_id.options[3] = new Option("Northern Territory", "184");
    theForm.b_zone_id.options[4] = new Option("Queensland", "185");
    theForm.b_zone_id.options[5] = new Option("South Australia", "186");
    theForm.b_zone_id.options[6] = new Option("Tasmania", "187");
    theForm.b_zone_id.options[7] = new Option("Victoria", "188");
    theForm.b_zone_id.options[8] = new Option("Western Australia", "189");
;
show("b_zone_id_tr");hide("b_zone_id_tr1");theForm.b_state.value="";} else if (SelectedCountry == "14") {
    theForm.b_zone_id.options[0] = new Option("Please select ...", "-1");
    theForm.b_zone_id.options[1] = new Option("Burgenland", "102");
    theForm.b_zone_id.options[2] = new Option("Kärtnen", "99");
    theForm.b_zone_id.options[3] = new Option("Niedersterreich", "96");
    theForm.b_zone_id.options[4] = new Option("Obersterreich", "97");
    theForm.b_zone_id.options[5] = new Option("Salzburg", "98");
    theForm.b_zone_id.options[6] = new Option("Steiermark", "100");
    theForm.b_zone_id.options[7] = new Option("Tirol", "101");
    theForm.b_zone_id.options[8] = new Option("Voralberg", "103");
    theForm.b_zone_id.options[9] = new Option("Wien", "95");
;
show("b_zone_id_tr");hide("b_zone_id_tr1");theForm.b_state.value="";} else if (SelectedCountry == "38") {
    theForm.b_zone_id.options[0] = new Option("Please select ...", "-1");
    theForm.b_zone_id.options[1] = new Option("Alberta", "66");
    theForm.b_zone_id.options[2] = new Option("British Columbia", "67");
    theForm.b_zone_id.options[3] = new Option("Manitoba", "68");
    theForm.b_zone_id.options[4] = new Option("New Brunswick", "70");
    theForm.b_zone_id.options[5] = new Option("Newfoundland", "69");
    theForm.b_zone_id.options[6] = new Option("Northwest Territories", "72");
    theForm.b_zone_id.options[7] = new Option("Nova Scotia", "71");
    theForm.b_zone_id.options[8] = new Option("Nunavut", "73");
    theForm.b_zone_id.options[9] = new Option("Ontario", "74");
    theForm.b_zone_id.options[10] = new Option("Prince Edward Island", "75");
    theForm.b_zone_id.options[11] = new Option("Quebec", "76");
    theForm.b_zone_id.options[12] = new Option("Saskatchewan", "77");
    theForm.b_zone_id.options[13] = new Option("Yukon Territory", "78");
;
show("b_zone_id_tr");hide("b_zone_id_tr1");theForm.b_state.value="";} else if (SelectedCountry == "81") {
    theForm.b_zone_id.options[0] = new Option("Please select ...", "-1");
    theForm.b_zone_id.options[1] = new Option("Baden-Wrttemberg", "80");
    theForm.b_zone_id.options[2] = new Option("Bayern", "81");
    theForm.b_zone_id.options[3] = new Option("Berlin", "82");
    theForm.b_zone_id.options[4] = new Option("Brandenburg", "83");
    theForm.b_zone_id.options[5] = new Option("Bremen", "84");
    theForm.b_zone_id.options[6] = new Option("Hamburg", "85");
    theForm.b_zone_id.options[7] = new Option("Hessen", "86");
    theForm.b_zone_id.options[8] = new Option("Mecklenburg-Vorpommern", "87");
    theForm.b_zone_id.options[9] = new Option("Niedersachsen", "79");
    theForm.b_zone_id.options[10] = new Option("Nordrhein-Westfalen", "88");
    theForm.b_zone_id.options[11] = new Option("Rheinland-Pfalz", "89");
    theForm.b_zone_id.options[12] = new Option("Saarland", "90");
    theForm.b_zone_id.options[13] = new Option("Sachsen", "91");
    theForm.b_zone_id.options[14] = new Option("Sachsen-Anhalt", "92");
    theForm.b_zone_id.options[15] = new Option("Schleswig-Holstein", "93");
    theForm.b_zone_id.options[16] = new Option("Thringen", "94");
;
show("b_zone_id_tr");hide("b_zone_id_tr1");theForm.b_state.value="";} else if (SelectedCountry == "163") {
    theForm.b_zone_id.options[0] = new Option("Please select ...", "-1");
    theForm.b_zone_id.options[1] = new Option("Palau", "50");
;
show("b_zone_id_tr");hide("b_zone_id_tr1");theForm.b_state.value="";} else if (SelectedCountry == "195") {
    theForm.b_zone_id.options[0] = new Option("Please select ...", "-1");
    theForm.b_zone_id.options[1] = new Option("A Corua", "130");
    theForm.b_zone_id.options[2] = new Option("Alava", "131");
    theForm.b_zone_id.options[3] = new Option("Albacete", "132");
    theForm.b_zone_id.options[4] = new Option("Alicante", "133");
    theForm.b_zone_id.options[5] = new Option("Almeria", "134");
    theForm.b_zone_id.options[6] = new Option("Asturias", "135");
    theForm.b_zone_id.options[7] = new Option("Avila", "136");
    theForm.b_zone_id.options[8] = new Option("Badajoz", "137");
    theForm.b_zone_id.options[9] = new Option("Baleares", "138");
    theForm.b_zone_id.options[10] = new Option("Barcelona", "139");
    theForm.b_zone_id.options[11] = new Option("Burgos", "140");
    theForm.b_zone_id.options[12] = new Option("Caceres", "141");
    theForm.b_zone_id.options[13] = new Option("Cadiz", "142");
    theForm.b_zone_id.options[14] = new Option("Cantabria", "143");
    theForm.b_zone_id.options[15] = new Option("Castellon", "144");
    theForm.b_zone_id.options[16] = new Option("Ceuta", "145");
    theForm.b_zone_id.options[17] = new Option("Ciudad Real", "146");
    theForm.b_zone_id.options[18] = new Option("Cordoba", "147");
    theForm.b_zone_id.options[19] = new Option("Cuenca", "148");
    theForm.b_zone_id.options[20] = new Option("Girona", "149");
    theForm.b_zone_id.options[21] = new Option("Granada", "150");
    theForm.b_zone_id.options[22] = new Option("Guadalajara", "151");
    theForm.b_zone_id.options[23] = new Option("Guipuzcoa", "152");
    theForm.b_zone_id.options[24] = new Option("Huelva", "153");
    theForm.b_zone_id.options[25] = new Option("Huesca", "154");
    theForm.b_zone_id.options[26] = new Option("Jaen", "155");
    theForm.b_zone_id.options[27] = new Option("La Rioja", "156");
    theForm.b_zone_id.options[28] = new Option("Las Palmas", "157");
    theForm.b_zone_id.options[29] = new Option("Leon", "158");
    theForm.b_zone_id.options[30] = new Option("Lleida", "159");
    theForm.b_zone_id.options[31] = new Option("Lugo", "160");
    theForm.b_zone_id.options[32] = new Option("Madrid", "161");
    theForm.b_zone_id.options[33] = new Option("Malaga", "162");
    theForm.b_zone_id.options[34] = new Option("Melilla", "163");
    theForm.b_zone_id.options[35] = new Option("Murcia", "164");
    theForm.b_zone_id.options[36] = new Option("Navarra", "165");
    theForm.b_zone_id.options[37] = new Option("Ourense", "166");
    theForm.b_zone_id.options[38] = new Option("Palencia", "167");
    theForm.b_zone_id.options[39] = new Option("Pontevedra", "168");
    theForm.b_zone_id.options[40] = new Option("Salamanca", "169");
    theForm.b_zone_id.options[41] = new Option("Santa Cruz de Tenerife", "170");
    theForm.b_zone_id.options[42] = new Option("Segovia", "171");
    theForm.b_zone_id.options[43] = new Option("Sevilla", "172");
    theForm.b_zone_id.options[44] = new Option("Soria", "173");
    theForm.b_zone_id.options[45] = new Option("Tarragona", "174");
    theForm.b_zone_id.options[46] = new Option("Teruel", "175");
    theForm.b_zone_id.options[47] = new Option("Toledo", "176");
    theForm.b_zone_id.options[48] = new Option("Valencia", "177");
    theForm.b_zone_id.options[49] = new Option("Valladolid", "178");
    theForm.b_zone_id.options[50] = new Option("Vizcaya", "179");
    theForm.b_zone_id.options[51] = new Option("Zamora", "180");
    theForm.b_zone_id.options[52] = new Option("Zaragoza", "181");
;
show("b_zone_id_tr");hide("b_zone_id_tr1");theForm.b_state.value="";} else if (SelectedCountry == "204") {
    theForm.b_zone_id.options[0] = new Option("Please select ...", "-1");
    theForm.b_zone_id.options[1] = new Option("Aargau", "104");
    theForm.b_zone_id.options[2] = new Option("Appenzell Ausserrhoden", "106");
    theForm.b_zone_id.options[3] = new Option("Appenzell Innerrhoden", "105");
    theForm.b_zone_id.options[4] = new Option("Basel-Landschaft", "108");
    theForm.b_zone_id.options[5] = new Option("Basel-Stadt", "109");
    theForm.b_zone_id.options[6] = new Option("Bern", "107");
    theForm.b_zone_id.options[7] = new Option("Freiburg", "110");
    theForm.b_zone_id.options[8] = new Option("Genf", "111");
    theForm.b_zone_id.options[9] = new Option("Glarus", "112");
    theForm.b_zone_id.options[10] = new Option("Graubnden", "113");
    theForm.b_zone_id.options[11] = new Option("Jura", "114");
    theForm.b_zone_id.options[12] = new Option("Luzern", "115");
    theForm.b_zone_id.options[13] = new Option("Neuenburg", "116");
    theForm.b_zone_id.options[14] = new Option("Nidwalden", "117");
    theForm.b_zone_id.options[15] = new Option("Obwalden", "118");
    theForm.b_zone_id.options[16] = new Option("Schaffhausen", "120");
    theForm.b_zone_id.options[17] = new Option("Schwyz", "122");
    theForm.b_zone_id.options[18] = new Option("Solothurn", "121");
    theForm.b_zone_id.options[19] = new Option("St. Gallen", "119");
    theForm.b_zone_id.options[20] = new Option("Tessin", "124");
    theForm.b_zone_id.options[21] = new Option("Thurgau", "123");
    theForm.b_zone_id.options[22] = new Option("Uri", "125");
    theForm.b_zone_id.options[23] = new Option("Waadt", "126");
    theForm.b_zone_id.options[24] = new Option("Wallis", "127");
    theForm.b_zone_id.options[25] = new Option("Zrich", "129");
    theForm.b_zone_id.options[26] = new Option("Zug", "128");
;
show("b_zone_id_tr");hide("b_zone_id_tr1");theForm.b_state.value="";} else if (SelectedCountry == "223") {
    theForm.b_zone_id.options[0] = new Option("Please select ...", "-1");
    theForm.b_zone_id.options[1] = new Option("Alabama", "1");
    theForm.b_zone_id.options[2] = new Option("Alaska", "2");
    theForm.b_zone_id.options[3] = new Option("American Samoa", "3");
    theForm.b_zone_id.options[4] = new Option("Arizona", "4");
    theForm.b_zone_id.options[5] = new Option("Arkansas", "5");
    theForm.b_zone_id.options[6] = new Option("Armed Forces Africa", "6");
    theForm.b_zone_id.options[7] = new Option("Armed Forces Americas", "7");
    theForm.b_zone_id.options[8] = new Option("Armed Forces Canada", "8");
    theForm.b_zone_id.options[9] = new Option("Armed Forces Europe", "9");
    theForm.b_zone_id.options[10] = new Option("Armed Forces Middle East", "10");
    theForm.b_zone_id.options[11] = new Option("Armed Forces Pacific", "11");
    theForm.b_zone_id.options[12] = new Option("California", "12");
    theForm.b_zone_id.options[13] = new Option("Colorado", "13");
    theForm.b_zone_id.options[14] = new Option("Connecticut", "14");
    theForm.b_zone_id.options[15] = new Option("Delaware", "15");
    theForm.b_zone_id.options[16] = new Option("District of Columbia", "16");
    theForm.b_zone_id.options[17] = new Option("Federated States Of Micronesia", "17");
    theForm.b_zone_id.options[18] = new Option("Florida", "18");
    theForm.b_zone_id.options[19] = new Option("Georgia", "19");
    theForm.b_zone_id.options[20] = new Option("Guam", "20");
    theForm.b_zone_id.options[21] = new Option("Hawaii", "21");
    theForm.b_zone_id.options[22] = new Option("Idaho", "22");
    theForm.b_zone_id.options[23] = new Option("Illinois", "23");
    theForm.b_zone_id.options[24] = new Option("Indiana", "24");
    theForm.b_zone_id.options[25] = new Option("Iowa", "25");
    theForm.b_zone_id.options[26] = new Option("Kansas", "26");
    theForm.b_zone_id.options[27] = new Option("Kentucky", "27");
    theForm.b_zone_id.options[28] = new Option("Louisiana", "28");
    theForm.b_zone_id.options[29] = new Option("Maine", "29");
    theForm.b_zone_id.options[30] = new Option("Marshall Islands", "30");
    theForm.b_zone_id.options[31] = new Option("Maryland", "31");
    theForm.b_zone_id.options[32] = new Option("Massachusetts", "32");
    theForm.b_zone_id.options[33] = new Option("Michigan", "33");
    theForm.b_zone_id.options[34] = new Option("Minnesota", "34");
    theForm.b_zone_id.options[35] = new Option("Mississippi", "35");
    theForm.b_zone_id.options[36] = new Option("Missouri", "36");
    theForm.b_zone_id.options[37] = new Option("Montana", "37");
    theForm.b_zone_id.options[38] = new Option("Nebraska", "38");
    theForm.b_zone_id.options[39] = new Option("Nevada", "39");
    theForm.b_zone_id.options[40] = new Option("New Hampshire", "40");
    theForm.b_zone_id.options[41] = new Option("New Jersey", "41");
    theForm.b_zone_id.options[42] = new Option("New Mexico", "42");
    theForm.b_zone_id.options[43] = new Option("New York", "43");
    theForm.b_zone_id.options[44] = new Option("North Carolina", "44");
    theForm.b_zone_id.options[45] = new Option("North Dakota", "45");
    theForm.b_zone_id.options[46] = new Option("Northern Mariana Islands", "46");
    theForm.b_zone_id.options[47] = new Option("Ohio", "47");
    theForm.b_zone_id.options[48] = new Option("Oklahoma", "48");
    theForm.b_zone_id.options[49] = new Option("Oregon", "49");
    theForm.b_zone_id.options[50] = new Option("Pennsylvania", "51");
    theForm.b_zone_id.options[51] = new Option("Puerto Rico", "52");
    theForm.b_zone_id.options[52] = new Option("Rhode Island", "53");
    theForm.b_zone_id.options[53] = new Option("South Carolina", "54");
    theForm.b_zone_id.options[54] = new Option("South Dakota", "55");
    theForm.b_zone_id.options[55] = new Option("Tennessee", "56");
    theForm.b_zone_id.options[56] = new Option("Texas", "57");
    theForm.b_zone_id.options[57] = new Option("Utah", "58");
    theForm.b_zone_id.options[58] = new Option("Vermont", "59");
    theForm.b_zone_id.options[59] = new Option("Virgin Islands", "60");
    theForm.b_zone_id.options[60] = new Option("Virginia", "61");
    theForm.b_zone_id.options[61] = new Option("Washington", "62");
    theForm.b_zone_id.options[62] = new Option("West Virginia", "63");
    theForm.b_zone_id.options[63] = new Option("Wisconsin", "64");
    theForm.b_zone_id.options[64] = new Option("Wyoming", "65");
;
show("b_zone_id_tr");hide("b_zone_id_tr1");theForm.b_state.value="";} else {hide("b_zone_id_tr");show("b_zone_id_tr1");}
    // if we had a value before reset, set it again
    if (SelectedZone != "") theForm.elements["b_zone_id"].value = SelectedZone;
  }
//--></script>