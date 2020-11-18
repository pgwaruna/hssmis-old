<?php
session_start();
error_reporting(0);
if((isset($_SESSION['login'])=="truefohssmis")&&($_SESSION['adpdcngperm']=="yes")){

?>

<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />

<link href="css/fosmiscss.css" rel="stylesheet" type="text/css"/>
<link href="style/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="style/jquery.min.js"></script>
<script src="style/jquery-ui.min.js"></script>
<script src="style/jquery.tooltip.js"></script>





<script type="text/javascript">
function checkr(r)
{
	 
	if (r.old_pass_pro.value==""){
 	alert("Please Enter Your Current Password !");
	r.old_pass_pro.focus();
 	return false;}


	if (r.old_pass_pro.value==r.new_pass_one.value){
 	alert("Please change your new password other than old !");
	r.new_pass_one.focus();
 	return false;}


	if (r.new_pass_one.value!=r.new_pass_two.value){
 	alert("Your Confirm Password Not Match !");
	r.new_pass_two.focus();
 	return false;}


	
	  
 }
</script>











<?php
include'connection/connection.php';


$gtresn=$_GET['rea_cng'];


if($gtresn!=null){
$_SESSION['reson']=$gtresn;

}


$resn=$_SESSION['reson'];

echo"<div id=a align=center>";

echo "<h3> Your Personal Profile</h3>";
			
	if($_SESSION['role']=="student"){
		$pro_user=$_SESSION['ru_st_user_id'];
		$cngst=$_SESSION['user_id'];
									}

	else{	
        $pro_user=$_SESSION['user_id'];		
		}



		
		
						
		$query_p="select l_name, initials, user, occupation, role, email from rumisdb.fohssmis where user='$pro_user'";
		$pro_q=mysql_query($query_p);
		echo "<table border='1' bordercolor='#993366' width=60%' cellspacing='0'>";
		while($find_pro=mysql_fetch_array($pro_q)){
		
		echo "<tr><td align='center'>Your Name<td>&nbsp;&nbsp;".$find_pro['l_name']." ".$find_pro['initials'];
		echo "<tr><td align='center'>Proffession<td>&nbsp;&nbsp;".$find_pro['occupation'];
		echo "<tr><td align='center'>Your Role<td>&nbsp;&nbsp;".$find_pro['role'];
		echo "<tr><td align='center'>Your Email<td>&nbsp;&nbsp;".$find_pro['email'];
		}
		echo "</table>";
						
echo '<br><hr class=bar><h3>Change Your Password </h3><hr class=bar>';	
     
	$item=$_GET['item'];
	if($item=='chpsw'){
	
	$old_pass_pro=$_POST['old_pass_pro'];
	$new_pass_one=$_POST['new_pass_one'];
	$new_pass_two=$_POST['new_pass_two'];
	




	if($new_pass_one!=$new_pass_two){
	echo '<font color="red"> Your Confirm Password Not Match</font>';
	echo '<br ><a href="mpcng.php?task=edit"> Try Again </a>';
	}
	
	else{
	
	
						
	$query_pwd="select AES_DECRYPT(password,1000) as pwd from rumisdb.fohssmis where user='$pro_user'";
	$pro_qwd=mysql_query($query_pwd);
	while($find_pass=mysql_fetch_array($pro_qwd)){
		
	if($find_pass['pwd']==$old_pass_pro){
	/*  echo 'password matched'; */
	$query_pwd="update rumisdb.fohssmis set password=AES_ENCRYPT('$new_pass_two',1000) where user='$pro_user'";
	
#echo $query_pwd;
$pro_qwd=mysql_query($query_pwd);
	if($pro_qwd){

		include_once ("classes/loginClass.php");
			$j=new login();
			$j->logUser();
			$login_ip=$j->getIp();

		if($_SESSION['role']=="student"){
				$pro_user=$cngst;			
						}

		$quecngpwd="insert into chngpwd(uname,datentime,ip,reason) values('$pro_user',now(),'$login_ip','$resn')";
		//echo$quecngpwd;
		mysql_query($quecngpwd);
		echo '<font color="red" size=3px> Password Changed Successfully !</font>';

		unset($_SESSION['adpdcngperm']);


		echo"<br><br><div align=center>[ <a href='index.php?view=admin'>Back to Home</a> ]</div>";

		echo "<meta http-equiv='refresh' content='1;URL=index.php?view=admin'>"; 

		

	
	
	}
	
	
	}
	else{
	echo '<font color="red"> Your Old Password does not match</font>';
	echo '<br><br >[ <a href="mpcng.php?task=edit"> Try Again </a> ]<br><br>';
	
	}
	
	
	}
	
	
	
	}
	
	echo"<br>";
	}
	else{
	echo '<form method="POST" name="passchange" action="mpcng.php?task=edit&item=chpsw">';  
       echo"<table class=bgc border=0>"; 
	echo '<tr><td>Your Current Password <td> : ';
	echo '<input type="password" name="old_pass_pro" size="15">';
	echo '<tr><td>New Password <td> : ';
	echo '<span id="sprypassword"><input type="password" name="new_pass_one" size="15">';
	echo '<span class="passwordRequiredMsg"><font size="-1"> Enter New Password </font></span></span><br>';
	echo '<tr><td>Confirm New Password <td> : <span id="sprypassword1">';
	echo '<input type="password" name="new_pass_two" size="15">';
	echo '<span class="passwordRequiredMsg"><font size="-1"> Confirm the Password</font></span></span>';
	echo '<tr><td colspan=2 align=center><input type="submit" value="Submit" name="submit" onclick="return checkr(this.form)"></table></form>';


    }

echo"</div>";
?>

<script type="text/javascript">
<!--
var userid = new Spry.Widget.ValidationTextField("userid");

var number1 = new Spry.Widget.ValidationTextField("number1", "none", {validateOn:["change"]});
var number2 = new Spry.Widget.ValidationTextField("number2", "none", {validateOn:["change"]});
var ValidMarks = new Spry.Widget.ValidationTextField("marks", "integer", { maxValue:100, useCharacterMasking:false, validateOn:["blur", "change"]});

var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var textarea_counter_up = new Spry.Widget.ValidationTextarea("textarea_counter_up", {maxChars:255, counterType:"chars_remaining", counterId:"Counttextarea_counter", validateOn:["change"]});

var date1 = new Spry.Widget.ValidationTextField("date1", "date", {format:"yyyy-mm-dd", hint:"yyyy-mm-dd", useCharacterMasking:true, validateOn:["blur"]});

var date2 = new Spry.Widget.ValidationTextField("date2", "date", {format:"yyyy-mm-dd", hint:"yyyy-mm-dd", useCharacterMasking:true, validateOn:["blur"]});

var date3 = new Spry.Widget.ValidationTextField("date3", "date", {format:"yyyy-mm-dd", hint:"yyyy-mm-dd", useCharacterMasking:true, validateOn:["blur"]});

var date4 = new Spry.Widget.ValidationTextField("date4", "date", {format:"yyyy-mm-dd", hint:"yyyy-mm-dd", useCharacterMasking:true, validateOn:["blur"]});

var date5 = new Spry.Widget.ValidationTextField("date5", "date", {format:"yyyy-mm-dd", hint:"yyyy-mm-dd", useCharacterMasking:true, validateOn:["blur"]});

var time1 = new Spry.Widget.ValidationTextField("time1", "time", {format:"HH:MM", hint:"HH:MM", useCharacterMasking:true, validateOn:["blur"]});

var code = new Spry.Widget.ValidationTextField("code","custom", {pattern:"AAA0xxx",useCharacterMasking:true, validateOn:["blur"]});

var email = new Spry.Widget.ValidationTextField("email", "email", {validateOn:["blur"]});

var password = new Spry.Widget.ValidationTextField("password", "none", {minChars:6, maxChars:10, validateOn:["change"]});
var sprypassword = new Spry.Widget.ValidationPassword("sprypassword");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");

//-->
</script>








<?php
}
else{

echo "You Have Not Permission To Access This Area!";}




?>
