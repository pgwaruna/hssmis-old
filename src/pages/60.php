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
if($qpers['id']=="60"){
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
  function chkalcnf(){
        var cnf=confirm("Do you realy want, Confirm All Special Selected Student ?  \nIf yes Click [OK] ");
        if(cnf==true){
            return true;
        }
        else{
            return false;
        }
        
       } 
    
</script>

<?php


$due=$_GET['due'];
require_once('./classes/globalClass.php');
$n=new settings();

$crr_acyear2=$n->getAcc(); 

$expacy=explode("_",$crr_acyear2);

$expacyl=$expacy[0];
$expacyr=$expacy[1];

$newexpacyl=$expacyl+1;
$newexpacyr=$expacyr+1;

$crr_acyear3=$newexpacyl."_".$newexpacyr;


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

$combination=array();

$combination[1]="CS + Maths + AM";
$combination[2]="CS + Maths + Physics";
$combination[3]="CS + Chemistry + Maths";
$combination[4]="IM + Maths + Chemistry";
$combination[5]="IM + Maths + Physics";
$combination[6]="Maths + AM + Physics";
$combination[7]="Maths + AM + Chemistry";
$combination[8]="Maths + Physics + Chemistry";
$combination[9]="Zoo + Bot + Chemistry";
$combination[10]="Chemistry + Botany + Physics";
$combination[11]="Chemistry + Zoo + Physics";
$combination[12]="Botany + Zoo + Physics";
$combination[13]="BCS - Computer Science";









echo"Manage Special Application";
echo"<hr class=bar>";
 


if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
    echo"<h3>*** Start Special  Application Calling ***</h3>";
echo "<form method='POST' action='./index.php?view=admin&admin=60&task=strspreg'>";
echo "Special Rgistration Closing Date : ";
echo"<span id='date1'><input type='text' name='enddate' size='20'><span class='textfieldRequiredMsg'><font size='-1'> Enter the Closing Date</font></span>";
echo"<span class='textfieldInvalidFormatMsg'><font size='-1'>Invalid format</font></span>";
echo"<select name=crac>";
echo"<option value='$crr_acyear3' selected>$crr_acyear3</option>";
echo"<option value='$crr_acyear2'>$crr_acyear2</option>";
echo"</select>";

echo"<select name='status'>";
echo"<option value='1'>Start</option>";
echo"<option value='0'>Stop</option>";
echo"</select>";
echo"<input type='submit' value='Submit'>";
echo "</form><br>";


if($task=="strspreg"){
    $enddate=$_POST['enddate'];
    $status=$_POST['status'];
       $scrac=$_POST['crac']; 
      
      $quedel="delete from call_special_application";
      mysql_query($quedel);
      
      $que_ins_spreg="insert into call_special_application(acc_year,end_data,status) values('$scrac','$enddate',$status)";
      mysql_query($que_ins_spreg);
                         }


$quesel="select * from call_special_application";
$qusel=mysql_query($quesel);
while($qsel=mysql_fetch_array($qusel)){

$ye=$qsel['acc_year'];
$ed=$qsel['end_data'];
$st=$qsel['status'];
echo"<div align='center'><br>";

echo "<table border='0'>";
echo"<tr><th>Academic Year</th><th>Closing Date</th><th>Status</th></tr>";

echo "<tr class=trbgc>";
echo"<td align='center'>$ye</td>";
echo"<td align='center'>$ed</td>";
echo"<td align='center'>";
if($st=='1')
{echo"Start";}
if($st=='0')
{echo"Stop";}
echo"</td></tr>";
echo"</table>";

}










echo"<hr class=bar>";
echo"<h3>*** Check Student List ***</h3>";
echo"<form method=POST action='./index.php?view=admin&admin=60&task=selctdept&due=view'>";
echo"Select Subject to Check Student List";
    echo"<select name=sedept>";
        echo"<option value='botany'>".strtoupper('botany')."</option>";
        echo"<option value='chemistry'>".strtoupper('chemistry')."</option>";
	echo"<option value='computer_science'>".strtoupper('computer science (bcs)')."</option>";	
        echo"<option value='mathematics'>".strtoupper('mathematics')."</option>";
        echo"<option value='physics'>".strtoupper('physics')."</option>";
        echo"<option value='zoology'>".strtoupper('zoology')."</option>";
	
    echo"</select>";
echo"<input type=submit value='Search'></form>";

if($task=="selctdept"){
       $_SESSION['chkdept']=$_POST['sedept'];
               }
    
    
$chkspdept=$_SESSION['chkdept'];
/*
echo"<hr class=bar>";
echo"<h3>*** Finalize of Special Selections ***</h3>";
echo"<form method=post action='./index.php?view=admin&admin=60&task=cnfall'>";

echo"<table width=70%><tr class=trbgc><td align=center valign=middle height=30px>";
echo"Confirmation of the all Special Selections : ";
 echo"<input type=submit name=allcnf value='Confirm All Selected Student'>";
echo"</td></tr></table>";

echo"</form>";  

 */  
                        }////////////////// special on/off part close for admin..............
