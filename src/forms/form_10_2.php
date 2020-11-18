
<div align="center">
<table border="0" width="65%" cellspacing="1" class="bgc">
	<tr>
		<td align="center">
<form method="POST" action="index.php?view=admin&admin=10&task=modrslt">

<input type="hidden" name="resid" size="4" value="<?php echo $id; ?>">
	<font color="#800000">&nbsp;&nbsp; Index Number :</font>&nbsp;
	


<?php
echo"SC/$styear/$student_10_2";
?>

<input type="hidden" name="index_10_2" size="4" value="<?php echo $student_10_2; ?>"><br><br>
	<font color="#800000">&nbsp;&nbsp; Subject Code :</font> 
<?php echo $sub_10_2; ?>

	<input type="hidden" name="sub_10_2" size="12" value="<?php echo $sub_10_2; ?>"><br><br>
	
	<font size="2" color="#FF0000">&nbsp;&nbsp; </font>&nbsp;<font color="#800000">Modify as Grade 
	:</font> 
	<select size="1" name="grade_10_2">
<option value="A+">A+</option>
<option value="A">A</option>
<option value="A-">A-</option>
<option value="B+">B+</option>
<option value="B">B</option>
<option value="B-">B-</option>
<option value="C+">C+</option>
<option value="C">C</option>
<option value="C-">C-</option>
<option value="D+">D+</option>
<option value="D">D</option>
<option value="E">E</option>
<option value="E*">E*</option>
</select>&nbsp; <font color="#800000">&nbsp;</font><br>

 
	
	<br>&nbsp; <input type="submit" value="Modify" name="submit">
</form>

</td>
	</tr>
</table>


</div>


