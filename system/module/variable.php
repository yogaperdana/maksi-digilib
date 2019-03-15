<?php
	function def_var($sitetype, $field, $value1) {
		global $connection;
		$dv_query = @mysql_query("SELECT * FROM `".TB_OPT."` ".
			"WHERE `field` = '".$sitetype."_".$field."' AND `value1` = '".$value1."'", $connection);
		$dv_fetch = mysql_fetch_array($dv_query);
		$dv_return = $dv_fetch['value2'];
		return $dv_return;
	}
	$site_title			= def_var($sitetype, "site", "title");
	$site_header_image	= def_var($sitetype, "site", "header");
	$site_name			= def_var($sitetype, "site", "name");
	$site_note			= def_var($sitetype, "site", "note");
	$site_welcome		= def_var($sitetype, "site", "welcome");
	$site_editor		= def_var($sitetype, "site", "editor");
	$site_copyright		= def_var("all", "site", "copyright");
	$site_version		= 'v2.1.4b (2015.01.20)';
	
	function doc_count($table, $site, $op, $status) {
		global $connection;
		if (empty($site)) {$type = "";}
		else {$type = "`jenis` = '".$site."'";}
		if (empty($op))		{$cond = "";}
		else {$cond = "`kondisi` ".$op." '".$status."'";}
		if (empty($site) && empty($op)) {$where = "";}
		else {$where = "WHERE";}
		if (!empty($site) && !empty($op)) {$and = "AND";}
		else {$and = "";}
		$dc_query = @mysql_query("SELECT COUNT(*) AS TOTAL FROM `".$table."` ".
			"".$where." ".$type." ".$and." ".$cond."", $connection);
		$dc_fetch = mysql_fetch_array($dc_query);
		$dc_return = $dc_fetch['TOTAL'];
		return $dc_return;
	}
	$docs_all_pub		= doc_count(TB_DOC, "", "=", "publish");
	$docs_theses_pub	= doc_count(TB_DOC, "theses", "=", "publish");
	$docs_journal_pub	= doc_count(TB_DOC, "journal", "=", "publish");
	$docs_all_npub		= doc_count(TB_DOC, "", "!=", "publish");
	$docs_edition		= doc_count(TB_EDT, "", "", "");
	
	$doc_file_maxsize = '104857600';
	
	function stat_count($site, $type) {
		global $connection;
		$sql_cst = "SELECT COUNT(*) AS 'total' FROM `".TB_STT."` WHERE `site` = '".$site."' AND `type` = '".$type."'";
		$res_cst = @mysql_query($sql_cst, $connection) or die(mysql_error());
		$row_cst = mysql_fetch_array($res_cst);
		return $row_cst['total'];
	}
	$stat_total_access = stat_count($sitetype, "visit");
	$stat_total_docs = doc_count(TB_DOC, $sitetype, "=", "publish");

	date_default_timezone_set('Asia/Bangkok');
?>