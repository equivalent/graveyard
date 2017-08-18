<?session_start();?>

<?php

include 'autorizacia.php';
include 'spojenie_s_db.php';
include 'id_gether.php';
$TTmoje_prava=prava_chcem();
$id = $_REQUEST['id'];
$can_I=mas_na_to_pravo('autor_o', $id, 'id_obr', 'update');
                   
//print_r($_GET);
$TTmoje_nastavenia=nastavenia_chcem();
$sql_vyber_vnutor_nastavenia="SELECT  v_s AS vnutro_stranky FROM nastavenia WHERE id=$TTmoje_nastavenia";
$sql_vvn= mysql_query($sql_vyber_vnutor_nastavenia) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
$extrect_vvn= mysql_fetch_array($sql_vvn);
extract ($extrect_vvn);




/*aj ked sa tato cast skryptu sem nemusela davat, dal som ju pre vytiahnutie komentaru o obrazku z DB*/
$obrazok_load = mysql_query( "SELECT * FROM obrazok JOIN autor_o ON (id=id_obr) WHERE id = '$id'" )
  or die( mysql_error() );
  
  
$roadok = mysql_fetch_array( $obrazok_load );
extract( $roadok );

$obrazok ="imggalery/". $id. ".jpg";

/*ziskam hodnoty sirka vyska*/
list( $sirka, $vyska, $typ, $atributy ) = getimagesize( $obrazok );


admin_has_seen_it ( 'autor_o', 'id_obr', $id, $new);
?>


<html>
<head>
<title>Obrazok: <?echo $id?>.jpg</title>
<link rel="stylesheet" href="main.css">
<meta http-equiv="content-type" content="text/html; charset=windows-1250">
</head>
<body>
<table>
<tr>
<td>

<table  width='100%' cellpadding='<?echo $vnutro_stranky;?>'  cellspacing='<?echo $vnutro_stranky;?>'>


<tr>
<td align='center' colspan='3' width='100%'>

    <?$sprava_nadpis="⁄prava obr·zku $id.jpg";
    include 'zaoblenie_start.php';
    ?>
    <img src="<?php echo $obrazok; ?>" align="left">
    <?include 'zaoblenie_end.php';?>

</td>
</tr>

<tr>

<!---------------------------------------------------------------------------------------------------Komentar obrazku-------------->
<td valign='top' > 
<table>
<tr>
<td >
      <?$sprava_nadpis="Popis obr·zku";
      include 'zaoblenie_start.php';?>
      <table >
      

          <tr><td height='170' valign='top'>

              <?// ak je nastavne ze chcem upravit komentar, hodim $popis do textarea
              if ( isset($_POST['menimkom']))
                { 
                  
                  echo "<form action='zmena_obrazku.php' method='post'>";
                  echo "<input type='hidden' name='iddd' value='$id'>";
                  echo "<textarea maxlength='255' name='zmenkomentar' cols='21' rows='9'>";}
                  
                /**********************************************************************************/
                /**/if( !isset($_REQUEST['menimkom'])){                                         /**/
                /**/     /*TESTY DLZKY POPISU*/                                                 /**/
                /**/      $dlzka_popisu= strlen($popis);                                        /**/
                /**/      if ( $dlzka_popisu > 25 ) {$popis= chunk_split ($popis, 25, '<br>');  /**/
                /**/      /*ak je nad urcity pocet znakov vloz <br> */  }                       /**/
                /************************************/}/*******************************************/
                 if ( isset($_POST['menimkom'])) {echo $popis;} 
                  else {echo nl2br($popis);}
                  
                            
              
              if ( isset($_POST['menimkom']))
                {echo "</textarea><br /> <input class='button_all' style='width:130px;'  type='submit' value='Zmeniù popis' >";}
                
              
              else {
                    if ($can_I){
                    ?>
              <tr><td>
              
               <form action='ukaz_upload.php' method='post'>
               <input type='hidden' name='menimkom' value='1'>
               <input type='hidden' name='id' value='<? echo $id;?>'>
               <input class='button_all' style="width:130px;" type='submit' value='Zmeniù popis'><br>
               </form>
               
     
               
               <form action='zmena_obrazku.php' method='post'>
               <input type='hidden' name='aplikujkomentar' value='1'>
               <input type='hidden' name='id_komentar' value='<? echo $id;?>'>
               <input class='button_all' style="width:130px;" type='submit' value='Vloûiù popis'><br>
               <select name='farba' size='1' style="width:130px;" class='select'>
                <option value='0' class='option'>»ierne pÌsmo
                <option value='999' class='option' <? if (isset ($_GET['farba'] ) and ($_GET['farba']=='999') ){echo 'selected' ;}?> >Modre pÌsmo
                <option value='99999' class='option' <? if (isset ($_GET['farba'] ) and ($_GET['farba']=='99999') ){echo 'selected'; }?> >Az˙rovÈ pismo
                <option value='333333333' class='option' <? if (isset ($_GET['farba'] ) and ($_GET['farba']=='333333333') ){echo 'selected' ;}?> >»ervenÈ pÌsmo
                <option value='999999999' class='option'       <? if (isset ($_GET['farba'] ) and ($_GET['farba']=='999999999') ){echo 'selected'; }?> >BledÈ pÌsmo
              </select><br>
              Y=<input type='text' class='select' size='2' maxlength="4" name='minux_y' value='<? if (isset ($_GET['minux_y'])){echo $_GET['minux_y']; } else {echo "20";}?>'>
              &nbsp;X=<input type='text' class='select' size='2' maxlength='4' name='minux_x' value='<? if (isset ($_GET['minux_x'])){echo $_GET['minux_x']; } else {echo "20";}?>'>
               </form>
              <?}}?>
      </table>   
   <? include 'zaoblenie_end.php';?>     
