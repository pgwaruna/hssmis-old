 <head>



 <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  



  </head>



<?php
echo "Check F O H S S M I S Users <hr class=bar><br>";
						$vwusr=$_GET['viwingusers'];
						$id=$_GET['id'];
						if($vwusr=='vwusr'){
						//Grouping Users
											
						
						echo "<b><center>User Summery</center></b>";
							
						$query20_2="select * from $rmsdb.fohssmis group by user desc";
						$usr_details=mysql_query($query20_2);
						echo '<table border="0" align="center" ><tr><th>User<th>Name<th>Role<th>Occupation<th>Remove</tr>';
						
						//Grouping With Pages
						while($data=mysql_fetch_array($usr_details)){
						echo "<tr class=trbgc><td align=center>".$data['user']."<td>".$data['initials']." ".$data['l_name']."<td align=center>".$data['role']."<td>".$data['occupation']."<td align=center>";
						echo "<a href=?view=admin&admin=20&task=removeuser&id=".$data['user'].">remove</a></tr>";
						}
						echo "</table>";
						
						}
						
						else{
									
						
						
							// Removing Users 
						if($task=='removeuser'){
						//$query20_3="delete from $rmsdb.fohssmis where user='$id'";
						//$ann_rm=mysql_query($query20_3);
							echo "<font color=red>User Removed Successfully !</font><br><br>";
						
						}
						
						
						
						echo '[ <a href="index.php?view=admin&admin=20&viwingusers=vwusr">Click Here to View and Manage Available Users</a> ]<br><br>';
						
						
						 echo"<hr class=bar>";
						
										
						
						}
//..................EDIT BY IRANGA UPLOAD STUDENT USER EXCEL FILE............
//echo"<br><br><a href='./forms/uploads/upload_studentfile.php'>Click Here To Add Multiple Student Users</a><br>";
//................................................

//..................EDIT BY IRANGA UPLOAD NEW STUDENT'S PERMANENT NUMBERS EXCEL FILE............
//echo"<br><br><a href='./forms/uploads/upload_studentPNfile.php'>Click Here To Add Student's Permanent Numbers</a><br>";
//................................................



//..................EDIT BY IRANGA TO CHECK LECTURE USES'S LOGIN STATUS............
echo"<br><br>[ <a href='./letprog.php'>Click Here To CHECK LECTURE'S LOGIN STATUS</a> ]<br>";
//................................................

//..................EDIT BY IRANGA TO Insert Exam registration details of student...........
echo"<br><br>[ <a href='./forms/uploads/upload_st_examfile.php'>Click Here To Add Student's Exam Registration Details</a> ]<br>";
//................................................


//..................EDIT BY IRANGA TO Insert old registration details of student...........
echo"<br><br>[ <a href='./forms/uploads/upload_st_oldfile.php'>Click Here To Add Student's Previous Registration Details</a> ]<br><br>";
//................................................


 echo"<hr class=bar>";



//..................EDIT BY IRANGA TO check student attendence details of student...........
echo"Check Student's Attendence Details<br>";
//................................................
 echo"<hr class=bar>";
?>


<form enctype="multipart/form-data" action="./forms/readexlfile.php"' method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
Choose a Student file to Check Attendence : <input name="uploadedfile" type="file" /><br />
<input type="submit" value="Upload File" />
</form>




