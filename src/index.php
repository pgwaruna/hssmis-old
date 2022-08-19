<?php
session_start();
error_reporting(-1);

@$admin=$_GET['admin'];
@$task=$_GET['task'];
@$getdue=$_GET['due'];
@$attdisp=$_GET['attdisp'];
@$view=$_GET['view'];
?>
<link rel="shortcut icon" href="images/logo.gif">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Faculty of Humanities and Social Sciences, University of Ruhuna | Management Information System | [ H S S M I S ]</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="author" content="Iranga Muthumala, Sathiska Udayanga and Amal Ranganath" />
<meta name="Keywords" content="Faculty of Humanities and Social Sciences, University of Ruhuna" />
<meta name="Description" content="MIS of faculty of Humanities and Social Sciences" />

<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />

<link href="css/fosmiscss.css" rel="stylesheet" type="text/css"/>
<link href="style/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="style/jquery.min.js"></script>
<script src="style/jquery-ui.min.js"></script>
<script src="style/jquery.tooltip.js"></script>

<noscript><meta http-equiv="refresh" content="0; url=jsnotspt.php"></noscript>

<script type="text/javascript" src="Ajax/tasks.js"></script>



<!--///////////////////////////////////////////////////////////////////
////////////////////////////must cng pwd///////////////////////////////
///////////////////////////////////////////////////////////////////////
-->
<script>
function load(reason)
{
    alert("Periodically password change alert!\nPlease change your password.");
       window.location = "mpcng.php?rea_cng="+reason
 }
</script>
<!--///////////////////////////////////////////////////////////////////
////////////////////////////must cng pwd///////////////////////////////
///////////////////////////////////////////////////////////////////////
-->



<script language="JavaScript" type="text/JavaScript">
function smenu(ele){
document.getElementById(ele).style.visibility="visible"
}

function hmenu(ele){
document.getElementById(ele).style.visibility="hidden"
}
</script>








</head>
<body>
<?php
//////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////set var for dis rumis dont edit///////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
// Block Students for checking the system
//$uid=$_SESSION['user_id'];
//echo "<br>Hello - ".$uid;
//if($uid === "" || $uid === null){
//    //do nothing
//} else {
//    if($uid === 'hssmis'){
//        //do nothing
//    }elseif ($uid === 'hs17620'){
//        //do nothing
//    }elseif($uid === 'hs17141'){
//        //do nothing
//    }elseif($uid === 'hs16989'){
//        //do nothing
//    }elseif($uid === 'hs16587'){
//        //do nothing
//    }elseif($uid === 'sarhss'){
//        //do nothing
//    }elseif($uid === 'hs16222'){
//        //do nothing
//    }elseif($uid === 'hs16191'){
//        //do nothing
//    }elseif($uid === 'hs17137'){
//        //do nothing
//    }elseif($uid === 'hs16746'){
//        //do nothing
//    }
//    else{
//        echo"<br>System update in progress, check back later !";
//        exit();
//    }
//}

  if($view=="admin"){
        if(isset($_SESSION['login'])&&($_SESSION['remtgt']!="cntctorumis")){
		
           	$_SESSION['login']="true".$_SESSION['faculty'];
	  	$_SESSION['userhost']=$_SESSION['faculty'];
		
				if($_SESSION['role_id']==1){
					$_SESSION['role_id']=3;
					$_SESSION['role']="administrator";
								}



                                         }        
                               }



if($task=="leaverms"){
header('Location: ../rumis/index.php?task=leaverms');
//echo "<meta http-equiv='refresh' content='0;URL=../rumis/index.php?task=leaverms'>"; 
			}
///////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// end set var for dis rumis dont edit //////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
//echo$_SESSION['rumis_access'].$_SESSION['userhost'].$_SESSION['login'];

echo"<div id=a>";



include'connection/connection.php';
////////////////////// validate date from all registration on/off///////////////////////// 
include 'datevalidation.php';
//////////////////////////////////////////////////////////////////////////////////////////






///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////// remort login to site by remort user///////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////don't edit bellow code //////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



