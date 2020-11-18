


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
if($find_L==1)
$query_21_1="select code, name from courseunit where department='$dept_17' and (semister=1 or semister=3) and availability=1 order by code,name";
elseif($find_L==2)
$query_21_1="select code, name from courseunit where department='$dept_17' and (semister=2 or semister=3) and availability=1 order by code,name";
$att=mysql_query($query_21_1);
echo "You have following subjects to Set Cut-off for Attendence";
echo '<table>';
while($attdata=mysql_fetch_array($att)){
    $allcose=$attdata['code'];
  //////////////////////.............................//////////////////////////////                          
            ////////////////////////////////////////////////////////////////////////////////////////
            $coursegetchr=trim($allcose);
            $ccdwoutcrd=substr("$coursegetchr", 0, -1);
            $getchar = preg_split('//', $coursegetchr, -1);

                    $credit=$getchar[7];
                    if(($credit=="a")||($credit=="A")){
                        $credit="&#945;";
                            }
                    elseif(($credit=="b")||($credit=="B")){
                        $credit="&#946;";
                                }
                    elseif(($credit=="d")||($credit=="D")){
                        $credit="&#948;";
                                }
                    else{
                        $credit=$credit;
                        }

            $allcose2=$ccdwoutcrd.$credit;
////////////////////////////////////////////////////////////////////////////////////////
                            ////////////////////////////////////////////////////////
                                $getchar = preg_split('//', $allcose2, -1);

                                $midcredit=$getchar[5];
                                if($midcredit=="b"){
                                    $getlob=explode('b',$allcose2);
                                        $fistprt=$getlob[0];
                                        $sectprt=$getlob[1];
                                        $fulcode3=strtoupper($fistprt)."b".$sectprt;
                                                        }

                                elseif($midcredit=="B"){
                                    $getlob=explode('B',$allcose2);
                                        $fistprt=$getlob[0];
                                        $sectprt=$getlob[1];
                                        $fulcode3=strtoupper($fistprt)."b".$sectprt;
                                                        }
                                else{
                                $fulcode3=strtoupper($allcose2);
                                }
                            ////////////////////////////////////////////////////                
                            
                            
                        
                    
 //////////////////////.............................////////////////////////////// 
    
    
    
    
echo '<tr align="left" class="trbgc"><td align=center><a href="index.php?view=admin&admin=35&attdisp=displayatt&sub='.$attdata['code'].'&task8=attendence&display=all"';
?>

onclick="viewWindow(this.href,'mywin','860','600','yes','center');return false";


<?php
echo '>'.$fulcode3."</a><td>".ucfirst($attdata['name']);

}
mysql_close($con21_1);
echo "</table>";
}
		

						

// View attendences Available
$task8=$_GET['task8'];
if($task8=='attendence'){
$sub_21=$_GET['sub'];
////////////////////////////


echo '<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr><td width=100px>&nbsp;';

////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////
/////////////////// Check form /////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////

echo '<td align="left">';
echo"<font color=#48AF48 size=small>You can check cut-off Levels here</font><br /><br /><br />";
$query_21_a="SELECT distinct type FROM lecture where course = '$sub_21'";
$atta=mysql_query($query_21_a);
while($find_type=mysql_fetch_array($atta)){
	$find_a=$find_type['type'];
	echo '<form name="check" method="post"';
	echo 'action=index.php?view=admin&admin=35&attdisp=displayatt&sub='.$sub_21.'&task8=attendence&display='.$find_a.'>';
	echo ucfirst($find_a);
echo '&nbsp;&nbsp;<input type="text" size="1" name="'.$find_a.'" id="'.$find_a.'"> &nbsp;%<br /><br />';

}

echo '&nbsp;<input type=submit value="Check This % Value"></form>';
////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////

		
////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////
///////////////////Submit Form /////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////
echo '<td align="left">';
echo"<font color=#48AF48 size=small>You can confirm cut-off Levels here<br />(Can be also changed)</font><br /><br />";

$query_21_a="SELECT distinct type FROM lecture where course = '$sub_21'";
$atta=mysql_query($query_21_a);
while($find_type=mysql_fetch_array($atta)){
	
	$find_a=$find_type['type'];
	echo '<form name=submitatt1 method="post"';
	echo 'action=index.php?view=admin&admin=35&attdisp=displayatt&sub='.$sub_21.'&task8=attendence&display='.$find_a.'>';
	echo ucfirst($find_a);
	
echo '&nbsp;&nbsp;<input type="text" size="1" name="a'.$find_a.'" id="a'.$find_a.'"> &nbsp;%<br /><br />';

}

echo '&nbsp;<input type=submit name="submitatt" value="Submit This % Value"></form>';

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


echo "<br /><font color=red>Current Eligibility of ".$sub_21." Course Unit &nbsp&nbsp| &nbsp&nbsp&nbsp ".ucfirst($selection)." Type</font>";

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
	echo "<br />Lecture is ".$l." %";
	$m->addPer($sub_21,$acc1,"lecture",$l);
	}
	if(isset($_POST['atute'])){
		$t=$_POST['atute'];
	echo "<br />Tute is ".$t." %";
	$m->addPer($sub_21,$acc1,"tute",$t);
	
	}
	if(isset($_POST['apractical'])){
		$p=$_POST['apractical'];
	echo "<br />Practical is ".$p." %";
	$m->addPer($sub_21,$acc1,"practical",$p);
	
	}
	
	
	}

