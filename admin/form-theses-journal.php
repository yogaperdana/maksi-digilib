<?php
	if ($_GET['page'] == 'new') {
		$var_getview = $_GET['view'];
		$f_kategori = $f_judul = $f_penulis = $f_nim = $f_dosen = $f_abstrak = $f_keyword = $f_intisari = $f_katakunci = $f_deskripsi = $f_konsentrasi = $f_angkatan = $f_wisuda = $f_kondisi = "";
		$f_bahasa = "Indonesia";
		$f_penerbit = "MAKSI FEB UGM";
		$f_lokasi = "MAKSI FEB UGM Yogyakarta";
	} else
	if ($_GET['page'] == 'edit') {
		$sql_edit = "SELECT * FROM `".TB_DOC."` WHERE `id` = '".$_GET['docID']."'";
		$res_edit = @mysql_query($sql_edit, $connection) or die(mysql_error());
		$row_edit = mysql_fetch_array($res_edit);
		$var_getview = $row_edit['jenis'];
		$f_kategori = $row_edit['kategori'];
		$f_kondisi = $row_edit['kondisi'];
		$f_judul = $row_edit['judul'];
		$f_penulis = $row_edit['penulis'];
		$f_nim = $row_edit['nim'];
		$f_dosen = $row_edit['dosen'];
		$f_abstrak = $row_edit['abstrak'];
		$f_keyword = $row_edit['keyword'];
		$f_intisari = $row_edit['intisari'];
		$f_katakunci = $row_edit['katakunci'];
		$f_deskripsi = $row_edit['deskripsi'];
		$f_konsentrasi = $row_edit['konsentrasi'];
		$f_angkatan = $row_edit['angkatan'];
		$f_wisuda = $row_edit['wisuda'];
		$f_bahasa = $row_edit['bahasa'];
		$f_penerbit = $row_edit['penerbit'];
		$f_lokasi = $row_edit['lokasi'];
		$f_berkas = $row_edit['berkas'];
	}
