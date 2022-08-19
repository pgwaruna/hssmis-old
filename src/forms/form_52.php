<?php
error_reporting(0);
session_start();
if (($_SESSION['login']) == "truefohssmis") {

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

            if ($qpers['id'] == "52") {
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
        $prntday = date("d");
        $prntdasup = date("S");
        $prntmntnyr = date("M Y");

        require_once('../classes/globalClass.php');
        $vr52f = new settings();

        echo "<div id='c'>";

        echo "<table border='0' width='100%'><tr><td align='left' valign='top'>";
        echo "<form method='POST' action='../index.php?view=admin&admin=52'>";
        echo "<input type='submit' value='Back' id='btnPrint'>";
        echo "</form>";
        echo "</td><td align='right' valign='top'>";
        echo "Printed Date : " . $prntday . "<sup>" . $prntdasup . "</sup> " . $prntmntnyr;
        echo "<input type='button' id='btnPrint' onclick='window.print();' value='Print Page' /></td></tr></table>";

        include '../admin/config.php';
        mysql_connect($host, $user, $pass) or die("Unable to connect Database");
        mysql_select_db($db);


        $prtcode = $_POST['prtcode'];
//////////////////////////////////////////////////
        $prtcode2 = trim($prtcode);
        $prtcode3 = strtoupper($prtcode2);
////////////////////////////////////////////////////
///
        $thurty = array(73,153,233,313,393,473,553,633,713,793,873,953,1033);
        $thurty2 = array(113,193,273,353,433,513,593,673,753,833,913,993,1073);

//////////////////////////////////////////////////
        $prtcodept2 = $_POST['prtcodept'];

        $prtcodept = $vr52f->getdeptname($prtcodept2);

        $prtconame = $_POST['prtconame'];
        $prtcolvl = $_POST['prtcolvl'];
        $prtcosem = $_POST['prtcosem'];
        $getprtcomdm = $_POST['prtcomdm'];
////////////////////////////////////////////////////
        if ($getprtcomdm == "SI") {
            $getcsmdmshw = "Sinhala";
        } elseif ($getprtcomdm == "EN") {
            $getcsmdmshw = "English";
        } elseif ($getprtcomdm == "TA") {
            $getcsmdmshw = "Tamil";
        } elseif ($getprtcomdm == "SI+EN") {
            $getassubbtn = $_POST['assubbtn'];

            if ($getassubbtn == "View Attendance Sheet - Sinhala") {
                $getcsmdmshw = "Sinhala";
                $getprtcomdm = "SI";
            } elseif ($getassubbtn == "View Attendance Sheet - English") {
                $getcsmdmshw = "English";
                $getprtcomdm = "EN";
            } else {
                $getcsmdmshw = "SI+EN";
                $getprtcomdm = "SI+EN";
            }

        } else {
            $getcsmdmshw = $getprtcomdm;
        }
////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////////////
/////////////////////////////rm nx sem ///////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
        /*if($prtcolvl!=1){
        $prtcosem=2;
                }
        else{
        $prtcosem=1;
        }*/
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
        $prtcrtacy = $_POST['prtcrtacy'];


//echo"<table border='0' align='center' width='850px' cellspacing='0' cellpadding='0' bordercolor=#030000'><tr><td>";


/////////////////////...............................................////////////////////////////////////////////
        echo "<table border=0 align='center' width=98%><tr><td align='center' colspan=2><font size='3px'><b>Attendance Sheet - Level $prtcolvl" . "000 and Semester $prtcosem of $prtcrtacy Academic Year</b></font></td></tr>";
        echo "<tr><td align='center' colspan=2><font size='3px'><b>" . ucfirst($prtcodept) . "</b></font></td></tr>";
        echo "<tr><td align='center' width=50% colspan=2><font size='3px'><b>Course Unit </font></b><font size='3px'><b>- " . $prtcode3 . "</b> ( $prtconame.,<i> in $getcsmdmshw Medium</i> )</font></td></tr>";
        echo "<tr><td><font size='3px'><b>Name of the lecturer : </b> ........................................... </td><td align='right'><b>Type : </b>........................</font></td></tr>";
        echo "<tr><td><font size='3px'><b>Date : </b> .................... </td><td align='right'><b>Time : </b>........................</font></td></tr>";

        echo "</table>";
        echo "<br>";
/////////////////////...............................................////////////////////////////////////////////


        echo "<table border=0 align='center' width=95% >
        <tr>
            <td align='left' valign='top' width='50%'>";////////////two td tbl


        echo "<table border='1' cellspacing='0' cellpadding='0' width=95%>
            <tr height='30px'>
                <td width='5%' align='center'>NO</td>
                <td width='30%'   align='center'>NAME WITH INITIALS</td>
                <td width='30%' align='center'>STUDENT NUMBER</td>
                <td width='30%' align='center'>SIGNATURE</td>
            </tr>";

///////////////////////////check reg on/off/////////////////////////////////
        $queregst = "select register from call_registration where level=$prtcolvl";
        $quregst = mysql_query($queregst);
        $qregst = mysql_fetch_array($quregst);
        $regst = $qregst['register'];
//////////////////////////////////////////////////////////////////////////
        $fmviweque = "$rmsdb.fohssmisStudents fs";
        if (($prtcolvl == 1) && ($prtcosem == 1)) {
            ///////////////////////////check reg on/off/////////////////////////////////
            $quecmbregst = "select status from call_combination";
            $qucmbregst = mysql_query($quecmbregst);
            $qcmbregst = mysql_fetch_array($qucmbregst);
            $cmbregst = $qcmbregst['status'];
            //////////////////////////////////////////////////////////////////////////

            if ($cmbregst == 1) {
                $jonque = "$rmsdb.fohssmis u";
                $queprtatn = "select distinct r.student, u.l_name, u.initials from registration r, $jonque, $fmviweque where u.user=r.student and r.course ='$prtcode' and r.acedemic_year='$prtcrtacy' and r.student=fs.user_name order by u.user";

                $newst = "yes";
            } else {
                $queprtatn = "select distinct r.student, s.l_name, s.initials, s.batch from registration r, student s, $fmviweque  where s.id=r.student and r.course = '$prtcode' and r.acedemic_year='$prtcrtacy' and r.student=fs.user_name and r.confirm=1 and s.medium='$getprtcomdm' order by r.student";
            }
        } else {
            if ($regst == 1) {
                $queprtatn = "select distinct r.student, s.l_name, s.initials, s.batch from registration r, student s, $fmviweque where s.id=r.student and r.course = '$prtcode' and r.acedemic_year='$prtcrtacy' and r.student=fs.user_name and s.medium='$getprtcomdm'  order by r.student";
            } else {
                $queprtatn = "select distinct r.student, s.l_name, s.initials, s.batch from registration r, student s, $fmviweque where s.id=r.student and r.course = '$prtcode' and r.acedemic_year='$prtcrtacy' and r.student=fs.user_name and r.confirm=1 and s.medium='$getprtcomdm'  order by r.student";
            }

        }


        //echo$queprtatn;
        $quprtatn = mysql_query($queprtatn);
        $i = 1;
        $co = 1;
        while ($qprtatn = mysql_fetch_array($quprtatn)) {
            $student = $qprtatn['student'];

            $stprmtnum = $vr52f->getStudentNumber($student);
            if ($stprmtnum == null) {
                $fulstno = "HS/$batch/$student";
            } else {
                $fulstno = $stprmtnum;
            }

            $batch = $qprtatn['batch'];
            $l_name = $qprtatn['l_name'];
            $initials = $qprtatn['initials'];

            echo "<tr height='30px'>
                    <td align='center'><font size='2.5px'>$i</font></td>
                    <td><font size='2.5px'>&nbsp;&nbsp;$l_name &nbsp;$initials</font></td>
                    <td align='center'><font size='2.5px'>$fulstno</font></td>
                    <td>&nbsp;</td>
                </tr></font>";

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            if ($i == 36) {

                echo "</table></td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                    <td align='right' valign='top' width='50%'>";

                echo "<table border='1' cellspacing='0' cellpadding='0' width=95%>
                    <tr>
                        <td width='5%' align='center'>NO</td>
                        <td width='30%' align='center'>NAME WITH INITIALS</td>
                        <td width='30%' align='center'>STUDENT NUMBER</td>
                        <td width='30%' align='center'>SIGNATURE</td>
                    </tr>";

            }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            if (in_array($i, $thurty)) {

                echo "</table></td></tr></table>";
                echo '<p style="page-break-after: always">';
                echo "<table border='0' align='center' width=95% >
                <tr>
                    ";////////////two td tbl
                        echo "<tr>
                           <td align='left' valign='top' width='50%'>";

                        echo "<table border=1 cellspacing='0' cellpadding='0' width=95%>
                            <tr height='30px'>
                                <td width='5%' align='center'>NO</td>
                                <td width='30%' align='center'>NAME WITH INITIALS</td>
                                <td width='30%' align='center'>STUDENT NUMBER</td>
                                <td width='30%' align='center'>SIGNATURE</td>
                             </tr>";
            }

            if (in_array($i, $thurty2)) {

                echo "</table></td><td>&nbsp;&nbsp;&nbsp;</td>
                <td align='right' valign='top' width='50%'>";

                echo "<table border='1' cellspacing='0' cellpadding='0' width=95%>
                    <tr height='30px'>
                        <td width='5%' align='center'>NO</td>
                        <td width='30%' align='center'>NAME WITH INITIALS</td>
                        <td width=30% align='center'>STUDENT NUMBER</td>
                        <td width=30% align='center'>SIGNATURE</td>
                    </tr>";
            }
            
            $i = $i + 1;
            echo "</p>";
            $co++;
        }//main while
        

        echo "</table>";
        echo "</td></tr></table>";
        
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

