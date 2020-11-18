

		
	<?php
	
	
	$con1_9=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);	
	$std_id=$_SESSION['user_id'];
						
	// Find The Level of Student
						
	$query1_7="select l.level, l.semister from level l,student s where s.year=l.year and s.id='$std_id'";
	$one=mysql_query($query1_7);
	while($ldata=mysql_fetch_array($one)){
	$level_st=$ldata['level'];
	$semi_st=$ldata['semister'];

	mysql_close($con1_9);
	
	}
		
	echo '<div align="center"><table border="0" width="87%" cellspacing="1"><tr><td>';
	
	$con1_6=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);
	$id_1=$_SESSION['user_id'];
	
		
	$query_1_6="select distinct c.code, c.name from courseunit c, combination o, student s where o.id=s.combination and s.id='$id_1' and o.department=c.department and c.core='co' and c.level='$level_st' and c.semister='$semi_st'";

	$ccc=mysql_query($query_1_6);
	echo '<br>Core Course Units<br>';	
	while($data_1_1=mysql_fetch_array($ccc)){
	
	
	echo '<form method="POST" action="index.php?view=admin&admin=1&task=register">';
	echo "<font color=#109010><b>".strtoupper($data_1_1['code']);
	echo '<input type="hidden" name="cou_1" value="'.$data_1_1['code'].'" size="10"></b></font>';
	echo '<font color="#800000">&nbsp;&nbsp;'.$data_1_1['name']." (Core Course)&nbsp;";
	echo '</font>';
	echo '<select size="1" name="deg_1">';
	echo '<option selected value="degree">Degree</option>';
	echo '</select><font color="#800000">&nbsp; </font>';
	echo '<input type="submit" value="Register" name="submit">';
	echo '<br><br></p></form>';
	
	}

	$query_1_7="select code, name from courseunit where core='op' and level='$level_st' and semister='$semi_st'";
	$cce=mysql_query($query_1_7);
	echo '<br>Optional Course Units<br>';	
	while($data_1_1=mysql_fetch_array($cce)){
	
	
	echo '<form method="POST" action="index.php?view=admin&admin=1&task=register">';
	echo "<font color=#109010><b>".strtoupper($data_1_1['code']);
	echo '<input type="hidden" name="cou_1" value="'.$data_1_1['code'].'" size="10"></b></font>';
	echo '<font color="#800000">&nbsp;&nbsp;'.$data_1_1['name']." (Optional)&nbsp;";
	echo '</font>';
	echo '<select size="1" name="deg_1">';
	echo '<option selected value="degree">Degree</option>';
   	echo '<option value="nondegree">Non Degree</option>';
	echo '</select><font color="#800000">&nbsp; </font>';
	echo '<input type="submit" value="Register" name="submit">';
	echo '<br><br></p></form>';
	}
	
	mysql_close($con1_6);
	echo '</td>	</tr></table></div>';
	
	?>