if($_SESSION['remtgt']=="cntctorumis"){
echo"<div align='center'>";

//;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;//

if($_SESSION['role_id']==1){
	$_SESSION['role_id']=3;
	$_SESSION['role']="administrator";
	$_SESSION['admswich']="yes";
								}
								
								
$role=$_SESSION['role_id'];
echo"<table border=0 width=95%>";
echo"<tr class=newsbar><td align='center' colspan=2>";
echo'<marquee scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();" style="width:1195px;">Welcome To The Management Information System!';
include('news.php');
echo'</marquee>';
echo"</td></tr>";
echo"<tr><td align='center' width=90%>&nbsp;";

/////////////////////////////////////// mentor view /////////////////////////////////////////////////////////////	
if($role!="6"){
$abc=$_SESSION['user_id'];

$quegtmntid="select mentor_id from mentor where user_name='$abc'";
$qugtmntid=mysql_query($quegtmntid);
if(mysql_num_rows($qugtmntid)!=0){
  while($qgtmntid=mysql_fetch_array($qugtmntid)){
	$_SESSION['Smntid']=$qgtmntid['mentor_id'];
		
						}
	$mntid=$_SESSION['Smntid'];
	echo"<table border='0' width='95%'><tr>";
	echo"<td width='40'><img border='0' src='images/mentor.png' align='right'></td>";
	echo"<form method='POST' action='./forms/mentor.php?task=check'><td valign='middle'>";
	echo"<input type='submit' value='Check Your Mentoring Students'>";
	echo"</form></td></tr></table><br>";
}

}
/////////////////////////////////////end mentor view////////////////////////////////////////////////////////////////	

echo"<td align=center>";
//////////////////////////////////// view Special notice //////////////////////////////////////////
		$quechknt="select Notice_ID,date_time from notice where Status<>0 order by Notice_ID";
		
		$quchknt=mysql_query($quechknt);
		if(mysql_num_rows($quchknt)!=0){
			$newnot=array();
			error_reporting(0);
			$today=date("Y-m-d");
			//echo$today;
			$nnot=0;
			while($qchknt=mysql_fetch_array($quchknt)){
				$Notice_ID=$qchknt['Notice_ID'];
				$date_time=$qchknt['date_time'];
					///////////////////////////// check notice new or old////////////////////////////////////
					$gtdatetm=explode("/",$date_time);
						$gtdate=$gtdatetm[0];
						$diff = abs(strtotime($today) - strtotime($gtdate));
			
							$years = floor($diff / (365*60*60*24));
							$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
							$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

								if($years>=1){
									$months=($years*12)+$months;
										}
								if($months>=1){
									$days=($months*30)+$days;
										}
								
									if($days<=7){										
										$newnot[$nnot]="new";
											}
									else{
										$newnot[$nnot]="old";
											$queupaslod="update notice set Status='2' where Notice_ID='$Notice_ID'";
											mysql_query($queupaslod);
										}
														
						$nnot=$nnot+1;

									}// while loop close brec
					//////////////////////////////////////////////////////////////////////////////////////////
												

					if (in_array("new", $newnot)) {
						echo"<a href='./forms/form_53_a.php'><img src='./images/newnote.gif'><br><font size=2px><b>NOTICE</b></font></a>";
										}
					else{
						echo"<a href='./forms/form_53_a.php'><font size=2px ><b>SPECIAL<br> NOTICE </b></font></a>";
						}
	echo"</td></tr>";
						}
	
	///////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////// end view specails notice//////////////////////////////////////

//////event calencer////////
    //echo"<tr><td>";
    
    echo"<tr><td colspan=2 align=center><a href='./pages/75.php'><font size=2px><b>Events</b></font></a>";
    
    
    echo"</td></tr>";
////////////////end event calender///////

	
//////////////////////////////////////// main menu//////////////////////////////////////////////////	
echo"<tr><td colspan=2 align=center>";

$quegetmmenu="select distinct(permi_group) from permission where role_id=".$_SESSION['role_id'];
$qugetmmenu=mysql_query($quegetmmenu);

echo"<table border=0><tr>";
while($qgetmmenu=mysql_fetch_array($qugetmmenu)){
	$prmimenu=$qgetmmenu['permi_group'];

echo"<td align='center' onMouseOver=smenu('tuto$prmimenu') onMouseOut=hmenu('tuto$prmimenu') width=100px><div>";
$pfile=$prmimenu.".gif";
echo "<img src=images/small/$pfile width=65px height=65px><br><font size=4>".ucfirst($prmimenu)."</font><br>";

		$query2="select id,description from permission where role_id=$role and permi_group='$prmimenu'";
		$prev=mysql_query($query2);
		echo"<table class='menu' id='tuto$prmimenu' align='left' border='0'  bgcolor='#f2cff8' width='280px'>";
		while($predata=mysql_fetch_array($prev)){
				echo '<tr><td valign="top" align="left"><font  size="4px"><b> &nbsp;*&nbsp;</b></font>';
					echo "<font  size='3px'><a href=?view=admin&admin=".$predata['id'].">";
					echo $predata['description']."</a></font>";
					echo '</td></tr>';

							}


echo"</table></div></td>";

						}

echo"</tr></table>";

////////////////////////////// end main menu/////////////////////////////////////////////////////////	
	echo"</td></tr></table>";
		////////////////////////// include page/////////////////////////////////////////////////////////////////////////////////
	if(isset($admin)){
			echo '<hr class="bar">';
			$quechkpermi="select id from permission where role_id=".$_SESSION['role_id']." and id=$admin";
			//echo$quechkpermi;
			$quchkpermi=mysql_query($quechkpermi);
				if(mysql_num_rows($quchkpermi)!=0){
						$getfile=$admin.".php";
						//echo$getfile;
						
						////////////////////////////// include permission pages//////////////////////////
						include "pages/$getfile";
						/////////////////////////////////////////////////////////////////////////////////
														}
				else{
					echo"<font color='red'>You have no permission to access this area!</font>";
					}
						}
		////////////////////////// end include page/////////////////////////////////////////////////////////////////////////////////



//;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;//


echo"</div>";
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////don't edit above code ////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////// remort login to site by remort user///////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////












///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////// local login to site by local user/////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else{





$true="true".$_SESSION['userhost'];
$faculty=$_SESSION['faculty'];
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////// attendence display //////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($attdisp=="displayatt"){

if((($_SESSION['login'])=="truefohssmis")&&(($_SESSION['userhost'])!="rumis")){
echo"<div align='center'>";
////////////////////////// include page/////////////////////////////////////////////////////////////////////////////////
	if(isset($admin)){
			echo '<h class="bar">';
		
			$quechkpermi="select id from permission where role_id=".$_SESSION['role_id']." and id=$admin";
			//echo$quechkpermi;
			$quchkpermi=mysql_query($quechkpermi);
				if(mysql_num_rows($quchkpermi)!=0){
						$getfile=$admin.".php";
						//echo$getfile;
						
						////////////////////////////// include permission pages//////////////////////////
						include "pages/$getfile";
						/////////////////////////////////////////////////////////////////////////////////
														}
				else{
					echo"<font color='red'>You have no permission to access this area!</font>";
					}
						}
	////////////////////////// end include page/////////////////////////////////////////////////////////////////////////////////
echo"</div>";
																			}
				}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////end attendence display //////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////// general user page attendence not display ////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else{

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////// header //////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

