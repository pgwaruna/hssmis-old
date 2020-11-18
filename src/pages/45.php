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
if($qpers['id']=="45"){
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
$task=$_GET['task'];
$tbl=$_POST['tbl'];
echo"Data Base Analysis";
echo"<hr class=bar>"; 
	echo"Select Table Name to Find Information ";
	echo"<form method='POST' action='./index.php?view=admin&admin=45&task=findtbl'><select name='tbl'>";
	$quegttbl="show tables";
	$qugttbl=mysql_query($quegttbl);
	while($qgttbl=mysql_fetch_array($qugttbl)){
		$gttbl=$qgttbl['Tables_in_fohssmisdb'];
			echo"<option value='$gttbl'>$gttbl</option>";
						}
	echo"</select>";
	echo"<input type='submit' value='Find'></form>";

	echo"<hr class=bar>"; 

	if($task=="findtbl"){
		//echo'<div style="overflow: auto; height: 500px; width: 98%; border: 1px solid #8c189d; padding: 3px;">';
		echo'<div id="m">';
		$_SESSION['task']=$_GET['task'];
		$_SESSION['$tbl']=$_POST['tbl'];
		echo"<h3> Information of [ $tbl ] Table </h3>";
		echo"<form method='POST' action='./index.php?view=admin&admin=45&task=tblfil'>";
		echo"<input type='submit' name='submit' value='Browse Column'><input type='hidden' name='tbl' value='$tbl'>";
		echo"<input type='submit' name='submit' value='Search'>";

		echo"<table border='0'><tr>";
		$quedistbl="select * from $tbl";
		//echo$quedistbl;
		$qudistbl=mysql_query($quedistbl);
			for($f=0;$f < mysql_num_fields($qudistbl);$f++){
				$field=mysql_field_name($qudistbl,$f);
						echo "<th> ".mysql_field_name($qudistbl,$f)."<br><input type='checkbox' name='$field'></th>";
									}
		echo"</tr>";
			while ($get=mysql_fetch_array($qudistbl,MYSQL_ASSOC)){
					echo "<tr  bgcolor='#edd4dc'>";
							foreach($get as $p ){
							echo "<td>".$p."</td>";
										}
					echo "</tr>";
										}

		echo"</table></form>";
		echo"</div>";

			
				}


if($task=="tblfil"){
$submit=$_POST['submit'];
//echo'<div style="overflow: auto; height: 500px; width: 140%; border: 1px solid #8c189d; padding: 3px;">';
echo'<div id="m">';

echo"<form method='POST' action='./index.php?view=admin&admin=45&task=tblfil'>";
echo"<h3> Information of [ $tbl ] Table</h3>";
echo"<input type='submit' name='submit' value='Browse Column'><input type='hidden' name='tbl' value='$tbl'>";
echo"<input type='submit' name='submit' value='Search'>";




if($submit=="Browse Column"){
$seltbl=$_POST['tbl'];

	$quedistbl="select * from $tbl";
		$qudistbl=mysql_query($quedistbl);
		$menu=null;
		for($i=0;$i < mysql_num_fields($qudistbl);$i++){
				$field=mysql_field_name($qudistbl,$i);
						$checkfld[$i]=$_POST[$field];
							if($checkfld[$i]=="on"){
								$menu=$menu.",".$field;
										}
								}

		$fields = substr($menu, 1);



if($fields!=null){

	echo"<table>";
	$quedistbl="select * from $tbl";
	//echo$quedistbl;
	$qudistbl=mysql_query($quedistbl);
		for($f=0;$f < mysql_num_fields($qudistbl);$f++){
			$field=mysql_field_name($qudistbl,$f);
					echo "<th> ".mysql_field_name($qudistbl,$f)."<br><input type='checkbox' name='$field'></th>";
					}
	echo"</tr>";

	echo"</table></form>";

	echo"<h3>Filtered [ $tbl ] Table</h3>";
		
		
		
			$quegtfilttbl="select $fields from $tbl";
			//echo$quegtfilttbl;
			echo"<table border=0><tr>";
			$qugtfilttbl=mysql_query($quegtfilttbl);
			for($j=0;$j < mysql_num_fields($qugtfilttbl);$j++){
					echo "<th> ".mysql_field_name($qugtfilttbl,$j)."</th>";
										}

			echo"</tr>";

			while ($qgtfilttbl=mysql_fetch_array($qugtfilttbl,MYSQL_ASSOC)){
						echo "<tr  bgcolor='#edd4dc'>";
								foreach($qgtfilttbl as $m ){
								echo "<td>".$m."</td>";
								}
						echo "</tr>";
						}

			echo"</table>";

						}
		else{
				echo"<table border='0'><tr>";
					$quedistbl="select * from $tbl";
					//echo$quedistbl;
					$qudistbl=mysql_query($quedistbl);
						for($f=0;$f < mysql_num_fields($qudistbl);$f++){
							$field=mysql_field_name($qudistbl,$f);
									echo "<th> ".mysql_field_name($qudistbl,$f)."<br><input type='checkbox' name='$field'></th>";
												}
					echo"</tr>";
						while ($get=mysql_fetch_array($qudistbl,MYSQL_ASSOC)){
								echo "<tr  bgcolor='#edd4dc'>";
										foreach($get as $p ){
										echo "<td>".$p."</td>";
													}
								echo "</tr>";
													}

					echo"</table>";





			}


			}//bws clm if

if($submit=="Search"){
echo"</form>";
//echo"<br>";
//echo$submit.$tbl;
$operator[0]="=";
$operator[1]=">";
$operator[2]=">=";
$operator[3]="<";
$operator[4]="<=";
$operator[5]="!=";
$operator[6]="LIKE";
$operator[7]="NOT LIKE";
$operator[8]="IS NULL";
$operator[9]="IS NOT NULL";
$operator[10]="BETWEEN";
$operator[11]="NOT BETWEEN";




echo"<form method='POST' action='./index.php?view=admin&admin=45&task=tblfil'>";
echo"<font size='3px'>Searching [ $tbl ] Table &nbsp; &nbsp;&nbsp;&nbsp;</font>";
echo"<input type='hidden' name='tbl' value='$tbl'><input type='submit' name='submit' value='GO'>";
echo"<table border='0'><tr>";
echo"<th>Field Name<th>Field Type<th>Operator<th>Value</tr>";
	$quedesc="DESCRIBE $tbl";
	$qudesc=mysql_query($quedesc);
	$ar=0;
	while($qdesc=mysql_fetch_array($qudesc)){
		$Field[$ar]=$qdesc['Field'];
		$Type[$ar]=$qdesc['Type'];
		$ar=$ar+1;
						}
	$totrw=$ar;
	for($t=0;$t<$totrw;$t++){
		echo"<tr bgcolor='#edd4dc'><td>$Field[$t]<input type='hidden' name='colnm$t' value='$Field[$t]'><td>$Type[$t]<td>";
			$typ=explode("(",$Type[$t]);
			$dttyp=$typ[0];

			if(($dttyp!="varchar")&&($dttyp!="text")){
			echo"<select name=operator$t>";
			for($o=0;$o<12;$o++){
				echo"<option value='$operator[$o]'>$operator[$o]</option>";
						}
			echo"</select>";
			echo"<td><input type='text' name='Field$t' size='20'></tr>";

				}
			else{

			echo"<select name=operator$t>";
				for($o=0;$o<12;$o++){
					if($o==6){
						echo"<option value='$operator[$o]' selected>$operator[$o]</option>";
							}
					else{
						echo"<option value='$operator[$o]'>$operator[$o]</option>";
						}
									}
						echo"</select>";
						echo"<td><input type='text' name='Field$t' size='20'></tr>";

				}
						}
echo"</table>";
echo"<input type='hidden' name='totrw' value=$totrw>";


echo"</form>";


			}//search if


if($submit=="GO"){
echo"<h3>Searching [ $tbl ] Table</h3>";
echo"</form>";
//echo"<input type='text' name='tbl' value='$tbl'>";
$novr=$_POST['totrw'];
//get column value
for($v=0;$v<$novr;$v++){
		$gv="Field$v";
		if($_POST[$gv]!=null){
		$colmnm[$v]=$_POST[$gv];
					}
		else{
			$colmnm[$v]="nil";
			}	
		//echo$colmnm[$v];
				}

//get oprator		
for($op=0;$op<$novr;$op++){
		$gop="operator$op";
		if($colmnm[$op]!=null){
		$gtoptr[$op]=$_POST[$gop];
					}
		else{
			$gtoptr[$op]="nil";
			}
		//echo$gtoptr[$op];
	
				}

//get field name
for($clnm=0;$clnm<$novr;$clnm++){
		$gtclnm="colnm$clnm";
		if($colmnm[$clnm]!=null){
			$fildnm[$clnm]=$_POST[$gtclnm];
					}
		else{
			$fildnm[$clnm]="nil3";
			}
		//echo$fildnm[$clnm];

					}

for($q=0;$q<$novr;$q++){
$colmnm[$q];
$gtoptr[$q];
$fildnm[$q];


if($colmnm[$q]!="nil"){
$condi[$q]=$fildnm[$q]." ".$gtoptr[$q]." '".$colmnm[$q]."'";

			}
else{
	$condi[$q]="nil";
	}
//echo$condi[$q];

			}

for($c=0;$c<$novr;$c++){
	if($condi[$c]!="nil"){
	$sum=$sum." and ".$condi[$c];
			}
}

$totcond = substr($sum, 5);



///////////////////////////////////////////////////////////////////////////////////////
	if($totcond!=null){
	$queschque="select * from $tbl where $totcond";
	//echo$queschque;
		echo"<table>";
		$quschque=mysql_query($queschque);
			if(mysql_num_rows($quschque)!=0){
						for($f=0;$f < mysql_num_fields($quschque);$f++){
							$field=mysql_field_name($quschque,$f);
									echo "<th> ".mysql_field_name($quschque,$f)."</th>";
												}
					echo"</tr>";
						while ($get=mysql_fetch_array($quschque,MYSQL_ASSOC)){
								echo "<tr  bgcolor='#edd4dc'>";
										foreach($get as $p ){
										echo "<td>".$p."</td>";
													}
								echo "</tr>";
													}

					
							}
			else{
				echo"Sorry Can not Find ";
			
				}
					echo"</table>";
				}
	else{
		echo"<font color='red'>Enter Criterian...</font>";
		
		}
/////////////////////////////////////////////////////////////////


		}//search go of


echo"</div>";
	}//TASK tblfil

?>


<?php
}
}	
else{

echo "You Have Not Permission To Access This Area!";}
?>

