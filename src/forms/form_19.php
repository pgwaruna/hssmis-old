
<div align="center">
<table border="0" width="87%" cellspacing="1">
	<tr>
		<td>
<form method="POST" action="index.php?view=admin&admin=19&task=addatt">
	<p><font color="#800000">&nbsp;&nbsp;&nbsp;&nbsp; Index Number :</font>&nbsp;
	<font color="#800000">SC/</font>
<select size="1" name="year_19">
	<option value="2005">2005</option>
	<option value="2006">2006</option>
	<option value="2007">2007</option>
	<option value="2008">2008</option>
	<option value="2009">2009</option>
	<option value="2010">2010</option>
	<option value="2011">2011</option>
</select><font color="#800000">/</font>
	<span id="number1">
	<input type="text" name="index_19" size="4">
	<span class="textfieldRequiredMsg"><font size="-1"> Enter a index Number</font></span>
	<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span></span>
	&nbsp;for
	<input type="text" name="cor_19" size="6" value="
	<?php
	echo $sub_19;
	?>"> 
	<font color="#FF0000"><span style="font-size: 10pt"> 
	<br><br></span></font><font color="#800000">&nbsp;&nbsp;&nbsp;&nbsp; 
	Exam Eligibility :</font>&nbsp;
	<select size="1" name="eli_19">
<option value="1">Eligible to Exam</option>
<option value="0">Not Eligible</option>
</select><font color="#800000">&nbsp; </font>
	<input type="submit" value="Submit" name="submit"></p>
</form>

		<p>&nbsp;</td>
	</tr>
</table>


</div>



