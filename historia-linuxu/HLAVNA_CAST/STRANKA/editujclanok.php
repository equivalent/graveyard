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




if (! isset($order) ) {$order="clanazov"; }


$sql2="clanok";
include 'edit_inc/sql_zaciatok.php';// tu sa nachadza kopa veci ktore su rovnake pre vsetky edity


if ($TTmoje_prava >3 and $godles==1 )   {  $sql="SELECT e.id,  e.clanazov, s.nazov AS nazovsekcie, e.cladatum FROM clanok e JOIN sekcia_clanok sc JOIN sekcia s ON ( sc.id_clanok= e.id AND s.id=id_sekcia ) ORDER BY ". $order. " ". $asc ." LIMIT ". $sql_min ." , ".$sql_max." ; ";}
else {  $sql="SELECT e.id,  e.clanazov, s.nazov AS nazovsekcie, e.cladatum FROM clanok e JOIN autor_c av JOIN sekcia_clanok sc JOIN sekcia s ON ( e.id = av.id_clanku AND sc.id_clanok= e.id AND s.id=id_sekcia ) WHERE av.id_usera= $TTmoje_id  ORDER BY ". $order. " ". $asc ." LIMIT ". $sql_min ." , ".$sql_max." ; ";}

$spust_sql1= mysql_query ( $sql ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);



/*

$sql="SELECT c.id, c.clanazov, c.cladatum, s.nazov AS nazovsekcie FROM clanok c,".
    " sekcia s, sekcia_clanok sc WHERE sc.id_clanok= c.id AND s.id=id_sekcia ".
    " ORDER BY ". $order. " ". $asc ." LIMIT ". $sql_min ." , ".$sql_max." ; ";

$spust_sql1= mysql_query ( $sql ) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);

*/

/*
$dlzka= strlen($vysvetlivka);
                               if ( $dlzka < 50 ) {echo " $vysvetlivka ";}
                               else { 
                                    $a= chunk_split ($vysvetliv ka, 50, '<br>');
                                    echo $a;
                                    }
*/

