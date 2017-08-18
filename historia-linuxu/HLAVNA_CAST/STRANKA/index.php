<?
session_start();
?>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
<title>História Linuxu</title>
<link rel="stylesheet" href="main.css">
</head>
<body bgcolor='fffefb'>
  <script>
function zobraz (idecko){
el=document.getElementById(idecko).style; 
el.display=(el.display == 'block')?'none':'block';
}
</script>
<?php


echo ("<script language=\"JavaScript\">\n");
echo ("<!--\n");
echo ("function openWin( windowURL, windowName, windowFeatures ) { \n");
echo (" return window.open( windowURL, windowName, windowFeatures ) ; \n");
echo ("} \n");
echo ("// -->\n");
echo ("</script>\n");


/*top of site*/
include "cs.php";
include "page_top.php";
include "spojenie_s_db.php";
include "funkcie.php";



If ( (isset ($_GET['adminaction']) and ($_GET['adminaction']== 'odhlasit')   ) or (isset ($_POST['adminaction']) and ($_POST['adminaction']== 'odhlasit')   )  ){session_destroy();} /* ADMIN */    

If ( (isset($_GET['action'])  and  ($_GET['action']== 'admin')) or (isset($_POST['action'])  and  ($_POST['action']== 'admin'))){include "admin.php";} /* ADMIN */
elseif ( (isset($_GET['action'])  and  ($_GET['action']== 'profil')) or (isset($_POST['action'])  and  ($_POST['action']== 'profily'))){include "profily.php";} /* profily */        
else {

include 'id_gether.php';
if (isset( $_SESSION['moje_user']) && $_SESSION['moje_user'] != "") {$TTmoje_nastavenia=nastavenia_chcem(); $TTmoje_prava=prava_chcem();} else {$TTmoje_nastavenia=1; $TTmoje_prava=1;}

/************************************Vyber nastaveni stranky z DB******************************/
$sql_vyber_vnutor_nastavenia="SELECT stm AS sirka_tabulky_menu,".
                            " vpo AS vnutroclankovy_pravy_okraj,".
                            " vlo AS vnutroclankovy_lavy_okraj,".
                            " mmlp AS mezera_mezi_l_p,".
                            " mmm AS mezera_mezi_menu,".
                            " mmlam AS mezera_mezi_logom_a_menu,".
                            " v_s AS vnutro_stranky,".
                            " popupv,".
                            " popups".
                            " FROM nastavenia WHERE id=$TTmoje_nastavenia";
$sql_vvn= mysql_query($sql_vyber_vnutor_nastavenia) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
$extrect_vvn= mysql_fetch_array($sql_vvn);
extract ($extrect_vvn);
/**********************************************************************************************/ 
global $popupv;
global $popups;



$count_pre_pop=0;//premena dalej v skripte
          ?>
          
          
          
            <!-- Telo stranky-->
          <table cellpadding='0'  cellspacing='0' width='100%' height='70%' border='0' rules='none'>
          
            <tr><!-- SABLONA-->
              <td><!--lavy okraj-->
              <td height='<?echo $mezera_mezi_logom_a_menu;?>'><img src='bg/spacer.gif' border=0> <!-- spacer--><!--menu-->
              <td><!--text-->
              <td><!--pravy okraj-->
            </tr>
          
            <tr>  <!-- stranka--> 
              <td width='<?echo $vnutroclankovy_lavy_okraj;?>'>
                <img src='bg/spacer.gif' border=0> <!-- free-->
              </td>  
              
              
              <td  width='<?echo $sirka_tabulky_menu?>' valign='top' align='left'> <!-- lavy panel stranky-->
          
             
              <?    /*Z databazy vyberiem nazvy sekcii a cisla*/
              $sql_vyber_sekcie_z_db='SELECT s.id AS cislo_sekcie, s.nazov AS nazov_sekcie,  vysvetlivka AS ex_pl FROM sekcia s';
              $spust_sql_vyber_sekcie_z_db= mysql_query ( $sql_vyber_sekcie_z_db ) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
              while ($extraction = mysql_fetch_array( $spust_sql_vyber_sekcie_z_db ))
                  {
                  $count_pre_pop++; //puzite aj tu aj dalej v skripte,
                  
                
                  extract( $extraction ); //takto ziskam premenne $cislo_sekcie a nazov_sekcie
                  
                  $_vysvetlivka[$count_pre_pop]=$ex_pl;
              ?>  
                  <table cellpadding='0'  cellspacing='0' width='100%' >
                       <tr>
                       <td align='left' onmouseover="zobraz('pokus<?echo $count_pre_pop;?>')" onmouseout="zobraz('pokus<?echo $count_pre_pop;?>')">        
                            <?  $sprava_nadpis=$nazov_sekcie;/*tato premenna je vlasne nadpis tabulky*/
                                include 'zaoblenie_start.php';  ?> 
          
                                              <div class='txtmenu'>
                                                  <?    
                                                  /*Z databazy vyberiem nazvy clankov priradene na zaklade cisla sekcie v do ktorej patria  $cislo_sekcie */
                                                  $sql_vyber_clanok_z_db='SELECT ac.ack AS is_accepted, ac.new AS new_stat, c.cladatum AS datum_clanku, c.clanazov AS nazov_clanku, c.id AS idclanocek  FROM clanok c'.
                                                                          ' JOIN sekcia_clanok sc JOIN autor_c ac ON ( c.id=sc.id_clanok AND ac.id_clanku=c.id ) WHERE '.
                                                                            ' sc.id_sekcia= '.$cislo_sekcie;
                                                  $spust_sql_vyber_clanok_z_db= mysql_query ( $sql_vyber_clanok_z_db ) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
                                                  while ($extraction = mysql_fetch_array( $spust_sql_vyber_clanok_z_db ))
                                                      {
                                                          extract( $extraction ); //takto ziskam premennu $nazov_clanku
                                                          
                                                          if ($TTmoje_prava<4 and $is_accepted==0){}
                                                          else{
                                                          ?> 
                                                          
                                                          <a href='index.php?clanok=<?echo $idclanocek;?>'><?if($is_accepted==0){echo "! ";} echo $nazov_clanku; ?> </a><br>
                                                          
                                                          
                                                    <?}}/*koniec byberu z clankov*/?>
                                              </div>
                                     
                            <?  include 'zaoblenie_end.php';    ?>
                        </td>
                        </tr> 

                                                
                          <tr><td height='<?echo $mezera_mezi_menu;?>'><img border=0 src='bg/spacer.gif'><!---SPACER----></td></tr><!--------Medzera mezi jednotlivimy menu---->
                    </table>
                    
              <?} /*koniec else, teda vyberu z sekcie*/?>   
              
          <!----------------------------------------------------------------------------------------------------------------------------------ADMIN-->    
          <?/*   TOTO MOZETE AKTIVOVAT AK CHCETE MAT MOZNOST ADMINISTRACIE PRIAMO V LAVOM PANELY    
                    <table cellpadding='0'  cellspacing='0' width='100%' border='0'>
                           
                            <tr>
                              <td align='left'>        
                                
                                 \<\?
                                    $sprava_nadpis='Moźnosti';
                                    include 'zaoblenie_start.php';  \?\> 
              
                                                  <div class='txtmenu'>
                                                    <a href='index.php?action=admin'>Administrácia</a>
                                                  </div>
                                \<\?  include 'zaoblenie_end.php';    \?\>
                               </td>
                            </tr>
                    </table>       
            */  
             ?> 
              
              
             <table width='100%'>
             <tr>
             <td height=170  valign=top order=0 cellpadding='0' cellspacing='0' background='bg/spacer.jpg'> 
             <? 
             
             $count_pre_pop;
             for ($tu=1;$tu<=$count_pre_pop;$tu++)
             {
             ?>
              <span id="pokus<?echo $tu;?>" class='hidden'><?$sprava_baby=$_vysvetlivka[$tu]; include 'tux_gnu_pop_up.php';?></span> 
                                             
            <?}?>
              </table>
              
              
              
              
                <?/****medzera mezi lavym panelom a textovou oblastou******/?>  
                <td width='<?echo $mezera_mezi_l_p;?>'><img border=0 src='bg/spacer.gif'><!---spacer----> 
                </td>
              
              <td  valign='top'><!--STRED--->
              
                      <?
          /*******************************************************************************************************formular na prihlasenie**/            
                        if (isset($_GET['co_spravit']) and $_GET['co_spravit'] == 'prihlas' )
                            {
                                if (isset($_GET['nespravne'])){$sprava_prihlasenia="Nesprávny údaj!";} else {$sprava_prihlasenia='Zadajte meno a heslo';}
                                ?>
                                 
                                  
                                  
                                   
                                  
                                      
                                      
                                  <table width='100%' height='100%'><!---5145616558---->
                                  <tr>
                                  <td align='center'>    
                                  <table><!---51asas16558---->
                                  <tr><td>
                                       <?
                                  $sprava_nadpis="";
                                  include 'zaoblenie_start.php';

                                  include 'generauj_kod.php'; //malo to byt generuj ale akosi som to zle pomenoval. stava sa :)
                                  ?>
                                  <table><!---sadgfasdgasd-->
                                  <tr>
                                  <td align='center' >
                                  <font size=+1><b><?echo $sprava_prihlasenia;?></b></font>
                                    <form method='post' action='spracuj3.php'>
                                      <input type='hidden'   name='gen_er' value='<?echo $gencislo;?>'>
                                      <input type='hidden'   name='presmeruj' value='<?echo $_GET['presmeruj'];?>'>
                                      <table><!---asda544sd-->
                                        <tr><td>
                                         Prihlasovacie meno:<td><input type='text' class='select' name='user'>
                                        <tr><td>
                                         Prihlasovacie heslo:<td><input type='password' class='select' name='helso'>
                                        <tr><td><td align='center'>
                                        <b><?echo $sprava;?></b> <input type='text' maxlength='1' size='1' class='select' name='overovaci_kod'> 
                                        <tr><td><td>
                                         <input type='submit' class='button_all'  name='odoslat' value='Potvrď'>
                                      </table><!---asda544sd-->
                                    </form>  
                                  <td align='center' style=" background-repeat: no-repeat; width:70px; height:70px;" background='bg/babytux.jpg'>
                                  
                                  
                                  </table><!---sadgfasdgasd-->
                                  <?
                                
                                  include 'zaoblenie_end.php';
                                   ?>
                                   </table><!---51asas16558---->
                                  </table><!---5145616558---->
                        
                        
                        
                        
                            <?}
                            
                            
                        elseif ( (isset($_GET['action'])  and  ($_GET['action']== 'hladaj')) or (isset($_POST['action'])  and  ($_POST['action']== 'hladaj'))){include "hladaj.php";} /* vyhladavanie */        

                        
                        
                        
                        else{
                              if (isset($_GET['clanok']) and $_GET['clanok'] > 0 )
                                                      {
                                $clanok=$_GET['clanok'];
                                                        }
                                else {$clanok=1;}
                                $tatopremenajedolezitanaspravnevykreslenie=1;
                                $sql_vyber_text_z_db='SELECT p.id AS ide_autora, p.user AS user_autora, c.clanazov AS nazov_clanku, c.clatext AS text_clanku, ac.ack AS is_accepted, ac.new AS newnew FROM clanok c JOIN autor_c ac JOIN profil p  ON (ac.id_clanku=c.id and ac.id_usera=p.id) WHERE c.id= '.$clanok;
                                
                                $spuist_sql_vyber_text_z_db= mysql_query ( $sql_vyber_text_z_db ) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
                                $text_clanku= mysql_fetch_array ($spuist_sql_vyber_text_z_db); 
                                extract ($text_clanku);
                                
                                if ( $is_accepted==0 and $TTmoje_prava<4 ) {echo "<p class='txtnadpis'>Tento článok ešte nebol schválený</p>";}
                                else {
                                echo "<p class='txtnadpis'>$nazov_clanku</p><br>";
                                $BB_upraveny_clanok=bbcode4clanok($text_clanku);
                                   
                                   /*   VYHLADAVANIE A OZNACENIE
                                      if (isset ($oznac_qnajdeny)){echo ereg_replace( $oznac_qnajdeny, "<span style='background-color: yellow'>$oznac_qnajdeny</span>" ,$BB_upraveny_clanok); }
                                      else {echo $BB_upraveny_clanok; } 
                                      
                                  */
                                  echo $BB_upraveny_clanok; 
                                  }
                            }           
                      ?>
              <td width='<?echo $vnutroclankovy_pravy_okraj;?>'><!---SPACER---><img border=0 src='bg/spacer.gif'> <!---------Nastavenie praveho vnutorneho okraja ------>
              </td>
            </tr>
                       <tr><!-- SABLONA-->
              <td><!--lavy okraj-->
              <td height='<?echo $mezera_mezi_logom_a_menu;?>'><img src='bg/spacer.gif' border=0> <!-- spacer--><!--menu-->
              <td><!--text-->
              <td><!--pravy okraj-->
            </tr> 
           
          </table>       
          
                  
 <?}/*koniec elsu, indexu*/?>
 <div style="position: relative; bottom: -25; ">
 <?

 if (isset ($tatopremenajedolezitanaspravnevykreslenie) and $tatopremenajedolezitanaspravnevykreslenie==1 and $TTmoje_prava>3 ){
 

 admin_has_seen_it ( 'autor_c', 'id_clanku', $clanok, $new_stat);
 
 ?>
          <table width=100%>
          <tr>
          
          <td align=right>
              <table>
                  <tr>
                  <td><b>Autor článku: <a href='celyprofil.php?id=<?echo  $ide_autora;?>' ><?echo  $user_autora;?></a>&nbsp;&nbsp;&nbsp;</b>
                  <td>

                        <table cellspacing='3'>
                         <tr> <td class='table'> <a href='index.php?action=admin&adminaction=pridajclanok&edit=<?echo $clanok; ?>'><img border=0 src='bg/edit.gif' width='27' height='18'  alt='Uprav clanok' ></a> 
                         <?if ($is_accepted==0) {
                                             $coco="clanok";
                                             $hrefer="delete_pop_up.php?co=$coco&id=$clanok"; 
                                             $kreper=  "onClick=\"JavaScript: newWindow = openWin( '$hrefer', 'Profile',".
                                                       "'width=500,height=200,toolbar=0,location=0,directories=0,".
                                                       "status=0,menuBar=0,scrollBars=auto,resizable=1' ); newWindow.focus(); return false;\"";
                                                       $greper="<a href='$hrefer' $kreper>";  
                         
                         ?><td class='table'> <a href='akceptor.php?clanok=<?echo $clanok;?>'><img border=0 src='bg/accept.gif' alt='Akceptuj clanok' width='27' height='18'></a> 
                                                  <td class='table'> <?echo $greper;?><img border=0 src='bg/delete.gif' alt='Zmaž článok' width='27' height='18'></a>
                         <?}?>
                         
                        </table>
                 <tr>
                  <td><font size= -1>Datum pridania: <? echo $datum_clanku;?></font>   
              </table>
          <tr><td height='<?echo $mezera_mezi_logom_a_menu;?>'><img src='bg/spacer.gif' border=0> <!-- spacer--><!--menu-->
          </table>
                                                    <?}  
 
 elseif (isset ($tatopremenajedolezitanaspravnevykreslenie) and $tatopremenajedolezitanaspravnevykreslenie==1) {
 ?>
  <table width=100%>
          <tr>
          
          <td align=right>
              <table>
                  <tr>
                  <td><b>Autor článku: <a href='celyprofil.php?id=<?echo  $ide_autora;?>' ><?echo  $user_autora;?></a>&nbsp;&nbsp;&nbsp;</b>
                  <tr>
                  <td><font size= -1>Datum pridania: <? echo $datum_clanku;?></font>
              </table>    
              
  </table>
 <?
 }
 
 
 
 include 'page_bottom.php';?>
 </div>
