<?php


require_once('./classes/globalClass.php');
$n=new settings();

if($_SESSION['role_id']=="6"){
echo"<table border='0' align='center' class=bgc><tr>";
echo"<th  colspan='2' align='center'>Your Mentor</th></tr>";

$stno=$_SESSION['user_id'];
//echo $stno;
$quegtmet="select mentor_id from student where id='$stno'";
//echo $quegtmet;
$qugtmet=mysql_query($quegtmet);
if(mysql_num_rows($qugtmet)!=0){
   

	while($qgemnt=mysql_fetch_array($qugtmet)){
		$mentid=$qgemnt['mentor_id'];
						}
	
		if($mentid!=0){
				$quegtmtdt="select * from mentor where mentor_id=$mentid";
				$qugtmtdt=mysql_query($quegtmtdt);
				while($qgtmtdt=mysql_fetch_array($qugtmtdt)){
					$user_name=$qgtmtdt['user_name'];
					$title=$qgtmtdt['title'];
					$lname=$qgtmtdt['l_name'];
					$initials=$qgtmtdt['initials'];
					$designation=$qgtmtdt['designation'];
					$department=$qgtmtdt['section'];
					$email=$qgtmtdt['email'];
					$Internal_no=$qgtmtdt['Internal_no'];
					$residence=$qgtmtdt['residence'];
					$mobile=$qgtmtdt['mobile'];	
										}
			
			
			
			$piname=$user_name.".jpg";
			$picppath="./images/staff/$piname";
			
			
			
			echo"<tr><td colspan='2' align='center'>";
				if(file_exists($picppath)){
					echo"<img src=$picppath  border=3></center>";
								}
				else{
				echo "<img src=./images/staff/HSS_Fac_no_picture.png class='stretch' alt='' width=100px height=110px>";
								}
			echo"</td></tr>";


			echo"<tr><td>Name</td><td>:&nbsp;$lname $initials </td></tr>";	
			echo"<td>Designation</td><td>:&nbsp;$designation</td></tr>";
			
			
			$deptnm=$n->getdeptname($department);
			
			echo"<td>Department</td><td>:&nbsp;$deptnm</td></tr>";
			echo"<td>E-mail</td><td>:&nbsp;<a href='mailto:$email'>$email</a></td></tr>";
			echo"<td>Internal TP No</td><td>:&nbsp;$Internal_no</td></tr>";
			echo"<td>Residence</td><td>:&nbsp;$residence</td></tr>";
			echo"<td>Mobile</td><td>:&nbsp;$mobile</td></tr>";
			echo"</table>";
							}
				
		else{
			echo"<tr><td colspan='2' align='center'>Sorry ! Your mentor has not yet been assigned or defined by the system. Please contact Dean's
Office.</td></tr></table>";
				}
		}
else{
echo"<tr><td colspan='2' align='center'>Sorry ! Your mentor is not diefine by system.</td></tr></table>";
	}
				}




else{

	$current_user=$_SESSION['user_id'];

	$potofile="./images/staff/".$current_user.".jpg";
	
	echo"<table border=0 align=right v align=top><tr><td colspan=2>";
	//echo '<center><img src=$potofile></center><br>';
	if(file_exists($potofile)){
			echo"<center><img src=$potofile  border=3></center><br>";
								}
		else{
			echo "<center><img src=images/staff/HSS_Fac_no_picture.png class='stretch' alt='' width=100px height=110px></center><br>";
								}
	
	echo"</td></tr>";
	
	
	
	echo '<tr class="trbgc"><td align=left><font color=#800000>';
	
	echo '&nbsp;Name<td align=left> '.ucfirst($_SESSION['last_name']).' '.strtoupper($_SESSION['initials']);
	
	echo '<tr class="trbgc"><td align=left><font color=#800000>&nbsp;Role<td align=left> '.ucfirst($_SESSION['role_name']);
	
	echo '<tr class="trbgc"><td align=left><font color=#800000>&nbsp;Designation<td> '.ucfirst($_SESSION['occupation']);
	
	$ip=$_SERVER['REMOTE_ADDR'];
	echo '<tr class="trbgc"><td align=left><font color=#800000>&nbsp;Your IP<td> '.$ip;
	
	$browser=$_SERVER['HTTP_USER_AGENT'];
	//echo 'Your Browser : '.$browser;

	echo '</font></table>';
}





?>
