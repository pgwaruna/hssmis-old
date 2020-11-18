<?php
// Test CVS

include '../../admin/config.php';


mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

$acc_ye=$oldacyear;
$seme=$oldseme;


require_once 'Excel/reader.php';

// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();

// Set output Encoding.
$data->setOutputEncoding('CP1251');

$data->read($target_path);
//$data->read($_FILES['uploadedfile']['name']);

error_reporting(E_ALL ^ E_NOTICE);

for ($i = 3; $i <= $data->sheets[0]['numRows']; $i++) 
{
	$index=$data->sheets[0]['cells'][$i][2];
	
	//list($fac,$acadamicyear,$indexy) = split('[/.-]',$index);

	$str_exp = explode("/", $index);
	
	$regstno="hs".$str_exp[2];

	$acadamicyear1=$acc_ye;
	

	//$course=$data->sheets[0]['cells'][$i][4];

	//$medium=$data->sheets[0]['cells'][$i][5];

	for ($j = 3; $j <= $data->sheets[0]['numCols']; $j++)
	{
		
		if($data->sheets[0]['cells'][$i][$j]=="6"){
			$degree_nonDegree="Non Degree";
		}
		else{
			$degree_nonDegree="Degree";
		}
		
		
		
		if( $data->sheets[0]['cells'][$i][$j]=="1"||
			$data->sheets[0]['cells'][$i][$j]=="2"||
			$data->sheets[0]['cells'][$i][$j]=="3"||
			$data->sheets[0]['cells'][$i][$j]=="4"||
			$data->sheets[0]['cells'][$i][$j]=="5"|| 
			$data->sheets[0]['cells'][$i][$j]=="6")
		//if($data->sheets[0]['cells'][$i][$j]!=null )
		
		{

				$prac=$data->sheets[0]['cells'][2][$j];
				
				$quechk="select confirm from registration where student='$regstno' and course='$prac'and acedemic_year='$acc_ye' and (semister='3' or semister=$seme)";
				//echo$quechk;
					$quchk=mysql_query($quechk);
				if(mysql_num_rows($quchk)=='0'){

					$queupdt="insert into registration(student,course,acedemic_year,semister,degree,confirm) values ('".$regstno."','".$prac."','".$acadamicyear1."','$seme','".$degree_nonDegree."','1')";
					
												}
				else{
					$queupdt="update registration set confirm=1,degree='$degree_nonDegree' where student='$regstno' and course='$prac'and acedemic_year='$acc_ye' and (semister='3' or semister=$seme)";
					}
				echo$queupdt."<br>";	
				mysql_query($queupdt);

		
				
		//continue;
				
	}

}
}

?>