else{
$chkspdept=$_SESSION['section'];
$due="view";

}

////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////// confirm subject///////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
if($task=="cnfspsub"){
    $cnfstno=$_POST['cnfspstno'];
    $cnfsub=$_POST['cnfsub'];
    $cnfbttn=$_POST['cnfbttn'];
    
    $gencmbid=$n->getcombination($cnfstno);
    $ststem=$n->getstream($cnfstno);
    $stbatch=$n->getBatch($cnfstno);
    
    
   // echo$cnfstno.$cnfsub.$cnfbttn;
    if($cnfbttn=="$cnfstno - Confirm"){
        $queupspappred="update special_registration set conf_subject='$cnfsub' where stno='$cnfstno' and ac_year='$crr_acyear'";
        mysql_query($queupspappred);
        
                    /////////////////////////////////////////////////////////////////////////////
                    ///////////////////////// insert cmb for cmb_reg/////////////////////////////
                    /////////////////////////////////////////////////////////////////////////////
                    $query="SELECT acedemic_year FROM acc_year where acedemic_year LIKE '$stbatch%'";
                        $data=mysql_query($query);
                        while($predata=mysql_fetch_array($data)){
                            $stregac=$predata['acedemic_year'];
                            }
                    $spstoldcmbwtval=$combination[$gencmbid]."/".$gencmbid;
                    
                    
                    $quegetstoldcmb="select combination from request_combination where stno='$cnfstno' and status='Confirmed'";
                    $qugetstoldcmb=mysql_query($quegetstoldcmb);
                    if(mysql_num_rows($qugetstoldcmb)==0){
                        $inseroldcmbforcmbreg="insert into request_combination(acc_year, stno, combination, priority, status) values('$stregac','$cnfstno','$spstoldcmbwtval',0,'Confirmed')";
                        //echo$inseroldcmbforcmbreg;
                        mysql_query($inseroldcmbforcmbreg);
                    }
                    /////////////////////////////////////////////////////////////////////////////
                    ///////////////////////// insert cmb for cmb_reg/////////////////////////////
                    /////////////////////////////////////////////////////////////////////////////
        
        
        ////////////////////////////////////////////////////////////////
        /////////////////////CHNG CMB TO SP/////////////////////////////
        ////////////////////////////////////////////////////////////////
        $stspcmb=$cnfsub."_sp";
        
        $quegetspcmb="select id from combination where subject='$stspcmb'";
        $qugetspcmb=mysql_query($quegetspcmb);
        if(mysql_num_rows($qugetspcmb)!=0){
            while($qgetspcmb=mysql_fetch_array($qugetspcmb)){
                $spcmbid=$qgetspcmb['id'];
            }
        }
        else{
            $spcmbid=$gencmbid;
        }
        
        $newspstrm=$ststem."(".$stspcmb.")";
        
        $queupdstsp="update student set stream='$newspstrm', combination=$spcmbid where id='$cnfstno'";
        //echo$queupdstsp;
        mysql_query($queupdstsp);
        ////////////////////////////////////////////////////////////////
        /////////////////end CHNG CMB TO SP/////////////////////////////
        ////////////////////////////////////////////////////////////////
        }
    else{
        $queupspappred="update special_registration set conf_subject='In Progress' where stno='$cnfstno' and ac_year='$crr_acyear'";
        mysql_query($queupspappred);
                
        ///////////////////////////////////////////////////////////////
        /////////////////////CHNG CMB TO NML///////////////////////////
        ////////////////////////////////////////////////////////////////
        $stoldstm = substr("$ststem", 0 ,3); 
        
        $quegetstoldcmb="select combination from request_combination where stno='$cnfstno' and status='Confirmed'";
        $qugetstoldcmb=mysql_query($quegetstoldcmb);
        if(mysql_num_rows($qugetstoldcmb)!=0){
            while($qgetstoldcmb=mysql_fetch_array($qugetstoldcmb)){
                $stoldcmbfmrcmb2=$qgetstoldcmb['combination'];
            }
            $stoldcmbfmrcmbexp=explode("/",$stoldcmbfmrcmb2);
            
            $stoldcmbfmrcmb=$stoldcmbfmrcmbexp[1];
        }
        else{
            $stoldcmbfmrcmb="0";
        }
        
        
        $queupdstspold="update student set stream='$stoldstm', combination=$stoldcmbfmrcmb where id='$cnfstno'";
        //echo$queupdstspold;
        mysql_query($queupdstspold);
        ////////////////////////////////////////////////////////////////
        /////////////////end CHNG CMB TO NML////////////////////////////
        ////////////////////////////////////////////////////////////////
        
    }

}
////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////// end confirm subject///////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////







