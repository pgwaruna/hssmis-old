<?php
//error_reporting(0);
session_start();
if(($_SESSION['login'])=="truefohssmis"){


$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
//echo $querole;
$qurole=mysql_query($querole);

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
if($qpers['id']=="49"){
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







<?php
require_once('./classes/globalClass.php');
$n=new settings();

//...............get acc_year....................
$acy=$n->getAcc();
//.................................................			

$getyr=explode("_",$acy);
$yrpast=$getyr[0];
$ynezt=$getyr[1];
$yelast=$yrpast-6;

//...........get semester..........
$cseme=$n->getSemister();
//.................................................		



echo"Change the Degree Medium of Students";
echo"<hr class=bar>";

echo'<table border="0" cellspacing="1" class="bgc"><tr><td>';
echo"<form method=POST action='./index.php?view=admin&admin=49&task=modfymedi'>";
echo"Enter student Number:&nbsp;&nbsp;";
echo"HS/<select name=byearmd>";
for($i=1;$i<=10;$i++){
$k=$ynezt-$i;
echo"<option value=$k>$k</option>";
}
echo"</select>/";

echo'<span id="number2">';
	echo'<input name="stnomd" size="6">&nbsp;';
	echo'<span class="textfieldRequiredMsg"><font size="-1"> Enter a index Number</font></span>';
	echo'<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>';
	echo'</span>';

echo"<input type=submit value='Submit'></form>";
echo'<font color="#FF0000"><center>(<span style="font-size: 10pt"> Ex: HS/2003/15291) </center></span></font></td></tr></table>';

if($task=="modfymedi"){
echo"<hr class=bar>";
$stnomd=$_POST['stnomd'];
$stbtch=$_POST['byearmd'];
//echo$stno.$stbtch;

$getbt=$n->getBatch($stnomd);
$stname=$n->getName($stnomd);

	if($getbt==$stbtch){

		//echo"HS/".$stbtch."/".$stnomd;
		$quecngdgmed="select medium from student where id='hs$stnomd'";
		//echo$quecngdgmed;
		$qucngdgmed=mysql_query($quecngdgmed);
		$qcngdgmed=mysql_fetch_array($qucngdgmed);
			$cngdgmed=$qcngdgmed['medium'];
			//echo$cngdgmed;
			if($cngdgmed=="SI"){
				$cngdgmedPNT="Sinhala";
			}
			elseif($cngdgmed=="EN"){
				$cngdgmedPNT="English";				
			}
			else{
				$cngdgmedPNT=$medium;				
			}


			echo"<table border='0' ><tr><form method='POST' action='./index.php?view=admin&admin=49&task=modfymedi2'>";
			echo"<th>Student Number<th>Name with Initials<th>Current Degree Medium<th>Change To<th>Change </tr>";
			echo"<tr class=trbgc><td align='center'>HS/$stbtch/$stnomd<input type=hidden name=cngst value='$stnomd'></td><td align='center'>$stname</td>";
			echo"<td align='center'>".strtoupper($cngdgmedPNT)."</td>";
			echo"<td align='center'><select name=dgmedi>";

				if($cngdgmed=="SI"){
					echo"<option value='SI' >Sinhala Medium</option>";
					echo"<option value='EN' selected>English Medium</option>";
							}
				elseif($cngdgmed=="EN"){
				
					echo"<option value='SI' selected>Sinhala Medium</option>";
					echo"<option value='EN' >English Medium</option>";
							}
				else{
				
					echo"<option value='SI'>Sinhala Medium</option>";
					echo"<option value='EN' selected>English Medium</option>";
							}



			echo"</select></td>";

			echo"<td align='center'><input type=submit value=Change></form></tr>";
			echo"</table>";






				}
	else{
		echo"<font color=red>( HS/$stbtch/$stnomd ) Invalid student Number !</font><br>";
		}



}// modfymedi if close brct

if($task=="modfymedi2"){
echo"<hr class=bar>";
$gtcngst=$_POST['cngst'];
$mdymed=$_POST['dgmedi'];

//echo$gtcngst.$mdymed;
	$quemodymedim="update student set medium='$mdymed' where id='hs$gtcngst'";
	mysql_query($quemodymedim);


		$quedismedim="select l_name,initials,batch,medium from student where id='hs$gtcngst'";
		$qudismedim=mysql_query($quedismedim);
		$qdismedim=mysql_fetch_array($qudismedim);
			$l_name=$qdismedim['l_name'];
			$initials=$qdismedim['initials'];
			$batch=$qdismedim['batch'];				
			$medium=$qdismedim['medium'];
			if($medium=="SI"){
				$mediumPNT="Sinhala";
			}
			elseif($medium=="EN"){
				$mediumPNT="English";				
			}
			else{
				$mediumPNT=$medium;				
			}

			echo"<table border='0' ><tr>";
			echo"<th>Student Number<th>Name with Initials<th>Current Degree Medium<th>Change </tr>";
			echo"<tr class=trbgc height=25px><td align='center'>HS/$batch/$gtcngst<td align='center'>$l_name &nbsp; $initials<td align='center'>$mediumPNT<td align='center'>Medium Changed Successfully !</tr></table>";







}// modfymedi2 if close brct





?>







<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>

