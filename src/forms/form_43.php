<?php
session_start();
if(($_SESSION['login'])=="truefohssmis"){

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
@media print {
input#btnPrint {
display: none;
}
}
</style>
<style type="text/css">
@import url('../style/default.css');
</style>


<?php
echo"<div id='b'>";

echo"<table border='0' width='100%'><tr><td align='left' valign='top'>";
echo"<form method='POST' action='../index.php?view=admin&admin=43'>";
echo"<input type='submit' value='Back' id='btnPrint'>";
echo"</form>";
echo"</td><td align='right' valign='top'>";
echo "<input type='button' id='btnPrint' onclick='window.print();' value='Print Page' /></td></tr></table>";
include'../admin/config.php';




mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

//...............get acc_year....................
$acc_year="select acedemic_year from acc_year where current='1'";
$ac_year=mysql_query($acc_year);
while($a_y=mysql_fetch_array($ac_year)){
$acy=$a_y['acedemic_year'];
}
//.................................................			

//...........get semester..........
$queprac="select * from call_registration";
$quprac=mysql_query($queprac);
while($qup=mysql_fetch_array($quprac)){
$cseme=$qup['semister'];
}
//.................................................			


//get confirmed student numbers accordin to accedemic year and semester............
$querpgnt="select DISTINCT student from registration where acedemic_year='$acy' and semister=$cseme and confirm=1 order by student";
//echo$querpgnt;
$qurpgnt=mysql_query($querpgnt);
$pgno=0;
$odarr=array();
$fore=array();
for($ar=0;$ar<10000;$ar++){
		$odarr[$ar]=(2*$ar)+1;
				}

$tbl=0;
for($fo=0;$fo<10000;$fo++){
		$fore[$fo]=2*$fo;
				}



while($qrpgnt=mysql_fetch_array($qurpgnt)){

$pgno=$pgno+1;




if (in_array($pgno, $odarr)){
if (in_array($tbl, $fore)){
echo'<p style="page-break-after: always">';
}
echo"<table border='0' align='center'><tr><td>";
$tbl=$tbl+1;

	}
else{
echo"<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>";
	}


$rpstno=$qrpgnt['student'];


//..........................................................................
echo"<table border='2' bordercolor='#040006' cellspacing='0' style='border-collapse: collapse' width='345px' height='425px' ><tr><td align='center' valign='top'>";
echo"<table border='0' width='340px'>";
//echo"<font color='#030000'>";

//echo"<tr><td colspan='4' align='center'>&nbsp;</td></tr>";
//....get ful name of above student...................
$querpgnt2="select l_name, initials, batch from student where id='$rpstno'";
//echo$querpgnt2;
$qurpgnt2=mysql_query($querpgnt2);
if(mysql_num_rows($qurpgnt2)!=0){
while($qrpgnt2=mysql_fetch_array($qurpgnt2)){
$l_name=$qrpgnt2['l_name'];
$initials=$qrpgnt2['initials'];
$year=$qrpgnt2['batch'];
					}//get name while
				}
else{

$l_name="Not-Define";
$initials=" ";
$year="ND";

	}
$getlevl="select l.level from level l, student s where s.id='$rpstno' and s.year=l.year";
//echo$getlevl;
$gtlevl=mysql_query($getlevl);
$glevl=mysql_fetch_array($gtlevl);
$levl=$glevl['level'];
//.....................................................
echo"<tr><td colspan='4' align='left'><font size='2px' color='#030000'>විද්‍යාවේදී (සාමාන්‍ය) උපාධි-  $levl ස්ථලය<br>Bachelor of Science(General) Degree- Level $levl<br>අධ්‍යයන වර්ෂය / Academic Year -<b> $acy</b>";
//echo"<br>අධ්‍යයන පාඨමාලා / Courses of Study";
echo"</font></td></tr>";
echo"<tr><td align='left' colspan='2'><font color='#030000'>Student Id</font></td><td align='right' colspan='2'><font color='#030000'> Name with initials</font></td><tr>";

echo"<tr><td align='left' colspan='2'><font color='#030000'><b>SC/$year/$rpstno</b></font></td><td align='right' colspan='2'><font color='#030000'><b>$l_name $initials</b></font></td></tr>";


echo"<tr><td colspan='1' align='left'><font color='#030000'>Course Unit</font></td><td colspan='1' align='center'><font color='#030000'>Course Unit Name</font></td><td align='right'><font color='#030000'>Certification <br>of the Dept.</font></tr>";

echo"<tr><td colspan='4' align='center'><table border='1' width='340px'  bordercolor='#040006' cellspacing='0' cellpadding='0' >";
//...............get course details...........................
$querpgnt3="select c.name,c.code from courseunit c, registration r where r.student='$rpstno' and r.confirm=1 and r.course=c.code and r.acedemic_year='$acy' and r.semister=$cseme";
//echo$querpgnt3;
$qurpgnt3=mysql_query($querpgnt3);
while($qrpgnt3=mysql_fetch_array($qurpgnt3)){
$cname=$qrpgnt3['name'];
$ccodegt=$qrpgnt3['code'];
////////////////////////////////////////////////////////////////////////////////////////
                                $coursegetchr=trim($ccodegt);
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

                                $rehcoscode2=$ccdwoutcrd.$credit;
                            ////////////////////////////////////////////////////////////////////////////////////////
                                ////////////////////////////////////////////////////////
                                $getchar = preg_split('//', $rehcoscode2, -1);

                                $midcredit=$getchar[5];
                                if($midcredit=="b"){
                                    $getlob=explode('b',$rehcoscode2);
                                        $fistprt=$getlob[0];
                                        $sectprt=$getlob[1];
                                        $fulcode2=strtoupper($fistprt)."b".$sectprt;
                                                        }

                                elseif($midcredit=="B"){
                                    $getlob=explode('B',$rehcoscode2);
                                        $fistprt=$getlob[0];
                                        $sectprt=$getlob[1];
                                        $fulcode2=strtoupper($fistprt)."b".$sectprt;
                                                        }
                                else{
                                $ccode=strtoupper($rehcoscode2);
                                }
                                ////////////////////////////////////////////////////


//echo$ccode;
echo"<tr><td align='left' width='15%'><font color=#030000>";
echo strtoupper($ccode);
echo"</font></td><td align='left' width='60%' ><font color='#030000' size='2px'>&nbsp;$cname</font></td>";
echo"<td align='left' width='25%'><font color='#030000'>&nbsp;</font></td></tr>";
					}// get course details

echo"</table></td></tr>";





error_reporting(0);

echo"<tr><td colspan='4' align='left'>&nbsp;</td></tr>";
echo"<tr><td colspan='2' align='left'><font color='#030000'>Date:&nbsp;</font>";
echo"<font color='#030000'>".date('d-m-Y')."</font>";

echo"</td><td colspan='2' align='right'><font color='#030000'>......................................</font></td></tr>";
echo"<tr><td colspan='2' align='left'><font color='#030000'>[$pgno]&nbsp;</font></td><td colspan='2' align='right'><font color='#030000'>SAR / Science&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td></tr>";

echo"</table></td></tr></table>";

if (in_array($pgno, $odarr)){
echo"</td>";
}
else{
echo"</td></tr></table><br>";
	}
echo"</p>";

}//mail while

echo"</div>";

?>



<?php

}	
else{

echo "You Have Not Permission To Access This Area!";}

?>

