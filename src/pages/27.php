<?php
echo "View Registered Student for Course Units <hr class=bar><br>";
						
	
include'./admin/config.php';								
$lec_id=$_SESSION['user_id'];
						
$con21_1=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);
			
//...............get acc_year....................
$acc_year="select acedemic_year from acc_year where current='1'";
$ac_year=mysql_query($acc_year);
while($a_y=mysql_fetch_array($ac_year)){
$acy=$a_y['acedemic_year'];
}
//.................................................	


$query_21_8="select distinct semister from level";
$attL=mysql_query($query_21_8);
while($find_semiL=mysql_fetch_array($attL)){
$find_L=$find_semiL['semister'];
}

///////////////////////////check reg on/off/////////////////////////////////			
$queregst="select register from call_registration";
$quregst=mysql_query($queregst);
$qregst=mysql_fetch_array($quregst);
$regst=$qregst['register'];
//////////////////////////////////////////////////////////////////////////

///////////////////////////////// task 8///////////////////////////////////
// View attendences Available
$task8=$_GET['task8'];
if($task8=='attendence'){
$fmviweque="$rmsdb.fohssmisStudents fs";

$sub_21=$_GET['sub'];
echo"<div align='right'>";
echo"[ <a href='index.php?view=admin&admin=27'>Back to Subjects List</a> ]";
echo"</div>";
echo "<font color=red>Current Registration of ".strtoupper($sub_21)." Course Unit</font><br />";

////////////////////////////
////////////////////////////
$quehtl1ns1="select level, semister from courseunit where code='$sub_21'";

$quhtl1ns1=mysql_query($quehtl1ns1);
while($qhtl1ns1=mysql_fetch_array($quhtl1ns1)){
    $coslvl=$qhtl1ns1['level'];
    $cossem=$qhtl1ns1['semister'];
                        }

if(($coslvl==1)&&(($cossem==1)||($cossem==3))){
///////////////////////////check reg on/off/////////////////////////////////            
$queregst2="select status from  call_combination";

$quregst2=mysql_query($queregst2);
$qregst2=mysql_fetch_array($quregst2);
$regst2=$qregst2['status'];
//////////////////////////////////////////////////////////////////////////

    if($regst2==1){
        $jonque="$rmsdb.fohssmis u";
        $query_21_8="select distinct r.student, u.l_name, u.initials from registration r, $jonque, $fmviweque where u.user=concat('sc',r.student) and r.course ='$sub_21' and r.acedemic_year='$acy' and concat('sc',r.student)=fs.user_name order by u.user";
  
    $newst="yes";
            }
    else{
    $query_21_8="select distinct r.student, s.l_name, s.initials, s.year from registration r, student s, $fmviweque where s.id=r.student and r.course = '$sub_21' and r.acedemic_year='$acy' and r.confirm='1' and concat('sc',r.student)=fs.user_name order by r.student";

        }


                }
	
else{
/////////////////////////
if($regst==0){
	$query_21_8="select distinct r.student, s.l_name, s.initials, s.year from registration r, student s, $fmviweque where s.id=r.student and r.course = '$sub_21' and r.acedemic_year='$acy' and r.confirm='1' and concat('sc',r.student)=fs.user_name order by r.student";
		}
else{
	$query_21_8="select distinct r.student, s.l_name, s.initials, s.year from registration r, student s, $fmviweque where s.id=r.student and r.course = '$sub_21' and r.acedemic_year='$acy' and concat('sc',r.student)=fs.user_name order by r.student";
	}
	}
	$stcnt=0;
  	$oce=mysql_query($query_21_8);
  	if(mysql_num_rows($oce)!=0){
  	echo '<table>';
	echo"<tr><th>No<th>Name with Initials<th>Student Number</tr>";
	while($data2=mysql_fetch_array($oce)){
	    $stcnt++;
	echo '<tr class="trbgc">';
	echo "<td align=center>$stcnt<td>".$data2['l_name']." ".$data2['initials']."<td align=center>";
	if($newst=="yes"){
            $tmpstno=$data2['student'];
            echo$tmpstno;
                    }
        else{
        echo"SC/".$data2['year']."/".strtoupper($data2['student']);
            }
	
	
	
	$student_select=$data2['student'];
	/// Student Registration Information
	
	
		
	// End Student Registration Information	
	
	}
	
	
	echo "</table>";
	   }
else{
    echo"Sorry! there are no registered student found<br>";
}

if($regst==0){
    $query_21_9="select count(distinct r.student) from registration r, student s, $fmviweque where s.id=r.student and r.course = '$sub_21' and r.acedemic_year='$acy' and concat('sc',r.student)=fs.user_name and r.confirm='1'";
		}
else{
	$query_21_9="select count(distinct r.student) from registration r, student s, $fmviweque where s.id=r.student and r.course = '$sub_21' and r.acedemic_year='$acy' and concat('sc',r.student)=fs.user_name";
	}
  	$oce2=mysql_query($query_21_9);
	while($data3=mysql_fetch_array($oce2)){
    echo '<br /> <font color="green">Number of Students Register : <b>';
        if($newst=="yes"){
        echo$stcnt;
                }
    else{
      echo $student_select=$data3['count(distinct r.student)'];
        }
    //echo $student_select=$data3['count(distinct r.student)'];
    echo '</b></font>';
    }



echo '<br><hr class=bar>';

////////////////////////////
////////////////////////////
}
	




