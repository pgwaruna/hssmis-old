<?php

	$group=$_GET['group'];
	$role=$_GET['role'];

     include '../admin/config.php';
     $con5_a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
     mysql_select_db($db);
	
 

//$query2="select p.id, p.description from permission p, role r where p.role_id=r.id and r.role='$role' and p.permi_group='$group'";
$query2="select id,description from permission where role_id=$role and permi_group='$group'";
$prev=mysql_query($query2);
echo '<table border="0" cellpadding="3" cellspacing="0">';
while($predata=mysql_fetch_array($prev)){
echo '<tr><td><img src="images/arrow.png"><td valign="top" align="left">';

echo "&nbsp;<a href=?view=admin&admin=".$predata['id'].">";
echo $predata['description']."</a><br>";
echo '</td></tr>';

}
echo '</table><br>';
echo "<meta http-equiv='refresh' content='0;URL=index.php?view=admin>";






//sleep(1);
?>