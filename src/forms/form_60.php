<?php
//error_reporting(0);
session_start();
$role=$_SESSION['role'];
if((($_SESSION['login'])=="truefohssmis")&&($_SESSION['role']!="student")){

include'../connection/connection.php';


$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
//echo $querole;
$qurole=mysql_query($querole);

if($qurole!=NULL)
{
while($qrole=mysql_fetch_array($qurole)){
$roleid=$qrole['role_id'];
}

$quepers="SELECT id FROM permission WHERE role_id=$roleid";
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


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
@media print {
input#btnPrint {
display: none;
}
}
</style>
<style type="text/css">
@import url('../css/blackfont.css');
</style>

<?php
include'../admin/config.php';
mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);


echo"<div id='c'>";
$spstfno=$_POST['spstfno'];
$spstchoice=$_POST['spstchoice'];
$sumdate=$_POST['spstsumdt'];
$role=$_SESSION['role'];

require_once('../classes/globalClass.php');
$n=new settings();

$ststrm=$n->getstream($spstfno);
    if($ststrm=="phy"){
        $ststrmfull="Physical Science";
    }
    elseif ($ststrm=="bio") {
        $ststrmfull="Bio Science";
    }
    else{
        $ststrmfull="Computer science";
    }
$spstnm=$n->getName($spstfno);
$spstbt=$n->getBatch($spstfno);


echo"<table border='0' width='100%'><tr><td align='left' valign='top'>";
echo"<form method='POST' action='../index.php?view=admin&admin=60&task=selctdept&due=view'>";
echo"<input type='submit' value='Back' id='btnPrint'>";
if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
$sedept=$_SESSION['chkdept'];
echo"<input type=hidden name='sedept' value='$sedept'>";
}
else{
$sedept=$_SESSION['section'];
  }
echo"</form>";
echo"</td><td align='right' valign='top'>";
echo "<input type='button' id='btnPrint' onclick='window.print();' value='Print Page' /></td></tr></table>";



