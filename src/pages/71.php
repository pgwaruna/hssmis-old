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
if($qpers['id']=="71"){
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
  function chkdelcnf(){
        var cnf=confirm("Do you realy want, Delete This Form ?  \nIf yes Click [OK] ");
        if(cnf==true){
            return true;
        }
        else{
            return false;
        }
        
       } 
</script>







<?php
require_once('./classes/globalClass.php');
$p=new settings();
$due=$_GET['due'];
$redt=$_GET['redt'];
$curacyear=$p->getAcc();
$userdept=$_SESSION['section'];
echo"Student Feedback Questionnaire";
echo"<hr class=bar>";

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// submit Evaluation Form ////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($task=="setevlfm"){
		$getevlcd=$_POST['sndpercode'];
		$getevlcddis=$_POST['sndpercodedis'];
		$trorpr=$_POST['trorpr'];
		if($getevlcd!=null){
			$_SESSION['setevlcdss']=$getevlcd;
			$_SESSION['setevlcddisss']=$getevlcddis;
			$_SESSION['setevltype']=$trorpr;
					}

	$evlcd=$_SESSION['setevlcdss'];
	$evlcddis=$_SESSION['setevlcddisss'];
	$evlcdtyp=$_SESSION['setevltype'];




//////////////////////////////////////////////////////////
/////////////////// enter dt to db ///////////////////////
//////////////////////////////////////////////////////////
if($due=="entbl"){
$nofque=$_POST['nofque'];
$filcode=$_POST['filcode'];
$filacyear2=$_POST['acyear'];
	$_SESSION['get_rw_acy']=$filacyear2;
	$filacyear=$_SESSION['get_rw_acy'];

$lect_name2=$_POST['lect_name'];
	$_SESSION['get_lec_nm']=$lect_name2;
	$lect_name=$_SESSION['get_lec_nm'];

//$student_name=$_POST['student_name'];

$sub_date2=$_POST['sub_date'];
	$_SESSION['get_sub_dt']=$sub_date2;
	$sub_date=$_SESSION['get_sub_dt'];


//echo$filcode.$lect_name.$student_name.$sub_date;
/////////////////////////////////////////////////////////////////////////////
/////////////////////////// edit form////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
if($redt=="updt"){
$uplect_name=$_POST['uplect_name'];
$uprwacyear=$_POST['uprwacyear'];
//$upstudent_name=$_POST['upstudent_name'];
$upsub_date=$_POST['upsub_date'];

$edtpid=$_POST['edtpid'];
$submopt=$_POST['submopt'];
$nofqn=$_POST['nofqn'];

//echo$uplect_name.$uprwacyear.$upstudent_name.$upsub_date.$edtpid.$submopt;
///////////////////////////////////////////////////////////////////////
///////////////////////////Update Form/////////////////////////////////
///////////////////////////////////////////////////////////////////////
if($submopt=="Update Form"){
$queupdtpidses="update student_evaluation_session set ac_year='$uprwacyear',lect_name='$uplect_name',submit_date='$upsub_date' where student_evl_id=$edtpid";
$quupdtpidses=mysql_query($queupdtpidses);
if($quupdtpidses){
	for($uq=1;$uq<=$nofqn;$uq++){
		$getnewelm="recrtans".$uq;
		$getneans=$_POST[$getnewelm];
		//echo$getneans;
			$queupdtans="update  student_evaluation_status set answer='$getneans' where que_no=$uq and student_evl_id=$edtpid";
			mysql_query($queupdtans);

					}
echo"<font color=blue>Form Succsefuly Updated.</font>";
			}
}
///////////////////////////////////////////////////////////////////////
////////////////////// end Update Form/////////////////////////////////
///////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////
///////////////////////////delete Form/////////////////////////////////
///////////////////////////////////////////////////////////////////////

if($submopt=="Delete Form"){
	$quedelses="delete from  student_evaluation_session where student_evl_id=$edtpid";
	$qudelses=mysql_query($quedelses);

		if($qudelses){
			$quedelsts="delete from student_evaluation_status where student_evl_id=$edtpid";
			$qudelsts=mysql_query($quedelsts);

			if($qudelsts){echo"<font color=blue>Form Succsefuly Deleted.</font>";}
	

				}
}
///////////////////////////////////////////////////////////////////////
/////////////////////// end delete Form////////////////////////////////
///////////////////////////////////////////////////////////////////////




}/////////////////////////////////////////////////////////////////////////////
////////////////////////end edit form/////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
else{


	$queinsprses="insert into  student_evaluation_session(course_unit,ac_year,lect_name,course_type,submit_date) values('$filcode', '$filacyear', '$lect_name', '$evlcdtyp','$sub_date')";
	$quinsprses=mysql_query($queinsprses);

	if($quinsprses){
		$quegetmxpid="SELECT MAX(student_evl_id) as maxpid FROM student_evaluation_session";
		$qugetmxpid=mysql_query($quegetmxpid);
		$qgetmxpid=mysql_fetch_array($qugetmxpid);
			$getmaxp_id=$qgetmxpid['maxpid'];



		for($grd=1;$grd<=$nofque;$grd++)
			{
			$rdbttn=$_POST[$grd];
			//echo$grd."-".$rdbttn."<br>";
			$queinsqnqns="insert into student_evaluation_status(student_evl_id,que_no,answer) values ($getmaxp_id,$grd,'$rdbttn')";
			mysql_query($queinsqnqns);
			}
	echo"<font color=blue>Form Succsefuly Inserted.<br>(If you want to edit previous session Please use following table unless ignore this table.)</font>";

		$quegetprvdata="select * from student_evaluation_session where student_evl_id=$getmaxp_id";
		$qugetprvdata=mysql_query($quegetprvdata);
		echo"<table border=0 width=100%><tr class=faccolor><td align=center><font color=#ffffff><b>Lecturer Name &<br> Review Academic Year<td align=center><b><font color=#ffffff>Submit Date";
			for($q=1;$q<=$nofque;$q++){
				echo"<td align=center><font color=#ffffff><b>Que : $q</b></font></td>";
							}


		while($qgetprvdata=mysql_fetch_array($qugetprvdata)){
				$course_unit=$qgetprvdata['course_unit'];
				$ac_year=$qgetprvdata['ac_year'];
				$lect_name=$qgetprvdata['lect_name'];
				//$student_name=$qgetprvdata['student_name'];
				$submit_date=$qgetprvdata['submit_date'];
		echo"<form method=post action='./index.php?view=admin&admin=71&task=setevlfm&due=entbl&redt=updt' id='cnfdelfm'><tr class=trbgc>";
			echo"<td align=center><input type=text name=uplect_name value='$lect_name' size=15><br>";
			echo"<input type=text name=uprwacyear value='$ac_year' size=15>";
			echo"<td align=center><input type=text name=upsub_date value='$submit_date' size=8>";
			


				$quegetprvans="select * from student_evaluation_status where student_evl_id=$getmaxp_id order by que_no";
				$qugetprvans=mysql_query($quegetprvans);
				while($qgetprvans=mysql_fetch_array($qugetprvans)){				
						$gtquen=$qgetprvans['que_no'];
						$gtans=$qgetprvans['answer'];
						
						echo"<td align=center>";
							echo"<select name=recrtans$gtquen  width='40' style='width: 40px'>";
								echo"<option value=''>...</option>";
								for($ras=1;$ras<=5;$ras++){
									if($ras==$gtans){
										echo"<option value=$ras selected>$ras</option>";
											}
									else{
										echo"<option value=$ras>$ras</option>";
										}

												}
								/*if($gtans=="NA"){
									echo"<option value='NA' selected>NA</option>";
											}
								else{echo"<option value='NA'>NA</option>";}*/
																


							echo"</select>";

											}
					$clsp=2+$gtquen;
			echo"<tr class=trbgc><td colspan=$clsp align=center>";
				echo"<input type=hidden name=nofqn value=$gtquen>";
				echo"<input type=hidden name=edtpid value=$getmaxp_id>";
				echo"<input type=submit name=submopt value='Update Form'>";
				echo"<input type=submit  name=submopt value='Delete Form' onclick='return chkdelcnf(cnfdelfm)'>";

		echo"</form>";
									}
		echo"</table>";

				}///////////inse que sucs if close/////
	else{echo"<br><font color=red>Sorry! There is a problem with inserting please try again.</font>";}



}
}
//////////////////////////////////////////////////////////
/////////////// end enter dt to db ///////////////////////
//////////////////////////////////////////////////////////









	//echo$evlcd;
$quegetque="select * from  student_evaluation_questions where course_type='$evlcdtyp' and que_version=1 order by que_no";
$qugetque=mysql_query($quegetque);
if(mysql_num_rows($qugetque)==0){
	echo"<font color=red>Sorry! Can not find Questions.</font>";
					}
else{
echo"<div align=right>[ <a href='./index.php?view=admin&admin=71'>Back to Course Unit List </a>]</div>";
echo"<form method=post action='./index.php?view=admin&admin=71&task=setevlfm&due=entbl'>";
echo"<table border=0><th colspan=8 align center height=30px>Student Feedback Questionnaire - ".ucfirst($evlcdtyp)." Course Unit for $evlcddis";
echo"<input type=hidden name=filcode value='$evlcd'>";

//////////////////////////////////lect name//////////////////////////////////////////////////////////////////
echo"<tr class=trbgc height=30px><td colspan=2 width=60%>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name of the Lecturer: ";
	echo"<input type=text name=lect_name size=28 value='$lect_name'>";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


echo"<td colspan=6>Review Academic Year : ";
echo"<select name=acyear>";
	$quegtacyr="select acedemic_year from acc_year order by acedemic_year DESC limit 3";
	$qugtacyr=mysql_query($quegtacyr);
	while($qgtacyr=mysql_fetch_array($qugtacyr)){
		$gtacyr=$qgtacyr['acedemic_year'];
		if($filacyear=="$gtacyr"){
		echo"<option value='$gtacyr' selected>$gtacyr</option>";
						}
		else{
		echo"<option value='$gtacyr'>$gtacyr</option>";
			}
							}
echo"</select>";




while($qgetque=mysql_fetch_array($qugetque)){
	$qusno=$qgetque['que_no'];
	$question=$qgetque['question'];
	echo"<tr class=trbgc height=30px><td align=center width=3%>$qusno.<td>&nbsp;$question";
		for($cb=1;$cb<=5;$cb++){
		echo"<td width=5% class=selecttdbg>";
			echo"<table border=0><tr>";
				echo"<td>$cb<td><input type=radio name='$qusno' value=$cb>";
			echo"</tr></table>";

					}
	/*echo"<td width=5% class=selecttdbg>";
			echo"<table border=0><tr>";
				echo"<td>NA<td><input type=radio name=$qusno value=NA>";
			echo"</tr></table>";*/






						}
	echo"</tr>";

//////////////////////////////////student name adn date///////////////////////////////////////
echo"<tr class=trbgc height=30px>";
	//echo"<input type=text name=student_name size=30>";
echo"<td colspan=7 align=right>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Evaluated Date : ";
	echo"<input type=text name=sub_date size=15 placeholder='yyyy-mm-dd' value='$sub_date'>";
//////////////////////////////////////////////////////////////////////////////////////////

echo"</tr><th colspan=8 align center><input type=hidden name=nofque value=$qusno><input type=submit value='Submit The Form'></tr>";
echo"</table>";

echo"</form>";
}///else close///////////


}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////end submit Evaluation Form ////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////





