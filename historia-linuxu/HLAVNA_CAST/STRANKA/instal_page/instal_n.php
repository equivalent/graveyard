<?php
include "setup.php";
/*

upozornenie tento skript nieje dokonceny. Nieje preto ani sucastou zdrojovych kodov, je to viacmenej priprava na verziu 2.0
*/
$spojenie= mysql_connect( $host, $sql_user, $sql_pass )
 or die ('CHYBA!!!  spojenie zlyhalo <br>'.mysql_error() );
mysql_select_db('matura_valent', $spojenie);

/*
$DB='matura_valent';

$sql_born_ct="CREATE DATABASE `$DB` ;";
mysql_query ($sql_born_ct) or die ("<font color='red' >Vytvorenie databazy neuspešné </font> krok1");
echo "<font color='green' >Vytvorenie databazy '$DB' uspešné </font><br />";
*/

/*
echo $sql_born="CREATE TABLE `$DB`.`admin_nast` (
`id` mediumint( 9 ) NOT NULL AUTO_INCREMENT ,
`zlsi` tinyint( 4 ) NOT NULL default '0',
`reg_form` text NOT NULL ,
PRIMARY KEY ( `id` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `$DB`.`autor_b` (
`id_usera` int( 11 ) NOT NULL default '0',
`id_bufferu` int( 11 ) NOT NULL default '0',
PRIMARY KEY ( `id_usera` , `id_bufferu` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `$DB`.`autor_c` (
`id_usera` int( 11 ) NOT NULL default '0',
`id_clanku` int( 11 ) NOT NULL default '0',
`ack` tinyint( 4 ) NOT NULL default '0',
`new` tinyint( 4 ) NOT NULL default '0',
PRIMARY KEY ( `id_usera` , `id_clanku` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `$DB`.`autor_o` (
`id_usera` int( 11 ) NOT NULL default '0',
`id_obr` int( 11 ) NOT NULL default '0',
`new` tinyint( 4 ) NOT NULL default '0',
PRIMARY KEY ( `id_usera` , `id_obr` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `$DB`.`autor_u` (
`id_usera` int( 11 ) NOT NULL default '0',
`id_uprava` int( 11 ) NOT NULL default '0',
PRIMARY KEY ( `id_usera` , `id_uprava` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `$DB`.`autor_v` (
`id_usera` int( 11 ) NOT NULL default '0',
`id_expl` int( 11 ) NOT NULL default '0',
`new` tinyint( 4 ) NOT NULL default '0',
PRIMARY KEY ( `id_usera` , `id_expl` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `$DB`.`buffer` (
`id` int( 11 ) NOT NULL default '0',
`id_sekcia` tinyint( 4 ) NOT NULL default '0',
`bufnazov` varchar( 255 ) NOT NULL default '',
`buftext` text NOT NULL ,
`expl_obr` varchar( 20 ) NOT NULL default '',
`strana` tinyint( 4 ) NOT NULL default '0',
`bufedit` int( 11 ) default NULL ,
`datum` date NOT NULL default '0000-00-00',
PRIMARY KEY ( `id` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `$DB`.`clanok` (
`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
`clanazov` varchar( 255 ) NOT NULL default '',
`clatext` text NOT NULL ,
`cladatum` date NOT NULL default '0000-00-00',
PRIMARY KEY ( `id` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `$DB`.`expl` (
`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
`vyraz` varchar( 255 ) NOT NULL default '',
`vysvetlenie` text NOT NULL ,
`datum` date NOT NULL default '0000-00-00',
PRIMARY KEY ( `id` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `$DB`.`heslo` (
`id` int( 4 ) NOT NULL AUTO_INCREMENT ,
`pass` varchar( 255 ) NOT NULL default '',
PRIMARY KEY ( `id` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `$DB`.`nastavenia` (
`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
`stm` int( 11 ) NOT NULL default '0',
`vpo` int( 11 ) NOT NULL default '0',
`vlo` int( 11 ) NOT NULL default '0',
`mmlp` int( 11 ) NOT NULL default '0',
`mmm` int( 11 ) NOT NULL default '0',
`mmlam` int( 11 ) NOT NULL default '0',
`form_w` int( 11 ) NOT NULL default '0',
`textarea_w` int( 11 ) NOT NULL default '0',
`textarea_h` int( 11 ) NOT NULL default '0',
`v_s` int( 11 ) NOT NULL default '0',
`rnt` int( 11 ) NOT NULL default '0',
`rntpc` int( 11 ) NOT NULL default '0',
`popupv` int( 11 ) NOT NULL default '0',
`popups` int( 11 ) NOT NULL default '0',
PRIMARY KEY ( `id` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `$DB`.`obrazok` (
`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
`popis` varchar( 255 ) NOT NULL default '',
`pov_sirka` int( 5 ) NOT NULL default '0',
`pov_vyska` int( 5 ) NOT NULL default '0',
`datum` date NOT NULL default '0000-00-00',
PRIMARY KEY ( `id` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `$DB`.`profil` (
`id` mediumint( 9 ) NOT NULL AUTO_INCREMENT ,
`user` varchar( 255 ) NOT NULL default '',
`real_name` varchar( 255 ) NOT NULL default '',
`real_priezv` varchar( 255 ) NOT NULL default '',
`email` varchar( 255 ) NOT NULL default '',
`nieco_o` varchar( 255 ) NOT NULL default '',
`zverej_email` tinyint( 4 ) NOT NULL default '0',
`prava` tinyint( 4 ) NOT NULL default '0',
`id_nastavenia` int( 11 ) NOT NULL default '0',
`is_active` tinyint( 4 ) NOT NULL default '0',
`datum` date NOT NULL default '0000-00-00',
`id_pass` int( 11 ) NOT NULL default '0',
PRIMARY KEY ( `id` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `$DB`.`sekcia` (
`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
`nazov` varchar( 255 ) NOT NULL default '',
`vysvetlivka` varchar( 255 ) NOT NULL default '',
PRIMARY KEY ( `id` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `$DB`.`sekcia_clanok` (
`id_clanok` int( 11 ) NOT NULL default '0',
`id_sekcia` int( 11 ) NOT NULL default '0',
PRIMARY KEY ( `id_sekcia` , `id_clanok` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `$DB`.`testuj_s` (
`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
`clanazov` varchar( 255 ) NOT NULL default '',
`clatext` text NOT NULL ,
`cladatum` date NOT NULL default '0000-00-00',
PRIMARY KEY ( `id` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;";
mysql_query ($sql_born) or die (mysql_error()."<br /><font color='red' >Vytvorenie databazy neuspešné </font> krok2");
echo "<font color='green' >Vytvorenie tabuliek databazy uspešné </font><br />";


*/

