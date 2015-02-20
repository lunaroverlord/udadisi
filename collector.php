
<?php


date_default_timezone_set("UTC");
set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', 1);
//$mysqli = new mysqli("localhost", "root", "", "albatross");
//$mysqli = new mysqli("localhost", "root", "", "udadisi");
$mysqli = new mysqli("lunaroverlord.cn3imgfeosz7.eu-west-1.rds.amazonaws.com", "maksis", "esmugejs", "udadisi");




echo "<pre>";

/*
 * Read in KIBERA CSV
 */
/*
$csv = array_map('str_getcsv', file('./sources/kibera.csv'));
///can have images
//print_r($csv);
foreach($csv as $r)
{
	if($r[6] != "REPORT TITLE")
	{
		$title = $r[3];
		$text = $r[6];  
		$link = $r[2];
		$picture_link = $r[0];
		$date = strtotime($r[7]);
		$location = $r[8];
		$mysqli->query("INSERT INTO articles (source, title, text, link, picture_link, date, location)
			VALUES ('KIBERA', '$title', '$text', '$link', '$picture_link', '$date', '$location')");
		//echo ("INSERT INTO articles (source, title, text, link, date, location)
		//	VALUES ('KIBERA', '$title', '$text', '$link', '$date', '$location')");
	}
}
 */

/*
 * Twitter 20k posts with geolocation from cartodb
 * Mostly stupid
 */

/*
$csv = array_map('str_getcsv', file('./sources/twitter_kot.csv'));
//print_r($csv);
foreach($csv as $r)
{
		$title = $r[13];
		$text = $r[3];  
		$link = $r[2];
		$date = strtotime($r[16]);
		$location = $r[34];
		//$mysqli->query("INSERT INTO articles (source, title, text, link, date, location)
			//VALUES ('TWITTER_KOT', '$title', '$text', '$link', '$date', '$location')");
		echo ("INSERT INTO articles (source, title, text, link, date, location)
			VALUES ('KIBERA', '$title', '$text', '$link', '$date', '$location')");
}
 */
/*
 * Twitter 10k posts from kenyan techies
 */
/*
$json = ( json_decode(file_get_contents("./sources/tweet_user.json")));
print_r($json);
foreach($json->tweets as $obj)
{
	$title = $obj->title;
	$text = mysql_real_escape_string($obj->content);
	$link = $obj->url;
	$picture_link = $obj->image;
	$date = strtotime($obj->date);
	$location = "";

	//$mysqli->query("INSERT INTO articles (source, title, text, link, picture_link, date, location)
		//VALUES ('TWEET_TECH', '$title', '$text', '$link', '$picture_link', '$date', '$location')");
	//echo ("INSERT INTO articles (source, title, text, link, picture_link, date, location)
	//	VALUES ('TWEET_TECH', '$title', '$text', '$link', '$picture_link', '$date', '$location')");
}
 */

/*
 * IHUB startups
 */
/*
$csv = array_map('str_getcsv', file('./sources/ihub.csv'));
//print_r($csv);
foreach($csv as $r)
{
	print_r($r);
		$title = $r[5];
		$text = $r[9];  
		$link = $r[2];
		$picture_link = $r[0];
		$date = strtotime($r[8]);
		$location = $r[6];
		$mysqli->query("INSERT INTO articles (source, title, text, link, picture_link, date, location)
			VALUES ('IHUB_STARTUPS', '$title', '$text', '$link', '$picture_link', '$date', '$location')");
		//echo ("INSERT INTO articles (source, title, text, link, date, location)
			//VALUES ('IHUB_STARTUPS', '$title', '$text', '$link', '$date', '$location')");
}
 */

/*
 * IHUB blog posts
 */
/*
$json = ( json_decode(file_get_contents("./sources/ihub_blog.json")));
foreach($json->articles as $obj)
{
	$title = $obj->title;
	$text = mysql_real_escape_string($obj->content);
	$link = $obj->url;
	$picture_link = $obj->image;
	$date = strtotime($obj->date);
	$location = "";
//	echo ("INSERT INTO articles (source, title, text, link, date, location)
//		VALUES ('IHUB_BLOG', '$title', '$text', '$link', '$picture_link', '$date', '$location')");
	$mysqli->query("INSERT INTO articles (source, title, text, link, picture_link, date, location)
		VALUES ('IHUB_BLOG', '$title', '$text', '$link', '$picture_link', '$date', '$location')");
}
 */

/*
 * Guardian articles about kenya
 */

/*
if ($handle = opendir("./sources/guardian/"))
{
	while (false !== ($file = readdir($handle)))
	{
		if ('.' === $file) continue;
		if ('..' === $file) continue;


		$json = ( json_decode(file_get_contents("./sources/guardian/$file")));

		foreach($json->response->results as $obj)
		{
			$title = $obj->webTitle;
			$text = mysql_real_escape_string($obj->fields->body);
			$link = $obj->webUrl;
			$date = strtotime($obj->webPublicationDate);
			$location = "";

			$mysqli->query("INSERT INTO articles (source, title, text, link, date, location)
				VALUES ('GUARDIAN', '$title', '$text', '$link', '$date', '$location')");
			//echo ("INSERT INTO articles (source, title, text, link, date, location)
				//VALUES ('GUARDIAN', '$title', '$text', '$link', '$date', '$location')");
		}

	}
	closedir($handle);
}
 */

/*
 * Daily nation technology articles about Kenya
 */
//$json = ( json_decode(file_get_contents("./sources/articles_daily_nation.json")));
/*
$json = ( json_decode(file_get_contents("./sources/daily_nation_technology.json")));
foreach($json->articles as $obj)
{
	$title = $obj->title;
	$text = mysql_real_escape_string($obj->content);
	$link = $obj->url;
	$picture_link = $obj->image;
	$date = strtotime($obj->date);
	$location = "";

	$mysqli->query("INSERT INTO articles (source, title, text, link, picture_link, date, location)
		VALUES ('DAILYNATION', '$title', '$text', '$link', '$picture_link', '$date', '$location')");
	//echo ("INSERT INTO articles (source, title, text, link, picture_link, date, location)
	//	VALUES ('DAILYNATION', '$title', '$text', '$link', '$picture_link', '$date', '$location')");
}

 */


echo "</pre>";
?>
