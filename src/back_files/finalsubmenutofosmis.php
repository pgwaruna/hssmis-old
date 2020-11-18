<?php
session_start();
error_reporting(0);

$admin=$_GET['admin'];
$task=$_GET['task'];
$view=$_GET['view'];
?>




<style>table.menu{fontsize:100%; position:absolute; visibility:hidden;}</style>


<script language="JavaScript" type="text/JavaScript">
function smenu(ele){
document.getElementById(ele).style.visibility="visible"
}

function hmenu(ele){
document.getElementById(ele).style.visibility="hidden"
}
</script>





<?php

include'connection/connection.php';
$quegetmmenu="select distinct(permi_group) from permission where role_id='3'";
$qugetmmenu=mysql_query($quegetmmenu);


echo"<table border=0><tr>";
while($qgetmmenu=mysql_fetch_array($qugetmmenu)){
	$prmimenu=$qgetmmenu['permi_group'];

echo"<td align='center' onMouseOver=smenu('tuto$prmimenu') onMouseOut=hmenu('tuto$prmimenu') width=100px><div>";
$pfile=$prmimenu.".png";

echo "<img src=images/small/$pfile width=70px height=70px><br><font size=2>$prmimenu</font>";

		$query2="select id,description from permission where role_id=3 and permi_group='$prmimenu'";
		$prev=mysql_query($query2);
		echo"<table class='menu' id='tuto$prmimenu' align='left' border='0'>";



		while($predata=mysql_fetch_array($prev)){
				echo "<tr bgcolor='#edd4dc'><td valign='top' align='left'>";

				echo "<a href=?view=admin&admin=".$predata['id'].">";
					echo $predata['description']."</a>";
				echo '</td></tr>';

							}


echo"</table></div></td>";

						}

echo"</tr></table>";
echo"<br><h3>submenu success!</h3><br>";
if($view=="admin"){

echo"data of admin= ".$admin;

		}






?>


