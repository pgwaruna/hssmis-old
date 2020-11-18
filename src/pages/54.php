<?php
//error_reporting(0);
session_start();
if(($_SESSION['login'])=="truefohssmis"){

$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
//echo $querole;
$qurole=mysql_query($querole);

if($qurole!=NULL)
{
while($qrole=mysql_fetch_array($qurole)){
$roleid=$qrole['role_id'];
}

$quepers="SELECT id FROM permission WHERE role_id =$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
if($qpers['id']=="54"){
$pem="TRUE";

}
}
}
else
{
echo "You Have Not Permission To Access This Area!";
}

if($pem=="TRUE")
{
?>



<?php

require_once('./classes/globalClass.php');
$n=new settings();

$yelast=$n->getAcc();

$getyr=explode("_",$yelast);
$yrpast=$getyr[0];
$yelast=$yrpast-6;

echo"Change Degree Status of Courses Registered by Student";
echo"<hr class=bar>";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<form method=POST action='./index.php?view=admin&admin=54&task=modfycosdegrst'>";
echo"Enter Student Number:&nbsp;&nbsp;";
echo"SC/<select name=byear>";
for($i=1;$i<=7;$i++){
$k=$yelast+$i;
echo"<option value=$k>$k</option>";
}
echo"</select>/";

echo'<span id="number2">';
	echo'<input name="chngstno" size="6">&nbsp;';
	echo'<span class="textfieldRequiredMsg"><font size="-1"> Enter a Index Number</font></span>';
	echo'<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>';
	echo'</span>';

echo"<input type=submit value='Submit'><br><font color=red>( Eg:- SC/2003/5291 )</font></form>";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($task=="modfycosdegrst"){
$due=$_GET['due'];
$chngstno2=$_POST['chngstno'];
$chngstbatch2=$_POST['byear'];

if($chngstno2!=null){
	$_SESSION['chngstno2']=$chngstno2;
	$_SESSION['chngstbatch2']=$chngstbatch2;
			}


$chngstno=$_SESSION['chngstno2'];
$chngstbatch=$_SESSION['chngstbatch2'];



$chstrealbt=$n-> getBatch($chngstno);
$chstnm=$n->getName($chngstno);



	if($due=="changedg"){
		
		$rcosid=$_POST['rcosid'];
		$rcosut=$_POST['rcosut'];
		$dgstat=$_POST['dgstat'];
		$cnfstat=$_POST['cnfstat'];

			$queupdgstat="update registration set degree='$dgstat',confirm='$cnfstat' where id='$rcosid'";
			//echo$queupdgstat;
			mysql_query($queupdgstat);


		echo"<font color='red'>Course Unit ($rcosut) Successfully Updated !</font>";


				}


	if($chstrealbt==$chngstbatch){
	//echo$chngstbatch.$chngstno;
	echo"<h3>All Optinal Course Unit Details of SC/$chngstbatch/$chngstno ( $chstnm )</h3>";
		$quegtopcos="select r.id, r.course, r.acedemic_year, r.semister, r.degree,r.confirm, c.name from registration r, courseunit c where r.student='$chngstno' and c.core='op' and r.course=c.code order by r.id desc  ";
		//echo$quegtopcos;
		$qugtopcos=mysql_query($quegtopcos);
		if(mysql_num_rows($qugtopcos)!=0){
			echo"<table border=0 ><tr><th>Course Unit<th>Course Name<th>Registered Academic Year<th>Registered Semester<th>Current Degree Status<th>Current Confirmation Status<th>Submit</tr>";


			while($qgtopcos=mysql_fetch_array($qugtopcos)){
				$rid=$qgtopcos['id'];
				$rcos=$qgtopcos['course'];
                ////////////////////////////////////////////////////////////////////////////////////////
                                $coursegetchr=trim($rcos);
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

                                $temdiscos2=$ccdwoutcrd.$credit;
                            ////////////////////////////////////////////////////////////////////////////////////////
                                ////////////////////////////////////////////////////////
                                $getchar = preg_split('//', $temdiscos2, -1);

                                $midcredit=$getchar[5];
                                if($midcredit=="b"){
                                    $getlob=explode('b',$temdiscos2);
                                        $fistprt=$getlob[0];
                                        $sectprt=$getlob[1];
                                        $fulcode=strtoupper($fistprt)."b".$sectprt;
                                                        }

                                elseif($midcredit=="B"){
                                    $getlob=explode('B',$temdiscos2);
                                        $fistprt=$getlob[0];
                                        $sectprt=$getlob[1];
                                        $fulcode=strtoupper($fistprt)."b".$sectprt;
                                                        }
                                else{
                                $fulcode=strtoupper($temdiscos2);
                                }
                                ////////////////////////////////////////////////////
                
                
				$cosnm=$qgtopcos['name'];
				$racyear=$qgtopcos['acedemic_year'];
				$rseme=$qgtopcos['semister'];
				$rdegre=$qgtopcos['degree'];
				$rcnfm=$qgtopcos['confirm'];
		
				//echo$rid.$rcos.$cosnm.$racyear.$rseme.$rdegre.$rcnfm."<br>";

				echo"<form method=POST action='./index.php?view=admin&admin=54&task=modfycosdegrst&due=changedg'><tr class=trbgc>";
				echo"<td align='center'>".$fulcode."<input type=hidden name=rcosid value='$rid'><input type=hidden name=rcosut value='$rcos'>";
				echo"<td>&nbsp; $cosnm<td align='center'>$racyear";
				echo"<td align='center'>";
					if($rseme==1){
						$rseme2="Semester 1";
							}
					elseif($rseme==2){
						$rseme2="Semester 2";
							}
					else{
						$rseme2="Both Semester";
						}
				echo"$rseme2<td align='center'>";
					echo"<select name=dgstat>";
					if($rdegre==1){
						echo"<option value=1 selected>Degree</option>";
						echo"<option value=2>Non Degree</option>";
							}
					else{
						echo"<option value=1>Degree</option>";
						echo"<option value=2 selected>Non Degree</option>";
						}
					echo"</select>";
				echo"<td align='center'>";
					echo"<select name=cnfstat>";
					if($rcnfm==1){
						echo"<option value=1 selected>Confirm</option>";
						echo"<option value=0>Not Confirm</option>";
							}
					else{
						echo"<option value=1>Confirm</option>";
						echo"<option value=0 selected>Not Confirm</option>";
						}
					echo"</select>";


				echo"<td><input type=submit value=Submit></tr></form>";
									}//while close
			echo"</table>";
							}//num of rows is notnull if close
		else{
			echo"<font color='red'>Sorry ! Can not find any registered optional course.</font><br>";
			}





					}
	else{
	echo"<font color='red'> SC/$chngstbatch2/$chngstno2 is Invalid Student Number.</font><br>";
		}


				}//task modfycosdegrst if close




?>








<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>






