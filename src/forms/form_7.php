<?php
//error_reporting(0);
session_start();
if(($_SESSION['login'])=="truefohssmis"){


$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
//echo $querole;
$qurole=mysql_query($querole) or die(mysql_error());

if($qurole!=NULL)
{
while($qrole=mysql_fetch_array($qurole)){
$roleid=$qrole['role_id'];
}
//echo$qpers['id'];
$quepers="SELECT id FROM permission WHERE role_id =$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
if($qpers['id']=="7"){
$pem="TRUE";

}
}
}
else
{
echo "You Have Not Permission To Access This Area!";
}

if($pem=="TRUE")
{
?>  

<script>


function showamntbx() {

var rgtpval=document.getElementById("regtp_7").value;

	if(rgtpval=="Limited"){
	document.getElementById("lmtdno").style.visibility='visible';
			}
	else{
	document.getElementById("lmtdno").style.visibility='hidden';
		}
	
	
    
	
	
}
</script>

<script>


function showgpabx() {

var rgtpval=document.getElementById("co_7").value;

	if(rgtpval=="GE"){
		document.getElementById("gpslbl").style.visibility='visible';
		
	
		document.getElementById("cotyp1_7").style.visibility='visible';
		document.getElementById("cotyp1_7").options.length=0;
		
		var sel = document.getElementById('cotyp1_7');
		
		var opt = document.createElement('option');
		opt.appendChild( document.createTextNode('GPA') );
		opt.value = 'GPA'; 
		sel.appendChild(opt)
		
		var opt1 = document.createElement('option');
		opt1.appendChild( document.createTextNode('NGPA') );
		opt1.value = 'NGPA'; 
		sel.appendChild(opt1)
			
		var opt2 = document.createElement('option');
		opt2.appendChild( document.createTextNode('Both (GPA+NGPA)') );
		opt2.value = 'GPA+NGPA'; 
		sel.appendChild(opt2)
		
			}
			
			
			
			
	else if(rgtpval=="TE"){
		document.getElementById("gpslbl").style.visibility='visible';
		document.getElementById("cotyp1_7").style.visibility='visible';
		document.getElementById("cotyp1_7").options.length=0;
		
		var sel = document.getElementById('cotyp1_7');
		
		var opt = document.createElement('option');
		opt.appendChild( document.createTextNode('GPA') );
		opt.value = 'GPA'; 
		sel.appendChild(opt)
		
		var opt1 = document.createElement('option');
		opt1.appendChild( document.createTextNode('NGPA') );
		opt1.value = 'NGPA'; 
		sel.appendChild(opt1)
			
		var opt2 = document.createElement('option');
		opt2.appendChild( document.createTextNode('Both (GPA+NGPA)') );
		opt2.value = 'GPA+NGPA'; 
		sel.appendChild(opt2)
			}	
			
			
			
	else{
		document.getElementById("gpslbl").style.visibility='hidden';
		document.getElementById("cotyp1_7").style.visibility='visible';
		document.getElementById("cotyp1_7").options.length=0;
		
		var sel = document.getElementById('cotyp1_7');
		
		var opt = document.createElement('option');
		opt.appendChild( document.createTextNode('GPA') );
		opt.value = 'GPA'; 
		sel.appendChild(opt)
		
		}
	
}
</script>

<script>
function hidelbl() {
	var lblval=document.getElementById("gpslbl").style.visibility='hidden';
					}
</script>










<!--
 // create new option element
// create text node to add to option element (opt)
opt.appendChild( document.createTextNode('New Option Text') );
opt.value = 'option val'; // set value property of opt
sel.appendChild(opt); // add opt to end of select box (sel)
-->


<div align="center"><strong>Introduce New Course Unit</strong><br  />

</div>
<div align="center">
<table border="0" width="90%" >
<form method="POST" action="index.php?view=admin&admin=7&task=addcourse">    

<!----------------------------row 1--------------------------------->
<tr height="30px" class="trbgc">
<td width=18%>
	<font color="#800000">&nbsp;&nbsp; Course Unit Code </font> 
	
	
<td width=35% > : 	
	<span id="code">
	<input type="text" name="code_7" size="12" required>
	&nbsp;
	<span class="textfieldRequiredMsg"><font size="-1"> Enter a Course Unit Code</font></span>
	<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>	</span>
	
	<!--<font color="red">[ &#945; = a ] [ &#946; = b ] [ &#948; = d ]</font>-->
<font color="#800000">	
&nbsp;	&nbsp;In&nbsp;&nbsp;	
	<select name=cosmdum>
		<option value='SI'>Sinhala</option>
		<option value='EN'>English</option>
		<option value='SI+EN'>Sinhala & English</option>
	</select>
	&nbsp;&nbsp; Medium	
</font>
<td width=18%>	
	<font color="#800000">&nbsp;&nbsp; Course Unit Name </font> 
	
	
<td width=31%> : 
	<span id="sprytextfield1">
	<input type="text" name="name_7" size="30" required>
	&nbsp; 
	<span class="textfieldRequiredMsg"><font size="-1"> Enter a Course Unit Name</font></span></span>
	
	

	
<!--
	<font size="2" color="#FF0000">&nbsp;&nbsp; </font><font color="#800000">Credits :</font> 
	<span id="sprytextfield2">
	<input type="text" name="cre_7" size="1">
	<span class="textfieldRequiredMsg"><font size="-1"> Enter # Credits </font></span></span>-->


<!--<font color="#800000">&nbsp; Level :</font> 
	<select size="1" name="le_7">
	<option value="1">One</option>
	<option value="2">Two</option>
	<option value="3">Three</option>
	</select> &nbsp; <br><br>-->
<!----------------------------row 2--------------------------------->	
<tr height="30px" class="trbgc">
<td>	
	<font color="#800000">&nbsp;&nbsp;  Course Unit Core </font> 
	
	
<td> : 
    <select size="1" name="co_7" id="co_7" ">
	<option value="co" selected="selected">Compulsory Course Unit</option>
	<option value="op">Optional Course Unit</option>
	<option value="nd">No Credits Compulsory Course</option>
	<option value="nn">No Credits Other Course</option>
	
	</select>
	

<td>	
	<font color="#800000">&nbsp;&nbsp;  Course Unit Type</font>
<td> : 

<select size="1" name="cotyp_7" id="cotyp1_7" ">
	<option value="Theory" selected="selected">Theory</option>
	<option value="Practical">Practical</option>
	<option value="Th+Pr">Both (Theory/Practical)</option>
	<option value="Other">Other</option>	
</select>
<font color=red id=gpslbl style='visibility: hidden'>[ Please select one ]</font>
<!----------------------------row 3--------------------------------->
<tr height="30px" class="trbgc"><td>
	<!--
	<font color="#800000">&nbsp;&nbsp; No of Students  </font> <td>:
		<select name="regtp_7" onchange="showamntbx()" id="regtp_7">
			<option value="Normal" selected>Normal</option>
			<option value="Limited">Limited</option>
			
		</select>
		<span id="number1">
		<input type=text name=lmtdno id=lmtdno size=6 Placeholder=Amount style='visibility: hidden' >
			
		<span class="textfieldRequiredMsg"><font size="-1"> Max. Students Amount </font></span>
		<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid Number</font></span>
		</span>
	<!--<font color="#800000">&nbsp;&nbsp; Semester </font> <td>:
	<select size="1" name="se_7">
	<option value="1" selected>1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
	
	
	
	
	</select> &nbsp; -->
	<?php
	if($department_7!="all"){
	$query7_h="select user,l_name,initials from $rmsdb.fohssmis where section='$department_7' and (role='lecturer' or role='general' or role='topadmin' or role='dssc') order by l_name";
				}
	else{
	$query7_h="select user,l_name,initials from $rmsdb.fohssmis where (role='lecturer' or role='general' or role='topadmin' or role='dssc') order by l_name";
		}
	$usr_9=mysql_query($query7_h);
	echo '<font color="#800000">&nbsp;&nbsp; Coordinator  </font> ';
	echo "<td> : <select name=cood_7>";
	echo"<option value='Add Here'>Add Here</option>";
  	while($data8=mysql_fetch_array($usr_9)){
	echo '<option value="'.$data8['user'].'">'.$data8['l_name'].' '.$data8['initials'].'</option>';
	}			
	echo "</select>";
	
	
	echo '<td><font color="#800000">&nbsp;&nbsp; Lecturers  </font><td>: ';
	if($department_7!="all"){
	$query7_h2="select user,l_name,initials from $rmsdb.fohssmis where section='$department_7' and (role='lecturer' or role='general' or role='topadmin' or role='dssc') order by l_name";
				}
	else{
	$query7_h2="select user,l_name,initials from $rmsdb.fohssmis where (role='lecturer' or role='general' or role='topadmin' or role='dssc') order by l_name";
		}
	$usr_92=mysql_query($query7_h2);	
	
	
	
	
	
	echo "<select name=lec1_7>";
	echo"<option value='No'>No</option>";
  	while($data82=mysql_fetch_array($usr_92)){
	echo '<option value="'.$data82['user'].'">'.$data82['l_name'].' '.$data82['initials'].'</option>';
	}			
	echo "</select>";
	
	
	
	
	
	
	if($department_7!="all"){
	$query7_h23="select user,l_name,initials from $rmsdb.fohssmis where section='$department_7' and (role='lecturer' or role='general' or role='topadmin' or role='dssc') order by l_name";
				}
	else{
	$query7_h23="select user,l_name,initials from $rmsdb.fohssmis where (role='lecturer' or role='general' or role='topadmin' or role='dssc') order by l_name";
		}
	$usr_923=mysql_query($query7_h23);		
	echo "<br>:&nbsp;<select name=lec2_7>";
	echo"<option value='No'>No</option>";
  	while($data823=mysql_fetch_array($usr_923)){
	echo '<option value="'.$data823['user'].'">'.$data823['l_name'].' '.$data823['initials'].'</option>';
	}			
	echo "</select>";	
	
	
	
	

//<!----------------------------row 4--------------------------------->
	



	$quedept="select distinct(dept_name),dept_code from department where status=1 order by dept_name";
	$qudept=mysql_query($quedept);
	echo '<tr class="trbgc" height="30px"><td><font color="#800000">&nbsp;&nbsp; Offering Department </font> ';
	echo "<td> : <select name=dept>";
		if($department_7=="all"){
		while($qdept=mysql_fetch_array($qudept)){
			$dept=$qdept['dept_name'];
			$deptcd=$qdept['dept_code'];
			echo"<option value='$deptcd'>".strtoupper($dept)."</option>";
							}
					}
		else{
			$quegtdeptcode="select dept_code from department where dept_name='$department_7' ";
			$qugtdeptcode=mysql_query($quegtdeptcode);
				$qgtdeptcode=mysql_fetch_array($qugtdeptcode);
					$gtdeptcode=$qgtdeptcode['dept_code'];
			echo"<option value='$gtdeptcode'>".strtoupper($department_7)."</option>";
			}
	echo"</select>";
	?>
	
<td> 	
	<font color="#800000">&nbsp;&nbsp; Curriculum </font>
	
<td> : 	
    <select name="curri_7" size="1" id="curri_7">
<?php
$quegetcrry="select * from  curriculum order by cr_id DESC";
$qugetcrry=mysql_query($quegetcrry);
if(mysql_num_rows($qugetcrry)!=0){
	while($qgetcrry=mysql_fetch_array($qugetcrry)){
		$getcrryvalue=$qgetcrry['cr_value'];
		$getcrryname=$qgetcrry['cr_name'];
		
			echo"<option value=$getcrryvalue>$getcrryname</option>";
		
	}
}
else{
	echo"<option value=0>Error</option>";
}


?>
    </select>
	
	
	
	
	
	
	
	
	
<!----------------------------row 5--------------------------------->	
	
	
	
<?php	
	echo '<tr class="trbgc" height="30px"align=center><td colspan=4 ><font color="#800000"><br>Please select the relevent subject/(s) for course unit</font><br> ';
	$quegetmnsub="select * from main_subjects where status=1 order by sub_name";
	$qugetmnsub=mysql_query($quegetmnsub);
	if(mysql_num_rows($qugetmnsub)!=0){
		$subtblid=0;
		echo"<table width=100% border=0>";
	while($qgetmnsub=mysql_fetch_array($qugetmnsub)){
		
		$getmnsub=$qgetmnsub['sub_name'];
		$getmnsubid=$qgetmnsub['sub_id'];
		
		$dv=fmod($subtblid,4);
		if($dv==0){
			echo"<tr align=center valign=top><td width=20%>";
		}
		else{
			echo"<td width=20%>";
		}
		
		echo"<label><table><tr><td><input type=checkbox name=itmbox$subtblid id=itmbox$subtblid value=$getmnsubid><td>".ucfirst($getmnsub)."</table></label>";
		
		$subtblid++;
	}
	$dv2=fmod($subtblid,4);
			if($dv2==0){
			echo"<tr align=center valign=top><td width=20%>";
		}
		else{
			echo"<td width=20%>";
		}
	echo"<label><table><tr><td><input type=checkbox name=allitmbox id=allitmbox value='All'><td><B>ALL SUBJECTS</B></table></label>";
	echo"</table>";
	echo"<input type=hidden name=chkbxvl value=$subtblid>";
	}
	else{
		echo"Sorry! Can not find main subjects. Contact administrator.";
	}



	?>













<tr height="30px" class="trbgc">


<!----------------------------row 6--------------------------------->	

<td> 
	<font color="#800000">&nbsp;&nbsp; If any Pre Requisites </font>
	
<td> : 	  <select name="require_7">
										<option value="No">Select one</option>
										<?php
										
										/*if($department_7!="all"){
										
											$quegetprrqes="select distinct code, by_low_version from courseunit where department='$department_7' and availability<>0 order by code";
													}
										else{
										    $quegetprrqes="select distinct code, by_low_version  from courseunit where availability<>0 order by department,code";
											}
										*/	
											
										$quegetprrqes="select distinct c.code, c.by_low_version,cr.cr_code  from courseunit c,curriculum cr where c.availability<>0 and c.by_low_version=cr.cr_value order by c.department,c.code";
										$qugetprrqes=mysql_query($quegetprrqes);
										while($qgetprrqes=mysql_fetch_array($qugetprrqes)){
													$getprrqes=$qgetprrqes['code'];
													$getprrqescdcrry=$qgetprrqes['by_low_version'];
													$getprrqescdcrry_code=$qgetprrqes['cr_code'];
													
													$crculm=$getprrqescdcrry_code;
													/*
														if($getprrqescdcrry=="1"){
															$crculm="<font color=red>N.C.</font>";
														}
														else{
															$crculm="<font color=red>O.C.</font>";
														}
													*/
													echo"<option value='$getprrqes'>".strtoupper($getprrqes)." - (".$crculm.")</option>";
																							}
										
										
										?>
										
										
									  </select>
	
	
	
<td> 	
	<font color="#800000">&nbsp;&nbsp; Availability </font>
	
<td> : 	
    <select name="availability_7" size="1" id="availability_7"  >
    <option value="1" selected >Available</option>
	<option value="2" disabled="disabled">Not Available only for this Semester</option>
    <option value="0" disabled="disabled">Total Remove</option>
    </select>
	
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<tr height="30px" class="trbgc">
<td  align=center colspan=4> 	
	<input type="submit" value="Submit The New Course Unit" name="submit" id="submit">
	</form>
	
	
	</table>


</div>









<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>
