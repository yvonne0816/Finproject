<?php
header('Content-Type: application/json; charset=UTF-8');
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );


$name = $_POST["name"];
$uname = $_POST["username"];
$passwd = hash('sha256', $_POST["password"]);



if(isset($uname)){
	$commandText = <<<SqlQuery
	select m_username from member
	SqlQuery;
	$a=0;
	$result = mysqli_query ( $link, $commandText);
	while($row = mysqli_fetch_assoc( $result)){
		if($uname==$row['m_username']){
			$a++;
			echo json_encode(array(
				'errorMsg' => '帳號已被註冊'
			));
		break;
		}
	}
	if($name !=null &&  $uname!=null && $passwd!=null && $a==0){
		$commandText2 = <<<SqlQuery
		insert into member(m_name, m_username, m_passwd) VALUES ('$name', '$uname', '$passwd')
		SqlQuery;

		$result2 = mysqli_query ( $link, $commandText2 );
		echo json_encode(array(
			'name' => $name,
			'username' => $uname,
			'password' => $passwd
		));
	}
//header("Refresh:3;URL=index.php");
}
?>

