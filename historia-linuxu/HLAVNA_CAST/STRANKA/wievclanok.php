<?php
include 'autorizacia.php';
/*
wievclanok.php
sluzi na zobrazenie clanku pred ulozenim z tabulky buffer do tabulky clanok


*/

foreach ( $_POST as $kluc => $hodnota)
{
$$kluc= $hodnota;
}
/*
ziskam premenne:
            $buf
            $edit

*/

$sql1="SELECT id_sekcia, id, bufnazov, buftext, strana, bufedit FROM buffer WHERE id= $buf ";
$sql2="SELECT  n.nazov FROM buffer c JOIN sekcia n ON (c.id_sekcia = n.id) WHERE c.id=$buf";
/* Ano tieto 2 SQL dotazy su prilis neprakticke, daly sa zapisat jednym. Jedna sa vsak o to ze Chybova sekcia 125
sposobuje to ze sa nenacitaju z tabulky buffer clanky ktorych sekcia je 125. Je to sposobene tym ze ze neexistuje 
sekcia s ID 125 a tym padom sa ignoruje cely dotaz, teda aj nacitanie z tabulky buffer. takto sa bude ignorovat
dotaz iba z tabulky sekcia.

$sql1="SELECT c.id_sekcia, c.bufnazov, c.buftext, c.expl_obr, c.strana, c.bufedit, n.nazov FROM buffer c JOIN sekcia n ON (c.id_sekcia = n.id) WHERE c.id=$buf";
*/

$spust_sql1  = mysql_query ( $sql1 ) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
$extraction1 = mysql_fetch_array( $spust_sql1 );
         extract( $extraction1 );
$spust_sql2 = mysql_query ( $sql2 ) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
$extraction2 = mysql_fetch_array( $spust_sql2 );
if (isset($extraction2) and $extraction2!=''){ extract( $extraction2 );}

      
if (! $bufedit== 0) {$edit=$bufedit ;}

?>
<table width='100%'>
<tr><td colspan=2>&nbsp;
<? if ($id_sekcia==125)
{echo"<tr><td colspan=2>&nbsp; <font size=-1 align='center' color=black><b>Prosim zvolte sekciu, ktorej bude Ëlanok patriù!</b></font>";}
/*Ak este nieje zvolena sekcia nezobrazi sa Textik "Clanok je v sekcii .. Ale zobrazi sa mu ze nezadal sekciu"*/ 
 else{ ?>
<tr><td colspan=2 align='center'><font size=-1 color=black><b>»l·nok je v sekcii <? echo $nazov; ?></b></font>
<?    }?>
<tr><td colspan=2>
<tr><td colspan=2 align='center'><p class='txtnadpis'><? echo ucfirst($bufnazov); ?></p>
<tr><td colspan=2>
<tr><td colspan=2><?echo bbcode4clanok($buftext)?>
<tr><td colspan=2>&nbsp;
 

 
       <table width=100%><!---sadfasd--->
       <tr>
       <td align=left>
      <?/* v pripade ze si zvoli uzivatel navrat na upravy clankov*/?> 
        <form action='index.php' method='post'>
           <input type='hidden' name='action'       value='admin'>
           <input type='hidden' name='adminaction'  value='pridajclanok'>
           <input type='hidden' name='buf'          value='<? echo $buf; ?>'>
           <? if (isset ($edit)){echo 
          "<input type='hidden' name='edit'         value='$edit'>";/*ak upravujem clanok*/}?>
           <input type='submit' class='button_all' value='Sp‰ù na upravy'>
        </form>
      </td>
       <td align=right>
         
       <?/* v pripade ze si zvoli uzivatel potvrdenie clanku => definitivne sa prida */?>       
        <form action='spracuj.php' method='post'>
           <input type='hidden' name='spracovanie' value='clanok'> 
           <input type='hidden' name='clanokcibuf' value='clanok'> <?/*z istotou to mozem tvrdit pre cely pridaj pridajclanok.php
                                                                    lebo volba zapisu do clanku je az vo wievclanok.php*/?>
           <?if (isset ($edit)) {$co_odoslem_ako_co_s_clankom='uprav';} else {$co_odoslem_ako_co_s_clankom='pridaj';} ?>
           <input type='hidden' name='co_s_clankom' value='<?echo"$co_odoslem_ako_co_s_clankom";?>'>
           <?/*posiela ze chcem pridavat clanok z moznosti : pridaj, uprav, zmaz*/?>
                                                                      
           <input type='hidden' name='buf'         value='<? echo $buf;       ?>'>
           <input type='hidden' name='id_sekcia'   value='<? echo $id_sekcia; ?>'>
           <input type='hidden' name='bufnazov'    value='<? echo $bufnazov;  ?>'>
           <input type='hidden' name='buftext'     value='<? echo $buftext;   ?>'>
           <? if (isset ($edit)){echo 
          "<input type='hidden' name='edit'       value='$edit'>";/*ak upravujem clanok*/}
          
              if ($id_sekcia==125){}/*Uzivatel nezvolil sekciu, nezobrazi sa mu submit na ulozenie clanku*/
              else{
                 if(isset($edit)){ 
                    echo"<input type='submit' class='button_all' value='Uloûiù zmeny Ëlanok'>";
                                  }
                 else{ 
                    echo"<input type='submit' class='button_all'  value='Pridù Ëlanok'>";
                      } /*koniec elsu pri podmienke if(isset($edit)*/ 
                  }/*koniec elsu if ($id_sekcia==125)*/?>
        </form>
        </td>
        </tr>
         <table><!---sadfasd--->
   
</td></tr>




<?
/****************Litle silver info**************************************************/
/**/if (isset($zobraz_litle_silver_info) and $zobraz_litle_silver_info==1  ){
/**/if (isset($edit))
/**/  { $xx[0]= "Upravuje sa Clanok s id $edit. ";}
/**/$xx[1]= "Buf clanku je $buf. ";
/**/
/**/if ($id_sekcia==125){$xx[2]= "Nezvolili ste este sekciu, preto nemozte pridat.";}
/**/$zobraz_silver_info= implode ('', $xx);                                                      }
/***********************************************************************************/
?>
</table>
</table>
