<?php
include 'spojenie_s_db.php';
//print_r($_GET);
/*
foreach ( $_GET as $kluc => $hodnota){
$$kluc= $hodnota;
    }
*/
        //        $hladaj_ma=$_GET['hladaj_ma'];
        //        $typ=$_GET['typ'];
if (! isset($order) ) {$order="id"; }
if(!isset($asc)) {$asc='ASC';}
if(!isset($tab)) {$tab='1';}
if(!isset($typ)) {$typ='all';}
if(isset($hladaj_ma) and strlen($hladaj_ma)>50 ) {die ('Prekrocili ste 50 znakov vo vyhladavani.');}




if (isset($hladaj_ma) ){


$riadky_na_tabulku=20;

        /*vyhladavac */

        if (isset($typ) );
        $hladaj_ma=$_GET['hladaj_ma'];
        Switch ($typ)
        {
        
      
        
        
        case 'expl':


if ($order =='my_nazov'){ $order =='vyraz';}
elseif ($order =='my_datum'){ $order =='datum';}
else { $order =='id';}

        $kolko="
        SELECT COUNT(id) 
        FROM expl
        WHERE vyraz LIKE CONVERT( _utf8 '%$hladaj_ma%'
        USING $sql_kodovanie_using )
        COLLATE $sql_kodovanie
        OR vysvetlenie LIKE CONVERT( _utf8 '%$hladaj_ma%'
        USING $sql_kodovanie_using )
        COLLATE $sql_kodovanie
        LIMIT 0 , 30
        ";
       
        $sql_kolko= mysql_query($kolko) or die ("Ospravldlnujeme sa, zlyhala databáza");
            $vysledok_kolko= mysql_fetch_array($sql_kolko);
            $vysledok_kolko=$vysledok_kolko[0];
            
            
            
           $counter=$vysledok_kolko;
    
            
               $kolko_krat=$counter/$riadky_na_tabulku;  
               $kolko_krat= ceil($kolko_krat);
            if ( ! $tab<1){
            $sql_min= ($riadky_na_tabulku * $tab)-$riadky_na_tabulku;
                          }
            else 
            {
            $sql_min= 0;
            }
           
           $sql_max=$riadky_na_tabulku;
       
       
        $select="
        SELECT e.id AS my_id, e.vyraz AS my_nazov, e.datum AS my_datum, p.user AS my_autor
        FROM expl e
        JOIN autor_v ae
        ON (e.id= ae.id_expl)
        JOIN profil p
        ON (ae.id_usera= p.id)
        WHERE vyraz LIKE CONVERT( _utf8 '%$hladaj_ma%'
        USING $sql_kodovanie_using )
        COLLATE $sql_kodovanie
        OR
        vysvetlenie LIKE CONVERT( _utf8 '%$hladaj_ma%'
        USING $sql_kodovanie_using )
        COLLATE $sql_kodovanie
        
        ORDER BY  e.$order  $asc  LIMIT $sql_min, $sql_max
        ";

        
        
        $hrefhref='pop.php?id=';


        $este_nieco_dodat=" onClick=\"JavaScript: newWindow = openWin( 'pop.php?id=";
        $este_nieco_dodat2="', 'Profile', 'width=$popups,height=$popupv,toolbar=0,location=0,directories=0,status=0,menuBar=0,scrollBars=auto,resizable=1' ); newWindow.focus(); return false;\"";

        
        
        break;
        
        default:
        /*case 'all':*/

        $kolko="
        SELECT COUNT(id) 
        FROM clanok
        WHERE clanazov LIKE CONVERT( _utf8 '%$hladaj_ma%'
        USING $sql_kodovanie_using )
        COLLATE $sql_kodovanie
        OR clatext LIKE CONVERT( _utf8 '%$hladaj_ma%'
        USING $sql_kodovanie_using )
        COLLATE $sql_kodovanie
        LIMIT 0 , 30
        ";
            $sql_kolko= mysql_query($kolko) or die ("Ospravldlnujeme sa, zlyhala databáza");
            $vysledok_kolko= mysql_fetch_array($sql_kolko);
            $vysledok_kolko=$vysledok_kolko[0];
             

           $counter=$vysledok_kolko;
    
          
               $kolko_krat=$counter/$riadky_na_tabulku;  
               $kolko_krat= ceil($kolko_krat);
            if ( ! $tab<1){
            $sql_min= ($riadky_na_tabulku * $tab)-$riadky_na_tabulku;
            }
            else 
            {
            $sql_min= 0;
            }
           $sql_max=$riadky_na_tabulku;


        $select="
        SELECT c.id AS my_id, c.clanazov AS my_nazov, c.cladatum AS my_datum, p.user AS my_autor
        FROM clanok c
        JOIN autor_c ac
        ON (c.id= ac.id_clanku)
        JOIN profil p
        ON (ac.id_usera= p.id)
        WHERE clanazov LIKE CONVERT( _utf8 '%$hladaj_ma%'
        USING $sql_kodovanie_using )
        COLLATE $sql_kodovanie
        OR clatext LIKE CONVERT( _utf8 '%$hladaj_ma%'
        USING $sql_kodovanie_using )
        COLLATE $sql_kodovanie
        
        ORDER BY  c.$order  $asc  LIMIT $sql_min, $sql_max
        ";
        

        
        $este_nieco_dodat="";
        $este_nieco_dodat2="";
        
        if ($hladaj_ma==""){$hrefhref="index.php?&clanok=";}
        
        else {$hrefhref="index.php?oznac_qnajdeny=$hladaj_ma&clanok=";}
        
        
        break;
        
        }








}
?>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
<title>Historia Linuxu - vyh¾adavanie</title>
<link rel="stylesheet" href="main.css">
</head>
<body bgcolor='fffefb'>
<table border=0 cellpadding='<?echo $vnutro_stranky;?>'  cellspacing='<?echo $vnutro_stranky;?>'>
<tr>
<td valign=top>

  <? if (isset($hladaj_ma) ){?>
                  <table>
                  <tr>
                  <td valign=top>
                    <?$sprava_nadpis="Poèet nájdených: $vysledok_kolko";?>
                    <? include 'zaoblenie_start.php';?>
                   <table align=center class='table'>
                                                                     
                    <?
                    $sql_vvn= mysql_query($select) or die ("Ospravldlnujeme sa, zlyhala databáza");
                    if (! mysql_num_rows($sql_vvn)){ echo "neexistuje"; }
                    
                    else
                    {?>
                       <tr>
                                    <td class='tdu'>Názov 
                                    <td class='tdu'>Autor
                                    <td class='tdu'>Dátum
                                    <td class='tdu'>Ukáž                
                                    
                                  </tr> 
                    <?
                    while($vysledok= mysql_fetch_array($sql_vvn))
                    {
                    extract ($vysledok);
                    
                    ?>
                    <TR><TD class='tdh'><?echo $my_nazov;?>
                        <TD class='tdh'><?echo $my_autor;?>
                        <TD class='tdh'><?echo $my_datum;?>
                        <TD class='tdh'><?
                                            echo "<a href='$hrefhref"; 
                                            echo "$my_id";
                                            echo "'";
                                            if ($este_nieco_dodat!="") {echo "$este_nieco_dodat".$my_id.$este_nieco_dodat2;}
                                            echo ">";
                        ?><img src='bg/wiwe.gif' width='27' height='18'></a>
                        
                    </TR> </TD>
                    
                    <?}
                    }


                  ?></table>
                  <? include 'zaoblenie_end.php';?>
                  </table>
  <?}?>
