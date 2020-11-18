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
if($qpers['id']=="53"){
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
	$ntsusrnm=$_SESSION['user_id'];
?>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////// Text Editor /////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="./editers/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : 			"autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
       

 theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
        

theme_advanced_buttons2 : "bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,insertdate,inserttime,|,forecolor,backcolor",
        

theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,advhr,|,print,|,ltr,rtl,|,fullscreen",
        

theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,spellchecker,|,insertfile,insertimage",
       


 theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Example content CSS (should be your site CSS)
        content_css : "css/example.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
});
</script>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////// End text editor ////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


<script type="text/javascript">
function checkaddtl(a)
{
	 
	if (a.nottitle.value==""){
 	alert("Please Enter a Title for this Notice.");
	a.nottitle.focus();
 	return false;}
	 
	  
 }


</script>















<?php
echo"Manage Notices";
echo"<hr class=bar>";
echo"<h3>*** Upload Notice From File ***</h3>";
include'./forms/form_53.php';
//////////////////////////// file upload /////////////////////////////////////

if($task=="upnote"){
$upfltitle=$_POST['upfltitle'];
$target_path = "./downloads/Notices/";
//error_reporting(0);
$dt=date("ymdHis");

$target_path = $target_path.$dt."-". basename( $_FILES['uploadedfile']['name']); 


if($dd=move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) 
{	
	$filename=$dt."-".basename( $_FILES['uploadedfile']['name']);
	echo $filename;
	chmod($target_path, 0777);
		
	
		
	//echo "uploads/".$target_path."<br>";
			
	//include 'Excel_Upload/Regi_Detail_UP.php';
		//////////////////////////////////////////////////////////////////////////
		$dnt=date("Y-m-d/H:i");
		
		$queinsfile="insert into notice(sender,Title,File_Name,date_time,Status) values ('$ntsusrnm','$upfltitle','$filename','$dnt',1)";
		mysql_query($queinsfile);






		//////////////////////////////////////////////////////////////////////////
	$filename2=basename( $_FILES['uploadedfile']['name']);

	echo "<font size=3px> The file <font color=blue size=3px>".$filename2."</font> has been uploaded<br></font> ";
    echo"<hr class=bar>";
} 
else
{
echo "<font color=green size=3px>There was an error uploading the file, please try again!</font>";
}


}
//////////////////////////// end file upload /////////////////////////////////




echo"<br><h3>*** Create Notice ***</h3>";

////////////////////////////// create note ///////////////////////////////////	
if($task=="cretnote"){
$nttitle=$_POST['nottitle'];
$ntdesp=$_POST['elm1'];
//echo$nttitle.$ntdesp;
//error_reporting(0);

$dnt=date("Y-m-d/H:i");

$crdt=date("Y-m-d-H-i-s");
$filenm=$nttitle."-".$crdt;
$filepath="./downloads/Notices/".$filenm.".html";

unlink($filepath);

$fh = fopen($filepath, 'a') or die("can't open file");
chmod($filepath, 0777);

fwrite($fh, stripslashes($ntdesp));



fclose($fh);
	$filename=$filenm.".html";
	$queinsfl="insert into notice(sender,Title,File_Name,date_time,Status) values ('$ntsusrnm','$nttitle','$filename','$dnt',1)";
	//echo$queinsfl;
	mysql_query($queinsfl);
	echo"<font color=red>Notice Send Successfully ! </font><br><br>";
}
/////////////////////////////end create note ////////////////////////////////





echo"<form method=POST action='./index.php?view=admin&admin=53&task=cretnote'>";
echo"Enter Title:<input type=text name=nottitle><font color=red>[ Please don't use the fullstop mark (<b>.</b>) with in the Title ]</font><br>";


?>
<!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
		

			<textarea id="elm1" name="elm1" rows="25" cols="80" style="width: 100%"> </textarea>
		

		
		<input type="submit" name="save" value="Submit"  onclick="return checkaddtl(this.form)" />
		<input type="reset" name="reset" value="Reset" />
	
</form>

<?php


echo"</form>";
echo"<hr class=bar>";

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
//////////////////////// Manage notice table///////////////////////////////////
echo"All Notices";
echo"<hr class=bar>";

