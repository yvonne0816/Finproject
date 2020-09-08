<?php
  session_start();

header("Content-type: text/html; charset=utf-8");
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );

if(isset($_SESSION["buname"])){
	$u=$_SESSION["buname"];
	echo json_encode(array(
		'username' => $u
	));
	//echo "ok";
}
else{
	header('Location: index.html');
}
?>