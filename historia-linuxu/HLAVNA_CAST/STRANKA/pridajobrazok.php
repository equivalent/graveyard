<?
include 'autorizacia.php';

?>
                
<form name="form1" method="post" action="spracuj.php" enctype="multipart/form-data">
<input type='hidden' name='spracovanie' value='obrazok'>
<table align='center' border=0 cellpadding='<?echo $vnutro_stranky;?>'  cellspacing='<?echo $vnutro_stranky;?>'>
    <tr>
      <td > 
                    <?$sprava_nadpis='';?>
                    <? include 'zaoblenie_start.php';?>
                     <p class='txtnadpis'>Pridanie obrázku</p>
                    <? include 'zaoblenie_end.php';?>
      </td>
   </tr>
   <tr>
              <td > 
                  <table align=center>
                  <tr>
                  <td>
                    <?$sprava_nadpis='Popis obrázku';?>
                    <? include 'zaoblenie_start.php';?>
                     <input class='form_all' type='text' name='popis_obrazku' maxlength="255" size='<?echo ($form_w); ?>' >
                    <? include 'zaoblenie_end.php';?>
                  </td>
                  </tr>
                  </table>
              </td>
  </tr>
    
    
  <tr> 
    <td>
    <?$sprava_nadpis='Cesta k obrázku';?>
    <? include 'zaoblenie_start.php';?>
        <span class='form_all'><input  name="url_obrazku" type="file" size='<?echo ($form_w-20); ?>'></span>
    <? include 'zaoblenie_end.php';?>
    </td>
  </tr>

  <tr>
  <td>
    <table>
      <tr>
      <td align=left width= 100%> <input class='button_all' type="submit" name="odoslat" value="Odosla">
       <td align=right><input class='button_all' type="reset" name="Vynulovat" value="Storno" >
    </table>
  </td>
  </tr>

</table>
</form>

