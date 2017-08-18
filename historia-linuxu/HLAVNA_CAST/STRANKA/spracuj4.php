<?php
include 'spojenie_s_db.php';
include 'autorizacia.php';
include 'id_gether.php';
//print_r ($_POST);

$TTright=prava_chcem();
$TTmoje_nastavenia=nastavenia_chcem();



$add_by_admin="";
if ($TTright==5 and isset($_POST['rozkazal_vsetkym']))
{  
$rozkazal_vsetkym=$_POST['rozkazal_vsetkym'];
  if ($rozkazal_vsetkym){$TTmoje_nastavenia=1;}
  
$add_by_admin="&TC_ukazat_vseob=$rozkazal_vsetkym";
}


foreach ( $_POST as $kluc => $hodnota)
    {
$$kluc= $hodnota;
    }

/* $zmena*/
//print_r($_POST);

$write="index.php?action=admin&adminaction=nastavenia_admina&uspech=1$add_by_admin"; 
switch ($zmena) 
{
case 'okraje':
 
  $sql_uprav_okraje= 
  " UPDATE nastavenia SET stm = '$stm', ".
                        " vpo = '$vpo', ".
                        " vlo = '$vlo', ".
                       " mmlp = '$mmlp', ".
                        " mmm = '$mmm', ".
                      " mmlam = '$mmlam', ".                        
                        " v_s = '$v_s' ".
  " WHERE id=$TTmoje_nastavenia ";  
                        
                        
mysql_query ( $sql_uprav_okraje ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
break;

case 'formulare':

  $sql_uprav_formulare= 
  " UPDATE nastavenia SET form_w = '$form_w', ".
                    " textarea_w = '$textarea_w', ".
                    " textarea_w = '$textarea_w', ".
                    " textarea_h = '$textarea_h' ".
  " WHERE id=$TTmoje_nastavenia ";  
                        
                        
mysql_query ( $sql_uprav_formulare ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);

break;

case 'riadky':
  $sql_uprav_riadky= 
  " UPDATE nastavenia SET rnt = '$rnt', ".
                      " rntpc = '$rntpc' ".
  " WHERE id=$TTmoje_nastavenia ";  
  mysql_query ( $sql_uprav_riadky ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
break;

case 'lsi':

   $sql_uprav_zlsi= 
  "UPDATE admin_nast SET zlsi = $zlsi where id = 1"; //nemen!!!
  mysql_query ( $sql_uprav_zlsi ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
break;



case 'popup':
  $sql_uprav_pop= 
  " UPDATE nastavenia SET popupv = '$popupv', ".
                        " popups = '$popups' ".
  " WHERE id=$TTmoje_nastavenia ";  
  mysql_query ( $sql_uprav_pop ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
break;



case 'reset':

$sql_vyber_vnutor_nastavenia="SELECT * FROM nastavenia WHERE id=1";
$sql_vvn= mysql_query($sql_vyber_vnutor_nastavenia) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
$extrect_vvn= mysql_fetch_array($sql_vvn);
extract ($extrect_vvn);

  $sql_uprav_okraje= 
  " UPDATE nastavenia SET stm = '$stm', ".
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
                      " rntpc = '$rntpc' ".
                                                                                                  
  " WHERE id=$TTmoje_nastavenia ";  
  
  mysql_query ( $sql_uprav_okraje ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
break;




case 'formular':

$text= $_POST['text'];

  $sql_uprav_okraje= 
  " UPDATE admin_nast SET reg_form = '$text' ".
                                                                                                  
  " WHERE id=1 ";  //nemen!!!
  
  mysql_query ( $sql_uprav_okraje ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
break;


default:
echo $sprava_zla_volba="<font color='red'><B>CHYBA! Bola zadan· zl· voæba.</B></font> 
                  <font size='-1'>Pravdepodobne ste zadali zl˙, alebo neplatn˙ voæbu.</font><br />
                  <font size='-2'>Ak ste tento problem nezavinili Vy a ovplyvnuje funkcnosù str·nky, prosÌm kontaktujte n·s o Úom.</font><br />";
$write="index.php?action=admin&adminaction=nastavenia_admina";                   
break;
                            
                        
}

      if ( headers_sent()) { echo "<b><a href='$write'>Pokracovat dalej</a></b>";}
      else { header ("Location:$write");}

?>
