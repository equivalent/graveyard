<?php

/*

||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
Funkcia na overovanie ci uz v databaze zaznam nieje

||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
*/



function zisti_ci_existuje($my_sql, $vyraz)

{
/* VRACJA 1 AK EXISTUJE!!!! */

/*format SQL
$my_sql="SELECT coztabulky FROM nazovtabulky GROUP BY coztabulky";

*/

$aky_sql= mysql_query ( $my_sql ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);



$alow_write_to_db=0;


/* teraz ten sa teato cast postara o to aby som mal obsah DB v poli s ktorim mozem pracovat. */
 
while ($riadok =  mysql_fetch_assoc ($aky_sql)) 

{
/*funkcia strcasecmp porovnava 2 retazce bez ohladu na velke a male pismena*/
/*premena $vyraz je poslana ako parameter funkcie*/
foreach($riadok as $hodnota)
{
$vyraz_uz_je=  strcasecmp($hodnota, $vyraz);

if (!$vyraz_uz_je ) {$alow_write_to_db=1;}
}
}
return $alow_write_to_db;
}



/*

||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
Funkcia na bbcode

su 4
2 su na vysvetlivky 
a 2 na clanky
dvovod je taky ze nechcem mat vo vysvetlivkach odkazy na obrazky a odkazy na dalsie vysvetlivky

||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

zdrojom tejto funkcie je
http://en.wikipedia.org/wiki/BBCode
*/

function bbcode2html4vysvetlivka ($strInput) {
    return preg_replace(
        array(
            '/\\[url[\\:\\=]((\\"([\\W]*javascript\:[^\\"]*)?([^\\"]*)\\")|'.
                '(([\\W]*javascript\:[^\\]]*)?([^\\]]*)))\\]/ie', '/\\[\\/url\\]/i',


            '/\\[n\\]/i',    
            '/\\[b\\]/i', '/\\[\/b\\]/i',
            '/\\[i\\]/i', '/\\[\/i\\]/i',
       
            '/\\[stred\\]/i', '/\\[\/stred\\]/i',
                         
                
            '/\\[farba[\\:\\=]cervena\\]/i', '/\\[\/farba\\]/i', 
            
            '/\\[farba[\\:\\=]modra\\]/i',
            
            '/\\[farba[\\:\\=]zelena\\]/i',    
                     
            '/\\[farba[\\:\\=]hneda\\]/i',  
            
            '/\\[farba[\\:\\=]siva\\]/i',
            
            '/\\[farba[\\:\\=]fialova\\]/i',                
            
            '/\\[farba[\\:\\=]oranzova\\]/i', 
 
            '/\\[farba[\\:\\=]fs\\]/i',
            
            '/\\[farba[\\:\\=]maroon\\]/i',                           
            
            '/\\[velkost[\\:\\=]mensie\\]/i',                         
 
            '/\\[velkost[\\:\\=]male\\]/i',
            
            '/\\[velkost[\\:\\=]normal\\]/i',
            
            '/\\[velkost[\\:\\=]velke\\]/i',

            '/\\[velkost[\\:\\=]vacsie\\]/i',
            
            '/\\[velkost[\\:\\=]obor\\]/i',                                       
                  
            '/\\[\/velkost\\]/i',      
                        
            '/\\[m\\]/i',

            '/\\[tab\\]/i'                                                  
        ),
        
      

        array(
            '\'<a href="\'.(\'$4\'?\'$4\':\'$7\').\'" ><u>\'', '</u></a>',
            
            '<br>',
            
            '<strong>', '</strong>',
            
            '<em>', '</em>',
                        
            '<center>', '</center>',
                             
            
            '<font color=\'red\'>', '</font>',
            
            '<font color=\'blue\'>',
            
            '<font color=\'green\'>',   
 
            '<font color=\'BurlyWood\'>', 
            
            '<font color=\'Gray\'>',
            
            '<font color=\'orchid\'>',
            
            '<font color=\'DarkOrange\'>', 
            
            '<font color=\'#ffd21f\'>', 
            
            '<font color=\'Maroon\'>',                                                             
            
              
            '<font size=\'1\'>',             

            '<font size=\'2\'>', 

            '<font size=\'3\'>', 
            
            '<font size=\'4\'>',
            
            '<font size=\'5\'>',                         

            '<font size=\'6\'>',                        
            
            '</font>',
            
            '&nbsp;',
            
            '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'   
            
        ),
        $strInput
    );
}

