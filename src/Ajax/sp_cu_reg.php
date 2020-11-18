<?php
session_start();
?>

<script type="text/javascript" src="./Ajax/sp_cu_reg.js"></script>


<?php
$task=$_GET['task'];
$studet=$_GET['stno'];
$spcu=$_GET['spcourse'];
//$spacyr=$_GET['acyear'];
$dgrst=$_GET['spdgst'];
$spcuid=$_GET['spcuregid'];


             $spacyr=$_SESSION['sp_ac_year'];   
             $spseme=$_SESSION['sp_semester'];

include'../connection/connection.php';
    $quegetcusem="select semister from courseunit where code='$spcu'";
    $qugetcusem=mysql_query($quegetcusem);
    $qgetcusem=mysql_fetch_array($qugetcusem);
    $getcusem=$qgetcusem['semister'];



//////////////////////////////////////////////////////////////////////////////
//////////////////////// course registration /////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
if($task=="regis"){

$queregspregis="insert into registration(student,course,acedemic_year,semister,degree,confirm) values('$studet','$spcu','$spacyr',$getcusem,$dgrst,1)";
$quregspregis=mysql_query($queregspregis);

if($quregspregis){
    $quegetspid="select * from registration where student='$studet' and course='$spcu' and acedemic_year='$spacyr'";
    $qugetspid=mysql_query($quegetspid);
    if(mysql_num_rows($qugetspid)!=0){
    while($qgetspid=mysql_fetch_array($qugetspid)){
            $getspid=$qgetspid['id'];   
            $confirm=$qgetspid['confirm'];
                    if($confirm==1){
                        $confirm2="- Confirmed";
                    }
                    else{
                         $confirm2="- Not Confirmed";
                    }
        
    }
    }
    
 echo"<div align='center' id='did$spcu'>";
                echo"<table border=0 width=100% class=logbox><tr><td width=55% align=center>";
                      echo"<font color=blue>Register ".$confirm2."</font>";
                echo"<td>";
                      echo "<img style='visibility: hidden' id='ldr$spcu' src='./images/ajax-loader.gif'>";
             
                      echo"<input type=\"button\" value=\"Cancel\"  onclick=\"spregcnl('$getspid','$studet','$spcu','$spacyr')\"></tr>";   
                echo"</table>";
             echo"</div>";

}

}
//////////////////////////////////////////////////////////////////////////////
//////////////////// end course registration /////////////////////////////////
//////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////////////////
//////////////////////// course registration cancel //////////////////////////
//////////////////////////////////////////////////////////////////////////////
if($task=="cncl"){

$quedelspreg="delete from registration where id=$spcuid";
$qudelspreg=mysql_query($quedelspreg);
if($qudelspreg){
 echo"<div align='center' id='did$spcu'>";
                echo"<table border=0 width=100% class=bgc><tr><td width=55% align=center>";
                      echo"<font color=red>Not Register</font>";
                echo"<td>";
                      echo "<img style='visibility: hidden' id='ldr$spcu' src='./images/ajax-loader.gif'>";
             
                      echo"<input type=\"button\" value=\"Register\"  onclick=\"spregister('$studet','$spcu','$spacyr')\"></tr>";   
                echo"</table>";
             echo"</div>";
}

}
//////////////////////////////////////////////////////////////////////////////
//////////////////// end course registration cancel //////////////////////////
//////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////////////
//////////////////////// course registration counter//////////////////////////
//////////////////////////////////////////////////////////////////////////////
if($task=="cdtcunt"){
$quegetcdcunt="select sum(c.credits)from registration r, courseunit c where r.acedemic_year='$spacyr' and (r.semister=$spseme or r.semister='3') and r.course=c.code and r.student='$studet' and r.degree='1' and r.confirm=1";
$qugetcdcunt=mysql_query($quegetcdcunt);
$qgetcdcunt=mysql_fetch_array($qugetcdcunt);
    $getcdcunt=$qgetcdcunt['sum(c.credits)'];

if($getcdcunt==null){
    echo"0";
}
else{
    echo$getcdcunt;
}

}
//////////////////////////////////////////////////////////////////////////////
////////////////////////end course registration counter //////////////////////
//////////////////////////////////////////////////////////////////////////////
if($task=="allcdtcunt"){
$tot_c="select sum(c.credits) from registration r, courseunit c where student='$studet' and r.course=c.code and r.degree='1' and r.confirm='1'";
$tot=mysql_query($tot_c);
while($t=mysql_fetch_array($tot)){
    $alcrd=$t['sum(c.credits)'];
}

if($alcrd==null){
    echo"0";
}
else{
    echo$alcrd;
}

}
//////////////////////////////////////////////////////////////////////////////
////////////////////////all course registration counter///////////////////////
//////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////
//////////////////// end all course registration counter//////////////////////
//////////////////////////////////////////////////////////////////////////////



?>
