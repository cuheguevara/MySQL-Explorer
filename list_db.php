<?php
	if (empty($_COOKIE["server"])){
		header("location:index.php?err=log");
	}
	$db = $_REQUEST["db"];
	include "globalNav.php";
	
	_header();

	print("<tr>");
	print("<td background=\"images/home02012008f.gif\" width=130 height=442 valign=\"top\">");
		print("<strong><a href=\"home.php\" style=\"color:#000066\">HOME</strong><br>");
		print("<strong><a href=\"index.php\" style=\"color:#FF0000\">LOG OUT </a></strong>");
		
	print("<hr>");

		if($cn=mysql_connect($_COOKIE["server"],$_COOKIE["user"],$_COOKIE["password"])){
		  	@mysql_select_db($dbs,$cn);
			@mysql_close($cn);
				echo "<strong>".$db."</strong>"; 	
		}else{
			header("location:index.php?err=log");
		}

	print("<hr>");
	print("<div style=\"position:absolute;overflow:scroll;height:350;width:140;\">");

		$cn=mysql_connect($_COOKIE["server"],$_COOKIE["user"],$_COOKIE["password"]);
		mysql_query("use ".$db);
		$qry=mysql_query("show tables") or die(mysql_error());
		while($row=mysql_fetch_array($qry)){
			echo "<a href=\"list_field.php?db=$db&pop=$row[0]\">$row[0]</a><br>";
		}
		mysql_close($cn);

	print("</div>");		
	print("</td>");
	print("<td><img src=\"images/home02012008g.gif\" width=29 height=442 alt=\"\"></td>");
	print("<td background=\"images/home02012008h.gif\" width=693 height=442 valign=\"top\" align=\"center\">");
			//ISI
	print("</td>");
	print("</tr>");
	_footer();
?>