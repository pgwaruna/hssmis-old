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

$quepers="SELECT id FROM permission WHERE role_id =$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
if($qpers['id']=="98"){
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
echo"Mark Return Sheet";
echo"<hr class=bar>";




$role=$_SESSION['role'];
$dept_id=$_SESSION['section'];
$rltduser=$_SESSION['user_id'];

require_once('./classes/globalClass.php');
$n=new settings();


$acyart=$n->getAcc();
$crrseme=$n->getSemister();



//////////////////////////////print exam attendent sheet/////////////////////////////////////////////////////////////////////////////////
echo"<h3>*** You have following subjects to view Mark Return Sheet ***</h3>"; 




	
if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
$queprtatt="select code, name,stream,medium,level,department from courseunit where availability=1 and (semister=$crrseme or semister=3) order by code,name";
                                                                    }
elseif(($role=="general")||($role=="office")){
$queprtatt="select code, name,stream,medium,level,department from courseunit where department='$dept_id'  and availability=1 and (semister=$crrseme or semister=3)  order by code,name";
}
else{
$queprtatt="select code, name,stream,medium,level,department from courseunit where (coordinator='$rltduser' or lecturers LIKE '%[$rltduser]%')   and availability=1 and (semister=$find_L or semister=3)  order by code,name";	
}


//echo$queprtatt;
$quprtatt=mysql_query($queprtatt);
echo"<table border=0 width=80%><tr>";
echo"<th  width=5%>#<th  width=10%>Course Unit<th>Course Unit Name<th width=10%>Stream<th width=10%>Medium<th  width=20%>Sheets</tr>";
$eamrethb=1;
$stdept="nil";
$rwclrin=0;
while($qprtatt=mysql_fetch_array($quprtatt)){
	$code=$qprtatt['code'];
   ////////////////////////////////////////////////////////////
                                $coursegetchr=trim($code);

                                $fulcode=strtoupper($coursegetchr);
                               
   ////////////////////////////////////////////////////////////////
    
    
    
	$coname=$qprtatt['name'];
	$codept=$qprtatt['department'];
	if($stdept!=$codept){
		
		if($rwclrin>=5){
			$rwclrin=0;
		}	
		
		
		
		if($rwclrin==0){
			$rowclr="selectbg";
		}
		elseif($rwclrin==1){
			$rowclr="trbgc";
		}
		else{
		$rowclr="selectbg".$rwclrin;
		}
		

		
		$rwclrin++;
	}
	
	
	$colvl=$qprtatt['level'];
	
$stream=$qprtatt['stream'];
$medium=$qprtatt['medium'];  
	
if($medium!="SI+EN"){
		echo"<tr class=$rowclr><form method=POST action='./forms/form_98.php'><td  align='center'>$eamrethb<td align='center'>".$fulcode;
			echo"<input type='hidden' name='prtcode' value=$code >";
			echo"<input type='hidden' name='prtcolvl' value=$colvl >";
			echo"<input type='hidden' name='prtcosem' value=$crrseme >";
			echo"<input type='hidden' name='prtcrtacy' value=$acyart ></td>";

		echo"<td>&nbsp;&nbsp; $coname<input type='hidden' name='prtconame' value='$coname'></td>";
		
		echo"<td align='center'>$stream<td align='center'>$medium";
		echo"<input type='hidden' name='prtcomdm' value='$medium'>";
		echo"<input type='hidden' name='prtcodept' value= $codept>";
		
		echo"<td align='center'>";
		/*
		echo"<input type='text' name='shtdate' size=9 placeholder='YYYY-MM-DD'>";
		echo"<input type='text' name='shttme' size=5 placeholder='Time'>";
		echo"<input type='text' name='shtcntr' size=15 placeholder='Centre'>";
		
		echo"<input type='text' name='shtfstno' size=12 placeholder='First Index No'>";
		echo"<input type='text' name='shtlstno' size=12 placeholder='Last Index No'>";
		*/
		echo"<input type=submit name='subbutton' value='View Sheet'>";

		

		echo"</tr></form>";	
}
else{
		echo"<tr class=$rowclr><form method=POST action='./forms/form_98.php'><td  align='center'>$eamrethb<td align='center'>".$fulcode;
			echo"<input type='hidden' name='prtcode' value=$code >";
			echo"<input type='hidden' name='prtcolvl' value=$colvl >";
			echo"<input type='hidden' name='prtcosem' value=$crrseme >";
			echo"<input type='hidden' name='prtcrtacy' value=$acyart ></td>";

		echo"<td>&nbsp;&nbsp; $coname<input type='hidden' name='prtconame' value='$coname'></td>";
		
		echo"<td align='center'>$stream<td align='center'>$medium";
		echo"<input type='hidden' name='prtcomdm' value='$medium'>";
		echo"<input type='hidden' name='prtcodept' value= $codept>";
		
		
		
		echo"<td align='center'>";

		echo"<table border=0>";
		
		/*echo"<tr align=center  class=selectbg><td rowspan='2'>";
		echo"<input type='text' name='shtdate' size=9 placeholder='YYYY-MM-DD'><br>";
		echo"<input type='text' name='shttme' size=5 placeholder='Time'>";
		echo"<input type='text' name='shtcntr' size=15 placeholder='Centre'>";
		echo"<input type='text' name='shtfstno' size=12 placeholder='First Index No'>";
		echo"<input type='text' name='shtlstno' size=12 placeholder='Last Index No'>";		
		*/
		echo"<tr  class=selectbg><td><input type=submit name='subbutton' value='View Sheet for Sinhala'>";
		echo"<tr  class=selectbg><td ><input type=submit name='subbutton' value='View Sheet for English'>";
		echo"</table>";		

		echo"</tr></form>";	








	
}

$stdept=$codept;
$eamrethb++;
}

echo"</table>";

?>
















<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}

?>
