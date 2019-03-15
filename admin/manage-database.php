<?php
	$where = "WHERE 1=1 ";
	if (isset($_GET['term'])) {
		$where .= "AND (
			`title` LIKE '%".$_GET['term']."%' OR 
			`author` LIKE '%".$_GET['term']."%' OR 
			`description` LIKE '%".$_GET['term']."%'
		)";
	}
	$get_input_term = "<input type=\"hidden\" name=\"type\" value=\"".$_GET['type']."\">";
	$limit = 20;
	$page = $_GET['view'];
	if ($page) {
		$start = ($page - 1) * $limit;
	} else {
		$start = 0;
	}
	if ($page == 0) $page = 1;
	include('../system/module/nav_number.php');
	echo "<div id=\"doc_list\">";
	$no = $cur_page_s+1;
	$sql_list = "SELECT * FROM `".TB_DBD."` ".$where." ".$order." LIMIT ".$start.",".$limit."";
	$res_list = @mysql_query($sql_list, $connection) or die(mysql_error());
	while($row_list = mysql_fetch_array($res_list)) {
		$entrydate = date('j ', strtotime($row_list['date_create'])).
					 $array_bulan[date('n', strtotime($row_list['date_create']))].
					 date(' Y', strtotime($row_list['date_create']));
		echo "<div class=\"doc_result\">".
			 "<a href=\"?page=edit&view=database&docID=".$row_list['id_doc']."\"><div class=\"doc_number\">".($no++)."</div>".
			 "<span class=\"doc_res_title\">".$row_list['title']."</span><br>".
			 "<span class=\"doc_res_author\">".$row_list['author']."";
		echo "</span><br><span class=\"doc_res_meta\">";
		if ($row_list['status'] != 'publish') {
			echo "<font color=red><b>Tidak Dipublikasikan</b></font>. ";
		}
		if (empty($row_list['file'])) {
			echo "<font color=orange><b>Berkas belum ada</b></font>. ";
		}
		echo "Tanggal Entri: ".$entrydate.".</span></a></div>";
	}
	echo "</div>";
	include('../system/module/nav_number.php');
?>