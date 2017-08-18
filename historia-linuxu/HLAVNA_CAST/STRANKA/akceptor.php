<?php
include 'spojenie_s_db.php';
include 'autorizacia.php';
include 'id_gether.php';
$TTmoje_prava=prava_chcem();
if ($TTmoje_prava<4) {DIE ('<font color="red"> NA TOTO NEMÁTE PRÁVO!!!</FONT>'); }

$clanok=$_GET['clanok'];

$sql_uprav_vyraz= "UPDATE autor_c SET ack = 1 WHERE id_clanku = $clanok ";
mysql_query ( $sql_uprav_vyraz ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);



$write="index.php?clanok=$clanok";
      if ( headers_sent()) { echo "<b><a href='$write'>Pokracovat dalej</a></b>";}
      else { header ("Location:$write");}
?>
