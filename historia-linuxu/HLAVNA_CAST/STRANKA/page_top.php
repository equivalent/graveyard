<!-- horna cast stranky.  -->
<table cellpadding='0' cellspacing='0' width='100%' height='' >
<!-- 1 level, level pre logo 1 urovne  -->

  <tr>
      <td width='1' nowrap > <!--TD 1 --><img border=0 src='bg/spacer.gif'> </td>
      <td nowrap align='left' valign='top' width='500' background='bg/logoback.jpg'><!--TD 2 --><a href='index.php'><img border='0' src='bg/logo.jpg'></a></td>
      <td nowrap colspan='2'  align='left' valign='top'  background='bg/logoback.jpg'><!--TD 3  --></td>  
      <td nowrap width='300' background='bg/logoback.jpg' height='100%' ><!-- TD 4 -->
      <table height='100%'>
      <tr><td valign='top' align='center'>   
         <table>
            <tr>
            <td><b><?

            if (isset ($HREBALL_ism) ) {$_SESSION['moje_user']=$HREBALL_ism;}
            
                if (isset( $_SESSION['moje_user']) )
                      { echo "<a href='index.php?action=admin'>Administr·cia</a>&nbsp;&nbsp;";  }
                
                else  { echo"<a href='registracia.php'>Registr·cia</a>&nbsp;&nbsp;"; }
                ?></b>
            </td>
            
            <td><b><?
            
          
                if (isset( $_SESSION['moje_user']) )
                      {echo "<a href='index.php?adminaction=odhlasit'>Odhl·siù</a>&nbsp;&nbsp;";}
                else  {echo"<a href='index.php?co_spravit=prihlas'>Prihl·sù</a>&nbsp;&nbsp;";}
                ?></b>
            </td>    
            <td><b><?  if (isset( $_SESSION['moje_user']) )
                      {echo "<a href='index.php?action=admin&adminaction=profil'>UûÌvatelia</a>&nbsp;&nbsp;";}
                else  {echo"<a href='index.php?action=profil'>UûÌvatelia</a>&nbsp;&nbsp;";}?>
            
                </b>
            <td><b><?echo "<a href='index.php?action=hladaj'>Vyhæad·vanie</a>";?>
            </td>   
         </table>
         
      <tr><td valign='bottom'>    
         <table cellpadding='0' cellspacing='0'>
            <tr>   
                        <table border=0 cellpadding='0' cellspacing='0'>
                        <tr>
                          <td>
                          <td><p class="txtinfo">Vyhæadavanie</p>
                          <td> 
                        </tr>
                        <tr>
                          <td background='bg/babygnu.jpg' style=" background-repeat: no-repeat; width:70px; height:70px;" >
                          <td align='center'> 
                              <table>
                              <form method='get' name='hhhhladaj' action='index.php'>
                              <input type=hidden name='action' value='hladaj'>
                              <input type=hidden name='typ' value='all'>
                                
                              <tr>
                                     <td align='center'>
                                         <input style="background: #f8e496; border-width:4px; border-style: double; border-color: #ffd21f; text-align:center; font-weight: bold; border-color=#ffd21f;" onClick="document.hhhhladaj.hladaj_ma.value = ''" type=text   name='hladaj_ma' value='Hladaj vyraz'  maxlength=50 size=13>
                                     </td>
                              </tr>
                              <tr>       
                                     <td align='center'>         
                                         <input style="background: #f8e496; font-weight: bold;" type=submit value='Hladat >' >
                                     </td>
                              </tr>
                              </form>
                              </table>
                          </td>
                          <td background='bg/babytux.jpg' style=" background-repeat: no-repeat; width:70px; height:70px;">
                        </tr>
                        <tr>
                       <td height=4 background='bg/spacer.gif'>
                       <td>
                       <td>           
                       </tr>
                        
         </table>  
       </table
     
                                   
      </td>    
      <td nowrap align='left' valign='top' rowspan='3' width='21'  background='bg/zakoncenie.jpg' ><!--TD 5 --><img src='bg/spacer.gif'></td>        
      <td width='1' nowrap > <!--TD 6 --><img border=0 src='bg/spacer.gif'> </td>       
  </tr>

</table>