$ok="<font color='green' >Vlozenie udajov do databazy uspešné </font><br />";
$notok="<br /><font color='red' >Neuspešné</font> ";

$nastavenie1="INSERT INTO nastavenia ( id, stm, vpo, vlo, mmlp, mmm, mmlam, form_w, textarea_w, textarea_h, v_s, rnt, rntpc,  popupv, popups ) VALUE (1, 160, 5, 5, 5, 5, 5, 50, 60, 50, 5, 10, 6,  180, 360); ";

mysql_query ($nastavenie1) or die (mysql_error()."$notok krok3");
echo $ok;

$nastavenie2="INSERT INTO nastavenia ( id, stm, vpo, vlo, mmlp, mmm, mmlam, form_w, textarea_w, textarea_h, v_s, rnt, rntpc,  popupv, popups ) VALUE (2, 160, 5, 5, 5, 5, 5, 50, 60, 50, 5, 10, 6,  180, 360); ";
echo $ok;
mysql_query ($nastavenie1) or die (mysql_error()."$notok krok4");
echo $ok;

$nastavenie3="INSERT INTO admin_nast ( id, zlsi, reg_form ) VALUE (1, 1, 'ahoj' ); ";
echo $ok;
mysql_query ($nastavenie1) or die (mysql_error()."$notok krok5");
echo $ok;

?>
