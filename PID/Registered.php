<?php
header("Content-type: text/html; charset=utf-8");
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );


$name = $_POST["name"];
$username = $_POST["username"];
//$passwd =  hash("sha256",$_POST["password"]);
$passwd = hash('sha256', $_POST["password"]);
$sex = $_POST["sex"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$address = $_POST["address"];


if(isset($username)){
$commandText = <<<SqlQuery
insert into member(m_name, m_username, m_passwd, m_sex, m_email, m_phone, m_address) VALUES 
('$name', '$username', '$passwd', '$sex', '$email', '$phone', '$address')
SqlQuery;

$result = mysqli_query ( $link, $commandText );
echo "<script>alert('註冊成功'); location.href = 'login.php';</script>";
//header("Location: login.php");
//$row = mysqli_fetch_assoc ( $result );
//mysqli_close($link);
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
				</div>
				
				
			</div>
		</div>
	</nav>
	
	<div id="fh5co-product">
		<div class="container">
		<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>註冊<h2>
					<!-- <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p> -->
				</div>
			</div>
			<div class="row">
				<form method="POST" action="Registered.php">
				<div class="col-md-6 prod animate-box">
				<form id="form1" name="form1" method="post" action="Registered.php" onsubmit="return check()">
				<p>姓名:<input type="text" name="name" id="name" required="required"></p>
				<p>帳號:<input type="text" name="username" id="username" placeholder="只能包含數字或英文" required="required"></p>
				<p>密碼: <input type="password" name="password" id="password" pattern="\w{8,12}" placeholder="請輸入8~12個數字或英文" required="required"><label onclick="show_pwd1()">  <input type="checkbox"> 顯示密碼</label></p>
				<p>確認密碼: <input type="password" name="chpassword" id="chpassword" pattern="\w{8,12}" placeholder="請再輸入一次密碼" required="required"><label onclick="show_pwd2()">  <input type="checkbox"> 顯示密碼</label></p>
				</div>
				<div class="col-md-6 prod animate-box">
				<p>性別:<input type="radio" required="required" id="male" name="sex" value="男" checked >
				  <label for="male">男</label>
				  <input type="radio" required="required" id="female" name="sex" value="女" checked>
				  <label for="female">女</label>
				</p>
				<p>E-mail: <input type="text" name="email" id="email" required="required" pattern="\w+([.-]\w+)*@\w+(.\w+)+"></p>
				<p>行動電話: <input type="text" name="phone" id="phone" required="required" pattern="09\d{8}" placeholder="請輸入電話(如：09XXXXXXXX)"></p>
				<p>地址:<input type="text" name="address" required="required" id="address"></p>

					<!-- <span ><input type="button" value="結帳" onclick="location.href='buy.php'"></span> -->
				</div>
				<p><input type="submit" name="submit" id="submit" value="註冊"></p>
				</form>
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
	
	<script type="text/javascript">
    function check(){
        var pwd1 = document.getElementById("password");
        var pwd2 = document.getElementById("chpassword");
       if(pwd1.value != pwd2.value){
            window.alert("兩次密碼並不相同！");
            document.getElementById("password").focus();
            return false;
        }
    }

	function show_pwd1(){
        var pwd = document.getElementById("password");
		if (pwd.type == "password") {
			pwd.type = "text";
		}else {
			pwd.type = "password";
		}
	}


    function show_pwd2(){
        var pwd = document.getElementById("chpassword");
		if (pwd.type == "password") {
			pwd.type = "text";
		}else {
			pwd.type = "password";
		}
	}

   
</script>


	</body>
</html>

