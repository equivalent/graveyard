<?php
include 'autorizacia.php';
/*
include 'funkcie.php';
include 'spojenie_s_db.php';
include 'cs.php';


*/


foreach ( $_GET as $kluc => $hodnota){
$$kluc= $hodnota;
    }
/*
ziskam volby 
        $order
        $asc
        $tab
        pripadne $oznac
                  
*/


if (! isset($asc)){ $asc='ASC'; }
if (! isset($tab) ) {$tab=1; }

if (! isset($order) ) {$order="bufnazov"; }


$sql2='buffer';


$pole= count_na_table_x ($riadky_na_tabulku,$tab, $sql2, $TTmoje_id); 
/*edituj buf nepouziva sql_zaciatok.php, kazdy ma vlasne rospisane clanky, do ktorych nikoho nic*/


$counter=    $pole[0];
$sql_min=    $pole[1];
$sql_max=    $pole[2];
$kolko_krat= $pole[3];





 $sql_b="SELECT b.id, b.bufnazov, b.datum FROM buffer b JOIN autor_b ab ON ( b.id = ab.id_bufferu ) WHERE ab.id_usera= $TTmoje_id  ORDER BY ". $order. " ". $asc ." LIMIT ". $sql_min ." , ".$sql_max."";



$spust_sql1= mysql_query ( $sql_b ) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);



?>
<table align='center' border=0 cellpadding='<?echo $vnutro_stranky;?>'  cellspacing='<?echo $vnutro_stranky;?>'>
    <tr>
    <td valign=top>        
              <?
              
              
              
              if ($counter==0) {
              $sprava_nadpis='Nexistuju ziadne rozpisané èlanky';
              include 'zaoblenie_start.php';
              include 'zaoblenie_end.php';

              
              }             
              else {
              
              $sprava_nadpis="Poèet rozpísaných èlánkov: $counter";
              include 'zaoblenie_start.php';
              ?>
            
            
            <table class='table' ><!---uuu11--->
              <tr>
                <td class='tdu' width='100'>Názov 
                
                <td class='tdu'>Dátum pridania
                <td class='tdu'>Uprav
                <td class='tdu'>Zmaž
              </tr>

<?




               while ($extraction = mysql_fetch_array( $spust_sql1 ))
                                              {
                                             extract( $extraction );  
                                             
                                             $coco="buffer";
                                             $hrefer="delete_pop_up.php?co=$coco&id=$id"; 
                                             $kreper=  "onClick=\"JavaScript: newWindow = openWin( '$hrefer', 'Profile',".
                                                       "'width=500,height=200,toolbar=0,location=0,directories=0,".
                                                       "status=0,menuBar=0,scrollBars=auto,resizable=0' ); newWindow.focus(); return false;\"";
                                                       $greper="<a href='$hrefer' $kreper>";
                                             
                                             
                                             echo " <tr> ";
                                             
                                             echo " <td class='tdh'> ";
                                             echo " $bufnazov "; 
                                             echo " </td> ";
                                             
                                               
              
                                             echo " <td class='tdt'> ";
                                             echo " $datum "; 
                                             echo " </td> ";
                                             
                                             echo " <td  class='tdt'  >";
                                             echo " <a href='index.php?action=admin&adminaction=pridajclanok&buf=$id'><img src='bg/edit.gif' border=0 width='27' height='18'></a>";
                                             echo " </td> "; 
              
                                             echo " <td class='tdt'> ";
                                             echo "$greper"."<img src='bg/delete.gif' width='27' height='18'></a>";
                                             echo " </td> ";
                                                                            
                                             echo " </tr> ";     
                                               }
                                             
              
              ?>
              </table><!---uuu11--->
              <?include 'zaoblenie_end.php';?>
</td>
      
 <td valign='top'> 





     <table > <!---cx658-->      
    <tr><!---555658-->
      <td valign=top>
                       
            
            <?$sprava_nadpis='Zoradenie';
            include 'zaoblenie_start.php';?>            
            <table
            <tr>
            
            <td>
              <form method='get' action='index.php' >
                                                          
              <input type='hidden' name='adminaction' value='editujbuf'>
              <input type='hidden' name='action' value='admin'>
              <input  type='hidden' name='tab' value='<? if(isset($tab)) {echo $tab;} else echo "1";?> '>      
  
              

              <table><!---AZZZ123--->
                  <tr>
                  <td center> <p class='txtsprava'>Zoraï pod¾a:</p>
                  <tr>
                  <td center> 
                <select name='order' size='1' class='select' style='width:100px;'>
                  <option class='option' value='bufnazov' <? if(isset($order) and $order=='bufnazov' ){echo "selected";} ?> >Názvu
                  <option class='option' value='datum' <? if(isset($order) and $order=='datum' ){echo "selected";} ?> >Datumu
                  <option class='option' value='id' <? if(isset($order) and $order=='id' ){echo "selected";} ?> >Poradia  
                        
                </select>
                  <tr>
                  <td center> <p class='txtsprava'>Poradie:</p>
                  <tr>
                  <td center>
                <select name='asc' size='1' class='select' style='width:100px;'>
                  <option class='option' value='ASC' <? if(isset($asc) and $asc=='ASC' ){echo "selected";} ?> >Normálne
                  <option class='option' value='DESC' <? if(isset($asc) and $asc=='DESC' ){echo "selected";} ?> >Obrátene
                   
                </select>
                
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
            </tr>
            </table>
            <?
             include 'zaoblenie_end.php';
            ?>
       </td>
       </tr><!---555658-->
         <tr><!--spacer----><td height='<?echo ($vnutro_stranky*2);?>'><img src='bg/spacer.gif' border=0>
    
       <tr><!---trcx658-->
       <td height='100%'><!---huy55--->
                  <!---------------------------STRANY------------------------------>
                  <?$sprava_nadpis='Strany';
                  
                
                  
                  include 'zaoblenie_start.php';
                  $sprava_strany=" <a href='index.php?action=admin&adminaction=editujbuf&order=".$order."&asc=".$asc."";                  
                  include 'strany.php';                  
                  include 'zaoblenie_end.php';
                  ?>
                  <!----------------------end--STRANY------------------------------>
        </td> <!---huy55---> 
        </tr><!---trcx658-->   
        
        
       


</table><!---cx658-->
<?}?>
            


</table>

