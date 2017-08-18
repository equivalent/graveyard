<? if ($TTmoje_prava<4) { Die("Je nam æ˙to ale sem nem·te prÌstup. <a href='index.php'><u>PokraËovaù</u></a>;"); }?>
 <? include 'novinky.php'; ?>
 <?
 
         
 foreach ( $_GET as $kluc => $hodnota){
$$kluc= $hodnota;
    }  
 /*zobraz=clanok*/



if($TTmoje_prava<5)  {$mod=2;}
if(!isset($mod) )    {$mod=2;}
if(!isset($zobraz) ) {$zobraz='c';   }


switch ($zobraz)
{
case 'o':
$nazov='popis';
$tabl='obrazok';
$id_identifer='id_obr';
$zobraz_cov='autor_o';  
$dadatum='datum';    
$is_ack='';  
$este_nieco_dodat="";
$este_nieco_dodat2="";
$hrefhref='ukaz_upload.php?id=';





break;

case 'v':
$nazov='vyraz';
$tabl='expl';
$id_identifer='id_expl';
$zobraz_cov='autor_v';  
$dadatum='datum';    
$is_ack='';  

                                    

$hrefhref='pop.php?id=';


$este_nieco_dodat=" onClick=\"JavaScript: newWindow = openWin( 'pop.php?id=";
$este_nieco_dodat2="', 'Profile', 'width=$popups,height=$popupv,toolbar=0,location=0,directories=0,status=0,menuBar=0,scrollBars=auto,resizable=1' ); newWindow.focus(); return false;\"";






break;

case 'c':

$nazov='clanazov';
$tabl='clanok';
$id_identifer='id_clanku';
$zobraz_cov='autor_c';   
$dadatum='cladatum';   
$is_ack='ax.ack AS ack_c_ocv,';  

$este_nieco_dodat="";
$este_nieco_dodat2="";

$hrefhref="index.php?clanok=";





break;
}

if (isset ($wiewack) and $wiewack==1 )
{
$spust_sql_="SELECT x.id AS id_ocv, p.user AS user_ocv, x.$nazov AS nazov_ocv, $is_ack x.$dadatum AS datum_ocv FROM $tabl x JOIN $zobraz_cov ax JOIN profil p ON ( x.id = ax.$id_identifer AND p.id=ax.id_usera ) WHERE ax.ack=0";
}

else {
 $spust_sql_="SELECT x.id AS id_ocv, p.user AS user_ocv, x.$nazov AS nazov_ocv, $is_ack x.$dadatum AS datum_ocv FROM $tabl x JOIN $zobraz_cov ax JOIN profil p ON ( x.id = ax.$id_identifer AND p.id=ax.id_usera ) WHERE ax.new= $mod";
     }
$spust_sql_post= mysql_query ( $spust_sql_ ) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);



 ?>

<table width=100%>
<tr>
<td align='center' valign='top'>
          <table align='center' border=0 cellpadding='<?echo $vnutro_stranky;?>'  cellspacing='<?echo $vnutro_stranky;?>'>
          <tr>
          <td align='center' valign='top'>
              <table>
                <tr>
                <td align='center'>
                  <?  $sprava_nadpis='';/*tato premenna je vlasne nadpis tabulky*/
                    include 'zaoblenie_start.php';  ?>
                      
                        <table cellpadding=3 class='table'>
                          <?if ($TTmoje_prava==5) {?><tr> <td colspan=3> <font color='orange'>PISATELIA</font><?}?>
                          <tr> <td> <b>NovÈ Ël·nky</b> <td><?echo $count_new_c;?>      <td><a href='index.php?action=admin&adminaction=news&zobraz=c&mod=2'><img src='bg/wiwe.gif' width='27' height='18'></a></tr> 
                          <tr> <td> <b>NovÈ vysvetlivky</b> <td><?echo $count_new_v;?> <td><a href='index.php?action=admin&adminaction=news&zobraz=v&mod=2'><img src='bg/wiwe.gif' width='27' height='18'></a></tr> 
                          <tr> <td> <b>NovÈ obr·zky</b> <td><?echo $count_new_o;?>     <td><a href='index.php?action=admin&adminaction=news&zobraz=o&mod=2'><img src='bg/wiwe.gif' width='27' height='18'></a></tr>                 
