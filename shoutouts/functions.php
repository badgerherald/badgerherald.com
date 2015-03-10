<?php

require_once('config.php');

$so_dbh = mysql_connect(SO_DB_SERVER.':'.SO_DB_PORT,SO_DB_USERNAME,SO_DB_PASSWORD); 
if (!$so_dbh) { 
	echo "<h3>Unable to connect to database. Please check details in configuration file.</h3>"; 
	exit(); 
} 

mysql_selectdb(SO_DB_NAME,$so_dbh); 
mysql_query("SET NAMES utf8"); 
mysql_query("SET CHARACTER SET utf8"); 
mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'"); 


/** 
  * Class: ShoutoutList
  *
  * Goes to database, and grabs the specified shoutouts, and then adds them to 
  * a nice array for you.  (array of Shoutout objects).
  * 
  */ 
class ShoutoutList {
	
	private $shoutouts = array();
	private $numShoutouts;
	private $pagenum;
	private $perpage;
	private $setid;
	
	function __construct($pagenum=NULL,$perpage=NULL,$setid=NULL) {
		
		global $so_dbh;

		//mysql_selectdb(SO_DB_NAME,$so_dbh);

		if($pagenum==NULL) {
			$pagenum = 1;
		}
		$this->pagenum = $pagenum;
		
		/** If this is NOT a multiple of 40, find which page contains the shoutout requested, 
			*	and send the user there NOTE: this is a header request, so MUST be the first 
			*  operation on the page.
			*/

		if($perpage==NULL) {
			$perpage = 40;
		}
		$this->perpage = $perpage;

		if($setid==NULL) {
			/* First, we fetch the current set of shoutouts 'setid', from the export date table */
			$result = @mysql_fetch_assoc(mysql_query('SELECT MAX(setidofexported) as "setid" FROM shoutouts_exports'));
			$setid = (int)$result[setid];
		}
		$this->setid = $setid;

		$start = ($pagenum * $perpage) - $perpage;
		
		/* We write a query to fetch all APPROVED shoutouts from the current SETID */
		$sql = "SELECT `text`, `date`, `id`, `sonum` FROM shoutouts_new WHERE setid='$setid' AND approved=1 ORDER BY `date` DESC";
		$sql .= " LIMIT $start, $perpage";


//		echo $sql . "<hr/>";
		$query = mysql_query($sql);
//		echo mysql_error();

		/* Load those suckers into an array */
		while($shoutout = mysql_fetch_assoc($query)) {
			$this->shoutouts[$shoutout[sonum]] = new Shoutout($shoutout[id],$shoutout[sonum],$setid,$shoutout[text],$shoutout[date]);
		}


		$query = "SELECT COUNT(id) FROM shoutouts_new WHERE (`date` > (SELECT MAX(export_date) FROM shoutouts_exports) OR (SELECT COUNT(export_date) FROM shoutouts_exports) = 0) AND approved=1";

		/* Find out how many shoutouts we're dealing with here (pull largest sonum id from database for that setid */
		$numResults = @mysql_fetch_assoc(mysql_query("SELECT COUNT(*) as 'sonum' FROM shoutouts_new WHERE setid='$setid' AND approved=1"));
		$this->numShoutouts = (int)$numResults[sonum];

	}
	
	function numShoutouts() {
		return $this->numShoutouts;
	}
	
	function getArray() {
		return $this->shoutouts;
	}
	
	function hasShoutouts() {
	
		if($this->numShoutouts == 0)
			return FALSE;
		else
			return TRUE;
			
	}
	
	function getNav($pageLocation) {
		
	//	if($pageLocation==NULL) {
			$pageLocation = "page/";
	//	}
		
		$numPages = ceil($this->numShoutouts/$this->perpage);
		
		$toReturn = "";

		if($numPages<=8) {

			$toReturn = '<ul class="shoutout-navbar"><li>Page: </li>';
			
			for($x = 1; $x <= $numPages; $x++) {
				
			$toReturn .= '<li><a href="';
			  
			  if($x==1) {
				  $toReturn .= SITE_ROOT . SHOUTOUT_ROOT . '"';
					}
				else {
				  $toReturn .= SITE_ROOT . SHOUTOUT_ROOT . $pageLocation . $x . '"';
			  }
			  if($x==$this->pagenum) {
				  $toReturn .= ' class="current-page">';
				  }
			  else {
				  $toReturn .= '>';
			  	}
			  	
				  $toReturn .= $x . "</a>";
			
			  $toReturn .= "</li>";
			  
			}
			
			$toReturn .= "</ul>";
		
		} else {

			$toReturn = '<ul class="shoutout-navbar"><li>Page: </li>';
			
			$toReturn .= '<li><a href="' . SITE_ROOT . SHOUTOUT_ROOT . '">1</a></li>';

			if($this->pagenum>3)
				$toReturn .= '<li class="so-ellipses">...</li>';

			for($x = min(max($this->pagenum-1,2),$numPages-2); $x <= min(max($this->pagenum,2)+1,$numPages-1); $x++) {
				
			$toReturn .= '<li><a href="' . SITE_ROOT . SHOUTOUT_ROOT . $pageLocation . $x . '"';

			  if($x==$this->pagenum) {
				  $toReturn .= ' class="current-page">';
				  }
			  else {
				  $toReturn .= '>';
			  	}
			  	
				  $toReturn .= $x . "</a>";
			
			  $toReturn .= "</li>";
			  
			}

			if($this->pagenum < $numPages - 2)
				$toReturn .= '<li class="so-ellipses">...</li>';

			$toReturn .= '<li><a href="' . SITE_ROOT . SHOUTOUT_ROOT . $pageLocation . $numPages . '">' . $numPages . '</a></li>';
			
			$toReturn .= "</ul>";

		}

		return $toReturn;
		
	}
	
}

