<?php
session_start();
header('Content-Type: application/json; charset=UTF-8');
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );

$uname = $_POST["username"];
$password = hash('sha256', $_POST["password"]);
//echo($password);
if(isset($uname)){
$sql = <<<qlc
    select * from member where m_username = "$uname" and m_passwd="$password"
    qlc;
    $result = mysqli_query ( $link, $sql) or die("查詢失敗");
    $row = mysqli_fetch_assoc( $result );
    //var_dump($row);
    if($row){
        $_SESSION["out"]=0;
        $_SESSION["buname"]=$uname;
        echo json_encode(array(
			'username' => $_SESSION["buname"],
			'password' => $password
		));

        // header("location:content.php");
    }
    else {
        echo json_encode(array(
            'errorMsg' => '帳號或密碼登入失敗'
        ));
    }
}

?>

