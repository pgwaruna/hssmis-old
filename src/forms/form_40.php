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





<?php
//// get calender...................................
$task=$_GET['task'];
$id=$_GET['id'];
if($task=="send"){
$sub=$_POST['pcode'];
}
else{
$sub=$_GET['sub'];
}
?>
<link href="../style/calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../style/calendar/calendar.js"></script>

<div align="center">
<font color="#800000">Create Group Session for <?php echo $sub; ?></font>
<div id="create_l">
<br>


<table border="1" width="46%" bordercolor="#C1E0FF" cellspacing="0" height="231" bgcolor="#FFFFFF" bordercolordark="#C1E0FF" bordercolorlight="#C1E0FF" style="border-collapse: collapse"><tr><td>
<div align="center">
<table border="0" width="97%">

	<form id="create_practical" action="form_40_a.php?task=create&sub=<?php echo $sub?>" method="POST">

<tr>
		<td rowspan="3" width="26%" align="center">




<?php
require_once('../style/calendar/classes/tc_calendar.php');

	  $myCalendar = new tc_calendar("date2");
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d'), date('m'), date('Y'), date('l'));
	  $myCalendar->setPath("../style/calendar/");
		$lastye=date('Y')-4;
	  $myCalendar->setYearInterval($lastye, date('Y'));
	  //$myCalendar->dateAllow('2010-12-01', "", false);
	  $myCalendar->startMonday(true);
	  
	  $myCalendar->disabledDay("sun");
	  $myCalendar->writeScript();


  
	  ?>
	
	
	
	</td>
		<td rowspan="2" width="16%" align="center"> 
		<p align="center"> <select size="10" name="time1" id="time1">
	<option value="08:00">08:00 AM</option>
	<option value="09:00" selected>09:00 AM</option>
	<option value="10:00">10:00 AM</option>
	<option value="11:00">11:00 AM</option>
	<option value="12:00">12:00 PM</option>
	<option value="13:00">13:00 PM</option>
	<option value="14:00">14:00 PM</option>
	<option value="15:00">15:00 PM</option>
	<option value="16:00">16:00 PM</option>
	<option value="17:00">17:00 PM</option>
	</select></td>
		<td width="19%" align="center"> 
	<select size="4" name="hours1" id="hours1">
	<option value="1">1 Hours</option>
	<option value="2" selected>2 Hours</option>
	<option value="3">3 Hours</option>
	<option value="4">4 Hours</option>
	</select></td>
	<td align="center">Maximum no of Student:
		<select name="gpmem" id="gpmem">
		<?php
			for($i=1;$i<=50;$i++){
			echo"<option value=$i>$i</option>";
			}
		?>
		</select>
		</td>
		<tr>
<td align="center" width="19%">
<input type=text name=lggpnm size=10 placeholder="Session Name" maxlength="25">
	<select size="4" name="groupbox" id="group">
<?php
	echo"<option value='ngp' selected>Select One</option>";
	
		for($c='A';$c<'Z';$c++){
			echo"<option value='$c'> Group $c</option>";

					}
		
		?>
	
	</select></td>
		
		<td align="center">Venue:<input type="text" name="venue" id="venue"></td>
	
	
		<tr>
		<td width="35%" align="center" colspan="3"> <input type="hidden" id="subject_name" name="subject_name" value="<?php echo trim($sub); ?>">
			<input type="hidden" id="taskb" name="taskb" value="<?php echo $task; ?>">
	<input type="submit" value="Create Practical Session For <?php echo strtoupper($sub); ?>" ></td>
		<tr><td colspan=3>	
</form>
</table>
</div>
</td></tr>
</table>

</div>
<p>
<br>

</div>



<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>



