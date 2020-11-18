


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
//var subj="saasa";
var selected_Value= document.getElementById('group').options[selected_Index].value;
window.location= 'index.php?view=admin&admin=36&attdisp=displayatt&sub='+subj+'&task8=attendence&display='+ selected_Value;

}
</script>


<?php

echo"View Attendence of All Course Units<hr class=bar>";

require_once('classes/attClass.php');		
$m=new attendence();							

include'./admin/config.php';
$dept_17=$_SESSION['section'];									
$lec_id=$_SESSION['user_id'];
						
$con21_1=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);
//..............Edit by Iranga...Overall attendance progress.................
	//echo "<a href='./att_presentage.php'>Click Here to Check Overall Attendance progress</a><br><br>";
//................................................

$acc_year="select acedemic_year from acc_year where current='1'";
$ac_year=mysql_query($acc_year);
while($a_y=mysql_fetch_array($ac_year)){
$acy=$a_y['acedemic_year'];
}


		
$query_21_8="select distinct semister from level";
$attL=mysql_query($query_21_8);
while($find_semiL=mysql_fetch_array($attL)){
$find_L=$find_semiL['semister'];
}

$selection=$_GET['display'];
if(($_GET['task8'])!='attendence'){

if($find_L==1)
$query_21_1="select code, name, department from courseunit where (semister=1 or semister=3) and availability=1 order by department,code,name";
elseif($find_L==2)
$query_21_1="select code, name, department from courseunit where (semister=2 or semister=3) and availability=1 order by department,code,name";
$att=mysql_query($query_21_1);
echo "You have following subjects for view Attendence ";
echo '<table><th>Course Unit<th>Course Name<th>Department';	
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
        
    
echo '<tr align="left" class="trbgc"><td align=center><a href="index.php?view=admin&admin=36&attdisp=displayatt&sub='.$attdata['code'].'&task8=attendence&display=all"';
?>

onclick="viewWindow(this.href,'mywin','860','600','yes','center');return false";


<?php
echo '>'.$fulcode3."</a><td>".ucfirst($attdata['name'])."<td align=center>".ucfirst($attdata['department']);

}
mysql_close($con21_1);
echo "</table>";
}
		
	
						

// View attendences Available
$task8=$_GET['task8'];
if($task8=='attendence'){
error_reporting(0);
$sub_21=$_GET['sub'];
////////////////////////////

/////////////////////////
/// Create CSV File /////
/////////////////////////

$id_save=$sub_21."-".$acy;
//$id_save=$sub_21."-".date("Y-m-d-H-i-s");
$myFile = "export_data/att/".$id_save.".csv";

////////////////////////////
////////////////////////////
////////////////////////////
////////////////////////////
////////////////////////////
////////////////////////////
////////////////////////////

echo '<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr><td align="center">';
echo '<input type="hidden" name="subject" id="subject" size="3" value="'.$sub_21.'">';

echo '<select size="4" name="group" id="group" onchange="att_display()">	<option value="all">All Att.</option>';

$query_21_a="SELECT distinct type FROM lecture where course = '$sub_21' and acc_year='$acy'";
$atta=mysql_query($query_21_a);
while($find_type=mysql_fetch_array($atta)){
$find_a=$find_type['type'];

echo '<option value="'.$find_a.'">';
echo ucfirst($find_a);
echo '</option>';
}


echo '</select></td><td align="center">';
		
////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////
?>
<a href="javascript:window.print();">

<img border="0" src="images/small/document-print.png" width="48" height="48"></a></td>
<td align="center">  




<?php    
echo '<a href="export_data/att/download.php?file='.$id_save.'.csv" ><img border="0" src="images/small/old-ooo-template.png"></a> ';

?>




 
</td>
		<td align="center"> <a href="#" onclick="window.location.reload()"><img border="0" src="images/small/edit-redo.png" ></a><p> </td>
		<td align="center"> <a href="javascript:window.close()"> <img border="0" src="images/small/emblem-nowrite.png" width="48" height="48"></a></td>
	</tr>
	<tr>
		<td align="center">Filter Data</td>
		<td align="center">&nbsp; Print This Page </td>
		<td align="center">Export CSV</td>
		<td align="center">Reload Page</td>
		<td align="center">Close Window</td>
	</tr>
</table>








<?php
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
echo '<hr class=bar>';	


echo "<br /><font color=red>Current Attendences of ".$sub_21." Course Unit &nbsp&nbsp| &nbsp&nbsp&nbsp ".ucfirst($selection)." Type</font>";
////////////////////////////
////////////////////////////
////////////////////////////
//// Write into Text File //
////////////////////////////
////////////////////////////
////////////////////////////
////////////////////////////
//$id_save=$sub_21."-".date("Y-m-d-H-i-s");
$id_save=$sub_21."-".$acy;
$myFile = "export_data/att/".$id_save.".csv";
unlink($myFile);
$fh = fopen($myFile, 'a') or die("can't open file");
$header="Current Attendence Sheet Data of ".$sub_21."- | &nbsp&nbsp&nbsp ".ucfirst($selection)." Type\n\n\n";
fwrite($fh, $header);
////////////////////////////
////////////////////////////
////////////////////////////
////////////////////////////
////////////////////////////
////////////////////////////


	$con9=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);
	
	if((isset($selection))&&($selection!='all'))
	$query1_2="select lecture_id, date, time , type, hours, att_group from lecture where course='$sub_21' and type='$selection' and acc_year='$acy' order by date ,time";
    else
	$query1_2="select lecture_id, date, time , type, hours, att_group from lecture where course='$sub_21' and acc_year='$acy' order by date ,time";
	
	$reg_once=mysql_query($query1_2);
	echo '<br /><br /><div align="center"><table border="0" width="100%" cellspacing="1" cellpadding="2" bordercolor="#C0C0C0" bgcolor="#000000"><tr><td bgcolor="#A8FFA8" align=center valign=middle>#<td bgcolor="#A8FFA8">&nbsp;';
	
	
