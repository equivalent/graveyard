<?php




function id_chcem()
{
$TVmoje_user=$_SESSION['moje_user'];

    $sql_reg="SELECT id FROM profil WHERE user='$TVmoje_user'"; /* test ci uz vyraz neexistuje*/
                              $sql_reg_sq= mysql_query ($sql_reg) or die ("<font size=+3 color='red'>Závažná chyba!!</font><br />
                              <font size=+1 color='red'>ERROR</font><br />
                              Zlyhanie systemu. Ak ste tento problém nezavinily Vy kontaktuje PROSI administratora<br />
                              emailom <b>historialinuxu@gmail.com</b> a ohlaste <font color=orange>Chyba 877-9</font> a uvedte vaše prihlasovacie meno<br /><br />
                              DAKUJEME");
                              $vysledok_form=mysql_fetch_array ($sql_reg_sq);
     $id=$vysledok_form[0];
     return ($id);
}                         

                   
function prava_chcem() 
{
$id=id_chcem();
  $sql_reg="SELECT prava FROM profil WHERE id='$id'"; /* test ci uz vyraz neexistuje*/          
                              $sql_reg_sq= mysql_query ($sql_reg) or die ("<font size=+3 color='red'>Závažná chyba!!</font><br />
                              <font size=+1 color='red'>ERROR</font><br />
                              Zlyhanie systemu. Ak ste tento problém nezavinily Vy kontaktuje PROSI administratora<br />
                              emailom <b>historialinuxu@gmail.com</b> a ohlaste <font color=orange>Chyba 899-9</font> a uvedte vaše prihlasovacie meno<br /><br />
                              DAKUJEME");
                              $vysledok_form=mysql_fetch_array ($sql_reg_sq);
    $right=$vysledok_form[0];                              
    return ($right);
}  

function nastavenia_chcem() 
{
$id=id_chcem();
  $sql_reg="SELECT id_nastavenia FROM profil WHERE id='$id'"; /* test ci uz vyraz neexistuje*/          
                              $sql_reg_sq= mysql_query ($sql_reg) or die ("<font size=+3 color='red'>Závažná chyba!!</font><br />
                              <font size=+1 color='red'>ERROR</font><br />
                              Zlyhanie systemu. Ak ste tento problém nezavinily Vy kontaktuje PROSI administratora<br />
                              emailom <b>historialinuxu@gmail.com</b> a ohlaste <font color=orange>Chyba 855-9</font> a uvedte vaše prihlasovacie meno<br /><br />
                              DAKUJEME");
                              $vysledok_form=mysql_fetch_array ($sql_reg_sq);
    $right=$vysledok_form[0];                              
    return ($right);
}  


/*
Projek histori linuxu funguje na istej hierarchii kde najnizsie su neregistrovany uzivatelia a najvysie admin
tu su jednotlive prava

1 neregistrovany uzivatel, moze sa iba pozerat
2 registrovany uzovatel - moze upravit a pridat udaje do clanku, moze i vytvorit clanok, no musi byt jeho cinnost potvrdena
3 moderator - moze upravovat bez potvrdenia clanku pricom o jeho zmene budei informovany len admin
4 strazca - dava suhlas jednotlyvym uzivatelom na zmenu clanku, kazda potvrdenie je adminovy znama jeho cinnost. Strazca niako neovplyvnuje cinnost moderatrov
5 admin - ma prava nad vsetkymi a kontorluje vsetkych

*/


function mas_na_to_pravo ($tabulka, $vyraz, $pole, $operacia)
                        {
                        
    //$operacia je nevyuzity operand.
    // mal sluzit na editacia clankov userom ktory niesu registrovany
    // v dalsej verzii tejto stranky uz sa bude pouzivat, neni dovod na jeho odstranenie                    
 $operacia=$operacia;
                        
$TTmoje_id=id_chcem();
$TTmoje_prava=prava_chcem();

 global $vyhrazna_sprava_3;
 global $vyhrazna_sprava_end;
 

 
  $sql_zisti_ci_je_autor="SELECT id_usera FROM $tabulka WHERE $pole='$vyraz'"; /* test ci uz vyraz neexistuje*/
                          $spust_sql_zisti_ci_= mysql_query ($sql_zisti_ci_je_autor) or die ("<font size=+3 color='red'>Závažná chyba!!</font><br />
                              <font size=+1 color='red'>ERROR</font><br />
                              Zlyhanie systemu. Ak ste tento problém nezavinily Vy kontaktuje PROSI administratora<br />
                              emailom <b>historialinuxu@gmail.com</b> a ohlaste <font color=orange>Chyba 333-9</font> a uvedte vaše prihlasovacie meno<br /><br />
                              DAKUJEME");
                          $vysledok=mysql_fetch_array ($spust_sql_zisti_ci_);    

if ($vysledok[0] == $TTmoje_id)  {$mozem=1;}   
elseif ($TTmoje_prava >3)  {$mozem=1;}
else  {$mozem=0;}                                      
                     return ($mozem);                         
                        }


function admin_has_seen_it ($tabulka, $id_coho, $id, $new)
{ 

/*priklad   $tabulka= autor_c; $id_coho = id_clanku  $id=1*/



$mojeprava= prava_chcem();
 if($mojeprava==4 and $new==2){
 
$sql_uprav_vyraz= "UPDATE $tabulka SET new = 0 WHERE $id_coho = $id ";
mysql_query ( $sql_uprav_vyraz ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);     
                               }
 elseif($mojeprava==5 and $new>0){

$sql_uprav_vyraz= "UPDATE $tabulka SET new = 0 WHERE $id_coho = $id ";
mysql_query ( $sql_uprav_vyraz ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);     
                                  }

return (1);

}
                        
?>
