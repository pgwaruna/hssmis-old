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
if($qpers['id']=="61"){
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

<script type="text/javascript">
  function checkfirstnsecind(){
    if (specialapply.firstcho.value=="no_subject"){
    alert("Please Select Your First Choice !");
    specialapply.firstcho.focus();
    return false;}
    
      
    if (specialapply.firstcho.value==specialapply.secndchoi.value){
    alert("Please Change Your Subject for Second Choice !");
    specialapply.secndchoi.focus();
    return false;}
       
   if((specialapply.secndchoi.value!="no_subject")||(specialapply.terddchoi.value!="no_subject")){
   
           if (specialapply.secndchoi.value==specialapply.terddchoi.value){
            alert("Please Change Your Subject for Third Choice !");
            specialapply.terddchoi.focus();
            return false;}
               
          
           
           if (specialapply.firstcho.value==specialapply.terddchoi.value){
            alert("Please Change Your Subject for Third Choice !");
            specialapply.terddchoi.focus();
            return false;}
            }
       
   } 
   
   
   
   
    
    
</script>





<?php
require_once('./classes/globalClass.php');
$n=new settings();
$spstno=$_SESSION['user_id'];


$stlevel=$n->getLevel($spstno);
$stbt=$n->getBatch($spstno);

$stname=$n->getName($spstno);


$quegtnm="select l_name, initials from users where  user='$spstno'";
$qugtnm=mysql_query($quegtnm);
while($qgtnm=mysql_fetch_array($qugtnm)){
        $lname=$qgtnm['l_name'];
        $initials=$qgtnm['initials'];
                                        }

$crr_acyear2=$n->getAcc(); 

$quesel="select acc_year from call_special_application";
$qusel=mysql_query($quesel);
if(mysql_num_rows($qusel)!=0){
while($qsel=mysql_fetch_array($qusel)){
$crr_acyear=$qsel['acc_year'];
}
}
else{
$crr_acyear=$crr_acyear2;  
}




$fulstno="SC/$stbt/$spstno";

/////////////////////////// current date////////////////////////////////
//error_reporting(0);
$today=date("Y-m-d");
////////////////////////////////////////////////////////////////////////





/////////////////////get cmb///////////////////////////
$quegtcmb="select c.department, c.subject,s.combination, s.stream from combination c, student s where s.combination=c.id and s.id='$spstno'";

$qugtcmb=mysql_query($quegtcmb);
if(mysql_num_rows($qugtcmb)!=0){
  $deptar=array();
  $cmbsubar=array();
    $i=0;
    while($qgtcmb=mysql_fetch_array($qugtcmb)){
        $deptar[$i]=$qgtcmb['department'];
        $cmbsubar[$i]=strtoupper($qgtcmb['subject']);
        $stcmbid=$qgtcmb['combination'];
        $ststrm=$qgtcmb['stream'];

		$newsrem=substr($ststrm, 0, 3);	

        $i++;
        
    }
    
    
    
}

//////////////////////////////////////////////////////
$specialsub=array();
/*/////////////////////////////special criteria///////////////////////////////////

for($sp=0;$sp<3;$sp++){

if($cmbsubar[$sp]==strtoupper('applied_mathematics')){//////////Mathematics////////////////////////////
        $specialsub[$sp]=strtoupper('mathematics');
}

elseif($cmbsubar[$sp]==strtoupper('mathematics')){//////////physics////////////////////////////
        $specialsub[$sp]=strtoupper('physics');

}


}
////////////////////////////////////////////////////////////////////////////////*/

//////////////////////////
if($ststrm=="phy"){
    $specialsub[0]=strtoupper('mathematics');
    $specialsub[1]=strtoupper('physics');
    $specialsub[2]=strtoupper('chemistry');


}
elseif ($ststrm=="bio") {
    $specialsub[0]=strtoupper('chemistry');
    $specialsub[1]=strtoupper('botany');
    $specialsub[2]=strtoupper('zoology'); 
    $specialsub[3]=strtoupper('physics');
}
else{
    $specialsub[0]=strtoupper('bcs');
}
//////////////////////////




echo"Appling for Bachelor of Science (Special) Degree";
echo"<hr class=bar>";


///////////////////////////////// send sp data to db ///////////////////////////// 
if($task=="sbspapfm"){
  $quinsert="nil";  
    
        $firstcho=$_POST['firstcho'];
        $secndchoi=$_POST['secndchoi'];
        $terddchoi=$_POST['terddchoi'];
        $oth_qul=$_POST['oth_qul'];
        
        $padd1=$_POST['padd1'];
        $padd2=$_POST['padd2'];
        $padd3=$_POST['padd3'];
        $padd4=$_POST['padd4'];
        $dob=$_POST['dob'];
        $nic=$_POST['nic'];
        $land=$_POST['land'];
        $mobil=$_POST['mobil'];
        $email=$_POST['email'];
        $olindex=$_POST['olindex'];
        $olyear=$_POST['olyear'];
        $maths=$_POST['maths'];
        $scie=$_POST['scie'];
        $buddis=$_POST['buddis'];
        $sinha=$_POST['sinha'];
        $engl=$_POST['engl'];
        $sosnh=$_POST['sosnh'];
        $art_sub=$_POST['art_sub'];
        $art_g=$_POST['art'];
        $other_sub1=$_POST['other_sub1'];
        $othr1=$_POST['othr1'];
        $other_sub2=$_POST['other_sub2'];
        $othr2=$_POST['othr2'];
        $other_sub3=$_POST['other_sub3'];
        $othr3=$_POST['othr3'];
        $other_sub4=$_POST['other_sub4'];
        $othr4=$_POST['othr4'];
        $other_sub5=$_POST['other_sub5'];
        $othr5=$_POST['othr5'];
        $alindex=$_POST['alindex'];
        $alyear=$_POST['alyear'];
        $phy=$_POST['phy'];
        $che=$_POST['che'];
        $commat=$_POST['commat'];
        $bio=$_POST['bio'];
        $adsub=$_POST['adsub'];
        $adsubgd=$_POST['adsubgd'];
        $geneng=$_POST['geneng'];
        $zscor=$_POST['zscor'];
        $gentmrks=$_POST['gentmrks'];
    
//echo$firstcho.$secndchoi.$padd1.$padd2.$padd3.$padd4.$dob.$nic.$land.$mobil.$email.$olindex.$olyear.$maths.$scie.$buddis.$sinha.$engl.$sosnh.$art_sub.$art_g.$other_sub1.$othr1.$other_sub2.$othr2.$other_sub3.$othr3.$other_sub4.$othr4.$other_sub5.$othr5.$alindex.$alyear.$phy.$che.$commat.$bio.$adsub.$adsubgd.$geneng.$zscor.$gentmrks;
   
   $quechkinc="select stno from student_personal_detais where nic='$nic'";
   $quchkinc=mysql_query($quechkinc);
    if(mysql_num_rows($quchkinc)==0){
            $quinsert="yes";
                                    }
    else{
         $qchkinc=mysql_fetch_array($quchkinc);
            $chkinc=$qchkinc['stno'];
            if($chkinc==$fulstno){
            $quinsert="yes"; 
            }
            else{
            $quinsert="no";
            }
            
            
    }
        
        
        
        
        if($quinsert=="yes"){
   
   ////////////////////special data ///////////////////////////////////////////////////
        $quechkspreg="select sp_id from special_registration where stno='$spstno'";   
        $quchkspreg=mysql_query($quechkspreg);
        if(mysql_num_rows($quchkspreg)==0){
            ////////////////sp insert//////////////////
            $quespdatainst="insert into special_registration(stno,ac_year,choice_one,choice_two,choice_three,hand_over_date,conf_subject,other_qulipi) values('$spstno','$crr_acyear','$firstcho','$secndchoi','$terddchoi','$today','In Progress','$oth_qul')";
           mysql_query($quespdatainst);
        }
        else{
            ///////////////sp update//////////////////
            $queupspreg="update special_registration set choice_one='$firstcho', choice_two'$secndchoi',choice_three='$terddchoi', hand_over_date='$today', conf_subject='In Progress',other_qulipi='$oth_qul' where stno='$spstno'";
           mysql_query($queupspreg);
        }    
   ////////////////////////////////////////////////////////////////////////////////////
   
            
   
   ///////////////////////////pernal data/////////////////////////////////////////////

   
   
        $quechkpersnal="select nic from student_personal_detais where stno='SC/$stbt/$spstno'";    
        $quchkpersnal=mysql_query($quechkpersnal);
        if(mysql_num_rows($quchkpersnal)==0){
         
            
                    
            //////////////////////insert persona data query///////////////////
            $queinsetpersonal="insert into student_personal_detais(stno,lname,initials,nic,dob,padd1,padd2,padd3,padd4,tel_home,tel_mobile,email,
            olyear,olindexno,mathematics,science,buddhism,soc_s_n_history,sinhala,engilsh,art_sub, art_sub_grd,other_sub1,other_sub1_grd,
            other_sub2,other_sub2_grd,other_sub3,other_sub3_grd,other_sub4,other_sub4_grd,other_sub5,other_sub5_grd,alyear,alindexno,zscore,gtmarks,
            physics,chemistry,com_maths,biology,gen_english,addi_subject,add_sub_grd)
            values('$fulstno','$lname','$initials','$nic','$dob','$padd1','$padd2','$padd3','$padd4','$land','$mobil','$email','$olyear','$olindex',
            '$maths','$scie','$buddis','$sosnh','$sinha','$engl','$art_sub','$art_g','$other_sub1','$othr1','$other_sub2','$othr2','$other_sub3','$othr3',
            '$other_sub4','$othr4','$other_sub5','$othr5','$alyear','$alindex','$zscor','$gentmrks','$phy','$che','$commat','$bio','$geneng','$adsub','$adsubgd')";
            mysql_query($queinsetpersonal);
            // echo"<font color=red>You have successfully registered for the Bachelor of Science (Special) Degree</font>";
            //////////////////////end insert persona data query///////////////
                                            
            
        }
        else{
            ////////////////update query///////////////////////
            
            $queupdtpersinf="update student_personal_detais set nic='$nic' ,dob='$dob' ,padd1='$padd1' ,padd2='$padd2' ,padd3='$padd3' ,padd4='$padd4' ,tel_home='$land' ,tel_mobile='$mobil' ,email='$email' ,
            olyear='$olyear' ,olindexno='$olindex' ,mathematics='$maths' ,science='$scie' ,buddhism='$buddis' ,soc_s_n_history='$sosnh' ,sinhala='$sinha' ,engilsh='$engl' ,art_sub='$art_sub' , art_sub_grd='$art_g' ,other_sub1='$other_sub1' ,other_sub1_grd='$othr1' ,
            other_sub2='$other_sub2' ,other_sub2_grd='$othr2' ,other_sub3='$other_sub3' ,other_sub3_grd='$othr3' ,other_sub4='$other_sub4' ,other_sub4_grd='$othr4' ,other_sub5='$other_sub5' ,other_sub5_grd='$othr5' ,alyear='$alyear' ,alindexno='$alindex' ,zscore='$zscor' ,gtmarks='$gentmrks' ,
            physics='$phy' ,chemistry='$che' ,com_maths='$commat' ,biology='$bio' ,gen_english='$geneng' ,addi_subject='$adsub' ,add_sub_grd='$adsubgd' where stno='SC/$stbt/$spstno'";
            
           // echo$queupdtpersinf;
            mysql_query($queupdtpersinf);
             //echo"<font color=red>You have successfully Apply for the Bachelor of Science (Special) Degree</font>";
                    }
                    
                    
                    
             echo"<font color=red>You have successfully Apply for the Bachelor of Science (Special) Degree.</font>";
                    
                                }
            else{
                echo"<font color=red>Duplicate National Identity Card Number. Please try again!</font>";
            }
    
    //////////////////////////////////////////////////////////////////////////////////////
    
    
    
    
}
////////////////////////////// end send sp data to db///////////////////////////// 