function bbcode2html4clanok ($strInput) {
  /*$tefer="\'.(\'\$4\'?\'\$4\':\'\$7\').\'";*/
global $popupv;
global $popups;
  $trefer="\$7";
  $hrefer="pop.php?id=$trefer";
  $kreper="onClick=\"JavaScript: newWindow = openWin( \'$hrefer\', \'Profile\', \'width=".$popups.",height=".$popupv.",toolbar=0,location=0,directories=0,status=0,menuBar=0,scrollBars=auto,resizable=1\' ); newWindow.focus(); return false;\"";
  /*ano blbsie nazvy som nevedel vymisliet!*/
    return preg_replace(
        array(

            '/\\[url[\\:\\=]((\\"([\\W]*javascript\:[^\\"]*)?([^\\"]*)\\")|'.
                '(([\\W]*javascript\:[^\\]]*)?([^\\]]*)))\\]/ie', '/\\[\\/url\\]/i',

            '/\\[vysvet[\\:\\=]((\\"([\\W]*javascript\:[^\\"]*)?([^\\"]*)\\")|'.
                '(([\\W]*javascript\:[^\\]]*)?([^\\]]*)))\\]/ie', '/\\[\\/vysvet\\]/i',
                
            '/\\[b\\]/i', '/\\[\/b\\]/i',
            '/\\[i\\]/i', '/\\[\/i\\]/i',
            '/\\[cituj\\]/i', '/\\[\/cituj\\]/i',

            '/\\[stred\\]/i', '/\\[\/stred\\]/i',
    
            '/\\[vpravo\\]/i', '/\\[\/vpravo\\]/i',        
            
            '/\\[img[\\:\\=]((\\"([\\W]*javascript\:[^\\"]*)?([^\\"]*)\\")|'.
                '(([\\W]*javascript\:[^\\]]*)?([^\\]]*)))\\]/ie',
           
            '/\\[limg[\\:\\=]((\\"([\\W]*javascript\:[^\\"]*)?([^\\"]*)\\")|'.
                '(([\\W]*javascript\:[^\\]]*)?([^\\]]*)))\\]/ie',
                
            '/\\[rimg[\\:\\=]((\\"([\\W]*javascript\:[^\\"]*)?([^\\"]*)\\")|'.
                '(([\\W]*javascript\:[^\\]]*)?([^\\]]*)))\\]/ie',                                  

            '/\\[myimg[\\:\\=]((\\"([\\W]*javascript\:[^\\"]*)?([^\\"]*)\\")|'.
                '(([\\W]*javascript\:[^\\]]*)?([^\\]]*)))\\]/ie',
           
            '/\\[lmyimg[\\:\\=]((\\"([\\W]*javascript\:[^\\"]*)?([^\\"]*)\\")|'.
                '(([\\W]*javascript\:[^\\]]*)?([^\\]]*)))\\]/ie',
                
            '/\\[rmyimg[\\:\\=]((\\"([\\W]*javascript\:[^\\"]*)?([^\\"]*)\\")|'.
                '(([\\W]*javascript\:[^\\]]*)?([^\\]]*)))\\]/ie',
                
            '/\\[farba[\\:\\=]cervena\\]/i', '/\\[\/farba\\]/i', 
            
            '/\\[farba[\\:\\=]modra\\]/i',
            
            '/\\[farba[\\:\\=]zelena\\]/i',    
                     
            '/\\[farba[\\:\\=]hneda\\]/i',  
            
            '/\\[farba[\\:\\=]siva\\]/i',
            
            '/\\[farba[\\:\\=]fialova\\]/i',                
            
            '/\\[farba[\\:\\=]oranzova\\]/i', 
 
            '/\\[farba[\\:\\=]fs\\]/i',
            
            '/\\[farba[\\:\\=]maroon\\]/i',                           
            
            '/\\[velkost[\\:\\=]mensie\\]/i',                         
 
            '/\\[velkost[\\:\\=]male\\]/i',
            
            '/\\[velkost[\\:\\=]normal\\]/i',
            
            '/\\[velkost[\\:\\=]velke\\]/i',

            '/\\[velkost[\\:\\=]vacsie\\]/i',
            
            '/\\[velkost[\\:\\=]obor\\]/i',                                       
                  
            '/\\[\/velkost\\]/i',      
                        
            '/\\[m\\]/i',

            '/\\[tab\\]/i'                                                  
        ),
        
      

        array(
            '\'<a href="\'.(\'$4\'?\'$4\':\'$7\').\'" ><u>\'', '</u></a>',
     
         
            '\'<a target="_blank" href="'.$hrefer.'" '.$kreper.' ><u>\'', '</u></a>',
            
            '<strong>', '</strong>',
            
            '<em>', '</em>',
            
            '<blockquote style="background-color: #f6ebb0;">', '</blockquote>',
            
            '<center>', '</center>',
            
            '<div style=\'text-align: right; \'>', '</div>',                         
            
            '\'<img src="\'.(\'$4\'?\'$4\':\'$7\').\'">\'',
            
            '\'<img src="\'.(\'$4\'?\'$4\':\'$7\').\'" align="left" >\'',     
            
            '\'<img src="\'.(\'$4\'?\'$4\':\'$7\').\'" align="right" >\'', 
            
            '\'<img src="imggalery/\'.(\'$4\'?\'$4\':\'$7\').\'">\'',
            
            '\'<img src="imggalery/\'.(\'$4\'?\'$4\':\'$7\').\'" align="left" >\'',     
            
            '\'<img src="imggalery/\'.(\'$4\'?\'$4\':\'$7\').\'" align="right" >\'',                                
            
            '<font color=\'red\'>', '</font>',
            
            '<font color=\'blue\'>',
            
            '<font color=\'green\'>',   
 
            '<font color=\'BurlyWood\'>', 
            
            '<font color=\'Gray\'>',
            
            '<font color=\'orchid\'>',
            
            '<font color=\'DarkOrange\'>', 
            
            '<font color=\'#ffd21f\'>', 
            
            '<font color=\'Maroon\'>',                                                             
            
              
            '<font size=\'1\'>',             

            '<font size=\'2\'>', 

            '<font size=\'3\'>', 
            
            '<font size=\'4\'>',
            
            '<font size=\'5\'>',                         

            '<font size=\'6\'>',                        
            
            '</font>',
            
            '&nbsp;',
            
            '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'                                   
        ),
        $strInput
    );
}






