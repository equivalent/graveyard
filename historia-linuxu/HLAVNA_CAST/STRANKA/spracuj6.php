<?php
foreach ( $_POST as $kluc => $hodnota){
$$kluc= $hodnota; 
}



include "autorizacia.php";  
include "spojenie_s_db.php";
include "funkcie.php";
include 'id_gether.php';
$TTmoje_id=id_chcem();
$TTmoje_prava=prava_chcem();

   

if (isset($godpower) and  $godpower==1 and  $TTmoje_prava ==5) {$vse_je_all_right=1;}
else {$vse_je_all_right=0;}
   $eghr="";
   if (isset ($id_upravT) and $vse_je_all_right ){ $TTmoje_id = $id_upravT; $eghr="&id_upravT=$TTmoje_id"; } 
  

      
 
      
  if (isset($zobraz_em)) {$zverej_email=1;} else {$zverej_email=0;}
                  
                    if (($email=="" and tover_mail($email)) ) {$write="index.php?action=admin&adminaction=nastavenia_profil&error=3$eghr";}
                    else { 
                           
                           if ($pass1!="" or $pass2!="")
                           {
                               
                               
                                
                                    if ($pass1==$pass2)
                                    {  
                                             
                                           if(isset ($oldpass) ) {$my_heslo=$oldpass;}
                                           else {$my_heslo='a'; /*to je jedno comu sa teraz rovna aj tak sa nevyuzije!!!!*/}
                                             
                                             
                                        /**/  
                                        /**/  $my_heslo=md5($my_heslo);
                                        /**/  $sql_id_pass=" SELECT id_pass FROM profil WHERE id=$TTmoje_id  ";
                                        /**/  $zistenie_id_pass=mysql_query ($sql_id_pass) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
                                        /**/  $zistenie_zistenia_id_pass= mysql_fetch_array ($zistenie_id_pass);
                                        /**/  $id_pass=$zistenie_zistenia_id_pass[0];
                                        /**/ 
                                        /**/  $sql_pass=" SELECT pass FROM heslo WHERE id= ".$id_pass."  ";
                                        /**/  $zistenie=mysql_query ($sql_pass) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
                                        /**/  $zistenie_pola= mysql_fetch_array ($zistenie);
                                              
                                          if (($my_heslo==$zistenie_pola[0]) or  $vse_je_all_right)
                                          {
                                                  $pass1=md5($pass1);
                                              $sql_uprav_pass= "UPDATE heslo SET pass = '$pass1' WHERE id=$id_pass ";
                                               mysql_query ( $sql_uprav_pass ) or die ($vyhrazna_sprava_4.$vyhrazna_sprava_end);
                                                             
                                     
                                          }
                                           else { $write='index.php?action=admin&adminaction=nastavenia_profil&error=4'.$eghr;
                                          if ( headers_sent()) { echo "<b><a href='$write'>Pokracovat dalej</a></b>";}
                                          else { header ("Location:$write");}                             
                                          die; 
                                          }
                                    }
                                    
                                    else { $write='index.php?action=admin&adminaction=nastavenia_profil&error=4'.$eghr;
                                          if ( headers_sent()) { echo "<b><a href='$write'>Pokracovat dalej</a></b>";}
                                          else { header ("Location:$write");}                             
                                          die; 
                                         }       
                               
                            }
                          
                          
                          $sql_uprav_pass= "UPDATE profil SET email = '$email', real_name= '$real_name', real_priezv = '$real_priezv', nieco_o = '$nieco_o',  zverej_email= $zverej_email WHERE id=$TTmoje_id";
                          mysql_query ( $sql_uprav_pass ) or die ($vyhrazna_sprava_4.$vyhrazna_sprava_end);
                          $write="index.php?action=admin&adminaction=nastavenia_profil&okokok=1$eghr";       
 
                                

                             

                 }   
                                          if ( headers_sent()) { echo "<b><a href='$write'>Pokracovat dalej</a></b>";}
                                          else { header ("Location:$write");}     
?>
