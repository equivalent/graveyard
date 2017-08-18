<?php
include 'spojenie_s_db.php';
include 'funkcie.php';
include 'cs.php';
include 'autorizacia.php';
include 'id_gether.php';

$TTmoje_id=id_chcem();
$TTmoje_prava=prava_chcem();


foreach ( $_POST as $kluc => $hodnota){
$$kluc= $hodnota;
    }    
 foreach ( $_GET as $kluc => $hodnota){
$$kluc= $hodnota;
    }    
    
    
/*
Projek histori linuxu funguje na istej hierarchii kde najnizsie su neregistrovany uzivatelia a najvysie admin
tu su jednotlive prava

1 neregistrovany uzivatel, moze sa iba pozerat
2 registrovany uzovatel - moze upravit a pridat udaje do clanku, moze i vytvorit clanok, no musi byt jeho cinnost potvrdena
3 moderator - moze upravovat bez potvrdenia clanku pricom o jeho zmene budei informovany len admin
4 strazca - dava suhlas jednotlyvym uzivatelom na zmenu clanku, kazda potvrdenie je adminovy znama jeho cinnost. Strazca niako neovplyvnuje cinnost moderatrov
5 admin - ma prava nad vsetkymi a kontorluje vsetkych

*/    
    

/*************************************************/$TOTAL_ERROR="<font color = 'red'>Zavazna chyba, snazite sa naburat system, vaša IP adresa je zaznamenana<br />
                                                   Ak ste tento problem nezavinily vy prosim kontaktujte admina na adrese <B>historialinuxu@gmail.com</b><br />
                                                   Uvedte ako predmet spravy ERROR";




 // print_r ($_GET);
/*



ziskam premenne 
v pripade vysvetlivky
                  $vyraz
                  $vysvetlenie
                    pripadne $edit
                              $delete_it

v pripade clanku, BUFFRU
          $clanokcibuf
          
               $meno_clanku
               $samotny_clanok
               $sekcia
                 $viev               - ci obr alebo expl
                 $tab                - strana alebo tabulka
                 prpadne $buf
                
                pripadne $bufsubmit
                $finalsubmit
                
                
                pri ukladani do definitivnej tabulky:
                                                    $buf
                                                    $id_sekcia
                                                    $bufnazov
                                                    $buftext  
                                                    $edit                                                                                                                                                        
  */ 
 
$date= date("Y-m-d"); 
 
 


