<?php
	function sortdoclist() {
		global $sel1, $sel2, $sel3, $sel4, $sel5, $sel6, $order;
		$selected = " selected=\"selected\"";
		if ($_GET['sort'] == '') {
			$_GET['sort'] = "entry_desc";
		}
		if ($_GET['sort'] == 'entry_desc') {
			$order = "ORDER BY tanggal DESC";
			$sel1 = $selected;
			$sel2 = $sel3 = $sel4 = $sel5 = $sel6 = "";
		} else if ($_GET['sort'] == 'entry_asc') {
			$order = "ORDER BY tanggal ASC";
			$sel2 = $selected;
			$sel1 = $sel3 = $sel4 = $sel5 = $sel6 = "";
		} else if ($_GET['sort'] == 'title_desc') {
			$order = "ORDER BY judul DESC";
			$sel3 = $selected;
			$sel1 = $sel2 = $sel4 = $sel5 = $sel6 = "";
		} else if ($_GET['sort'] == 'title_asc') {
			$order = "ORDER BY judul ASC";
			$sel4 = $selected;
			$sel1 = $sel2 = $sel3 = $sel5 = $sel6 = "";
		} else if ($_GET['sort'] == 'author_desc') {
			$order = "ORDER BY penulis DESC";
			$sel5 = $selected;
			$sel1 = $sel2 = $sel3 = $sel4 = $sel6 = "";
		} else if ($_GET['sort'] == 'author_asc') {
			$order = "ORDER BY penulis ASC";
			$sel6 = $selected;
			$sel1 = $sel2 = $sel3 = $sel4 = $sel5 = "";
		} else {
			$order = "ORDER BY tanggal DESC";
			$sel1 = $selected;
			$sel2 = $sel3 = $sel4 = $sel5 = $sel6 = "";
		}
	}
	function sortdblist() {
		global $sel1, $sel2, $sel3, $sel4, $sel5, $sel6, $order;
		$selected = " selected=\"selected\"";
		if ($_GET['sort'] == '') {
			$_GET['sort'] = "entry_desc";
		}
		if ($_GET['sort'] == 'entry_desc') {
			$order = "ORDER BY date_create DESC";
			$sel1 = $selected;
			$sel2 = $sel3 = $sel4 = $sel5 = $sel6 = "";
		} else if ($_GET['sort'] == 'entry_asc') {
			$order = "ORDER BY date_create ASC";
			$sel2 = $selected;
			$sel1 = $sel3 = $sel4 = $sel5 = $sel6 = "";
		} else if ($_GET['sort'] == 'title_desc') {
			$order = "ORDER BY title DESC";
			$sel3 = $selected;
			$sel1 = $sel2 = $sel4 = $sel5 = $sel6 = "";
		} else if ($_GET['sort'] == 'title_asc') {
			$order = "ORDER BY title ASC";
			$sel4 = $selected;
			$sel1 = $sel2 = $sel3 = $sel5 = $sel6 = "";
		} else if ($_GET['sort'] == 'author_desc') {
			$order = "ORDER BY author DESC";
			$sel5 = $selected;
			$sel1 = $sel2 = $sel3 = $sel4 = $sel6 = "";
		} else if ($_GET['sort'] == 'author_asc') {
			$order = "ORDER BY author ASC";
			$sel6 = $selected;
			$sel1 = $sel2 = $sel3 = $sel4 = $sel5 = "";
		} else {
			$order = "ORDER BY date_create DESC";
			$sel1 = $selected;
			$sel2 = $sel3 = $sel4 = $sel5 = $sel6 = "";
		}
	}
	function doc_popular($docstat, $doctype, $doclimit) {
		global $connection;
		$func_return = "";
		$sql_dpc = "SELECT *, COUNT(*) AS `counts` FROM `".TB_STT."` 
					WHERE `type` = '".$docstat."' AND `site` = '".$doctype."' 
					AND `stamp` <> '; ; ;' AND `stamp` <> '' 
					GROUP BY `stamp` ORDER BY `counts` DESC LIMIT ".$doclimit."";
		$que_dpc = @mysql_query($sql_dpc, $connection);
		while($row_dpc = mysql_fetch_array($que_dpc)) {
			$sql_dpv = "SELECT * FROM `".TB_DOC."` WHERE `id` = '".$row_dpc['stamp']."'";
			$que_dpv = @mysql_query($sql_dpv, $connection);
			$row_dpv = mysql_fetch_array($que_dpv);
			if ($docstat == 'view') {
				$func_return .= "<p><a href=\"".SITE_DIR."/?page=detail&docID=".$row_dpv['id']."\">".
								substr($row_dpv['judul'], 0, 50)."... ".
								"<small>(".$row_dpc['counts']." kali dilihat)</small></a></p>\n";
			} else {
				$func_return .= "<p>".$row_dpc['stamp']."</p>\n";
			}
		}
		return $func_return;
	}
	function ftxt_permission($ftxt_ip) {
		global $connection, $sitetype;
		$sql_per1 = "SELECT * FROM `".TB_OPT."` WHERE `field` = '".$sitetype."_site' AND `value1` = 'ftxt_site_allow'";
		$que_per1 = @mysql_query($sql_per1, $connection);
		$row_per1 = mysql_fetch_array($que_per1);
		if ($row_per1['value2'] == 'TRUE') {
			$sql_per2 = "SELECT * FROM `".TB_OPT."` WHERE `field` = 'all_site' AND `value1` = 'ftxt_ip_deny'";
			$que_per2 = @mysql_query($sql_per2, $connection);
			$row_per2 = mysql_fetch_array($que_per2);
			$exp_list_ip = explode(",", $row_per2['value2']);
			$count_list_ip = count($exp_list_ip);
			for ($i=0; $i<$count_list_ip; $i++) {
				if ($exp_list_ip[$i] == $ftxt_ip) {
					goto ret_false;
				}
			}
			ret_true: $return = TRUE;
		} else {
			ret_false: $return = FALSE;
		}
		return $return;
	}
?>
