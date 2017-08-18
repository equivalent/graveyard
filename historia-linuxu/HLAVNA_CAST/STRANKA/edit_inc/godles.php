       <tr><!--spacer----><td height='<?echo ($vnutro_stranky*2);?>'><img src='bg/spacer.gif' border=0>
       <tr><!---trcx658-->
       <td height='100%'>
         <table width=100%>
           <tr>
           <td>
           <?
               $sprava_nadpis='Zaznamy:';
               include 'zaoblenie_start.php';?>
               <form action='index.php' method='get'>
                    <table colspan=3>
                    <tr><td>
                    <input type='hidden' name='adminaction' value='<?echo $wtf_is_hapenning;?>'>
                    <input type='hidden' name='action' value='admin'>
                    <input  type='hidden' name='tab' value='<? echo $tab;?> '>
                    <input  type='hidden' name='order' value='<? echo $order;?> '>
                    <input  type='hidden' name='asc' value='<? echo $asc;?> '>
                    
                    <?if (isset ($oznac) ) {echo "<input  type='hidden' name='oznac' value='$oznac'>";}?> 
                    
                    <select name='godles' size='1' class='select' style='width:100px;'>
                            <option class='option' value='1' <? if(isset($godles) and $godles=='1' ){echo "selected";} ?> >Všetky
                            <option class='option' value='0' <? if(isset($godles) and $godles=='0' ){echo "selected";} ?> >Len moje                                                   
                    </select>
                    <tr><td align=center>
                    <input  class='button_all' type="submit" value='Zobraz'>       
                    </table>              
               </form>
               <?include 'zaoblenie_end.php';?>
         </table>
