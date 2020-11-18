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

$quepers="SELECT id FROM permission WHERE role_id =$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
if($qpers['id']=="57"){
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

require_once('./classes/globalClass.php');
$rp=new settings();





//...............get acc_year....................
$acyart=$rp->getAcc();
//.................................................			

//...........get semester..........
$seme=$rp->getSemister();
//.................................................	

$due=$_GET['due'];

$ye=date('Y');
$dtntm=date("Y-m-d/H:i");
$user=$_SESSION['user_id'];

$upuser=$user."/".$dtntm;



echo" Confirm Repeat Subjects of Students";
echo"<hr class=bar>";


echo"<h3>*** Confirm one Student's Repeat Subjects ***</h3>";

include'./forms/form_57.php';

///////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////// one st confirm ///////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////



if($task=="onest"){

$stno57_2=$_POST['index57'];
$btno57_2=$_POST['year57'];
if($stno57_2!=null){
$_SESSION['gtstno57']=$stno57_2;
$_SESSION['gtbtno57']=$btno57_2;
			}
$stno57=$_SESSION['gtstno57'];
$btno57=$_SESSION['gtbtno57'];


if($due=="onestcnf"){
$cnfid=$_POST['cnfid'];
$quecnfupdt="update exam_registration set confirm=1,Last_update='$upuser' where id='$cnfid'";
//echo$quecnfupdt;
mysql_query($quecnfupdt);
		}

if($due=="onestcnle"){
$cnfid=$_POST['cnfid'];
$lstup=$_POST['lstup'];

$getinsst=explode('+',$lstup);

$insby=$getinsst[0];

if($insby=="regby"){
//echo"del";
$quedereg="delete from exam_registration where id=$cnfid";
mysql_query($quedereg);



			}
else{
$quecnfupdt="update exam_registration set confirm=0,Last_update='$upuser' where id='$cnfid'";
//echo$quecnfupdt;
mysql_query($quecnfupdt);

	}

		}

if($due=="onestrgncnf"){
$cnfcod=$_POST['cnfcod'];
$cnfdgst=$_POST['cnfdgst'];
$rgby="regby+".$upuser;

$queregncnf="insert into exam_registration (student,course,acedemic_year,semester,degree,confirm,year,Last_update) values('$stno57','$cnfcod','$acyart',$seme,'$cnfdgst',1,'$ye','$rgby')";

mysql_query($queregncnf);
//echo$queregncnf;



			}


$gtbtch=$rp->getBatch($stno57);
if($gtbtch!=$btno57){
echo"<font color='red'>Sorry !, SC/$btno57/$stno57 is Invalid Student Number.</font><br>";

			}
else{






$gtnmerpst=$rp->getName($stno57);
//............get st level...........................
$stlvl=$rp->getLevel($stno57);
//..................................................
if($stlvl!=1){
echo"<h3>Repeat Exam Registration Details of $gtnmerpst (SC/$btno57/$stno57)</h3>";

if($stlvl!=0){

if($seme==1){
$quecoreg="select r.course, r.degree, c.name from registration r,courseunit c where r.student='$stno57' and r.semister=1 and r.confirm=1 and r.acedemic_year<>'$acyart' and r.course=c.code order by r.acedemic_year,r.semister,r.course";
}
else{
$quecoreg="select r.course,r.degree,c.name from registration r,courseunit c where r.student='$stno57' and (r.semister=2 or r.semister=3) and r.confirm=1 and r.acedemic_year<>'$acyart' and r.course=c.code order by r.acedemic_year,r.semister,r.course";
}
		}
else{
if($seme==1){
$quecoreg="select r.course, r.degree, c.name from registration r,courseunit c where r.student='$stno57' and r.semister=1 and r.confirm=1 and r.course=c.code order by r.acedemic_year,r.semister,r.course";
}
else{
$quecoreg="select r.course,r.degree,c.name from registration r,courseunit c where r.student='$stno57' and (r.semister=2 or r.semister=3) and r.confirm=1 and  r.course=c.code order by r.acedemic_year,r.semister,r.course";
}

}


$qucoreg=mysql_query($quecoreg);
if(mysql_num_rows($qucoreg)==0){
	echo"<font color='red'>Sorry ! Can not find subject registration details.</font><br>";
				}
else{
$norp=0;

echo"<table border='0'><tr>";
echo"<th>Courses Code</th><th>Courses Name</th><th>Degree Status</th><th>Confirmation Status</th><th>Submission</th></tr>";
while($qcoreg=mysql_fetch_array($qucoreg)){
	$coreg2=$qcoreg['course'];
	////////////////////////////////////////////////////////////////////////////////////////
                                $coursegetchr=trim($coreg2);
                                $ccdwoutcrd=substr("$coursegetchr", 0, -1);
                                $getchar = preg_split('//', $coursegetchr, -1);

                                        $credit=$getchar[7];
                                        if(($credit=="a")||($credit=="A")){
                                            $credit="&#945;";
                                                }
                                        elseif(($credit=="b")||($credit=="B")){
                                            $credit="&#946;";
                                                    }
                                        elseif(($credit=="d")||($credit=="D")){
                                            $credit="&#948;";
                                                    }
                                        else{
                                            $credit=$credit;
                                            }

                                $temdiscos2=$ccdwoutcrd.$credit;
                            ////////////////////////////////////////////////////////////////////////////////////////
                                ////////////////////////////////////////////////////////
                                $getchar = preg_split('//', $temdiscos2, -1);

                                $midcredit=$getchar[5];
                                if($midcredit=="b"){
                                    $getlob=explode('b',$temdiscos2);
                                        $fistprt=$getlob[0];
                                        $sectprt=$getlob[1];
                                        $fulcode=strtoupper($fistprt)."b".$sectprt;
                                                        }

                                elseif($midcredit=="B"){
                                    $getlob=explode('B',$temdiscos2);
                                        $fistprt=$getlob[0];
                                        $sectprt=$getlob[1];
                                        $fulcode=strtoupper($fistprt)."b".$sectprt;
                                                        }
                                else{
                                $fulcode=strtoupper($temdiscos2);
                                }
                                ////////////////////////////////////////////////////
	
	
	
	
	

		$coreg=strtoupper($coreg2);
	$cname2=$qcoreg['name'];
		$cname=ucfirst($cname2);
	$status=$qcoreg['degree'];
	if($status==1){
		$dgstas="Degree";
			}
	else{
		$dgstas=" Non Degree";
		}

$chkrp=$rp->checkrepeat($stno57,$coreg);
if($chkrp=="yes"){
$norp=$norp+1;
//echo$coreg."-".$chkrp."<br>";

		$quechkexregi="select id,confirm,Last_update from exam_registration where student='$stno57' and course='$coreg'and acedemic_year='$acyart' and semester=$seme";
		$quchkexregi=mysql_query($quechkexregi);
		if(mysql_num_rows($quchkexregi)!=0){
			while($qchkexregi=mysql_fetch_array($quchkexregi)){
				$id=$qchkexregi['id'];
				$confirm=$qchkexregi['confirm'];
				$lstup=$qchkexregi['Last_update'];

										}


			if($confirm==0){
			echo"<form method=POST action='./index.php?view=admin&admin=57&task=onest&due=onestcnf'><tr class=trbgc><td align=center>$fulcode<td>".ucfirst($cname)."<td align=center>$dgstas<td align=center>Not Confirm<td align=center><input type=hidden name=cnfid value=$id><input type=submit value='Confirm'></tr></form>";
					}
			if($confirm==1){
			echo"<form method=POST action='./index.php?view=admin&admin=57&task=onest&due=onestcnle'><tr class=selectbg><td align=center>$fulcode<td>".ucfirst($cname)."<td align=center>$dgstas<td align=center>Confirmed as Eligiblel<td align=center><input type=hidden name=cnfid value=$id><input type=hidden name=lstup value=$lstup><input type=submit value='Cancel'></form></tr>";
					}





							}
		else{
			echo"<form method=POST action='./index.php?view=admin&admin=57&task=onest&due=onestrgncnf'><tr class=selectbg4><td align=center>$fulcode<td>".ucfirst($cname)."<td align=center>$dgstas<td align=center>Not Register<td align=center>";

			echo"<input type=hidden name=cnfcod value=$coreg>";
			echo"<input type=hidden name=cnfdgst value=$status>";
			
			echo"<input type=submit value='Register & Confirm'></form></tr>";

			}

					}

						}

if($norp==0){
echo"<tr class=selectbg4><td align='center' colspan=5>No Repeate Subject</td>";
		}


echo"</table>";
}

echo"<hr class=bar>";





		}
else{
echo"This student is level one ,there are no repeat subject !";
	}
}//valied student if close
			}/////task if close

///////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////// end one st confirm //////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////


echo"<h4>*** BULK CONFIRMATIONS ***</h4>";

echo"<form method=POST action='./imp_exp/rpt_reg_conf.php'>";
echo"<table border=0><tr class=trbgc><td>";

echo"Select Student's Level to Confirm Repeate Subjects";

echo"<td><select name=rpcnflvl>";
	echo"<option value='all' selected>All Repeate Students</option>";
	echo"<option value='2'>Currently Level 2 Repeate Students</option>";
	echo"<option value='3'>Currently Level 3 Repeate Students</option>";
	echo"<option value='0'>Pass out Repeate Students</option>";

echo"</select>";
echo"<td><input type=hidden name=crsem value=$seme> <input type=hidden name=cracy value=$acyart><input type=submit value=Search>";
 
echo"</tr></table></form>";




?>




<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>
