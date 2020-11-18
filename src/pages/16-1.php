

<?php



	require_once('classes/attClass.php');
	require_once('classes/globalClass.php');		
	
	$m=new attendence();
	$n=new settings();	

	static $desition=1;
				


//...............get acc_year....................

$acc_year="select acedemic_year from acc_year where current='1'";
$ac_year=mysql_query($acc_year);
while($a_y=mysql_fetch_array($ac_year)){
$acy=$a_y['acedemic_year'];
}
//.................................................	
// ger semester.........................

$crrseme=$n->getSemister();

		
//Selecting courses to submit Medical

$userst=$_SESSION['user_id'];
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
$getstlvl=$n->getLevel($userst);
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
//if($getstlvl==1){
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////


	$task=$_GET['task'];
	if($task=='viewAtt'){
						
	$course=$_GET['course'];
	$user16=$_SESSION['user_id'];
						

						
				
	// Ending one by one 
						
	///////////////// Select Available Course Types related to Course /////////
	
	echo "Summery of Your Attendence <hr class=bar><br>";			
	

//...............get acc_year....................
$acc_year="select acedemic_year from acc_year where current='1'";
$ac_year=mysql_query($acc_year);
while($a_y=mysql_fetch_array($ac_year)){
$acy=$a_y['acedemic_year'];
}
//.................................................	

$practgp=$m->getprctgp($user16,$course,$acy);

	$query_4="select distinct type from lecture where course='$course' and acc_year='$acy'";
	//echo$query_4;
	$q4=mysql_query($query_4);

	if(mysql_num_rows($q4)!=0){	

	$divid=1;
	while($raw4=mysql_fetch_array($q4)){
	
	$a=$raw4['type'];
	echo '<font color=Green><b>Attendence of '.ucfirst($a).' - in '.$course.' Course Unit</b></font><br/><br/>';
	
	$total=$m->getTotal($course, $user16, $a, $acy);
	$ctotal=$m->getSubTotal($course, $a, $acy,$practgp);
	
	
	
	$cp=$total/$ctotal*100;

	$acc_year1=$n->getAcc();
	$max=$m->getMax($course,$a,$acc_year1);

	if($max=="nd"){

	echo 'Total Partcipated Hours : '.$total.'<br />';
	echo 'Total Lecture Hours : '.$ctotal.'<br /><br />';




	?>
	
	  
	<script type="text/javascript">

$(document).ready(function() {
	  $("#<?php echo 'a'.$divid;?>").progressbar({ value: <?php echo round($cp);?> });  });

</script>
 
  
  <div id="<?php echo 'a'.$divid;?>" style="width:70%;"></div><br />

	<?php 

}


		//echo '<font color=red>Your Available Percentage : '.round($cp).'&nbsp; %</font><br />';
		
		
		if($max=="nd"){
			$max=80;
				}
		if(!(isset($max)))
		$max=80;
		//echo '<font color=#736533 size=3px>Cut off Percentage : '.$max.'&nbsp; %</font><br />';
		echo '<font color=#736533 size=3px>Cut off Percentage : 80&nbsp;%</font><br />';
		
		if($desition!=0){
		if($cp>=$max)
		$desition=2;
		else
		$desition=0;
		}
		
   // echo "<hr class=bar>";
    $divid++;
	}
	
	

    ////////////////////////////////////////////////////////////////////////////
    

	
	if($desition==2){
		echo "<br /><img src=images/e.png><br /> <font color=green size=4px>You are Eligible to sit exam for course unit</font>&nbsp;&nbsp;&nbsp;<br />";
		echo "(Note : This may be changed with changings of relevant department)";
	}
	else{
		echo "<br /><img src=images/n.png><br /> <font color=red size=4px>Sorry! you are Not Eligible to  sit exam for this course unit</font>&nbsp;&nbsp;&nbsp;<br />";
		echo "(Note : This may be changed with changings of relevant department)";
		
	}

	echo "<hr class=bar>";
	echo'<a href="index.php?view=admin&admin=16"><img src="./images/small/back.png"><br>&nbsp;Go Back&nbsp;</a><br><br>';
	
		}
/////////////////////////////////////////////////////////////////////////
	else{
		echo"Sorry! Can not View Exam Eligibility for  $course <br>";
		echo'<a href="index.php?view=admin&admin=16"><img src="./images/small/back.png"><br>&nbsp;Go Back&nbsp;</a><br><br>';
		}
///////////////////////////////////////////////////////////////////////////



	}
	else{

		///////////////////////check student passout or not/////////////////////////////////
		//............get st level...........................
		$stlvl=$n->getLevel($userst);
		//..................................................

		if($stlvl!=0){


				
	echo "Select the Course Unit For view Eligibility<br>";
	echo"<hr class=bar>";
	
	$user16=$_SESSION['user_id'];
	$query_16="select r.course, c.name, c.department from registration r,courseunit c where r.course=c.code and r.student='$user16' and r.acedemic_year='$acy'  and (r.semister=$crrseme or r.semister=3) and r.confirm='1' ";
	$q16=mysql_query($query_16);
	if(mysql_num_rows($q16)!=0){
	echo '<table border=0><tr><th>Subject<th>Name<th>Department<th>View</tr>';
	while($raw4=mysql_fetch_array($q16)){
                                
              $elblcos=$raw4['course'];                  
////////////////////.........................................................///////////////////////////////////////                                
 ////////////////////////////////////////////////////////////////////////////////////////
            $coursegetchr=trim($elblcos);
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
                                
                                
                                
                                
	                        
                            
////////////////////.........................................................///////////////////////////////////////	                    
	                
	            
	        
	    
	echo '<tr class=trbgc><td align=center>'.$fulcode3.'<td>'.$raw4['name'].'<td align=center>'.ucfirst($raw4['department']).'<td align=center><a href=index.php?view=admin&admin=16&task=viewAtt&course='.$raw4['course'].'> View </a>';
	}
	echo '</table></font>';
				}
	else{
		echo"<font color='red'>Sorry!You have not registered to any subject for this semester.</font>";
		}		


}	///check level if

	else{
		echo '<font color="red"> Sorry!  This option is not available for you.</font><br>';

		}
////////////////////////////////////////////////////////////////////////////////////////////////

	
	}




////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////stop dispaly for lvl2&3/////////////////////////////////////////////
/*}
else{
echo'<font color="red" size="3">Note : Estimated eligibility viewer of FOS-MIS closed for students.....</font>';
}
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
 
 echo '<font color="red" size="3">Note : Estimated eligibility viewer of FOS-MIS closed for students.</font>';						
?>




