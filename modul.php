<?php

	if(isset($_POST["mode"])){
		$mode=$_POST["mode"];
		if($mode=="login"){
			if(empty($_POST["user"])){
				header("location:index.php?err=log&ser=Unknown User");
			}else{
				//echo $HTTP_COOKIE_VARS["server"];
				if($cn=mysql_connect($_POST["server"],$_POST["user"],$_POST["password"])){
					setcookie("server",$_POST["server"]);
					setcookie("user",$_POST["user"]);
					setcookie("password",$_POST["password"]);
					header("location:home.php");
				}else{
					header("location:index.php?err=log&ser=".mysql_error());
				}
			}
		}
	}else{
		header("location:index.php");
	}
?>