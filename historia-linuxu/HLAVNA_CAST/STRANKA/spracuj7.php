<?php
include 'spojenie_s_db.php';
include 'autorizacia.php';
include 'id_gether.php';
$TTmojeprava=prava_chcem();

/*************************************************/$TOTAL_ERROR="<font color = 'red'>Zavazna chyba, snazite sa naburat system, vaša IP adresa je zaznamenana<br />
                                                   Ak ste tento problem nezavinily vy prosim kontaktujte admina na adrese <B>historialinuxu@gmail.com</b><br />
                                                   Uvedte ako predmet spravy ERROR";
if ($TTmojeprava<5) {die ($TOTAL_ERROR."USR-NST</font>"); }




foreach ( $_POST as $kluc => $hodnota){
$$kluc= $hodnota;
    } 



switch ($what)
{
case 'prava':
if (! isset ($id) ){die ("Zavazna chyba! "); }

       $sql_uprav_pravo= "UPDATE profil SET prava = '$prava' WHERE id = $id ";
       mysql_query ( $sql_uprav_pravo ) or die ($vyhrazna_sprava_4.mysql_error().$vyhrazna_sprava_end);
     $write="celyprofil.php?id=$id&HREBALL_ism=$HREBALL_ism";
break;


case 'delete':
if (! isset ($id) ){die ("Zavazna chyba! "); }

if (isset ($ano_som) ){

      $sql_uprav= "UPDATE profil SET is_active = '0' , prava = '0'  WHERE id = $id ";
       mysql_query ( $sql_uprav ) or die ($vyhrazna_sprava_4.mysql_error().$vyhrazna_sprava_end);
     
       $sql_vymaz= "DELETE FROM heslo WHERE id= $id ";
      mysql_query ( $sql_vymaz ) or die ($vyhrazna_sprava_5.mysql_error().$vyhrazna_sprava_end);
     
     $write="index.php?action=admin&adminaction=profil&delele=1";


                      }
else {$write="celyprofil.php?id=$id&ch=1&HREBALL_ism=$HREBALL_ism";}                      



break;


default:
break;
}
      if ( headers_sent()) { echo "<b><a href='$write'>Pokracovat dalej</a></b>";}
      else { header ("Location:$write");}

?>
