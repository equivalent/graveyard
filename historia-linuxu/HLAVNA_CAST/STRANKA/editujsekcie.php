<?
include 'autorizacia.php';
//include 'id_gether.php';

//$TTmoje_prava=prava_chcem();

/*************************************************/$TOTAL_ERROR="<font color = 'red'>Nepovolena operacia<br />
                                                   Ak ste tento problem nezavinily vy prosim kontaktujte admina na adrese <B>historialinuxu@gmail.com</b><br />
                                                   Uvedte ako predmet spravy ERROR";

                    if ($TTmoje_prava<4) {die ("$TOTAL_ERROR SEK-566</font>");}


/*
potrebne includy:
include 'spojenie_s_db.php';
include 'funkcie.php';
include 'cs.php';


vsetky su uz zahrnute v admin.php

*/


if (isset($_POST['nazov_sekcie']))   { $nazov_sekcie = $_POST['nazov_sekcie'];}
if (isset($_POST['popis_sekcie']))   { $popis_sekcie = $_POST['popis_sekcie'];}
if (isset($_POST['editujem']))       { $editujem     = $_POST['editujem'];}
if (isset($_POST['vymazujem']))      { $vymazujem    = $_POST['vymazujem'];}
if (isset($_POST['pridavam']))       { $pridavam     = $_POST['pridavam'];}
 
    

/* rozhodol som sa ze editujsekcie.php bude sluzit aj na pridavanie aj na upravovanie aj na prezeranie. teda nebbude mat ziaden
vedlajsi skript ktoremu bude posielat informacie. sam si ich spracuje*/




$sql="SELECT * FROM sekcia" ;
$spust_sql1= mysql_query ( $sql ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);


/* ||||||||||||||||||||||||||||||||||||||||||||||||||||
PRIDANIE ZAZNAMU  podstatou je premenna $pridavam

Uprava ZAZNAMU   podstatou je premenne $editujem a $upravzaznam
||||||||||||||||||||||||||||||||||||||||||||||||||||*/

