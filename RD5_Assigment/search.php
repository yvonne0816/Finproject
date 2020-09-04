<?php
  session_start();

header("Content-type: text/html; charset=utf-8");
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );

$id=$_GET["id"];

$u=$_SESSION["buname"];

if (isset($_GET["logout"]))
{
	unset($_SESSION["buname"]);
	header("Location: index.php");
	exit();
}

$sql2="select total_money,m_id from member where m_username='$u'";
$result2=mysqli_query($link,$sql2)or die ("2");
$row2=mysqli_fetch_assoc($result2);
$tot=$row2['total_money'];
$m=$row2['m_id'];

if($id==1){
	$sql="select * from list where action='提款' && m_id=$m order by date desc";
	$result=mysqli_query($link,$sql)or die ("1");
}
if($id==2){
	$sql="select * from list where action='存款' && m_id=$m order by date desc";
	$result=mysqli_query($link,$sql)or die ("1");
}
if($id==3){
	$sql="select * from list where m_id=$m order by date desc";
	$result=mysqli_query($link,$sql)or die ("1");
}

?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Bank &mdash; Welcome</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="freehtml5.co" />

	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">

	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/flexslider.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/modernizr-2.6.2.min.js"></script>

	</head>
	<body>
		
	<div class="fh5co-loader"></div>
	
	<nav class="fh5co-nav" role="navigation">
		<div class="top-menu">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-2">
						<div id="fh5co-logo"><a href="content.php">Bank<span>.</span></a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li class="has-dropdown">
								<a href="#">服務項目</a>
								<ul class="dropdown">
									<li><a href="action.php">存款／提款</a></li>
									<li><a href="search.php?id=3">查詢餘額明細</a></li>
								</ul>
							</li>
							<?php if($u!="Guest"){?>
							<li class="has-dropdown"><a href="#"><span><?= $u?></span></a>
							<ul class="dropdown">
									<li><a href="index.php?logout=1">Logout</a></li>
							</ul></li>
							<?php }else{ 
								header("location:login.php");
							}?>	
						</ul>
					</div>
				</div>
				
				
			</div>
		</div>
	</nav>

	
	<div id="fh5co-about">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h3>總餘額 <h3 id=show onclick="show_money()">NT.*****元<h3><h3>
					<!-- <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p> -->
				</div>
			</div>
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
				<input type="button" name="button1" id="button1" value="提款明細" onclick="location.href='search.php?id=1'" style="width: 100px;" >
				<input type="button" name="button1" id="button1" value="存款明細" onclick="location.href='search.php?id=2'" style="width: 100px;" >
				<input type="button" name="button1" id="button1" value="全部明細" onclick="location.href='search.php?id=3'" style="width: 100px;" >
				</div>
			</div>
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<?php if($id==1){?>
					<h3>提款明細<h3>
					<?php } ?> 
					<?php if($id==2){?>
					<h3>存款明細<h3>
					<?php } ?> 
					<?php if($id==3){?>
					<h3>全部明細<h3>
					<?php } ?> 
				</div>
			</div>
				<div class="row">
					<div class="member">
						<?php while($row = mysqli_fetch_assoc( $result )){ 
							// $string=strval($row['over']);
							// $a=strlen($string);
							// for($i=1;$i<$a;$i++){
							// 	$string=substr_replace($string,"*",$i);
							// }									
							?>
							<div class="col-md-4 nopadding animate-box">
								<div class="desc">
									<h3>交易編號：<?=$row['t_number']?></h3>
									<hr/>
									<?php if($id==3){?>
									<p>交易類別：<?=$row['action']?></p>
									<?php } ?>
									<p></p>
									<p>日期：<?=$row['date']?></p>
									<p>交易金額：<?=$row['m_cash']?>元</p>
									<p>帳戶餘額：<?=$row['over']?>元</p>
								</div>
							</div>
						<?php }?>
					</div>
				</div>
		</div>
	</div>


	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.flexslider-min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<script src="js/main.js"></script>

	</body>
	<script>
		function show_money(){
        var mon = document.getElementById("show");
        //alert(pwd.value);
		if (mon.innerHTML == 'NT.<?=$tot?>元') {
			mon.innerHTML="NT.*****元";
		}
		else {
			mon.innerHTML = 'NT.<?=$tot?>元';
		}
	}
	</script>
</html>

