<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Personal Information</title>

<script type="text/javascript">
function checkr(r)
{
	 
	if (r.nic.value==""){
 	alert("Enter your National Identity Card No");
	r.nic.focus();
 	return false;}
	 
 	 
  	if (r.padd2.value==""){
	alert("Enter your Compleate Personal Address ");
	r.padd2.focus();
 	return false;}
	  
 }
</script>

</head>

<body>
<p>&nbsp;</p>
<form method="POST" action="personal_2.php">
<table width="90%" border="0" align="center">
<tr><td><input type="hidden" name="task" value="regis1"><td><input type="hidden" name="student" value="<?php echo$student;?>">
  <tr>
    <td width="40%" >National Identity Card No:</td>
    <td width="23%" colspan="2">
      <input type="text" name="nic" size="20" value="<?php echo$nic;?>"/>    </td>
    
    <td width="30%">&nbsp;</td>
  </tr>
  <tr>
    <td>Date Of Birth: </td>
    <td><div align="center">Year:      
      <select name="year">
	<?php 
	
	  for($y=1985;$y<=2005;$y++){
		if($styear==$y){
       		echo"<option value=$y selected>$y</option>";
	   	 }
		else{
		echo"<option value=$y>$y</option>";
		    }		
				     }
	?>
	</select>
    </div></td>
    <td><div align="center">Month:
      <select name="month">
<?php
$month[1]="January";
$month[2]="February";
$month[3]="March";
$month[4]="April";
$month[5]="May";
$month[6]="June";
$month[7]="July";
$month[8]="August";
$month[9]="September";
$month[10]="October";
$month[11]="November";
$month[12]="December";
	for($m=1;$m<=12;$m++){
		if($m<='9'){
		$n="0".$m;
			}
		else{
		$n=$m;
		   }
			if($stmon==$n){
			echo "<option value=$n selected>$month[$m]</option>";
				 }    
			else{
			echo "<option value=$n >$month[$m]</option>";	
				}
			   }
?>       
	 </select>
    </div></td>
    <td><div align="center">Date:
      <select name="dated">
        <?php 
	  for($d=1;$d<=31;$d++){
		if($d<='9'){
		$dd="0".$d;
			}
		else{
		$dd=$d;
		   }
	       		if($stdate==$d){	
	       		echo"<option value=$dd selected>$d</option>";
		   	 		}
			else{
			echo"<option value=$dd>$d</option>";
			    }	
	   	 		}		
	?>
        </select>
    </div></td>
  </tr>
  <tr>
    <td>Gender:</td>
    <td><div align="center">Male
	<?php
	if($gen=="female"){
      	echo"<input name='gender' type='radio' value='male'  />";
	echo"</div></td>";
	echo"<td>Female";
      	echo"<input name='gender' type='radio' value='female' checked/></td>";
	}
    	else{
	echo"<input name='gender' type='radio' value='male' checked/>";
	echo"</div></td>";
    	echo"<td>Female";
      	echo"<input name='gender' type='radio' value='female'/></td>";
	}?>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4">Personal Address </td>
    
  </tr>
  <tr>
    <td ><div align="right">Address No:</div></td>
    <td colspan="2"><input type="text" name="padd1"  size="40" value="<?php echo$padd1;?>"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td co><div align="right">Address Line 1: </div></td>
    <td colspan="2"><input type="text" name="padd2"size="40" value="<?php echo$padd2;?>"/></td>
    <td>&nbsp;</td>
   
  </tr>
  <tr>
    <td><div align="right">Address Line 2: </div></td>
    <td colspan="2"><input type="text" name="padd3"size="40" value="<?php echo$padd3;?>"/></td>
    <td>&nbsp;</td>
    
  </tr>
  <tr>
    <td><div align="right">Address Line 3: </div></td>
    <td colspan="2"><input type="text" name="padd4" size="40" value="<?php echo$padd4;?>"/></td>
    <td>&nbsp;</td>
    
  </tr>
  <tr>
    <td colspan="4">Temporary Address </td>
    
  </tr>
  <tr>
    <td><div align="right">Address No: </div></td>
    <td colspan="2"><input type="text" name="tadd1" size="40" value="<?php echo$tadd1;?>"/></td>
    <td>&nbsp;</td>
    
  </tr>
  <tr>
    <td><div align="right">Address Line 1: </div></td>
    <td colspan="2"><input type="text" name="tadd2" size="40" value="<?php echo$tadd2;?>"/></td>
    <td>&nbsp;</td>
   
  </tr>
  <tr>
    <td><div align="right">Address Line 2: </div></td>
    <td colspan="2"><input type="text" name="tadd3" size="40" value="<?php echo$tadd3;?>"/></td>
    <td >&nbsp;</td>
   
  </tr>
  <tr>
    <td><div align="right">Address Line 3: </div></td>
    <td colspan="2"><input type="text" name="tadd4" size="40" value="<?php echo$tadd4;?>"/></td>
    <td>&nbsp;</td>
   
  </tr>
  <tr>
    <td>Contact Numbers </td>
    <td><div align="right">Home:</div></td>
    <td><input type="text" name="home" value="<?php echo$telih;?>" size="16"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><div align="right">Mobile:</div></td>
    <td><input type="text" name="mobile" value="<?php echo$telim;?>" size="16"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Email Address</td>
   <td colspan="3"><input type="text" name="email" value="<?php echo$email;?>"/></td>
  </tr>
  <tr>
    <td>Civil Status</td>
    <td><select name="cstate">
