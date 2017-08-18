<?
include 'autorizacia.php';
/*
funkcie potrebne pre script
include 'funkcie.php';
include 'spojenie_s_db.php';
include 'id_gether.php';


$TTmoje_id=id_chcem();
$TTmoje_prava=prava_chcem();

su uz v admin.php
*/

//print_r($_GET);


 
if (! isset($order) ) {$order="id"; }




$riadky_na_tabulku=$riadky_na_tabulku/2;

$sql2='obrazok';



include 'edit_inc/sql_zaciatok.php';// tu sa nachadza kopa veci ktore su rovnake pre vsetky edity


if ($TTmoje_prava >2 and $godles==1 ) { $sql_o="SELECT id, popis, datum FROM obrazok ORDER BY ". $order. " ". $asc ." LIMIT ". $sql_min ." , ".$sql_max."" ;} 
else {$sql_o="SELECT o.id, o.popis, o.datum FROM obrazok o JOIN autor_o ao ON ( o.id = ao.id_obr ) WHERE ao.id_usera= $TTmoje_id  ORDER BY ". $order. " ". $asc ." LIMIT ". $sql_min ." , ".$sql_max."";}

 

$sql= mysql_query ($sql_o) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);



?>


 
<table align='center' border=0 cellpadding='<?echo $vnutro_stranky;?>'  cellspacing='<?echo $vnutro_stranky;?>'>
    <tr>
    <td valign=top>        
              <?
              
              
              
              if ($counter==0) 
              {$sprava_nadpis='Nexistuju ziadne obrázky';
              include 'zaoblenie_start.php';
              include 'zaoblenie_end.php';
              
              if($TTmoje_prava >3){
              echo "<td>";
              
              
               $wtf_is_hapenning='editujobrazok';
                      include 'edit_inc/godles.php';
                      }
              
              }
             
              else {
              
              $sprava_nadpis="Poèet obrázkov: $counter";
              include 'zaoblenie_start.php';
              ?> 

             <table class='table' ><!---ZZZ11--->
              <tr>
                <td class='tdu' >Obrázok 
                <td class='tdu'>Popis obrázka
                <td class='tdu'>Dátum pridania
                <td class='tdu'>Rozmer               
                <td class='tdu'>Uprav
                <td class='tdu'>Zmaž
              </tr>



                                <?
                                while ($extraction = mysql_fetch_array( $sql )) 
                                {
                                 extract( $extraction );
                                 
                                             $coco="obrazok";
                                             $hrefer="delete_pop_up.php?co=$coco&id=$id"; 
                                             $kreper=  "onClick=\"JavaScript: newWindow = openWin( '$hrefer', 'Profile',".
                                                       "'width=500,height=200,toolbar=0,location=0,directories=0,".
                                                       "status=0,menuBar=0,scrollBars=auto,resizable=0' ); newWindow.focus(); return false;\"";
                                                       $greper="<a href='$hrefer' $kreper>";                                    
                                 
                                $dlzka_popisu= strlen($popis);
                                if ( $dlzka_popisu > 50 ) {$popis= chunk_split ($popis, 50, '<br>');
                                /*ak je nad urcity pocet znakov vloz <br> */  } 
                                
                                $obrazok ="imggalery/". $id. ".jpg";
                               
                                list( $sirka, $vyska, $typ, $atributy ) = getimagesize( $obrazok );
                                 ?>

              
                                          
                                              <tr>
                                                  <?
                                                     if ( isset($oznac) and $oznac==$id ){echo " <td class='tdo'> ";} else {echo " <td class='tdt'> ";  }
                                                     echo "<img src=\"imggalery/miniatury/$id.jpg\">"; 
                                                     echo " </td> ";
                                                      
                                                     if ( isset($oznac) and $oznac==$id ){echo " <td class='tdo'> ";} else {echo " <td class='tdh'> ";  }
                                                     echo "$popis "; 
                                                     echo " </td> ";                                               
           
                                                     if ( isset($oznac) and $oznac==$id ){echo " <td class='tdo'> ";} else {echo " <td class='tdt'> ";  }
                                                     echo "$datum "; 
                                                     echo " </td> "; 
                                                          
                                                     if ( isset($oznac) and $oznac==$id ){echo " <td class='tdo'> ";} else {echo " <td class='tdt'> ";  }
                                                     echo "$sirka X $vyska"; 
                                                     echo " </td> ";
                                                     
                                                     if ( isset($oznac) and $oznac==$id ){echo " <td class='tdo'> ";} else {echo " <td class='tdt'> ";  }
                                                     echo "<a href=\"ukaz_upload.php?id=$id\"><img src='bg/edit.gif' width='27' height='18'></a>"; 
                                                     echo " </td> ";
          
                                                    if ( isset($oznac) and $oznac==$id ){echo " <td class='tdo'> ";} else {echo " <td class='tdt'> ";  }
                                                    echo "$greper <img src='bg/delete.gif' width='27' height='18'> </a>"; 
                                                    echo " </td> ";                                              
                                                  ?> 
                                              </tr>
                                          <?
                              } /***************** Koniec while ****************/ 
                                          ?>
                                         
             </table><!---ZZZ11--->
                 
            <?include 'zaoblenie_end.php';?>                                        
                                         
       </td>
     
       <td valign=top>        
            
     <table > <!---cx658-->      
    <tr><!---555658-->
      <td valign='top'>
                       
            
            <?$sprava_nadpis='Zoradenie';
            include 'zaoblenie_start.php';?>            
            <table
            <tr>
            
            <td>                                       

               <form method='get' action='index.php' >
                <input  type='hidden' name='adminaction' value='editujobrazok'>
                <input  type='hidden' name='action' value='admin'>
                <input  type='hidden' name='tab' value='<? if(isset($tab)) {echo $tab;} else echo "1";?> '>
                <?if(isset($oznac)) {echo " <input type='hidden' name='oznac' value='$oznac'>";}?>
                <input  type='hidden' name='godles' value='<? echo $godles;?> '>
              <table><!---AZZZ123--->
                  <tr>
                  <td center> <p class='txtsprava'>Zoraï pod¾a:</p>
                  <tr>
                  <td center>
                                                  <select name='order' size='1' class='select' style='width:100px;'>
                                                    <option class='option' value='id' <? if(isset($order) and $order=='id' ){echo "selected";} ?> >Poradia           
                                                    <option class='option' value='datum' <? if(isset($order) and $order=='datum' ){echo "selected";} ?> >Datumu
                                                    <option class='option' value='popis' <? if(isset($order) and $order=='popis' ){echo "selected";} ?> >Komentaru        
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
       <td height='100%'>
                <!---------------------------STRANY------------------------------>
                  <?$sprava_nadpis='Strany';
                 if(isset($oznac)){$_oznac_retazec="&oznac=$oznac";} else{$_oznac_retazec="";}
                 
                  include 'zaoblenie_start.php';
                  $sprava_strany="<a href='index.php?action=admin&adminaction=editujobrazok&order=".$order."&godles=$godles&asc=".$asc.$_oznac_retazec."";
                  include 'strany.php';                  
                  include 'zaoblenie_end.php';
                  ?>
                  <!----------------------end--STRANY------------------------------>
       <td>     
    </tr><!---trcx658-->
    
    
       <?if($TTmoje_prava >2){
   $wtf_is_hapenning='editujobrazok';
                      include 'edit_inc/godles.php';
                      }?>  
    
    
</table><!---cx658-->
<?}?>
</table>                                        