////////////////////////////
////////////////////////////
////////////////////////////
//// Write into Text File //
////////////////////////////
$header0="-,";
fwrite($fh, $header0);
////////////////////////////
////////////////////////////
	
	
	while($data=mysql_fetch_array($reg_once)){
	echo '<td bgcolor="#A8FFA8" align=center>';
	echo "<font size=1px>L-".$data['lecture_id']."<br>".substr($data['date'],5,5)."<br>".substr($data['time'],0,5)."<br>".substr(ucfirst($data['type']),0,4)."<br>".$data['hours']." H<br>";
		if($data['att_group']!="nogrp"){
		echo$data['att_group']."</font>";
		$ptgp=$data['att_group'];
		
									}
	else{
	echo"&nbsp;</font>";
	$ptgp="ng";
	}
	
////////////////////////////
////////////////////////////
////////////////////////////
//// Write into Text File //
////////////////////////////
$header2=$data['date']."-".$data['time']."-".substr(ucfirst($data['type']),0,4)."-".$data['hours']."H-".$ptgp.",";
fwrite($fh, $header2);
////////////////////////////
////////////////////////////

	
	
	}
	echo '<td width="50px" bgcolor="#A8FFA8" align=center><b>%</b>';
	
	
////////////////////////////
////////////////////////////
////////////////////////////
//// Write into Text File //
////////////////////////////
$header3="%";
fwrite($fh, $header3);
////////////////////////////
////////////////////////////	
	

     $fmviweque="rumisdb.fohssmisStudents fs";
	$query_21_8="select distinct r.student, s.batch from registration r, lecture l, student s, $fmviweque where s.id=r.student and r.course = '$sub_21' and l.course=r.course and r.acedemic_year='$acy' and r.confirm='1' and concat('sc',r.student)=fs.user_name order by l.date, r.student";
  	$oce=mysql_query($query_21_8);
    $atrw=1;
	while($data2=mysql_fetch_array($oce)){
	echo '<tr><td bgcolor="#F0FFF0" width=1% align=center>'.$atrw;
	


////////////////////////////
////////////////////////////
////////////////////////////
//// Write into Text File //
////////////////////////////
$header4="\n";
fwrite($fh, $header4);
////////////////////////////
////////////////////////////

	
	
	
	echo '<td bgcolor="#F0FFF0">&nbsp;&nbsp;SC/'.$data2['batch'].'/'.strtoupper($data2['student']).'&nbsp;&nbsp;';
	
	
	
	
////////////////////////////
////////////////////////////
////////////////////////////
//// Write into Text File //
////////////////////////////
$header5='SC/'.$data2['batch'].'/'.strtoupper($data2['student']).',';
fwrite($fh, $header5);
////////////////////////////
////////////////////////////
	
	
	$student_select=$data2['student'];
	/// Student Registration Information
	
	
	if((isset($selection))&&($selection!='all')){
	$query1_4="select lecture_id,att_group from lecture where course='$sub_21' and type='$selection' and acc_year='$acy' order by date,time";
	}
	else
	$query1_4="select lecture_id,att_group from lecture where course='$sub_21' and acc_year='$acy' order by date,time";
	
	
	$reg_three=mysql_query($query1_4);
	
	while($data3=mysql_fetch_array($reg_three)){
	echo '<td bgcolor="#F5F3FE" align=center>&nbsp;';
	
	$lect_id=$data3['lecture_id'];
	$att_group=$data3['att_group'];
//////////////////////////////
//////////////////////////////
//////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($att_group=="nogrp"){	
	$status=$m->getAtt($lect_id, $student_select);
	
	if($status==0)
	$d='0';
	elseif($status==1)
	$d= '1';
	elseif($status==2)
	$d= 'M';
	elseif($status==3)
	$d= 'E';

	echo $d;
							}
else{

$expgetexptno=explode('-',$att_group);
$getexptno=$expgetexptno[0];
$getexptgp=$expgetexptno[1];
$status=$m->getAtt($lect_id, $student_select);


	if($status==1)
	$d= '1';
	elseif($status==2)
	$d= 'M';
	elseif($status==3)
	$d= 'E';
	else{
		
		$practgp=$m->getprctgp($student_select,$sub_21,$acy);
		
		if($getexptgp==$practgp){
			$d="0";
								}
		else{
			$d=" ";
				}
	
			}
	
	echo $d;


	}
//////////////////////////////////////////////////////////////////////////////////////////////////////	
////////////////////////////
////////////////////////////
////////////////////////////
//// Write into Text File //
////////////////////////////
$header6=$d.",";
fwrite($fh, $header6);
////////////////////////////
////////////////////////////
/////////////////////////////
//////////////////////////////
//////////////////////////////
	
	
	
	// End of the checking Registration
	}
	
	////////////////////////////////////////////////////////
	/////////////////// Percentage Displays ////////////////
	////////////////////////////////////////////////////////
	echo '<td bgcolor="#F4FBF7" align=center>';
	
	$stpractgp=$m->getprctgp($student_select,$sub_21,$acy);		
	if((isset($selection))&&($selection!='all')){
    $total=$m->getTotal($sub_21, $student_select,$selection,$acy);
    $ctotal=$m->getSubTotal($sub_21,$selection,$acy,$stpractgp);
	}
	else{
	$total=$m->getTotalAll($sub_21, $student_select,$acy);
	$ctotal=$m->getSubTotalAll($sub_21,$acy,$stpractgp);

	}
	
	
	$cp=($total/$ctotal)*100;
	echo '<font color=green>'.round($cp).' %';
	
	
	
