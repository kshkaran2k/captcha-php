<?php
	session_start();
	if($_SESSION['captcha'] == $_POST['input_captcha']){
	  echo "Captcha Verified. You are human.";
	}
	else{
	  echo "Captcha Valification Failed. Its seems that you aren't human.";
	}
?>
