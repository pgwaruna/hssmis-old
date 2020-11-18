<script type="text/javascript" src="confirmation.js"></script>


<?php

	$course=$_GET['course'];
	$student=$_GET['student'];
	$addnew=$_GET['addnew'];
	$degree=$_GET['core'];
	if($degree==1){
		$degree="Degree";
	}
	else{
		$degree="Non Degree";
	}
	
	$task=$_GET['task'];


     include '../admin/config.php';
     $con5_a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
     mysql_select_db($db);
if($task=="remove"){	
//echo$course.$student;

$quegtcosdata="select * from registration where student='$student' and course='$course'";
$qugtcosdata=mysql_query($quegtcosdata);
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
	mysql_query($queinsrereg);




                        ////////////////////////////remove result//////////////////////
                            $quermrslt="delete from results where index_number='$student' and subject='$course'";
                            //echo$quermrslt;
                            mysql_query($quermrslt);
                        ///////////////////////////////////////////////////////////////


                        ///////////////////////////remove exam registration//////////////////////
                           $quereexmreg="delete from exam_registration where student='$student' and course='$course'";
                            //echo$quereexmreg;
                           mysql_query($quereexmreg);
                        ///////////////////////////////////////////////////////////////////////// 



	$quedelreg="delete from registration where id='$id'";
	//echo$quedelreg;
	mysql_query($quedelreg);
	
	echo"<font color=red>Removed!</font>";

							}
else{
	echo"Error";
	}
					}








else{
$query2="select confirm from registration where student='$student' and course='$course'";
$prev=mysql_query($query2);
while($predata=mysql_fetch_array($prev)){
$predata['confirm'];

if(($predata['confirm'])==1){
$query3="update registration set confirm=0 where student='$student' and course='$course'";
$prev3=mysql_query($query3);



	echo "<div id=".$course."-".$student.">";
	echo "<img id=".$course."img".$student." src=../images/conf31.png onClick=change('$course','$student')>";
	echo"<br><font color=red><b>0</b></font>";
	echo '<div>';

	


	

}

elseif(($predata['confirm'])==0){
$query3="update registration set confirm=1 where student='$student' and course='$course'";
$prev3=mysql_query($query3);

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
$Acc_Year=mysql_query($que_year);
$data_year=mysql_fetch_array($Acc_Year);
$dy=$data_year['acedemic_year'];
/*
$que_semi="select semister from call_registration where acedemic_year='$dy'";
$semister=mysql_query($que_semi);
$data_semi=mysql_fetch_array($semister);
$se=$data_semi['semister'];*/
///////////////////////////////////////////////////////////////////////
$quegetsem="select semister from courseunit where code='$course'";
$qugetsem=mysql_query($quegetsem);
$qgetsem=mysql_fetch_array($qugetsem);
$se=$qgetsem['semister'];


//////////////////////////////////////////////////////////////////////

$add="insert into registration (student,course,acedemic_year,semister,degree,confirm) values('$student','$course','$dy','$se','$degree','1')"; 
$qq=mysql_query($add);

echo "<font color=brown><b>Added !</b></font>";
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

	}

?>
