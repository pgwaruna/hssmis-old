

		
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
		
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
/*if($reg_check==1){
if($stlvl==1){
$semi_st=1;
		}
else{
$semi_st=2;
}
}*/
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////





	echo '<div align="left"><table border="0" align="center"><tr><td style="font-size:12px">';
	
	$con1_6=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);
	$id_1=$_SESSION['user_id'];
	
	
	/* Registering Main Core course Units */
	
	
	if($semi_st==1)	
	$query_1_6="select distinct c.code, c.name ,c.requirment,c.target_group from courseunit c, combination o, student s , target_group t where o.id=s.combination and s.id='$id_1' and o.subject=t.subject and t.target_id=c.target_group and c.core='co' and c.level='$level_st' and (c.semister=1 or c.semister=3) and c.availability=1 order by c.code";
	elseif($semi_st==2)
	$query_1_6="select distinct c.code, c.name ,c.requirment,c.target_group from courseunit c, combination o, student s , target_group t where o.id=s.combination and s.id='$id_1' and o.subject=t.subject and t.target_id=c.target_group and c.core='co' and c.level='$level_st' and (c.semister=2 or c.semister=3) and c.availability=1 order by c.code";
		
	$ccc=mysql_query($query_1_6);
	
	
	echo '<tr><td colspan="5"  align="center" style="font-size:16px" ><font color="#8c189d"><b>Registration For Core Course Units</b></font></td></tr>';	
	
	if(mysql_num_rows($ccc)==0){
	
	echo '<tr class="trbgc"><td colspan="5"  align="center">No Core Course Units for Registration</th></tr>';	
								}
	else{
	echo"<th>Course Unit<th>Course name<th>Prerequisites<th>Current Status<th>Submit as</tr>";
	while($data_1_1=mysql_fetch_array($ccc)){
		$register="ok";
			$df=$data_1_1['code'];
			$trgtbp=$data_1_1['target_group'];
				if($trgtbp!="12"){
					$register="ok";
							}
				else{
				$quegtcs="select c.subject from combination c, student s where s.combination=c.id and s.id='$id_1'";
				$qugtcs=mysql_query($quegtcs);
				while($qgtcs=mysql_fetch_array($qugtcs)){
					$cmbsubj=$qgtcs['subject'];
						if($cmbsubj=="computer_science"){
								$register="no";
										}
									}

					}





//..............Edit by iranga......
	if($register=="ok"){
/////////////////////////////////////--------------------/////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
			$coursegetchr=trim($df);
			$ccdwoutcrd=substr("$coursegetchr", 0, -1);
			$getchar = preg_split('//', $coursegetchr, -1);

					$credit=$getchar[7];
					if(($credit=="a")||($credit=="A")){
						$credit="&#945;";
							}
					elseif(($credit=="b")||($credit=="B")){
						$credit="&#946;";
								}
					elseif(($credit=="d")||($credit=="D")){
						$credit="&#948;";
								}
					else{
						$credit=$credit;
						}

			$coscode2=$ccdwoutcrd.$credit;
////////////////////////////////////////////////////////////////////////////////////////
							////////////////////////////////////////////////////////
								$getchar = preg_split('//', $coscode2, -1);

								$midcredit=$getchar[5];
								if($midcredit=="b"){
									$getlob=explode('b',$coscode2);
										$fistprt=$getlob[0];
										$sectprt=$getlob[1];
										$fulcodeco=strtoupper($fistprt)."b".$sectprt;
														}

								elseif($midcredit=="B"){
									$getlob=explode('B',$coscode2);
										$fistprt=$getlob[0];
										$sectprt=$getlob[1];
										$fulcodeco=strtoupper($fistprt)."b".$sectprt;
														}
								else{
								$fulcodeco=strtoupper($coscode2);
								}
							////////////////////////////////////////////////////







	$check_to_reg2="select id,confirm from registration where student='$id_1' and (semister='$semi_1' or semister='3') and acedemic_year='$ac_1' and course='$df'";
	
	$check2=mysql_query($check_to_reg2);
	$chk2=mysql_fetch_array($check2);
	$id2=$chk2['id'];
	$idcmf=$chk2['confirm'];
		if($idcmf==1){
			$idcmf2="<font color=blue>[Confirmed]</font>";
				}
		else{
			$idcmf2="<font color=red>[Not Confirmed]</font>";
			
			}

		if(mysql_num_rows($check2)=='1')
		{	
		echo '<form method="POST" action="index.php?view=admin&admin=1&task=removereg&id='.$id2.'">';

			echo "<tr class=selectbg><td align=center><b>".$fulcodeco."</b>";
			echo '<input type="hidden" name="cou_1" value="'.$data_1_1['code'].'" size="10"></b></font></td>';
			echo '<td>&nbsp;&nbsp;'.$data_1_1['name']." (Core Course)&nbsp;";
			
			echo '<select size="1" name="deg_1" style="visibility:hidden">';
			echo '<option selected value="1">D</option></td>';
			echo '</select>';
			echo "<td align='left'>&nbsp;".$data_1_1['requirment']."</td>";
			echo '<td align="center" valign="middle"><font color=blue>Registered !</font>';
			echo '<td align="center" valign="middle">';
			echo'<input type="submit" value="  Cancel  " name="Removereg">';
			echo '</form></td></tr>';

			
		}	
		else{

		echo '<form method="POST" action="index.php?view=admin&admin=1&task=register">';

			echo "<tr class=trbgc><td align=center><b>".$fulcodeco."</b>";
			echo '<input type="hidden" name="cou_1" value="'.$data_1_1['code'].'" size="10"></b></font></td>';
			echo '<td>&nbsp;&nbsp;'.$data_1_1['name']." (Core Course)&nbsp;";
			
			echo '<select size="1" name="deg_1" style="visibility:hidden">';
			echo '<option selected value="1">D</option></td>';
			echo '</select>';
			echo "<td align='left'>&nbsp;".$data_1_1['requirment']."</td>";
			echo '<td align="center" valign="middle"><font color=red>Not Registered !</font>';
			echo '<td align="center"><input type="submit" value="Register" name="submit">';
			echo '</form></td></tr>';
			
	
			}
	
		}
	/////////////////////////////////////--------------------/////////////////////////////////////////////	
			}///register ok if close
		}
