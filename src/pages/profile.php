<?php
echo "<br> Your Personal Profile <br><br>";
			
	if($_SESSION['role']=="student"){
		$pro_user=$_SESSION['ru_st_user_id'];
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
						
echo '<br><hr class=bar>Change Your Password <hr class=bar>';	
     
	$item=$_GET['item'];
	if($item=='chpsw'){
	
	$old_pass_pro=$_POST['old_pass_pro'];
	$new_pass_one=$_POST['new_pass_one'];
	$new_pass_two=$_POST['new_pass_two'];
	
	if($new_pass_one!=$new_pass_two){
	echo '<font color="red"> Your Confirm Password Not Match</font>';
	echo '<br ><a href="index.php?task=edit"> Try Again </a>';
	}
	
	else{
	
	
						
	$query_pwd="select AES_DECRYPT(password,1000) as pwd from rumisdb.fohssmis where user='$pro_user'";
	$pro_qwd=mysql_query($query_pwd) or die(mysql_error());
	while($find_pass=mysql_fetch_array($pro_qwd)){
		
	if($find_pass['pwd']==$old_pass_pro){
	/*  echo 'password matched'; */
	$query_pwd="update rumisdb.fohssmis set password=AES_ENCRYPT('$new_pass_two',1000) where user='$pro_user'";
	$pro_qwd=mysql_query($query_pwd);
	if($pro_qwd){

		include_once ("./classes/loginClass.php");
			$j=new login();
			$j->logUser();
			$login_ip=$j->getIp();


			if($_SESSION['role']=="student"){
				$fac_user=$_SESSION['user_id'];
							}

			else{	
			$fac_user=$_SESSION['user_id'];		
				}




		$quecngpwd="insert into chngpwd(uname,datentime,ip,reason) values('$fac_user',now(),'$login_ip','nml_pwd_cng')";
		//echo$quecngpwd;
		mysql_query($quecngpwd);



	echo '<font color="red"> Password Changed Successfully</font>';
	}
	
	
	}
	else{
	echo '<font color="red"> Your Old Password does not match</font>';
	echo '<br ><a href="index.php?task=edit"> Try Again </a>';
	
	}
	
	
	}
	
	
	
	}
	
	echo"<br>";
	}
	else{
	echo '<form method="POST" name="passchange" action="index.php?task=edit&item=chpsw">';  
       echo"<table class=bgc border=0>"; 
	echo '<tr><td>Your Current Password <td> : ';
	echo '<input type="password" name="old_pass_pro" size="15">';
	echo '<tr><td>New Password <td> : ';
	echo '<span id="sprypassword"><input type="password" name="new_pass_one" size="15">';
	echo '<span class="passwordRequiredMsg"><font size="-1"> Enter a Password </font></span></span><br>';
	echo '<tr><td>Confirm New Password <td> : <span id="sprypassword1">';
	echo '<input type="password" name="new_pass_two" size="15">';
	echo '<span class="passwordRequiredMsg"><font size="-1"> Confirm the Password</font></span></span>';
	echo '<tr><td colspan=2 align=center><input type="submit" value="Submit" name="submit"></table></form>';


    }

?>
