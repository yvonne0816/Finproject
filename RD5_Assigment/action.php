<?php
  session_start();

header("Content-type: text/html; charset=utf-8");
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );

  $u=$_SESSION["buname"];
if (isset($_GET["logout"]))
{
	unset($_SESSION["buname"]);
	header("Location: index.php");
	exit();
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
	//echo $mid;
	if($action=='提款' &&  $total1<$money){
		echo "<script>alert('您帳戶裡的額度不足，請確認餘額'); location.href = 'content.php';</script>";
	}
	else{
		$a=rand(1,99999999);
		if($action=='提款'){
			$sql3="update member set total_money=($total1-$money) where m_id=$mid";
			$result3=mysqli_query($link,$sql3)or die ("3");
			$sql4="insert into list(m_id,date,action,m_cash,over,t_number) values($mid,CURRENT_TIMESTAMP,'$action',$money,$total1-$money,$a)";
			$result4=mysqli_query($link,$sql4)or die ("4");
			echo "<script>alert('交易成功'); location.href = 'content.php';</script>";
		}
		if($action=='存款'){
			$sql3="update member set total_money=($total1+$money) where m_id=$mid";
			$result3=mysqli_query($link,$sql3)or die ("3");
			$sql4="insert into list(m_id,date,action,m_cash,over,t_number) values($mid,CURRENT_TIMESTAMP,'$action',$money,$total1+$money,$a)";
			$result4=mysqli_query($link,$sql4)or die ("4");
			echo "<script>alert('交易成功'); location.href = 'content.php';</script>";
		}
	}
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
	
	<nav class="fh5co-nav" role="navigation">
		<div class="top-menu">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-2">
						<div id="fh5co-logo"><a href="content.php">Bank<span>.</span></a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<!-- <li class="active"><a href="index.php">Home</a></li> -->
							<!-- <li><a href="index.php">產品</a></li> -->
							<li class="has-dropdown">
								<a href="#">服務項目</a>
								<ul class="dropdown">
									<li><a href="action.php">存款／提款</a></li>
									<li><a href="search.php?id=3">查詢餘額明細</a></li>
									<!-- <li><a href="#">API</a></li> -->
								</ul>
							</li>
							<!-- <li><a href="about.php">About</a></li> -->
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

	<!-- <aside id="fh5co-hero" class="js-fullheight">
		<div class="flexslider js-fullheight">
			<ul class="slides">
		   	<li class="holder" style="background-image: url(images/img_bg_1.jpg);">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
		   				<div class="slider-text-inner desc">
		   					<h2 class="heading-section">Product</h2>
		   					<p class="fh5co-lead">Designed with <i class="icon-heart3"></i> by the fine folks at <a href="http://freehtml5.co" target="_blank">FreeHTML5.co</a></p>
		   				</div>
		   			</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside> -->
	
	<div id="fh5co-product">
		<div class="container">
			<div class="row">
				<form id="form1" name="form1" method="post" action="action.php" onsubmit="return check()">
					<div class="col-md-12 prod text-center animate-box">
						
						<h3><a href="#">存款/提款</a></h3><br>
						<span>
							<p>選擇項目:
								<input type="radio" required="required" id="deposit" name="action" value="存款" checked >
					  				<label for="deposit">存款</label>
					 			<input type="radio" required="required" id="withdrawal" name="action" value="提款" checked>
					  				<label for="提款">提款</label>
							</p>
						</span>
						<span >金額：<input type="text" name="money" id="money" pattern="\d{4,5}" placeholder="台幣金額" required="required"></span>
						<p><p>
						<span ><input type="submit" name="submit" id="submit" value="確定" ></span>
						<!-- <span ><input type="button" value="結帳" onclick="location.href='buy.php'"></span> -->
					</div>
				</form>
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

	<script type="text/javascript">
    function check(){
        var money = document.getElementById("money");

       if(money.value >30000 || money.value <1000){
            window.alert("金額大於30000或小於1000");
            document.getElementById("money").focus();
            return false;
        }
    }
   
</script>
	

	</body>
</html>

