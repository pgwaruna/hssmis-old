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
      
 echo"<form method='POST' action='./index.php?view=admin&admin=65&task=stsprg'>";
?>


<div align="center">
<table border="0" width="65%" class=bgc>
<tr>
    <td>Select Department<td>:
        
        <?php
         echo"<select name=stspdept>";
            
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
    
    
        ?>
        
 <tr><td>
Academic Year 
<td>: 
    
    
<?php     
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
////////////////////  Select List of Accedemic Year for register  ///////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

echo"<select name=stspacyr>";    

/*if($dept=="all"){
    
}
else{
    $quegetspacyear="select distinct academic_year from sp_academic_status where department='$dept2' order by academic_year";
}
*/   
                 echo"<option value='$backacyr'>$backacyr</option>";
                echo"<option value='$gen_cr_ac_yr' selected>$gen_cr_ac_yr</option>";
                echo"<option value='$nextacyr'>$nextacyr</option>";
                
echo"</select>";   
     
     
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
     
?>       
        
        
        
<tr>
    <td>Select Student's Level<td>: 
            <select name=stsplvl>
                <option value='0'>All</option>
                <option value='1'>1</option>
                <option value='2'>2</option>
         </select>
    
    
</tr>    
    
    
    
<tr>
<td width=30%>
Academic Semester  
<td>: 
<select size="1" name="stspsem">
<option selected value="1">Semester 01</option>
<option value="2">Semester 02</option>
</select>



</select>
<tr><td>Closing Date 
<td>: 
    <span id="date1">
    <input type="text" name="sprgeddt" size="20">
    <span class="textfieldRequiredMsg"><font size="-1"> Enter the Closing Date</font></span>
    <span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>
    </span>
<tr><td>Register Progress  
<td>:   
    
<select name=stspclnor>
    <option value='nor' selected>Normal</option>
    <option value='ext'>Extra</option>
</select>    
    
    
<select size="1" name="sprgstus">
    <option value="1" selected>Start</option>
    <option value="0">Stop</option>

</select>



<tr><td colspan="2" align=center><input type="submit" value="Submit" name="submit">
</p>
</form> 
</table><br>


</div>


















<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>
