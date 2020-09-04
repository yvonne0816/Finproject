<?php
  session_start();

header("Content-type: text/html; charset=utf-8");
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );

$m_id=$_GET["m_id"];
//echo $p_id;

$sql = <<<qlc
    select * from member where m_id=$m_id;
qlc;
$result = mysqli_query ( $link, $sql) or die("查詢失敗");
$row = mysqli_fetch_assoc( $result );

$mname =$_POST["name"];
$memail =$_POST["email"];
$mphone =$_POST["phone"];
$maddress = $_POST["address"];

if(isset($maddress)){
$sql2=<<<SqlQuery
	select m_email from member where m_id!=$m_id;
SqlQuery;
$a=0;
$result2=mysqli_query($link,$sql2);
while($row2=mysqli_fetch_assoc($result2)){
	if($memail==$row2['m_email']){
		$error2="!信箱已被註冊!";
		$a++;
	}
}

if($a==0){
	$sql2 = <<<qlc
		update member set m_name='$mname',m_email='$memail',m_phone='$mphone',m_address='$maddress' where m_id=$m_id;
	qlc;
	$result2 = mysqli_query ( $link, $sql2) or die("查詢失敗2");
	echo "<script>alert('更新成功'); location.href = 'memanage.php';</script>";
}
}
	

if(isset($_SESSION["userName"])){
	$manage=$_SESSION["userName"];
}
else{
	$manage="Guest";
}
if (isset($_GET["logout"]))
{
	unset($manage);
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
						<div id="fh5co-logo"><a href="memanage.php">Beauty<span>.</span></a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>

							<li><a href="memanage.php">會員管理</a></li>
							<li class="has-dropdown">
								<a href="#">商品管理</a>
									<ul class="dropdown">
										<li><a href="promanage.php">商品總覽</a></li>
										<li><a href="addproduct.php">增加商品</a></li>

								</ul>
							</li>
							<li class="has-dropdown"><span><a href="#"><?= $user ?></span></a>
							<ul class="dropdown">

									<li><a href="memanage.php?logout=1">Logout</a></li>
								</ul></li>

							
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
					<h2>會員更新</h2>
				</div>
			</div>
			<div class="row">
			<div class="col-md-4 prod   center animate-box">
			</div>
				<form id="form3" name="form3" method="post" action="#" enctype="multipart/form-data">
				<div class="col-md-4 prod   center animate-box">
				<p>使用者名字:<input type="text" name="name" id="name" value="<?= $row['m_name']?>" required="required"></p>
				<p>Email:<input type="text" name="email" id="email" value="<?= $row['m_email']?>" required="required" pattern="\w+([.-]\w+)*@\w+(.\w+)+"></p>
				<?php if($a==1){?>
				<p style="color:red;"><?=$error2?></p>
				<?php }?>
				<p>行動電話:<input type="text" name="phone" id="phone" value="<?= $row['m_phone']?>" required="required" pattern="09\d{8}" placeholder="請輸入電話(如：09XXXXXXXX)"></p>
                <p>地址:<input type="text" name="address" required="required" id="address" value="<?= $row['m_address']?>"></p>
				<p><input type="submit" name="submit" id="submit" value="送出"></p>
				</div>
				</form>
				<div class="col-md-4 prod   center animate-box">
			</div>
				
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

