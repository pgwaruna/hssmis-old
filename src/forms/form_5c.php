<?php
require_once('./classes/globalClass.php');
	$y=new settings();

	$cacy=$y->getAcc();

	$divacyr=explode("_",$cac);

		$npreacyr=$divacyr[0];
		$npstacyr=$divacyr[1];

?>





<div align="center">
<table border="0" width="87%" cellspacing="1">
	<tr>
	  <td align="center">


<!--

Defining New Academic Year

-->

<form method="POST" action="index.php?view=admin&admin=5&task=year">
	<p><font color="#800000">&nbsp;&nbsp; 
	Level 1000 : </font>
<select size="1" name="level1_5">
	<?php
		echo"<option value='$npstacyr'>$npstacyr</option>";
		for($l1=1;$l1<=4;$l1++){
			$loneyr=$npstacyr-$l1;
		if($l1==1){
		echo"<option value='$loneyr' selected>$loneyr</option>";
				}
		else{
		echo"<option value='$loneyr'>$loneyr</option>";
			}

					}

	?>

        
      </select>
	  <font color="#800000">&nbsp;&nbsp;</font><br /><br />
	<font color="#800000">  &nbsp;&nbsp; Level 2000 : </font>
	  <select size="1" name="level2_5">
		<?php
		$loneyr21=$npstacyr-1;
		echo"<option value='$loneyr21'>$loneyr21</option>";

		for($l2=2;$l2<=5;$l2++){
			$loneyr2=$npstacyr-$l2;

		if($l2==2){
		echo"<option value='$loneyr2' selected>$loneyr2</option>";
				}
		else{
		echo"<option value='$loneyr2'>$loneyr2</option>";
			}

					}

		?>
	


	    </select>
	  <font color="#800000">&nbsp;&nbsp; </font><br /><br />
	<font color="#800000">&nbsp;&nbsp; Level 3000 : </font>
	  <select size="1" name="level3_5">

		<?php
		$loneyr31=$npstacyr-2;
		echo"<option value='$loneyr31'>$loneyr31</option>";


		for($l3=3;$l3<=6;$l3++){
			$loneyr3=$npstacyr-$l3;
		if($l3==3){
		echo"<option value='$loneyr3' selected>$loneyr3</option>";
				}
		else{
		echo"<option value='$loneyr3'>$loneyr3</option>";
			}

					}



		?>


	    </select>
		
		
	  <font color="#800000">&nbsp;&nbsp; </font><br /><br />
	<font color="#800000">&nbsp;&nbsp; Level 4000 : </font>
	  <select size="1" name="level4_5">

		<?php
		$loneyr32=$npstacyr-3;
		echo"<option value='$loneyr32'>$loneyr32</option>";


		for($l32=4;$l32<=7;$l32++){
			$loneyr32=$npstacyr-$l32;
		if($l32==4){
		echo"<option value='$loneyr32' selected>$loneyr32</option>";
				}
		else{
		echo"<option value='$loneyr32'>$loneyr32</option>";
			}

					}



		?>


	    </select>		
		
		
		
		
		
	  <font color="#800000"> <br />
	    <br />
	    &nbsp;&nbsp; Pass Out Batch : </font>
	  <select size="1" name="level0_5">

		<?php
		$loneyr41=$npstacyr-3;
		echo"<option value='$loneyr41'>$loneyr41</option>";


		for($l4=5;$l4<=8;$l4++){
			$loneyr4=$npstacyr-$l4;

		if($l4==5){
		echo"<option value='$loneyr4' selected>$loneyr4</option>";
				}
		else{
		echo"<option value='$loneyr4'>$loneyr4</option>";
			}

					}

		?>

	  

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