////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////// calling sp APP//////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
if(($stlevel==0)&&($newsrem=="bcs")){
$spreg="on";
}
elseif(($stlevel==3)&&($stcmbid!=13)){
$spreg="on";
}
else{
$spreg="off";
}
////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////// end calling sp APP///////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////





if($spreg=="on"){

   //echo$cmbsubar[0]."-".$cmbsubar[1]."-".$cmbsubar[2]."<br>";
//echo $specialsub[0]."+".$specialsub[1];
    ////////////////////////chk application call status/////////////////////
    $quechkstat="select status,end_data from call_special_application";
    $quchkstat=mysql_query($quechkstat);
    if(mysql_num_rows($quchkstat)!=0){
        while ($qchkstat=mysql_fetch_array($quchkstat)) {
            $status=$qchkstat['status'];
            $enddate=$qchkstat['end_data'];
        }
        
        
    }
    ////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////// calling BCS APP//////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
/*if(($stlevel==0)&&($ststrm=="bcs")){
$status=1;
$enddate="2014-01-21";
}*/
////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////// end calling BCS APP///////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////




    if($status==1){
        
        
        $quecheckspreg="select * from special_registration where stno='$spstno'";
        $qucheckspreg=mysql_query($quecheckspreg);
        if(mysql_num_rows($qucheckspreg)!=0){
            echo"<br>Your Registration Datails of Special Degree <br>";
            
            while($qcheckspreg=mysql_fetch_array($qucheckspreg)){
                    $ac_year=$qcheckspreg['ac_year'];
                    $choice_one=$qcheckspreg['choice_one'];
                    $choice_two=$qcheckspreg['choice_two'];
                    $choice_three=$qcheckspreg['choice_three'];
                    $hand_over_date=$qcheckspreg['hand_over_date'];
                    $conf_subject=$qcheckspreg['conf_subject'];
                    
                    echo"<table border=0 class=bgc width=70%><tr><td width=40%>Name With Initials<td> : $stname";
                    echo"<tr><td>Registered Academic Year <td> : $ac_year";
                    echo"<tr><td>First Choice Subject <td> : ".strtoupper($choice_one);
                    echo"<tr><td>Second Choice Subject <td> : ".strtoupper($choice_two);
                    if ($ststrm=="bio") {
                    echo"<tr><td>Third Choice Subject <td> : ".strtoupper($choice_three);
                    }
                    echo"<tr><td>Submited Date <td> : $hand_over_date";
                    echo"<tr><td>Confirmation Subject <td> : $conf_subject";
                    echo"</table>";
                    
                                                                }
                   }
        
        else   {
            
            /////////////////////get personal info//////////////////////////////
            $queghetpers="select * from student_personal_detais where stno='SC/$stbt/$spstno'";
            $qughetpers=mysql_query($queghetpers);
            $qghetpers=mysql_fetch_array($qughetpers);
       
            ////////////////////////////////////////////////////////////////////
        
        
            echo"<h3>Application form of Bachelor of Science(Special) Degree</h3>";
                echo"<font color=red>[ Application Closing Date : $enddate ]</font><br>";
            echo"<form method=post action='./index.php?view=admin&admin=61&task=sbspapfm' id='specialapply' onkeypress='return event.keyCode!=13'>";
        
        echo"<table border=0 width=100% class=bgc>";
            echo"<tr><td align=center colspan=2>*** Select the Principal Subject of Special Degree ***";
           // echo"<tr><td align=center colspan=2>[ Your Subject Combinations Are $cmbsubar[0] &nbsp;&nbsp; $cmbsubar[1] &nbsp;&nbsp; $cmbsubar[2] ]";
            echo"<tr><td colspan=2 align=center> First Choice: <select name=firstcho>";
                echo"<option value='no_subject' selected>Select one</option>";
                for($j=0;$j<3;$j++){
                    
                    if(in_array($cmbsubar[$j], $specialsub)){
                            
                        
                    echo"<option value='$deptar[$j]'>$cmbsubar[$j]</option>";
                    }
                }
            
                    echo"</select>";
            
            echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            
            $arrelmnt = count($specialsub);
           
             if($arrelmnt>="2"){
            echo"Second Choice: <select name=secndchoi>";
            echo"<option value='no_subject' selected>Select one</option>";
                for($k=0;$k<3;$k++){
                    if(in_array($cmbsubar[$k], $specialsub)){
                    echo"<option value='$deptar[$k]'>$cmbsubar[$k]</option>";
                    }
                }
            
            
                    echo"</select>";
                    
              if ($ststrm=="bio") {
                echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";      
                echo"Third Choice: <select name=terddchoi>";
                echo"<option value='no_subject' selected>Select one</option>";
                for($k=0;$k<3;$k++){
                    if(in_array($cmbsubar[$k], $specialsub)){
                    echo"<option value='$deptar[$k]'>$cmbsubar[$k]</option>";
                    }
                }
            
            
                    echo"</select>";
                                    }
                                }
        
            echo"<tr><td align=center colspan=2><br>*** Other Informations ***<br>";
              echo"(If your name appear wrong, please contact Dean's Office immediately.)<br>"; 
            echo"<tr><td width=30%>1. Name with Initials<td> : ";
                                echo strtoupper($stname);
                                 
            echo"<tr><td valign=top>2. Address<td valign=top> : ";
                        $ad1=$qghetpers['padd1'];
                        $ad2=$qghetpers['padd2'];
                        $ad3=$qghetpers['padd3'];
                        $ad4=$qghetpers['padd4'];
                        if($ad1!=NULL){
                            echo"<input type=text name=padd1 value='$ad1'><br>";
                        }
                        else{
                            echo"<span id='sprytextfield2'><input type='text' name='padd1' size='20'><span class='textfieldRequiredMsg'><font size='-1'> Enter the Address</font></span>";
                            echo"<span class='textfieldInvalidFormatMsg'><font size='-1'>Invalid format</font></span><br>";
                            
                            
                        }
                        
                        
                        echo"&nbsp;&nbsp;<input type=text name=padd2 value='$ad2'><br>";
                        echo"&nbsp;&nbsp;<input type=text name=padd3 value='$ad3'><br>";
                        echo"&nbsp;&nbsp;<input type=text name=padd4 value='$ad4'><br>";
                        
                        
            echo"<tr><td>3. Date of Birth<td> : ";
                        $dob=$qghetpers['dob'];
                        if($dob!=NULL){
                            echo"<input type=text name=dob value='$dob' size='10'>(YYYY-MM-DD)";
                        }

                        else{
                            echo"<span id='date1'><input type='text' name='dob' size='10'><span class='textfieldRequiredMsg'><font size='-1'> Enter the Date of Birth</font></span>";
                            echo"<span class='textfieldInvalidFormatMsg'><font size='-1'>Invalid format</font></span>";
                        }


            //echo"<tr><td>4. Age as at closing date of application<td> : ";
            
            echo"<tr><td>4. National Identity Card No<td> : ";
                        $nic=$qghetpers['nic'];
                        if($nic!=NULL){
                            echo"<input type=text name=nic value='$nic' size='10'>";
                        }
                        else{
                            echo"<span id='sprytextfield1'><input type='text' name='nic' size='10'><span class='textfieldRequiredMsg'><font size='-1'> Enter the National Identiti Card No</font></span>";
        echo"<span class='textfieldInvalidFormatMsg'><font size='-1'>Invalid format</font></span>";
                            
                        }
            echo"<tr><td>5. Contatact No<td> : ";
                        $hmtpno=$qghetpers['tel_home'];
                        $mbtpno=$qghetpers['tel_mobile'];
                        if($hmtpno!=NULLl){
                             echo"Home<input type=text name=land value='$hmtpno' size=12>";
                         }
                        else{
                                echo"Home<input type=text name=land size=12>";
                            
                        }
                        
                        if($mbtpno!=NULL){
                            echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mobile<input type=text name=mobil value='$mbtpno' size=12>";
                        }
                        else{
                                echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mobile<input type=text name=mobil size=12>";
                             }
                        
                        
            echo"<tr><td>6. Email<td> : ";         
                        $email=$qghetpers['email'];
                        echo"<input type=text name=email value='$email' size=40>";
                        
            echo"<tr><td colspan=2>7. Educational Qualipications : ";
        
                        $olyear=$qghetpers['olyear'];
                        $olindexno=$qghetpers['olindexno'];
        
        
            echo"<tr><td align=right>7.1. G. C. E. (O/L) <td> : Index No<input type=text name=olindex value='$olindexno' size=12>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    echo"Year<input type=text name=olyear value='$olyear' size=8>";
                    echo"<tr><td colspan=2>";
                         $mathematics=$qghetpers['mathematics'];
                         $science=$qghetpers['science'];
                         $buddhism=$qghetpers['buddhism'];
                         $soc_s_n_history=$qghetpers['soc_s_n_history'];
                         $sinhala=$qghetpers['sinhala'];
                         $engilsh=$qghetpers['engilsh'];
                         
                            $art_sub=$qghetpers['art_sub'];
                            $art_sub_grd=$qghetpers['art_sub_grd'];
                            
                            $other_sub1=$qghetpers['other_sub1'];
                            $other_sub1_grd=$qghetpers['other_sub1_grd'];
                                                                                   
                            $other_sub2=$qghetpers['other_sub2'];
                            $other_sub2_grd=$qghetpers['other_sub2_grd'];
                            
                            $other_sub3=$qghetpers['other_sub3'];
                            $other_sub3_grd=$qghetpers['other_sub3_grd'];
                            
                            $other_sub4=$qghetpers['other_sub4'];
                            $other_sub4_grd=$qghetpers['other_sub4_grd'];
                                          
                            $other_sub5=$qghetpers['other_sub5'];
                            $other_sub5_grd=$qghetpers['other_sub5_grd'];
                            
                        
                        echo"<table border=1 align=center cellspadding=0 cellspacing=0 width=70%><th width=40%>Subject<th width=10%>Grade<th width=40%>Subject<th width=10%>Grade";
                        echo"<tr><td>1. Mathematics<td align=center><input type=text name=maths value='$mathematics' size=1><td>7. &nbsp;<input type=text name=art_sub value='$art_sub' size=20><td align=center><input type=text name=art value='$art_sub_grd' size=1>";
                       
                       
                        echo"<tr><td>2. Science<td align=center><input type=text name=scie value='$science' size=1><td>8. &nbsp;<input type=text name=other_sub1 value='$other_sub1' size=20><td align=center><input type=text name=othr1 value='$other_sub1_grd' size=1>";
                        
                        
                        echo"<tr><td>3. Buddhism<td align=center><input type=text name=buddis value='$buddhism' size=1><td>9. &nbsp;<input type=text name=other_sub2 value='$other_sub2' size=20><td align=center><input type=text name=othr2 value='$other_sub2_grd' size=1>";
                        
                        
                        echo"<tr><td>4. Sinhala<td align=center><input type=text name=sinha value='$sinhala' size=1><td>10.<input type=text name=other_sub3 value='$other_sub3' size=20><td align=center><input type=text name=othr3 value='$other_sub3_grd' size=1>";
                        
                        
                        echo"<tr><td>5. Engilsh<td align=center><input type=text name=engl value='$engilsh' size=1><td>11.<input type=text name=other_sub4 value='$other_sub4' size=20><td align=center><input type=text name=othr4 value='$other_sub4_grd' size=1>";
                        
                        
                        echo"<tr><td>6. Soc.s & History<td align=center><input type=text name=sosnh value='$soc_s_n_history' size=1><td>12.<input type=text name=other_sub5 value='$other_sub5' size=20><td align=center><input type=text name=othr5 value='$other_sub5_grd' size=1>";
                        
                        echo"</table><br>";
                        
                        $alyear=$qghetpers['alyear'];
                        $alindexno=$qghetpers['alindexno'];
        
         echo"<tr><td align=right>7.2. G. C. E. (A/L) <td> : Index No<input type=text name=alindex value='$alindexno' size=12>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    echo"Year<input type=text name=alyear value='$alyear' size=8>";
                    echo"<tr><td colspan=2>";
                                $physics=$qghetpers['physics'];
                                $chemistry =$qghetpers['chemistry'];
                                $com_maths=$qghetpers['com_maths'];
                                $biology=$qghetpers['biology'];
                                $gen_english=$qghetpers['gen_english'];
                                $addi_subject=$qghetpers['addi_subject'];
                                $add_sub_grd=$qghetpers['add_sub_grd'];
                                $zscore=$qghetpers['zscore'];
                                $gtmarks=$qghetpers['gtmarks'];
                                //$=$qghetpers[''];
                                  
                            echo"<table border=1 align=center cellspadding=0 cellspacing=0><th>Subject<th>Grade";
                                echo"<tr><td>1. Physics<td align=center><input type=text name=phy value='$physics' size=1>";
                                echo"<tr><td>2. Chemistry<td align=center><input type=text name=che value='$chemistry' size=1>";
                                echo"<tr><td>3. Combind Mathematics<td align=center><input type=text name=commat value='$com_maths' size=1>";
                                echo"<tr><td>4. Biology<td align=center><input type=text name=bio value='$biology' size=1>";
                                echo"<tr><td>5. <input type=text name=adsub value='$addi_subject' size=10><td align=center><input type=text name=adsubgd value='$add_sub_grd' size=1>";
                                echo"<tr><td>6. Gen. English<td align=center><input type=text name=geneng value='$gen_english' size=1>";
                                echo"<tr><td>7. Z-Score<td align=center><input type=text name=zscor value='$zscore' size=5>";
                                echo"<tr><td>8. Gen. Test Marks<td align=center><input type=text name=gentmrks value='$gtmarks' size=2>";
                            echo"</table><br>";
        
        
                echo"<tr><td valign=top>8. Other Qualifications<td valign=top>  ";
                //echo"<textarea name='oth_qul' cols='60' rows='3' ></textarea>";
                    echo'<span id="textarea_counter_up">';
                    echo'<textarea rows="3" name="oth_qul" cols="60">&nbsp;</textarea>';
                    echo'<span id="Counttextarea_counter">Remaining Chars &nbsp;</span>';
                    echo'<center> <span class="textareaRequiredMsg">Type a Description of  Other Qualifications</span> </center> ';
                    echo'<span class="textareaMaxCharsMsg">The maximum number of characters exceeded</span>'; 
                    echo'</span>';
                        
        
                echo"<tr><td>9. Submited Date<td> : $today";
                
                echo"<tr><td colspan=2 align=center><input type=submit value=Submit onclick='return checkfirstnsecind(specialapply)'>";
        
         echo"</table>";
             echo"</form>";
             }//already sp not register if close            
                    }//special reg on if close/////////////////
    else{
        echo"<font color=red>Appling for Special Degree is Closed.</font><br>";
        
         $quecheckspreg="select * from special_registration where stno='$spstno'";
        $qucheckspreg=mysql_query($quecheckspreg);
        if(mysql_num_rows($qucheckspreg)!=0){
            echo"<br>Your Application Datails of Special Degree <br>";
            while($qcheckspreg=mysql_fetch_array($qucheckspreg)){
                    $ac_year=$qcheckspreg['ac_year'];
                    $choice_one=$qcheckspreg['choice_one'];
                    $choice_two=$qcheckspreg['choice_two'];
                    $choice_three=$qcheckspreg['choice_three'];
                    $hand_over_date=$qcheckspreg['hand_over_date'];
                    $conf_subject=$qcheckspreg['conf_subject'];
                    
                    echo"<table border=0 class=bgc width=70%><tr><td width=40%>Name With Initials<td> : $stname";
                    echo"<tr><td>Applied Academic Year <td> : $ac_year";
                    echo"<tr><td>First Choice Subject <td> : ".strtoupper($choice_one);
                    echo"<tr><td>Second Choice Subject <td> : ".strtoupper($choice_two);
                    if ($ststrm=="bio") {
                    echo"<tr><td>Third Choice Subject <td> : ".strtoupper($choice_three);
                    }
                    echo"<tr><td>Submited Date <td> : $hand_over_date";
                    echo"<tr><td>Confirmed Special Subject <td> : ";
                    if($conf_subject!="In Progress"){
                        echo"<blink><font color=blue><b>".strtoupper($conf_subject)."</b></font></blink>";
                    }
                    else{
                        echo$conf_subject;
                    }
                    
                    
                    
                    echo"</table>";
                    
                                                                }
                   }
        else{
            echo"<br><font color=red>Sorry! You are not Applied for Special Degree</font><br><br>";
            
        }
        
        
        
        
        
    }
















                }//level 3 if close
else{
    echo"<font color=red>Sorry! You have no permission to apply for Bachelor of Science (Special) degree</font>";
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


