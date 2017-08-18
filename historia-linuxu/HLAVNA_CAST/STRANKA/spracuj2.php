<?php
include 'spojenie_s_db.php';
include 'autorizacia.php';
/*
Poznamka pre upravovatela tejto stranky. Stranka sa da upravit aj tak aby upravovat mohlo viac administratorov. treba dorobit formular pre pridanie
uzivatela a upravit skripty pre testovanie , lebo vsetky SQL dotazy pre upravu a kontroly su pre id=1
*/


/************************************************************************************************************Zmena hesla**************/

$oldpassword=md5($_POST['oldpassword']);

$sql_over="SELECT COUNT(id) FROM heslo WHERE pass='". $oldpassword ."'";
$vykonajsql_over=mysql_query($sql_over) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
$hodnoty=mysql_fetch_array($vykonajsql_over);

if($hodnoty[0]==1)
{
/*overene, mozem menit heslo*/

    if ( (strlen($newpassword)) >8 )
      {
$newpassword=md5($_POST['newpassword']);
        $sql_zmena_hesla="UPDATE heslo SET pass='".$newpassword."' WHERE id=1 ";
        mysql_query($sql_zmena_hesla) or die ($vyhrazna_sprava_4.mysql_error().$vyhrazna_sprava_end);
        
        $sprava= "<font color='green'>Heslo uspesne zmenene </font>";
      }
    else 
      {$sprava= "<font color='red'>Heslo priliö kr·tke. </font>";}
}
else 
{$sprava= "<font color='red'>Nespravne heslo !!! </font>";}

$write="index.php?action=admin&adminaction=nastavenia_admina";
            if ( headers_sent()) { echo "$sprava <b><a href='$write'>Uk·zaù upload</a></b>";}
            else { header ("Refresh: 2; URL=$write"); echo "$sprava <br /><br /><br /> Budete automaticky presmerovany...";}
            
            
            
?>