switch ($spracovanie)
{
/* 
||||||||||||||||||||||
||||||||||||||||||||||
spracovanie vysvetlivky 
||||||||||||||||||||||
||||||||||||||||||||||


*/
case 'vysvetlivka':



/* V PRIPADE ZE NEUPRAVUJEM ALE PRIDAVAM*/
/*najprv si overim ci vyrazuz v databaze neni, naco by som tam pisal 10 krat o tom istom*/



/*ak je nastavene vymazenie netreba robit testy aj tak to tomu zaznamu je uz jedno. Jeho dni su spocitane :) */       
              
                if (isset($delete_it))
                    {
                    $can_I=mas_na_to_pravo('autor_v', $delete_it, 'id_expl', 'delete');
                    if ($can_I==0) {die ("$TOTAL_ERROR HJK-566=$delete_it</font>");
                                            }
                                                  
                          $sql_vyaz_vyraz= "DELETE FROM expl WHERE id= $delete_it ";
                           mysql_query ( $sql_vyaz_vyraz ) or die ($vyhrazna_sprava_5.mysql_error().$vyhrazna_sprava_end);
                         
                         $sql_vyaz_vyraz= "DELETE FROM autor_v WHERE id_expl = $delete_it ";
                           mysql_query ( $sql_vyaz_vyraz ) or die ($vyhrazna_sprava_5.mysql_error().$vyhrazna_sprava_end);
                         
                         
                         
                          /************************************************************************************/
                          /**/$write="delete_pop_up.php?a_ok=1";                                            /**/
                          /************************************************************************************/                                                           
                                                                    
                    }
                    
 /* urobim mensie testy ci je mozne pridat zaznam */                  
                elseif ( $vyraz=='' or
                     $vysvetlenie==''
                      ){ echo "<center>$sprava_volba_prazna</center>";}
                
                /*tato cast zabespecuje ze nezadate viac ako 255 znakov, aj ked som toto uz zabespecil v 
                html kode MAXLENGHT=255, ale clovek nikdy nevie*/
                elseif (strlen($vyraz) > 255) {
                        echo "<center>$sprava_volba_prilis_dlha</center>";
                        } 
                
                else
                /*testy prebehli, vsetko v poriadku, mozem pokracovat dalej*/
                {             
                              $vyraz=addslashes($vyraz);
                              $vysvetlenie=addslashes($vysvetlenie);

                          /* ak je nastavene editovanie vyrazu, prejde na skript updatu ak nie ide skript pridania aj s testami ci sa v DB nenachaza rovnaky zaznam */
                          
                          if (isset($edit))
                          {    
                               $can_I=mas_na_to_pravo('autor_v', $edit, 'id_expl', 'update');           
                               if ($can_I==0) {die ("$TOTAL_ERROR EDT-566=$edit</font>");}  
                          
                                $sql_uprav_vyraz= "UPDATE expl SET vyraz = '$vyraz', vysvetlenie = '$vysvetlenie', datum = '$date' WHERE id = $edit ";
                                 mysql_query ( $sql_uprav_vyraz ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
      
                                $sql_vysvet_autora= "UPDATE autor_v SET new = '3' WHERE id_expl = $edit ";
                                 mysql_query ( $sql_vysvet_autora ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
      
      
                                /************************************************************************************/
                                /**/ $write="index.php?action=admin&adminaction=editujvetlivku&oznac=$edit";      /**/
                                /************************************************************************************/                                                                                      
                                                                        
                          }
                          
                          /*pridavam novy zaznam */
                          else
                          {
                              
                          $sql_zisti_ci_uz_je="SELECT count(vyraz) FROM expl WHERE vyraz='$vyraz'"; /* test ci uz vyraz neexistuje*/
                          $spust_sql_zisti_ci_uz_je= mysql_query ($sql_zisti_ci_uz_je) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end);
                          $vysledok=mysql_fetch_array ($spust_sql_zisti_ci_uz_je);
                          if ($vysledok[0]) {$zaznam_uz_existuje=1;}
                          else {$zaznam_uz_existuje=0;}
                                                    
                          if ($zaznam_uz_existuje==1) {echo $sprava_volba_existuje;}
                          /*zaznam existuje ZAPISOVAT NEMOZEM*/
                          else { 

                               $sql2="INSERT INTO expl ( vyraz, vysvetlenie, datum )". 
                               "VALUE ('".$vyraz."', '".$vysvetlenie."', '".$date."' )";   
                               
                               mysql_query ($sql2) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);
                               
                               $last=posledny_zaznam('expl');
                               
                               if ($TTmoje_prava == 5 ) {$new= 0; } 
                               else if ($TTmoje_prava == 4 or $TTmoje_prava == 3 ) {$new= 1 ;} 
                               else {$new= 2 ;} 
                               
                               $sql2v="INSERT INTO autor_v ( id_usera, id_expl, new )". 
                               "VALUE ( '".$TTmoje_id."', '".$last."', '".$new."' )";   
                               
                               mysql_query ($sql2v) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);                               
                               
                               
                               }   
                               
                                /************************************************************************************/
                                /**/     /*ak je pridany novy clanok zobrazy bude posledny zaznam  zvyrazneny */  /**/
                                /**/  $iddqd=posledny_zaznam('expl');                                             /**/
                                /**/ $write='index.php?action=admin&adminaction=editujvetlivku&oznac='.$iddqd;    /**/
                                /************************************************************************************/  
                          }  
                }


      if ( headers_sent()) { echo "<b><a href='$write'>Pokracovat</a></b>";}
      else { header ("Location:$write");}
    
 

break;
/*==================================================================================================================================*/  






case 'obrazok':

/* 
||||||||||||||||||||||
||||||||||||||||||||||
spracovanie obrazky
||||||||||||||||||||||
||||||||||||||||||||||


*/
/*nastava pridavanie obrazkov. Tento skript mi sposobil niekpolkodenu nevyspatost a predavkovanie sa kavou */

/*pretoze ja posielam data koa FILE skript 

foreach ( $_GET as $kluc => $hodnota){
$$kluc= $hodnota;

my nevttvori spravne premenu$povodny_obrazok

preto to musim spravit takto
*/
$povodny_obrazok = $_FILES['url_obrazku']['name'];

