<?php
session_start();
?>

<!--<style type="text/css">
@import url('../style/default.css');
</style>-->
<?php
echo"<div id='c' align='center'>";
include'../admin/config.php';
mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

$task=$_SESSION['task'];
$tbl=$_SESSION['$tbl'];


if($task=="findtbl"){

echo"<form method='POST' action='#task=tblfil'>";
echo"Information of $tbl Table<br>";
echo"<input type='submit' value='Find'>";
echo"<table border='1'><tr>";
$quedistbl="select * from $tbl";
//echo$quedistbl;
$qudistbl=mysql_query($quedistbl);
	for($f=0;$f < mysql_num_fields($qudistbl);$f++){
				$field=mysql_field_name($qudistbl,$f);
				echo "<th> ".mysql_field_name($qudistbl,$f)."<input type='checkbox' name='$field'></th>";
				}
echo"</tr></form>";






while ($get=mysql_fetch_array($qudistbl,MYSQL_ASSOC)){
			echo "<tr bgcolor='#ffffff'>";
					foreach($get as $p ){
					echo "<td>".$p."</td>";
					}
			echo "</tr>";
			}




echo"</table>";

echo"<br><br><br>";
}





echo"</div>";

?>
