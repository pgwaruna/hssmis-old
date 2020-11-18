<?php
//error_reporting(0);
session_start();
if(($_SESSION['login'])=="truefohssmis"){


$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
//echo $querole;
$qurole=mysql_query($querole) or die(mysql_error());

if($qurole!=NULL)
{
while($qrole=mysql_fetch_array($qurole)){
$roleid=$qrole['role_id'];
}
echo$qpers['role_id'];
$quepers="SELECT id FROM permission WHERE role_id =$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
if($qpers['id']=="35"){
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

var win=null;
function viewWindow(mypage1,myname,w,h,scroll,pos){
if(pos=="random"){LeftPosition=(screen.width)?Math.floor(Math.random()*(screen.width-w)):100;TopPosition=(screen.height)?Math.floor(Math.random()*((screen.height-h)-75)):100;}
if(pos=="center"){LeftPosition=(screen.width)?(screen.width-w)/2:100;TopPosition=(screen.height)?(screen.height-h)/2:100;}
else if((pos!="center" && pos!="random") || pos==null){LeftPosition=0;TopPosition=20}
settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
win=window.open(mypage1,myname,settings);}
</script>




<script type="text/javascript">
function att_display(){
var selected_Index= document.getElementById('group').selectedIndex;
var subj= document.getElementById('subject').value;
var selected_Value= document.getElementById('group').options[selected_Index].value;
window.location= 'index.php?view=admin&admin=35&attdisp=displayatt&sub='+subj+'&task8=attendence&display='+ selected_Value;

}
</script>


<?php
error_reporting(0);

include'./admin/config.php';
require_once('classes/attClass.php');	
require_once('classes/globalClass.php');		

$m=new attendence();							
$n=new settings();
static 	$count1=0;
static 	$count=0;
static 	$counta=0;

$fisttm="no";
$alclm=0;
$clm=0;
$attendens="ok";
$dept_17=$_SESSION['section'];									
$lec_id=$_SESSION['user_id'];
						
$con21_1=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);
			
$query_21_8="select distinct semister from level";
$attL=mysql_query($query_21_8);
while($find_semiL=mysql_fetch_array($attL)){
$find_L=$find_semiL['semister'];
}

//...............get acc_year....................
$acc_year="select acedemic_year from acc_year where current='1'";
$ac_year=mysql_query($acc_year);
while($a_y=mysql_fetch_array($ac_year)){
$acy=$a_y['acedemic_year'];
}
//.................................................	


$selection=$_GET['display'];
if(($_GET['task8'])!='attendence'){
echo"Set Cut-off for Attendence<hr class=bar>";


if(($role=="administrator")||($role=="topadmin")){
$query_21_1="select code, name from courseunit where availability=1 and (semister=$find_L or semister=3) order by code,name";
                                                                    }
else{
$query_21_1="select code, name from courseunit where department='$dept_17'  and availability=1 and (semister=$find_L or semister=3)  order by code,name";
}
//echo$query_21_1;







$att=mysql_query($query_21_1);
echo "You have following subjects to Set Cut-off for Attendence";
if(mysql_num_rows($att)!=0){
$cutbl=1;
echo '<table width=95%><th>#<th>Course Unit<th>Course Name<th>Current Cut-Off';	
while($attdata=mysql_fetch_array($att)){
    $allcose=$attdata['code'];
  //////////////////////.............................//////////////////////////////                          
            ////////////////////////////////////////////////////////////////////////////////////////
            $coursegetchr=trim($allcose);
           
                                $fulcode3=strtoupper($coursegetchr);
                                
                            ////////////////////////////////////////////////////                
                            
                            
                        
                    
 //////////////////////.............................////////////////////////////// 
    
    
    
    
echo '<tr align="left" class="trbgc" height=25px><td align=center>'.$cutbl.'<td align=center><a href="index.php?view=admin&admin=35&attdisp=displayatt&sub='.$attdata['code'].'&task8=attendence&display=all"';
?>

onclick="viewWindow(this.href,'mywin','1200','550','yes','center');return false";


<?php
echo '>'.$fulcode3."</a><td> &nbsp;".ucfirst($attdata['name']);

echo"<td align=center>";
$quegetcutoff="select max,type from maxatt where course='$fulcode3' and acc_year='$acy'"; 
$qugetcutoff=mysql_query($quegetcutoff);
if(mysql_num_rows($qugetcutoff)==0){
	echo"80%";
}
else{
	while($qgetcutoff=mysql_fetch_array($qugetcutoff)){
		$maxptg=$qgetcutoff['max'];
		$mxptglectp=ucfirst($qgetcutoff['type']);
		
		echo"[ $mxptglectp - $maxptg % ] ";
	}
	
}

$cutbl++;
}

echo "</table>";
}
else{
	echo"<br><br>Sorry! Can not find course unit to Set Cut-Off for you<br>";
}
}
		

						

// View attendences Available
$task8=$_GET['task8'];
if($task8=='attendence'){
$sub_21=$_GET['sub'];
////////////////////////////

///////////////////////////////////////////get full code///////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
                                $coursegetchr=trim($sub_21);
                                
                                $fulcode=strtoupper($coursegetchr);
                                
                                ////////////////////////////////////////////////////




/////////////////////////////////////////// end get full code//////////////////////////////

echo '<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr><td width=100px>';

////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////
/////////////////// Check form /////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////

echo '<td align="left" width="30%">';

$query_21_a="SELECT distinct type FROM lecture where course = '$sub_21' and acc_year='$acy'";
$atta=mysql_query($query_21_a);
if(mysql_num_rows($atta)!=0){
    echo"<font color=#48AF48 size=small>You can check Cut-Off Levels here</font><br /><br /><br />";
while($find_type=mysql_fetch_array($atta)){
	$find_a=$find_type['type'];
	echo '<form name="check" method="post"';
	echo 'action=index.php?view=admin&admin=35&attdisp=displayatt&sub='.$sub_21.'&task8=attendence&display='.$find_a.'>';
	echo ucfirst($find_a);
echo '&nbsp;&nbsp;<input type="text" size="2"  name="'.$find_a.'" id="'.$find_a.'" style="text-align:center;">% <br /><br />';

}

echo '&nbsp;<input type=submit value="Check this value" name="checkval"></form>';
$attendens="notok";
}
else{
    echo"<font color=red size=3px>Sorry! Attendance Are Not Inserted.</font>";
}

////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////

		
////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////
///////////////////Submit Form /////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////
echo '<td align="left" width="30%">';

$query_21_a="SELECT distinct type FROM lecture where course = '$sub_21' and acc_year='$acy'";
$atta=mysql_query($query_21_a);
if(mysql_num_rows($atta)!=0){
echo"<font color=#48AF48 size=small>You can confirm Cut-Off Levels here<br />(Can be also changed)</font><br /><br />";
    
while($find_type=mysql_fetch_array($atta)){
	
	$find_a=$find_type['type'];
	echo '<form name=submitatt1 method="post"';
	echo 'action=index.php?view=admin&admin=35&attdisp=displayatt&sub='.$sub_21.'&task8=attendence&display='.$find_a.'>';
	echo ucfirst($find_a);
	
echo '&nbsp;&nbsp;<input type="text" size="2"  name="a'.$find_a.'" id="a'.$find_a.'" style="text-align:center;">%<br /><br />';

}

echo '&nbsp;<input type=submit name="submitatt" value="Confirm this value" ></form>';
}
else{
    echo"&nbsp;";
}
//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
?>
		<td align="center">
		<a href="javascript:window.print();">
		<img border="0" src="images/small/document-print.png" width="48" height="48"></a>

		<td align="center"> <a href="#" onclick="window.location.reload()"><img border="0" src="images/small/edit-redo.png" ></a><p> </td>
		<td align="center"> <a href="javascript:window.close()"> <img border="0" src="images/small/emblem-nowrite.png" width="48" height="48"></a></td>
	
	
</table>








<?php
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
echo '<hr class=bar>';	


echo "<br /><font color=red size=3px>Current Eligibility Status of ".$fulcode." Course Unit ";

///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////
	if(isset($_POST['submitatt'])){
			$acc1=$n->getAcc();
		if(isset($_POST['alecture'])){
		$l=$_POST['alecture'];
		
	echo "<br />".$l."% for Lectures";
	
	$m->addPer($sub_21,$acc1,"lecture",$l);
	}
	if(isset($_POST['atute'])){
		$t=$_POST['atute'];
		
	echo "<br />".$t."% for Tutes";
	
	$m->addPer($sub_21,$acc1,"tute",$t);
	
	}
	if(isset($_POST['apractical'])){
		$p=$_POST['apractical'];
		
	echo "<br />".$p."% for Practicals";
	
	$m->addPer($sub_21,$acc1,"practical",$p);

	}
	if(isset($_POST['aassignment'])){
		$a=$_POST['aassignment'];
		
	echo "<br />".$a."% for Assignment";
	
	$m->addPer($sub_21,$acc1,"assignment",$a);
	
	}	
		
	}
echo"</font>";
///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////


	$con9=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);
		
	$query1_2="SELECT distinct type FROM lecture where course = '$sub_21' and acc_year='$acy'";
    
	$reg_once=mysql_query($query1_2);
	echo '<div align="center"><table border="0" width="100%" cellspacing="1" cellpadding="2" bordercolor="#C0C0C0" bgcolor="#000000" align=center><tr align=center><td bgcolor="#A8FFA8" align=center valign=middle>#<td bgcolor="#A8FFA8" width=20%>Student No';
	if(mysql_num_rows($reg_once)!=0){
	while($data=mysql_fetch_array($reg_once)){
	    $alclm++;
	echo '<td bgcolor="#A8FFA8"  width=20%>';
	echo "<font size=1px>".ucfirst($data['type'])."s<br>";
	$lect_typenow=$data['type'];
	$acc=$n->getAcc();
	$total=$m->getMax($sub_21, $lect_typenow,$acc);
		if($total=="nd"){
			$total=0;
				}
	echo "Minnimum<br /><font size=3>( ".$total." % )</font> ";

		}
    
    }
    else{
        $fisttm="yes";
        
    }
	echo '<td width=20% bgcolor="#A8FFA8">Check Value<br><font color=blue size="2px">';
		
	if(isset($_POST['lecture']))
	echo "Lecture is ".$_POST['lecture']." %";

	if(isset($_POST['tute']))
	echo "<br />Tute is ".$_POST['tute']." %";

	if(isset($_POST['practical']))
	echo "<br />Practical is ".$_POST['practical']." %";
	
	if(isset($_POST['assignment']))
	echo "<br />Assignment is ".$_POST['assignment']." %";	
	
	
	echo '</font><td width=20% bgcolor="#A8FFA8">Finalized Eligibility Status<td width=20% bgcolor="#A8FFA8">Total Average Percentage<br>( % )';
	
	
    $fmviweque="$rmsdb.fohssmisStudents fs";
	$query_21_8="select distinct r.student, s.l_name, s.batch from registration r, student s, $fmviweque where s.id=r.student and r.course = '$sub_21' and r.acedemic_year='$acy' and r.confirm='1' and r.student=fs.user_name order by r.student";
  	$oce=mysql_query($query_21_8);
    $rs=1;
	while($data2=mysql_fetch_array($oce)){
			$counta++;
			$student_select=$data2['student'];
			$stpractgp=$m->getprctgp($student_select,$sub_21,$acy);	
	echo '<tr align=center><td bgcolor="#F0FFF0" width=1% align=center>'.$rs;
	
	
	echo '<td bgcolor="#F0FFF0">';
		$getstlstdgt=$data2['student'];
		$stprmtnum=$n->getStudentNumber($getstlstdgt); 
		if($stprmtnum==null){
			$lastdisgt=substr("$getstlstdgt",2);
			$stprmtnum="HS/".$data2['batch']."/".$lastdisgt;
		}
		
		echo$stprmtnum;
	

	/// Student Registration Information
	
	$true_eli=0;
	$query1_4="SELECT distinct type FROM lecture where course = '$sub_21' and acc_year='$acy'";
	
	
	$reg_three=mysql_query($query1_4);
	
	while($data3=mysql_fetch_array($reg_three)){
	//echo '<td bgcolor="#F5F3FE">&nbsp;';
	
	
	
	echo '<td bgcolor="#F4FBF7">';
	$lectsel_type=$data3['type'];
	
    $total=$m->getTotal($sub_21, $student_select,$lectsel_type,$acy);
    $ctotal=$m->getSubTotal($sub_21,$lectsel_type,$acy,$stpractgp);
	
    $accy=$n->getAcc();
    $Qvalue=$m->getMax($sub_21, $lectsel_type,$accy);
		if($Qvalue=="nd"){
			$Qvalue=0;
            $fisttm="yes";
				}	
	


	$cp=($total/$ctotal)*100;
	echo '<table border=0 width=90%><tr><td align=center width=60%><font color=#07A007>'.round($cp).' %';
   if(isset($_POST['checkval'])){//////////////////////////////////////////
	if(($lectsel_type)=='lecture'){
    $Qvalue2=$_POST['lecture'];
    }
    elseif(($lectsel_type)=='tute'){
    $Qvalue2=$_POST['tute'];
    }
    elseif(($lectsel_type)=='practical'){
    $Qvalue2=$_POST['practical'];
    }
    elseif(($lectsel_type)=='assignment'){
    $Qvalue2=$_POST['assignment'];
    }
	
    if(round($cp)>=$Qvalue2) {
        echo '<td align=right><img src=images/r.png>';
        
    }
    else{
       echo '<td align=right><img src=images/w.png>'; 
    }
    
    
   }////////////////////////////////////////////////////
  

  
	
	if(round($cp)>=$Qvalue) 
	{
	     if($fisttm!="yes"){
		  echo '<td align=right><img src=images/r.png>';
         }
		if($true_eli==1){
		$true_eli=1;
                 }
		elseif($true_eli==0){
		$true_eli=2;
		
        
		}
	}
	
	else
	{
	    if($fisttm!="yes"){
		echo '<td align=right><img src=images/w.png>';
        }
		$true_eli=1;
	}
	 echo"</tr></table>";
	// End of the checking Registration
	}
	
	////////////////////////////////////////////////////////
	/////////////////// Percentage Displays ////////////////
	////////////////////////////////////////////////////////
	
	///////////////////////////////////////////////////////
	////// Check Value/////////////////////////////////////
	///////////////////////////////////////////////////////
	
	$student_select=$data2['student'];
	/// Student Registration Information
	
	$true_eli1=0;
	
	$query1_4="SELECT distinct type FROM lecture where course = '$sub_21' and acc_year='$acy'";
	
	
	$reg_three=mysql_query($query1_4);
	echo '<td bgcolor="#F4FBF7">';
	while($data3=mysql_fetch_array($reg_three)){
	//echo '<td bgcolor="#F5F3FE">&nbsp;';
	
	$lectsel_type=$data3['type'];
	
    $total=$m->getTotal($sub_21, $student_select,$lectsel_type,$acy);
    $ctotal=$m->getSubTotal($sub_21,$lectsel_type,$acy,$stpractgp);
	
    $cp1=($total/$ctotal)*100;
	//echo '<font color=#07A007>'.round($cp).' %';
	
	
	if(($lectsel_type)=='lecture')
	$Qvalue1=$_POST['lecture'];
	
	elseif(($lectsel_type)=='tute')
	$Qvalue1=$_POST['tute'];
	
	elseif(($lectsel_type)=='practical')
	$Qvalue1=$_POST['practical'];
	
	elseif(($lectsel_type)=='assignment')
    $Qvalue1=$_POST['assignment'];
    
   
	if(round($cp1)>=$Qvalue1) 
	{
		
		if($true_eli1==1)
		$true_eli1=1;
		elseif($true_eli1==0)
		$true_eli1=2;
	}
	
	else
	{
		
		$true_eli1=1;
	}
	
	// End of the checking Registration
	}
	if(isset($_POST['checkval'])){////////////////--------------------///////////////
	if($true_eli1==2){
	echo '<img src=images/r.png>';
	$count++;
	}
	else
	echo '<img src=images/w.png>';
    
    }////////////////--------------------///////////////
    

    
	//////////////////////////////////////////////////////
	//// End Check Value//////////////////////////////////
	//////////////////////////////////////////////////////
	
	
	// Finitialized Value
	echo '<td bgcolor="#F4FBF7" align=center>';
///88888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888///	
if(isset($_POST['submitatt'])){
	if(($lectsel_type)=='lecture')
	$Qvaluecnf=$_POST['alecture'];
	
	elseif(($lectsel_type)=='tute')
	$Qvaluecnf=$_POST['atute'];
	
	elseif(($lectsel_type)=='practical')
	$Qvaluecnf=$_POST['apractical'];
	
	elseif(($lectsel_type)=='assignment')
	$Qvaluecnf=$_POST['aassignment'];
	
	if(round($cp1)>=$Qvaluecnf) 
	{
		
		if($true_eli1==1)
		$true_eli1=1;
		elseif($true_eli1==0)
		$true_eli1=2;
	}
	
	else
	{
		
		$true_eli1=1;
	}	
	}
///88888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888///	
	//echo$true_eli1.$Qvaluecnf.round($cp1,2).$ctotal;
	
  if(isset($_POST['submitatt'])||($fisttm!="yes")){//////////////;;;;;;;;;;;;;;;;;;;;;;////////////////////
	if($true_eli1==2){
		if(isset($_POST['checkval'])){
			echo '<img src=images/r.png>';
			$count1++;
		}
		else{
			/*if($true_eli1==2){
				if(isset($_POST['submitatt'])){
				echo '<img src=images/r.png>';
				$count1++;
				}
			}
			else{
				echo '<img src=images/w.png>';
			
			}
			*/
		}
	
	///////////////////////////////////////////////////////////////////////////
	
	////////////////    add update exam reg to ELIGIBLE here
	
	///////////////////////////////////////////////////////////////////////////
	}
	else
	{
		if(isset($_POST['checkval'])){
			echo '<img src=images/w.png>';
					}
		else{
			///////////////////////
			///////////////////////////
			//////////check this area
			
		}
			//echo '<img src=images/w.png>'.$fisttm.$true_eli1;


	//echo '&nbsp;&nbsp;&nbsp;<img src=images/conf.png>';
	}
    }//////////////;;;;;;;;;;;;;;;;;;;;;;////////////////////
	// End Finitialized Value
	
	// Any Comments
	//echo '<td bgcolor="#F4FBF7"><font style="font-size:smaller;">no comments</font>';
	
	
	
	// End Comments
	
	// All percentage Value
	
	echo '<td bgcolor="#F4FBF7">';
	
	
	
	$total=$m->getTotalAll($sub_21, $student_select,$acy);
	$ctotal=$m->getSubTotalAll($sub_21,$acy,$stpractgp);

	
	$cp=($total/$ctotal)*100;
	echo '<font color=green>'.round($cp).' %';
	
	// end all value 
	///////////////////////////////////////////////////////
	///////////////////////////////////////////////////////
	///////////////////////////////////////////////////////
		
	// End Student Registration Information	
	$rs++;
	}
	echo '<tr align=center height=25px><td bgcolor="#F4FBF7"><td bgcolor="#F4FBF7">Total  &nbsp;&nbsp;'.$counta.'&nbsp;&nbsp; Students';
    for($clm=0;$clm<$alclm;$clm++){
        echo'<td bgcolor="#F4FBF7">&nbsp;';
        
    }
	$c1=round(($count/$counta)*100,2);
	$c2=round(($count1/$counta)*100,2);
	echo '<td bgcolor="#F4FBF7">Eligible : '.$count.' &nbsp;&nbsp;&nbsp;[ '.$c1.' % ]<td bgcolor="#F4FBF7">Eligible : '.$count1.' &nbsp;&nbsp;&nbsp;[ '.$c2.' % ]<td bgcolor="#F4FBF7">&nbsp;';
	echo "</table>";
    echo "</div>";
    
    

    
 
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


