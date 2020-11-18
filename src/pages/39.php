
<head>
<meta http-equiv="Content-Language" content>


</head>

<?php
include './admin/config.php';
echo "Download Past Papers<hr class=bar><br>";

echo '<form method="post" action="index.php?view=admin&admin=39&course=view">'; 

$con16=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);
$query_16="select distinct course from pastpapers";
	$q16=mysql_query($query_16);
	echo 'Select a Course Unit to Search Past Paper <select name="cource">';
	while($raw4=mysql_fetch_array($q16)){
	echo '<option value='.strtoupper($raw4['course']).'>'.strtoupper($raw4['course']).'</option>';
	}
echo '</select>&nbsp;&nbsp;&nbsp;&nbsp;';



echo '<input type="submit" value="Search" name="submit"></form>'

?>




						

						<?php
						if((($_GET['course'])=='view')&&(isset($_POST['submit']))){
						$course=$_POST['cource'];
											
						
						// view Results
						echo "<h3>Past Papers of ".$course." </h3>";
						
				
						$query_11_2="select id,year,course,file from pastpapers where course='$course'";
						echo '<table border="0" width=50%><th>Year of Past Paper<th>Download Link';
						$res_vw=mysql_query($query_11_2);
						while($data=mysql_fetch_array($res_vw)){
						echo "<tr class=trbgc><td align=center width=50%>".$data['year']."<td align=center width=50%>";
						echo "[ <a href=export_data/pp/download.php?file=".$data['file'].">Download</a> ]";
						}
						echo "</table>";
						}

?>