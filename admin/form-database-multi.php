<style>
#page, #menu_top {width: 95% !important}
#subpage {width: 97.5% !important}
#list input {width: 100% !important;}
</style>
<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="page" value="<?php echo $_GET['page']; ?>" />
	<input type="hidden" name="view" value="<?php echo $_GET['view']; ?>" />
	<table id="list" class="list_new" cellspacing="0" align="center" width="100%">
		<tr>
			<td width="112"><b>Jenis</b></td>
			<td><select name="type">
				<?php
					$sql1 = "SELECT * FROM `".TB_DBT."` ORDER BY `name` DESC";
					$que1 = @mysql_query($sql1, $connection);
					while($row1 = mysql_fetch_array($que1)) {
						echo "<option value=\"".$row1['id_type']."\"".($f_type==$row1['id_type'] ? " selected" : "").">".$row1['name']."</option>\n";
					}
				?>
			</select></td>
		</tr>
	</table>
	<br>
	<?php
		$sql2 = "SELECT * FROM `".TB_DBG."` ORDER BY `name` DESC";
		$que2 = @mysql_query($sql2, $connection);
		while($row2 = mysql_fetch_array($que2)) {
			$kat[$row2['id_group']] = $row2['alias'];
		}
	?>
	<table id="list" class="list_new" cellspacing="0" align="center" width="100%">
		<tr>
			<td width="20" height="30"><b>No</b></td>
			<td width="80"><b>Kategori</b></td>
			<td><b>Judul</b></td>
			<td><b>Penulis</b></td>
			<td><b>Nomor</b></td>
			<td><b>Tanggal</b></td>
			<td width="80"><b>Berkas</b></td>
			<td width="75"><b>Status</b></td>
		</tr>
		<?php for ($x = 1; $x <= 20; $x++) { ?>
		<tr>
			<td><center><b><?php echo $x; ?></b></center></td>
			<td><select name="group[<?php echo $x; ?>]"><option value="0"></option><?php
				foreach ($kat as $key1 => $val1) {
					echo "<option value=\"".$key1."\">".$val1."</option>\n";
				}
			?></select></td>
			<td><input type="text" name="title[<?php echo $x; ?>]" size="75" value="" /></td>
			<td><input type="text" name="author[<?php echo $x; ?>]" size="10" value="" /></td>
			<td><input type="text" name="number[<?php echo $x; ?>]" value="" /></td>
			<td><input type="text" name="date[<?php echo $x; ?>]" value="" /></td>
			<td><input type="file" name="file[<?php echo $x; ?>]"></td>
			<td><select name="status[<?php echo $x; ?>]">
				<option value="publish">Terbit</option>
				<option value="draft">Draft</option>
			</select></td>
		</tr>
		<?php } ?>
	</table>
	<br>
	<input type="submit" value="Simpan" name="multi-doc-save" onclick="return confirm('Apakah Anda yakin untuk menyimpan semua dokumen baru ini? Pastikan untuk meneliti kembali isian Anda!');">
	<button onclick="history.go(-1); return false;">Kembali</button>
</form>
