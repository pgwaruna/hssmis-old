<?php
//error_reporting(0);
session_start();
if(($_SESSION['login'])=="truefohssmis"){


$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
//echo $querole;
$qurole=mysql_query($querole);

if($qurole!=NULL)
{
while($qrole=mysql_fetch_array($qurole)){
$roleid=$qrole['role_id'];
}
//echo$qpers['id'];
$quepers="SELECT id FROM permission WHERE role_id =$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
if($qpers['id']=="51"){
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

$user=$_SESSION['user_id'];
$role=$_SESSION['role'];

if(($role=="general")||($role=="office")){
$dept=$_SESSION['section'];
}

if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
$dept="all";
}
require_once('./classes/attClass.php');
require_once('./classes/globalClass.php');
$n=new settings();
$g=new attendence();

$acyart=$n->getAcc();


$getyr=explode("_",$acyart);

$nxyr=$getyr[1];
$cryr=$getyr[0];


$crrseme=$n->getSemister();

echo"Adding Excuses for Attendace to One Student";
echo"<hr class=bar>";


echo"<table class=bgc><tr align=center><td><br>";
echo"<form method=POST action='./index.php?view=admin&admin=51&task=setex'>";
echo"Enter Student Number:&nbsp;&nbsp;";
echo"HS/<select name='ckexsbt'>";
for($indx=0;$indx<10;$indx++){
	$olyr=$cryr-$indx;
	echo"<option value='$olyr'>$olyr</option>";
}
echo"</select>/";

echo'<span id="number1">';
	echo'<input name="excstno" size="6">&nbsp;';
	echo'<span class="textfieldRequiredMsg"><font size="-1"> Enter a index Number</font></span>';
	echo'<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>';
	echo'</span>';

echo"<input type=submit value='Submit'><br><font color=red>( Eg:- HS/2003/52911 )</font></form>";
echo"</table>";


if($task=="setex"){
$due=$_GET['due'];
$stbt=$_POST['ckexsbt'];
$excst=$_POST['excstno'];
//////////////////////////////////////// get student number//////////////////////////////////
		if($_POST['excstno']!=NULL){
		$_SESSION['excst']=$_POST['excstno'];

		$_SESSION['exctbt']=$_POST['ckexsbt'];
					}
////////////////////////////////////////////////////////////////////////////////////////////
$exstno=$_SESSION['excst'];
$exstbt=$_SESSION['exctbt'];
//echo$exstbt.$exstno.$stbt;


$stbt=$n->getBatch($exstno);
$stname=$n->getName($exstno);

	if($exstbt==$stbt){
		echo"<font color='blue'>Registered course unit for $acyart academic year and semester $crrseme<br>";
		echo"( $stname - HS/$exstbt/$exstno )</font><br>";

			if(($role=="general")||($role=="office")){
				$queexccos="select r.course, c.name,c.department from registration r,courseunit c where r.student='hs$exstno' and r.acedemic_year='$acyart' and (r.semister=$crrseme or r.semister=3) and r.confirm=1 and r.course=c.code and c.department='$dept' order by r.course";
				//echo$queexccos;
								}
			
			if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
				$queexccos="select r.course, c.name,c.department from registration r,courseunit c where r.student='hs$exstno' and r.acedemic_year='$acyart' and (r.semister=$crrseme or r.semister=3) and r.confirm=1 and r.course=c.code order by r.course";
				//echo$queexccos;							
												}
				$quexccos=mysql_query($queexccos);
				if(mysql_num_rows($quexccos)!=0){
			echo"<table border=0 width=100%><tr><th>Course Unit</th><th>Course Name</th><th>Modification</th></tr>";

				while($qexccos=mysql_fetch_array($quexccos)){
					$excors=$qexccos['course'];
                    ////////////////////////////////////////////////////////////////////////////////////////
                     $coursegetchr=trim($excors);
                           
                                $fulcode=strtoupper($coursegetchr);
                                
                                ////////////////////////////////////////////////////
                    
                    
                    
					$excorsnm=$qexccos['name'];
					$exdept=$qexccos['department'];
					echo"<tr class=trbgc height=25px><td align='center'>".$fulcode."</td><td>&nbsp; &nbsp;$excorsnm</td><td align='center'>[ <a href='index.php?view=admin&admin=51&task=setex&due=chng&exco=$excors'>Set Excuses for $fulcode</a> ]</td></tr>";
					

										}
			echo"</table>";
												}
			else{echo"<br><font color=red>Sorry! Can not find Course Registration Information.</font>";}
if($due=="chng"){
$exco=$_GET['exco'];
$subdue=$_GET['subdue'];
$excoid=$_GET['excoid'];

	if($dept=="all"){
		$access="yes";
			}
	else{
	$queckdep="select department from courseunit where code='$exco'";
	$quckdep=mysql_query($queckdep);
	$qckdep=mysql_fetch_array($quckdep);
	$ckdep=$qckdep['department'];
		if($dept==$ckdep){
			$access="yes";	
					}
		else{
			$access="no";
			}


		}

if($access=="yes"){////////////////change attendence/////////////////////////////////////////////////// 
//echo$exco.$exdept.$exstno;



//////////////////////////////////////////////////////set as excuses/////////////////////////////////////////////////////////////
	if($subdue=="excues"){
		
		$quechklecid="select lecture_id from lecture where course='$exco' and lecture_id=$excoid";
		$quchklecid=mysql_query($quechklecid);
		if(mysql_num_rows($quchklecid)!=0){
			//echo$excoid.$exco.$exstno;
			$queinsexco="insert into participation(student,lect_id,status) values('hs$exstno',$excoid,3)";
			mysql_query($queinsexco);

							}
		else{
		echo"<font color='red'>You have no permission to change this course unit.</font>";
			}

				}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////remove excuses/////////////////////////////////////////////////////////////
	if($subdue=="excancel"){

			$quechklecid="select lecture_id from lecture where course='$exco' and lecture_id=$excoid";
		$quchklecid=mysql_query($quechklecid);
		if(mysql_num_rows($quchklecid)!=0){
			//echo$excoid.$exco.$exstno;
			$quedelexco="delete from participation where student='hs$exstno' and lect_id=$excoid and status=3";
			mysql_query($quedelexco);

							}
		else{
		echo"<font color='red'>You have no permission to change this course unit.</font>";
			}
				}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




$stgp=$g->getprctgp($exstno,$exco,$acyart); 
	$quesetexatt="select * from lecture  where course='$exco' and acc_year='$acyart' order by date,time";
	//echo$quesetexatt;
	$qusetexatt=mysql_query($quesetexatt);
	if(mysql_num_rows($qusetexatt)!=0){
	echo"<font color='red'><h3>- Absent Attendance of $exco - </h3></font>";

	echo"<table border=0 width=100%><tr><th>Lecture ID<th>Date<th>Time<th>Hours<th>Type<th>Group<th>Submit</tr>";

	$i=0;
	while($qsetexatt=mysql_fetch_array($qusetexatt)){
	 
		$lectid=$qsetexatt['lecture_id'];
		$date=$qsetexatt['date'];
		$time=$qsetexatt['time'];
		$hours=$qsetexatt['hours'];
		$type=$qsetexatt['type'];
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$pgrp2=$qsetexatt['att_group'];
		
		if($pgrp2=="nogrp"){
			$pgrp="-";
			$grop="ng";
							}
		else{
			$pgrp=$pgrp2;
			$gtgrop=explode("-",$pgrp);
			$grop=$gtgrop[1];
			
			}
		
		
			$quegetatt="select status from participation where student='hs$exstno' and lect_id=$lectid";
															
			//echo$quegetatt."<br>";
			$qugetatt=mysql_query($quegetatt);
			
			
			if(($pgrp2=="nogrp")||($stgp=="$grop")||($stgp=="ng")){
				if(mysql_num_rows($qugetatt)==0){
					//echo$exco.$lectid.$date.$time.$hours.$type."0<br>";
					echo"<tr class=trbgc><td align='center'>$lectid<td align='center'>$date<td align='center'>$time<td align='center'>$hours<td align='center'>$type<td align='center'>$pgrp";
					echo"<td align='center'>[ <a href='index.php?view=admin&admin=51&task=setex&due=chng&subdue=excues&exco=$exco&excoid=$lectid'>Set as Excuse</a> ]</tr>";

					$i=$i+1;
								}
				else{
					$qgetatt=mysql_fetch_array($qugetatt);
						$stat=$qgetatt['status'];
						if($stat==3){
							echo"<tr class=selectbg><td align='center'>$lectid<td align='center'>$date<td align='center'>$time<td align='center'>$hours<td align='center'>$type<td align='center'>$pgrp";
							echo"<td align='center'><font color=red>(Set as Present)</font>&nbsp;&nbsp;&nbsp;&nbsp;[ <a href='index.php?view=admin&admin=51&task=setex&due=chng&subdue=excancel&exco=$exco&excoid=$lectid'>Cancel</a> ]</tr>";


								}
	
					}

																	}




					
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
								}//while
		if($i==0){
			echo"<tr class=selectbg4><td align='center' colspan=7> No Absent Attendence. </td></tr>";
			}
		echo"</table>";
						}
	else{
		echo"<br><font color='red'>Sorry ! Attendence of $exco is not install yet!</font><br>";
		}



			}/////////////change attendence if close////////////////////////////////////////
else{
echo"<font color='red'>You have no permission to change this course unit.</font><br>";
	}
}
				}//////////////Student batch confermation if
	else{
	echo"<font color='red'>HS/$exstbt/$exstno is Invalid Student Number ! </font><br>";
		}

}////////////task setex if









?>





<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>




