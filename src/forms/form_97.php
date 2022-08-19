<?php
//error_reporting(0);
session_start();
$curriculum = intval($_SESSION['curriculum']);
if ((isset($_SESSION['login']) == "truefohssmis") && ($_SESSION['role'] != "student")) {

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

            if ($qpers['id'] == "97") {
                $pem = "TRUE";
            }

        }
    } else {
        echo "You Have Not Permission To Access This Area!";
    }

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
        echo "<div id='c'>";

        echo "<table border='0' width='100%'><tr><td align='left' valign='top'>";
        echo "<form method='POST' action='../index.php?view=admin&admin=97'>";
        echo "<input type='submit' value='Back' id='btnPrint'>";
        echo "</form>";
        echo "</td><td align='right' valign='top'>";
        echo "<input type='button' id='btnPrint' onclick='window.print();' value='Print Page' /></td></tr></table>";

        include '../admin/config.php';
        mysql_connect($host, $user, $pass) or die("Unable to connect Database");
        mysql_select_db($db);


        require_once('../classes/globalClass.php');
        $vr97f = new settings();

        $prtcode = $_POST['prtcode'];
/////////////////////////////////////////////////////
        $coursegetchr = trim($prtcode);

        $fulcode = strtoupper($coursegetchr);

////////////////////////////////////////////////////
        $prtcode2 = $fulcode;
        $prtcodept = $_POST['prtcodept'];
        $prtconame = $_POST['prtconame'];
        $prtcolvl = $_POST['prtcolvl'];
        $prtcosem = $_POST['prtcosem'];
        $prtcomdm = $_POST['prtcomdm'];
        $prtcrtacy = $_POST['prtcrtacy'];
        $submitbtt = $_POST['subbutton'];


        $getshtdate = $_POST['shtdate'];
        $getshttme = $_POST['shttme'];
        $getshtcntr = $_POST['shtcntr'];
        $getshtfstno = $_POST['shtfstno'];
        $getshtlstno = $_POST['shtlstno'];


        if ($prtcomdm == "SI+EN") {
            $divsbbtnm = explode(" ", $submitbtt);
            $prtmdm = $divsbbtnm[3];
            if ($prtmdm == "English") {
                $prtcomdm = "EN";
            } else {
                $prtcomdm = "SI";
            }
        } else {
            if ($prtcomdm == "SI") {
                $prtmdm = "Sinhala";
            } elseif ($prtcomdm == "EN") {
                $prtmdm = "English";
            } elseif ($prtcomdm == "TA") {
                $prtmdm = "Tamil";
            } else {
                $prtmdm = $prtcomdm;
            }

        }


//echo$prtcode2.$prtconame.$prtcodept.$prtcolvl.$prtcosem.$prtcrtacy.$submitbtt;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////// design start mrk sht////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//echo"<div align=center><font size=3px><b>".strtoupper("Examination Registarions")."<br> $prtcode2 ($prtconame) in $prtmdm Medium at $prtcrtacy Academic year and semester $prtcosem </b></font></div><br><br>";

        $exmnm4mrksht = "BA (General/Special ) degree $prtcolvl" . "000 level semester $prtcosem examination $prtcrtacy academic year";


        echo "<div align=center><font size=3px><b>
									UNIVERSITY OF RUHUNA<br>
									Faculty of Humanities and Social Sciences<br>
									ATTENDANCE SHEET and DETAILED MARK SHEET (Proper/Repeat)
