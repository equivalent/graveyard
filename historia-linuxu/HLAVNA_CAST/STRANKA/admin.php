<?
include 'autorizacia.php';
include 'id_gether.php';

$TTmoje_id=id_chcem();
$TTmoje_prava=prava_chcem();

$TTmoje_nastavenia=nastavenia_chcem();
/*
include "cs.php";
include "page_top.php";
include "funkcie.php";
include "spojenie_s_db.php";

*/

if ((isset ($_POST['TC_ukazat_vseob'])) and ($_POST['TC_ukazat_vseob']==1)) {$TTmoje_nastavenia=1;   }



/************************************Vyber nastaveni stranky z DB******************************/
$sql_vyber_vnutor_nastavenia="SELECT stm AS sirka_tabulky_menu,".
                            " vpo AS vnutroclankovy_pravy_okraj,".
                            " vlo AS vnutroclankovy_lavy_okraj,".
                            " mmlp AS mezera_mezi_l_p,".
                            " mmm AS mezera_mezi_menu,".
                            " mmlam AS mezera_mezi_logom_a_menu,".
                            " form_w,".
                            " textarea_w,".
                            " textarea_h,".
                            " v_s AS vnutro_stranky,".
                            " rnt AS riadky_na_tabulku,".
                            " rntpc AS riadky_na_tabulku_pc,".
                            " popupv,".
                            " popups".
                            " FROM nastavenia WHERE id=$TTmoje_nastavenia";
$sql_vvn= mysql_query($sql_vyber_vnutor_nastavenia) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
$extrect_vvn= mysql_fetch_array($sql_vvn);
extract ($extrect_vvn);


$sql_vyber_admin_nastavenia="SELECT".
                            " zlsi AS zobraz_litle_silver_info".
                         
                            " FROM admin_nast WHERE id=1";
$sql_avvn= mysql_query($sql_vyber_admin_nastavenia) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
$extrect_avvn= mysql_fetch_array($sql_avvn);
extract ($extrect_avvn);


/**********************************************************************************************/



?>


<!-- llava strana-->  
<table cellpadding='0'  cellspacing='0' width='100%' height=70% border='0' rules='none'><!---AAA01--->
  <tr><!-- SABLONA-->
    <td><!--lavy okraj-->
    <td width='<?echo $vnutroclankovy_pravy_okraj?>'><img src='bg/spacer.gif' border=0> <!-- spacer--><!--menu-->
     <td height='<?echo $mezera_mezi_logom_a_menu;?>'><img src='bg/spacer.gif' border=0> <!-- spacer--><!--menu-->
    <td><!--pravy okraj-->
  </tr>
  
  
  
  
  
  <tr>
    <td width='<?echo $vnutroclankovy_lavy_okraj;?>'>
      <img src='bg/spacer.gif' border=0> <!-- spacer-->
    </td>
  
    
  <td valign='top' width='<?echo $sirka_tabulky_menu?>' align='left'>   
    
<!--------------------------------------------------------------------------------------------------------------------1 table-------------->
                  <table cellpadding='0'  cellspacing='0' width='100%'><!---AAA11--->
                  <tr>
                  <td align='left'>               
                  <?  $sprava_nadpis='Nastavenia';/*tato premenna je vlasne nadpis tabulky*/
                      include 'zaoblenie_start.php';  ?>
                      
                                  <div class='txtmenu'>
                                    <a href='index.php?adminaction=odhlasit'>Odhlasiù sa</a><br>
                                    <a href='index.php?action=admin&adminaction=nastavenia_profil' >ZmeÚ profil</a><br>
                                    <a href='index.php?action=admin&adminaction=nastavenia_admina' >ZmeÚ nastavenia</a><br>
                                    <?if ($TTmoje_prava>3){?>
                                    <a href='index.php?action=admin&adminaction=profil' >Uûivatelia</a><br>
                                    <a href='index.php?action=admin&adminaction=news' >NovÏ prÌspevky</a><br>
                                    <?                    }?>   
                                  </div>
                                  
                  <?  include 'zaoblenie_end.php';    ?>
                  </td>
                  </tr>
                  <tr><td height='<?echo $mezera_mezi_menu;?>'><img border=0 src='bg/spacer.gif'><!---SPACER----></td></tr><!--Medzera mezi jednotlivimy menu---->
                  </table><!---AAA11--->
