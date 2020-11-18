






<?php
echo "Adding Technical Officer to the MIS@UOR <hr color=#E1E1F4 width=95%><br>";
						
	$section=$_SESSION['sec'];
	$vwusr=$_GET['viwingusers'];
	if($vwusr=='vwusr'){
						
echo "<b><center>TO Account Summery</center></b>";
$con20_2=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);		
$query20_2="select * from users where role='office' and section='$section' group by user desc";
$usr_details=mysql_query($query20_2);
echo '<table border="1" align="center"  bordercolor="#993366"><tr><th>User<th>Name<th>Role<th>Occupation<th>Remove</tr>';
						
//Grouping With Pages
while($data=mysql_fetch_array($usr_details)){
echo "<tr><td>".$data['user']."<td>".$data['initials']." ".$data['l_name']."<td>".$data['role']."<td>".$data['occupation']."<td>";
echo "<a href=?view=admin&admin=31&task=removeuser&id=".$data['user'].">remove</a></tr>";
}
echo "</table>";
						
}
						
else{
echo '<a href="index.php?view=admin&admin=31&viwingusers=vwusr">View and Manage Available Users</a><br><br>';

//Adding Users to MIS
if(($task=='adduser')&&(isset($_POST['submit']))){
$l_name=$_POST['last_20'];
$init=$_POST['init_20'];
$occu=$_POST['occu_20'];
$user_20=$_POST['user_20'];
$pass_20=$_POST['pass_20'];
$pass_20_2=$_POST['pass_20_2'];
$role_20=$_POST['role_20'];
$email=$_POST['email_20'];
$sec=$_POST['sec_20'];
	
//Form Validation
if($user_20==""){
echo "<font color=red>User Name Cannot be Empty</font><br>";
}
elseif($pass_20!=$pass_20_2){
echo "<font color=red>Confirm Password Not Match</font><br>";
}
else{
$con20=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);
				
// Add Users
		
$query20="insert into users values('$l_name','$init','$occu','$user_20',AES_ENCRYPT('$pass_20',1000),'$role_20','$email','$sec')";
$usr_add=mysql_query($query20);
if($usr_add){
echo "User Added Successfully";
}
else
echo "Cannot Create User";
}
}
						
//else{
echo '<div id="dialog" title="Add User" width="400px" height="600px">';

include 'forms/form_31.php';
echo '</div>';
						
						
						//}
						
						// Removing Users 
						
						$con20=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						if($task='removeuser'){
						$query20_3="delete from users where user='$id'";
						$ann_rm=mysql_query($query20_3);
						}
						if($ann){
						echo "removed";
						}
						}
?>