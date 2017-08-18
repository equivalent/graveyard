<?
include 'autorizacia.php';
/*
include 'spojenie_s_db.php';
include 'funkcie.php';
include 'cs.php';

su zahrnute v samotnom index.php
*/


foreach ( $_GET as $kluc => $hodnota){
$$kluc= $hodnota;
}

foreach ( $_POST as $kluc => $hodnota){
$$kluc= $hodnota;
}

$sory_10_ismax=0;
 /*najprv zistim ci uz nema viasc ako 10 nerozpisanych prispevkov*/
                                                   $sql_count_user="SELECT COUNT(id_bufferu) from autor_b WHERE id_usera=$TTmoje_id";
                                                    $spust_sql_count_u = mysql_query ( $sql_count_user ) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end); 
                                                      $zistenie_z= mysql_fetch_array ($spust_sql_count_u);
                                                   if ($zistenie_z[0] >=10) { $sory_10_ismax=1;}
                                                     


                    
if (isset ($buf)) 
    {        
    $sory_10_ismax=0; //zabespeci aby nezrusilo upravu 10 nedopisaneho clanku
                 
    $sql_buf= mysql_query ("SELECT * FROM buffer WHERE id=$buf ") or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
      while ($extraction = mysql_fetch_array( $sql_buf ))
        { extract( $extraction );}
        
        $viev= $expl_obr;        
        $tab= $strana;            
       if (! $bufedit==0){ $edit= $bufedit; }


       
     }
     /*AK UPRAVUJEM CLANOK*/             
elseif (isset ($edit)){
      
      $sory_10_ismax=0; //zabespeci aby nezrusilo upravu 10 nedopisaneho clanku
      $sql_cla_sek="SELECT c.clanazov, c.clatext, sc.id_sekcia FROM clanok c JOIN sekcia_clanok sc ON (c.id = sc.id_clanok ) WHERE c.id=$edit";

       $vykonaj_sql_cla_sek= mysql_query ($sql_cla_sek) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);               
            while ($extraction = mysql_fetch_array( $vykonaj_sql_cla_sek ))
           { extract( $extraction );}          
                /* */    
                         $bufnazov=$clanazov; 
                         $buftext=$clatext;

$can_I=mas_na_to_pravo('autor_c', $edit, 'id_clanku', 'update');
if (!$can_I) {  DIE ('Na toto nemate pravo... ');}                        
                                          
                      }

if (! isset($tab) ) {$tab=1; }


if( ! isset($viev) || $viev == '' ) { $viev='expl'; }

if (! isset($order) ) {$order='id'; } //ak neni inak nastavene zobraz podla ID
if (! isset($asc) ) {$asc='ASC'; } //ak neni inak nastavene zobraz podla ID

/* sirka textarea a vlasne aj vsetkych formularov */


?>

<script language="Javascript" type="text/javascript">

function vlozbb(what)
  {
  document.formular.samotny_clanok.value = document.formular.samotny_clanok.value + what; 
  document.formular.samotny_clanok.focus(); 
  

  }

</script>



<br >


<!-------------------- FORMULAR -------------------------------------->
  <form name='formular' action='spracuj.php' method='post'>
 <input type='hidden' name='spracovanie' value='clanok'>
 <input type='hidden' name='clanokcibuf' value='buffer'> <?/*z istotou to mozem tvrdit pre cely pridaj pridajclanok.php
                                                              lebo volba zapisu do clanku je az vo wievclanok.php*/?>
 <input type='hidden' name='viev' value='<?echo $viev;?>'> 
 <input type='hidden' name='tab'  value='<?echo $tab;?>'>

 
 <?if (isset ($edit)){echo "<input type='hidden' name='edit' value='$edit'>";}?>
 <?if (isset ($buf) ){echo "<input type='hidden' name='buf' value='$buf'>";}?>

