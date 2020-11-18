<?php
//error_reporting(0);
session_start();
if(($_SESSION['login'])=="truefohssmis"){
include'../connection/connection.php';

$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
//echo $querole;
$qurole=mysql_query($querole) or die(mysql_error());

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
if($qpers['id']=="65"){
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


echo"Manage Special Academic Status ";
echo"<hr class=bar>";


if($role=="administrator"||$role=="topadmin"||$role=="sar"){
    $dept="all";
}
else{
    $dept2=$_SESSION['section'];
    $dept=strtolower($dept2);
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if($task=="entspsts"){
    $spacyear=$_POST['spacyear'];
    $spseme=$_POST['spseme'];
    $spstlvl=$_POST['spstlvl'];
    $spdept=$_POST['spdept'];
    $spstlvlnc=$_POST['spstlvlnc'];
   // echo$spacyear.$spseme.$spstlvl.$spdept;
    
    if($spstlvl!=0){
    $quegtcrlvldt="select * from sp_academic_status where level=$spstlvl and department='$spdept'";
    $qugtcrlvldt=mysql_query($quegtcrlvldt);
    if(mysql_num_rows($qugtcrlvldt)==0){
         $queinsspdt="insert into sp_academic_status (academic_year,semester,level,department) values ('$spacyear',$spseme,$spstlvl,'$spdept')";
         $quspdt=mysql_query($queinsspdt);
         echo"<font color=red>Data Successfuly Inserted !</font>";
    }
    else{
        if($spstlvlnc=="ncex"){
         $queinsspdtex="insert into sp_academic_status (academic_year,semester,level,department) values ('$spacyear',$spseme,$spstlvl,'$spdept')";
         $quspdtex=mysql_query($queinsspdtex);
         echo"<font color=red>Data Successfuly Inserted !</font>";
            
        }  
        else{
            if(mysql_num_rows($qugtcrlvldt)>=2){
                $quedelacy="delete from sp_academic_status where level=$spstlvl and department='$spdept'";
                mysql_query($quedelacy);
                
                $queinsspdt2="insert into sp_academic_status (academic_year,semester,level,department) values ('$spacyear',$spseme,$spstlvl,'$spdept')";
                $quspdt=mysql_query($queinsspdt2);
                echo"<font color=red>Data Successfuly Inserted !</font>";
                
              
            }
            else{
                $queupdtrow="update sp_academic_status set academic_year='$spacyear', semester=$spseme where level=$spstlvl and department='$spdept'";
                $quspdt=mysql_query($queupdtrow);
                echo"<font color=red>Data Successfuly Submited !</font>";
                }
            }
    }
                    }
    else{
        
        
        
        
        for($l=1;$l<=2;$l++){
                    
                 $spstlvl=$l;   
                    $quegtcrlvldt="select * from sp_academic_status where level=$spstlvl and department='$spdept'";
                    $qugtcrlvldt=mysql_query($quegtcrlvldt);
                    if(mysql_num_rows($qugtcrlvldt)==0){
                         $queinsspdt="insert into sp_academic_status (academic_year,semester,level,department) values ('$spacyear',$spseme,$spstlvl,'$spdept')";
                         $quspdt=mysql_query($queinsspdt);
                         echo"<font color=red>Data Successfuly Inserted !</font>";
                    }
                    else{
                            
                         if(mysql_num_rows($qugtcrlvldt)>=2){
                            $quedelacy2="delete from sp_academic_status where level=$spstlvl and department='$spdept'";
                            mysql_query($quedelacy2);
                            
                            $queinsspdt22="insert into sp_academic_status (academic_year,semester,level,department) values ('$spacyear',$spseme,$spstlvl,'$spdept')";
                            $quspdt2=mysql_query($queinsspdt22);
                            //echo"<font color=red>Data Successfuly Inserted !</font>";
                                     }
                        else{   
                            $queupdtrow="update sp_academic_status set academic_year='$spacyear', semester=$spseme where level=$spstlvl and department='$spdept'";
                            $quspdt=mysql_query($queupdtrow);
                        //echo"<font color=red>Data Successfuly Submited !</font>";
                        }
                        }
          
        }
        echo"<font color=red>Data Successfuly Submited !</font>";
        
        
        
    }  
    echo"<br>";
    
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////




///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if($task=="entsplvl"){
         $spdept2=$_POST['spdept2'];       
         $spl1year=$_POST['spl1year'];      
         $spl2year=$_POST['spl2year']; 
         $spl0year=$_POST['spl0year'];
      
             $spexlv=$_POST['spexlv'];
             $spexyear=$_POST['spexyear'];
             
         $getnorm="no";
         
        // echo$spdept2.$spl1year.$spl2year.$spl0year;
        
     if(($spl1year=="nv")&&($spl2year=="nv")&&($spl0year=="nv")&&($spexlv=="ndexl")&&($spexyear=="nvey")){
                  $getnorm="yes";
                  echo"<font color=red>Please Select Registration Year for Levels !</font><br>";
     }   
        
        
        
        
        //////////////////////////for lvl 1//////////////////////////////////////////
        if($spl1year!="nv"){
             $getnorm="yes";
        $queinslv1="select reg_year from  sp_student_levels where  department='$spdept2' and level=1";
        $quinslv1=mysql_query($queinslv1);
        if(mysql_num_rows($quinslv1)==0){
            $queinsertdt="insert into sp_student_levels (level,reg_year,department) values(1,'$spl1year','$spdept2')";
            mysql_query($queinsertdt);
            echo"<font color=red>Level 1, Successfuly Inserted !</font><br>";
        }
        else{
            
            if(mysql_num_rows($quinslv1)>=2){
                $quedelyr="delete from sp_student_levels where department='$spdept2' and level=1";
                mysql_query($quedelyr);
                    $queinsertdt="insert into sp_student_levels (level,reg_year,department) values(1,'$spl1year','$spdept2')";
                    mysql_query($queinsertdt);
                    echo"<font color=red>Level 1, Successfuly Inserted !</font><br>";
                
                
            }
            else{
            $queuplvl1="update sp_student_levels set reg_year='$spl1year' where department='$spdept2' and level=1";
            mysql_query($queuplvl1);
            echo"<font color=red>Level 1, Successfuly Submited !</font><br>";
                }
        }
        }
        /////////////////////////////////////////////////////////////////////////////
        
        
        
         //////////////////////////for lvl 2//////////////////////////////////////////
         if($spl2year!="nv"){
              $getnorm="yes";
        $queinslv2="select reg_year from  sp_student_levels where  department='$spdept2' and level=2";
        $quinslv2=mysql_query($queinslv2);
        if(mysql_num_rows($quinslv2)==0){
            $queinsertdt2="insert into sp_student_levels (level,reg_year,department) values(2,'$spl2year','$spdept2')";
            mysql_query($queinsertdt2);
            echo"<font color=red>Level 2, Successfuly Inserted !</font><br>";
        }
        else{
             if(mysql_num_rows($quinslv2)>=2){
                $quedelyr2="delete from sp_student_levels where department='$spdept2' and level=2";
                mysql_query($quedelyr2);
                    $queinsertdt2="insert into sp_student_levels (level,reg_year,department) values(2,'$spl2year','$spdept2')";
                    mysql_query($queinsertdt2);
                    echo"<font color=red>Level 2, Successfuly Inserted !</font><br>";
                
                
            }
            else{
            $queuplvl2="update sp_student_levels set reg_year='$spl2year' where department='$spdept2' and level=2";
            mysql_query($queuplvl2);
            echo"<font color=red>Level 2, Successfuly Submited !</font><br>";
            }
        }
        }
        /////////////////////////////////////////////////////////////////////////////  
        
        
          //////////////////////////for lvl 0//////////////////////////////////////////
          if($spl0year!="nv"){
               $getnorm="yes";
        $queinslv0="select reg_year from  sp_student_levels where  department='$spdept2' and level=0";
        $quinslv0=mysql_query($queinslv0);
        if(mysql_num_rows($quinslv0)==0){
            $queinsertdt0="insert into sp_student_levels (level,reg_year,department) values(0,'$spl0year','$spdept2')";
            mysql_query($queinsertdt0);
            echo"<font color=red>Passout Level , Successfuly Inserted !</font><br>";
        }
        else{
             if(mysql_num_rows($quinslv0)>=2){
                $quedelyr0="delete from sp_student_levels where department='$spdept2' and level=0";
                mysql_query($quedelyr0);
                    $queinsertdt0="insert into sp_student_levels (level,reg_year,department) values(0,'$spl0year','$spdept2')";
                    mysql_query($queinsertdt0);
                    echo"<font color=red>Passout Level, Successfuly Inserted !</font><br>";
                
                
            }
            else{
            $queuplvl0="update sp_student_levels set reg_year='$spl0year' where department='$spdept2' and level=0";
            mysql_query($queuplvl0);
            echo"<font color=red>Passout Level , Successfuly Submited !</font><br>";
            }
        }
        }
        ///////////////////////////////////////////////////////////////////////////// 
         
        
        
            //////////////////////////////////////////////////////////////////////////////////////
            /////////////////////////////// define extra level n year ////////////////////////////
            //////////////////////////////////////////////////////////////////////////////////////
                    if(($spexlv!="ndexl")&&($spexyear!="nvey")){
                                //echo$spexlv.$spexyear;
                                
                                if($spexlv==0){
                                    $spexlv2="Passout Level";
                                }
                                else{
                                    $spexlv2="Level $spexlv";
                                }
                                
                            $queinsertdtex="insert into sp_student_levels (level,reg_year,department) values($spexlv,'$spexyear','$spdept2')";
                            mysql_query($queinsertdtex);
                            echo"<font color=red>$spexlv2 , Successfuly Inserted !</font><br>";
                        
                    }
                    else{
                        if( $getnorm=="no"){
                        echo"<font color=red>Please Select Level & Registration Year !</font><br>";
                        }
                    }
            
            
            
            //////////////////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////////////////////////
        
        
}



///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////




echo"<table border=0 width=100%><tr align=center valign=top class=selectbg2><td width=50%>";


/////////////////////////disp tbl//////////////////////////
if($dept=="all"){
     $quegetspacsttbl="select * from sp_academic_status order by department,level,academic_year ";
}
else{
       $quegetspacsttbl="select * from sp_academic_status where department='$dept' order by level";
}

$qugetspacsttbl=mysql_query($quegetspacsttbl);
if(mysql_num_rows($qugetspacsttbl)!=0){
    echo"<font size=3>*** Current Special Academic Year & Semester ***</font>";
    
echo"<table border=0><th>Level<th>Semester<th>Academic Year<th>Department";        
    
    
       while($qgetspacsttbl=mysql_fetch_array($qugetspacsttbl)){
           
                       $academic_year=$qgetspacsttbl['academic_year'];
                       $semester=$qgetspacsttbl['semester'];
                       $level=$qgetspacsttbl['level'];
                       $department=$qgetspacsttbl['department'];
           echo"<tr class=trbgc align=center><td>$level<td>$semester<td>$academic_year<td>".ucfirst($department)."</tr>";
                 }         
echo"</table>";               
   
}

///////////////////////////////////////////////////////////

/////////////////cng current ac_status////////////////////////////////////////////
echo"<br><font size=3>*** Define Current Special Academic Year & Semester ***</font>";

echo"<form method=post action='./index.php?view=admin&admin=65&task=entspsts'>";
echo"<table>";

echo"<tr class=trbgc><td>Select Student's Level<td>";
            echo"<select name=spstlvl>";
                echo"<option value='0'>All</option>";
                echo"<option value='1'>1</option>";
                echo"<option value='2'>2</option>";
            echo"</select>";

            



 echo"<tr class=trbgc><td>Select Current Semester<td>";           
            echo"<select name=spseme>";
                echo"<option value='1'>Semester 01</option>";
                echo"<option value='2'>Semester 02</option>";
            echo"</select>";
   


echo"<tr class=trbgc><td>Define New ";

echo"<select name=spstlvlnc>";
                 echo"<option value='nnc'>Normal</option>";
                 echo"<option value='ncex'>Extra</option>";
            echo"</select>";


echo" Academic Year<td>";
            echo"<select name=spacyear>";
                $gen_cr_ac_yr=$n->getAcc();
                    $gtyr=explode("_",$gen_cr_ac_yr);
                        $cryr=$gtyr[0];
                        $nxyr=$gtyr[1];
                        
                            $backacyr=($cryr-1)."_".$cryr;
                            $nextacyr=$nxyr."_".($nxyr+1);
                            
                            
                echo"<option value='$backacyr'>$backacyr</option>";
                echo"<option value='$gen_cr_ac_yr' selected>$gen_cr_ac_yr</option>";
                echo"<option value='$nextacyr'>$nextacyr</option>";
                
            echo"</select>";
            


            

echo"<tr class=trbgc><td>Select Department<td>";
            echo"<select name=spdept>";
            
                if($dept=="all"){
                    $quegetdept="select distinct(department) from courseunit order by department";
                    $qugetdept=mysql_query($quegetdept);
                    while($qgetdept=mysql_fetch_array($qugetdept)){
                            $department=$qgetdept['department'];
				if($department=="computerscience"){
				echo"<option value='computer_science'>Computer Science(BCS)</option>";
				//echo"<option value='computerscience'>Computer Science(CS)</option>";
									}
				else{
                           	echo"<option value='$department'>".ucfirst($department)."</option>";
                                                                   }
                    			}


                }
            else{
                echo"<option value='$dept'>".ucfirst($dept)."</option>";
                }
            
            echo"</select>";
            

echo"<tr class=trbgc><td colspan=2 align=center><input type=submit value='Submit the Data'> ";

echo"</table>";
echo"</form>";
//////////////////////////////////////////////////////////////////////////////////


echo"<td>";

//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////



/////////////////////////disp tbl//////////////////////////



if($dept=="all"){
    $quegetsplvl="select * from sp_student_levels order by department,reg_year";
}
else{
    $quegetsplvl="select * from sp_student_levels where department='$dept' order by reg_year";
}

$qugetsplvl=mysql_query($quegetsplvl);

if(mysql_num_rows($qugetsplvl)!=0){
     echo"<font size=3>*** Current Levels of Special Students ***</font>";
    echo"<table><th>Student's Level<th>Registration Year<th>Department";                
          while($qgetsplvl=mysql_fetch_array($qugetsplvl)){
              $lvl=$qgetsplvl['level'];
              if($lvl==0){
                  $lvl1="Passout";
              }
              else{
                  $lvl1=$lvl;
              }
              $regyear=$qgetsplvl['reg_year'];
              $stdept=$qgetsplvl['department'];
              $semes=$qgetsplvl['semester'];
              
              echo"<tr class=trbgc align=center><td>$lvl1<td>$regyear<td>".ucfirst($stdept)."</tr>";
              
              
          }           
    echo"</table><br>";
}
//////////////////// end disp tbl//////////////////////////





echo"<font size=3>*** Define Levels of Special Students ***</font>";


    $quegtgenlvl="select year from level where level=1";
    $qugtgenlvl=mysql_query($quegtgenlvl);
    while($qgtgenlvl=mysql_fetch_array($qugtgenlvl)){
        $year=$qgtgenlvl['year'];
              }




echo"<form method=post action='./index.php?view=admin&admin=65&task=entsplvl'>";
echo"<table width=100%>";

echo"<tr class=trbgc><td>Registration Year for Level 1 Special Student<td>";
            echo"<select name=spl1year>";
            echo"<option value='nv' selected>...</option>";
            $year1=$year;
            $yearlast1=$year-5;
             for($sp1=$year1;$sp1>$yearlast1;$sp1--){
                 echo"<option value=$sp1>$sp1</option>";
             }
                
            echo"</select>";
            
 echo"<tr class=trbgc><td>Registration Year for Level 2 Special Student<td>";           
            echo"<select name=spl2year>";
            echo"<option value='nv' selected>...</option>";
            $year2=$year-1;
            $yearlast2=$year2-5;
             for($sp2=$year2;$sp2>$yearlast2;$sp2--){
                 echo"<option value=$sp2>$sp2</option>";
             }
                
            echo"</select>";
   
echo"<tr class=trbgc><td>Registration Year for Recently Pass out Special Student<td>";
            echo"<select name=spl0year>";
            echo"<option value='nv' selected>...</option>";
            $year3=$year-2;
            $yearlast3=$year3-5;
             for($sp3=$year3;$sp3>$yearlast3;$sp3--){
                 echo"<option value=$sp3>$sp3</option>";
             }
                
            echo"</select>";
 echo"<tr class=trbgc><td width=65%>Select Department<td>";
            echo"<select name=spdept2>";
            
                if($dept=="all"){
                    $quegetdept="select distinct(department) from courseunit order by department";
                    $qugetdept=mysql_query($quegetdept);
                    while($qgetdept=mysql_fetch_array($qugetdept)){
                            $department=$qgetdept['department'];
                            if($department=="computerscience"){
				echo"<option value='computer_science'>Computer Science(BCS)</option>";
				//echo"<option value='computerscience'>Computer Science(CS)</option>";
									}
				else{
                           	 echo"<option value='$department'>".ucfirst($department)."</option>";
                                                                   }
                                                                   }
                    
                }
            else{
                echo"<option value='$dept'>".ucfirst($dept)."</option>";
                }
            
            echo"</select>";           
            
            

echo"<tr class=selectbg4><td>Define extra level & registration year ?<td>";
            echo"<select name=spexlv>";
            echo"<option value='ndexl' selected>Not Define Level</option>";
            echo"<option value='1'>Level 1</option>";
            echo"<option value='2'>Level 2</option>";
            echo"<option value='0'>Pass Out</option>";
              
            echo"</select>";
            
            echo"<select name=spexyear>";
            echo"<option value='nvey' selected> Not&nbsp; Define&nbsp;&nbsp;Year</option>";
            $year1e=$year;
            $yearlast1e=$year-6;
             for($sp1e=$year1e;$sp1e>$yearlast1e;$sp1e--){
                 echo"<option value=$sp1e>$sp1e</option>";
             }
                
            echo"</select>";
            
            



echo"<tr class=trbgc><td colspan=2 align=center><input type=submit value='Submit the Levels'> ";

echo"</table></form>";



echo"</tr></table>";

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<hr class=bar>";
echo"Start Special Registration";
echo"<hr class=bar>";

if($task=="stsprg"){
    $stspdept=$_POST['stspdept'];
    $stspacyr=$_POST['stspacyr'];
    $stsplvl=$_POST['stsplvl'];
    $stspsem=$_POST['stspsem'];
    $sprgeddt=$_POST['sprgeddt'];
    $sprgstus=$_POST['sprgstus'];
    $stspclnor=$_POST['stspclnor'];
    
  // echo$stspdept.$stsplvl.$stspsem.$stspacyr.$sprgeddt.$sprgstus;
  echo"<br>";   
   if($stsplvl!=0){
       $quegetregstatus="select * from  sp_call_registration where department='$stspdept' and academic_year='$stspacyr' and level=$stsplvl";
       //echo$quegetregstatus;
       $qugetregstatus=mysql_query($quegetregstatus);
       if(mysql_num_rows($qugetregstatus)==0){
           
           //$quedelclrg2="delete from sp_call_registration where level=$stsplvl and department='$stspdept'";
           //mysql_query($quedelclrg2);
           
           
           $queinscalrg="insert into sp_call_registration (department,academic_year,level,semester,end_date,status) values ('$stspdept','$stspacyr',$stsplvl,$stspsem,'$sprgeddt',$sprgstus)";
           mysql_query($queinscalrg);
           
           echo"<font color=red>Data Inserted Successfuly ! </font>";
       }
       else{
           $queupspclrg="update sp_call_registration set semester=$stspsem, end_date='$sprgeddt', status=$sprgstus where  department='$stspdept' and academic_year='$stspacyr' and level=$stsplvl";
           mysql_query($queupspclrg);
           echo"<font color=red>Data Successfuly Submited ! </font>";
       }
       
   } 
   else{
       for($lvl=1;$lvl<=2;$lvl++){
             $quedelclrg="delete from sp_call_registration where level=$lvl and department='$stspdept'";
             mysql_query($quedelclrg);
             
             $queinscalrg="insert into sp_call_registration (department,academic_year,level,semester,end_date,status) values ('$stspdept','$stspacyr',$lvl,$stspsem,'$sprgeddt',$sprgstus)";
             mysql_query($queinscalrg);   
          
       }
       
       echo"<font color=red>Data Inserted Successfuly for All Levels ! </font>";
      
   }
    
    
    
 echo"<br>";   
    
    
    
    
}


//////////////////////////////////////////////////////////////////////
//////////////////// disp sp_cl_rg tbl ///////////////////////////////
//////////////////////////////////////////////////////////////////////

if($dept=="all"){
    $quegetspclrgtbl="select * from sp_call_registration order by department,academic_year";
}
else{
    $quegetspclrgtbl="select * from sp_call_registration where department='$dept' order by academic_year";       
    }

$qugetspclrgtbl=mysql_query($quegetspclrgtbl);

if(mysql_num_rows($qugetspclrgtbl)!=0){
    echo"<br><font size=3>*** Current Special Call Registration Status ***</font>";
    echo"<table>";
    
    for($f=0;$f < mysql_num_fields($qugetspclrgtbl);$f++){
                $field=mysql_field_name($qugetspclrgtbl,$f);
                        echo "<th> ".ucfirst($field)."</th>";
                                    }
    
    while($qgetspclrgtbl=mysql_fetch_array($qugetspclrgtbl)){
                        $department=$qgetspclrgtbl['department'];
                        $academic_year=$qgetspclrgtbl['academic_year'];
                        $level=$qgetspclrgtbl['level'];
                        $semester=$qgetspclrgtbl['semester'];
                        $end_date=$qgetspclrgtbl['end_date'];
                        $status=$qgetspclrgtbl['status'];
                            if($status==1){
                                $status2="Start";
                            }
                            else{
                                $status2="Stop";
                            }
                        
               echo"<tr class=trbgc align=center><td align=left>&nbsp;&nbsp;".ucfirst($department)."<td>$academic_year<td>$level<td>$semester<td>$end_date<td>$status2";         
                        
    }
    
    echo"</table><br>";
    
    
}











//////////////////////////////////////////////////////////////////////
////////////////// end disp sp_cl_rg tbl /////////////////////////////
//////////////////////////////////////////////////////////////////////




echo"<font size=3>*** Change Special Call Registration Status ***</font>";
include './forms/form_65.php';






?>



<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>