echo"<table border=0 align='center' width='100%' style='background-image: url(picture/bgpic.jpg); background-repeat: no-repeat ; background-size: 100%;'>";
echo"<tr><td align='center'  width=10%><image src='picture/UoRlogo.png'>";

echo"<td align='left' height=110px width=75%><font size='5'>Faculty of Humanities and Social Sciences </font><br><font size='5'>Management Information System <br>[ H S S - M I S ]</font>";
echo"</td><td align='center' width=150px>&nbsp;";
if((($_SESSION['login'])=="truefohssmis")&&(($_SESSION['userhost'])!="rumis")){
if(($_SESSION['role'])=="student"){
$picname="../rumis/picture/user_pictures/student_std_pics/".$_SESSION['userhost']."_pic/".$_SESSION['ru_st_user_id'].".jpg";
	
		if(file_exists($picname)){
			//echo"<img src='$picname' class='stretch' alt='' width=100px height=110px border=3>";
								}
		else{
			//echo "<img src=../rumis/picture/user_pictures/student_std_pics/SCI_Fac_no_picture.png class='stretch' alt='' width=100px height=110px>";
								}
									}
else{
echo"&nbsp;";
		}

																		}

echo"</td></tr>";

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////end header //////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////// news bar ///////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

echo"<tr class=newsbar><td align='center' colspan=3>";
echo'<marquee scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();" style="width:1145px;">Welcome To The Management Information System! ';
include('news.php');
echo'</marquee>';
echo"</td></tr>";

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////// end news bar ///////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////





