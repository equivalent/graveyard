<?php
include 'spojenie_s_db.php';
include 'funkcie.php';
include 'id_gether.php';
if (! headers_sent()) {session_start();}
$id=$_GET['id'];

$sql_vyber_vnutor_nastavenia="SELECT e.vyraz, e.vysvetlenie, av.new FROM expl e JOIN autor_v av ON (id= av.id_expl) WHERE id='$id'";
$sql_vvn= mysql_query($sql_vyber_vnutor_nastavenia) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
$extrect_vvn= mysql_fetch_array($sql_vvn);
extract ($extrect_vvn);

?>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
<title><?echo $vyraz;?>
</title>
<link rel="stylesheet" href="main.css">
</head>
<body bgcolor='fffefb'>
<table>
<tr>
<td align='left'>
<?$sprava_nadpis="$vyraz";
 include 'zaoblenie_start.php';
 echo "<div align = left>";
 $vysvetlenie=bbcode2html4vysvetlivka($vysvetlenie);
 echo "$vysvetlenie ";
 echo "</div>";
 include 'zaoblenie_end.php'; 
 ?>


</td>
</tr>

<?
if (isset( $_SESSION['moje_user']) )
{
 admin_has_seen_it ( 'autor_v', 'id_expl', $id, $new);
}
?>
</table>
