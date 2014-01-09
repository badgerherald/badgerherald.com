<?php
/**
 * Class that groups common DFP functions together.
 * 
 * Contents:
 * ----------------------------------------------------------------
 *
 * hrld_dfp_header() : outputs tags to embed ad units on the page.
 *
 * hrld_top_leaderboard_ad() : outputs top leaderboard tag.
 * hrld_bottom_leaderboard_ad() : outputs bottom leaderboard tag.
 * hrld_sidebar_ad() : outputs top sidebar tag.
 * hrld_sidebar_lower_ad() : outputs bottom sidebar tag.
 * 
 * ----------------------------------------------------------------
 * 
 * @since Nov 2013
 * @author Will Haynes
 *
 */
class dfp {

        private static $adUnits = array();
        private static $initialized = false;
        private static $placement = "misc";

        private static function initialize() {

            if (self::$initialized)
                    return;

            if(!hrld_is_production()) {
                    self::$placement = "development";
            } else if(is_front_page()) {
                    self::$placement = "homepage";
            } else if (is_page("shoutouts")) {
                    self::$placement = "shoutouts";
            } else if ("news" == get_post_type()) {
                    self::$placement = "news";
            } else if ("sports" == get_post_type()) {
                    self::$placement = "sports";
            } else if ("oped" == get_post_type()) {
                    self::$placement = "banter";
            } else if ("artsetc" == get_post_type()) {
                    self::$placement = "artsetc";
            } else {
                    self::$placement = "misc";
            }

            self::$initialized = true;

    }

        function hrld_dfp_header() {

                self::initialize();

                switch (self::$placement) {
                        
                        case "development":

                                echo "<!-- DFP tags for development site -->";
								$ran = rand(0,1)+1;

                                self::$adUnits['upper-leaderboard'] = "
										
										<img src='" . get_bloginfo('template_directory') . "/img/ads/728x90-$ran.jpg' />

                                ";

                                self::$adUnits['lower-leaderboard'] = "

										<img src='" . get_bloginfo('template_directory') . "/img/ads/728x90-$ran.jpg' />

                                ";

                                self::$adUnits['upper-rect'] = "

										<img src='" . get_bloginfo('template_directory') . "/img/ads/300x250.jpg' />

                                ";

                                self::$adUnits['lower-rect'] = "

										<img src='" . get_bloginfo('template_directory') . "/img/ads/300x250.jpg' />

                                ";

                                  break;        

                        case "homepage":

                                echo "<!-- DFP tags for Homepage -->

                                        <script type='text/javascript'>
                                        var googletag = googletag || {};
                                        googletag.cmd = googletag.cmd || [];
                                        (function() {
                                        var gads = document.createElement('script');
                                        gads.async = true;
                                        gads.type = 'text/javascript';
                                        var useSSL = 'https:' == document.location.protocol;
                                        gads.src = (useSSL ? 'https:' : 'http:') + 
                                        '//www.googletagservices.com/tag/js/gpt.js';
                                        var node = document.getElementsByTagName('script')[0];
                                        node.parentNode.insertBefore(gads, node);
                                        })();
                                        </script>

                                        <script type='text/javascript'>
                                        googletag.cmd.push(function() {
                                        googletag.defineSlot('/8653162/herald//homepage//lower//300x250', [300, 250], 'div-gpt-ad-1385862931104-0').addService(googletag.pubads());
                                        googletag.defineSlot('/8653162/herald//homepage//lower//728x90', [728, 90], 'div-gpt-ad-1385862931104-1').addService(googletag.pubads());
                                        googletag.defineSlot('/8653162/herald//homepage//upper//300x600.300x250', [[300, 250], [300, 600]], 'div-gpt-ad-1385862931104-2').addService(googletag.pubads());
                                        googletag.defineSlot('/8653162/herald//homepage//upper//728x90', [728, 90], 'div-gpt-ad-1385862931104-3').addService(googletag.pubads());
                                        googletag.pubads().enableSingleRequest();
                                        googletag.enableServices();
                                        });
                                        </script>

                                ";

                                self::$adUnits['upper-leaderboard'] = "

                                        <!-- herald/homepage/upper/728x90 -->
                                        <div id='div-gpt-ad-1385862931104-3' style='width:728px; height:90px;'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862931104-3'); });
                                        }</script>
                                        </div>

                                ";

                                self::$adUnits['lower-leaderboard'] = "

                                        <!-- herald/homepage/lower/728x90 -->
                                        <div id='div-gpt-ad-1385862931104-1' style='width:728px; height:90px;'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862931104-1'); });
                                        }</script>
                                        </div>

