<?php
//error_reporting(0);
session_start();

include '../connection/connection.php';	


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
if($qpers['id']=="64"){
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
$sttream=$_POST['blkStrm'];
$strgyr=$_POST['blkregyear'];

$alcode = array();
$alstcode = array();
$alscdst= array();
echo"<a href='../index.php?view=admin&admin=64'><img border='0' src='../images/small/back.png' align='left'><br>Go Back</a><br><br>";

echo"Registration details of ".strtoupper($sttream).". Science Student( Registration Year at $strgyr ).&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DE=Degree &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ND=Non Degree<br>";




if($sttream=="all"){
$quegetredsucode="select distinct(r.course) from registration r, student s where s.year='$strgyr' and s.id=r.student order by course";
}
else{
$quegetredsucode="select distinct(r.course) from registration r, student s where s.year='$strgyr' and  stream='$sttream' and s.id=r.student order by course";
}
//echo$quegetredsucode;

$qugetredsucode=mysql_query($quegetredsucode);


if(mysql_num_rows($qugetredsucode)==0){

echo"<br><font color=red>Sorry! Cannot find informations</font>";

}
else{
echo"<br><table border=1><th>#<th>Student No<th>medium";
$bainx=0;
while($qgetredsucode=mysql_fetch_array($qugetredsucode)){
	$getredsucode=$qgetredsucode['course'];
////////////////////////////////////////////////////////////////////////////////////////
			$coursegetchr=trim($getredsucode);

			$alcode[$bainx]=$coursegetchr;


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
										$blkfulcode=strtoupper($fistprt)."b".$sectprt;
														}
								else{
								$blkfulcode=strtoupper($allcose2);
								}
							////////////////////////////////////////////////////


	echo"<th>$blkfulcode</th>";
$bainx++;
}
if($sttream=="all"){
$quegetblkst="select id,batch,medium from student where year='$strgyr' order by id";
}
else{
$quegetblkst="select id,batch,medium from student where year='$strgyr' and stream='$sttream' order by id ";
}

$qugetblkst=mysql_query($quegetblkst);
$blkr=1;

while($qgetblkst=mysql_fetch_array($qugetblkst)){
	$blkstid=$qgetblkst['id'];
	$blkstbt=$qgetblkst['batch'];
	$blkstmd=$qgetblkst['medium'];

	echo"<tr align=center><td>$blkr</td><td>SC/$blkstbt/$blkstid</td><td>$blkstmd</td>";


		for($i=0;$i<$bainx;$i++){
			
				$chkcos=trim($alcode[$i]);
				echo"<td>";
				$quechkreg="select distinct(degree) from  registration where student='$blkstid' and course='$chkcos' and confirm=1 order by acedemic_year";
				//echo$quechkreg;
				$quchkreg=mysql_query($quechkreg);
				 if(mysql_num_rows($quchkreg)==0){
						echo"&nbsp;";
									}
				else{
					while($qchkreg=mysql_fetch_array($quchkreg)){
						$ckdgst=$qchkreg['degree'];

						if($ckdgst=='1'){
							echo"DE";
								}
						else{
							echo"ND";
							}

											}
			
					}
				echo"</td>";
			
		

			}




echo"</tr>";

$blkr++;

}




echo"</table>";
}


?>








<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}

?>
