<?php
	define("DB_SERVER", "localhost");
	define("DB_USER", "");
	define("DB_PASS", "");
	define("DB_NAME", "");
	define("TB_DOC", "mds_document");
	define("TB_OPT", "mds_option");
	define("TB_PGM", "mds_pagemenu");
	define("TB_STT", "mds_statistic");
	define("TB_EDT", "mds_edition");
	define("TB_USR", "mds_user");
	define("TB_PWD", "mds_password");
	/* DATABASE SECTION */
	define("TB_DBT", "mds_dbtype");
	define("TB_DBG", "mds_dbgroup");
	define("TB_DBD", "mds_dbdoc");
	/* CONNECT TO DB */
	$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
	mysql_select_db(DB_NAME, $connection) or die(mysql_error());
	$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
?>
