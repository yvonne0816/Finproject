<?php
header("Content-type: text/html; charset=utf-8");
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );

$m_id=$_GET["m_id"];
$hi = $_GET["hi"];
if($hi==1){
$sql= <<<hiu
    delete from member where m_id=$m_id
hiu;

$result = mysqli_query ( $link, $sql) or die("刪除失敗1");
header("location:memanage.php");
}
else if($hi==2){
    $sql2= <<<hiu
    update member set canuse=true where m_id=$m_id
    hiu;

    $result = mysqli_query ( $link, $sql2) or die("刪除失敗2");
    header("location:memanage.php");
}

else if($hi==3){
    $sql3= <<<hiu
    update member set canuse=false where m_id=$m_id
    hiu;

    $result = mysqli_query ( $link, $sql3) or die("刪除失敗3");
    header("location:memanage.php");
}

?>