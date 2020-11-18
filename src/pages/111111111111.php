<!--Student Registration Information.
student can check their register course unit and new commers can select their course combinations.
-->
<script type="text/javascript" src="./Ajax/sp_cu_reg.js"></script>

<?php
/////////////////////////////////////////////////////////////////////////////////
//.....edit by iranga New student can choose their course combinations..........
/////////////////////////////////////////////////////////////////////////////////
$stno=$_SESSION['user_id'];
$rustno=$_SESSION['ru_st_user_id'];

$duty=$_GET['duty'];
$gid=$_POST['id'];
$priot=$_POST['priority'];
$combi=$_POST['combi'];
    $getcmbid=explode("/",$combi);
    $cmbid=$getcmbid[1];
$regcmb=$_POST['regcmb'];
$make=$_POST['make'];
$id=$_GET['id'];
include'./admin/config.php';


//////////////edit by iranga ////////////////////////////////////////////////////
require_once('./classes/globalClass.php');
$l=new settings();
/////////////////////////////////////////////////////////////////////////////////
//Check the genaral or special//////
$stspsub=$l->chkspecial($stno);
//echo $stspsub;
///////////////////////////////////////////////////////////////////////////////////
/////////////////////////////// if genaral student/////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
if($stspsub=="General Student"){

$con_combin=mysql_connect($host,$user,$pass) or die("Unable to connect Database");
mysql_select_db($db);

///////////////////////////////////////////////////////////////
//....check student new commer or not....................
//////////////////////////////////////////////////////////

$questcmbi="select * from student where id='hs$stno'";
//echo $questcmbi;
$qustcmbi=mysql_query($questcmbi);

/// if student new commer...........

if(mysql_num_rows($qustcmbi)==0)
{
//mysql_close($con_combin);
///get student scream.............................


$quesrem="select occupation from $rmsdb.fohssmis where user='$rustno'";
//echo$quesrem;
$qusrem=mysql_query($quesrem);

while($qsrem=mysql_fetch_array($qusrem)){
$srem=$qsrem['occupation'];
//echo$srem;
}



include'./connection/connection.php';
//...........................		
				
//....................get closing date of call combinations.....................
$quecmbcldt="select * from call_combination where status='1'";
$qucmbcldt=mysql_query($quecmbcldt);
while($qcmbcldt=mysql_fetch_array($qucmbcldt)){
$cmbacc_yaer=$qcmbcldt['acc_year'];
$cmbend=$qcmbcldt['closing_date'];
$cmbst=$qcmbcldt['status'];
}
///////////////////////////////////////////////////////

if(($duty=="fill")&&($make=="Register")){
$queinstcm="insert into request_combination(stno, acc_year, combination, priority, status) values('$stno', '$cmbacc_yaer', '$combi', '$priot', '$regcmb')";
mysql_query($queinstcm);
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////// tempory registration for course unit /////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    if($priot==1){
    $acy=$l->getAcc();                          
    $quereglsefirst="select distinct c.code,c.semister,c.target_group from courseunit c, combination o, target_group t where o.id=$cmbid and o.subject=t.subject and t.target_id=c.target_group and c.core='co' and c.level='1' and (c.semister=1 or c.semister=3) and c.availability=1 order by c.code";
    //echo$quereglsefirst;
    $qureglsefirst=mysql_query($quereglsefirst);
        while($qreglsefirst=mysql_fetch_array($qureglsefirst)){
                        
            $firstcos=$qreglsefirst['code'];
            $firstseme=$qreglsefirst['semister'];
            $trgtbp=$qreglsefirst['target_group'];
                        
            //echo$firstcos.$firstseme.$trgtbp."<br>";
                if($trgtbp!="12"){
                    $queinsfirst="insert into  registration(student, course, acedemic_year, semister, degree, confirm) values('$stno', '$firstcos', '$acy', $firstseme,1,0)";
                    //echo$queinsfirst."a<br>";
                    mysql_query($queinsfirst);  
                        }
                else{
                ///////////////////////////////////////////////////////////////////////////////////////////////
                    $cs="no";
                    $quegtcs="select subject from combination where id='$cmbid'";
                    $qugtcs=mysql_query($quegtcs);
                        while($qgtcs=mysql_fetch_array($qugtcs)){
                            $cmbsubj=$qgtcs['subject'];
                                if($cmbsubj=="computer_science"){
                                        $cs="yes";
                                                }
                                            }
                    if($cs=="no"){
                        $queinsfirst="insert into  registration(student,course,acedemic_year,semister,degree,confirm) values('$stno','$firstcos','$acy',$firstseme,1,0)";
                        //echo$queinsfirst."b<br>";
                        mysql_query($queinsfirst);

                            }

        ///////////////////////////////////////////////////////////////////////////////////////////////
                                }

                                        }

            }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// end tempory registration for course unit /////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

					}



if(($duty=="fill")&&($make=="Cancel")){
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// cancel  tempory registration for course unit /////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $quegetcmbchoic="select  stno,acc_year,priority from request_combination where id=$gid";
    //echo$quegetcmbchoic;
    $qugetcmbchoic=mysql_query($quegetcmbchoic);
    while($qgetcmbchoic=mysql_fetch_array($qugetcmbchoic)){
        $stno=$qgetcmbchoic['stno'];
        $acc_year=$qgetcmbchoic['acc_year'];
        $priority=$qgetcmbchoic['priority'];
            
                                }
        
        if($priority==1){
            $quedelreg="delete from registration where student='$stno' and acedemic_year='$acc_year' and (semister=1 or semister=3)";
            mysql_query($quedelreg);
                }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////// end cancel  tempory registration for course unit /////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $quedelcmb="delete from request_combination where id=$gid";
    mysql_query($quedelcmb);
					}


echo" Subject Combinations Registration Unit<br>";
echo"<hr class=bar><br>";

$combination[1]="Computer Science + Mathematics + Applied Mathematics";
$combination[2]="Computer Science + Mathematics + Physics";
$combination[3]="Computer Science + Chemistry + Mathematics";
$combination[4]="Industrial Mathematics + Mathematics + Chemistry";
$combination[5]="Industrial Mathematics + Mathematics + Physics";
$combination[6]="Mathematics + Applied Mathematics + Physics";
$combination[7]="Mathematics + Applied Mathematics + Chemistry";
$combination[8]="Mathematics + Physics + Chemistry";
$combination[9]="Zoology + Botany + Chemistry";
$combination[10]="Chemistry + Botany + Physics";
$combination[11]="Chemistry + Zoology + Physics";
$combination[12]="Botany + Zoology + Physics";
$combination[13]="BCS - Computer Science";

///...........check call combination status.....................
if($cmbst=='1'){



echo"<font size='3px'>No Changes Are Allowed After : <font color='red'>$cmbend</font></font><br>";

echo"<table border='0' width='90%'>";
echo"<tr><th>Course Combinations</th><th>Priority</th><th>Submit</th></tr>";

// for physical science student.................................
if($srem=="phy_student"){
echo"Student must be register at least more than one combination as your choice.<br>";
	for($cm=1;$cm<=8;$cm++){

$quegetcmb="select * from request_combination where stno='$stno' and combination='$combination[$cm]/$cm' order by priority";

$qugetcmb=mysql_query($quegetcmb);
	if(mysql_num_rows($qugetcmb)=='0'){
	echo"<form method='POST' action='./index.php?view=admin&admin=1&duty=fill'>";
	echo"<tr class=trbgc><td align='center'>$combination[$cm]<input type='hidden' name='combi' value='$combination[$cm]/$cm'></td>";
	echo"<td align='center'>";

		echo"<select name='priority'>";
		
		for($k=0;$k<8 ;$k++){
			$prtary[$k]=0;
					}
			for($i=1;$i<=8;$i++){
				$quecmbprit="select priority from request_combination where stno='$stno' order by priority;";
				$qucmbprit=mysql_query($quecmbprit);
				while($qcmbprit=mysql_fetch_array($qucmbprit)){
				$cmbprit=$qcmbprit['priority'];
					if($cmbprit==$i){
				   	$prtary[$i]=1;
							}
										}
						}
		for($j=1;$j<=8;$j++){
			if($prtary[$j]==0){
			echo"<option value=$j>$j</option>"; 
					   }
				      }
		echo"</select>";
	echo"</td>";
	echo"<td align='center'><input type='submit' value='Register' name='regcmb'><input type='hidden' name='make' value='Register'></td></tr></form>";
						
					}
	else{	    
	while($qgetcmb=mysql_fetch_array($qugetcmb)){
	$ckid=$qgetcmb['id'];
	$ckstno=$qgetcmb['stno'];
	$ckcmb=$qgetcmb['combination'];
	$ckpriot=$qgetcmb['priority'];
	$ckstat=$qgetcmb['status'];
							}
	echo"<form method='POST' action='./index.php?view=admin&admin=1&duty=fill'>";
	echo"<tr class=selectbg><td align='center'>$combination[$cm]<input type='hidden' name='combi' value='$combination[$cm]/$cm'></td>";
	echo"<td align='center'>";
	if($ckcmb==$combination[$cm]."/".$cm){
		echo$ckpriot."</td><td align='center'>";
		echo"<input type='submit' value='Cancel' name='regcmb'><input type='hidden' name='make' value='Cancel'>";
		echo"<input type='hidden' name='id' value='$ckid'>";
		echo"</td></tr></form>";
					}
		}
			}

  }
// end phy sci student prosses.........................

//.. for bio science stucent......................
if($srem=="bio_student"){
echo"Student must be register at least more than one combination as your choice.<br>";
for($cm=9;$cm<=12;$cm++){
$quegetcmb="select * from request_combination where stno='$stno' and combination='$combination[$cm]/$cm' order by priority";
$qugetcmb=mysql_query($quegetcmb);
	if(mysql_num_rows($qugetcmb)=='0'){
	echo"<form method='POST' action='./index.php?view=admin&admin=1&duty=fill'>";
	echo"<tr class=trbgc><td align='center'>$combination[$cm]<input type='hidden' name='combi' value='$combination[$cm]/$cm'></td>";
	echo"<td align='center'>";

		echo"<select name='priority'>";
		
		for($k=0;$k<4 ;$k++){
			$prtary[$k]=0;
					}
			for($i=1;$i<=4;$i++){
				$quecmbprit="select priority from request_combination where stno='$stno' order by priority;";
				$qucmbprit=mysql_query($quecmbprit);
				while($qcmbprit=mysql_fetch_array($qucmbprit)){
				$cmbprit=$qcmbprit['priority'];
					if($cmbprit==$i){
				   	$prtary[$i]=1;
							}
										}
						}
		for($j=1;$j<=4;$j++){
			if($prtary[$j]==0){
			echo"<option value=$j>$j</option>"; 
					   }
				      }
		echo"</select>";
	echo"</td>";
	echo"<td align='center'><input type='submit' value='Register' name='regcmb'><input type='hidden' name='make' value='Register'></td></tr></form>";
						
					}
	else{	    
	while($qgetcmb=mysql_fetch_array($qugetcmb)){
	$ckid=$qgetcmb['id'];
	$ckstno=$qgetcmb['stno'];
	$ckcmb=$qgetcmb['combination'];
	$ckpriot=$qgetcmb['priority'];
	$ckstat=$qgetcmb['status'];
							}
	echo"<form method='POST' action='./index.php?view=admin&admin=1&duty=fill'>";
	echo"<tr class=selectbg><td align='center'>$combination[$cm]<input type='hidden' name='combi' value='$combination[$cm]/$cm'></td>";
	echo"<td align='center'>";
	if($ckcmb==$combination[$cm]."/".$cm){
		echo$ckpriot."</td><td align='center'>";
		echo"<input type='submit' value='Cancel' name='regcmb'><input type='hidden' name='make' value='Cancel'>";
		echo"<input type='hidden' name='id' value='$ckid'>";
		echo"</td></tr></form>";
					}
		}
			

			}
		    }
// end bio sci student prosses.........................
//.. for bcs student........................
if($srem=="bcs_student"){

$quegetcmb="select * from request_combination where stno='$stno' and combination='$combination[13]/13' order by priority";
$qugetcmb=mysql_query($quegetcmb);
	if(mysql_num_rows($qugetcmb)=='0'){
	echo"<form method='POST' action='./index.php?view=admin&admin=1&duty=fill'>";
	echo"<tr class=trbgc><td align='center'>$combination[13]<input type='hidden' name='combi' value='$combination[13]/13'></td>";
	echo"<td align='center'>";
	echo"<select name='priority'>";
	echo"<option value=1>1</option>"; 
	echo"</select>";	
	echo"</td>";
	echo"<td align='center'><input type='submit' value='Register' name='regcmb'><input type='hidden' name='make' value='Register'></td></tr></form>";
						
					}
	else{	    
	while($qgetcmb=mysql_fetch_array($qugetcmb)){
	$ckid=$qgetcmb['id'];
	$ckstno=$qgetcmb['stno'];
	$ckcmb=$qgetcmb['combination'];
	$ckpriot=$qgetcmb['priority'];
	$ckstat=$qgetcmb['status'];
							}
	echo"<form method='POST' action='./index.php?view=admin&admin=1&duty=fill'>";
	echo"<tr class=selectbg><td align='center'>$combination[13]<input type='hidden' name='combi' value='$combination[13]/13'></td>";
	echo"<td align='center'>";
	if($ckcmb==$combination[13]/13){
		echo$ckpriot."</td><td align='center'>";
		echo"<input type='submit' value='Cancel' name='regcmb'><input type='hidden' name='make' value='Cancel'>";
		echo"<input type='hidden' name='id' value='$ckid'>";
		echo"</td></tr></form>";
					}
		}

		    }
// end bcs student prosses.........................
echo"</table>";							
}



//.......when call combination stoped.................... 
else{
echo"Sorry..! Combination Registration Closed. If Any Changes ? Contact Dean Office.";
}
//...............................................


}