<table align='center' border=0  cellpadding='<?echo $vnutro_stranky;?>'  cellspacing='<?echo $vnutro_stranky;?>'><!--XXX21--->
 <tr>
  <td colspan=2>
      <?
          $sprava_nadpis='';
          include 'zaoblenie_start.php';
          if($sory_10_ismax==1) {echo"<p class='txtnadpis'>Limit 10 rozpÌsan˝ch öl·nkov je prekroËen˝.</p>";}
          elseif (isset($save)) {echo"<p class='txtnadpis'>Clanok ulozeny v odkladacej casti.</p>";}
          else {echo "<p class='txtnadpis'>Pridanie Ël·nku</p>";}
          include 'zaoblenie_end.php';
      
       if($sory_10_ismax==1){die;}
      ?>
  </td>
 </tr>
 
 <tr>
  
    <td valign='middle' align='center' colspan=1>
<!------------------------ NAZOV CLANKU------------------------------------------------------------------------------------->            
    
        <table ><!--XXX31--->
        
          <tr>
              <td > 
                    <?$sprava_nadpis='N·zov Ël·nku';?>
                    <? include 'zaoblenie_start.php';?>
                     <input class='form_all' type='text' name='meno_clanku' maxlength="255" size='<?echo $form_w; ?>' value='<? if (isset($bufnazov)) {echo $bufnazov;} else {echo 'Meno Ël·nku';} ?>' >
                    <? include 'zaoblenie_end.php';?>
              </td>
          </tr>
            

        </table><!--XXX31--->
    </td>
    


<!------------------------ VYBER SEKCIE-------------------------------------------------------------------------------------------->            
         <td>
          <table><!--XXX41--->
              <tr>
                  <td>
                   <?$sprava_nadpis='V˝ber sekcie';?>
                    <? include 'zaoblenie_start.php';?>
                        <select name='sekcia' size='3' class='select'>
                             <?
                                /*vypise mi zaznamy MENA ako polozky pre option. Do value sa ulozi ID  */
                                $sql_vyber= mysql_query ("SELECT * FROM sekcia ") or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
                               
                                while ($extraction = mysql_fetch_array( $sql_vyber ))
                                  {
                                     extract( $extraction );                
                                     echo "<option value='$id' class='option' ";
                                     if (isset($id_sekcia)) {
                                                                if ($id==$id_sekcia){echo " selected ";}
                                                              }      
                                     echo " >$nazov";
                                  }
                              ?>
                        </select>
                  <? include 'zaoblenie_end.php';?>
                  </td>
             </tr>         
           </table><!--XXX41--->
          </td>

    <tr>    
