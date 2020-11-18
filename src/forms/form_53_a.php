<?php
session_start();
if(($_SESSION['login'])=="truefohssmis"){
?>




<link rel="shortcut icon" href="images/logo.gif">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> FOHSSMIS Notices of Faculty of Humanities and Social Sciences | University of Ruhuna |</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/fosmiscss.css" rel="stylesheet" type="text/css"/>


<div id="a">
 
  <table border='0' align='center' style="background-image: url(../picture/bgpic.jpg); background-repeat: no-repeat ; background-size: 100%;" >

<tr>
<td  width="10%" align="center"><image src='../animations/UoRlogo3.png'></td>
<td  valign='middle' align="left" colspan="1"><font size='5'>Faculty of Humanities and Social Sciences
<br><font size='5'>Management Information System
<br>[ H S S - M I S ]
</font></td>

   
</tr>
<tr class='newsbar'>
<td colspan='3'>
   <div><font  size='2px'>
	<marquee scrollamount="3" onmouseover="this.stop();" onmouseout="this.start(); " style="width:1145px;">Welcome To The Management Information System!&nbsp;<?php include('../news.php')?></marquee></font>
	
  </div></td>
</tr>


<tr><td align="center" vlaign="middle"><a href="../index.php?view=admin"><img src=../images/small/back.png><br> &nbsp;Back to Home</a><td align="center">&nbsp;
 <td align="center"><a href="../forms/form_53_a.php" ><img border="0" src="../images/small/edit-redo.png" ><br> &nbsp;Back to Notice&nbsp; </a>
</td></tr><tr><td colspan="3" align="left">

<?php
include '../admin/config.php';
mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);
$taskf=$_GET['taskf'];
if($taskf=="incl"){
$fname=$_GET['fname'];
echo"<div id=m>";

include '../downloads/Notices/'.$fname;
echo"</div>";
}

//////////////////////////////// Most Recent Notices ///////////////////////////////////////////////
echo"<div align='center'><h3>Most Recent Notices</h3>";
echo"<table border=0 width=80%><tr><th>No<th>Add Date / Time<th>Title<th>Download Link</tr>";
$quenotice="select * from notice where Status=1 order by date_time desc";
$qunotice=mysql_query($quenotice);
$i=1;
if(mysql_num_rows($qunotice)!=0){
	
	while($qnotice=mysql_fetch_array($qunotice)){
		$title=$qnotice['Title'];
		$File_Name=$qnotice['File_Name'];
		$adddt=$qnotice['date_time'];
		
	echo"<tr class=trbgc><td align='center'>$i<td align=center>$adddt<td align=center>";
	echo strtoupper($title)."<td align=center>";
	
		$htmlfle=explode(".",	$File_Name);
		$htmlext=$htmlfle[1];
	if($htmlext=="html"){
		echo"<a href='form_53_a.php?taskf=incl&fname=$File_Name'>Download</a></tr>";
		
				}
	else{
	echo"<a href='../downloads/Notices/$File_Name'>Download</a></tr>";
		}
	$i=$i+1;
							}
				}
else{
	echo"<tr class=trbgc><td colspan=4  align='center'>There are no Most Recent Notices</tr>";
	}
echo"</table>";
//////////////////////////////// end Most Recent Notices /////////////////////////////////////////////


/////////////////////////////// Older Notices ////////////////////////////////////////////////////////


echo"<h3>Previous Notices</h3>";

echo"<table border=0 width=80%><tr><th>No<th>Add Date / Time<th>Title<th>Download Link</tr>";
$quenotice2="select * from notice where Status=2 order by date_time desc LIMIT 0 , 50";
$qunotice2=mysql_query($quenotice2);
$i2=1;
if(mysql_num_rows($qunotice2)!=0){
	
	while($qnotice2=mysql_fetch_array($qunotice2)){
		$title2=$qnotice2['Title'];
		$File_Name2=$qnotice2['File_Name'];
		$adddt2=$qnotice2['date_time'];
	echo"<tr class=trbgc><td align='center'>$i2<td align=center>$adddt2<td align=center>";
	echo strtoupper($title2)."<td align=center>";
		
	$htmlfle2=explode(".",	$File_Name2);
		$htmlext2=$htmlfle2[1];
	if($htmlext2=="html"){
		echo"<a href='form_53_a.php?taskf=incl&fname=$File_Name2'>Download</a></tr>";
		
				}
	else{
	echo"<a href='../downloads/Notices/$File_Name2'>Download</a></tr>";
		}





	
	$i2=$i2+1;
							}
				}
else{
	echo"<tr class=trbgc><td colspan=4  align='center'>There are no Previous Notices</tr>";
	}
echo"</table>";

//////////////////////////// end older notice///////////////////////////////////////////////////




echo"</div>";
?>

</td></tr>

<tr><td colspan="3" align="center">
	
 
 
© Faculty of Humanities and Social Sciences, University of Ruhuna.</div></td></tr></table>
</div>



</body>
</html>



<?php
}
else{
echo "You Have Not Permission To Access This Area!";}
?>













