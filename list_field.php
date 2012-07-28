<?php
	if (empty($_COOKIE["server"])){
		header("location:index.php?err=log");
	}
	$db = $_REQUEST["db"];
	$pop = $_REQUEST["pop"];
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
	print("<div style=\"position:absolute;overflow:scroll;height:300;width:140;\">");

		$cn=mysql_connect($_COOKIE["server"],$_COOKIE["user"],$_COOKIE["password"]);
		mysql_query("use ".$db);
		$qry=mysql_query("show tables") or die(mysql_error());
		while($row=mysql_fetch_array($qry)){
			echo "<a href=\"list_field.php?db=$db&pop=$row[0]\">$row[0]</a><br>";
		}
		mysql_close($cn);

	print("</div>");		
	print("</td>");
	print("<td>");
	print("<img src=\"images/home02012008g.gif\" width=29 height=442 alt=\"\"></td>");
	print("<td background=\"images/home02012008h.gif\" width=693 height=442 valign=\"top\" align=\"left\">");
	?>
	<div style="position:absolute;overflow:scroll;height:440; width:690; ">
	<?
			print("<h5>STRUCTURE FIELD (". $pop.")</h5>");
			$i=0;
			$cn=mysql_connect($_COOKIE["server"],$_COOKIE["user"],$_COOKIE["password"]);
			mysql_select_db("$db",$cn);
			$qry=mysql_query("describe $pop",$cn) or die (mysql_error());
	print("<table align=\"center\" width=\"600\">");
	print("<tr><td colspan=\"6\"><hr></td></tr>");
	print("<tr>
				<td><strong>FIELD NAME</strong></td>
				<td><strong>TYPE</strong></td>
				<td><strong>NULL</strong></td>
				<td><strong>PRIMARY KEY</strong></td>
				<td><strong>DEFAULT</strong></td>
				<td><strong>EXTRA</strong></td></tr>");
	print("<tr><td colspan=\"6\"><hr></td></tr>");		
			while($row=mysql_fetch_array($qry)){
			   echo "
			   <tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td></tr>
			   ";
			}
	print("<tr><td colspan=\"6\"><hr></td></tr>");
	print("</table>");
	
	//==============
	print("<h5>CONTENT (". $pop.")</h5>");
			$i=0;
			$cn=mysql_connect($_COOKIE["server"],$_COOKIE["user"],$_COOKIE["password"]);
			mysql_select_db("$db",$cn);
			
			$sql=mysql_query("select * from $pop") or die (mysql_error());
			$field=mysql_list_fields($db,$pop);
			$jum_field=mysql_num_fields($field);
				
	print("<table align=\"center\" width=\"600\" border=0>");
		//tampil nama field
		print("<tr><td colspan=$jum_field><hr></td></tr>");
		print("<tr>");
			for($i=0;$i< mysql_num_fields($sql);$i++){
				print("<td>");
				$nama = mysql_field_name($sql,$i);
				print("<strong>".$nama."</strong>");
				print("</td>");
			}
		print("</tr>");
		//"end of - "tampil nama field
	print("<tr><td colspan=\"$jum_field\"><hr></td></tr>");
		/*TAMPIL REKORD*/
		
			while($row=mysql_fetch_row($sql)){
				print("<tr>");
				for($x=0;$x<$jum_field;$x++){
					print("<td>". htmlentities($row[$x]) ."</td>");
				}
				print("</tr>");
			}
		/*TAMPIL REKORD*/
	print("<tr>");
	print("<td><strong>$data[0]</strong></td>");
	print("</tr>");

	print("<tr><td colspan=\"$jum_field\"><hr></td></tr>");
	
	print("</table></div>");

	//==============
	print("</td>");
	print("</tr>");
	_footer();
?>