<?php
// Test CVS

 
include  '../../admin/config.php';


mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);



require_once 'Excel/reader.php';

// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();

// Set output Encoding.
$data->setOutputEncoding('CP1251');

$data->read($target_path);
//$data->read($_FILES['uploadedfile']['name']);

error_reporting(E_ALL ^ E_NOTICE);

for ($i = 7; $i <= $data->sheets[0]['numRows']; $i++) 
{
	$examname=$data->sheets[0]['cells'][3][1];
	$examyear=explode("-", $examname);
	$year=$examyear[1];
	
	$index=$data->sheets[0]['cells'][$i][3];
	$str_exp = explode("/", $index);
	
	

	for ($j = 4; $j <= $data->sheets[0]['numCols']; $j++)
	{
		
		
		if($data->sheets[0]['cells'][$i][$j]!=null)
		{
			if($j>=4)
			{
				$sub=$data->sheets[0]['cells'][6][$j];
							
				$sql="insert into results(index_number,subject,grade,year) values ('".$str_exp[2]."','".$sub."','".$data->sheets[0]['cells'][$i][$j]."','".$year."')";
				//echo $sql;

				mysql_query($sql);

			}			
								
				
		continue;
		}		
	}


}

?>
