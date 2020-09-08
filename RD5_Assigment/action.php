<?php
  session_start();

header('Content-Type: application/json; charset=utf8');
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );

if(isset($_SESSION["buname"])){
	$u=$_SESSION["buname"];

}
else{
	header('Location: index.html');
}


$action = $_POST["action"];
$money = $_POST["money"];


 if(isset($money)){
	$sql="select m_id,total_money from member where m_username='$u'";
	$result=mysqli_query($link,$sql)or die ("1");
	$row=mysqli_fetch_assoc($result);
	$_SESSION['mid']=$row['m_id'];
	$mid=$_SESSION['mid'];
	$total1=$row['total_money'];
		
		if($action=='提款' &&  $total1<$money){
			echo json_encode(array(
				'errorMsg' => '您帳戶裡的額度不足，請確認餘額'
			));
		}
		else if($action!=null && $money!=null){
			
			$a=rand(1,99999999);
			if($action=='提款'){
				$sql3="update member set total_money=($total1-$money) where m_id=$mid";
				$result3=mysqli_query($link,$sql3)or die ("3");
				$sql4="insert into list(m_id,date,action,m_cash,over,t_number) values($mid,CURRENT_TIMESTAMP,'$action',$money,$total1-$money,$a)";
				$result4=mysqli_query($link,$sql4)or die ("4");
			}
			else if($action=='存款'){
				$sql3="update member set total_money=($total1+$money) where m_id=$mid";
				$result3=mysqli_query($link,$sql3)or die ("3");
				$sql4="insert into list(m_id,date,action,m_cash,over,t_number) values($mid,CURRENT_TIMESTAMP,'$action',$money,$total1+$money,$a)";
				$result4=mysqli_query($link,$sql4)or die ("4");
			}

			echo json_encode(array(
				'action' => $action,
				'money' => $money
			));
		}
		
 }
?>
