<?php
$vyhrazna_sprava_1="<font color='red'>Pridanie do databazy <b>ne</b>uspešné</font><br>
<font size='-1' color='green'><code>";

$vyhrazna_sprava_end="</code></font>";
$vyhrazna_sprava_2="<font color='red'>Do databazy nebol uskutocneny zapis. Vyraz tohto druhu existuje</font><br>";
$vyhrazna_sprava_3="<font color='red'>Vyber z databazy <b>ne</b>uspešný</font><br>
<font size='-1' color='green'><code>";
$vyhrazna_sprava_4="<font color='red'>Uprava databazy <b>ne</b>uspešná</font><br>
<font size='-1' color='green'><code>";
$vyhrazna_sprava_5="<font color='red'>ZMAZANIE ZAZNAMU z databazy <b>ne</b>uspešné</font><br>
<font size='-1' color='green'><code>";
include 'instal_page/setup.php';
$spojenie= mysql_connect( $host, $sql_user, $sql_pass ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
mysql_select_db ($sql_db, $spojenie);



/*  $sql= mysql_query ("SELECT * FROM obrazok ") or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);   */



?>
