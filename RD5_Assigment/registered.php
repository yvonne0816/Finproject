<?php
header("Content-type: text/html; charset=utf-8");
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );


$name = $_POST["name"];
$uname = $_POST["username"];
//$passwd =  hash("sha256",$_POST["password"]);
$passwd = hash('sha256', $_POST["password"]);



if(isset($uname)){
$commandText = <<<SqlQuery
insert into member(m_name, m_username, m_passwd) VALUES ('$name', '$uname', '$passwd')
SqlQuery;

$result = mysqli_query ( $link, $commandText );
echo "<script>alert('註冊成功'); location.href = 'index.php';</script>";
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
	
	<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<div class="top-menu">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-2">
						<div id="fh5co-logo"><a href="index.php">Bank<span>.</span></a></div>
					</div>
				</div>
				
				
			</div>
		</div>
	</nav>
	
	<div id="fh5co-product">
		<div class="container">
			<div class="row">
				
				<div class="prod  animate-box">
				<form id="form1" name="form1" method="post" action="registered.php" onsubmit="return check()">
				<p>姓名:<input type="text" name="name" id="name" required="required"></p>
				<p>帳號:<input type="text" name="username" id="username" placeholder="只能包含數字或英文" required="required"></p>
				<p>密碼: <input type="password" name="password" id="password" pattern="\w{8,12}" placeholder="請輸入8~12個數字或英文" required="required"><label onclick="show_pwd1()">  <input type="checkbox"> 顯示密碼</label></p>
				<p>確認密碼: <input type="password" name="chpassword" id="chpassword" pattern="\w{8,12}" placeholder="請再輸入一次密碼" required="required"><label onclick="show_pwd2()">  <input type="checkbox"> 顯示密碼</label></p>

				<p><input type="submit" name="submit" id="submit" value="註冊"></p>
					<!-- <span ><input type="button" value="結帳" onclick="location.href='buy.php'"></span> -->
				</div>
				</form>
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
        //alert(pwd.value);
		if (pwd.type == "password") {
			pwd.type = "text";
		}else {
			pwd.type = "password";
		}
	}


    function show_pwd2(){
        var pwd = document.getElementById("chpassword");
        //alert(pwd.value);
		if (pwd.type == "password") {
			pwd.type = "text";
		}else {
			pwd.type = "password";
		}
	}

   
</script>


	</body>
</html>