                                ";

                                self::$adUnits['upper-rect'] = "

                                        <!-- herald/homepage/upper/300x600.300x250 -->
                                        <div id='div-gpt-ad-1385862931104-2'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862931104-2'); });
                                        }
                                        </script>
                                        </div>

                                ";

                                self::$adUnits['lower-rect'] = "

                                        <!-- herald/homepage/lower/300x250 -->
                                        <div id='div-gpt-ad-1385862931104-0' style='width:300px; height:250px;'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862931104-0'); });
                                        }</script>
                                        </div>

                                ";

                                  break;        

                        case "shoutouts":

                                echo "<!-- DFP tags for Shoutouts -->

                                        <script type='text/javascript'>
                                        var googletag = googletag || {};
                                        googletag.cmd = googletag.cmd || [];
                                        (function() {
                                        var gads = document.createElement('script');
                                        gads.async = true;
                                        gads.type = 'text/javascript';
                                        var useSSL = 'https:' == document.location.protocol;
                                        gads.src = (useSSL ? 'https:' : 'http:') + 
                                        '//www.googletagservices.com/tag/js/gpt.js';
                                        var node = document.getElementsByTagName('script')[0];
                                        node.parentNode.insertBefore(gads, node);
                                        })();
                                        </script>

                                        <script type='text/javascript'>
                                        googletag.cmd.push(function() {
                                        googletag.defineSlot('/8653162/herald//shoutouts//lower//300x250', [300, 250], 'div-gpt-ad-1385862843903-0').addService(googletag.pubads());
                                        googletag.defineSlot('/8653162/herald//shoutouts//lower//728x90', [728, 90], 'div-gpt-ad-1385862843903-1').addService(googletag.pubads());
                                        googletag.defineSlot('/8653162/herald//shoutouts//upper//300x600.300x250', [[300, 250], [300, 600]], 'div-gpt-ad-1385862843903-2').addService(googletag.pubads());
                                        googletag.defineSlot('/8653162/herald//shoutouts//upper//728x90', [728, 90], 'div-gpt-ad-1385862843903-3').addService(googletag.pubads());
                                        googletag.pubads().enableSingleRequest();
                                        googletag.enableServices();
                                        });
                                        </script>

                                ";

                                self::$adUnits['upper-leaderboard'] = "

                                        <!-- herald/shoutouts/upper/728x90 -->
                                        <div id='div-gpt-ad-1385862843903-3' style='width:728px; height:90px;'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862843903-3'); });
                                        }
                                        </script>
                                        </div>

                                ";

                                self::$adUnits['lower-leaderboard'] = "

                                        <!-- herald/shoutouts/lower/728x90 -->
                                        <div id='div-gpt-ad-1385862843903-1' style='width:728px; height:90px;'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862843903-1'); });
                                        }
                                        </script>
                                        </div>

                                ";

                                self::$adUnits['upper-rect'] = "

                                        <!-- herald/shoutouts/upper/300x600.300x250 -->
                                        <div id='div-gpt-ad-1385862843903-2'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862843903-2'); });
                                        }
                                        </script>
                                        </div>

                                ";

                                self::$adUnits['lower-rect'] = "

                                        <!-- herald/shoutouts/lower/300x250 -->
                                        <div id='div-gpt-ad-1385862843903-0' style='width:300px; height:250px;'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862843903-0'); });
                                        }
                                        </script>
                                        </div>

                                ";

                                  break;        
                
                        case "sports":
                                
                                echo "<!-- DFP tags for Sports -->

                                        <script type='text/javascript'>
                                        var googletag = googletag || {};
                                        googletag.cmd = googletag.cmd || [];
                                        (function() {
                                        var gads = document.createElement('script');
                                        gads.async = true;
                                        gads.type = 'text/javascript';
                                        var useSSL = 'https:' == document.location.protocol;
                                        gads.src = (useSSL ? 'https:' : 'http:') + 
                                        '//www.googletagservices.com/tag/js/gpt.js';
                                        var node = document.getElementsByTagName('script')[0];
                                        node.parentNode.insertBefore(gads, node);
                                        })();
                                        </script>

                                        <script type='text/javascript'>
                                        googletag.cmd.push(function() {
                                        googletag.defineSlot('/8653162/herald//sports//lower//300x250', [300, 250], 'div-gpt-ad-1385862766096-0').addService(googletag.pubads());
                                        googletag.defineSlot('/8653162/herald//sports//lower//728x90', [728, 90], 'div-gpt-ad-1385862766096-1').addService(googletag.pubads());
                                        googletag.defineSlot('/8653162/herald//sports//upper//300x600.300x250', [[300, 250], [300, 600]], 'div-gpt-ad-1385862766096-2').addService(googletag.pubads());
                                        googletag.defineSlot('/8653162/herald//sports//upper//728x90', [728, 90], 'div-gpt-ad-1385862766096-3').addService(googletag.pubads());
                                        googletag.pubads().enableSingleRequest();
                                        googletag.enableServices();
                                        });
                                        </script>

                                ";

                                self::$adUnits['upper-leaderboard'] = "

                                        <!-- herald/sports/upper/728x90 -->
                                        <div id='div-gpt-ad-1385862766096-3' style='width:728px; height:90px;'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862766096-3'); });
                                        }</script>
                                        </div>

                                ";

                                self::$adUnits['lower-leaderboard'] = "

                                        <!-- herald/sports/lower/728x90 -->
                                        <div id='div-gpt-ad-1385862766096-1' style='width:728px; height:90px;'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862766096-1'); });
                                        }
                                        </script>
                                        </div>

                                ";

                                self::$adUnits['upper-rect'] = "

                                        <!-- herald/sports/upper/300x600.300x250 -->
                                        <div id='div-gpt-ad-1385862766096-2'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862766096-2'); });
                                        }
                                        </script>
                                        </div>

                                ";

                                self::$adUnits['lower-rect'] = "

                                        <!-- herald/sports/lower/300x250 -->
                                        <div id='div-gpt-ad-1385862766096-0' style='width:300px; height:250px;'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862766096-0'); });
                                        }
                                        </script>
                                        </div>

                                ";

                                  break;        

                        case "artsetc":
                                echo "<!-- DFP tags for ArtsEtc. -->

                                        <script type='text/javascript'>
                                        var googletag = googletag || {};
                                        googletag.cmd = googletag.cmd || [];
                                        (function() {
                                        var gads = document.createElement('script');
                                        gads.async = true;
                                        gads.type = 'text/javascript';
                                        var useSSL = 'https:' == document.location.protocol;
                                        gads.src = (useSSL ? 'https:' : 'http:') + 
                                        '//www.googletagservices.com/tag/js/gpt.js';
                                        var node = document.getElementsByTagName('script')[0];
                                        node.parentNode.insertBefore(gads, node);
                                        })();
                                        </script>

                                        <script type='text/javascript'>
                                        googletag.cmd.push(function() {
                                        googletag.defineSlot('/8653162/herald//artsetc//lower//300x250', [300, 250], 'div-gpt-ad-1385860635393-0').addService(googletag.pubads());
                                        googletag.defineSlot('/8653162/herald//artsetc//lower//728x90', [728, 90], 'div-gpt-ad-1385860635393-1').addService(googletag.pubads());
                                        googletag.defineSlot('/8653162/herald//artsetc//upper//300x600.300x250', [[300, 250], [300, 600]], 'div-gpt-ad-1385860635393-2').addService(googletag.pubads());
                                        googletag.defineSlot('/8653162/herald//artsetc//upper//728x90', [728, 90], 'div-gpt-ad-1385860635393-3').addService(googletag.pubads());
                                        googletag.pubads().enableSingleRequest();
                                        googletag.enableServices();
                                        });
                                        </script>

                                ";

                                self::$adUnits['upper-leaderboard'] = "

                                        <!-- herald/artsetc/upper/728x90 -->
                                        <div id='div-gpt-ad-1385860635393-3' style='width:728px; height:90px;'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385860635393-3'); });
                                        }
                                        </script>
                                        </div>

                                ";

                                self::$adUnits['lower-leaderboard'] = "

                                        <!-- herald/artsetc/lower/728x90 -->
                                        <div id='div-gpt-ad-1385860635393-1' style='width:728px; height:90px;'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385860635393-1'); });
                                        }
                                        </script>
                                        </div>

                                ";

                                self::$adUnits['upper-rect'] = "

                                        <!-- herald/artsetc/upper/300x600.300x250 -->
                                        <div id='div-gpt-ad-1385860635393-2'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385860635393-2'); });
                                        }
                                        </script>
                                        </div>

                                ";

                                self::$adUnits['lower-rect'] = "

                                        <!-- herald/artsetc/lower/300x250 -->
                                        <div id='div-gpt-ad-1385860635393-0' style='width:300px; height:250px;'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385860635393-0'); });
                                        }
                                        </script>
                                        </div>

                                ";

                                  break;                

                        case "banter":

                        echo "<!-- DFP tags for Banter -->

                                        <script type='text/javascript'>
                                        var googletag = googletag || {};
                                        googletag.cmd = googletag.cmd || [];
                                        (function() {
                                        var gads = document.createElement('script');
                                        gads.async = true;
                                        gads.type = 'text/javascript';
                                        var useSSL = 'https:' == document.location.protocol;
                                        gads.src = (useSSL ? 'https:' : 'http:') + 
                                        '//www.googletagservices.com/tag/js/gpt.js';
                                        var node = document.getElementsByTagName('script')[0];
                                        node.parentNode.insertBefore(gads, node);
                                        })();
                                        </script>

                                        <script type='text/javascript'>
                                        googletag.cmd.push(function() {
                                        googletag.defineSlot('/8653162/herald//banter//lower//300x250', [300, 250], 'div-gpt-ad-1385862429867-0').addService(googletag.pubads());
                                        googletag.defineSlot('/8653162/herald//banter//lower//728x90', [728, 90], 'div-gpt-ad-1385862429867-1').addService(googletag.pubads());
                                        googletag.defineSlot('/8653162/herald//banter//upper//300x600.300x250', [[300, 250], [300, 600]], 'div-gpt-ad-1385862429867-2').addService(googletag.pubads());
                                        googletag.defineSlot('/8653162/herald//banter//upper//728x90', [728, 90], 'div-gpt-ad-1385862429867-3').addService(googletag.pubads());
                                        googletag.pubads().enableSingleRequest();
                                        googletag.enableServices();
                                        });
                                        </script>

                                ";

                                self::$adUnits['upper-leaderboard'] = "

                                        <!-- herald/banter/upper/728x90 -->
                                        <div id='div-gpt-ad-1385862429867-3' style='width:728px; height:90px;'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862429867-3'); });
                                        }
                                        </script>
                                        </div>

                                ";

                                self::$adUnits['lower-leaderboard'] = "

                                        <!-- herald/banter/lower/728x90 -->
                                        <div id='div-gpt-ad-1385862429867-1' style='width:728px; height:90px;'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862429867-1'); });
                                        }
                                        </script>
                                        </div>

                                ";

                                self::$adUnits['upper-rect'] = "

                                        <!-- herald/banter/upper/300x600.300x250 -->
                                        <div id='div-gpt-ad-1385862429867-2'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862429867-2'); });
                                        }
                                        </script>
                                        </div>

                                ";

                                self::$adUnits['lower-rect'] = "

                                        <!-- herald/banter/lower/300x250 -->
                                        <div id='div-gpt-ad-1385862429867-0' style='width:300px; height:250px;'>
                                        <script type='text/javascript'>
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862429867-0'); });
                                        </script>
                                        </div>

                                ";
                                  break;        

                        case "news":

                        echo "<!-- DFP tags for News -->

                                        <script type='text/javascript'>
                                        var googletag = googletag || {};
                                        googletag.cmd = googletag.cmd || [];
                                        (function() {
                                        var gads = document.createElement('script');
                                        gads.async = true;
                                        gads.type = 'text/javascript';
                                        var useSSL = 'https:' == document.location.protocol;
                                        gads.src = (useSSL ? 'https:' : 'http:') + 
                                        '//www.googletagservices.com/tag/js/gpt.js';
                                        var node = document.getElementsByTagName('script')[0];
                                        node.parentNode.insertBefore(gads, node);
                                        })();
                                        </script>

                                        <script type='text/javascript'>
                                        googletag.cmd.push(function() {
                                        googletag.defineSlot('/8653162/herald//news//lower//300x250', [300, 250], 'div-gpt-ad-1385862520901-0').addService(googletag.pubads());
                                        googletag.defineSlot('/8653162/herald//news//lower//728x90', [728, 90], 'div-gpt-ad-1385862520901-1').addService(googletag.pubads());
                                        googletag.defineSlot('/8653162/herald//news//upper//300x600.300x250', [[300, 250], [300, 600]], 'div-gpt-ad-1385862520901-2').addService(googletag.pubads());
                                        googletag.defineSlot('/8653162/herald//news//upper//728x90', [728, 90], 'div-gpt-ad-1385862520901-3').addService(googletag.pubads());
                                        googletag.pubads().enableSingleRequest();
                                        googletag.enableServices();
                                        });
                                        </script>

                                ";

                                self::$adUnits['upper-leaderboard'] = "

                                        <!-- herald/news/upper/728x90 -->
                                        <div id='div-gpt-ad-1385862520901-3' style='width:728px; height:90px;'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862520901-3'); });
                                        }
                                        </script>
                                        </div>

                                ";

                                self::$adUnits['lower-leaderboard'] = "

                                        <!-- herald/news/lower/728x90 -->
                                        <div id='div-gpt-ad-1385862520901-1' style='width:728px; height:90px;'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862520901-1'); });
                                        }
                                        </script>
                                        </div>


                                ";

                                self::$adUnits['upper-rect'] = "

                                        <!-- herald/news/upper/300x600.300x250 -->
                                        <div id='div-gpt-ad-1385862520901-2'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862520901-2'); });
                                        }
                                        </script>
                                        </div>

                                ";

                                self::$adUnits['lower-rect'] = "

                                        <!-- herald/news/lower/300x250 -->
                                        <div id='div-gpt-ad-1385862520901-0' style='width:300px; height:250px;'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862520901-0'); });
                                        }
                                        </script>
                                        </div>

                                ";
                                  break;        
        
                        default :


                                echo "<!-- DFP tags for Misc -->

                                <script type='text/javascript'>
                                var googletag = googletag || {};
                                googletag.cmd = googletag.cmd || [];
                                (function() {
                                var gads = document.createElement('script');
                                gads.async = true;
                                gads.type = 'text/javascript';
                                var useSSL = 'https:' == document.location.protocol;
                                gads.src = (useSSL ? 'https:' : 'http:') + 
                                '//www.googletagservices.com/tag/js/gpt.js';
                                var node = document.getElementsByTagName('script')[0];
                                node.parentNode.insertBefore(gads, node);
                                })();
                                </script>

                                <script type='text/javascript'>
                                googletag.cmd.push(function() {
                                googletag.defineSlot('/8653162/herald//misc//lower//300x250', [300, 250], 'div-gpt-ad-1385862674454-0').addService(googletag.pubads());
                                googletag.defineSlot('/8653162/herald//misc//lower//728x90', [728, 90], 'div-gpt-ad-1385862674454-1').addService(googletag.pubads());
                                googletag.defineSlot('/8653162/herald//misc//upper//300x600.300x250', [[300, 250], [300, 600]], 'div-gpt-ad-1385862674454-2').addService(googletag.pubads());
                                googletag.defineSlot('/8653162/herald//misc//upper//728x90', [728, 90], 'div-gpt-ad-1385862674454-3').addService(googletag.pubads());
                                googletag.pubads().enableSingleRequest();
                                googletag.enableServices();
                                });
                                </script>

                                ";

                                self::$adUnits['upper-leaderboard'] = "

                                        <!-- herald/misc/upper/728x90 -->
                                        <div id='div-gpt-ad-1385862674454-3' style='width:728px; height:90px;'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862674454-3'); });
                                        }
                                        </script>
                                        </div>

                                ";

                                self::$adUnits['lower-leaderboard'] = "

                                        <!-- herald/misc/lower/728x90 -->
                                        <div id='div-gpt-ad-1385862674454-1' style='width:728px; height:90px;'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862674454-1'); });
                                        }
                                        </script>
                                        </div>


                                ";

                                self::$adUnits['upper-rect'] = "

                                        <!-- herald/misc/lower/728x90 -->
                                        <div id='div-gpt-ad-1385862674454-1' style='width:728px; height:90px;'>
                                        <script type='text/javascript'>
                                        if(window.innerWidth >= 768){
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862674454-1'); });
                                        }
                                        </script>
                                        </div>

                                ";

                                self::$adUnits['lower-rect'] = "

                                        <!-- herald/misc/lower/300x250 -->
                                        <div id='div-gpt-ad-1385862674454-0' style='width:300px; height:250px;'>
                                        <script type='text/javascript'>
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1385862674454-0'); });
                                        </script>

                                ";

                }


        }


        function hrld_top_leaderboard_ad() { 

                echo "<div id='ad-leaderboard'>";
                echo self::$adUnits['upper-leaderboard'];
                echo "</div>";

        }

