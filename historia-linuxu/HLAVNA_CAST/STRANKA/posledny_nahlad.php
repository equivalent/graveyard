<?include 'autorizacia.php';
include 'spojenie_s_db.php';?>
<html>
<head>
<title>Nah�ad pred podtvrden�m</title>
<link rel="stylesheet" href="main.css">
<meta http-equiv="content-type" content="text/html; charset=windows-1250">
</head>
<body>
  <?$id=$_GET['id'];?>

<table>
 <tr>
 <td>
  <?$sprava_nadpis="P�vodn� obr�zok";
    include 'zaoblenie_start.php';?>
    <img src='imggalery/<?echo $id; ?>.jpg' border=0>
  <?include 'zaoblenie_end.php';?>
  </td>
 <td>
  <?$sprava_nadpis="�praven� obr�zok";
    include 'zaoblenie_start.php';?>
    <img src='imggalery/<?echo $id; ?>_nahlad.jpg' border=0>
  <?include 'zaoblenie_end.php';?>
  </td>
<tr>
 <td colspan=2 align='center'>
  <?$sprava_nadpis="";
    include 'zaoblenie_start.php';?>
    <table>
    <tr>
    <td>
    <form action='zmena_obrazku.php' method='post'>
               <input type='hidden' name='definitivneaplikuj' value='1'>
               <input type='hidden' name='id_komentar' value='<? echo $id;?>'>
               <input class='button_all' type='submit' value='Vlo� popis natrvalo!'>
                  
    </form>
    <td>
    <form action='zmena_obrazku.php' method='post'>
               <input type='hidden' name='goback' value='1'>
                <input type='hidden' name='minux_x' value='<?echo $_GET['minux_x'];?>'>
                <input type='hidden' name='minux_y' value='<?echo $_GET['minux_y'];?>'>
                <input type='hidden' name='farba' value='<?echo $_GET['farba'];?>'>
               <input type='hidden' name='id_komentar' value='<? echo $id;?>'>
               <input class='button_all' type='submit' value='Vr�ti� sa'>
    </form>
    
    <tr>
    <td><font size='-2'><i>POZOR zmenu nemozno vratit sp�<br> bude natrvalo v obr�zku bez z�lohy</i></font><br>
     <td align='right'><a href="javascript:location.reload()"><u>Refresh</u></a>    
    </table>
  <?include 'zaoblenie_end.php';?>
  </td>
  
</table>
