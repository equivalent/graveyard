<?php
if (! headers_sent()) {session_start();}




if ( isset( $_SESSION['moje_heslo']) &&
      $_SESSION['moje_heslo'] != ""  && isset( $_SESSION['moje_user']) && $_SESSION['moje_user'] != "" )  {} 


else {

  $write_back="index.php?co_spravit=prihlas";

      if ( headers_sent()) { 
      ?>
      <table width=100% height=75%>
      <tr><td align='center'>
      
      <?
      echo "<table><tr><td align='center'>";
      
      $sprava_nadpis="";
      include 'zaoblenie_start.php';
      echo "<table><tr><td align='center' style=\" background-repeat: no-repeat; width:70px; height:70px;\" background='bg/babygnu.jpg'>";
      echo "<td align='center' >";
      echo "<b>Nieste prihl·sen˝. <a href='$write_back'><u>Prihl·siù</u></a>, alebo <a href='index.php'><u>Ìsù na hlavn˙ str·nku</u></a>.</b><br />";
      echo "<b>MÙûete sa <a href='registracia.php'><u>registrovaù</u></a> a budete mocù prid·vaù<br /> a upravovaù Ël·nky.</b><br />";      
      echo "</table>";
      include 'zaoblenie_end.php';
     
    
      echo "</table>";
      ?>
      </table>
      
       <span style="position: relative; bottom: 0; ">
       <? include 'page_bottom.php';?>
       </span>
      <?
   
                            }
      else { header ("Refresh: 3; URL=$write_back");}
  
  die();
      
      }

?>
