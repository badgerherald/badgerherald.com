<?php

/*  This code left over from previous SHOUT OUT implementation 
$config = array(
	'SO_DB_host'					=>	"localhost",
	'SO_DB_user'					=>	"badgerh_shoutouts",
	'SO_DB_pass'					=>	"bh!",
	'SO_DB_name'					=>	"badgerh_shoutouts",
	
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


$dbh = mysql_connect(SO_DB_SERVER.':'.SO_DB_PORT,SO_DB_USERNAME,SO_DB_PASSWORD); 

if(!$dbh) {
	echo "<h3>Unable to connect to database. Please check details in configuration file.</h3>"; 
	exit(); 
}

mysql_selectdb(SO_DB_NAME,$dbh); 

mysql_query("SET NAMES utf8"); 
mysql_query("SET CHARACTER SET utf8"); 
mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'"); 

?>
