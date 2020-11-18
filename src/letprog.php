<?php
echo"<a href='index.php?view=admin&admin=20'>Go Back</a><br>";
include'admin/config.php';
mysql_connect($host,$user,$pass) or die("can not connect");
mysql_select_db($db);

$quemen="select lname,initials,user_name from mentor";
$qumen=mysql_query($quemen);
echo"<table border='1'><tr><th>last name<th>Initials<th>User Name<th> Last Login Date & Time<th>Mentor</tr>";
$c=0;
$d=0;
while($qmen=mysql_fetch_array($qumen)){
		$lname=$qmen['lname'];
		$initials=$qmen['initials'];
		$user_name=$qmen['user_name'];
		$c=$c+1;
echo"<tr><td>$lname</td><td>$initials</td><td align='center'>$user_name</td><td align='center'>";

	$queldate="select intime from login_info where user_id='$user_name'";
	$quldate=mysql_query($queldate);
		if(mysql_num_rows($quldate)!=0){
			while($qldate=mysql_fetch_array($quldate)){
					$ldate=$qldate['intime'];
									}		
					echo$ldate."</td>";	

						}
		else{
			echo"Not Login yet</td>";
			}

echo"<td align='center'>Yes</td></tr>";

					}


$quenotmen="select u.user,u.l_name,u.initials from rumisdb.fohssmis u where u.role='lecturer' and u.user not in ( select m.user_name from mentor m)";
//echo$quenotmen;
$qunotmen=mysql_query($quenotmen);
while($qnotmen=mysql_fetch_array($qunotmen)){
		$l_name=$qnotmen['l_name'];
		$init=$qnotmen['initials'];	
		$user=$qnotmen['user'];	
		$d=$d+1;
echo"<tr><td>$l_name</td><td>$init</td><td align='center'>$user</td><td align='center'>";

		$queldate1="select intime from login_info where user_id='$user'";
	$quldate1=mysql_query($queldate1);
		if(mysql_num_rows($quldate1)!=0){
			while($qldate1=mysql_fetch_array($quldate1)){
					$ldate1=$qldate1['intime'];
									}		
					echo$ldate1."</td>";	

						}
		else{
			echo"Not Login yet</td>";
			}
	

echo"<td align='center'>No</td></tr>";

						}
$e=$c+$d;
echo"Total Users: ".$e;
echo"</table>"
?>
