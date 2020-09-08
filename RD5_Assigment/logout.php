<?php
    session_start();
    unset($_SESSION["buname"]);
    // if(isset($_SESSION["buname"]))
    // echo "ok";
    // else
    // echo "empty";
    header('Location: index.html'); 
	exit();

?>