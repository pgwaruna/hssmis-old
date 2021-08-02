<?php
//error_reporting(0);
session_start();
if (($_SESSION['login']) == "truefohssmis") {
    include '../connection/connection.php';

    $role = $_SESSION['role'];
    $pem = "FALSE";
    $querole = "select role_id from $rmsdb.role where role='$role'";
//echo $querole;
    $qurole = mysql_query($querole) or die(mysql_error());

    if ($qurole != NULL) {
        while ($qrole = mysql_fetch_array($qurole)) {
            $roleid = $qrole['role_id'];
        }
//echo$qpers['id'];
        $quepers = "SELECT id FROM permission WHERE role_id =$roleid";
//echo $quepers;
        $qupers = mysql_query($quepers);

        while ($qpers = mysql_fetch_array($qupers)) {
            if ($qpers['id'] == "48") {
                $pem = "TRUE";

            }
        }
    } else {
        echo "You Have Not Permission To Access This Area!";
    }

    if ($pem == "TRUE") {
        ?>
        <!--////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////////-->
        <?php


//////////////////remove this comment to procied exam registration prosses///////////////////////


        $stno = $_SESSION['user_id'];
//$stno="hs15617";
        require_once('./classes/globalClass.php');
        $n = new settings();

//...............get acc_year....................
        $acyart = $n->getAcc();
//.................................................			

//...........get semester..........
        $seme = $n->getSemister();
//.................................................	

//............get st level...........................
        $stlvl = $n->getLevel($stno);
//..................................................

//............get st medium...........................
        $stmdm = $n->getmedium($stno);
//..................................................


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        $task = $_GET['task'];

        $stno = $_SESSION['user_id'];
//$stno="hs15617";
        $rept = "nil";

        $queeddt = "select * from call_exam_registration where level=$stlvl";

        $queddt = mysql_query($queeddt);
        while ($qeddt = mysql_fetch_array($queddt)) {
            $clsdt = $qeddt['closing_date'];
            $stat = $qeddt['status'];
            $exac_year = $qeddt['acc_year'];
            $exac_seme = $qeddt['semester'];

        }


        echo "Exam Registration Unit";
        echo "<hr class=bar>";


////////////////////exam registration prosses////////////////////////
        if ($task == "exregis") {
            error_reporting(0);
            $exccode = $_POST['coscode'];
            $exdgrest = $_POST['dgrest'];
            $exsbmdm = $_POST['sbmdm'];
            if ($exsbmdm == "English") {
                $exsbmdm2 = $exsbmdm;
            } else {
                $exsbmdm2 = null;
            }


//echo$exccode.$exdgrest."<br>";
            $ye = date('Y');
            $queinsexreg = "insert into exam_registration(std_id,course_code,academic_year,semester,course_type,status,rqs_exm_medium) values('$stno','$exccode','$exac_year',$exac_seme,'$exdgrest',1,'$exsbmdm2')";
//echo$queinsexreg;
            mysql_query($queinsexreg);


        }
////////////////////////////////////////////////////////////////////


/////////////////////exam subject registration calcel//////////////////////// 
        if ($task == "exregicancel") {
            $exrgid = $_POST['exregid'];
            $quedelexreg = "delete from exam_registration where id=$exrgid";
            mysql_query($quedelexreg);

        }
////////////////////////////////////////////////////////////////////////////


        echo "<br>Examination Registration for $exac_year Academic year and Semester $exac_seme in $stmdm Medium<br>";

        if ($stat == "1") {

            echo "Do Modification On or Before :<font color='red'> $clsdt</font><br><br>	";

//            $querqexco = "select r.course, r.degree, r.confirm, c.name from registration r, courseunit c, student s where r.student='$stno' and r.student=s.id and s.curriculum=c.by_low_version and r.acedemic_year='$acyart' and r.semister=$seme and r.course=c.code and r.confirm=1 order by r.course";

            if ($seme == 1) {
                $querqexco = "select r.course, r.degree, r.confirm, c.name from registration r, courseunit c, student s where r.student='$stno' and r.student=s.id and s.curriculum=c.by_low_version and r.acedemic_year='$acyart' and r.semister=$seme and r.course=c.code and r.confirm=1 order by r.course";
            } else {
                $querqexco = "select r.course, r.degree, r.confirm, c.name from registration r, courseunit c, student s where r.student='$stno'  and r.student=s.id and s.curriculum=c.by_low_version and r.acedemic_year='$acyart' and (r.semister=$seme or r.semister=3) and r.course=c.code and r.confirm=1 order by r.course";
            }
            $qurqexco = mysql_query($querqexco);

            if (mysql_num_rows($qurqexco) != 0) {
                $exmtblrw = 1;
                echo "<table border='0' width='90%'><tr>";
                echo "<th>#<th>Courses Code</th><th>Courses Name</th><th>Degree Status</th><th>Current Status</th><th>Submit as</th></tr>";


                while ($qrqexco = mysql_fetch_array($qurqexco)) {
                    $ccode2 = $qrqexco['course'];
                    $coursegetchr = trim($ccode2);
                    $ccode3 = strtoupper($coursegetchr);


////////////////////////////////////////////////////////////////////////////////////////
                    $ccode = strtoupper($ccode2);
                    $cname = $qrqexco['name'];
                    $degre = $qrqexco['degree'];

                    if ($degre == "Non Degree") {
                        $stexmrgcstyp = "Non Degree Course-(6)";
                    } else {
                        $stexmrgcstyp = $n->getcostype($coursegetchr, $stno);
                    }


//$cnfm=$qrqexco['confirm'];

                    $quechkexregi = "select * from exam_registration where std_id='$stno' and course_code='$ccode'and academic_year='$acyart' and semester=$seme and course_type='$stexmrgcstyp'";
                    $quchkexregi = mysql_query($quechkexregi);
                    if (mysql_num_rows($quchkexregi) != 0) {
                        while ($qchkexregi = mysql_fetch_array($quchkexregi)) {
                            $id = $qchkexregi['id'];
                            $rqs_exm_medium = $qchkexregi['rqs_exm_medium'];
                            if ($rqs_exm_medium == "English") {
                                $rqs_exm_medium2 = " ( In English Medium )";
                            } else {
                                $rqs_exm_medium2 = null;
                            }

                        }

                        echo "<form method=POST action='./index.php?view=admin&admin=48&task=exregicancel'>";
                        echo "<tr class=selectbg><td align='center'>$exmtblrw<td align='center'>$ccode3</td><td>" . ucfirst($cname) . " $rqs_exm_medium2</td><td align='center'>$stexmrgcstyp</td>";
                        echo "<td align='center'><font color=blue>Registered !</font></td>";
                        echo "<td align='center'><input type=hidden name=exregid value=$id><input type=submit name=exregidel value=Cancel></td></tr>";
                        echo "</form>";


                    } else {
                        echo "<form method=POST action='./index.php?view=admin&admin=48&task=exregis'>";
                        echo "<tr class=trbgc><td align='center'>$exmtblrw<td align='center'>$ccode3<input type=hidden name=coscode value=$ccode></td>";
                        echo "<td>" . ucfirst($cname);
//                        if ($stlvl == 1) {
//                            echo " ( In <select name=sbmdm>";
//                            echo "<option value='Sinhala' selected>Sinhala</option>";
//                            echo "<option value='English'>English</option>";
//                            echo "</select> Medium )";
//                        }

                        echo "</td><td align='center'>$stexmrgcstyp<input type=hidden name=dgrest value='$stexmrgcstyp'></td></td>";
                        echo "<td align='center'><font color=red>Not Registered !</font></td>";
                        echo "<td align='center'><input type=submit name=exregister value=Register></td></tr>";
                        echo "</form>";
                    }
                    $exmtblrw++;

                }


                echo "</table>";
            }//num of rows not zero
///////////////////////////////////////////////////////////////////////////
///////////for passout student/////////////////////////////////////////////
            else {
                if ($stlvl != 0) {
                    echo "<font color=red>Sorry! Can not find your Course Registration Details <br>( You are not register for course unit in this semester, Cantact Dean office. )</font> ";
                }
                //echo"You are passout Student!";


            }
//////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////


/////////////////////////repeate exam registration////////////////////////////////////

            if ($stlvl != 1) {

                echo "<br><br>*** Incomplete Course Unit Registration *** ";


                if ($stlvl != 0) {

                    if ($seme == 1) {
//                        $quecoreg = "select r.course, r.degree, c.name from registration r,courseunit c where r.student='$stno' and r.semister=1 and r.confirm=1 and r.acedemic_year<>'$acyart' and r.course=c.code order by r.acedemic_year,r.semister,r.course";
                        $quecoreg = "select r.course, r.degree, c.name from registration r,courseunit c,student s where r.student='$stno' and r.student=s.id and r.semister=1 and r.confirm=1 and r.acedemic_year<>'$acyart' and r.course=c.code and c.by_low_version=s.curriculum order by r.acedemic_year,r.semister,r.course";
//                        echo '1_quecoreg '.$quecoreg;
                    } else {
                        $quecoreg = "select r.course,r.degree,c.name from registration r,courseunit c where r.student='$stno' and (r.semister=2 or r.semister=3) and r.confirm=1 and r.acedemic_year<>'$acyart' and r.course=c.code order by r.acedemic_year,r.semister,r.course";
//                        echo '2_quecoreg '.$quecoreg;
                    }
                } else {
                    if ($seme == 1) {
                        $quecoreg = "select r.course, r.degree, c.name from registration r,courseunit c where r.student='$stno' and r.semister=1 and r.confirm=1 and r.course=c.code order by r.acedemic_year,r.semister,r.course";
//                        echo '3_quecoreg '.$quecoreg;
                    } else {
                        $quecoreg = "select r.course,r.degree,c.name from registration r,courseunit c where r.student='$stno' and (r.semister=2 or r.semister=3) and r.confirm=1 and  r.course=c.code order by r.acedemic_year,r.semister,r.course";
//                        echo '4_quecoreg '.$quecoreg;
                    }

                }





                $qucoreg = mysql_query($quecoreg);
                if (mysql_num_rows($qucoreg) != 0) {

                    echo "<table border='0' width='90%'><tr>";
                    echo "<th>#<th>1Courses Code</th><th>Courses Name</th><th>Degree Status</th><th>Current Status</th><th>Submit as</th></tr>";
                    $colum = 0;
                    $rprexmrgrw = 1;
                    while ($qcoreg = mysql_fetch_array($qucoreg)) {
                        $rptcoreg2 = $qcoreg['course'];
                        $rptcoursegetchr = trim($rptcoreg2);
                        $rptcoreg3 = strtoupper($rptcoursegetchr);


                        $rptcname = $qcoreg['name'];
                        $rgdgstatus = $qcoreg['degree'];


                        $stexmrgcstyp = $n->checkrepeat($stno, $rptcoursegetchr);

                        if ($stexmrgcstyp == "yes") {
                            if ($rgdgstatus == "Non Degree") {
                                $rptstexmrgcstyp = "Non Degree Course-(6)";
                            } else {
                                $rptstexmrgcstyp = $n->getcostype($rptcoursegetchr, $stno);
                            }
                            $rept = "yes";
                            $colum = $colum + 1;
                            //echo$coreg."---".$dgstas."...".$gtreslt."==".$gpavl."<br>";
                            $quechkexregi = "select * from exam_registration where std_id='$stno' and course_code='$rptcoursegetchr'and academic_year='$acyart' and semester=$seme and course_type='$rptstexmrgcstyp'";
                            //echo$quechkexregi;
                            $quchkexregi = mysql_query($quechkexregi);
                            if (mysql_num_rows($quchkexregi) != 0) {
                                while ($qchkexregi = mysql_fetch_array($quchkexregi)) {
                                    $id = $qchkexregi['id'];
                                }

                                echo "<form method=POST action='./index.php?view=admin&admin=48&task=exregicancel'>";
                                echo "<tr class=selectbg><td align='center'>$rprexmrgrw<td align='center'>$rptcoreg3</td><td>" . ucfirst($rptcname) . "</td><td align='center'>$rptstexmrgcstyp</td>";
                                echo "<td align='center'><font color=blue>Registered !</font></td>";
                                echo "<td align='center'><input type=hidden name=exregid value=$id><input type=submit name=exregidel value=Cancel></td></tr>";
                                echo "</form>";


                            } else {
                                echo "<form method=POST action='./index.php?view=admin&admin=48&task=exregis'>";
                                echo "<tr class=selectbg4><td align='center'>$rprexmrgrw<td align='center'>$rptcoreg3<input type=hidden name=coscode value=$rptcoursegetchr></td><td>" . ucfirst($rptcname) . "</td>";
                                echo "<td align='center'>$rptstexmrgcstyp<input type=hidden name=dgrest value='$rptstexmrgcstyp'></td></td>";
                                echo "<td align='center'><font color=red>Not Registered !</font></td>";
                                echo "<td align='center'><input type=submit name=exregister value=Register></td></tr>";
                                echo "</form>";
                            }

                            $rprexmrgrw++;
                        }


                    }//while
                    if ($colum == 0) {
                        echo "<tr class=selectbg4><td align='center' colspan=6>You have no repeate subject !</td></td>";
                    }


                    echo "</table>";


                }//query if
                else {
                    echo "<font color='red'>Sorry ! Can not find subject registration details.</font><br>";
                }


            }


//////////////////////////////////////////////////////////////////////////////////////

        }//main if
        else {

//echo"end closing date";

            $quegtexreg = "select er.* ,c.name,c.level from exam_registration er,courseunit c where er.std_id='$stno' and er.academic_year='$exac_year' and er.semester=$exac_seme and er.course_code=c.code order by c.level, er.course_code,c.level";

            $qugtexreg = mysql_query($quegtexreg);
            if (mysql_num_rows($qugtexreg) != 0) {
                $exmrptrw = 1;
                echo "<br><table border='0' width='90%'><tr>";
                echo "<th>#<th>Courses Code</th><th>Courses Name</th><th>Degree Status</th><th>Eligibility Status</th></tr>";
                while ($qgtexreg = mysql_fetch_array($qugtexreg)) {
                    $courseaf = $qgtexreg['course_code'];
                    $coursegetchr = trim($courseaf);
                    $fulcode = strtoupper($coursegetchr);
                    $afexregcourse = $fulcode;

                    $degree = $qgtexreg['course_type'];


                    $confirm = $qgtexreg['status'];
                    if ($confirm == 0) {
                        $confirm1 = "Pending !";
                    } elseif ($confirm == 2) {
                        $confirm1 = "<font color='red'>Not Eligible</font>";
                    } else {
                        $confirm1 = "<font color='Blue'>Eligible</font>";

                    }

                    $excosname = $qgtexreg['name'];
                    $excoslevel = $qgtexreg['level'];

                    $stactlvl = $n->getLevel($stno);
                    //////////////////////////////////////// medical check ///////////////////////////////////////////////////
                    $quechkmedi = "select status from exam_medical where student='$stno' and course='$coursegetchr' and academic_year='$exac_year' and semester=$exac_seme";
                    $quchkmedi = mysql_query($quechkmedi);
                    ///////////////////////////////////////// end medical check //////////////////////////////////////////////


                    echo "<tr class=trbgc><td align='center'>$exmrptrw<td align='center'>$afexregcourse</td><td>" . ucfirst($excosname);


                    $gtrqs_exm_medium = $qgtexreg['rqs_exm_medium'];
                    if ($gtrqs_exm_medium == "English") {
                        echo " ( In English Medium )";
                    }


                    if ($excoslevel < $stactlvl) {
                        echo "<font color=red> ( ** Re Attempt ** )</font>";
                    }


                    echo "<td align='center'>$degree</td><td align='center'>$confirm1";
                    if (mysql_num_rows($quchkmedi) != 0) {
                        while ($qchkmedi = mysql_fetch_array($quchkmedi)) {
                            $chkmedistat = $qchkmedi['status'];
                        }
                        echo "<font color=red>[ * Your Medical is $chkmedistat.*]</font>";

                    }


                    echo "</td></tr>";
                    $exmrptrw++;
                }
                echo "</table>";

            } else {

                echo "<br><font color='red'>Sorry! You have not registered to the Examination.</font><br><br>";
//	}


            }


        }
        /*}//// lvl !=1 if close
        else{
           echo"<font color=red>Sorry! Exam registration temporary not available for you.</font>";
        }*/
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        ?>


        <?php
    } else {

        echo "You Have Not Permission To Access This Area!";
    }


} else {

    echo "You Have Not Permission To Access This Area!";
}
?>

