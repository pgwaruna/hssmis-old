<div align="center"><strong>To Introduce a New Course Unit</strong><br  />

</div>
<div align="center">
<table border="0" width="70%" cellspacing="1" class="bgc">
<form method="POST" action="index.php?view=admin&admin=7&task=addcourse">    
<tr height="30px">
<td>
	<font color="#800000">&nbsp;&nbsp; Course Code </font> 
	
	
<td> : 	
	<span id="code">
	<input type="text" name="code_7" size="12">
	&nbsp;
	<span class="textfieldRequiredMsg"><font size="-1"> Enter a Course Code</font></span>
	<span class="textfieldInvalidFormatMsg"><font size="-1">in valid format</font></span>	</span>
	
	<font color="red">[ &#945; = a ] [ &#946; = b ] [ &#948; = d ]</font>
	
<tr height="30px">
<td>	
	<font color="#800000">&nbsp;&nbsp; Course Name </font> 
	
	
<td> : 
	<span id="sprytextfield1">
	<input type="text" name="name_7" size="30">
	&nbsp; 
	<span class="textfieldRequiredMsg"><font size="-1"> Enter a Course Name</font></span></span>
	
<!--
	<font size="2" color="#FF0000">&nbsp;&nbsp; </font><font color="#800000">Credits :</font> 
	<span id="sprytextfield2">
	<input type="text" name="cre_7" size="1">
	<span class="textfieldRequiredMsg"><font size="-1"> Enter # Credits </font></span></span>-->


<!--<font color="#800000">&nbsp; Level :</font> 
	<select size="1" name="le_7">
	<option value="1">One</option>
	<option value="2">Two</option>
	<option value="3">Three</option>
	</select> &nbsp; <br><br>-->
	
<tr height="30px">
<td>	
	<font color="#800000">&nbsp;&nbsp;  Course Core </font> 
	
	
<td> : 
    <select size="1" name="co_7">
	<option value="co" selected="selected">Compulsory Course Unit</option>
	<option value="op">Optional Course Unit</option>
	<option value="nd">No Credits Compulsory course</option>
	<option value="nn">No Credits Other course</option>
	</select>
	
<tr height="30px">
<td>	
	<font color="#800000">&nbsp;&nbsp; Course Type </font>
<td> : 
<select size="1" name="cotyp_7">
	<option value="Theory" selected="selected">Theory</option>
	<option value="Practical">Practical</option>
	<option value="Th+Pr">Both (Theory/Practical)</option>
	
	</select>
<tr height="30px"><td>
	<font color="#800000">&nbsp;&nbsp; Semester </font> <td>:
	<select size="1" name="se_7">
	<option value="1" selected>Semester One</option>
	<option value="2">Semester Two</option>
	<option value="3">Both Semester</option>
	</select> &nbsp; 
	<?php
	if($department_7!="all"){
	$query7_h="select user,l_name,initials from $rmsdb.fohssmis where section='$department_7' and (role='lecturer' or role='general' or role='topadmin' or role='dssc') order by l_name";
				}
	else{
	$query7_h="select user,l_name,initials from $rmsdb.fohssmis where (role='lecturer' or role='general' or role='topadmin' or role='dssc') order by l_name";
		}
	$usr_9=mysql_query($query7_h);
	echo '<br /><tr><td><font color="#800000">&nbsp;&nbsp; Lecturer </font> ';
	echo "<td> : <select name=lec_7>";
	echo"<option value='Add Here'>Add Here</option>";
  	while($data8=mysql_fetch_array($usr_9)){
	echo '<option value="'.$data8['user'].'">'.$data8['l_name'].' '.$data8['initials'].'</option>';
	}			
	echo "</select>";
	
	
	$query7_i="select distinct(target_id), name from target_group order by name";
	$usr_10=mysql_query($query7_i);
	echo '<tr><td><font color="#800000">&nbsp;&nbsp; Target Group </font> ';
	echo "<td> : <select name=group_7>";
  	while($data10=mysql_fetch_array($usr_10)){
	echo '<option value="'.$data10['target_id'].'">'.$data10['name'].'</option>';
	}			
	echo "</select>";



	$quedept="select distinct(department) from courseunit order by department";
	$qudept=mysql_query($quedept);
	echo '<tr><td><font color="#800000">&nbsp;&nbsp; Department </font> ';
	echo "<td> : <select name=dept>";
		if($department_7=="all"){
		while($qdept=mysql_fetch_array($qudept)){
			$dept=$qdept['department'];
			echo"<option value='$dept'>".ucfirst($dept)."</option>";
							}
					}
		else{
			echo"<option value='$department_7'>".ucfirst($department_7)."</option>";
			}
	echo"</select>";
	?>
	
<tr height="30px">
<td> 	
	<font color="#800000">&nbsp;&nbsp; Availability </font>
	
<td> : 	
    <select name="availability_7" size="1" id="availability_7">
    <option value="1">Available</option>
    <option value="0">Not Available</option>
    </select>
	
<tr height="30px"><td> 
	<font color="#800000">&nbsp;&nbsp; Pre Requirement </font>
	
<td> : 	
	<span id="sprytextfield3">
	<input name="require_7" type="text" id="require_7" size="40">
	<span class="textfieldRequiredMsg"><font size="-1"> Enter Requirement </font></span></span>
	
<tr height="30px"><td colspan=2 align=center> 	
	<input type="submit" value="Submit The New Course Unit" name="submit">
	</form>
	
	
	</table>


</div>



