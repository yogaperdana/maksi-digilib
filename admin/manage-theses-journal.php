<?php
		$where = "WHERE `jenis` = '".$_GET['type']."' ";
		if (isset($_GET['term'])) {
			$where .= "AND (`judul` LIKE '%".$_GET['term']."%' OR `penulis` LIKE '%".$_GET['term']."%' OR `dosen` LIKE '%".$_GET['term']."%' OR `katakunci` LIKE '%".$_GET['term']."%' OR `keyword` LIKE '%".$_GET['term']."%')";
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
		$sql_list = "SELECT * FROM `".TB_DOC."` ".$where." ".$order." LIMIT ".$start.",".$limit."";
		$res_list = @mysql_query($sql_list, $connection) or die(mysql_error());
		while($row_list = mysql_fetch_array($res_list)) {
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
				 "<a href=\"?page=edit&view=".$row_list['jenis']."&docID=".$row_list['id']."\"><div class=\"doc_number\">".($no++)."</div>".
				 "<span class=\"doc_res_title\">".$row_list['judul']."</span><br>".
				 "<span class=\"doc_res_author\">".$row_list['penulis']."";
			if ($row_list['jenis'] == 'journal') {
				echo ", ".$row_list['dosen']."";
			} else {
				echo "<span style=\"font-weight:normal;font-size:12px;\"> (Pembimbing: ".$row_list['dosen'].")</span>";
			}
			echo "</span><br><span class=\"doc_res_key\">Kata Kunci: <i>".$row_list['katakunci']."</i></span><br>".
				 "<span class=\"doc_res_meta\">";
			if ($row_list['kondisi'] == 'publish') {
				echo "Dilihat ".$row_dvc['counts']." kali. ";
			} else {
				echo "<font color=red><b>Tidak Dipublikasikan</b></font>. ";
			}
			if (empty($row_list['berkas'])) {
				echo "<font color=orange><b>Berkas belum ada</b></font>. ";
			}
			echo "Tanggal Entri: ".$entrydate.".";
			if ($_GET['type'] == 'journal') {
				if (empty($row_list['berkas'])) {
					echo " <font color=green><b>Belum masuk edisi apapun</b></font>. ";
				} else {
					echo " Edisi: ".$row_dje['nama'].".";
				}
			}
			echo "</span></a></div>";
		}
		echo "</div>";
		include('../system/module/nav_number.php');
?>