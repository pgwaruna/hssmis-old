<!--Edit by iranga..... -->
	

<form method="POST" action="imp_exp/reg_view.php">
	<table class=bgc width=70% align=center><tr height=50px align=center><td>

  
  <select name="stream" size="1" id="level">
    <option value="All">All Student</option>
    <option value="General">All General Student</option>
    <option value="Special">All Special Student</option>
    <!--<option value="Special Sinhala Medium">Special Sinhala Medium Student</option>
	<option value="Special English Medium">Special English Medium Student</option>-->

  </select> 

&nbsp;&nbsp;&nbsp;



  <font color="#800000">Level </font>&nbsp;: 
  <select name="level" size="1" id="level">
    <option value="1">1000</option>
    <option value="2">2000</option>
    <option value="3">3000</option>
	<option value="4">4000</option>
  </select> 
  
  
  &nbsp;&nbsp;&nbsp;
  
  <font color="#800000">Semester</font> &nbsp;: 
  <select name="sem" size="1" id="sem">
    <option value="1">One</option>
    <option value="2">Two</option>
    </select>
&nbsp;&nbsp;&nbsp;
  <font color="#800000">Accademic Year</font>&nbsp;:  
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
  </select>&nbsp;&nbsp;&nbsp;
<input type="submit" value="Find" name="submit">

</table>
</form>
<!--
<form method="POST" Action="add_st_details.php">
//<input type="text" name="st_de_file" size="32"><br><br>
//CSV file path paste here &nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" value="Submit" name="submit"><br><br>
</form>
-->


BULK CONFIRMATION
	<br><br>
	<form method="POST" action="imp_exp/reg_conf.php">
	<table width=70%><tr  class=selectbg height=50px  align=center><td>
	
  
  <select name="stream" size="1" id="level">
    <option value="All">All Student</option>
    <option value="General">All General Student</option>
    <option value="Special">All Special Student</option>
    <!--<option value="Special Sinhala Medium">Special Sinhala Medium Student</option>
	<option value="Special English Medium">Special English Medium Student</option>-->
  </select> 	
&nbsp;&nbsp;&nbsp;	
	
	
	
  <font color="#800000">Level </font>&nbsp;: 
  <select name="level" size="1" id="level">
    <option value="1">1000</option>
    <option value="2">2000</option>
    <option value="3">3000</option>
	<option value="4">4000</option>
  </select> 
  
  &nbsp;&nbsp;&nbsp;
  
  <font color="#800000">Semester</font> &nbsp;: 
  <select name="sem" size="1" id="sem">
    <option value="1">One</option>
    <option value="2">Two</option>
    </select>
&nbsp;&nbsp;&nbsp;
  <font color="#800000">Accademic Year</font> &nbsp;:  
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
  &nbsp;&nbsp;&nbsp;
<input type="submit" value="Find" name="submit" onclick="NewWindow('imp_exp/reg_conf.php','mywin','860','600','yes','center');return false">

</table>
</form>



<?php
//echo '[ <a href="forms/uploads/uploadfile.php">Click here to choose a file for upload to bulk registration</a> ]<br><br>';
//include 'forms/uploads/uploadfile.php';
?>