<?php
session_start();
if((isset($_SESSION['login'])=="truefohssmis")&&($_SESSION['role']!="student")){
?>



<script type="text/javascript" src="../Ajax/confirm_cmb.js"></script>
<style type="text/css">
@import url('../css/fosmiscss.css');
</style>


<?php
// Add Data forms
/*include'../admin/config.php';
$con6_7=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);
*/



include'../connection/connection.php';
//...............get acc_year....................
$acc_year="select acedemic_year from acc_year where current='1'";
$ac_year=mysql_query($acc_year) or die(mysql_error());
while($a_y=mysql_fetch_array($ac_year)){
$acy=$a_y['acedemic_year'];
}
$acyer=explode("_",$acy);
$acyold=$acyer[0]-1;
$acycur=$acyer[0];
$acynx=$acyer[1];
$lstacy=$acynx-5;
///////////////////////////////////////////

/////////////////////////////
require_once('../classes/globalClass.php');
$vcmbl=new settings();
///////////////////////////


echo"<div id='a'>";

echo"<table border='0'  width='100%' style='background-image: url(../picture/bgpic.jpg); background-repeat: no-repeat; background-size: 100%;' >";
echo"<tr>";
echo"<td align='center' width=10%><image src='../animations/UoRlogo3.png'></td>";
echo"<td colspan='2'  valign='middle'><font size='5'>Faculty of Humanities and Social Sciences";
echo"<br><font size='5'>Management Information System";
echo"<br>[H S S - M I S]";
echo"</font></td></tr>";

   
echo"<tr class=newsbar>";
echo"<td colspan='3'><div><font  size='2px'><marquee scrollamount='3' onmouseover='this.stop();' onmouseout='this.start();'>Welcome To The Management Information System!&nbsp;";
include "../news.php";
echo"</marquee></font></div></td>";



echo"<tr><td colspan='3' align='center' >";
echo"<table border='0' width='100%'><tr><td width='50px'>";
echo"<a href='../index.php?view=admin&admin=6'><img src='../images/small/back.png'>Go Back</a></td>";

/////////////////////////////////////////////////////////////////////
$fmviweque="$rmsdb.fohssmisStudents fs";
$jonque="$rmsdb.fohssmis u";
$query_6_8="select u.user, u.l_name, u.initials from $jonque, $fmviweque where u.role = 'student' and (u.section = 'Other' or u.section = 'other') and u.user=fs.user_name order by u.user";
$oce=mysql_query($query_6_8) ;




///////////////////////////////////////////////////////////////////////////
echo '<td align="center"><h2>Select and submit data from list below</h2></td>';
echo"<td width='40px'><a href='#' onclick='window.location.reload()'><img src='../images/small/edit-redo.png'><br>&nbsp;&nbsp;Reload&nbsp;</a></td>";
echo'</tr></table><hr class=bar>';	
	

	
	
	
	
if(mysql_num_rows($oce)!=0){	
	
$rw=1;	
	
echo"<table border='0' width='100%'>";
echo"<tr><th>No<th>Index number</th><th>Name with Initials</th><th>Subject Combination</th><th><font size='2px'>Insert&nbsp;/&nbsp;Undo</font></th></tr>";




	while($data_6_8=mysql_fetch_array($oce)){
		$stno=$data_6_8['user'];
		
		$stno1=substr($stno,2);
		
		
		$lname=$data_6_8['l_name'];
		$mula=$data_6_8['initials'];
echo"<tr class=trbgc>";//table start			
    echo"<td align=center>$rw";
	echo"<td width='18%' align='center'>";
			echo '<font color="#800000">HS/</font><select size="1" name="year_6_6" id="'.$stno.'year_6_6">';
			
			$lvlyer=$acycur;////////remove this cooment after entering all student in HSS-MIS - (Iranga 2019-06-12)
			//$lvlyer="2016";//////////comment this  after entering all student in HSS-MIS - (Iranga 2019-06-12)
			for($cnfy=$acynx;$cnfy>=$lstacy;$cnfy--){
				if($cnfy==$lvlyer){
					echo "<option value=$cnfy selected>$cnfy</option>";
				}
				else{
					echo "<option value=$cnfy>$cnfy</option>";
				}
			}
			
			
			//echo "<option value=$acyold>$acyold</option><option value=$acycur selected='selected'>$acycur</option><option value=$acynx>$acynx</option>";
			
			
			echo "</select>";
			echo "<font color='#800000'>/$stno1</font>";
	echo"</td>";
					
	echo"<td>&nbsp;&nbsp;";
			echo"$lname&nbsp;&nbsp;$mula";
	echo"</td>";


		
	
	//include'../connection/connection.php';
	//get student choosen cmb/////////////////////////
		$quegtstcmb="select combination from request_combination where stno='$stno' and acc_year='$acy' and status=1";
		//echo$quegtstcmb;
		$qugtstcmb=mysql_query($quegtstcmb);

	$quegetmnsub="select * from main_subjects where status=1 order by sub_name";	
		if(mysql_num_rows($qugtstcmb)==0){
			echo"<td align='center'>";
				echo "<div id='div$stno'>";
			///////////////////////////////////////////////////////////////////////////////////////////////////
			echo'<select name="comb_6_6"  id="'.$stno.'comb_sub01"><option value=0 selected>Select Subject</option>';
			$qugetmnsub01=mysql_query($quegetmnsub);
			while($qgetmnsub01=mysql_fetch_array($qugetmnsub01)){
				$getmnsub01=$qgetmnsub01['sub_name'];
				$getmnsubid01=$qgetmnsub01['sub_id'];
				IF(($getmnsubid01!=2)&&($getmnsubid01!=8)){///////EDIT BY IRANGA to hide tis sub to c-20 student
					echo"<option value=$getmnsubid01>$getmnsub01</option>";
				}
				
			}	
			echo"</select>";
			////////////////////////////////////////////////////////////////////////////////////////////////////
			
			
			///////////////////////////////////////////////////////////////////////////////////////////////////
			echo'+<select name="comb_6_6"  id="'.$stno.'comb_sub02"><option value=0 selected>Select Subject</option>';
			$qugetmnsub02=mysql_query($quegetmnsub);
			while($qgetmnsub02=mysql_fetch_array($qugetmnsub02)){
				$getmnsub02=$qgetmnsub02['sub_name'];
				$getmnsubid02=$qgetmnsub02['sub_id'];
				IF(($getmnsubid02!=2)&&($getmnsubid02!=8)){///////EDIT BY IRANGA to hide tis sub to c-20 student
					echo"<option value=$getmnsubid02>$getmnsub02</option>";
				}
				
			}	
			echo"</select>";
			////////////////////////////////////////////////////////////////////////////////////////////////////			
			
			
			///////////////////////////////////////////////////////////////////////////////////////////////////
			echo'+<select name="comb_6_6"  id="'.$stno.'comb_sub03"><option value=0 selected>Select Subject</option>';
			$qugetmnsub03=mysql_query($quegetmnsub);
			while($qgetmnsub03=mysql_fetch_array($qugetmnsub03)){
				$getmnsub03=$qgetmnsub03['sub_name'];
				$getmnsubid03=$qgetmnsub03['sub_id'];
				IF(($getmnsubid03!=2)&&($getmnsubid03!=8)){///////EDIT BY IRANGA to hide tis sub to c-20 student
					echo"<option value=$getmnsubid03 >$getmnsub03</option>";
				}
				
			}	
			echo"</select>";
			////////////////////////////////////////////////////////////////////////////////////////////////////			
			
			
			
			
			
			
			
			
			
			
			
						}
		else{
		echo"<td align='center' class='selecttdbg'>";
			echo "<div id='div$stno'>";
			while($qgtstcmb=mysql_fetch_array($qugtstcmb)){
				$stcmb=$qgtstcmb['combination'];
				
				$cmbval=explode("+",$stcmb);

	$rmopbckt=explode("[",$cmbval[0]);
		$rmclbkt=explode("]",$rmopbckt[1]);
	$puresubid1=$rmclbkt[0];

	$rmopbckt2=explode("[",$cmbval[1]);
		$rmclbkt2=explode("]",$rmopbckt2[1]);
	$puresubid2=$rmclbkt2[0];	
	
	$rmopbckt3=explode("[",$cmbval[2]);
		$rmclbkt3=explode("]",$rmopbckt3[1]);
	$puresubid3=$rmclbkt3[0];					
								
				
				
				
				
				
				
				
				
				
				
					$sub1=$puresubid1;
						$subone=$vcmbl->getmainsubject($sub1);
					$sub2=$puresubid2;
						$subtwo=$vcmbl->getmainsubject($sub2);
					$sub3=$puresubid3;	
						$subthree=$vcmbl->getmainsubject($sub3);
						}


	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	echo'<select name="comb_6_6"  id="'.$stno.'comb_sub01"><option value=0>Select Subject</option>';
	$qugetmnsub=mysql_query($quegetmnsub);
	while($qgetmnsub=mysql_fetch_array($qugetmnsub)){
		$getmnsub=$qgetmnsub['sub_name'];
		$getmnsubid=$qgetmnsub['sub_id'];
		if($getmnsubid==$sub1){
			echo"<option value=$getmnsubid selected>$getmnsub</option>";
		}
		else{
			echo"<option value=$getmnsubid>$getmnsub</option>";
		}
		
	}	
	echo"</select>";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	echo'+<select name="comb_6_6"  id="'.$stno.'comb_sub02"><option value=0>Select Subject</option>';
	$qugetmnsub2=mysql_query($quegetmnsub);
	while($qgetmnsub2=mysql_fetch_array($qugetmnsub2)){
		$getmnsub2=$qgetmnsub2['sub_name'];
		$getmnsubid2=$qgetmnsub2['sub_id'];
		if($getmnsubid2==$sub2){
			echo"<option value=$getmnsubid2 selected>$getmnsub2</option>";
		}
		else{
			echo"<option value=$getmnsubid2>$getmnsub2</option>";
		}
		
	}	
	echo"</select>";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	echo'+<select name="comb_6_6"  id="'.$stno.'comb_sub03"><option value=0>Select Subject</option>';
	$qugetmnsub3=mysql_query($quegetmnsub);
	while($qgetmnsub3=mysql_fetch_array($qugetmnsub3)){
		$getmnsub3=$qgetmnsub3['sub_name'];
		$getmnsubid3=$qgetmnsub3['sub_id'];
		if($getmnsubid3==$sub3){
			echo"<option value=$getmnsubid3 selected>$getmnsub3</option>";
		}
		else{
			echo"<option value=$getmnsubid3>$getmnsub3</option>";
		}
		
	}	
	echo"</select>";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////






















		


			}
	echo"</div></td>";
		//////////////////////////////////////////////
	echo"<td align='center'>";
			echo "<img style='visibility: hidden' id='ldr$stno' src='../images/ajax-loader.gif'>";
 			echo"<img id='img$stno' src='../images/submt.png' onclick=cmbcnfm('$stno')>";
			echo"<img style='visibility: hidden' id='sho$stno' src='../images/edit-undo.png' onclick=cmbundo('$stno')>";
	echo"</td>";		


echo'</tr>';	
$rw++;
						}
	

echo"</table>";
				
						
	}
else{
echo"<font color=red>Sorry! There are no student to insert !</font><hr class=bar>";


	}



	
	
						//mysql_close($con6_7);
						
	
							// End of Add Data



echo"</td></tr><tr><td colspan='3' align='center'><font>&#169 Faculty of Humanities and Social Sciences, University of Ruhuna. </font></td></tr>";
echo"</table>";
echo"</div>";





 ?>

<?php
}	
else{
echo "You Have Not Permission To Access This Area!";
}
?>