///////////////////////////////////////////////////////////////
//...............end select combination prosses.................
//////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
// if student not new commer, student can register their course units...........
////////////////////////////////////////////////////////////////////////////////





else{


///////////////////////check student passout or not/////////////////////////////////
//............get st level...........................
$stlvl=$l->getLevel($stno);
//..................................................
echo "Course Registration Unit <hr class=bar>";
if($stlvl!=0){
////////////////////////////////////////////////////////////////////////////////////

//......................course unit registration prosses..........................

/////////////////////////////////////////////
$quegtcs="select c.subject from combination c, student s where s.combination=c.id and s.id='$stno'";
			$qugtcs=mysql_query($quegtcs);
			echo"<table border=0 width=60%><tr><ul>";
			while($qgtcs=mysql_fetch_array($qugtcs)){
				$cmbsubj=$qgtcs['subject'];
				echo "<td vlaign=middel align=center  width=20%><li>".strtoupper($cmbsubj)."</li>";

					}

			echo" </table></br>";

/////////////////////////////////////////////						
						$con1_2=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);	
						
						// if registration Noticed
						
						$query1_1="select * from call_registration";
						$prev=mysql_query($query1_1);
						while($predata=mysql_fetch_array($prev)){
						$reg_check=$predata['register'];
						$ac_1=$predata['acedemic_year'];
						$semi_1=$predata['semister'];
						$close_1=$predata['closing_date'];
						

						}
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
/*
if($stlvl!=1){
if($reg_check==1){
$reg_check=0;
}
//$semi_1=1;
		}
else{
if($reg_check==1){
$reg_check=1;
}
//$semi_1=2;
}
*/

////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
						
						if($reg_check==1){
						echo '<font color=#109010>Registered Subjects for '.$ac_1.' Academic year and Semester	'.$semi_1.' </font><br>';	
						echo "Closing Date for Registration : <font color=green>".$close_1."</font><br>";
						echo "<font color=red><b><center> Notice : Do Modification of Registration on or Before Closing Date </center></b></font>";
			
						// Go ahead with Registration
						include 'forms/form_1.php';
						
						//adding Data to the Database
						if(($task=='register')&&(isset($_POST['submit']))){
						$cou_1=$_POST['cou_1'];
						$deg_1=$_POST['deg_1'];
						$con9=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						
						$check_to_reg="select course from registration where student='$id_1' and (semister='$semi_1' or semister='3') and acedemic_year='$ac_1'";
						$check_5=mysql_query($check_to_reg);
						while($chk=mysql_fetch_array($check_5)){
						if($cou_1==$chk['course']){
						$duplicate='Yes';
						}
						}
						if($duplicate=='Yes'){
						 echo "<hr class=bar>";
						echo "<br><font color=red style='font-size:16px'> * You have Already Registered This Course Unit<br></font><br>";
						 echo "<hr class=bar>";
						}
						else{
							$quegtseme="select semister from courseunit where code='$cou_1'";
							$qugtseme=mysql_query($quegtseme);
							$qgtseme=mysql_fetch_array($qugtseme);
								$cou_1seme=$qgtseme['semister'];
							
							if($cou_1seme=="3"){
								$reg_7="insert into registration values(NULL,'$id_1','$cou_1','$ac_1',3,'$deg_1',0)";
								$x=mysql_query($reg_7);
								echo "<meta http-equiv='refresh' content='0;URL=index.php?view=admin&admin=1'>";
								}
							else{
								$reg_7="insert into registration values(NULL,'$id_1','$cou_1','$ac_1','$semi_1','$deg_1',0)";
								$x=mysql_query($reg_7);
								echo "<meta http-equiv='refresh' content='0;URL=index.php?view=admin&admin=1'>";
								}
						}
						mysql_close($con9);
						}

						// Modifying Registration by student
						
						if($task=='removereg'){
						
						$con7=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						
						// Remove Registration
						
						$query_1_4="delete from registration where id='$id' and student='$id_1'";
						echo$query_1_4;
						mysql_query($query_1_4);
						echo "<meta http-equiv='refresh' content='0;URL=index.php?view=admin&admin=1'>"; 
						}
						
						// Display Temporely Registration
						
						$con9=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
					//if($stlvl==1){
						$query1_2="select r.id, r.course, r.degree,r.confirm, c.name from registration r, call_registration cr, courseunit c where cr.acedemic_year=r.acedemic_year and (cr.semister=r.semister or r.semister='3') and r.course=c.code and r.student='$id_1'";
						if($semi_1==1){
						$query1_5="select sum(c.credits)from registration r, call_registration cr, courseunit c where cr.acedemic_year=r.acedemic_year and (cr.semister=r.semister or r.semister='3') and r.course=c.code and r.student='$id_1' and r.degree='1'";
								}
						else{
						$query1_5="select sum(c.credits)from registration r, call_registration cr, courseunit c where cr.acedemic_year=r.acedemic_year and cr.semister=r.semister and r.course=c.code and r.student='$id_1' and r.degree='1'";
						      }


						      /*	}
					else{
						$query1_2="select r.id, r.course, r.degree,r.confirm, c.name from registration r, call_registration cr, courseunit c where cr.acedemic_year=r.acedemic_year and (r.semister=2 or r.semister='3') and r.course=c.code and r.student='$id_1'";
						$query1_5="select sum(c.credits)from registration r, call_registration cr, courseunit c where cr.acedemic_year=r.acedemic_year and (r.semister=2 or r.semister='3') and r.course=c.code and r.student='$id_1' and r.degree='1'";

						}*/
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////

//.............................Edit by Iranga.......................................
					
						$reg_two=mysql_query($query1_5);
						$data=mysql_fetch_array($reg_two);
						$semecrdt=$data['sum(c.credits)'];
						echo"<div align='center'>";
						if($semecrdt!=null){
						echo "<b><font size='2'> You Have Register for <b><font color='red'>".$semecrdt;
						echo "</font></b> Credits for This Semester</font></b>";
									}
						$reg_once=mysql_query($query1_2);
						if(mysql_num_rows($reg_once)!=0){
						echo '<table border="1"  cellspacing=0><tr><th>Courses Code<th>Courses Name<th>Degree Status<th>Conf. Status<th>Remove</tr>';
						while($data=mysql_fetch_array($reg_once)){
							$temdiscos=$data['course'];
							////////////////////////////////////////////////////////////////////////////////////////
								$coursegetchr=trim($temdiscos);
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

								$temdiscos2=$ccdwoutcrd.$credit;
							////////////////////////////////////////////////////////////////////////////////////////
								////////////////////////////////////////////////////////
								$getchar = preg_split('//', $temdiscos2, -1);

								$midcredit=$getchar[5];
								if($midcredit=="b"){
									$getlob=explode('b',$temdiscos2);
										$fistprt=$getlob[0];
										$sectprt=$getlob[1];
										$fulcode=strtoupper($fistprt)."b".$sectprt;
														}

								elseif($midcredit=="B"){
									$getlob=explode('B',$temdiscos2);
										$fistprt=$getlob[0];
										$sectprt=$getlob[1];
										$fulcode=strtoupper($fistprt)."b".$sectprt;
														}
								else{
								$fulcode=strtoupper($temdiscos2);
								}
								////////////////////////////////////////////////////










						echo "<tr><td align=center>".$fulcode."<td>".ucfirst($data['name'])."<td align=center>";
							if(($data['degree'])==1)
								{echo "Degree";}
							elseif(($data['degree'])==2)
								{echo "<font color='red'>Non Degree";}
							else
								{echo "NN";}
						
						echo"<td align=center>";
							if(($data['confirm'])==1){
								echo"Confirmed";
										}
							else{echo"Not Confirmed";}

						    ////////////////////////////////////////////////////////////////////
							$quegtseme2="select semister from courseunit where code='$coursegetchr'";
							$qugtseme2=mysql_query($quegtseme2);
							$qgtseme2=mysql_fetch_array($qugtseme2);
								$cou_1seme2=$qgtseme2['semister'];

							///////////////////////////////////////////////////////////////////

						if(($cou_1seme2==3)&&($semi_1==2)){
						echo "<td align=center>Can not Remove</tr>";
						  }
						else{
						echo "<td align=center><a href=?view=admin&admin=1&task=removereg&id=".$data['id'].">Remove</a></tr>";
						      }
						}
						
						echo "</table>";
								}
//...................................................................................						
						
						} // End registration section
						
						
						elseif($reg_check==0){
						
						// After Registration subject display
						echo '<font color=#109010>Registered Subjects for '.$ac_1.' Academic year and Semester	'.$semi_1.' </font><br><br>';						
						$con5=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);
						$id_2=$_SESSION['user_id'];

////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
					//if($stlvl==1){
						$query1_3="select r.id, r. confirm, r.course, r.degree, c.name from registration r, courseunit c, call_registration cr where r.course=c.code and (cr.semister=r.semister or r.semister='3') and cr.acedemic_year=r.acedemic_year and r.student='$id_2'";
						$query1_4="select sum(c.credits) from registration r, courseunit c, call_registration cr where r.course=c.code and (cr.semister=r.semister or r.semister='3') and cr.acedemic_year=r.acedemic_year and r.student='$id_2'and r.confirm='1' and r.degree=1";
					/*		}

					else{
						$query1_3="select r.id, r. confirm, r.course, r.degree, c.name from registration r, courseunit c, call_registration cr where r.course=c.code and (r.semister=2 or r.semister='3') and cr.acedemic_year=r.acedemic_year and r.student='$id_2'";
						$query1_4="select sum(c.credits) from registration r, courseunit c, call_registration cr where r.course=c.code and (r.semister=2 or r.semister='3') and cr.acedemic_year=r.acedemic_year and r.student='$id_2'and r.confirm='1' and r.degree=1";
						}*/
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////
////////////0000000000000000000000000000000000000000000////////////////////////////////








						$reg_once=mysql_query($query1_3);
						$reg_four=mysql_query($query1_4);
                        if(mysql_num_rows($reg_once)!=0){
						while($data=mysql_fetch_array($reg_four)){
								$crsemcdt=$data['sum(c.credits)'];
								if($crsemcdt!=0){
									$crsemcdt2=$crsemcdt;
										}
								else{$crsemcdt2=0;}

						echo 'You Have registered for <b><font color="red">'.$crsemcdt2;
						echo '</font></b>(Confirm) Credits for This semester';
						}
						echo '<table border="0"><tr><th>Courses Code<th>Courses Name<th>Degree Status<th>Official Confirmation</tr>';
						while($data=mysql_fetch_array($reg_once)){
							$regcos=$data['course'];
							////////////////////////////////////////////////////////////////////////////////////////
								$coursegetchr=trim($regcos);
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

								$rehcoscode2=$ccdwoutcrd.$credit;
							////////////////////////////////////////////////////////////////////////////////////////
								////////////////////////////////////////////////////////
								$getchar = preg_split('//', $rehcoscode2, -1);

								$midcredit=$getchar[5];
								if($midcredit=="b"){
									$getlob=explode('b',$rehcoscode2);
										$fistprt=$getlob[0];
										$sectprt=$getlob[1];
										$fulcode2=strtoupper($fistprt)."b".$sectprt;
														}

								elseif($midcredit=="B"){
									$getlob=explode('B',$rehcoscode2);
										$fistprt=$getlob[0];
										$sectprt=$getlob[1];
										$fulcode2=strtoupper($fistprt)."b".$sectprt;
														}
								else{
								$fulcode2=strtoupper($rehcoscode2);
								}
								////////////////////////////////////////////////////






						echo "<tr class=trbgc><td align='center'>".$fulcode2."<td>".ucfirst($data['name'])."<td align='center'>";
						if(($data['degree'])==1)
							{echo "Degree";}
						elseif(($data['degree'])==2)
							{echo "Non Degree";}
						else {echo "NN";}
						echo"<td align='center'>";
						if(($data['confirm'])==0){
						echo '<font color="red">Not Confirmed</font>';
						}
						elseif(($data['confirm'])==1){
						echo "Confirmed";
						}
						echo "</tr>";
						}
						echo "</font></table>";
						}
                        else{
                            echo"<font color=red>Sorry! You are not register for course unit in this semester.</font>";
                        }
						mysql_close($con5);
	}

