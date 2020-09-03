<?php
  session_start();

header("Content-type: text/html; charset=utf-8");
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );

$sql = <<<qlc
    select p_name,p_quantity,p_price,c.c_name,p_id,p_img from product p inner join category c on c.c_id=p.c_id
    qlc;
    $result = mysqli_query ( $link, $sql) or die("查詢失敗");


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

	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,700,800" rel="stylesheet">	 -->
	<link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<div class="top-menu">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-2">
						<div id="fh5co-logo"><a href="memanage.php">Beauty<span>.</span></a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<!-- <li class="active"><a href="memanage.php">Home</a></li> -->
							<!-- <li class="active"><a href="memanage.php">Home</a></li> -->
							<li><a href="memanage.php">會員管理</a></li>
							<li class="has-dropdown">
								<a href="#">商品管理</a>
									<ul class="dropdown">
										<li><a href="promanage.php">商品總覽</a></li>
										<li><a href="addproduct.php">增加商品</a></li>
									<!-- <li><a href="#">eCommerce</a></li>
									<li><a href="#">Branding</a></li>
									<li><a href="#">API</a></li> -->
								</ul>
							</li>
							<li class="has-dropdown"><span><a href="#"><?= $user ?></span></a>
							<ul class="dropdown">
									<!-- <li><a href="manager.php">會員管理</a></li>
									<li><a href="addproduct.php">商品管理</a></li> -->
									<li><a href="memanage.php?logout=1">Logout</a></li>
								</ul></li>
							<!-- <li><a href="promanage.php">商品管理</a></li> -->
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
					<h2>商品管理<h2>
					<!-- <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p> -->
				</div>
			</div>
			<div class="row">
				
				<?php while($row = mysqli_fetch_assoc( $result )):?>
				<form method="POST" action="memanage.php?p_id=<?=$row['p_id']?>">
				<div class="col-md-4 prod text-center animate-box">
					<div class="product" style="background-image: url('<?= $row['p_img']?>');">
					</div>
					<h3>商品名：<a href="#"><?= $row['p_name']?></a></h3>
					<span >商品價格：<?= $row["p_price"]?>元</span><br>
					<span >庫存量：<?= $row["p_quantity"]?></span><br>
					<span > 總類：<?= $row["c_name"]?></span><br>
                    <span><input type="button" value="修改" onclick="location.href='editproduct.php?p_id=<?=$row['p_id']?>'"></span>
					<span><input type="button" value="刪除" onclick="location.href='deleteproduct.php?p_id=<?=$row['p_id']?>'"></span>
					<!-- <span ><input type="button" value="結帳" onclick="location.href='buy.php'"></span> -->
				</div>
				</form>
				<?php endwhile ?>
			</div>
		</div>
	</div>

	<!-- <footer id="fh5co-footer" role="contentinfo">
		<div class="container">
			<div class="row row-pb-md">
				<div class="col-md-4 fh5co-widget">
					<h4>Ink's</h4>
					<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
				</div>
				<div class="col-md-4 col-md-push-1">
					<h4>Links</h4>
					<ul class="fh5co-footer-links">
						<li><a href="#">Home</a></li>
						<li><a href="#">Practice Areas</a></li>
						<li><a href="#">Won Cases</a></li>
						<li><a href="#">Blog</a></li>
						<li><a href="#">About us</a></li>
					</ul>
				</div>

				<div class="col-md-4 col-md-push-1">
					<h4>Contact Information</h4>
					<ul class="fh5co-footer-links">
						<li>198 West 21th Street, <br> Suite 721 New York NY 10016</li>
						<li><a href="tel://1234567920">+ 1235 2355 98</a></li>
						<li><a href="mailto:info@yoursite.com">info@yoursite.com</a></li>
						<li><a href="http://gettemplates.co">gettemplates.co</a></li>
					</ul>
				</div>

			</div>

			<div class="row copyright">
				<div class="col-md-12 text-center">
					<p>
						<small class="block">&copy; 2016 Free HTML5. All Rights Reserved.</small> 
						<small class="block">Designed by <a href="http://freehtml5.co/" target="_blank">FreeHTML5.co</a> Demo Images: <a href="http://unsplash.co/" target="_blank">Unsplash</a></small>
					</p>
					<p>
						<ul class="fh5co-social-icons">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
					</p>
				</div>
			</div>

		</div>
	</footer> -->
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.flexslider-min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>