$ciel ="imggalery/";

$ciel_miniatury = $ciel. "miniatury/";

$ciel_a_nazov = $ciel. $povodny_obrazok;
//  $date= date("Y-m-d");

$popis_obrazku=addslashes($popis_obrazku);

if ( move_uploaded_file( $_FILES['url_obrazku']['tmp_name'],
                       $ciel_a_nazov ) ) {

  list( $sirka, $vyska, $typ, $atributy ) = getimagesize( $ciel_a_nazov );

  if ( $typ > 3 ) {
    echo "obrazok nieje GIF, JPG, ani PNG.<br>";
   
  } else {


  $vloz_do_db = "INSERT INTO obrazok
            (  popis, pov_sirka, pov_vyska, datum )
            VALUES
            ( '$popis_obrazku', '$sirka', '$vyska', '$date'  )";
  $spust_sql2 = mysql_query( $vloz_do_db ) or die( mysql_error() );

 $ziskaj_id = mysql_insert_id();  //tuto funkciu som obiavil az ked som mal poslednych par riadkou skriptu na dokoncenie, 
                                  // dost by mi ulahcila robotu to je pravda, co uz  :( 

                              $last=$ziskaj_id;
                               if ($TTmoje_prava == 5 ) {$new= 0; } 
                               else if ($TTmoje_prava == 4 or $TTmoje_prava == 3 ) {$new= 1 ;} 
                               else {$new= 2 ;} 
                               
                               $sql2v="INSERT INTO autor_o ( id_usera, id_obr, new )". 
                               "VALUE ( '".$TTmoje_id."', '".$last."', '".$new."' )";   
                               
                               mysql_query ($sql2v) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);       

  
  $novy_nazov = $ciel. $ziskaj_id. ".jpg";


  if ( $typ == 2 ) {
    rename( $ciel_a_nazov, $novy_nazov );} 
  
  else {
        if ( $typ == 1 ) {
          $obrazok_na_upravu = imagecreatefromgif( $ciel_a_nazov );
         } elseif ( $typ == 3 ) {
         $obrazok_na_upravu = imagecreatefrompng( $ciel_a_nazov );
          }

    $vytvoreny_obrazok_jpg = imagecreatetruecolor( $sirka, $vyska );
    imagecopyresampled( $vytvoreny_obrazok_jpg, $obrazok_na_upravu, 0, 0, 0, 0,
                       $sirka, $vyska, $sirka, $vyska );
    imagejpeg( $vytvoreny_obrazok_jpg, $novy_nazov );
    imagedestroy( $obrazok_na_upravu );
    imagedestroy( $vytvoreny_obrazok_jpg );
      }
  
  

  $novy_nazov_miniatury = $ciel_miniatury. $ziskaj_id. ".jpg";

      if ( $sirka > $vyska ){ 
                        $sirka_zmenseniny="80";
                        $adekvatny_pomer=($sirka/$sirka_zmenseniny);
                        $vyska_zmenseniny=($vyska/$adekvatny_pomer);
                          }
                         
      else{             $vyska_zmenseniny="80";
                        $adekvatny_pomer=($vyska/$vyska_zmenseniny);
                        $sirka_zmenseniny=($sirka/$adekvatny_pomer); 
                        }
     
  $sirka_zmenseniny= ceil($sirka_zmenseniny);  
  $vyska_zmenseniny= ceil($vyska_zmenseniny);  
    
  $orazok_velky = imagecreatefromjpeg( $novy_nazov );
  $miniatura = imagecreatetruecolor( $sirka_zmenseniny, $vyska_zmenseniny );
  imagecopyresampled( $miniatura, $orazok_velky, 0, 0, 0, 0,
                    $sirka_zmenseniny, $vyska_zmenseniny, $sirka, $vyska );
  imagejpeg( $miniatura, $novy_nazov_miniatury );
  imagedestroy( $orazok_velky );
  imagedestroy( $miniatura );

  $write="ukaz_upload.php?id=".$ziskaj_id;

      if ( headers_sent()) { echo "<b><a href='$write'>Váš Upload</a></b>";}
      else { header ("Location:$write");}
}
}


else "nejde toooo!!!!";


