<?php 
	setcookie("server","");
	setcookie("user","");
	setcookie("password","");
?>
<html>
<head>
<title>mysqlExplorer</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="script/style.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor=#FFFFFF leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>
<!-- ImageReady Slices (mysqlExplorer.psd) -->
<table width=900 border=0 cellpadding=0 cellspacing=0 align="center">
	<tr>
		<td colspan=5>
			<img src="images/home02012008a.gif" width=900 height=14 alt=""></td>
	</tr>
	<tr>
		<td rowspan=3>
			<img src="images/home02012008b.gif" width=20 height=510 alt=""></td>
		<td colspan=3 background="images/home02012008c.gif" width=852 height=41 align="center" valign="middle" style="font-family:Arial, Helvetica, sans-serif ">
			<font size="3" face="Arial, Helvetica, sans-serif"><strong>MySQL - EXPLORER</strong></font><br>
			<a href="mailto:sickbytreason@yahoo.com">yohanamxs@gmail.com</a>
		</td>
		<td rowspan=4>
			<img src="images/home02012008d.gif" width=28 height=536 alt=""></td>
	</tr>
	<tr>
		<td colspan=3>
			<img src="images/home02012008e.gif" width=852 height=27 alt=""></td>
	</tr>
	<tr>
		<td background="images/home02012008f.gif" width=130 height=442 valign="top">
			<div style="overflow:scroll;width:130px; height:442px">
			<?php 
				echo "<b>Home Directory :</b><br>".$_SERVER['DOCUMENT_ROOT']."<br><br>";
				echo "<b>Host :</b><br>".$_SERVER['HTTP_HOST']."<br><br>";
				echo "<b>Home Directory :</b><br>".$_SERVER['HTTP_USER_AGENT']."<br><br>";
				echo "<b>Web Server :</b><br>".$_SERVER['SERVER_SOFTWARE']."<br><br>";
				echo "<b>Connection :</b><br>".$_SERVER['HTTP_CONNECTION']."<br><br>";
				echo "<b>Address</b><br>".$_SERVER['REMOTE_ADDR']."<br><br>";
				echo "<b>Port Used</b><br>".$_SERVER['SERVER_PORT']."<br><br>";
				echo "<b>Protocol</b><br>".$_SERVER['SERVER_PROTOCOL']."<br><br>";
				echo "<b>Gateway Int. face</b><br>".$_SERVER['GATEWAY_INTERFACE']."<br><br>";
			?>
			</div>
		</td>
		<td>
			<img src="images/home02012008g.gif" width=29 height=442 alt=""></td>
		<td background="images/home02012008h.gif" width=693 height=442 valign="middle" align="center">
			<form action="modul.php" method="post">
			<input type="hidden" name="mode" value="login">
			<table border="1" bordercolor="#666666" cellpadding="5" cellspacing="0">
				<tr>
					<td>
						<table width="100%"><tr><td colspan="3" valign="top" align="center"><strong>LOGIN</strong></td></tr></table>
					</td>
				</tr>
				<tr>
					<td>
						<table>
							<tr><td>Server</td><td>:</td><td><input type="text" name="server"></td></tr>
							<tr><td>User</td><td>:</td><td><input type="text" name="user"></td></tr>
							<tr><td>Password</td><td>:</td><td><input type="password" name="password"></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%">
							<tr>
								<td colspan="3" valign="top" align="center">
									<input type="submit" value="Submit">
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			</form>
			<?php
				if(isset($err)){
					print "<br><font color=red>Koneksi Gagal !!! : <br>".$ser."</font>";
				}
			?>
		</td>
	</tr>
	<tr>
		<td colspan=4>
			<img src="images/home02012008i.gif" width=872 height=26 alt=""></td>
	</tr>
</table>
<!-- End ImageReady Slices -->
</body>
</html>