///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////
///////////////////////////////////////////////


	$con9=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);
		
	$query1_2="SELECT distinct type FROM lecture where course = '$sub_21'";
    
	$reg_once=mysql_query($query1_2);
	echo '<br /><br /><div align="center"><table border="0" width="100%" cellspacing="1" cellpadding="2" bordercolor="#C0C0C0" bgcolor="#000000"><tr><td bgcolor="#A8FFA8">&nbsp;';
	
	

	
	
	while($data=mysql_fetch_array($reg_once)){
	echo '<td bgcolor="#A8FFA8" width="65px">';
	echo "<font size=1px>".ucfirst($data['type'])."s<br>";
	$lect_typenow=$data['type'];
	$acc=$n->getAcc();
	$total=$m->getMax($sub_21, $lect_typenow,$acc);
		if($total=="nd"){
			$total=0;
				}
	echo "Minnimum,<br /> <font size=3>".$total." %</font>";

	
	
	
	}
	echo '<td width="120px" bgcolor="#A8FFA8"> Check Value <font color=#458748 size="2px">';
		
	if(isset($_POST['lecture']))
	echo "Lecture is ".$_POST['lecture']." %";
	if(isset($_POST['tute']))
	echo "<br />Tute is ".$_POST['tute']." %";
	if(isset($_POST['practical']))
	echo "<br />Practical is ".$_POST['practical']." %";
	
	
	
	
	echo '</font><td width="100px" bgcolor="#A8FFA8"> Finalized Eligibility<td width="200px" bgcolor="#A8FFA8"> Comments  <td width="100px" bgcolor="#A8FFA8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Percentage %&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	
	

	$query_21_8="select distinct r.student, s.l_name, s.batch from registration r, lecture l, student s where s.id=r.student and r.course = '$sub_21' and l.course=r.course  and r.acedemic_year='$acy' and r.confirm='1'  order by l.lecture_id, r.student";
  	$oce=mysql_query($query_21_8);
	while($data2=mysql_fetch_array($oce)){
			$counta++;
			$student_select=$data2['student'];
			$stpractgp=$m->getprctgp($student_select,$sub_21,$acy);	
	echo '<tr>';
	
	
	echo '<td bgcolor="#F0FFF0">&nbsp;&nbsp;SC/'.$data2['batch'].'/'.strtoupper($data2['student']).'&nbsp;&nbsp;';
	
	

	/// Student Registration Information
	
	$true_eli=0;
	$query1_4="SELECT distinct type FROM lecture where course = '$sub_21'";
	
	
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
				}	
	


	$cp=($total/$ctotal)*100;
	echo '<font color=#07A007>'.round($cp).' %';
	
	
	if(round($cp)>=$Qvalue) 
	{
		echo '&nbsp;&nbsp;&nbsp;<img src=images/r.png>';
		if($true_eli==1)
		$true_eli=1;
		elseif($true_eli==0){
		$true_eli=2;
		$count1++;
		}
	}
	
	else
	{
		echo '&nbsp;&nbsp;&nbsp;<img src=images/w.png>';
		$true_eli=1;
	}
	
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
	
	$query1_4="SELECT distinct type FROM lecture where course = '$sub_21'";
	
	
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
	
	if($true_eli1==2){
	echo '&nbsp;&nbsp;&nbsp;<img src=images/r.png>';
	$count++;
	}
	else
	echo '&nbsp;&nbsp;&nbsp;<img src=images/w.png>';
	//////////////////////////////////////////////////////
	//// End Check Value//////////////////////////////////
	//////////////////////////////////////////////////////
	
	
	// Finitialized Value
	echo '<td bgcolor="#F4FBF7" align=center>';
	if($true_eli==2)
	echo '<img src=images/r.png>';
	else
	{
	echo '<img src=images/w.png>';
	//echo '&nbsp;&nbsp;&nbsp;<img src=images/conf.png>';
	}
	// End Finitialized Value
	
	// Any Comments
	echo '<td bgcolor="#F4FBF7"><font style="font-size:smaller;">no comments</font>';
	
	
	
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
	
	}
	echo '<tr><td bgcolor="#F4FBF7">Total %<td bgcolor="#F4FBF7">'.$counta.' Students';
	$c1=round(($count/$counta)*100,2);
	$c2=round(($count1/$counta)*100,2);
	echo '<td bgcolor="#F4FBF7">&nbsp<td bgcolor="#F4FBF7">'.$count.' ('.$c1.'%)<td bgcolor="#F4FBF7">'.$count1.' ('.$c2.'%)<td bgcolor="#F4FBF7">&nbsp;<td bgcolor="#F4FBF7">&nbsp;';
	echo "</table>";
    echo "</div>";
    
    

    
 
}
						
						
						

?>
