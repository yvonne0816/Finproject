<<?php
header("Content-type: text/html; charset=utf-8");
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );

$d_id=$_GET["d_id"];

$sql= <<<hiu
    update dreamlist set buy = true where d_id = $d_id;
hiu;

$result = mysqli_query ( $link, $sql) or die("加入失敗");

echo "<script>alert('成功結帳'); location.href = 'shopcar.php';</script>";

?>
