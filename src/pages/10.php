
<?php
//.............Edit by Iranga..........Modyfy Result 
//.........remove marks variable
require_once('./classes/globalClass.php');
$by=new settings();

include './admin/config.php';


	echo "Modify Students Results<hr class=bar><br>";
						include 'forms/form_10_1.php';
						echo "<hr class=bar><br>";


			if(($task=='modrslt')&&(isset($_POST['submit']))){
						$getid=$_POST['resid'];
						$index_10_2=$_POST['index_10_2'];
						$sub_10_2=$_POST['sub_10_2'];
						$marks_10_2=$_POST['marks_10_2'];
						$grade_10_2=$_POST['grade_10_2'];
						
						$con10_2=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						
						// Modify Results
			
						$query_10_2="update results set grade='$grade_10_2' where index_number='$index_10_2' and subject='$sub_10_2' and id='$getid'";
						$rslt_mod=mysql_query($query_10_2);
						if($rslt_mod){
						echo "Data Modified Successfully &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
						echo$sub_10_2." = ".$grade_10_2."<br><br>";
						}
						}

						// Display Results to Modify
						
			if(($task=='modify')&&(isset($_POST['submit']))){
						$index_10=$_POST['index_10'];
						$sub_10=$_POST['sub_10'];
						$stbtyear=$_POST['year_9'];
						
						$gtbyr=$by->getBatch($index_10);
						
						
				if($stbtyear==$gtbyr){
						
						$_SESSION['std_10']=$index_10;
						$_SESSION['sub_10']=$sub_10;
					
						$con103=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						$student_10_3=$_SESSION['std_10'];

						$query10_2="select id, subject, grade, year from results where index_number='$index_10' and subject='$sub_10'";
						$res_mod=mysql_query($query10_2);
						
						if(mysql_num_rows($res_mod)!=0){
						echo '<table border="0" width="80%"><tr><th>Subject<th>Grade<th>Year<th>Modify</tr>';
						while($data=mysql_fetch_array($res_mod)){
						echo "<tr class=trbgc><td align='center'>".$data['subject']."<td align='center'>".$data['grade']."<td align='center'>".$data['year']."<td align='center'>";
						echo "<a href=?view=admin&admin=10&task=modify_res&id=".$data['id']."&stbyear=$stbtyear>Modify</a></tr>";
						
						}
						echo "</table>";
																	}
						else{
							echo"<br><font color='red'>Sorry!, Can not find result.</font>";
								}
						
						
										}
				else{
						echo"<br><font color='red'>( SC/$stbtyear/$index_10 ) Invalid student number ! Recheck student number.</font>";
					}	
						
						}
						
						// Modify Results
						elseif($task=='modify_res'){ 
						$con101=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						$styear=$_GET['stbyear'];
						$id=$_GET['id'];
						$student_10_2=$_SESSION['std_10'];
						$sub_10_2=$_SESSION['sub_10'];

						include 'forms/form_10_2.php';
						//unset($_SESSION['std_10']);

						}


?>