/*
function hrld_bottom_leaderboard_ad() { 

        if(hrld_is_production()) :

                echo "
                        <!-- v6.sitewide.leaderboard.bottom -->
                        <div id='div-gpt-ad-1379013535352-2' style=''>
                        <script type='text/javascript'>
                        if(window.innerWidth >= 768){
                                document.getElementById('div-gpt-ad-1379013535352-2').style.width = 728 +'px';
                                document.getElementById('div-gpt-ad-1379013535352-2').style.height = 90 +'px';
                                googletag.cmd.push(function() { googletag.display('div-gpt-ad-1379013535352-2'); });
                        }
                        </script>
                        </div>
                ";

        else :

                echo "<img src='" . get_bloginfo('template_directory') . "/img/ads/728x90.jpg' />";

        endif;

} */

        function hrld_bottom_leaderboard_ad() { 
                
                echo "<div id='ad-leaderboard'>";
                echo self::$adUnits['lower-leaderboard'];
                echo "</div>";

        } 

        function hrld_sidebar_ad() { 

                echo "<div id='ad-leaderboard'>";
                echo self::$adUnits['upper-rect'];
                echo "</div>";

        }

        function hrld_sidebar_lower_ad() { 

                echo "<div id='ad-leaderboard'>";
                echo self::$adUnits['lower-rect'];
                echo "</div>";

        }

}