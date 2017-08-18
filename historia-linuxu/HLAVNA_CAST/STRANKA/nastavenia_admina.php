<?php
include 'autorizacia.php';
//include 'id_gether.php'; je uz included
$TTright=prava_chcem();

function admin_is_admin ()
 {
 global $TTright;
if ($TTright==5) {

if (isset ($_POST['TC_ukazat_vseob'])){ $TC_ukazat_vseob= $_POST['TC_ukazat_vseob']; } 
elseif (isset ($_GET['TC_ukazat_vseob'] )){ $TC_ukazat_vseob= $_GET['TC_ukazat_vseob'];  }
else { $TC_ukazat_vseob= 2; /*toto cislo nieje velmo podstatne, moze byt kludne 300. jedna sa o to ze to da vediet skriptu nizsie ze ma zobrazit nastavenia svojho profilu*/  }
?>
                  
                  
                  
                   
                  <select name='rozkazal_vsetkym' size='1' class='select'>
                    <option value='0' class='option' <?if ($TC_ukazat_vseob!=1){echo 'selected';}?> >Zmena vo vlastnom profile
                    <option value='1' class='option' <?if ($TC_ukazat_vseob==1){echo 'selected';}?> >Zmena vo vöeobecnom profile
                  </select>
                 <?}
else echo"";                 
return 0;
}


?>

<table align='center' cellpadding='<?echo $vnutro_stranky;?>'  cellspacing='<?echo $vnutro_stranky;?>'>

<?if( isset($_GET['uspech'])){
echo "<tr> <td colspan=2>";
$sprava_nadpis='';
include 'zaoblenie_start.php'; 
?>
<p class='txtnadpis'>Zmeny ˙speöne vykonanÈ</p>
<?
include 'zaoblenie_end.php'; 
echo "</td></tr>";           }
?>


                           

                        