<!------------------------BB TLACITKA----------------------------------------------------------------------------------------------------->            

      <td align='center' colspan='1'>
                   
                   
                    
                    <?$sprava_nadpis='';?>
                    <? include 'zaoblenie_start.php';?>
                                 <table><!--XXX56--->
                                                        <tr>
                                                          <td>
                                                          <!------------------------FRABY------border=3 bordercolor='#fbcf3b' cellpadding='0' cellspacing='0' ------------------->
                                                                  <table class='table_bb_farby'"><!--XXX51--->
                                                                    <tr>
                                                                      <td><a href="#" onclick="vlozbb('[farba=maroon]');  return false;"><img src="tlacitka/bb/farby/tlacitko_color_maroon.jpg"  alt="maroon"  border=0 width="18" height="18"></a>
                                                                      <td><a href="#" onclick="vlozbb('[farba=siva]');    return false;"><img src="tlacitka/bb/farby/tlacitko_color_siva.jpg"    alt="siva"    border=0 width="18" height="18"></a>
                                                                      <td><a href="#" onclick="vlozbb('[farba=fialova]'); return false;"><img src="tlacitka/bb/farby/tlacitko_color_fialova.jpg" alt="fialova" border=0 width="18" height="18"></a>
                                                                    </tr>
                                                                    <tr>
                                                                      <td><a href="#" onclick="vlozbb('[farba=cervena]'); return false;"> <img src="tlacitka/bb/farby/tlacitko_color_red.jpg"     alt="cervena" border=0 width="18" height="18"></a>
                                                                      <td><a href="#" onclick="vlozbb('[farba=hneda]');   return false;"> <img src="tlacitka/bb/farby/tlacitko_color_hneda.jpg"   alt="hneda"   border=0 width="18" height="18"></a>
                                                                      <td><a href="#" onclick="vlozbb('[farba=modra]');   return false;"> <img src="tlacitka/bb/farby/tlacitko_color_modra.jpg"   alt="modra"   border=0 width="18" height="18"></a>
                                                                    </tr>
                                                                    <tr>
                                                                      <td><a href="#" onclick="vlozbb('[farba=oranzova]'); return false;"><img src="tlacitka/bb/farby/tlacitko_color_oranzova.jpg" alt="oranzova"       border=0 width="18" height="18"></a>
                                                                      <td><a href="#" onclick="vlozbb('[farba=fs]');       return false;"><img src="tlacitka/bb/farby/tlacitko_color_fs.jpg"       alt="farba stranky"  border=0 width="18" height="18"></a>
                                                                      <td><a href="#" onclick="vlozbb('[farba=zelena]');   return false;"><img src="tlacitka/bb/farby/tlacitko_color_zelena.jpg"   alt="zelena"         border=0 width="18" height="18"></a>
                                                                    </tr>  
                                                                    
                                                                    <tr>                                                                    <tr>
                                                                      <td class='td_bb_vysky' colspan=3 align= center><a href="#" onclick="vlozbb('[/farba]'); return false;"><img src="tlacitka/bb/farby/tlacitko_color_farba.jpg" alt="ukoncenie [/farba]" border=0 width="54" height="9"></a>
                                                                    </tr>
                                                                    
                                                                  </table><!--XXX51--->
                                                          <td>
                                                          <!------------------------Stredne BB kody--------------->
                                                            <table><!--XXX52--->
                                                                    <tr>
                                                                      <td align=center>
                                                                              <table><!--XXX53--->
                                                                                <tr>
                                                                                
                                                                                <td><a href="#" onclick="vlozbb('[tab]');       return false;"><img src="tlacitka/bb/tlacitko_zkalad_tab.jpg"       alt="Tabulator"         border=0 width="40" height="20"></a>
                                                                                <td><a href="#" onclick="vlozbb('[m]');         return false;"><img src="tlacitka/bb/tlacitko_zkalad_m.jpg"         alt="Medzera"           border=0 width="40" height="20"></a>
                                                                                <td><a href="#" onclick="vlozbb('[img=]');       return false;"><img src="tlacitka/bb/tlacitko_zkalad_img.jpg"       alt="obr·zok"           border=0 width="40" height="20"></a>
                                                                                
                                                                                </tr>
                                                                              </table><!--XXX53--->
                                                                      
                                                                              <table> <!--XXX54--->
                                                                                <tr>
                                                                                
                                                                                <td><a href="#" onclick="vlozbb('[b]');       return false;"><img src="tlacitka/bb/tlacitko_zkalad_b.jpg"       alt="TuËn˝"         border=0 width="30" height="20"></a>
                                                                                <td><a href="#" onclick="vlozbb('[i]');       return false;"><img src="tlacitka/bb/tlacitko_zkalad_i.jpg"       alt="äikm˝"         border=0 width="30" height="20"></a>
                                                                                <td><a href="#" onclick="vlozbb('[url=]');     return false;"><img src="tlacitka/bb/tlacitko_zkalad_url.jpg"     alt="Url adresa"    border=0 width="38" height="20"></a>
                                                                                <td><a href="#" onclick="vlozbb('[cituj]');   return false;"><img src="tlacitka/bb/tlacitko_zkalad_cituj.jpg"   alt="Citovanie"     border=0 width="46" height="20"></a>
                                                                                <td><a href="#" onclick="vlozbb('[stred]');   return false;"><img src="tlacitka/bb/tlacitko_zkalad_stred.jpg"   alt="Text na stred" border=0 width="52" height="20"></a>
                                                                                <td><a href="#" onclick="vlozbb('[vpravo]');  return false;"><img src="tlacitka/bb/tlacitko_zkalad_vpravo.jpg"  alt="Text vpravo"   border=0 width="58" height="20"></a>
                                                                              
                                                                                </tr>
                                                                                
                                                                                <tr>
                                                                                
                                                                                <td><a href="#" onclick="vlozbb('[/b]');       return false;"><img src="tlacitka/bb/tlacitko_zkalad_b_l.jpg"       alt="TuËn˝ koniec"         border=0 width="30" height="20"></a>
                                                                                <td><a href="#" onclick="vlozbb('[/i]');       return false;"><img src="tlacitka/bb/tlacitko_zkalad_i_l.jpg"       alt="äikm˝ koniec"         border=0 width="30" height="20"></a>
                                                                                <td><a href="#" onclick="vlozbb('[/url]');     return false;"><img src="tlacitka/bb/tlacitko_zkalad_url_l.jpg"     alt="Url adresa koniec"    border=0 width="38" height="20"></a>
                                                                                <td><a href="#" onclick="vlozbb('[/cituj]');   return false;"><img src="tlacitka/bb/tlacitko_zkalad_cituj_l.jpg"   alt="Citovanie koniec"     border=0 width="46" height="20"></a>
                                                                                <td><a href="#" onclick="vlozbb('[/stred]');   return false;"><img src="tlacitka/bb/tlacitko_zkalad_stred_l.jpg"   alt="Text na stred koniec" border=0 width="52" height="20"></a>
                                                                                <td><a href="#" onclick="vlozbb('[/vpravo]');  return false;"><img src="tlacitka/bb/tlacitko_zkalad_vpravo_l.jpg"  alt="Text vpravo koniec"   border=0 width="58" height="20"></a>
                                                                                
                                                                                </tr>
                                                                              </table><!--XXX54--->
                                                                       </td>       
                                                                    <tr>
                                                              </table><!--XXX52--->
                                                          <td>
                                                          
                                                          
                                                          
                                                          <!------------------------VELKOSTI-------------------->
                                                                       <table class='table_bb_vysky'" height=84><!--XXX55--->
                                                                         <tr>
                                                                            <td class='td_bb_vysky'><a href="#" onclick="vlozbb('[velkost=mensie]');   return false;"><img src="tlacitka/bb/vysky/tlacitk_vyska_mensie.jpg"  alt="mensie pismo"  border=0 width="54" height="9"></a>
                                                                            <td class='td_bb_vysky'><a href="#" onclick="vlozbb('[velkost=velke]');    return false;"><img src="tlacitka/bb/vysky/tlacitk_vyska_velke.jpg"   alt="velke pismo"   border=0 width="54" height="9"></a>
                                                                         </tr>
                                                                         <tr>
                                                                            <td class='td_bb_vysky'><a href="#" onclick="vlozbb('[velkost=male]');     return false;"> <img src="tlacitka/bb/vysky/tlacitk_vyska_male.jpg"   alt="male pismo"   border=0 width="54" height="9"></a>
                                                                            <td class='td_bb_vysky'><a href="#" onclick="vlozbb('[velkost=vacsie]');   return false;"><img src="tlacitka/bb/vysky/tlacitk_vyska_vacsie.jpg"  alt="vacsie pismo"  border=0 width="54" height="9"></a>
                                                                         </tr>
                                                                        
                                                                          <tr>
                                                                            <td class='td_bb_vysky'><a href="#" onclick="vlozbb('[velkost=normal]');   return false;"><img src="tlacitka/bb/vysky/tlacitk_vyska_normal.jpg"  alt="normal pismo"  border=0 width="54" height="9"></a>
                                                                            <td class='td_bb_vysky'><a href="#" onclick="vlozbb('[velkost=obor]');     return false;"><img src="tlacitka/bb/vysky/tlacitk_vyska_obor.jpg"    alt="obor pismo"     border=0 width="54" height="9"></a>
                                                                          </tr>
                                                                           
                                                                          <tr>                                                                   
                                                                            <td class='td_bb_vysky' colspan=3 align= center><a href="#" onclick="vlozbb('[/velkost]'); return false;"><img src="tlacitka/bb/vysky/tlacitk_vyska_velkost.jpg" alt="ukoncenie [/velkost]" border=0 width="54" height="9"></a>
                                                                          </tr>      
                                                                      </table><!--XXX55--->
                                                         
                                                         
                                                         
                                                         </tr>
                                                         <? if ($viev=='obr'){?>
                                                         <tr>
                                                         <td colspan=3><font size = -1 align = center>Pre umiestnenie obr·zku dopiste do BB kodu <b>r</b> (vpravo), alebo <b>l</b> (væavo). Napriklad: [<b>r</b>myimg=12.jpg]</font>
                                                           <?}?>
                                </table><!--XXX56--->
                  <? include 'zaoblenie_end.php';?>
         
          
          
      </td>
      
