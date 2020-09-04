<?php
  session_start();



header("Content-type: text/html; charset=utf-8");
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );

$did=$_GET['d_id'];

  if(isset($_SESSION["userName"])){
  $user=$_SESSION["userName"];
  $sql=<<<hiu
	select canuse from member where m_username=$user
hiu;
	$row=(mysqli_fetch_assoc(mysqli_query($link,$sql)));
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


$sql3 = <<<qlcw
				select m_id from member where m_username='$user'
			qlcw;
			$result3 = mysqli_query ( $link, $sql3) or die("查詢失敗1");
			$row3 = mysqli_fetch_assoc( $result3 );
			$fin=$row3['m_id'];

$sql = <<<qlcq
	select p.p_name,d_quantity,p.p_price,d_id,p_img,(d_quantity*p.p_price) as total_price from dreamlist d inner join product p on d.p_id=p.p_id where (buy=false && m_id=$fin) order by d_id desc;
	qlcq;
$result = mysqli_query ( $link, $sql) or die("查詢失敗2");

$upq=$_POST["updateq"];
if(isset($upq)){
	$sql4 = <<<qlcq
		select * from product where p_id in (select p_id from dreamlist where d_id=$did)
		qlcq;
	$result4 = mysqli_query ( $link, $sql4) or die("查詢失敗3");
	$row4 = mysqli_fetch_assoc($result4);
	$q=$row4['p_quantity'];
// echo $upq;
// echo $did;
if($q>=$upq){
	$sql2=<<<qlcq
	update dreamlist set  d_quantity=$upq where d_id=$did
	qlcq;
	$result2 = mysqli_query ( $link, $sql2) or die("更新失敗");
	echo "<script>alert('更新成功'); location.href = 'shopcar.php';</script>";
}
else{
	echo "<script>alert('庫存量為 $q 件，超過庫存量，請重新輸入'); location.href = 'shopcar.php';</script>";
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
	<script type="text/javascript" src="jquery.min.js"></script>
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
							<li class="has-dropdown">
								<a href="index.php">產品</a>
								<ul class="dropdown">
									<li><a href="index.php?c_id=1">上衣</a></li>
									<li><a href="index.php?c_id=2">裙子</a></li>
									<li><a href="index.php?c_id=3">褲子</a></li>
									<!-- <li><a href="#">API</a></li> -->
								</ul>
							</li>
							<?php if($user=="Guest"){ ?>
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


	<div id="fh5co-about">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>購物車清單</h2>
					<!-- <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p> -->
				</div>
			</div>
			<div class="row">
			<?php while($row = mysqli_fetch_assoc( $result )):?>
				<div class="member">
					<div class="col-md-6 nopadding animate-box">
						<div class="author" style="background-image: url('<?= $row['p_img']?>');"></div>
					</div>
					<div class="col-md-6 nopadding animate-box">
						<div class="desc">
							<h3><?=$row['p_name']?></h3>
							<hr/>
							<p>單價：<?=$row['p_price']?>元</p>
							<p>數量：<?=$row['d_quantity']?>件 <form method="POST" action="shopcar.php?d_id=<?= $row['d_id']?>"><p class="test">數量：<input type="text" name="updateq" pattern="\d{1,5}" style="width:50px;"> <input type="submit" name="submit" id="submit" value="更新"></p></form></p>
							<p>總價：<?=$row['total_price']?>元</p>
							<p>
								<ul class="fh5co-social-icons">
									<li><input type="button" value="修改" class="edit"></li>
									<li><input type="button" value="刪除" onclick="location.href='action.php?d_id=<?=$row['d_id']?> && id=1'"></li>
									<li><input type="button" value="結帳" onclick="location.href='action.php?d_id=<?=$row['d_id']?> && id=2'"></li>
								</ul>
							</p>
						</div>
					</div>
				</div>
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
	
	<script>
	
	$(document).ready(function(){
		$(".test").hide();
		$('.edit').click(function() { 
			$(this).closest('.desc').find('.test').toggle();
			// 	function(){$("#content").hide();},
			// 	function(){$("#content").show();}
			// );
		});


	// 	$(".test").hide();
    //   $(".edit").click(function(){
    //     $(".test").toggle();
    //   })
    });

	</script>



	</body>
</html>