////////////////////////////////////////////////////////////////////////////////////////////////
}	///check level if

	else{
		echo '<br><font color="red"> Sorry!  This option is not available for you.</font>';

		}
////////////////////////////////////////////////////////////////////////////////////////////////
}

}///////////////chk special student if close bracket////////////////////
///////////////////////////////////////////////////////////////////////////////////
/////////////////////////////// if end genaral student/////////////////////////////
///////////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////special student //////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else{
echo "Special Course Registration Unit <hr class=bar>";
//echo$stspsub;
    $trgspsub=$stspsub."_sp";
    
    $quegetspstat="select csr.end_date, csr.status, csr.academic_year, csr.semester 
        from 
                sp_call_registration csr, 
                student s, 
                sp_student_levels slv, 
                sp_academic_status sac 
        where 
            s.id='$stno' 
            and s.year=slv.reg_year 
            and slv.department='$stspsub' 
            and slv.level=sac.level 
            and sac.department=slv.department
            and sac.department=csr.department 
            and sac.academic_year=csr.academic_year 
            and sac.level=csr.level"; 
    
    //echo$quegetspstat;
    $qugetspstat=mysql_query($quegetspstat);
    if(mysql_num_rows($qugetspstat)!=0){
        while($qgetspstat=mysql_fetch_array($qugetspstat)){
                $end_date=$qgetspstat['end_date'];
                $status=$qgetspstat['status'];
                $academic_year2=$qgetspstat['academic_year'];
                $semester2=$qgetspstat['semester'];
               
                    $_SESSION['sp_ac_year']= $academic_year2;   
                    $_SESSION['sp_semester']=$semester2;
               
                $academic_year=$_SESSION['sp_ac_year'];
                $semester=$_SESSION['sp_semester'];
           // echo$end_date.$status;
        }
        
        
    }else{
        echo"<font color=red>Sorry! Cannot find special call registration status</font>";
        
    }
    
  ///////////////////////////////////////////////////////////////////////////
  /////////////////// sp_registration on/////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////
   if($status==1){    
    
    $quegetspsub="select cu.code, cu.name, cu.credits, cu.core, cu.type, cu.requirment from courseunit cu, target_group tg where tg.target_id=cu.target_group and tg.subject='$trgspsub' order by cu.code";
    //echo$quegetspsub;
    $qugetspsub=mysql_query($quegetspsub);
    if(mysql_num_rows($qugetspsub)==0){
        echo"<font color=red>Sorry! Cannot find Course Units";
    }
    else{
        
        echo"<font size=3px><b>Special Degree Course Registration Unit of ".strtoupper($stspsub)." Subject</b></font><br>";
        
        echo"Registration of $academic_year Academic Year and Semester $semester</br>";
        
        echo"Do Modification of Registration on or Before : <font color=red>$end_date</font><br>";
        
        echo"<table border=0 align=center><tr><td>You have registered for<td>&nbsp;&nbsp;<font color=red><div id='spcdcut'>";
        /////////////////////////////get currnt cdt val///////////////////////
        $quegetcdcunt="select sum(c.credits)from registration r, courseunit c where r.acedemic_year='$academic_year' and (r.semister=$semester or r.semister='3') and r.course=c.code and r.student='$stno' and r.degree='1' and r.confirm=1";
        //echo$quegetcdcunt;
        $qugetcdcunt=mysql_query($quegetcdcunt);
        $qgetcdcunt=mysql_fetch_array($qugetcdcunt);
        $getcdcunt=$qgetcdcunt['sum(c.credits)'];
        
        if($getcdcunt==NULL){
            echo"0";
        }
        else{
            
            echo$getcdcunt;
        }
       
        //////////////////////////////////////////////////////////////////////
        echo"</div></font>&nbsp;&nbsp;<td>confirmed credits for this semester</td></tr></table>";
        
        echo '<table border="0" align="center" width=99%>';
        echo"<th width=10%>Course Unit<th width=30%>Course name<th width=15%>Degree Status<th>Prerequisites<th width=15%>Current Status<th width=15%>Submit as";
        while($qgetspsub=mysql_fetch_array($qugetspsub)){
            $code=$qgetspsub['code'];
            ////////////////////////////////////////////////////////////////////////////////////////
                                $coursegetchr=trim($code);
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

                                $rehcoscode2=$ccdwoutcrd.$credit;
                            ////////////////////////////////////////////////////////////////////////////////////////
                                ////////////////////////////////////////////////////////
                                $getchar = preg_split('//', $rehcoscode2, -1);

                                $midcredit=$getchar[5];
                                if($midcredit=="b"){
                                    $getlob=explode('b',$rehcoscode2);
                                        $fistprt=$getlob[0];
                                        $sectprt=$getlob[1];
                                        $fulcode2=strtoupper($fistprt)."b".$sectprt;
                                                        }

                                elseif($midcredit=="B"){
                                    $getlob=explode('B',$rehcoscode2);
                                        $fistprt=$getlob[0];
                                        $sectprt=$getlob[1];
                                        $fulcode2=strtoupper($fistprt)."b".$sectprt;
                                                        }
                                else{
                                $fulcode2=strtoupper($rehcoscode2);
                                }
                                ////////////////////////////////////////////////////
            
            
            
            
            
            $name=$qgetspsub['name'];
            $credits=$qgetspsub['credits'];
            $core=$qgetspsub['core'];
            $requirment=$qgetspsub['requirment'];
            $type=$qgetspsub['type'];
            
           //echo$code.$name.$credits.$core.$type;
         //////////////////////////////////////check allready reg/////////////////////////////////////// 
           $quechkalreg="select * from registration where student='$stno' and course='$coursegetchr' and acedemic_year='$academic_year'";
           $quchkalreg=mysql_query($quechkalreg);
           if(mysql_num_rows($quchkalreg)==0){     
         ///////////////////////////////////////////////////////////////////////////////////////////////
      
           
           echo"<tr class=trbgc align=center><td>$fulcode2<td align=left>".ucfirst($name)."<td>";
           
           echo"<select id=spdg$coursegetchr>";
          
           if($core=="op"){
                        echo"<option value=1 selected>Degree</option>";
                        echo"<option value=2>Non Degree</option>";
            }
           else{
                        echo"<option value=1 selected>Degree</option>";
                  }
           echo"</select>";
           
           echo"<td align=left>&nbsp;&nbsp;".ucfirst($requirment);
           
           
          echo"<td colspan=2 >";
             echo"<div align='center' id='did$coursegetchr'>";
                echo"<table border=0 width=100%><tr><td width=55% align=center>";
                      echo"<font color=red>Not Register</font>";
                echo"<td>";
                      echo "<img style='visibility: hidden' id='ldr$coursegetchr' src='./images/ajax-loader.gif'>";
             
                      echo"<input type=\"button\" value=\"Register\"  onclick=\"spregister('$stno','$coursegetchr','$academic_year')\"></tr>";   
                echo"</table>";
             echo"</div></td>";
                    }
        else{
                while($qchkalreg=mysql_fetch_array($quchkalreg)){
                    $id=$qchkalreg['id'];
                    $semister=$qchkalreg['semister'];
                    $degree=$qchkalreg['degree'];
                    $confirm=$qchkalreg['confirm'];
                    if($confirm==1){
                        $confirm2="- Confirmed";
                    }
                    else{
                         $confirm2="- Not Confirmed";
                    }
                    
                }
                
             echo"<tr class=selectbg4 align=center><td>$fulcode2<td align=left>".ucfirst($name)."<td>"; 
             
             echo"<select id=spdg$coursegetchr>";
           if($core=="op"){
           if($degree==1){
                        echo"<option value=1 selected>Degree</option>";
                        echo"<option value=2>Non Degree</option>";
            }
           else{
                        echo"<option value=1>Degree</option>";
                        echo"<option value=2 selected>Non Degree</option>";
                  }
           
           }
           else{
               echo"<option value=1 selected>Degree</option>";
           }
           echo"</select>";
             
             
             
             
               
             
                 echo"<td align=left>&nbsp;&nbsp;".ucfirst($requirment);
                 
                 
        
         echo"<td colspan=2 class=selecttdbg>";
             echo"<div align='center' id='did$coursegetchr'>";
                echo"<table border=0 width=100%><tr><td width=55% align=center>";
                      echo"<font color=blue>Register ".$confirm2."</font>";
                echo"<td>";
                      echo "<img style='visibility: hidden' id='ldr$coursegetchr' src='./images/ajax-loader.gif'>";
             
                    echo"<td><input type=\"button\" value=\"Cancel\"  onclick=\"spregcnl('$id','$stno','$coursegetchr','$academic_year')\"></tr>";      
                echo"</table>";
             echo"</div></td>";
                       
        
        }
            
        }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////genaral course for sp student //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<tr><td colspan=6>&nbsp;</tr>";



       $quegetstoldcmb="select combination from request_combination where stno='$stno' and status='Confirmed'";
        $qugetstoldcmb=mysql_query($quegetstoldcmb);
        if(mysql_num_rows($qugetstoldcmb)!=0){
            while($qgetstoldcmb=mysql_fetch_array($qugetstoldcmb)){
                $stoldcmbfmrcmb2=$qgetstoldcmb['combination'];
            }
            $stoldcmbfmrcmbexp=explode("/",$stoldcmbfmrcmb2);
            
            $stoldcmbfmrcmb=$stoldcmbfmrcmbexp[1];
        }
        else{
            $stoldcmbfmrcmb="0";
        }


$quereggencos="select c.code, c.name ,c.requirment,c.core from courseunit c, combination o, target_group t where o.id=$stoldcmbfmrcmb and o.subject=t.subject and t.target_id=c.target_group and (c.core='co' or c.core='op') and (c.level=2 or c.level=3)  and (c.semister=$semester or c.semister=3) and c.availability=1 order by c.code";
//echo$quereggencos;
$qureggencos=mysql_query($quereggencos);
if(mysql_num_rows($qureggencos)!=0){
echo"<tr><td colspan=6 align=center><font size=3px>Genaral Degree Course Unit for Registrations</font></tr>";
echo"<th>Course Unit<th>Course name<th>Degree Status<th>Prerequisites<th>Current Status<th>Submit as";                    
       while($qreggencos=mysql_fetch_array($qureggencos)){
               
               $spgencode=trim($qreggencos['code']);
               
               $quechkprereg="select id from registration where student='$stno' and course='$spgencode' and acedemic_year<>'$academic_year'";
               //echo$quechkprereg;
               $quchkprereg=mysql_query($quechkprereg);
               if(mysql_num_rows($quchkprereg)==0){ /////////////////////%%%%%%%%%%%%%%%%%%%%%%%%%%%%%////////////////           
               
               
               
               
               /////////////////////**********************************************///////////////////////////////
               /////////////////////**********************************************///////////////////////////////
               /////////////////////**********************************************///////////////////////////////
               ////////////////////////////////////////////////////////////////////////////////////////
                                
                                $ccdwoutcrd=substr("$spgencode", 0, -1);
                                $getchar = preg_split('//', $spgencode, -1);

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

                                $rehcoscode2=$ccdwoutcrd.$credit;
                            ////////////////////////////////////////////////////////////////////////////////////////
                                ////////////////////////////////////////////////////////
                                $getchar = preg_split('//', $rehcoscode2, -1);

                                $midcredit=$getchar[5];
                                if($midcredit=="b"){
                                    $getlob=explode('b',$rehcoscode2);
                                        $fistprt=$getlob[0];
                                        $sectprt=$getlob[1];
                                        $fulcodeall=strtoupper($fistprt)."b".$sectprt;
                                                        }

                                elseif($midcredit=="B"){
                                    $getlob=explode('B',$rehcoscode2);
                                        $fistprt=$getlob[0];
                                        $sectprt=$getlob[1];
                                        $fulcodeall=strtoupper($fistprt)."b".$sectprt;
                                                        }
                                else{
                                $fulcodeall=strtoupper($rehcoscode2);
                                }
                                ////////////////////////////////////////////////////
               
               /////////////////////**********************************************///////////////////////////////
               /////////////////////**********************************************///////////////////////////////
               /////////////////////**********************************************///////////////////////////////
               $spgenname=$qreggencos['name'];
               $spgenrequirment=$qreggencos['requirment'];
               $spgencore=$qreggencos['core'];
               
               
               
           //////////////////////////////////////check allready reg/////////////////////////////////////// 
           $quechkalreg2="select * from registration where student='$stno' and course='$spgencode' and acedemic_year='$academic_year'";
           $quchkalreg2=mysql_query($quechkalreg2);
           if(mysql_num_rows($quchkalreg2)==0){     
         ///////////////////////////////////////////////////////////////////////////////////////////////
               
              echo"<tr class=trbgc align=center><td>$fulcodeall<td align=left>".ucfirst($spgenname)."<td>"; 
              
                 echo"<select id=spdg$spgencode>";
                        echo"<option value=1 selected>Degree</option>";
                        echo"<option value=2>Non Degree</option>";
                 echo"</select>";
             echo"<td align=left>&nbsp;&nbsp;".ucfirst($spgenrequirment);
             
                echo"<td colspan=2 >";
                echo"<div align='center' id='did$spgencode'>";
                echo"<table border=0 width=100%><tr><td width=55% align=center>";
                      echo"<font color=red>Not Register</font>";
                echo"<td>";
                      echo "<img style='visibility: hidden' id='ldr$spgencode' src='./images/ajax-loader.gif'>";
             
                      echo"<input type=\"button\" value=\"Register\"  onclick=\"spregister('$stno','$spgencode','$academic_year')\"></tr>";   
                echo"</table>";
                echo"</div></td>";
           
           
           }
            else{
                 while($qchkalreg2=mysql_fetch_array($quchkalreg2)){
                    $id2=$qchkalreg2['id'];
                    $semister2=$qchkalreg2['semister'];
                    $degree2=$qchkalreg2['degree'];
                    $confirm2=$qchkalreg2['confirm'];
                    if($confirm2==1){
                        $confirm22="- Confirmed";
                    }
                    else{
                         $confirm22="- Not Confirmed";
                    }
                    
                }
        
        
        
                echo"<tr class=selectbg4 align=center><td>$fulcodeall<td align=left>".ucfirst($spgenname)."<td>"; 
             
             echo"<select id=spdg$spgencode>";
           if($core=="op"){
           if($degree==1){
                        echo"<option value=1 selected>Degree</option>";
                        echo"<option value=2>Non Degree</option>";
            }
           else{
                        echo"<option value=1>Degree</option>";
                        echo"<option value=2 selected>Non Degree</option>";
                  }
           
           }
           else{
               echo"<option value=1 selected>Degree</option>";
           }
           echo"</select>";
             
             
             
             
               
             
                 echo"<td align=left>&nbsp;&nbsp;".ucfirst($spgenrequirment);
                 
                 
        
         echo"<td colspan=2 class=selecttdbg>";
             echo"<div align='center' id='did$spgencode'>";
                echo"<table border=0 width=100%><tr><td width=55% align=center>";
                      echo"<font color=blue>Register ".$confirm22."</font>";
                echo"<td>";
                      echo "<img style='visibility: hidden' id='ldr$spgencode' src='./images/ajax-loader.gif'>";
             
                    echo"<td><input type=\"button\" value=\"Cancel\"  onclick=\"spregcnl('$id2','$stno','$spgencode','$academic_year')\"></tr>";      
                echo"</table>";
             echo"</div></td>";
                       
      
             }
            
           
           
           
           }/////////////////////%%%%%%%%%%%%%%%%%%%%%%%%%%%%%////////////////  
         
       }  //gencoslist if clase       
            
        
    
}
else{
    echo"<font color=red>Sorry! Cannot find course units.</font>";
}







/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////end genaral course for sp student //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       echo"</table>";
        
        
    }
    }
  ///////////////////////////////////////////////////////////////////////////
  /////////////////// sp_registration on end ////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////
   else{
       //echo"call registration closed";
       echo"Registered Course Units for $academic_year Academic year and Semester $semester<br>";
       /////////////////////////////get currnt cdt val///////////////////////
        $quegetcdcunt="select sum(c.credits)from registration r, courseunit c where r.acedemic_year='$academic_year' and (r.semister=$semester or r.semister='3') and r.course=c.code and r.student='$stno' and r.degree='1' and r.confirm=1";
        //echo$quegetcdcunt;
        $qugetcdcunt=mysql_query($quegetcdcunt);
        $qgetcdcunt=mysql_fetch_array($qugetcdcunt);
        $getcdcunt=$qgetcdcunt['sum(c.credits)'];
        echo"<br><font color=blue size=3px>You have registered &nbsp;<font color=red>";
        if($getcdcunt==NULL){
            echo"0";
        }
        else{
            
            echo$getcdcunt;
        }
        echo"</font>&nbsp;(confirmed) credits in this semester </font><br>";
        
        
        
        
           $quechkalregcls="select r.course, c.name, r.degree, r.confirm from registration r, courseunit c where  r.student='$stno' and r.acedemic_year='$academic_year' and (r.semister=$semester or r.semister='3') and r.course=c.code";
           $quchkalregcls=mysql_query($quechkalregcls);
           if(mysql_num_rows($quchkalregcls)==0){
               echo"<br><font color=red>Sorry! You have not register for any course unit in this semester.</font><br>";
           }
           else{
               echo"<table><th>Course Code<th>Course Name<th>Degree Status<th>Official Confirmation";
               while($qchkalregcls=mysql_fetch_array($quchkalregcls)){
                              $course=$qchkalregcls['course']; 
                              $coursegetchral=trim($course);
                                $ccdwoutcrd=substr("$coursegetchral", 0, -1);
                                $getchar = preg_split('//', $coursegetchral, -1);

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

                                $rehcoscode2=$ccdwoutcrd.$credit;
                            ////////////////////////////////////////////////////////////////////////////////////////
                                ////////////////////////////////////////////////////////
                                $getchar = preg_split('//', $rehcoscode2, -1);

                                $midcredit=$getchar[5];
                                if($midcredit=="b"){
                                    $getlob=explode('b',$rehcoscode2);
                                        $fistprt=$getlob[0];
                                        $sectprt=$getlob[1];
                                        $fulcode21=strtoupper($fistprt)."b".$sectprt;
                                                        }

                                elseif($midcredit=="B"){
                                    $getlob=explode('B',$rehcoscode2);
                                        $fistprt=$getlob[0];
                                        $sectprt=$getlob[1];
                                        $fulcode21=strtoupper($fistprt)."b".$sectprt;
                                                        }
                                else{
                                $fulcode21=strtoupper($rehcoscode2);
                                }
                                ////////////////////////////////////////////////////
                              
                                          
                              $name=$qchkalregcls['name'];         
                              $degree=$qchkalregcls['degree'];
                                if($degree==1){
                                    $degree2="Degree";
                                }
                                else{
                                    $degree2="<font color=red>Non Degree</font>";
                                }
                              
                                   
                              $confirm=$qchkalregcls['confirm']; 
                           
                                if($confirm==1){
                                    $confirm2="Confirmed";
                                }
                                else{
                                    $confirm2="<font color=red>Not Confirmed</font>";
                                }
                           
                           
                           
                           echo"<tr class=trbgc align=center><td>$fulcode21<td align=left>&nbsp;".ucfirst($name);
                           
                           echo"<td>$degree2<td>$confirm2";
                       
                   
               }
               
               
               
               
               
               echo"</table>";
           }
       
       
       
   }




}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////end special student /////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////










