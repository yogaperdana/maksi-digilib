<?php
	if ($AUTH_ALLOW == "YES") {
		include('../../admin/admin.php');
	} else {
		if ($_GET['page'] == 'login') {
			if ( $sitetype == 'admin' ) {
				include('../../admin/login.php');
			} else {
				header("location:".SITE_DIR."");
			}
		} else {
			header("location:".SITE_DIR."/?page=login");
		}
	}
?>