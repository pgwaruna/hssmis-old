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
    $sttream=$_POST['blkStrmSp'];
    if($sttream=="bot"){
        $stream="(botany_sp)";
        $stname="botany";
    }else if($sttream=="che"){
        $stream="(chemistry_sp)";
        $stname="chemistry";
    }
    else if($sttream=="com"){
        $stream="(computer_science_sp)";
        $stname="computer science";
    }
    else if($sttream=="mat"){
        $stream="(mathematics_sp)";
        $stname="mathematics";
    }
    else if($sttream=="phy"){
        $stream="(physics_sp)";
        $stname="physics";
    }
    else if($sttream=="zoo"){
        $stream="(zoology_sp)";
        $stname="zoology";
    }
    else{
        echo "Requesting Error";
        $stream=null;
        $stname=null;
    }
    if($stream != null) {
        $strgyr=$_POST['blkregyear'];

        $alcode = array();
        $alstcode = array();
        $alscdst= array();
        echo"<a href='../index.php?view=admin&admin=64'><img border='0' src='../images/small/back.png' align='left'><br>Go Back</a><br><br>";

        echo"Registration details of ".strtoupper($stname)." Special Student( Registration Year at $strgyr ).&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DE=Degree &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ND=Non Degree<br>";
        $quegetredsucode="select distinct(r.course) from registration r, student s where s.year='$strgyr' and  stream like '%$stream%' and s.id=r.student order by course";
        $qugetredsucode=mysql_query($quegetredsucode);

        if(mysql_num_rows($qugetredsucode)==0){
            echo"<br><font color=red>Sorry! Cannot find informations</font>";
        }
        else{
            echo"<br><table border=1><th>#<th>Student No";
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
            $quegetblkst="select id,batch from student where year='$strgyr' and stream like '%$stream%' order by id ";
            /////
            $qugetblkst=mysql_query($quegetblkst);
            $blkr=1;

            while($qgetblkst=mysql_fetch_array($qugetblkst)){
                $blkstid=$qgetblkst['id'];
                $blkstbt=$qgetblkst['batch'];
                echo"<tr align=center><td>$blkr<td>SC/$blkstbt/$blkstid</td>";
                for($i=0;$i<$bainx;$i++)
                {
                    $chkcos=trim($alcode[$i]);
                    echo"<td>";
                    $quechkreg="select degree from  registration where student='$blkstid' and course='$chkcos' and confirm=1 order by acedemic_year";
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
                $blkr++;
            }
        echo"</table>";
        }
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