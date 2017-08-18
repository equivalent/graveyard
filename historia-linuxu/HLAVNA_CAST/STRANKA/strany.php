                  <table>
      
                        <tr>
                        <td align='right'>
                        <?
                        
                        
                        
                        if (isset ($tab) and $tab>3)
                        /*
                        Upozornenie autora !!! ak nechces prist o nervy a o zdravie nebabri do tochto!!!!!!!
                        
                        */
                        {
                        
                        
                        $zacni=$tab-2;
                        $skonci=$tab+2;
                        
                        /*ak je dosiahnuty koniec, posledne cislo. Inak by to slo do nekonecna klikat*/  
                        if (($tab+2)>$kolko_krat)
                        {
                         $qqq=($tab+2)-$kolko_krat;
                         $zacni=$zacni-$qqq;     /*chcem sa vyhnut ovplyvneniu hodnoty tab!!!!*/  
                         $skonci=$skonci-$qqq;   /*chcem sa vyhnut ovplyvneniu hodnoty tab!!!!*/  
                        }
                                
                                 
                                for ($cc=$zacni;$cc<=$skonci;$cc++)
                                {
                                echo $sprava_strany;/*tuto hodnotu obsahuje v sebe stranka, ktora si vypita tuto stranku.*/
                                echo "&tab=$cc";
                                if (isset($oznac)) {echo "&oznac=$oznac";}
                                
                                 echo "'>$cc</a>";
                                
                                }
                       }
                        else
                         { 
                            if ($kolko_krat>5){$zobrazzz=5;} else {$zobrazzz=$kolko_krat;}
                               for ($cc=1; $cc<=$zobrazzz; $cc++)
                                {
                                echo $sprava_strany;/*tuto hodnotu obsahuje v sebe stranka, ktora si vypita tuto stranku.*/
                                echo "&tab=$cc";
                                if (isset($oznac)) {echo "&oznac=$oznac";}
                                
                                 echo "'>$cc</a>";
                                
                                }
                        
                        
                         }
                        
                        ?>
                        </td>
                        </tr>
                  </table>