echo "</table><br>";















	/* Registering Optional and Non degree Course Units */
	
    if($semi_st==1)
	$query_1_7="select distinct c.code, c.name ,c.requirment,c.target_group from courseunit c, combination o, student s , target_group t where o.id=s.combination and s.id='$id_1' and o.subject=t.subject and t.target_id=c.target_group and (c.core='op' or c.core='nd' or c.core='nn') and c.level='$level_st' and (c.semister=1 or c.semister=3) and c.availability=1 order by c.code";
	elseif($semi_st==2)
	$query_1_7="select distinct c.code, c.name ,c.requirment,c.target_group from courseunit c, combination o, student s , target_group t where o.id=s.combination and s.id='$id_1' and o.subject=t.subject and t.target_id=c.target_group and (c.core='op' or c.core='nd' or c.core='nn') and c.level='$level_st' and (c.semister=2 or c.semister=3) and c.availability=1 order by c.code";
	//echo$query_1_7;
	$cce=mysql_query($query_1_7);
	
	if(mysql_num_rows($cce)!=0){
	
	
	
	echo '<table border="0" align="center"><td style="font-size:12px">';
		echo '<tr><td colspan="5" align="center" style="font-size:16px"><font color="#8c189d"><b>Registration For Optional And Non Degree Course Units </b></font></td></tr>';
	echo"<th>Course Unit<th>Course name<th>Degree Status<th>Prerequisites<th>Current Status<th>Submit as</tr>";
	while($data_1_1=mysql_fetch_array($cce)){
	$registerop="ok";
		$dfo=$data_1_1['code'];
		$trgtbpop=$data_1_1['target_group'];
			if($trgtbpop!="12"){
				$registerop="ok";
						}
			else{
			$quegtcs="select c.subject from combination c, student s where s.combination=c.id and s.id='$id_1'";
			$qugtcs=mysql_query($quegtcs);
			while($qgtcs=mysql_fetch_array($qugtcs)){
				$cmbsubj=$qgtcs['subject'];
					if($cmbsubj=="computer_science"){
							$registerop="no";
									}
								}

				}
//////////////............................//////////////////////......................./////////////////////////////
		if($registerop=="ok"){



////////////////////////////////////////////////////////////////////////////////////////
			$coursegetchr=trim($dfo);
			$ccdwoutcrd=substr("$coursegetchr", 0, -1);
			$getchar = preg_split('//', $coursegetchr, -1);

					$credit=$getchar[7];
					if(($credit=="a")||($credit=="A")){
						$credit="&#945;";
							}
					elseif(($credit=="b")||($credit=="B")){
						$credit="&#946;";
								}
					elseif(($credit=="d")||($credit=="D")){
						$credit="&#948;";
								}
					else{
						$credit=$credit;
						}

			$opcoscode2=$ccdwoutcrd.$credit;
////////////////////////////////////////////////////////////////////////////////////////
							////////////////////////////////////////////////////////
								$getchar = preg_split('//', $opcoscode2, -1);

								$midcredit=$getchar[5];
								if($midcredit=="b"){
									$getlob=explode('b',$opcoscode2);
										$fistprt=$getlob[0];
										$sectprt=$getlob[1];
										$fulcodeop=strtoupper($fistprt)."b".$sectprt;
														}

								elseif($midcredit=="B"){
									$getlob=explode('B',$opcoscode2);
										$fistprt=$getlob[0];
										$sectprt=$getlob[1];
										$fulcodeop=strtoupper($fistprt)."b".$sectprt;
														}
								else{
								$fulcodeop=strtoupper($opcoscode2);
								}
							////////////////////////////////////////////////////



	$check_to_reg2_op="select id,confirm,degree from registration where student='$id_1' and (semister='$semi_1' or semister='3') and acedemic_year='$ac_1' and course='$dfo'";
	$check2_op=mysql_query($check_to_reg2_op);
	$chk2op=mysql_fetch_array($check2_op);
	$id2op=$chk2op['id'];
	$idcmf2=$chk2op['confirm'];
		if($idcmf2==1){
			$idcmf3="<font color=blue>[Confirmed]</font>";
				}
		else{
			$idcmf3="<font color=red>[Not Confirmed]</font>";
			
			}
	$dgstop=$chk2op['degree'];
		if($dgstop==1){
			$dgstop2="Degree";
				}
		else{
			$dgstop2="<font color=red>Non Degree</font>";
			}




	if(mysql_num_rows($check2_op)=='1')
		{
			echo '<form method="POST" action="index.php?view=admin&admin=1&task=removereg&id='.$id2op.'">';
			echo "<tr class=selectbg><td align='center'><font color=#800000><b>".$fulcodeop."</b>";
			echo '<input type="hidden" name="cou_1" value="'.$data_1_1['code'].'" size="10"></b></font></td>';
			echo '<td><font color="#800000">&nbsp;&nbsp;'.$data_1_1['name']." (Optional)&nbsp;";
			echo '</font></td>';
			echo "<td align='center'>$dgstop2</td>";
			echo "<td align='left'>&nbsp;".$data_1_1['requirment']."</td>";
			echo '<td align="center" valign="middle"><font color=blue>Registered !</font>';
			echo '<td align="center">';
				
			echo'<input type="submit" value="  Cancel  " name="Removereg"></font>';
				

			echo "</form></td></tr>";
			
		}

	else	{

			echo '<form method="POST" action="index.php?view=admin&admin=1&task=register">';
			echo "<tr class=trbgc><td align=center><font color=#800000><b>".$fulcodeop."</b>";
			echo '<input type="hidden" name="cou_1" value="'.$data_1_1['code'].'" size="10"></b></font></td>';
			echo '<td><font color="#800000">&nbsp;&nbsp;'.$data_1_1['name']." (Optional)&nbsp;";
			echo '</font></td>';
			echo '<td align="center"><select size="1" name="deg_1">';
			echo '<option selected value="1">Degree</option>';
		   	echo '<option value="2">Non Degree</option>';
			echo '</select></td>';
			echo "<td align='left'>&nbsp;".$data_1_1['requirment']."</td>";
			echo '<td align="center" valign="middle"><font color=red>Not Registered!</font>';
			echo '<td align="right"><input type="submit" value="Register" name="submit">';
			echo '</form></td></tr>';
				
		}
		}///registerop ok if close
//////////////............................//////////////////////......................./////////////////////////////
	}
	mysql_close($con1_6);
	echo '</tr></table></div><br>';
	 //echo "<br><br><hr color=#E1E1F4 width=100% >";
	 
	 
						}
	 
	 
	 
	 
	 
	 
	 
	?>
