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
if($qpers['id']=="56"){
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
$n=new settings();
$crsemster=$n->getSemister();

echo"All Registration Status of Student by Semester Wise";
echo"<hr class=bar>";
echo"<h3>*** Registration Status of One Student ***</h3>";
include './forms/form_56.php';

if($task=="onest"){
$byear=$_POST['year56'];
$stno=$_POST['index56'];
$stregbt=$n-> getBatch($stno);
$stname=$n->getName($stno);

//echo$byear.$stno.$stregbt.$stnm;

if($byear!=$stregbt){

echo"<font color='red'>Sorry !, HS/$byear/$stno is Invalid Student Number.</font><br>";
		      }
else{

echo"<b>All Registration Status of $stname ( HS/$stregbt/$stno )<br>";
$crlvl=$n->getLevel($stno);

if($crlvl==0){
	$crlvl2="Pass out student";
		}
else{
	$crlvl2="Level ".$crlvl." Student";

	}

echo$crlvl2." </b><br>";
$semone=array();
$semone=$n->regsemesters($stno);
$semcount=count($semone);
            if($crsemster==1){
                $semcount=$semcount-1;
            }
            else{
                $semcount=$semcount;
            }


echo"<table border=0><tr><th>Student No<th>Details";
for($i=1;$i<=$semcount;$i++){

echo"<th>Semester $i</th>";
				}
echo"<th>Total Credits";

echo"</tr>";
echo"<tr class=trbgc><td align=center><b>HS/$stregbt/$stno</b></td>";

echo"<form method=POST action='./forms/mentor.php?task=viewinf' ><td><input type=submit value='View'><input type=hidden name=year_8_5 value='$stregbt'><input type=hidden name=index_8_5 value='$stno'><input type=hidden name=vfrom value='56'><input hidden=text name=vfromtp value='one'>


</td></form>";



for($j=0;$j<$semcount;$j++){
echo"<td align=center>";
	if($semone[$j]=="yes"){
		echo"<img src=images/r2.png>";

				}
	else if($semone[$j]=="no"){
		echo '<img src=images/w2.png>';
		}
	else{
		echo"Can not Find!";
		}



echo"</td>";

				}
echo"<td align=center><b>";
$quetotcrd="select sum(c.credits) as totcd from registration r, courseunit c where r.student='$stno' and r.course=c.code and r.degree='1' and r.confirm='1'";
$qutotcrd=mysql_query($quetotcrd);

while($qtotcrd=mysql_fetch_array($qutotcrd)){
	$totcrd=$qtotcrd['totcd'];
					}
if($totcrd==NULL){
$totcrd2=0;
			}
else{
$totcrd2=$totcrd;
}

echo$totcrd2;

echo"</b></td></tr></table>";
      }


		  }


//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
echo"<hr class=bar>";
echo"<h3>***Registration Status Filter by Student's Level ***</h3>";

echo"<table border=0><tr height=40px class=trbgc>";
echo"<td valign=bottom>Select Level to find Registration Status :";

echo"<form method='POST' action='index.php?view=admin&admin=56&task=lvlflt'>";
echo"<td><select name='lvlfl'>";
	echo"<option value=1>Level 1</option>";
	echo"<option value=2>Level 2</option>";
	echo"<option value=3>Level 3</option>";
echo"</select>";


echo"<td><select name=dropst>";
	echo"<option value='All' selected>All Student</option>";
	echo"<option value='Drop'>Drop Student Only</option>";
echo"</select>";


echo"<td><input type=submit value='Find'></form></tr></table><br>";


if($task=="lvlflt"){
$levl2=$_POST['lvlfl'];
$drop2=$_POST['dropst'];
$fmviweque="$rmsdb.fohssmisStudents fs"; 

if(($levl2!=NULL)&&($drop2!=null)){
$_SESSION['levl2']=$levl2;
$_SESSION['drop2']=$drop2;
				}
$levl=$_SESSION['levl2'];
$drop=$_SESSION['drop2'];

if($crsemster==1){
    $sem=($levl*2)-1;
}
else{
$sem=$levl*2;
}
echo"<b>Registration Status of Level $levl [ $drop ] Students</b><br>";

	$quegtlvlst="select s.id, s.batch, s.l_name, s.initials, s.stream from student s, level l, $fmviweque where l.level='$levl' and l.year=s.year and concat('sc',s.id)=fs.user_name order by s.id";
	//echo$quegtlvlst;
	$qugtlvlst=mysql_query($quegtlvlst);
	if(mysql_num_rows($qugtlvlst)!=0){
		$no=1;
		$dno=1;	
		echo"<table align=center ><tr>";

		echo"<th>No</th><th>Student Number<th>Details</th><th> Name with  Initials</th><th>Stream";

			for($l=1;$l<=$sem;$l++){
				echo"<th><font size=2px>Semester</font> $l</th>";
						}
		echo"<th>Total Credits";

	
		while($qgtlvlst=mysql_fetch_array($qugtlvlst)){
			$sid=$qgtlvlst['id'];
			$sbatch=$qgtlvlst['batch'];
			$sl_name=$qgtlvlst['l_name'];
			$siniti=$qgtlvlst['initials'];
			$sstream=$qgtlvlst['stream'];
				if($sstream=="phy")
					{$sstream2="Phy. Science";}
				else if($sstream=="bio")
					{$sstream2="Bio. Science";}
				else
					{$sstream2="B.C. Science";}


		

///////////////////////////////////////////////////////////////////////////////////////
		if($drop=="All"){
			echo"<tr class=trbgc><td align=center>$no</td><td align=center>SC/$sbatch/$sid</td>";
///////////////////////////////////////view////////////////////////////////////////
echo"<form method=POST action='./forms/mentor.php?task=viewinf' ><td><input type=submit value='View'><input type=hidden name=year_8_5 value='$sbatch'><input type=hidden name=index_8_5 value='$sid'><input type=hidden name=vfrom value='56'><input type=hidden name=vfromtp value='all'></td></form>";

///////////////////////////////////////////////////////////////////////////////////
			echo"<td>$sl_name $siniti </td><td align=center>$sstream2</td>";


			$semstar=$n->regsemesters($sid);
			$semstarcount=count($semstar);
            if($crsemster==1){
                $semstarcount=$semstarcount-1;
            }
            else{
                $semstarcount=$semstarcount;
            }

				for($sc=0;$sc<$semstarcount;$sc++){
					echo"<td align=center>";
						if($semstar[$sc]=="yes"){
							echo"<img src=images/r2.png>";

									}
						else if($semstar[$sc]=="no"){
							if($sc==5){
									$quetotcrd="select sum(c.credits) as totcd from registration r, courseunit c where r.student='$sid' and r.course=c.code and r.degree='1' and r.confirm='1'";
									$qutotcrd=mysql_query($quetotcrd);
									while($qtotcrd=mysql_fetch_array($qutotcrd)){
											$totcrd=$qtotcrd['totcd'];

															}
									//echo$totcrd;
										if($totcrd>=90){
											
											echo"<b>Credit Compleate</b>";
												}
										else{
											echo '<img src=images/w2.png>';
											}


										}
							else{
								echo '<img src=images/w2.png>';
									}



							}
						else{
							echo"ND";
							}
					echo"</td>";



									}
						echo"<td align=center><b>";
							$quetotcrd2="select sum(c.credits) as totcd from registration r, courseunit c where r.student='$sid' and r.course=c.code and r.degree='1' and r.confirm='1'";
							$qutotcrd2=mysql_query($quetotcrd2);

							while($qtotcrd2=mysql_fetch_array($qutotcrd2)){
										$totcrd2=$qtotcrd2['totcd'];
													}
								if($totcrd2==NULL){
								$totcrd22=0;
											}
								else{
								$totcrd22=$totcrd2;
								}

							echo$totcrd22;

							echo"</b></td>";


					}
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
		if($drop=="Drop"){
			$drpst=array();
            $dropst="no";
			$semstar=$n->regsemesters($sid);
			$semstarcount=count($semstar);
            if($crsemster==1){
                $semstarcount=$semstarcount-1;
            }
            else{
                $semstarcount=$semstarcount;
            }

				for($dr=0;$dr<$semstarcount;$dr++){
					if($semstar[$dr]=="yes"){
						$drpst[$dr]="false";
								}
					elseif($semstar[$dr]=="no"){
						if($dr==5){
									$quetotcrd="select sum(c.credits) as totcd from registration r, courseunit c where r.student='$sid' and r.course=c.code and r.degree='1' and r.confirm='1'";
									$qutotcrd=mysql_query($quetotcrd);
									while($qtotcrd=mysql_fetch_array($qutotcrd)){
											$totcrd=$qtotcrd['totcd'];

															}
									//echo$totcrd;
										if($totcrd>=90){
											$drpst[$dr]="false";
												}
										else{
											$drpst[$dr]="true";
											}


										}
						else{
							$drpst[$dr]="true";
							}




								}
					else{
						$drpst[$dr]="false";
								}
					
									}

					if (in_array("true", $drpst)){
					    $dropst="yes";
						echo"<tr class=trbgc><td align=center>$dno</td><td align=center>SC/$sbatch/$sid</td>";
////////////////////////////////////////////////////////////////////////////////view////////////////////////////////////////
						echo"<form method=POST action='./forms/mentor.php?task=viewinf' ><td><input type=submit value='View'><input type=hidden name=year_8_5 value='$sbatch'><input type=hidden name=index_8_5 value='$sid'><input type=hidden name=vfrom value='56'><input type=hidden name=vfromtp value='all'></td></form>";

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

						echo"<td>$sl_name $siniti </td><td align=center>$sstream2</td>";
					for($drc=0;$drc<$semstarcount;$drc++){
						echo"<td align=center>";
							if($semstar[$drc]=="yes"){
								echo"<img src=images/r2.png>";

										}
							else if($semstar[$drc]=="no"){
								echo '<img src=images/w2.png>';
								
								}
							else{
								echo"UnD";
								}
						echo"</td>";
										}

///////////////////////////////////////////////////////////////////////////////////////////////
					echo"<td align=center><b>";
							$quetotcrd2d="select sum(c.credits) as totcd from registration r, courseunit c where r.student='$sid' and r.course=c.code and r.degree='1' and r.confirm='1'";
							$qutotcrd2d=mysql_query($quetotcrd2d);

							while($qtotcrd2d=mysql_fetch_array($qutotcrd2d)){
										$totcrd2d=$qtotcrd2d['totcd'];
													}
								if($totcrd2d==NULL){
								$totcrd22d=0;
											}
								else{
								$totcrd22d=$totcrd2d;
								}

							echo$totcrd22d;

							echo"</b></td>";


////////////////////////////////////////////////////////////////////////////////////////////////



				
						$dno++;
							}

					}
////////////////////////////////////////////////////////////////////////////////////////////
		

				$no++;
								}
//echo$dropst;
    if($dropst=="yes"){
	$clsp=$l+6;
    echo"<tr class=selectbg4><td colspan=$clsp align=center>Sorry!There are no any drop student found";
            }   

		echo"</table>";

						}

		}


//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////


echo"<hr class=bar>";








?>



<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>
