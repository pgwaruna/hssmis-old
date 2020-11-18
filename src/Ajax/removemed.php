<?php
session_start();
?>

<?php
$role=$_SESSION['role'];
	$student=$_GET['std'];
	$lid=$_GET['lid'];

     include '../admin/config.php';
     $con2_a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
     mysql_select_db($db);



$query1="delete from participation where student = '$student' and lect_id = '$lid'";
$prev1=mysql_query($query1);
	
if($prev1){	
if($role=="office"){			
echo 'Undo Successfully !<br><a href="index.php?view=admin&admin=32"><img src="./images/small/backsm.png"></a><br>Back';
}
else{echo 'Undo Successfully !<br><a href="index.php?view=admin&admin=23"><img src="./images/small/backsm.png"></a><br>Back';}

?>
<?php
}



//sleep(1);
?>
