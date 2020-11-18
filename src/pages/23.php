<script type="text/javascript" src="Ajax/displaycourses.js"></script>

<head>

<link href="style/calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="style/calendar/calendar.js"></script>
<style type="text/css">
@import url('./style/default.css');
</style>

</head>


Add Medical For Attendences
<hr class=bar>Select the date for add medical
<div id="create_l">
<br>
<div align="center">
<table border="1" width="46%" bordercolor="#A550B2" cellspacing="0" height="231" bgcolor="#FFFFFF" bordercolordark="#C1E0FF" bordercolorlight="#C1E0FF" style="border-collapse: collapse"><tr><td>
<div align="center">
<table border="0" width="97%">
<tr>
		<td rowspan="2" width="13%" align="center">


	<?php

require_once('style/calendar/classes/tc_calendar.php');

	  $myCalendar = new tc_calendar("date2");
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("style/calendar/");
	  $myCalendar->setYearInterval(2010, 2012);
	  $myCalendar->dateAllow('2010-12-01', date("Y-m-d"), false);
	  $myCalendar->startMonday(true);
	  
	  $myCalendar->writeScript();


  
	  ?>
	
	
	
	</td>
		<td width="43%" align="center"> 
		<p align="center"> 
		
		
		
		
<select size="8" name="dept_subject" id="dept_subject" onchange="displayCourses()">
<?php
include './admin/config.php';
$con20a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);
$query20a="select distinct department from courseunit";
$data20a=mysql_query($query20a);
while($data=mysql_fetch_array($data20a)){
echo '<option value="'.$data['department'].'">'.ucfirst($data['department']).'</option>';
}
mysql_close($con20a);
?>
</select>
<img style='visibility: hidden' id='loader6' src='images/ajax-loader.gif'>
</td>
	<td width="43%" align="center"> 

	<div id="courseunit" name="courseunit">
	<select size="8" name="dept_courses" id="dept_courses" onchange="displayLid()">
	<option>Course Select</option>
	</select>

	</div>
	<img style='visibility: hidden' id='loader7' src='images/ajax-loader.gif'>

	</td>
		
		
		
		
		
		<tr>
		<td width="86%" align="center" colspan="2"> 
	<div id="lid" name="lid">
	<select size="4" name="lect_id" id="dept_courses1">
	<option>Time Select</option>
	</select>
	</div>
	</td>
				
		
		
		
		
		<tr>
		<td width="86%" align="center" colspan="3"> 
			<img style='visibility: hidden' id='loader8' src='images/ajax-loader.gif'>
			
			<div id="std" name="std">
</div>
			</td>

			
		
		</td>
		
</table>
</div>
</td></tr>
</table>
</div>
<p>
<br>

</div>
		
		
