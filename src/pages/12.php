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
if($qpers['id']=="12"){
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
//////////////edit by iranga ////////////////////////////////////////////////////
require_once('./classes/globalClass.php');
$vr12=new settings();
/////////////////////////////////////////////////////////////////////////////////
	
echo "Search Results form Course Unit<hr class=bar><br>";
						include 'forms/form_12.php';
						
						echo "<hr class=bar><br>";


			if(($task=='deprslt')&&(isset($_POST['submit']))){
						$level_12=$_POST['level_12'];
						$sub_12=$_POST['sub_12'];
                        ///////////////////////////////////////////////////////
 ////////////////////////////////////////////////////////////////////////////////////////
            $coursegetchr=trim($sub_12);
                              $fulcode3=strtoupper($coursegetchr);
                                
                            ////////////////////////////////////////////////////

                      
                      
///////////////////////////////////////////////////////////                       
                        
                        
                        //////////////////////////////////////////////////////
						if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
							$chkdept="all";
						}
						
							$department_12=$_SESSION['section'];
						

						// view Results
						echo "Searched Results of  currently in Level ".$level_12."000 Students<br><br>";
						
						if($chkdept=="all"){
							$query_12_2="select r.userName, s.batch, r.grade, r.Date as exyear, c.name from rumisdb.fohssmisResult r, courseunit c, student s, level l where r.userName=s.id and l.level='$level_12' and  r.subject_code='$sub_12' and s.year=l.year and r.subject_code=c.code order by r.userName";
						}
						else{
							$query_12_2="select r.userName, s.batch, r.grade, r.Date as exyear, c.name from rumisdb.fohssmisResult r, courseunit c, student s, level l where r.userName=s.id and l.level='$level_12' and c.department='$department_12' and r.subject_code='$sub_12' and s.year=l.year and r.subject_code=c.code order by r.userName";
							
						}
						
						//echo$query_12_2;
						$res_vw2=mysql_query($query_12_2);
						
						
						
						if(mysql_num_rows($res_vw2)!=0){
						$deptrsl=1;
						echo '<table border="0" width="62%"><tr><th width="2%">#<th width="20%">Student Number<th width="20%">Grade<th width="20%">Examination Date</tr>';
						
						$stindxdup="nil";
						while($data=mysql_fetch_array($res_vw2)){

						$byear=$data['batch'];
						$indx=$data['userName'];
						//////////////////////////////////////////////////////////////////
						$stprmtnum=$vr12->getStudentNumber($indx); 
						if($stprmtnum==null){
							$lastdisgt=substr("$indx",2);
							$stprmtnum="HS/".byear."/".$lastdisgt;
						}
						//////////////////////////////////////////////////////////////////
						$csnm=$data['name'];
						
						$stindx=trim($stprmtnum);

						
						
						if($stindx==$stindxdup){
							echo "<tr class=selectbg><td align='center'>$deptrsl<td align='right'>".$stindx." [Re Attempt]<td align='center'>".$data['grade']."<td align='center'>".$data['exyear']."</tr>";
							}
						else{
							echo "<tr class=trbgc><td align='center'>$deptrsl<td align='center'>".$stindx."<td align='center'>".$data['grade']."<td align='center'>".$data['exyear']."</tr>";
							}
						$stindxdup=$stindx;		


						//echo "<tr><td>".$stindx."<td>".$data['exyear']."<td>".$data['grade']."</tr>";
						$deptrsl++;
						}
						echo"<caption>$fulcode3 - ".$csnm."</caption>";
						echo "</table>";
												}
				else{
					echo"<br><font color='red'>Sorry ! Cannot find Results.</font>";	
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

