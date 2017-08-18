<table width=100%>
<tr>
<td width=100% align=center>
  <?
  
   if (isset ($id_upravT)){ $TTmoje_id = $id_upravT; } 
  

  
 $sql_reg="SELECT user, real_name, real_priezv, email, zverej_email, nieco_o  FROM profil WHERE id='$TTmoje_id'"; 
                          $sql_reg_sq= mysql_query ($sql_reg) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
                          $extraction=mysql_fetch_array ($sql_reg_sq);
                          extract ($extraction);
              
     
if (isset ($error) and ($error==3)){$msg="<font size='-1' color='red'>Nezadali ste email, alebo slte zadaly zl˝ form·t emailu</font>";}
elseif (isset ($error) and ($error==4) and  (!isset ($id_upravT)) ){$msg="<font size='-1' color='red'>Zadali ste zlÈ pÙvodnÈ heslo, alebo sa novÈ hesla nezhoduj˙</font>";}
elseif (isset ($error) and ($error==4) and  (isset ($id_upravT)) ){$msg="<font size='-1' color='red'>NovÈ hesla nezhoduj˙</font>";}
elseif  (isset ($okokok)) {$msg="<font size='-1' color='green'>Zmeny uspeönÈ</font>";}
else $msg=""; 
              
                        
  ?>
  
     <table><!-----asdf------>
     <tr>
     <td>
     
            <? $TTmojemeno=$user;
                $sprava_nadpis="Zmena ˙dajov uûivateæa $TTmojemeno";/*tato premenna je vlasne nadpis tabulky*/
                include 'zaoblenie_start.php'; ?>
                <form action='spracuj6.php' method='post'>
                 <?if (isset ($id_upravT)){ echo"<input type='hidden' name='godpower' value='1'>"; echo"<input type='hidden' name='id_upravT' value='$id_upravT'>"; }?> 
                  <table>
                    
                 
                     <!---4--><tr><td colspan=2 align=center><?echo $msg;?>
                     <?if (!isset ($id_upravT)){ ?>
                    <!---4--><tr><td><b><?if ((isset ($error)) and ($error==4)){echo "<font color='red'>";} ?>StarÈ heslo:<?if ((isset ($error)) and ($error==4)){echo "<font color='red'>";} ?></b>&nbsp;<td><input class='select' type='password' size=30 name='oldpass'>
                                              <?}?>  
                    <!---5--><tr><td><b><?if ((isset ($error)) and ($error==4)){echo "<font color='red'>";} ?>Heslo novÈ:<?if ((isset ($error)) and ($error==4)){echo "<font color='red'>";} ?></b>&nbsp;<td><input class='select' type='password' size=30 name='pass1'>
                    <!---6--><tr><td><b><?if ((isset ($error)) and ($error==4)){echo "<font color='red'>";} ?>Heslo novÈ eöte raz:<?if ((isset ($error)) and ($error==4)){echo "<font color='red'>";} ?></b>&nbsp;<td><input class='select' type='password' size=30 name='pass2'>
                    <!---7--><tr><td><b><?if ((isset ($error)) and ($error==3)){echo "<font color='red'>";} ?>e-mail:<?if ((isset ($error)) and ($error==3)){echo "</font>";} ?></b>&nbsp;<td><input class='select' type='text' size=30 name='email' value='<? echo $email;?>'>
                     <?if (!isset ($id_upravT)){ ?>
                    <!---8--><tr><td align='center' colspan=2>Zobrazovaù <b>e-mail</b> vöetk˝m uûivateæom <input class='select' type='checkbox' name='zobraz_em' <? if ($zverej_email==1 ){echo 'checked'; }?>>
                                             <?}?>      
                                             
                    <!---9--><tr><td height='9'><img src='bg/spacer.gif' border=0>
                    <!--10--><tr><td><b>&nbsp;&nbsp;Meno:</b>&nbsp;<td><input class='select' type='text' size=30 name='real_name' value='<?echo $real_name;?>' >
                    <!--11--><tr><td><b>&nbsp;&nbsp;Priezvysko:</b>&nbsp;<td><input class='select' type='text' size=30 name='real_priezv' value='<?echo $real_priezv;?>'>  
                    <!--13--><tr><td height='9'><img src='bg/spacer.gif' border=0>
                    <!--16--><tr><td valign='top'><b>&nbsp;&nbsp;NieËo o V·s:</b>&nbsp;<td><textarea class='select' cols='22' rows='5' name='nieco_o' ><? echo $nieco_o; ?></textarea>
                    <!--17--><tr><td height='9'><img src='bg/spacer.gif' border=0>
                    <!--18--><tr><td valign='top'><b><td valign='top'>
                   
                                  <table><!---sadgfasdgasd-->
                                  <tr>
                                  <td align='center'>
                                     
                                      <table>
                                      <tr><td>
                                     
                                      <tr><td><input type='submit' class='button_all'  name='odoslat' value='ZmeÚ ˙daje'> 
                                      </table>
                                  <td align='center' style=" background-repeat: no-repeat; width:70px; height:70px;" background='bg/babytux.jpg'>
                                </table><!---sadgfasdgasd-->
                  
                  
                  
                  
                  
                  
                  </table>
                  
                </form>
            <? include 'zaoblenie_end.php';    ?>
      </table><!-----asdf------>      
</table>
