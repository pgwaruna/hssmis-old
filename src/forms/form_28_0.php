<script type="text/javascript" src="Ajax/create.js"></script>
<!--//////////////////////////////////////insert by iranga for prct grp////////////////////////////////////-->	
<script type="text/javascript" src="Ajax/displayGrp.js"></script>
<!--//////////////////////////////////////insert by iranga for prct grp////////////////////////////////////-->	


<link href="style/calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="style/calendar/calendar.js"></script>


<font color="#800000">Create Lecture ID for Enter Attendence</font>
<div id="create_l">
<br>
<div align="center">
<table border="1" width="70%" bordercolor="#A550B2" cellspacing="0" height="231" bgcolor="#FFFFFF" bordercolordark="#C1E0FF" bordercolorlight="#C1E0FF" style="border-collapse: collapse"><tr><td>
<div align="center">
<table border="0" width="100%"><tr height=30px><th width=20%>Date<th width=20%>Time<th width=20%>Hours<th width=20%>Type<th width=20%>Exp. / Group

<tr valign=top class=trbgc><form id="create_lecture">
		<td align="center"><br>


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
	
	
	<br>
	</td>
		<td  align="center"><br>
		<select size="10" name="time1" id="time1">
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
		<td align="center"><br>
	<select size="4" name="hours1" id="hours1">
	<option value="1">1 Hours</option>
	<option value="2" selected>2 Hours</option>
	<option value="3">3 Hours</option>
	<option value="4">4 Hours</option>
	</select></td>
		
		<td  align="center"><br>
	<select size="6" name="type1" id="type1" onclick="displayGrp()">
	<option selected value="lecture">Lecture</option>
	<option value="tute">Tutorial</option>
	<option value="practical">Practical</option>
	<option value="assignment">Assignment</option>
	<option value="field">Field Visit</option>
	<option value="other">Other</option>
	</select></td>

	
<!--//////////////////////////////////////insert by iranga for prct grp////////////////////////////////////-->	
	<td align="center"><br>


	
	<img style='visibility: hidden' id='loadergp' src='images/ajax-loader.gif'>
	<div id="dispgrp" name="dispgrp">
		
		<select size="1" name="swgrp" id="swgrp" >
		<option value="nogrp" selected >No Group</option>
	</select>
	</div>
	</td>
<!--//////////////////////////////////////insert by iranga for prct grp////////////////////////////////////-->		
	
		<tr  class=trbgc>
		<td  align="center" colspan="5"> <input type=hidden id="subject_name" name="subject_name" value="<?php echo $sub_21; ?>">
			
	<input type="button" value="Create Lecture ID for <?php echo strtoupper($sub_21); ?>" onclick=this.disabled=true;create() >
	<img style='visibility: hidden' id='loader4' src='images/ajax-loader.gif'></td>
		<tr><td colspan=5>	
</form>
</table>
</div>
</td></tr>
</table>
</div>
<p>
<br>

</div>
		
