CREATE TABLE `tomas_valent_4d`.`admin_nast` (
`id` mediumint( 9 ) NOT NULL AUTO_INCREMENT ,
`zlsi` tinyint( 4 ) NOT NULL default '0',
`reg_form` text NOT NULL ,
PRIMARY KEY ( `id` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `tomas_valent_4d`.`autor_b` (
`id_usera` int( 11 ) NOT NULL default '0',
`id_bufferu` int( 11 ) NOT NULL default '0',
PRIMARY KEY ( `id_usera` , `id_bufferu` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `tomas_valent_4d`.`autor_c` (
`id_usera` int( 11 ) NOT NULL default '0',
`id_clanku` int( 11 ) NOT NULL default '0',
`ack` tinyint( 4 ) NOT NULL default '0',
`new` tinyint( 4 ) NOT NULL default '0',
PRIMARY KEY ( `id_usera` , `id_clanku` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `tomas_valent_4d`.`autor_o` (
`id_usera` int( 11 ) NOT NULL default '0',
`id_obr` int( 11 ) NOT NULL default '0',
`new` tinyint( 4 ) NOT NULL default '0',
PRIMARY KEY ( `id_usera` , `id_obr` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `tomas_valent_4d`.`autor_u` (
`id_usera` int( 11 ) NOT NULL default '0',
`id_uprava` int( 11 ) NOT NULL default '0',
PRIMARY KEY ( `id_usera` , `id_uprava` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `tomas_valent_4d`.`autor_v` (
`id_usera` int( 11 ) NOT NULL default '0',
`id_expl` int( 11 ) NOT NULL default '0',
`new` tinyint( 4 ) NOT NULL default '0',
PRIMARY KEY ( `id_usera` , `id_expl` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `tomas_valent_4d`.`buffer` (
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

CREATE TABLE `tomas_valent_4d`.`clanok` (
`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
`clanazov` varchar( 255 ) NOT NULL default '',
`clatext` text NOT NULL ,
`cladatum` date NOT NULL default '0000-00-00',
PRIMARY KEY ( `id` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `tomas_valent_4d`.`expl` (
`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
`vyraz` varchar( 255 ) NOT NULL default '',
`vysvetlenie` text NOT NULL ,
`datum` date NOT NULL default '0000-00-00',
PRIMARY KEY ( `id` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `tomas_valent_4d`.`heslo` (
`id` int( 4 ) NOT NULL AUTO_INCREMENT ,
`pass` varchar( 255 ) NOT NULL default '',
PRIMARY KEY ( `id` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `tomas_valent_4d`.`nastavenia` (
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

CREATE TABLE `tomas_valent_4d`.`obrazok` (
`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
`popis` varchar( 255 ) NOT NULL default '',
`pov_sirka` int( 5 ) NOT NULL default '0',
`pov_vyska` int( 5 ) NOT NULL default '0',
`datum` date NOT NULL default '0000-00-00',
PRIMARY KEY ( `id` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `tomas_valent_4d`.`profil` (
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

CREATE TABLE `tomas_valent_4d`.`sekcia` (
`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
`nazov` varchar( 255 ) NOT NULL default '',
`vysvetlivka` varchar( 255 ) NOT NULL default '',
PRIMARY KEY ( `id` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `tomas_valent_4d`.`sekcia_clanok` (
`id_clanok` int( 11 ) NOT NULL default '0',
`id_sekcia` int( 11 ) NOT NULL default '0',
PRIMARY KEY ( `id_sekcia` , `id_clanok` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;

CREATE TABLE `tomas_valent_4d`.`testuj_s` (
`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
`clanazov` varchar( 255 ) NOT NULL default '',
`clatext` text NOT NULL ,
`cladatum` date NOT NULL default '0000-00-00',
PRIMARY KEY ( `id` )
) ENGINE = MYISAM DEFAULT CHARSET = utf8;