<!-----------------------------------------------------------------------------------------------------------Zmena rozmerov--------------->        
        
        
        <?
        
                if ($TTright==5) {

if (isset ($_POST['TC_ukazat_vseob'])){ $TC_ukazat_vseob= $_POST['TC_ukazat_vseob']; } 
elseif (isset ($_GET['TC_ukazat_vseob'] )){ $TC_ukazat_vseob= $_GET['TC_ukazat_vseob'];  }
else { $TC_ukazat_vseob= 2; /*toto cislo nieje velmo podstatne, moze byt kludne 300. jedna sa o to ze to da vediet skriptu nizsie ze ma zobrazit nastavenia svojho profilu*/  }

        ?>
                          <tr><td colspan=2 align= 'center'>
                          <form action='index.php' method='post'>
                          <input type='hidden' name='action' value='admin'>
                          <input type='hidden' name='adminaction' value='nastavenia_admina'>
                          
                           
                          <select name='TC_ukazat_vseob' size='1' class='select'>
                          
                            <option value='0' class='option' <?if ($TC_ukazat_vseob!=1){echo 'selected';}?> >Zobraz nastavenia vlastnÈho profilu
                            <option value='1' class='option' <?if ($TC_ukazat_vseob==1){echo 'selected';}?> >Zobraz nastavenia vöeobecnÈho profilu
                          </select>
                          <input class='button_all' type="submit" value=">">
                          </select> 
                          </form>
                          
                          
        <?}
        ?>
        
        
        
        <tr>
        <td valign='top' >
                    
        <?  $sprava_nadpis='Nastavenie vn˙tor. okrajov';/*tato premenna je vlasne nadpis tabulky*/
            include 'zaoblenie_start.php';  ?> 
                  <form action="spracuj4.php" method="post">
                      <input type='hidden' name='zmena' value='okraje'>
                      <table>
                        <tr><td><b>äÌrka menu</b></td>            <td align='right'><input class='form_all' type='text' name='stm'   value='<?echo $sirka_tabulky_menu;?>' >        </td></tr>                      
                        <tr><td><b>ºav˝ okraj</b></td>            <td align='right'><input class='form_all' type='text' name='vlo'   value='<?echo $vnutroclankovy_lavy_okraj;?>' > </td></tr> 
                        <tr><td><b>Prav˝ okraj</b></td>           <td align='right'><input class='form_all' type='text' name='vpo'   value='<?echo $vnutroclankovy_pravy_okraj;?>' ></td></tr> 
                        <tr><td><b>Okraj textu od menu</b></td>   <td align='right'><input class='form_all' type='text' name='mmlp'  value='<?echo $mezera_mezi_l_p;?>' >           </td></tr> 
                        <tr><td><b>Medzera mezi sekciami</b></td> <td align='right'><input class='form_all' type='text' name='mmm'   value='<?echo $mezera_mezi_menu;?>' >          </td></tr> 
                        <tr><td><b>Medzera od loga</b></td>       <td align='right'><input class='form_all' type='text' name='mmlam' value='<?echo $mezera_mezi_logom_a_menu;?>' >  </td></tr>
                        <tr><td><b>Medzery mezi tabulkami</b></td>       <td><input class='form_all' type='text' name='v_s'   value='<?echo $vnutro_stranky;?>' >  </td></tr>                                                                                                                          
                        <tr><td><td><font size='-1'><i>⁄daj sa ud·va v pixeloch</i></font>    
                        <tr><td colspan=2 ><? admin_is_admin();?>
                        <tr><td><input class='button_all' type="submit" value="Zmena ˙dajov"> 
                        
                      </table>
                  </form>
        <?  include 'zaoblenie_end.php';    ?>
        </td>
    

    
        <td valign='top'  >
                    
        <?  $sprava_nadpis='Nastavenie Formul·rov';/*tato premenna je vlasne nadpis tabulky*/
            include 'zaoblenie_start.php';  ?> 
                  <form action="spracuj4.php" method="post">
                      <input type='hidden' name='zmena' value='formulare'>
                      <table>
                        <tr><td><b>äÌrka malÈho formul·ra</b></td>            <td align='right'><input class='form_all' type='text' name='form_w'       value='<?echo $form_w;?>' >     </td></tr>                      
                        <tr><td><b>äÌrka veækÈho formul·ra</b></td>           <td align='right'><input class='form_all' type='text' name='textarea_w'   value='<?echo $textarea_w;?>' > </td></tr> 
                        <tr><td><b>V˝öka veækÈho formul·ra</b></td>           <td align='right'><input class='form_all' type='text' name='textarea_h'   value='<?echo $textarea_h;?>' > </td></tr> 
                        <tr><td><td><font size='-1'><i>⁄daj sa ud·va v poËte znakov</i></font>                                                                           
                        <tr><td colspan=2 ><? admin_is_admin();?>
                        <tr><td><input class='button_all' type="submit" value="Zmena ˙dajov"> 
                      </table>
                  </form>
        <?  include 'zaoblenie_end.php';    ?>
        
       <img src='bg/spacer.gif' height='<?echo ($vnutro_stranky*3);?>' border=0>
       
         
        <?  $sprava_nadpis='Resetovanie nastavenÌ';/*tato premenna je vlasne nadpis tabulky*/
            include 'zaoblenie_start.php';  ?> 
                  <form action="spracuj4.php" method="post">
                      <input type='hidden' name='zmena' value='reset'>
                      <table>
                          <tr><td><input class='button_all' type="submit" value="Resetovanie nastavenÌ">    
                      </table>           
                  </form>
                  
                  <font size='-1'><i>Vaöe nastavenia okien <br /> sa zmenia na zakladnÈ nastavenia</i></font>    
        <?  include 'zaoblenie_end.php';    ?>
        </td>


  <!------------------------------------------------------------------------------------------------------------------------->          
        <tr>
        
          <td valign='top' >
        <?  $sprava_nadpis='vysvetlivky na tabuæku';/*tato premenna je vlasne nadpis tabulky*/
            include 'zaoblenie_start.php';  ?> 
                  <form action="spracuj4.php" method="post">
                      <input type='hidden' name='zmena' value='riadky'>
                      <table>
                        <tr><td colspan=2 align='center'><font size='-1'><i>Nastavuje sa poËet zobrazovan˝ch riadkov v ˙prav·ch</i></font>
                        <tr><td><b>V uprav·ch</b></td>            <td  align='right'><input class='form_all' type='text' name='rnt'       value='<?echo $riadky_na_tabulku;?>' >     </td></tr>                      
                        <tr><td><b>V pridanÌ Ël·nku</b></td>            <td  align='right'><input class='form_all' type='text' name='rntpc'    value='<?echo $riadky_na_tabulku_pc;?>' >  </td></tr>  
                        <tr><td><td><font size='-1'><i>⁄daj sa ud·va v poËte riadkov</i></font>                                                                           
                        <tr><td colspan=2 ><? admin_is_admin();?>
                        <tr><td><input class='button_all' type="submit" value="Zmena ˙dajov"> 
                      </table>
                  </form>
        <?  include 'zaoblenie_end.php';    ?>        
        
        </td>




    
