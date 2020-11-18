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
if($qpers['id']=="43"){
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
echo"Print Reports";
require_once('./classes/globalClass.php');
$r=new settings();	
echo"<hr class=bar>";

echo"[ <a href='./forms/form_43.php'>Click Here to Print Record Books</a> ] <br><br>";

echo"Print One Record Book<br><br>";
include'./forms/form_43_0.php';
if($task=="printonerek"){
echo"<br>";
$stno=$_POST['index_8_5'];
$stbtno=$_POST['year_8_5'];

$stbt=$r->getBatch($stno);
if($stbtno!=$stbt){
echo"<font color='red'>( SC/$stbtno/$stno ) Invalid student number ! Recheck student number.</font>";
					}
else{
//echo$stbtno.$stno;
$crrseme=$r->getSemister();
$crracayr=$r->getAcc();
$stnm=$r->getName($stno);


echo"Registration Details of $stnm ( SC/$stbtno/$stno ) <br>at Semester $crrseme of $crracayr Academic Year<br><br>";
$quegtreg="select c.name,c.code from courseunit c, registration r where r.student='$stno' and r.confirm=1 and r.course=c.code and r.acedemic_year='$crracayr' and r.semister=$crrseme";
//echo$quegtreg;
$qugtreg=mysql_query($quegtreg);
if(mysql_num_rows($qugtreg)==0){
	echo"<font color='red'>Sorry ! Cannot find registration details of SC/$stbtno/$stno </font>";
								}
else{
echo"<table border=0><tr><th>Course Unit<th>Course Unit Name</tr>";
while($qgtreg=mysql_fetch_array($qugtreg)){

$code=$qgtreg['code'];
$name=$qgtreg['name'];

////////////////////////////////////////////////////////////////////////////////////////
                                $coursegetchr=trim($code);
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
                                $fulcode2=strtoupper($rehcoscode2);
                                }
                                ////////////////////////////////////////////////////

echo"<tr class='trbgc' ><td align='center'>".$fulcode2."<td>".ucfirst($name)."</tr>";
											}
											
echo"</table><br>";

}



	}
}
echo"<hr class=bar>";
echo"[ <a href='./forms/form_43_a.php'>Click Here to Check Student's Degree Medium</a> ]";
echo"<hr class=bar>";



i






?>


<?php
}
}	
else{

echo "You Have Not Permission To Access This Area!";
}

?>

