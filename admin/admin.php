<?php
	//error_reporting(E_ALL); 
	//ini_set("display_errors", 1);
	include('function.php');
	sec_session_start();
	if(login_check($mysqli) == true) {
		include('top.php');
		if ($_GET['page'] == 'home') {
			include('panel.php');
		} else
		if ($_GET['page'] == 'new') {
			include('new.php');
		} else
		if ($_GET['page'] == 'manage') {
			include('manage.php');
		} else
		if ($_GET['page'] == 'edit') {
			include('new.php');
		} else
		if ($_GET['page'] == 'detail') {
			echo "<div class=\"doc_detail\">";
			include('../system/module/detail.php');
			echo "</div>";
		} else
		if ($_GET['page'] == 'database') {
			include('database.php');
		} else
		if ($_GET['page'] == 'edition') {
			include('edition.php');
		} else
		if ($_GET['page'] == 'menu') {
			include('pagemenu.php');
		} else
		if ($_GET['page'] == 'password') {
			include('password.php');
		} else
		if ($_GET['page'] == 'option') {
			include('option.php');
		} else
		if ($_GET['page'] == 'stat') {
			include('stat.php');
		} else
		if ($_GET['page'] == 'recap') {
			include('recap.php');
		} else
		if ($_GET['page'] == 'logout') {
			include('logout.php');
		} else {
			header("location:".SITE_DIR."");
		}
	} else {
		include('login.php');
	}
?>