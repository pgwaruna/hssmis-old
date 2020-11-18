<?php
$task=$_GET['task'];
$index_6_6=$_GET['stno'];

$year_6_6=$_GET['byear'];
$stream_6_6=$_GET['strem'];
$comb_6_6=$_GET['cmbvl'];


include'../admin/config.php';
$con66=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

//...............get acc_year....................
$acc_year="select acedemic_year from acc_year where current='1'";
$ac_year=mysql_query($acc_year);
while($a_y=mysql_fetch_array($ac_year)){
$acy=$a_y['acedemic_year'];
}
$acyer=explode("_",$acy);
$acyold=$acyer[0]-1;
$acycur=$acyer[0];
$acynx=$acyer[1];



$queini="select initials,l_name from rumisdb.fohssmis where user='sc$index_6_6'";
$quini=mysql_query($queini);	
while($qini=mysql_fetch_array($quini)){
	$ini_6_6=$qini['initials'];
	$name_6_6=$qini['l_name'];
					}



$combination[0]="--Select One--";
$combination[1]="CS + Maths + AM";
$combination[2]="CS + Maths + Physics";
$combination[3]="CS + Chemistry + Maths";
$combination[4]="IM + Maths + Chemistry";
$combination[5]="IM + Maths + Physics";
$combination[6]="Maths + AM + Physics";
$combination[7]="Maths + AM + Chemistry";
$combination[8]="Maths + Physics + Chemistry";
$combination[9]="Zoo + Bot + Chemistry";
$combination[10]="Chemistry + Botany + Physics";
$combination[11]="Chemistry + Zoo + Physics";
$combination[12]="Botany + Zoo + Physics";
$combination[13]="BCS - Computer Science";


//confirm combinations/////
if($task=="cnfm"){
//echo$task.$index_6_6.$name_6_6.$year_6_6.$stream_6_6.$comb_6_6;
		// Add Student
			


	$query_6_8="insert into student(id, l_name, initials, year, stream, combination, batch, medium) values('$index_6_6', '$name_6_6', '$ini_6_6', '$acycur', '$stream_6_6', '$comb_6_6', '$year_6_6', 'select')";
	$usr_addings=mysql_query($query_6_8);
	//echo$query_6_8;
	if($usr_addings){
	

		$query_6_9="update rumisdb.fohssmis set section='checked' where user='sc$index_6_6'";
		$usr_addings=mysql_query($query_6_9);
	
		
								//edit by iranga

		$quecfcmbrq1="select combination from request_combination where stno='$index_6_6'";	
		//echo$quecfcmbrq1;		
		$qucfcmbrq1=mysql_query($quecfcmbrq1);
		if(mysql_num_rows($qucfcmbrq1)!=0){
			while($qcfcmbrq1=mysql_fetch_array($qucfcmbrq1)){
				$cfcmbrq1=$qcfcmbrq1['combination'];
				$cfcmbepx=explode("/",$cfcmbrq1);
				$cfcmbevl=$cfcmbepx[1];	
				if($cfcmbevl==$comb_6_6){
					$quecfcmbrq2="update request_combination set status='Confirmed' where  combination='$cfcmbrq1' and stno='$index_6_6'";
					//echo$quecfcmbrq2;
					$qucfcmbrq2=mysql_query($quecfcmbrq2);
							}
									}
						}
						
					////////////////////////////////////// confirmed courese unit of lvl1 seme1/////////////////////////////////////////	
					
					
					
					
						$quereglsefirst="select distinct c.code,c.semister,c.target_group from courseunit c, combination o, student s , target_group t where o.id=s.combination and s.id='$index_6_6' and o.subject=t.subject and t.target_id=c.target_group and c.core='co' and c.level='1' and (c.semister=1 or c.semister=3) and c.availability=1 order by c.code";
						//echo$quereglsefirst;
						$qureglsefirst=mysql_query($quereglsefirst);
						while($qreglsefirst=mysql_fetch_array($qureglsefirst)){
						
									$firstcos=$qreglsefirst['code'];
									$firstseme=$qreglsefirst['semister'];
									$trgtbp=$qreglsefirst['target_group'];
						//echo$firstcos.$firstseme.$acy."<br>";
						if($trgtbp!="12"){
							$queinsfirst="insert into  registration(student,course,acedemic_year,semister,degree,confirm) values('$index_6_6','$firstcos','$acy',$firstseme,1,1)";
							//echo$queinsfirst;
							mysql_query($queinsfirst);	
								}
							else{
		///////////////////////////////////////////////////////////////////////////////////////////////
								$cs="no";
								$quegtcs="select c.subject from combination c, student s where s.combination=c.id and s.id='$index_6_6'";
								$qugtcs=mysql_query($quegtcs);
								while($qgtcs=mysql_fetch_array($qugtcs)){
										$cmbsubj=$qgtcs['subject'];
										if($cmbsubj=="computer_science"){
											$cs="yes";
												}
													}
								if($cs=="no"){
							$queinsfirst="insert into  registration(student,course,acedemic_year,semister,degree,confirm) values('$index_6_6','$firstcos','$acy',$firstseme,1,1)";
							//echo$queinsfirst;
							mysql_query($queinsfirst);

										}

		///////////////////////////////////////////////////////////////////////////////////////////////
								}











																				}
						
					/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
				

		echo "SC/$year_6_6/$index_6_6 <br>";
		echo"$combination[$comb_6_6]";
						}
//////////////////////////////						
}
//undo confirm combinations

