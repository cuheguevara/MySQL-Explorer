<?php
	if (empty($_COOKIE["server"])){
		header("location:index.php?err=log&ser=".mysql_error());
	}
	include "globalNav.php";
	_header();

	print("<tr>");
	print("<td background=\"images/home02012008f.gif\" width=130 height=442 valign=\"top\">");
	print("<strong>SHOW DATABASES :</strong>");
	print("<hr>");
		 if($cn=mysql_connect($_COOKIE["server"],$_COOKIE["user"],$_COOKIE["password"])){
			 $db=@mysql_list_dbs ($cn);
			 while($data=@mysql_fetch_object($db)){
				echo "<a href=\"list_db.php?db=".$data->Database."\">".$data->Database."</a><br>";
			 } 
			@mysql_close($cn);
		}else{
			header("location:index.php?err=log&ser=".mysql_error());
		}
		print("</td>");
	_footer_home();
?>