<!------------------------/BB TLACITKA----------------------------------------------------------------------------------------------------->        
          <td width=200 align='left'>
<!------------------------ VYBER SEKCIE-------------------------------------------------------------------------------------------->            
 <!--======  Zoradenie  ================================================   --> 
                   
                          <div>    <?$sprava_nadpis='';?>
                                   <? include 'zaoblenie_start.php';?>
                                                    
                                           <input class='input_but'  type='submit' name='viev' value='expl'>
                                           <input class='input_but'  type='submit' name='viev' value='obr'>
                                            
                                   

                                   <?if( $viev=='obr'){?>
                                                  <select name='order' size='1' class='select' style='width:100px;'>
                                                    <option class='option' value='id' <? if(isset($order) and $order=='id' ){echo "selected";} ?> >Id          
                                                    <option class='option' value='datum' <? if(isset($order) and $order=='datum' ){echo "selected";} ?> >Datumu
                                                           
                                                  </select>
                                                                                                   
                                                  <select name='asc' size='1' class='select' style='width:100px;'>
                                                    <option class='option' value='ASC' <? if(isset($asc) and $asc=='ASC' ){echo "selected";} ?> >Norm·lne
                                                    <option class='option' value='DESC' <? if(isset($asc) and $asc=='DESC' ){echo "selected";} ?> >Obr·tene
                                                  </select>
                                                  <input class='input_but'  type='submit' value='Zobraz' style='width:100px;'>
                                   <?}?>  
                                   <?if( $viev=='expl'){?>
                                                  <select name='order' size='1' class='select' style='width:100px;'>
                                                    <option class='option' value='id' <? if(isset($order) and $order=='id' ){echo "selected";} ?> >Id          
                                                    <option class='option' value='datum' <? if(isset($order) and $order=='datum' ){echo "selected";} ?> >Datumu
                                                    <option class='option' value='vyraz' <? if(isset($order) and $order=='vyraz' ){echo "selected";} ?> >V˝razu       
                                                  </select>
                                                  
                                                  <select name='asc' size='1' class='select' style='width:100px;'>
                                                    <option class='option' value='ASC' <? if(isset($asc) and $asc=='ASC' ){echo "selected";} ?> >Norm·lne
                                                    <option class='option' value='DESC' <? if(isset($asc) and $asc=='DESC' ){echo "selected";} ?> >Obr·tene
                                                  </select>  
                                                  <input class='input_but'  type='submit'  value='Zobraz' style='width:100px;'>                                                
                                   <?}?>                                    
                                 
                                   <? include 'zaoblenie_end.php';?>
                                  
                         </div>
                       
                 
    </td>
      
  </tr>




