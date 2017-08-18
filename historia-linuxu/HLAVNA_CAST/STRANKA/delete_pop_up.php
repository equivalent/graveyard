<?include 'autorizacia.php';?>
<?include 'spojenie_s_db.php';?>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
<title>Zmazanie článku</title>
<link rel="stylesheet" href="main.css">
</head>
<body>
           <table >
            <tr>
            <td align=center >
<?
if (isset($_GET['a_ok']) )
{
    
    
          $sprava_nadpis="Definitivne zmazanie! ";
      include 'zaoblenie_start.php';
?>
           <table >
            <tr>
            <td align=center><b>
               <font size='+1'>Úspešne zmazané. </font>&nbsp; <a href="#" onClick="JavaScript: window.close()"><font color="green">Zavrieť okno</font</a>
                              </b>            
             <td background='bg/babytux.jpg' style=" background-repeat: no-repeat; width:70px; height:70px;">  
            
          </table>
<?      
      include 'zaoblenie_end.php';
    
    
    
?>          </table><?    
    

}


else{

$_delete_clanok="spracuj.php?spracovanie=clanok&clanokcibuf=clanok&co_s_clankom=delete&delete_it=$id";
$_delete_buffer="spracuj.php?spracovanie=clanok&clanokcibuf=buffer&delete_it=$id";
$_delete_obrazok="zmena_obrazku.php?delete_id=$id";
$_delete_expl="spracuj.php?spracovanie=vysvetlivka&delete_it=$id";


$co= $_GET['co'];
$id= $_GET['id'];

switch ($co)
{
case 'buffer':
  $nazov='bufnazov';
  $comazem='rozpísaný článok';
  $delete=$_delete_buffer;
  

break;

case 'clanok':
  $nazov='clanazov';
  $comazem='článok';  
  $delete=$_delete_clanok;  
break;

case 'obrazok':
  $nazov='popis';
  $comazem='obrázok';  
  $delete=$_delete_obrazok;    
break;

case 'expl':
  $nazov='vyraz';
  $comazem='vysvetlivku';    
  $delete=$_delete_expl;    
break;

default:
echo "<font color=red>Fatalna chyba</font>";
die;
break;
}



$sql="SELECT $nazov FROM $co WHERE id=$id";
$spust_sql1= mysql_query ( $sql ) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
$nazov_zobraz = mysql_fetch_array( $spust_sql1 );
$nazov_zobraz=$nazov_zobraz[0];





      $sprava_nadpis="Definitivne zmazanie! ";
      include 'zaoblenie_start.php';
?>
           <table>
            <tr>
            <td align=center>
              <font size='-1'>Definitivne mažete <? echo $comazem;?> <?if ($co=='buffer' and $id==666){} else echo "s názvom";?> <b><? echo $nazov_zobraz;?></b></font><br><br>
                              <b>
               <font size='+1'>Skutočne chcete zmazať <? echo $comazem;?> ?</font><br />
               <a href='<? echo $delete;?>'><font color="red">ÁNO</font</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onClick="JavaScript: window.close()"><font color="green">NIE</font</a>
                              </b>            
             <td background='bg/babytux.jpg' style=" background-repeat: no-repeat; width:70px; height:70px;">  
            
          </table>
<?      
      include 'zaoblenie_end.php';
}
?>

</body>
</html>
