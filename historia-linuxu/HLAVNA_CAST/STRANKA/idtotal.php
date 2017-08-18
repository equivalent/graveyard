<?php
$sql_vyber_[1]="SELECT * FROM profil WHERE id=$id_TOTALid";
$sql_vyber_[2]="SELECT COUNT(id_obr)  AS count_o  FROM autor_o WHERE id_usera=$id_TOTALid";
$sql_vyber_[3]="SELECT COUNT(id_expl) AS count_v  FROM autor_v WHERE id_usera=$id_TOTALid";
$sql_vyber_[4]="SELECT COUNT(id_clanku) AS count_c FROM autor_c WHERE id_usera=$id_TOTALid";
$sql_vyber_[5]="SELECT COUNT(id_bufferu) AS count_b FROM autor_b WHERE id_usera=$id_TOTALid";

$sql_vyber_[6]="SELECT COUNT(id) AS t_count_c FROM clanok ";
$sql_vyber_[7]="SELECT COUNT(id) AS t_count_o FROM obrazok ";
$sql_vyber_[8]="SELECT COUNT(id) AS t_count_v FROM expl ";
$sql_vyber_[9]="SELECT COUNT(id) AS t_count_s FROM sekcia ";


for ($Ii=1;$Ii<10;$Ii++)
{
$sql= mysql_query($sql_vyber_[$Ii]) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
$extrect= mysql_fetch_array($sql);                         
extract ($extrect);
}

     /*statista*/
     if ($t_count_v==0) { $t_count_v=1;}
     if ($t_count_c==0) { $t_count_c=1;}
     if ($t_count_o==0) { $t_count_o=1;}
    
    
     $MOJEpercento_v=ceil (($count_v/$t_count_v)*100);
     $MOJEpercento_c=ceil (($count_c/$t_count_c)*100);
     $MOJEpercento_o=ceil (($count_o/$t_count_o)*100);

      if  ($prava == 0){$THprave="<s><font color='black'>ZMAZANÝ</font></s>";}
      if  ($prava == 2){$THprave="<font color='orange'>Pisate¾</font>";}
      if  ($prava == 3){$THprave="<font color='green'>Moderator</font>";}
      if  ($prava == 4){$THprave="<font color='blue'>Strážca</font>";}
      if  ($prava == 5){$THprave="<font color='red'>Administrátor</font>";}





?>
