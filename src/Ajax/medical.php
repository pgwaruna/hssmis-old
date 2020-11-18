<?php
session_start();
?>

<script type="text/javascript" src="Ajax/displaycourses.js"></script>
<?php
$role=$_SESSION['role'];
	$student=$_GET['student'];
	$lid=$_GET['lid'];

     include '../admin/config.php';
     $con2_a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
     mysql_select_db($db);



$query1="insert into participation values('$student','$lid','2')";
$prev1=mysql_query($query1);
	
if($prev1){				
echo 'Added Successfully !';

?>
<table border="0"><tr><td class="tdbgc"><img src="images/edit-undo.png" onclick="removethis('<?php echo $student; ?>',<?php echo $lid; ?>)"><br>Undo</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<?php
if($role=="office"){
echo"<td class=tdbgc ><a href='index.php?view=admin&admin=32'><img src='./images/small/next.png'></a><br>&nbsp;Next</td>";
}
else{echo"<td class=tdbgc ><a href='index.php?view=admin&admin=23'><img src='./images/small/next.png'></a><br>&nbsp;Next</td>";}
?>
</tr></table>
<?php
}



//sleep(1);
?>
