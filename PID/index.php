<?php
  session_start();

header("Content-type: text/html; charset=utf-8");
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );

$c_id=$_GET["c_id"];
if(isset($c_id)){
	$sql = <<<qlc
    select * from product where (c_id=$c_id && p_quantity>0) order by p_id desc
    qlc;
	$result = mysqli_query ( $link, $sql) or die("查詢失敗4");
}
else{
$sql = <<<qlc
    select * from product where p_quantity>0 order by p_id desc
    qlc;
	$result = mysqli_query ( $link, $sql) or die("查詢失敗5");
}


  if(isset($_SESSION["userName"])){
  $user=$_SESSION["userName"];
}
  else{
  $user="Guest";
}
if (isset($_GET["logout"]))
{
	unset($_SESSION["userName"]);
	header("Location: index.php");
	exit();
}

$p_id=$_GET["p_id"];
$dquantity = $_POST["dquantity"];
	// echo $p_id;
	// echo $dquantity;

	$sql2 = <<<qlcw
		select * from product where p_id = "$p_id" 
		qlcw;
		$result2 = mysqli_query ( $link, $sql2) or die("查詢失敗1");
		$row = mysqli_fetch_assoc( $result2 );
		$cid=$row['c_id'];
		if(isset($dquantity)){
			if($dquantity>$row["p_quantity"]){
				echo "<script>alert('超過庫存量，請重新輸入'); location.href = 'index.php?c_id=$cid';</script>";
				//header("location: index.php?c_id=$cid");
			}
		else{
			$sql3 = <<<qlcw
				select m_id from member where m_username='$user'
			qlcw;
			$result3 = mysqli_query ( $link, $sql3) or die("查詢失敗2");
			$row3 = mysqli_fetch_assoc( $result3 );
			$fin=$row3['m_id'];
			//echo $fin;

			$sql4 = <<<qlcw
				insert into dreamlist(d_quantity,p_id,m_id,buy,date) values($dquantity,$p_id,$fin,false,CURRENT_TIMESTAMP) 
			qlcw;
			$result4 = mysqli_query ( $link, $sql4) or die("存取失敗3");

			echo "<script>alert('加入購物車'); location.href = 'index.php?c_id=$cid';</script>";
		}
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Beauty &mdash; Happy Shopping</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="freehtml5.co" />

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
	
	<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<div class="top-menu">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-2">
						<div id="fh5co-logo"><a href="index.php">Beauty<span>.</span></a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<!-- <li class="active"><a href="index.php">Home</a></li> -->
							<!-- <li><a href="index.php">產品</a></li> -->
							<li class="has-dropdown">
								<a href="index.php">產品</a>
								<ul class="dropdown">
									<li><a href="index.php?c_id=1">上衣</a></li>
									<li><a href="index.php?c_id=2">裙子</a></li>
									<li><a href="index.php?c_id=3">褲子</a></li>
									<!-- <li><a href="#">API</a></li> -->
								</ul>
							</li>
							<!-- <li><a href="about.php">About</a></li> -->
							<?php if($user=="Guest" || $user=="kl123"){ ?>
							<li class="btn-cta"><a href="Login.php"><span>Login</span></a></li>
							<?php } else{ ?>
							<li class="has-dropdown"><a href="#"><span><?= $user ?></span></a>
							<ul class="dropdown">
									<li><a href="shopcar.php">購物車</a></li>
									<li><a href="finbuy.php">購買歷史紀錄</a></li>
									<!-- <li><a href="#">會員資料</a></li> -->
									<li><a href="index.php?logout=1">Logout</a></li>
								</ul></li>
							<?php }?>
						</ul>
					</div>
				</div>
				
				
			</div>
		</div>
	</nav>

	
	<div id="fh5co-product">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<?php if($c_id==1){ ?>
					<h2>上衣</h2>
					<?php }else if($c_id==2){ ?>
					<h2>裙子</h2>
					<?php }else if($c_id==3){ ?>
					<h2>褲子</h2>
					<?php }else{ ?>
					<h2>商品總覽</h2>
					<?php }?>
					<!-- <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p> -->
				</div>
			</div>
			<div class="row">
				
				<?php while($row = mysqli_fetch_assoc( $result )):?>
				<form method="POST" action="index.php?p_id=<?=$row['p_id']?>">
				<div class="col-md-4 prod text-center animate-box">
					<div class="product" style="background-image: url('<?= $row['p_img']?>');">
					</div>
					<h3><a href="#"><?= $row['p_name']?></a></h3>
					<span ><?= $row["p_price"]?>元</span><br>
					<span >庫存量：<?= $row["p_quantity"]?></span><br>
					<span > 種類：<?= $row["c_name"]?></span><br>
					<?php if($user!="Guest" && $user!="kl123"){ ?>
					<span >數量：<input type="text" name="dquantity" id="dquantity" required="required" style="width: 75px;"></span>
					<span ><input type="submit" name="submit" id="submit" value="加入購物車" style="width: 100px;"></span>
					<?php } ?>
					<!-- <span ><input type="button" value="結帳" onclick="location.href='buy.php'"></span> -->
				</div>
				</form>
				<?php endwhile ?>
			</div>
		</div>
	</div>

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>

