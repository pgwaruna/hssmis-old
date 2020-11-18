<?php
//error_reporting(0);
session_start();
$role=$_SESSION['role'];
if((($_SESSION['login'])=="truefohssmis")&&($role=="administrator")){

$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
//echo $querole;
$qurole=mysql_query($querole);

if($qurole!=NULL)
{
while($qrole=mysql_fetch_array($qurole)){
$roleid=$qrole['role_id'];
}

$quepers="SELECT id FROM permission WHERE role_id =$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
if($qpers['id']=="62"){
$pem="TRUE";

}
}
}
else
{
echo "You Have Not Permission To Access This Area!";
}

if($pem=="TRUE")
{
$fscd="62";
?>

<script type="text/javascript">
function checkcnfpwd(){
	
	if(chngpwd.restcod.value==""){
		alert("Please Enter Security Code");
		chngpwd.restcod.focus();
		return false;		
		}
	if(chngpwd.newpwd.value==""){
		alert("Please Enter New Password");
		chngpwd.newpwd.focus();
		return false;		
		}
	if(chngpwd.newpwd.value!=chngpwd.cnfpwd.value){
		alert("Sorry! Confirm Password is Not Match. Please Confirm Password ");
		chngpwd.cnfpwd.focus();
		return false;		
		}
	
}


</script>









<?php
echo"Password Reset Unit";
echo"<hr class=bar>";
$dt=date("n.j");
echo"<form method=post action='./index.php?view=admin&admin=62&task=chkpwd'>";
echo"Enter User Name:<input type=text name=chkuser><input type=submit value=Search></form>";


if($task=="chkpwd"){
$getchkuser=$_POST['chkuser'];


$quegetuser="select role from $rmsdb.fohssmis where user='$getchkuser'";
$qugetuser=mysql_query($quegetuser);
if(mysql_num_rows($qugetuser)==0){
	echo"<br><font color=red>Sorry! Invalid user name ( $getchkuser ) </font><br><br>";
					}
else{
	while($qgetuser=mysql_fetch_array($qugetuser)){
		$chkrole=$qgetuser['role'];
		//echo$chkrole;

		if($chkrole!="administrator"){
		echo"<form method=post action='./index.php?view=admin&admin=62&task=rstpd' id=chngpwd>";
		echo"<table border=0 class=bgc>";
			
			echo"<tr><td>Enter Security Code<td> : <input type=password name=restcod><input type=hidden name=chnuser value=$getchkuser>";
			echo"<tr><td>Enter New Password<td> : <input type=password name=newpwd>";
			echo"<tr><td>Confirm New Passowrd<td> : <input type=password name=cnfpwd>";
			echo"<tr><td colspan=2 align=center><input type=submit value='Reset Password' onclick='return checkcnfpwd(chngpwd)'>";
		echo"</form></table>";

						}
		else{
		echo"<font color=red>Sorry! You can not change password for this user</font><br><br>";
			}
							}


	}


}

if($task=="rstpd"){
$chnuser=$_POST['chnuser'];
$seqcode=$_POST['restcod'];
$npwd=$_POST['newpwd'];
$fullsqecode=$fscd.$roleid."&".$dt."/".$roleid.$fscd;

if($fullsqecode==$seqcode){
	$query_pwd="update $rmsdb.fohssmis set password=AES_ENCRYPT('$npwd',1000) where user='$chnuser'";
	$pro_qwd=mysql_query($query_pwd);
	if($pro_qwd){
	echo '<font color="red"> Password Changed Successfully !</font><br>';
	}
    else{
        echo"<font color=red>Sorry! Can not change Password.</font><br>";
    }



				}
else{
echo"<font color=red>Sorry! Can not change Password.</font><br>";
}


			}




?>













<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}

?>

