<?php
$sql_news_[1]="SELECT COUNT(id_obr) AS count_new_o  FROM autor_o WHERE new=2";
$sql_news_[2]="SELECT COUNT(id_expl) AS count_new_v  FROM autor_v WHERE new=2";
$sql_news_[3]="SELECT COUNT(id_clanku) AS count_new_c  FROM autor_c WHERE new=2";
$sql_news_[4]="SELECT COUNT(id_clanku) AS count_ack_c  FROM autor_c WHERE ack=0";
/*clanky ktore pridajiu moderatori a strazcovia*/
$sql_news_[5]="SELECT COUNT(id_obr) AS count_new_ao  FROM autor_o WHERE new=1";
$sql_news_[6]="SELECT COUNT(id_expl) AS count_new_av  FROM autor_v WHERE new=1";
$sql_news_[7]="SELECT COUNT(id_clanku) AS count_new_ac  FROM autor_c WHERE new=1";
/*upravy*/
$sql_news_[8]="SELECT COUNT(id_clanku) AS count_new_uc  FROM autor_c WHERE new=3";
$sql_news_[9]="SELECT COUNT(id_expl) AS count_new_uv  FROM autor_v WHERE new=3";
$sql_news_[10]="SELECT COUNT(id_obr) AS count_new_uo  FROM autor_o WHERE new=3";

for ($Ii=1;$Ii<11;$Ii++)
{
$sql= mysql_query($sql_news_[$Ii]) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
$extrect= mysql_fetch_array($sql);                         
extract ($extrect);
}

?>