/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////// body ///////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////





/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////// login true if//////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if((($_SESSION['login'])=="truefohssmis")&&(($_SESSION['userhost'])!="rumis")){




echo"<tr><td align='center' colspan=3 >";
//echo$_SESSION['user_id'].$_SESSION['last_name'].$_SESSION['initials'].$_SESSION['occupation'].$_SESSION['section'].$_SESSION['email'].$_SESSION['role_id'];
echo"<hr class='bar'>Welcome! ".strtoupper($_SESSION['last_name'])." ".strtoupper($_SESSION['initials']). " | ".$_SESSION['user_id'] ." | ". $_SESSION['curriculum']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ <a href=index.php?view=admin&task=edit>Change My Password</a> ]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ <a href='logoff.php'>Log Out</a> ]<hr class='bar'>";
$role=$_SESSION['role_id'];

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////// the following procedure only for FOSMIS ///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////// view specail notice////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<table border=0 align='center' width=99% ><tr valign='top'>";

echo"<td align='left' height=50px width=50% valign='top' >";

//////////////////////////////////// mentor prosses////////////////////////////////////////////////////////	


//...........role check menteor or not..................
if($role!="6"){
$abc=$_SESSION['user_id'];

$quegtmntid="select mentor_id from mentor where user_name='$abc'";
$qugtmntid=mysql_query($quegtmntid);
if(mysql_num_rows($qugtmntid)!=0){
  while($qgtmntid=mysql_fetch_array($qugtmntid)){
	$_SESSION['Smntid']=$qgtmntid['mentor_id'];
		
						}
	$mntid=$_SESSION['Smntid'];
	echo"<table border='0' width='80%'><tr>";
	echo"<td width='40'><img border='0' src='images/mentor.png' align='right'></td>";
	echo"<form method='POST' action='./forms/mentor.php?task=check'><td valign='middle'>";
	echo"<input type='submit' value='Check Your Mentoring Students'>";
	echo"</form></td></tr></table><br>";
}

}
// On select

if($role !=="6") {

    if (!empty($_POST['curriculum'])) {
        $_SESSION['curriculum'] = $_POST['curriculum'];
    }

// Select curriculum
    echo "<table><tr><td>
    <form action='' method='post'>
    <select size='1' name='curriculum' id='curriculum'>
    <option selected>Select curriculum</option>";

    $curriculum_qry = "select * from curriculum order by cr_name";
    $curriculum_res = mysql_query($curriculum_qry);

    while ($row = mysql_fetch_array($curriculum_res)) {
        $cr_value = $row['cr_value'];
        $cr_name = $row['cr_name'];
        echo "<option value=" . $cr_value . ">" . $cr_name . "</option>";
    }
    echo "</select><input type='submit' value='submit' name='submit'></form>";

    echo "<script>document.getElementById('curriculum').value=" . $_SESSION['curriculum'] . "</script></td><td>";

    if (!empty($_SESSION['curriculum'])) {
        echo "Active curriculum " . $_SESSION['curriculum'];
    } else {
        echo "<span style='color: red; font-weight: bold'>Please select curriculum first.</span>";
    }

    echo "</td></tr></table>";
}
//////////////////////////////////////////////////////////
// Print student admission
$stuId = $_SESSION['user_id'];

if($role=="6") {
//    $curriculum_qry = mysql_query("select * from student where id='$stuId'");
//    while($row=mysql_fetch_array($curriculum_qry)) {
//        $curriculum = $row['curriculum'];
//    }
//    $_SESSION['curriculum'] = $curriculum;
//    $userId =  substr($_SESSION['user_id'],2);
//
//    echo "<form method=POST action='./forms/form_47.php?task=oneadd'>";
//    echo "<input type='hidden' name='exstno' size='6' value=".$userId.">";
//    echo"<input type=submit value='View & Print Admission'></form>";
}
///////////////////////////////////end mentor process//////////////////////////////////////////////////////	
	
    //////event calencer////////
  //if($role=="3"){
   //   echo"<table width='100%'><tr><td align=right colspan=6>&nbsp;";
   // echo"<a href='./forms/form_75.php' ><font size=2px><b><i>EVENT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>CALENDER</b></i></font></a>";
  //  echo"</td></tr></table>";
 // }
