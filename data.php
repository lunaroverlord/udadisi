<?php
date_default_timezone_set("UTC");
set_time_limit(0);
error_reporting(E_ALL);
ini_set('display_errors', 1);
//$mysqli = new mysqli("localhost", "root", "", "albatross");
//$mysqli = new mysqli("localhost", "root", "", "udadisi");
$mysqli = new mysqli("lunaroverlord.cn3imgfeosz7.eu-west-1.rds.amazonaws.com", "maksis", "esmugejs", "udadisi");

if(!isset($_POST["query"]))
	$query = "Alibaba";
else $query = $_POST["query"];


$result = array();
$mysqli->query('SET CHARACTER SET utf8');
$res = $mysqli->query("SELECT * FROM articles WHERE UPPER(title) LIKE UPPER('%$query%') OR UPPER(text) LIKE UPPER('%$query%')");
while($row = mysqli_fetch_assoc($res))
{
	$result[] = $row;
}

$json = json_encode($result);
echo $json;

?>