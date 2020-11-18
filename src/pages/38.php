<?php
$role=$_SESSION['role'];
$dept_id=$_SESSION['section'];
include './admin/config.php';
include 'classes/pastClass.php';
echo"Upload Past Peper";
echo '<hr class=bar>';
$upload_dir = "./export_data/pp"; // Directory for file storing
                                            // filesystem path


$web_upload_dir = "./export_data/pp"; // Directory for file storing
                          // Web-Server dir 

/* upload_dir is filesystem path, something like
   /var/www/htdocs/files/upload or c:/www/files/upload

   web upload dir, is the webserver path of the same
   directory. If your upload-directory accessible under 
   www.your-domain.com/files/upload/, then 
   web_upload_dir is /files/upload
*/


// testing upload dir 
// remove these lines if you're shure 
// that your upload dir is really writable to PHP scripts
$tf = $upload_dir.'/'.md5(rand()).".test";
$f = @fopen($tf, "w");
if ($f == false) 
    die("Fatal error! {$upload_dir} is not writable. Set 'chmod 777 {$upload_dir}'
        or something like this");
fclose($f);
unlink($tf);
// end up upload dir testing 



// FILEFRAME section of the script
if (isset($_POST['fileframe'])) 
{
    $result = 'ERROR';
    $result_msg = 'No FILE field found';

    if (isset($_FILES['file']))  // file was send from browser
    {
        if ($_FILES['file']['error'] == UPLOAD_ERR_OK)  // no error
        {
            $filename = $_FILES['file']['name']; // file name 
            move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir.'/'.$filename);
            // main action -- move uploaded file to $upload_dir 
		chmod($upload_dir.'/'.$filename, 0777);//edit by iranga
            $result = 'OK';
        }
        elseif ($_FILES['file']['error'] == UPLOAD_ERR_INI_SIZE)
            $result_msg = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
        else 
            $result_msg = 'Unknown error';

        // you may add more error checking
        // see http://www.php.net/manual/en/features.file-upload.errors.php
        // for details 
    }

    // outputing trivial html with javascript code 
    // (return data to document)

    // This is a PHP code outputing Javascript code.
    // Do not be so confused ;) 
    echo '<html><head><title>-</title></head><body>';
    echo '<script language="JavaScript" type="text/javascript">'."\n";
    echo 'var parDoc = window.parent.document;';
    // this code is outputted to IFRAME (embedded frame)
    // main page is a 'parent'

    if ($result == 'OK')
    {
        // Simply updating status of fields and submit button
        echo 'parDoc.getElementById("upload_status").value = "file successfully uploaded";';
        echo 'parDoc.getElementById("filename").value = "'.$filename.'";';
        echo 'parDoc.getElementById("filenamei").value = "'.$filename.'";';
        echo 'parDoc.getElementById("upload_button").disabled = false;';
    }
    else
    {
        echo 'parDoc.getElementById("upload_status").value = "ERROR: '.$result_msg.'";';
    }

    echo "\n".'</script></body></html>';

    exit(); // do not go futher 
}
// FILEFRAME section END



// just userful functions
// which 'quotes' all HTML-tags and special symbols 
// from user input 
function safehtml($s)
{
    $s=str_replace("&", "&amp;", $s);
    $s=str_replace("<", "&lt;", $s);
    $s=str_replace(">", "&gt;", $s);
    $s=str_replace("'", "&apos;", $s);
    $s=str_replace("\"", "&quot;", $s);
    return $s;
}


 
// retrieving message from cookie 
if (isset($_COOKIE['msg']) && $_COOKIE['msg'] != '')  
{  
    if (get_magic_quotes_gpc()) 
        $msg = stripslashes($_COOKIE['msg']); 
    else
        $msg = $_COOKIE['msg'];

    // clearing cookie, we're not going to display same message several times
    setcookie('msg', ''); 
} 



if (($_GET['save'])=="true")
{
    $filename = $_POST['filename'];
    $year = $_POST['year'];
    $cource = $_POST['cource'];
    
   	$e=new pastpapers();
	$e->addPaper($filename,$year,$cource);
	
} 


else{

?>
<!-- Beginning of main page -->
<html><head>
<title>FOSMIS - Past Paper ZONE</title>
</head>
<body>
<?php 
if (isset($msg)) // this is special section for outputing message 
    echo '<p style="font-weight: bold;">'.$msg.'</p>';
?> 
<h1>Upload file:</h1>

<form action="<?=$PHP_SELF?>" target="upload_iframe" method="post" enctype="multipart/form-data">
<input type="hidden" name="fileframe" value="true">
<!-- Target of the form is set to hidden iframe -->
<!-- From will send its post data to fileframe section of 
     this PHP script (see above) -->
<font color="red">*** Please rename your file name as MAM1113-2006 before upload ***</font><br /><br />
<label for="file">Past Paper Uploader:</label><br>
<!-- JavaScript is called by OnChange attribute -->
<input type="file" name="file" id="file" onChange="jsUpload(this)">
</form>
<script type="text/javascript">
/* This function is called when user selects file in file dialog */
function jsUpload(upload_field)
{
    // this is just an example of checking file extensions
    // if you do not need extension checking, remove 
    // everything down to line
    // upload_field.form.submit();

    var re_text = /\.doc|\.jpg|\.pdf|\.zip/i;
    var filename = upload_field.value;

    /* Checking file type */
    if (filename.search(re_text) == -1)
    {
        alert("File does not have text(doc, pdf, jpg, zip) extension");
        upload_field.form.reset();
        return false;
    }

    upload_field.form.submit();
    document.getElementById('upload_status').value = "uploading file...";
    upload_field.disabled = true;
    return true;
}
</script>
<iframe name="upload_iframe" style="width: 400px; height: 100px; display: none;">
</iframe>
<!-- For debugging purposes, it's often useful to remove
     "display: none" from style="" attribute -->

<br>
Upload status:<br>
<input type="text" name="upload_status" id="upload_status" 
       value="not uploaded" size="64" disabled>
<br><br>

File name:<br>
<input type="text" name="filenamei" id="filenamei" value="none" disabled>

<form action="index.php?view=admin&admin=38&save=true" method="POST">
<!-- one field is "disabled" for displaying-only. Other, hidden one is for 
    sending data -->
<input type="hidden" name="filename" id="filename">
<br><br>
Course: 

<?php

if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
$query_16="select code, name from courseunit order by code";
}
else{
$query_16="select code, name from courseunit where department='$dept_id' order by code"; 
}




	$q16=mysql_query($query_16);
	echo '<select name="cource">';
	while($raw4=mysql_fetch_array($q16)){
	echo '<option value='.strtoupper($raw4['code']).'>'.strtoupper($raw4['code']).'</option>';
	}

?>

</select>
Year:
<?php

$quebtyear="select * from acc_year where current='1'";
$qubtyear=mysql_query($quebtyear);
while($qbtyear=mysql_fetch_array($qubtyear)){
$btyear=$qbtyear['acedemic_year'];
$btyr=explode("_",$btyear);

$nxyr=$btyr[1];
$cryr=$btyr[0];
}

echo'<select name="year">';

for($py=1;$py<=10;$py++){
    $pastyear=$btyr[1]-$py;
   echo"<option value='$pastyear'>$pastyear</option>";
    
    
    
}

echo"</select>";


?>

  



<br><br>
<input type="submit" id="upload_button" value="save file" disabled>
</form>

</body>
</html>
<?php 
}
?>
