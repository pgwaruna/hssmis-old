<?php
//error_reporting(0);
session_start();
if((isset($_SESSION['login'])=="truefohssmis")&&($_SESSION['role']!="student")){

include'../connection/connection.php';

$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from rumisdb.role where role='$role'";
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
    
if($qpers['id']=="57"){
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




<link rel="shortcut icon" href="images/logo.gif">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> MIS of Faculty of Science | University of Ruhuna |</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="author" content="Iranga Muthumala" />
<meta name="Keywords" content="Faculty of Science, University of Ruhuna, MIS, ITRC, Janak,Iranga, Projects, Undergraduate Research Project, Sri Lanka" />
<meta name="Description" content="MIS of faculty of Science University of Ruhuna. Introduced Management Information Syatem of Faculty of Science by Sathiska Udayanga Under ITRC project" />

<link href="../css/fosmiscss.css" rel="stylesheet" type="text/css"/>

 
</head>
<body>
<div id="a">
 
  <table border='0' style="background-image: url(../picture/bgpic.jpg); background-repeat: no-repeat" width="770px">

<tr>
<td width="15%" align="center"><image src='../animations/UoRlogo3.png'></td>
<td  valign='middle' align="left" colspan="1"><font size='6'>Faculty of Science
<br><font size='5'>Management Information System
<br>[ F O S M I S ]
</font></td>

   
</tr>
<tr class="newsbar">
<td colspan='3'>
   <font size='2px'>
	<marquee scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();">Welcome To The Management Information System!&nbsp;<?include('../news.php')?></marquee></font>
	
  </td>
</tr>


<tr><td align="center">
<a href="../index.php?view=admin&admin=57"><img src=../images/small/back.png><br>
Go to Back Page   </a>
<td align="center"><h3>Confirmation of Repeat Course Units </h3>
<td align="center">
<a href="#" onclick="window.location.reload()"><img border="0" src="../images/small/edit-redo.png" ><br>Reload This Page</a></tr>

	

<tr><td colspan="3" align="center">
<?php

include 'Repeate_reg_confirmation.php';
?>

</td></tr>

<tr><td colspan="3" align="center">
	
   
  
© Faculty of Science, University of Ruhuna.</div></td></tr></table>


 </div>

</body>
</html>



<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}

?>
