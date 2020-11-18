<?php
session_start();
if((isset($_SESSION['login'])=="truefohssmis")&&($_SESSION['role']=="administrator")){
?>

<?php
//error_reporting(0);
include'../connection/connection.php';

require_once('../classes/attClass.php');
$at=new attendence();


require_once 'uploads/Excel_Upload/Excel/reader.php';


$target_path1 = "uploads/Excel_Upload/Student_Data/";

$target_path =$target_path1.basename( $_FILES['uploadedfile']['name']); 
chmod($target_path, 0777);





if($dd=move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) 
{	
	$filename=basename( $_FILES['uploadedfile']['name']);
	chmod($target_path, 0777);
		

// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();

// Set output Encoding.
$data->setOutputEncoding('CP1251');

$data->read($target_path);
//$data->read($_FILES['uploadedfile']['name']);

error_reporting(E_ALL ^ E_NOTICE);



echo"<table border=1><tr><th>Student No";



$quegetcs="select * from courseunit where (level=1 and semister=2) or level=2 and availability=1 order by level,semister,code";
$qugetcs=mysql_query($quegetcs);
while($qgetcs=mysql_fetch_array($qugetcs)){

$getcs=$qgetcs['code'];

echo"<th>".$getcs."</th>";

$alcos[$ar]=strtoupper($getcs);


}

echo"</tr>";

for ($e = 3; $e <= $data->sheets[0]['numRows']; $e++) 
{
	$index=$data->sheets[0]['cells'][$e][2];
	$str_exp = explode("/", $index);
	$scre=$str_exp[0];
	$stnum=$str_exp[2];
		$st_tem_no=$scre.$num;// student temp no

	echo"<tr><td>$index</td>";

///////////////////////////////////////////////////////////////////////////////////////////////////
		$ar=0;
		$alcos=array();
		$quegestalrg="select course from registration where student='$stnum' and confirm=1 order by id";
		$qugestalrg=mysql_query($quegestalrg);

		while($qgestalrg=mysql_fetch_array($qugestalrg)){
			
			$gestalrg=$qgestalrg['course'];
			$alcos[$ar]=strtoupper($gestalrg);


		$ar++;
								}
///////////////////////////////////////////////////////////////////////////////////////////////////

			$qugetcs2=mysql_query($quegetcs);
			while($qgetcs2=mysql_fetch_array($qugetcs2)){
			
			$getcs2=$qgetcs2['code'];
				$getcs22=strtoupper($getcs2);
				echo"<td align=center>";
					if(in_array($getcs22,$alcos)){
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

			//echo$stnum.$submit;	
			$quegtallatt="select r.course,c.name,r.acedemic_year,r.semister,r.degree from registration r ,courseunit c where r.student='$stnum' and r.course='$getcs2' and r.confirm=1 and r.course=c.code order by r.acedemic_year,r.semister,r.course";
//echo$quegtallatt;
			$qugtallatt=mysql_query($quegtallatt);
			
				
					while($qgtallatt=mysql_fetch_array($qugtallatt)){
						$course=$qgtallatt['course'];
					
				
					
						$acedemic_year=$qgtallatt['acedemic_year'];
						$semister=$qgtallatt['semister'];
							if($semister==3){
									$semister=2;
											}
						
						
							
								$practgp=$at->getprctgp($stnum,$course,$acedemic_year);
									$totlecths=$at->getSubTotalAll($course, $acedemic_year,$practgp);
									
										//echo"<b>".$totlecths."</b><br>";	

										$quelettp="select distinct(type) from lecture where course='$course' and acc_year='$acedemic_year'";
										$qulettp=mysql_query($quelettp);
										if(mysql_num_rows($qulettp)!=0){
										$alllectype=array();
										$totlecthotp=array();
										$i=0;
											while($qlettp=mysql_fetch_array($qulettp)){
													$lettp=$qlettp['type'];
														$trelet=substr("$lettp", 0,4);
														
														
														
													//echo"[".ucfirst($trelet).":";
													$alllectype[$i]=ucfirst($trelet);
													
														$totlecbytp=$at->getSubTotal($course, $lettp, $acedemic_year, $practgp);
														//echo$totlecbytp."] ";
														$totlecthotp[$i]=$totlecbytp;
														$i=$i+1;
																						}
																		}
						
							
							
																											
									$getpesall=$at->getTotalAll($course, $stnum, $acedemic_year);
										
										///echo"/<b>".$getpesall."</b><br>";
																												
										$quelettp1="select distinct(type) from lecture where course='$course' and acc_year='$acedemic_year'";
										$qulettp1=mysql_query($quelettp1);
										if(mysql_num_rows($qulettp1)!=0){
										$prtyhours=array();
										$j=0;
											while($qlettp1=mysql_fetch_array($qulettp1)){
													$lettp1=$qlettp1['type'];
														$trelet1=substr("$lettp1", 0,4);
													//echo"[".ucfirst($trelet1).":"; 
													
												$totprs=$at->getTotal($course, $stnum, $lettp1, $acedemic_year);
														//echo$totprs."]<br>";
														$prtyhours[$j]=$totprs;
														$j=$j+1;
																							}
																		
																		}
							
							//echo"-";
								if($totlecths!=0){						
								$ppecen=($getpesall/$totlecths)*100;
								}
								else{
								$ppecen=0;
									}

								echo"<b>".round($ppecen,2)."%</b>";
								if($ppecen!=0){
									for($k=0;$k<$i;$k++){
										//echo"[".$alllectype[$k].":";
										
											//$typecn=($prtyhours[$k]/$totlecthotp[$k])*100;
									
											//echo round($typecn,2)."%]<br>";
															
								//echo$totlecthotp[$k]."--".$prtyhours[$k]." ";
															
															
															}
												}
						
						
							
						
						
						
						
						
						
						
																	}
				
				
			
					
					


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
						//echo$getcs2;
							}
					else{
						echo"&nbsp;";
						}

									}


echo"</tr>";

}

echo"</table>";


} 
else
{
echo "There was an error uploading the file, please try again!";
}













?>



<?php
}
else{
echo "You Have Not Permission To Access This Area!";}
?>