</td>
</tr>
<tr>

<td align='left' valign='top' >
    <table><!--XXX61--->
    
       <tr> 
        <td align='left' valign='top' >
             <?$sprava_nadpis='Text Ël·nku';?>
             <? include 'zaoblenie_start.php';?>
               <textarea class='form_all' name='samotny_clanok' cols='<?echo $textarea_w; ?>' rows='<?echo $textarea_h; ?>'><? if (isset($buftext)) {echo $buftext;} else {echo 'V·ö Ël·nok';}?></textarea>
             <? include 'zaoblenie_end.php';?>
        </td>
      </tr>
      <tr>
        <td collspan='2'>
          
        </td>
      </tr>
    
      
      
     
    </table><!--XXX61--->


</td>
<td width=200 valign='top' align='left' >
            <!--======  Pravy panel ================================================   -->    
                     <table width='100%'>  <!--XXX71--->

                     
                     <tr>      
                     <td align =left>
                     
                    <?$sprava_nadpis='';
                      include 'zaoblenie_start.php';
                      
            /*
            Pravy panel kde su klikacie obrazky alebo vysvetlivky 
            
            
            */
                      
                          if( $viev=='obr'){
                              if ($order=='vyraz'){$order='id';}      
                                  
                                  
                                  
                                    /*
                                    |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                                    ||||||||||||||||||||||KLIKACIE OBRAZKY|||||||||||||||||||||||||||||||||||||||
                                    |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                                    */
                                    
                                     
                                    $sql2="obrazok";
                                    /*
                                    nutne parametre :
                                    count_na_table($prvy,$druhy, $tabulka);
                                    $prvy  - pocet riadkou pre na ktorych sa zobrazia zaznamy (kolko riadkou sa ma zobrazit)
                                    $druhy  - ktora tabulka sa zobrazuje, teda tabulka zo zaznamu od 0 -15 alebo od 15 do 30...
                                    $tabulka  -sql nazov tabulky napr: 'clanok' "; 
                                    */
                                    $pole= count_na_table($riadky_na_tabulku_pc,$tab, $sql2);
                                    
                                    
                                    $counter= $pole[0];
                                    
                                    $sql_min= $pole[1];
                                    
                                    $sql_max= $pole[2];
                                    $kolko_krat= $pole[3];
                                   
                                                                        
                                  $sql_obr ="SELECT * FROM obrazok ORDER BY ". $order. " ". $asc."  LIMIT ". $sql_min ." , ".$sql_max." ; ";                 
                                   
                                    $sql_3= mysql_query ( $sql_obr ) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
                                            echo"<table width='100% '>";
                                    while ($extraction = mysql_fetch_array( $sql_3 ))
                                                                                                  {
                                     extract( $extraction );
                                                         ?>  
                                                            
                                                            <tr>
                                                              <td align=center><a href="#" onclick="vlozbb('[myimg=<? echo $id;?>.jpg]'); return false;">
                                                              <img alt='<?echo $popis ;?>' src='imggalery/miniatury/<?echo $id;?>.jpg'></a> 
                                                        
                                                            </tr>
                                                           
                                                           <?
                                                                                                 }
                                            echo"</table>";                                                     
                                    
                                           }
                           
                            elseif ($viev=='expl')
                            
                            {
                                    
                                    /*
                                    |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                                    ||||||||||||||||||||||KLIKACIE vyrazy||||||||||||||||||||||||||||||||||||||||
                                    |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                                    */
                                    
                                    
                                    
                                    
                                    $sql4="expl";
                                    /*
                                    nutne parametre :
                                    count_na_table($prvy,$druhy, $tabulka);
                                    $prvy  - pocet riadkou pre na ktorych sa zobrazia zaznamy (kolko riadkou sa ma zobrazit)
                                    $druhy  - ktora tabulka sa zobrazuje, teda tabulka zo zaznamu od 0 -15 alebo od 15 do 30...
                                    $tabulka  -sql nazov tabulky napr: 'clanok' "; 
                                    */
                                    
                                    
                                    $pole= count_na_table($riadky_na_tabulku_pc*2,$tab, $sql4);
                                   
                                    
                                         $counter= $pole[0];
                                    
                                         $sql_min= $pole[1];
                                    
                                         $sql_max= $pole[2];
                                         
                                         
                                         
                                         $kolko_krat= $pole[3];  
                                                   
                                         
                                                                      
                                    $sql_5="SELECT * FROM expl ORDER BY ". $order. " ". $asc."  LIMIT ". $sql_min ." , ".$sql_max." ; ";                 
                                                                        
                                     $sql_6=mysql_query ($sql_5)or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);                                   
                                    
                                            echo"<table width='100%'>";
                                    while ($extraction = mysql_fetch_array( $sql_6 ))
                                                                                                  {
                                     extract( $extraction );
                                     
                                                                    /*Vyrazy */
                                                                       ?>      
                                                                        
                                                                            <tr>
                                                                              <td align=left><a href="#" onclick="vlozbb('[vysvet=<? echo $id;?>]<?echo $vyraz ;?>[/vysvet]'); return false;">
                                                                              <?echo $vyraz ;?></a> <hr>
                                                                     
                                                                            </tr>
                                                                           
                                                                        <?
                                                                                                      }
                                            echo"</table>";                                                          
                          }
                          include 'zaoblenie_end.php';
                          ?>
                          </td>
                          </tr>
                          </table> <!----xx71---->
                                                                
                       

