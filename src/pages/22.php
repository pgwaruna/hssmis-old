<?php
//error_reporting(0);
session_start();
if(($_SESSION['login'])=="truefohssmis"){


$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
//echo $querole;
$qurole=mysql_query($querole) or die(mysql_error());

if($qurole!=NULL)
{
while($qrole=mysql_fetch_array($qurole)){
$roleid=$qrole['role_id'];
}
echo$qpers['role_id'];
$quepers="SELECT id FROM permission WHERE role_id =$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
if($qpers['id']=="22"){
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
?>







<!--.................comment by iranga..and remove next seme........-->

<?php

//...............get acc_year....................
$acc_year="select acedemic_year from acc_year where current='1'";
$ac_year=mysql_query($acc_year);
while($a_y=mysql_fetch_array($ac_year)){
$acy=$a_y['acedemic_year'];
}
//.................................................	

//get semester.................
$querysem="select distinct semister from level";
$qusem=mysql_query($querysem);
while($find_semi=mysql_fetch_array($qusem)){
$finds=$find_semi['semister'];
}
//...............................

echo "View your daily attendance <hr class=bar><br>";
	
	require_once('classes/attClass.php');		
	$m=new attendence();
					
	require_once('classes/globalClass.php');
	$n=new settings();
					
//Selecting courses to submit Medical
$userstat=$_SESSION['user_id'];


////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
$getstlvl=$n->getLevel($userstat);
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
//if($getstlvl==1){
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////






///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$task=$_GET['task'];
	if($task=='viewAtt'){
						
	$course=$_GET['course'];
	$user22=$_SESSION['user_id'];
						
//View Daily one by one attendence 

$practgp=$m->getprctgp($user22,$course,$acy);

	echo "Course : ".$course."<br />";
	
	$query_AA="select lecture_id, date, hours, time, type, att_group from lecture where course='$course' and acc_year='$acy' group by lecture_id order by date,time,lecture_id";
	//echo$query_AA;
	$q22=mysql_query($query_AA);

	if(mysql_num_rows($q22)!=0){
		
	echo '<table border="0" width="70%">';
	echo '<th>L id<th>Date<th>Hours<th>Type<th>Time<th>Group<th>Status';
	$exptnonew="nil";
	$allperspract=array();
	$p=0;
	while($rawAA=mysql_fetch_array($q22)){
		$att_group2=$rawAA['att_group'];
			$lect_id=$rawAA['lecture_id'];
		if($att_group2!="nogrp"){
				$att_group=$att_group2;
				$setexptno=explode('-',$att_group2);
					$exptno=$setexptno[0];
					$stpgp=$setexptno[1];
						$status=$m->getAtt($lect_id, $user22);
				
	
					if($exptno!=$exptnonew){
							if($status!=0){					
									//echo$lect_id."if-".$att_group2."---".$status."<br>";
								if (!(in_array("$att_group2", $allperspract))) {
									$allperspract[$p]="$att_group2";
														
								echo "<tr class=trbgc align=center>";
									echo "<td>".$lect_id."<td>".$rawAA['date']."<td align=center>".$rawAA['hours']."<td>".ucfirst($rawAA['type'])."<td>".$rawAA['time']."<td align=center>$att_group2<td align=center>";								
								
														if($status==0)
														echo 'Absent';
														elseif($status==1)
														echo 'Present';
														elseif($status==2)
														echo 'Medical';
														elseif($status==3)
														echo 'Excuse';

																			
								echo "</tr>";								
											}
					
									
									$quegetotgp="select * from lecture where att_group <>'$att_group2' and att_group LIKE '$exptno%' and course='$course' and acc_year='$acy'";
									$qugetotgp=mysql_query($quegetotgp);
									if(mysql_num_rows($qugetotgp)!=0){
									while($qgetotgp=mysql_fetch_array($qugetotgp)){
											$chkgplid=$qgetotgp['lecture_id'];
											$getotgp=$qgetotgp['att_group'];
											$date=$qgetotgp['date'];
											$hours=$qgetotgp['hours'];
											$time=$qgetotgp['time'];
											$type=$qgetotgp['type'];
											
											
											$nwstatus=$m->getAtt($chkgplid, $user22);
										if($nwstatus!=0){
											$wp=$p+1;
											if (!(in_array("$getotgp", $allperspract))) {
												$allperspract[$wp]=$getotgp;
																	
											//echo$chkgplid."ifm-".$getotgp."--".$nwstatus."<br>";
											// enter wrong participation group
												echo "<tr class=trbgc align=center>";
															echo "<td>".$chkgplid."<td>".$date."<td align=center>".$hours."<td>".ucfirst($type)."<td>".$time."<td align=center>$getotgp<td align=center>";								
									
															if($nwstatus==0)
															echo 'Absent';
															elseif($nwstatus==1)
															echo 'Present';
															elseif($nwstatus==2)
															echo 'Medical';
															elseif($nwstatus==3)
															echo 'Excuse';

																				
												echo "</tr>";
											$p=$wp+1;
															}


																	}
																				
																					}
									
									
																		}
								$p=$p+1;
									
									
											}
							else{
														
									$quegetotgp="select * from lecture where att_group <>'$att_group2' and att_group LIKE '$exptno%' and course='$course' and acc_year='$acy'";
	
									$qugetotgp=mysql_query($quegetotgp);
									if(mysql_num_rows($qugetotgp)!=0){
									while($qgetotgp=mysql_fetch_array($qugetotgp)){
											$chkgplid=$qgetotgp['lecture_id'];
											$getotgp=$qgetotgp['att_group'];
											$date=$qgetotgp['date'];
											$hours=$qgetotgp['hours'];
											$time=$qgetotgp['time'];
											$type=$qgetotgp['type'];
											
											$nwstatus=$m->getAtt($chkgplid, $user22);
											if($nwstatus!=0){
												//echo$chkgplid."es1-".$getotgp."--".$nwstatus."<br>";
											if (!(in_array("$getotgp", $allperspract))) {
												
												echo "<tr class=trbgc align=center>";
															echo "<td>".$chkgplid."<td>".$date."<td align=center>".$hours."<td>".ucfirst($type)."<td>".$time."<td align=center>$getotgp<td align=center>";								
									
															if($nwstatus==0)
															echo 'Absent';
															elseif($nwstatus==1)
															echo 'Present';
															elseif($nwstatus==2)
															echo 'Medical';
															elseif($nwstatus==3)
															echo 'Excuse';

																				
												echo "</tr>";
																}
															}
											else{	
											//echo$chkgplid."es0-".$getotgp."--".$nwstatus."ab<br>";
											//absent experiment
											
											
												if($stpgp=="$practgp"){
													echo "<tr class=trbgc align=center>";
															echo "<td>".$chkgplid."<td>".$date."<td align=center>".$hours."<td>".ucfirst($type)."<td>".$time."<td align=center>$exptno"."-".$stpgp."<td align=center>";								
									
															if($nwstatus==0)
															echo 'Absent';
															elseif($nwstatus==1)
															echo 'Present';
															elseif($nwstatus==2)
															echo 'Medical';
															elseif($nwstatus==3)
															echo 'Excuse';
													echo "</tr>";

															}
												else{
															//echo"<td colspan=7 align=center>Absent ".ucfirst($type)." [ Expt. No is: $exptno ]";
													continue;
													}
																				
												
											
											
											
											
											
											
											
											
											
											
											
												}										
															}
																		}
									}
					
												}
					
					
					$exptnonew=$exptno;
		
									}
		else{
				$att_group="No Group";
					echo "<tr class=trbgc align=center>";
							echo "<td>".$rawAA['lecture_id']."<td>".$rawAA['date']."<td align=center>".$rawAA['hours']."<td>".ucfirst($rawAA['type'])."<td>".$rawAA['time']."<td align=center>-<td align=center>";
												
												
						//////////////////////////////
						//////////////////////////////
						//////////////////////////////

							$lect_id=$rawAA['lecture_id'];
							
							$status=$m->getAtt($lect_id, $user22);
							
							if($status==0)
							echo 'Absent';
							elseif($status==1)
							echo 'Present';
							elseif($status==2)
							echo 'Medical';
							elseif($status==3)
							echo 'Excuse';

						/////////////////////////////
						//////////////////////////////
						//////////////////////////////
				
				
				
				
				
				
				
			}
			
			
			
			
			
			
			
			
			
			
		

	
						
	}
	echo '</table><br><br>';

			//for($k=0;$k<12;$k++){
				//echo$allperspract[$k]."--";
				//		}			
				
	//Ending one by one 
						
	///////////////// Select Available Course Types related to Course /////////
	


	
				
	
	$query_4="select distinct type from lecture where course='$course' and acc_year='$acy'";
	//echo$query_4;
	$q4=mysql_query($query_4);
	$divid=1;
	
	
	while($raw4=mysql_fetch_array($q4)){
	
	$a=$raw4['type'];
	$max=$m->getMax($course,$a,$acy);
	if($max=="nd"){
	echo "<hr class=bar>Summary of Your Attendance <hr class=bar><br>";
	echo '<font color=blue><b>Attendance of '.ucfirst($a).' - for '.$course.' Course Unit</b></font><br/><br/>';
	
	$total=$m->getTotal($course, $user22, $a, $acy);
	$ctotal=$m->getSubTotal($course, $a, $acy,$practgp);
	
	echo 'Total Partcipated Hours : '.$total.'<br />';
	echo 'Total Hours : '.$ctotal.'<br /><br />';
	
	$cp=$total/$ctotal*100;
	
	?>
	<script type="text/javascript">

$(document).ready(function() {
	  $("#<?php echo 'a'.$divid;?>").progressbar({ value: <?php echo round($cp);?> });  });

</script>
<!--///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////
.................comment remove by iranga.. and commnet next seme..........
///////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////-->



 <!--////////////////////remove conetnex -->

  <div id="<?php echo 'a'.$divid;?>" style="width:70%;"></div><br />
	
	<?php 
		//echo '<font color=red>Current Percentage : '.round($cp).'&nbsp; %</font><br />';
	
    echo "<hr class=bar>";
    $divid++;
	}
	}
	/////////////////end  Select Available Course Types related to Course /////////

    ////////////////////////////////////////////////////////////////////////////
    
	echo '<a href="index.php?view=admin&admin=22"><img src="./images/small/back.png"><br>&nbsp;Go Back&nbsp;</a>';
///////////////////////////////////////////////////////////
		}
	else{
		echo"Sorry! Can not find your daily attendance<br>";
		echo '<a href="index.php?view=admin&admin=22"><img src="./images/small/back.png"><br>&nbsp;Go Back&nbsp;</a>';

		}
//////////////////////////////////////////////////////////
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	else{
		///////////////////////check student passout or not/////////////////////////////////
		//............get st level...........................
		$stlvl=$n->getLevel($userstat);
		//..................................................

		if($stlvl!=0){




		
	//echo "Select the course unit for view attendance<br>";
	
	$user22=$_SESSION['user_id'];
	$query_22="select r.course, c.name, c.department from registration r,courseunit c where r.course=c.code and r.student='$user22' and r.acedemic_year='$acy' and (r.semister=$finds or r.semister=3 ) and r.confirm='1' order by r.course";
	//echo$query_22;
	$q22=mysql_query($query_22);
	if(mysql_num_rows($q22)!=0){
		$sblsid=1;
	echo '<table border=0><th>#<th>Course Unit<th>Course Name<th>Department<th>Attendance';
	while($raw4=mysql_fetch_array($q22)){
	    $attcos=$raw4['course'];
        //////////////////////.................................///////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////
            $coursegetchr=trim($attcos);
            
                $fulcode3=strtoupper($coursegetchr);
                               
        ////////////////////////////////////////////////////
        
        
        
        //////////////////////.................................///////////////////////////////
        
       $getdeptnm=$raw4['department'];
        $lngdeptnm=$n->getdeptname($getdeptnm);
        
	echo '<tr class=trbgc height=25px><td align=center>'.$sblsid.'<td align=center>'.$fulcode3.'<td>'.$raw4['name'].'<td align=left>&nbsp;'.ucfirst($lngdeptnm).'<td align=center><a href=index.php?view=admin&admin=22&task=viewAtt&course='.$raw4['course'].'> Show </a>';
	$sblsid++;
	}
	echo '</table></font>';
					}
	else{
		echo"<font color='red'>Sorry!You have not registered to any subject for this semester.</font>"; 
		}	


		}	///check level if

	else{
		echo '<font color="red"> Sorry!  This option is not available for you.</font><br>';

		}
////////////////////////////////////////////////////////////////////////////////////////////////






	}



////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////stop dispaly for lvl2&3/////////////////////////////////////////////
//}
//else{
//echo'<font color="red" size="3">Note : Daily Attendance viewer of HSS-MIS closed for students.....</font>';
//}
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////


//echo '<font color="red" size="3">Note : Daily Attendance viewer of HSS-MIS closed for students.</font><br>';


 						
?>






<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>



