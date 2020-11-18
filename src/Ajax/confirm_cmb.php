<?php
$task=$_GET['task'];
$index_6_6=$_GET['stno'];
$stno=$index_6_6;
$year_6_6=$_GET['byear'];
//$stream_6_6=$_GET['strem'];
$comb_6_61=$_GET['cmbvl1'];
$comb_6_62=$_GET['cmbvl2'];
$comb_6_63=$_GET['cmbvl3'];

//echo$task;

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
$acycur=$acyer[0];////////remove this cooment after entering all student in HSS-MIS - (Iranga 2019-06-12)
//$acycur="2016";//////////comment this  after entering all student in HSS-MIS - (Iranga 2019-06-12)
$acynx=$acyer[1];



$queini="select initials,l_name from rumisdb.fohssmis where user='$index_6_6'";
$quini=mysql_query($queini);	
while($qini=mysql_fetch_array($quini)){
	$ini_6_6=$qini['initials'];
	$name_6_6=$qini['l_name'];
					}

/////////////////////////////
require_once('../classes/globalClass.php');
$vcmblcnf=new settings();
///////////////////////////


//confirm combinations/////
if($task=="cnfm"){
//echo$task.$index_6_6.$name_6_6.$year_6_6.$stream_6_6.$comb_6_61.$comb_6_62.$comb_6_63;
		// Add Student
			
$stflcmb="[".$comb_6_61."]+[".$comb_6_62."]+[".$comb_6_63."]";
$currentcrrclm=$vcmblcnf->getcrntcryculmvle();


	$query_6_8="insert into student(id, l_name, initials, year, stream, combination, batch,curriculum) values('$index_6_6', '$name_6_6', '$ini_6_6', '$acycur', 'General', '$stflcmb', '$year_6_6',$currentcrrclm)";
	$usr_addings=mysql_query($query_6_8);
	//echo$query_6_8;
	if($usr_addings){
		$query_6_9="update rumisdb.fohssmis set section='checked' where user='$index_6_6'";
		$usr_addings=mysql_query($query_6_9);
								//edit by iranga
		
					/*////////////////////////delete registration//////////////////////////   
                    $quedelprereg="delete from registration where student='$index_6_6' and acedemic_year='$acy' and (semister=1 or semister=3) and confirm=0";
                    //echo$quedelprereg;
                    mysql_query($quedelprereg);
                    /////////////////////////////////////////////////////////////////////
						
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
						
						/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/	
				
		$divstno=substr($index_6_6,2);
		echo "HS/$year_6_6/$divstno <br>";
		
		
		$cnfcmsubone=$vcmblcnf->getmainsubject($comb_6_61);
		$cnfcmsubtwo=$vcmblcnf->getmainsubject($comb_6_62);		
		$cnfcmsubthree=$vcmblcnf->getmainsubject($comb_6_63);

		$fullcnfcmb=$cnfcmsubone."+".$cnfcmsubtwo."+".$cnfcmsubthree;
		
		echo"$fullcnfcmb";
						}
//////////////////////////////						
}
//undo confirm combinations

if($task=="undocf"){
//echo$task.$index_6_6.$name_6_6.$year_6_6.$stream_6_6.$comb_6_6;

$quedelcmb="delete from student where id='$index_6_6'";
//echo$quedelcmb;
mysql_query($quedelcmb);


$queuseoth="update rumisdb.fohssmis set section='Other' where user='$index_6_6'";
//echo$queuseoth;
mysql_query($queuseoth);
	


/*
$quedelreg="delete from  registration where student='$index_6_6' and acedemic_year='$acy' and (semister=1 or semister=3)";
//echo$quedelreg;
mysql_query($quedelreg);
*/
$quegtstcmb="select combination from request_combination where stno='$index_6_6' and acc_year='$acy'";
$qugtstcmb=mysql_query($quegtstcmb);

if(mysql_num_rows($qugtstcmb)==0){
$quegetmnsub="select * from main_subjects where status=1 order by sub_name";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	echo'<select name="comb_6_6"  id="'.$stno.'comb_sub01"><option value=0>Select Subject</option>';
	$qugetmnsub=mysql_query($quegetmnsub);
	while($qgetmnsub=mysql_fetch_array($qugetmnsub)){
		$getmnsub=$qgetmnsub['sub_name'];
		$getmnsubid=$qgetmnsub['sub_id'];
		if($getmnsubid==$sub1){
			echo"<option value=$getmnsubid selected>$getmnsub</option>";
		}
		else{
			echo"<option value=$getmnsubid>$getmnsub</option>";
		}
		
	}	
	echo"</select>";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	echo'+<select name="comb_6_6"  id="'.$stno.'comb_sub02"><option value=0>Select Subject</option>';
	$qugetmnsub2=mysql_query($quegetmnsub);
	while($qgetmnsub2=mysql_fetch_array($qugetmnsub2)){
		$getmnsub2=$qgetmnsub2['sub_name'];
		$getmnsubid2=$qgetmnsub2['sub_id'];
		if($getmnsubid2==$sub2){
			echo"<option value=$getmnsubid2 selected>$getmnsub2</option>";
		}
		else{
			echo"<option value=$getmnsubid2>$getmnsub2</option>";
		}
		
	}	
	echo"</select>";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	echo'+<select name="comb_6_6"  id="'.$stno.'comb_sub03"><option value=0>Select Subject</option>';
	$qugetmnsub3=mysql_query($quegetmnsub);
	while($qgetmnsub3=mysql_fetch_array($qugetmnsub3)){
		$getmnsub3=$qgetmnsub3['sub_name'];
		$getmnsubid3=$qgetmnsub3['sub_id'];
		if($getmnsubid3==$sub3){
			echo"<option value=$getmnsubid3 selected>$getmnsub3</option>";
		}
		else{
			echo"<option value=$getmnsubid3>$getmnsub3</option>";
		}
		
	}	
	echo"</select>";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
						}
		else{
		
			
$quegetmnsub="select * from main_subjects where status=1 order by sub_name";
//echo$quegetmnsub;
			while($qgtstcmb=mysql_fetch_array($qugtstcmb)){
				$stcmb=$qgtstcmb['combination'];

////////////////////////////////888888888888888888888888888888888888888///////////////////////////////////////	
				
				$cmbval=explode("+",$stcmb);

	$rmopbckt=explode("[",$cmbval[0]);
		$rmclbkt=explode("]",$rmopbckt[1]);
	$puresubid1=$rmclbkt[0];

	$rmopbckt2=explode("[",$cmbval[1]);
		$rmclbkt2=explode("]",$rmopbckt2[1]);
	$puresubid2=$rmclbkt2[0];	
	
	$rmopbckt3=explode("[",$cmbval[2]);
		$rmclbkt3=explode("]",$rmopbckt3[1]);
	$puresubid3=$rmclbkt3[0];					
				
				
				
				
				
				
					$sub1=$puresubid1;
						$subone=$vcmblcnf->getmainsubject($sub1);
					$sub2=$puresubid2;
						$subtwo=$vcmblcnf->getmainsubject($sub2);
					$sub3=$puresubid3;	
						$subthree=$vcmblcnf->getmainsubject($sub3);
						}


	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	echo'<select name="comb_6_6"  id="'.$stno.'comb_sub01"><option value=0>Select Subject</option>';
	$qugetmnsub=mysql_query($quegetmnsub);
	while($qgetmnsub=mysql_fetch_array($qugetmnsub)){
		$getmnsub=$qgetmnsub['sub_name'];
		$getmnsubid=$qgetmnsub['sub_id'];
		if($getmnsubid==$sub1){
			echo"<option value=$getmnsubid selected>$getmnsub</option>";
		}
		else{
			echo"<option value=$getmnsubid>$getmnsub</option>";
		}
		
	}	
	echo"</select>";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	echo'+<select name="comb_6_6"  id="'.$stno.'comb_sub02"><option value=0>Select Subject</option>';
	$qugetmnsub2=mysql_query($quegetmnsub);
	while($qgetmnsub2=mysql_fetch_array($qugetmnsub2)){
		$getmnsub2=$qgetmnsub2['sub_name'];
		$getmnsubid2=$qgetmnsub2['sub_id'];
		if($getmnsubid2==$sub2){
			echo"<option value=$getmnsubid2 selected>$getmnsub2</option>";
		}
		else{
			echo"<option value=$getmnsubid2>$getmnsub2</option>";
		}
		
	}	
	echo"</select>";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	echo'+<select name="comb_6_6"  id="'.$stno.'comb_sub03"><option value=0>Select Subject</option>';
	$qugetmnsub3=mysql_query($quegetmnsub);
	while($qgetmnsub3=mysql_fetch_array($qugetmnsub3)){
		$getmnsub3=$qgetmnsub3['sub_name'];
		$getmnsubid3=$qgetmnsub3['sub_id'];
		if($getmnsubid3==$sub3){
			echo"<option value=$getmnsubid3 selected>$getmnsub3</option>";
		}
		else{
			echo"<option value=$getmnsubid3>$getmnsub3</option>";
		}
		
	}	
	echo"</select>";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////888888888888888888888888888888888888888///////////////////////////////////////
			

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////after undo re enter registration////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////         
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////// ////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////         
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                       /* $quereglsefirst="select distinct c.code,c.semister,c.target_group from courseunit c, combination o, target_group t where o.id=$cmbvl and o.subject=t.subject and t.target_id=c.target_group and c.core='co' and c.level='1' and (c.semister=1 or c.semister=3) and c.availability=1 order by c.code";
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
                                                            }*/
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////// end after undo re enter registration////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////         
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////         
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		
						}


}

//////////////////////////////////










////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($task=="setnwspstm"){

$quegetpresubcnb="select stream,combination from  student where id='$stno'";
//echo$quegetpresubcnb;
$qugetpresubcnb=mysql_query($quegetpresubcnb);
if(mysql_num_rows($qugetpresubcnb)!=0){
	$qgetpresubcnb=mysql_fetch_array($qugetpresubcnb);
		$getpresubcnb=$qgetpresubcnb['combination'];
		$getprestream=$qgetpresubcnb['stream'];		
		if($getprestream=="General"){
		$queinprcnbi="insert into pre_sub_combination(st_num,sub_combination) values ('$stno','$getpresubcnb')";
		//echo$queinprcnbi;
		$quinprcnbi=mysql_query($queinprcnbi);			
		if($quinprcnbi){
			
			$newspstrm="[".$comb_6_61."]";
			$newspstrmname=$vcmblcnf->getmainsubject($comb_6_61);
			$queupdtsttbl="update student set stream='Special',combination='$newspstrm' where id='$stno'";
			//echo$queupdtsttbl;
			$quupdtsttbl=mysql_query($queupdtsttbl);
			if($quupdtsttbl){
				echo"<font color=blue>Successfully registered to the ".strtoupper($newspstrmname)." special stream .</font>";
			}
			else{
				echo"Error with registration! Please try again.";
			}
			
			}
			else{
				echo"Sorry! Can not register, Please try again.";
			}
		
		
		}
		else{
			$newspstrm="[".$comb_6_61."]";
			$newspstrmname=$vcmblcnf->getmainsubject($comb_6_61);
			$queupdtsttbl="update student set stream='Special',combination='$newspstrm' where id='$stno'";
			//echo$queupdtsttbl;
			$quupdtsttbl=mysql_query($queupdtsttbl);
			if($quupdtsttbl){
				echo"<font color=blue>Successfully registered to the ".strtoupper($newspstrmname)." special stream .</font>";
			}
			else{
				echo"Error with registration! Please try again.";
			}
		}
	
}
else{
	echo"Error! Please try again.";
}








}
////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($task=="undospreg"){
	$quegetpresbcmbi="select * from pre_sub_combination where st_num='$stno'";
	$qugetpresbcmbi=mysql_query($quegetpresbcmbi);
	if(mysql_num_rows($qugetpresbcmbi)==0){
		echo"System Error! Please try again.";
	}
	else{
		$qgetpresbcmbi=mysql_fetch_array($qugetpresbcmbi);
			$getpresbcmbipsc_id=$qgetpresbcmbi['psc_id'];
			$getpresbcmbi=$qgetpresbcmbi['sub_combination'];
			
			$queupdtsttbl="update student set stream='General',combination='$getpresbcmbi' where id='$stno'";
			//echo$queupdtsttbl;
			$quupdtsttbl=mysql_query($queupdtsttbl);
			if($quupdtsttbl){
			/////////////////////////////////////////////////////////////////////////////////////////////
			/////////////////////////////////////////////////////////////////////////////////////////////
			$cmbval=explode("+",$getpresbcmbi);

				$rmopbckt=explode("[",$cmbval[0]);
					$rmclbkt=explode("]",$rmopbckt[1]);
				$puresubid1=$rmclbkt[0];

				$rmopbckt2=explode("[",$cmbval[1]);
					$rmclbkt2=explode("]",$rmopbckt2[1]);
				$puresubid2=$rmclbkt2[0];	
				
				$rmopbckt3=explode("[",$cmbval[2]);
					$rmclbkt3=explode("]",$rmopbckt3[1]);
				$puresubid3=$rmclbkt3[0];					
											
					$sub1=$puresubid1;
						$subone=$vcmblcnf->getmainsubject($sub1);
					$sub2=$puresubid2;
						$subtwo=$vcmblcnf->getmainsubject($sub2);
					$sub3=$puresubid3;	
						$subthree=$vcmblcnf->getmainsubject($sub3);
			
			
						echo "<div id='div$stno'> ";
								
								echo'<select name="spclstrm"  id="'.$stno.'spclstrm" style="width : 90%;"><option value=0 selected>Select Subject</option>';

									echo"<option value=$sub1>$subone</option>";
									echo"<option value=$sub2>$subtwo</option>";
									echo"<option value=$sub3>$subthree</option>";
									
									
								echo"</select>";
								
						echo"</div>";
						
						
				$quedelrec="delete from pre_sub_combination where st_num='$stno' and psc_id=$getpresbcmbipsc_id";	
				$qudelrec=mysql_query($quedelrec);
			/////////////////////////////////////////////////////////////////////////////////////////////
			/////////////////////////////////////////////////////////////////////////////////////////////
				
				
				
				
			}
			else{
				echo"Error with undo! Please try again.";
			}
			
		
	}
	
	
	

}
////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////











?>
