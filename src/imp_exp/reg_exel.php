<?

// Connect database. 

include '../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);


// Get data records from table. 

$result=mysql_query("select * from registration");

// Functions for export to excel.
function xlsBOF() { 
echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0); 
return; 
} 

function xlsEOF() { 
echo pack("ss", 0x0A, 0x00); 
return; 
} 

function xlsWriteNumber($Row, $Col, $Value) { 
echo pack("sssss", 0x203, 14, $Row, $Col, 0x0); 
echo pack("d", $Value); 
return; 
} 

function xlsWriteLabel($Row, $Col, $Value ) { 
$L = strlen($Value); 
echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L); 
echo $Value; 
return; 
} 

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Disposition: attachment;filename=Student_Registration.xls "); 
header("Content-Transfer-Encoding: binary ");
xlsBOF();

/*
Make a top line on your excel sheet at line 1 (starting at 0).
The first number is the row number and the second number is the column, both are start at '0'
*/

xlsWriteLabel(0,0,"Registration Available in the Database");

// Make column labels. (at line 3)
xlsWriteLabel(2,0,"Reg ID");
xlsWriteLabel(2,1,"Student");
xlsWriteLabel(2,2,"Course");
xlsWriteLabel(2,3,"Semester");
xlsWriteLabel(2,4,"Status");
xlsWriteLabel(2,5,"Confimation");
$xlsRow = 3;

// Put data records from mysql by while loop.
while($row=mysql_fetch_array($result)){
xlsWriteNumber($xlsRow,0,$row['id']);
xlsWriteLabel($xlsRow,1,$row['student']);
xlsWriteLabel($xlsRow,2,$row['course']);
xlsWriteNumber($xlsRow,3,$row['semister']);
xlsWriteLabel($xlsRow,4,$row['degree']);
xlsWriteLabel($xlsRow,5,$row['confirm']);
$xlsRow++;
} 
xlsEOF();
exit();
?>