/** 
  * Class: Shoutout
  *
  * Stores shoutout information in nice compact object.
  * Allows us to access shoutout information without dealing lots of operations.
  *
  * METHODS: getID(), getSOnum(), getText(), getDate([$date (string)]).
  * 
  */ 
class Shoutout {
	
	private $setid;
	private $id;
	private $sonum;
	private $text;
	private $date;
	
	function __construct($id=null,$sonum=null,$setid=null,$text=null,$date=null) {
	
		$this->id = $id;
		
		$this->sonum = $sonum;
		
		$this->setid = $setid;
		
		$this->text = stripslashes(htmlentities($text));
		
		$this->date = strtotime($date);
		
	}
	
	function getID() {
		return $this->id;
	}
	
	function getSetID() {
		return $this->setid;
	}
	
	function getNum() {
		return $this->sonum;
	}
	
	function getText() {
		
		/* Start routine to parse the SO for hashtags */
				
		/* We match all the hashtags in the text, and drop them in $hashtags */
		preg_match_all("/#[0-9]{1,6}/", $this->text, $hashtags);
		
		/* Get rid of the multidimensionality of $hashtags */
		$hashtags = $hashtags[0];
				
		/* We then seperate the string into an array of elements around the hashtag into $hashtagSplit. */
		$hashtagSplit = preg_split("/#[0-9]{1,6}/", $this->text);
				
		/* Example of above:
				
			#54: "SO referencing #23.  What do we do about it #yolo?"
					
			$hashtags[0] = "#23"
					
			$hashtagSplit[0] = "SO referencing "						** #23 was pulled out of the string & split
			$hashtagSplit[1] = ".  What do we do about it #yolo?"		** #yolo doesn't match regex.
				
			*/

		$referencedText = "";
		
		for($x = 0; $x < sizeof($hashtagSplit); $x++) {
					
			$referencedText .= $hashtagSplit[$x];
			$setid = $this->setid;		
			$hashtags[$x] = trim($hashtags[$x],"#");				
			$sql = "SELECT id FROM " . SO_DB_NAME . " WHERE setid=$setid AND sonum='$hashtags[$x]' AND approved=1 LIMIT 1";


$dbh = mysql_connect(SO_DB_SERVER.':'.SO_DB_PORT,SO_DB_USERNAME,SO_DB_PASSWORD); 
if (!$dbh) { 
	echo "<h3>Unable to connect to database. Please check details in configuration file.</h3>"; 
	exit(); 
} 
mysql_selectdb(SO_DB_NAME,$dbh); 
mysql_query("SET NAMES utf8"); 
mysql_query("SET CHARACTER SET utf8"); 
mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'"); 




			$result = mysql_query($sql);
			if($result) {
				$referenceSO = mysql_fetch_assoc($result);
				$referenceSO = (int)$referenceSO[id];				
				if($x != sizeof($hashtagSplit)-1){
					if($referenceSO!=NULL) {
						$referencedText .= "<a target='_blank' href='" . SITE_ROOT . SHOUTOUT_ROOT  . "so/" . $referenceSO . "' title='Shoutout #" . $hashtags[$x] . "'>";
						$referencedText .="#";
						$referencedText .=$hashtags[$x];
						$referencedText .="</a>";
					}
					else {
						$referencedText .="#";
						$referencedText .=$hashtags[$x];
					}
				}
			}
		}
				
		$this->text = $referencedText;
		
		return $this->text;
		
	}
	
	function getDate($dateString=null) {
			
		if($dateString==NULL)
			return date("l, M. j, Y @ g:ia",$this->date);
		else
			return date($dateString,$this->date);

	}
	
} 

?>
