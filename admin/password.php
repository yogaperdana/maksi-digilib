<?php
		if (isset($_POST['newpass'])) {
			$p_passwd = mysql_real_escape_string($_POST['password']);
			$p_expire = mysql_real_escape_string($_POST['expire']);
			$p_name = mysql_real_escape_string($_POST['name']);
			$p_from = mysql_real_escape_string($_POST['from']);
			$p_purpose = mysql_real_escape_string($_POST['purpose']);
			$p_access = ""; $pp = 0;
			foreach ($_POST['access'] as $field => $value) {
				if ($pp == 1) {$p_access .= "|";}
				$p_access .= mysql_real_escape_string($value); $pp = 1;
			}
			$sql_val = "SELECT *, COUNT(*) AS 'total' FROM `".TB_PWD."` WHERE `sandi` = '".$p_passwd."'";
			$res_val = @mysql_query($sql_val, $connection) or die(mysql_error());
			$row_val = mysql_fetch_array($res_val);
			if ($row_val['total'] == 0) {
				$sql_new = "INSERT INTO `".TB_PWD."` (`sandi`, `masa`, `akses`, `nama`, `asal`, `tujuan`) ".
						   "VALUES ('".$p_passwd."', '".$p_expire."', '".$p_access."', '".$p_name."', '".$p_from."', '".$p_purpose."')";
				$res_new = mysql_query($sql_new) or die(mysql_error());
				echo "<script language=\"JavaScript\" type=\"Text/JavaScript\">alert(\"Kata sandi telah ditambahkan!.\")</script>";
			} else {
				echo "<script language=\"JavaScript\" type=\"Text/JavaScript\">".
					 "alert(\"Kata sandi tersebut sudah digunakan!.\")</script>";
			}
		} else
		if (isset($_POST['renew'])) {
			$sql_upd = "UPDATE `".TB_PWD."` SET `waktu` = '0' WHERE `id` = '".$_POST['id']."'";
			$res_upd = mysql_query($sql_upd) or die(mysql_error());
			echo "<script language=\"JavaScript\" type=\"Text/JavaScript\">alert(\"Masa berlaku telah diperbarui!.\")</script>";
		} else
		if (isset($_POST['delete'])) {
			$sql_del = "DELETE FROM `".TB_PWD."` WHERE `id` = '".$_POST['id']."'";
			$res_del = mysql_query($sql_del) or die(mysql_error());
			echo "<script language=\"JavaScript\" type=\"Text/JavaScript\">alert(\"Kata sandi telah dihapus!.\")</script>";
		}