if($task=="undocf"){
//echo$task.$index_6_6.$name_6_6.$year_6_6.$stream_6_6.$comb_6_6;

$quedelcmb="delete from student where id='$index_6_6'";
//echo$quedelcmb;
mysql_query($quedelcmb);


$queuseoth="update rumisdb.fohssmis set section='Other' where user='sc$index_6_6'";
//echo$queuseoth;
mysql_query($queuseoth);
	



$queuprqcm="update request_combination set status='Register' where stno='$index_6_6'";
$quuprqcm=mysql_query($queuprqcm);



$quedelreg="delete from  registration where student='$index_6_6' and acedemic_year='$acy' and (semister=1 or semister=3)";
//echo$quedelreg;
mysql_query($quedelreg);

$quegtstcmb="select combination,priority from request_combination where stno='$index_6_6' and acc_year='$acy'";
$qugtstcmb=mysql_query($quegtstcmb);

if(mysql_num_rows($qugtstcmb)==0){
			echo '<select size="1" name="comb_6_6"  id="'.$index_6_6.'comb_6_6">';
				for($i=0;$i<=13;$i++){				
					echo "<option value=$i>$combination[$i]</option>";
							}
			echo '</select>';
						}
		else{
			for($k=1;$k<=13;$k++){
				$cmbls[$k]=0;
						}			
			
			echo '<select size="1" name="comb_6_6"  id="'.$index_6_6.'comb_6_6">';
			while($qgtstcmb=mysql_fetch_array($qugtstcmb)){
				$stcmb=$qgtstcmb['combination'];
				$stcmbpty=$qgtstcmb['priority'];
				$cmbval=explode("/",$stcmb);

				$cmb=$cmbval[0];
				$cmbvl=$cmbval[1];
				
					
				if($stcmbpty==1){
				echo "<option value=$cmbvl selected>$combination[$cmbvl]&nbsp;&nbsp;&nbsp;[$stcmbpty]</option>";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////after undo re enter registration////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////         
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////// ////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////         
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        $quereglsefirst="select distinct c.code,c.semister,c.target_group from courseunit c, combination o, target_group t where o.id=$cmbvl and o.subject=t.subject and t.target_id=c.target_group and c.core='co' and c.level='1' and (c.semister=1 or c.semister=3) and c.availability=1 order by c.code";
                        //echo$quereglsefirst;
                        $qureglsefirst=mysql_query($quereglsefirst);
                        while($qreglsefirst=mysql_fetch_array($qureglsefirst)){
                        
                            $firstcos=$qreglsefirst['code'];
                            $firstseme=$qreglsefirst['semister'];
                            $trgtbp=$qreglsefirst['target_group'];
                                
                            //echo$firstcos.$firstseme.$trgtbp."<br>";
                                if($trgtbp!="12"){
                                    $queinsfirst="insert into  registration(student,course,acedemic_year,semister,degree,confirm) values('$index_6_6','$firstcos','$acy',$firstseme,1,0)";
                                    //echo$queinsfirst."a<br>";
                                    mysql_query($queinsfirst);  
                                            }
                                else{
                            ///////////////////////////////////////////////////////////////////////////////////////////////
                                    $cs="no";
                                    $quegtcs="select subject from combination where id='$cmbvl'";
                                    $qugtcs=mysql_query($quegtcs);
                                        while($qgtcs=mysql_fetch_array($qugtcs)){
                                            $cmbsubj=$qgtcs['subject'];
                                                if($cmbsubj=="computer_science"){
                                                    $cs="yes";
                                                                    }
                                                            }
                                    if($cs=="no"){
                                        $queinsfirst="insert into  registration(student, course, acedemic_year, semister, degree, confirm) values('$index_6_6', '$firstcos','$acy',$firstseme,1,0)";
                                        //echo$queinsfirst."b<br>";
                                        mysql_query($queinsfirst);

                                                            }

                            ///////////////////////////////////////////////////////////////////////////////////////////////
                                    }
                                                            }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////// end after undo re enter registration////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////         
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////         
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
										}
				else{
				echo "<option value=$cmbvl>$combination[$cmbvl]&nbsp;&nbsp;&nbsp;[$stcmbpty]</option>";
					}
				
				$cmbls[$cmbvl]=1;
						}

			
		for($n=1;$n<=13;$n++){
				if($cmbls[$n]==0){
					echo "<option value=$n>$combination[$n]</option>";
						}
					}
		echo '</select>';


			}




}
//////////////////////////////////

?>
