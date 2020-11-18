
	<?php
	
	echo '<div align="center"><table border="0" width="87%" cellspacing="1"><tr><td style="font-size:12px">';
	
	$con1_6=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);
		
	if($semi_st==1)	
	$query_1_6="select distinct c.code, c.name ,c.requirment from courseunit c, combination o, student s , 
	target_group t where o.id=s.combination and s.id='$id_1' and o.subject=t.subject and 
	t.target_id=c.target_group and c.core='co' and c.level='$level_st' and (c.semister=1 or c.semister=3)
	and c.code not in 
	(select course from registration where student='$id_1' and semister='$semi_1' and acedemic_year='$ac_1')";
	elseif($semi_st==2)
	$query_1_6="select distinct c.code, c.name ,c.requirment from courseunit c, combination o, student s , 
	target_group t where o.id=s.combination and s.id='$id_1' and o.subject=t.subject and 
	t.target_id=c.target_group and c.core='co' and c.level='$level_st' and c.semister=2
	and c.code not in 
	(select course from registration where student='$id_1' and semister='$semi_1' and acedemic_year='$ac_1')";
		
	$ccc=mysql_query($query_1_6);
	echo '<br><font color="green">Core Course Units</font><hr color=#E1E1F4 width=100%>';	
	while($data_1_1=mysql_fetch_array($ccc)){
	
	
	echo '<form method="POST" action="index.php?view=admin&admin=2&task=post_register">';
	echo "<font color=#109010><b>".strtoupper($data_1_1['code']);
	echo '<input type="hidden" name="cou_1" value="'.$data_1_1['code'].'" size="10"></b></font>';
	echo '<input type="hidden" name="std_2" value="'.$std_2.'" size="10"></b></font>';
	echo '<input type="hidden" name="std_y" value="'.$std_y.'" size="10"></b></font>';
	
	echo '<font color="#800000">&nbsp;&nbsp;'.$data_1_1['name']." (Core Course)&nbsp;";
	echo '</font>';
	echo '<select size="1" name="deg_1" id="deg_1" style="visibility:hidden">';
	echo '<option selected value="1">D</option>';
	echo '</select><br />';
	echo "Pre Prerequisites : ".$data_1_1['requirment']."  ";
	echo '<input type="submit" value="Register" name="submit1">';
	echo '<br><br></form>';
	
	}
	
	

	
    if($semi_st==1)
	$query_1_7="select distinct c.code, c.name ,c.requirment from courseunit c, combination o, student s , 
	target_group t where o.id=s.combination and s.id='$id_1' and o.subject=t.subject and 
	t.target_id=c.target_group and (c.core='op' or c.core='nd' or c.core='nn') and c.level='$level_st' 
	and (c.semister=1 or c.semister=3)
	and c.code not in 
	(select course from registration where student='$id_1' and semister='$semi_1' and acedemic_year='$ac_1')";
	elseif($semi_st==2)
	$query_1_7="select distinct c.code, c.name ,c.requirment from courseunit c, combination o, student s , 
	target_group t where o.id=s.combination and s.id='$id_1' and o.subject=t.subject and 
	t.target_id=c.target_group and (c.core='op' or c.core='nd' or c.core='nn') and c.level='$level_st' 
	and c.semister=2
	and c.code not in 
	(select course from registration where student='$id_1' and semister='$semi_1' and acedemic_year='$ac_1')";
	$cce=mysql_query($query_1_7);
	echo '<br><font color="green">Optional and Non Degree Course Units</font><hr color=#E1E1F4 width=100%>';
	while($data_1_1=mysql_fetch_array($cce)){
	
	
	echo '<form method="POST" action="index.php?view=admin&admin=2&task=post_register">';
	echo "<font color=#109010><b>".strtoupper($data_1_1['code']);
	
	echo '<input type="hidden" name="cou_1" value="'.$data_1_1['code'].'" size="10"></b></font>';
	echo '<input type="hidden" name="std_2" value="'.$std_2.'" size="10">';
	echo '<input type="hidden" name="std_y" value="'.$std_y.'" size="10">';
	echo '<font color="#800000">&nbsp;&nbsp;'.$data_1_1['name']." (Optional)&nbsp;";
	echo '</font>';
	
	echo '<select size="1" name="deg_1">';
	echo '<option selected value="1">Degree</option>';
   	echo '<option value="2">ND</option>';
	echo '</select><br />';
	echo "Pre Prerequisites : ".$data_1_1['requirment']."  ";
	echo '<input type="submit" value="Register" name="submit1">';
	echo '<br><br></p></form>';
	}
	
	mysql_close($con1_6);
	echo '</table></div>';
	
		?>