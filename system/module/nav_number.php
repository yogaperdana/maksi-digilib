<?php
	if (($sitetype == 'theses') || ($sitetype == 'journal') || ($_GET['type'] == 'theses') || ($_GET['type'] == 'journal')) {
		$tablename = TB_DOC;
	} else if (($sitetype == 'database') || ($_GET['type'] == 'database')) {
		$tablename = TB_DBD;
	}
	$sql_count = "SELECT COUNT(*) AS 'total' FROM `".$tablename."` ".$where."";
	$res_count = @mysql_query($sql_count, $connection) or die(mysql_error());
	$row_count = mysql_fetch_array($res_count);
	echo "<div id=\"pagination\">";
		if (empty($_GET['method'])) {
			$get_input_method = "";
		} else {
			$get_input_method = "<input type=\"hidden\" name=\"method\" value=\"".$_GET['method']."\" id=\"s_method\">";
		}
		if (empty($_GET['sort'])) {
			$get_input_sort = "";
		} else {
			$get_input_sort = "<input type=\"hidden\" name=\"sort\" value=\"".$_GET['sort']."\" id=\"s_sort\">";
		}
		echo "<form action=\"\" method=\"get\"><input type=\"hidden\" name=\"page\" value=\"".$_GET['page']."\">".
			 $get_input_method.$get_input_term."<div id=\"pagesel\"><b>Halaman:</b> <select name=\"view\" id=\"s_view\">";
		$page_total=ceil($row_count['total']/$limit);
		$cur_page_s = ($page-1)*$limit;
		for ($pages = 1; $pages <= $page_total; $pages++) {
			if ($page != $pages) {
				echo "<option value=\"".$pages."\">".$pages."</option>";
			} else {
				echo "<option value=\"".$pages."\" selected=\"selected\">".$pages."</option>";
			}
		}
		echo "</select>".$get_input_sort."<input type=\"submit\" value=\"Lihat\"></div></form>";
		if (($sitetype == 'theses') || ($sitetype == 'journal')) {
			sortdoclist();
		} else if ($sitetype == 'database') {
			sortdblist();
		}
		echo "<form action=\"\" method=\"get\"><input type=\"hidden\" name=\"page\" value=\"".$_GET['page']."\">".$get_input_method;
		if (!empty($_GET['view'])) {
			echo "<input type=\"hidden\" name=\"view\" value=\"".$_GET['view']."\" id=\"s_view\">";
		}
		echo $get_input_term."<div id=\"sort\"><b>Urutkan:</b> <select name=\"sort\">".
			 "<option value=\"entry_asc\" ".$sel2.">Entri Terlama</option>".
			 "<option value=\"entry_desc\" ".$sel1.">Entri Terbaru</option>".
			 "<option value=\"title_asc\" ".$sel4.">Judul A-Z</option>".
			 "<option value=\"title_desc\" ".$sel3.">Judul Z-A</option>".
			 "<option value=\"author_asc\" ".$sel6.">Penulis A-Z</option>".
			 "<option value=\"author_desc\" ".$sel5.">Penulis Z-A</option>".
			 "</select><input type=\"submit\" value=\"OK\"></div></form>";
	echo "</div>";
?>