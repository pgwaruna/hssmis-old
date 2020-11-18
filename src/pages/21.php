<?php
include'./admin/config.php';
echo "Submit Student Daily Attendence <hr color=#E1E1F4 width=95%><br>";
						
									
						$lec_id=$_SESSION['user_id'];
						
						$con21_1=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						
						$query_21_8="select distinct semister from level";
						$attL=mysql_query($query_21_8);
						while($find_semiL=mysql_fetch_array($attL)){
						$find_L=$find_semiL['semister'];
						}

						if($find_L==1)
						$query_21_1="select code, name from courseunit where lecture='$lec_id' and (semister=1 or semister=3)";
						elseif($find_L==2)
						$query_21_1="select code, name from courseunit where lecture='$lec_id' and (semister=2 or semister=3)";
						$att=mysql_query($query_21_1);
						echo "<font color=#006699>You have following subjects to Create New Lecture </font><table>";
						while($attdata=mysql_fetch_array($att)){
						echo '<tr align="left"><td><a href="index.php?view=admin&admin=21&sub='.$attdata['code'].'&task0=attendence">'.strtoupper($attdata['code'])."</a><td>".$attdata['name'];
						}
						mysql_close($con21_1);
						echo "</table>";

						
						echo '<br><hr color=#E1E1F4 width=95%>';	
						

						//Selecting Date and Hours
						$task0=$_GET['task0'];
						if($task0=='attendence'){
						$sub_21=$_GET['sub'];
						include 'forms/form_21_0.php';
						echo "<font color=red>Please Remember your Lecture ID for Future Tasks</font>";
						}
						
						
						// selecting courses
						$task1=$_GET['task1'];
						if(($task1=='attendence')&&(isset($_POST['submit']))){
						
						$y=$_POST['y'];
						$m=$_POST['m'];
						$d=$_POST['d'];
						
						$sub_21=$_GET['sub'];
						$hours=$_POST['hours'];
						$time_21=$_POST['time_21'];
						$day=$y.'-'.$m.'-'.$d;
						$user_21=$_SESSION['user_id'];
						
						// Creating a Lecture ID
						
						$con21_7=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						
						$query_21_7="insert into lecture values(NULL,'$sub_21','$day','$hours','$user_21','$time_21')";
						$att_add=mysql_query($query_21_7);
						if($att_add){
						echo "<br>Lecture ID created Successfully. ";
						}
						$query_21_8="select max(lecture_id) from lecture";
						$id=mysql_query($query_21_8);
						while($iddata=mysql_fetch_array($id)){
						
						echo "Your Lecture ID= ".$iddata['max(lecture_id)']."<br>";
						echo '<br><font color="brown"><a href="index.php?view=admin&admin=21&task2=dailyAtt&id='.$iddata['max(lecture_id)'].'">Click Here to Add Attendence for Lecture ID '.$iddata['max(lecture_id)'].'</a>';
						echo '<br>'.strtoupper($sub_21).' @ '.$day.' / ( 0'.$hours.' Hours Lecture ) </font><br><br>';
						}
						mysql_close($con21_7);
						}
						
						$data=$_GET['data'];
						$task2=$_GET['task2'];
						if($task2=='dailyAtt'){
						
						if(($_GET['submiting'])!=ok)
						{
						include 'forms/form_21.php';
						}
						
						}
						// Adding Attendence Data To the Table
						
						if(($data=='input')&&(isset($_POST['att_submit']))){
						$count_val=$_POST['count_val'];
						$lect_id=$_POST['lect_id'];
						
						
						// Add Daily Attendence
																												
						$connection21_8=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						$j=1;
						while($j<($count_val)){
						$x=$_POST[$j];
						if(isset($x)){
						$query_21_2="insert into participation values('$x','$lect_id','1')";
						}
						$j++;
						$result=mysql_query($query_21_2);
						}
						if($result){
						echo 'Data Added succesfully';
						}
						mysql_close($connection21_8);
						}		

?>