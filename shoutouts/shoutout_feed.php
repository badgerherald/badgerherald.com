<?php
include("config.php");

$shoutouts = array();
$query = 'SELECT id, text, sonum, `date` FROM shoutouts_new WHERE (`date` > (SELECT MAX(export_date) FROM shoutouts_exports) OR (SELECT COUNT(export_date) FROM shoutouts_exports) = 0) AND approved=1 ORDER BY `date` DESC LIMIT 50';
$query = @mysql_query($query);
$items_output = null;
$item_count = 0;
while($shoutout = mysql_fetch_assoc($query))
{

		$date = strtotime($shoutout['date']);
		$link = htmlentities("http://badgerherald.com/shoutouts/so.php?id=");
		$id = $shoutout['id'];
		$sonum = $shoutout['sonum'];
		$pubdate = date("r",$date);
		$author = "Anonymous";
		$item_count += 1;
		$description = $shoutout['text'];
		$text = $shoutout['text'];
		
		$items_output .= <<<EOF
		
		<item>
			<title>{$sonum}</title>
			<description>
				{$description}
			</description>
			<link>{$link}{$id}</link>
			<pubDate>{$pubdate}</pubDate>
			<guid isPermaLink="false">{$id}@badgerherald.com/shoutouts</guid>
		</item>
EOF;

	}

$config['encoding']    = empty($config['encoding']) ? 'ISO-8859-1' : $config['encoding'];
$copyright            = empty($config['copyright']) ? null : "<copyright>".str_replace('{year}',date('Y'),$config['copyright'])."</copyright>";
$pubdate            = $config['show_feed_pubdate'] ? "<pubDate>".gmdate('r')."</pubDate>" : null;
$language            = empty($config['language']) ? null : "<language>{$config['language']}</language>";
$output = <<<EOF
<?xml version="1.0" encoding="{$config['encoding']}" ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>{$config['feed_title']}</title>
        <link>{$config['link']}</link>
        <description>{$config['description']}</description>{$copyright}{$pubdate}{$language}{$items_output}
    <atom:link href="http://badgerherald.com/shoutouts/shoutout_feed.php" rel="self" type="application/rss+xml" />
    </channel>
</rss>

EOF;

header("Content-type: application/xml; charset={$config['encoding']}");
echo $output;
?>