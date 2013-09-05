<?php

/*  This code left over from previous SHOUT OUT implementation 
$config = array(
	'db_host'					=>	"localhost",
	'db_user'					=>	"badgerh_shoutouts",
	'db_pass'					=>	"bh!",
	'db_name'					=>	"badgerh_shoutouts",
	
'language'					=> "en-us",
'feed_title'				=> "Badger Herald Shout-Outs",
'link'							=> "http://badgerherald.com/shoutouts/new",
'description'				=> "The latest shout-outs posted to badgerherald.com, delivered directly to your computer.",
'copyright'					=> "2010 The Badger Herald - Some Rights Reserved",
'show_feed_pubdate'	=> false,
'headlines'					=> 0,
'show_author_info'	=> false,
'encoding'					=> "ISO-8859-1",
);
*/

/*
 * CONFIG.PHP contains all information about databases, passwords
 * and root URLS.  The script also connects to the relevant database for
 * shoutouts so that this does not need to be done in the script.
 *
 * Think if them as global variables.
 *
 */

/* DATABASE CONNECT */
define('DB_SERVER','localhost'); 
define('DB_PORT','3306'); 
define('DB_USERNAME','rosebowlwp'); 
define('DB_PASSWORD','KuBnLyaHWzhzw6y6'); 
define('DB_NAME','badgerh_shoutouts'); 

/* TABLE DEFINITIONS */
define('DB_SHOUTOUTS','shoutouts_new'); 


/* URL DEFINITIONS */
define("SITE_ROOT","http://badgerherald.com/");
define("SHOUTOUT_ROOT","shoutouts/");
define("TEPLATE_ROOT","BH/shoutouts/components/");
define("STYLE_SHEET_LOCATION","BH/shoutouts/components/header.php");



$dbh = mysql_connect(DB_SERVER.':'.DB_PORT,DB_USERNAME,DB_PASSWORD); 
if (!$dbh) { 
	echo "<h3>Unable to connect to database. Please check details in configuration file.</h3>"; 
	exit(); 
} 
mysql_selectdb(DB_NAME,$dbh); 
mysql_query("SET NAMES utf8"); 
mysql_query("SET CHARACTER SET utf8"); 
mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'"); 

?>
