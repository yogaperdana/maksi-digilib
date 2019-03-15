<?php
		if (isset($_POST['edit'])) {
			$sql_edit = "SELECT * FROM `".TB_EDT."` WHERE `id` = '".$_POST['id']."'";
			$res_edit = @mysql_query($sql_edit, $connection) or die(mysql_error());
			$row_edit = mysql_fetch_array($res_edit);
			$f_id = $row_edit['id'];
			$f_nama = $row_edit['nama'];
			$f_alias = $row_edit['alias'];
			$f_tanggal = $row_edit['tanggal'];
			$f_catatan = $row_edit['catatan'];
			$v_submit = 'Simpan';
			$n_submit = 'save';
		} else
		if (isset($_POST['save'])) {
			$p_nama = mysql_real_escape_string($_POST['nama']);
			$p_alias = mysql_real_escape_string($_POST['alias']);
			$p_tanggal = mysql_real_escape_string($_POST['tanggal']);
			$p_catatan = mysql_real_escape_string($_POST['catatan']);
			$sql_upd = "UPDATE `".TB_EDT."` SET `alias` = '".$p_alias."', `nama` = '".$p_nama."', `tanggal` = '".$p_tanggal."', ".
						"`catatan` = '".$p_catatan."' WHERE `id` = '".$_POST['id']."'";
			$res_upd = mysql_query($sql_upd) or die(mysql_error());
			echo "<script language=\"JavaScript\" type=\"Text/JavaScript\">alert(\"Edisi telah diperbarui!.\")</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=?page=edition\">";
			exit;
		} else
		if (isset($_POST['new'])) {
			$p_nama = mysql_real_escape_string($_POST['nama']);
			$p_alias = mysql_real_escape_string($_POST['alias']);
			$p_tanggal = mysql_real_escape_string($_POST['tanggal']);
			$p_catatan = mysql_real_escape_string($_POST['catatan']);
			$sql_new = "INSERT INTO `".TB_EDT."` (`alias`, `nama`, `tanggal`, `catatan`) VALUES ".
						"('".$p_alias."', '".$p_nama."', '".$p_tanggal."', '".$p_catatan."')";
			$res_new = mysql_query($sql_new) or die(mysql_error());
			echo "<script language=\"JavaScript\" type=\"Text/JavaScript\">alert(\"Edisi telah ditambahkan!.\")</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=?page=edition\">";
			exit;
		} else
		if (isset($_POST['delete'])) {
			$sql_chk = "SELECT COUNT(*) AS total FROM `".TB_DOC."` WHERE `kategori` = '".$_POST['id']."'";
			$res_chk = @mysql_query($sql_chk, $connection) or die(mysql_error());
			$row_chk = mysql_fetch_array($res_chk);
			if ($row_chk['total'] == 0) {
				$sql_del = "DELETE FROM `".TB_EDT."` WHERE `id` = '".$_POST['id']."'";
				$res_del = mysql_query($sql_del) or die(mysql_error());
				echo "<script language=\"JavaScript\" type=\"Text/JavaScript\">alert(\"Edisi telah dihapus!.\")</script>";
			} else {
				echo "<script language=\"JavaScript\" type=\"Text/JavaScript\">alert(\"Maaf, masih ada dokumen yang masuk dalam kategori ini.\")</script>";
			}
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=?page=edition\">";
			exit;
		} else {
			$f_id = $f_nama = $f_alias = $f_tanggal = $f_catatan = "";
			$v_submit = 'Tambah Baru';
			$n_submit = 'new';
		}
?>
			<div id="subpage">
				<div class="panel_title">
					<img border="0" src="<?php echo SYS_DIR; ?>/images/admin_icon_folder.png">
					<h3>Edisi Jurnal</h3>
				</div>
				<div style="float: left; margin: 10px 0;">
					<form action="" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $f_id; ?>" />
					<table id="list" class="list_new" cellspacing="0" align="center">
						<tr>
							<td width="100"><b>Nama Edisi</b></td>
							<td width="810"><input type="text" name="nama" value="<?php echo $f_nama; ?>" /></td>
						</tr>
						<tr>
							<td><b>Alias</b></td>
							<td>
								<input type="text" name="alias" value="<?php echo $f_alias; ?>" style="width: 50%" />
								<font style="font-size:11px; margin-left: 5px;">Alias hanya untuk penamaan pada URL saja.</font>
							</td>
						</tr>
						<tr>
							<td><b>Tanggal Terbit</b></td>
							<td>
								<input type="text" name="tanggal" value="<?php echo $f_tanggal; ?>" style="width: 50%" />
								<font style="font-size:11px; margin-left: 5px;">Format: YYYY-MM-DD (Contoh: 2013-07-01)</font>
							</td>
						</tr>
						<tr>
							<td><b>Catatan</b></td>
							<td><input type="text" name="catatan" value="<?php echo $f_catatan; ?>" /></td>
						</tr>
					</table>
					<input type="submit" value="<?php echo $v_submit; ?>" name="<?php echo $n_submit; ?>">
					</form>
					<br>
					<table id="list" class="list_border" cellspacing="0" align="center">
						<tr style="background: #ddd;">
							<td width="200"><b>Nama Edisi</b></td>
							<td width="110"><b>Alias</b></td>
							<td width="110"><b>Tanggal</b></td>
							<td width="50"><b>Dokumen</b></td>
							<td><b>Catatan</b></td>
							<td width="45"><b>Operasi</b></td>
						</tr>
						<?php
							$sql_list = "SELECT * FROM `".TB_EDT."` ORDER BY `tanggal` DESC";
							$res_list = @mysql_query($sql_list, $connection) or die(mysql_error());
							while($row_list = mysql_fetch_array($res_list)) {
								$entrydate = date('j ', strtotime($row_list['tanggal'])).
											 $array_bulan[date('n', strtotime($row_list['tanggal']))].
											 date(' Y', strtotime($row_list['tanggal']));
								$ed_sql = "SELECT COUNT(*) AS TOTAL FROM `".TB_DOC."` ".
										  "WHERE `kategori` = '".$row_list['id']."'";
								$ed_que = @mysql_query($ed_sql, $connection);
								$ed_doc = mysql_fetch_array($ed_que);
								echo "\n<tr>\n<td><b>".$row_list['nama']."</b></td>\n".
									 "<td>".$row_list['alias']."</td>\n".
									 "<td>".$entrydate."</td>\n".
									 "<td>".$ed_doc['TOTAL']."</td>\n".
									 "<td>".$row_list['catatan']."</td>\n".
									 "<td><form action=\"\" method=\"post\">".
									 "<input type=\"hidden\" name=\"id\" value=\"".$row_list['id']."\">".
									 "<button type=\"submit\" name=\"edit\" value=\"Sunting\" title=\"Sunting\">".
									 "<img border=\"0\" src=\"".SYS_DIR."/images/icon_edit.png\"></button>".
									 "<button type=\"submit\" name=\"delete\" value=\"Hapus\" title=\"Hapus\" ".
									 "onclick=\"return confirm('Apakah anda yakin akan menghapus edisi jurnal ini?')\">".
									 "<img border=\"0\" src=\"".SYS_DIR."/images/icon_delete.png\"></button>".
									 "</form></td>\n</tr>";
							}
						?>
					</table>
				</div>
			</div>