<!--------------------------------------------------------------------------------------------------------------------2 table-------------->
                  <table cellpadding='0'  cellspacing='0' width='100%'><!---AAA12--->
                  <tr>
                  <td>
                  <?  $sprava_nadpis='Prid·vanie';/*tato premenna je vlasne nadpis tabulky*/
                      include 'zaoblenie_start.php';  ?>
                                  
                                  <div class='txtmenu'>
                                    <a href='index.php?action=admin&adminaction=pridajclanok' >Pridaù Ël·nok</a><br>
                                    <a href='index.php?action=admin&adminaction=pridajvysvetlivku' >Pridaù vysvetlÌvku</a><br>
                                    <a href='index.php?action=admin&adminaction=pridajobrazok' >Pridaù obrazok</a><br>
                                  </div>
                                  
                  <?  include 'zaoblenie_end.php';    ?>
                  </td>
                  </tr>
                  <tr><td height='<?echo $mezera_mezi_menu;?>'><img border=0 src='bg/spacer.gif'><!---SPACER----></td></tr><!--Medzera mezi jednotlivimy menu---->
                  </table>                                             <!---AAA12--->           
<!--------------------------------------------------------------------------------------------------------------------3 table-------------->
                  <table cellpadding='0'  cellspacing='0' width='100%'><!---AAA13--->
                  <tr>
                  <td>
                  <?  $sprava_nadpis='⁄pravy';/*tato premenna je vlasne nadpis tabulky*/
                      include 'zaoblenie_start.php';  ?>
                                  
                                  <div class='txtmenu'>      
                                    <?if ($TTmoje_prava>3){?>
                                    <a href='index.php?action=admin&adminaction=editujsekcie' >Sekcie str·nky</a><br>
                                    <?                    }?>          
                                    <a href='index.php?action=admin&adminaction=editujbuf' >RozpisanÈ Ël·nky</a><br>  
                                    <a href='index.php?action=admin&adminaction=editujclanok' >⁄pravy Ël·nokov</a><br> 
                                    <a href='index.php?action=admin&adminaction=editujvetlivku' >⁄pravy vysvetlÌviek</a><br>
                                    <a href='index.php?action=admin&adminaction=editujobrazok' >⁄pravy obr·zkov</a><br>
                                    
                                  </div>
                  <?  include 'zaoblenie_end.php';    ?>
                  </td>
                  </tr>
                  <tr><td height='<?echo $mezera_mezi_menu;?>'><img border=0 src='bg/spacer.gif'><!---SPACER----></td></tr><!--Medzera mezi jednotlivimy menu---->
                  </table> <!---AAA13--->
   </td>   
    
    
    
    
  <?/****medzera mezi lavym panelom a textovou oblastou******/?>  
  <td width='<?echo $mezera_mezi_l_p;?>'><img border=0 src='bg/spacer.gif'><!---spacer----> 
  </td>  

     <td   rowspan='1' align='left' valign='top'>
     <?