//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////// display course unit list //////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<br><font size=3px>*** Select Course Unit to Enter Student Feedback Questionnaire *** </font><br>";
//$role="lecturer";

if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
$quegetcodelst="select code,name,department from courseunit where availability=1 order by department,code";
}
else{
$quegetcodelst="select code,name,department from courseunit where availability=1 and department='$userdept' order by department,code";
}
//echo$quegetcodelst;

$qugetcodelst=mysql_query($quegetcodelst);

if(mysql_num_rows($qugetcodelst)==0){
	echo"<br><font color=red>Sorry! can not find course unit informations.</font>";
					}
else{
echo"<table border=0><tr height=30px><th>#<th>Course Unit<th>Course Name<th>Department<th>Type<th>Submit</tr>";
$rn=1;
while($qgetcodelst=mysql_fetch_array($qugetcodelst)){
		$percode=trim($qgetcodelst['code']);
		$percdname=$qgetcodelst['name'];
		$percddept=$qgetcodelst['department'];
			///////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////
								$coursegetchr=trim($percode);
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
	echo"<form method=post action='./index.php?view=admin&admin=71&task=setevlfm'>";
	echo"<tr class=trbgc align=center><td>$rn<td>$fulcode<td align=left> &nbsp;&nbsp;".ucfirst($percdname)."<td>".ucfirst($percddept)."<td>";
	echo"<select name=trorpr>";
		echo"<option value='theory' selected>Theory</option>";
		echo"<option value='practical'>Practical</option>";
	echo"</select><td>";


	echo"<input type=hidden name=sndpercode value='$percode'>";
	echo"<input type=hidden name=sndpercodedis value='$fulcode'>";
	
	

	echo"<input type=submit value='Submit for $fulcode'>";


	echo"</tr></form>";
$rn++;
							}//////////////while close


echo"</table>";
}/////////////else close

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////// end display course unit list //////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>





<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>