//..........Edit by Iranga..................	
//..........Print All course unit that students were register.........
$conIR=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

$id_1=$_SESSION['user_id'];
echo "<br><br><hr class=bar>";




echo 'All Course Units That You Are Registered Up Today</font><br>';
echo "<hr class=bar><br>";

//echo"<font color='red'>* * * Important: The below values are shown only for course units that have been confirmed by the faculty since the Second Semester of 2010_2011 Academic year.</font><br>";

$tot_c="select sum(c.credits) from registration r, courseunit c where student='$id_1'and r.course=c.code and r.degree='1' and r.confirm='1'";
$tot=mysql_query($tot_c);

while($t=mysql_fetch_array($tot)){
$alstcdt=$t['sum(c.credits)'];

}
if($alstcdt==NULL){
$alstcdt=0;
}

echo '<table border=0><tr><td><font color="blue" size="3">You have registered <td><font color="red" size="3">';
////////////////////////////gen st////////////////////////////////    
if($stspsub=="General Student"){
    echo$alstcdt;
}
//////////////////////////////sp st///////////////////////////////
else{
echo"<div id='allcdcut'>";
   echo$alstcdt;  
echo"</div>";    
}
//////////////////////////////////////////////////////////////////
echo '</font></b><td><font color="blue" size="3">(Confirmed) Credits </b></font>';

echo"</tr></table>";

$que_All_CU="select r.confirm, r.course, r.degree, c.name from registration r, courseunit c where student='$id_1'and r.course=c.code order by r.acedemic_year,r.semister,r.course";
$all_course=mysql_query($que_All_CU);
if(mysql_num_rows($all_course)!=0){

echo '<table border="0"><tr><th>Course Code<th>Course Name<th>Degree Status<th>Official Confirmation</tr>';
while($ac=mysql_fetch_array($all_course)){
$allcose=$ac['course'];
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




echo "<tr class=trbgc><td align='center'>".$fulcode3."<td>".ucfirst($ac['name'])."<td align='center'>";
if(($ac['degree'])=='1')
{echo "Degree ";} 
elseif(($ac['degree'])=='2')
{echo '<font color="red">Non Degree </font>';}
else{echo "Not Define";}
echo"<td align='center'>"; 
if(($ac['confirm'])==1){
echo "Confirmed";
}
	elseif(($ac['confirm'])==0){
		echo '<font color="red">Not Confirmed</font>';
				}
						
echo "</tr>";
}
echo "</table>";

}

mysql_close($conIR);
//.........................................................

		




				
						
						
?>