?>
			<style>.list12px td {font-size: 12px;}</style>
			<div id="subpage">
				<div class="panel_title">
					<img border="0" src="<?php echo SYS_DIR; ?>/images/admin_icon_manage.png">
					<h3>Kelola Kata Sandi</h3>
				</div>
				<div style="margin: 10px 0;">
					
					<script>
					var keylist="ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789"
					var temp=''
					function generatepass(plength) {
						temp=''
						for (i=0;i<plength;i++)
						temp+=keylist.charAt(Math.floor(Math.random()*keylist.length))
						return temp
					}
					function populateform(enterlength){
						document.pgenerate.password.value=generatepass(enterlength)
					}
					</script>

					<form action="" method="post" enctype="multipart/form-data" name="pgenerate">
					<input type="hidden" name="id" value="<?php echo $f_id; ?>">
					<div style="float: left; width: 98%; padding: 10px; margin-bottom: 10px; background: #eee;">
					<table id="list" cellspacing="0" align="center">
						<tr>
							<td width="95"><b>Kata Sandi</b></td>
							<td width="170"><input type="text" name="password" style="font-family:courier;"></td>
							<td width="80" style="padding-left: 15px;"><b>Nama</b></td>
							<td width="200"><input type="text" name="name"></td>
							<td width="60" style="padding-left: 15px;" rowspan="2"><b>Akses</b></td>
							<td rowspan="2">
								<input type="checkbox" name="access[]" value="J"> Jurnal<br>
								<input type="checkbox" name="access[]" value="T"> Tesis<br>
								<input type="checkbox" name="access[]" value="D"> Database
							</td>
						</tr>
						<tr>
							<td><b>Generator</b></td>
							<td>Panjang: 
								<input type="text" name="thelength" size="2" value="8" style="width:auto;">
								<input type="button" value="Buat Acak" 
								onClick="populateform(this.form.thelength.value)" style="width:auto;"></td>
							<td style="padding-left: 15px;"><b>Instansi</b></td>
							<td><input type="text" name="from"></td>
						</tr>
						<tr>
							<td><b>Masa Berlaku</b></td>
							<td><input type="text" name="expire" size="3" value="120" style="width:auto;margin:0;"> menit</td>
							<td style="padding-left: 15px;"><b>Keperluan</b></td>
							<td><input type="text" name="purpose"></td>
							<td style="padding-left: 15px;" colspan="2">
								<input type="submit" value="Simpan Kata Sandi" name="newpass" 
								style="font-weight: bold; margin: 2px 1px;">
							</td>
						</tr>
					</table>
					</div>
					</form>
					<br><br>
					<b>Waktu Saat Ini</b>: <?php echo date('d/m/Y H:i:s'); ?>
					<br>
				</div>
				<div style="margin: 0;">
					<table id="list" class="list_border list12px" cellspacing="0" align="center" width="100%">
						<tr style="background: #ddd;">
							<td><b>No</b></td>
							<td><b>Kata Sandi</b></td>
							<td><b>Nama</b></td>
							<td><b>Instansi</b></td>
							<td><b>Keperluan</b></td>
							<td><b>Waktu Login</b></td>
							<td><b>Kadaluarsa</b></td>
							<td><b>Berlaku</b></td>
							<td><b>Akses</b></td>
							<td><b>Pilihan</b></td>
						</tr>
						<?php
							$no = 1;
							$sql_list = "SELECT * FROM `".TB_PWD."` ORDER BY `waktu` DESC, `sandi` ASC";
							$res_list = @mysql_query($sql_list, $connection) or die(mysql_error());
							while($row_list = mysql_fetch_array($res_list)) {
								echo "\n<tr>\n<td width=\"10\">".$no++."</td>\n".
									 "<td style=\"font-family:courier;\"><b>".$row_list['sandi']."</b></td>".
									 "<td>".$row_list['nama']."</td>\n<td>".$row_list['asal']."</td>\n".
									 "<td>".$row_list['tujuan']."</td>\n<td style=\"font-family:courier;\" nowrap>";
								if ($row_list['waktu'] != "0000-00-00 00:00:00") {
									echo date('d-M-y H:i:s', strtotime($row_list['waktu']));
								}
								echo "</td>\n<td style=\"font-family:courier;\" nowrap>";
								if ($row_list['waktu'] != "0000-00-00 00:00:00") {
									$futureDate = strtotime($row_list['waktu'])+(60*$row_list['masa']);
									echo date('d-M-y H:i:s', $futureDate);
								}
								$acctype = ""; $pt = 0;
								$exacc = explode("|", $row_list['akses']);
								foreach ($exacc as $keya => $vala) {
									if ($pt == 1) {$acctype .= ", ";}
									switch ($vala) {
										case "J": $acctype .= "Jurnal"; break;
										case "T": $acctype .= "Tesis"; break;
										case "D": $acctype .= "Database"; break;
									} $pt = 1;
								}
								echo "</td>\n<td nowrap>".$row_list['masa']." menit</td>\n<td>".$acctype."</td>\n".
									 "<td style=\"padding: 2px;\" nowrap><form action=\"\" method=\"post\">".
									 "<input type=\"hidden\" name=\"id\" value=\"".$row_list['id']."\">".
									 "<input type=\"submit\" name=\"renew\" value=\"Perbarui\" title=\"Perbarui\" ".
									 "style=\"width: auto !important; padding: 3px 7px;\" ".
									 "onclick=\"return confirm('Apakah anda yakin untuk memperbarui masa berlaku sandi ini?')\">".
									 "<input type=\"submit\" name=\"delete\" value=\"X\" title=\"Hapus\" ".
									 "style=\"width: auto !important; padding: 3px 7px; margin-left:2px; color: red;\" ".
									 "onclick=\"return confirm('Apakah anda yakin akan menghapus kata sandi ini?')\">".
									 "</form></td>\n</tr>";
							}
						?>
					</table>
					
				</div>
			</div>
			