<?php
	if($cstat=="married"){
      echo"<option value='married' selected>Married</option>";
      echo"<option value='unmarried'>Unmarried</option>";
			     }
	else{
	echo"<option value='married'>Married</option>";
      	echo"<option value='unmarried' selected>Unmarried</option>";
	    }
?>
    </select>
    </td>
    <td align="right">Weight</td>
    <td><input type="text" name="weight" value="<?php echo$weight;?>" size="5"/>kilogram(kg)</td>
  </tr>
  <tr>
    <td>Nationality </td>
    <td><input type="text" name="nation" value="<?php echo$nation;?>"/></td>
    <td align="right">Height</td>
    <td><input type="text" name="height" value="<?php echo$height;?>" size="5"/>centimeter(cm)</td>
  </tr>
  
  <tr>
    <td>District</td>
    <td><select name="district">
<?php 
$dist[1]="Ampara";
$dist[2]="Anuradhapura";
$dist[3]="Badulla";
$dist[4]="Batticaloa";
$dist[5]="Colombo";
$dist[6]="Galle";
$dist[7]="Gampaha";
$dist[8]="Hambantota";
$dist[9]="Jaffna";
$dist[10]="Kalutara";
$dist[11]="Kandy";
$dist[12]="Kegalle";
$dist[13]="Kilinochchi";
$dist[14]="Kurunegala";
$dist[15]="Mannar";
$dist[16]="Matale";
$dist[17]="Matara";
$dist[18]="Moneragala";
$dist[19]="Mullaitivu";
$dist[20]="Nuwara Eliya";
$dist[21]="Polonnaruwa";
$dist[22]="Puttalam";
$dist[23]="Ratnapura";
$dist[24]="Trincomalee";
$dist[25]="Vavuniya";

	for($di=1;$di<=25;$di++){
		if($distr==$dist[$di]){
		echo"<option value=$dist[$di] selected>$dist[$di]</option>";
				}

		else{
		echo"<option value=$dist[$di]>$dist[$di]</option>";	
			}
				}

	?>
	</select>

    <td align="right">Religion</td>
    <td ><input type="text" name="relig" value="<?php echo$relg;?>" size="12"/></td>
  </tr>
  <tr>
    <td>Blood Group </td>
    <td><input type="text" name="blgp" value="<?php echo$blgp;?>" size="5"/></td>
     <td colspan="2">What is the course you are expecting to follow in the university?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="combination">
	<?php
	$combi[0]="Physical_Science";
	$combi[1]="Bio_Science";
	$combi[2]="Computer_Science";
	for($co=0;$co<3;$co++){
	if($scream==$combi[$co]){
	echo"<option value=$combi[$co] selected>$combi[$co]</option>";
				}
	else{
	echo"<option value=$combi[$co]>$combi[$co]</option>";
		} 	
				}
	?>
</select>

</td></tr>
 <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><input type="submit" name="submit" value="Next" onclick="return checkr(this.form)" /></td>
    <td align="left"><input type="reset" name="Reset" value="Reset"></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
