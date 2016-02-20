<?php 

function analytic_dashboard() {
	add_menu_page( "Analytics", "Analytics", "edit_posts", "Analytics", "analytic_dashboard_html", "", 5);
}
add_action('admin_menu','analytic_dashboard');

function analytic_dashboard_html() {

	$access_token = json_decode ( get_option('analyticbridge_access_token') );
	$profile = get_option('analyticbridge_setting_account_profile_id');

	$todaysPageLevel2 = date("/Y/", current_time('U'));
	$todaysPageLevel3 = date("/m/", current_time('U'));
	$todaysPageLevel4start = date("/d/", current_time('U'));

	$yesterdaysPageLevel2 = date("/Y/", current_time('U') - 24*60*60);
	$yesterdaysPageLevel3 = date("/m/", current_time('U') - 24*60*60);
	$yesterdaysPageLevel4start = date("/d/", current_time('U') - 24*60*60);

	$threeDaysPageLevel2 = date("/Y/", current_time('U') - 2*24*60*60);
	$threeDaysPageLevel3 = date("/m/", current_time('U') - 2*24*60*60);
	$threeDaysPageLevel4start = date("/d/", current_time('U') - 2*24*60*60);

?>



<script>
(function(w,d,s,g,js,fs){
  g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
  js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
  js.src='https://apis.google.com/js/platform.js';
  fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
}(window,document,'script'));
</script>


<style> 
.top-chart {

}


.sidebar {
	float:left;
	width: 38%;
	margin-right: 2%;
}

.pie-chart {
	margin-top: -50px;
}

.main {
	width: 60%;
	float: left;
}

.top-chart {
	margin-top: -60px;
}

h4 {
	color: #bbb;
	margin-top: -12px;
}

hr {
	border: none;
	height: 1px;
	background: #bbb;
}

.post-table {
	margin-bottom: 24px;
}
</style>


<div class="wrap">
<h2>Today's Analytics</h2>
<hr/>
<div class="top">
	<h2>Pageviews by hour</h2>
	<div id="top" class="top-chart"></div>
</div>

<hr />

<div class="sidebar">
	<h2>Section breakdown:</h2>
	<h4>Today's pageviews by section.</h4>
	<div id="sectionbreakdown" class="pie-chart"></div>
</div>


<div class="main">

	<h2>Today's content:</h2>
	<h4>Today's pageviews for content published today.</h4>
	<div id="todaysposts" class="post-table"></div>
	<hr />

	<h2>Yesterday's content:</h2>
	<h4>Today's pageviews for content published on <?php echo date("l", current_time('U') - 1*24*60*60); ?>.</h4>
	<div id="yesterdaysposts" class="post-table"></div>
	
	<hr />
	<h2><?php echo date("l", current_time('U') - 2*24*60*60); ?>'s content</h2>
	<h4>Today's pageviews for content published on <?php echo date("l", current_time('U') - 2*24*60*60); ?>.</h4>
	<div id="threeDaysPosts" class="post-table"></div>

</div>

</div>

<div class="clearfix"></div>


<script>

gapi.analytics.ready(function() {

  /**
   * Auth using saved server token
   */
  gapi.analytics.auth.authorize({
    'serverAuth': {
      'access_token': '<?php echo $access_token->access_token ?>'
    }
  });


  /**
   * Creates a new DataChart instance showing sessions over the past 30 days.
   * It will be rendered inside an element with the id "chart-1-container".
   */
  var dataChart1 = new gapi.analytics.googleCharts.DataChart({
    query: {
      'ids': '<?php echo $profile ?>', // The Demos & Tools website view.
      'start-date': 'today',
      'end-date': 'today',
      'metrics': 'ga:sessions,ga:pageviews',
      'dimensions': 'ga:hour',
    },
    chart: {
      'container': 'top',
      'type': 'LINE',
      'options': {
        'width': '100%',
        'backgroundColor':'transparent',
        'legend': {'alignment':'end'}
      }
    }
  });
  dataChart1.execute();


  /**
   * Creates a new DataChart instance showing top 5 most popular demos/tools
   * amongst returning users only.
   * It will be rendered inside an element with the id "chart-3-container".
   */
  var dataChart2 = new gapi.analytics.googleCharts.DataChart({
    query: {
      'ids': '<?php echo $profile ?>', // The Demos & Tools website view.
      'start-date': '30daysAgo',
      'end-date': 'today',
      'metrics': 'ga:pageviews',
      'dimensions': 'ga:pagePathLevel1',
      'sort': '-ga:pageviews',
      'filters': 'ga:pagePathLevel1==/banter/,ga:pagePathLevel1==/news/,ga:pagePathLevel1==/sports/,ga:pagePathLevel1==/artsetc/,ga:pagePathLevel1==/opinion/',
      'max-results': 7
    },
    chart: {
      'container': 'sectionbreakdown',
      'type': 'PIE',
      'options': {
        'width': '100%',
        'pieHole': 6/9,
        'fontSize': 14,
        'backgroundColor':'transparent',
        'pieSliceText':'none',
      }
    }
  });
  dataChart2.execute();

  /**
   * Creates a new DataChart instance showing top 5 most popular demos/tools
   * amongst returning users only.
   * It will be rendered inside an element with the id "chart-3-container".

  var dataChart3 = new gapi.analytics.googleCharts.DataChart({
    query: {
      'ids': '<?php echo $profile ?>', // The Demos & Tools website view.
      'start-date': 'today',
      'end-date': 'today',
      'metrics': 'ga:uniquePageviews',
      'dimensions': 'ga:pageTitle',
      'sort': '-ga:uniquePageviews',
      'max-results': 10
    },
    chart: {
      'container': '',
      'type': 'TABLE',
      'options': {
        'width': '100%',
        'pieHole': 7/9,
      }
    }
  }).on('error', function(response) {
  	console.log(response.error.message);
  });

  dataChart3.execute();
   */
  /**
   * Creates a new DataChart instance showing top 5 most popular demos/tools
   * amongst returning users only.
   * It will be rendered inside an element with the id "chart-3-container".
   */
  var dataChart4 = new gapi.analytics.googleCharts.DataChart({
    query: {
      'ids': '<?php echo $profile ?>', // The Demos & Tools website view.
      'start-date': 'today',
      'end-date': 'today',
      'metrics': 'ga:uniquePageviews',
      'dimensions': 'ga:pageTitle',
      'sort': '-ga:uniquePageviews',
      'filters': "ga:pagePathLevel2==<?php echo $todaysPageLevel2 ?>;ga:pagePathLevel3==<?php echo $todaysPageLevel3 ?>;ga:pagePathLevel4=@<?php echo $todaysPageLevel4start ?>",
      'max-results': 100
    },
    chart: {
      'container': 'todaysposts',
      'type': 'TABLE',
      'options': {
        'width': '100%',
        'backgroundColor':'transparent',
        'pieHole': 7/9,
      }
    }
  }).on('error', function(response) {
  	console.log(response.error.message);
  });

  dataChart4.execute();

  /**
   * Creates a new DataChart instance showing top 5 most popular demos/tools
   * amongst returning users only.
   * It will be rendered inside an element with the id "chart-3-container".
 */
  var dataChart5 = new gapi.analytics.googleCharts.DataChart({
    query: {
      'ids': '<?php echo $profile ?>', // The Demos & Tools website view.
      'start-date': 'today',
      'end-date': 'today',
      'metrics': 'ga:uniquePageviews',
      'dimensions': 'ga:pageTitle',
      'sort': '-ga:uniquePageviews',
	  'filters': "ga:pagePathLevel2==<?php echo $yesterdaysPageLevel2 ?>;ga:pagePathLevel3==<?php echo $yesterdaysPageLevel3 ?>;ga:pagePathLevel4=@<?php echo $yesterdaysPageLevel4start ?>",
      'max-results': 100
    },
    chart: {
      'container': 'yesterdaysposts',
      'type': 'TABLE',
      'options': {
        'width': '100%',
        'backgroundColor':'transparent',
        'pieHole': 7/9,
      }
    }
  }).on('error', function(response) {
  	console.log(response.error.message);
  });

  dataChart5.execute();

   /**
   * Creates a new DataChart instance showing top 5 most popular demos/tools
   * amongst returning users only.
   * It will be rendered inside an element with the id "chart-3-container".
   */
  var dataChart6 = new gapi.analytics.googleCharts.DataChart({
    query: {
      'ids': '<?php echo $profile ?>', // The Demos & Tools website view.
      'start-date': 'today',
      'end-date': 'today',
      'metrics': 'ga:uniquePageviews',
      'dimensions': 'ga:pageTitle',
      'sort': '-ga:uniquePageviews',
	  'filters': "ga:pagePathLevel2==<?php echo $threeDaysPageLevel2 ?>;ga:pagePathLevel3==<?php echo $threeDaysPageLevel3 ?>;ga:pagePathLevel4=@<?php echo $threeDaysPageLevel4start ?>",
      'max-results': 100
    },
    chart: {
      'container': 'threeDaysPosts',
      'type': 'TABLE',
      'options': {
        'width': '100%',
        'pieHole': 7/9,
      }
    }
  }).on('error', function(response) {
  	console.log(response.error.message);
  });

  dataChart6.execute();


  /*
  .on('success', function(response) {
  	console.log(response.chart);
    console.log(response.data);
    response.data.cols = [];
    return response;
   // response.data.cols[2].type = "time";
  }).execute();
  */
   
  
});
</script>

<?php
}


