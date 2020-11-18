<?php
//error_reporting(0);
session_start();
if((($_SESSION['login'])=="truefohssmis")&&($_SESSION['role']!="student")){

include'../connection/connection.php';

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

$quepers="SELECT id FROM permission WHERE role_id=$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
    
if($qpers['id']=="47"){
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

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
@media print {
input#btnPrint {
display: none;
}
}
</style>
<style type="text/css">
@import url('../css/blackfont.css');
</style>




<?php

	require_once('../classes/attClass.php');
	require_once('../classes/globalClass.php');		
	
	$m=new attendence();
	$n=new settings();	
///////////////////////////////// theory and practical course unit///////////////////////////////////////////
$tnpcourse=array();
$tnpcourse[0]="COM311B";
$tnpcourse[1]="COM212B";
$tnpcourse[2]="COM213A";
$tnpcourse[3]="COM112B";
$tnpcourse[4]="COM113A";
$tnpcourse[5]="CSC1113";
$tnpcourse[6]="CSC2113";
$tnpcourse[7]="CSC2123";
$tnpcourse[8]="CSC2133";
$tnpcourse[9]="CSC2143";
$tnpcourse[10]="ZOO3112";
$tnpcourse[11]="ZOO3272";
$tnpcourse[12]="ZOO3192";
$tnpcourse[13]="ZOO3152";
$tnpcourse[14]="ZOO3182";
$tnpcourse[15]="ZOO3122";

$tnpcourse[16]="COM121B";
$tnpcourse[17]="COM122B";
$tnpcourse[18]="CSC1213";
$tnpcourse[19]="CSC1223";
$tnpcourse[20]="COM221B";
$tnpcourse[21]="COM222B";
$tnpcourse[22]="CSC2213";
$tnpcourse[23]="CSC2263";
$tnpcourse[24]="CSC2233";
$tnpcourse[25]="CHE321B";
$tnpcourse[26]="CHE322B";
$tnpcourse[27]="FSC224A";
$tnpcourse[28]="PHY3242";
$tnpcourse[29]="PHY3282";
$tnpcourse[30]="ZOO2242";
$tnpcourse[31]="ZOO2232";
$tnpcourse[32]="ZOO3202";
$tnpcourse[33]="ZOO3222";
$tnpcourse[34]="ZOO3232";
$tnpcourse[35]="ZOO3252";
$tnpcourse[36]="ZOO3282";

////////////////////////////////////////////////////////////////////////////////////////////////////////////

echo"<div id=c>";
echo"<table border='0' width='100%'><tr><td align='left' valign='top'>";
echo"<form method='POST' action='../index.php?view=admin&admin=47'>";
echo"<input type='submit' value='Back' id='btnPrint'>";
echo"</form>";
echo"</td><td align='right' valign='top'>";
echo "<input type='button' id='btnPrint' onclick='window.print();' value='Print Page' /></td></tr></table>";



$task=$_GET['task'];
$onestyr=$_POST['byear'];
$onestno=$_POST['exstno'];
$gplevel=$_POST['admission'];

if($gplevel=="Admissions of Pass out Student"){
$gplevel="Admissions of Level-0";
					}

if($gplevel=="Admissions of Special Degree Student"){
$gplevel="Admissions of Level-SP";
					}

//echo$onestyr.$onestno.$gplevel.$task;

include'../admin/config.php';
mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

//...............get acc_year....................
$acy=$n->getAcc();
//.................................................			



//...........get semester..........
$cseme=$n->getSemister();
//.................................................		



error_reporting(0);
$ye=date('Y');


if($task=="oneadd"){

$quecknum="select batch, length(stream) as stlng from student where id='$onestno'";
$qucknum=mysql_query($quecknum);
if(mysql_num_rows($qucknum)!=0){
$qcknum=mysql_fetch_array($qucknum);
	$stbyear=$qcknum['batch'];
	$ststrmlng=$qcknum['stlng'];

	if($stbyear==$onestyr){

		if($ststrmlng==3){
			$examname="Bachelor of Science Genaral Degree Level I,II & III (Semester $cseme) Examination";
					}
		else{
			$examname="Bachelor of Science Special Degree Level I & II (Semester $cseme) Examination";
			}

		//echo"SC/$onestyr/$onestno";
		$admisid=$onestno;
		//echo$admisid."<br>";

		$stleve=$n->getLevel($admisid);
/////////////////..........................................................////////////////////////////////
		
$queckexreg="select course from exam_registration where acedemic_year='$acy' and semester=$cseme and student='$admisid'";
		$quckexreg=mysql_query($queckexreg);
		if(mysql_num_rows($quckexreg)!=0){
			//echo"student ".$admisid."<br>";
			while($qckexreg=mysql_fetch_array($quckexreg)){
				$excocode=$qckexreg['course'];
				$qulisub="noqlsub";
				$ntelisub="noelsub";
				$practgp=$m->getprctgp($admisid,$excocode,$acy);
				//echo$excocode."{";
				///////////////////////////////check repeate course/////////////////////////////////////////////
				$quegetcolslvl="select level from courseunit where code='$excocode'";
				$qugetcolslvl=mysql_query($quegetcolslvl);
				$qgetcolslvl=mysql_fetch_array($qugetcolslvl);
				$cslvl=$qgetcolslvl['level'];
					//$char_buff = preg_split('//', $excocode, -1);
					//$forthchr=$char_buff[4];			
				//echo$forthchr."---".$stleve."==";
				if($cslvl==$stleve){//////////////////////////////////////////////////////////////////////////




				$quegtlecids="select distinct(type) from lecture where course='$excocode' and acc_year='$acy'";
				//echo$quegtlecids;
				$qugtlecids=mysql_query($quegtlecids);
				if(mysql_num_rows($qugtlecids)!=0){
				$type="nil";
					$totalall=$m->getTotalAll($excocode, $admisid, $acy);/////////no of total participation lecture hourse/////////////////
					$alllechs=$m->getSubTotalAll($excocode, $acy,$practgp);/////////no of total lecture hourse/////////////////
					

					$topsg=($totalall/$alllechs)*100;
					$totprs=round($topsg);
					//echo"all ac ses".$alllechs."---";
					//echo"tot party ".$totalall.":::::tot persentage= ".round($topsg)."% <br>";	
						while($qgtlecids=mysql_fetch_array($qugtlecids)){
							$gtlecttp=$qgtlecids['type'];
								if($gtlecttp!=$type){
									if(($gtlecttp=="field")||($gtlecttp=="assignment")){
										continue;
										}
									else{

									$total=$m->getTotal($excocode, $admisid, $gtlecttp, $acy);
									$ctotal=$m->getSubTotal($excocode, $gtlecttp, $acy,$practgp);
									$cutofmrk=$m->getMax($excocode, $gtlecttp, $acy);
										if($cutofmrk=="nd"){
											$cutofmrk=80;
													}
										$ctm=round($cutofmrk);

										if($cutofmrk!="nd"){

										//echo"tot $gtlecttp hs=".$ctotal."---";
										//echo"prt $gtlecttp hs=".$total.":::::";
										//echo"cut of mrk=".round($cutofmrk)."% +++++";
										$perpsg=($total/$ctotal)*100;
										$pest=round($perpsg);
											//echo" Current Persentage= ".round($perpsg)."% }";
											$type=$gtlecttp;
												if(($totprs!=0)&&($ctm<=$pest)){
													//echo"<font color=blue>OK Print Admisstion $totprs %</font><br>";
													$qulisub=$excocode;
													
														}
												else{
													if($gtlecttp=="practical"){
														$fulpermi="no";
														
																	}
													//echo"<font color=red>Not Eligibility $totprs %</font><br>";
													$ntelisub=$excocode;
													}




											}

										}
											}
												}
						if(($qulisub==$excocode)&&($qulisub!=$ntelisub)&&($fulpermi!="no")){
							//echo"<font color=blue>{---------Qulified ".$qulisub."------$ntelisub---}</font>";
							$queupexcm1="update exam_registration set confirm=1 where student='$admisid' and course='$qulisub' and acedemic_year='$acy' and semester=$cseme";
							//echo$queupexcm1;
							mysql_query($queupexcm1);


									}
						else{
							//echo"<font color=red>{---------Not Qulified ".$ntelisub."---------}</font>";
							
								$queel="select confirm from exam_registration where student='$admisid' and course='$ntelisub' and acedemic_year='$acy' and semester=$cseme";
								$quel=mysql_query($queel);
								$qel=mysql_fetch_array($quel);
								$el=$qel['confirm'];
								
								if($el!="1"){
							$queupexcm2="update exam_registration set confirm=2 where student='$admisid' and course='$ntelisub' and acedemic_year='$acy' and semester=$cseme";
							//echo$queupexcm2;
							mysql_query($queupexcm2);
										}

							
							}
						
						


					//echo"<br>";

									}
				else{
					//echo"not define}<br>";	
					continue;
					}

		
				
								}//repete chk if
							else{
								/*$queupexcm2="update exam_registration set confirm=1 where student='$admisid' and course='$excocode' and acedemic_year='$acy' and semester=$cseme";
							echo$queupexcm2;
							mysql_query($queupexcm2);*/

								continue;
								}





									}////////////////exam reg sta gen que if clos
//.................................................
			

//.................................................






/////////////////..........................................................////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////
			

			$name=$n->getName($admisid);
			$batch=$n->getBatch($admisid);
			echo'<p style="page-break-after: always">';
			//echo"<font color='black' size='2px'>";

			echo"<table border='1' align='center' width='842px' cellspacing='0' cellpadding='0' bordercolor=#030000'><tr><td>";
		///////////////////START ADMISSION///////////////////////////////

			/////////////////////////////////////////////admission header////////////////////////////////////////////////
			echo"<table border=0 width='838px'>";
			echo"<tr><td colspan=4>&nbsp;</td></tr>";
			echo"<tr><td colspan=2 height='100px' align='center' valign='middel' width='50%' ><font size='5px'>රුහුණ විශ්වවිද්‍යාලය<br>University of Ruhuna
</font><br><font size='3px'>විද්‍යා පීඨය<br>Faculty of Science</font></td>";


			echo"<td colspan=2  width='50%'><table border='1' align='right'  cellspacing='0' cellpadding='0' bordercolor=#030000'><tr><td valign='middel'><table boder='0'><tr><td> විභාග අංකය<br>Index No</td><td> <image border='0' src='../images/bract.gif' ></td><td>
SC/$batch/$admisid&nbsp;</td></tr></table></td></tr></table>";

			
			echo"<tr><td colspan=4 height='30px' align='center' valign='middel'><font size='5px'>විභාග ප්‍රවේශ පත්‍රය<br>Examination Admission Card</font></td></tr>";


			
			echo"<tr><td colspan=3><table border='0'><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; පරීක්ෂණය<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Examination</td><td><image border='0' src='../images/bract.gif' ></td><td>$examname</td></tr></table></td>";


			echo"<td width='30%'><table border='0'><tr><td>වර්ෂය<br>Year</td><td><image border='0' src='../images/bract.gif' ></td><td>$ye</td></tr></table></td></tr>";


			echo"<tr><td colspan=4><table border='0'><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; අපේක්ෂකයාගේ නම<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Name of Candidate
</td><td><image border='0' src='../images/bract.gif' ></td><td>$name</td></tr></table></td>";

	
			
			echo"<tr><td colspan=4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ඉහත අපේක්ෂකයා පෙනී සිටීමට සුදුසුකම් ලබන පාඨමාලා ඒකක පහත වගුවේ දැක්වේ<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The Course Units that the above candidate qualifies to sit are mentioned over –leaf.
</td></tr>";

			
			echo"<tr><td colspan=4>&nbsp;</td></tr>";
			echo"<tr><td colspan=3>&nbsp;</td><td>ජ්‍යෙෂ්ඨ සහකාර ලේඛකාධිකාරී(විද්‍යා)<br>Senior Assistant Registrar (Science)
</td></tr>";
			echo"<tr><td colspan=4><hr></td></tr>";
			/////////////////////////////////////////////////////////////////////////////////////////////////
			///////////////////////////////admission body/////////////////////////////////////////////////////
			echo"<tr><td colspan=4>";

			
			//;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
			echo"<table border='1' align='center'  cellspacing='0' cellpadding='0' bordercolor=#030000'>";
			echo"<tr><td width='3%'>&nbsp;</td><td width='14%' align='center'>පාඨමාලා ඒකකය<br>Course Unit</td><td width='25%' align='center'>පාඨමාලා නාමය<br>Course Name</td><td width='10%' align='center'>දිනය<br>Date</td><td width='18%' align='center'>අපේක්ෂකයාගේ අත්සන<br>Signature of Candidate</td><td width='18%' align='center'>නිරීක්ෂකයාගේ අත්සන<br>Signature of Invigilator</td><td width='12%' align='center'>තත්වය<br>Status</td></tr>";
			

			$queprtadm="select er.course, er.degree, er.confirm, c.name from exam_registration er, courseunit c  where er.acedemic_year='$acy' and er.semester=$cseme and er.student='$admisid' and er.course=c.code order by er.course";
			$quprtadm=mysql_query($queprtadm);
			$rows=0;
			$xidx=0;
			$creaxmrg=array();
			while($qprtadm=mysql_fetch_array($quprtadm)){
			$course3=$qprtadm['course'];
			$course2=trim($course3);
			$courseUPC=strtoupper($course2);
				$creaxmrg[$xidx]=$courseUPC;
				$xidx++;
				////////////////////////////////////////////////////////////////////////////////////////
                                $coursegetchr=trim($course3);
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

					$course=$fulcode;

			$degree=$qprtadm['degree'];
			$confirm=$qprtadm['confirm'];
			if($confirm==1){
				$confirm1="EL";	
					}
			elseif($confirm==2){
				$confirm1="NE";	
					}
			else{
				$confirm1="NC";
				}



			$name=$qprtadm['name'];
			$rows=$rows+1;

			if (in_array($courseUPC, $tnpcourse)) {

			echo"<tr height='25px'><td align='center'>$rows<td>&nbsp;&nbsp;$course (T)<td>$name - (Theory)<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;&nbsp;$confirm1</tr>";
			$rows=$rows+1;
			echo"<tr height='25px'><td align='center'>$rows<td>&nbsp;&nbsp;$course (P)<td>$name - (Practical)<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;&nbsp;$confirm1</tr>";

								}
			else{
			echo"<tr height='25px'><td align='center'>$rows<td>&nbsp;&nbsp;$course<td>$name<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;&nbsp;$confirm1</tr>";
				}
			}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////==========================================//////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////check cos reg//////////////////////////////////
			if($cseme==1){
			$quechkcsregfoadm="select r.course, c.name from registration r, courseunit c where r.acedemic_year='$acy' and r.semister=$cseme and r.student='$admisid' and r.confirm=1 and r.course=c.code order by r.course";
					}
			else{
			$quechkcsregfoadm="select r.course, c.name from registration r, courseunit c where r.acedemic_year='$acy' and (r.semister=$cseme or r.semister=3) and r.student='$admisid' and r.confirm=1 and r.course=c.code order by r.course";
				}
			$quchkcsregfoadm=mysql_query($quechkcsregfoadm);
			if(mysql_num_rows($quchkcsregfoadm)!=0){
				while($qchkcsregfoadm=mysql_fetch_array($quchkcsregfoadm)){
						$chkcsregfoadm=trim($qchkcsregfoadm['course']);
							$chkcsregfoadmUPC=strtoupper($chkcsregfoadm);
				////////////////////////////////////////////////////////////////////////////////////////
                                $ccdwoutcrd=substr("$chkcsregfoadm", 0, -1);
                                $getchar = preg_split('//', $chkcsregfoadm, -1);

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
                                        $fulcodeNA=strtoupper($fistprt)."b".$sectprt;
                                                        }
                                else{
                                $fulcodeNA=strtoupper($temdiscos2);
                                }
                                ////////////////////////////////////////////////////

					$NAcourse=$fulcodeNA;
						$chkcsnameregfoad=ucfirst($qchkcsregfoadm['name']);
							
						if(!in_array($chkcsregfoadmUPC, $creaxmrg)){
							$rows=$rows+1;

			////////////////////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
							if (in_array($chkcsregfoadmUPC, $tnpcourse)) {

								echo"<tr height='25px'><td align='center'>$rows<td>&nbsp; * $NAcourse (T)<td>$chkcsnameregfoad - (Theory)<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;&nbsp;NA</tr>";
								$rows=$rows+1;
								echo"<tr height='25px'><td align='center'>$rows<td>&nbsp; * $NAcourse (P)<td>$chkcsnameregfoad - (Practical)<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;&nbsp;NA</tr>";

													}
								else{
								echo"<tr height='25px'><td align='center'>$rows<td>&nbsp; * $NAcourse<td>$chkcsnameregfoad <td>&nbsp; <td>&nbsp;<td>&nbsp;<td>&nbsp;&nbsp;NA</tr>";
									}
////////////////////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
											}
												}
								}
			/////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////==========================================//////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////




			for($i=$rows+1;$i<=22;$i++){
			echo"<tr height='25px'><td align='center'>$i<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;</tr>";
			}
			echo"<tr height='25px'><td align='center' colspan=7>EL : Eligible &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NE : Not Eligible &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NC : Not Confirm &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NA : Not Applied</td></tr>";
			echo"</table>";

			//;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;

			echo"</td></tr>";
			//////////////////////////////////////////////////////////////////////////////////////////////////////

			/////////////////////////////admission footer/////////////////////////////////////////////////////////
			echo"<tr><td colspan=4>&nbsp;</td></tr>";
			echo"<tr height='25px'><td colspan=4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;මේ පරීක්ෂණයේ තමාට අදාළ අන්තිම පත්‍රයට පිළිතුරු ලියා අවසන්වූ වහාම ප්‍රවේශ පත්‍රය ශාලාධිපතිට භාරදිය යුතුය. එසේ භාර නොදෙන සිසුන්ගේ විභාග ප්‍රතිඵල අත්හිටුවීමට සිදුවන බවද දන්වා සිටිමි.   </td></tr></table><br>";

			echo"</font></table><br>";
			///////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////END ADMISSION///////////////////////////////////////////////
			echo"</p>";

			//...............................................................
										}
					else{
						echo"student $admisid not register to the exam<br>";
			
						}
			//...............................................................

////////////////////////////////////////////////////////////////////////////////////////////

				}
	else{
		echo"Invalid student Number";
		}

				}
else{
		echo"Invalid User Name";
		}

}//one add if close


