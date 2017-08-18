<?include 'autorizacia.php';
include 'spojenie_s_db.php';?>
<html>
<head>
<title>Nahľad pred podtvrdením</title>
<link rel="stylesheet" href="main.css">
<meta http-equiv="content-type" content="text/html; charset=windows-1250">
</head>
<body>
  <?$id=$_GET['id'];?>

<table>
 <tr>
 <td>
  <?$sprava_nadpis="Pôvodný obrázok";
    include 'zaoblenie_start.php';?>
    <img src='imggalery/<?echo $id; ?>.jpg' border=0>
  <?include 'zaoblenie_end.php';?>
  </td>
 <td>
  <?$sprava_nadpis="Úpravený obrázok";
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
               <input class='button_all' type='submit' value='Vlož popis natrvalo!'>
                  
    </form>
    <td>
    <form action='zmena_obrazku.php' method='post'>
               <input type='hidden' name='goback' value='1'>
                <input type='hidden' name='minux_x' value='<?echo $_GET['minux_x'];?>'>
                <input type='hidden' name='minux_y' value='<?echo $_GET['minux_y'];?>'>
                <input type='hidden' name='farba' value='<?echo $_GET['farba'];?>'>
               <input type='hidden' name='id_komentar' value='<? echo $id;?>'>
               <input class='button_all' type='submit' value='Vrátiť sa'>
    </form>
    
    <tr>
    <td><font size='-2'><i>POZOR zmenu nemozno vratit späť<br> bude natrvalo v obrázku bez zálohy</i></font><br>
     <td align='right'><a href="javascript:location.reload()"><u>Refresh</u></a>    
    </table>
  <?include 'zaoblenie_end.php';?>
  </td>
  
</table>