<? if ($count_ack_c>0){?> <tr> <td colspan=3> <a href='index.php?action=admin&adminaction=news&zobraz=c&mod=1&wiewack=1'><font color=red size=-1><u>V datab·ze s˙ neodakceptovanÈ Ël·nky!</u></font></a></tr><?}?>                                          
                          <?if ($TTmoje_prava==5) {?>
                          <tr> <td colspan=3> <hr></tr> 
                          <tr> <td colspan=3> <font color='blue'>STR¡éCOVIA</font> a <font color='green'>MODER¡TORI</font></tr> 
                          <tr> <td> <b>NovÈ Ël·nky</b> <td><?echo $count_new_ac;?>      <td><a href='index.php?action=admin&adminaction=news&zobraz=c&mod=1'><img src='bg/wiwe.gif' width='27' height='18'></a></tr> 
                          <tr> <td> <b>NovÈ vysvetlivky</b> <td><?echo $count_new_av;?> <td><a href='index.php?action=admin&adminaction=news&zobraz=v&mod=1'><img src='bg/wiwe.gif' width='27' height='18'></a></tr> 
                          <tr> <td> <b>NovÈ obr·zky</b> <td><?echo $count_new_ao;?>     <td><a href='index.php?action=admin&adminaction=news&zobraz=o&mod=1'><img src='bg/wiwe.gif' width='27' height='18'></a></tr>                 
                          <tr> <td colspan=3>  <hr></tr> 
                          <tr> <td colspan=3> <font color='brown'>UPRAVEN…</font></tr> 
                          <tr> <td> <b>UpravenÈ Ël·nky</b> <td><?echo $count_new_uc;?>  <td><a href='index.php?action=admin&adminaction=news&zobraz=c&mod=3'><img src='bg/wiwe.gif' width='27' height='18'></a></tr>
                          <tr> <td> <b>UpravenÈ vysvetlivky</b> <td><?echo $count_new_uv;?>  <td><a href='index.php?action=admin&adminaction=news&zobraz=v&mod=3'><img src='bg/wiwe.gif' width='27' height='18'></a></tr> 
                          <tr> <td> <b>UpravenÈ obr·zky</b> <td><?echo $count_new_uo;?>  <td><a href='index.php?action=admin&adminaction=news&zobraz=o&mod=3'><img src='bg/wiwe.gif' width='27' height='18'></a></tr>  
                          </tr>                
                          <?}?>
                        </table>  
                           
                      <? include 'zaoblenie_end.php';?>             
                </td>
          
              </table>
          
          
      <td valign='top'>
          <table>
            <tr>
            <td align='center'>
              <?  $sprava_nadpis='';/*tato premenna je vlasne nadpis tabulky*/
                include 'zaoblenie_start.php';  ?>
                  
                  <table class='table' ><!---uuu11--->
                    <tr>
                      <td class='tdu'>Uûivateæ 
                      <td class='tdu'>N·zov 
                      <td class='tdu'>D·tum
                      <td class='tdu'>Uk·û 
                                  
                      
                    </tr> 
                    
                    <? while ($extraction = mysql_fetch_array( $spust_sql_post ))
                                {
                               extract( $extraction );  
                               if ($nazov_ocv==""){$nazov_ocv='NEUVEDEN›';}
                     echo " <tr> ";
                    echo " <td class='tdt'> ";
                    echo " $user_ocv "; 
                    echo " </td> ";
                    
                    echo " <td class='tdt'> "; 
                    echo " $nazov_ocv "; 
                    echo " </td> ";
                                                           
                    echo " <td class='tdt'> ";
                    echo " $datum_ocv"; 
                    echo " </td> ";
                                                            
                    echo " <td class='tdt'> ";
                   
                    echo "<a href='$hrefhref"; 
                    echo "$id_ocv";
                    echo "'";
                    if ($este_nieco_dodat!="") {echo "$este_nieco_dodat".$id_ocv.$este_nieco_dodat2;}
                    
                    
                    echo ">"; 
                    echo " <img src='bg/wiwe.gif' width='27' height='18'></a>";
                    echo " </td> ";
                                                           

                             }?>
                    
                    
                  </table>     
              <? include 'zaoblenie_end.php';?>             
            </td>
            </tr>
          </table>
      
      </table>
</table>
