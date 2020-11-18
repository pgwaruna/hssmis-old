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
if($qpers['id']=="72"){
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

<script type="text/javascript" src="./Ajax/dis_tp_72.js"></script>


<!--///////////////////////////////////////////////////////////////////////////////
///////////////////////////print js////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////-->
<script type="text/javascript" >

function PrintDivData(crtlid)
{
var ctrlcontent=document.getElementById(crtlid);
var printscreen=window.open('','','left=1,top=1,width=1000,height=400,toolbar=0,scrollbars=0,status=0');
printscreen.document.write(ctrlcontent.innerHTML);
printscreen.print();

}


<!--///////////////////////////////////////////////////////////////////////////////
/////////////////////////// end   print js/////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////-->

</script>



<?php
require_once('./classes/evaluateClass.php');
$ev=new evaluation();


echo" Analysis Evaluation Forms and Student Feedback Questionnaire";
echo"<hr class=bar>";


$due=$_GET['due'];





////////////////////////////////////////////////////////////////////////////////
/////////////////////////// display anlysis/////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
if($task=="oneevlsrc"){
echo"<div id=ajaxDiv>";

	$evlcos2=trim($_POST['evlcos']);
			///////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////
								$coursegetchr=trim($evlcos2);
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
					
			//////////////////////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////

	$anlstype2=$_POST['anlstype'];
	$elvcostpy2=$_POST['elvcostpy'];

	
	$elvacyr2=$_POST['evlacyear'];
//echo$evlcos.$anlstype.$elvcostpy;

	if($evlcos2!=null){
		$_SESSION['evlcos']=$evlcos2;
		$_SESSION['fulevlcos']=$fulcode;
		$_SESSION['anlstype']=$anlstype2;
		$_SESSION['elvcostpy']=$elvcostpy2;
		$_SESSION['elvacyr']=$elvacyr2;
				}

		$evlcos=$_SESSION['evlcos'];
		$fulcode2=$_SESSION['fulevlcos'];
		$anlstype3=$_SESSION['anlstype'];

			if($due=="swaptst"){
				if($anlstype3=="peer"){
					$_SESSION['anlstype']="student";
					$_SESSION['elvcostpy']="theory";
							}
				else{
					$_SESSION['anlstype']="peer";
					}
					}
			else if($due=="swaptpr"){
				$_SESSION['anlstype']="peer";

					}
			else{
				$anlstype=$anlstype3;
				}
		$anlstype=$_SESSION['anlstype'];


		$elvcostpy3=$_SESSION['elvcostpy'];
			if($due=="swap"){
				if($elvcostpy3=="theory"){
					$_SESSION['elvcostpy']="practical";
							}
				else{
					$_SESSION['elvcostpy']="theory";
					}
							}
			else{
				$elvcostpy=$elvcostpy3;
				}
		$elvcostpy=$_SESSION['elvcostpy'];

		$elvacyr=$_SESSION['elvacyr'];







	$quegetsubjdata="select name, department,semister from  courseunit where code='$evlcos'";
	$qugetsubjdata=mysql_query($quegetsubjdata);
	if(mysql_num_rows($qugetsubjdata)==0){echo"<font color=red>Sorry! Invalid Course Unit($evlcos). Please try again.</font>";}
	else{
	while($qgetsubjdata=mysql_fetch_array($qugetsubjdata)){
			$evlcodenm=$qgetsubjdata['name'];
			$evlcodedept=$qgetsubjdata['department'];
			$evlcodeseme=$qgetsubjdata['semister'];
				if($evlcodeseme==3){$evlcodeseme="1 & 2";}
				
				
								}



echo"<table width=99%><th colspan=9>$fulcode2-( ".ucfirst($evlcodenm)." ) ".ucfirst($elvcostpy)." - Department of ".ucfirst($evlcodedept)."</th>";


if($anlstype=="peer"){

echo"<h3>*** Peer Evaluation Analysis for $elvacyr Academic Year and Semester $evlcodeseme *** </h3>";
echo"<tr class=trbgc height=35px>";

/////////////////////////////////get lect nm//////////////////////////////////////////////////////////////////////////////////////////
	$quegetlectnm="select distinct(lect_name) from  peer_evaluation_session where  ac_year='$elvacyr' and course_unit='$evlcos'";
	$qugetlectnm=mysql_query($quegetlectnm);
	if(mysql_num_rows($qugetlectnm)!=0){
	echo"<td colspan=9>* Name of the Lecturer : ";
	while($qgetlectnm=mysql_fetch_array($qugetlectnm)){
			$getlectnm=$qgetlectnm['lect_name'];
			echo"[ ".ucfirst($getlectnm)." ] ";
								}
				}
//////////////////////////////end get lect nm//////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////get peer nm//////////////////////////////////////////////////////////////////////////////////////////
	$quegetpeernm="select distinct(Peer_name) from  peer_evaluation_session where  ac_year='$elvacyr' and course_unit='$evlcos'";
	$qugetpeernm=mysql_query($quegetpeernm);
	if(mysql_num_rows($qugetpeernm)!=0){
	echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Name of the Peer : ";
	while($qgetpeernm=mysql_fetch_array($qugetpeernm)){
			$getpeernm=$qgetpeernm['Peer_name'];
			echo"[  ".ucfirst($getpeernm)."  ] ";
								}
				}

//////////////////////////// end get peer nm//////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////get subm date/////////////////////////////////////////////////////////////////////////////////////////
	$quegetsubmdt="select distinct(submit_date) from  peer_evaluation_session where  ac_year='$elvacyr' and course_unit='$evlcos'";
	$qugetsubmdt=mysql_query($quegetsubmdt);
	if(mysql_num_rows($qugetsubmdt)!=0){
	echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*  Evaluated Date : ";
	while($qgetsubmdt=mysql_fetch_array($qugetsubmdt)){
			$getsubmdt=$qgetsubmdt['submit_date'];
			echo"[  ".ucfirst($getsubmdt)."  ] ";
								}
				}

//////////////////////////// end get get subm date//////////////////////////////////////////////////////////////////////////////////////////




			////////////total peer forms//////////////////
			$totevlid=$ev->totevlidcunt($elvacyr,$evlcos);
			///////////end total peer forms///////////////
if($totevlid!=0){
 			echo"<br>* Total Peer Evaluation Form : <font color=red><b>$totevlid<b></font> ";



	echo"<tr class=selectbg2 align=center height=30px><td><b>No<td><b>Questions<td><b>Ans : 1<td><b>Ans : 2<td><b>Ans : 3<td><b>Ans : 4<td><b>Ans : 5<td><b>Ans : NA</b>";
			

			

//////////////////////////////////// get peer ques///////////////////////////////
	$quegetpeerque="select que_no,question from peer_evaluation_questions where que_version=1";
	$qugetpeerque=mysql_query($quegetpeerque);
	if(mysql_num_rows($qugetpeerque)==0){	
	echo"<tr class=trbgc align=center height=30px><td colspan=9>Sorry! No questions found.";
						}
	else{
		while($qgetpeerque=mysql_fetch_array($qugetpeerque)){
				$que_no=$qgetpeerque['que_no'];
				$question=$qgetpeerque['question'];

			echo"<tr class=trbgc align=center height=30px><td>$que_no<td align=left>&nbsp;&nbsp;".ucfirst($question);
			
				
				for($ans=1;$ans<=5;$ans++){			
					echo"<td class=selecttdbg>";
					$getansbytot=$ev->getansptg($que_no,$ans,$elvacyr,$evlcos);

					$ansptg=($getansbytot/$totevlid)*100;
					
					echo"<font color=blue><b>".round($ansptg, 1)." %</b></font>";


								}
					$getansbytotna=$ev->getansptg($que_no,'NA',$elvacyr,$evlcos);
					$ansptgna=($getansbytotna/$totevlid)*100;
					echo"<td class=selecttdbg>";
					echo"<font color=blue><b>".round($ansptgna, 1)." %</b></font>";


									}




		}
///////////////////////////////// end get peer ques//////////////////////////////


				}/////////count=0 if close

			else{echo"<td colspan=7 align=center><font color=red>Sorry! Can not find any Peer Evaluation Form.</font></tr>";}


echo"<form method=post action='./index.php?view=admin&admin=72&task=oneevlsrc&due=swaptst'><tr class=trbgc align=center height=30px><td colspan=9 align=right><font color=red><b>This Analysis Result for ".ucfirst($anlstype)." Evaluation &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></font>";

			if($anlstype=="peer"){$serchfor="Student Evaluation";}
			else{$serchfor="Peer Evaluation";}
		echo"<input type=submit value='View $serchfor'></form>";
echo"<tr class=trbgc align=center height=30px><td colspan=9><font color=green>";
echo"[ VERY NEGATIVE 1 2 3 4 5 VERY POSITIVE ]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo"[ Ans:NA = NOT APPLICABLE ]";


echo"</font>";


			}////////////peer if close

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if($anlstype=="student"){
echo"<h3>*** Student Feedback Questionnaire Analysis for $elvacyr Academic year  and Semester $evlcodeseme *** </h3>";
echo"<tr class=trbgc height=35px>";
/////////////////////////////////get lect nm//////////////////////////////////////////////////////////////////////////////////////////
	$quegetlectnm="select distinct(lect_name) from  student_evaluation_session where  ac_year='$elvacyr' and course_unit='$evlcos' and  course_type='$elvcostpy'";
	$qugetlectnm=mysql_query($quegetlectnm);
	if(mysql_num_rows($qugetlectnm)!=0){
	echo"<td colspan=9>* Nameof the Lecturer : ";
	while($qgetlectnm=mysql_fetch_array($qugetlectnm)){
			$getlectnm=$qgetlectnm['lect_name'];
			echo"[ ".ucfirst($getlectnm)." ] ";
								}
				}
//////////////////////////////end get lect nm//////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////get subm date/////////////////////////////////////////////////////////////////////////////////////////
	$quegetsubmdt="select distinct(submit_date) from  student_evaluation_session where  ac_year='$elvacyr' and course_unit='$evlcos' and  course_type='$elvcostpy'";
	$qugetsubmdt=mysql_query($quegetsubmdt);
	if(mysql_num_rows($qugetsubmdt)!=0){
	echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*  Evaluated Date : ";
	while($qgetsubmdt=mysql_fetch_array($qugetsubmdt)){
			$getsubmdt=$qgetsubmdt['submit_date'];
			echo"[  ".ucfirst($getsubmdt)."  ] ";
								}
				}

//////////////////////////// end get get subm date//////////////////////////////////////////////////////////////////////////////////////////


			////////////total student forms//////////////////
			$totstevlid=$ev->totstevlidcunt($elvacyr,$evlcos,$elvcostpy);
			///////////end total student forms///////////////


	if($totstevlid==0){echo"<td colspan=9 align=center><font color=red>Sorry! Can not find any Student Feedback Questionnaire Form.</font></tr>";}
	else{
		echo"<br>* Total Student Feedback Questionnaire Form : <font color=red><b>$totstevlid<b></font> ";


	echo"<tr class=selectbg2 align=center height=30px><td><b>No<td><b>Questions<td><b>Ans : 1<td><b>Ans : 2<td><b>Ans : 3<td><b>Ans : 4<td><b>Ans : 5";
	

//////////////////////////////////// get student ques///////////////////////////////
	$quegetpeerque="select que_no,question from student_evaluation_questions where que_version=1 and course_type='$elvcostpy'";
	$qugetpeerque=mysql_query($quegetpeerque);
	if(mysql_num_rows($qugetpeerque)==0){	
	echo"<tr class=trbgc align=center height=30px><td colspan=9>Sorry! No Questions Found.";
						}
	else{
		while($qgetpeerque=mysql_fetch_array($qugetpeerque)){
				$que_no=$qgetpeerque['que_no'];
				$question=$qgetpeerque['question'];

			echo"<tr class=trbgc align=center height=30px><td>$que_no<td align=left>&nbsp;&nbsp;$question";
			
				
				for($ans=1;$ans<=5;$ans++){			
					echo"<td class=selecttdbg width=50px>";
					$getansbytot=$ev->getstansptg($que_no,$ans,$elvacyr,$evlcos,$elvcostpy);

					$ansptg=($getansbytot/$totstevlid)*100;
					
					echo"<font color=blue><b>".round($ansptg, 1)." %</b></font></td>";


								}
					


									}
		

		}
///////////////////////////////// end get peer ques//////////////////////////////



		}////////forms not 0 else close


echo"<form method=post action='./index.php?view=admin&admin=72&task=oneevlsrc&due=swap'>";
echo"<tr class=trbgc align=center height=30px><td colspan=2><font color=red><b>This Analysis Result for ".ucfirst($elvcostpy)."</b></font>";
			if($elvcostpy=="theory"){$serchfor="Practical";}
			else{$serchfor="Theory";}
		echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=submit value='View for $serchfor '></form></td>";







echo"<form method=post action='./index.php?view=admin&admin=72&task=oneevlsrc&due=swaptpr'>";
echo"<td colspan=5>";
echo"<input type=submit value='View Peer Evaluation'></form></td>";


echo"<tr class=trbgc align=center height=30px><td colspan=7><font color=green size=3px>";
echo"[ Ans:1 = Very Poor ]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo"[ Ans:2 = Poor ]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo"[ Ans:3 = Satisfactory ]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo"[ Ans:4 = Good ]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo"[ Ans:5 = Very Good ]";

echo"</font>";

echo"</tr>";

			}////////////student if close

echo"</table>";


			}////////right course unit else cloase

//echo "<input type=button name=Print value=Print onClick=javascript:PrintDivData('ajaxDiv'); Runat=Server/>";
echo"</div>";


echo"<hr class=bar>";
}//task="oneevlsrc" if close
////////////////////////////////////////////////////////////////////////////////
/////////////////////////// display anlysis/////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////


$uname=$_SESSION['user_id'];
$eliuser=array("saman");

if(($role=="administrator")||($role=="topadmin")||($role=="sar")||(in_array($uname,$eliuser))){
////////////////////////////////////////////////////////////////////////////////
///////////////////////// search one course unit////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
echo"<br><font size=3px>*** Search for One Course Unit ***</font>";

echo"<form method=post action='./index.php?view=admin&admin=72&task=oneevlsrc'>";
echo"<table border=0 class=bgc><tr>";

echo"<td colspan=5 align=center>Enter Course Unit ";
echo"<span id='code'>";
echo"<input type=text name=evlcos size=6>&nbsp;&nbsp;&nbsp;";
echo'<font color="red">[ &#945; = a ] [ &#946; = b ] [ &#948; = d ]</font>&nbsp;&nbsp;&nbsp;';

echo'<span class="textfieldRequiredMsg"><font size="-1"> Enter the Subject Code </font></span>';
echo'<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>';
echo'</span>';
echo"<img style='visibility: hidden' id='ldrtop' src='images/ajax-loader.gif'>";

 echo"<tr>";
echo"<td align=center><select name=evlacyear>";

	$quegtacyr="(select ac_year from peer_evaluation_session) UNION (select ac_year from student_evaluation_session) order by ac_year DESC limit 5";

	//$quegtacyr="select acedemic_year from acc_year order by acedemic_year DESC limit 3";
	$qugtacyr=mysql_query($quegtacyr);
	while($qgtacyr=mysql_fetch_array($qugtacyr)){
		$gtacyr=$qgtacyr['ac_year'];
		if($filacyear=="$gtacyr"){
		echo"<option value='$gtacyr' selected>$gtacyr</option>";
						}
		else{
		echo"<option value='$gtacyr'>$gtacyr</option>";
			}
					}
echo"</select>";		


echo"<td align=center><select name='anlstype' id='anlstype'  onchange='display_torp()'>";
	echo"<option value='peer' selected>Peer Evaluation</option>";
	echo"<option value='student'>Student Feedback Questionnaires</option>";
echo"</select>";




echo'<td align=center>';
	echo'<div id="disptop" name="disptop"></div>';
	
echo"<td align=center><input type=submit value='Analysis Forms'>";
echo"</tr></table>";
echo"</form>";
////////////////////////////////////////////////////////////////////////////////
//////////////////////end search one course unit////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
}/////////check role if close




////////////////////////////////////////////////////////////////////////////////
///////////////////////// search all course unit////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
echo"<br><font size=3px>*** Course Unit List ***</font><br>";
if(($role=="administrator")||($role=="topadmin")||($role=="sar")||(in_array($uname,$eliuser))){
$quegetallcosunt="(select course_unit from peer_evaluation_session ) UNION (select course_unit from student_evaluation_session ) order by course_unit";
}
else{
$quegetallcosunt="select code as course_unit from courseunit where lecture='$uname' and code IN (select course_unit from student_evaluation_session UNION select distinct course_unit from peer_evaluation_session) order by code ";
}
//echo$quegetallcosunt;
$qugetallcosunt=mysql_query($quegetallcosunt);
if(mysql_num_rows($qugetallcosunt)==0){
	echo"<font color=red>Sorry! Can not find any Evaluated Course Unit.</font>";
					}
else{
$no=1;

echo"<table border=0><th>No<th width=8%>Course Unit<th>Course Name<th width=15%>Evaluated Academic Year<th>Evaluate Type<th>Submit</th>";
while($qgetallcosunt=mysql_fetch_array($qugetallcosunt)){
		$getallcosunt=trim($qgetallcosunt['course_unit']);
			///////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////
								$coursegetchr=trim($getallcosunt);
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
					
			//////////////////////////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////


		$quegetcosname="select name from courseunit where code='$getallcosunt'";
		$qugetcosname=mysql_query($quegetcosname);
		$qgetcosname=mysql_fetch_array($qugetcosname);
			$getcosname=ucfirst($qgetcosname['name']);



//echo$getallcosunt."<br>";
echo"<tr class=trbgc align=center><form method=POST action='./index.php?view=admin&admin=72&task=oneevlsrc' id='$no' name='$no'>";


	echo"<td>$no<td><input type=hidden name=evlcos value='$getallcosunt'>$fulcode<td align=left>&nbsp;&nbsp;$getcosname";

	echo"<td align=center><select name=evlacyear>";
	$quegtacyr="(select ac_year from peer_evaluation_session where course_unit='$getallcosunt') UNION (select ac_year from student_evaluation_session where course_unit='$getallcosunt' ) order by ac_year DESC limit 5";
	//$quegtacyr="select acedemic_year from acc_year order by acedemic_year DESC limit 3";
	$qugtacyr=mysql_query($quegtacyr);
	while($qgtacyr=mysql_fetch_array($qugtacyr)){
		$gtacyr=$qgtacyr['ac_year'];
		if($filacyear=="$gtacyr"){
		echo"<option value='$gtacyr' selected>$gtacyr</option>";
						}
		else{
		echo"<option value='$gtacyr'>$gtacyr</option>";
			}
					}
	echo"</select>";




	echo"<td align=center>";

	echo"<table border=0><tr><td>";
	echo"<select name='anlstype' id='anlstype$no'  onchange='display_torp_all($no)' width='145' style='width: 145px'>";
		echo"<option value='peer' selected>Peer Evaluation</option>";
		echo"<option value='student'>Student Feedback Questionnaires</option>";
	echo"</select>";

	echo"<td><img style='visibility: hidden' id='ldrtop$no' src='images/ajax-loader.gif'>";
	echo"<td><select size='2' name='elvcostpy' id='disptop$no' style='visibility: hidden' ></select></td>";
	echo"</tr></table>";
echo"<td><input type=submit value='Analysis'>";



echo"</tr></form>";

$no++;

								}/////while close
echo"</table>";
	}////////course unit serch els close
////////////////////////////////////////////////////////////////////////////////
///////////////////////// search all course unit////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

?>





<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>
