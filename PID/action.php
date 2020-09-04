<<?php
header("Content-type: text/html; charset=utf-8");
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );

$d_id=$_GET["d_id"];
$id=$_GET["id"];
if($id==2){
    $a=rand(1,99999999);
    $sql= <<<hiu
        update dreamlist set buy = true , d_number = $a where d_id = $d_id;
    hiu;
    $result = mysqli_query ( $link, $sql) or die("加入失敗");


    $sql2="select * from dreamlist where d_id=$d_id";
    $result2= mysqli_query ( $link, $sql2) or die("加入失敗");
    $row2=mysqli_fetch_assoc($result2);
    $d=$row2['d_quantity'];
    $pid=$row2['p_id'];
                
    $sql4="select p_quantity from product where p_id=$pid";
    $result4= mysqli_query ( $link, $sql4) or die("加入失敗");
    $row4=mysqli_fetch_assoc($result4);
    $p=$row4['p_quantity'];

    if($p>=$d){
        $sql3= <<<hiu
            update product set p_quantity =($p-$d) where p_id = $pid;
        hiu;         
        $result3 = mysqli_query ( $link, $sql3) or die("減失敗");
        echo "<script>alert('成功結帳，訂單編號：$a'); location.href = 'shopcar.php';</script>";
    }
    else{
        echo "<script>alert('庫存已空，請選購其他商品'); location.href = 'shopcar.php';</script>";
    }
}

// if($id==1){
//     $sql= <<<hiu
//         delete from dreamlist where d_id=$d_id
//     hiu;
//     $result = mysqli_query ( $link, $sql) or die("刪除失敗");
//     header("location:shopcar.php");
// }
?>
