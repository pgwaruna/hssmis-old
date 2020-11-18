<?php
//error_reporting(0);
session_start();
if(($_SESSION['login'])=="truefohssmis"){
include'../connection/connection.php';

$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
//echo $querole;
$qurole=mysql_query($querole) ;

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
if($qpers['id']=="67"){
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


<script type="text/javascript">
function chkbevstnul(){
    if (behinf.behstno.value==""){
    alert("Please Enter Student Number !");
    behinf.behstno.focus();
    return false;}
    
      
    if (behinf.descriptin.value==""){
    alert("Please Enter Description according to Student Special Behaviour!");
    behinf.descriptin.focus();
    return false;}
       

       
   } 

function remvcnf(){
   
    var cnf=confirm("Do you realy want remove this record ? If yes Click [OK] !");
	if (cnf== true){
		return true;
		}
	else{
		return false;
		}
        
   }
   
   
   
    
    
</script>



<?php
echo"Student Special Behaviour Information";
echo"<hr class=bar>";

$set=$_GET['set'];
require_once('./classes/globalClass.php');
$n=new settings();

$subdate=date("d-m-Y");

$curacye=$n->getAcc();


$brekacyr=explode("_",$curacye);
$begyear=$brekacyr[0];
$endyear=$brekacyr[1];

$lyear=$begyear-6;


echo"<h3>Set Special Behaviour Information for Student</h3>";

//////////////////////////////////////////////////////////////////////////
/////////////////////////task=entbev//////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
if($task=="entbev"){
$behstno=$_POST['behstno'];
$behstbatch=$_POST['behstbt'];
$behstdesc=$_POST['descriptin'];
$sbbtn=$_POST['sbbtn'];

//echo$behstbatch.$behstno.$behstdesc;

$strealbt=$n->getBatch($behstno);
if($behstbatch!=$strealbt){
	echo"<font color='red'>Sorry! SC/$behstbatch/$behstno is Invalid Student Number, Please recheck number. </font><br><br>";
				}
else{
	if($sbbtn=="Submit Informations"){
		$queinsstbeh="insert into student_behaviour(stno,submit_date,description) values ('$behstno','$subdate','$behstdesc')";
		mysql_query($queinsstbeh);
		echo"<font color='red'>Informations Submited Successfully.</font><br><br>";
			}

	if($sbbtn=="Update Informations"){
		$upstbehid=$_POST['upstbehid'];
		$queupdstbev="update student_behaviour set stno='$behstno',description='$behstdesc' where id=$upstbehid";
		mysql_query($queupdstbev);
		echo"<font color='red'>Informations Updated Successfully.</font><br><br>";

			}

}

}
//////////////////////////////////////////////////////////////////////////
///////////////////////end task=entbev////////////////////////////////////
//////////////////////////////////////////////////////////////////////////

if($task!="mngbehif"){
echo"<table border=0 class=bgc>";
echo"<form method=post action='./index.php?view=admin&admin=67&task=entbev' id='behinf'>";
echo"<tr><td>Student Number<td>: SC/";
	echo"<select name=behstbt>";
		for($bh=$endyear;$lyear<$bh;$bh--){
			echo"<option value='$bh'>$bh</option>";
}
		


	echo"</select>";
echo'<span id="number1">';
echo'<input type="text" name="behstno" size="4">&nbsp;';
	echo'<span class="textfieldRequiredMsg"><font size="-1"> Enter the Student Number</font></span>';
	echo'<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>';
	echo'(<span style="font-size: 10pt"> Ex: SC/2003/5291)</span>';

echo"<tr><td valign=top>Description<td valign=top>&nbsp;&nbsp;<textarea name=descriptin cols=60 rows=20></textarea>";
echo"<tr><td>Submit Date<td>: $subdate";
echo"<tr><td colspan=2 align=center><input type=submit  name='sbbtn' value='Submit Informations'  onclick='return chkbevstnul(behinf)'>";
echo"</form>";
echo"</table>";
}

else{
$mngbtn=$_POST['mngbttn'];
$mngbevid=$_POST['stbehid'];
	if($mngbtn=="Modify"){
		echo"Update Record<br>";
		
		$quegetstbev="select * from student_behaviour where id=$mngbevid";
		//echo$quegetstbev;
		$qugetstbev=mysql_query($quegetstbev);
		while($qgetstbev=mysql_fetch_array($qugetstbev)){
				$qgetstno=$qgetstbev['stno'];
					$getbevmodbt=$n->getBatch($qgetstno);
				$qgetsubmit_date=$qgetstbev['submit_date'];
				$qgetdescription=$qgetstbev['description'];
//echo$qgetstno.$getbevmodbt.$qgetsubmit_date.$qgetdescription;
		}
		//////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////
		echo"<table border=0 class=bgc>";
		echo"<form method=post action='./index.php?view=admin&admin=67&task=entbev' id='behinf'>";
		echo"<tr><td>Student Number<td>: SC/";
			echo"<select name=behstbt>";
				for($bhg=$endyear;$lyear<$bhg;$bhg--){
					if($bhg==$getbevmodbt){
					echo"<option value='$bhg' selected>$bhg</option>";
					}
					else{
					echo"<option value='$bhg'>$bhg</option>";
					}
		}
		


			echo"</select>";
		echo'<span id="number1">';
		echo"<input type='text' name='behstno' size='4' value='$qgetstno'>&nbsp;";
			echo'<span class="textfieldRequiredMsg"><font size="-1"> Enter the Student Number</font></span>';
			echo'<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>';
			echo'(<span style="font-size: 10pt"> Ex: SC/2003/5291)</span>';

		echo"<tr><td valign=top>Description<td valign=top>&nbsp;&nbsp;<textarea name=descriptin cols=60 rows=20>$qgetdescription</textarea>";
		echo"<tr><td>Submit Date<td>: $qgetsubmit_date";
		echo"<input type=hidden value=$mngbevid name=upstbehid>";
		echo"<tr><td colspan=2 align=center><input type=submit name='sbbtn' value='Update Informations'  onclick='return chkbevstnul(behinf)'>";
		echo"</form>";
		echo"</table>";
		//////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////

		
			}

	if($mngbtn=="Remove"){
		$quedelbev="delete from student_behaviour where id=$mngbevid";
		mysql_query($quedelbev);
		echo"<font color='red'>Informations Successfully Removed.</font><br><br>";

		//////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////
		echo"<table border=0 class=bgc>";
		echo"<form method=post action='./index.php?view=admin&admin=67&task=entbev' id='behinf'>";
		echo"<tr><td>Student Number<td>: SC/";
			echo"<select name=behstbt>";
				for($bh=$endyear;$lyear<$bh;$bh--){
					echo"<option value='$bh'>$bh</option>";
		}
		


			echo"</select>";
		echo'<span id="number1">';
		echo'<input type="text" name="behstno" size="4">&nbsp;';
			echo'<span class="textfieldRequiredMsg"><font size="-1"> Enter the Student Number</font></span>';
			echo'<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>';
			echo'(<span style="font-size: 10pt"> Ex: SC/2003/5291)</span>';

		echo"<tr><td valign=top>Description<td valign=top>&nbsp;&nbsp;<textarea name=descriptin cols=60 rows=20></textarea>";
		echo"<tr><td>Submit Date<td>: $subdate";
		echo"<tr><td colspan=2 align=center><input type=submit  name='sbbtn' value='Submit Informations'  onclick='return chkbevstnul(behinf)'>";
		echo"</form>";
		echo"</table>";

		//////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////





			}
}











///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////Manage Behaviour ///////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////


	$quegetbehinf="select * from student_behaviour order by stno ";
	$qugetbehinf=mysql_query($quegetbehinf);
	if(mysql_num_rows($qugetbehinf)!=0){
	echo"<hr class=bar>";
	echo"Manage Students Special Behaviour Information";
	echo"<hr class=bar>";
	echo"<table border=0><th>#<th>Student Number<th>Name with Initials<th>Submit Date<th>Description<th>Modify<th>Remove";
	$rw=1;
		while($qgetbehinf=mysql_fetch_array($qugetbehinf)){
				$stid=$qgetbehinf['id'];
				$getstno=$qgetbehinf['stno'];
					$getstrealbt=$n->getBatch($getstno);
				$name=$n->getName($getstno);
				

				$submit_date=$qgetbehinf['submit_date'];
				$description=$qgetbehinf['description'];
		
		echo"<tr class=trbgc valign=top>";
		echo"<form method=post action='./index.php?view=admin&admin=67&task=mngbehif' id='cnfrmv'>";
		echo"<td >$rw<td align=center>SC/$getstrealbt/$getstno";
		
		echo"<td>".strtoupper($name)."<td align=center>$submit_date";
		
		echo"<td>".ucfirst($description);
		echo"<input type=hidden value=$stid name=stbehid>";
		echo"<td align=center><input type=submit name=mngbttn value=Modify>";

		echo"<td align=center><input type=submit name=mngbttn value=Remove  onclick='return remvcnf(cnfrmv)'>";
		
		echo"</form></tr>";
		$rw++;
									}

	echo"</table>";
						}
///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// end Manage Behaviour //////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////






?>


















<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>
