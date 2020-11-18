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
if($qpers['id']=="41"){
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
//echo"Practical Registration not start yet";

//......edit by iranga
//..........students' practical registration presses
echo "Group Registrations";
echo"<hr class=bar>";



$std_id=$_SESSION['user_id'];

//////////////edit by iranga ////////////////////////////////////////////////////
require_once('./classes/globalClass.php');
$l=new settings();


///////////////////////check student passout or not/////////////////////////////////
//............get st level...........................
$stlvl=$l->getLevel($std_id);
//..................................................

if($stlvl!=0){
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

//check practical registration start or stop............
$questart="select status,end_date from call_prac_registration";
$questa=mysql_query($questart);
while($qust=mysql_fetch_array($questa)){
	$start_st=$qust['status'];
	$end_date=$qust['end_date'];
					}
//get level semester and batch of student.................
$query41="select l.level, l.semister, s.batch from level l,student s where s.year=l.year and s.id='$std_id'";
$datais=mysql_query($query41);
while($ldata=mysql_fetch_array($datais)){
	$level_st=$ldata['level'];
	$semi_st=$ldata['semister'];
	$batch=$ldata['batch'];
					}
//get acc current acc year.......................
$queacc="select * from acc_year where current='1'";
$quacc=mysql_query($queacc);
while($qacc=mysql_fetch_array($quacc)){
$acc_ye=$qacc['acedemic_year'];
				      }


////practical registration prosses by student
$task=$_GET['task'];
$sub=$_POST['sub'];
$date=$_POST['date'];
$time=$_POST['time'];
$group=$_POST['group'];
$hours=$_POST['hours'];
$tot=$_POST['tot'];

$choice=$_POST['cochoice'];
$submit=$_POST['pregi'];
//////registration query...................
if($task=='preg')
{
//echo " ".$std_id." ".$acc_ye." ".$task." ".$sub." ".$date." ".$time." ".$group." ".$hours." ".$tot." ".$choice." ".$submit."<br>";
$queinsert="insert into Prac_registration(student,acc_year,semester,subject,prac_group,date,time,hours,choice,status) values('$std_id','$acc_ye',$semi_st,'$sub','$group','$date','$time',$hours,'$choice','$submit')";
mysql_query($queinsert);
}
//////remove query.......................
if($task=='cancel'){
$quedelete="delete from Prac_registration where student='$std_id' and subject='$sub' and prac_group='$group' and acc_year='$acc_ye'";
mysql_query($quedelete);
}

// practical registration start..........and student's  practical registration presses.....
if($start_st=='1'){
echo "Group Registration for ".$acc_ye." Accademic Year and Semester ".$semi_st." .<br>";
//echo "<font color='blue'>Student must be register at least more than one group for each subject as your choice.</font><br>";
echo"<font color='red'>Do modification before : ".$end_date.".</font><br>"; 
////check co course unit.................................

$query_1_6="select course from registration where student='$std_id' and confirm='1'and (semister=$semi_st or semister='3') and acedemic_year='$acc_ye'";
//echo $query_1_6;
$check41=mysql_query($query_1_6);

echo"<table border='0' >";
$noprac="no";
$ctgprgst=1;
echo "<tr align='center'><th>#<th>Subject<th>Group Name<th>Date<th>Time<th>Hours<th>No of Available Seat<th>Choice<th>Status<th>Group Members<th>Venue</th></tr>";
while($check=mysql_fetch_array($check41)){
	
	$che=$check['course'];
	//echo " ".$che." ";
$que41="select * from practical_session where subject='$che' and acc_year='$acc_ye'  order by subject";
//echo$que41;
$qu41=mysql_query($que41);
if(mysql_num_rows($qu41)!=0){
$noprac="yes";
while($q41=mysql_fetch_array($qu41)){
$sub=$q41['subject'];
$date=$q41['date'];
$time=$q41['time'];
$gtype=$q41['grouptype'];
$hours=$q41['hours'];
$tot=$q41['max_amount'];
$venue=$q41['Venue'];

$que_check="select * from Prac_registration where student='$std_id' and subject='$sub' and prac_group='$gtype' and acc_year='$acc_ye'";
$qu_chk=mysql_query($que_check);
while($q_chk=mysql_fetch_array($qu_chk)){
$st=$q_chk['student'];
$acy=$q_chk['acc_year'];
$sem=$q_chk['semester'];
$su=$q_chk['subject'];
$pg=$q_chk['prac_group'];
$dt=$q_chk['date'];
$tm=$q_chk['time'];
$hu=$q_chk['hours'];
$ch=$q_chk['choice'];
$st=$q_chk['status'];
}
if(mysql_num_rows($qu_chk)=='0'){

$que_count="select count(student) as stnum from Prac_registration where subject='$sub' and prac_group='$gtype' and acc_year='$acc_ye'";
$qu_count=mysql_query($que_count);
while($q_count=mysql_fetch_array($qu_count)){
$stnum=$q_count['stnum'];
$vac=$tot-$stnum;
					    }
///.............check vacancy...........................
if($vac>0){
////// query for check choice............

echo "<form name='pra_reg' method='POST' action='./index.php?view=admin&admin=41&task=preg'>";
echo"<tr class=trbgc align=center><td>$ctgprgst<td>$sub<input type='hidden' name='sub' value=$sub></td><td>$gtype<input type='hidden' name='group' value=$gtype></td><td>$date<input type='hidden' name='date' value=$date></td><td>$time<input type='hidden' name='time' value=$time></td><td>$hours<input type='hidden' name='hours' value=$hours></td><td>".$vac." out of ".$tot."<input type='hidden' name='tot' value=$tot></td>";
echo "<td><select name='cochoice'>";
	$que_choice="select count(grouptype) as pgtot from practical_session where subject='$sub' and acc_year='$acc_ye'";
	$qu_cho=mysql_query($que_choice);

	while($q_cho=mysql_fetch_array($qu_cho)){
		$item=$q_cho['pgtot'];
						}
	
	for($k=0;$k<$item ;$k++){
		$yarrr[$k]=0;
				}
	for($i=0;$i<=$item ;$i++){
	$quecho="select choice from Prac_registration where subject='$sub' and student='$std_id' and acc_year='$acc_ye' order by choice";
	$quch=mysql_query($quecho);

	if(mysql_num_rows($quch)!='0'){
		while($quchww=mysql_fetch_array($quch)){
		$cos=$quchww['choice'];
		if($cos==$i+1)
		{
		$yarrr[$i]=1;	
		}
							}
					}
				}

	for($j=1;$j<=$item ;$j++){
		if($yarrr[$j-1]==0)
		{
			echo"<option value=$j>$j</option>";
		}
				}
echo"</select></td>";
echo "<td><input type='submit' value='Register' name='pregi'></form></td>";

//echo"<td><a href='./index.php?view=admin&admin=41&task=checkgm&sub=$sub&gp=$gtype'>Check</a></td>";
echo"<form method=post action='./index.php?view=admin&admin=41&task=checkgm'><td>";
echo"<input type=hidden name=sub value='$sub'>";
echo"<input type=hidden name=gp value='$gtype'>";
echo"<input type=submit value='Check'>";
echo"</td></form>";

echo"<td>$venue</td></tr>";
echo"</form>";
$ctgprgst++;
	     }
/////////// no vacancy.....................
else{
echo"<tr align='center' class=selectbg><td>$ctgprgst<td>$sub</td><td>$gtype</td><td>$date</td><td>$time</td><td>$hours</td><td  colspan='3'>No Available Seat for This Group</td>";
//echo "<td><a href='./index.php?view=admin&admin=41&task=checkgm&sub=$sub&gp=$gtype'>Check</a></td>";
echo"<form method=post action='./index.php?view=admin&admin=41&task=checkgm'><td>";
echo"<input type=hidden name=sub value='$sub'>";
echo"<input type=hidden name=gp value='$gtype'>";
echo"<input type=submit value='Check'>";
echo"</td></form>";

echo "<td>$venue</td>";
$ctgprgst++;
    }
////////////////////////////////////////////////////////////////////////////////
			}
else{
$que_count="select count(student) as stnum from Prac_registration where subject='$sub' and prac_group='$gtype' and acc_year='$acc_ye' ";
$qu_count=mysql_query($que_count);
while($q_count=mysql_fetch_array($qu_count)){
$stnum=$q_count['stnum'];
$vac=$tot-$stnum;
}
echo "<form name='pra_reg' method='POST' action='./index.php?view=admin&admin=41&task=cancel'>";
echo"<tr align='center' class=selectbg><td>$ctgprgst<td>$sub<input type='hidden' name='sub' value=$sub></td><td>$gtype<input type='hidden' name='group' value=$gtype></td><td>$date<input type='hidden' name='date' value=$date></td><td>$time<input type='hidden' name='time' value=$time></td><td>$hours<input type='hidden' name='hours' value=$hours></td><td>".$vac." out of ".$tot."<input type='hidden' name='tot' value=$tot></td>";
echo "<td>$ch</td>";
echo "<td><input type='submit' value='Cancel' name='pregi'></form></td>";
//echo"<td><a href='./index.php?view=admin&admin=41&task=checkgm&sub=$sub&gp=$gtype'>Check</a></td>";
echo"<form method=post action='./index.php?view=admin&admin=41&task=checkgm'><td>";
echo"<input type=hidden name=sub value='$sub'>";
echo"<input type=hidden name=gp value='$gtype'>";
echo"<input type=submit value='Check'>";
echo"</td></form>";

echo"<td>$venue</td></tr>";
echo"</form>";
$ctgprgst++;
     }
}
}




}

if($noprac=="no")
{
	echo"<tr class=trbgc><td colspan=11 align=center>Sorry! There are no created group sessions</td></tr>"; 

		}

echo "</table>";

}
///////////////////////////////////////////////////////////


















//If Registration close.... display selected practical courses........

elseif($start_st=='0'){
echo"*** Group Registration Time Period is Over. ***<br>";
echo "Group Registration for ".$acc_ye." Accademic Year and Semester ".$semi_st." .";



$que_get="select * from Prac_registration where student='$std_id' and acc_year='$acc_ye' order by subject";
$qu_get=mysql_query($que_get);

if(mysql_num_rows($qu_get)!=0){
echo"<table border='0' >";
echo "<tr align='center'><th>#<th>Subject<th>Group Name<th>Date<th>Time<th>Hours<th>Choice<th>Status<th>Group Members<th>Venue</th></tr>";
$crov=1;
while($q_get=mysql_fetch_array($qu_get)){
$st=$q_get['student'];
$acy=$q_get['acc_year'];
$sem=$q_get['semester'];
$su=$q_get['subject'];
$pg=$q_get['prac_group'];
$dt=$q_get['date'];
$tm=$q_get['time'];
$hu=$q_get['hours'];
$ch=$q_get['choice'];
$st=$q_get['status'];

echo"<tr align='center' class=trbgc><td>$crov<td>$su</td><td>$pg</td><td>$dt</td><td>$tm</td><td>$hu</td>";
echo "<td>$ch</td>";
if($st=="Register"){
	$st='Not Confirm';
		   }
echo"<td>$st</td>";
//echo"<td><a href='./index.php?view=admin&admin=41&task=checkgm&sub=$su&gp=$pg'>Check</a></td>";
echo"<form method=post action='./index.php?view=admin&admin=41&task=checkgm'><td>";
echo"<input type=hidden name=sub value='$su'>";
echo"<input type=hidden name=gp value='$pg'>";
echo"<input type=submit value='Check'>";
echo"</td></form>";


// get venue.........................
$quevenue="select Venue from practical_session where subject='$su' and grouptype='$pg' and acc_year='$acy' and date='$dt' and time='$tm'";
$quvenue=mysql_query($quevenue);
while($qvenue=mysql_fetch_array($quvenue)){
	$venu=$qvenue['Venue'];
			}
echo"<td>$venu</td></tr>";
$crov++;
}
echo"</table>";

				}

else{
echo"<br><br><font color='red'>Sorry! You have not registered to the groups</font>";

}







}


//////////////////////////////////////no permission to strat pract regi////////////////////////////
else{
echo"<font color=red>Sorry! Group Registration is not start yet</font><br>";

}
//////////////////////////////////////////////////////////////////////////////////////////////////



//check group members..............
if($task=='checkgm'){
$gp=$_POST['gp'];
$subg=$_POST['sub'];

$getgm="select * from Prac_registration where subject='$subg' and prac_group='$gp' and acc_year='$acc_ye'  order by student";
//echo"select * from Prac_registration where subject='$sub' and prac_group='$gp' and acc_year='$acc_ye' ";
$gegm=mysql_query($getgm);
if(mysql_num_rows($gegm)!=0){
echo"<br><h3>Group Members of Course Unit ".$subg." And Group ".$gp."</h3>";
echo"<table border='0' >";
echo"<tr align='center'><th>#<th>Student No<th>Name<th>Choice<th>Status</th></tr>";
$ctgpm=1;
while($ggm=mysql_fetch_array($gegm)){
$stu=$ggm['student'];
$suj=$ggm['subject'];
$choi=$ggm['choice'];
$sat=$ggm['status'];
//$pcg=$ggm['prac_group '];
//echo "<br>".$stu.$suj.$pg.$choi.$sat."<br>";

$questname="select l_name, initials from $rmsdb.fohssmis where user='sc$stu'";
//echo$questname;
$qustna=mysql_query($questname);

while($qname=mysql_fetch_array($qustna)){
$lname=$qname['l_name'];
$ini=$qname['initials'];
					}
echo"<tr align='center' class=selectbg><td>$ctgpm<td>SC/".$batch."/".$stu."</td><td align='left'>".$ini." ".$lname."</td><td>$choi</td><td>$sat</td>";
$ctgpm++;
				   }
echo"</table>";

						}
else{
	echo"<br><font color=red>Sorry! There are no registered group members.</font>";
	}


		    }









////////////////////////////////////////////////////////////////////////////////////////////////
}	///check level if

	else{
		echo '<font color="red"> Sorry!  This option is not available for you.</font><br>';

		}
////////////////////////////////////////////////////////////////////////////////////////////////


?>







<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>






