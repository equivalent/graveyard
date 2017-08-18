<?php
session_start();
include 'spojenie_s_db.php';
include 'funkcie.php';

/*osobitny skript na zistenie spravnosti hesla */

$presmeruj="index.php?action=admin";
$gener=$_POST['gen_er'];
$overenie= $_POST['overovaci_kod'];

include "generauj_vysledok.php";                                       
                        

if ($overenie==$kod[$gener])
{   


    $user=$_POST['user'];
    $existuje_dakto_taky=select_count ('profil', $user, 'user');    
    if($existuje_dakto_taky)
    {
        $my_heslo=$_POST['helso'];
        $my_heslo=md5($my_heslo);
        $sql_id_pass=" SELECT id_pass FROM profil WHERE user= '".$user."'  ";
        $zistenie_id_pass=mysql_query ($sql_id_pass) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
        $zistenie_zistenia_id_pass= mysql_fetch_array ($zistenie_id_pass);
        $id_pass=$zistenie_zistenia_id_pass[0];
       
        $sql_pass=" SELECT pass FROM heslo WHERE id= ".$id_pass."  ";
        $zistenie=mysql_query ($sql_pass) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
        $zistenie_pola= mysql_fetch_array ($zistenie);
        
        if ($my_heslo==$zistenie_pola[0])
        {
          $_SESSION['moje_heslo']=$my_heslo;
          $_SESSION['moje_user']=$user;
          
          $write=$presmeruj;
        }
       else
        {
        $write="index.php?co_spravit=prihlas&nespravne=1";
        }
    
    }
    else {$write="index.php?co_spravit=prihlas&nespravne=1";}
}
else
{
$write="index.php?co_spravit=prihlas&nespravne=1";
}

     $write;
      if ( headers_sent()) {echo "<b><a href='$write'><u>Pokracovat >>></u></a></b>"; }
      else { header ("Location: $write ");}

?>
