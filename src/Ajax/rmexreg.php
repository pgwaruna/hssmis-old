<?php
include '../admin/config.php';
$con40=mysql_connect($host,$user,$pass) or die("Unable to connect Database");
mysql_select_db($db);

$rmcourseid=$_GET['rmcourseid'];

        $quedtexrg="select * from  exam_registration where id='$rmcourseid'";
        $qudtexrg=mysql_query($quedtexrg);
           while($qdtexrg=mysql_fetch_array($qudtexrg)){
               $student=$qdtexrg['student'];
               $course2=$qdtexrg['course'];
                    $course=$course2."-exm_reg";
               $acedemic_year=$qdtexrg['acedemic_year'];
               $semester=$qdtexrg['semester'];
               $degree=$qdtexrg['degree'];
               $confirm=$qdtexrg['confirm'];
               
               
               $queinsrereg="insert into remove_reg(student,course,academic_year,semester,degree,status) values('$student','$course','$acedemic_year',$semester,$degree,$confirm)";
               //echo$id.$queinsrereg;
               mysql_query($queinsrereg);
               
               
           }

$quedelexreg="delete from exam_registration where id='$rmcourseid'";
mysql_query($quedelexreg);


echo"<font color=red>Successfully Removed!</font>";





		



?>
