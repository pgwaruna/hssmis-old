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
if($qpers['id']=="9"){
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
function chkrmcnf(){
	 var cnf=confirm("Do you realy want remove this Result ? If yes Click [OK] !");

	if (cnf== true){
		return true;
		}
	else{
		return false;
		}
				}
</script>




<?php
echo "Add Student Results <hr class=bar><br>";

/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////upload excel file of results////////////////////////
/////////////////////////////////////////////////////////////////////////////////
if($role=="administrator"){
		//.........edit By Iranga...to upload result sheet..............			
			echo '<font size=3px>[ <a href="forms/uploads/upload_resultfile.php">Click here to Select a file to Upload Results</a> ]</font><br><br>';

		//..................................
						// Add Results from CSV File
/*						
						echo '<form method="POST" action="index.php?view=admin&admin=9&action=upload">';
						echo '<input type="text" name="file" size="32"><br><br>CSV file path paste here &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Submit" name="submit"><br><br>';
						echo '</form>';
						
						$action=$_GET['action'];
						$file=$_POST['file'];

						if(($action=='upload')&&(isset($_POST['submit']))){
						$con9_3=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						$query_9_1="LOAD DATA LOCAL INFILE '$file' INTO TABLE results fields terminated by ',' ignore 3 lines";
						$prev=mysql_query($query_9_1);	
						if($prev){
						echo "Results added Success<br><br>";
						}	
						mysql_close($con9_3);
						}
	*/					
}
/////////////////////////////////////////////////////////////////////////////////
/////////////////////// end upload excel file of results/////////////////////////
/////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////////////////
////////////////////////////ins que///////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
if($task=="onersltad"){
$rststnum=$_POST['rststnum'];
$rstsubcd=$_POST['rstsubcd'];
$rstgrd2=$_POST['rstgrd'];
	$rstgrd=ucfirst(trim($rstgrd2));

$rstyear=$_POST['rstyear'];

//echo$rststnum.$rstsubcd.$rstgrd.$rstyear;

$queinsrslt="insert into results(index_number,subject,grade,year) values ('$rststnum','$rstsubcd','$rstgrd','$rstyear')";
$quinsrslt=mysql_query($queinsrslt);
if($quinsrslt){
echo"<font color=blue>Successfully Inserted !</font>";

	$quegetcrret="select id from results where index_number='$rststnum' and subject='$rstsubcd' and grade='$rstgrd' and year='$rstyear' order by id";
	$qugetcrret=mysql_query($quegetcrret);
	if(mysql_num_rows($qugetcrret)!=0){
		while($qgetcrret=mysql_fetch_array($qugetcrret)){
			$getcrret=$qgetcrret['id'];
									}
echo"<form method=post action='./index.php?view=admin&admin=9&task=rmnwrslt' id=rmvrs>";
	echo"<table border=0 width=60%><th>Student Number<th>Subject<th>Grade<th>Year<th>Submit";
	echo"<tr class=trbgc align=center valign=middle><td>$rststnum<td>$rstsubcd<td>$rstgrd<td>$rstyear";
		
			echo"<td><input type=hidden name=rsltid value=$getcrret><input type=submit value=Remove onclick='return chkrmcnf(rmvrs)'>";	
	

	echo"</table><br>";	
	echo"</form>";

						}
}
else{
echo"<font color=red>Sorry! There is a problem with inserting please try again.</font><br>";
}




}



//////////////////////////////////////////////////////////////////////////////////
////////////////////////////ins que end //////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////////////////
/////////////////////////// del que///////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
if($task=="rmnwrslt"){
$rsltid=$_POST['rsltid'];

$quedelreslt="delete from results where id=$rsltid";
$qudelreslt=mysql_query($quedelreslt);

if($qudelreslt){
	echo"<font color=red>Successfully Removed!</font><br>";
}
else{
echo"<font color=red>Sorry! There is a problem with removing please contact FOSMIS administrator.</font><br>";
}

}
//////////////////////////////////////////////////////////////////////////////////
/////////////////////////// del que end //////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////






echo"<font size=3px><b>*** Enter Results of Student ***</b></font><br>";


echo"<form method=post action='./index.php?view=admin&admin=9&task=onersltad'>";

echo"<table border=0 ><tr class=trbgc><td>Student Number<td><span id=sprytextfield1><input type=text name=rststnum size=15  placeholder='Eg:- 5291 or ps139'>";
	echo'<span class="textfieldRequiredMsg"><font size="-1"> Please Enter Student Number&nbsp;</font></span>';
echo"</span>";
echo"<tr class=trbgc><td>Course Unit<td><span id='code'><input type=text name=rstsubcd size=15 placeholder='Eg:- ABC1b2d'>";
	echo'<span class="textfieldRequiredMsg"><font size="-1"> Please Enter Course Code&nbsp;</font></span>';
	echo'<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>';
echo"</span>";



echo"<tr class=trbgc><td>Grade<td><span id=sprytextfield2><input type=text name=rstgrd size=15 placeholder='Eg:- A+'>";
	echo'<span class="textfieldRequiredMsg"><font size="-1"> Please Enter Grade&nbsp;</font></span>';
echo"</span>";


echo"<tr class=trbgc><td>Year<td><span id=number1><input type=text name=rstyear size=15 placeholder='Eg:- 2014'>";
	echo'<span class="textfieldRequiredMsg"><font size="-1"> Please Enter Year&nbsp; </font></span>';
	//echo'<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>';
echo"</span>";
echo"<tr class=trbgc><td colspan=2 align=center><input type=submit value=Submit>";
echo"</table>";

echo"</form>";





?>










<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>
