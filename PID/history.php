<?php
  session_start();



header("Content-type: text/html; charset=utf-8");
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );

$m_id=$_GET["m_id"];

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

$sql = <<<qlcq
	select *,(d_quantity*p.p_price) as total_price from dreamlist d inner join product p on d.p_id=p.p_id  where (buy=true && m_id=$m_id);
	qlcq;
$result = mysqli_query ( $link, $sql) or die("查詢失敗");
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
							<li class="has-dropdown"><span><a href="#"><?= $manage ?></span></a>
							<ul class="dropdown">
									<li><a href="memanage.php?logout=1">Logout</a></li>
								</ul></li>
							
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
					<h2>購買紀錄</h2>
				</div>
			</div>
			<div class="row">
			<?php while($row = mysqli_fetch_assoc( $result )):?>
				<div class="member">
					<div class="col-md-6 nopadding animate-box">
						<div class="author" style="background-image: url(<?= $row['p_img']?>);"></div>
					</div>
					<div class="col-md-6 nopadding animate-box">
						<div class="desc">
							<h3><?=$row['p_name']?></h3>
							<hr/>
							<p>購買時間：<?=$row['date']?></p>
							<p>訂單編號：<?=$row['d_number']?></p>
							<p>數量：<?=$row['d_quantity']?>件</p>
							<p>單價：<?=$row['p_price']?>元</p>
							<p>總價：<?=$row['total_price']?>元</p>
						</div>
					</div>
				</div>
				<?php endwhile ?>
			</div>
		</div>
	</div>
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
	
	<script>
	
	$("#edit").click(function () {
		alert("OK");
		// var iIndex = $(this).closest("p").index();
		// alert(iIndex);
		// header("location:edit.php")
        // currentIndex = -1;
        // $("#titleTextBox").val("");
        // $("#ymdTextBox").val("");
        $("#newsModal").modal( { backdrop: "static" } );
	})
	
	// $("#okButton").click(function){

	// }


	</script>



	</body>
</html>

