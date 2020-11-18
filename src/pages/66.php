<?php
//error_reporting(0);
session_start();
if(($_SESSION['login'])=="truefohssmis"){
include'../connection/connection.php';

$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
//echo $querole;
$qurole=mysql_query($querole) ;

if($qurole!=NULL)
{
while($qrole=mysql_fetch_array($qurole)){
$roleid=$qrole['role_id'];
}
//echo$qpers['id'];
$quepers="SELECT id FROM permission WHERE role_id =$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
if($qpers['id']=="66"){
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


echo"Hostel Information";
echo"<hr class=bar>";


if($role=="student"){

echo"<h3>*** Your Hostel Information ***</h3>";
$fulstno=$_SESSION['ru_st_user_id'];

$quegethostinf="select  h.* from $rmsdb.fohssmis_hostel h ,$rmsdb. fohssmisStudents fs where fs.user_name='$fulstno' and fs.SSID=h.SSID order by AcademicYear";
//echo$quegethostinf;
$qugethostinf=mysql_query($quegethostinf);

if(mysql_num_rows($qugethostinf)==0){
echo"<font color=red>Sorry ! Can not find informations </font>";
}
else{
echo"<table> ";
echo"<th>#<th>Registered Academic Year<th>Used Level<th>Name of Hostel<th>Room Number<th>Selection Method<th>Charges Paid<th>Bill No<th>Hostel Facility Used";
$hr=1;
while($qgethostinf=mysql_fetch_array($qugethostinf)){
	
	$AcademicYear=$qgethostinf['AcademicYear'];
	$NameOfHostel=$qgethostinf['NameOfHostel'];
	$SelectedMethod=$qgethostinf['SelectedMethod'];
	$ChargesPaid=$qgethostinf['ChargesPaid'];
	$BillNO=$qgethostinf['BillNO'];
	$HostelFacilityUsed=$qgethostinf['HostelFacilityUsed'];
	$Level=$qgethostinf['Level'];
	$RoomNumber=$qgethostinf['RoomNumber'];

echo"<tr class=trbgc align=center height=30px><td>$hr<td>$AcademicYear<td>$Level<td>$NameOfHostel<td>$RoomNumber<td>$SelectedMethod<td>$ChargesPaid<td>$BillNO<td>$HostelFacilityUsed";

$hr++;
}



echo"</table>";
}

}

//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////


else{
echo"<h3>*** Search Hostel Information of Students***</h3>";


$quebtyear="select * from acc_year where current='1'";
$qubtyear=mysql_query($quebtyear);
while($qbtyear=mysql_fetch_array($qubtyear)){
$btyear=$qbtyear['acedemic_year'];
$btyr=explode("_",$btyear);

$nxyr=$btyr[1];
$cryr=$btyr[0];
$olyr1=$cryr-1;
$olyr2=$cryr-2;
$olyr3=$cryr-3;
$olyr4=$cryr-4;
$olyr5=$cryr-5;
}
?>
<div align="center">
<table border="0" cellspacing="1" class="bgc">
	<tr>
		<td>
<form method="POST" action="./index.php?view=admin&admin=66&task=shwhsinf">
	<font size="2" color="#FF0000">&nbsp;&nbsp; </font>
	<font color="#800000">&nbsp;Index Number :</font>&nbsp;
	<font color="#800000">SC/</font>

<?php
echo'<select size="1" name="hsstyr">';
echo"<option value='$olyr5'>$olyr5</option>";
echo"<option value='$olyr4'>$olyr4</option>";
echo"<option value='$olyr3'>$olyr3</option>";
echo"<option value='$olyr2'>$olyr2</option>";
echo"<option value='$olyr1'>$olyr1</option>";
echo"<option value='$cryr'>$cryr</option>";
echo"<option value='$nxyr'>$nxyr</option>";


echo'</select>';
?>

<font color="#800000">/</font>
	<span id="number1">
	<input type="text" name="hsstnmb" size="4">&nbsp;
	<span class="textfieldRequiredMsg"><font size="-1"> Enter a index Number</font></span>
	<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>
	</span>
	<input type="submit" value="Submit" name="submit"> <br>
	<font color="#FF0000"><center>
	(<span style="font-size: 10pt"> Ex: SC/2003/5291) </center></span></font></form></td>
	</tr>
</table>


</div><br>


<?php

//////////////////////////////////////ont st////////////////////////////////////////
if($task=="shwhsinf"){
$hsstyr=$_POST['hsstyr'];
$hsstnmb=$_POST['hsstnmb'];

//echo$hsstyr.$hsstnmb;

$gtstbt=$n->getBatch($hsstnmb);

    if($gtstbt!=$hsstyr){
        
        echo"<font color='red'>Sorry! SC/$hsstyr/$hsstnmb is Invalid Student Number, Please recheck number. </font><br>";
        
    }
    else{
        $hsstnm=$n->getName($hsstnmb);
        echo"<font size=3px><b>Hostel Information of ".strtoupper($hsstnm)." ( SC/$hsstyr/$hsstnmb )</b></font><br>";
        
        
        $quegethostinf="select  h.* from $rmsdb.fohssmis_hostel h ,$rmsdb. fohssmisStudents fs where fs.user_name='sc$hsstnmb' and fs.SSID=h.SSID order by AcademicYear";
            //echo$quegethostinf;
            $qugethostinf=mysql_query($quegethostinf);
            
            if(mysql_num_rows($qugethostinf)==0){
            echo"<br><font color=red>Sorry ! Can not find informations </font><br><br>";
            }
            else{
            echo"<table> ";
            echo"<th>#<th>Registered Academic Year<th>Used Level<th>Name of Hostel<th>Room Number<th>Selection Method<th>Charges Paid<th>Bill No<th>Hostel Facility Used";
            $hr=1;
            while($qgethostinf=mysql_fetch_array($qugethostinf)){
                
                $AcademicYear=$qgethostinf['AcademicYear'];
                $NameOfHostel=$qgethostinf['NameOfHostel'];
                $SelectedMethod=$qgethostinf['SelectedMethod'];
                $ChargesPaid=$qgethostinf['ChargesPaid'];
                $BillNO=$qgethostinf['BillNO'];
                $HostelFacilityUsed=$qgethostinf['HostelFacilityUsed'];
                $Level=$qgethostinf['Level'];
                $RoomNumber=$qgethostinf['RoomNumber'];
            
            echo"<tr class=trbgc align=center height=30px><td>$hr<td>$AcademicYear<td>$Level<td>$NameOfHostel<td>$RoomNumber<td>$SelectedMethod<td>$ChargesPaid<td>$BillNO<td>$HostelFacilityUsed";
            
            $hr++;
            }
            
            
            
            echo"</table>";
            }
        
        
        
        
    }


}
////////////////////////end one st///////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// gp st /////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
echo"<h3>*** Search  Group of Students Hostel Information ***</h3>";

echo"<form method=post action='./index.php?view=admin&admin=66&task=shwgphsinf'>";

echo"<table class=bgc><tr><td>";
echo"Select Stream : ";

echo"<select name=hsstem>";
    echo"<option value='all'>ALL Student</option>";
    echo"<option value='phy'>Phy. Student</option>";
    echo"<option value='bio'>Bio. Student</option>";
    echo"<option value='bcs'>BCS. Student</option>";
echo"</select>";

echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Select Student's Current Level : ";

echo"<select name=hsstlvl>";
    echo"<option value='all'>ALL Levels</option>";
    echo"<option value='1'>Level 1</option>";
    echo"<option value='2'>Level 2</option>";
    echo"<option value='3'>Level 3</option>";
    //echo"<option value='0'>Pass out</option>";
echo"</select>";
echo"<tr><td align=center><input type=submit value='Search Information'>";

echo"</table>";
echo"</form>";

//////////////////////////////////////////////////////////
//////////////////////task shwgphsinf/////////////////////
//////////////////////////////////////////////////////////
    if($task=="shwgphsinf"){
        $hsstrm=$_POST['hsstem'];
                if($hsstrm=="phy"){
                    $hsstrm2="Physical Science";
                }
                elseif($hsstrm=="bio"){
                    $hsstrm2="Biological Science";
                }
                elseif($hsstrm=="bcs"){
                    $hsstrm2="Computer Science";
                }
                else{
                    $hsstrm2=$hsstrm;
                }
                
        
        
        $hslvl=$_POST['hsstlvl'];

           // echo$hsstrm.$hslvl;
           
           $fmviweque="$rmsdb.fohssmisStudents fs";  
           $hsviw="$rmsdb.fohssmis_hostel ho";
           
           if(($hsstrm=="all")&&($hslvl=="all")){
                     echo"<font size=3px color=blue> Information of All Students</font><br>";
                   
                   $quegtallhsinf="select s.id, s.l_name, s.batch, s.initials, s.stream, ho.* from student s, $fmviweque, $hsviw,level l where  concat('sc',s.id)=fs.user_name and fs.SSID=ho.SSID and l.level<>'0' and l.year=s.year order by s.id";
                    // echo$quegtallhsinf;
                    //$quegtallhsinf="select s.id, s.l_name, s.batch, s.initials, s.stream, l.level from student s, level l, $fmviweque where l.level='$level_8_2' and l.year=s.year and s.stream='$stream_8_2' and concat('sc',s.id)=fs.user_name"
                   
           }
           else{
               if($hsstrm=="all"){
                   echo"<font size=3px color=blue> Information of  All Level $hslvl Students</font><br>";
                   $quegtallhsinf="select s.id, s.l_name, s.batch, s.initials, s.stream, ho.* from student s, $fmviweque, $hsviw ,level l where  concat('sc',s.id)=fs.user_name and fs.SSID=ho.SSID  and l.level='$hslvl' and l.year=s.year order by s.id";
                              }
               elseif($hslvl=="all"){
                   echo"<font size=3px color=blue> Information of All $hsstrm2 Students</font><br>";
                   $quegtallhsinf="select s.id, s.l_name, s.batch, s.initials, s.stream, ho.* from student s, $fmviweque, $hsviw ,level l where  concat('sc',s.id)=fs.user_name and fs.SSID=ho.SSID and s.stream='$hsstrm' and l.level<>'0' and l.year=s.year order by s.id";
                               }
               else{
                   echo"<font size=3px color=blue> Information of $hsstrm2  Level $hslvl Students</font><br>";               
                $quegtallhsinf="select s.id, s.l_name, s.batch, s.initials, s.stream, ho.* from student s, $fmviweque, $hsviw ,level l where  concat('sc',s.id)=fs.user_name and fs.SSID=ho.SSID and s.stream='$hsstrm' and l.level='$hslvl' and l.year=s.year order by s.id";
                //echo$quegtallhsinf;
               }
               
               
           }
                   
                   
                   
                   $qugtallhsinf=mysql_query($quegtallhsinf);
                   if(mysql_num_rows($qugtallhsinf)==0){
                       echo"<font color=red>Sorry! Can not find informations</font>";
                                    }
                   else{
                       $alhscn=1;
                       echo"<table><th>#<th>Student Number<th>Name with Initials<th>Stream<th>Registered Ac. Year<th width=14%>Hostel<th>Room<th>Apply Method<th>Used Level<th>Paid<th>Bill No<th>Used";
                       while($qgtallhsinf=mysql_fetch_array($qugtallhsinf)){
                                   $id=$qgtallhsinf['id'];                            
                                   $l_name=$qgtallhsinf['l_name'];                       
                                   $batch=$qgtallhsinf['batch'];                  
                                   $initials=$qgtallhsinf['initials'];             
                                   $stream=$qgtallhsinf['stream'];         
                                   $AcademicYear=$qgtallhsinf['AcademicYear'];    
                                   $NameOfHostel=$qgtallhsinf['NameOfHostel'];   
                                   $RoomNumber=$qgtallhsinf['RoomNumber'];
                                   $ChargesPaid=$qgtallhsinf['ChargesPaid'];
                                   $BillNO=$qgtallhsinf['BillNO'];
                                   $Level=$qgtallhsinf['Level'];
                                   $HostelFacilityUsed=$qgtallhsinf['HostelFacilityUsed'];
                                   $SelectedMethod=$qgtallhsinf['SelectedMethod'];
                                   
                                   
                               echo"<tr class=trbgc align=center height=30px><td>$alhscn<td>SC/$batch/$id";
                                    echo"<td align=left>".strtoupper($l_name)." ".strtoupper($initials);
                                    echo"<td>".strtoupper($stream);
                                    echo"<td>$AcademicYear<td>$NameOfHostel<td>$RoomNumber<td>".strtoupper($SelectedMethod)."<td>$Level<td>".strtoupper($ChargesPaid)."<td>$BillNO<td>".strtoupper($HostelFacilityUsed);
                                
                                   
                          $alhscn++;         
                       }
                       
                       echo"</table>";
                       
                   }
               
               
               
               
               
               
               
               
           










                            }
//////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
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
