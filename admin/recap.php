
<?php
	if (!isset($_POST['type'])) {
		$f_type = "";
	} else {
		$f_type = $_POST['type'];
	}
	if (!isset($_POST['dosen'])) {
		$f_dos = "";
	} else {
		$f_dos = $_POST['dosen'];
	}
?>
			<div id="subpage">
				<div class="panel_title">
					<img border="0" src="<?php echo SYS_DIR; ?>/images/admin_icon_manage.png">
					<h3>Rekap Dokumen</h3>
				</div>
				<div style="float: left; margin: 0;">
					<form action="" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $f_id; ?>" />
					Jenis Dokumen:
					<select name="type">
						<option value="theses" <?php echo $f_type=='theses' ? " selected" : ""; ?>>Tesis</option>
						<option value="journal" <?php echo $f_type=='journal' ? " selected" : ""; ?>>Jurnal</option>
					</select>
					<!---<select name="dosen">
						<option value="Y" <?php echo $f_dos=='Y' ? " selected" : ""; ?>>Dengan Dosen</option>
						<option value="N" <?php echo $f_dos=='N' ? " selected" : ""; ?>>Tanpa Dosen</option>
						<option value="A" <?php echo $f_dos=='A' ? " selected" : ""; ?>>Semuanya</option>
					</select>--->
					<input type="submit" name="recap" value="Tampilkan Rekap">
					</form>
					<br>
					<?php if (isset($_POST['recap'])) { ?>
					<table id="list" class="list_border" cellspacing="0" align="center">
						<tr style="background: #ddd;">
							<td><b>No.</b></td>
							<td><b>Nama Penulis</b></td>
							<td><b>Judul</b></td>
							<td><b>Tanggal</b></td>
						</tr>
						<?php
							$num = 1;
							$sql_list = "SELECT `penulis`, `dosen`, `judul`, `tanggal` FROM `".TB_DOC."`
										 WHERE `jenis` = 'journal' AND `dosen` != '' AND `dosen` != '-'
										 ORDER BY `penulis` ASC";
							$res_list = @mysql_query($sql_list, $connection) or die(mysql_error());
							while($row_list = mysql_fetch_array($res_list)) {
								echo "<tr><td>".$num++."</td><td>".$row_list['penulis'].", ".$row_list['dosen']."</td>".
									 "<td>".$row_list['judul']."</td>".
									 "<td nowrap='nowrap'>".date('d-m-Y', strtotime($row_list['tanggal']))."</td></tr>";
							}
						?>
					</table>
					<?php } ?>
				</div>
			</div>