//echo$spstfno.$spstchoice.$sedept;
$quegetadd="select * from student_personal_detais where stno='SC/$spstbt/$spstfno'";
    $qugetadd=mysql_query($quegetadd);
    while($qgetadd=mysql_fetch_array($qugetadd)){

echo"<table border=0 width=85% align=center><td align=left  width=20%>"; 
echo"<table border=1 cellspacing=0 width=100%><tr><td align=center>SC/$spstbt/$spstfno</tr></table>";
echo"<td align=center>&nbsp;";
echo"<td align=right width=20%><table border=1 cellspacing=0  width=100%><tr><td align=center>$ststrmfull</tr></table>";
echo"</table>";



echo"<table border=0 align=center width=95%>";
      

echo"<tr><td colspan=3 align=center><h3>FORM OF APPLICATION<br>SPECIAL SCIENCE DEGREE COURSE- FACULTY OF SCIENCE<br>UNIVERSITY OF RUNUNA</h3>";

echo"<tr><td width=2%>1.&nbsp;&nbsp;&nbsp;<td  width=25%>Name with Initials <td>: ".strtoupper($spstnm);

echo"<tr><td>2.&nbsp;&nbsp;&nbsp;<td>Postal Address <td>: ";
    
            $padd1=$qgetadd['padd1'];
            $padd2=$qgetadd['padd2'];
            $padd3=$qgetadd['padd3'];
            $padd4=$qgetadd['padd4'];
            
            echo$padd1;
        echo"<tr><td colspan=2>&nbsp;<td>&nbsp;&nbsp;$padd2";
        echo"<tr><td colspan=2>&nbsp;<td>&nbsp;&nbsp;$padd3";
        echo"<tr><td colspan=2>&nbsp;<td>&nbsp;&nbsp;$padd4";


echo"<tr><td>3.&nbsp;&nbsp;&nbsp;<td>Date of Birth <td>: ";

        $dob=$qgetadd['dob'];
        //$dob="1982-09-12";
            echo$dob;


echo"<tr><td valign=top>4.&nbsp;&nbsp;&nbsp;<td>Age as at closing date of application <td>: ";

            require_once('../classes/getage.php');
            ////////////////////////chk application call status/////////////////////
	    $quechkstat="select end_data from call_special_registration";
	    $quchkstat=mysql_query($quechkstat);
	    if(mysql_num_rows($quchkstat)!=0){
		while ($qchkstat=mysql_fetch_array($quchkstat)) {
		   
		    $enddate=$qchkstat['end_data'];
		}
		
		
	    }
	    ////////////////////////////////////////////////////////////////////////
            
            
            //$age=_date_diff(strtotime($dob), strtotime($enddate));
            $age=_date_diff(strtotime($enddate), strtotime($dob));
    
                    $years=$age['y'];
                    $months=$age['m'];
                    $days=$age['d'];
            echo"Year : ".$years." , Month : ".$months." , Days : ".$days;



echo"<tr><td valign=top>5.&nbsp;&nbsp;&nbsp;<td>National Identity Card No <td>: ";

             $nic=$qgetadd['nic'];

                echo$nic;


echo"<tr><td valign=top>6.&nbsp;&nbsp;&nbsp;<td>Contact No <td>: ";

        $tel_home=$qgetadd['tel_home'];
        $tel_mobile=$qgetadd['tel_mobile'];

        echo"$tel_home , $tel_mobile";


echo"<tr><td valign=top>7.&nbsp;&nbsp;&nbsp;<td>Educational Qualipications <td>&nbsp; ";
                $olindex=$qgetadd['olindexno'];
                if($olindex==null){
                    $olindex="Can't Find";
                }
                $olyear=$qgetadd['olyear'];
                

echo"<tr><td valign=top>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td>7.1.&nbsp;&nbsp;&nbsp; G.C.E (O/L)<td>: Index No : $olindex &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [ year : $olyear ] ";


echo"<tr><td valign=top>&nbsp;<td colspan=2 align=center>";

                        $mathematics=$qgetadd['mathematics'];
                         $science=$qgetadd['science'];
                         $buddhism=$qgetadd['buddhism'];
                         $soc_s_n_history=$qgetadd['soc_s_n_history'];
                         $sinhala=$qgetadd['sinhala'];
                         $engilsh=$qgetadd['engilsh'];
                         
                            $art_sub=$qgetadd['art_sub'];
                            $art_sub_grd=$qgetadd['art_sub_grd'];
                            
                            $other_sub1=$qgetadd['other_sub1'];
                            $other_sub1_grd=$qgetadd['other_sub1_grd'];
                                                                                   
                            $other_sub2=$qgetadd['other_sub2'];
                            $other_sub2_grd=$qgetadd['other_sub2_grd'];
                            
                            $other_sub3=$qgetadd['other_sub3'];
                            $other_sub3_grd=$qgetadd['other_sub3_grd'];
                            
                            $other_sub4=$qgetadd['other_sub4'];
                            $other_sub4_grd=$qgetadd['other_sub4_grd'];
                                          
                            $other_sub5=$qgetadd['other_sub5'];
                            $other_sub5_grd=$qgetadd['other_sub5_grd'];



                                    echo"<table border=1 align=center cellspadding=0 cellspacing=0 width=70%><th width=40%>Subject<th width=10%>Grade<th width=40%>Subject<th width=10%>Grade";
                                    echo"<tr><td>1. Mathematics<td align=center>&nbsp;$mathematics<td>7. &nbsp;$art_sub<td align=center>&nbsp;$art_sub_grd";
                                   
                                   
                                    echo"<tr><td>2. Science<td align=center>&nbsp;$science<td>8. &nbsp;$other_sub1<td align=center>&nbsp;$other_sub1_grd";
                                    
                                    
                                    echo"<tr><td>3. Buddhism<td align=center>&nbsp;$buddhism<td>9. &nbsp;$other_sub2<td align=center>&nbsp;$other_sub2_grd";
                                    
                                    
                                    echo"<tr><td>4. Sinhala<td align=center>&nbsp;$sinhala<td>10. &nbsp;$other_sub3<td align=center>&nbsp;$other_sub3_grd";
                                    
                                    
                                    echo"<tr><td>5. Engilsh<td align=center>&nbsp;$engilsh<td>11. &nbsp;$other_sub4<td align=center>&nbsp;$other_sub4_grd";
                                    
                                    
                                    echo"<tr><td>6. Soc.s & History<td align=center>&nbsp;$soc_s_n_history<td>12. &nbsp;$other_sub5<td align=center>&nbsp;$other_sub5_grd";
                                    
                                    echo"</table><br>";


                $alindex=$qgetadd['alindexno'];
                if($alindex==null){
                    $alindex="Can't Find";
                }
                $alyear=$qgetadd['alyear'];


echo"<tr><td valign=top>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td>7.2.&nbsp;&nbsp;&nbsp; G.C.E (A/L)<td>: Index No : $alindex &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [ year : $alyear ] ";

echo"<tr><td valign=top>&nbsp;<td colspan=2 align=center>";


                                $physics=$qgetadd['physics'];
                                $chemistry =$qgetadd['chemistry'];
                                $com_maths=$qgetadd['com_maths'];
                                $biology=$qgetadd['biology'];
                                $gen_english=$qgetadd['gen_english'];
                                $addi_subject=$qgetadd['addi_subject'];
                                $add_sub_grd=$qgetadd['add_sub_grd'];
                                $zscore=$qgetadd['zscore'];
                                $gtmarks=$qgetadd['gtmarks'];
                                //$=$qgetadd[''];
                                  
                            echo"<table border=1 align=center cellspadding=0 cellspacing=0><th>Subject<th>Grade";
                                echo"<tr><td>1. Physics<td align=center>&nbsp;$physics";
                                echo"<tr><td>2. Chemistry<td align=center>&nbsp;$chemistry";
                                echo"<tr><td>3. Combind Mathematics<td align=center>&nbsp;$com_maths";
                                echo"<tr><td>4. Biology<td align=center>&nbsp;$biology";
                                echo"<tr><td>5. &nbsp;$addi_subject<td align=center>&nbsp;$add_sub_grd";
                                echo"<tr><td>6. Gen. English<td align=center>&nbsp;$gen_english";
                                echo"<tr><td>7. Z-Score<td align=center>&nbsp;$zscore";
                                echo"<tr><td>8. Gen. Test Marks<td align=center>&nbsp;$gtmarks";
                            echo"</table><br>";
        

echo"<tr><td valign=top>8.&nbsp;&nbsp;&nbsp;<td>Details of Results <td>&nbsp; ";
echo"<tr><td valign=top align=center colspan=3><font size=3px>General Science Degree Result with Gradings</font><br>";
echo"<table border=0 width=99%><tr><td align=center valign=top width=50%>";
    echo"Level 1 Semester I  ";
    ///////////////////////////////////////////////////////result display l1 se1/////////////////////////////////////////////////////////////
                $quegetl1s1reslt="select r.subject,r.grade,r.year,c.name from results r, courseunit c where r.index_number='$spstfno' and c.level=1 and c.semister=1 and r.subject=c.code order by r.subject,r.year";
                $qugetl1s1reslt=mysql_query($quegetl1s1reslt);
                echo"<table border=1 cellspadding=0 cellspacing=0><th>Course unit<th>Course Name<th>Year<th>Grade";
                $recose="nil";
                while($qgetl1s1reslt=mysql_fetch_array($qugetl1s1reslt)){
                          $subject=$qgetl1s1reslt['subject'];
                          ///////////////////////////////////////////////////////////////////////
                          ///////////////////////////////////////////////////////////////////////
                            $coursegetchr=trim($subject);
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
                
                            $spstressub=strtoupper($ccdwoutcrd.$credit);
                          ///////////////////////////////////////////////////////////////////////
                          ///////////////////////////////////////////////////////////////////////
                          $grade=$qgetl1s1reslt['grade'];
                          $year=$qgetl1s1reslt['year'];             
                          $cname=$qgetl1s1reslt['name'];              
                                  //echo$spstressub.$grade.$year."<br>";
                           if($recose!=$coursegetchr){
                            echo"<tr><td align=center>$spstressub<td>$cname<td align=center>&nbsp;$year <td align=center>$grade</tr>";    
                           }
                           else{
                               echo"<tr class=trbgc><td align=center colspan=2>Repeat Attempt [ $spstressub - $cname  ]<td align=center>&nbsp;$year<td align=center>$grade</tr>"; 
                               
                           }
                            
                            $recose=$coursegetchr;
                            
                        
                    
                }
                    echo"</table><br>";
    //////////////////////////////////////////////////////////////////////////////////////////////////
echo"<td align=center valign=top>";
 echo"Level 1 Semester II  ";
 //////////////////////////////////////////////// display result l1 se 2////////////////////////////////////////////////
 ///////////////////////////////////////////////////////result display/////////////////////////////////////////////////////////////
                $quegetl1s1reslt2="select r.subject,r.grade,r.year,c.name from results r, courseunit c where r.index_number='$spstfno' and c.level=1 and (c.semister=2 or c.semister=3) and r.subject=c.code order by r.subject,r.year";
                $qugetl1s1reslt2=mysql_query($quegetl1s1reslt2);
                echo"<table border=1 cellspadding=0 cellspacing=0><th>Course unit<th>Course Name<th>Year<th>Grade";
                $recose2="nil";
                while($qgetl1s1reslt2=mysql_fetch_array($qugetl1s1reslt2)){
                          $subject2=$qgetl1s1reslt2['subject'];
                          ///////////////////////////////////////////////////////////////////////
                          ///////////////////////////////////////////////////////////////////////
                            $coursegetchr2=trim($subject2);
                            $ccdwoutcrd2=substr("$coursegetchr2", 0, -1);
                            $getchar2 = preg_split('//', $coursegetchr2, -1);
                
                                    $credit2=$getchar2[7];
                                    if(($credit2=="a")||($credit2=="A")){
                                        $credit2="&#945;";
                                            }
                                    elseif(($credit2=="b")||($credit2=="B")){
                                        $credit2="&#946;";
                                                }
                                    elseif(($credit2=="d")||($credit2=="D")){
                                        $credit2="&#948;";
                                                }
                                    else{
                                        $credit2=$credit2;
                                        }
                
                            $spstressub2=strtoupper($ccdwoutcrd2.$credit2);
                          ///////////////////////////////////////////////////////////////////////
                          ///////////////////////////////////////////////////////////////////////
                          $grade2=$qgetl1s1reslt2['grade'];
                          $year2=$qgetl1s1reslt2['year'];             
                          $cname2=$qgetl1s1reslt2['name'];              
                                  //echo$spstressub.$grade.$year."<br>";
                           if($recose2!=$coursegetchr2){
                            echo"<tr><td align=center>$spstressub2<td>$cname2<td align=center>&nbsp;$year2 <td align=center>$grade2</tr>";    
                           }
                           else{
                               echo"<tr class=trbgc><td align=center colspan=2>Repeat Attempt [ $spstressub2 - $cname2  ]<td align=center>&nbsp;$year2<td align=center>$grade2</tr>"; 
                               
                           }
                            
                            $recose2=$coursegetchr2;
                            
                        
                    
                }
                    echo"</table><br>";
    //////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
 
 
 
 
 
 
 
 
 
echo"</tr></table>"; 




echo'<p style="page-break-before: always">';


echo"<table border=0 width=99%><tr><td align=center valign=top width=50%>";
echo"<caption>General Science Degree Result with Gradings</caption>";
echo"<tr><td align=center valign=top>";
 echo"Level 2 Semester I  ";
 //////////////////////////////////////////////// display result l2 se 1////////////////////////////////////////////////
 ///////////////////////////////////////////////////////result display/////////////////////////////////////////////////////////////
                $quegetl1s1reslt21="select r.subject,r.grade,r.year,c.name from results r, courseunit c where r.index_number='$spstfno' and c.level=2 and c.semister=1 and r.subject=c.code order by r.subject,r.year";
                $qugetl1s1reslt21=mysql_query($quegetl1s1reslt21);
                echo"<table border=1 cellspadding=0 cellspacing=0><th>Course unit<th>Course Name<th>Year<th>Grade";
                $recose21="nil";
                while($qgetl1s1reslt21=mysql_fetch_array($qugetl1s1reslt21)){
                          $subject21=$qgetl1s1reslt21['subject'];
                          ///////////////////////////////////////////////////////////////////////
                          ///////////////////////////////////////////////////////////////////////
                            $coursegetchr21=trim($subject21);
                            $ccdwoutcrd21=substr("$coursegetchr21", 0, -1);
                            $getchar21 = preg_split('//', $coursegetchr21, -1);
                
                                    $credit21=$getchar21[7];
                                    if(($credit21=="a")||($credit21=="A")){
                                        $credit21="&#945;";
                                            }
                                    elseif(($credit21=="b")||($credit21=="B")){
                                        $credit21="&#946;";
                                                }
                                    elseif(($credit21=="d")||($credit21=="D")){
                                        $credit21="&#948;";
                                                }
                                    else{
                                        $credit21=$credit21;
                                        }
                
                            $spstressub21=strtoupper($ccdwoutcrd21.$credit21);
                          ///////////////////////////////////////////////////////////////////////
                          ///////////////////////////////////////////////////////////////////////
                          $grade21=$qgetl1s1reslt21['grade'];
                          $year21=$qgetl1s1reslt21['year'];             
                          $cname21=$qgetl1s1reslt21['name'];              
                                  //echo$spstressub.$grade.$year."<br>";
                           if($recose21!=$coursegetchr21){
                            echo"<tr><td align=center>$spstressub21<td>$cname21<td align=center>&nbsp;$year21 <td align=center>$grade21</tr>";    
                           }
                           else{
                               echo"<tr class=trbgc><td align=center colspan=2>Repeat Attempt [ $spstressub21 - $cname21  ]<td align=center>&nbsp;$year21<td align=center>$grade21</tr>"; 
                               
                           }
                            
                            $recose21=$coursegetchr21;
                            
                        
                    
                }
                    echo"</table><br>";
    //////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
 
 
 
 
 
 
 
 
 
 
 
echo"<td align=center valign=top>";
 echo"Level 2 Semester II  ";
 
 //////////////////////////////////////////////// display result l2 se 2////////////////////////////////////////////////
 
             /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
echo"<table border=1 cellspadding=0 cellspacing=0><th>Course unit<th>Course Name<th>Year<th>Grade";              
                            $quege22cos="select r.course,c.name from registration r, courseunit c where r.student='$spstfno' and r.course=c.code and r.confirm=1 and c.level=2 and (c.semister=2 or c.semister=3) order by r.course";
		            $quge22cos=mysql_query($quege22cos);
		            if(mysql_num_rows($quge22cos)!=0){
				while($qge22cos=mysql_fetch_array($quge22cos)){
						$cose=$qge22cos['course'];
			///////////////////////////////////////////////////////////////////////
                          ///////////////////////////////////////////////////////////////////////
                            $coursegetchr22=trim($cose);
                            $ccdwoutcrd22=substr("$coursegetchr22", 0, -1);
                            $getchar22 = preg_split('//', $coursegetchr22, -1);
                
                                    $credit22=$getchar22[7];
                                    if(($credit22=="a")||($credit22=="A")){
                                        $credit22="&#945;";
                                            }
                                    elseif(($credit22=="b")||($credit22=="B")){
                                        $credit22="&#946;";
                                                }
                                    elseif(($credit22=="d")||($credit22=="D")){
                                        $credit22="&#948;";
                                                }
                                    else{
                                        $credit22=$credit22;
                                        }
                
                            $spstressub222=strtoupper($ccdwoutcrd22.$credit22);
                          ///////////////////////////////////////////////////////////////////////
                          ///////////////////////////////////////////////////////////////////////
                            			$cname=$qge22cos['name'];
                            
//////////////////check result//////////////////////////											
///////////////////////////////////////////////////////result display/////////////////////////////////////////////////////////////
                $quegetl1s1reslt22="select subject,grade,year from results  where index_number='$spstfno' and subject='$coursegetchr22' order by subject,year";
                $qugetl1s1reslt22=mysql_query($quegetl1s1reslt22);
               
                $recose22="nil";
                if(mysql_num_rows($qugetl1s1reslt22)!=0){
                while($qgetl1s1reslt22=mysql_fetch_array($qugetl1s1reslt22)){
                          $subject22=$qgetl1s1reslt22['subject'];
                          $grade22=$qgetl1s1reslt22['grade'];
                          $year22=$qgetl1s1reslt22['year'];             
                                      
                          
                           if($recose22!=$subject22){
                            echo"<tr><td align=center>$spstressub222<td>$cname<td align=center>&nbsp;$year22 <td align=center>$grade22</tr>";    
                           }
                           else{
                               echo"<tr class=trbgc><td align=center colspan=2>Repeat Attempt [ $spstressub222 - $cname  ]<td align=center>&nbsp;$year22<td align=center>$grade22</tr>"; 
                               
                           }
                            
                            $recose22=$subject22;
                            
                        
                    
                								}
                					}
		else{

		echo"<tr><td align=center>$spstressub222<td>$cname<td align=center>&nbsp;<td align=center>&nbsp;</tr>";

		}


///////////////end chek result/////////////////////////
									}    
										
						}
			else{
			 echo"<tr><td align=center colspan=4>Not Register for Course Unit for this Semester </tr>"; 
				}				
										
										
										                        
                 /////////////////////////////////////////////////////////////////////////////////           
                       
                    echo"</table><br>";
    //////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
echo"</table>";

echo"<tr><td valign=top>9.&nbsp;&nbsp;&nbsp;<td>Proficiency in English Examination <td>&nbsp; ";

echo"<tr><td valign=top align=center colspan=3>&nbsp;";
    
    echo"<table border=1 cellspadding=0 cellspacing=0 width=70%><th>Level<th>Pass/Fail<th>Year";
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $quegetengres="select id, grade , year from results where subject='ENG1201' and index_number='$spstfno' order by id";
    $qugetengres=mysql_query($quegetengres);
    if(mysql_num_rows($qugetengres)!=0){
        $engrept="nil";
    while($qgetengre=mysql_fetch_array($qugetengres)){
                $engid=$qgetengre['id'];
                $engl1=$qgetengre['grade'];
                $engl1yr=$qgetengre['year'];
                if($engrept!= $engid){
                    echo"<tr><td align=center >Level I&nbsp;&nbsp;&nbsp;[ ENG1201 ]<td align=center>&nbsp;$engl1<td align=center>&nbsp;$engl1yr";      
                }
                else{
                    echo"<tr><td align=center class=trbgc >Repeat Attempt (Level I&nbsp;&nbsp;&nbsp;[ ENG1201 ] )<td align=center>&nbsp;$engl1<td align=center>&nbsp;$engl1yr";
                }
                
                                                        }
    }
    else{
            echo"<tr><td align=center>Level I<td align=center>Fail<td>&nbsp;";
        }
   ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
   
   
   //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $quegetengres2="select id, grade , year from results where subject='ENG2201' and index_number='$spstfno' order by id";
    $qugetengres2=mysql_query($quegetengres2);
    if(mysql_num_rows($qugetengres2)!=0){
        $engrept2="nil";
    while($qgetengre2=mysql_fetch_array($qugetengres2)){
                $engid2=$qgetengre2['id'];
                $engl2=$qgetengre2['grade'];
                $engl1yr2=$qgetengre2['year'];
                if($engrept2!= $engid2){
                    echo"<tr><td align=center >Level II&nbsp;&nbsp;&nbsp;[ ENG2201 ]<td align=center>&nbsp;$engl2<td align=center>&nbsp;$engl1yr2";      
                }
                else{
                    echo"<tr><td align=center class=trbgc >Repeat Attempt (Level II&nbsp;&nbsp;&nbsp;[ ENG2201 ] )<td align=center>&nbsp;$engl2<td align=center>&nbsp;$engl1yr2";
                }
                
                                                        }
    }
    else{
            echo"<tr><td align=center>Level II<td>&nbsp;<td>&nbsp;";
        }
   ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
   
   
    echo"<tr><td align=center>Level III<td>&nbsp;<td>&nbsp;";
    echo"</table><br>";



echo"<tr><td valign=top coalspan=3>&nbsp;";

echo"<tr><td valign=top>10.&nbsp;&nbsp;&nbsp;<td valign=top>Other Qualifications <td>: ";
        $quegtotherquli="select other_qulipi from special_registration where stno='$spstfno'";
        $qugtotherquli=mysql_query($quegtotherquli);
        $qgtotherquli=mysql_fetch_array($qugtotherquli);
        
        $therquli=$qgtotherquli['other_qulipi'];
        
        echo$therquli;



echo"<tr><td valign=top>11.&nbsp;&nbsp;&nbsp;<td>Principal Subject <td>:";

                        if($spstchoice=="choice_one"){
                                $spstchoice2="First Choice";
                            
                        }
                        else if($spstchoice=="choice_two"){
                                $spstchoice2="Second Choice";
                            
                        }
                        else{
                            $spstchoice2="Third Choice";
                        }


                    echo" ".strtoupper($sedept)." as a ".strtoupper($spstchoice2);



echo"<tr><td valign=top>12.&nbsp;&nbsp;&nbsp;<td>Submitted Date <td>: $sumdate";


echo"<tr><td valign=top coalspan=3>&nbsp;&nbsp;&nbsp;";















///////////////////////////////////////2nd page////////////////////////////////////////////////////////







echo"</p>";






echo"</table>";





    }/////////////////////personal infor while if close

?>






<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}

?>
