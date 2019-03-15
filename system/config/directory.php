<?php
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	$serverip = "absi.maksi.feb.ugm.ac.id";
	
	// Directory without "/" in the end.
	if (strpos($ip, '10.7.17.') !== false) {
		if ( $sitetype == 'theses' ) {
			define("SITE_DIR", "http://".$serverip."/tesis");
		} else
		if ( $sitetype == 'journal' ) {
			define("SITE_DIR", "http://".$serverip."/jurnal");
		} else
		if ( $sitetype == 'db_bpk' ) {
			define("SITE_DIR", "http://".$serverip."/bpk");
		} else
		if ( $sitetype == 'admin' ) {
			define("SITE_DIR", "http://".$serverip."/admin");
		}
		define("SYS_DIR", "http://".$serverip."/dlcdn");
		define("SYS_DOC", "http://".$serverip."/digilib/docs");
	} else
	if (strpos($ip, '10.7.130.') !== false) {
		if ( $sitetype == 'theses' ) {
			define("SITE_DIR", "http://tesis.maksi");
		} else
		if ( $sitetype == 'journal' ) {
			define("SITE_DIR", "http://jurnal.maksi");
		} else
		if ( $sitetype == 'db_bpk' ) {
                        define("SITE_DIR", "http://bpk.maksi");
                } else
		if ( $sitetype == 'admin' ) {
			define("SITE_DIR", "http://".$serverip."/admin");
		}
		define("SYS_DIR", "http://".$serverip."/dlcdn");
		define("SYS_DOC", "http://".$serverip."/digilib/docs");
	} else
	if (strpos($ip, '192.168.127.') !== false) {
		if ( $sitetype == 'theses' ) {
			define("SITE_DIR", "http://tesis.maksi");
		} else
		if ( $sitetype == 'journal' ) {
			define("SITE_DIR", "http://jurnal.maksi");
		} else
		if ( $sitetype == 'db_bpk' ) {
                        define("SITE_DIR", "http://bpk.maksi");
                } else
		if ( $sitetype == 'admin' ) {
			define("SITE_DIR", "http://192.168.127.1/admin");
		}
		define("SYS_DIR", "http://192.168.127.1/dlcdn");
		define("SYS_DOC", "http://192.168.127.1/digilib/docs");
	} else {
		$iplokal="absi.maksi.feb.ugm.ac.id";
                if ( $sitetype == 'theses' ) {
			define("SITE_DIR", "http://$iplokal/theses");
		} else
		if ( $sitetype == 'journal' ) {
			define("SITE_DIR", "http://$iplokal/journal");
		} else
		if ( $sitetype == 'db_bpk' ) {
                        define("SITE_DIR", "http://$iplokal/bpk");
                } else
		if ( $sitetype == 'admin' ) {
			define("SITE_DIR", "http://$iplokal/admin");
		}
		define("SYS_DIR", "http://$iplokal/system");
		define("SYS_DOC", "http://$iplokal/docs");
	}
?>
