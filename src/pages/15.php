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
if($qpers['id']=="15"){
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

echo "Manage General Anouncements of Faculty of Humanities and Social Sciences  <hr class=bar><br>";	
						
						if($task=='remove'){
                        $id=$_GET['id'];
                            echo"<table border=0  width=60% class=bgc><tr><td align=center>";
                            echo"<form method=post action='./index.php?view=admin&admin=15&task=rmcnf'>";
                            echo"<font color=red>Do you realy want remove this Announcement ?&nbsp;&nbsp;&nbsp;</font>";
                            echo"<input type=hidden name=rmid value='$id'>";
                            echo"<input type=submit name=cnf value='Yes'>";
                            echo"&nbsp;&nbsp;&nbsp;<input type=submit name=cnf value='No'>";
                            
                            echo"</form></td></tr></table><br>";
                                            }
                        
                        if($task=='rmcnf'){
                        $id=$_POST['rmid'];
                        $bttn=$_POST['cnf'];
                        
                        if($bttn=="Yes"){
                            $query15_1="delete from announcement where id='$id'";
                            $ann_rm=mysql_query($query15_1);
                            
                            echo"<font color='red' >Announcement Removed Succesffly!</font><br><br>";
                                        }
                        else{
                            echo"<font color=red>Removing Canceled!</font><br><br>";
                        }
                                          }
                        
						// Add Announcements
			
						if($task=='add'){
						$title=$_POST['title'];
						$desc=$_POST['desc'];
						
						$query15_2="insert into announcement values(NULL,'$title','$desc')";
						$ann_add=mysql_query($query15_2);
						if($ann_add){
						echo "<font color='red' >Announcement Added Successfully !</font><br><br>";
						include 'forms/form_15.php';
						}
						}
						else
						include 'forms/form_15.php';
						
						
						
						// Removing Announcements
						
						
						
						
						
						
						
						$query15_2="select * from announcement order by id desc";
						$ann=mysql_query($query15_2);
                        if(mysql_num_rows($ann)!=0){
                        echo"<h3>Available Announcement</h3>";
						echo '<table border="0" >';
						while($data=mysql_fetch_array($ann)){
						echo '<tr class=trbgc><td valign="top" align="center">';
						echo "<b><font color=#654225>".$data['title']."</font></b><br>".$data['description']."&nbsp;";
						echo "<br><a href=?view=admin&admin=15&task=remove&id=".$data['id'].">";
						echo "[Click Here to REMOVE This Announcement]</a><br><br>";
						echo '</td></tr>';
						}
						echo '</table>';
						mysql_close($con2);

                        }
?>




<?php
}
}	
else{

echo "You Have Not Permission To Access This Area!";}
?>

