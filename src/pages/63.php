<?php //error_reporting(0);
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
if($qpers['id']=="63"){
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

require_once('./classes/globalClass.php');
require_once('./classes/gpaClass.php');

$n=new settings();
$gpa=new calculate();

echo"Grade Point Average ( GPA )";
echo"<hr class=bar>";





///////get acc year & cal decreesing five years////////////////////////////////
$acc_year=$n->getAcc();

$year=substr("$acc_year",5,4);
for($i=0;$i<5;$i++){
	$yearA[$i]=$year-$i;
		}

////////////////////////////////////////////////////////////////////////////////

if($role!="student"){

///////////////display select index no form for role!=student//////////////////////////////////


echo"<h3>*** Check GPA for Individual Students ***</h3>";
echo"<table class=bgc><tr><td align=center>";
include './forms/form_63.php';
echo"</td></tr></table>";


			}

/////////////////////////////////////////////////////////////////////////////

//////////select index process for role!=student/////////////////////////////////////////

if($task=="selectindex"){
	$year=$_POST['year'];
	$indexno=$_POST['index'];


////check valid index no///////////////////

	$batch_year=$n->getBatch($indexno);

	$get_batchyear="select batch from student where id='$indexno'";
	$result_batchyear=mysql_query("$get_batchyear");
	if(mysql_num_rows($result_batchyear)!=0){
		while($row=mysql_fetch_array($result_batchyear)){
			$batch_year=$row['batch'];
								}
		if($batch_year!=$year){
			echo"<font color='red'>Sorry !, SC/$year/$indexno is Invalid Student Number.</font><br>";
					}

		else{
			$student_ID=$indexno;
			$get_dept_occu="select section,occupation,concat(l_name,' ',initials) as full_name  from $rmsdb.fohssmis where user='sc$student_ID'";
			//echo$get_dept_occu;
			$result_dept_occu=mysql_query("$get_dept_occu");
			while($row=mysql_fetch_array($result_dept_occu)){
				$occupation=$row['occupation'];
				$department=$row['section'];
				$full_name=$row['full_name'];
									}
			}

						}
	else{
		$get_occu="select section from $rmsdb.fohssmis where user='$indexno'";
		$result_occu=mysql_query("$get_occu");
		while($row=mysql_fetch_array($result_occu)){
			$department=$row['section'];
							}
		}
					}

/////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////

if($role=="student"){
	$student_ID=$_SESSION['user_id'];
	$department=$_SESSION['section'];
	$occupation=$_SESSION['occupation'];
		}

if($occupation=="student"){
        $quegtocu="select stream from student where id='$student_ID'";
        $qugtocu=mysql_query($quegtocu);
        if(mysql_num_rows($qugtocu)==0){
            $occupation=$occupation;
        }
        else{
             $qgtocu=mysql_fetch_array($qugtocu);
             $gtocu=$qgtocu['stream'];
                $newoccupation=$gtocu."_student";

             $occupation=$newoccupation;
        }

}


///////check GPA for student///////////////////////////////////////////////////////////////////////////////////////////////////////////////

if($department=='Other'){
	echo"<font color=red>Sorry! Can not find Subject Combination details.</p>";
				}

///////////////for old student/////////////////////////////////////////////////////////////////////////////

if($department=='checked'){

	if($role!="student"){
		echo "<h3>Details of ".$full_name." ( SC/$batch_year/$student_ID )</h3>";
				}

//////////cal gpa and view gpa/////////////////////////////////
	$crtgpavar=array();

	$crtgpavar=$gpa->calcurrentgpa($student_ID);


	$crtgpa=$crtgpavar[0];
	$sumcredit=$crtgpavar[1];
	$totcrdtvalue=$crtgpavar[2];


//echo"Total Credit=$sumcredit and Total Credit value =".$totcrdtvalue."<br>";

	if($crtgpa==0){
		echo"<font color=red>Result not release yet!</font>";
			}
	else{
		echo "<font color=red size=3px>Current GPA value for according to released results  : ". round($crtgpa,2)."</font><br>( Note: This value is not official )</br></br>";

//////////cal new GPA value///////////////////////////////

		if($role=="student"){
			$gpaasume="no";
		$moreresult=$gpa->chkallresult($student_ID);

//echo$moreresult[0]."--".$moreresult[1];

		if($moreresult[1]<90){
			$gpaasume="yes";
					}
		else{
			if($moreresult[0]!=0){
				$gpaasume="yes";
						}
		}


		if($gpaasume=="yes"){
///////////////////////////////-------------------------------------//////////////////////////////////////////////////
////display select grade form for role=student//////

			$gradeA=array('A+','A','A-','B+','B','B-','C+','C','C-','D+','D','E');



			$balance_credit=90-$sumcredit;
			//echo"<hr width=50% color=#610b0e></br>";

			echo"<form action='./index.php?view=admin&admin=63&task=selectgrade' method='post'>";
            echo"<table class=bgc><tr><td>";
			echo"Select Grade to Assume GPA : <select name='grade'>";
			for($i=0;$i<count($gradeA);$i++){
				echo"<option value='$gradeA[$i]'>$gradeA[$i]</option>";
							}
			echo"</select>&nbsp;&nbsp;&nbsp;<input type='submit' value='Submit'></td></tr></table></form>";

//////////////////////////////////////////////////

///select grade process//////

			if($task=="selectgrade"){
				$grade=$_POST['grade'];

//set value for above grade////
				switch($grade){
					case "A+":
						$value=4;
						break;
					case "A":
						$value=4;
						break;
					case "A-":
						$value=3.7;
						break;
					case "B+":
						$value=3.3;
						break;
					case "B":
						$value=3;
						break;
					case "B-":
						$value=2.7;
						break;
					case "C+":
						$value=2.3;
						break;
					case "C":
						$value=2;
						break;
					case "C-":
						$value=1.7;
						break;
					case "D+":
						$value=1.3;
						break;
					case "D":
						$value=1;
						break;
					default:
						$value=0;
						break;
						}
/////////////////////////////
				$second_gpa=($balance_credit*$value);

				$newgpa=($totcrdtvalue+$second_gpa)/90;
				echo"<font color=blue>New Assumed GPA Value : ".round($newgpa,2)."  for Grade $grade </font>";

						}

/////////////////////////////////////////////
			echo"<hr class=bar>";






///////////////////////////////-------------------------------------//////////////////////////////////////////////////
					}
					}

////////////////////////////////////////////////////////////////
		}

//////////////////////////////////////////////////////////////






////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////display minimum requerment table/////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$req=array();
	echo"</br><table><caption>Minimum Requirements for Completion of the Bachelor of Science (General) Degree</caption></tr><th>No</th><th>Requirements</th><th>Status</th></tr>";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////requ:1 min credit 90/////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////


///////get registered total credit////////////////
	$crttotcrdt=$gpa->crrtotcredit($student_ID);
//////////////////////////////////////////////////

///display 1st condition///////////////////////////////

	echo"<tr class=trbgc><td align='center'>1</td><td>* A minimum of 90 credits register for degree</br></br><font color=red>[ Registered $crttotcrdt credits ]</font></td>";
	if($crttotcrdt>=90){
		echo"<td align='center'><img src=./images/conf31.png><br>Complete</td></tr>";
		$req[0]="ok";
				}
	else{
		echo"<td align='center'><img src=./images/rm.png><br>Incomplete</td></tr>";
		$req[0]="notok";
		}

///////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////





///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////requ:2 C or better min credit 60% theory core course////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////condition 2 clculation part/////////////////////////////////////
	$subjectA=array();

    $subjectA=$gpa->mainsubject($student_ID);
/////////////////////////////////////////////////////////////////////////////

////////////////display 2nd condition///////////////////////////////

	echo"<tr class=trbgc><td align='center'>2</td><td>* Grades of C or better from theory aggregating to a minimum of 60% credits of core course unit from each main subject";
	$check=array();
	for($i=0;$i<count($subjectA);$i++){

		$getallsubcocredit=$gpa->allsubcocredit($subjectA[$i]);
        $corbtcdt=$gpa->chkcorbetter($student_ID,$subjectA[$i]);

        $getcoptg=($corbtcdt/$getallsubcocredit)*100;
        $coptg=round($getcoptg,2);
		echo"</br></br><font color=blue>{ ".strtoupper($subjectA[$i])." }</font></br>[ Total Credits for Core Course Unit : <font color=red>".$getallsubcocredit."</font> ]&nbsp;&nbsp;&nbsp;[ Grade ' C ' or better credits for Core Course unit : <font color=red>".$corbtcdt."</font> ]&nbsp;&nbsp;&nbsp;[ Precentage : </font><font color=red>".$coptg."%</font> ]";

		if($coptg>=60){
			$check[$i]="yes";
				}
		else{
			$check[$i]="no";
			}
					}
	echo"</td>";
	if(in_array("no",$check)){
		echo"<td align='center'><img src=./images/rm.png><br>Incomplete</td></tr>";
		$req[1]="notok";
					}
	else{
		echo"<td align='center'><img src=./images/conf31.png><br>Complete</td></tr>";
		$req[1]="ok";
		}

//////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////




///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////requ:3 must register 24 credits for per subject////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////condition 3 clculation part/////////////////////////////////////
	if($occupation!="bcs_student"){
	$subjectAll=array();

    $subjectAll=$gpa->mainsubject($student_ID);
/////////////////////////////////////////////////////////////////////////////

////////////////display 2nd condition///////////////////////////////

	echo"<tr class=trbgc><td align='center'>3</td><td>* Minimum of 24 credits required for a main subject";
	$check=array();
	for($i=0;$i<count($subjectAll);$i++){

		$getallsubcredit=$gpa->allsubcredit($student_ID,$subjectAll[$i]);
    
		echo"</br></br><font color=blue>{ ".strtoupper($subjectAll[$i])." }</font></br><font color=red>[ Registered: ".$getallsubcredit."</font> ]";
		
		if($getallsubcredit>=24){
			$check[$i]="yes";
			
				}
		else{
			$check[$i]="no";
			
			
			}
					}
	echo"</td>";
	if(in_array("no",$check)){
		
		$req[2]="notok";
		echo"<td align='center'><img src=./images/rm.png><br>Incomplete</td></tr>";
					}
	else{
		
		$req[2]="ok";
		echo"<td align='center'><img src=./images/conf31.png><br>Complete</td></tr>";
		}
	}

//////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////requ:3 D+ or better min credit 60% optional course//////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////condition 3 clculation part/////////////////////////////////////
    $alopcdt=$gpa->allopcredit($student_ID);
	///////////////////////////////////////////////////////////////////////
    $dorbeterptg=$gpa->allopcorbetter($student_ID);
///display 3rd condition///////////////////////////////
    $calprctage=($dorbeterptg/$alopcdt)*100;
    $dorbtptge=round($calprctage,2);
 	$getstrm="select stream from student where id='$student_ID'";
    $result_strm=mysql_query("$getstrm");

                                $strm=mysql_fetch_array($result_strm);
             					$g_stream=$strm['stream'];
    if($g_stream=="bcs")
    	echo"<tr class=trbgc><td align='center'>4</td><td>* Grades of C or better aggregating to a minimum of 60% credits of optional course unit </br></br>[ Registered total credits for optional course unit : <font color=red>".$alopcdt."</font>&nbsp;] [&nbsp;C or better credits for optional course unit : <font color=red>".$dorbeterptg."</font>&nbsp;] [&nbsp;Precentage : <font color=red>".$dorbtptge."%</font> ]</td>";
    else
		echo"<tr class=trbgc><td align='center'>4</td><td>* Grades of D+ or better aggregating to a minimum of 60% credits of optional course unit </br></br>[ Registered total credits for optional course unit : <font color=red>".$alopcdt."</font>&nbsp;] [&nbsp;D+ or better credits for optional course unit : <font color=red>".$dorbeterptg."</font>&nbsp;] [&nbsp;Precentage : <font color=red>".$dorbtptge."%</font> ]</td>";

	if($dorbtptge>=60){
		echo"<td align='center'><img src=./images/conf31.png><br>Complete</td></tr>";
		$req[3]="ok";
			}
	else{
		echo"<td align='center'><img src=./images/rm.png><br>Incomplete</td></tr>";
		$req[3]="notok";
		}

////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////





/////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////requ:4 C- or better min credit 60% all practical core course//////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////condition 4 clculation part/////////////////////////////////////
        $alprcredit=$gpa->allpracticalunit($student_ID);
///////////////////////////////////////////////////////////////////////
        $cminorbt=0;
            for($j=0;$j<count($subjectA);$j++){

                $gtcminorbtcrdt=$gpa->chkprcminorbetter($student_ID, $subjectA[$j]);
                $cminorbt=$cminorbt+$gtcminorbtcrdt;

            }

        $calprctage=($cminorbt/$alprcredit)*100;
        $prcminorbtptg=round($calprctage,2);

///display 4th condition///////////////////////////////

	echo"<tr class=trbgc><td align='center'>5</td><td>* Grades of C- or better in all practical core course unit </br></br>[ Total credits of practical core course unit : <font color=red>".$alprcredit."</font>&nbsp;]&nbsp;[&nbsp;C- or better credits of practical core course unit : <font color=red>".$cminorbt."</font>&nbsp;]&nbsp;[&nbsp;Precentage : <font color=red>".$prcminorbtptg."% </font>]</td>";

	if($calprctage>=100){
		echo"<td align='center'><img src=./images/conf31.png><br>Complete</td></tr>";
		$req[4]="ok";
			}
	else{
		echo"<td align='center'><img src=./images/rm.png><br>Incomplete</td></tr>";
		$req[4]="notok";
		}

////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////






////requ:5 GPA is 2 or more///////////////////////////////////////////////////////////////

///display 5th condition///////////////////////////////

	echo"<tr class=trbgc><td align='center'>6</td><td>* A Grade Point Average (GPA) of 2 or more </br></br>[ Current GPA : <font color=red>".round($crtgpa,2)."</font> ]</td>";
	if(round($crtgpa,2)>=2){
		echo"<td align='center'><img src=./images/conf31.png><br>Complete</td></tr>";
		$req[5]="ok";
			}
	else{
		echo"<td align='center'><img src=./images/rm.png><br>Incomplete</td></tr>";
		$req[5]="notok";
		}
////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////

////requ:6 pass the english level 1& 11////////////////////////////////////////////////

//////condition 6 clculation part/////////////////////////////////////
    $codeA=array();
    $codeA=$gpa->checkENGresult($student_ID);

///////////////////////////////////////////////////////////////////////

///display 6th condition///////////////////////////////

	echo"<tr class=trbgc><td align='center'>7</td><td>* Pass the English Proficiency Level 1 & Level 11</form> </br></br> ";



		if(count($codeA)==0){
			echo"[ <font color=red>Sorry! Can't find results of English Level 1 & Level 11 ]";
				}
		else{
			echo"[ <font color=red>Pass English";
			if(in_array('ENG1201',$codeA)){
				echo" Level 1";
							}
			if(in_array('ENG2201',$codeA)){
				echo" , Level 2";
							}
            echo"</font> ]";
			}


	if(count($codeA)==2){
		echo"</font></td><td align='center'><img src=./images/conf31.png><br>Complete</td></tr>";
		$req[6]="ok";
				}
	else{
		echo"</font></td><td align='center'><img src=./images/rm.png><br>Incomplete</td></tr>";
		$req[6]="notok";

		}

///////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////requ:fcs cannnot exceed 6 credit limit for fsc//////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////
//////condition fsc clculation part/////////////////////////////////////
		$alfsccdt=$gpa->allfsccredit($student_ID);

		echo"<tr class=trbgc><td align='center'>8</td><td>* maximum of 6 credits register for FSC and Cannot exceed this credit limit</br></br><font color=red>[ Registered ".$alfsccdt." credits ]</font></td>";
			if($alfsccdt<=6){
				echo"<td align='center'><img src=./images/conf31.png><br>Comply</td></tr>";
				$req[7]="ok";
			}
			else{
				echo"<td align='center'><img src=./images/rm.png><br>Incomplete</td></tr>";
				$req[7]="notok";
			}
////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////






if($occupation!="bcs_student"){
////requ:7 pass the CLC//////////////////////////////////////////////////////////////////

//////condition 7 clculation part//////////////////////

///display 7th condition///////////////////////////////

	if(!in_array("computer_science",$subjectA)){
	                $get_grade="select grade from results where index_number='$student_ID' and subject='ICT1b13' order by year";
                    $result_grade=mysql_query("$get_grade");
                    while($row=mysql_fetch_array($result_grade)){
                        $grade=$row['grade'];
                            }



		echo"<tr class=trbgc><td align='center'>9</td><td><font class=minreq>* Pass the examination of Computer Literacy Course (ICT1b13)</form> </br></br>";
		if(mysql_num_rows($result_grade)==0){
			echo"<font class=order>Result not release yet! </font></td><td align='center'><img src=./images/rm.png><br>Incomplete</td></tr>";
						}
		else{
			if($grade=="Pass"){
				echo"[ <font color=red>Pass CLC (ICT1b13) </font> ]</td><td align='center'><img src=./images/conf31.png><br>Complete</td></tr>";
				$req[8]="ok";
					}
            elseif($grade=="Fail"){
				echo"[ <font color=red>Fail CLC (ICT1b13)</font></td><td align='center'><img src=./images/rm.png><br>Incomplete</td></tr>";
				$req[8]="notok";
				}
            else{
                echo"[ <font color=red> CLC (ICT1b13) Result is ".strtoupper($grade)."</font> ]</td><td align='center'><img src=./images/rm.png><br>Incomplete</td></tr>";
                $req[8]="notok";
            }
			}
							}

//////////////////////////////////////////////
}

////////////////////////////////////////////////////////////////////////////////////////

////requ:8 pass the bio maths//////////////////////////////////////////////////////////////////

	if($occupation=="bio_student"){

//////condition 8 clculation part//////////////////////
		///get grade for bio maths///////////////////

        $get_gradebm="select grade from results where index_number='$student_ID' and subject='MAT1142' order by year";
        $result_gradebm=mysql_query("$get_gradebm");
        while($rowbm=mysql_fetch_array($result_gradebm)){
            $gradebm=$rowbm['grade'];
                            }

            /////////////////////////////////////////

            //set value for above grade////
                    switch($gradebm){
                        case "A+":
                            $valuebm=4;
                            break;
                        case "A":
                            $valuebm=4;
                            break;
                        case "A-":
                            $valuebm=3.7;
                            break;
                        case "B+":
                            $valuebm=3.3;
                            break;
                        case "B":
                            $valuebm=3;
                            break;
                        case "B-":
                            $valuebm=2.7;
                            break;
                        case "C+":
                            $valuebm=2.3;
                            break;
                        case "C":
                            $valuebm=2;
                            break;
                        case "C-":
                            $valuebm=1.7;
                            break;
                        case "D+":
                            $valuebm=1.3;
                            break;
                        case "D":
                            $valuebm=1;
                            break;
                        default:
                            $valuebm=0;
                            break;
                            }

            /////////////////////////////

////////////////////////////////////////////////////////

///display 8th condition///////////////////////////////

		echo"<tr class=trbgc><td align='center'>10</td><td>* Pass in course unit MAT1142 (Mathematics of Biology) </br></br>";
		if(mysql_num_rows($result_gradebm)==0){
			echo"[ <font color=red>Result not release yet! </font> ]</td><td align='center'><img src=./images/rm.png><br>Incomplete</td></tr>";
							}
		else{
			if($valuebm>=2){
				echo"[ <font color=red>Pass MAT1142 </font> ]</td><td align='center'><img src=./images/conf31.png><br>Complete</td></tr>";
				$req[9]="ok";
					}
			else{
				echo"[ <font color=red>Fail MAT1142 </font> ]</td><td align='center'><img src=./images/rm.png><br>Incomplete</td></tr>";
				$req[9]="notok";
				}
			}

//////////////////////////////////////////////
						}

////////////////////////////////////////////////////////////////////////////////////////////

		echo"</table>";

///////////////////////////////////////////////////////////////////////////////////////////////////

/////////check class////////////////////////////////////////////////////////////////////////////////

//check satisfy minimum requ for class///////////////

		if(!in_array("notok",$req)){

/////check class calculation part////////
        $getAorBcdt=array();
        $getAorBcdt=$gpa->chkAorBcredit($student_ID);
		$a_more=$getAorBcdt[0];
		$b_more=$getAorBcdt[1];
//////////////////////////////////////////

/////display class////////////////

			if((round($crtgpa,2)>=3.7) && ($a_more>=40)) {
				if($role=="student"){
					echo"</br><blink><h3><font color=blue> CONGRATULATION ! YOU HAVE FIRST CLASS</font><font color=red> (Unconfirmed and Not Official)</font></font></h3></blink>";
							}
				else{
					echo" </br><blink><h3><font color=blue> $full_name HAS FIRST CLASS</font></h3></blink>";
					}
								}
			elseif((round($crtgpa,2)>=3.3) && ($b_more>=40)) {
				if($role=="student"){
					echo"</br><blink><h3><font color=green>CONGRATULATION ! YOU HAVE SECOND UPPER CLASS</font><font color=red> (Unconfirmed and Not Official)</font></h3></blink>";
							}
				else{
					echo"</br><blink><h3><font color=green>$full_name HAS SECOND UPPER CLASS</font></h3></blink>";
					}
								}
			elseif((round($crtgpa,2)>=3.0) && ($b_more>=40)) {
				if($role=="student"){
					echo"</br><blink><font color=green size=3px>CONGRATULATION ! YOU HAVE SECOND LOWER CLASS</font><font color=red> (Unconfirmed and Not Official)</font></blink></br>";
							}
				else{
					echo"</br><blink><font color=green size=3px> $full_name HAS SECOND LOWER CLASS</font></blink></br>";
					}
								}
			else{
				if($role=="student"){
					echo"</br><blink><h3>You have General Degree with normal PASS<font color=red> (Unconfirmed and Not Official)</font></h3></blink>";
							}
				else{
					echo"</br><blink><h3> $full_name has General Degree with normal PASS</h3></blink>";
					}
				}

///////////////////////////////////////////////

						}

/////////////////////////////////////////////////////////

	else{
	    if($role=="student"){
			echo"<br><h3><font color=red>Sorry! your degree is incomlete</font><font color=red> (Unconfirmed and Not Official)</font></h3>";
			}
        else{
            echo"<br><h3><font color=red>$full_name degree is incomlete</font></h3>";
        }
		}
////////////////////////////////////////////////////////////////////////////

////display class req:table////////

			echo"<br><table><caption>Requirement for Award of Honours for B.Sc.(General) degree</caption><tr><th>Class</th><th>Requirement</th></tr>";
			echo"<tr class=trbgc><td>First Class Honours</td><td>1. A minimum GPA of 3.70 </br>2. Grades of A or better in course units aggregating to a minimum of 40 credits</td></tr><tr class=trbgc><td>Second Class (Upper Division)</td><td>1. A minimum GPA of 3.30</br>2. Grades of B or better in course units aggregating to a minimum of 40 credits</td></tr><tr class=trbgc><td>Second Class (Lower Division)</td><td>1. A minimum GPA of 3.00</br>2. Grades of B or better in course units aggregating to a minimum of 40 credits</td></tr></table></br>";

////////////////////////////////////
echo"<hr class=bar>";
		}
//
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//check gpa of all student for admin,dean or SAR///////////////////////////////////////////////////////////////////////////////////////////

///select level form//////////////////////////////////////

if($role!="student"){


	echo"<h3>*** Check GAP for All Students ***</h3>";
	echo"<table class=bgc><tr><td align=center>";
	echo"<font color=red>( Select level and stream to check GPA )</font>";
	echo"<form action='index.php?view=admin&admin=63&task=selectlevel' method='post'>";
	echo"Level : <select name='level'><option value='select level'>Select Level</option>";

	$get_level="select level from level";
	$result_level=mysql_query("$get_level");
	while($row=mysql_fetch_array($result_level)){
		$level=$row['level'];

		if($level==0){
			echo"<option value=$level>Pass Out</option>";
				}
		else{
			echo"<option value=$level>Level $level</option>";
				}
							}
	echo"</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Stream : <select name='stream'>";
	echo"<option value='All'>ALL STUDENTS</option>";
	$get_stream="select distinct stream from student";
	$result_stream=mysql_query("$get_stream");
	while($row=mysql_fetch_array($result_stream)){
		$stream=$row['stream'];
		echo "<option value='$stream'>".strtoupper($stream).". SCIENCE</option>";
							}
	echo"</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='View'></form>";
	echo"</td></tr></table>";
			}

//////////////////////////////////////////////////

///select level process////////////////////////////////////////////////

if($task=="selectlevel"){
	$level=$_POST['level'];
	$stream=$_POST['stream'];


if($level!="select level"){




//select student for enter level & stream//////////

	$reqA=array();
     $fmviweque="$rmsdb.fohssmisStudents fs";
    if($stream=="All"){
    $get_stdid="select s.id, concat(s.l_name,' ',s.initials) as full_name, s.batch, s.stream, l.level from student s, level l, $fmviweque where l.level='$level' and length(s.stream)='3' and l.year=s.year and concat('sc',s.id)=fs.user_name order by s.id";
        }
    else{
	$get_stdid="select s.id, concat(s.l_name,' ',s.initials) as full_name, s.batch from student s, level l, $fmviweque where l.level='$level' and l.year=s.year and s.stream='$stream' and concat('sc',s.id)=fs.user_name order by s.id";
	}


	$result_stdid=mysql_query("$get_stdid");

//////////////////////////////////////////////////

////////display all student gpa table///////////////////////////////
    if(mysql_num_rows($result_stdid)!=0){
	echo"<br><table width=95%>";
	if($level==0){
		echo"<caption>GPA Status of ".ucfirst($stream).". Science, Recently Passout Students</caption>";
			}
	else{
		echo"<caption>GPA Status of Level $level and ".ucfirst($stream).". Science Students</caption>";
		}
	echo"<tr><th>#<th>Student No</th><th>Name with Initials</th><th> No of Total Credits</th><th>Current GPA Value</th><th>Degree Status</th></tr>";
	$f=0;
	$su=0;
	$sl=0;
	$g=0;
	$in=0;
    $gparw=1;
    $allgpavalues=array();
     $gparvl=0;
	while($row=mysql_fetch_array($result_stdid)){
		$student_ID=$row['id'];
		$full_name=$row['full_name'];
        $stbatch=$row['batch'];
		////////////////////////get st section//////////////////
		$get_occu="select occupation from $rmsdb.fohssmis where user='sc$student_ID'";
		$result_occu=mysql_query("$get_occu");
		while($row=mysql_fetch_array($result_occu)){
			$occupation=$row['occupation'];
							}
		////////////////////////////////////////////////////////

//////////cal gpa/////////////////////////////////

		$allcrtgpavar=$gpa->calcurrentgpa($student_ID);
        $allgpavalues["$student_ID"]=round($allcrtgpavar[0],2);

        $crtgpa=round($allcrtgpavar[0],2);
//////////////////////////////////////////////

		echo"<tr class=trbgc><td align='center'>$gparw<td align='center'>SC/$stbatch/$student_ID</td><td>$full_name</td>";

///check satisfy minimum requ for class////////////////////////////////////////

///////requ:1 min credit 90////////////////
		$sumcredit=$gpa->crrtotcredit($student_ID);
		if($sumcredit>=90){
			$reqA[0]="ok";
					}
		else{
			$reqA[0]="notok";
			}

//////////////////////////////////////////
echo"<td align='center'>$sumcredit</td><td align='center'>".round($allcrtgpavar[0],2)."</td>";
///requ:2 C or better min credit 60% theory core course
		$subjectA=array();

        $subjectA=$gpa->mainsubject($student_ID);
		$check=array();
		for($i=0;$i<count($subjectA);$i++){
		    $getallsubcocredit=$gpa->allsubcocredit($subjectA[$i]);
            $corbtcdt=$gpa->chkcorbetter($student_ID,$subjectA[$i]);

            $getcoptg=($corbtcdt/$getallsubcocredit)*100;
            $coptg=round($getcoptg,2);
			if($coptg>=60){
				$check[$i]="yes";
					}
			else{
				$check[$i]="no";
				}
							}
		if(in_array("no",$check)){
			$reqA[1]="notok";
						}
		else{
			$reqA[1]="ok";
			}


///////////////////////////////////////////////////

///requ:3 24 min credit for main subjects



	if($occupation!="bcs_student"){
	$subjectAll=array();

    $subjectAll=$gpa->mainsubject($student_ID);


	
	$check=array();
	for($i=0;$i<count($subjectAll);$i++){

		$getallsubcredit=$gpa->allsubcredit($student_ID,$subjectAll[$i]);
    
		if($getallsubcredit>=24){
			$check[$i]="yes";
			}
		else{
			$check[$i]="no";
			}
		}

	if(in_array("no",$check)){
		$reqA[2]="notok";
		}
	else{
		$reqA[2]="ok";
		}
	}



///////////////////////////////////////////////////

///requ:3 D+ or better min credit 60% optional course
		 $alopcdt=$gpa->allopcredit($student_ID);
         $dorbeterptg=$gpa->allopcorbetter($student_ID);
         $calprctage=($dorbeterptg/$alopcdt)*100;
         $dorbtptge=round($calprctage,2);
		if($dorbtptge>=60){
			$reqA[3]="ok";
					}
		else{
			$reqA[3]="notok";
			}

////////////////////////////////////////////////////

///requ:4 C- or better min credit 60% all practical core course

        $alprcredit=$gpa->allpracticalunit($student_ID);
          $cminorbt=0;
            for($j=0;$j<count($subjectA);$j++){

                $gtcminorbtcrdt=$gpa->chkprcminorbetter($student_ID, $subjectA[$j]);
                $cminorbt=$cminorbt+$gtcminorbtcrdt;

            }

        $calprctage=($cminorbt/$alprcredit)*100;

		if($calprctage>=100){
			$reqA[4]="ok";
					}
		else{
			$reqA[4]="notok";
			}

///////////////////////////////////////////////////////////

///requ:5 GPA is 2 or more/////////////////////
		if($crtgpa>=2){
			$reqA[5]="ok";
				}
		else{
			$reqA[5]="notok";
			}

//////////////////////////////////////////////

//////requ:6 pass the english level 1& 11///
		 $codeA=array();
         $codeA=$gpa->checkENGresult($student_ID);
		if(count($codeA)==2){
			$reqA[6]="ok";
					}
		else{
			$reqA[6]="notok";
				}

//////////////////////////////////////////

//////requ:7 pass the CLC////////////////
if($occupation!="bcs_student"){

		if(!in_array("computer_science",$subjectA)){
		    $get_grade="select grade from results where index_number='$student_ID' and subject='ICT1b13' order by year";
                    $result_grade=mysql_query("$get_grade");
                    while($row=mysql_fetch_array($result_grade)){
                        $grade=$row['grade'];
                            }

			if($grade=="Pass"){
				$reqA[7]="ok";
					}
			elseif($grade=="Fail"){
				$reqA[7]="notok";
				}
			else{
                $reqA[7]="notok";
                }
								}
		else{
			$reqA[7]="ok";
					}


}

////////////////////////////////////////////////

//////requ:8 pass the bio maths////////////////

		if($occupation=="bio_student"){
		$valuebm=0;
        $get_gradebm="select grade from results where index_number='$student_ID' and subject='MAT1142' order by year";
        $result_gradebm=mysql_query("$get_gradebm");
        while($rowbm=mysql_fetch_array($result_gradebm)){
            $gradebm=$rowbm['grade'];
                            }

            /////////////////////////////////////////

            //set value for above grade////
                    switch($gradebm){
                        case "A+":
                            $valuebm=4;
                            break;
                        case "A":
                            $valuebm=4;
                            break;
                        case "A-":
                            $valuebm=3.7;
                            break;
                        case "B+":
                            $valuebm=3.3;
                            break;
                        case "B":
                            $valuebm=3;
                            break;
                        case "B-":
                            $valuebm=2.7;
                            break;
                        case "C+":
                            $valuebm=2.3;
                            break;
                        case "C":
                            $valuebm=2;
                            break;
                        case "C-":
                            $valuebm=1.7;
                            break;
                        case "D+":
                            $valuebm=1.3;
                            break;
                        case "D":
                            $valuebm=1;
                            break;
                        default:
                            $valuebm=0;
                            break;
                            }

            /////////////////////////////

						if($valuebm>=2){
							$reqA[8]="ok";
								}
						else{
							$reqA[8]="notok";
							}
									}
						else{
							$reqA[8]="ok";
								}

////////////////////////////////////////////////
//fsc 6 credit limit
		$alfsccdt=$gpa->allfsccredit($student_ID);

			
					if($alfsccdt<=6){
						
						$reqA[9]="ok";
					}
					else{
						
						$reqA[9]="notok";
					}






/////check class calculation part////////


		if(!in_array("notok",$reqA)){
			 $getAorBcdt=array();
             $getAorBcdt=$gpa->chkAorBcredit($student_ID);


             $a_more=$getAorBcdt[0];
             $b_more=$getAorBcdt[1];

			if(($crtgpa>=3.7) && ($a_more>=40)) {
				echo"<td align='center'><font color=blue><b>FIRST CLASS</b></font></td></tr>";
				$f=$f+1;
								}
			elseif(($crtgpa>=3.3) && ($b_more>=40)) {
				echo"<td align='center'><font color=green><b>Second Upper Class</b></td></tr>";
				$su++;
									}
			elseif(($crtgpa>=3.0) && ($b_more>=40)) {
				echo"<td align='center'><font color=green>Second Lower Class</td></tr>";
				$sl++;
									}
			else{
				echo"<td align='center'>General Pass</td></tr>";
				$g++;
				}
						}

		else{
			//echo"<td>$reqA[0].$reqA[1].$reqA[2].$reqA[3].$reqA[4].$reqA[5].$reqA[6].$reqA[7].$occupation";
			echo"<td align='center'><font color=red>Incomplete.</font></td></tr>";
			$in=$in+1;
			}

//////////////////////////////////////////
		$gparw++;
        $gparvl++;
					}
	echo"</table>";
    $maxgpa=max($allgpavalues);
    $mingpa=min($allgpavalues);



    $maxgpast = array_search($maxgpa, $allgpavalues);
    $mingpast = array_search($mingpa, $allgpavalues);



$mxgpast= count(array_keys($allgpavalues, $maxgpa));
$mngpast= count(array_keys($allgpavalues, $mingpa));


if($mxgpast==1){
    $maxgpastbt=$n->getBatch($maxgpast);
    $maxgpastnm=$n->getName($maxgpast);
echo"<br><font color=black size=3px>Maximum GPA  Value : ".round($maxgpa,2)." ( SC/$maxgpastbt/$maxgpast - ".strtoupper($maxgpastnm)." )";
}
else{
echo"<br><font color=black size=3px>Maximum GPA  Value : ".round($maxgpa,2)." ( $mxgpast Students Have This GPA Value )<br>";
   echo"<table border=1 cellspacing=0 cellspadding=0>";
   for($k=0;$k<$mxgpast;$k++){
           $othermaxgpast= array_keys($allgpavalues, $maxgpa);

            $othmaxgpastbt=$n->getBatch($othermaxgpast[$k]);
            $othmaxgpastnm=$n->getName($othermaxgpast[$k]);
            echo"<tr class=trbgc><td align=center>";
            echo"SC/$othmaxgpastbt/$othermaxgpast[$k]<td>&nbsp;&nbsp; $othmaxgpastnm </tr>";

   }
   echo"</table>";


}


echo"<br> Minimum GPA Value : ".round($mingpa,2);
if($mngpast==1){
    $mingpastbt=$n->getBatch($mingpast);
    $mingpastnm=$n->getName($mingpast);
   echo" ( SC/$mingpastbt/$mingpast - ".strtoupper($mingpastnm)." )";
}
else{
echo" ( $mngpast Students Have This GPA Value )";
}
echo"</font><br><br>";
////////////////////////////////////////////////////////////////////////////////

////display no of student has class//////////////

echo"<table class=bgc width=40%><tr><td><font color=blue><b>NO OF FIRST CLASS STUDENT</b></font></td><td><font color=blue><b>: $f</b></font></td></tr>
<tr><td><font color=green><b>No of Second Upper Class student</b></font></td><td><font color=green><b>: $su</b></font></td></tr>
<tr><td><font color=green>No of Second Lower Class student</font></td><td><font color=green>: $sl</font></td></tr>
<tr><td>No of General Pass student</td><td>: $g</font></td></tr>
<tr><td><font color=red>No of Degree Incomplete student</font></td><td><font color=red>: $in</font></td></tr></table>";
///////////////////////////////////////////////



}
else{
    echo"<font color=red>Sorry! Cannot find information.</font>";
}
							}
else{
    echo"<font color=red>Sorry! Please select students Level to find GPA.";
}



				}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


?>


<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}
else{

echo "You Have Not Permission To Access This Area!";}

?>
 