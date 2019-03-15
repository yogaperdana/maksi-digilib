<?php
	function statinsert($st_type, $st_stamp) {
		global $sitetype;
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		$comp = GetHostByAddr($ip);
		if ($_GET['page'] == 'home') {
			$browser = $_SERVER['HTTP_USER_AGENT'];
		} else {
			$browser = "";
		}
		$sql_stat = "INSERT INTO ".TB_STT." (`datetime`, `type`, `stamp`, `user`, `ip`, `site`, `browser`) ".
					"VALUES (NOW(), '".$st_type."', '".$st_stamp."', '".$comp."', '".$ip."', '".$sitetype."', '".$browser."');";
		$res_stat = mysql_query($sql_stat) or die(mysql_error());
	}
	
	if ($sitetype != "admin") {
		if ($_GET['page'] == 'home') {
			if ($_GET['ref'] != 'home') {
				statinsert("visit", "home");
			}
		} else
		if ($_GET['page'] == 'detail') {
			statinsert("view", $_GET['docID']);
		} else
		if ($_GET['page'] == 'search') {
			if ($_GET['method'] == "simple") {
				statinsert("search", $_GET['term']);
			} else 
			if ($_GET['method'] == "advanced") {
				statinsert("search", $_GET['title']."; ".$_GET['author']."; ".$_GET['keyword'].";");
			}
		}
	}
?>