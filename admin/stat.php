<?php
	if (isset($_POST['delete'])) {
		$sql_del = "DELETE FROM `".TB_STT."` WHERE `id` = '".$_POST['stat_id']."'";
		$res_del = mysql_query($sql_del) or die(mysql_error());
	}
	if ($_GET['site'] == "theses") {
		$where1 = "`site` = 'theses'";
	} else
	if ($_GET['site'] == "journal") {
		$where1 = "`site` = 'journal'";
	} else {
		$where1 = "1=1";
	}
	if ($_GET['type'] == "view") {
		$where2 = "`type` = 'view'";
	} else
	if ($_GET['type'] == "search") {
		$where2 = "`type` = 'search'";
	} else
	if ($_GET['type'] == "visit") {
		$where2 = "`type` = 'visit'";
	} else {
		$where2 = "2=2";
	}
	$sql_cst = "SELECT COUNT(*) AS 'total' FROM `".TB_STT."` WHERE ".$where1." AND ".$where2."";
	$res_cst = @mysql_query($sql_cst, $connection) or die(mysql_error());
	$row_cst = mysql_fetch_array($res_cst);
	$limit = 25;
	$page = $_GET['view'];
	if ($page) {
		$start = ($page - 1) * $limit;
	} else {
		$start = 0;
	}
	if ($page == 0) $page = 1;
?>
			<div id="subpage">
				<div class="panel_title">
					<img border="0" src="<?php echo SYS_DIR; ?>/images/admin_icon_stat.png">
					<h3>Statistik</h3>
				</div>
				<div style="float: left; margin: 10px 0; width: 100%;">
					<div id="pagination">
						<form action="" method="get">
							<input type="hidden" name="page" value="<?php echo $_GET['page']; ?>">
							<div id="pagesel"><b>Halaman:</b> <select name="view">
							<?php
								$page_total=ceil($row_cst['total']/$limit);
								for ($pages = 1; $pages <= $page_total; $pages++) {
									if ($page != $pages) {
										echo "<option value=\"".$pages."\">".$pages."</option>\n";
									} else {
										echo "<option value=\"".$pages."\" selected=\"selected\">".$pages."</option>\n";
									}
								}
							?>
							</select>
							<b>Tunjukkan:</b> <select name="site">
							<?php
								if (!isset($_GET['site']) || ($_GET['site'] == "all")) {
									echo "<option value=\"all\" selected=\"selected\">Tesis dan Jurnal</option>\n";
								} else {
									echo "<option value=\"all\">Tesis dan Jurnal</option>\n";
								}
								if ($_GET['site'] == "theses") {
									echo "<option value=\"theses\" selected=\"selected\">Hanya Tesis</option>\n";
								} else {
									echo "<option value=\"theses\">Hanya Tesis</option>\n";
								}
								if ($_GET['site'] == "journal") {
									echo "<option value=\"journal\" selected=\"selected\">Hanya Jurnal</option>\n";
								} else {
									echo "<option value=\"journal\">Hanya Jurnal</option>\n";
								}
							?>
							</select> <select name="type">
							<?php
								if (!isset($_GET['type']) || ($_GET['site'] == "type")) {
									echo "<option value=\"all\" selected=\"selected\">Semuanya</option>\n";
								} else {
									echo "<option value=\"all\">Semuanya</option>\n";
								}
								if ($_GET['type'] == "view") {
									echo "<option value=\"view\" selected=\"selected\">Lihat Dokumen</option>\n";
								} else {
									echo "<option value=\"view\">Lihat Dokumen</option>\n";
								}
								if ($_GET['type'] == "search") {
									echo "<option value=\"search\" selected=\"selected\">Pencarian</option>\n";
								} else {
									echo "<option value=\"search\">Pencarian</option>\n";
								}
								if ($_GET['type'] == "visit") {
									echo "<option value=\"visit\" selected=\"selected\">Berkunjung</option>\n";
								} else {
									echo "<option value=\"visit\">Berkunjung</option>\n";
								}
							?>
							</select>
							<input type="submit" value="Lihat"></div>
							<div id="pagesel" style="text-align: right">
								Ditemukan ada <?php echo $row_cst['total']; ?> rekaman
							</div>
						</form>
					</div>
					<table id="list" class="list_border stats" cellspacing="0" align="center">
						<tr style="background: #ddd;">
							<td width="120"><b>Tanggal</b></td>
							<td width="50"><b>Jenis</b></td>
							<td width="90"><b>Aktivitas</b></td>
							<td><b>Detail</b></td>
							<td width="180"><b>Pengakses</b></td>
							<td width="25"><b>Del</b></td>
						</tr>
						<?php
							$sql_list = "SELECT * FROM `".TB_STT."` WHERE ".$where1." AND ".$where2." ".
										"ORDER BY `datetime` DESC LIMIT ".$start.",".$limit."";
							$res_list = @mysql_query($sql_list, $connection) or die(mysql_error());
							while($row_list = mysql_fetch_array($res_list)) {
								echo "\n<tr>\n<td>".$row_list['datetime']."</td>\n<td>";
								switch ($row_list['site']) {
									case "theses":	echo "Tesis"; break;
									case "journal":	echo "Jurnal"; break;
									default:		echo $row_list['site'];
								}
								echo "</td>\n";
								switch ($row_list['type']) {
									case "view":
										$sql_svd = "SELECT * FROM `".TB_DOC."` WHERE `id` = '".$row_list['stamp']."'";
										$que_svd = @mysql_query($sql_svd, $connection);
										$row_svd = mysql_fetch_array($que_svd);
										echo "<td>Lihat Dokumen</td>\n<td><a href=\"#\" target=\"_blank\">".
											 substr($row_svd['judul'], 0, 60)."...</a></td>\n";
										break;
									case "search":
										echo "<td>Pencarian</td>\n<td><i>".$row_list['stamp']."</i></td>\n";
										break;
									case "visit":
										echo "<td>Berkunjung</td>\n<td>Halaman Depan</td>\n";
										break;
									default:
										echo "<td>".$row_list['type']."</td>\n<td>".$row_list['stamp']."</td>\n";
								}
								echo "<td>".$row_list['user']." @ ".$row_list['ip']."</td>\n".
									 "<td><form action=\"\" method=\"post\"><input type=\"hidden\" name=\"stat_id\" ".
									 "value=\"".$row_list['id']."\"><button type=\"submit\" name=\"delete\" value=\"Hapus\" ".
									 "title=\"Hapus\" onclick=\"return confirm('Are you sure to delete this item?')\">".
									 "<img border=\"0\" src=\"".SYS_DIR."/images/icon_delete.png\"></button>".
									 "</form></td>\n</tr>";
							}
						?>
					</table>
				</div>
			</div>