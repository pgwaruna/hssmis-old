<?php
session_start();
if(($_SESSION['login'])=="truefohssmis"){
?>

<link rel="shortcut icon" href="images/logo.gif">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> FOSMIS Notices of Faculty of Science | University of Ruhuna |</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/fosmiscss.css" rel="stylesheet" type="text/css"/>


<div id="a">

  <table border='0' style="background-image: url(../picture/bgpic.jpg); background-repeat: no-repeat" width="770px">

<tr>
<td width="125px" width="15%" align="center"><image src='../animations/UoRlogo3.png'></td>
<td  valign='middle' align="left" colspan="1"><font size='6'>Faculty of Science
<br><font size='5'>Management Information System
<br>[ F O S M I S ]
</font></td>


</tr>
<tr class='newsbar'>
<td colspan='3'>
   <div><font  size='2px'>
	<marquee scrollamount="3" onmouseover="this.stop();" onmouseout="this.start(); " style="width:765px;">Welcome To The Management Information System!&nbsp;<?php include('../news.php')?></marquee></font>

  </div></td>
</tr>


<tr><td align="center" vlaign="middle"><a href="../index.php?view=admin"><img src=../images/small/back.png><br> &nbsp;Back to Home</a><td align="center">&nbsp;
<td align="center"></td></tr><tr><td colspan="3" align="left">
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

//////////////////////////////// Most Recent Events ///////////////////////////////////////////////
//
    $query23="SELECT acedemic_year FROM acc_year where current=1";
    $data223=mysql_query($query23);
    while($predata=mysql_fetch_array($data223)){
        $ac=$predata['acedemic_year'];
        $query75_2="select * from event where academic_year='$ac' order by s_date";
        $event_details=mysql_query($query75_2);
        if($event_details) {
            echo"<div align='center'><h2>Events in $ac academic year</h2>";
            echo '<table border="0"align="center"><tr><th>Event<th>Starting Date<th>Duration<th>Status<th>Notice</tr>';
            while($data=mysql_fetch_array($event_details)){
                echo "<tr class=trbgc><td align=left>".$data['description']."<td align=center>".$data['s_date'];
                if($data['duration']==1){
                    echo "<td align=center>".$data['duration']." day";
                }
                else{
                    echo "<td align=center>".$data['duration']." days";
                }
                if($data['confirmation']==1){
                    echo "<td align=left><b><font color='green'>Confirmed</font></b>";
                }else{
                    echo "<td align=left>Tentative";
                }
                if($data['news_id']!= null){
                    $n_id=$data['news_id'];
                    $query75_1="select * from notice where Notice_ID='".$n_id."'";
                    $query75=mysql_query($query75_1);

                    if(mysql_num_rows($query75)!=0){

                        while($notice_details=mysql_fetch_array($query75)){
                            $title2=$notice_details['Title'];
                            $File_Name2=$notice_details['File_Name'];
                            echo"<td align=left><a href='../downloads/Notices/$File_Name2' target='_blank'><b>Download</b></a>";
				        }
				    }
                }else{
                echo"<td align=left>Not found";
                }
                echo "</tr>";
            }
            echo "</table><br />";
        }
        else{
            echo "No Events for '$ac' academic year";
        }
    }
                                       echo"</div>";
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
?>


















