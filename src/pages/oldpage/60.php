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



<?php


$due=$_GET['due'];
require_once('./classes/globalClass.php');
$n=new settings();

$crr_acyear=$n->getAcc(); 




echo"Manage Special Registrations";
echo"<hr class=bar>";
 


if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
    echo"<h3>*** Start Special Registrations ***</h3>";
echo "<form method='POST' action='./index.php?view=admin&admin=60&task=strspreg'>";
echo "Special Rgistration Closing Date : ";
echo"<span id='date1'><input type='text' name='enddate' size='20'><span class='textfieldRequiredMsg'><font size='-1'> Enter the Closing Date</font></span>";
echo"<span class='textfieldInvalidFormatMsg'><font size='-1'>Invalid format</font></span>";
echo"<select name='status'>";
echo"<option value='1'>Start</option>";
echo"<option value='0'>Stop</option>";
echo"</select>";
echo"<input type='submit' value='Submit'>";
echo "</form><br>";


if($task=="strspreg"){
    $enddate=$_POST['enddate'];
    $status=$_POST['status'];
       
      
      $quedel="delete from call_special_registration";
      mysql_query($quedel);
      
      $que_ins_spreg="insert into call_special_registration(acc_year,end_data,status) values('$crr_acyear','$enddate',$status)";
      mysql_query($que_ins_spreg);
                         }


$quesel="select * from call_special_registration";
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
        echo"<option value='mathematics'>".strtoupper('mathematics')."</option>";
        echo"<option value='physics'>".strtoupper('physics')."</option>";
        echo"<option value='zoology'>".strtoupper('zoology')."</option>";
    echo"</select>";
echo"<input type=submit value='Search'></form>";

if($task=="selctdept"){
       $_SESSION['chkdept']=$_POST['sedept'];
               }
    
    
$chkspdept=$_SESSION['chkdept'];



                        }////////////////// special on/off part close for admin..............
else{
$chkspdept=$_SESSION['section'];
$due="view";

}
if(($chkspdept!=null)&&($due=="view")){
echo"<h3>List of Students Registed for Special Degree in Department of ".ucfirst($chkspdept)."</h3>";
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
        echo"<th>Other Choices<th>View Application";                   
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
                           
                           echo"<tr class=trbgc><td align=center>SC/$spstbt/$spstno<td>$spstnm";
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
                                										$year2=$year;
                                											}
                                									else{
                                										$year2="ND";
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
                               echo"[ Second Choice : <font color=red>".strtoupper($choice_two)."</font> ]<br>";
                                                      }
                            if($choice_three!=null){
                               echo"[ Third Choice : <font color=red>".strtoupper($choice_three)."</font> ]<br>";
                                                      }
                           //////////////////////////////////////////////////////////////////////////
                           echo"<td align=center><input type=hidden name=spstfno value='$spstno'>";
                           echo"<input type=hidden name=spstchoice value='choice_one'>";
                            echo"<input type=hidden name=spstsumdt value='$hand_over_date'>";
                           echo"<input type=submit value='View'></form></tr>";
                           
                       
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
        echo"<th>Other Choices<th>View Application";   
                         
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
                           
                           echo"<tr class=trbgc><td align=center>SC/$spstbt/$spstno<td>$spstnm";
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
                                                                        $year2=$year;
                                                                            }
                                                                    else{
                                                                        $year2="ND";
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
                               echo"[ First Choice : <font color=red>".strtoupper($choice_one)."</font> ]<br>";
                                                      }
                            if($choice_three!=null){
                               echo"[ Third Choice : <font color=red>".strtoupper($choice_three)."</font> ]<br>";
                                                      }
                           //////////////////////////////////////////////////////////////////////////
                           echo"<td align=center><input type=hidden name=spstfno value='$spstno'>";
                           echo"<input type=hidden name=spstchoice value='choice_two'>";
                            echo"<input type=hidden name=spstsumdt value='$hand_over_date'>";
                           echo"<input type=submit value='View'></form></tr>";
                       
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
       echo"<th>Other Choices<th>View Application";                  
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
                           
                           echo"<tr class=trbgc><td align=center>SC/$spstbt/$spstno<td>$spstnm";
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
                                                                        $year2=$year;
                                                                            }
                                                                    else{
                                                                        $year2="ND";
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
                               echo"[ First Choice : <font color=red>".strtoupper($choice_one)."</font> ]<br>";
                                                      }
                            if($choice_two!=null){
                               echo"[ Second Choice : <font color=red>".strtoupper($choice_two)."</font> ]<br>";
                                                      }
                           //////////////////////////////////////////////////////////////////////////
                           echo"<td align=center><input type=hidden name=spstfno value='$spstno'>";
                           echo"<input type=hidden name=spstchoice value='choice_three'>";
                           echo"<input type=hidden name=spstsumdt value='$hand_over_date'>";
                           echo"<input type=submit value='View'></form></tr>";
                       
                  }
        echo"</table><br>";
////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"</div>";
                                    }





/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////end 3rd second choice studen////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////







                 
                 

}///////////////////////////view student if close




















?>










<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}

?>