/* |||||||||||||||miesto kde je text|||||||||||||||||||*/
     
     if (isset ($_GET['adminaction']))   { $adminactionpremena = $_GET['adminaction']; }
     if (isset ($_POST['adminaction']))  { $adminactionpremena = $_POST['adminaction']; }
          
     if (isset($adminactionpremena )){
                          
                          switch ($adminactionpremena){
                                  
                                  case 'nastavenia_admina':
                                      include 'nastavenia_admina.php';
                                  break;
                                  
                                  case 'nastavenia_profil':
                                      include 'nastavenia_profil.php';
                                  break;
                                  
                                   case 'news':
                                      include 'see_novinky.php';
                                  break;
                                  
                                  
                                  case 'pridajclanok':
                                      include 'pridajclanok.php';
                                  break;
                                case 'pridajvysvetlivku':
                                      include 'pridajvysvetlivku.php';
                                  break;
                              case 'pridajobrazok':
                                      include 'pridajobrazok.php';
                                  break;
                             
                               case 'profil':
                                      include 'profily.php';
                                  break;   
                                  
                                  
                                  case 'editujobrazok':
                                      include 'editujobrazok.php';
                                  break;
                                  
                                  
                                   case 'editujsekcie':
                                      include 'editujsekcie.php';
                                  break;
                                  
                                   case 'editujvetlivku':
                                      include 'editujvetlivku.php';
                                      /*ano viem malo tam byt vysvetlivku a nie vetlivku ale ked som to zistil uz som mal kopu veci na to hotovych */
                                      
                                  break;
                                     case 'wievclanok':
                                     include 'wievclanok.php';
                                  break; 
                                  
                                  case 'editujclanok':
                                     include 'editujclanok.php';
                                  break; 
                                  case 'editujbuf':
                                     include 'editujbuf.php';
                                  break; 
  
                                  
                                  default:
                                  echo "<center>$sprava_zla_volba</center>";
                          
                          
                          
                                                      }
                          
     
     
                                      }
      
       else { ?>
      
      <table width='100%' height='70%'><!--hgjgf2-->
        <tr>
          <td align='center'>
            <table><!--hgjgfa-->
              <tr>
               <td>
                    <?  $sprava_nadpis="";/*tato premenna je vlasne nadpis tabulky*/
                    include 'zaoblenie_start.php';  ?> 
                       <table><!--hgghhgjjha-->
                        <tr>
                         
                                             
                         <td>
                          <p class='txtnadpis'>Dobr˝ deÚ <?echo $_SESSION['moje_user'];?></p>
                         </td>
                          
                         
                        </tr>
                        
                        <tr>
                         <td>
                             <table>
                              <tr>
                              <td background='bg/babygnu.jpg' style=" background-repeat: no-repeat; width:70px; height:70px;">
                              <td >
                              
                               <?
                               
                                   $id_TOTALid=$TTmoje_id;
                                   include 'idtotal.php';   

                               
                               ?>
                                    <p class='txtuvod'>V datab·ze je <span class='txtuvodr'><?echo $t_count_c;?></span> Ël·nkov v <span class='txtuvodr'><?echo $t_count_s;?></span> sekci·ch.
                                                       V datab·ze je taktieû <span class='txtuvodr'><?echo $t_count_o;?></span> obr·zkov a <span class='txtuvodr'><?echo $t_count_v;?></span> vysvetliviek.
                                    </p>
                                    <p class='txtuvod'>Vy ste autorom <span class='txtuvodr'><?echo $count_c;?></span> Ël·nkov (<span class='txtuvodper'><?echo $MOJEpercento_c;?> %</span>), <span class='txtuvodr'><?echo $count_v;?></span> vysvetliviek (<span class='txtuvodper'><?echo $MOJEpercento_v;?> %</span>)
                                                       a pridali ste <span class='txtuvodr'><?echo $count_o;?></span> obr·zkov (<span class='txtuvodper'><?echo $MOJEpercento_o;?> %</span>).                                                      
                                                       <?if ($count_b==0) { echo "Nem·te rozpÌsanÈ Ël·nky. ";} else{?>
                                                       M·te <span class='txtuvodr'><?echo $count_b;?></span> nedopÌsan˝ch Ël·nkov.
                                    </p>                    
                                                       <?}
                                                       if ( $TTmoje_prava>3 )
                                                       { include 'novinky.php'; ?>
                                   <p class='txtuvod'>                  
                                                       V datab·ze je <span class='txtuvodr'><?echo $count_new_c;?></span> nov˝ch Ël·nkov, <span class='txtuvodr'><?echo $count_new_v;?></span> nov˝ch vysvetliviek 
                                                       a <span class='txtuvodr'><?echo $count_new_o;?></span> nov˝ch obr·zkov od <font color='orange'>PISATEºOV</font>. Treba skontrolovaù a odakceptovaù <span class='txtuvodr'><?echo $count_ack_c;?></span> nov˝ch Ël·nkov. <a href='index.php?action=admin&adminaction=news'><u>Kontrola prÌspevkov</u></a>
                                   </p> 
                                                      <?if ( $TTmoje_prava==5 ) {?>
                                  <p class='txtuvod'>  <font color='blue'>STR¡éCOVIA</font> a <font color='green'>MODER¡TORI</font> pridali  <span class='txtuvodr'><?echo $count_new_ac;?></span> Ël·nkov, <span class='txtuvodr'><?echo $count_new_av;?></span> vysvetliviek a <span class='txtuvodr'><?echo $count_new_ao;?></span> obr·zkov. 
                                  </p> 
                                   <p class='txtuvod'>                   Bolo vykonan˝ch  <span class='txtuvodr'><?echo $count_new_uc;?></span> ˙prav Ël·nkov, <span class='txtuvodr'><?echo $count_new_uv;?></span> ˙prav vysvetliviek a <span class='txtuvodr'><?echo $count_new_uo?></span> ˙prav obr·zkov.
                                    </p>                       <?}}?>
                                                       
                                                                                             
                                    
                               
                               
                               
                               <?//<td background='bg/babytux.jpg' style=" background-repeat: no-repeat; width:70px; height:70px;">?>
                               </td>
                               
                               </tr>
                              </table>
                         </td>
                         
                        </tr>
                       </table><!--hgghhgjjha-->
                    <?include 'zaoblenie_end.php';  ?> 
               </td>
              </tr>
            </table><!--hgjgfa-->
          </td>
        </tr>
      </table><!--hgjgf2-->

     <?
     }
     ?>
     </td>
    
    <td width='<?echo $vnutroclankovy_pravy_okraj?>'><img border=0 src='bg/spacer.gif'><!---spacer---->
    </td>
    
  </tr>
  
<tr><!-- SABLONA-->
              <td><!--lavy okraj-->
              <td height='<?echo $mezera_mezi_logom_a_menu;?>'><img src='bg/spacer.gif' border=0> <!-- spacer--><!--menu-->
              <td><!--text-->
              <td><!--pravy okraj-->
 </tr>
  
</table><!---AAA01--->