</td>
</tr>

  <tr> 
  <td> 
        <table width ='100%'><!---xxx91--->
        <tr>
        <td>
           <input class='button_all' type='submit' name=finalsubmit value='Uk·û Ëlanok'>
        </td>
         
        <td align='right'>
          <input class='button_all' type='submit' name=bufsubmit value='Uloûiù medzi rozpÌsanÈ'>
        </td>
        </tr>
        </table><!--xxx91-->
  </td>     
  <td >
                            <?
                          
                                                                         
                                            /*Tlacitka na dalsie strany */
                                      
                                      
                                      
                                      
                        /*
                        Upozornenie autora !!! ak nechces prist o nervy a o zdravie nebabri do tochto!!!!!!!
                        
                        */               
                        echo "<table border = 0 align= right><tr><!--XXx999-->";               
                        if (isset ($tab) and $tab>3)
                       {
                        
                        
                        $zacni=$tab-2;
                        $skonci=$tab+2;
                        
                        /*ak je dosiahnuty koniec, posledne cislo. Inak by to slo do nekonecna klikat*/  
                       
                       
                       
                       
                        
                         
                        if (($tab+2)>$kolko_krat)
                        {
                         $qqq=($tab+2)-$kolko_krat;
                         $zacni=$zacni-$qqq;     /*chcem sa vyhnut ovplyvneniu hodnoty tab!!!!*/  
                         $skonci=$skonci-$qqq;   /*chcem sa vyhnut ovplyvneniu hodnoty tab!!!!*/  
                        }
                                      
                                      
                                    
                                        for ($cc=$zacni;$cc<=$skonci;$cc++)
                                        {
                                        ?>
                                        <td><input class='input_num'  type='submit' name='tab' value='<?echo $cc?>'></td>
                                        <?
                                        
                                        }
                                      
                          
                          }
                        else
                         { 
                         
                            if ($kolko_krat>5){$zobrazzz=5;} else {$zobrazzz=$kolko_krat;}
                               for ($cc=1; $cc<=$zobrazzz; $cc++)
                                {
                                ?>
                                        <td><input class='input_num'  type='submit' name='tab' value='<?echo $cc?>'></td>
                                 <?
                                }
                        }   
                           
                            echo "</tr></table><!--XXx999-->";
                      ?>
  </td>
  </tr>