//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
/////////////////////////gp admission/////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////


if($task=="gpadd"){
$gtgplvl=explode("-",$gplevel);
$gtgplvlnum=$gtgplvl[1];

if($gtgplvlnum!="SP"){
if($gtgplvlnum!=0){
$quegtstfomlvl="select distinct(r.student) from registration r,student s,level l where l.level=$gtgplvlnum and l.year=s.year and s.id=r.student and length(s.stream)='3' order by r.student";
}
else{
$quegtstfomlvl="select distinct(r.student) from registration r,student s,level l where l.level=0 and (l.year >= s.year) and s.id=r.student and length(s.stream)='3' order by r.student";
}
$examname="Bachelor of Science Genaral Degree Level I,II & III (Semester $cseme) Examination";
			}
else{
$quegtstfomlvl="select distinct(r.student) from registration r,student s,level l where l.year=s.year and s.id=r.student and length(s.stream) NOT LIKE '3' order by r.student";

$examname="Bachelor of Science Special Degree Level I & II (Semester $cseme) Examination";

	}

//echo$quegtstfomlvl;
$qugtstfomlvl=mysql_query($quegtstfomlvl);
while($qgtstfomlvl=mysql_fetch_array($qugtstfomlvl)){
$creaxmrg=array();
$xidx=0;
	$admisid=$qgtstfomlvl['student'];
	
			//echo$admisid."<br>";	
			
	


	$stleve=$n->getLevel($admisid);
/////////////////////////////////////////////////////////////////////////////////////////
		$queckexreg="select course from exam_registration where acedemic_year='$acy' and semester=$cseme and student='$admisid'";
		$quckexreg=mysql_query($queckexreg);
		if(mysql_num_rows($quckexreg)!=0){
			//echo"student ".$admisid."<br>";
			while($qckexreg=mysql_fetch_array($quckexreg)){
				$excocode=$qckexreg['course'];
				$qulisub="noqlsub";
				$ntelisub="noelsub";
				$practgp=$m->getprctgp($admisid, $excocode, $acy);
				//echo$excocode."{".$practgp;
				///////////////////////////////check repeate course/////////////////////////////////////////////
				$quegetcolslvl="select level from courseunit where code='$excocode'";
				$qugetcolslvl=mysql_query($quegetcolslvl);
				$qgetcolslvl=mysql_fetch_array($qugetcolslvl);
				$cslvl=$qgetcolslvl['level'];
					//$char_buff = preg_split('//', $excocode, -1);
					//$forthchr=$char_buff[4];			
				//echo$forthchr."---".$stleve."==";

				if($cslvl==$stleve){//////////////////////////////////////////////////////////////////////////
				
				$quegtlecids="select distinct(type) from lecture where course='$excocode' and acc_year='$acy'";
				//echo$quegtlecids;
				$qugtlecids=mysql_query($quegtlecids);
				if(mysql_num_rows($qugtlecids)!=0){
				$type="nil";
					$totalall=$m->getTotalAll($excocode, $admisid, $acy);/////////no of total participation lecture hourse/////////////////
					$alllechs=$m->getSubTotalAll($excocode, $acy, $practgp);/////////no of total lecture hourse/////////////////
					

					$topsg=($totalall/$alllechs)*100;
					$totprs=round($topsg);
					//echo"all ac ses".$alllechs."---";
					//echo"tot party ".$totalall.":::::tot persentage= ".round($topsg)."% <br>";	
						while($qgtlecids=mysql_fetch_array($qugtlecids)){
							$gtlecttp=$qgtlecids['type'];
							$fulpermi="null";
								if($gtlecttp!=$type){
									if(($gtlecttp=="field")||($gtlecttp=="assignment")){
										continue;
										}
									else{
									$total=$m->getTotal($excocode, $admisid, $gtlecttp, $acy);
									$ctotal=$m->getSubTotal($excocode, $gtlecttp, $acy, $practgp);
									$cutofmrk=$m->getMax($excocode, $gtlecttp, $acy);
										if($cutofmrk=="nd"){
											$cutofmrk=80;
													}
										$ctm=round($cutofmrk);
									if($cutofmrk!="nd"){

										
										//echo"tot $gtlecttp hs=".$ctotal."---";
										//echo"prt $gtlecttp hs=".$total.":::::";
										//echo"cut of mrk=".round($cutofmrk)."% +++++";
										$perpsg=($total/$ctotal)*100;
										$pest=round($perpsg);
											//echo" Current Persentage= ".round($perpsg)."% }";
											$type=$gtlecttp;
												if(($totprs!=0)&&($ctm<=$pest)){
													//echo"<font color=blue>OK Print Admisstion $totprs %</font><br>";
													$qulisub=$excocode;
														
														}
												else{
													if($gtlecttp=="practical"){
														$fulpermi="no";
														
																	}
													//echo"<font color=red>Not Eligibility $totprs %</font><br>";
													$ntelisub=$excocode;
													}


											}
										}
											}
												}
						if(($qulisub==$excocode)&&($qulisub!=$ntelisub)&&($fulpermi!="no")){
							//echo"<font color=blue>{---------Qulified ".$qulisub."---------}</font>";
							$queupexcm1="update exam_registration set confirm=1 where student='$admisid' and course='$qulisub' and acedemic_year='$acy' and semester=$cseme";
							//echo$queupexcm1;
							mysql_query($queupexcm1);
							

									}
						else{
							//echo"<font color=red>{---------Not Qulified ".$ntelisub."---------}</font>";
								
								$queel="select confirm from exam_registration where student='$admisid' and course='$ntelisub' and acedemic_year='$acy' and semester=$cseme";
								$quel=mysql_query($queel);
								$qel=mysql_fetch_array($quel);
								$el=$qel['confirm'];
								
								if($el!="1"){
							$queupexcm2="update exam_registration set confirm=2 where student='$admisid' and course='$ntelisub' and acedemic_year='$acy' and semester=$cseme";
							//echo$queupexcm2;
							mysql_query($queupexcm2);


										}
							}
						
						


					//echo"<br>";

									}
				else{
					//echo"not define}<br>";	
					continue;
					}


								}//repete chk if
							else{
								/*$queupexcm2="update exam_registration set confirm=1 where student='$admisid' and course='$excocode' and acedemic_year='$acy' and semester=$cseme";
							echo$queupexcm2;
							mysql_query($queupexcm2);*/
									continue;

								}


									}
			
							}
		else{
			//echo"student $admisid not register to the exam<br>";
			continue;
			}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$name=$n->getName($admisid);
$batch=$n->getBatch($admisid);

echo'<p style="page-break-after: always">';
//echo"Admission of ".."  <br>";
//echo"SC/$batch/$admisid";
//echo"<font color='black' size='2px'>";
echo"<table border='1' align='center'  width='842px' cellspacing='0' cellpadding='0' bordercolor=#030000'><tr><td>";

/////////////////////////////////////////////admission header////////////////////////////////////////////////
			echo"<table border=0 width='838px'>";
			echo"<tr><td colspan=4>&nbsp;</td></tr>";
			echo"<tr><td colspan=2 height='100px' align='center' valign='middel' width='50%' ><font size='5px'>රුහුණ විශ්වවිද්‍යාලය<br>University of Ruhuna
</font><br><font size='3px'>විද්‍යා පීඨය<br>Faculty of Science</font></td>";


			echo"<td colspan=2  width='50%' align='right'><table border='1' align='right'  cellspacing='0' cellpadding='0' bordercolor=#030000'><tr><td valign='middel'><table boder='0'><tr><td> විභාග අංකය<br>Index No</td><td> <image border='0' src='../images/bract.gif' ></td><td>
SC/$batch/$admisid&nbsp;</td></tr></table></td></tr></table>";

			
			echo"<tr><td colspan=4 height='30px' align='center' valign='middel'><font size='5px'>විභාග ප්‍රවේශ පත්‍රය<br>Examination Admission Card</font></td></tr>";


			
			echo"<tr><td colspan=3><table border='0'><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; පරීක්ෂණය<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Examination</td><td><image border='0' src='../images/bract.gif' ></td><td>$examname</td></tr></table></td>";


			echo"<td width='30%'><table border='0'><tr><td>වර්ෂය<br>Year</td><td><image border='0' src='../images/bract.gif' ></td><td>$ye</td></tr></table></td></tr>";


			echo"<tr><td colspan=4><table border='0'><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; අපේක්ෂකයාගේ නම<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Name of Candidate
</td><td><image border='0' src='../images/bract.gif' ></td><td>$name</td></tr></table></td>";

	
			
			echo"<tr><td colspan=4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ඉහත අපේක්ෂකයා පෙනී සිටීමට සුදුසුකම් ලබන පාඨමාලා ඒකක පහත වගුවේ දැක්වේ<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The Course Units that the above candidate qualifies to sit are mentioned over –leaf.
</td></tr>";

			
			//echo"<tr><td colspan=4>&nbsp;</td></tr>";
			echo"<tr><td colspan=3>&nbsp;</td><td>ජ්‍යෙෂ්ඨ සහකාර ලේඛකාධිකාරී(විද්‍යා)<br>Senior Assistant Registrar (Science)
</td></tr>";
			echo"<tr><td colspan=4><hr></td></tr>";
			/////////////////////////////////////////////////////////////////////////////////////////////////
			///////////////////////////////admission body/////////////////////////////////////////////////////
			echo"<tr><td colspan=4>";

echo"<table border='1' align='center' cellspacing='0' cellpadding='0' bordercolor=#030000'>";
echo"<tr><td width='3%'>&nbsp;</td><td width='14%' align='center'>පාඨමාලා ඒකකය<br>Course Unit</td><td width='25%' align='center'>පාඨමාලා නාමය<br>Course Name</td><td width='10%' align='center'>දිනය<br>Date</td><td width='18%' align='center'>අපේක්ෂකයාගේ අත්සන<br>Signature of Candidate</td><td width='18%' align='center'>නිරීක්ෂකයාගේ අත්සන<br>Signature of Invigilator</td><td width='12%' align='center'>තත්වය<br>Status</td></tr>";

$queprtadm="select er.course, er.degree, er.confirm, c.name from exam_registration er, courseunit c  where er.acedemic_year='$acy' and er.semester=$cseme and er.student='$admisid' and er.course=c.code order by er.course";
$quprtadm=mysql_query($queprtadm);
$rows=0;


while($qprtadm=mysql_fetch_array($quprtadm)){
$course3=$qprtadm['course'];
$course2=trim($course3);
$courseUPC=strtoupper($course2);
			$creaxmrg[$xidx]=$courseUPC;
			$xidx++;
////////////////////////////////////////////////////////////////////////////////////////
                                $coursegetchr=trim($course3);
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

$course=$fulcode;







$degree=$qprtadm['degree'];
$confirm=$qprtadm['confirm'];
			if($confirm==1){
				$confirm1="EL";	
					}
			elseif($confirm==2){
				$confirm1="NE";	
					}
			else{
				$confirm1="NC";
				}





$name=$qprtadm['name'];
$rows=$rows+1;
if (in_array($courseUPC, $tnpcourse)) {
echo"<tr height='25px'><td align='center'>$rows<td>&nbsp;&nbsp;$course (T)<td>$name - (Theory)<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;&nbsp;$confirm1</tr>";
$rows=$rows+1;
echo"<tr height='25px'><td align='center'>$rows<td>&nbsp;&nbsp;$course (P)<td>$name - (Practical)<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;&nbsp;$confirm1</tr>";


}

else{
echo"<tr height='25px'><td align='center'>$rows<td>&nbsp;&nbsp;$course<td>$name<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;&nbsp;$confirm1</tr>";
}

}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////==========================================//////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////check cos reg//////////////////////////////////
			if($cseme==1){
			$quechkcsregfoadm="select r.course, c.name from registration r, courseunit c where r.acedemic_year='$acy' and r.semister=$cseme and r.student='$admisid' and r.confirm=1 and r.course=c.code order by r.course";
					}
			else{
			$quechkcsregfoadm="select r.course, c.name from registration r, courseunit c where r.acedemic_year='$acy' and (r.semister=$cseme or r.semister=3) and r.student='$admisid' and r.confirm=1 and r.course=c.code order by r.course";
				}
			$quchkcsregfoadm=mysql_query($quechkcsregfoadm);
			if(mysql_num_rows($quchkcsregfoadm)!=0){
				while($qchkcsregfoadm=mysql_fetch_array($quchkcsregfoadm)){
						$chkcsregfoadm=trim($qchkcsregfoadm['course']);
							$chkcsregfoadmUPC=strtoupper($chkcsregfoadm);
				////////////////////////////////////////////////////////////////////////////////////////
                                $ccdwoutcrd=substr("$chkcsregfoadm", 0, -1);
                                $getchar = preg_split('//', $chkcsregfoadm, -1);

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
                                        $fulcodeNA=strtoupper($fistprt)."b".$sectprt;
                                                        }
                                else{
                                $fulcodeNA=strtoupper($temdiscos2);
                                }
                                ////////////////////////////////////////////////////

					$NAcourse=$fulcodeNA;
						$chkcsnameregfoad=ucfirst($qchkcsregfoadm['name']);
							
						if(!in_array($chkcsregfoadmUPC, $creaxmrg)){
							$rows=$rows+1;

			////////////////////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
							if (in_array($chkcsregfoadmUPC, $tnpcourse)) {

								echo"<tr height='25px'><td align='center'>$rows<td>&nbsp; * $NAcourse (T)<td>$chkcsnameregfoad - (Theory)<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;&nbsp;NA</tr>";
								$rows=$rows+1;
								echo"<tr height='25px'><td align='center'>$rows<td>&nbsp; * $NAcourse (P)<td>$chkcsnameregfoad - (Practical)<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;&nbsp;NA</tr>";

													}
								else{
								echo"<tr height='25px'><td align='center'>$rows<td>&nbsp; * $NAcourse<td>$chkcsnameregfoad <td>&nbsp; <td>&nbsp;<td>&nbsp;<td>&nbsp;&nbsp;NA</tr>";
									}
////////////////////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
											}
												}
								}
			/////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////==========================================//////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////




for($i=$rows+1;$i<=22;$i++){
echo"<tr height='25px'><td align='center'>$i<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;</tr>";
}
echo"<tr><td align='center' colspan=7>EL : Eligible &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NE : Not Eligible &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NC : Not Confirm &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NA : Not Applied</td></tr></table>";

echo"</td></tr>";
/////////////////////////////admission footer/////////////////////////////////////////////////////////
			echo"<tr><td colspan=4>&nbsp;</td></tr>";
			echo"<tr><td colspan=4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;මේ පරීක්ෂණයේ තමාට අදාළ අන්තිම පත්‍රයට පිළිතුරු ලියා අවසන්වූ වහාම ප්‍රවේශ පත්‍රය ශාලාධිපතිට භාරදිය යුතුය. එසේ භාර නොදෙන සිසුන්ගේ විභාග ප්‍රතිඵල අත්හිටුවීමට සිදුවන බවද දන්වා සිටිමි.</td></tr></table><br>";

			echo"</table><br>";
			///////////////////////////////////////////////////////////////////////////////////////////////////////////



echo"</p>";

}//main while
	
}//gpadd if close






echo"</div>";
?>





<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}

?>
