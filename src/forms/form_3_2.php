
	
	
<form method="POST" action="imp_exp/reg_view.php">
  <font color="#800000">Level </font>
  <select name="level" size="1" id="level">
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
  </select> 
  <font color="#800000">&nbsp;Semester</font> 
  <select name="sem" size="1" id="sem">
    <option value="1">One</option>
    <option value="2">Two</option>
    </select>

  <font color="#800000">Accademic Year</font>  
  <select name="acc_year" size="1" id="acc_year_cur">
<?php     
	 $con5_a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
     mysql_select_db($db);
     $query5_a="select acedemic_year from acc_year where current = 1";
     $five_a=mysql_query($query5_a);
	 while($data5=mysql_fetch_array($five_a)){
	 echo "<option value=".$data5['acedemic_year'].">";
	 $acc_parts=explode("_",$data5['acedemic_year']);
	 echo $acc_parts[0]." - ".$acc_parts[1];
	 echo "</option>";
	 }
?>
  </select>
<input type="submit" value="Find" name="submit">
<br><br></form>
BULK CONFIRMATION
	<br><br>
	<form method="POST" action="imp_exp/reg_conf.php">
  <font color="#800000">Level </font>
  <select name="level" size="1" id="level">
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
  </select> 
  <font color="#800000">&nbsp;Semester</font> 
  <select name="sem" size="1" id="sem">
    <option value="1">One</option>
    <option value="2">Two</option>
    </select>

  <font color="#800000">Accademic Year</font>  
  <select name="acc_year" size="1" id="acc_year_cur">
<?php     
	 $con5_a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
     mysql_select_db($db);
     $query5_a="select acedemic_year from acc_year where current = 1";
     $five_a=mysql_query($query5_a);
	 while($data5=mysql_fetch_array($five_a)){
	 echo "<option value=".$data5['acedemic_year'].">";
	 $acc_parts=explode("_",$data5['acedemic_year']);
	 echo $acc_parts[0]." - ".$acc_parts[1];
	 echo "</option>";
	 }
?>
  </select>
<input type="submit" value="Find" name="submit" onclick="NewWindow('imp_exp/reg_conf.php','mywin','860','600','yes','center');return false">
<br><br></form>
