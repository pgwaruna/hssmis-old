
<div align="center">
<table border="0" width="87%" cellspacing="1">
	<tr>
	  <td align="center">
<form method="POST" action="index.php?view=admin&admin=5&task=current">
	<font color="#800000">Current Academic Semester : </font>
	<select size="1" name="sem_5">
<option selected value="1">Semester 01</option>
<option value="2">Semester 02</option>
    </select>
	&nbsp; 
	<br /><br />
	<font color="#800000"> Current Academic Year : </font>
    <select name="acc_year_cur" size="1" id="acc_year_cur">
<?php
       
	 //$con5_a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
    // mysql_select_db($db);
     $query5_a="select acedemic_year from acc_year where current=1 or current=2;";
     $five_a=mysql_query($query5_a);
	 while($data5=mysql_fetch_array($five_a)){
	 echo "<option value=".$data5['acedemic_year'].">";
	 $acc_parts=explode("_",$data5['acedemic_year']);
	 echo $acc_parts[0]." - ".$acc_parts[1];
	 echo "</option>";
	 }
?>
    </select>
<br />
<br />
<input type="submit" value="Submit" name="submit">
</form>






</td>
	</tr>
</table>


</div>
