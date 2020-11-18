<?php
	$status=$_GET['status'];
	$fstno=$_GET['fstno'];
	$herg=$_GET['herg'];
	$visn=$_GET['visn'];
	$phydisabi=$_GET['phydisabi'];
	$supt=$_GET['supt'];
	$sptspe=$_GET['sptspe'];
	$takemedi=$_GET['takemedi'];
	$medicspe=$_GET['medicspe'];
	

	include '../admin/config.php';
	$con5_a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);
if($status=="disp")
{
echo"<input type='hidden' name='dsbl_stat' value='yes'>";
}

elseif($status=="del")
{
echo"<input type='hidden' name='dsbl_stat' value='no'>";
}
/*elseif($status=="hide")
{
echo"<input type='text' name='dsbl_stat' value='yes'>";
}*/
else{echo"<input type='hidden' name='dsbl_stat' value=$status>";}

if($status=="yes"){
echo"<table border='0' bgcolor='#e3cce7'>";
echo"<tr><td colspan='2' align='center'>Please Mention Your Disability</td></tr>";
echo"<tr><td>Hearing impairment</td><td><input type='checkbox' name='hearing' value='hearing_impairment'></td></tr>";
echo"<tr><td>Vision impairment</td><td><input type='checkbox' name='vision' value='vision_impairment'></td></tr>";
echo"<tr><td colspan='2' align='left'>Physical Disability:<td></tr>";
echo"<tr><td valign='top' align='right'>Please Specify</td><td><textarea cols='20' rows'2' name='phycaldsb'></textarea></td></tr>";
echo"<tr><td colspan='2' align='left'>Do you need special support for your disability in the university ?<td></tr>";
echo"<tr><td>Yes:<input type='radio' name='spt' value='support_yes'></td><td>No:<input type='radio' name='spt' value='support_no'></td></tr>";
echo"<tr><td valign='top' align='right'>If Yes, Please Specify</td><td><textarea cols='20' rows'2' name='sptyes'></textarea></td></tr>";
echo"<tr><td colspan='2' align='left'>Do you take regular medicine for known diseases ?<td></tr>";
echo"<tr><td>Yes:<input type='radio' name='deses' value='deses_yes'></td><td>No:<input type='radio' name='deses' value='deses_no'></td></tr>";
echo"<tr><td valign='top' align='right'>If Yes, Please Specify</td><td><textarea cols='20' rows'2' name='desesyes'></textarea></td></tr>";
echo"</table>";

$queuddese="update student_personal_detais set disability='yes' where stno='$fstno'";
mysql_query($queuddese);

}


if($status=="no"){
echo"<br>I have no any disability.";
$qudese="update student_personal_detais set disability='no' where stno='$fstno'";
mysql_query($qudese);
}



if($status=="del"){
$qudes="update student_personal_detais set disability='no', hearing='ok', vision='ok', phy_disability=NULL, support=NULL, spt_specify=NULL, take_medicine=NULL, medic_specify=NULL where stno='$fstno'";
mysql_query($qudes);
echo"Delete Successfully.";
}




if($status=="disp"){

echo"<table border='0' bgcolor='#e3cce7' width='275px' align='center'>";
			echo"<tr><td colspan='2' align='center'>Status of the disability</td></tr>";
			
			echo"<tr><td>Hearing impairment</td><td>";
				if($herg=="hearing_impairment"){				
					echo"<input type='checkbox' name='hearing' value='hearing_impairment' checked></td></tr>";
								 }
				else{echo"<input type='checkbox' name='hearing' value='hearing_impairment'></td></tr>";}
			
			echo"<tr><td>Vision impairment</td><td>";
				if($visn=="vision_impairment"){
					echo"<input type='checkbox' name='vision' value='vision_impairment' checked></td></tr>";
								}
				else{echo"<input type='checkbox' name='vision' value='vision_impairment'></td></tr>";}

			echo"<tr><td colspan='2' align='left'>Physical Disability:<td></tr>";
			echo"<tr><td valign='top' align='right'>Please Specify</td><td><textarea cols='20' rows'2' name='phycaldsb'>$phydisabi</textarea></td></tr>";
			echo"<tr><td colspan='2' align='left'>Do you need special support for your disability in the university ?<td></tr>";
			echo"<tr><td>Yes:";

					if($supt=="support_yes"){			
					echo"<input type='radio' name='spt' value='support_yes' checked></td>";
							}
					else{echo"<input type='radio' name='spt' value='support_yes'></td>";}
			echo"<td>No:";
					if($supt=="support_no"){
					echo"<input type='radio' name='spt' value='support_no' checked></td></tr>";
								}
					else{echo"<input type='radio' name='spt' value='support_no'>";}
				
			echo"</td></tr>";

			echo"<tr><td valign='top' align='right'>If Yes, Please Specify</td><td><textarea cols='20' rows'2' name='sptyes'>$sptspe</textarea></td></tr>";
			echo"<tr><td colspan='2' align='left'>Do you take regular medicine for known diseases ?<td></tr>";
			echo"<tr><td>Yes:";
					if($takemedi=="deses_yes"){	
						echo"<input type='radio' name='deses' value='deses_yes' checked></td>";
									}
					else{echo"<input type='radio' name='deses' value='deses_yes'></td>";}
			echo"<td>No:";
					if($takemedi=="deses_no"){
						echo"<input type='radio' name='deses' value='deses_no' checked></td></tr>";
									}
					else{echo"<input type='radio' name='deses' value='deses_no'></td></tr>";}

			echo"<tr><td valign='top' align='right'>If Yes, Please Specify</td><td><textarea cols='20' rows'2' name='desesyes'>$medicspe</textarea></td></tr>";
			echo"</table>";



}



?>