<!------------------------------------------------------------------------------------------------------------------------>        


    
     <td valign='top' >
       <?  $sprava_nadpis='POP UP nastavenia';/*tato premenna je vlasne nadpis tabulky*/
            include 'zaoblenie_start.php';  ?> 
                  <form action="spracuj4.php" method="post">
                      <input type='hidden' name='zmena' value='popup'>
                      <table>
                        <tr><td><b>V˝öka okna</b></td>   <td align='right'><input class='form_all' type='text' name='popupv'       value='<?echo $popupv;?>' >     </td></tr>                                          
                        <tr><td><b>äÌrka okna</b></td>   <td align='right'><input class='form_all' type='text' name='popups'       value='<?echo $popups;?>' >     </td></tr>                                          
                        <tr><td><td><font size='-1'><i>⁄daj sa ud·va v pixeloch</i></font>   
                        <tr><td colspan=2 ><? admin_is_admin();?>
                        <tr><td><input class='button_all' type="submit" value="Zmena udajov">    
                      </table>           
                  </form>
       <?  include 'zaoblenie_end.php';    ?>     



<?
if ($TTright==5)
{
?>
<tr>













       <td valign='top'>
          <?  $sprava_nadpis='Little silver info';/*tato premenna je vlasne nadpis tabulky*/
            include 'zaoblenie_start.php';  ?> 
                  <form action="spracuj4.php" method="post">
                      <input type='hidden' name='zmena' value='lsi'>
                      <table>
                        <tr><td colspan=2 align='center'><b>Zobraziù little silver info?</b>
                        <tr><td> ANO<input type='radio' <?if ($zobraz_litle_silver_info==1){echo " checked  ";}?> name='zlsi' value='1' > NIE <input type='radio' <?if ($zobraz_litle_silver_info==0){echo " checked  ";}?> name='zlsi' value='0' >                                                                                                
                        <tr><td><font size='-2'><i>Little silver info su male striebornÈ informacie, ktorÈ sa zobrazia<br>
                                                        v spodnej Ëasti st·nky. Sluûia hlavne na riesenie problemov.</i></font> 
                        <tr><td><input class='button_all' type="submit" value="Zmena ˙dajov"> 
                      </table>
                  </form>
        <?  include 'zaoblenie_end.php';    ?>   
  
       
       
       
      <td valign='top' >
        <?  $sprava_nadpis='Zmena registraËn˝ch podmienok';/*tato premenna je vlasne nadpis tabulky*/
            include 'zaoblenie_start.php'; 
            
 $sql_reg="SELECT reg_form FROM admin_nast WHERE id='1'"; /* test ci uz vyraz neexistuje*/
                          $sql_reg_sq= mysql_query ($sql_reg) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
                          $vysledok_form=mysql_fetch_array ($sql_reg_sq);
            
             ?> 
               <form action="spracuj4.php" method="post">   
                    <input type='hidden' name='zmena' value='formular'> 
                    <table>
                      
                      <tr>
                        <td><textarea class='select' cols='35' rows='5' name='text'><?echo $vysledok_form[0];?></textarea>
                      </tr>
                      <tr><td><input class='button_all' type="submit" value="Zmena podmienok"> 
                    </table>
              </form>                    
        <?  include 'zaoblenie_end.php';    ?>
        </td>
<?}?>

</table>
