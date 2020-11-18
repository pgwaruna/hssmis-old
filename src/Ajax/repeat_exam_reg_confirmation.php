<?php
session_start();
?>

<script type="text/javascript" src="../Ajax/repeat_exam_reg_confirmation.js"></script>


<?php
require_once('../classes/globalClass.php');
$rp=new settings();

//...............get acc_year....................
$acyart=$rp->getAcc();
//.................................................			

//...........get semester..........
$seme=$rp->getSemister();
//.................................................

	$task=$_GET['task'];
	$course=$_GET['course'];
	$student=$_GET['student'];
	$confirm=$_GET['conf'];
	$exregid=$_GET['exrid'];
	$core=$_GET['core'];


     include '../admin/config.php';
     $con5_a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
     mysql_select_db($db);	
error_reporting(0);
$ye=date('Y');
$dtntm=date("Y-m-d/H:i");
$user=$_SESSION['user_id'];

$upuser=$user."/".$dtntm;


if($task=="chngcnf"){
	//echo$course.$student.$confirm."cng";

	if($confirm==1){
	/////////////////////////////////already confirmed (1) set as notconfirmed(0)//////////////////////////////
		$queupexregi="update exam_registration set confirm=0, Last_update='$upuser' where id=$exregid";
		//echo$queupexregi;
		mysql_query($queupexregi);
				echo "<img id=cnf".$course."img".$student." src=../images/conf31.png onClick=change('$course','$student','0',$exregid) >";
				echo"<br><font color=red><b>0</b></font>";
			}
	else{	
	/////////////////////////////////already not confirmed (0) set as confirmed(1)//////////////////////////////
		$queupexregi="update exam_registration set confirm=1, Last_update='$upuser' where id=$exregid";
		//echo$queupexregi;
		mysql_query($queupexregi);	
				echo "<img id=cnf".$course."img".$student." src=../images/ntcnf.png onClick=change('$course','$student','1',$exregid)>";
				echo"<br><font color=green><b>1</b></font>";
				
		}	
		


			}


if($task=="addnew"){
//echo$course.$student.$confirm."add.$acyart.$seme";

$rgby="regby+".$upuser;
$queinsnewexrg="insert into exam_registration (student,course,acedemic_year,semester,degree,confirm,year,Last_update) values('$student','$course','$acyart',$seme,'$core',1,'$ye','$rgby')";
//echo$queinsnewexrg;
mysql_query($queinsnewexrg);

echo"<font color=red><b>Added!</b></font>";

			}


if($task=="remove"){
	//echo$course.$student.$confirm."rm".$exregid;
	
        $quedtexrg="select * from  exam_registration where id='$exregid'";
        $qudtexrg=mysql_query($quedtexrg);
           while($qdtexrg=mysql_fetch_array($qudtexrg)){
               $student2=$qdtexrg['student'];
               $course2=$qdtexrg['course'];
                    $course=$course2."-exm_reg";
               $acedemic_year=$qdtexrg['acedemic_year'];
               $semester=$qdtexrg['semester'];
               $degree=$qdtexrg['degree'];
               $confirm=$qdtexrg['confirm'];
               
               
               $queinsrereg="insert into remove_reg(student,course,academic_year,semester,degree,status) values('$student2','$course','$acedemic_year',$semester,$degree,$confirm)";
               //echo$id.$queinsrereg;
               mysql_query($queinsrereg);
               
               
           }
	
	
	$quedelexreg="delete from exam_registration where id=$exregid";
	//echo$quedelexreg;
	mysql_query($quedelexreg);
	echo"<font color=red><b>Removed!</b></font>";
    
    
    
    
    
    
    
    


			}




























/*
     include '../admin/config.php';
     $con5_a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
     mysql_select_db($db);
if($task=="remove"){	
//echo$course.$student;

$quegtcosdata="select * from registration where student='$student' and course='$course'";
//$qugtcosdata=mysql_query($quegtcosdata);
if(mysql_num_rows($qugtcosdata)==1){
while($qgtcosdata=mysql_fetch_array($qugtcosdata)){
	$id=$qgtcosdata['id'];

	$student=$qgtcosdata['student'];
	$course=$qgtcosdata['course'];
	$acedemic_year=$qgtcosdata['acedemic_year'];
	$semister=$qgtcosdata['semister'];							
	$degree=$qgtcosdata['degree'];
	$confirm=$qgtcosdata['confirm'];
							}


	$queinsrereg="insert into remove_reg(student,course,academic_year,semester,degree,status) values('$student','$course','$acedemic_year',$semister,$degree,$confirm)";
	//echo$id.$queinsrereg;
	//mysql_query($queinsrereg);


	$quedelreg="delete from registration where id='$id'";
	//echo$quedelreg;
	//mysql_query($quedelreg);
	
	echo"<font color=red>Removed!</font>";

							}
else{
	echo"Error";
	}
					}








else{
$query2="select confirm from registration where student='$student' and course='$course'";
//$prev=mysql_query($query2);
while($predata=mysql_fetch_array($prev)){
$predata['confirm'];

if(($predata['confirm'])==1){
$query3="update registration set confirm=0 where student='$student' and course='$course'";
//$prev3=mysql_query($query3);



	echo "<div id=".$course."-".$student.">";
	echo "<img id=".$course."img".$student." src=../images/conf31.png onClick=change('$course','$student')>";
	echo"<br><font color=red><b>0</b></font>";
	echo '<div>';

	


	

}

elseif(($predata['confirm'])==0){
$query3="update registration set confirm=1 where student='$student' and course='$course'";
//$prev3=mysql_query($query3);

echo "<div id=".$course."-".$student.">";
	echo "<img id=".$course."img".$student." src=../images/ntcnf.png onClick=change('$course','$student')>";
echo"<br><font color=green><b>1</b></font>";


	echo '<div>';
}
}
//.................edit by Iranga...............
//.................the queries of inserting new course unit to registration table................
if($addnew=='yes')
{

$que_year="select acedemic_year from acc_year where current='1'";
//$Acc_Year=mysql_query($que_year);
$data_year=mysql_fetch_array($Acc_Year);
$dy=$data_year['acedemic_year'];

$que_semi="select semister from call_registration where acedemic_year='$dy'";
//$semister=mysql_query($que_semi);
$data_semi=mysql_fetch_array($semister);
$se=$data_semi['semister'];


$add="insert into registration (student,course,acedemic_year,semister,degree,confirm) values('$student','$course','$dy','$se','$degree','1')"; 
//$qq=mysql_query($add);

echo "<font color=brown><b>Added ok!</b></font>";
}
//...................................................................



/*
$query4="select confirm from registration where student='$student' and course='$course'";
$prev4=mysql_query($query4);
while($predata4=mysql_fetch_array($prev4)){
echo "<font color=brown><b>&nbsp;&nbsp;".$predata4['confirm']."</b></font> ";
}
*/
//sleep(1);

	//}

?>
