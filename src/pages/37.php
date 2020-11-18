<?php
require_once('classes/globalClass.php');		
						
$o=new settings();

$blk=$_GET['blk'];
if($blk!=null){
$_SESSION['gtblkscnd']=$blk;
}
$blk2=$_SESSION['gtblkscnd'];
echo "Edit Course Registration<hr class=bar>";
echo"<table border=0 width=95%><tr align=center class=selectbg2 valign=top><td width=50%>";

echo"<b><font size=3px>*** For General Degree Student ***</font></b><br><br>";
		include 'forms/form_37_2.php';


echo"<td>";
echo"<b><font size=3px>*** For Special Degree Student ***</font></b><br><br>";
		include 'forms/form_37_3.php';

echo"</tr></table>";
echo "<hr class=bar>";



if(isset($_POST['submit37'])){
	$_SESSION['student_reg']=$_POST['std_n'];
	$_SESSION['student_btc']=$_POST['std_y'];
	$_SESSION['regtp']=$_POST['regflt'];		
				}
$edtrgst=$_SESSION['student_reg'];
$edtrgstyr=$_SESSION['student_btc'];
$regtp=$_SESSION['regtp'];

      if($blk=="gnrg"){
      unset($_SESSION['gtblk']);
      }

      if(($blk=="sprg")&&($regtp=="current")){
      unset($_SESSION['gtblk']);
      }

if(($blk=="sprg")&&($regtp=="old")){
$_SESSION['gtblk']=$blk;
}

if(isset($_SESSION['gtblk'])){
$crblk=$_SESSION['gtblk'];
}


if($regtp=="current"){
	
	$regtp2="Current Registration";
	    
}
else{
if($crblk=="sprg"){
	$regtp2="General Degree Previous Registration";
	}
	else{
	$regtp2="Previous Registration";
	    }
}


//echo$edtrgst.$edtrgstyr;

$b=$o->getBatch($edtrgst);
$nm=$o->getName($edtrgst);
$crsem=$o->getSemister();
$cracyea=$o->getAcc();
if($crblk!="sprg"){
$level_st=$o->getLevel($edtrgst);
}
else{
$query23="SELECT distinct level from level l, student s where l.year = s.year and s.id = '$edtrgst'";
			$data223=mysql_query($query23);
			while($predata=mysql_fetch_array($data223)){
			$level_st= $predata['level'];
								}
}
$chkspst=$o->chkspecial($edtrgst);

$acyear=array();
$preacyer=array();
if($level_st!=0){
	$quegtallreg="select acedemic_year from acc_year where (current=1 or current=0) order by acedemic_year DESC limit $level_st";
}
else{
$quegetlvl3="select year from level where level=3";
$qugetlvl3=mysql_query($quegetlvl3);
$qgetlvl3=mysql_fetch_array($qugetlvl3);
    $getlvl3=$qgetlvl3['year'];


$quegetregyr="select year from student where id='$edtrgst'";
$qugetregyr=mysql_query($quegetregyr);
$qgetregyr=mysql_fetch_array($qugetregyr);
     $getregyr=$qgetregyr['year'];

  

  $psoutbt=3+($getlvl3-$getregyr);


	$quegtallreg="select acedemic_year from acc_year where (current=1 or current=0) order by acedemic_year DESC limit $psoutbt";
}
				$qugtallreg=mysql_query($quegtallreg);
				$i=0;
				while($qgtallreg=mysql_fetch_array($qugtallreg)){
					$gtallreg=$qgtallreg['acedemic_year'];
					$acyear[$i]="$gtallreg";
					$i++;
								}

				$preacyer=array_reverse($acyear);

//echo$level_st."/".$preacyer[0]."/".$preacyer[1]."/".$preacyer[2]."/".$psoutbt;






