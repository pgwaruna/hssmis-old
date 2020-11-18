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
echo$qpers['id'];
$quepers="SELECT id FROM permission WHERE role_id =$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
if($qpers['id']=="50"){
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


<script type="text/javascript" src="./Ajax/rmexreg.js"></script>

<?php
require_once('./classes/globalClass.php');
$n=new settings();

require_once('./classes/attClass.php');
$m=new attendence();


$acyart=$n->getAcc();
$getyr=explode("_",$acyart);
$yrpast=$getyr[0];
$ynezt=$getyr[1];
$yelast=$yrpast-6;

$crrseme=$n->getSemister();

/////////////////////////////////deatils of record update person/////////////////////
error_reporting(0);
$dtntm=date("Y-m-d/H:i");
$user=$_SESSION['user_id'];

$upuser=$user."/".$dtntm;

$ye2=explode("-",$dtntm);
$ye=$ye2[0];
/////////////////////////////////////////////////////////////////////////////////////





echo"Modifications of Student's Exam Eligibility";
echo"<hr class=bar>";

echo'<table border="0" cellspacing="1" class="bgc"><tr align="center"><td>';

echo"<form method=POST action='./index.php?view=admin&admin=50&task=chkel'>";
echo"Enter Student Number:&nbsp;&nbsp;";
echo"HS/<select name='ckelbt'>";
for($indx=0;$indx<10;$indx++){
	$olyr=$yrpast-$indx;
	echo"<option value='$olyr'>$olyr</option>";
}
echo"</select>/";

echo'<span id="number1">';
	echo'<input name="ckelstno" size="6">&nbsp;';
	echo'<span class="textfieldRequiredMsg"><font size="-1"> Enter a Index Number</font></span>';
	echo'<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>';
	echo'</span>';

echo"<input type=submit value='Submit'><br><font color=red>( Eg:- HS/2003/15291 )</font></form>";
echo'</table><br><br>';


if($task=="chkel"){
$subtsk=$_GET['subtsk'];

//echo$subtsk;
if($_POST['ckelstno']!=NULL){
$_SESSION['elst']=$_POST['ckelstno'];

$_SESSION['elstbt']=$_POST['ckelbt'];
			}
			
$elgst=$_SESSION['elst'];
$elgstbt=$_SESSION['elstbt'];
	

$stbt=$n->getBatch($elgst);
$stname=$n->getName($elgst);





$dept=$_SESSION['section'];
$role=$_SESSION['role'];

////////////////////////////////////////change eliligibility////////////////////////////////////////////////
if($subtsk=="modify"){
$coid2=$_POST['coid2'];

$queuptoel="update exam_registration set status=1 where id=$coid2 ";
mysql_query($queuptoel);
//echo$queuptoel;
$queupdtexdata="update exam_registration set Last_update='$upuser' where id=$coid2";
mysql_query($queupdtexdata);

}
//////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////cancel eliligibility////////////////////////////////////////////////
if($subtsk=="cancel"){
$coid=$_POST['coid'];

$queudcnseexr="update exam_registration set status=0 where id=$coid";	
mysql_query($queudcnseexr);
//echo$queudcnseexr;
$queupdtexdata="update exam_registration set Last_update='$upuser' where id=$coid";
mysql_query($queupdtexdata);

}
//////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////new registration with eligible/////////////////////////////////////
if($subtsk=="regwtelg"){
$regcos=$_POST['regcos'];
$rgdgst=$_POST['rgdgst'];


$queinsexrgnw="insert into exam_registration (std_id,course_code,academic_year,semester,course_type,status,Last_update) values('hs$elgst','$regcos','$acyart',$crrseme,'$rgdgst',1,'$upuser')";
//echo$queinsexrgnw;
mysql_query($queinsexrgnw);

}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

if($elgstbt==$stbt){////////////////////////////start change eligibility prosses////////////////////////////////////////////////



		echo"<font color='blue'> Current Eligibility Status of $stname ( HS/$elgstbt/$elgst )</font><br>";

		if(($role=="general")||($role=="office")){
			$queexcorse="select r.course,r.degree,c.name from registration r,courseunit c where r.student='hs$elgst' and r.acedemic_year='$acyart' and (r.semister=$crrseme or r.semister=3)  and r.course=c.code and c.department='$dept' and r.confirm=1 order by r.course";
			//echo$queexcorse;
								}
		if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
			$queexcorse="select r.course,r.degree,c.name from registration r,courseunit c where r.student='hs$elgst' and r.acedemic_year='$acyart' and (r.semister=$crrseme or r.semister=3)  and r.course=c.code and r.confirm=1 order by r.course";
			//echo$queexcorse;
											}

		
			$quexcorse=mysql_query($queexcorse);
            if(mysql_num_rows($quexcorse)==0){
                echo"<font color=red>Sorry! Can not find Course Registration Details";
            }
else {
	$elstrw=1;
        echo"<table border=0><tr>";
        echo"<th>#<th> Courese Unit</th><th>Course Name</th><th>Degree Status</th><th>Percentage of Attendence Participation </th><th>Current Status</th><th>Submission</th></tr>";
        
	
    

			while($qexcorse=mysql_fetch_array($quexcorse)){
				$course2=$qexcorse['course'];
				$course=strtoupper($course2);
				////////////////////////////////////////////////////////////////////////////////////////
                                $coursegetchr=trim($course2);
				////////////////////////////////////////////////////////////////////////////////////////
                
                $fulcode=strtoupper($coursegetchr);
                
                
                
                
				$degree=$qexcorse['degree'];
					if($degree=="Non Degree"){
						$stexmrgcstyp="Non Degree Course-(6)";
					}
					else{
						$stno="hs".$elgst;
						$stexmrgcstyp=$n->getcostype($coursegetchr,$stno);
					}

				$name=$qexcorse['name'];
				$stnoprgp="hs".$elgst;
				$practgp=$m->getprctgp($stnoprgp,$course,$acyart);
					////////////////////////////////////calculate attendence percentages of student////////////////////////////////////
						$quegtlctp="select distinct(type) from lecture where course='$course' and acc_year='$acyart'";
						//echo$quegtlctp;
						$qugtlctp=mysql_query($quegtlctp);
						$lectp = array();
						$totpe= array();
						$totpetot= array();
						$atpre= array();
						$i=0;
						if(mysql_num_rows($qugtlctp)!=0){
						
							while($qgtlctp=mysql_fetch_array($qugtlctp)){
							$gtlctp=$qgtlctp['type'];
							$lectp[$i]=$gtlctp;

							$totpe2=$m->getTotal($course, $stnoprgp, $gtlctp, $acyart);
							$totpe[$i]=$totpe2;

							$totpetot2=$m->getSubTotal($course, $gtlctp, $acyart,$practgp);
							$totpetot[$i]=$totpetot2;

							$atpre2=round(($totpe2/$totpetot2)*100);
							$atpre[$i]=$atpre2;

							$i++;



												}
												}
											
						else{
							$lectp[$i]="Not-Allocate";
							$i++;
							}

					///////////////////////////////////////////////////////////////////////////////////////////////////////////////////


				$quecngelg="select status,id from exam_registration where std_id='hs$elgst' and course_code='$course' and academic_year='$acyart' and semester=$crrseme";
				$qucngelg=mysql_query($quecngelg);
				if(mysql_num_rows($qucngelg)!=0){
					$qcngelg=mysql_fetch_array($qucngelg);
					$cnfno2=$qcngelg['status'];
						if($cnfno2==0){
							$cnfno="Not Confirmed";
								}
						elseif($cnfno2==1){
							$cnfno="<font color=blue>Eligible</font>";
								}
						else{
							$cnfno="<font color=red>Not Eligible</font>";
								}
					$cnfid=$qcngelg['id'];
						//echo$cnfno."<br>";





					if($cnfno2==1){
						echo"<form method=POST action='./index.php?view=admin&admin=50&task=chkel&subtsk=cancel'>";
						echo"<tr class=selectbg height=30px><td align='center'>$elstrw<td align='center'>$fulcode<input type=hidden name=coid value=$cnfid></td>";
						echo"<td>$name</td><td align='center'>$stexmrgcstyp</td><td>";
							for($j=0;$j<$i;$j++){
							
								if($lectp[$j]=="Not-Allocate"){
									echo"[ Attendence Not Included ]";
												}
								else{
									echo"[ ".$lectp[$j]." - ".$atpre[$j]."% ] ";
									}

									}



						echo"</td><td align='center'>$cnfno</td>";
						echo"<td align='center'><input type=submit name=cancel value=Cancel></td></tr></form>";				
							}
					elseif($cnfno2==2){
						echo"<form method=POST action='./index.php?view=admin&admin=50&task=chkel&subtsk=modify'>";
						echo"<tr class=trbgc height=30px><td align='center'>$elstrw<td align='center'>$fulcode<input type=hidden name=coid2 value=$cnfid></td>";
						echo"<td>$name</td><td align='center'>$stexmrgcstyp</td><td>";
							for($j=0;$j<$i;$j++){
								if($lectp[$j]=="Not-Allocate"){
									echo"[ Attendence Not Included ]";
												}
								else{
									echo"[ ".$lectp[$j]." - ".$atpre[$j]."% ] ";
									}


									}

						echo"</td><td align='center'>$cnfno</td>";
						echo"<td align='center'><input type=submit name=modify value=Eligible></td></tr></form>";
						}
					else{
						echo"<form method=POST action='./index.php?view=admin&admin=50&task=chkel&subtsk=modify'>";
						echo"<tr class=trbgc height=30px><td align='center'>$elstrw<td align='center'>$fulcode<input type=hidden name=coid2 value=$cnfid></td>";
						echo"<td>$name</td><td align='center'>$stexmrgcstyp</td><td>";
							for($j=0;$j<$i;$j++){
								if($lectp[$j]=="Not-Allocate"){
									echo"[ Attendence Not Included ]";
												}
								else{
									echo"[ ".$lectp[$j]." - ".$atpre[$j]."% ] ";
									}
									}
						echo"</td><td align='center'>$cnfno</td>";
						echo"<td align='center' width=20%><div id=$cnfid><input type=submit name=modify value='Eligible'><input type='button' name='regmod' value='Remove' onClick=removeexreg($cnfid)></div></td></tr></form>";
						}



								}
				else{
					//echo"not register to the subject";	
						echo"<form method=POST action='./index.php?view=admin&admin=50&task=chkel&subtsk=regwtelg'>";
						echo"<tr class=selectbg4 height=30px><td align='center'>$elstrw<td align='center'>$fulcode<input type=hidden name=regcos value=$course></td>";
						echo"<td>$name</td><td align='center'>$stexmrgcstyp<input type=hidden name=rgdgst value='$stexmrgcstyp'></td><td>";
							for($j=0;$j<$i;$j++){
								if($lectp[$j]=="Not-Allocate"){
									echo"[ Attendence Not Included ]";
												}
								else{
									echo"[ ".$lectp[$j]." - ".$atpre[$j]."% ] ";
									}
									}
						echo"</td><td align='center'><font color=red>* Not Register to the Examination</font></td>";
						echo"<td align='center'><input type=submit name=regwtelg value='Register & Eligible'></td></tr></form>";


	
					}

$elstrw++;


									}

			echo"</table>";
    }


		}/////////////////////////////////stop change eligibility prosses////////////////////////////////////////////////
else{
	echo"<font color='red'>HS/$elgstbt/$elgst is Invalid Student Number ! </font><br>";
	}

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








