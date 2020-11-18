<script type="text/javascript" src="Ajax/per_edit.js"></script>

Roles and Permission<hr class=bar>
<!--						
Manage New User Roles<br />
<form method="post" action="index.php?view=admin&admin=33">
Role (without spaces):<input type="text" name="role" name"role" size="12">&nbsp;&nbsp;&nbsp;
Name :<input type="text" name="role_name" name"role_name" size="12">
<input type="submit" value="submit" name="submit">
</form>
<br /> Add New Role -->

<font size=3px>*** View User Roles ***</font><br />

<?php
if(isset($_POST['submit'])){

$role=$_POST['role'];
$role_name=$_POST['role_name'];


$query2="insert into $rmsdb.role values(NULL,'$role','$role_name')";
$prev=mysql_query($query2);

if($prev){
echo "Role Added Succesfully<br />";
}
}


		
$query33="select * from $rmsdb.role where role_id<>1";
$r_details=mysql_query($query33);
echo '<table border="0" align="center" width=70%><tr><th>Role ID<th>Role<th>Name<th>Host';
echo"<tr class='trbgc'><td align='center'>1<td align='center'>SUPPER ADMIN<td>RUMIS ADMINISTRATOR<td align='center'>RUMIS</tr>";
while($data=mysql_fetch_array($r_details)){
echo "<tr class='trbgc'><td align='center'>".$data['role_id']."<td align='center'><a href=index.php?view=admin&admin=33&per=".$data['role_id'].">".$data['role']."</a><td>".$data['Name']."<td align='center'>";
if($data['host']=="local"){
    echo"RUMIS";
    
}
else{
    echo"<b>FOHSSMIS</b>";
}


}
echo "</table>";

require_once('classes/globalClass.php');		
$m=new settings();	
echo "<hr class=bar>";

		if(isset($_GET['per'])){
		$role_id=$_GET['per'];
		echo "Permission Table for Role ID - ".$role_id=$_GET['per'];
echo "<hr class=bar>";
			
		$query8_4="select distinct id, description from permission order by id";
		$perm=mysql_query($query8_4);
		echo "<table border=1 cellspacing=0><th>Permi. Id<th>Permission Name<th>Status";
		while($data=mysql_fetch_array($perm)){
												
		echo "<tr><td align=center>".$data['id']."<td>&nbsp;&nbsp;".$data['description']."<td align=center>";
		$per_id=$data['id'];
		$status=$m->getPer($role_id, $per_id);
		echo "<div id=div-".$role_id."-".$per_id.">";
		if(($status)==1)
		echo '<img src=images/r.png>&nbsp;&nbsp;&nbsp;&nbsp;';
		elseif(($status)==0)
		echo '<img src=images/w.png>&nbsp;&nbsp;&nbsp;&nbsp;';
		// Change
		?>
		<img src=images/conf.png id="img-<?php echo $role_id; ?>-<?php echo $per_id; ?>" onclick="changeper(<?php echo $role_id; ?>,<?php echo $per_id; ?>,<?php echo $status;?>)"></div>
		<?php 
		}
		echo "</table>";
		}


?>
