<? if ( ! headers_sent()) {session_start();}?><html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
<title>
</title>
<link rel="stylesheet" href="main.css">
</head>
<body bgcolor='fffefb'>
<table height = 100% width = 100%>
<tr>
<td>
<?php

include 'page_top.php';
include 'spojenie_s_db.php';
  if (isset( $_SESSION['moje_user']) && $_SESSION['moje_user'] != "")
{
include 'id_gether.php';

$id=$_GET['id'];

$TTmoje_id=id_chcem();
$TTmoje_prava=prava_chcem();
$TTmoje_nastavenia=nastavenia_chcem();





}

else { $TTmoje_nastavenia=1;}


/************************************Vyber nastaveni stranky z DB******************************/
$sql_vyber_vnutor_nastavenia="SELECT  v_s AS vnutro_stranky".
                            " FROM nastavenia WHERE id=$TTmoje_nastavenia";
$sql_vvn= mysql_query($sql_vyber_vnutor_nastavenia) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
$extrect_vvn= mysql_fetch_array($sql_vvn);
extract ($extrect_vvn);

$id_TOTALid= $id;
include 'idtotal.php';  /*vybere vstku zname hodnoty */


                /**/if( !isset($_REQUEST['menimkom'])){                                         /**/
                /**/     /*TESTY DLZKY POPISU*/                                                 /**/
                /**/      $dlzka_popisu= strlen($nieco_o);                                        /**/
                /**/      if ( $dlzka_popisu > 25 ) {$nieco_o= chunk_split ($nieco_o, 25, '<br>');  /**/
                /**/      /*ak je nad urcity pocet znakov vloz <br> */  }    }



?>



<table height = 80% align='center' border=0 cellpadding='<?echo $vnutro_stranky;?>'  cellspacing='<?echo $vnutro_stranky;?>'>
<tr><!--spacer----><td height='<?echo ($vnutro_stranky*2);?>'><img src='bg/spacer.gif' border=0>
<tr>
<td valign=top>
            <table>
            <tr>
            <td>
          
            <?$sprava_nadpis="Profil u�ivate�a: '$user'";
            include 'zaoblenie_start.php';?> 
      
                <table class='table' cellpadding=2 >
                    
                    <tr><td ><b>Funkcia na str�nke:&nbsp;&nbsp;</b><td><?echo $THprave ;?>
                    <tr><td colspan=2><hr>
                    <tr><td><b>Meno:&nbsp;&nbsp;</b><td><?echo $real_name ;?>
                    <tr><td><b>Priezvysko:&nbsp;&nbsp;</b><td><?echo $real_priezv ;?>    
                    <tr><td><b>E-mail:&nbsp;&nbsp;</b><td><?echo $email ;?>
                    <tr><td><b>D�tum registr�cie:&nbsp;&nbsp;</b><td><?echo $datum ;?>
                    <tr><td colspan=2><hr>    
                    <tr><td valign= top><b>O u�ivate�ovi:&nbsp;&nbsp;</b><td><?echo $nieco_o ;?>
                    <tr><td colspan=2><hr>
               
                    <tr><td><b>Po�et �lankov:&nbsp;&nbsp;</b><td><?echo $count_c ;?> &nbsp;&nbsp;&nbsp;&nbsp;(<font color='green'><?echo $MOJEpercento_c;?></font> %)
                    <tr><td><b>Po�et vysvetliviek:&nbsp;&nbsp;</b><td><?echo $count_v ;?> &nbsp;&nbsp;&nbsp;&nbsp;(<font color='green'><?echo $MOJEpercento_v ;?></font> %)
                    <tr><td><b>Po�et obr�zkov:&nbsp;&nbsp;</b><td><?echo $count_o ;?> &nbsp;&nbsp;&nbsp;&nbsp;(<font color='green'><?echo $MOJEpercento_o ;?></font> %)
                    
                </table>
        
            <? include 'zaoblenie_end.php';?>
         </table>    
<?
if (isset ($TTmoje_prava) and $TTmoje_prava >4) {?>


<td valign=top>

 <table>
            <tr>
            <td>
          
            <?$sprava_nadpis="Post u�ivate�a";
            include 'zaoblenie_start.php';?> 
                  <form action='spracuj7.php' method='post'>
                <table>
                <tr>
                <td> 
                    
                      <input type='hidden' name='what' value='prava' >
                      <input type='hidden' name='id' value='<?echo $id;?>' >
                      <input type='hidden' name='HREBALL_ism' value='<? echo $HREBALL_ism; ?>' >
                      <select name='prava' size='1' class='select'>
                        <option value='2' class='option' <?if  ($prava==2){echo 'selected';}?> >Pisate�
                        <option value='3' class='option' <?if  ($prava==3){echo 'selected';}?> >Moder�tor
                        <option value='4' class='option' <?if  ($prava==4){echo 'selected';}?> >Str�ca
                        <option value='5' class='option' <?if  ($prava==5){echo 'selected';}?> >Admin
                      </select>
                <tr>
                <td>
                    <input class='button_all' type="submit" value="Zme� pr�va">  
                 
                   
                </table>
                 </form>
 <? include 'zaoblenie_end.php';?>
 
 <tr><!--spacer----><td height='<?echo ($vnutro_stranky*2);?>'><img src='bg/spacer.gif' border=0>
             <tr>
            <td>
             <?$sprava_nadpis="Zmaza� u�ivate�a";
            include 'zaoblenie_start.php';?> 
                  <form action='spracuj7.php' method='post'>
                  <input type='hidden' name='what' value='delete' >  
                  <input type='hidden' name='id' value='<?echo $id;?>' > 
                  <input type='hidden' name='HREBALL_ism' value='<? echo $HREBALL_ism; ?>' >                                                   
                <table>
                <tr>
                <td><? if ( isset($ch) ){echo "<font color=red>";}?>                  
                  <b>Som si vedom� <br>�o rob�m</b<input class='select_all' name='ano_som' type="checkbox">
                   <? if ( isset($ch) ){echo "</font>";}?>
                   
                <tr>
                <td> 
                  <input class='button_all' type="submit" value="Zma� <?echo "'$user'";?>">  
 
                                     
                </table>
                 </form>
 <? include 'zaoblenie_end.php';?>
 
  <tr><!--spacer----><td height='<?echo ($vnutro_stranky*2);?>'><img src='bg/spacer.gif' border=0>
             <tr>
            <td>
             <?$sprava_nadpis="Zmaza� u�ivate�a";
            include 'zaoblenie_start.php';?> 
               <form action='index.php' method='post'>
               <input type='hidden' name='action' value='admin' >
               <input type='hidden' name='adminaction' value='nastavenia_profil' >
               <input type='hidden' name='id_upravT' value='<?echo $id;?>' >   
               <input class='button_all' type="submit" value="Uprav profil">  
               
                 </form>
 <? include 'zaoblenie_end.php';?>
 
 
 </table>   




<?}?>
</table>
<tr><!--spacer----><td height='<?echo ($vnutro_stranky*2);?>'><img src='bg/spacer.gif' border=0>
<?php
include 'page_bottom.php';
?>


</body></html>
