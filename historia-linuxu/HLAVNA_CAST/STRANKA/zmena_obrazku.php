<?php
include 'spojenie_s_db.php';
include 'autorizacia.php';
include 'id_gether.php';








/*************************************************/$TOTAL_ERROR="<font color = 'red'>Zavazna chyba, snazite sa naburat system, vaöa IP adresa je zaznamenana<br />
                                                   Ak ste tento problem nezavinily vy prosim kontaktujte admina na adrese <B>historialinuxu@gmail.com</b><br />
                                                   Uvedte ako predmet spravy ERROR";


if (isset  ($_POST['delete_id']) or isset  ($_GET['delete_id']) )
{


if (isset  ($_POST['delete_id'])) {$delete_it=$_POST['delete_id'];}
if (isset  ($_GET['delete_id'])) {$delete_it=$_GET['delete_id'];}
                 
                 
                    $can_I=mas_na_to_pravo('autor_o', $delete_it, 'id_obr', 'delete');
                    if ($can_I==0) {die ("$TOTAL_ERROR OBR-566=$delete_it</font>");}
                                            

$hmm_obrazok="imggalery/" .$delete_it. ".jpg";
$hmm_miniatura="imggalery/miniatury/" .$delete_it. ".jpg";

    if (file_exists ($hmm_obrazok) )
    {
    mysql_query ("DELETE FROM autor_o WHERE id_obr =".$delete_it)
    or die ($vyhrazna_sprava_5.mysql_error().$vyhrazna_sprava_end);
    
    mysql_query ("DELETE FROM obrazok WHERE id =".$delete_it)
    or die ($vyhrazna_sprava_5.mysql_error().$vyhrazna_sprava_end);
  
    unlink ($hmm_obrazok);
    unlink ($hmm_miniatura);
      
$write="delete_pop_up.php?a_ok=1";
    if ( headers_sent()) { echo "Obrazok bol uspesne upraveny. <b><a href='$write'>Uk·zaù upload</a></b>";}
    else { header ("Location:$write");} 
    
    }//koniec testu ci existuje
    
    
    else 
    {
    echo "Subor $hmm_obrazok neexistuje .<br /> ";
    if (file_exists ($hmm_miniatura) )  {echo "Subor $hmm_miniatura neexistuje .<br /> ";}
    /*netestujem priamo v skripte ci miniatura existuje. Nieje totiz pre mna podstatna. Dolezite je vymazanie velkeho obrazku*/
    }
    
}//koniec if isset

/**************************************************Upravujem komentar***************************************************************/

elseif (isset  ($_POST['zmenkomentar']))
{



$sprava=$_POST['zmenkomentar'];
$sprava=addslashes($sprava);

$id=$_POST['iddd'];

                    $can_I=mas_na_to_pravo('autor_o', $id, 'id_obr', 'update');
                    if ($can_I==0) {die ("$TOTAL_ERROR OBR-555=$id</font>");}

mysql_query("UPDATE obrazok SET popis= '".$sprava."' WHERE id =".$id)
or die ($vyhrazna_sprava_4.mysql_error().$vyhrazna_sprava_end);

$write="ukaz_upload.php?id=$id";
    if ( headers_sent()) { echo "Obrazok bol uspesne upraveny. <b><a href='$write'>Zmenene, vratit sa.</a></b>";}
    else { header ("Location:$write");} 

}




/**************************************************Vloz popisok****************************************************************/

elseif (isset  ($_POST['aplikujkomentar']))
{
$id=$_POST['id_komentar'];

                    $can_I=mas_na_to_pravo('autor_o', $id, 'id_obr', 'update');
                    if ($can_I==0) {die ("$TOTAL_ERROR OBR-CREAT-wiev=$id</font>");}


$farba= $_POST['farba'];
$minux_y= $_POST['minux_y'];
$minux_x= $_POST['minux_x'];
$farba= $_POST['farba'];
$sql_komentar="SELECT popis FROM obrazok where id=$id";
$zistikomentar = mysql_query ( $sql_komentar ) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end); 
$komentar= mysql_fetch_array ($zistikomentar);
$komentar=$komentar[0];

