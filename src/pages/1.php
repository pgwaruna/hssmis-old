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
//echo$qpers['id'];
$quepers="SELECT id FROM permission WHERE role_id =$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
if($qpers['id']=="1"){
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










<!--Student Registration Information.
student can check their register course unit and new commers can select their course combinations.
-->
<script type="text/javascript" src="./Ajax/sp_cu_reg.js"></script>




<script type="text/javascript">
function sendcscmb(){
	
var cmb1="comb_sub01";
var c1 = document.getElementById(cmb1);
var cmbvl1 = c1.options[c1.selectedIndex].value;


var cmb2="comb_sub02";
var c2 = document.getElementById(cmb2);
var cmbvl2 = c2.options[c2.selectedIndex].value;


var cmb3="comb_sub03";
var c3 = document.getElementById(cmb3);
var cmbvl3 = c3.options[c3.selectedIndex].value;


 
if((cmbvl1==0)||(cmbvl2==0)||(cmbvl3==0)){
	alert("Please select the subject ! ");
return false; 
	}
else{
	
	
 var subcnf=confirm("Press ' OK ' to Confirm your combination and ' Cancel ' to change your preference.\n\n");
	   
	   if(subcnf){
		  return true; 
	   }
	   else{
		return false;   
	   }	
}
}
</script>
<?php
/////////////////////////////////////////////////////////////////////////////////
//.....edit by iranga New student can choose their course combinations..........
/////////////////////////////////////////////////////////////////////////////////
$stno=$_SESSION['user_id'];
$rustno=$_SESSION['ru_st_user_id'];

$duty=$_GET['duty'];
$gid=$_POST['id'];
$mnsujctone=$_POST['mnsujctone'];
$mnsujcttwo=$_POST['mnsujcttwo'];
$mnsujctthree=$_POST['mnsujctthree'];

$combi="[".$mnsujctone."]+[".$mnsujcttwo."]+[".$mnsujctthree."]";


$make=$_POST['make'];
$id=$_GET['id'];
include'./admin/config.php';


//////////////edit by iranga ////////////////////////////////////////////////////
require_once('./classes/globalClass.php');
$l=new settings();
/////////////////////////////////////////////////////////////////////////////////

$stspsub=$l->chkspecial($stno);
//echo$stspsub;


//............get st medium...........................
$stmdm=$l->getmedium($stno);
//..................................................
///////////////////////////////////////////////////////////////////////////////////
/////////////////////////////// if genaral student/////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
//if($stspsub=="General Student"){


//....check student new commer or not....................
$questcmbi="select * from student where id='$stno'";
//echo$questcmbi;
$qustcmbi=mysql_query($questcmbi);
/// if student new commer...........

if(mysql_num_rows($qustcmbi)==0)
{
//mysql_close($con_combin);
///get student scream.............................
echo" Subject Combinations Registration Unit<br>";
echo"<hr class=bar><br>";

$quesrem="select occupation from $rmsdb.fohssmis where user='$rustno'";
//echo$quesrem;
$qusrem=mysql_query($quesrem);

while($qsrem=mysql_fetch_array($qusrem)){
$srem=$qsrem['occupation'];
//echo$srem;
}



include'./connection/connection.php';
//...........................		
				
//....................get closing date of call combinations.....................
$quecmbcldt="select * from call_combination";
$qucmbcldt=mysql_query($quecmbcldt);
while($qcmbcldt=mysql_fetch_array($qucmbcldt)){
$cmbacc_yaer=$qcmbcldt['acc_year'];
$cmbend=$qcmbcldt['closing_date'];
$cmbst=$qcmbcldt['status'];
}
///////////////////////////////////////////////////////

if($duty=="fill"){
$quegetcmbchoic="select  id from request_combination where stno='$rustno' and acc_year='$cmbacc_yaer' and status=1";
//echo$quegetcmbchoic;
$qugetcmbchoic=mysql_query($quegetcmbchoic);
if(mysql_num_rows($qugetcmbchoic)==0)  { 
	$queinstcm="insert into request_combination(stno, acc_year, combination, priority, status) values('$rustno', '$cmbacc_yaer', '$combi',1, 1)";
	//echo$queinstcm;
	mysql_query($queinstcm);
	
}
else{
	$queupdatsubcnb="UPDATE request_combination SET combination='$combi' WHERE stno='$rustno' and acc_year='$cmbacc_yaer' and status=1";
	mysql_query($queupdatsubcnb);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////// tempory registration for course unit /////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
    $acy=$l->getAcc();                          
    $quereglsefirst="select distinct c.code,c.semister,c.target_group from courseunit c, combination o, target_group t where o.id=$cmbid and o.subject=t.subject and t.target_id=c.target_group and c.core='co' and c.level='1' and (c.semister=1 or c.semister=3) and c.availability=1 order by c.code";
    //echo$quereglsefirst;
    $qureglsefirst=mysql_query($quereglsefirst);
        while($qreglsefirst=mysql_fetch_array($qureglsefirst)){
                        
            $firstcos=$qreglsefirst['code'];
            $firstseme=$qreglsefirst['semister'];
            $trgtbp=$qreglsefirst['target_group'];
                        
            //echo$firstcos.$firstseme.$trgtbp."<br>";
                if($trgtbp!="12"){
                    $queinsfirst="insert into  registration(student, course, acedemic_year, semister, degree, confirm) values('$stno', '$firstcos', '$acy', $firstseme,1,0)";
                    //echo$queinsfirst."a<br>";
                   // mysql_query($queinsfirst);  
                        }
                else{
                ///////////////////////////////////////////////////////////////////////////////////////////////
                    $cs="no";
                    $quegtcs="select subject from combination where id='$cmbid'";
                    $qugtcs=mysql_query($quegtcs);
                        while($qgtcs=mysql_fetch_array($qugtcs)){
                            $cmbsubj=$qgtcs['subject'];
                                if($cmbsubj=="computer_science"){
                                        $cs="yes";
                                                }
                                            }
                    if($cs=="no"){
                        $queinsfirst="insert into  registration(student,course,acedemic_year,semister,degree,confirm) values('$stno','$firstcos','$acy',$firstseme,1,0)";
                        //echo$queinsfirst."b<br>";
                      //  mysql_query($queinsfirst);

                            }

        ///////////////////////////////////////////////////////////////////////////////////////////////
                                }

                                        }
*/
            
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// end tempory registration for course unit /////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////








					}








///...........check call combination status.....................
if($cmbst=='1'){



echo"<font size='3px'>No changes are allowed after : <font color='red'>$cmbend</font></font><br>";

echo"<table border='0' width='60%'>";
echo"<tr><th>Subject One </th><th>Subject Two </th><th>Subject Three </th></tr>";
echo"<tr class=trbgc>";
echo"<form method=post action=./index.php?view=admin&admin=1&duty=fill>";
$quegetmnsub="select * from main_subjects where status=1";
$qugetmnsub=mysql_query($quegetmnsub);
if(mysql_num_rows($qugetmnsub)==0){
	echo"<td colspan=3>Sorry ! No subject Found";
}
else{
	echo"<td><select name=mnsujctone style='width:100%;' id='comb_sub01'><option value=0 selected>Select Subject</option>";
	while($qgetmnsub=mysql_fetch_array($qugetmnsub)){
		$getmnsub=$qgetmnsub['sub_name'];
		$getmnsubid=$qgetmnsub['sub_id'];
		IF(($getmnsubid!=2)&&($getmnsubid!=8)){///////EDIT BY IRANGA to hide tis sub to c-20 student
		echo"<option value=$getmnsubid>$getmnsub</option>";
		}
	}	
	echo"</select>";
$qugetmnsub2=mysql_query($quegetmnsub);	
	echo"<td><select name=mnsujcttwo style='width:100%;' id='comb_sub02'><option value=0 selected>Select Subject</option>";
	while($qgetmnsub2=mysql_fetch_array($qugetmnsub2)){
		$getmnsub2=$qgetmnsub2['sub_name'];
		$getmnsubid2=$qgetmnsub2['sub_id'];
		IF(($getmnsubid2!=2)&&($getmnsubid2!=8)){///////EDIT BY IRANGA to hide tis sub to c-20 student
		echo"<option value=$getmnsubid2>$getmnsub2</option>";
		}
	}	
	echo"</select>";
	
	
$qugetmnsub3=mysql_query($quegetmnsub);	
	echo"<td><select name=mnsujctthree style='width:100%;' id='comb_sub03'><option value=0 selected>Select Subject</option>";
	while($qgetmnsub3=mysql_fetch_array($qugetmnsub3)){
		$getmnsub3=$qgetmnsub3['sub_name'];
		$getmnsubid3=$qgetmnsub3['sub_id'];
		IF(($getmnsubid3!=2)&&($getmnsubid3!=8)){///////EDIT BY IRANGA to hide tis sub to c-20 student
			echo"<option value=$getmnsubid3>$getmnsub3</option>";
		}
	}	
	echo"</select>";

}

echo"<tr class=trbgc align=center><td colspan=3><input type=submit value='Submit Subjects'  onclick='return sendcscmb()'></form>";


echo"</table><br>";			


/////////////////////////////////////////////////////////////////////////////
$queshwsucmb="select * from request_combination where stno='$rustno' and acc_year='$cmbacc_yaer' and  status=1";
//echo$queshwsucmb;
$qushwsucmb=mysql_query($queshwsucmb);
if(mysql_num_rows($qushwsucmb)!=0){
echo"<b>Your Current Main Subjects</b>";
echo"<table border='0' width='60%'>";
echo"<tr><th>Subject One </th><th>Subject Two </th><th>Subject Three </th></tr>";	
	while($qshwsucmb=mysql_fetch_array($qushwsucmb)){
			$shwsucmb=$qshwsucmb['combination'];
	}
$getsubjct=explode("+",$shwsucmb);

	$rmopbckt=explode("[",$getsubjct[0]);
		$rmclbkt=explode("]",$rmopbckt[1]);
	$puresubid1=$rmclbkt[0];

	$rmopbckt2=explode("[",$getsubjct[1]);
		$rmclbkt2=explode("]",$rmopbckt2[1]);
	$puresubid2=$rmclbkt2[0];	
	
	$rmopbckt3=explode("[",$getsubjct[2]);
		$rmclbkt3=explode("]",$rmopbckt3[1]);
	$puresubid3=$rmclbkt3[0];	
	
echo"<tr class=trbgc align=center height=30px>";
	
		$subone=$l->getmainsubject($puresubid1);
	echo"<td>$subone";
	
		$subtwo=$l->getmainsubject($puresubid2);
	echo"<td>$subtwo";
	
		$subthree=$l->getmainsubject($puresubid3);
	echo"<td>$subthree";
	echo"</table><br><br>";


//////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
$getsubjctcd=explode("+",$shwsucmb);
	$sub1=$getsubjctcd[0];
	$sub2=$getsubjctcd[1];
	$sub3=$getsubjctcd[2];

$quegetstblesubj="select c.* from courseunit c,curriculum cr where availability=1 and c.by_low_version=cr.cr_value and cr.status=1 and ( c.target_group LIKE '%All%' or c.target_group LIKE '%$sub1%' or  c.target_group LIKE '%$sub2%' or  c.target_group LIKE '%$sub3%') and c.level=1 and c.semister=1 order by c.code";
//echo$quegetstblesubj;
$qugetstblesubj=mysql_query($quegetstblesubj);
if(mysql_num_rows($qugetstblesubj)!=0){
	$cutblrw=1;
	$sufex="nil";
	echo"Recommended course units for this semester, according to your main subjects.";
	echo"<table><tr><th>#<th>Course Unit<th>Course Name<th>Department<th>Credits";
	while($qgetstblesubj=mysql_fetch_array($qugetstblesubj)){	
				$code=$qgetstblesubj['code'];
					$fifx3=substr("$code",0,3);
				$name=$qgetstblesubj['name'];
				$department=$qgetstblesubj['department'];
				$credits=$qgetstblesubj['credits'];
				$coordinator=$qgetstblesubj['coordinator'];
		if(($sufex==$fifx3)&&($fifx3=="SUP")){
			echo"<tr align=center class=selectbg><td colspan=5 align=center><b>OR</b>";
		}
		
		if($fifx3=="SUP"){
			echo"<tr align=center class=selectbg><td>$cutblrw";
		}
		else{
			echo"<tr align=center class=trbgc><td>$cutblrw";
		}
			

		echo"<td>".strtoupper($code);
		echo"<td align=left> &nbsp;".ucfirst($name);
		echo"<td align=left> &nbsp;";
			$department_name=$l->getdeptname($department);
			echo ucfirst($department_name);
		
		echo"<td>".$credits;
		//echo"<td>".$coordinator;
		
	$sufex=$fifx3;
	$cutblrw++;
	}
	echo"</table>";
}
}
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////			
}



//.......when call combination stoped.................... 
else{
/////////////////////////////////////////////////////////////////////////////
$queshwsucmb="select * from request_combination where stno='$rustno' and acc_year='$cmbacc_yaer' and  status=1";
//echo$queshwsucmb;
$qushwsucmb=mysql_query($queshwsucmb);
if(mysql_num_rows($qushwsucmb)!=0){
echo"<b>Your Main Subjects</b>";
echo"<table border='0' width='60%'>";
echo"<tr><th>Subject One </th><th>Subject Two </th><th>Subject Three </th></tr>";	
	while($qshwsucmb=mysql_fetch_array($qushwsucmb)){
			$shwsucmb=$qshwsucmb['combination'];
	}
$getsubjct=explode("+",$shwsucmb);


	$rmopbckt=explode("[",$getsubjct[0]);
		$rmclbkt=explode("]",$rmopbckt[1]);
	$puresubid1=$rmclbkt[0];

	$rmopbckt2=explode("[",$getsubjct[1]);
		$rmclbkt2=explode("]",$rmopbckt2[1]);
	$puresubid2=$rmclbkt2[0];	
	
	$rmopbckt3=explode("[",$getsubjct[2]);
		$rmclbkt3=explode("]",$rmopbckt3[1]);
	$puresubid3=$rmclbkt3[0];	
	






echo"<tr class=trbgc align=center height=30px>";
	
		$subone=$l->getmainsubject($puresubid1);
	echo"<td>$subone";
	
		$subtwo=$l->getmainsubject($puresubid2);
	echo"<td>$subtwo";
	
		$subthree=$l->getmainsubject($puresubid3);
	echo"<td>$subthree";
	echo"</table><br><br>";
}
else{
	echo"Sorry..! Combination Registration Closed. If Any Changes ? Contact Dean Office.";
}
//////////////////////////////////////////////////////////////////////////////



}
//...............................................


}

///////////////////////////////////////////////////////////////
//...............end select combination prosses.................
//////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
// if student not new commer, student can register their course units...........
////////////////////////////////////////////////////////////////////////////////





else{
$qstcmbi=mysql_fetch_array($qustcmbi);
	$combination=$qstcmbi['combination'];
	$curriculum=$qstcmbi['curriculum'];
	$stream=$qstcmbi['stream'];	
///////////////////////check student passout or not/////////////////////////////////
//............get st level...........................
$stlvl=$l->getLevel($stno);
//..................................................
echo "Course Registration Unit <hr class=bar>";
if($stlvl!=0){
						$query1_1="select * from call_registration where  level=$stlvl";
						$prev=mysql_query($query1_1);
						while($predata=mysql_fetch_array($prev)){
						$reg_check=$predata['register'];
						$ac_1=$predata['acedemic_year'];
						$semi_1=$predata['semister'];
						$close_1=$predata['closing_date'];
						

						}

if($task=="regmdl"){
	$getsubcdid=$_POST['subcdid'];
	$getdgsts=$_POST['dgsts'];
	$getsuvmtbtn=$_POST['suvmtbtn'];
		$dvdsuvmtbtn=explode("-",$getsuvmtbtn);
			$dvdbtnvle=$dvdsuvmtbtn[0];
			
	$getotrsubcd=$_SESSION['otrsubssn'];

	//echo$getsubcdid.$getdgsts.$dvdbtnvle;
	
	
	if($dvdbtnvle=="Register"){
		$queregeditqary="insert into registration(student,course,acedemic_year,semister,degree,confirm) values ('$stno','$getsubcdid','$ac_1',$semi_1,'$getdgsts',0)";
					
	}
	
	if($dvdbtnvle=="Cancel"){
		$queregeditqary="delete from registration where id=$getsubcdid";		
	}	
	$quregeditqary=mysql_query($queregeditqary);
	//echo$queregeditqary;
	
}
	
	
	
	
	
	
	
	
	
	
////////////////////////////////////////////////////////////////////////////////////




//......................course unit registration prosses..........................
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
$getsubjctcd=explode("+",$combination);
	$sub1=$getsubjctcd[0];
	$sub2=$getsubjctcd[1];
	$sub3=$getsubjctcd[2];

	$rmopbckt=explode("[",$getsubjctcd[0]);
		$rmclbkt=explode("]",$rmopbckt[1]);
	$puresubid1=$rmclbkt[0];

	$rmopbckt2=explode("[",$getsubjctcd[1]);
		$rmclbkt2=explode("]",$rmopbckt2[1]);
	$puresubid2=$rmclbkt2[0];	
	
	$rmopbckt3=explode("[",$getsubjctcd[2]);
		$rmclbkt3=explode("]",$rmopbckt3[1]);
	$puresubid3=$rmclbkt3[0];		
	
	$prntsub1=$l->getmainsubject($puresubid1);	
	$prntsub2=$l->getmainsubject($puresubid2);	
	$prntsub3=$l->getmainsubject($puresubid3);		
	
echo"<table width=60%><tr align=center class=selectbg>";

if($stream=="Special"){
	echo"<td width=20%><b>".strtoupper($prntsub1)."</b>";
}
else{
	echo"<td width=20%><b>".strtoupper($prntsub1)."<td width=20%><b>".strtoupper($prntsub2)."<td width=20%><b>".strtoupper($prntsub3)."</b>";
}
echo"</table><br>";
echo '<b>Course Unit Registration for '.$ac_1.' Academic year and Semester	'.$semi_1.'  in '.$stmdm.' Medium</b><br>';	

$quegettosum="select sum(c.credits)from registration r, courseunit c, student s  where r.acedemic_year='$ac_1' and (r.semister=$semi_1 or r.semister='3') and r.degree='Degree' and r.course=c.code and r.student='$stno' and r.student=s.id and s.curriculum=c.by_low_version";
//echo$quegettosum;
$qugettosum=mysql_query($quegettosum);
$qgettosum=mysql_fetch_array($qugettosum);
$gettosum=$qgettosum['sum(c.credits)'];				
if($gettosum>0){						
echo "<br><b><font color=blue> You have register for ".$gettosum." credits , for this semester</font></b><br><br>";
}


if($reg_check==1){

echo "Closing Date for Registration : <font color=red>".$close_1."</font><br>";
echo "<font color=red><center>( Do Modification of Registration On or Before Closing Date )</center></font><br>";



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// co course/////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if($stream=="Special"){
	$quegetstblesubj="select c.* from courseunit c where c.availability=1 and c.by_low_version=$curriculum and (c.core='co' or c.core='nd') and ( c.target_group LIKE '%All%' or  c.target_group LIKE '%$sub1%' ) and c.level=$stlvl and c.semister=$semi_1 and c.stream='$stream' order by c.code";
}
else{
	$quegetstblesubj="select c.* from courseunit c where c.availability=1 and c.by_low_version=$curriculum and (c.core='co' or c.core='nd') and ( c.target_group LIKE '%All%' or c.target_group LIKE '%$sub1%' or  c.target_group LIKE '%$sub2%' or  c.target_group LIKE '%$sub3%') and c.level=$stlvl and c.semister=$semi_1 and c.stream='$stream' order by c.code";
}



//echo$quegetstblesubj;
$qugetstblesubj=mysql_query($quegetstblesubj);
if(mysql_num_rows($qugetstblesubj)!=0){
	$cutblrw=1;
	
	$totcocdtcunt=0;
	echo"";
	echo"<table width=70%><tr><th colspan=5>Compulsory Course Units";
	echo"<tr><th>#<th>Course Unit<th>Course Name<th>Credits<th>Current Status ";
	while($qgetstblesubj=mysql_fetch_array($qugetstblesubj)){	
				$code=trim($qgetstblesubj['code']);
					$fifx3=substr("$code",0,3);
				$name=$qgetstblesubj['name'];
				$department=$qgetstblesubj['department'];
				$credits=$qgetstblesubj['credits'];
					$totcocdtcunt=$totcocdtcunt+$credits;
				$coordinator=$qgetstblesubj['coordinator'];
				
				$quechkinscocu="select id from  registration where student='$stno' and acedemic_year='$ac_1' and course='$code' and semister=$semi_1";
				//echo$quechkinscocu;
				$quchkinscocu=mysql_query($quechkinscocu);
				if(mysql_num_rows($quchkinscocu)==0){
					$queinscocu="insert into registration(student,course,acedemic_year,semister,degree,confirm) values ('$stno','$code','$ac_1',$semi_1,'Degree',1)";
					mysql_query($queinscocu);
				}
		////////////////////////////////////////////////////////////////////////////////
		echo"<tr align=center class=trbgc>";
		echo"<td>$cutblrw";
		echo"<td>".strtoupper($code);
		echo"<td align=left> &nbsp;".ucfirst($name);
		echo"<td>".$credits;
		/*echo"<td>".$coordinator;
		echo"<td align=left> &nbsp;";
			$department_name=$l->getdeptname($department);
			echo ucfirst($department_name);
		*/
		echo"<td>";
			echo"<img src='./images/r.png'> <font color=blue>[ Rigistered ]</font>";
		///////////////////////////////////////////////////////////////////////////////	

	$cutblrw++;
	}
	echo"<tr height=25px><td colspan=3  align=right><b>TOTAL</b><td align=center class=tdbgc><font color=blue><b>".number_format("$totcocdtcunt",2)."</b></font>";
	echo"</table>";
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// sup course/////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($stream=="Special"){
$quegetstblesubj="select c.* from courseunit c, where c.code LIKE 'sup%' and c.availability=1 and c.by_low_version=$curriculum and (c.core='op' or c.core='nn') and ( c.target_group LIKE '%All%' or c.target_group LIKE '%$sub1%' ) and c.level=$stlvl and c.semister=$semi_1 and c.stream='$stream' order by c.code";
}
else{
$quegetstblesubj="select c.* from courseunit c, where c.code LIKE 'sup%' and c.availability=1 and c.by_low_version=$curriculum and (c.core='op' or c.core='nn') and ( c.target_group LIKE '%All%' or c.target_group LIKE '%$sub1%' or  c.target_group LIKE '%$sub2%' or  c.target_group LIKE '%$sub3%') and c.level=$stlvl and c.semister=$semi_1 and c.stream='$stream' order by c.code";
}
//echo$quegetstblesubj;
$qugetstblesubj=mysql_query($quegetstblesubj);
if(mysql_num_rows($qugetstblesubj)!=0){
	$cutblrw=1;
	
	$totcocdtcunt=0;
	echo"";
	echo"<br><br><table width=70%><tr><th colspan=7><br>Supplementary  Course Units<br><font size=2px>( Compulsory to select either one course unit )<br><br>";
	echo"<tr><th>#<th>Course Unit<th>Course Name<th>Credits<th>Current Status <th>Submission";
	while($qgetstblesubj=mysql_fetch_array($qugetstblesubj)){	
				$code=trim($qgetstblesubj['code']);
					$fifx3=substr("$code",0,3);
				$name=$qgetstblesubj['name'];
				$core=$qgetstblesubj['core'];
				$department=$qgetstblesubj['department'];
				$credits=$qgetstblesubj['credits'];
					$totcocdtcunt=$totcocdtcunt+$credits;
				$coordinator=$qgetstblesubj['coordinator'];
				
				$quechkinscocu="select id,degree from  registration where student='$stno' and acedemic_year='$ac_1' and course='$code' and semister=$semi_1";
				//echo$quechkinscocu;
				$quchkinscocu=mysql_query($quechkinscocu);
				if(mysql_num_rows($quchkinscocu)==0){
					$curegchk="No";
				}
				else{
					$qchkinscocu=mysql_fetch_array($quchkinscocu);
						$chkinscocu=$qchkinscocu['id'];
						$chkinscocudegree=$qchkinscocu['degree'];
					$curegchk="Yes";
				}
		////////////////////////////////////////////////////////////////////////////////
		if($curegchk=="Yes"){
			echo"<tr align=center class=selectbg>";
		}
		else{
			echo"<tr align=center class=trbgc>";	
		}
		echo"<form method=post action='./?view=admin&admin=1&task=regmdl'><td>$cutblrw";
		echo"<td>".strtoupper($code);
				if($curegchk=="No"){
					echo"<input type=hidden name=subcdid value='$code'>";
				}
				else{
					echo"<input type=hidden name=subcdid value='$chkinscocu'>";
				}
		echo"<td align=left> &nbsp;".ucfirst($name);
		echo"<td>".$credits;
		/*echo"<td>".$coordinator;
		echo"<td align=left> &nbsp;";
			$department_name=$l->getdeptname($department);
			echo ucfirst($department_name);
		*/
		//echo"<td>";
			echo"<select name=dgsts hidden>";
			if($curegchk=="No"){
				if($core=="co"){
					echo"<option value='Degree'>Degree</option>";
				}
				elseif($core=="op"){
					echo"<option value='Degree' selected>Degree</option>";
					echo"<option value='Non Degree'>Non Degree</option>";				
				}			
				elseif($core=="nd"){
					echo"<option value='Non Degree'>Non Degree</option>";					
				}		
				elseif($core=="nn"){
					echo"<option value='Non Degree'>Non Degree</option>";					
				}
				else{
					echo"<option value='Degree' selected>Degree</option>";
					echo"<option value='Non Degree'>Non Degree</option>";				
				}
			}
			else{
				echo"<option value='$chkinscocudegree'>$chkinscocudegree</option>";
			}
			echo"</select>";
		
		echo"<td>";
		if($curegchk=="Yes"){
			echo"<img src='./images/r.png'> <font color=blue>[ Registered ! ]</font>";
		}
		else{
			echo"<font color=red>[ Not Registered ! ]</font>";
		}
		
		echo"<td>";
		if($curegchk=="No"){	
			echo"<input type=submit name=suvmtbtn value='Register-".$code."'>";
		}
		else{
			echo"<input type=submit  name=suvmtbtn  value='Cancel-".$code."'>";
		}
		
		
			echo"</form>";
		///////////////////////////////////////////////////////////////////////////////	
		
	$cutblrw++;
	}
//	echo"<tr height=25px><td colspan=3  align=right><b>TOTAL</b><td align=center class=tdbgc><font color=blue><b>".number_format("$totcocdtcunt",2)."</b></font>";
	echo"</table>";
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////








////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// op course/////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//if((($stlvl!=2)&&($stlvl!=3))||($stream=="Special")){
if($stream=="Special"){
$quegetstblesubj2="select c.* from courseunit c where c.code NOT LIKE'sup%' and  c.availability=1 and c.by_low_version=$curriculum and (c.core='op' or c.core='nn') and (c.target_group LIKE '%$sub1%' ) and c.level=$stlvl and c.semister=$semi_1 and c.stream='$stream' order by c.code";
}
else{
$quegetstblesubj2="select c.* from courseunit c where c.code NOT LIKE'sup%' and  c.availability=1 and c.by_low_version=$curriculum and (c.core='op' or c.core='nn') and ( c.target_group LIKE '%$sub1%' or  c.target_group LIKE '%$sub2%' or  c.target_group LIKE '%$sub3%') and c.level=$stlvl and c.semister=$semi_1 and c.stream='$stream' order by c.code";
	
}
//echo$quegetstblesubj2; 
$qugetstblesubj2=mysql_query($quegetstblesubj2);
if(mysql_num_rows($qugetstblesubj2)!=0){
	$cutblrw2=1;
	
	$totcocdtcunt2=0;
	echo"";
	if($stream=="Special"){
			echo"<br><br><table width=70%><tr><th colspan=7><br>Core Optional  Course Units<br><font size=2px>( Only one subject should be selected )<br><br>";
		}
	else{
			echo"<br><br><table width=70%><tr><th colspan=7><br>Core Optional  Course Units<br><font size=2px>( Only one subject should be selected within either semester I or semester II )<br><br>";
		}
	echo"<tr><th>#<th>Course Unit<th>Course Name<th>Credits<th>Current Status <th>Submission";
	while($qgetstblesubj2=mysql_fetch_array($qugetstblesubj2)){	
				$code2=trim($qgetstblesubj2['code']);
					$fifx32=substr("$code",0,3);
				$name2=$qgetstblesubj2['name'];
				$core2=$qgetstblesubj2['core'];
				$department2=$qgetstblesubj2['department'];
				$credits2=$qgetstblesubj2['credits'];
					$totcocdtcunt2=$totcocdtcunt2+$credits2;
				$coordinator2=$qgetstblesubj2['coordinator'];
				
				$quechkinscocu2="select id,degree from  registration where student='$stno' and acedemic_year='$ac_1' and course='$code2' and semister=$semi_1";
				//echo$quechkinscocu2;
				$quchkinscocu2=mysql_query($quechkinscocu2);
				if(mysql_num_rows($quchkinscocu2)==0){
					$curegchk2="No";
				}
				else{
					$qchkinscocu2=mysql_fetch_array($quchkinscocu2);
						$chkinscocu2=$qchkinscocu2['id'];
						$chkinscocudegree2=$qchkinscocu2['degree'];
					$curegchk2="Yes";
				}
		////////////////////////////////////////////////////////////////////////////////
		if($curegchk2=="Yes"){
			echo"<tr align=center class=selectbg>";
		}
		else{
			echo"<tr align=center class=trbgc>";	
		}
		echo"<form method=post action='./?view=admin&admin=1&task=regmdl'><td>$cutblrw2";
		echo"<td>".strtoupper($code2);
				if($curegchk2=="No"){
					echo"<input type=hidden name=subcdid value='$code2'>";
				}
				else{
					echo"<input type=hidden name=subcdid value='$chkinscocu2'>";
				}
		echo"<td align=left> &nbsp;".ucfirst($name2);
		echo"<td>".$credits2;
		/*echo"<td>".$coordinator;
		echo"<td align=left> &nbsp;";
			$department_name=$l->getdeptname($department);
			echo ucfirst($department_name);
		*/
		//echo"<td>";
			echo"<select name=dgsts hidden>";
			if($curegchk2=="No"){
				if($core2=="co"){
					echo"<option value='Degree'>Degree</option>";
				}
				elseif($core2=="op"){
					echo"<option value='Degree' selected>Degree</option>";
					echo"<option value='Non Degree'>Non Degree</option>";				
				}			
				elseif($core2=="nd"){
					echo"<option value='Non Degree'>Non Degree</option>";					
				}		
				elseif($core2=="nn"){
					echo"<option value='Non Degree'>Non Degree</option>";					
				}
				else{
					echo"<option value='Degree' selected>Degree</option>";
					echo"<option value='Non Degree'>Non Degree</option>";				
				}
			}
			else{
				echo"<option value='$chkinscocudegree2'>$chkinscocudegree2</option>";
			}
			echo"</select>";
		
		echo"<td>";
		if($curegchk2=="Yes"){
			echo"<img src='./images/r.png'> <font color=blue>[ Registered ! ]</font>";
		}
		else{
			echo"<font color=red>[ Not Registered ! ]</font>";
		}
		
		echo"<td>";
		if($curegchk2=="No"){	
			echo"<input type=submit name=suvmtbtn value='Register-".$code2."'>";
		}
		else{
			echo"<input type=submit  name=suvmtbtn  value='Cancel-".$code2."'>";
		}
		
		
			echo"</form>";
		///////////////////////////////////////////////////////////////////////////////	
		
	$cutblrw2++;
	}
//	echo"<tr height=25px><td colspan=3  align=right><b>TOTAL</b><td align=center class=tdbgc><font color=blue><b>".number_format("$totcocdtcunt",2)."</b></font>";
	echo"</table>";
}
//}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////









//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// Other subjet course ////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($stlvl!=1){
echo"<br><br><table width=70%><tr><th colspan=7>Extra Optional Course Units";
if($stream=="Special"){
	echo"<br><font size=2px>( Maximum two subject can be selected either semester I or semester II )<br><br></font> ";
}
else{
	echo"<br><font size=2px>( If you wish to register for other subject course units, Please submit the subject name. )<br><br></font> ";
}


$quegetmnsub="select * from main_subjects where status=1";
$qugetmnsub=mysql_query($quegetmnsub);
if(mysql_num_rows($qugetmnsub)==0){
	echo"Sorry ! No subject Found";
}
else{
	
echo"<form method=post action='./?view=admin&admin=1&duty=regmdl4otrsub'>";
	echo"<select name=mnsujct4otrreg>";
	echo"<option value=0 selected>Select Subject</option>";
	while($qgetmnsub=mysql_fetch_array($qugetmnsub)){
		$getmnsub=$qgetmnsub['sub_name'];
		$getmnsubid=$qgetmnsub['sub_id'];
		
		if(($puresubid1!=$getmnsubid)&&($puresubid2!=$getmnsubid)&&($puresubid3!=$getmnsubid)){
			echo"<option value=$getmnsubid>$getmnsub</option>";
		}
	}	
	echo"</select>";


echo"<input type=submit  value='Submit'>";
echo"</form>";
}
if($duty=="regmdl4otrsub"){
	$getotrsubcd3=$_POST['mnsujct4otrreg'];
	$getotrsubcd2="[".$getotrsubcd3."]";
	
	if($getotrsubcd3!=null){
		$_SESSION['otrsubssn']=$getotrsubcd2;
		$_SESSION['otrsubcdssn']=$getotrsubcd3;

	}
	$getotrsubcd=$_SESSION['otrsubssn'];		
	
//echo$getotrsubcd.$_SESSION['otrsubssn'];
////////////////8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888///////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// other course /////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$quegetstblesubj3="select c.* from courseunit c where c.availability=1 and c.by_low_version=$curriculum and  ( c.target_group LIKE '%$getotrsubcd%' ) and c.level=$stlvl and c.semister=$semi_1 and c.stream='$stream' order by c.code";
//echo$quegetstblesubj3;
$qugetstblesubj3=mysql_query($quegetstblesubj3);
if(mysql_num_rows($qugetstblesubj3)!=0){
	$cutblrw3=1;
	
	$totcocdtcunt3=0;
	
	$prntothrsub=$l->getmainsubject($_SESSION['otrsubcdssn']);	
	echo"Course Unit Table for ".$prntothrsub;
	if(($stlvl==2)||($stlvl==3)){
	echo"<br><font size=2px>( Only one subject should be selected within either semester I or semester II )</font>";
	}
	echo"<tr><th>#<th>Course Unit<th>Course Name<th>Credits<th>Current Status <th>Submission";
	
	while($qgetstblesubj3=mysql_fetch_array($qugetstblesubj3)){	
				$code3=trim($qgetstblesubj3['code']);
					$fifx33=substr("$code3",0,3);
				$name3=$qgetstblesubj3['name'];
				$core3=$qgetstblesubj3['core'];
				$department3=$qgetstblesubj3['department'];
				$credits3=$qgetstblesubj3['credits'];
					$totcocdtcunt3=$totcocdtcunt3+$credits3;
				$coordinator3=$qgetstblesubj3['coordinator'];
				
				$quechkinscocu3="select id from  registration where student='$stno' and acedemic_year='$ac_1' and course='$code3' and semister=$semi_1";
				//echo$quechkinscocu3;
				$quchkinscocu3=mysql_query($quechkinscocu3);
				if(mysql_num_rows($quchkinscocu3)==0){
					$curegchk3="No";
				}
				else{
					$qchkinscocu3=mysql_fetch_array($quchkinscocu3);
						$chkinscocu3=$qchkinscocu3['id'];
					$curegchk3="Yes";
				}
		////////////////////////////////////////////////////////////////////////////////
		if($curegchk3=="Yes"){
			echo"<tr align=center class=selectbg>";
		}
		else{
			echo"<tr align=center class=trbgc>";	
		}
		echo"<form method=post action='./?view=admin&admin=1&task=regmdl&duty=regmdl4otrsub'><td>$cutblrw3";
		echo"<td>".strtoupper($code3);
				if($curegchk3=="No"){
					echo"<input type=hidden name=subcdid value='$code3'>";
				}
				else{
					echo"<input type=hidden name=subcdid value='$chkinscocu3'>";
				}
		echo"<td align=left> &nbsp;".ucfirst($name3);
		echo"<td>".$credits3;
		/*echo"<td>".$coordinator;
		echo"<td align=left> &nbsp;";
			$department_name=$l->getdeptname($department);
			echo ucfirst($department_name);
		*/
		//echo"<td>";
			echo"<select name=dgsts hidden>";
			echo"<option value='Degree'>Degree</option>";	
			//echo"<option value='Non Degree'>Non Degree</option>";
			/*if($core3=="co"){
				echo"<option value='Degree'>Degree</option>";
			}
			elseif($core3=="op"){
				echo"<option value='Degree' selected>Degree</option>";
				echo"<option value='Non Degree'>Non Degree</option>";				
			}			
			elseif($core3=="nd"){
				echo"<option value='Non Degree'>Non Degree</option>";					
			}		
			elseif($core3=="nn"){
				echo"<option value='Non Degree'>Non Degree</option>";					
			}
			else{
				echo"<option value='Degree' selected>Degree</option>";
				echo"<option value='Non Degree'>Non Degree</option>";				
			}
			*/
			echo"</select>";
		
		echo"<td>";
		if($curegchk3=="Yes"){
			echo"<img src='./images/r.png'> <font color=blue>[ Registered ! ]</font>";
		}
		else{
			echo"<font color=red>[ Not Registered ! ]</font>";
		}
		
		echo"<td>";
		if($curegchk3=="No"){	
			echo"<input type=submit name=suvmtbtn value='Register-".$code3."'>";
		}
		else{
			echo"<input type=submit  name=suvmtbtn  value='Cancel-".$code3."'>";
		}
		
		
			echo"</form>";
		///////////////////////////////////////////////////////////////////////////////	
		
	$cutblrw3++;
	}
//	echo"<tr height=25px><td colspan=3  align=right><b>TOTAL</b><td align=center class=tdbgc><font color=blue><b>".number_format("$totcocdtcunt",2)."</b></font>";
	
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888////////////////////
}
echo"</table>";
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	
}
else{
////////////////////000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000/////////////////////
$que_CRS_CU="select r.confirm, r.course, r.degree, c.name,c.credits from registration r, courseunit c where student='$stno'and r.course=c.code and r.acedemic_year='$ac_1' and r.semister=$semi_1 order by r.course";
//echo$que_CRS_CU;
$CRS_course=mysql_query($que_CRS_CU);
if(mysql_num_rows($CRS_course)!=0){
$stmnrgrwnm=1;
echo '<table border="0" width=70%><tr><th>#<th>Course Unit<th>Course Name<th>Credits<th>Degree Status<th>Official Confirmation</tr>';
while($CRS=mysql_fetch_array($CRS_course)){
$CRScose=trim($CRS['course']);



echo "<tr class=trbgc><td align='center'>$stmnrgrwnm<td align='center'>".$CRScose."<td>".ucfirst($CRS['name'])."<td align='center'>".$CRS['credits'];

$stregdgstt=$CRS['degree'];
if($stregdgstt=="Non Degree"){
	$stregdgstt2="None Degree Course-(6)";
}
else{
	$stregdgstt2=$l->getcostype($CRScose,$stno);
}

echo "<td align='center'>$stregdgstt2";



echo"<td align='center'>"; 
if(($CRS['confirm'])==1){
echo "Confirmed";
}
	elseif(($CRS['confirm'])==0){
		echo '<font color="red">Not Confirmed</font>';
				}
$stmnrgrwnm++;						
echo "</tr>";
}
echo "</table>";
}
else{
		echo '<br><font color="red"> Sorry!  Can not find course unit for this semester.</font>';
}
////////////////////000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000/////////////////////	
}









//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////	
//................................................................................
////////////////////////////////////////////////////////////////////////////////////
}	///check level if

	else{
		echo '<br><font color="red"> Sorry!  This option is not available for you.</font>';

		}
////////////////////////////////////////////////////////////////////////////////////////////////
}

//}///////////////chk special student if close bracket////////////////////
///////////////////////////////////////////////////////////////////////////////////
/////////////////////////////// if end genaral student/////////////////////////////
///////////////////////////////////////////////////////////////////////////////////














//..........Edit by Iranga..................	
//..........Print All course unit that students were register.........
$conIR=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

$id_1=$_SESSION['user_id'];
echo "<br><br><hr class=bar>";




echo 'All course units that you are registered up today</font><br>';
echo "<hr class=bar><br>";

//echo"<font color='red'>* * * Important: The below values are shown only for course units that have been confirmed by the faculty since the Second Semester of 2010_2011 Academic year.</font><br>";

$tot_c="select sum(c.credits) from registration r, courseunit c where student='$id_1'and r.course=c.code  and r.confirm='1' and r.degree='Degree' ";
$tot=mysql_query($tot_c);

while($t=mysql_fetch_array($tot)){
$alstcdt=$t['sum(c.credits)'];

}
if($alstcdt==NULL){
$alstcdt=0;
}

echo '<table border=0><tr><td><font color="blue" size="3">You have registered <td><font color="red" size="3">';
////////////////////////////gen st////////////////////////////////    
if($stspsub=="General Student"){
    echo$alstcdt;
}
//////////////////////////////sp st///////////////////////////////
else{
echo"<div id='allcdcut'>";
   echo$alstcdt;  
echo"</div>";    
}
//////////////////////////////////////////////////////////////////
echo '</font></b><td><font color="blue" size="3">(Confirmed) Credits </b></font>';

echo"</tr></table>";

$que_All_CU="select r.confirm, r.course, r.degree, c.name,c.credits from registration r, courseunit c where student='$id_1'and r.course=c.code order by r.acedemic_year,r.semister,r.course";
$all_course=mysql_query($que_All_CU);
if(mysql_num_rows($all_course)!=0){
$alcuid=1;
echo '<table border="0" width=70%><tr><th>#<th>Course Unit<th>Course Name<th>Credits<th width=20%>Degree Status<th>Official Confirmation</tr>';
while($ac=mysql_fetch_array($all_course)){
$allcose=$ac['course'];
////////////////////////////////////////////////////////////////////////////////////////
			$coursegetchr=trim($allcose);
			
								$fulcode3=strtoupper($coursegetchr);
		////////////////////////////////////////////////////




echo "<tr class=trbgc><td align='center'>$alcuid<td align='center'>".$fulcode3."<td>".ucfirst($ac['name'])."<td align='center'>".$ac['credits'];

$stregdgstt2=$ac['degree'];
if($stregdgstt2=="Non Degree"){
	$stregdgstt22="None Degree Course-(6)";
}
else{
	$stregdgstt22=$l->getcostype($coursegetchr,$id_1);
}

echo "<td align='center'>$stregdgstt22";



echo"<td align='center'>"; 
if(($ac['confirm'])==1){
echo "Confirmed";
}
	elseif(($ac['confirm'])==0){
		echo '<font color="red">Not Confirmed</font>';
				}
						
echo "</tr>";
$alcuid++;
}
echo "</table>";

}

mysql_close($conIR);
//.........................................................

		




				
						
						
?>




















<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>
