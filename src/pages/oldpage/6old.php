<?php
mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);
//...............get acc_year....................
$acc_year="select acedemic_year from acc_year where current='1'";
$ac_year=mysql_query($acc_year);
while($a_y=mysql_fetch_array($ac_year)){
$acy=$a_y['acedemic_year'];
}
$acyer=explode("_",$acy);
$acyold=$acyer[0]-1;
$acycur=$acyer[0];
$acynx=$acyer[1];

//.................................................	



	echo "Add Remove Student Information <hr color=#E1E1F4 width=95%><br>";

						$addingstd=$_GET['addstd'];
						if($addingstd=='fromData'){
						
						// Add Data from Users Table
						
						if(($task=='adding')&&(isset($_POST['submit']))){
						$index_6_6=strtolower($_POST['index_6_6']);
						$name_6_6=$_POST['name_6_6'];
						$ini_6_6=$_POST['ini_6_6'];
						$year_6_6=$_POST['year_6_6'];
						$stream_6_6=$_POST['stream_6_6'];
						$comb_6_6=$_POST['comb_6_6'];

						
						$con66=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						
						// Add Student
			
						$query_6_8="insert into student (id,l_name,initials,year,stream,combination,batch,medium) values('$index_6_6','$name_6_6','$ini_6_6','$year_6_6','$stream_6_6','$comb_6_6','$year_6_6','select')";
						$usr_addings=mysql_query($query_6_8);
						if($usr_addings){
						$query_6_9="update users set section='checked' where user='$index_6_6'";
						$usr_addings=mysql_query($query_6_9);
								//edit by iranga
						$quecfcmbrq1="select combination from request_combination where stno=$index_6_6";						
						$qucfcmbrq1=mysql_query($quecfcmbrq1);
						while($qcfcmbrq1=mysql_fetch_array($qucfcmbrq1)){
						$cfcmbrq1=$qcfcmbrq1['combination'];
							$cfcmbepx=explode("/",$cfcmbrq1);
							$cfcmbevl=$cfcmbepx[1];	
							if($cfcmbevl==$comb_6_6){
								$quecfcmbrq2="update request_combination set status='Confirmed' where  combination='$cfcmbrq1' and stno=$index_6_6";
								$qucfcmbrq2=mysql_query($quecfcmbrq2);
										}


				
									}
						echo "Student $index_6_6 Data Added Successfully";
						}
						}

						
						
						// Add Data forms
						
						$con6_7=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						$query_6_8="select user, l_name, initials from users where role = 'student' and section <> 'checked'";
						$oce=mysql_query($query_6_8);
						echo '<br>Select and Submit Data from list Below<hr color=#E1E1F4 width=95%>';	
						while($data_6_8=mysql_fetch_array($oce)){
	
	
						echo '<form method="POST" action="index.php?view=admin&admin=6&addstd=fromData&task=adding">';
						
						echo '<font color="#800000">&nbsp;&nbsp; Index Number :</font>&nbsp;';
						echo '<font color="#800000">SC/</font><select size="1" name="year_6_6">';


						echo "<option value=$acyold>$acyold</option><option value=$acycur selected>$acycur</option><option value=$acynx>$acynx</option>";





						echo "</select>";
							$stno=$data_6_8['user'];
							$lname=$data_6_8['l_name'];
							$ini=$data_6_8['initials'];
						
						echo"<font color='#800000'>/</font>$stno<input type='hidden' name='index_6_6' size='4' value=$stno>";//hidden
						
						echo '<font color="#800000">&nbsp;&nbsp;</font><font size="2" color="#FF0000">&nbsp;&nbsp; </font>&nbsp;<font color="#800000">Stream :</font>';
						echo '<select size="1" name="stream_6_6">';
						echo '<option value="phy" selected="selected">Physical Science</option>';
						echo '<option value="bio">Bio Science</option>';
						echo '<option value="bcs">Com. Science</option>';

						echo '</select>&nbsp; <font color="#800000">&nbsp;</font>';
						echo"<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[".$lname."&nbsp;&nbsp;".$ini."]<br>";
						echo '<font size="2" color="#FF0000">&nbsp;&nbsp; </font>&nbsp;<font color="#800000">Combination :</font>'; 
						echo '<select size="1" name="comb_6_6">';
						echo '<option value="1">CS + Maths + AM</option>';
						echo '<option value="2">CS + Maths + Physics</option>';
						echo '<option value="3">CS + Chemistry + Maths</option>';
						echo '<option value="4">IM + Maths + Chemistry</option>';
						echo '<option value="5">IM + Maths + Physics</option>';
						echo '<option value="6">Maths + AM + Physics</option>';
						echo '<option value="7">Maths + AM + Chemistry</option>';
						echo '<option value="8">Maths + Physics + Chemistry</option>';
						echo '<option value="9">Zoo + Bot + Chemistry</option>';
						echo '<option value="10">Chemistry + Botany + Physics</option>';
						echo '<option value="11">Chemistry + Zoo + Physics</option>';
						echo '<option value="12">Botany + Zoo + Physics</option>';
						echo '<option value="13">BCS - Computer Science</option>';
						echo '</select>&nbsp; <font color="#800000"></font>';
							
						echo '<input type="hidden" name="name_6_6" size="10" value="'.$data_6_8['l_name'].'">';//hidden
						echo '<input type="hidden" name="ini_6_6" size="10" value="'.$data_6_8['initials'].'">';//hidden

 						echo '&nbsp;&nbsp;&nbsp;<input type="submit" value="Add To Student Table" name="submit">';
						echo '<br><br><hr color=#E1E1F4 width=95%></p></form>';
							}
	
						mysql_close($con6_7);
						//echo '</td></tr></table>';
	
						
						// End of Add Data
						
						}
						else{
						
						echo '<a href="index.php?view=admin&admin=6&addstd=fromData">Add Students From Available Users</a><br><br>';

						
						echo "<hr color=#E1E1F4 width=95%>";
						
						
						
						

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
echo '<div id="dialog" title="Add User" width="600px" height="600px">';

include 'forms/form_6.php';
echo '</div>';
					
					
						
						
						
						
						
						
						
						
						
						
						
						
						
					
						
					
						}


?>