////////////////////////////////end task8//////////////////////////////////



if($find_L==1)
$query_21_1="select code, name from courseunit where lecture='$lec_id' and (semister=1 or semister=3) and availability=1 order by code,name";
elseif($find_L==2)
$query_21_1="select code, name from courseunit where lecture='$lec_id' and (semister=2 or semister=3) and availability=1 order by code,name";
$att=mysql_query($query_21_1);
if(mysql_num_rows($att)!=0){
echo "<font >You have following subjects view Attendence </font><br><br><table border=0>";
while($attdata=mysql_fetch_array($att)){
       $allcose=$attdata['code'];
  //////////////////////.............................//////////////////////////////                          
            ////////////////////////////////////////////////////////////////////////////////////////
            $coursegetchr=trim($allcose);
            $ccdwoutcrd=substr("$coursegetchr", 0, -1);
            $getchar = preg_split('//', $coursegetchr, -1);

                    $credit=$getchar[7];
                    if(($credit=="a")||($credit=="A")){
                        $credit="&#945;";
                            }
                    elseif(($credit=="b")||($credit=="B")){
                        $credit="&#946;";
                                }
                    elseif(($credit=="d")||($credit=="D")){
                        $credit="&#948;";
                                }
                    else{
                        $credit=$credit;
                        }

            $allcose2=$ccdwoutcrd.$credit;
////////////////////////////////////////////////////////////////////////////////////////
                            ////////////////////////////////////////////////////////
                                $getchar = preg_split('//', $allcose2, -1);

                                $midcredit=$getchar[5];
                                if($midcredit=="b"){
                                    $getlob=explode('b',$allcose2);
                                        $fistprt=$getlob[0];
                                        $sectprt=$getlob[1];
                                        $fulcode3=strtoupper($fistprt)."b".$sectprt;
                                                        }

                                elseif($midcredit=="B"){
                                    $getlob=explode('B',$allcose2);
                                        $fistprt=$getlob[0];
                                        $sectprt=$getlob[1];
                                        $fulcode3=strtoupper($fistprt)."b".$sectprt;
                                                        }
                                else{
                                $fulcode3=strtoupper($allcose2);
                                }
                            ////////////////////////////////////////////////////                
                            
                            
                        
                    
 //////////////////////.............................//////////////////////////////                      
                    
                
            
        
    
echo '<tr align="left" class="trbgc" ><td><a href="index.php?view=admin&admin=27&sub='.$attdata['code'].'&task8=attendence">'.$fulcode3."</a><td>".ucfirst($attdata['name']);
}
mysql_close($con21_1);
echo "</table>";
}
else{
	echo"<font color=red>Sorry! Your department haven't initiate any subject for you .</font><br><br>";
	}
echo '<hr class=bar>';		
	
						

					
						
						

?>