</table>
</td>

<!---------------------------------------------------------------------------------------------------Sirka /vyska------------------>
<td align='left' valign='top'>
<table>
<tr>
<td>
  <?$sprava_nadpis="Info o obr·zku";
  include 'zaoblenie_start.php';?>
    <table >
      <tr>
        <td><b>Povodn· öirka:</b>
        </td>
        <td><? echo $pov_sirka; ?>
        </td>
      </tr>
      <tr>
        <td><b>Povodn· v˝öka:</b>
        </td>
        <td><? echo $pov_vyska; ?>
        </td>
      </tr>
      <tr>
        <td><b>Datum uploadu:</b>
        </td>
        <td><? echo $datum; ?>
        </td>
      </tr>

      <tr>
        <td colspan='2'>&nbsp;
      </tr>
      <tr>
        <td colspan='2'>&nbsp;
      </tr>
      
      <tr>
        <td><b>Terajöia öirka:</b>
        </td>
        <td><? echo $sirka; ?>
        </td>
      </tr>
      <tr>
        <td><b>Terajöia v˝öka:</b>
        </td>
        <td><? echo $vyska; ?>
        </td>
      </tr>
     </table> 
   
   <? include 'zaoblenie_end.php';?>
 </table>    
</td>

<!--------------------------------------------------------------------------------------------------Zmena velkosti----------------->

<td align='left' valign='top' >
<?if ($can_I){?>
 <table><!--dsfsafsad---->
 <tr><!--dsfsafsad---->
 <td>
  <?$sprava_nadpis="Automaticke zmeneie velikosti";
  include 'zaoblenie_start.php';?>  
        <table >
              <form action='zmena_obrazku.php' method='post'>
                      <input type='hidden' name='id' value='<?echo $id; ?>'>              
                      <tr>
                        <td nowrap >
                          Nov· öÌrka:
                        </td>
                        <td>
                          <input type='text' maxlength='4' name='autosirka' class='select'>
                        </td>
                      </tr>
                      <tr>
                        <td colspan='2'>
                          <font size='-2'><i>V˝öka sa prispÙsobÌ öirke v spravnom pomere</i></font>
                        </td>
                      </tr>
                      <tr>
                        <td colspan='2'>
                         &nbsp;
                        </td>
                      </tr>
                      <tr>
                      <td>
                      <td>
                       <input class='button_all' type='submit' value='Vykonaj zmenu'><br>
                       <font size='-2'><i>POZOR zmenu nemozno vratit sp‰ù</i></font>
                       </td>
                     </tr>      
                </form>                          
        </table>
  <?include 'zaoblenie_end.php';?>  
<tr><!--dsfsafsad---->
 <td height='<?echo ($vnutro_stranky*2);?>'><img src='bg/spacer.gif' border=0>
<tr><!--dsfsafsad---->
 <td> 
  <?$sprava_nadpis="Zmena veækosti";
  include 'zaoblenie_start.php';?>      
    <table>
              <form action='zmena_obrazku.php' method='post'>
                      <input type='hidden' name='id' value='<?echo $id; ?>'>
                    <tr>
                      <td><b>Nov· öÌrka:</b>
                      </td>
                      <td>
                        <input maxlength='4' type='text' name='sirka' class='select'>
                      </td>
                    </tr>
                    <tr>
                      <td><b>Nov· v˝öka:</b>
                      </td>
                      <td>
                      <input maxlength='4' type='text' name='vyska' class='select'>
                      
                      </td>
                    </tr>
                    <tr>
                      <td>
                      </td>
                      <td>
                      <input type='submit' value='Vykonaj zmenu' class='button_all'>
                      <br>
                      <font size='-2'><i>POZOR zmenu nemozno vratit sp‰ù</i></font>
                      </td>
                    </tr>
            </form>
    </table>

  <?include 'zaoblenie_end.php';?>    
</table><!--dsfsafsad---->
</td>
</tr>
<?}?>
<!---------------------------------------------------------------------------------------------------KONIEC <TR> ------------------>


<tr>
  <td align='left' colspan= 3>  
        <b><a href="javascript:location.reload()"><u>Refresh</u></a><br /></b><br />
        <b><a href='index.php?action=admin&adminaction=editujobrazok&oznac=<?echo $id;?>'><u>Vratiù sa do galerie</u></a></b>
        <? if( $TTmoje_prava>3 ) {echo "<br /></b><br /><b><a href='index.php?action=admin&adminaction=news'><u>Vratiù sa do nov˝ch spr·v</u></a></b>";}?>
        
  </td>
</tr>
</table>
<td>
</table>

</body>
</html>
