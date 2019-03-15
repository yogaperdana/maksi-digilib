<?php
		if (isset($_POST['edit'])) {
			$sql_edit = "SELECT * FROM `".TB_PGM."` WHERE `id` = '".$_POST['id']."'";
			$res_edit = @mysql_query($sql_edit, $connection) or die(mysql_error());
			$row_edit = mysql_fetch_array($res_edit);
			$f_id = $row_edit['id'];
			$f_type = $row_edit['type'];
			$f_name = $row_edit['name'];
			$f_alias = $row_edit['alias'];
			$f_link = $row_edit['link'];
			$f_text = $row_edit['text'];
			$v_submit = 'Simpan';
			$n_submit = 'save';
		} else
		if (isset($_POST['save'])) {
			$p_type = mysql_real_escape_string($_POST['type']);
			$p_name = mysql_real_escape_string($_POST['name']);
			$p_alias = mysql_real_escape_string($_POST['alias']);
			$p_link = mysql_real_escape_string($_POST['link']);
			$p_text = mysql_real_escape_string($_POST['text']);
			$sql_upd = "UPDATE `".TB_PGM."` SET `type` = '".$p_type."', `name` = '".$p_name."', `alias` = '".$p_alias."', ".
						"`link` = '".$p_link."', `text` = '".$p_text."' WHERE `id` = '".$_POST['id']."'";
			$res_upd = mysql_query($sql_upd) or die(mysql_error());
			echo "<script language=\"JavaScript\" type=\"Text/JavaScript\">alert(\"Menu/halaman telah diperbarui!.\")</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=?page=menu\">";
			exit;
		} else
		if (isset($_POST['new'])) {
			$p_type = mysql_real_escape_string($_POST['type']);
			$p_name = mysql_real_escape_string($_POST['name']);
			$p_alias = mysql_real_escape_string($_POST['alias']);
			$p_link = mysql_real_escape_string($_POST['link']);
			$p_text = mysql_real_escape_string($_POST['text']);
			$sql_new = "INSERT INTO `".TB_PGM."` (`type`, `name`, `alias`, `link`, `text`) VALUES ".
						"('".$p_type."', '".$p_name."', '".$p_alias."', '".$p_link."', '".$p_text."')";
			$res_new = mysql_query($sql_new) or die(mysql_error());
			echo "<script language=\"JavaScript\" type=\"Text/JavaScript\">alert(\"Menu/halaman telah ditambahkan!.\")</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=?page=menu\">";
			exit;
		} else
		if (isset($_POST['delete'])) {
			$sql_del = "DELETE FROM `".TB_PGM."` WHERE `id` = '".$_POST['id']."'";
			$res_del = mysql_query($sql_del) or die(mysql_error());
			echo "<script language=\"JavaScript\" type=\"Text/JavaScript\">alert(\"Menu/halaman telah dihapus!.\")</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=?page=menu\">";
			exit;
		} else {
			$f_id = $f_type = $f_name = $f_alias = $f_link = $f_text = "";
			$v_submit = 'Tambah Baru';
			$n_submit = 'new';
		}
?>
			<div id="subpage">
				<div class="panel_title">
					<img border="0" src="<?php echo SYS_DIR; ?>/images/admin_icon_menu.png">
					<h3>Menu dan Halaman</h3>
				</div>
				<div style="float: left; margin: 10px 0; width: 100%;">
					<form action="" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $f_id; ?>" />
					<table id="list" class="list_new" cellspacing="0" align="center">
						<tr>
							<td width="100"><b>Jenis</b></td>
							<td width="810">
								<select name="type">
									<option value="0">-- Pilih Jenis --</option>
									<option value="t_link"<?php echo ($f_type=='t_link' ? " selected" : ""); ?>>Link untuk Tesis Digital</option>
									<option value="j_link"<?php echo ($f_type=='j_link' ? " selected" : ""); ?>>Link untuk Jurnal Online</option>
									<option value="t_page"<?php echo ($f_type=='t_page' ? " selected" : ""); ?>>Halaman untuk Tesis Digital</option>
									<option value="j_page"<?php echo ($f_type=='j_page' ? " selected" : ""); ?>>Halaman untuk Jurnal Online</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><b>Judul</b></td>
							<td><input type="text" name="name" value="<?php echo $f_name; ?>" /></td>
						</tr>
						<tr>
							<td><b>Alias</b></td>
							<td>
								<input type="text" name="alias" value="<?php echo $f_alias; ?>" style="width: 50%" />
								<font style="font-size:11px; margin-left: 5px;">Alias hanya untuk penamaan pada URL saja.</font>
							</td>
						</tr>
						<tr>
							<td><b>Link (URL)</b></td>
							<td><input type="text" name="link" value="<?php echo $f_link; ?>" /></td>
						</tr>
						<tr>
							<td><b>Konten</b></td>
							<td><textarea type="text" name="text" rows="5"><?php echo $f_text; ?></textarea></td>
						</tr>
					</table>
					<input type="submit" value="<?php echo $v_submit; ?>" name="<?php echo $n_submit; ?>">
					</form>
					<br>
					<table id="list" class="list_border" cellspacing="0" align="center">
						<tr style="background: #ddd;">
							<td width="150"><b>Jenis</b></td>
							<td><b>Judul</b></td>
							<td width="50"><b>Operasi</b></td>
						</tr>
						<?php
							$sql_list = "SELECT * FROM `".TB_PGM."` WHERE `type` != 'a_link' ORDER BY `type` ASC";
							$res_list = @mysql_query($sql_list, $connection) or die(mysql_error());
							while($row_list = mysql_fetch_array($res_list)) {
								echo "\n<tr>\n<td><b>";
								if ($row_list['type'] == 't_link') {
									echo "Link di Tesis";
								} else
								if ($row_list['type'] == 'j_link') {
									echo "Link di Jurnal";
								} else
								if ($row_list['type'] == 't_page') {
									echo "Halaman di Tesis";
								} else
								if ($row_list['type'] == 'j_page') {
									echo "Halaman di Jurnal";
								} else {
									echo $row_list['type'];
								}
								echo "</b></td>\n<td>".$row_list['name']."</td>\n".
									 "<td><form action=\"\" method=\"post\">".
									 "<input type=\"hidden\" name=\"id\" value=\"".$row_list['id']."\">".
									 "<button type=\"submit\" name=\"edit\" value=\"Sunting\" title=\"Sunting\">".
									 "<img border=\"0\" src=\"".SYS_DIR."/images/icon_edit.png\"></button>".
									 "<button type=\"submit\" name=\"delete\" value=\"Hapus\" title=\"Hapus\" ".
									 "onclick=\"return confirm('Apakah anda yakin akan menghapus menu/halaman ini?')\">".
									 "<img border=\"0\" src=\"".SYS_DIR."/images/icon_delete.png\"></button>".
									 "</form></td>\n</tr>";
							}
						?>
					</table>
				</div>
			</div>
