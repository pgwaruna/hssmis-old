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
if($qpers['id']=="95"){
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
$role=$_SESSION['role'];
$dept_id=$_SESSION['section'];
$rltduser=$_SESSION['user_id'];	

require_once('./classes/globalClass.php');
$n=new settings();


$acyart=$n->getAcc();
$crrseme=$n->getSemister();

echo"Assignment Marks Sheet";
echo"<hr class=bar>";

echo"You have following subjects to assignment marks sheet<br>";


$query_21_8="select distinct semister from level";
$attL=mysql_query($query_21_8);
while($find_semiL=mysql_fetch_array($attL)){
$find_L=$find_semiL['semister'];
}

//////////////------------------------------------------------------------------------------------------------------------------------/////////////////

if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
$queprtatt="select code, name,department,level,medium,stream,by_low_version from courseunit where availability=1 and (semister=$find_L or semister=3) order by code,name";
                                                                    }
elseif(($role=="general")||($role=="office")){
$queprtatt="select code, name,department,level,medium,stream,by_low_version from courseunit where department='$dept_id'  and availability=1 and (semister=$find_L or semister=3)  order by code,name";
}
else{
$queprtatt="select code, name,department,level,medium,stream,by_low_version from courseunit where (coordinator='$rltduser' or lecturers LIKE '%[$rltduser]%')   and availability=1 and (semister=$find_L or semister=3)  order by code,name";
}

//////////////------------------------------------------------------------------------------------------------------------------------/////////////////

//echo$queprtatt;
$quprtatt=mysql_query($queprtatt);
if(mysql_num_rows($quprtatt)!=0){
echo"<table border=0 width='90%'><tr>";
echo"<th>#<th>Course Unit<th>Course Unit Name<th>Stream<th>Medium<th>View</tr>";
$pntatst=1;
while($qprtatt=mysql_fetch_array($quprtatt)){
	$code=$qprtatt['code'];
    ////////////////////////////////////////////////////////////////////////////////////////
                                $coursegetchr=trim($code);
                                
                                $fulcode=strtoupper($coursegetchr);
                                
                                ////////////////////////////////////////////////////
	$coname=$qprtatt['name'];
	$codept=$qprtatt['department'];
	$colvl=$qprtatt['level'];
	$stream=$qprtatt['stream'];
	$medium=$qprtatt['medium'];
	$curriculum=$qprtatt['by_low_version'];

		echo"<tr class=trbgc><form method=POST action='./forms/form_95.php'><td align='center'>$pntatst<td align='center'>".$fulcode;
			echo"<input type='hidden' name='prtcode' value=$code ></td>";
			echo"<input type='hidden' name='prtcolvl' value=$colvl ></td>";
			echo"<input type='hidden' name='prtcosem' value=$crrseme ></td>";
			echo"<input type='hidden' name='prtcrtacy' value=$acyart ></td>";
			echo"<input type='hidden' name='curriculum' value=$curriculum ></td>";

		echo"<td>&nbsp;&nbsp; $coname<input type='hidden' name='prtconame' value='$coname'></td>";
		echo"<td align='center'>$stream";
		echo"<td align='center'>$medium";		
		
		echo"<td align='center'>";
		if($medium!="SI+EN"){
			echo"<input type='hidden' name='prtcodept' value= $codept><input type='hidden' name='prtcomdm' value=$medium><input type=submit value='Assignment Marks Sheet'></td></tr></form>";
		}
		else{
			echo"<input type='hidden' name='prtcomdm' value=$medium>";
			echo"<table border=0>";
			echo"<tr class=selectbg height=25px><td>";
			echo"<input type='hidden' name='prtcodept' value= $codept><input name=assubbtn type=submit value='Assignment Marks Sheet - Sinhala'></td></tr>";
			echo"<tr class=selectbg height=25px><td>";
			echo"<input type='hidden' name='prtcodept' value= $codept><input name=assubbtn  type=submit value='Assignment Marks Sheet - English'></td></tr></form>";
			echo"</table>";			
		}
$pntatst++;
}

echo"</table>";

}
else{
    echo"<br><font color=red>Sorry! There are no available course unit for this semester</font>";
}















?>







<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}
else{

echo "You Have Not Permission To Access This Area!";}
?>




