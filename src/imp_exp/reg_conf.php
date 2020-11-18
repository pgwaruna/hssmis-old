<?php
session_start();
if(isset($_SESSION['login'])=="truefohssmis"){
include'../connection/connection.php';
?>






<style type="text/css">
@import url('../css/fosmiscss.css');
</style>

 <script src="../style/right.js" type="text/javascript"></script>
 <link href="../style/jquery-ui.css" rel="stylesheet" type="text/css"/>
 <script src="../style/jquery.min.js"></script>
 <script src="../style/jquery-ui.min.js"></script>
  <script src="../style/jquery.tooltip.js"></script>
 
</head>
<body>
<div id="a">
 <?php
echo"<table border='0'  width='100%' style='background-image: url(../picture/bgpic.jpg); background-repeat: no-repeat; background-size: 100%;' >";
echo"<tr>";
echo"<td align='center' width=10%><image src='../animations/UoRlogo3.png'></td>";
echo"<td colspan='2'  valign='middle'><font size='5'>Faculty of Humanities and Social Sciences";
echo"<br><font size='5'>Management Information System";
echo"<br>[H S S - M I S]";
echo"</font></td></tr>";

   
echo"<tr class=newsbar>";
//echo"<td colspan='3' bgcolor='e98ff1'>&nbsp;</td></tr>";



echo"<td colspan='3'><div><marquee scrollamount='3' onmouseover='this.stop();' onmouseout='this.start();' style='width:100%;'>Welcome To The Management Information System!&nbsp;&nbsp;&nbsp;";
include "../news.php";
echo"</marquee></div></td>";
?>

<tr><td colspan="3">
 
   <div align="center">


<h3>Confirmation of - Course Units Registrations</h3>

Go to Back Page  <a href="../index.php?view=admin&admin=3"><img src=../images/small/back.png> </a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Reload This Page
<a href="#" onclick="window.location.reload()"><img border="0" src="../images/small/edit-redo.png" ></a></div>
<br />
	<div align="justify">
<?php
//.................edit by Iranga...............
include 'Edit_reg_confirmation.php';
?>

 &nbsp;</div></td></tr>

<tr><td colspan="3" align="center">
	
   
  <div>
© Faculty of Science, University of Ruhuna.</div></td></tr></table>
</div>



</body>
</html>



<?php
}
else{
echo "You Have Not Permission To Access This Area!";}
?>
