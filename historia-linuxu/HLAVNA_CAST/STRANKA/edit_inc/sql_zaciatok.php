<?php

if (! isset($asc)){ $asc='ASC'; }
if (! isset($tab) ) {$tab=1; }
if (! isset($godles) ) {$godles=0; }
if (  isset($godles) and  $TTmoje_prava<3) {$godles=0; }




if ($TTmoje_prava >2 and $godles==1 ) {$pole= count_na_table ($riadky_na_tabulku,$tab, $sql2);}
else                   {$pole= count_na_table_x ($riadky_na_tabulku,$tab, $sql2, $TTmoje_id);}      



/*
nutne parametre :
count_na_table($prvy,$druhy, $tabulka);
$prvy  - pocet riadkou pre na ktorych sa zobrazia zaznamy (kolko riadkou sa ma zobrazit)
$druhy  - ktora tabulka sa zobrazuje, teda tabulka zo zaznamu od 0 -15 alebo od 15 do 30...
$tabulka -tabulka pre ktoru zistim hodnotu. Napriklad 'clanok'"; 
*/

$counter=    $pole[0];
$sql_min=    $pole[1];
$sql_max=    $pole[2];
$kolko_krat= $pole[3];


?>