<td valign=top>
     <table>
                  <tr>
                  <td valign=top>
                    <?$sprava_nadpis="Vyh¾adávanie";?>
                    <? include 'zaoblenie_start.php';?>
                   <table align=center>
                     <tr><td colspan=3>
                        <form method='get' action='index.php'>
                              <input type=hidden name='action' value='hladaj'>
                              
                              <input type='text' maxlength=50 name='hladaj_ma' class='form_all' size=25>
                      <tr><td valign='bottom'><table>
                                              <tr><td>
                                              <font size=-1><b>Èlánky</b></font><td><input class='select_all' name='typ' value='all' <? if(isset($typ) and $typ=='all' ){echo "checked";} ?> type="radio">
                                              <tr><td>
                                              <font size=-1><b>Vysvetlivky</b></font><td><input class='select_all' name='typ' value='expl' <? if(isset($typ) and $typ=='expl' ){echo "checked";} ?> type="radio">
                                              <tr><td>
                                             
                                              <input type='submit' value='H¾adaj' class='button_all'>
                                              </table>
                          </td>
                          <td><img src='bg/babytux.jpg' alt='tux' border=0>
                         
                         
                         </form>   
                   </table>
                    <? include 'zaoblenie_end.php';?>
                    
   <?if(isset($hladaj_ma)) {?>                      
 <tr><!--spacer----><td height='<?echo ($vnutro_stranky*2);?>'><img src='bg/spacer.gif' border=0> 
 
 
 
 
 
 
 
 
    
          <tr><!---555658-->
            <td valign=top>
      
            <?$sprava_nadpis='Zoradenie';
            include 'zaoblenie_start.php';?>            
            <table><!----rrttyy--->
            <tr>
            
            <td>
              <form method='get' action='index.php' >
                                                          
            
              <input type='hidden' name='action' value='hladaj'>
              <input  type='hidden' name='tab' value='<? if(isset($tab)) {echo $tab;} else echo "1";?> '>
              
              <?
              if(isset($typ)) {echo " <input type='hidden' name='typ' value='$typ'>";}
              if(isset($hladaj_ma)) {echo " <input type='hidden' name='hladaj_ma' value='$hladaj_ma'>";}
              ?>
                         <table><!---AZZZ123--->
                            <tr>
                            <td center> <p class='txtsprava'>Zoraï pod¾a:</p>
                            <tr>
                            <td center>  
                               
                                <? if(isset($typ) AND $typ=='expl'){?>
                                <select name='order' size='1' class='select' style='width:100px;'>
                                  <option class='option' value='vyraz' <? if(isset($order) and $order=='my_nazov' ){echo "selected";} ?> >Názvu
                                  <option class='option' value='datum' <? if(isset($order) and $order=='my_datum' ){echo "selected";} ?> >Datumu
                                  <option class='option' value='id' <? if(isset($order) and $order=='my_id' ){echo "selected";} ?> >Poradia         
                                </select>
                                <?}
                               
                               else {?>
                                <select name='order' size='1' class='select' style='width:100px;'>
                                  <option class='option' value='clanazov' <? if(isset($order) and $order=='my_nazov' ){echo "selected";} ?> >Názvu
                                  <option class='option' value='cladatum' <? if(isset($order) and $order=='my_datum' ){echo "selected";} ?> >Datumu
                                  <option class='option' value='id' <? if(isset($order) and $order=='my_id' ){echo "selected";} ?> >Poradia         
                                </select>
                               <?}?>
                               

                            <tr>
                            <td center> <p class='txtsprava'>Poradie:</p>
                            <tr>
                            <td center>                      
                                
                          <select name='asc' size='1' class='select' style='width: 100px';>
                            <option class='option' value='ASC' <? if(isset($asc) and $asc=='ASC' ){echo "selected";} ?> >Normlalne
                            <option class='option' value='DESC' <? if(isset($asc) and $asc=='DESC' ){echo "selected";} ?> >Obrátene
                             
                            </td>
                            </tr>
                            <tr><td height=2>
                            <tr>
                            <td align='center'>
                            <input  class='button_all' type="submit" value='Zobraz'>
                            </td>
                            </tr>
                        </table><!---AZZZ123--->
              </form>
            </td>  
            
            
            <td>
            
            
            </tr>
            </table><!----rrttyy--->
            
            
             
            <?
             include 'zaoblenie_end.php';
            ?>
    

     
   <tr><!--spacer----><td height='<?echo ($vnutro_stranky*2);?>'><img src='bg/spacer.gif' border=0>
             <tr>
            
            <td>   
     

     
     
     
     
     
     
     
           
                <!---------------------------STRANY------------------------------>
                 
                  <?
                 
                
                  $sprava_nadpis='Strany';
                 
                  
                  include 'zaoblenie_start.php';
                  $sprava_strany="<a href='index.php?action=hladaj&hladaj_ma=$hladaj_ma&typ=$typ&order=".$order."&asc=".$asc."";                  
                  include 'strany.php';                  
                  include 'zaoblenie_end.php';
                  ?>
                  <!----------------------end--STRANY------------------------------>



           <td>     

       
<?}?>          
    
</table><!---cx658-->                    

     </table>                    
</table>
</body>
</html>                  