/*
||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
Funkcia na prevod bbcodu, specialnych html znakov  a zalomenia riadku


||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
*/
function bbcode4vysvetlivka ($sprava) {


echo "<p>". bbcode2html4vysvetlivka (htmlspecialchars($sprava ))."</p>";
                            }
                            

function bbcode4clanok ($sprava) {


echo "<p>". bbcode2html4clanok (nl2br (htmlspecialchars($sprava )))."</p>";
                            }


/*
tu vznika dost rozporuplna teoria ohladom pouzitia funkcie htmlspecialchars()
ma prevazat "specialne HLML kody". Nech som testoval ako som testoval nenarazil som ani na 
jeden specialny html kod pre ktory by bola dobra tato funkcia (az na &nbsp;). V kazdom pripade som ju pouzil
lebo ju doporucena. Funkcia nl2br() sposobi ze zalomenie riadku sa nahradi tagom <br> */









/* 
 ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
funkcia vracia pocet zaznamov v tabulke, minimalu hodnotu pre zobrazenie, maximalnu hodnotu pre zobrazenie kolko krat zobrazit
pre sql prikaz 
        
        
        $sql="SELECT * FROM expl ORDER BY ". $order. " ". $asc ." LIMIT ". $sql_min ." , ".$sql_max." ; ";

 "; "; 

  */
