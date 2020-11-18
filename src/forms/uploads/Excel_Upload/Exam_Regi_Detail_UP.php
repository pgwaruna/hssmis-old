<?php
// Test CVS

include '../../admin/config.php';


mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

$queacc="select * from acc_year where current='1'";
$quacc=mysql_query($queacc);
while($qacc=mysql_fetch_array($quacc)){
$acc_ye=$qacc['acedemic_year'];
}
$quesemi="select semister from call_registration";
$qusemi=mysql_query($quesemi);
while($qsemi=mysql_fetch_array($qusemi)){
	$seme=$qsemi['semister'];
}
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
	$index=$data->sheets[0]['cells'][$i][3];
	
	//list($fac,$acadamicyear,$indexy) = split('[/.-]',$index);

	$str_exp = explode("/", $index);
	

	$acadamicyear1=$acc_ye;
	//$acadamicyear1="2010_2011";

	$course=$data->sheets[0]['cells'][$i][4];

	$year3=$data->sheets[0]['cells'][1][1];
	$year2=explode("-",$year3);
	$year1=$year2[1];

	//$medium=$data->sheets[0]['cells'][$i][5];

	for ($j = 6; $j <= $data->sheets[0]['numCols']; $j++)
	{

		

		$degree_nonDegree=$data->sheets[0]['cells'][$i][$j];
		
		if($data->sheets[0]['cells'][$i][$j]=="1" || $data->sheets[0]['cells'][$i][$j]=="2")
		{
			if($j>=6)
			{
				$prac=$data->sheets[0]['cells'][2][$j];
				//$char_buff = preg_split('//', $prac, -1);
				
				$quechk="select confirm from exam_registration where student='$str_exp[2]' and course='$prac' and acedemic_year='$acc_ye' and 	semester=$seme";
					//echo$quechk;
				$quchk=mysql_query($quechk);
				if(mysql_num_rows($quchk)==0){
								
			$sql="insert into exam_registration(student,course,acedemic_year,semester,degree,confirm,year) values ('".$str_exp[2]."','".$data->sheets[0]['cells'][2][$j]."','".$acadamicyear1."','$seme','".$degree_nonDegree."','0',$year1)";
					//echo $sql;
					mysql_query($sql);
							
								}
				else{
					$qchk=mysql_fetch_array($quchk);
					$chk=$qchk['confirm'];
		
					if($chk==0){
					$queupdt="update exam_registration set confirm=0 where student='$str_exp[2]' and course='$prac'and acedemic_year='$acc_ye' and semester=$seme";
					//echo$queupdt;
					mysql_query($queupdt);
						}	
					}


			
			
			
			
			
				
		continue;
		}		
	}

}
}

?>
