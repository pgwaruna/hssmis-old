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
if($qpers['id']=="96"){
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
echo "Assignment Eligibility Status<hr class=bar><br>";
		
//////////////edit by iranga ////////////////////////////////////////////////////
require_once('./classes/globalClass.php');
$vr96=new settings();
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

///////////////////////////check reg on/off/////////////////////////////////			
$queregst="select register from call_registration";
$quregst=mysql_query($queregst);
$qregst=mysql_fetch_array($quregst);
$regst=$qregst['register'];
//////////////////////////////////////////////////////////////////////////


$query_21_8="select distinct semister from level";
$attL=mysql_query($query_21_8);
while($find_semiL=mysql_fetch_array($attL)){
$find_L=$find_semiL['semister'];
}

///////////////////////////////////////////task8////////////////////////////////////////////////////
$task8=$_GET['task8'];
$getcsmdm=$_GET['mdm'];
if($getcsmdm==null){
	$getcsmdm="SI";
}	

// View attendences Available

if($task8=='attendence'){

$fmviweque="$rmsdb.fohssmisStudents fs";
$sub_21=$_GET['sub'];
echo"<div align='right'>";
echo"[ <a href='index.php?view=admin&admin=96'>Back to Subjects List</a> ]";
echo"</div>";
echo "<font color=red>Current Registration of ".strtoupper($sub_21)."</font> ";

if($getcsmdm=="SI"){
	$getcsmdmshw="Sinhala";
}
elseif($getcsmdm=="EN"){
		$getcsmdmshw="English";
}
elseif($getcsmdm=="TA"){
		$getcsmdmshw="Tamil";
}
else{
		$getcsmdmshw=$getcsmdm;
}

if($getcsmdm!=null){
	echo"<font color=red> in $getcsmdmshw Medium</font>";
}
echo"<br>";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//...............insert accyear validation..by iranga........
if($regst==0){	
    $query_21_9="select count(distinct r.student) from registration r, student s, $fmviweque where s.id=r.student and r.course = '$sub_21' and r.acedemic_year='$acy' and r.student=fs.user_name and r.confirm='1' and s.medium='$getcsmdm'";
		}
else{
$query_21_9="select count(distinct r.student) from registration r, student s, $fmviweque where s.id=r.student and r.course = '$sub_21' and r.acedemic_year='$acy' and r.student=fs.user_name and s.medium='$getcsmdm' ";
	}

  	$oce2=mysql_query($query_21_9);
	while($data3=mysql_fetch_array($oce2)){
    echo '<br /> <font color="green">Number of Students Register : <b>';
        if($newst=="yes"){
        echo$stcnt;
                }
    else{
      echo $student_select=$data3['count(distinct r.student)'];
        }
    echo '</b></font><br><br>';
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////
////////////////////////////
$quehtl1ns1="select level, semister from courseunit where code='$sub_21'";

$quhtl1ns1=mysql_query($quehtl1ns1);
while($qhtl1ns1=mysql_fetch_array($quhtl1ns1)){
    $coslvl=$qhtl1ns1['level'];
    $cossem=$qhtl1ns1['semister'];
                        }
if(($coslvl==1)&&(($cossem==1)||($cossem==3))){
///////////////////////////check reg on/off/////////////////////////////////            
$queregst2="select status from  call_combination";
$quregst2=mysql_query($queregst2);
$qregst2=mysql_fetch_array($quregst2);
$regst2=$qregst2['status'];
//////////////////////////////////////////////////////////////////////////

    if($regst2==1){
        $jonque="$rmsdb.fohssmis u";
        $query_21_8="select distinct r.student, u.l_name, u.initials from registration r, $jonque, $fmviweque where u.user=r.student and r.course ='$sub_21' and r.acedemic_year='$acy' and r.student=fs.user_name  order by u.user";
  
    $newst="yes";
            }
    else{
    $query_21_8="select distinct r.student, s.l_name, s.initials, s.year from registration r, student s, $fmviweque where s.id=r.student and r.course = '$sub_21' and r.acedemic_year='$acy' and r.student=fs.user_name  and r.confirm='1' and s.medium='$getcsmdm' order by r.student";

        }


                }
    else{
    //...............insert accyear validation..by iranga........

    if($regst==0){  
    $query_21_8="select distinct r.student, s.l_name, s.initials, s.year from registration r, student s, $fmviweque where s.id=r.student and r.course = '$sub_21' and r.acedemic_year='$acy' and r.student=fs.user_name  and r.confirm='1'  and s.medium='$getcsmdm'order by r.student";
            }
    else{
    $query_21_8="select distinct r.student, s.l_name, s.initials, s.year from registration r, student s, $fmviweque where s.id=r.student and r.course = '$sub_21' and r.acedemic_year='$acy' and r.student=fs.user_name and s.medium='$getcsmdm'  order by r.student";
        }
/////////////////////////////////////////////////////////////
        }

/////////////////////////

	//echo$query_21_8;
    $stcnt=0;
  	$oce=mysql_query($query_21_8);
    if(mysql_num_rows($oce)!=0){
		echo"<b><font color=blue size=3px>-- Please consider to submit Not Eligible student only ! --</font></b>";
		
	/////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////
	$getvrnebl=$_GET['nebl'];
	if($getvrnebl=="set"){
		$getasssubbtn=$_POST['asssubbtn'];
		////////////////////////////////
		if($getasssubbtn=="Cancel"){
			$getrmaseliid=$_POST['rmaseliid'];
			
			$quecnclntely="delete from assignment_eligibility where ass_id=$getrmaseliid";
			$qucnclntely=mysql_query($quecnclntely);
			
		}
		////////////////////////////////
		
		////////////////////////////////
		if($getasssubbtn=="Not Eligible"){
			$getasnelist=$_POST['asnelist'];
			$getasnelics=$_POST['asnelics'];
			$getasnelicsmdm=$_POST['asnelicsmdm'];

			$queinsnotelyrcd="insert into assignment_eligibility(stu_no,course,medium,ac_year,status) values ('$getasnelist','$getasnelics','$getasnelicsmdm','$acy','NE')";
			$quinsnotelyrcd=mysql_query($queinsnotelyrcd);

			
		}		
		///////////////////////////////
	
	
	}
	/////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////		
		
	
        echo '<table>';
	echo"<tr><th>#<th>Name with Initials<th>Student Number";
	//echo"<th>Assignment 1<th>Assignment 2<th>Assignment 3<th>Assignment 4";
	echo"<th>Final Eligibility<th>Submission</tr>";
	while($data2=mysql_fetch_array($oce)){
	    $stcnt++;

	echo '<tr class="trbgc" height=25px>';		
	
	echo"<form method=post action='./index.php?view=admin&admin=96&sub=$sub_21&task8=attendence&mdm=$getcsmdm&nebl=set'>";
	echo "<td align=center>$stcnt<td>".$data2['l_name']." ".$data2['initials']."<td align='center'>";
	$tmpstno=$data2['student'];
	$stprmtnum=$vr96->getStudentNumber($tmpstno); 
	
		echo$stprmtnum;
	
	
	$student_select=$data2['student'];
	/// Student Registration Information
	
	//echo"<td>&nbsp;";
	//echo"<td>&nbsp;";
	//echo"<td>&nbsp;";
	//echo"<td>&nbsp;";
	

	$quegetasselyst="select ass_id from assignment_eligibility where stu_no='$tmpstno' and course='$sub_21' and medium='$getcsmdm' and ac_year='$acy'";
	//echo$quegetasselyst;
	$qugetasselyst=mysql_query($quegetasselyst);
	
	if(mysql_num_rows($qugetasselyst)!=0){
		while($qgetasselyst=mysql_fetch_array($qugetasselyst)){
			$getasselyst=$qgetasselyst['ass_id'];
		}
		echo"<td align=center class=selecttdbg>";
		echo"<font color=red><b>Not Eligible</b></font>";
		echo"<td align=center class=selecttdbg>";
		echo"<input type=hidden name=rmaseliid value=$getasselyst>";
		echo"<input type=submit name=asssubbtn value='Cancel'>";
	}
	else{
		echo"<td align=center>&nbsp;";
		
		echo"<td align=center>";
		echo"<input type=hidden name=asnelist value=$tmpstno>";
		echo"<input type=hidden name=asnelics value=$sub_21>";
		echo"<input type=hidden name=asnelicsmdm value=$getcsmdm>";
		echo"<input type=submit name=asssubbtn  value='Not Eligible'>";
	}

	echo"</form>";
	
	// End Student Registration Information	
	
	}
	
	
	echo "</table>";
    }
    else{
    echo"Sorry! there are no registered student found<br>";
}


echo '<br><hr class=bar>';		

////////////////////////////
////////////////////////////
}



///////////////////////////////////////end task8////////////////////////////////////////////////////











////////////////////////////////////////////////////////////////////////////////////
if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
$query_21_1="select code, name,stream,medium from courseunit where availability=1 and (semister=$find_L or semister=3) order by code,name";
                                                                    }
elseif(($role=="general")||($role=="office")){
$query_21_1="select code, name,stream,medium from courseunit where department='$dept_id'  and availability=1 and (semister=$find_L or semister=3)  order by code,name";
}
else{
$query_21_1="select code, name,stream,medium from courseunit where (coordinator='$rltduser' or lecturers LIKE '%[$rltduser]%')   and availability=1 and (semister=$find_L or semister=3)  order by code,name";	
}


//echo$query_21_1;
$att=mysql_query($query_21_1);
$cutbl=1;
if(mysql_num_rows($att)!=0){
echo "You have following course units to set assignment eligibility status <table><th>#<th>Course Unit<th>Course Name<th>Stream<th>Medium";
while($attdata=mysql_fetch_array($att)){
        $allcose=$attdata['code'];
		$coursegetchr=trim($allcose);
                 
  $fulcode3=strtoupper($coursegetchr);     

$stream=$attdata['stream'];
$medium=$attdata['medium'];  

 //////////////////////.............................////////////////////////////// 
echo '<tr  align=center  class="trbgc" height=25px><td>'.$cutbl.'<td>';

$swcd=$attdata['code'];
if($medium!="SI+EN"){
	echo"<a href=index.php?view=admin&admin=96&sub=$swcd&task8=attendence&mdm=$medium>$fulcode3</a>";
}
else{
	echo"<table border=0>";
	echo"<tr class=selectbg height=25px><td><a href=index.php?view=admin&admin=96&sub=$swcd&task8=attendence&mdm=SI>$fulcode3 - Sinhala</a>";
	echo"<tr class=selectbg height=25px><td><a href=index.php?view=admin&admin=96&sub=$swcd&task8=attendence&mdm=EN>$fulcode3 - English</a>";
	echo"</table>";
}
echo"<td align=left>&nbsp;&nbsp;".ucfirst($attdata['name'])."<td>$stream<td>$medium";
$cutbl++;

}
mysql_close($con21_1);
echo "</table>";
}
else{
	echo"Sorry! Can not find course unit to view registration for you<br>";
}
		
echo '<br><hr class=bar>';	
///////////////////////////////////////////////////////////////////////////////////////						


						
						
						

?>















<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>