////////////////end event calender///////
    
    
//.........edit by iranga ..fill personal data of student's........................
/*
if($role=="6"){
$st=$_SESSION['user_id'];
echo"<table border='0' width='95%'><tr>";
echo"<td width='40'><img border='0' src='images/personal.png' align='right'></td>";
echo"<form method='POST' action='./forms/personal_info.php'><td valign='middle'>";
echo"<input type='submit' value='Personal Information'><input type='hidden' name='student' value=$st><input type='hidden' name='task' value='fill'>";
echo"</form></td></tr></table><br>";

}
*/
//................................................

	
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////// the above procedure only for FOSMIS ///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	
echo"<td align='center' width=10%>&nbsp;";




		$quechknt="select Notice_ID,date_time from notice where Status<>0 order by Notice_ID";
		
		$quchknt=mysql_query($quechknt);
		if(mysql_num_rows($quchknt)!=0){
			$newnot=array();
			error_reporting(0);
			$today=date("Y-m-d");
			//echo$today;
			$nnot=0;
			while($qchknt=mysql_fetch_array($quchknt)){
				$Notice_ID=$qchknt['Notice_ID'];
				$date_time=$qchknt['date_time'];
					///////////////////////////// check notice new or old////////////////////////////////////
					$gtdatetm=explode("/",$date_time);
						$gtdate=$gtdatetm[0];
						$diff = abs(strtotime($today) - strtotime($gtdate));
			
							$years = floor($diff / (365*60*60*24));
							$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
							$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

								if($years>=1){
									$months=($years*12)+$months;
										}
								if($months>=1){
									$days=($months*30)+$days;
										}
								
									if($days<=7){										
										$newnot[$nnot]="new";
											}
									else{
										$newnot[$nnot]="old";
											$queupaslod="update notice set Status='2' where Notice_ID='$Notice_ID'";
											mysql_query($queupaslod);
										}
														
						$nnot=$nnot+1;

									}// while loop close brec
					//////////////////////////////////////////////////////////////////////////////////////////
												

					if (in_array("new", $newnot)) {
						echo"<a href='./forms/form_53_a.php'><img src='./images/newnote.gif'><br><font size=2px> <b>NOTICE</b></font></a>";
										}
					else{

						echo"<a href='./forms/form_53_a.php'><font size=2px ><b>SPECIAL<br> NOTICE </b></font></a>";
						}

	echo"</td>";
						}
	echo"<td rowspan=2 width=30% valign='top'>";
///////////////////////////////////////// if user is student then view mentor details not student view user profile///////////////////////////////////////
			include"animations/role.php";
		/////////////////////////////////////end (if user is student then view mentor details not student view user profile) //////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////// end view specails notice//////////////////////////////////////

	
	
	
echo"<tr><td width=70% align='center' valign='top' colspan=2>";	
//////////////////////////////////////// main menu//////////////////////////////////////////////////	
	
//echo "<img id=cnf".$sndgetrepcos."img".$getrepstid." src=../images/ntcnf.png onload=change('$sndgetrepcos','$getrepstid','$rpsubcnf',$rpsubid)>";
                                    


$quegetmmenu="select distinct(permi_group) from permission where role_id=".$_SESSION['role_id']." order by id";
$qugetmmenu=mysql_query($quegetmmenu);

echo"<table border=0><tr>";

while($qgetmmenu=mysql_fetch_array($qugetmmenu)){
	$prmimenu=$qgetmmenu['permi_group'];

echo"<td align='center' onMouseOver=smenu('tuto$prmimenu') onMouseOut=hmenu('tuto$prmimenu') width=100px><div>";
$pfile=$prmimenu.".gif";
echo "<img src=images/small/$pfile width=65px height=65px><br><font size=4>".ucfirst($prmimenu)."</font><br>";

		$query2="select id,description from permission where role_id=$role and permi_group='$prmimenu'";
		$prev=mysql_query($query2);
		echo"<table class='menu' id='tuto$prmimenu' align='left' border='0'  bgcolor='#deb8b7'  width='280px'>";
		while($predata=mysql_fetch_array($prev)){
				echo '<tr><td valign="top" align="left"><font  size="4px"><b> &nbsp;*&nbsp;</b></font>';
				echo "<font  size='3px'><a href=?view=admin&admin=".$predata['id'].">";
				echo $predata['description']."</a></font>";
				echo '</td></tr>';

							}


			echo"</table></div></td>";

						}

