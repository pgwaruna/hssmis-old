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
if($qpers['id']=="16"){
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




<?php


	require_once('classes/attClass.php');
	require_once('classes/globalClass.php');		
	
	$m=new attendence();
	$n=new settings();	

	static $desition=1;
				


//...............get acc_year....................

$acc_year="select acedemic_year from acc_year where current='1'";
$ac_year=mysql_query($acc_year);
while($a_y=mysql_fetch_array($ac_year)){
$acy=$a_y['acedemic_year'];
}
//.................................................	
// ger semester.........................

$crrseme=$n->getSemister();

		
//Selecting courses to submit Medical

$userst=$_SESSION['user_id'];
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
$getstlvl=$n->getLevel($userst);
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
//if($getstlvl==1){
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////


	$task=$_GET['task'];
	if($task=='viewAtt'){
						
	$course=$_GET['course'];
	$user16=$_SESSION['user_id'];
						

						
				
	// Ending one by one 
						
	///////////////// Select Available Course Types related to Course /////////
	
	echo "Summery of Your Attendance <hr class=bar><br>";			
	

//...............get acc_year....................
$acc_year="select acedemic_year from acc_year where current='1'";
$ac_year=mysql_query($acc_year);
while($a_y=mysql_fetch_array($ac_year)){
$acy=$a_y['acedemic_year'];
}
//.................................................	

$practgp=$m->getprctgp($user16,$course,$acy);

	$query_4="select distinct type from lecture where course='$course' and acc_year='$acy'";
	//echo$query_4;
	$q4=mysql_query($query_4);

	if(mysql_num_rows($q4)!=0){	

	$divid=1;
	while($raw4=mysql_fetch_array($q4)){
	
	$a=$raw4['type'];
	echo '<font color=blue><b>Attendance of '.ucfirst($a).' - for '.$course.' Course Unit</b></font><br/><br/>';
	
	$total=$m->getTotal($course, $user16, $a, $acy);
	$ctotal=$m->getSubTotal($course, $a, $acy,$practgp);
	
	
	
	$cp=$total/$ctotal*100;

	$acc_year1=$n->getAcc();
	$max=$m->getMax($course,$a,$acc_year1);

	if($max=="nd"){

	echo 'Total Partcipated Hours : '.$total.'<br />';
	echo 'Total Lecture Hours : '.$ctotal.'<br /><br />';




	?>
	
	  
	<script type="text/javascript">

$(document).ready(function() {
	  $("#<?php echo 'a'.$divid;?>").progressbar({ value: <?php echo round($cp);?> });  });

</script>
 
  
  <div id="<?php echo 'a'.$divid;?>" style="width:70%;"></div><br />

	<?php 

}


		//echo '<font color=red>Your Available Percentage : '.round($cp).'&nbsp; %</font><br />';
		
		
		if($max=="nd"){
			$max=80;
				}
		if(!(isset($max)))
		$max=80;
		//echo '<font color=#736533 size=3px>Cut off Percentage : '.$max.'&nbsp; %</font><br />';
		echo '<font color=#736533 size=3px>Cut off Percentage : 80&nbsp;%</font><br />';
		
		if($desition!=0){
		if($cp>=$max)
		$desition=2;
		else
		$desition=0;
		}
		
   // echo "<hr class=bar>";
    $divid++;
	}
	
	

    ////////////////////////////////////////////////////////////////////////////
    

	
	if($desition==2){
		echo "<br /><img src=images/e.png><br /> <font color=blue size=4px>You are Eligible to sit exam for course unit</font>&nbsp;&nbsp;&nbsp;<br />";
		echo "(Note : This may be changed with changings of relevant department)";
	}
	else{
		echo "<br /><img src=images/n.png><br /> <font color=red size=4px>Sorry! you are Not Eligible to  sit exam for this course unit</font>&nbsp;&nbsp;&nbsp;<br />";
		echo "(Note : This may be changed with changings of relevant department)";
		
	}

	echo "<hr class=bar>";
	echo'<a href="index.php?view=admin&admin=16"><img src="./images/small/back.png"><br>&nbsp;Go Back&nbsp;</a><br><br>';
	
		}
/////////////////////////////////////////////////////////////////////////
	else{
		echo"Sorry! Can not View Exam Eligibility for  $course <br>";
		echo'<a href="index.php?view=admin&admin=16"><img src="./images/small/back.png"><br>&nbsp;Go Back&nbsp;</a><br><br>';
		}
///////////////////////////////////////////////////////////////////////////



	}
	else{

		///////////////////////check student passout or not/////////////////////////////////
		//............get st level...........................
		$stlvl=$n->getLevel($userst);
		//..................................................

		if($stlvl!=0){


				
	echo "Examination Eligibility of  the Course Unit<br>";
	echo"<hr class=bar>";
	
	$user16=$_SESSION['user_id'];
	$query_16="select r.course, c.name, c.department from registration r,courseunit c where r.course=c.code and r.student='$user16' and r.acedemic_year='$acy'  and (r.semister=$crrseme or r.semister=3) and r.confirm='1' order by r.course ";
	$q16=mysql_query($query_16);
	if(mysql_num_rows($q16)!=0){
				$sblsid=1;
	echo '<table border=0><th>#<th>Course Unit<th>Course Name<th>Department<th>Eligibility';
	while($raw4=mysql_fetch_array($q16)){
                                
              $elblcos=$raw4['course'];                  
////////////////////.........................................................///////////////////////////////////////                                
 ////////////////////////////////////////////////////////////////////////////////////////
            $coursegetchr=trim($elblcos);

                 $fulcode3=strtoupper($coursegetchr);
                               
 ////////////////////////////////////////////////////                               
                                
                                
                                
                                
	                        
                            
////////////////////.........................................................///////////////////////////////////////	                    
	                
	            
	 $getdeptnm=$raw4['department'];
        $lngdeptnm=$n->getdeptname($getdeptnm);       
	    
	echo '<tr class=trbgc height=25px><td align=center>'.$sblsid.'<td align=center>'.$fulcode3.'<td>&nbsp;'.$raw4['name'].'<td align=left>&nbsp;'.ucfirst($lngdeptnm).'<td align=center><a href=index.php?view=admin&admin=16&task=viewAtt&course='.$raw4['course'].'> Show Me </a>';
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
//echo'<font color="red" size="3">Note : Estimated eligibility viewer of HSS-MIS closed for students.....</font>';
//}
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
 
 //echo '<font color="red" size="3">Note : Estimated eligibility viewer of HSS-MIS closed for students.</font>';						
?>




<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>




