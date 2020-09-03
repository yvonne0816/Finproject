<?php

session_start();



header("Content-type: text/html; charset=utf-8");
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );

$p_id = $_GET['pid'];
echo $_SESSION["qBox"];


// $sql = <<<qlcq
// 	select p.p_name,d_quantity,p.p_price,d_id,(d_quantity*p.p_price) as total_price from dreamlist d inner join product p on d.p_id=p.p_id;
// 	qlcq;
// $result = mysqli_query ( $link, $sql) or die("查詢失敗");

?>