</b></font></div><br>";
        echo "<table border=0 width=98%  align=center>";
        echo "<tr height=30px><td width=20%><font size=3px>Name of Examination <td><font size=3px>: $exmnm4mrksht";
        echo "<tr height=30px><td><font size=3px>Course Code <td><font size=3px>: $prtcode2";
        echo "<tr height=30px><td><font size=3px>Title <td><font size=3px>: $prtconame ( in $prtmdm Medium )";
        echo "</table>";


        echo "<table border=0 width=98%  align=center>";
        echo "<tr height=30px><td width=50%><font size=3px>Part :<td><font size=3px>Date : $getshtdate";
        echo "<tr height=30px><td width=20%><font size=3px>Centre : $getshtcntr<td><font size=3px>Time : $getshttme";
        echo "<tr height=40px><td colspan=2 align=justify>The Supervisor is kindly requested to mark absentees clearly as ''ABSENT'' and ''√'' for those who are present in two copies. A separate copy should include signatures of students. The copy with signatures of students should be returned in a separate cover to the Senior Assistant Registrar of the faculty and the other two copies need to be enclosed in the relevant packet of answer scripts..";
        echo "</table>";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////// student list ////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if (($getshtfstno == null) || ($getshtlstno == null)) {
            $quegtexreg = "select e.std_id,e.course_type,e.status,s.l_name, s.initials,s.batch from exam_registration e, student s where e.std_id=s.id and e.course_code='$prtcode' and e.academic_year='$prtcrtacy' and e.semester=$prtcosem and s.medium='$prtcomdm' and s.curriculum='$curriculum' order by e.std_id ";

        } else {
            $getdvfstnum = explode("/", $getshtfstno);
            $dvfstnum = "hs" . $getdvfstnum[2];


            $getdvlstnum = explode("/", $getshtlstno);
            $dvlstnum = "hs" . $getdvlstnum[2];

            $quegtexreg = "select e.std_id,e.course_type,e.status,s.l_name, s.initials,s.batch from exam_registration e, student s where e.std_id BETWEEN '$dvfstnum' AND '$dvlstnum' and e.std_id=s.id and e.course_code='$prtcode' and e.academic_year='$prtcrtacy' and e.semester=$prtcosem and s.medium='$prtcomdm' and s.curriculum='$curriculum' order by e.std_id ";


        }
