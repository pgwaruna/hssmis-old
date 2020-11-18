<?php

$step=$_GET['step'];


echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;Install MIS@FOS 1.0 < Step ";
if(!(isset($step))){
$step='1';
echo $step;
echo " ><br>";
}
else{
echo $step;
echo " ><br>";
}

switch($step){

case 1 :	include 'form.php';
			break;
			
case 2 :	echo "<br><br>Installing Database....<br>";
			///*
			$host=$_POST['host'];
			$db=$_POST['db'];
			$user=$_POST['user'];
			$pass=$_POST['pwd'];
			//*/
			//$host='1';
			$string='<?php  $host="'.$host.'";  $db="'.$db.'";  $user="'.$user.'";  $pass="'.$pass.'";  ?>';
						
			$filename = '../admin/config.php';
			$somecontent = $string;
			if (is_writable($filename)) {
    		if (!$handle = fopen($filename, 'w')) {
        	 echo "Cannot open file ($filename)";
         	exit;
   		 	}

    		if (fwrite($handle, $somecontent) === FALSE) {
        	echo "Cannot write to configuration file, please chomod as 666, ($filename)";
        	exit;
  		  	}
    
    		echo "Successfully created configuration file";
       		fclose($handle);
			$ok='1';
			} 
			else
			{
   			 echo "<br><font color=#FF6600>Cannot write to configuration file, please chomod it as 666 and try again</font>";
			}		
			
			echo '<br><br><br><br><br><br><br><br><br>';
			echo '<p><a href="index.php?step=1"> Go to Back Step </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			if($ok=='1'){
			echo '<a href="index.php?step=3"> Go to Next Step </a> </p>';
			}
			break;
			

case 3 :	echo "<br><br>Installing Tables....<br>";
			
			include 'install_DB/announcement.php';
			echo "<br>";
			
			include 'install_DB/attendence.php';
			echo "<br>";
			
			include 'install_DB/call_registration.php';
			echo "<br>";
			
			include 'install_DB/courseunit.php';
			echo "<br>";
			
			include 'install_DB/level.php';
			echo "<br>";
			
			include 'install_DB/permission.php';
			echo "<br>";
			
			include 'install_DB/registration.php';
			echo "<br>";
			
			include 'install_DB/results.php';
			echo "<br>";
			
			include 'install_DB/role.php';
			echo "<br>";
			
			include 'install_DB/student.php';
			echo "<br>";
			
			include 'install_DB/users.php';
			echo "<br>";
	
			include 'install_DB/combination.php';
			echo "<br>";

			include 'install_DB/lecture.php';
			echo "<br>";
			
			include 'install_DB/participation.php';
			echo "<br>";
			
			include 'install_DB/sub_assign.php';
			echo "<br>";
			

			include 'install_DB/acc_year.php';
			echo "<br>";
			
					
			
			echo '<br><br>';
			echo '<p><a href="index.php?step=2"> Go to Back Step </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			echo '<a href="index.php?step=4"> Go to Next Step </a> </p>';

			break;

case 4 :	echo "<br><br>Creating Admin User....<br>";
			include 'form_2.php';
			break;
			
			
case 5 :	//Adding admin Users to MIS

			include '../admin/config.php';
			
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
			include '../admin/config.php';
			$con20=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
			mysql_select_db($db);
						
			// Add Users
			
			$query20="insert into users values('$l_name','$init','$occu','$user_20',AES_ENCRYPT($pass_20,1000),'$role_20','$email','$sec')";
			$usr_add=mysql_query($query20);
			if($usr_add){
			echo "<br><br>Addmin User account created Successfully";
			}
			}
			
			echo '<br><br>';
			echo '<p><a href="index.php?step=4"> Go to Back Step </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			echo '<a href="index.php?step=6"> Go to Next Step </a> </p>';
			break;
			


case 6	:	echo "Setup MIS@FOS is succesfully<br><br>";
			echo "Click Following link to start, Please login as admin and create users<br><br>";
			echo '<a href="../index.php"> START FROM HERE </a> <br>';
			break;


default :	echo "Invalid selection";
			break;
			

}


?>