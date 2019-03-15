<?php
	ob_start();
	include('module/var_if_not_set.php');
	include('module/date_array.php');
	include('config/database.php');
	include('config/directory.php');
	include('module/function.php');
	include('module/variable.php');
	include('site/header.php');
	if ( $sitetype == 'admin' ) {
		include('../admin/admin.php');
	} else {
		include('site/left.php');
		include('site/right.php');
	}
	include('site/footer.php');
//	include('module/tracker.php');
	ob_end_flush();
?>