break;
/*==================================================================================================================================*/  



/* 
||||||||||||||||||||||
||||||||||||||||||||||
spracovanie clanku
||||||||||||||||||||||
||||||||||||||||||||||



*/




case 'clanok':

//$date= date("Y-m-d");
if (! isset($tab) ) {$tab=1; }





/*
Pri vytvarani tejto stranky som si uvedomil fakt, ze sa tu budu tvorit dlhe clanky,
pri pisani ktorych je risk ze sa udaje stratia. Predstavme si situaciu, ze pisete hodinu 
clanok a zrazu sa vypne elektrina. Mna by takato skutocnost asi situacia dost vyviedla z miery.
Preto som sa rozhodol ze spravim priebezne ukladanie clanku do neutralnej tabulky databazy. 
Tabulka ma nazov BUFFER. Nielenze sa ukladaju udaje ked si to uzivatel zmysli ale aj ked napriklad
prepina strany tabuliek z vyrazmy alebo s obrazkamy. 

Zda sa to byt dost zbytocne a dost proti teorii ze na databazu treba co odosielat najmenej dotazov.
Skutocnost je ale taka ze tu pridava clanok 1 alebo viacej administratorov, teda nie tisic uzivatelov.

Pri prvom odoslani akehokolvek dotazu na spracuj.php (pri vytvarani alebo upravovani clanku) sa vygeneruje cislo pod
ktore bude patrit aj identifikatoru zaznamu v tabulke ( jednoducho povedane vygenerujem cislo ktre bude patrit 
id zaznamu.)
Pod tymto cislom sa bude pracovat dokym sa definitivne clanok neulozi. Potom sa zaznam v tabulke Buffer vymaze 


Bufedit sluzi ked sa clanok upravuje, azpameta sa jeho id cislo, aby sa potom mohlo ulozit pod id ktore mu patri.

*/



// $aq=$bufnieje $aq='ale_je'
// $clanokcibuf
// $co_s_clankom

//$meno_clanku 
//$samotny_clanok
//$sekia
   
/*
   $bufsubmit je pri ulozeni do bufferu  (uzivatel si zvloi ulozit)
   $finalsubmit je pri ukazani clanku   
   
   s buf
          ukazclanok    Array ( [spracovanie] => clanok [viev] => obr [tab] => 1 [buf] => 74 [sekcia] => 1 [meno_clanku] => dsa [samotny_clanok] => dsag[img=imggalery/8.jpg] [finalsubmit] => Ukáž èlanok )
          ulozclanok    Array ( [spracovanie] => clanok [viev] => obr [tab] => 1 [buf] => 74 [sekcia] => 1 [meno_clanku] => dsa [samotny_clanok] => dsag[img=imggalery/8.jpg] [bufsubmit] => Uloži èlanok )  
   akekolvektlacitko    Array ( [spracovanie] => clanok [viev] => expl [tab] => 1 [buf] => 74 [sekcia] => 1 [meno_clanku] => dsa [samotny_clanok] => dsag[img=imggalery/8.jpg] )
   
   bez buf
          ukazclanok   Array ( [spracovanie] => clanok [viev] => expl [tab] => 1 [sekcia] => 5 [meno_clanku] => sd [samotny_clanok] => sd [finalsubmit] => Ukáž èlanok )
          ulozclanok   Array ( [spracovanie] => clanok [viev] => expl [tab] => 1 [sekcia] => 5 [meno_clanku] => sd [samotny_clanok] => sd [bufsubmit] => Uloži èlanok )
  akekolvektlacitko    Array ( [spracovanie] => clanok [viev] => obr [tab] => 1 [sekcia] => 5 [meno_clanku] => sd [samotny_clanok] => sd )
                       Array ( [spracovanie] => clanok [viev] => expl [tab] => 2 [sekcia] => 5 [meno_clanku] => sd [samotny_clanok] => sd )

  bezsekcie            Array ( [spracovanie] => clanok [viev] => expl [tab] => 1 [meno_clanku] => sd [samotny_clanok] => sd [finalsubmit] => Ukáž èlanok ) 
*/   
 


