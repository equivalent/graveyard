
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
<title>Registrácia uživateľa</title>
<link rel="stylesheet" href="main.css">
</head>
<body bgcolor='fffefb'>
<?include 'page_top.php';?>


<?include 'spojenie_s_db.php';?>
<? 

 foreach ( $_GET as $kluc => $hodnota){
$$kluc= $hodnota;
    } 

$sql_reg="SELECT reg_form FROM admin_nast WHERE id='1'"; /* test ci uz vyraz neexistuje*/
                          $sql_reg_sq= mysql_query ($sql_reg) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
                          $vysledok_form=mysql_fetch_array ($sql_reg_sq);

$sql_vyber_vnutor_nastavenia="SELECT ".
                            " mmlam AS mezera_mezi_logom_a_menu".
                            " FROM nastavenia WHERE id=1";
$sql_vvn= mysql_query($sql_vyber_vnutor_nastavenia) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
$extrect_vvn= mysql_fetch_array($sql_vvn);
extract ($extrect_vvn);











//<?if ((isset ($error)) and ($error==2)){echo "<font color='red'>";} 
//<?if ((isset ($error)) and ($error==2)){echo "</font>";}


$mmmmsq="<font size=-1>Položky označené * sú povinné!</font>";
if (isset ($error) and ($error==4)){$msg="<font size='-1' color='red'>Užívaťeľ s týmto menom už existuje</font>";}
elseif (isset ($error) and ($error==5)){$msg="<font size='-1' color='red'>Heslá sa nezhodujú</font>";}
elseif (isset ($error) and ($error==18)){$msg="<font size='-1' color='red'>Nespravny overovaci kód!</font>";}
elseif (isset ($error)) {$msg= "<font color='red'>$mmmmsq</font>";}
else {$msg= $mmmmsq;}

//<? if (isset()){echo }

//print_r($_GET);
?>



<table width=100%><!-----asdsdagsdf------>  
  <tr> <td height='<?echo $mezera_mezi_logom_a_menu;?>'><img src='bg/spacer.gif' border=0>
  <tr>
   <td align='center'>
     <table><!-----asdf------>
     <tr>
     <td>
            <? $sprava_nadpis='Registrácia nového užívateľa';/*tato premenna je vlasne nadpis tabulky*/
                include 'zaoblenie_start.php'; ?>
                <form name='reg' action='spracuj5.php' method='post'>
                
                  <table width>
                    <!---0--><tr><td colspan=2 align='center'><i><?echo $msg;?></i>
                    <!---1--><tr><td colspan=2><table><tr><td background='bg/babygnu.jpg' style=" background-repeat: no-repeat; width:70px; height:70px;">
                    <!---1-->                    <td><b>Podmienky registrácie</b>:<br><br><? echo nl2br($vysledok_form[0]);?>
                    <!---1--></tr></table></td></tr>
                    <!---2--><tr><td align='center' colspan=2><b><?if ((isset ($error)) and ($error==2)){echo "<font color='red'>";} ?>*Akceptujem tieto podmienky<?if ((isset ($error)) and ($error==2)){echo "</font>";}?> </b><input class='select' type='checkbox'  name='akceptujem'>
                    
                  
                    <!---3--><tr><td height='9'><img src='bg/spacer.gif' border=0>
                    
                    <!---4--><tr><td><b>*Prihlasovacie meno:</b>&nbsp;<td><input class='select' type='text' size=30 name='user' value='<? if (isset($user)){echo $user;}?>'>
                    <!---5--><tr><td><b><?if ((isset ($error)) and ($error==5)){echo "<font color='red'>";} ?>*Heslo:<?if ((isset ($error)) and ($error==5)){echo "<font color='red'>";} ?></b>&nbsp;<td><input class='select' type='password' size=30 name='pass1'>
                    <!---6--><tr><td><b><?if ((isset ($error)) and ($error==5)){echo "<font color='red'>";} ?>*Heslo ešte raz:<?if ((isset ($error)) and ($error==5)){echo "<font color='red'>";} ?></b>&nbsp;<td><input class='select' type='password' size=30 name='pass2'>
                    <!---7--><tr><td><b><?if ((isset ($error)) and ($error==3)){echo "<font color='red'>";} ?>*e-mail:<?if ((isset ($error)) and ($error==3)){echo "</font>";} ?></b>&nbsp;<td><input class='select' type='text' size=30 name='email' onClick="document.reg.email.value = ''" value='<? if (isset($email)){echo $email;} else {echo "xxxxxxxxx@nnnn.ggg";}?>'>
                    <!---8--><tr><td align='center' colspan=2>Zobrazovať <b>e-mail</b> všetkým uživateľom <input class='select' type='checkbox' name='zobraz_em' <? if (isset($zobraz_em)){echo 'checked'; }?>>
                            
                    <!---9--><tr><td height='9'><img src='bg/spacer.gif' border=0>
                    <!--10--><tr><td><b>&nbsp;&nbsp;Meno:</b>&nbsp;<td><input class='select' type='text' size=30 name='meno' value='<? if (isset($meno)){echo $meno;}?>' >
                    <!--11--><tr><td><b>&nbsp;&nbsp;Priezvysko:</b>&nbsp;<td><input class='select' type='text' size=30 name='priezvysko' value='<? if (isset($priezvysko)){echo $priezvysko;}?>'>  
                    <!--13--><tr><td height='9'><img src='bg/spacer.gif' border=0>
                    <!--16--><tr><td valign='top'><b>&nbsp;&nbsp;Niečo o Vás:</b>&nbsp;<td><textarea class='select' cols='22' rows='5' name='profil' ><? if (isset($profil)){echo $profil; }?></textarea>
                    <!--17--><tr><td height='9'><img src='bg/spacer.gif' border=0>
                    <!--18--><tr><td valign='top'><b><?if ((isset ($error)) and ($error==18)){echo "<font color='red'>";} ?>*Overovaci kod<?if ((isset ($error)) and ($error==18)){echo "</font>";} ?></b>&nbsp;<td valign='top'>
                   
                                  <table><!---sadgfasdgasd-->
                                  <tr>
                                  <td align='center'>
                                      <?include 'generauj_kod.php';?>
                                      <table>
                                      <tr><td>
                                      <input type='hidden'   name='gen_er' value='<?echo $gencislo;?>'>
                                      <b><?echo $sprava;?></b> <input type='text' maxlength='1' size='1' class='select' name='overovaci_kod'>
                                      <tr><td><input type='submit' class='button_all'  name='odoslat' value='Registrovať'> 
                                      </table>
                                  <td align='center' style=" background-repeat: no-repeat; width:70px; height:70px;" background='bg/babytux.jpg'>
                                </table><!---sadgfasdgasd-->
                  
                  
                  
                  
                  
                  
                  </table>
                  
                </form>
            <? include 'zaoblenie_end.php';    ?>
      </table><!-----asdf------>      
   </td>
  </tr> 
  <tr> <td height='<?echo $mezera_mezi_logom_a_menu;?>'><img src='bg/spacer.gif' border=0>
</table><!-----asdsdagsdf------>  

<?

include 'page_bottom.php';

      ?>
