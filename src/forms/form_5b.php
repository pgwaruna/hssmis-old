

<div align="center">
<table border="0" width="87%" cellspacing="1">
	<tr>
	  <td align="center">


<!--

Defining New Academic Year

-->

<form method="POST" action="index.php?view=admin&admin=5&task=semister">
	<p><font color="#800000">&nbsp; New Academic Year : </font>
	    <select size="1" name="acc_year_val">

	<?php
	require_once('./classes/globalClass.php');
	$n=new settings();

	$cac=$n->getAcc();

	$divacy=explode("_",$cac);

		$preacyr=$divacy[0];
		$pstacyr=$divacy[1];

		for($sac=3;$sac>=1;$sac--){

			$prenewdfacyr=$preacyr-$sac;
			$posnewdfacyr=$pstacyr-$sac;
			$newdfacyr=$prenewdfacyr."_".$posnewdfacyr;

			echo"<option value='$newdfacyr'>$newdfacyr</option>";

						}
		for($sac2=0;$sac2<=3;$sac2++){

			$prenewdfacyr2=$preacyr+$sac2;
			$posnewdfacyr2=$pstacyr+$sac2;
			$newdfacyr2=$prenewdfacyr2."_".$posnewdfacyr2;

			if($sac2==1){
			echo"<option value='$newdfacyr2' selected>$newdfacyr2</option>";
					}
			else{
			echo"<option value='$newdfacyr2'>$newdfacyr2</option>";
				}

						}
	?>

	        </select>
	  <font color="#800000"> <br>
	    <br>
  &nbsp;&nbsp; 
	    App. Starting Date: </font>
		<span id="date1">
	    <input type="text" name="st_date" size="30" />
		<span class="textfieldRequiredMsg"><font size="-1"> Enter the Starting Date</font></span>
	    <span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>
	    </span>
	  <br />
	  <br />
  &nbsp;&nbsp; App. Ending Date: </font>
      <span id="date2">
	  <input type="text" name="en_date" size="30" />
	  <span class="textfieldRequiredMsg"><font size="-1"> Enter the Ending Date</font></span>
	  <span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>
	 </span>
	  <br>
	  <br>
  &nbsp;&nbsp; Status : </font>
	  <select size="1" name="current_acc">
	    <option value="1">Current Academic  Year</option>
	    <option value="2">Future Academic  Year</option>
	    </select>
	       <br>
	       <br>
	  &nbsp; 
	  <input type="submit" value="Submit" name="submit">
	  </p>
</form>


</td>
	</tr>
</table>


</div>
