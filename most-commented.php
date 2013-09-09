<?php
/**
 *
 * BH Homepage Theme.
 * 
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

    class Disqus {
 
        var $filePath = "";
        var $apiURI = "";

        var $secretKey = "zBYc5cVJogFEYDKkvVmBr92Aq4yh2s5R8TJFNzJUydMt0pX34BZQss3jyd7kh95M";
        var $apiKey = "qIobfUffjcgzf092RFB6hXjQnlDpiF7BhjRGBNcYlex1uLIGIv9PCurhTiCjVgdE";
		
        function __construct() {
	        
	        	// TODO: These should eventually be passed.
	        	
            $this->filePath = get_template_directory() . "/cache/disqus/listPopular.json";
            $this->apiURI = "https://disqus.com/api/3.0/threads/listPopular.json?api_key=qIobfUffjcgzf092RFB6hXjQnlDpiF7BhjRGBNcYlex1uLIGIv9PCurhTiCjVgdE&forum=badgerherald";
            
            // Does the file need to be updated?
            
            if ($this->checkForRenewal()) {
 
            	// Save the data to your file
              $xml = $this->getExternalInfo();
 
            }
            
        }
 
        function checkForRenewal() {
            
            // Set the caching time (in seconds)
            $cachetime = 100000; //(60 * 60 * 24); // One day.
 
            // Get the file time
            $filetimemod = @filemtime($this->filePath) + $cachetime;
 
            // If the renewal date is smaller than now, return true; else false (no need for update)
            
            if ($filetimemod < time()) {
                return true;
            } else {
                return false;
            }
            
        }
 
        function getExternalInfo() {
        
        	if(@copy($this->apiURI,$this->filePath)) {
        		echo "copied";
	        	return true;
        	} else {
        		echo "oops";
	        	return false;
        	}
        
        }
 
        function listPopular() {

	      	$arr = @json_decode(file_get_contents($this->filePath),true);
	       	return $arr['response'];
	      	
        }
 
    }
    
    $dq = new Disqus();
    $dq = $dq->listPopular();
    
    $d = array();
    ?>
    <ul class="top-headlines">
    <?php for ($i = 0; $i<15; $i+=1) :
    
    	$d = $dq[$i];

        if ($d[title]=="") break;
    	?>  
	  
		  <li><a href="<?php echo $d[link] ?>">

			  <?php echo $d[title] ?>
			    
		  </a></li>
	    
    <?php endfor; ?>
    </ul>
 