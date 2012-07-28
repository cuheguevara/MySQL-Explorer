<?
	
	/*******************APLICATION CONFIG************************

	* AUTHOR	: Suhendra Yohana Putra
	* Copyright @ 2006 - Suhendra Yohana Putra
	* Company : The Last Majezty
	* Under Licensed By : Black Clairvoyant (Suhendra-2006)
	* Module Name : Common Function
	* Contact : 
			* (+62) 81809548105  ||  (+62) 85659152645 
			* sickbytreason@yahoo.com  || http://www.orangstupid.freetzi.com 				

	***********************************************************/
	
	
	//This file controls all the forum settings. As well provide the SQL to create the tables, other function that this Application uses.

	
		class dbconnect {

			//Edit the lines below to configure your application....

			var $DBhost="localhost";  //your internet address of the mySQL database your going to use.
			
			var $DBusername="root"; //your mysql User name of the mySQL database your going to use.
			
			var $DBpassword=""; //your mysql password of the mySQL database your going to use.
			
			var $DBname="tlm_guest"; //name of database
			
			
			/* TABLE PROPERTIES */
			var $AllowNull="NOT NULL";
			
			var $PrimaryKey="PRIMARY KEY";
			
			var $Varchar="VARCHAR";
			
		}
	
	$config=new dbconnect();
	
	setcookie("APPNAME","THE LAST SKIRMISH");
	
	setcookie("TAGLINE","think different !!!!");
	
	setcookie("DATE",getDAY());
	
	setcookie("LICENSE","Copyright &copy; 2007 - Suhendra Yohana Putra");
	
	$db=$config->DBname;
		
	setcookie("SERVER",$config->DBhost);
	
	setcookie("MYSQL_USER",$config->DBusername);
	
	setcookie("MYSQL_PASS",$config->DBpassword);
	
	setcookie("MYSQL_DATABASE",$config->DBname);
		
	$cn=""; 
	
	$table=""; 
	
	$n=$config->AllowNull; 
	
	$pk=$config->PrimaryKey; 
	
	$v=$config->Varchar;
		
	$cn=mysql_connect($config->DBhost,$config->DBusername,$config->DBpassword); 
	
	/******************************************************************************************************************
	 Here are the mySQL commands you can run from the command line to create the tables that are needed by this application. DO THIS YOURSELF!!
	*******************************************************************************************************************/
	
	$table_name[]="guest";
	
	$table_name[]="admin";
	
	
	$my_table[]="create table $table_name[0] (id $v(150) $n, nama varchar(30) $n, email text $n, pesan text $n, judul text $n, tgl date $n, $pk(id))";
	
	$my_table[]="create table $table_name[1] (adminUSER $v(10) $n, adminPASSWORD $v(8) $n, $pk(adminUSER))";
	
		
	if(mysql_select_db($db,$cn)==0)
	{
		mysql_query("create database $db");
		
		mysql_select_db($db,$cn);
	}
	else
	{
		
		mysql_select_db($db,$cn);
		
	}
	
	$x=date("Y/m/d");
	
	mysql_query("INSERT INTO guest VALUES('SR001','R','_@yahoo.com','blank','blank','$x')");
	mysql_query("INSERT INTO guest VALUES('SR002','S','_@yahoo.com','reply only','blank','$x')");
	
	mysql_query("INSERT INTO admin VALUES('n','c')");
	mysql_query("INSERT INTO admin VALUES('r','i')");
	
	
	$jumper=0;
		
	for($jumper=0;$jumper<count($my_table);$jumper++)
	{
			
			mysql_query($my_table[$jumper]);
		
	}
			
			
	$db_username = $HTTP_COOKIE_VARS["MYSQL_USER"]; 
	
	$db_password = $HTTP_COOKIE_VARS["MYSQL_PASS"];
	
	$db_name =  $HTTP_COOKIE_VARS["MYSQL_DATABASE"]; 
	
	// CONVERT month value to month name	
	
	function getBln($parameter)
	{
		switch($parameter)
		{
				case "01":return "Januari"; break; 
				
				case "02":return "Februari"; break; 	
				
				case "03":return "Maret"; break;
				
				case "04":return "April"; break; 
				
				case "05":return "Mei"; break;	
				
				case "06":return "Juni"; break;
				
				case "07":return "Juli"; break; 
				
				case "08":return "Agustus"; break; 
				
				case "09":return "September"; break;
				
				case "10":return "Oktober"; break;	
				
				case "11":return "November"; break; 
				
				case "12":return "Desember"; break;
		}
	}
		
		// CONVERT day value to day name
		function CekHari($parameter)
		{
			switch($parameter)
			{
				case "Monday":return "Senin"; break; 
				
				case "Tuesday":return "Selasa"; break; 
				
				case "Wednesday":return "Rabu"; break;
				
				case "Thursday":return "Kamis"; break; 
				
				case "Friday":return "Jum'at"; break;
				
				case "Saturday":return "sabtu"; break;
				
				case "Sunday":return "Minggu"; break;
			}
		}
		
		// FULL DAY 
		function getDAY()
		{
			$day=array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
			
			$month=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
			
			$hari=$day[date("w")];
	
			$bulan=$month[date("m")-1];

			return $hari.", ".Date("d")." ".$bulan." ".Date("Y");
		}
		
		
		function New_Number($field,$table,$key,$Parse,$Digit_Count)
		{
			$NOL="0";
			
			$Q = mysql_query("Select $field from $table where $key like '$Parse%' order by $key DESC") or die(mysql_error()."Select $field from $table where $key like '$Parse%' order by $key DESC");
			
			$N = mysql_affected_rows();
			
			$counter=2;
			
			if($N==0)
			{
				while($counter < $Digit_Count)
				{
					$NOL="0".$NOL;
					
					$counter++;
				}
				return $Parse.$NOL."1";
			}
			else
			{
				$R = mysql_fetch_row($Q);
				
				$K = sprintf("%d",substr($R[0],-$Digit_Count));
				
				$K = $K + 1;
				
				$L = $K;
				
				while(strlen($L)!=$Digit_Count)
				{
					$L = "0".$L;
				}
				return $Parse.$L;
			}
		}
		
		
		// get date difference between 2 date
		function dateDiff($interval,$dateTimeBegin,$dateTimeEnd) 
		{
			//Parse about any English textual datetime
			//$dateTimeBegin, $dateTimeEnd
			
			$dateTimeBegin=strtotime($dateTimeBegin);
			
			if($dateTimeBegin === -1) 
			{
				return("..begin date Invalid");
			}
			
			$dateTimeEnd=strtotime($dateTimeEnd);
			
			if($dateTimeEnd === -1) 
			{
  				return("..end date Invalid");
			}

			$dif=$dateTimeEnd - $dateTimeBegin;
			
			switch($interval) 
			{
				//seconds
				case "s":
								return($dif);
								
				//minutes
			  	case "n":
								return(floor($dif/60)); //60s=1m
								
				//hours
			  	case "h":
								return(floor($dif/3600)); //3600s=1h
								
				//days
			  	case "d"://days
								return(floor($dif/86400)); //86400s=1d
								
				//week
			  	case "ww"://Week
								return(floor($dif/604800)); //604800s=1week=1semana
								
				//similar result "m" dateDiff Microsoft
			  	case "m": 
								$monthBegin=(date("Y",$dateTimeBegin)*12)+date("n",$dateTimeBegin);
								
								$monthEnd=(date("Y",$dateTimeEnd)*12) + date("n",$dateTimeEnd);
								
								$monthDiff=$monthEnd-$monthBegin;
								
								return($monthDiff);
								
				//similar result "yyyy" dateDiff Microsoft
			  	case "yyyy": 
								return(date("Y",$dateTimeEnd) - date("Y",$dateTimeBegin));
								
				//microtime
			  	default:
								return(floor($dif/86400)); //86400s=1d
			}
		}
		
		
		function future($interval,$Format,$jumper)
		{
			
			if ($jumper <1){ return ("..Jumper Invalid"); }
			
			$now=time();
			
			switch($interval)
			{
				case "s": //second (00 - 59)
								$tomorrow=$now * $jumper;
								break;
								
				case "i": //minutes (00 - 59)
								$tomorrow=$now + 60 * $jumper;
								break;
								
				case "h": // (00 - 12)
								$tomorrow=$now + 60 * 60 * $jumper;
								break;
								
				case "d": //day (00 - 31)
								$tomorrow=$now + 24 * 60 * 60 * $jumper;
								break;
								
				case "m": //month (00 - 12)
								$tomorrow=$now + 24 * 60 * 60 * date("t") * $jumper;
								break;
																
				case "y": // year (00 - 99)
								$tomorrow=$now + 24 * 60 * 60 * 365 * $jumper;
								break;
			}
			
			return(date($Format,$tomorrow));
			
		}
	
		
	function recordsetNav(&$db_connect,$db_query,$page_url,$offset=0,$limit=0,$tablewidth='100%',$verbiage=1) 
	{ 
		# EXAMPLE USAGE: recordsetNav($mysql_link,$users_query,$PHP_SELF,$offset,$limit,'75%',0); # 
		 
		$db_result = @mysql_query($db_query,$db_connect); 
	   
		$totalrecords = @mysql_num_rows($db_result); 
	   
		$pagenumber = ($offset + $limit) / $limit; 
	  
		$totalpages = intval($totalrecords/$limit); 
	 
		if ($totalrecords%$limit > 0) $totalpages++; 
		 
		// start building navigation string 
		$navstring  = "<table width=\"$tablewidth\" cellspacing=\"0\" cellpadding=\"1\" border=\"0\">"; 
		 
		if ($totalrecords > $limit) // only show <<PREV NEXT>> row if $totalrecords is greater than $limit 
		{ 
			$navstring .= "<tr>"; 
		 
			if ($offset != 0) 
	   
			{ 
	   
				$navstring .= "<td valign='middle' width='25%' nowrap><a class='small' href='".$page_url."?offset=".($offset-$limit)."&mode=view'><b>&lt;&lt; Sebelumnya</a></b></td>"; 
	   
			} else { 
		 
				$navstring .= "<td width='25%' nowrap>&nbsp;</td>"; 
		
			}     
	
			$navstring .= "<td align='center' width='50%' class='BG7'>"; 
	  
			for ($i=1;$i<=$totalpages;$i++) 
			{  
	  
				if ($i == $pagenumber) 
	   
				{  
	  
					$navstring .= "<span class='ATTENTIONsmall'>$i</span> ";  
	
				} else {  
	
					$nextoffset = $limit * ($i-1);  
	  
					$navstring .= "<a class='small' href='".$page_url."?offset=".$nextoffset."&mode=view'>$i</a> ";  
	   
				}  
	 
			}  
	 
			$navstring .= "</td>"; 
	
			 if($totalrecords-$offset <= $limit) 
	
			{  
	  
				$navstring .= "<td width='25%' nowrap>&nbsp;</td>"; 
	 
			} else {  
	 
				$navstring .= "<td align='right' valign='middle' width='25%' nowrap><a class='small' href='".$page_url."?offset=".($offset+$limit)."&mode=view'><b>Selanjutnya &gt;&gt;</b></a></td>";  
			} 
	
			$navstring .= "</tr>"; 
	
		}     
		 
		$navstring .= "<tr><td colspan='3' align='center'>&nbsp;</td></tr>"; 
	
		if ($verbiage) 
	
		{ 
	
			$navstring .= "<tr><td colspan='3' align='center' nowrap>"; 
	
			$navstring .= "<span class='RGBsmall'>Halaman: <b>".$pagenumber."</b>/<b>".$totalpages."</b>"; 
	
			$navstring .= "&nbsp;&nbsp; total Record(s): <b>".$totalrecords."</b></span>"; 
	
			$navstring .= "</td></tr>"; 
	
		} 
			
		$navstring .= "</table>"; 
		 
		echo $navstring; 
	} 

	function PrintPrinter()
		{
			?>
				<script>
					function Print() 
					{
						document.body.offsetHeight;
						window.print();
					}
				</script>
			<?php 
		}
	
	function GetPass(){
		print("<br>");
		print("	<table border=0 width=\"100%\" align=center>");
		print("		<tr>");
		print("			<td align=center>");
		print("				<input type=button onClick=\"window.open('Password.php','','resizable=no,width=450,height=400')\" value=\"Lupa Password\">");
		print("			</td>");
		print("		</tr>");
		print("	</table>");
	}
	?>