if (isset ($meno_clanku)) {$problemi= otestuj_clanok($meno_clanku, $samotny_clanok);}
elseif (isset ($bufnazov)) {$problemi= otestuj_clanok($bufnazov, $buftext);}  
elseif (isset  ($delete_it) ) {$problemi=0;}// tymto preskocim testy pri vymazuvani clanku, teda ked je nastavene  $delete_it                    
if ($problemi==1){
echo "<center>$sprava_volba_prazna</center>";
                                            }
elseif ($problemi==2){
echo "<center>$sprava_volba_prilis_dlha</center>";
echo "<br>";
echo "<center>Nazov clanku prekrocil 255</center>";
                                            }
else
{ /*ELSE, VSETKO JE OK*/    
if (isset($meno_clanku)) {$meno_clanku=addslashes($meno_clanku);}
if (isset($samotny_clanok)) {$samotny_clanok=addslashes($samotny_clanok);}

  switch ($clanokcibuf)//? to je otazka :)
/***/{//zaciatok switchu buf alebo clanok
/***/
/***/case 'buffer':
                                          if (! isset($asc)){$asc='ASC';}
                                         if (! isset($order)){$order='id';}              
              
              if(isset ($buf)){ $aq='buf_je'; } //je to spravene pre lepsiu zrozumitelnost kodu
              elseif (isset ($delete_it)) { $aq='buf_uz_nebude'; }
              else { $aq='buf_nieje'; } 
 
              switch ($aq)
              {
                  
                  case 'buf_uz_nebude':
                                        
                                                                                       
                                 $sql_vymaz_buf="DELETE FROM buffer WHERE id=$delete_it";              
                                                  $can_I=mas_na_to_pravo('autor_b', $delete_it, 'id_bufferu', 'delete');
                        
                                 if ($can_I==0) {die ("$TOTAL_ERROR DEL-5589=$delete_it</font> ");}  
                                            
                               $sql_vyaz_vyraz= "DELETE FROM autor_b WHERE id_bufferu = $delete_it ";
                               mysql_query ( $sql_vyaz_vyraz ) or die ($vyhrazna_sprava_5.mysql_error().$vyhrazna_sprava_end);
                                
                                $spust_sql_vymaz_buf = mysql_query ( $sql_vymaz_buf ) or die ($vyhrazna_sprava_5.mysql_error().$vyhrazna_sprava_end); 
                            /************************************************************************************/
                            /**/$write="delete_pop_up.php?a_ok=1";                                            /**/
                            /************************************************************************************/
                  break;
                                     
                  case 'buf_nieje':    
                                                      /*
                                      ++++++++++++++++++++++++++++++++++
                                              generovanie cisla 
                                      ++++++++++++++++++++++++++++++++++
                                                      */
                                                   
                                                   /*najprv zistim ci uz nema viasc ako 10 nerozpisanych prispevkov*/
                                                   $sql_count_user="SELECT COUNT(id_bufferu) from autor_b WHERE id_usera=$TTmoje_id";
                                                    $spust_sql_count_u = mysql_query ( $sql_count_user ) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end); 
                                                      $zistenie_z= mysql_fetch_array ($spust_sql_count_u);
                                                   if ($zistenie_z[0] >=10) {die ("FATALNA CHYBA !! Prekrocili ste limit 10 rozpisanych clankov, viac ako 10 nedopisanych clankov nemozte mat.");}
                                                     
                                                   
                                                    $pocet_opakovani_do_konca=10;
                                                    $pokracovat_generovani=1;
                                                    while ( $pokracovat_generovani)
                                                    {
                                                     //generujem nahodne cislo
                                                     $buf = rand(1 , 999999999);
                                                     //overim v DB
                                                      
                                                      
                                                     $pocet_opakovani_do_konca=$pocet_opakovani_do_konca--; //toto je poistka, v pripade ze do 10 pokusov nenajde cislotak skript skonci
                                                      if ($pocet_opakovani_do_konca ==0) {die ( "FATALNA CHYBA !! Pravdepodobne je prislis plna databaza. Prosim kontaktujet historialinuxu@gmail.com");}
                                                      
                                                     $sql_count="SELECT COUNT(id) from buffer WHERE id=$buf";
                                                     
                                                     
                                                     
                                                     
                                                     $spust_sql_count = mysql_query ( $sql_count ) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end); 
                                                      
                                                     $zistenie_z_sql= mysql_fetch_array ($spust_sql_count);
                                                    
                                                      /* do pola $zistenie_z_sql[0] sa mi zapise ci zaznam je alebo nieje!*/
                                                      if ($zistenie_z_sql[0]==0){
                                                                                $pokracovat_generovani=0;
                                                                                }                                                             
                                                      // ak zaznam nieje  uz negeneruj
                                                     }  
                                                          /*
                                        ++++++++++++++++++++++++++++++++++
                                           Pridavanie do bufferu (novy)
                                        ++++++++++++++++++++++++++++++++++
                                                        */
                                                if (! isset ($sekcia) )
                                                 { 
                                                   /* ak nieje este zvolena sekcia do ktorej bude clanok patrit tak ju nastavim
                                                   na cislo 125. Pred ukladanim clanku bude vyzivat uzivatela aby zvolil sekciu*/
                                                   $sekcia=125;
                                                 }
                                                 /*bufedit sluzi v pripade ked sa existujuci clanok upravuje. Vtedy sa pameta jeho id cislo,
                                                  aby sa potom mohlo ulozit pod id ktore mu patri.*/
                                                          if (isset($edit) )
                                                            {$bufedit=$edit;}
                                                          else {$bufedit=0;} 
                                                  $sql_pridaj="INSERT INTO buffer (id, id_sekcia, bufnazov, buftext, expl_obr, strana, bufedit, datum) ".
                                                              "VALUE ('".$buf."','".$sekcia."', '".$meno_clanku."', '".$samotny_clanok."',".
                                                              " '".$viev."', '".$tab."', ".$bufedit.", '".$date."' ) "; 
                                                           
                                                 $spust_sql_pridaj = mysql_query ( $sql_pridaj ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end); 
                                                 
                                                 
                                                                        
                               
                                               $sql2b="INSERT INTO autor_b ( id_usera, id_bufferu )". 
                                               "VALUE ( '".$TTmoje_id."', '".$buf."' )";   
                                               
                                               mysql_query ($sql2b) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);  
                                                                                                         
                              
                              /**  Zapise sa kam ist po vykonani skriptu ******************************************************************/
                              /**/if (  isset ($finalsubmit ) )                                                                         /**/
                              /**/  {$write="index.php?action=admin&adminaction=wievclanok&buf=".$buf;}                                 /**/
                              /**/  else{                                                                                               /**/     
                              /**/  if ( isset ($bufsubmit) ) { $aaa='&save=1'; }                                                       /**/
                              /**/  else {$aaa='';}                                                                                     /**/
                              /**/  $write="index.php?action=admin&adminaction=pridajclanok&buf=".$buf.$aaa."&order=$order&asc=$asc";   /**/
                              /**/     }                                                                                                /**/
                              /************************************************************************************************************/
                              
                              
 /***************************************************************************************************************************************************************/            
                              break;
                             
                              case 'buf_je': 
                      
                                                     
                                         
                                                         if (! isset ($sekcia) )
                                                          {  
                                                           /* ak nieje este zvolena sekcia do ktorej bude clanok patrit tak ju nastavim
                                                           na cislo 125. Pred ukladanim clanku bude vyzivat uzivatela aby zvolil sekciu*/
                                                           $sekcia=125;
                                                          }                                
                                                          if (isset($edit) )
                                                            {$bufedit=$edit;}
                                                          else {$bufedit=0;}   
                                                           /*bufedit sluzi v pripade ked sa existujuci clanok upravuje. 
                                                            Vtedy sa pameta jeho id cislo,
                                                            aby sa potom mohlo ulozit pod id ktore mu patri.*/                                     
                                                          $sql_uprav="UPDATE buffer SET id_sekcia='".$sekcia.
                                                                        "', bufnazov='".$meno_clanku."', buftext='".$samotny_clanok.
                                                                        "', expl_obr='".$viev."', strana='".$tab."', bufedit=".$bufedit.", datum='".$date."'".
                                                                        "WHERE id=".$buf." " ; 
                                                          $spust_sql_uprav = mysql_query ( $sql_uprav ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end); 
                                                            
                                                          $write="index.php?action=admin&adminaction=editujclanok&oznac=".$bufedit;
                          

                              /**  Zapise sa kam ist po vykonani skriptu *******************************************************************/
                              /**/if (  isset ($finalsubmit ) )                                                                          /**/
                              /**/  {$write="index.php?action=admin&adminaction=wievclanok&buf=".$buf;}                                  /**/
                              /**/  else{                                                                                                /**/     
                              /**/  if ( isset ($bufsubmit) ) { $aaa='&save=1'; }                                                        /**/
                              /**/  else {$aaa='';}                                                                                      /**/
                              /**/  $write="index.php?action=admin&adminaction=pridajclanok&buf=".$buf.$aaa."&order=$order&asc=$asc";       /**/
                              /**/     }                                                                                                 /**/
                              /************************************************************************************************************/
                              
                              break;
                              
                                
                             default: 
                              echo "EROOOOOOOR";
                             break;   
                          }//koniec switch $buf   
            