//echo $utf_komentar= iconv('windows-1250', 'UTF-8', $komentar);
$nazovobrazok= "imggalery/$id".".jpg";
$nahladnazov= "imggalery/$id"."_nahlad.jpg";


          list( $sirka, $vyska, $typ, $atributy ) = getimagesize( $nazovobrazok );
          $obrazok = imagecreatefromjpeg( $nazovobrazok );
         
          
          imagettftext( $obrazok, 10 ,0 ,$minux_x ,$minux_y , $farba, "arial.ttf", $komentar );                             

          imagejpeg($obrazok, $nahladnazov);
$write="posledny_nahlad.php?id=$id&minux_x=$minux_x&minux_y=$minux_y&farba=$farba";
      if ( headers_sent()) { echo "<b><a href='$write'>Pokracovat dalej</a></b>";}
      else { header ("Location:$write");}

}

/**************************************************definitivne Vloz popisok****************************************************************/

elseif (isset  ($_POST['definitivneaplikuj']))
{
$id=$_POST['id_komentar'];
$nazovobrazok= "imggalery/$id".".jpg";
$newobrazok= "imggalery/$id"."_nahlad.jpg";

                    $can_I=mas_na_to_pravo('autor_o', $id, 'id_obr', 'update');
                    if ($can_I==0) {die ("$TOTAL_ERROR OBR-DELETE-wiev=$id</font>");}
                     $sql_autora= "UPDATE autor_o SET new = '3' WHERE id_obr = $id ";
                     mysql_query ( $sql_autora ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
unlink ($nazovobrazok);
rename($newobrazok, $nazovobrazok);

            $write="ukaz_upload.php?id=".$id;
            if ( headers_sent()) { echo "Obrazok BOL upraveny. <b><a href='$write'>PokraËovaù</a></b>";}
            else { header ("Location:$write");}

}
/**************************************************zrus popisok****************************************************************/

elseif (isset  ($_POST['goback']))
{
$id=$_POST['id_komentar'];
$minux_x=$_POST['minux_x'];
$minux_y=$_POST['minux_y'];
$farba=$_POST['farba'];
$newobrazok= "imggalery/$id"."_nahlad.jpg";
unlink ($newobrazok);
            $write="ukaz_upload.php?id="."$id&minux_x=$minux_x&minux_y=$minux_y&farba=$farba";
            if ( headers_sent()) { echo "Obrazok NEBOL upraveny. <b><a href='$write'>PokraËovaù</a></b>";}
            else { header ("Location:$write");}
}


/**************************************************Upravujem rozmery****************************************************************/

else{
      foreach ( $_REQUEST as $kluc => $hodnota){
      $$kluc= $hodnota;
          }
      $obrazok = "imggalery/" . $id. ".jpg";
      $novy_nazov="imggalery/" . $id. ".jpg";
      
                    $can_I=mas_na_to_pravo('autor_o', $id, 'id_obr', 'update');
                    if ($can_I==0) {die ("$TOTAL_ERROR OBR-CREAT-wiev=$id</font>");}
      
       list( $old_sirka, $old_vyska, $typ, $atributy ) = getimagesize( $obrazok );
      if (isset($autosirka)and !$autosirka==0 ){
            $sirka=$autosirka;
          
              $adekvatny_pomer= ($sirka/$old_sirka);
               $vyska= ($old_vyska*$adekvatny_pomer);
            $vyska= ceil($vyska);
      }
       $obrazok_na_upravu = imagecreatefromjpeg( $obrazok );
          $vytvoreny_obrazok_jpg = imagecreatetruecolor( $sirka, $vyska );
          imagecopyresampled( $vytvoreny_obrazok_jpg, $obrazok_na_upravu, 0, 0, 0, 0,
                              $sirka, $vyska, $old_sirka, $old_vyska );
                             
          imagejpeg( $vytvoreny_obrazok_jpg, $novy_nazov );
          imagedestroy( $obrazok_na_upravu );
          imagedestroy( $vytvoreny_obrazok_jpg );
       
        /*list( $sirka, $vyska, $typ, $atributy ) = getimagesize( $obrazok );*/
        
        $write="ukaz_upload.php?id=".$id;
            if ( headers_sent()) { echo "Obrazok bol uspesne upraveny. <b><a href='$write'>Uk·zaù upload</a></b>";}
            else { header ("Location:$write");}
}      
?>