if ((isset($pridavam) and ($pridavam=='true')) or (isset($editujem) ))
  {                      $popis_sekcie=htmlspecialchars($popis_sekcie);
                         $nazov_sekcie=htmlspecialchars($nazov_sekcie);
    
         /*mensie testy ci je mozne pridat zaznam */  
                if ( $popis_sekcie=='' or
                     $nazov_sekcie==''
                    ){ echo "<center>$sprava_volba_prazna</center>";}
                
                /*tato cast zabespecuje ze nezadate viac ako 255 znakov, aj ked som toto uz zabespecil v 
                html kode MAXLENGHT=50, ale clovek nikdy nevie*/
                elseif (strlen($popis_sekcie) > 50 or
                        strlen($nazov_sekcie) > 25){
                        "<center>$sprava_volba_prilis_dlha</center>";
                        } 
                 
                
                else{ 
                
                             
                         if (isset($pridavam)){

                                               /*najprv overim ci zaznam v DB existuje*/
                                                $sql_zisti_ci_uz_je="SELECT count(nazov) FROM sekcia WHERE nazov='$nazov_sekcie'";
                                                $spust_sql_zisti_ci_uz_je= mysql_query ($sql_zisti_ci_uz_je) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
                                                $vysledok=mysql_fetch_array ($spust_sql_zisti_ci_uz_je);
                                                if ($vysledok[0]) {$zaznam_uz_existuje=1;}
                                                else {$zaznam_uz_existuje=0;}
                                                 
                                                 
                                                      if ($zaznam_uz_existuje==1) {echo $sprava_volba_existuje;}
                                                      /*zaznam existuje ZAPISOVAT NEMOZEM*/
                                                      
                                                      else{
                                                      
                                                      /*zaznam neexistuje ZAPISOVAT mozem*/
                                                      $sql_vyber= "INSERT INTO sekcia ( nazov, vysvetlivka )
                                                                   VALUES ( '$nazov_sekcie', '$popis_sekcie' )";
                                                      $spust_sql2= mysql_query ( $sql_vyber ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
                                                      echo "<p class='txtnadpis'>Sekcia $nazov_sekcie uspesne vytvoren·</p>";
                                                         }
                                                }
                         elseif (isset($editujem) and isset($upravzaznam) ) 
                                        {    
                                              /*upravuje zaznam v DB*/
                                        
                                              $sql_uprav= "UPDATE sekcia SET nazov = '$nazov_sekcie', vysvetlivka =".
                                                            " '$popis_sekcie' WHERE id = $upravzaznam ";
                                              $spust_sql2= mysql_query ( $sql_uprav ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
                                              echo "<p class='txtnadpis'>Uprava sekcie uspesn·</p>";
                                        
                                        }
                                       
                         else {echo "<center>$sprava_zla_volba</center>";}
                   
                    }
  }
  elseif (isset($vymazujem) and isset($upravzaznam) )
  {
                                        
        $sql_zmaz= "DELETE FROM sekcia WHERE id = $upravzaznam LIMIT 1";
        $spust_sql2= mysql_query ( $sql_zmaz ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
        $informacia_uspech="<p class='txtsprava'>Sekcia uspeöne vymazan·</p>";
                                       
    }   
     
     

                                                  
?>  

   <table border="0" align='center' cellpadding='<?echo $vnutro_stranky;?>'  cellspacing='<?echo $vnutro_stranky;?>'>





    <tr>
    <td valign='top'>                
        <table><!---55855265-->
        <tr><!---55855265-->
        <td valign='top'><!---55855265-->
        
    
                  <?$sprava_nadpis='Sekcie';
                  include 'zaoblenie_start.php';?>
                      <table border='0' class='table'>
                      <tr>
                      <td><p class='tdu'>N·zov</p>
                      <td><p class='tdu'>Popis sekcie</p>
                      </tr>
                      <?
                             $sql_vyber= mysql_query ("SELECT * FROM sekcia ") or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
                              
                              while ($extraction = mysql_fetch_array( $sql_vyber ))
                                {
                               extract( $extraction );  
                               echo " <tr> ";
                               echo " <td class='tdh'> ";              
                               echo " $nazov "; 
                               echo " <td class='tdh'> "; 
                               
                               $dlzka= strlen($vysvetlivka);
                               if ( $dlzka < 50 ) {echo " $vysvetlivka ";}
                               else { 
                                    $a= chunk_split ($vysvetlivka, 50, '<br>');
                                    echo $a;
                                    }
                                    
                               echo " </td> ";  
                               echo " </tr> ";     
                                 }
                      ?>
                      </table>
                  <? include 'zaoblenie_end.php';?>    
      </td><!---55855265-->
      </tr><!---55855265-->
      </table> <!---55855265--> 
      
      
     </td>
      
                                        
     <td valign='top'>   
        <table><!---55fdssd65-->
        <tr> <!---55fdssd65-->  
        <td  align='right' valign='top'>
                 <?$sprava_nadpis='Zvoæ ktor˝ z·znam editovaù';
                  include 'zaoblenie_start.php';?>
        
                              <form  method="post" action="index.php">  
                              <input type='hidden' name='adminaction' value='editujsekcie'>
                              <input type='hidden' name='action' value='admin'>    
                              <select name='upravzaznam' size='5' class='select'>
                                      <?
                              /*vypise mi zaznamy MENA ako polozky pre option. Do value sa ulozi ID  */
                              $sql_vyber= mysql_query ("SELECT * FROM sekcia ") or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
                             
                              while ($extraction = mysql_fetch_array( $sql_vyber ))
                                {
                               extract( $extraction );                
                               echo "<option class='option' value='$id'>$nazov";  
                                      
                                 }     
                                      ?>
                               </select>
                                <br><br>
                                <input class='button_all' type="submit" value='Zvoæ z·znam'>
                               </form>
                <? include 'zaoblenie_end.php';?>                               


        </td>
        </tr><!---55fdssd65-->
        </table><!---55fdssd65-->


<?

/* vyberie z databazy a sprvai premenne z mien poli*/
if (isset ($upravzaznam)){

$sql="SELECT * FROM sekcia WHERE id = $upravzaznam" ;

$spust_sqlx= mysql_query ( $sql ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
while ($asd= mysql_fetch_assoc( $spust_sqlx )){

extract( $asd );

}

}


?>



     <tr> 
     <td colspan=2 align='center'>
             
              <table><!---ffgfgg--->
              <tr><!---ffgfgg--->
              <td align='center' ><!---ffgfgg--->
                             
                             
                             
                  <form  method="post" action="index.php">
                  <input type='hidden' name='adminaction' value='editujsekcie'>
                  <input type='hidden' name='action' value='admin'>
                      <? if (isset ($upravzaznam)){
                        echo"<input type='hidden' name='upravzaznam' value='$id'>" ;  
                                       /* $upravzaznam mi je potrebna na to aby mi vo rormulary ukazalo zaznam co som napisal prave teraz*/                  
                                                  }
                        else {echo"<input type='hidden' name='pridavam' value='true'>";}
                     ?>

                       <?/*******************************************************************************************************/
                       if (isset ($upravzaznam))
                            {$sprava_nadpis= "Upraviù n·zov sekcie $nazov";}
                       else {$sprava_nadpis= "Vytvoriù nov˙ sekciu";} 
                       include 'zaoblenie_start.php';
                       ?>
                        
                        <input class='form_all' name="nazov_sekcie" type="text"  size='<?echo ($form_w); ?>' maxlength="25" <? if (isset ($upravzaznam)) {echo "value='$nazov'";} ?> >
                      
                       <?include 'zaoblenie_end.php';/************************************************************************/?>        
              </td>                               
             </tr>   
                             
             <tr>
             <td>
                       
                       <?/*******************************************************************************************************/
                       if (isset ($upravzaznam))
                            {$sprava_nadpis= "Upraviù popis sekcie $nazov";}
                       else {$sprava_nadpis= "Popis sekcie";} 
                       include 'zaoblenie_start.php';
                       ?>                                
                        <textarea class='form_all' name="popis_sekcie" type="text" rows='4' cols='<?echo $textarea_w; ?>' maxlength="50" ><? if (isset ($upravzaznam)) {echo $vysvetlivka;}?></textarea>
                        <?include 'zaoblenie_end.php';/************************************************************************/?>       
                                
              </td>                               
             </tr>                  
             <tr>
             <td>                
                                   <? if (isset ($upravzaznam))
                                                 {
                                      echo '<table width= 100%><tr><td>';
                                      echo "<input class='button_all' name='editujem' type='submit' value='Uprav sekciu - ".$nazov ."'>";
                                      echo '<td align="right">';
                                      echo "<input class='button_all name='vymazujem'  type='submit' value='Odstran sekciu - ".$nazov ."'>";
                                      echo '</td></tr></table>';
                
                                                    }
                                     else {
                                           echo "<input class='button_all' type='submit' value='pridaj z·znam'>";
                                          } 
                                  if (isset ($upravzaznam))
                                    {
                                   ?>
               </tr>
               <tr>
               <td align='right'>
                                <br />
               <a href='index.php?action=admin&adminaction=editujsekcie'><b><u>Pridaù novÈ sekcie</u></b></a>
               </tr>
                                    <?}?>

                          </table><!--sdf54646--->
                                       
                 </td><!---ffgfgg--->
                 </tr><!---ffgfgg--->
                 </table><!---ffgfgg--->
    </td>
    </tr>     
</table>
<?


/****************Litle silver info**************************************************/
/**/if (isset($zobraz_litle_silver_info) and $zobraz_litle_silver_info==1  ){
/**/$pocet_sekcii=posledny_pocet('sekcia');
/**/$posledna_sekcia=posledny_zaznam('sekcia');
/**/$pocet_dokopy_vymazanych=$posledna_sekcia-$pocet_sekcii;   
/**/
/**/if (isset($upravzaznam)) {$xx[0]="Upravujete existuj˙cu sekciu s identifik·torom <b>$upravzaznam</b> ";}
/**/else {$xx[0]="Prid·vate nov˙ sekciu. ";}
/**/
/**/$xx[1]= "Na str·nke je <b>$pocet_sekcii</b> sekcii. ";
/**/

/**/if ($pocet_dokopy_vymazanych>0 ){$xx[5]= "Na stranke ste uz vytvorili a zaroven odstr·nily $pocet_dokopy_vymazanych sekciu/i.";}
/**/$zobraz_silver_info= implode ('', $xx);
/**/                                               }
/***********************************************************************************/
?>