/***************************************************************************************************************************************************************/            
            
/***/break; //koniec $clanokcibuf=='buffer'  
/***/case 'clanok': 
  
 if (isset($edit) ){$co_s_clankom='uprav';}//zaistim tak ze akje upravovanie, nieje sanca ze sa pokusi pridat novy, neni to vsak potrebne ale iba bespecne 
           switch ($co_s_clankom)
              {
                                             
                          
                        case 'delete':
                                          
                                    $sql_vyaz_vyraz= "DELETE FROM clanok WHERE id= $delete_it ";
                                     mysql_query ( $sql_vyaz_vyraz ) or die ($vyhrazna_sprava_5.mysql_error().$vyhrazna_sprava_end);
                     
                                     $sql_vyaz_vyrazz= "DELETE FROM sekcia_clanok WHERE id_clanok= $delete_it ";
                                     mysql_query ( $sql_vyaz_vyrazz ) or die ($vyhrazna_sprava_5.mysql_error().$vyhrazna_sprava_end);
                                     
                                     $sql_vyaz_vyrazzz= "DELETE FROM autor_c WHERE id_clanku= $delete_it ";
                                     mysql_query ( $sql_vyaz_vyrazzz ) or die ($vyhrazna_sprava_5.mysql_error().$vyhrazna_sprava_end);
                                     
                                    $write="delete_pop_up.php?a_ok=1"; // write je  premena obsahujuca kam sa po vykonani spracuj ma uzivatel dostat
                        break;
                        
                        case 'pridaj':
                        
                                   $can_I=mas_na_to_pravo('autor_b', $buf, 'id_bufferu', 'insert');
                                    if ($can_I==0) {die ("$TOTAL_ERROR HJK-122=$buf</font>"); }           
                        
                        
                                      $sql_final_write_cla=" INSERT INTO clanok (clanazov, clatext, cladatum) ".
                                      " VALUES ( '".$bufnazov."', '".$buftext."', '".$date."' );";
                                      $spust_sql_final_write_cla = mysql_query ( $sql_final_write_cla ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end); 
                                      
                                      
                                      $zisti_posledny_v_clanku="SELECT id FROM clanok ORDER BY id DESC LIMIT 1; "; 
                                      $spust_zisti_posledny_v_clanku = mysql_query ( $zisti_posledny_v_clanku ) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end); 
                                      $zistenie_z_sql= mysql_fetch_array ($spust_zisti_posledny_v_clanku);
                                      $posledny_id_v_clanku=  $zistenie_z_sql[0];                              
                                                           
                                      
                                      $sql_final_write_clasek=" INSERT INTO sekcia_clanok (id_clanok, id_sekcia ) ".
                                                              " VALUES ( ".$posledny_id_v_clanku.", ".$id_sekcia." ) ";                      
                                      $spust_sql_final_write_clasek = mysql_query ( $sql_final_write_clasek ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end); 
                                      
                                      $sql_vymaz_buf="DELETE FROM buffer WHERE id=$buf";
                                      $spust_sql_vymaz_buf = mysql_query ( $sql_vymaz_buf ) or die ($vyhrazna_sprava_5.mysql_error().$vyhrazna_sprava_end); 
                                      
                                       
                                      $last=posledny_zaznam('clanok');
                                  
                                      
                                      
                               if ($TTmoje_prava == 5 ) {$new= 0; $ack=1;} 
                               else if ($TTmoje_prava == 4 or $TTmoje_prava == 3 ) {$new= 1 ; $ack=1;} 
                               else {$new= 2 ; $ack=0;} 
                                      
                                      $sql2c="INSERT INTO autor_c ( id_usera, id_clanku, new, ack )". 
                                               "VALUE ( '".$TTmoje_id."', '".$last."' , '". $new ."', '". $ack ."'   )";   
                                               
                                               mysql_query ($sql2c) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);    
                                     
                                     $sql_vymaz_buf="DELETE FROM autor_b WHERE id_bufferu=$buf";
                                      $spust_sql_vymaz_buf = mysql_query ( $sql_vymaz_buf ) or die ($vyhrazna_sprava_5.mysql_error().$vyhrazna_sprava_end);   
                                    
                                    
                                    
                                      
                            /************************************************************************************/
                            /**/      $iddqd=posledny_zaznam('clanok');                                       /**/
                            /**/$write="index.php?action=admin&adminaction=editujclanok&oznac=$iddqd";        /**/
                            /************************************************************************************/                                                
                        break;
                  
                        case 'uprav':
                        
                                    
                        
                        
                                    $zisti_udaje="SELECT * FROM buffer WHERE id=$buf ; ";
                                    $spust_zisti_udaje = mysql_query ( $zisti_udaje ) or die ($vyhrazna_sprava_3.mysql_error().$vyhrazna_sprava_end); 
                                          while ($extraction = mysql_fetch_array( $spust_zisti_udaje ))
                                                          {
                                                         extract( $extraction ); 
                                                          }
                                                       
                                    if ( $bufedit==0 ){echo "error GGHGGT  kontaktujte admina ";}
                                    else
                                        {
                                   
                                    $can_I=mas_na_to_pravo('autor_b', $buf, 'id_bufferu', 'update');
                                    if ($can_I==0) {die ("$TOTAL_ERROR CCU-565=$buf</font>"); }    
                                        
                                    $sql_final_update_cla="UPDATE clanok SET clanazov= '$bufnazov' , clatext= '$buftext' , cladatum= '$date' WHERE id =$bufedit";
                                    $spust_sql_final_update_cla = mysql_query ( $sql_final_update_cla ) or die ($vyhrazna_sprava_4.mysql_error().$vyhrazna_sprava_end); 
                                  
                                    $sql_final_update_clasek="UPDATE sekcia_clanok SET id_sekcia= $id_sekcia WHERE id_clanok=$bufedit ";
                                    $spust_sql_final_update_clasek = mysql_query ( $sql_final_update_clasek ) or die ($vyhrazna_sprava_4.mysql_error().$vyhrazna_sprava_end); 
                                    $sql_vymaz_buf="DELETE FROM buffer WHERE id=$buf";
                                    $spust_sql_vymaz_buf = mysql_query ( $sql_vymaz_buf ) or die ($vyhrazna_sprava_5.mysql_error().$vyhrazna_sprava_end);
                                       
                               
                               if ($TTmoje_prava == 5 ) {$new= 0; $ack=1;} 
                               else if ($TTmoje_prava == 4 or $TTmoje_prava == 3 ) {$new= 3 ; $ack=1;} 
                               else {$new= 3 ; $ack=1;} 
                               
                               
                                 $sql_vysvet_autora= "UPDATE autor_c SET new = '$new' WHERE id_clanku = $edit ";
                                 mysql_query ( $sql_vysvet_autora ) or die ($vyhrazna_sprava_1.mysql_error().$vyhrazna_sprava_end);   
                                  
                                
                                     
                                        }
                            /************************************************************************************/
                            /**/$write="index.php?action=admin&adminaction=editujclanok&oznac=$bufedit";      /**/
                            /************************************************************************************/                                        
                        break;
                  
                       default: 
                        echo "EROOOOOOOR";
                       break;
                } //konic switch $co_s_clankom
/***/break;       
/***/
                       default: 
                        echo "EROOOOOOOR";
                       break;

}//koniec switchu buf alebo clanok
 /***************************************************************************************************************************************************************/            
/***************************************************************************************************************************************************************/            

      
      if ( headers_sent()) { echo "<b><a href='$write'>Pokracovat dalej</a></b>";}
      else { header ("Location:$write");}
} /*KONIEC ELSE, VSETKO JE OK*/



break;
/*==================================================================================================================================*/  



default: 
 echo "EROOOOOOOR";
break;


}

?>
