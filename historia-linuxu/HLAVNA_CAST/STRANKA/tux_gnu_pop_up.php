
<?  $sprava_nadpis='';/*tato premenna je vlasne nadpis tabulky*/
    include 'zaoblenie_start.php';  ?> 
    <table width='100%' border=0 cellpadding='0' cellspacing='0'><!--poper_hjk-->
      <tr>
        <td bgcolor='#fef5cc'>
            <table width='100%' border=0 cellpadding='0' cellspacing='0'><!--poper_xxcv-->
                <tr>
                    <td class='td_vertikal_l_h' background='bg/poper/pop_left_up.jpg'    style="  width:10px; height:10px;">
                    <td class='td_vertikal_h'   background='bg/poper/pop_up.jpg'         style="  width:10px; height:10px;">
                    <td class='td_vertikal_p_h' background='bg/poper/pop_right_up.jpg'   style="  width:10px; height:10px;">
                
                <tr>
                    <td class='td_horizontal_l' background='bg/poper/pop_left.jpg'      style=" width:10px; height:10px;">
                    <td bgcolor='white'><p style="color: #806600; text-align: center; font-weight: bold; vertical-align: bottom; font-size: small"><? echo $sprava_baby; ?></p> 
                    <td class='td_horizontal_p' background='bg/poper/pop_right.jpg'     style=" width:10px; height:10px;">
                    
                <tr>  
                    <td class='td_vertikal_l_d' background='bg/poper/pop_left_down.jpg'  style=" width:10px; height:10px;">
                    <td class='td_vertikal_d' background='bg/poper/pop_down.jpg'         style=" height:10px;">
                    <td class='td_vertikal_p_d' background='bg/poper/pop_right_down.jpg' style=" width:10px; height:10px;">
                    
                
                
              
            </table><!--poper_xxcv-->
        </td>    
       <tr> 
        <td bgcolor='#fef5cc'>
             <table width='100%' border=0 cellpadding='0' cellspacing='0'><!--poper_xxcfv-->
              <tr>
                <td <? $gen_bt_or_bgnu=rand(1,4);
                       //$gen_bt_or_bgnu==1  => baby gnu
                       //$gen_bt_or_bgnu==2  => baby tux
                      if ($gen_bt_or_bgnu==1 or $gen_bt_or_bgnu==3){echo "background='bg/poper/babygnu_small.jpg' style=\" background-repeat: no-repeat; width:45px; height:45px;\"";}
                      else {echo "background='bg/poper/babytux_small.jpg' style=\" background-repeat: no-repeat; width:45px; height:45px;\"";}
                    ?>>&nbsp;
                
                <td background='bg/poper/buble.jpg' style=" background-repeat: no-repeat; width:45px; height:45px;"> &nbsp; 
                <td bgcolor='#fef5cc' width=''>&nbsp;
               </tr>
            </table><!--poper_xxcfv-->       
      </tr>
    </table><!--poper_hjk-->
<?  include 'zaoblenie_end.php';    ?>   
  
