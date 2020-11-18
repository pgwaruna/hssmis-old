<?php
session_start();

include_once ("classes/loginClass.php");
				$j=new login();
				$j->logoutUser();


//echo$_SESSION['host'];
if($_SESSION['host']=="remot"){
session_destroy();
header('Location: ../rumis/index.php');
								}
else{
session_destroy();
header('Location: index.php');

	}




?>