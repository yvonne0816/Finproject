<?php
header("Content-type: text/html; charset=utf-8");
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );

$d_id=$_GET["d_id"];

$sql2="select * from dreamlist where d_id=$d_id";
$result2= mysqli_query ( $link, $sql2) or die("加入失敗");
$row2=mysqli_fetch_assoc($result2);
$d=$row2['d_quantity'];
$pid=$row2['p_id'];

$sql4="select p_quantity from product where p_id=$pid";
$result4= mysqli_query ( $link, $sql4) or die("加入失敗");
$row4=mysqli_fetch_assoc($result4);
$p=$row4['p_quantity'];

$sql3= <<<hiu
    update product set p_quantity =($p+$d) where p_id = $pid;
hiu;

$result3 = mysqli_query ( $link, $sql3) or die("減失敗");

$sql= <<<hiu
    delete from dreamlist where d_id=$d_id
hiu;

$result = mysqli_query ( $link, $sql) or die("刪除失敗");
header("location:shopcar.php");

?>