?>
<table align='center' border=0 cellpadding='<?echo $vnutro_stranky;?>'  cellspacing='<?echo $vnutro_stranky;?>'>
    <tr>
    <td valign=top>        
              <?
              
              
              
              if ($counter==0) 
              {$sprava_nadpis='Nexistuju ziadne clanky';
              include 'zaoblenie_start.php';
              include 'zaoblenie_end.php';
            
             if($TTmoje_prava >3){
              echo "<td>";
              
              
               $wtf_is_hapenning='editujclanok';
                      include 'edit_inc/godles.php';
                      }            
            
              }
             
              else {
              
              $sprava_nadpis="Poèet èlánkov: $counter";
              include 'zaoblenie_start.php';
              ?>
            
            
            <table class='table' ><!---ZZZ11--->
              <tr>
                <td class='tdu' width='100'>Názov 
                <td class='tdu'>Sekcia
                <td class='tdu'>Dátum pridania
                <td class='tdu'>Uprav
                <td class='tdu'>Zmaž
              </tr>
            
            <?
            
            
             while ($extraction = mysql_fetch_array( $spust_sql1 ))
                                            {
                                           extract( $extraction );  
                                           
                                             $coco="clanok";
                                             $hrefer="delete_pop_up.php?co=$coco&id=$id"; 
                                             $kreper=  "onClick=\"JavaScript: newWindow = openWin( '$hrefer', 'Profile',".
                                                       "'width=500,height=200,toolbar=0,location=0,directories=0,".
                                                       "status=0,menuBar=0,scrollBars=auto,resizable=0' ); newWindow.focus(); return false;\"";
                                                       $greper="<a href='$hrefer' $kreper>";                                           
                                           
                                           
                                           echo " <tr> ";
                                           
                                           /*echo " <td class='tdh'> ";*/  
                                           if ( isset($oznac) and $oznac==$id ){echo " <td class='tdo'> ";} else {echo " <td class='tdh'> ";  }
                                                       
                                           echo " $clanazov "; 
                                           echo " </td> ";
                                           
                                            /*echo " <td class='tdt'> ";*/
                                           if ( isset($oznac) and $oznac==$id ){echo " <td class='tdo'> ";} else {echo " <td class='tdh'> ";  }
                                            
                                           echo " $nazovsekcie";
                                           
                                           /*echo " <td class='tdt'> ";*/
                                           if ( isset($oznac) and $oznac==$id ){echo " <td class='tdo'> ";} else {echo " <td class='tdt'> ";  }
                                            
                                           echo " $cladatum "; 
                                           echo " </td> ";
                                           
                                           /*echo " <td> ";*/
                                           if ( isset($oznac) and $oznac==$id ){echo " <td class='tdo'> ";} else {echo " <td class='tdt'> ";  }
                                           
                                           echo " <a href='index.php?action=admin&adminaction=pridajclanok&edit=$id'><img src='bg/edit.gif' width='27' height='18'> </a>";
                                           echo " </td> "; 
                                            
                                           if ( isset($oznac) and $oznac==$id ){echo " <td class='tdo'> ";} else {echo " <td class='tdt'> ";  }
                                           
                                           echo "$greper <img src='bg/delete.gif' width='27' height='18'> </a>";
                                           echo " </td> "; 
                                           
                                           echo " </tr> ";     
                                             }
                                           
            
            ?>
            </table><!---ZZZ11--->
                 
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
                                                        
            <input type='hidden' name='adminaction' value='editujclanok'>
            <input type='hidden' name='action' value='admin'>
            <input  type='hidden' name='godles' value='<? echo $godles;?> '>
            <input  type='hidden' name='tab' value='<? if(isset($tab)) {echo $tab;} else echo "1";?> '>
            <?if(isset($oznac)) {echo " <input type='hidden' name='oznac' value='$oznac'>";}
                      ?>
            
              <table><!---AZZZ123--->
                  <tr>
                  <td center> <p class='txtsprava'>Zoraï pod¾a:</p>
                  <tr>
                  <td center>
                  <select class='select' name='order' size='1' style='width:100px;'>
                    <option class='option' value='clanazov' <? if(isset($order) and $order=='vyraz' ){echo "selected";} ?> >Názvu
                    <option class='option' value='cladatum' <? if(isset($order) and $order=='cladatum' ){echo "selected";} ?> >Datumu
                    <option class='option' value='id' <? if(isset($order) and $order=='id' ){echo "selected";} ?> >Poradia  
                    <option class='option' value='nazov' <? if(isset($order) and $order=='nazov' ){echo "selected";} ?> >Sekcie      
                  </select>
                  <tr>
                  <td center> <p class='txtsprava'>Poradie:</p>
                  <tr>
                  <td center>
                  <select class='select' name='asc' size='1' style='width:100px;' >
                    <option class='option' value='ASC' <? if(isset($asc) and $asc=='ASC' ){echo "selected";} ?>   >Normlalne
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
       <td height='100%'>
                <!---------------------------STRANY------------------------------>
                  <?$sprava_nadpis='Strany';
                  if(isset($oznac)){$_oznac_retazec="&oznac=$oznac";} else{$_oznac_retazec="";}
                  
                  
                  include 'zaoblenie_start.php';
                  $sprava_strany="<a href='index.php?action=admin&adminaction=editujclanok&order=".$order."&godles=$godles&asc=".$asc.$_oznac_retazec."" ;
                  include 'strany.php';                  
                  include 'zaoblenie_end.php';
                  ?>
                  <!----------------------end--STRANY------------------------------>
       <td>   
       
        
    </tr><!---trcx658-->
     
     
       <?if($TTmoje_prava >2){
   $wtf_is_hapenning='editujclanok';
                      include 'edit_inc/godles.php';
                      }?>  
       
</table><!---cx658-->
<?}?>
</table>