//////////////////////////////// change notices status//////////////////////////
if($task=="modntst"){
$notid=$_POST['notid'];
$subbtn=$_POST['subas'];
$subvl=$_POST['subvlu'];
$delcnf=$_GET['delcnf'];
$confdel=$_POST['confdel'];
$delfile=$_POST['delfile'];
//echo$notid.$subbtn.$subvl;

	if($subbtn=="Hide"){
		$queuptohide="update notice set Status='0' where Notice_ID='$notid'";
		//echo$queuptohide;
		mysql_query($queuptohide);
		echo"<font color=red>Notice Hidden Successfully !</font>";
				}
	if($subbtn=="Show"){
	//error_reporting(0);
	$showdt=date("Y-m-d/H:i");
		$queuptohide="update notice set Status='1',date_time='$showdt' where Notice_ID='$notid'";
		//echo$queuptohide;
		mysql_query($queuptohide);
		echo"<font color=red>Notice Activited Successfully !</font>";
				}
	if($subbtn=="Remove"){
	
		echo"<font color=red>Are you sure,you want remove this notice? $confdel </font>";
			echo"<form method=POST action='./index.php?view=admin&admin=53&task=modntst&delcnf=delst'><input type=hidden name=delntid value='$notid'><input type=hidden name=delfilecnf value='$delfile'><input type=submit name=confdel value=Yes>";
			echo"<input type=submit name=confdel value=No></form>";
				}

	if(($delcnf=="delst")&&($confdel=="Yes")){
		$delcnfid=$_POST['delntid'];
		$delfilecnf=$_POST['delfilecnf'];
			$delfilepat="./downloads/Notices/$delfilecnf";
			//echo$delfilepat;
		$quedelrcd="delete from notice where Notice_ID='$delcnfid'";
		//echo$quedelrcd;
		mysql_query($quedelrcd);
		unlink($delfilepat);
		echo"<font color=red>Removed Successfully !</font>";

				}
	elseif(($delcnf=="delst")&&($confdel=="No")){
		echo"<font color=red>Remove Canceled !</font>";
		}

}
//////////////////////////////// end change notices status /////////////////////



if(($role=="administrator")||($role=="topadmin")){

$quedispnttbl="select * from notice order by date_time DESC LIMIT 0 , 100";

}

else{
$quedispnttbl="select * from notice where sender='$ntsusrnm' order by date_time DESC LIMIT 0 , 100";	
}



$qudispnttbl=mysql_query($quedispnttbl);
if(mysql_num_rows($qudispnttbl)!=0){

echo"<table border=0><tr><th>No<th>Date and Time<th  width=40%>Notice Title<th>File Name<th width=10%>Current Status<th colspan=2>Submit as</tr>";
$i=1;
while($qdispnttbl=mysql_fetch_array($qudispnttbl)){
$Notice_ID=$qdispnttbl['Notice_ID'];
$Title=$qdispnttbl['Title'];
$File_Name=$qdispnttbl['File_Name'];
$date_time=$qdispnttbl['date_time'];

$Status=$qdispnttbl['Status'];
	if($Status=='0'){
		$Status2="Hide";
		$Status3="Hide";
			}
	elseif($Status=='1'){
		$Status2="Show";
		$Status3="[new one]-&nbsp;&nbsp;Show";
		}
	else{
		$Status2="Show";
		$Status3="[old one]-&nbsp;&nbsp;Show";
		}
echo"<form method=POST action='./index.php?view=admin&admin=53&task=modntst'><tr class=trbgc><td align='center'>$i<input type=hidden name=notid value='$Notice_ID'><td align='center'>$date_time<td>$Title<td>$File_Name<td align='center'>$Status3<td align='center'>";
	if($Status2=='Hide'){
	echo"<input type=submit name=subas value=Show><td align='center'>";
			}
	elseif($Status2=='Show'){
	echo"<input type=submit name=subas value=Hide><td align='center'>";
		}
echo"<input type=hidden name=delfile value='$File_Name'><input type=submit name=subas value=Remove></tr></form>";

$i=$i+1;
							}
echo"</table>";
					}
else{
    echo"<font color=red><br>Sorry!.there are no available notices in system sent by you</font>";
}
/////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
?>









<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>


