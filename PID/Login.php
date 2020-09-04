<?php
session_start();
header("Content-type: text/html; charset=utf-8");
require ("config.php");

$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );

$username = $_POST["username"];
$password = hash('sha256', $_POST["password"]);
$cou=0;
$au=0;
//echo($password);
$sql = <<<qlc
    select * from member where m_username = "$username" and m_passwd="$password"
    qlc;
    $result = mysqli_query ( $link, $sql) or die("查詢失敗");
    $row = mysqli_fetch_assoc( $result );
    //var_dump($row);
    if($row){
        
        $_SESSION["userName"]=$username;
        if($_SESSION["userName"]=="kl123"){
        header("location:promanage.php");
        }
        else if($row['canuse']==true ){
        header("location:index.php");
        }
        else{
            $au=1;
            echo "<script>alert('權限已停用'); </script>";
        }
    }
    else {
        $cou++;
    }
    if($cou>1)
    {
        echo "<script>alert('帳號或密碼登入失敗');</script>";
    }

?>

<!DOCTYPE html>
<html lang="en" class="no-js"> 
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/form.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
    </head>
    <body>
        <div class="container">
            <div class="codrops-top">
                <div class="clr"></div>
            </div>
            <section>				
                <div id="container_demo" >
                    <!-- <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a> -->
                    <div id="wrapper">
                        <div id="login">
                            <form  method="POST" action="" autocomplete="on"> 
                                <h1>Log in</h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > Your username </label>
                                    <input id="username" name="username" required="required" type="text"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                    <input id="password" name="password" required="required" type="password" /> 
                                </p>
                                <p class="login button"> 
                                    <input type="submit" value="Login" /> 
								</p>
                                <p class="change_link">
									Not a member yet ?
									<a href="Registered.php" class="to_register">Join us</a>
								</p>
                            </form>
                        </div>
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>