////////////////////////////
////////////////////////////
////////////////////////////
//// Write into Text File //
////////////////////////////
$header7=round($cp)." %,";
fwrite($fh, $header7);
////////////////////////////
////////////////////////////
/////////////////////////////
//////////////////////////////
//////////////////////////////
	
	
	
	
  
	///////////////////////////////////////////////////////
	///////////////////////////////////////////////////////
	///////////////////////////////////////////////////////
		
	// End Student Registration Information	
	$atrw++;
	}
	echo '<tr><td bgcolor="#FFEAFF"><td bgcolor="#FFEAFF"><b>Total</b>';
	
	
	
////////////////////////////
////////////////////////////
////////////////////////////
//// Write into Text File //
////////////////////////////
$header7="\nTotal,";
fwrite($fh, $header7);
////////////////////////////
////////////////////////////
/////////////////////////////
//////////////////////////////
//////////////////////////////	
	
	
	
	
	
	
	
	/////////////////////////////////////
	////////////////////////////////////
	/////// Get Total //////////////////
	////////////////////////////////////
	////////////////////////////////////
	
	if((isset($selection))&&($selection!='all')){
	$query1_22="select lecture_id from lecture where course='$sub_21' and type='$selection' and acc_year='$acy' order by date,time";
	}
	
	else{
	$query1_22="select lecture_id from lecture where course='$sub_21' and acc_year='$acy' order by date,time";
	}
		
	$reg_once2=mysql_query($query1_22);
	while($data2=mysql_fetch_array($reg_once2)){
	echo '<td bgcolor="#FFEAFF" align=center>';
	$data2['lecture_id'];
	$total=$m->getNoStd($data2['lecture_id']);
	echo $total;
	
////////////////////////////
////////////////////////////
////////////////////////////
//// Write into Text File //
////////////////////////////
$header8=$total.",";
fwrite($fh, $header8);
////////////////////////////
////////////////////////////
/////////////////////////////
//////////////////////////////
//////////////////////////////	
	
	
	
	}
    echo '<td bgcolor="#FFEAFF"> &nbsp; ';
	////////////////////////////////////
	////////////////////////////////////
	////////////////////////////////////
	////////////////////////////////////
	
    
	
	echo "</table>";
    echo "</div>";
    
    
////////////////////////////
////////////////////////////
//// Write into Text File //
////////////////////////////
fclose($fh);
////////////////////////////
////////////////////////////
/////////////////////////////


    
 
}
						
						
						

?>
