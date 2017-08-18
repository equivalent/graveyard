<?php
foreach ( $_POST as $kluc => $hodnota){
$$kluc= $hodnota; 
}



if( isset($zobraz_em)){$em="&zobraz_em=1";}
else {$em="";}



$backurl="&user=$user&email=$email&meno=$meno&priezvysko=$priezvysko".
         "&profil=$profil".$em;




if (!isset ($akceptujem)) {$write="registracia.php?error=2$backurl";}// overim ci suhlasi s podmienkami
else{ 
    
     include "generauj_vysledok.php";
     
  
     $porovnanie=$kod[$gen_er];
     if (!$overovaci_kod==$porovnanie){$write="registracia.php?error=18$backurl";} 
     else{
         include "spojenie_s_db.php";
         include "funkcie.php";
         //select_count ($tabulka, $vyraz, $pole)  return pocent najdenych
         $existuje= select_count ('profil', $user, 'user');
         if  ($existuje!=0) {$write="registracia.php?error=4$backurl";}  
            
              else {
              
                    if (($email=="" or $email=="xxxxxxxxx@nnnn.ggg" ) and tover_mail($email)){$write="registracia.php?error=3$backurl";}
                    else {
                           if ($pass1!=$pass2 or $pass1=="")
                              {$write="registracia.php?error=5$backurl";}
                           else{
                                
                                
                            $sql_vyber_vnutor_nastavenia="SELECT * FROM nastavenia WHERE id=1";
                            $sql_vvn= mysql_query($sql_vyber_vnutor_nastavenia) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
                            $extrect_vvn= mysql_fetch_array($sql_vvn);
                            extract ($extrect_vvn);
                            
                              $sql1= 
                              " INSERT INTO nastavenia SET stm = '$stm', ".
                                                    " vpo = '$vpo', ".
                                                    " vlo = '$vlo', ".
                                                   " mmlp = '$mmlp', ".
                                                    " mmm = '$mmm', ".
                                                  " mmlam = '$mmlam', ".                        
                                                    " v_s = '$v_s', ".
                                                 " form_w = '$form_w', ".
                                             " textarea_w = '$textarea_w', ".
                                             " textarea_h = '$textarea_h', ".
                                                    " rnt = '$rnt', ".
                                                 " popupv = '$popupv', ".
                                                 " popups = '$popups', ".
                                                  " rntpc = '$rntpc' ";  
                              mysql_query($sql1) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
                             
                             $id_nastavenia= posledny_zaznam('nastavenia');   
                             $pass1=md5($pass1);
                             $sql3=" INSERT INTO heslo SET pass = '$pass1' "; 
                               mysql_query ($sql3) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end); 
                             
                             $id_pass= posledny_zaznam('heslo');
                                
                                if( isset($zobraz_em)){$eme=1;} else {$eme=0;}
                                $date= date("Y-m-d"); 
                                $sql2="INSERT INTO profil ( user, real_name, real_priezv, email, nieco_o, zverej_email, prava, is_active, datum, id_nastavenia, id_pass)  ". 
                               "VALUE ('".$user."', '".$meno."', '".$priezvysko."', '".$email."', '".$profil."', $eme, 2, 1, '$date',  $id_nastavenia, $id_pass)";   
                               
                               mysql_query ($sql2) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
                             
                               $write="index.php?co_spravit=prihlas";
                               }   
                          }  
              
                    }

          }
   }

      if ( headers_sent()) { echo "<b><a href='$write'>Pokracovat dalej</a></b>";}
      else { header ("Location:$write");}

?>
