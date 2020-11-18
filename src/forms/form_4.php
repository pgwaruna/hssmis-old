<?php
echo"<form method='POST' action='index.php?view=admin&admin=4&task=csession'>";
?>

<div align="center">
<table border="0" width="65%" class=bgc>

<tr>
<td width=30%>
Next Academic Semester  
<td>: 
<select size="1" name="sem_4">
<option selected value="1">Semester 01</option>
<option value="2">Semester 02</option>
</select>
<tr><td>
Next Academic Year 
<td>: <select size="1" name="ace_4">
	
	
<?php     
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
////////////////////  Select List of Accedemic Year for register  ///////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

	
     $query5_a="select acedemic_year from acc_year where current=1 or current=2;";
     $five_a=mysql_query($query5_a);
	 while($data5=mysql_fetch_array($five_a)){
	 echo "<option value=".$data5['acedemic_year'].">";
	 $acc_parts=explode("_",$data5['acedemic_year']);
	 echo $acc_parts[0]." - ".$acc_parts[1];
	 echo "</option>";
	 }
	 
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
	 
?>


</select>
<tr><td>Closing Date 
<td>: 
	<span id="date1">
	<input type="text" name="date_4" size="20">
	<span class="textfieldRequiredMsg"><font size="-1"> Enter the Closing Date</font></span>
	<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>
	</span>
<tr><td>Register Progress  
<td>:   
	<select size="1" name="reg_4">
<option value="1" selected>Register</option>
<option value="0">Stop</option>
</select>
<tr><td colspan="2" align=center><input type="submit" value="Submit" name="submit">
</p>
</form>	
</table><br>


</div>



