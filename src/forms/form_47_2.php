<div align="center">
<table border="0"  cellspacing="1" class="bgc" width="80%">

	<tr align="center">
		<td>
<br><form method="POST" action="./forms/form_47.php?task=gpadd">

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
</select> <br>



 
	<select size="1" name="level_8_2">
<?php
//$lstvl=$_SESSION['genok'];//////////remove this cmt after this sem
$lstvl=4;/////////comment this  after this sem
for($l=1;$l<=$lstvl;$l++){
	echo"<option value=$l>$l"."000</option>";
}
echo'<option value="0">Recently Pass Out</option>';

?>	
	
	
	
	

	
	
	
	
	
</select> 
 <font color="#800000">Level ,</font>
 <font color="#800000"> &nbsp;  In</font>



 
	<select size="1" name="degree_8_2">
	<option value="All" selected>ALL Streams</option>
	<option value="General">General Stream</option>
	<option value="Special">Special Stream</option>

</select> 




<br><br>
<?php
if($_SESSION['genok']!=0){
	echo'<input type="submit" value="View Admissions" name="submit">';
}
else{
		//echo'<input type="submit" value="View Admissions" name="submit" disabled>';//////////remove this cmt after this sem
		echo'<input type="submit" value="View Admissions" name="submit">';/////comment this  after this sem
}


?>
</p>
</form>

		</td>
	</tr>
</table>


</div>
