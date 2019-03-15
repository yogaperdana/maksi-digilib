<?php
	echo "<div id=\"doc_post\">";
							
	$limit = 20;
	$page = $_GET['view'];
	if ($page) {
		$start = ($page - 1) * $limit;
	} else {
		$start = 0;
	}
	if ($page == 0) $page = 1;
	include('nav_number.php');
	echo "<div id=\"doc_list\">";
	$no = $cur_page_s+1;
	if ($sitetype == 'database') {
		$sql_list = "SELECT * FROM `".TB_DBD."` LEFT JOIN `".TB_DBG."` ON `".TB_DBG."`.`id_group` = `".TB_DBD."`.`id_group`".
					"".$where." AND `status` = 'publish' ".$order." LIMIT ".$start.",".$limit."";
	} else {
		$sql_list = "SELECT * FROM `".TB_DOC."` ".$where." AND `jenis` = '".$sitetype."' 
					 AND `kondisi` = 'publish' ".$order." LIMIT ".$start.",".$limit."";
	}
	$res_list = @mysql_query($sql_list, $connection) or die(mysql_error());
	while($row_list = mysql_fetch_array($res_list)) {
		if ($sitetype == 'database') {
			$entrydate = date('j ', strtotime($row_list['date_create'])).
						 $array_bulan[date('n', strtotime($row_list['date_create']))].
						 date(' Y', strtotime($row_list['date_create']));
			echo "<div class=\"doc_result\">".
				 "<a href=\"./?page=detail&docID=".$row_list['id_doc']."\"><div class=\"doc_number\">".($no++)."</div>".
				 "<span class=\"doc_res_title\">".$row_list['title']."</span><br>".
				 "<span class=\"doc_res_author\">".$row_list['author']."</span><br>".
				 "<span class=\"doc_res_meta\">Kategori: ".$row_list['name']."<br>Tanggal Entri: ".$entrydate."</span></a></div>";
		} else {
			$sql_dvc = "SELECT *, COUNT(*) AS `counts` FROM `".TB_STT."` 
						WHERE `type` = 'view' AND `stamp` = '".$row_list['id']."'";
			$que_dvc = @mysql_query($sql_dvc, $connection);
			$row_dvc = mysql_fetch_array($que_dvc);
			$sql_dje = "SELECT * FROM `".TB_EDT."` WHERE `id` = '".$row_list['kategori']."'";
			$que_dje = @mysql_query($sql_dje, $connection);
			$row_dje = mysql_fetch_array($que_dje);
			$entrydate = date('j ', strtotime($row_list['tanggal'])).
						 $array_bulan[date('n', strtotime($row_list['tanggal']))].
						 date(' Y', strtotime($row_list['tanggal']));
			echo "<div class=\"doc_result\">".
				 "<a href=\"./?page=detail&docID=".$row_list['id']."\"><div class=\"doc_number\">".($no++)."</div>".
				 "<span class=\"doc_res_title\">".$row_list['judul']."</span><br>".
				 "<span class=\"doc_res_author\">".$row_list['penulis']."";
			if ($sitetype == 'journal') {
				echo "; ".$row_list['dosen']."";
			}
			echo "</span><br><span class=\"doc_res_key\">Kata Kunci: <i>".$row_list['katakunci']."</i></span><br>".
				 "<span class=\"doc_res_meta\">Dilihat ".$row_dvc['counts']." kali. Tanggal Entri: ".$entrydate.".";
			if ($sitetype == 'journal') {
				echo " Edisi: ".$row_dje['nama']."";
			}
			echo "</span></a></div>";
		}
	}
	echo "</div>";
	include('nav_number.php');
							
	echo "</div>";
?>