echo"</tr></table>";


////////////////////////////// end main menu/////////////////////////////////////////////////////////
	echo"</td><tr></table>";
	
	
				///////////////////////////////////////// change my passowrd//////////////////////////////////////
				if($task=="edit"){
					echo "<hr class='bar'>";
					echo"Change My Password";
					echo "<hr class='bar'>";
					include 'pages/profile.php';
									}
				/////////////////////////////////////////end change password//////////////////////////////////////
	
	
	
	////////////////////////// include page/////////////////////////////////////////////////////////////////////////////////
	if($_SESSION['adpdcngperm']!="yes"){
	if(isset($admin)){
			echo '<hr class="bar">';
			
			
			$quechkpermi="select id from permission where role_id=".$_SESSION['role_id']." and id=$admin";
			//echo$quechkpermi;
			$quchkpermi=mysql_query($quechkpermi);
				if(mysql_num_rows($quchkpermi)!=0){
						$getfile=$admin.".php";
						//echo$getfile;
						
						////////////////////////////// include permission pages//////////////////////////
						include "pages/$getfile";
						/////////////////////////////////////////////////////////////////////////////////
														}
				else{
					echo"<font color='red'>You have no permission to access this area!</font>";
					}
						
						}
	}
	else{
		echo "<meta http-equiv='refresh' content='0;URL=index.php?view=admin'>"; 
		}
	////////////////////////// end include page/////////////////////////////////////////////////////////////////////////////////
		
	/////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////// password change/////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////
    	/////////////////////////////////////////////////////////////////////////////////////
	
		$unamecng=$_SESSION['user_id'];
			$reason="pird_pwd_cng_secu_1";
		
			include'connection/connection.php';

			$quegecngpwd18="select id from chngpwd where uname='$unamecng' and reason='$reason'";
			//echo$quegecngpwd18;
			
			$qugecngpwd18=mysql_query($quegecngpwd18);
				if(mysql_num_rows($qugecngpwd18)==0){

					$_SESSION['adpdcngperm']="yes";
					echo"<body onload=load('$reason')></body>";
									}
	/////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////// end password change ///////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////	
		
															}///////////////end login true if
															
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////// end login true if//////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////
elseif((($_SESSION['login'])=="truefohssmis")&&(($_SESSION['userhost'])=="rumis")){
header('Location: ../rumis/index.php');
																			}
/////////////////////////////////////////////////////////////////////////////////////////




																			
//////////////////////////////// login false if ///////////////////////////////////////////////////////////////////////////
elseif(($_SESSION['login'])=="false"){
	//echo"<font color='red'>".$_SESSION['ermsg']."</font>";
	
echo"<tr><td align='center' colspan=2 ><br><br><h3>University of Ruhuna<br>Matara-Sri Lanka</h3>For Support<br>E-Mail:  itu@hss.ruh.ac.lk";


echo"<br><br><table ><tr><td>";

include 'destpnews.html';

echo"</tr></table>";




echo"</td><td valign=top align=center>";

echo"<table border=0 width='270px' class=logbox>";
echo"<form method='POST' action='login.php'>";
echo"<th colspan=2 height=50px align='center' valign='middle'><font size=4px>Sign In</font></th>";
echo"<tr><td width=50% align='right'>User Name <td width=50%><input type='text' name='uname' placeholder='hs12345'></tr>";
echo"<tr><td align='right'>Password <td><input type='password' name='upwd'></tr>";
echo"<tr><td  align='center' colspan=2 ><input type='submit' value='Sign In'><input type=reset value=Clear></tr></form>";
echo"<tr><td colspan=2 align='center'>";
echo"<font color='red'>".$_SESSION['ermsg']."</font>";
echo"</td></tr></table>";

session_destroy();
										}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//////////////////////////////// not login ///////////////////////////////////////////////
