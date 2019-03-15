<?php
	include('../system/config/database.php');
	include('function.php');
	sec_session_start();
	if(isset($_POST['email'], $_POST['p'])) {
		$email = $_POST['email'];
		$password = $_POST['p'];
		if(login($email, $password, $mysqli) == true) {
			header('Location: ./?page=home');
		} else {
			header('Location: ./?error=1');
		}
	} else {
		header('Location: ./?error=1');
	}
?>