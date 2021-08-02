<?php
//error_reporting(0);
session_start();
//if((($_SESSION['login'])=="truefohssmis")&&($_SESSION['role']!="student")){
if ((($_SESSION['login']) == "truefohssmis")) {

    include '../connection/connection.php';

    $role = $_SESSION['role'];
    $pem = "FALSE";
    $querole = "select role_id from $rmsdb.role where role='$role'";
//echo $querole;
    $qurole = mysql_query($querole);

    if ($qurole != NULL) {
        while ($qrole = mysql_fetch_array($qurole)) {
            $roleid = $qrole['role_id'];
        }

        $quepers = "SELECT id FROM permission WHERE role_id=$roleid";
//echo $quepers;
        $qupers = mysql_query($quepers);

        while ($qpers = mysql_fetch_array($qupers)) {

            if ($qpers['id'] == "47") {
                $pem = "TRUE";
            }

        }
    } else {
        echo "You Have Not Permission To Access This Area!";
    }

    $pem = "TRUE";

    if ($pem == "TRUE") {
        ?>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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

        require_once('../classes/attClass.php');
        require_once('../classes/globalClass.php');

        $m = new attendence();
        $n = new settings();
////////////////////////////////////course units in both semesters///////////////////////////////////////////
        $bothsemcourse = array();
        $bothsemcourse[0] = "ENG1101";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////// theory and practical course unit///////////////////////////////////////////
        $tnpcourse = array();
        $tnpcourse[0] = "COM311B";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


        $prntday = date("d");
        $prntdasup = date("S");
        $prntmntnyr = date("M Y");

        $pntdt47 = "<font size=1px>Printed Date : " . $prntday . "<sup>" . $prntdasup . "</sup> " . $prntmntnyr . "</font>";
//echo$pntdt47;

        echo "<div id=c>";
        echo "<table border='0' width='100%'><tr><td align='left' valign='top'>";
        echo "<form method='POST' action='../index.php?view=admin&admin=47'>";
        echo "<input type='submit' value='Back' id='btnPrint'>";
        echo "</form>";
        echo "</td><td align='right' valign='top'>";
        echo "<input type='button' id='btnPrint' onclick='window.print();' value='Print Page' /></td></tr></table>";

        $task = $_GET['task'];
        $onestyr = $_POST['byear'];
        $onestno = $_POST['exstno'];
        $gplevel = $_POST['admission'];
        $curriculum = intval($_SESSION['curriculum']);
//echo$onestyr.$onestno.$gplevel.$task;

        include '../admin/config.php';
        mysql_connect($host, $user, $pass) or die("Unable to connect Database");
        mysql_select_db($db);

//...............get acc_year....................
        $acy = $n->getAcc();
//.................................................


//...........get semester..........
        $cseme = $n->getSemister();
//.................................................


        error_reporting(0);
        $ye = date('Y');
        $studentNumber = null;

        if ($task == "oneadd") {

            $userId = $_SESSION['user_id'];

            if($roleid === 6){
                $studentNumber = $onestno;
            }else{
                $studentNumber = "hs".$onestno;
            }

            $quecknum = "select batch, stream  from student where id='$studentNumber'";

            $qucknum = mysql_query($quecknum);

            if (mysql_num_rows($qucknum) != 0) {
                $qcknum = mysql_fetch_array($qucknum);
                $stbyear = $qcknum['batch'];
                $ststrmlng = $qcknum['stream'];

//                if ($stbyear == $onestyr) {

                    //echo"HS/$onestyr/$onestno";
                    $admisid = $onestno;
                    //echo$admisid."<br>";
                    $stno4gtlvl = "hs" . $admisid;
                    $stleve = $n->getLevel($stno4gtlvl);

                    $examname = "BA (General/Special ) degree $stleve" . "000 level semester $cseme examination $acy academic year";
/////////////////..........................................................////////////////////////////////

                    $queckexreg = "select course_code from exam_registration where academic_year='$acy' and semester=$cseme and std_id='$studentNumber'";

                    $quckexreg = mysql_query($queckexreg);
                    if (mysql_num_rows($quckexreg) != 0) {
                        //echo"student ".$admisid."<br>";
//////////////////////////////////////////////////////////////////////////////////////////


                        $name = $n->getName($admisid);
                        $batch = $n->getBatch($admisid);
                        echo '<p style="page-break-after: always">';

                        include 'form_47_ADM.php';

                        echo "</p>";

                        //...............................................................
                    } else {
                        echo "<div align=center><font color=red size=3px>The student HS/$stbyear/$admisid is not register for the examimation<br><br></font></div>";

                    }
                    //...............................................................

////////////////////////////////////////////////////////////////////////////////////////////

//                } else {
//                    echo "Invalid Student Number";
//                }

            } else {
                echo "Invalid User Name";
            }

        }//one add if close


//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
/////////////////////////gp admission/////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////


        if ($task == "gpadd") {
            $curriculum = $_POST['curriculum'];

            $stream_8_2 = $_POST['stream_8_2'];
            if ($stream_8_2 != "all") {
                $quesubvr = "[" . $stream_8_2 . "]";
            }

            $level_8_2 = $_POST['level_8_2'];
            if ($level_8_2 == 0) {
                $admprtlvl = "1000/2000/3000/4000 level";
            } else {
                $admprtlvl = $level_8_2 . "000  level";
            }


            $degree_8_2 = $_POST['degree_8_2'];

            if ($degree_8_2 == "All") {
                $degrevar = "(s.stream='General' or s.stream='Special')";
            } else {
                $degrevar = "s.stream='$degree_8_2'";
            }
/////////////////////////////////////////////////////////////////////////////////////////////
            $fmviweque = "$rmsdb.fohssmis fs";
            if ($stream_8_2 == "all") {
                $quegtstfomlvl = "select s.id from student s, level l, $fmviweque where l.level='$level_8_2' and l.year=s.year and s.id=fs.user and $degrevar order by s.id";
            } else {
                $quegtstfomlvl = "select s.id from student s, level l, $fmviweque where l.level='$level_8_2' and l.year=s.year and s.combination LIKE '%$quesubvr%'  and $degrevar and s.id=fs.user order by s.id";
            }
/////////////////////////////////////////////////////////////////////////////////////////////	


            $gtgplvlnum = $level_8_22;


            $examname = "BA (General/Special ) degree $admprtlvl semester $cseme examination $acy academic year";


            /*
            if($gtgplvlnum!=0){
                $quegtstfomlvl="select distinct(r.student) from registration r,student s,level l where l.level=$gtgplvlnum and l.year=s.year and s.id=r.student order by r.student";
            }
            else{
            $quegtstfomlvl="select distinct(r.student) from registration r,student s,level l where l.level=0 and (l.year >= s.year) and s.id=r.student order by r.student";
            }
            */


//echo$quegtstfomlvl;
            $qugtstfomlvl = mysql_query($quegtstfomlvl);
            if (mysql_num_rows($qugtstfomlvl) == 0) {
                echo "<br><div align=center><font color=red size=3px>Sorry! Cannot find information according to search!</font></div><br>";
            } else {

                while ($qgtstfomlvl = mysql_fetch_array($qugtstfomlvl)) {
                    $creaxmrg = array();
                    $xidx = 0;
                    $admisid2 = $qgtstfomlvl['id'];
                    $admisid = substr($admisid2, 2);
                    //echo$admisid."<br>";


                    $stleve = $n->getLevel($admisid);

                    /////////77777777777777777777777777777777777777777777777777777
                    $name = $n->getName($admisid);
                    $batch = $n->getBatch($admisid);

                    echo '<p style="page-break-after: always">';
                    include 'form_47_ADM.php';
                    echo "</p>";
                    /////////77777777777777777777777777777777777777777777777777777


                }//main while
            }
        }//gpadd if close


        echo "</div>";
        ?>


        <?php
    } else {

        echo "You Have Not Permission To Access This Area!";
    }


} else {

    echo "You Have Not Permission To Access This Area!";
}

?>