else{
echo"<tr><td align='center' colspan=2 ><br><br><h3>University of Ruhuna<br>Matara-Sri Lanka</h3>For Support<br>E-Mail:  itu@hss.ruh.ac.lk";


echo"<br><br><table ><tr><td>";

include 'destpnews.html';

echo"</tr></table>";


echo"</td><td valign=top align=center>";

echo"<table border=0 width='270px' class=logbox>";
echo"<form method='POST' action='login.php'>";
echo"<th colspan=2 height=50px align='center' valign='middle'><font size=4px>Sign In</font></th>";
echo"<tr><td width=50% align='right'>User Name <td width=50%><input type='text' name='uname' placeholder='hs12345'></tr>";
echo"<tr><td align='right'>Password <td><input type='password' name='upwd'></tr>";
echo"<tr><td  align='center' colspan=2 ><input type='submit' value='Sign In'><input type=reset value=Clear></tr></form>";
echo"<tr class=faccolor><td colspan=2>&nbsp;</td></tr></table>";

	}
//////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////// end body ///////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////// show FOSMIS profile ///////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($task=="showprof"){

echo"<tr><td align='center' colspan=3>";
	include'profile.php';
echo"</td></tr>";
						}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////// End show FOSMIS profile ///////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////footer////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"</td></tr>";

echo"<tr><td align='center' colspan=3><br>&#169 Faculty of Humanities and Social Sciences, University of Ruhuna.  </td></tr>"; 
//echo"<tr><td align='center' colspan=3><br>&#169 Faculty of Humanities and Social Sciences, University of Ruhuna. [ <a href='index.php?view=admin&task=showprof'>About FOSMIS</a> ] </td></tr>"; 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////end footer //////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

echo"</table>";

}///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////end  general user page attendence not display ///////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






}//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// end local login body /////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


?>
<script type="text/javascript">
<!--
var userid = new Spry.Widget.ValidationTextField("userid");

var number1 = new Spry.Widget.ValidationTextField("number1", "none", {validateOn:["change"]});
var number2 = new Spry.Widget.ValidationTextField("number2", "none", {validateOn:["change"]});
var ValidMarks = new Spry.Widget.ValidationTextField("marks", "integer", { maxValue:100, useCharacterMasking:false, validateOn:["blur", "change"]});

var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var textarea_counter_up = new Spry.Widget.ValidationTextarea("textarea_counter_up", {maxChars:500, counterType:"chars_remaining", counterId:"Counttextarea_counter", validateOn:["change"]});

var date1 = new Spry.Widget.ValidationTextField("date1", "date", {format:"yyyy-mm-dd", hint:"yyyy-mm-dd", useCharacterMasking:true, validateOn:["blur"]});

var date2 = new Spry.Widget.ValidationTextField("date2", "date", {format:"yyyy-mm-dd", hint:"yyyy-mm-dd", useCharacterMasking:true, validateOn:["blur"]});

var date3 = new Spry.Widget.ValidationTextField("date3", "date", {format:"yyyy-mm-dd", hint:"yyyy-mm-dd", useCharacterMasking:true, validateOn:["blur"]});

var date4 = new Spry.Widget.ValidationTextField("date4", "date", {format:"yyyy-mm-dd", hint:"yyyy-mm-dd", useCharacterMasking:true, validateOn:["blur"]});

var date5 = new Spry.Widget.ValidationTextField("date5", "date", {format:"yyyy-mm-dd", hint:"yyyy-mm-dd", useCharacterMasking:true, validateOn:["blur"]});

var time1 = new Spry.Widget.ValidationTextField("time1", "time", {format:"HH:MM", hint:"HH:MM", useCharacterMasking:true, validateOn:["blur"]});

var code = new Spry.Widget.ValidationTextField("code","custom", {pattern:"AAA0xxxx",useCharacterMasking:true, validateOn:["blur"]});

var email = new Spry.Widget.ValidationTextField("email", "email", {validateOn:["blur"]});

var password = new Spry.Widget.ValidationTextField("password", "none", {minChars:6, maxChars:10, validateOn:["change"]});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");

//-->
</script>
</body>
</html>



