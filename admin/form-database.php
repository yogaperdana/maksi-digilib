<?php
	if ($_GET['page'] == 'new') {
		$f_type = $f_group = $f_title = $f_author = $f_number = $f_date = $f_desc = $f_file = $f_status = "";
	} else
	if ($_GET['page'] == 'edit') {
		$sql_edit = "SELECT * FROM `".TB_DBD."` ".
					"LEFT JOIN `".TB_DBG."` ON `".TB_DBG."`.`id_group` = `".TB_DBD."`.`id_group`".
					"WHERE `".TB_DBD."`.`id_doc` = '".$_GET['docID']."' ";
		$res_edit = @mysql_query($sql_edit, $connection) or die(mysql_error());
		$row_edit = mysql_fetch_array($res_edit);
		$f_type = $row_edit['id_type'];
		$f_group = $row_edit['id_group'];
		$f_title = $row_edit['title'];
		$f_author = $row_edit['author'];
		$f_number = $row_edit['number'];
		$f_date = $row_edit['date'];
		$f_desc = $row_edit['description'];
		$f_file = $row_edit['file'];
		$f_status = $row_edit['status'];
	}
?>
<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="page" value="<?php echo $_GET['page']; ?>" />
	<input type="hidden" name="view" value="<?php echo $_GET['view']; ?>" />
	<?php if ($_GET['page'] == 'edit') { ?>
	<input type="hidden" name="id_doc" value="<?php echo $row_edit['id_doc']; ?>" />
	<?php } ?>
	<table id="list" class="list_new" cellspacing="0" align="center">
		<tr>
			<td width="100"><b>Jenis</b></td>
			<td width="800"><select name="type">
				<option value="0">Pilih Jenis</option>
				<?php
					$sql1 = "SELECT * FROM `".TB_DBT."` ORDER BY `name` DESC";
					$que1 = @mysql_query($sql1, $connection);
					while($row1 = mysql_fetch_array($que1)) {
						echo "<option value=\"".$row1['id_type']."\"".($f_type==$row1['id_type'] ? " selected" : "").">".$row1['name']."</option>\n";
					}
				?>
			</select></td>
		</tr>
		<tr>
			<td><b>Kategori</b></td>
			<td><select name="group">
				<option value="0">Pilih Kategori</option>
				<?php
					$sql2 = "SELECT * FROM `".TB_DBG."` ORDER BY `name` DESC";
					$que2 = @mysql_query($sql2, $connection);
					while($row2 = mysql_fetch_array($que2)) {
						echo "<option value=\"".$row2['id_group']."\"".($f_group==$row2['id_group'] ? " selected" : "").">".$row2['name']."</option>\n";
					}
				?>
			</select></td>
		</tr>
		<tr>
			<td><b>Judul</b></td>
			<td><input type="text" name="title" value="<?php echo $f_title; ?>" /></td>
		</tr>
		<tr>
			<td><b>Penulis</b></td>
			<td><input type="text" name="author" value="<?php echo $f_author; ?>" /></td>
		</tr>
		<tr>
			<td><b>Nomor</b></td>
			<td><input type="text" name="number" value="<?php echo $f_number; ?>" /></td>
		</tr>
		<tr>
			<td><b>Tanggal</b></td>
			<td><input type="text" name="date" value="<?php echo $f_date; ?>" /></td>
		</tr>
		<tr>
			<td><b>Deskripsi</b></td>
			<td><textarea rows="6" name="desc"><?php echo $f_desc; ?></textarea></td>
		</tr>
		<tr>
			<td><b>Berkas</b></td>
			<td>
				<?php if ($_GET['page'] == 'edit') { ?>
					<input type="radio" name="doc_file" value="nochange" checked="checked"> Tidak ada perubahan berkas (tetap).<br>
					<input type="radio" name="doc_file" value="upload"> Upload berkas baru:<br>
					<div style="padding-left: 20px;">
						<input type="file" name="file" /><br>
						Ukuran file maks. <?php echo ($doc_file_maxsize/1024/1024); ?> MB, tipe berkas .pdf.
					</div>
					<?php if (!empty($f_file)) { ?>
						<input type="radio" name="doc_file" value="delete"> Hapus berkas yang ada.<br>
						<input type="hidden" name="doc_old" value="<?php echo $f_file; ?>">
					<?php } ?>
					Berkas saat ini: <?php if (empty($f_file)) { echo "Tidak ada."; } else { echo $f_file; } ?>
				<?php } else { ?>
					<input type="hidden" name="doc_file" value="upload">
					<input type="file" name="file"><br>
					Ukuran file maks. <?php echo ($doc_file_maxsize/1024/1024); ?> MB, tipe berkas .pdf.
				<?php } ?>
			</td>
		</tr>
		<tr>
			<td><b>Status</b></td>
			<td><select name="status">
				<option value="publish"<?php if ($f_status == 'publish') { echo " selected"; } ?>>Terbitkan</option>
				<option value="draft"<?php if ($f_status == 'draft') { echo " selected"; } ?>>Ditangguhkan</option>
			</select></td>
		</tr>
	</table>
	<br>
	<?php
		if ($_GET['page'] == 'edit') {
			$r_conf = "Apakah Anda yakin untuk menyimpan perubahan dokumen ini?";
		} else {
			$r_conf = "Apakah Anda yakin untuk menyimpan dokumen baru ini? Pastikan untuk meneliti kembali isian Anda!";
		}
	?>
	<input type="submit" value="Simpan" name="doc-save" onclick="return confirm('<?php echo $r_conf; ?>');">
	<button onclick="history.go(-1); return false;">Kembali</button>
</form>
