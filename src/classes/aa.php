<?php
		session_start();
		include_once ("loginClass.php");
		$j=new login();
		
		echo $j->getIp();
		echo $j->getSid();
				
?>