//echo$quegtexreg;
        $qugtexreg = mysql_query($quegtexreg);

        if (mysql_num_rows($qugtexreg) == 0) {
            echo "<p align=center><font color=red size=3px>Sorry ! There are no registered student to this course unit for examination.</font></p><br>";

        } else {
            echo "<table border=1 align=center cellspacing=0 cellspadding=0 width=98%><tr height=30px align=center>";
            $i = 1;

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
            echo "<td rowspan=2 width=3%>S.NO";
            echo "<td rowspan=2 width=15%>INDEX NO";
            echo "<td rowspan=2 width=10%> ATTENDANCE";
            echo "<td rowspan=2 width=6%>Q1";
            echo "<td rowspan=2 width=6%>Q2";
            echo "<td rowspan=2 width=6%>Q3";
            echo "<td rowspan=2 width=6%>Q4";
            echo "<td rowspan=2 width=6%>Q5";
            echo "<td rowspan=2 width=6%>Q6";
            echo "<td rowspan=2 width=6%>Q7";
            echo "<td rowspan=2 width=6%>Q8";
            echo "<td width=8%>TOTAL";
            echo "<td width=8%>&nbsp;";

            echo "<tr align=center><td>TOTAL<td>Out of 60";
////////////////////////////////////////////////////////
////////////////////////////////////////////////////////


            while ($qgtexreg = mysql_fetch_array($qugtexreg)) {
                $student = $qgtexreg['std_id'];
                $batch = $qgtexreg['batch'];
                $stprmtnum = $vr97f->getStudentNumber($student);
                if ($stprmtnum == null) {
                    $deacStudent = substr($student, 2);
                    $fulstno = "HS/$batch/$deacStudent";
                    $stuStatus = "Deactivated";
                } else {
                    $fulstno = $stprmtnum;
                    $stuStatus = "";
                }


                $degree = $qgtexreg['course_type'];

                $confirm = $qgtexreg['status'];

                if ($confirm == 2) {
                    $confirm2 = "NE";
                } else {
                    $confirm2 = null;
                }

                /*
                        $l_name=$qgtexreg['l_name'];
                        $initials=$qgtexreg['initials'];

                        $name=strtoupper($initials)." ".strtoupper($l_name);
                */


                echo "<tr height=25px><td align=center>$i<td align=center><font size=3px>$fulstno</font>";
                echo "<td>&nbsp;&nbsp;$confirm2$stuStatus";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
                $i++;

                if ($i == 31) {
                    $j = 1;
                    echo "</table><font size=1><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* NE : Not Eligible</font><br><br>";
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
                    echo "<table border=0 width=98%  align=center>";
                    echo "<tr height=40px><td width=53%><font size=3px>Sig. of Supervisor :........................";
                    echo "<td><font size=3px>Name of Examiner :...................................................";


                    echo "<tr height=40px><td width=20%><font size=3px>Sig. of Invigilator(s) 1 :.................. 2 :................... 3 :.................";
                    echo "<td><font size=3px>Signature of Examiner :..................... Date :................";
                    echo "</table>";
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////	


                    echo '<p style="page-break-before: always">';


                    echo "<br><table border=1 align=center cellspacing=0 cellspadding=0 width=98%><tr height=30px align=center>";
//$i=1;

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
                    echo "<td rowspan=2 width=3%>S.NO";
                    echo "<td rowspan=2 width=15%>INDEX NO";
                    echo "<td rowspan=2 width=10%> ATTENDANCE";
                    echo "<td rowspan=2 width=6%>Q1";
                    echo "<td rowspan=2 width=6%>Q2";
                    echo "<td rowspan=2 width=6%>Q3";
                    echo "<td rowspan=2 width=6%>Q4";
                    echo "<td rowspan=2 width=6%>Q5";
                    echo "<td rowspan=2 width=6%>Q6";
                    echo "<td rowspan=2 width=6%>Q7";
                    echo "<td rowspan=2 width=6%>Q8";
                    echo "<td width=8%>TOTAL";
                    echo "<td width=8%>&nbsp;";

                    echo "<tr align=center><td>TOTAL<td>Out of 60";
////////////////////////////////////////////////////////
////////////////////////////////////////////////////////	
                }


                $trty5md = $j % 40;
                if (($trty5md == 0) && ($i > 41)) {
                    echo "</table><font size=1><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* NE : Not Eligible</font><br><br>";
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
                    echo "<table border=0 width=98%  align=center>";
                    echo "<tr height=40px><td width=53%><font size=3px>Sig. of Supervisor :........................";
                    echo "<td><font size=3px>Name of Examiner :...................................................";


                    echo "<tr height=40px><td width=20%><font size=3px>Sig. of Invigilator(s) 1 :.................. 2 :................... 3 :.................";
                    echo "<td><font size=3px>Signature of Examiner :..................... Date :................";
                    echo "</table>";
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////	


                    echo '<p style="page-break-before: always">';


                    echo "<br><table border=1 align=center cellspacing=0 cellspadding=0 width=98%><tr height=30px align=center>";
//$i=1;

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
                    echo "<td rowspan=2 width=3%>S.NO";
                    echo "<td rowspan=2 width=15%>INDEX NO";
                    echo "<td rowspan=2 width=10%> ATTENDANCE";
                    echo "<td rowspan=2 width=6%>Q1";
                    echo "<td rowspan=2 width=6%>Q2";
                    echo "<td rowspan=2 width=6%>Q3";
                    echo "<td rowspan=2 width=6%>Q4";
                    echo "<td rowspan=2 width=6%>Q5";
                    echo "<td rowspan=2 width=6%>Q6";
                    echo "<td rowspan=2 width=6%>Q7";
                    echo "<td rowspan=2 width=6%>Q8";
                    echo "<td width=8%>TOTAL";
                    echo "<td width=8%>&nbsp;";

                    echo "<tr align=center><td>TOTAL<td>Out of 60";
////////////////////////////////////////////////////////
////////////////////////////////////////////////////////	


                }


                $j++;

            }// student listmain while closs
            for ($ex = 1; $ex <= 3; $ex++) {
                echo "<tr height=25px>";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
                echo "<td>&nbsp;";
            }


            echo "</table><font size=1><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* NE : Not Eligible</font><br>";
        }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////// end student list ////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
        echo "<table border=0 width=98%  align=center>";
        echo "<tr height=40px><td width=53%><font size=3px>Sig. of Supervisor :........................";
        echo "<td><font size=3px>Name of Examiner :...................................................";


        echo "<tr height=40px><td width=20%><font size=3px>Sig. of Invigilator(s) 1 :.................. 2 :................... 3 :.................";
        echo "<td><font size=3px>Signature of Examiner :..................... Date :................";
        echo "</table>";
////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////


        echo "</p>";

        echo "<div>";
        ?>


        <?php
    } else {

        echo "You Have Not Permission To Access This Area!";
    }


} else {

    echo "You Have Not Permission To Access This Area!";
}

?>

