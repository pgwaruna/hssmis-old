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
if($qpers['id']=="28"){
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











<script type="text/javascript" src="./Ajax/att_edit.js"></script>

<script type="text/javascript"> 

var win=null;
function NewWindow(mypage,myname,w,h,scroll,pos){
if(pos=="random"){LeftPosition=(screen.width)?Math.floor(Math.random()*(screen.width-w)):100;TopPosition=(screen.height)?Math.floor(Math.random()*((screen.height-h)-75)):100;}
if(pos=="center"){LeftPosition=(screen.width)?(screen.width-w)/2:100;TopPosition=(screen.height)?(screen.height-h)/2:100;}
else if((pos!="center" && pos!="random") || pos==null){LeftPosition=0;TopPosition=20}
settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',location=yes,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
win=window.open(mypage,myname,settings);}
</script>



<?php
echo "Submit Student Daily Attendence <hr class=bar><br>";
include'./admin/config.php';						
require_once('./classes/attClass.php');		
$k=new attendence();


//////////////edit by iranga ////////////////////////////////////////////////////
require_once('./classes/globalClass.php');
$vr28=new settings();
/////////////////////////////////////////////////////////////////////////////////							

$role=$_SESSION['role'];									
$dept_id=$_SESSION['section'];
$rltduser=$_SESSION['user_id'];						


//...............edit by iranga....................
$acc_year="select acedemic_year from acc_year where current='1'";
$ac_year=mysql_query($acc_year);
while($a_y=mysql_fetch_array($ac_year)){
$acy=$a_y['acedemic_year'];
}
//.................................................	
						
$query_21_8="select distinct semister from level";
$attL=mysql_query($query_21_8);
while($find_semiL=mysql_fetch_array($attL)){
$find_L=$find_semiL['semister'];
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*if($find_L==1)
$query_21_1="select code, name from courseunit where department='$dept_id' and (semister=1 or semister=3) and availability=1 order by code,name";
elseif($find_L==2)
$query_21_1="select code, name from courseunit where department='$dept_id' and (semister=2 or semister=3) and availability=1 order by code,name";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/

//////////////------------------------------------------------------------------------------------------------------------------------/////////////////
$curriculum=intval($_SESSION['curriculum']);

if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
$query_21_1="select code, name from courseunit where availability=1 and (semister=$find_L or semister=3) and by_low_version=$curriculum order by code,name";
                                                                    }
elseif(($role=="general")||($role=="office")){
$query_21_1="select code, name from courseunit where department='$dept_id'  and availability=1 and (semister=$find_L or semister=3) and by_low_version=$curriculum order by code,name";
}
else{
$query_21_1="select code, name from courseunit where (coordinator='$rltduser' or lecturers LIKE '%[$rltduser]%')   and availability=1 and (semister=$find_L or semister=3) and by_low_version=$curriculum order by code,name";
}

//////////////------------------------------------------------------------------------------------------------------------------------/////////////////





$att=mysql_query($query_21_1);
$cutbl=1;	
if((($_GET['task0'])!=attendence)&&(($_GET['task1'])!=attendence)&&(($_GET['task2'])!=dailyAtt)&&(($_GET['task2'])!='Removethis')){
				
echo "<font>You have following subjects to submit attendence </font> <table><th>#<th>Course Unit<th>Course Name";
while($attdata=mysql_fetch_array($att)){
    $allcose=$attdata['code'];
		$coursegetchr=trim($allcose);
                 
  $fulcode3=strtoupper($coursegetchr);            
            
        
    
echo '<tr align="center" class="trbgc" height=25px><td>'.$cutbl;
/////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////
echo '<td><a href="index.php?view=admin&admin=28&attdisp=displayatt&sub='.$attdata['code'].'&task0=attendence"';

?>


onclick="NewWindow(this.href,'mywin','1200','600','yes','center');return false" 

<?php

echo ">".$fulcode3."</a>";
echo "<td align='left'> &nbsp;".ucfirst($attdata['name']);
$cutbl++;
}
						
						

echo "</table>";

}
						
						
						
echo '<br>';	
						

//Selecting Date and Hours
$task0=$_GET['task0'];
if($task0=='attendence'){
$sub_21=$_GET['sub'];
include 'forms/form_28_0.php';
						
}
						
						
			
$data=$_GET['data'];
$task2=$_GET['task2'];
if($task2=='dailyAtt'){
				
if(($_GET['submiting'])!=ok)
{
include 'forms/form_28.php';
}
					
}




/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
//////////////////// Remove Lecture ID //////////////////////////
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////



if($task2=='Removethis'){
$l_id_remove=$_GET['id'];

$query_R="delete from lecture where lecture_id='$l_id_remove'";
$removing=mysql_query($query_R);				

if($removing){
echo '<br />Lecture ID removed Successfully';
echo '<br /><p>Close This Window <a href="javascript:window.close()"><img border="0" src="images/small/emblem-nowrite.png"></a></p>';

}
else
echo '<br />Cannot Remove. Contact Administrator to Remove this ID';				
}
						


/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
//////////////////// Remove Lecture ID //////////////////////////
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////


						
// Adding Attendence Data To the Table
						
if(($data=='input')&&(isset($_POST['att_submit']))){
$count_val=$_POST['count_val'];
$lect_id=$_POST['lect_id'];
						
						
// Add Daily Attendence
																												

$j=1;
while($j<($count_val)){
$x=$_POST[$j];
if(isset($x)){
$query_21_2="insert into participation values('$x','$lect_id','1')";
//echo$query_21_2;
}
$j++;
$result=mysql_query($query_21_2);
}
						
					
						
						
	$lect_id_edit=$_GET['id'];
	
	///////////////////////////////////////////////
	//////////// Get Subject ID from lect id //////
	///////////////////////////////////////////////
	


	$k=new attendence();
	echo $sub=$k->getSubject($lect_id_edit);
	echo ' -';
	echo "&nbsp;|&nbsp;Date : ".$k->getLectDate($lect_id_edit)."&nbsp;|&nbsp;&nbsp;Time : ".$k->getLectTime($lect_id_edit)."&nbsp;|&nbsp;&nbsp;Type : ".$k->getLectType($lect_id_edit)."&nbsp;|&nbsp;&nbsp;Hours : ".$k->getLectHours($lect_id_edit);
	echo '<br /> Total Present Students :  <font color=red><div id="count_now"> || '.$k->countPre($lect_id_edit).'  ||</div></font> Number of Registered Students : <font color=green>'.$k->countStd($sub,$acy).'</font></br >';
	
	echo '</br >';
						
	

	/*
	$k=new attendence();
	$sub=$k->getSubject($lect_id_edit);
	echo '<br />|| Note : <font color=red>'.$k->countPre($lect_id_edit).' </font> Student Present / out of <font color=green>'.$k->countStd($sub).'</font>. ||</br >';
	echo '<br />Following Data Added into Database </br ></br >';
	*/
						
	
	///////////////////////////////////////////////
	///////////////////////////////////////////////
	///////////////////////////////////////////////
	
	
    echo 'Close This Window <a href="javascript:window.close()"><img border="0" src="images/small/emblem-nowrite.png"></a>';
    echo 'Reload This Page  <a href="index.php?view=admin&admin=30&attdisp=displayatt&id='.$lect_id_edit.'&back=f28"><img border="0" src="images/small/edit-redo.png"></a>';

	echo '<table bordercolor="#006600" border="1"><tr><th>#<th>Name with Initials<th>Student Number<th>Status</tr>';
	$fmviweque="$rmsdb.fohssmisStudents fs";
	$query_21_8="select distinct r.student, concat(s.l_name,s.initials) as s_name, s.year from registration r, student s, $fmviweque where s.id=r.student and r.course = '$sub' and r.acedemic_year='$acy' and r.confirm='1' and r.student=fs.user_name order by r.student";
  	//echo$query_21_8;
  	$oce=mysql_query($query_21_8);
    $rw=1;
	while($data2=mysql_fetch_array($oce)){
	echo '<tr><td align=center>'.$rw;
	echo "<td>".$data2['s_name']."<td align=center>";
	$tmpstno2=$data2['student'];
	$stprmtnum2=$vr28->getStudentNumber($tmpstno2); 
	
		echo$stprmtnum2;

	
	$student_select=$data2['student'];
	
	
	//////////////////////////////////////////////////
	//////////////////////////////////////////////////
	//////////////////////////////////////////////////
	echo '<td>';
	//echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	//echo '<div id=".$lect_id_edit.'-att-'.$student_select.">';

	if($status5==2)
	echo 'Med';
	else{
	echo '<div id="'.$lect_id_edit.'-att-'.$student_select.'">'.$status5=$k->getAtt($lect_id_edit, $student_select);
        
	if(($status5==0)||($status5==1)){
	echo '&nbsp;&nbsp;<img src="images/conf.png" id="'.$lect_id_edit.'-img-'.$student_select.'" onclick=changeAtt('.$lect_id_edit.',"'.$student_select.'",'.$status5.')></div>';
	
	
	}
	}

   // echo '</div>';
    //////////////////////////////////////////////////
    //////////////////////////////////////////////////
    //////////////////////////////////////////////////


	
	
	// End Student Registration Information	
	$rw++;
	}
	echo '</table>';
	}
	

?>













<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>