</table><!--XXX21--->
</form>
<br>
<?
/****************Litle silver info**************************************************/
/**/
/**/if (isset($zobraz_litle_silver_info) and $zobraz_litle_silver_info==1  ){
/**/  
/**/
/**/if (isset($edit))
/**/      {$xx[0]="Upravujete Ëlanok s identifik·torom '<b>$edit</b>'.";}
/**/
/**/if (isset ($buf))
/**/      { $xx[1]= "BUF ËÌslo Ël·nku je '<b>$buf.</b>' "; }
/**/else  { $xx[1]= "Vytv·ra sa Ëist˝ Ël·nok, hodnota BUF nieje nastaven·. ";}
/**/       
/**/if (isset ($id_sekcia)and $id_sekcia==125)
/**/      { $xx[2]= "Sekcia eöte st·le nieje zvolena! Nebudete mÙcù Ël·nok pridaù.";}
/**/elseif (isset ( $id_sekcia) and $id_sekcia!=125 )
/**/      { $xx[2]= "»l·nok bude v sekcii s identifikatorom '<b>$id_sekcia</b>'. "; } 
/**/
/**/$xx[3]= "Na pravom klikaciom panely si prezer·te ";
/**/
/**/if ($viev == 'expl') {$xx[4]= "<b>vysvetlivky</b> ";}
/**/else                 {$xx[4]= "<b>obr·zky</b> ";}
/**/if ($asc == 'ASC') {$xx[5]= "v <b>norm·lnom</b> poradÌ, ";}
/**/else                 {$xx[5]= "v <b>obr·tenom</b> poradÌ, ";}


/**/$xx[6]= "a ich celkov˝ poËet v datab·ze je <b>$pole[0]</b>. Vi mÙûete vidieù z·znamy od <b>$pole[1]</b> po <b>".$alibaba=$pole[2]+$pole[1]."</b>. ";
/**/
/**/if ($pole[3]>1) {$xx[7]= "Pre zobrazenie ÔaæöÌch kliknite na Ëisla pod obrazkami. ∆Ìsla s˙ od <b>1</b> po <b>$pole[3]</b> ";}
/**/$zobraz_silver_info= implode ('', $xx);
/**/                                               }
/***********************************************************************************/
?>

