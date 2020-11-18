<?php
//error_reporting(0);
session_start();
if((($_SESSION['login'])=="truefohssmis")&&($_SESSION['role']!="student")){

include'../connection/connection.php';

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

$quepers="SELECT id FROM permission WHERE role_id=$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
    
if($qpers['id']=="59"){
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
$vmd=new settings();
echo"<h3>Medical Certificates of Examinations</h3>";


$viewbatch=$vmd->getBatch($mdstnumber);
$viewmdstnm=$vmd->getName($mdstnumber);
$viewmdstlvl=$vmd->getLevel($mdstnumber);


$quegtstrm="select stream from student where id='$mdstnumber'";
$qugtstrm=mysql_query($quegtstrm);
$qgtstrm=mysql_fetch_array($qugtstrm);
	$gtstrm=$qgtstrm['stream'];

	if($gtstrm=="phy"){
		$strm="Physical Science";
				}
	elseif($gtstrm=="bio"){
		$strm="Biological Science";
				}
	elseif($gtstrm=="bcs"){
		$strm="Computer Science";
				}
	else{
		$strm="No Stream";
		}





$quegetmddata="select academic_year, exam_date_time, semester, contact_no from exam_medical where student ='$mdstnumber' order by academic_year,semester";
$qugetmddata=mysql_query($quegetmddata);
if(mysql_num_rows($qugetmddata)==0){
	echo"<font color=red>Sorry! No Medical Certificates found for SC/$viewbatch/$mdstnumber</font>";
					}
else{
$chkrptmd="nil";
$newmedical="nil";
$duplicos="nil";
while($qgetmddata=mysql_fetch_array($qugetmddata)){
	$mdacademic_year=$qgetmddata['academic_year'];
	$exam_date_time=$qgetmddata['exam_date_time'];
		$gtexyear=explode("-",$exam_date_time);
		$exyear=$gtexyear[0];
	$semester=$qgetmddata['semester'];
	$contact_no=$qgetmddata['contact_no'];
	

	if($chkrptmd!=$mdacademic_year){	
	echo"<table border=0 class=bgc width=100%>";
	echo"<tr><td width=35%>01. Name <td>: ".strtoupper($viewmdstnm)."</tr>";
	echo"<tr><td>02. Registration Number <td>: SC/$viewbatch/$mdstnumber </tr>";
	echo"<tr><td>03. Academic Status <td>: $mdacademic_year Academic & Semester $semester</tr>";
	echo"<tr><td>04. Examination Year <td>: $exyear</tr>";
	echo"<tr><td>05. Contact Number <td>: $contact_no</tr>";
	echo"<tr><td>06. Degree Programme <td>: $strm</tr>";
	echo"<tr><td colspan=2>07. Details of Subjects corrected by the Medical certificate: </tr>";
	echo"<tr><td colspan=2>";
		echo"<table border=1 bordercolor='black' cellspacing=0>";
			echo"<th>No<th>Subject Code<th>Name of Subject<th>Date/Time of the Examination<th>Certificate No<th>Period of Covered<th>Issued By<th>Hand Over Date";
				$i=1;
				$quegetmedsub="select em.*, c.name from exam_medical em ,courseunit c where em.student ='$mdstnumber' and  em.academic_year='$mdacademic_year' and c.code=em.course order by em.academic_year,em.semester,em.course";
				$qugetmedsub=mysql_query($quegetmedsub);
				while($qgetmedsub=mysql_fetch_array($qugetmedsub)){
					$course=$qgetmedsub['course'];
					////////////////////////////////////////////////////////////////////////////////////////
					////////////////////////////////////////////////////////////////////////////////////////
                                $coursegetchr=trim($course);
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
								$ccode2=$fulcode;
					////////////////////////////////////////////////////////////////////////////////////////







					$cname=$qgetmedsub['name'];
					$med_certif_no=$qgetmedsub['med_certif_no'];
					$cover_period=$qgetmedsub['cover_period'];
					$issued_by=$qgetmedsub['issued_by'];
						$gtissued=explode("/",$issued_by);

						$issuddata=ucfirst($gtissued[1])." at ".$gtissued[0];
					$submit_date=$qgetmedsub['submit_date'];
						$gthadovrdt=explode("/",$submit_date);
						$hadovrdt=$gthadovrdt[0];
						$appdby=$gthadovrdt[1];

					$medstatus=$qgetmedsub['status'];


					
					echo"<tr><td align=center>$i<td align=center>$ccode2<td>&nbsp;".ucfirst($cname)."<td align=center>$exam_date_time<td align=center>$med_certif_no<td align=center>".ucfirst($cover_period)."<td>$issuddata<td align=center>$hadovrdt</tr>";

						$i++;
											}
		echo"</table>";
	echo"</tr>";

	if($medstatus!=null){
	echo"<tr><td colspan=2 align=right>Medical is $medstatus</tr>";
				}
	else{
	echo"<tr><td colspan=2 align=right>&nbsp;</tr>";
		}
	echo"</table><br>";
					}

	$chkrptmd=$mdacademic_year;
							}//medical while

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


