<?php

/*
 * Data feeder for udadisi.
 * Retrieves data from a MySQL database
 */

date_default_timezone_set("UTC");
set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', 1);
//$mysqli = new mysqli("localhost", "root", "", "albatross");
//$mysqli = new mysqli("localhost", "root", "", "udadisi");

//Please be ethical with my database
//@github trolls: this is fine, you have reduced privileges with this DB user
$mysqli = new mysqli("lunaroverlord.cn3imgfeosz7.eu-west-1.rds.amazonaws.com", "maksis", "esmugejs", "udadisi");

// Default search term for testing
if(!isset($_POST["query"]))
	$query = "innovation";
else $query = $_POST["query"];


$result = array();
$mysqli->query('SET CHARACTER SET utf8');

//TODO: similarity measure for texts
$res = $mysqli->query("SELECT * FROM articles WHERE UPPER(title) LIKE UPPER('%$query%') OR UPPER(text) LIKE UPPER('%$query%') LIMIT 100");
while($row = mysqli_fetch_assoc($res))
{
	$result[] = $row;
}

$json = json_encode($result);
echo $json;

?>