?>
<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="page" value="<?php echo $_GET['page']; ?>" />
	<input type="hidden" name="view" value="<?php echo $_GET['view']; ?>" />
	<input type="hidden" name="jenis" value="<?php echo $var_getview; ?>" />
	<?php if ($_GET['page'] == 'edit') { ?>
	<input type="hidden" name="docID" value="<?php echo $row_edit['id']; ?>" />
	<?php } ?>
	<table id="list" class="list_new" cellspacing="0" align="center">
		<?php if ($var_getview == 'journal') { ?>
		<tr>
			<td><b>Edisi</b></td>
			<td>
				<select name="kategori">
					<option value="0">-- Pilih Edisi Jurnal --</option>
					<?php
						$sql_ed = "SELECT * FROM `".TB_EDT."` ORDER BY `tanggal` DESC";
						$que_ed = @mysql_query($sql_ed, $connection);
						while($row_ed = mysql_fetch_array($que_ed)) {
							echo "<option value=\"".$row_ed['id']."\"".($f_kategori==$row_ed['id'] ? " selected" : "").">".$row_ed['nama']."</option>\n";
						}
					?>
				</select>
			</td>
		</tr>
		<?php } else { ?>
		<input type="hidden" name="kategori" value="0" />
		<?php } ?>
		<tr>
			<td width="100"><b>Judul</b></td>
			<td width="800"><input type="text" name="judul" value="<?php echo $f_judul; ?>" /></td>
		</tr>
		<tr>
			<td><b>Penulis</b></td>
			<td><input type="text" name="penulis" value="<?php echo $f_penulis; ?>" /></td>
		</tr>
		<tr>
			<td><b>NIM</b></td>
			<td><input type="text" name="nim" value="<?php echo $f_nim; ?>" /></td>
		</tr>
		<tr>
			<td><b>Pembimbing</b></td>
			<td><input type="text" name="dosen" value="<?php echo $f_dosen; ?>" /></td>
		</tr>
		<tr>
			<td><b>Abstrak (en)</b></td>
			<td><textarea rows="6" name="abstrak"><?php echo $f_abstrak; ?></textarea></td>
		</tr>
		<tr>
			<td><b>Keyword (en)</b></td>
			<td><input type="text" name="keyword" value="<?php echo $f_keyword; ?>" /></td>
		</tr>
		<tr>
			<td><b>Intisari</b></td>
			<td><textarea rows="6" name="intisari"><?php echo $f_intisari; ?></textarea></td>
		</tr>
		<tr>
			<td><b>Kata Kunci</b></td>
			<td><input type="text" name="katakunci" value="<?php echo $f_katakunci; ?>" /></td>
		</tr>
		<tr>
			<td><b>Deskripsi</b></td>
			<td><input type="text" name="deskripsi" value="<?php echo $f_deskripsi; ?>" /></td>
		</tr>
		<tr>
			<td><b>Konsentrasi</b></td>
			<td><input type="text" name="konsentrasi" value="<?php echo $f_konsentrasi; ?>" /></td>
		</tr>
		<tr>
			<td><b>Angkatan</b></td>
			<td><input type="text" name="angkatan" value="<?php echo $f_angkatan; ?>" /></td>
		</tr>
		<tr>
			<td><b>Periode Wisuda</b></td>
			<td><input type="text" name="wisuda" value="<?php echo $f_wisuda; ?>" /></td>
		</tr>
		<tr>
			<td><b>Bahasa</b></td>
			<td><input type="text" name="bahasa" value="<?php echo $f_bahasa; ?>" /></td>
		</tr>
		<tr>
			<td><b>Penerbit</b></td>
			<td><input type="text" name="penerbit" value="<?php echo $f_penerbit; ?>" /></td>
		</tr>
		<tr>
			<td><b>Lokasi</b></td>
			<td><input type="text" name="lokasi" value="<?php echo $f_lokasi; ?>" /></td>
		</tr>
		<tr>
			<td><b>Berkas</b></td>
			<td>
				<?php if ($_GET['page'] == 'edit') { ?>
					<input type="radio" name="doc_file" value="nochange" checked="checked"> Tidak ada perubahan berkas (tetap).<br>
					<input type="radio" name="doc_file" value="upload"> Upload berkas baru:<br>
					<div style="padding-left: 20px;">
						<input type="file" name="berkas" /><br>
						Ukuran file maks. <?php echo ($doc_file_maxsize/1024/1024); ?> MB, tipe berkas .swf.
					</div>
					<?php if (!empty($f_berkas)) { ?>
						<input type="radio" name="doc_file" value="delete"> Hapus berkas yang ada.<br>
					<?php } ?>
					<input type="hidden" name="berkas_lama" value="<?php echo $f_berkas; ?>">
					Berkas saat ini: <?php if (empty($f_berkas)) { echo "Tidak ada."; } else { echo $f_berkas; } ?>
				<?php } else { ?>
					<input type="hidden" name="doc_file" value="upload">
					<input type="file" name="berkas"><br>
					Ukuran file maks. <?php echo ($doc_file_maxsize/1024/1024); ?> MB, tipe berkas .swf.
				<?php } ?>
			</td>
		</tr>
		<tr>
			<td><b>Status</b></td>
			<td><select name="kondisi">
				<option value="publish"<?php if ($f_kondisi == 'publish') { echo " selected"; } ?>>Terbitkan</option>
				<option value="draft"<?php if ($f_kondisi == 'draft') { echo " selected"; } ?>>Ditangguhkan</option>
			</select></td>
		</tr>
	</table>
	<?php
		if ($_GET['page'] == 'edit') {
			$r_conf = "Apakah Anda yakin untuk menyimpan perubahan dokumen ini?";
		} else {
			$r_conf = "Apakah Anda yakin untuk menyimpan dokumen baru ini? Pastikan untuk meneliti kembali isian Anda!";
		}
	?>
	<br><input type="submit" value="Simpan" name="doc-save" onclick="return confirm('<?php echo $r_conf; ?>');">
	<button onclick="history.go(-1); return false;">Kembali</button>
</form>