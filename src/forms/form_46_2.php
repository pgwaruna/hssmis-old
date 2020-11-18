<div align="center">
<table border="0"  cellspacing="1" class="bgc">

	<tr>
		<td>
<br><form method="POST" action="index.php?view=admin&admin=46&task=viewsum">
	<font size="2" color="#FF0000">&nbsp;&nbsp; </font><font color="#800000">
	&nbsp; </font> 
	<select size="1" name="stream_8_2">
<option value="all" selected>All Students</option>	
<?php
	
	$quegetmnsub="select * from main_subjects where status=1 order by sub_name";	
		if(mysql_num_rows($qugtstcmb)==0){

			///////////////////////////////////////////////////////////////////////////////////////////////////

			$qugetmnsub01=mysql_query($quegetmnsub);
			while($qgetmnsub01=mysql_fetch_array($qugetmnsub01)){
				$getmnsub01=$qgetmnsub01['sub_name'];
				$getmnsubid01=$qgetmnsub01['sub_id'];
				
					echo"<option value=$getmnsubid01>$getmnsub01 Students</option>";
				
				
			}	

			////////////////////////////////////////////////////////////////////////////////////////////////////	
	
		}
	
	
	
	
?>	
</select> &nbsp; <font color="#800000">of &nbsp; Level &nbsp;</font>



 
	<select size="1" name="level_8_2">
	<option value="1" selected>1000</option>
	<option value="2">2000</option>
	<option value="3">3000</option>
	<option value="4">4000</option>	
	<option value="0">Recently Pass Out</option>
	
	
	
	
</select> 
 &nbsp; 
 <font color="#800000">in &nbsp;  </font>



 
	<select size="1" name="degree_8_2">
	<option value="All" selected>ALL Streams</option>
	<option value="General">General Stream</option>
	<option value="Special">Special Stream</option>

</select> 




&nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" value="Submit" name="submit">&nbsp;&nbsp; 
</p>
</form>

		</td>
	</tr>
</table>


</div>
