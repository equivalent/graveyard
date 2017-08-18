<?php


if (!isset($riadky_na_tabulku)) {$riadky_na_tabulku=15;}

if ( isset($_SESSION['moje_heslo'])) { $HREBALL_ism=$_SESSION['moje_user']; }

if (! isset($asc)){ $asc='ASC'; }
 
if (! isset($order) ) {$order="user"; }

if (! isset($tab) ) {$tab=1; }

$pole= count_na_table($riadky_na_tabulku,$tab, 'profil');

$counter=    $pole[0];
$sql_min=    $pole[1];
$sql_max=    $pole[2];
$kolko_krat= $pole[3];


?>



<table height = 70% align='center' border=0 cellpadding='<?echo $vnutro_stranky;?>'  cellspacing='<?echo $vnutro_stranky;?>'>
<tr><!--spacer----><td height='<?echo ($vnutro_stranky*2);?>'><img src='bg/spacer.gif' border=0>
<tr>
<td valign=top>

<table >
<? 
if (isset ($delele)) {
echo "<tr>";
echo "<td colspan =2 align='center' valign=top>";
              $sprava_nadpis="";
              include 'zaoblenie_start.php';
                   echo "<p class='txtnadpis'>Uživate¾ odaktivovaný</p>";  
              include 'zaoblenie_end.php';       
                    }
?>

<tr>
<td align='center' valign=top>  <!----sp5588--->      
              <?

              
              $sprava_nadpis="Poèet registrovaných: $counter";
              include 'zaoblenie_start.php';
              ?>
            
            
            <table class='table' ><!---uuu11--->
              <tr>
                <td class='tdu'>Užívate¾   
                <td class='tdu'>Status   
                <td class='tdu'>E mail
                <td class='tdu'>Dátum registrácie
                
                <td class='tdu'>Profil   
              </tr>
              
<?

 $SQL="SELECT  p.is_active, p.user, p.prava, p. datum, p.id, p.email, ".
 "p.zverej_email FROM profil p ORDER BY ". $order. " ". $asc ." LIMIT ". $sql_min ." , ".$sql_max." ; ";                                         
  $spust_sql1= mysql_query ( $SQL ) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);                                  
                                             
               while ($extraction = mysql_fetch_array( $spust_sql1 ))
                                              {
                                             extract( $extraction );                                             
                                                   echo " <tr> ";  
                                                     
                                                     if ( isset($oznac) and $oznac==$id ){echo " <td class='tdo'> ";} else {echo " <td class='tdt'> ";  }
                                                     if ($is_active==0 ){echo "<s>";}
                                                     echo "$user"; 
                                                     if ($is_active==0 ){echo "</s>";}
                                                     echo " </td> ";
                                                      
                                                     if ( isset($oznac) and $oznac==$id ){echo " <td class='tdo'> ";} else {echo " <td class='tdt'> ";  }
                                                        if  ($prava == 0){$prave="<s>ZMAZANÝ</s>";}
                                                        if  ($prava == 2){$prave="Pisate¾";}
                                                        if  ($prava == 3){$prave="<font color='green'>Moderator</font>";}
                                                        if  ($prava == 4){$prave="<font color='blue'>Strážca</font>";}
                                                        if  ($prava == 5){$prave="<font color='red'>Administrátor</font>";}
                                                    
                                                    echo "$prave"; 
                                                     echo " </td> ";
                                                      
                                                     if ( isset($oznac) and $oznac==$id ){echo " <td class='tdo'> ";} else {echo " <td class='tdh'> ";  }
                                                     if ($zverej_email==1) {echo "$email";} else {echo "NEZVEREJNENÝ";} 
                                                     echo " </td> ";                                               
           
                                                     if ( isset($oznac) and $oznac==$id ){echo " <td class='tdo'> ";} else {echo " <td class='tdt'> ";  }
                                                     echo "$datum "; 
                                                     echo " </td> "; 
                                                        
                                                     if ( isset($oznac) and $oznac==$id ){echo " <td class='tdo'> ";} else {echo " <td class='tdt'> ";  }
                                                     echo "<a href=\"celyprofil.php?id=$id";
                                                        if (isset ($HREBALL_ism) ) {echo "&HREBALL_ism=$HREBALL_ism";}
                                                        echo "\"><img src='bg/wiwe.gif' width='27' height='18'></a>"; 
                                                     echo " </td> ";
          
        
                                             
                                             }
                    ?>                         
                   </table>                          
                  <?include 'zaoblenie_end.php';?>                           
                                             
 </table>                                           
<td valign=top>
      
      
      
      <table>
              <td valign='top'>
                       
            
            <?$sprava_nadpis='Zoradenie';
            include 'zaoblenie_start.php';?>            
            <table
            <tr>
            
            <td>                                       

               <form method='get' action='index.php' >
          <?  if (isset( $_SESSION['moje_user'])){?>
                <input  type='hidden' name='adminaction' value='profil'>
                <input  type='hidden' name='action' value='admin'>
                                                                               <?}
                                                                               
              else {?><input  type='hidden' name='action' value='profil'><?}?>
                                                                                           
                <input  type='hidden' name='tab' value='<? if(isset($tab)) {echo $tab;} else echo "1";?> '>
                <?if(isset($oznac)) {echo " <input type='hidden' name='oznac' value='$oznac'>";}?>
              <table><!---AZZZ123--->
                  <tr>
                  <td center> <p class='txtsprava'>Zoraï pod¾a:</p>
                  <tr>
                  <td center>
                                                  <select name='order' size='1' class='select' style='width:100px;'>
                                                    <option class='option' value='id' <? if(isset($order) and $order=='id' ){echo "selected";} ?> >Id          
                                                    <option class='option' value='datum' <? if(isset($order) and $order=='datum' ){echo "selected";} ?> >Datumu
                                                    <option class='option' value='user' <? if(isset($order) and $order=='user' ){echo "selected";} ?> >Abecedy        
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
                   if (isset( $_SESSION['moje_user']) && $_SESSION['moje_user'] != ""){
                   $sprava_strany="<a href='index.php?action=admin&adminaction=profil&order=".$order."&asc=".$asc.$_oznac_retazec."";
                                                                                        }
                    else      { $sprava_strany="<a href='index.php?action=profil&order=".$order."&asc=".$asc.$_oznac_retazec."";}                                                                                   
                  include 'strany.php';                  
                  include 'zaoblenie_end.php';
                  ?>
                  <!----------------------end--STRANY------------------------------>   
        </td>                                    
   </table>




<tr><!--spacer----><td height='<?echo ($vnutro_stranky*2);?>'><img src='bg/spacer.gif' border=0>
</table>                                          
                                             
                                             
                                             
                                             
                                             
                                             
