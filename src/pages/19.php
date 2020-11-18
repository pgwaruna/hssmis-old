<?php
include'./admin/config.php';
// Add multiple Exam Eligibility from CSV File
						echo "Adding Multiple Exam Eligibility <hr color=#E1E1F4 width=95%><br>";

						echo '<form method="POST" action="index.php?view=admin&admin=19&action=upload">';
						echo '<input type="text" name="file" size="32"><br><br>CSV file path paste here &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Submit" name="submit"><br><br>';
						echo '</form>';
						
						$action=$_GET['action'];
						$file=$_POST['file'];

						if(($action=='upload')&&(isset($_POST['submit']))){
						$con19_3=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						$query_19_1="LOAD DATA LOCAL INFILE '$file' INTO TABLE attendence fields terminated by ',' ignore 3 lines";
						$prev=mysql_query($query_19_1);			
						mysql_close($con19_3);
						}

						
						echo "Add Student Exam Eligibility <hr color=#E1E1F4 width=95%><br>";
						
						$lec_id=$_SESSION['user_id'];
						
						$con19_1=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						
						$query_19_8="select distinct semister from level";
						$attL=mysql_query($query_19_8);
						while($find_semiL=mysql_fetch_array($attL)){
						$find_L=$find_semiL['semister'];
						}

						if($find_L==1)
						$query_19_1="select code, name from courseunit where lecture='$lec_id' and semister=1";
						elseif($find_L==2)
						$query_19_1="select code, name from courseunit where lecture='$lec_id' and (semister=2 or semister=3)";
						
						$att=mysql_query($query_19_1);
						echo "<font color=#006699>You have following subjects to add attendence</font><table>";
						while($attdata=mysql_fetch_array($att)){
						echo '<tr align="left"><td><a href="index.php?view=admin&admin=19&sub='.$attdata['code'].'&task=attendence">'.strtoupper($attdata['code'])."</a><td>".$attdata['name'];
						}
						mysql_close($con19_1);
						echo "</table>";
						
						// selecting courses
						if($task=='attendence'){
						$sub_19=$_GET['sub'];
						echo '<br>Add Attendence for '.strtoupper($sub_19).'<br><br>';
						include 'forms/form_19.php';
						}
						
						if(($task=='addatt')&&(isset($_POST['submit']))){
						$index_19=strtolower($_POST['index_19']);
						$eli_19=$_POST['eli_19'];
						$cor_19=$_POST['cor_19'];
																								
						$con19=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						
						// Add Exam Eligibility
						$check_to_att="select course from attendence where student='$index_19' and course='$cor_19'";
						$check_6=mysql_query($check_to_att);
						while($chk=mysql_fetch_array($check_6)){
						if($cor_19==$chk['course']){
						$duplicate='Yes';
						}
						}
						if($duplicate=='Yes'){
						echo "<br><font color=red> * Duplications are not allowed for attendence <br></font><br>";
						}
						else{			
						$query_19="insert into attendence values(NULL,'$index_19','$cor_19','$eli_19')";
						$att_add=mysql_query($query_19);
						if($att_add){
						echo "Data Added Successfully";
						}
						}
						mysql_close($con19);
						}
						
						// View Exam Eligibility of subject
						$con19_3=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						$query19_3="select a.course, a.student, a.eligibility from attendence a, courseunit c where a.course=c.code and c.lecture='$lec_id' and c.semister='$find_L'";
						$att_5=mysql_query($query19_3);
						echo '<table border="1"  bordercolor="#993366"><tr><th>course</th><th>Student</th><th>Eligibility</th></tr>';
						while($data=mysql_fetch_array($att_5)){
						echo '<tr>';
						echo "<td>".$data['course']."<td>".$data['student']."<td>".$data['eligibility'];
						echo '</tr>';
						}
						echo '</table>';
						mysql_close($con19_3);
?>