if($task=="eregister"){
$due=$_GET['due'];



//echo$crblk.$regtp;
///////////////////////////////////add///////////////////////////////////////////////////
if($due=="adnewreg"){
$adcode=$_POST['adcos'];
$cosdgst=$_POST['edregdst'];
//echo$due.$adcode.$cosdgst;

$queinsreg="insert into registration(student,course,acedemic_year,semister,degree,confirm) values('$edtrgst','$adcode','$cracyea',$crsem,$cosdgst,1)";
//echo$queinsreg;
mysql_query($queinsreg);


		}
////////////////////////////////////////////////////////////////////////////////////////





/////////////////////////////////remove/////////////////////////////////////////////////
if($due=="removereg"){
$rmcodeid=$_POST['rmcosid'];
$currreg=$_POST['currreg'];
$curdgst=$_POST['curdgst'];
$curcnfst=$_POST['curcnfst'];

//echo$due.$rmcodeid;

if($currreg=="Change"){
	$quecngcurrg="update registration set degree='$curdgst', confirm='$curcnfst' where id='$rmcodeid'";
	//echo$quecngprerg;
	mysql_query($quecngcurrg);
	$crok="<img src=./images/r.png >";
			}
else{

/////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////remove other details/////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
            $quegetcosfmreg="select * from registration where id='$rmcodeid'";
            $qugetcosfmreg=mysql_query($quegetcosfmreg);
            $qgetcosfmreg=mysql_fetch_array($qugetcosfmreg);
                $regcos2=$qgetcosfmreg['course'];
                         $regcos=trim($regcos2);
                $regst=$qgetcosfmreg['student'];
                
                $acedemic_year=$qgetcosfmreg['acedemic_year'];
                $semister=$qgetcosfmreg['semister'];                          
                $degree=$qgetcosfmreg['degree'];
                $confirm=$qgetcosfmreg['confirm'];
                            
                $queinsrereg="insert into remove_reg(student,course,academic_year,semester,degree,status) values('$regst','$regcos','$acedemic_year',$semister,$degree,$confirm)";
                //echo$id.$queinsrereg;
                mysql_query($queinsrereg);
                
                

                        ////////////////////////////remove result//////////////////////
                            $quermrslt="delete from results where index_number='$regst' and subject='$regcos'";
                            //echo$quermrslt;
                            mysql_query($quermrslt);
                        ///////////////////////////////////////////////////////////////


                        ///////////////////////////remove exam registration//////////////////////
                           $quereexmreg="delete from exam_registration where student='$regst' and course='$regcos'";
                            //echo$quereexmreg;
                           mysql_query($quereexmreg);
                        ///////////////////////////////////////////////////////////////////////// 

////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////

$quedelreg="delete from registration where id='$rmcodeid'";
mysql_query($quedelreg);



	}


		}
////////////////////////////////////////////////////////////////////////////////////////



if($b!=$edtrgstyr){
echo"<br><font color='red'>Sorry !,( HS/$edtrgstyr/$edtrgst ) is Invalid Student Number.</font><br>";

			}

else{
//echo$chkspst.$crblk."--".$blk;
///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
$edregtype="false";

if(($chkspst=="General Student")&&($blk2=="gnrg")){
    $edregtype="true";
}
elseif(($chkspst!="General Student")&&($blk2=="sprg")){
    $edregtype="true";
}
else{
    $edregtype="false";
    if($chkspst=="General Student"){
	  $flsermsg="Please Enter Special Degree Student's Number ";
				      }
    else{
	  $flsermsg="Please Enter General Degree Student's Number ";
	}


}
//echo$edregtype;
///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////////////////
//if($level_st==0){
//	echo"<font color='red'>This function is not available for passout student (HS/$edtrgstyr/$edtrgst is pass out student).</font><br>";	
//		}
//else{
/////////////////////////////////////////////////////////////////////////////////////////
echo"<h3>$regtp2 Details of $nm ( HS/$edtrgstyr/$edtrgst )</h3>";
if($edregtype=="true"){



//////////////////////////////////////////////////////////////////////////////////////
//////////////////// current registratios/////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
if($regtp=="current"){
if($blk2!="sprg"){
$quegtalcos="select distinct c.code, c.name ,c.requirment,c.core from courseunit c, combination o, student s , target_group t where o.id=s.combination and s.id='$edtrgst' and o.subject=t.subject and t.target_id=c.target_group and (c.core='co' or c.core='op')  and c.level='$level_st' and (c.semister=$crsem or c.semister=3) and c.availability=1 order by c.core,c.code";
			}
else{
$quegtalcos="select distinct c.code, c.name ,c.requirment,c.core from courseunit c, combination o, student s , target_group t where o.id=s.combination and s.id='$edtrgst' and o.subject=t.subject and t.target_id=c.target_group and (c.core='co' or c.core='op') and (c.semister=$crsem or c.semister=3) and c.availability=1 order by c.core,c.code";
	}
//echo$quegtalcos;

$qugtalcos=mysql_query($quegtalcos);
if(mysql_num_rows($qugtalcos)!=0){
echo"[ $cracyea Academic Year and Semester $crsem ]";
echo"<table align=center border=0>";
echo"<tr class=selectbg height=20px><td align=center>Registered Course Units</tr>";
echo"<tr class=trbgc height=20px><td align=center>Not Registered Course Units</tr>";
echo"</table>";
echo"<table border=0><tr><th>Course Unit<th>Name<th>Core<th> Prerequisites<th>Degree Status<th>Confirmation<th>Submit</tr>";



	while($qgtalcos=mysql_fetch_array($qugtalcos)){
			$code=$qgtalcos['code'];
				$code2=strtoupper($code);
			$name=$qgtalcos['name'];
				$name2=ucfirst($name);
			$requirment=$qgtalcos['requirment'];
				
			$core=$qgtalcos['core'];
				if($core=="op"){
					$core2="Optional Course";
						}
				if($core=="co"){
					$core2="Core Course";
						}



		$quechkreg="select id, degree, confirm from registration where student='$edtrgst' and course='$code' and acedemic_year='$cracyea' and (semister=$crsem or semister=3)";
		//echo$quechkreg;
		$quchkreg=mysql_query($quechkreg);
		if(mysql_num_rows($quchkreg)==0){
			echo"<form method=POST action='./index.php?view=admin&admin=37&task=eregister&due=adnewreg'>";
			echo"<tr class=trbgc><td align=center>$code2<input type=hidden name=adcos value='$code2'><td>$name2<td align=center>$core2<td>$requirment<td  align=center>";
				if($core=="op"){
					echo"<select name=edregdst>";
						echo"<option value=1>Degree</option>";
						echo"<option value=2>Non Degree</option>";
					echo"</select>";
						}
				else{
					echo"<select name=edregdst>";
						echo"<option value=1>Degree</option>";
					echo"</select>";
					}
			echo"<td align=center>Not Rigister<td align=center><input type=submit value='Add'></form></tr>";


						}
		else{
			while($qchkreg=mysql_fetch_array($quchkreg)){
				$id=$qchkreg['id'];
				$degree=$qchkreg['degree'];
					


				$confirm=$qchkreg['confirm'];
					


				echo"<form method=POST action='./index.php?view=admin&admin=37&task=eregister&due=removereg'>";

				echo"<tr class=selectbg><td align=center>$code2";
					if($code=="$adcode"){
					echo"<img src=./images/r.png >";
							}

				echo"<input type=hidden name=rmcosid value='$id'><td>$name2<td align=center>$core2<td>$requirment";
				
				echo"<td align=center>";
				echo"<select name=curdgst>";
					if($core=="co"){
						echo"<option value=1>Degree</option>";
						}
					else{
						if($degree==1){
						echo"<option value=1 selected>Degree</option>";
						echo"<option value=2> Non Degree</option>";
							}
						else{
						echo"<option value=1>Degree</option>";
						echo"<option value=2 selected> Non Degree</option>";
						}


					
						}
				echo"</select>";
	
				echo"<td align=center>";
				echo"<select name=curcnfst>";
					if($confirm==1){
							echo"<option value=1 selected>Confirm</option>";
							echo"<option value=0>Not Confirm</option>";
								}
						else{
							echo"<option value=1>Confirm</option>";
							echo"<option value=0 selected>Not Confirm</option>";
							}
				echo"</select>";
				echo"<td align=center>";
					if($id==$rmcodeid){
						echo$crok;
								}
				echo"<input type=submit value='Change' name=currreg> <input type=submit value='Remove' name=currreg></form></tr>";







									}


			}






							}

echo"</table>";
				}//num_rows !=0 if close
else{
echo"<font color=red>Sorry! Can not find informations.</font>"; 
}



}
//////////////////////////////////////////////////////////////////////////////////////
//////////////////// end current registratios/////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////















//////////////////////////////////////////////////////////////////////////////////////
//////////////////////// privious registratios////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
if($regtp=="old"){

if(isset($_POST['lvlsem'])){
$_SESSION['fdstlvl']=$_POST['stlvl'];
$_SESSION['edstsem']=$_POST['stsem'];
				}
$stlvl=$_SESSION['fdstlvl'];
$stsem=$_SESSION['edstsem'];



echo"<table border=0><tr class=trbgc><td align=center>";
echo"Select Level and Semester to find Details<br>";
echo"<form method=POST action='./index.php?view=admin&admin=37&task=eregister&due=prereg'>";
echo"<select name=stlvl>";
	echo"<option value='0' selected >All Levels</option>";
//////////////for sp st//////////////////////
if($blk2=="sprg"){
	$query23="SELECT distinct level from level l, student s where l.year = s.year and s.id = '$edtrgst'";
	$data223=mysql_query($query23);
		while($predata=mysql_fetch_array($data223)){
			$level_st= $predata['level'];
								}
}
/////////////////////////////////////////////

//////////////for passout st/////////////////
if($level_st==0){
$level_st=3;
}
/////////////////////////////////////////////

for($sb=0;$sb<$level_st;$sb++){
	$sbsum=$sb+1;
	echo"<option value='$sbsum'>Level $sbsum</option>";
	
				}
echo"</select>";

echo"<select name=stsem>";
	echo"<option value='0' selected >All Semesters</option>";
	echo"<option value='1'>Semester I</option>";
	echo"<option value='2'>Semester II</option>";
	
echo"</select>";


echo"<input type=submit name='lvlsem' value='Search'>";

echo"</form></td></tr></table>";

//echo$stlvl.$stsem;

if($due=="prereg"){
$sdue=$_GET['sdue'];
//echo$sdue;

//////////////////////////////////////////////////////// insert pre reg/////////////////////////////////////////////////////////////////////////////////////
if($sdue=="adprerg"){
$precos=$_POST['precos'];
$preacyr=$_POST['preacyr'];
$presem=$_POST['presem'];
$edregdst=$_POST['edregdst'];
//echo$precos.$preacyr.$presem.$edregdst;

$queprergins="insert into registration(student,course,acedemic_year,semister,degree,confirm) values('$edtrgst','$precos','$preacyr',$presem,$edregdst,1)";
//echo$queprergins;
mysql_query($queprergins);

			}
//////////////////////////////////////////////////////// end insert pre reg //////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////// modify or rm pre reg/////////////////////////////////////////////////////////////////////////////
if($sdue=="mdprerg"){
$precsid=$_POST['precsid'];
$precng=$_POST['precng'];
$predgst=$_POST['predgst'];
$precnfst=$_POST['precnfst'];

if($precng=="Change"){
	$quecngprerg="update registration set degree='$predgst', confirm='$precnfst' where id='$precsid'";
	//echo$quecngprerg;
	mysql_query($quecngprerg);
	$ok="<img src=./images/r.png >";
			}

else{
/////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////remove other details/////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
            $quegetcosfmreg="select * from registration where id='$precsid'";
            $qugetcosfmreg=mysql_query($quegetcosfmreg);
            $qgetcosfmreg=mysql_fetch_array($qugetcosfmreg);
                $regcos2=$qgetcosfmreg['course'];
                         $regcos=trim($regcos2);
                $regst=$qgetcosfmreg['student'];
                
                $acedemic_year=$qgetcosfmreg['acedemic_year'];
                $semister=$qgetcosfmreg['semister'];                          
                $degree=$qgetcosfmreg['degree'];
                $confirm=$qgetcosfmreg['confirm'];
                            
                $queinsrereg="insert into remove_reg(student,course,academic_year,semester,degree,status) values('$regst','$regcos','$acedemic_year',$semister,$degree,$confirm)";
                //echo$id.$queinsrereg;
                mysql_query($queinsrereg);
                
                

                        ////////////////////////////remove result//////////////////////
                            $quermrslt="delete from results where index_number='$regst' and subject='$regcos'";
                            //echo$quermrslt;
                            mysql_query($quermrslt);
                        ///////////////////////////////////////////////////////////////


                        ///////////////////////////remove exam registration//////////////////////
                           $quereexmreg="delete from exam_registration where student='$regst' and course='$regcos'";
                            //echo$quereexmreg;
                           mysql_query($quereexmreg);
                        ///////////////////////////////////////////////////////////////////////// 

////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////  
    
    
    
    
    
	$quedelprereg="delete from registration where id='$precsid'";
	//echo$quedelprereg;
	mysql_query($quedelprereg);
		}




			}
//////////////////////////////////////////////////////// end modify or rm pre reg /////////////////////////////////////////////////////////////////////////



if($crblk=="sprg"){


$quegetcmb="select combination from  request_combination where stno='$edtrgst' and status='Confirmed'";
//echo$quegetcmb;
$qugetcmb=mysql_query($quegetcmb);
if(mysql_num_rows($qugetcmb)!=0){
while($qgetcmb=mysql_fetch_array($qugetcmb)){
      $getcmb=$qgetcmb['combination'];
	      $gtstoldcmb=explode("/",$getcmb);
	      $stoldcmb=$gtstoldcmb[1];
					      }



//echo$stoldcmb;
//////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////qury set///////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
if(($stlvl==0)&&($stsem==0)){
echo"<b>All Registration Details</b><br>";

	if($level_st==3){
		$quegtalcosupt="select distinct c.code, c.name ,c.requirment,c.core ,c.level,c.semister from courseunit c, combination o, student s , target_group t where o.id=$stoldcmb and s.id='$edtrgst' and o.subject=t.subject and t.target_id=c.target_group and (c.core='co' or c.core='op') order by c.level,c.semister,c.code";
			}
	else if($level_st==2){
		$quegtalcosupt="select distinct c.code, c.name ,c.requirment,c.core ,c.level,c.semister  from courseunit c, combination o, student s , target_group t where o.id=$stoldcmb and s.id='$edtrgst' and o.subject=t.subject and t.target_id=c.target_group and (c.core='co' or c.core='op') and (c.level=2 or c.level=1) order by c.level,c.semister,c.code";
				}
	else{
		$quegtalcosupt="select distinct c.code, c.name ,c.requirment,c.core ,c.level,c.semister  from courseunit c, combination o, student s , target_group t where o.id=$stoldcmb and s.id='$edtrgst' and o.subject=t.subject and t.target_id=c.target_group and (c.core='co' or c.core='op') and c.level=1 order by c.level,c.semister,c.code";
		}
				}




else if(($stlvl==0)&&($stsem!=0)){
echo"<b>All Levels Semester $stsem Registration Details</b><br>";

	if($level_st==3){
		$quegtalcosupt="select distinct c.code, c.name ,c.requirment,c.core ,c.level,c.semister  from courseunit c, combination o, student s , target_group t where o.id=$stoldcmb and s.id='$edtrgst' and o.subject=t.subject and t.target_id=c.target_group and (c.core='co' or c.core='op') and (c.semister=$stsem or c.semister=3 )order by c.level,c.semister,c.code";
			}
	else if($level_st==2){
	$quegtalcosupt="select distinct c.code, c.name ,c.requirment,c.core ,c.level,c.semister  from courseunit c, combination o, student s , target_group t where o.id=$stoldcmb and s.id='$edtrgst' and o.subject=t.subject and t.target_id=c.target_group and (c.core='co' or c.core='op') and (c.semister=$stsem or c.semister=3 ) and (c.level=2 or c.level=1) order by c.level,c.semister,c.code";
				}
	else{
	$quegtalcosupt="select distinct c.code, c.name ,c.requirment,c.core ,c.level,c.semister  from courseunit c, combination o, student s , target_group t where o.id=$stoldcmb and s.id='$edtrgst' and o.subject=t.subject and t.target_id=c.target_group and (c.core='co' or c.core='op') and (c.semister=$stsem or c.semister=3 ) and c.level=1 order by c.level,c.semister,c.code";
		}
					}






else if(($stlvl!=0)&&($stsem==0)){
echo"<b>Level $stlvl Registration Details</b><br>";
$quegtalcosupt="select distinct c.code, c.name ,c.requirment,c.core ,c.level,c.semister  from courseunit c, combination o, student s , target_group t where o.id=$stoldcmb and s.id='$edtrgst' and o.subject=t.subject and t.target_id=c.target_group and (c.core='co' or c.core='op') and c.level=$stlvl order by c.level,c.semister,c.code";

				}





else{
echo"<b>Level $stlvl and Semester $stsem Registration Details</b><br>";
$quegtalcosupt="select distinct c.code, c.name ,c.requirment,c.core ,c.level,c.semister  from courseunit c, combination o, student s , target_group t where o.id=$stoldcmb and s.id='$edtrgst' and o.subject=t.subject and t.target_id=c.target_group and (c.core='co' or c.core='op') and (c.semister=$stsem or c.semister=3 ) and c.level=$stlvl order by c.core,c.code";

}


//////////////////////////////////////////////////////////////////////////////////////
///////////////////////////end qury set///////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////


}
else{
   echo"<font color=red>Subject Combinations Details are missing.</font></br>";

}


}

else{/////////////////else begin///////////////////////
if(($stlvl==0)&&($stsem==0)){
echo"<b>All Registration Details</b><br>";

	if($level_st==3){
		$quegtalcosupt="select distinct c.code, c.name ,c.requirment,c.core ,c.level,c.semister from courseunit c, combination o, student s , target_group t where o.id=s.combination and s.id='$edtrgst' and o.subject=t.subject and t.target_id=c.target_group and (c.core='co' or c.core='op') order by c.level,c.semister,c.code";
			}
	else if($level_st==2){
		$quegtalcosupt="select distinct c.code, c.name ,c.requirment,c.core ,c.level,c.semister  from courseunit c, combination o, student s , target_group t where o.id=s.combination and s.id='$edtrgst' and o.subject=t.subject and t.target_id=c.target_group and (c.core='co' or c.core='op') and (c.level=2 or c.level=1) order by c.level,c.semister,c.code";
				}
	else{
		$quegtalcosupt="select distinct c.code, c.name ,c.requirment,c.core ,c.level,c.semister  from courseunit c, combination o, student s , target_group t where o.id=s.combination and s.id='$edtrgst' and o.subject=t.subject and t.target_id=c.target_group and (c.core='co' or c.core='op') and c.level=1 order by c.level,c.semister,c.code";
		}
				}




else if(($stlvl==0)&&($stsem!=0)){
echo"<b>All Levels Semester $stsem Registration Details</b><br>";

	if($level_st==3){
		$quegtalcosupt="select distinct c.code, c.name ,c.requirment,c.core ,c.level,c.semister  from courseunit c, combination o, student s , target_group t where o.id=s.combination and s.id='$edtrgst' and o.subject=t.subject and t.target_id=c.target_group and (c.core='co' or c.core='op') and (c.semister=$stsem or c.semister=3 )order by c.level,c.semister,c.code";
			}
	else if($level_st==2){
	$quegtalcosupt="select distinct c.code, c.name ,c.requirment,c.core ,c.level,c.semister  from courseunit c, combination o, student s , target_group t where o.id=s.combination and s.id='$edtrgst' and o.subject=t.subject and t.target_id=c.target_group and (c.core='co' or c.core='op') and (c.semister=$stsem or c.semister=3 ) and (c.level=2 or c.level=1) order by c.level,c.semister,c.code";
				}
	else{
	$quegtalcosupt="select distinct c.code, c.name ,c.requirment,c.core ,c.level,c.semister  from courseunit c, combination o, student s , target_group t where o.id=s.combination and s.id='$edtrgst' and o.subject=t.subject and t.target_id=c.target_group and (c.core='co' or c.core='op') and (c.semister=$stsem or c.semister=3 ) and c.level=1 order by c.level,c.semister,c.code";
		}
					}






else if(($stlvl!=0)&&($stsem==0)){
echo"<b>Level $stlvl Registration Details</b><br>";
$quegtalcosupt="select distinct c.code, c.name ,c.requirment,c.core ,c.level,c.semister  from courseunit c, combination o, student s , target_group t where o.id=s.combination and s.id='$edtrgst' and o.subject=t.subject and t.target_id=c.target_group and (c.core='co' or c.core='op') and c.level=$stlvl order by c.level,c.semister,c.code";

				}





else{
echo"<b>Level $stlvl and Semester $stsem Registration Details</b><br>";
$quegtalcosupt="select distinct c.code, c.name ,c.requirment,c.core ,c.level,c.semister  from courseunit c, combination o, student s , target_group t where o.id=s.combination and s.id='$edtrgst' and o.subject=t.subject and t.target_id=c.target_group and (c.core='co' or c.core='op') and (c.semister=$stsem or c.semister=3 ) and c.level=$stlvl order by c.core,c.code";

}


}///////////////////////else close//////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////










//echo$quegtalcosupt;
//echo$crblk;
$qugtalcosupt=mysql_query($quegtalcosupt);

if(mysql_num_rows($qugtalcosupt)!=0){	
echo"<br>";	
echo"<table align=center border=0>";
echo"<tr class=selectbg height=20px><td align=center>Registered Course Units</tr>";
echo"<tr class=trbgc height=20px><td align=center>Not Registered Course Units</tr>";
echo"</table>";




echo"<table border=0><tr><th>Course Unit<th>Name<th>Core<th> Prerequisites<th>Degree Status<th>Confirmation<th>Submit</tr>";
while($qgtalcosupt=mysql_fetch_array($qugtalcosupt)){
			$code=$qgtalcosupt['code'];
				$code2=strtoupper($code);
			$name=$qgtalcosupt['name'];
				$name2=ucfirst($name);
			$requirment=$qgtalcosupt['requirment'];
				
			$core=$qgtalcosupt['core'];
				if($core=="op"){
					$core2="Optional Course";
						}
				if($core=="co"){
					$core2="Core Course";
						}
			$levl=$qgtalcosupt['level'];
				$ftacy=$preacyer[$levl-1];
			$cssem=$qgtalcosupt['semister'];
					
//echo"<tr class=trbgc><td>$code2 $ftacy<td>$name2 $levl<td>$requirment<td>$core2<td>e <td>e<td>e</tr>";
				$quechkprereg="select * from registration where  student='$edtrgst' and course='$code'";
				$quchkprereg=mysql_query($quechkprereg);
				if(mysql_num_rows($quchkprereg)==0){
				echo"<form method=POST action='./index.php?view=admin&admin=37&task=eregister&due=prereg&sdue=adprerg'>";
					echo"<tr class=trbgc><td align=center>$code2";
						echo"<input type=hidden name=precos value=$code>";
						echo"<input type=hidden name=preacyr value=$ftacy>";
						echo"<input type=hidden name=presem value=$cssem>";

					echo"<td>$name2<td align=center>$core2<td> $requirment<td align=center>";
						
					if($core=="op"){
						echo"<select name=edregdst>";
							echo"<option value=1>Degree</option>";
							echo"<option value=2>Non Degree</option>";
						echo"</select>";
							}
					else{
						echo"<select name=edregdst>";
							echo"<option value=1>Degree</option>";
						echo"</select>";
						}
					echo"<td align=center>Not Register<td align=center><input type=submit value='Add'></tr></form>";
			



									}
				else{
				while($qchkprereg=mysql_fetch_array($quchkprereg)){
					$id=$qchkprereg['id'];
					$acyear=$qchkprereg['acedemic_year'];
					$sem=$qchkprereg['semister'];
					$degree=$qchkprereg['degree'];
					$confirm=$qchkprereg['confirm'];
				echo"<form method=POST action='./index.php?view=admin&admin=37&task=eregister&due=prereg&sdue=mdprerg'>";
				echo"<tr class=selectbg><td align=center>$code2";
					if($code=="$precos"){
						echo"<img src=./images/r.png >";

							}
					//echo"<input type=text name=preacyr value=$ftacy>";
					//echo"<input type=text name=presem value=$cssem>";
					echo"<input type=hidden name=precsid value=$id>";
				echo"<td>$name2<td align=center>$core2<td>$requirment<td align=center>";
					echo"<select name=predgst>";
					if($core=="op"){
						if($degree==1){
							echo"<option value=1 selected>Degree</option>";
							echo"<option value=2>Non Degree</option>";
								}
						else{
							echo"<option value=1>Degree</option>";
							echo"<option value=2 selected> Non Degree</option>";
							}
							}
					if($core=="co"){
						echo"<option value=1>Degree</option>";
							}




					echo"</select>";
				echo"<td align=center>";
					echo"<select name=precnfst>";
						if($confirm==1){
							echo"<option value=1 selected>Confirm</option>";
							echo"<option value=0>Not Confirm</option>";
								}
						else{
							echo"<option value=1>Confirm</option>";
							echo"<option value=0 selected>Not Confirm</option>";
							}
					echo"</select>";
				echo"<td align=center>";
					if($id==$precsid){
						echo$ok;
								}
					echo"<input type=submit name=precng value='Change'><input type=submit name=precng value='Remove'>";

				echo"</tr></form>";




											}
					}




							}

echo"</table>";
					}// num of rows !=0
else{
	echo"Sorry! Can not find.";
	}


			}//due prereg close if




























//}
//////////////////////////////////////////////////////////////////////////////////////
//////////////////// end privious registratios ///////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////

			}//level 0 if close
		  }//true if close
else{
  echo"<font color=red>Sorry! Cannot Complete Process, $flsermsg</font>";
}
		}// batth if close



		}//task close if












					
						
						
?>
