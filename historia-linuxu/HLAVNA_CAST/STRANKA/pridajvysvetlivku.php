<?
include 'autorizacia.php';
/*
include 'spojenie_s_db.php';
include 'funkcie.php';
include 'cs.php';

su zahrnute v samotnom index.php
*/

/* sirka textarea a vlasne aj vsetkych formularov */


if (isset ($_GET['edit']))  {$edit=$_GET['edit'] ;}
if (isset ($_POST['edit']))  {$edit=$_POST['edit'];}


if (isset ($edit))
{

$sql="SELECT * FROM expl WHERE id = $edit" ;

$spust_sqlx= mysql_query ( $sql ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
while ($asd= mysql_fetch_assoc( $spust_sqlx ))
{
/* ziskam z DB premenne s hodnotami*/
extract( $asd );
}

$can_I=mas_na_to_pravo('autor_v', $id, 'id_expl', 'update');
if (!$can_I) {  DIE ('Na toto nemate pravo... ');}

}




?>
<script language="Javascript" type="text/javascript">

function vlozbb(what)
  {
  document.formular.vysvetlenie.value = document.formular.vysvetlenie.value + what; 
  document.formular.vysvetlenie.focus(); 
  }

</script>


<table align='center' border=0 cellpadding='<?echo $vnutro_stranky;?>'  cellspacing='<?echo $vnutro_stranky;?>'>
          <tr>
              <td > 
                    <?$sprava_nadpis='';?>
                    <? include 'zaoblenie_start.php';?>
                     <p class='txtnadpis'>Pridanie vysvetlívky</p>
                    <? include 'zaoblenie_end.php';?>
              </td>
          </tr>

  <form name="formular" action='spracuj.php' method='post'>
 <input type='hidden' name='spracovanie' value='vysvetlivka'>
   <? if (isset($edit)){ echo " <input type='hidden' name='edit' value='$edit'>";} ?> 
 <tr>
  
            
              <td > 
                  <table align=center>
                  <tr>
                  <td>
                    <?$sprava_nadpis='Názov novej vysvetlivky';?>
                    <? include 'zaoblenie_start.php';?>
                     <input class='form_all' type='text' name='vyraz' size='<?echo ($form_w); ?>' value='<? if (isset ($edit)){echo $vyraz;} else {echo 'Názov novej vysvetlivky';} ?>' >
                    <? include 'zaoblenie_end.php';?>
                  </td>
                  </tr>
                  </table>
              </td>

  </tr>
  
  
  
    <tr>
  
    <td valign='top' width='5'>
      <img src='bg/spacer.gif' border=0>
    </td>
</tr>
<tr>
  <td>
                                               <?$sprava_nadpis='';?>
                    <? include 'zaoblenie_start.php';?>
                                 <table><!--XXX56--->
                                                        <tr>
                                                          <td>
                                                          <!------------------------FRABY------border=3 bordercolor='#fbcf3b' cellpadding='0' cellspacing='0' ------------------->
                                                                  <table class='table_bb_farby'"><!--XXX51--->
                                                                    <tr>
                                                                      <td><a href="#" onclick="vlozbb('[farba=maroon]');  return false;"><img src="tlacitka/bb/farby/tlacitko_color_maroon.jpg"  alt="maroon"  border=0 width="18" height="18"></a>
                                                                      <td><a href="#" onclick="vlozbb('[farba=siva]');    return false;"><img src="tlacitka/bb/farby/tlacitko_color_siva.jpg"    alt="siva"    border=0 width="18" height="18"></a>
                                                                      <td><a href="#" onclick="vlozbb('[farba=fialova]'); return false;"><img src="tlacitka/bb/farby/tlacitko_color_fialova.jpg" alt="fialova" border=0 width="18" height="18"></a>
                                                                    </tr>
                                                                    <tr>
                                                                      <td><a href="#" onclick="vlozbb('[farba=cervena]'); return false;"> <img src="tlacitka/bb/farby/tlacitko_color_red.jpg"     alt="cervena" border=0 width="18" height="18"></a>
                                                                      <td><a href="#" onclick="vlozbb('[farba=hneda]');   return false;"> <img src="tlacitka/bb/farby/tlacitko_color_hneda.jpg"   alt="hneda"   border=0 width="18" height="18"></a>
                                                                      <td><a href="#" onclick="vlozbb('[farba=modra]');   return false;"> <img src="tlacitka/bb/farby/tlacitko_color_modra.jpg"   alt="modra"   border=0 width="18" height="18"></a>
                                                                    </tr>
                                                                    <tr>
                                                                      <td><a href="#" onclick="vlozbb('[farba=oranzova]'); return false;"><img src="tlacitka/bb/farby/tlacitko_color_oranzova.jpg" alt="oranzova"       border=0 width="18" height="18"></a>
                                                                      <td><a href="#" onclick="vlozbb('[farba=fs]');       return false;"><img src="tlacitka/bb/farby/tlacitko_color_fs.jpg"       alt="farba stranky"  border=0 width="18" height="18"></a>
                                                                      <td><a href="#" onclick="vlozbb('[farba=zelena]');   return false;"><img src="tlacitka/bb/farby/tlacitko_color_zelena.jpg"   alt="zelena"         border=0 width="18" height="18"></a>
                                                                    </tr>  
                                                                    
                                                                    <tr>                                                                    <tr>
                                                                      <td class='td_bb_vysky' colspan=3 align= center><a href="#" onclick="vlozbb('[/farba]'); return false;"><img src="tlacitka/bb/farby/tlacitko_color_farba.jpg" alt="ukoncenie [/farba]" border=0 width="54" height="9"></a>
                                                                    </tr>
                                                                    
                                                                  </table><!--XXX51--->
                                                          <td>
                                                          <!------------------------Stredne BB kody--------------->
                                                            <table><!--XXX52--->
                                                                    <tr>
                                                                      <td align=center>
                                                                              <table><!--XXX53--->
                                                                                <tr>
                                                                                
                                                                                <td><a href="#" onclick="vlozbb('[tab]');       return false;"><img src="tlacitka/bb/tlacitko_zkalad_tab.jpg"       alt="Tabulator"         border=0 width="40" height="20"></a>
                                                                                <td><a href="#" onclick="vlozbb('[m]');         return false;"><img src="tlacitka/bb/tlacitko_zkalad_m.jpg"         alt="Medzera"           border=0 width="40" height="20"></a>
                                                                                <td><a href="#" onclick="vlozbb('[n]');         return false;"><img src="tlacitka/bb/tlacitko_zkalad_n.jpg"         alt="Enter"             border=0 width="40" height="20"></a>
                                                                                
                                                                                </tr>
                                                                              </table><!--XXX53--->
                                                                      
                                                                              <table> <!--XXX54--->
                                                                                <tr>
                                                                                
                                                                                <td><a href="#" onclick="vlozbb('[b]');       return false;"><img src="tlacitka/bb/tlacitko_zkalad_b.jpg"       alt="Tuèný"         border=0 width="30" height="20"></a>
                                                                                <td><a href="#" onclick="vlozbb('[i]');       return false;"><img src="tlacitka/bb/tlacitko_zkalad_i.jpg"       alt="Šikmý"         border=0 width="30" height="20"></a>
                                                                                <td><a href="#" onclick="vlozbb('[url=]');    return false;"><img src="tlacitka/bb/tlacitko_zkalad_url.jpg"     alt="Url adresa"    border=0 width="38" height="20"></a>
                                                                                <td><a href="#" onclick="vlozbb('[stred]');   return false;"><img src="tlacitka/bb/tlacitko_zkalad_stred.jpg"   alt="Text na stred" border=0 width="52" height="20"></a>
                                                                                
                                                                                </tr>
                                                                                
                                                                                <tr>
                                                                                
                                                                                <td><a href="#" onclick="vlozbb('[/b]');       return false;"><img src="tlacitka/bb/tlacitko_zkalad_b_l.jpg"       alt="Tuèný koniec"         border=0 width="30" height="20"></a>
                                                                                <td><a href="#" onclick="vlozbb('[/i]');       return false;"><img src="tlacitka/bb/tlacitko_zkalad_i_l.jpg"       alt="Šikmý koniec"         border=0 width="30" height="20"></a>
                                                                                <td><a href="#" onclick="vlozbb('[/url]');    return false;"><img src="tlacitka/bb/tlacitko_zkalad_url_l.jpg"     alt="Url adresa koniec"    border=0 width="38" height="20"></a>
                                                                                <td><a href="#" onclick="vlozbb('[/stred]');   return false;"><img src="tlacitka/bb/tlacitko_zkalad_stred_l.jpg"   alt="Text na stred koniec" border=0 width="52" height="20"></a>
                                                                                
                                                                                </tr>
                                                                              </table><!--XXX54--->
                                                                       </td>       
                                                                    <tr>
                                                              </table><!--XXX52--->
                                                          <td>
                                                          
                                                          
                                                          
                                                          <!------------------------VELKOSTI-------------------->
                                                                       <table class='table_bb_vysky'" height=84><!--XXX55--->
                                                                         <tr>
                                                                            <td class='td_bb_vysky'><a href="#" onclick="vlozbb('[velkost=mensie]');   return false;"><img src="tlacitka/bb/vysky/tlacitk_vyska_mensie.jpg"  alt="mensie pismo"  border=0 width="54" height="9"></a>
                                                                            <td class='td_bb_vysky'><a href="#" onclick="vlozbb('[velkost=velke]');    return false;"><img src="tlacitka/bb/vysky/tlacitk_vyska_velke.jpg"   alt="velke pismo"   border=0 width="54" height="9"></a>
                                                                         </tr>
                                                                         <tr>
                                                                            <td class='td_bb_vysky'><a href="#" onclick="vlozbb('[velkost=male]');     return false;"> <img src="tlacitka/bb/vysky/tlacitk_vyska_male.jpg"   alt="male pismo"   border=0 width="54" height="9"></a>
                                                                            <td class='td_bb_vysky'><a href="#" onclick="vlozbb('[velkost=vacsie]');   return false;"><img src="tlacitka/bb/vysky/tlacitk_vyska_vacsie.jpg"  alt="vacsie pismo"  border=0 width="54" height="9"></a>
                                                                         </tr>
                                                                        
                                                                          <tr>
                                                                            <td class='td_bb_vysky'><a href="#" onclick="vlozbb('[velkost=normal]');   return false;"><img src="tlacitka/bb/vysky/tlacitk_vyska_normal.jpg"  alt="normal pismo"  border=0 width="54" height="9"></a>
                                                                            <td class='td_bb_vysky'><a href="#" onclick="vlozbb('[velkost=obor]');     return false;"><img src="tlacitka/bb/vysky/tlacitk_vyska_obor.jpg"    alt="obor pismo"     border=0 width="54" height="9"></a>
                                                                          </tr>
                                                                           
                                                                          <tr>                                                                   
                                                                            <td class='td_bb_vysky' colspan=3 align= center><a href="#" onclick="vlozbb('[/velkost]'); return false;"><img src="tlacitka/bb/vysky/tlacitk_vyska_velkost.jpg" alt="ukoncenie [/velkost]" border=0 width="54" height="9"></a>
                                                                          </tr>      
                                                                      </table><!--XXX55--->
                                                         
                                                         
                                                         
                                                         </tr>
                                                         
                                                           
                                </table><!--XXX56--->
                  <? include 'zaoblenie_end.php';?>
    
  </td>
</tr>
   <tr> 
    <td>              
       <?$sprava_nadpis='Vysvetlivka';?>
       <? include 'zaoblenie_start.php';?>
          
         <textarea maxlength=255 class='form_all' name='vysvetlenie' cols='<?echo $textarea_w; ?>' rows='6'><? if (isset($edit)){echo $vysvetlenie; } else echo "Vysvetlivka"; ?></textarea>
       <? include 'zaoblenie_end.php';?>  
    </td>
  </tr>

  <tr>  
    <td>
       <? 
       if (isset($edit)){ echo "<input class='button_all' type='submit' value='Upravi vysvetlivku $vyraz'>";}       
       else {echo "<input class='button_all' type='submit' value='Prida vysvetlivku'>"; }
      ?>
     </td>
  </tr>
  
  
  </form>
</table>
<br />