if(($chkspdept!=null)&&($due=="view")){
echo"<h3>List of Students Applied for Special Degree in Department of ".ucfirst($chkspdept)."</h3>";
////////////////////////////////////////////////////
///////////////////////BCS//////////////////////////
////////////////////////////////////////////////////
if($chkspdept=="computer_science"){
$chkspdept="computerscience";
}
////////////////////////////////////////////////////
////////////////////////////////////////////////////
////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////first choice studen/////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
$quegetspst="select * from special_registration where ac_year='$crr_acyear' and choice_one='$chkspdept' order by stno";
$qugetspst=mysql_query($quegetspst);
if(mysql_num_rows($qugetspst)!=0){
   echo"<div id=m>"; 
      echo"<table border=1 bordercolor=#ffffff cellspacing=0 >";
      echo"<h3>First Choice Student</h3>";
      echo"<th>Student Number<th>Name with Initials";  
      ////////////////////////////////////////get subject list//////////////////////////////////////////////////
////////////////////////////////////////////////////
///////////////////////BCS//////////////////////////
////////////////////////////////////////////////////
if($chkspdept=="computer_science"){
$chkspdept="computerscience";
}
////////////////////////////////////////////////////
////////////////////////////////////////////////////
////////////////////////////////////////////////////


      $quegetsublst="select code from courseunit where department='$chkspdept' and core='co' and (level=1 or level=2) and availability=1 order by level,semister,code";
//echo$quegetsublst;
      $qugetsublst=mysql_query($quegetsublst);
      if(mysql_num_rows($qugetsublst)!=0){
          while($qgetsublst=mysql_fetch_array($qugetsublst)){
              $subcode=$qgetsublst['code'];
              $sbject=strtoupper($subcode);
              $sbjectarr1 = str_split($sbject);
              //$wtspseparated = implode(" ", $sbjectarr1);
              
              echo"<td align=center valign=top bgcolor='#d2a6d9'>";
              for($t=0;$t<=6;$t++){
               
                  if($t!=6){
                    echo "<font size=2px><b>".$sbjectarr1[$t]."</b></font><br>";
                  }
                  else{
                  /////////////////////////////////////////
                          $credit=$sbjectarr1[6];
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
                  
                  /////////////////////////////////////////
                      echo "<font size=2px><b>".$credit."</b></font><br>";
                  }
                                    }
              echo"</td>";
          }
      }
        echo"<th>Other Choices<th>Application<th>Confirm Subject<th>Submit</th>";    
                   
      ///////////////////////////////////// sub end///////////////////////////////////////////////////////////////////// 
                         
                  while($qgetspst=mysql_fetch_array($qugetspst)){
                      echo"<form method=POST action='./forms/form_60.php'>";
                           $sp_id=$qgetspst['sp_id'];   
                           $spstno=$qgetspst['stno']; 
                           $ac_year=$qgetspst['ac_year'];
                           $choice_one=$qgetspst['choice_one'];
                           $choice_two=$qgetspst['choice_two'];
                           $choice_three=$qgetspst['choice_three'];
                           $hand_over_date=$qgetspst['hand_over_date'];
                           $conf_subject=$qgetspst['conf_subject'];
                           
                           $spstbt=$n->getBatch($spstno);
                           $spstnm=$n->getName($spstno);
                           //////////////////////////////////////////
                           if($conf_subject=="In Progress"){
                           echo"<tr class=trbgc valign=middle>";
                           }
                           elseif($conf_subject=="Not Qualified"){
                           echo"<tr class=selectbg2 valign=middle>";
                           }
                           else{
                           echo"<tr class=selectbg4 valign=middle>";
                           }
                           //////////////////////////////////////////
                           echo"<td align=center>SC/$spstbt/$spstno<td>".strtoupper($spstnm);
                           /////////////////////////////////////////////////////////////////////////////
                          
                           $qugetsublst2nd=mysql_query($quegetsublst);
                            if(mysql_num_rows($qugetsublst2nd)!=0){
                                while($qgetsublst2nd=mysql_fetch_array($qugetsublst2nd)){
                                    echo"<td align=center>";
                                        $subcode2nd=$qgetsublst2nd['code'];
                                        $subcode2nd3=trim($subcode2nd);
                                            $quegetresult="select grade, year from results where index_number='$spstno' and  subject='$subcode2nd3' order by year";
                                            $qugetresult=mysql_query($quegetresult);
                                            if(mysql_num_rows($qugetresult)!=0){
                                                $sal=0;
                                                while($qgetresult=mysql_fetch_array($qugetresult)){
                                                    $sal++;
                                                    if($sal>1){                                                               
                                                                echo"/";
                                                                }
                                                                $grade=$qgetresult['grade'];
                                                                $year=$qgetresult['year'];
                                                                
                                                                ////////////////////////////////////////////////////
                                                                //////////////////view year/////////////////////////
                                                                ////////////////////////////////////////////////////
                                									if($year!=null){
                                										$year2=$subcode2nd3." in ".$year;
                                											}
                                									else{
                                										$year2=$subcode2nd3." - ND";
                                										}
                                                                
                                                                  echo"&nbsp;<b><a href='#' class='$year2' title='$year2'>$grade</a></b>&nbsp;"; 
                                                                   echo'<script type="text/javascript">'; 
                                                                   echo"$".$year2."tooltip()"; 
                                                                   echo"</script>";                                     
                                                                
                                                                ////////////////////////////////////////////////////
                                                                ////////////////////////////////////////////////////
                                                                //////////////////////////////////////////////////// 
                                                                
                                                      
                                                  }
                                                
                                                
                                            }
                                            else{
                                                //echo"<input type=text name=result size=1>";
                                                echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                            }
                           
                           
                           
                           
                                    
                                    echo"</td>";
                                }
                                }
                           ///////////////////////////////////////////////////////////////////////////
                           
                           /////////////////////////////other choce////////////////////////////////
                           echo"<td width=40% align=center>";
                           if($choice_two!=null){
                               echo"[ 2<sup>nd</sup> Choice : <font color=red>".strtoupper($choice_two)."</font> ]<br>";
                                                      }
                            if($choice_three!=null){
                               echo"[ 3<sup>rd</sup> Choice : <font color=red>".strtoupper($choice_three)."</font> ]<br>";
                                                      }
                           //////////////////////////////////////////////////////////////////////////
                           echo"<td align=center><input type=hidden name=spstfno value='$spstno'>";
                           echo"<input type=hidden name=spstchoice value='choice_one'>";
                            echo"<input type=hidden name=spstsumdt value='$hand_over_date'>";
                           echo"<input type=submit value='View'></form></td>";
                           /////////////////////////////////////
                           /////////////////////////////////////
                           echo"<form method=post action='./index.php?view=admin&admin=60&task=cnfspsub&due=view'>";
                           
                           if($conf_subject=="In Progress"){
                                   
                               echo"<td align=center>&nbsp;<td align=center><input type=submit value='$spstno - Confirm' name='cnfbttn'>";
                               
                           }
                           elseif($conf_subject==$choice_one){
                               echo"<td align=center><font color=blue><b>".strtoupper($conf_subject)."</b></font><td align=center><input type=submit  name='cnfbttn' value='$spstno - Cancel'>"; 
                               
                           }
                           else{
                               echo"<td align=center colspan=2><font color=red><b>".strtoupper($conf_subject)."</b></font>"; 
                           }
                           echo"<input type=hidden name=cnfspstno value='$spstno'>";

////////////////////////////////////////////////////
///////////////////////BCS//////////////////////////
////////////////////////////////////////////////////
if($chkspdept=="computerscience"){
$chkspdept="computer_science";
}
////////////////////////////////////////////////////
////////////////////////////////////////////////////
////////////////////////////////////////////////////


                           echo"<input type=hidden name=cnfsub value='$chkspdept'>";
                           echo"</td></form>";
                           /////////////////////////////////////
                           /////////////////////////////////////
                  }
        echo"</table><br>";
////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"</div>";
                                    }
else{
    echo"<font color=red>Sorry! There are no  student applied for ".strtoupper($chkspdept)." as first choice</font><br>";
}
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////first choice studen/////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////




/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////second choice studen/////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////


$quegetspst="select * from special_registration where ac_year='$crr_acyear' and choice_two='$chkspdept' order by stno";
$qugetspst=mysql_query($quegetspst);
if(mysql_num_rows($qugetspst)!=0){
echo"<br><div id=m>";     
      echo"<table border=1 bordercolor=#ffffff cellspacing=0>";
      echo"<h3>Second Choice Student</h3>";
      echo"<th>Student Number<th>Name with Initials";  
      ////////////////////////////////////////get subject list//////////////////////////////////////////////////
      $quegetsublst="select code from courseunit where department='$chkspdept' and core='co' and (level=1 or level=2) and availability=1 order by level,semister,code";
      $qugetsublst=mysql_query($quegetsublst);
      if(mysql_num_rows($qugetsublst)!=0){
          while($qgetsublst=mysql_fetch_array($qugetsublst)){
              $subcode=$qgetsublst['code'];
              $sbject=strtoupper($subcode);
              $sbjectarr1 = str_split($sbject);
              //$wtspseparated = implode(" ", $sbjectarr1);
              
              echo"<td align=center valign=top bgcolor='#d2a6d9'>";
              for($t=0;$t<=6;$t++){
               
                  if($t!=6){
                    echo "<font size=2px><b>".$sbjectarr1[$t]."</b></font><br>";
                  }
                  else{
                  /////////////////////////////////////////
                          $credit=$sbjectarr1[6];
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
                  
                  /////////////////////////////////////////
                      echo "<font size=2px><b>".$credit."</b></font><br>";
                  }
                                    }
              echo"</td>";
          }
      }
         echo"<th>Other Choices<th>Application<th>Confirm Subject<th>Submit</th>";    
                         
      ///////////////////////////////////// sub end///////////////////////////////////////////////////////////////////// 
                         
                  while($qgetspst=mysql_fetch_array($qugetspst)){
                      echo"<form method=POST action='./forms/form_60.php'>";
                           $sp_id=$qgetspst['sp_id'];   
                           $spstno=$qgetspst['stno']; 
                           $ac_year=$qgetspst['ac_year'];
                           $choice_one=$qgetspst['choice_one'];
                           $choice_two=$qgetspst['choice_two'];
                           $choice_three=$qgetspst['choice_three'];
                           $hand_over_date=$qgetspst['hand_over_date'];
                           $conf_subject=$qgetspst['conf_subject'];
                           
                           $spstbt=$n->getBatch($spstno);
                           $spstnm=$n->getName($spstno);
                           //////////////////////////////////////////
                           if($conf_subject=="In Progress"){
                           echo"<tr class=trbgc>";
                           }
                           elseif($conf_subject=="Not Qualified"){
                           echo"<tr class=selectbg2 valign=middle>";
                           }
                           else{
                           echo"<tr class=selectbg4>";
                           }
                           //////////////////////////////////////////
                           echo"<td align=center>SC/$spstbt/$spstno<td>".strtoupper($spstnm);
                           /////////////////////////////////////////////////////////////////////////////
                          
                           $qugetsublst2nd=mysql_query($quegetsublst);
                            if(mysql_num_rows($qugetsublst2nd)!=0){
                                while($qgetsublst2nd=mysql_fetch_array($qugetsublst2nd)){
                                    echo"<td align=center>";
                                        $subcode2nd=$qgetsublst2nd['code'];
                                        $subcode2nd3=trim($subcode2nd);
                                            $quegetresult="select grade, year from results where index_number='$spstno' and  subject='$subcode2nd3' order by year";
                                            $qugetresult=mysql_query($quegetresult);
                                            
                                            if(mysql_num_rows($qugetresult)!=0){
                                                $sal=0;
                                                while($qgetresult=mysql_fetch_array($qugetresult)){
                                                    $sal++;
                                                    if($sal>1){                                                               
                                                                echo"/";
                                                                }
                                                                $grade=$qgetresult['grade'];
                                                                $year=$qgetresult['year'];
                                                                
                                                                ////////////////////////////////////////////////////
                                                                //////////////////view year/////////////////////////
                                                                ////////////////////////////////////////////////////
                                                                    if($year!=null){
                                                                        $year2=$subcode2nd3." in ".$year;
                                                                            }
                                                                    else{
                                                                        $year2=$subcode2nd3." - ND";
                                                                        }
                                                                
                                                                  echo"&nbsp;<b><a href='#' class='$year2' title='$year2'>$grade</a></b>&nbsp;"; 
                                                                   echo'<script type="text/javascript">'; 
                                                                   echo"$".$year2."tooltip()"; 
                                                                   echo"</script>";                                     
                                                                
                                                                ////////////////////////////////////////////////////
                                                                ////////////////////////////////////////////////////
                                                                ////////////////////////////////////////////////////                                                                
                                                     // echo"<b>&nbsp;".strtoupper($grade)."&nbsp;</b>";
                                                      
                                                  }
                                                
                                                
                                            }
                                            else{
                                                //echo"<input type=text name=result size=1>";
                                                echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                            }
                           
                           
                           
                           
                                    
                                    echo"</td>";
                                }
                                }
                           ///////////////////////////////////////////////////////////////////////////
                            /////////////////////////////other choce////////////////////////////////
                           echo"<td width=40% align=center>";
                           if($choice_one!=null){
                               echo"[ 1<sup>st</sup> Choice : <font color=red>".strtoupper($choice_one)."</font> ]<br>";
                                                      }
                            if($choice_three!=null){
                               echo"[ 3<sup>rd</sup> Choice : <font color=red>".strtoupper($choice_three)."</font> ]<br>";
                                                      }
                           //////////////////////////////////////////////////////////////////////////
                           echo"<td align=center><input type=hidden name=spstfno value='$spstno'>";
                           echo"<input type=hidden name=spstchoice value='choice_two'>";
                            echo"<input type=hidden name=spstsumdt value='$hand_over_date'>";
                           echo"<input type=submit value='View'></form></td>";
                           /////////////////////////////////////
                           /////////////////////////////////////
                           echo"<form method=post action='./index.php?view=admin&admin=60&task=cnfspsub&due=view'>";
                           
                           if($conf_subject=="In Progress"){
                                   
                               echo"<td align=center>&nbsp;<td align=center><input type=submit value='$spstno - Confirm' name='cnfbttn'>";
                               
                           }
                           elseif($conf_subject==$choice_two){
                               echo"<td align=center><font color=blue><b>".strtoupper($conf_subject)."</b></font><td align=center><input type=submit  name='cnfbttn' value='$spstno - Cancel'>"; 
                               
                           }
                           else{
                               echo"<td align=center colspan=2><font color=red><b>".strtoupper($conf_subject)."</b></font>";
                           }
                           echo"<input type=hidden name=cnfspstno value='$spstno'>";
                           echo"<input type=hidden name=cnfsub value='$chkspdept'>";
                           echo"</td></form>";
                           /////////////////////////////////////
                           /////////////////////////////////////
                       
                  }
        echo"</table><br>";
////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"</div>";
                                    }

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////end second choice studen////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////3rd second choice studen////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////



$quegetspst="select * from special_registration where ac_year='$crr_acyear' and choice_three='$chkspdept' order by stno";
$qugetspst=mysql_query($quegetspst);
if(mysql_num_rows($qugetspst)!=0){
echo"<br><div id=m>";     
      echo"<table border=1 bordercolor=#ffffff cellspacing=0>";
      echo"<h3>Third Choice Student</h3>";
      echo"<th>Student Number<th>Name with Initials";  
      ////////////////////////////////////////get subject list//////////////////////////////////////////////////
      $quegetsublst="select code from courseunit where department='$chkspdept' and core='co' and (level=1 or level=2) and availability=1 order by level,semister,code";
      $qugetsublst=mysql_query($quegetsublst);
      if(mysql_num_rows($qugetsublst)!=0){
          while($qgetsublst=mysql_fetch_array($qugetsublst)){
              $subcode=$qgetsublst['code'];
              $sbject=strtoupper($subcode);
              $sbjectarr1 = str_split($sbject);
              //$wtspseparated = implode(" ", $sbjectarr1);
              
              echo"<td align=center valign=top bgcolor='#d2a6d9'>";
              for($t=0;$t<=6;$t++){
               
                  if($t!=6){
                    echo "<font size=2px><b>".$sbjectarr1[$t]."</b></font><br>";
                  }
                  else{
                  /////////////////////////////////////////
                          $credit=$sbjectarr1[6];
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
                  
                  /////////////////////////////////////////
                      echo "<font size=2px><b>".$credit."</b></font><br>";
                  }
                                    }
              echo"</td>";
          }
      }
       echo"<th>Other Choices<th>Application<th>Confirm Subject<th>Submit</th>";                     
      ///////////////////////////////////// sub end///////////////////////////////////////////////////////////////////// 
                         
                  while($qgetspst=mysql_fetch_array($qugetspst)){
                      echo"<form method=POST action='./forms/form_60.php'>";
                           $sp_id=$qgetspst['sp_id'];   
                           $spstno=$qgetspst['stno']; 
                           $ac_year=$qgetspst['ac_year'];
                           $choice_one=$qgetspst['choice_one'];
                           $choice_two=$qgetspst['choice_two'];
                           $choice_three=$qgetspst['choice_three'];
                           $hand_over_date=$qgetspst['hand_over_date'];
                           $conf_subject=$qgetspst['conf_subject'];
                           
                           $spstbt=$n->getBatch($spstno);
                           $spstnm=$n->getName($spstno);
                           //////////////////////////////////////////
                           if($conf_subject=="In Progress"){
                           echo"<tr class=trbgc>";
                           }
                           elseif($conf_subject=="Not Qualified"){
                           echo"<tr class=selectbg2 valign=middle>";
                           }
                           else{
                           echo"<tr class=selectbg4>";
                           }
                           //////////////////////////////////////////
                           echo"<td align=center>SC/$spstbt/$spstno<td>".strtoupper($spstnm);
                           /////////////////////////////////////////////////////////////////////////////
                          
                           $qugetsublst2nd=mysql_query($quegetsublst);
                            if(mysql_num_rows($qugetsublst2nd)!=0){
                                while($qgetsublst2nd=mysql_fetch_array($qugetsublst2nd)){
                                    echo"<td align=center>";
                                        $subcode2nd=$qgetsublst2nd['code'];
                                        $subcode2nd3=trim($subcode2nd);
                                            $quegetresult="select grade, year from results where index_number='$spstno' and  subject='$subcode2nd3' order by year";
                                            $qugetresult=mysql_query($quegetresult);
                                            if(mysql_num_rows($qugetresult)!=0){
                                                $sal=0;
                                                while($qgetresult=mysql_fetch_array($qugetresult)){
                                                    $sal++;
                                                    if($sal>1){                                                               
                                                                echo"/";
                                                                }
                                                                $grade=$qgetresult['grade'];
                                                                $year=$qgetresult['year'];
                                                                
                                                                ////////////////////////////////////////////////////
                                                                //////////////////view year/////////////////////////
                                                                ////////////////////////////////////////////////////
                                                                    if($year!=null){
                                                                        $year2=$subcode2nd3." in ".$year;
                                                                            }
                                                                    else{
                                                                        $year2=$subcode2nd3." - ND";
                                                                        }
                                                                
                                                                  echo"&nbsp;<b><a href='#' class='$year2' title='$year2'>$grade</a></b>&nbsp;"; 
                                                                   echo'<script type="text/javascript">'; 
                                                                   echo"$".$year2."tooltip()"; 
                                                                   echo"</script>";                                     
                                                                
                                                                ////////////////////////////////////////////////////
                                                                ////////////////////////////////////////////////////
                                                                ////////////////////////////////////////////////////                                                                
                                                     // echo"<b>&nbsp;".strtoupper($grade)."&nbsp;</b>";
                                                      
                                                  }
                                                
                                                
                                            }
                                            else{
                                                //echo"<input type=text name=result size=1>";
                                                echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                            }
                           
                           
                           
                           
                                    
                                    echo"</td>";
                                }
                                }
                           ///////////////////////////////////////////////////////////////////////////
                           /////////////////////////////other choce////////////////////////////////
                           echo"<td width=40% align=center>";
                           if($choice_one!=null){
                               echo"[ 1<sup>st</sup> Choice : <font color=red>".strtoupper($choice_one)."</font> ]<br>";
                                                      }
                            if($choice_two!=null){
                               echo"[ 2<sup>nd</sup> Choice : <font color=red>".strtoupper($choice_two)."</font> ]<br>";
                                                      }
                           //////////////////////////////////////////////////////////////////////////
                           echo"<td align=center><input type=hidden name=spstfno value='$spstno'>";
                           echo"<input type=hidden name=spstchoice value='choice_three'>";
                           echo"<input type=hidden name=spstsumdt value='$hand_over_date'>";
                           echo"<input type=submit value='View'></form></td>";
                           /////////////////////////////////////
                           /////////////////////////////////////
                           echo"<form method=post action='./index.php?view=admin&admin=60&task=cnfspsub&due=view'>";
                           
                           if($conf_subject=="In Progress"){
                                   
                               echo"<td align=center>&nbsp;<td align=center><input type=submit value='$spstno - Confirm' name='cnfbttn'>";
                               
                           }
                           elseif($conf_subject==$choice_three){
                               echo"<td align=center><font color=blue><b>".strtoupper($conf_subject)."</b></font><td align=center><input type=submit  name='cnfbttn' value='$spstno - Cancel'>"; 
                               
                           }
                           else{
                               echo"<td align=center colspan=2><font color=red><b>".strtoupper($conf_subject)."</b></font>"; 
                           }
                           echo"<input type=hidden name=cnfspstno value='$spstno'>";
                           echo"<input type=hidden name=cnfsub value='$chkspdept'>";
                           echo"</td></form>";
                           /////////////////////////////////////
                           /////////////////////////////////////
                       
                  }
        echo"</table><br>";
////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"</div>";
                                    }





/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////end 3rd second choice studen////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////







                 
                 

}///////////////////////////view student if close


//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// bulk confirmation of athor all student ///////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
if($role=="administrator"){
echo"<hr class=bar>";
echo"<h3>*** Finalize of the Special Selections ***</h3>";
echo"<form method=post action='./index.php?view=admin&admin=60&task=cnfall' id='cnfbukst'>";

echo"<table width=70%><tr class=trbgc><td align=center valign=middle height=30px>";
echo"Bulk Confirmation of the All Special Selected Student : ";
 echo"<input type=submit name=allcnf value='Confirm All Selected Student' onclick='return chkalcnf(cnfbukst)'>";
echo"</td></tr></table>";

echo"</form>";

if($task=="cnfall"){
   
    $queupdatfnl="update  special_registration set conf_subject='Not Qualified' where conf_subject='In Progress' and ac_year='$crr_acyear'";
    $quupdatfnl=mysql_query($queupdatfnl);
     
    if($quupdatfnl){
        
        echo"<font color=red>Bulk Confirmation Successfully Completed!</font>";
   }
    
}

echo"<hr class=bar>";
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////end bulk confirmation of athor all student ////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////










?>










<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}

?>


