<?php
header("Content-type: text/html; charset=utf-8");
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );

$p_id=$_GET["p_id"];

$sql= <<<hiu
    delete from product where p_id=$p_id
hiu;

$result = mysqli_query ( $link, $sql) or die("刪除失敗");
header("location:memanage.php");

?>