function count_na_table($riadky_na_tabulku,$tab,$sql) 
{



$sql_s="SELECT COUNT(id) FROM $sql ";


$vykonaj_sql=mysql_query ( $sql_s ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
$zistenie_z_sql= mysql_fetch_array ($vykonaj_sql);

$counter=$zistenie_z_sql[0];



/*====================================*/
   /*zistim kolkok tabuliek od min limitu po max*/
   $kolko_krat=$counter/$riadky_na_tabulku;
   /*zaokruhli to */   
   $kolko_krat= ceil($kolko_krat);




if ( ! $tab<1){


$sql_min= ($riadky_na_tabulku * $tab)-$riadky_na_tabulku;

}
else 
{
/*aj ked by mohol predchazajuce prikazy vypocitat limit od 0 do $riadky_na_tabulku
radsej som to osetril 
*/
$sql_min= 0;

}

$pole= array( $counter, $sql_min, $riadky_na_tabulku, $kolko_krat );



//echo $pole[0];    //$counter
//echo "-";
//echo $pole[1];    //$sql_min
//echo "-";
//echo $pole[2];    //$sql_max
//echo "-";
//echo $pole[3];    //$kolko_krat



return $pole;
}














function count_na_table_x($riadky_na_tabulku,$tab,$sql_tabulka,  $mojeid) 
{

/*predpoklada sa ze je included id_gether.php. bez neho tato funkcia nepojde!!!!*/

if ($sql_tabulka=='expl') { $sql_autor_x='autor_v';         $sql_autor_x_pole='id_expl';    }  
else if ($sql_tabulka=='clanok') { $sql_autor_x='autor_c';  $sql_autor_x_pole='id_clanku';  }
else if ($sql_tabulka=='buffer') { $sql_autor_x='autor_b';  $sql_autor_x_pole='id_bufferu'; }
else if ($sql_tabulka=='obrazok') { $sql_autor_x='autor_o'; $sql_autor_x_pole='id_obr';     }
else {die ( "kontaktujte administratora na historialinuxu@gmail.com o CHYBE:  EROR-funkcii" );} 


$sql_s="SELECT COUNT(xx.id) FROM $sql_tabulka xx JOIN $sql_autor_x avtor ON  ( xx.id=$sql_autor_x_pole ) WHERE avtor.id_usera=$mojeid";


$vykonaj_sql=mysql_query ( $sql_s ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
$zistenie_z_sql= mysql_fetch_array ($vykonaj_sql);

$counter=$zistenie_z_sql[0];



/*====================================*/
   /*zistim kolkok tabuliek od min limitu po max*/
   $kolko_krat=$counter/$riadky_na_tabulku;
   /*zaokruhli to */   
   $kolko_krat= ceil($kolko_krat);




if ( ! $tab<1){


$sql_min= ($riadky_na_tabulku * $tab)-$riadky_na_tabulku;

}
else 
{
/*aj ked by mohol predchazajuce prikazy vypocitat limit od 0 do $riadky_na_tabulku
radsej som to osetril 
*/
$sql_min= 0;

}

$pole= array( $counter, $sql_min, $riadky_na_tabulku, $kolko_krat );



//echo $pole[0];    //$counter
//echo "-";
//echo $pole[1];    //$sql_min
//echo "-";
//echo $pole[2];    //$sql_max
//echo "-";
//echo $pole[3];    //$kolko_krat



return $pole;
}












/*
||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
*/


/*funkcia vrati cislo posledneho zaznamu v tabulke*/
function posledny_pocet ($tabulka)
{

$sql_last="SELECT COUNT(id) FROM $tabulka";
$vykonaj_sql_last=mysql_query ( $sql_last ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
$zistenie_z_sql= mysql_fetch_array ($vykonaj_sql_last);

$last=$zistenie_z_sql[0];

return $last;
}



/*funkcia vrati cislo posledneho zaznamu v tabulke*/
function posledny_zaznam ($tabulka)
{

$sql_last="SELECT id FROM $tabulka ORDER BY id DESC LIMIT 1";
$vykonaj_sql_last=mysql_query ( $sql_last ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
$zistenie_z_sql= mysql_fetch_array ($vykonaj_sql_last);

$last=$zistenie_z_sql[0];

return $last;
}




function otestuj_clanok ($meno_clanku,$samotny_clanok)
{
/*tato funkcia je jednorazova. tetuje ci je mozne pridavat clanok. to znamena ci nieje prazny retazec */
 

                      if ( $meno_clanku=='' or $samotny_clanok=='')  {
                                                                       $rozhodnutienepridat=1;
                                                                     }

                      /*tato cast zabespecuje ze nezadate viac ako 255 znakov, aj ked som toto uz zabespecil v 
                      html kode MAXLENGHT=255, ale clovek nikdy nevie*/
                      elseif (strlen($meno_clanku) > 255 )
                              {
                              $rozhodnutienepridat=2;
                              }
                     else {$rozhodnutienepridat=0;}
return $rozhodnutienepridat;
}


function select_count ($tabulka, $vyraz, $pole)
{
if (!$vyraz==""){ 

$sql_zisti_ci_uz_je="SELECT count($pole) FROM $tabulka WHERE $pole='$vyraz'"; /* test ci uz vyraz neexistuje*/
                          $spust_sql_zisti_ci_uz_je= mysql_query ($sql_zisti_ci_uz_je) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
                          $vysledok=mysql_fetch_array ($spust_sql_zisti_ci_uz_je);
                }
else {$vysledok[0]=1;}                
return $vysledok[0];
}


 function tover_mail($email)
 {
 
 
 return 1;
 }
 

?>
