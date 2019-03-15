<?php
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);
	if ($_GET['method'] == "simple") {
		$search_term = "kata: <b>".$_GET['term']."</b>.";
		$where = "WHERE (`judul` LIKE '%".$_GET['term']."%' OR `penulis` LIKE '%".$_GET['term']."%' OR `dosen` LIKE '%".$_GET['term']."%' OR `katakunci` LIKE '%".$_GET['term']."%' OR `keyword` LIKE '%".$_GET['term']."%')";
		$get_input_term = "<input type=\"hidden\" name=\"term\" value=\"".$_GET['term']."\">";
	} else if ($_GET['method'] == "advanced") {
		$search_term = "";
		if (empty($_GET['title'])) {
			$wget1a = $wget1b = "";
		} else {
			$search_term .= "judul: <b>".$_GET['title']."</b>. ";
			$wget1a = "`judul` LIKE '%".$_GET['title']."%' ";
			$wget1b = "<input type=\"hidden\" name=\"title\" value=\"".$_GET['title']."\">";
		}
		if (empty($_GET['author'])) {
			$wget2a = $wget2b = "";
		} else {
			$search_term .= "penulis: <b>".$_GET['author']."</b>. ";
			$wget2a = "`penulis` LIKE '%".$_GET['author']."%' ";
			$wget2b = "<input type=\"hidden\" name=\"author\" value=\"".$_GET['author']."\">";
		}
		if (empty($_GET['keyword'])) {
			$wget3a = $wget3b = "";
		} else {
			$search_term .= "kata kunci: <b>".$_GET['keyword']."</b>. ";
			$wget3a = "`katakunci` LIKE '%".$_GET['keyword']."%' ";
			$wget3b = "<input type=\"hidden\" name=\"keyword\" value=\"".$_GET['keyword']."\">";
		}
		/*  */ if ( (!empty($_GET['title'])) && (!empty($_GET['author'])) && (!empty($_GET['keyword'])) ) {
			$w = "WHERE ";
			$g1 = $g2 = " AND ";
		} else if ( (!empty($_GET['title'])) && (!empty($_GET['author'])) && (empty($_GET['keyword'])) ) {
			$w = "WHERE ";
			$g1 = " AND "; $g2 = "";
		} else if ( (!empty($_GET['title'])) && (empty($_GET['author'])) && (!empty($_GET['keyword'])) ) {
			$w = "WHERE ";
			$g1 = ""; $g2 = " AND ";
		} else if ( (empty($_GET['title'])) && (!empty($_GET['author'])) && (!empty($_GET['keyword'])) ) {
			$w = "WHERE ";
			$g1 = ""; $g2 = " AND ";
		} else if ( (empty($_GET['title'])) && (empty($_GET['author'])) && (empty($_GET['keyword'])) ) {
			$w = "WHERE 1=1";
			$g1 = $g2 = "";
		} else {
			$w = "WHERE ";
			$g1 = $g2 = "";
		}
		$where = $w.$wget1a.$g1.$wget2a.$g2.$wget3a;
		$get_input_term = $wget1b.$wget2b.$wget3b;
	} else {
		$where = "";
		$get_input_term = "";
	}
?>
						<div id="page_title">
							<h1>Pencarian Dokumen</h1>
						</div>
						<div id="doc_post">
							<?php
								$sql_count = "SELECT *, COUNT(*) AS 'total' FROM `".TB_DOC."` ".$where." AND `jenis` = '".$sitetype."' AND `kondisi` = 'publish'";
								$res_count = @mysql_query($sql_count, $connection) or die(mysql_error());
								$row_count = mysql_fetch_array($res_count);
								if ($row_count['total'] == 0) {
									echo "Pencarian tidak ditemukan!";
								} else {
									echo "Ditemukan <b>".$row_count['total']."</b> dokumen yang mengandung ".$search_term."";
								}
							?>
						</div>
						<?php
							if ($row_count['total'] != 0) {
								include('result.php');
							}
						?>
