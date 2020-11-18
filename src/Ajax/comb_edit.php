
<?php

	$std=$_GET['std'];
	$comb=$_GET['comb'];
	

include '../admin/config.php';
     
$con5_a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);
	
require_once('../classes/globalClass.php');
$ac=new settings();   

$crac=$ac->getAcc();
$crsem=$ac->getSemister();
$stlvl=$ac->getLevel($std);
    
$query2="update student set combination='$comb' where id='$std'";
$prev=mysql_query($query2);

if($prev){
    //////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////change course registration////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////
    if(($stlvl==1)&&($crsem==1)){
    
        ////////////////////////delete registration//////////////////////////   
         $quedelprereg="delete from registration where student='$std' and acedemic_year='$crac' and (semister=1 or semister=3)";
         //echo$quedelprereg;
         mysql_query($quedelprereg);
         /////////////////////////////////////////////////////////////////////
            ////////////////////////////////////// confirmed courese unit of lvl1 seme1/////////////////////////////////////////    
                             $quereglsefirst="select distinct c.code,c.semister,c.target_group from courseunit c, combination o, student s , target_group t where o.id=s.combination and s.id='$std' and o.subject=t.subject and t.target_id=c.target_group and c.core='co' and c.level='1' and (c.semister=1 or c.semister=3) and c.availability=1 order by c.code";
                                //echo$quereglsefirst;
                                $qureglsefirst=mysql_query($quereglsefirst);
                                while($qreglsefirst=mysql_fetch_array($qureglsefirst)){
                                
                                            $firstcos=$qreglsefirst['code'];
                                            $firstseme=$qreglsefirst['semister'];
                                            $trgtbp=$qreglsefirst['target_group'];
                                //echo$firstcos.$firstseme.$acy."<br>";
                                if($trgtbp!="12"){
                                    $queinsfirst="insert into  registration(student,course,acedemic_year,semister,degree,confirm) values('$std','$firstcos','$crac',$firstseme,1,1)";
                                    //echo$queinsfirst;
                                    mysql_query($queinsfirst);  
                                        }
                                    else{
                ///////////////////////////////////////////////////////////////////////////////////////////////
                                        $cs="no";
                                        $quegtcs="select c.subject from combination c, student s where s.combination=c.id and s.id='$std'";
                                        $qugtcs=mysql_query($quegtcs);
                                        while($qgtcs=mysql_fetch_array($qugtcs)){
                                                $cmbsubj=$qgtcs['subject'];
                                                if($cmbsubj=="computer_science"){
                                                    $cs="yes";
                                                        }
                                                            }
                                        if($cs=="no"){
                                    $queinsfirst="insert into  registration(student,course,acedemic_year,semister,degree,confirm) values('$std','$firstcos','$crac',$firstseme,1,1)";
                                    //echo$queinsfirst;
                                    mysql_query($queinsfirst);
        
                                                }
        
                ///////////////////////////////////////////////////////////////////////////////////////////////
                                        }
                
                                                                                        }
                                
                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////   
      
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////// end change course registration////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////
    
    

	
$con9_4=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);
	$query8_5="select c.subject as sub from combination c, student s where c.id=s.combination and s.id='$std'";
						
	$std_single=mysql_query($query8_5);
	echo"Current combinations<br>";
    echo '<table border="0" width="30%" align="center">';
	while($data8=mysql_fetch_array($std_single)){
	echo '<tr class=trbgc><td align=left width=20px><li>';
	$sub_name=explode("_",$data8['sub']);
	echo strtoupper($sub_name[0])." ".strtoupper($sub_name[1]);
	echo "</tr>";
	}
	echo "</table>";
	
	
	
}
else{
echo 'Error';
}

//sleep(1);
?>