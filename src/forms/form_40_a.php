<?php
//error_reporting(0);
session_start();
if((($_SESSION['login'])=="truefohssmis")&&($_SESSION['role']!="student")){
include'../connection/connection.php';

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
if($qpers['id']=="40"){
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


<style type="text/css">
@import url('../style/default.css');
</style>



<?php
///// create,remove practical sessoin by administrator.......................

$date=$_POST['date2'];

$time=$_POST['time1'];
$hours=$_POST['hours1'];
$lggpnm2=strtoupper($_POST['lggpnm']);
$lggpnm=trim($lggpnm2);
$groupb2=$_POST['groupbox'];
	if(($groupb2=="ngp")&&($lggpnm==null)){
	echo'<script type="text/javascript">';
		echo'alert("Please select Group Name")';
		//return false;
	echo"</script>";
				}
	elseif(($lggpnm!=null)&&($groupb2=="ngp")){
		$groupb=$lggpnm;
							}
	else{
		$groupb=$lggpnm."(".$groupb2.")";
		}




$tot=$_POST['gpmem'];
$sub3=$_POST['subject_name'];
$taskbox=$_POST['taskb'];
$venue=$_POST['venue'];


$sub=$_GET['sub'];
$task=$_GET['task'];
$id=$_GET['id'];




$queacc="select * from acc_year where current='1'";
$quacc=mysql_query($queacc);
while($qacc=mysql_fetch_array($quacc)){
$acc_ye=$qacc['acedemic_year'];
}
//...........get semester..........
$queprac="select * from call_registration";
$quprac=mysql_query($queprac);
while($qup=mysql_fetch_array($quprac)){
$seme=$qup['semister'];
}



//.............create practical session.............................
if($task=="create"){
include "form_40.php";
echo"<div align='center'><a href='../index.php?view=admin&admin=40'>Go Back</a></div>";

$que_ck_co="select * from practical_session where subject='$sub' and grouptype='$groupb' and semester='$seme' and acc_year='$acc_ye'";
$qu_ck_co=mysql_query($que_ck_co);
if(mysql_num_rows($qu_ck_co)=='0'){
$queins="insert into practical_session(subject,date,time,grouptype,hours,max_amount,acc_year,semester,Venue)values('$sub','$date','$time','$groupb',$hours,$tot,'$acc_ye','$seme','$venue')";
$qu40a=mysql_query($queins);
}
else{
echo'<script type="text/javascript">';
echo'alert("This Group '.$groupb.' Is Already Exist !")</script>';
    }
echo "<p align='center'>Scheduled Group Sessions</p>";

$que40a="select * from practical_session where acc_year='$acc_ye' order by subject,id";
$qu40a=mysql_query($que40a);
if(mysql_num_rows($qu40a)!=0){
$ctgsn=1;
echo "<table align='center' border='0'>";
echo "<tr><th>#<th>Subject<th>Date<th>Time<th>Group Name<th>Hours<th>Max Student<th>Submit as<th>Venue</th></tr>";
while($q40a=mysql_fetch_array($qu40a)){
$sub2=$q40a['subject'];
$date=$q40a['date'];
$time=$q40a['time'];
$group=$q40a['grouptype'];
$hours=$q40a['hours'];
$max=$q40a['max_amount'];
$id=$q40a['id'];
$venu=$q40a['Venue'];

echo"<tr class=trbgc><td align=center>$ctgsn<td>".$sub2."<td>".$date."<td>".$time."<td align='center'>".$group."<td  align='center'>".$hours."<td  align='center'>".$max."</td>";

if($sub==$sub2){
echo "<td align='center'><a href='form_40_a.php?id=$id&task=remove&sub=$sub'>Remove</td>";
}
else{
echo"<td align='center'> Done</td>";}
echo"<td>$venu</td></tr>";
$ctgsn++;
}

echo "</table><br><br>";
}
else{
    echo"<p align='center'><font color=red>Sorry! There are no Scheduled Group Sessions</font></p>";
}

}
//////////////////////////////////
//........remove practical session...............

else if($task=="remove"){
$sub=$_GET['sub'];
//...........delete student practical details according remove prac sessions
$quegetgp="select * from practical_session where id=$id";
$qugetgp=mysql_query($quegetgp);

while($qgetgp=mysql_fetch_array($qugetgp)){
$subject=$qgetgp['subject'];
$subgp=$qgetgp['grouptype'];
$sdate=$qgetgp['date'];
$stime=$qgetgp['time'];
$sacyear=$qgetgp['acc_year'];
}
$quedelst="delete from Prac_registration where subject='$subject' and prac_group='$subgp'and date='$sdate' and time='$stime' and acc_year='$sacyear'";
mysql_query($quedelst);
//echo$quedelst;
//........................................................
//..........delete prac session......... query............
$quedel="delete from practical_session where id=$id";
mysql_query($quedel);
//....................................................


include "form_40.php";
echo"<div align='center'><a href='../index.php?view=admin&admin=40'>Go Back</a></div>";
echo "<p align='center'>Scheduled Practical Sessions</p>";
$que40a="select * from practical_session  where acc_year='$acc_ye' order by subject,id";
$qu40a=mysql_query($que40a);

if(mysql_num_rows($qu40a)!=0){
$ctgsn1=1;
echo "<table align='center' border='0'>";
echo "<tr><th>#<th>Subject<th>Date<th>Time<th>Group Name<th>Hours<th>Max Student<th>Submit as<th>Venue</th></tr>";
while($q40a=mysql_fetch_array($qu40a)){
$sub2=$q40a['subject'];
$date=$q40a['date'];
$time=$q40a['time'];
$group=$q40a['grouptype'];
$hours=$q40a['hours'];
$max=$q40a['max_amount'];
$id=$q40a['id'];
$venu=$q40a['Venue'];

echo"<tr class=trbgc><td align=center>$ctgsn1<td>".$sub2."<td>".$date."<td>".$time."<td align='center'>".$group."<td  align='center'>".$hours."<td  align='center'>".$max."</td>";

if($sub==$sub2){
echo "<td align='center'><a href='form_40_a.php?id=$id&task=remove&sub=$sub'>Remove</td>";
}
else{
echo"<td align='center'> Done</td>";
}
echo"<td>$venu</td></tr>";
$ctgsn1++;
}


echo "</table><br><br>";
}
else{
    echo"<p align='center'><font color=red>Sorry! There are no Scheduled Practical Sessions</font></p>";
}

}
//////////////////////////
// enter other practical course unit..............

else if($task=="send"){
$sub=$_POST['pcode'];

$que="select code from courseunit where code='$sub'";
$qu=mysql_query($que);
if(mysql_num_rows($qu)!=0){

include "form_40.php";
echo"<div align='center'><a href='../index.php?view=admin&admin=40'>Back</a></div>";
$queins="insert into practical_session(subject,date,time,grouptype,hours,max_amount,acc_year,semester,Venue)values('$sub3','$date','$time','$groupb',$hours,$tot,'$acc_ye','$seme','$venue')";
$qu40a=mysql_query($queins);

echo "<p align='center'>Scheduled Practical Sessions</p>";

$que40a="select * from practical_session  where acc_year='$acc_ye' order by subject,id";
$qu40a=mysql_query($que40a);
echo "<table align='center' border='0'>";
$ctgsn2=1;
echo "<tr ><th>#<th>Subject<th>Date<th>Time<th>Group Name<th>Hours<th>Max Student<th>Status<th>Venue</th></tr>";
while($q40a=mysql_fetch_array($qu40a)){
$sub2=$q40a['subject'];
$date=$q40a['date'];
$time=$q40a['time'];
$group=$q40a['grouptype'];
$hours=$q40a['hours'];
$max=$q40a['max_amount'];
$id=$q40a['id'];
$venu=$q40a['Venue'];


echo"<tr class=trbgc><td align=center>$ctgsn2<td>".$sub2."<td>".$date."<td>".$time."<td align='center'>".$group."<td  align='center'>".$hours."<td  align='center'>".$max."</td>";
//echo$sub.$sub2."<br>";
$subp=trim($sub);
if ($subp==$sub2){

echo "<td align='center'><a href='form_40_a.php?id=$id&task=remove&sub=$sub'>Remove</td>";
}
else{
echo"<td align='center'> Done</td>";
}
echo"<td>$venu</td></tr>";
$ctgsn2++;
}


echo "</table><br><br>";

}

else
{
echo"<a href='../index.php?view=admin&admin=40'>Go Back</a>";
echo "<h3>Invalid Course Unit Recheck Course Unit</h3>";

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





