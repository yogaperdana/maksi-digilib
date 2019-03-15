<?php
		$a_t_title		= def_var("theses", "site", "title");
		$a_t_name		= def_var("theses", "site", "name");
		$a_t_sub		= def_var("theses", "site", "note");
		$a_t_header		= def_var("theses", "site", "header");
		$a_t_welcome	= def_var("theses", "site", "welcome");
		$a_j_title		= def_var("journal", "site", "title");
		$a_j_name		= def_var("journal", "site", "name");
		$a_j_sub		= def_var("journal", "site", "note");
		$a_j_header		= def_var("journal", "site", "header");
		$a_j_welcome	= def_var("journal", "site", "welcome");
		$a_j_editor		= def_var("journal", "site", "editor");
		$a_t_ftxtsa		= def_var("theses", "site", "ftxt_site_allow");
		$a_j_ftxtsa		= def_var("journal", "site", "ftxt_site_allow");
		$a_ftxtmd		= def_var("all", "site", "ftxt_msg_deny");
		$a_ftxtip		= def_var("all", "site", "ftxt_ip_deny");
		if (isset($_POST['save'])) {
			$p_t_title		= mysql_real_escape_string($_POST['t_title']);
			$p_t_name		= mysql_real_escape_string($_POST['t_name']);
			$p_t_sub		= mysql_real_escape_string($_POST['t_sub']);
			$p_t_header		= mysql_real_escape_string($_POST['t_header']);
			$p_t_welcome	= mysql_real_escape_string($_POST['t_welcome']);
			$p_j_title		= mysql_real_escape_string($_POST['j_title']);
			$p_j_name		= mysql_real_escape_string($_POST['j_name']);
			$p_j_sub		= mysql_real_escape_string($_POST['j_sub']);
			$p_j_header		= mysql_real_escape_string($_POST['j_header']);
			$p_j_welcome	= mysql_real_escape_string($_POST['j_welcome']);
			$p_j_editor		= mysql_real_escape_string($_POST['j_editor']);
			$p_t_ftxtsa		= mysql_real_escape_string($_POST['t_ftxtsa']);
			$p_j_ftxtsa		= mysql_real_escape_string($_POST['j_ftxtsa']);
			$p_ftxtmd		= mysql_real_escape_string($_POST['ftxtmd']);
			$p_ftxtip		= mysql_real_escape_string($_POST['ftxtip']);
			$s_append		= "UPDATE `".TB_OPT."` SET `value2` = ";
			$s_t_title		= $s_append."'".$p_t_title."' WHERE `field` = 'theses_site' AND `value1` = 'title'";
			$s_t_name		= $s_append."'".$p_t_name."' WHERE `field` = 'theses_site' AND `value1` = 'name'";
			$s_t_sub		= $s_append."'".$p_t_sub."' WHERE `field` = 'theses_site' AND `value1` = 'note'";
			$s_t_header		= $s_append."'".$p_t_header."' WHERE `field` = 'theses_site' AND `value1` = 'header'";
			$s_t_welcome	= $s_append."'".$p_t_welcome."' WHERE `field` = 'theses_site' AND `value1` = 'welcome'";
			$s_j_title		= $s_append."'".$p_j_title."' WHERE `field` = 'journal_site' AND `value1` = 'title'";
			$s_j_name		= $s_append."'".$p_j_name."' WHERE `field` = 'journal_site' AND `value1` = 'name'";
			$s_j_sub		= $s_append."'".$p_j_sub."' WHERE `field` = 'journal_site' AND `value1` = 'note'";
			$s_j_header		= $s_append."'".$p_j_header."' WHERE `field` = 'journal_site' AND `value1` = 'header'";
			$s_j_welcome	= $s_append."'".$p_j_welcome."' WHERE `field` = 'journal_site' AND `value1` = 'welcome'";
			$s_j_editor		= $s_append."'".$p_j_editor."' WHERE `field` = 'journal_site' AND `value1` = 'editor'";
			$s_t_ftxtsa		= $s_append."'".$p_t_ftxtsa."' WHERE `field` = 'theses_site' AND `value1` = 'ftxt_site_allow'";
			$s_j_ftxtsa		= $s_append."'".$p_j_ftxtsa."' WHERE `field` = 'journal_site' AND `value1` = 'ftxt_site_allow'";
			$s_ftxtmd		= $s_append."'".$p_ftxtmd."' WHERE `field` = 'all_site' AND `value1` = 'ftxt_msg_deny'";
			$s_ftxtip		= $s_append."'".$p_ftxtip."' WHERE `field` = 'all_site' AND `value1` = 'ftxt_ip_deny'";
			$r_t_title		= mysql_query($s_t_title) or die(mysql_error());
			$r_t_name		= mysql_query($s_t_name) or die(mysql_error());
			$r_t_sub		= mysql_query($s_t_sub) or die(mysql_error());
			$r_t_header		= mysql_query($s_t_header) or die(mysql_error());
			$r_t_welcome	= mysql_query($s_t_welcome) or die(mysql_error());
			$r_j_title		= mysql_query($s_j_title) or die(mysql_error());
			$r_j_name		= mysql_query($s_j_name) or die(mysql_error());
			$r_j_sub		= mysql_query($s_j_sub) or die(mysql_error());
			$r_j_header		= mysql_query($s_j_header) or die(mysql_error());
			$r_j_welcome	= mysql_query($s_j_welcome) or die(mysql_error());
			$r_j_editor		= mysql_query($s_j_editor) or die(mysql_error());
			$r_t_ftxtsa		= mysql_query($s_t_ftxtsa) or die(mysql_error());
			$r_j_ftxtsa		= mysql_query($s_j_ftxtsa) or die(mysql_error());
			$r_ftxtmd		= mysql_query($s_ftxtmd) or die(mysql_error());
			$r_ftxtip		= mysql_query($s_ftxtip) or die(mysql_error());
			echo "<script language=\"JavaScript\" type=\"Text/JavaScript\">alert(\"Pengaturan telah diperbarui!.\")</script>";
			echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=?page=option\">";
			exit;
		}
		if (isset($_POST["a_update"])) {
		
			if(login($_SESSION['email'], $_POST['pass_old'], $mysqli) == true) {
				if ($_POST['pass_new'] == $_POST['pass_con']) {
					$ses_email = $_SESSION['email'];
					$password = $_POST['pass_new'];
					$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
					$password = hash('sha512', $password.$random_salt);
					if ($upd_stmt = $mysqli->prepare("UPDATE ".TB_USR." SET `password` = '".$password."', `salt` = '".$random_salt."' WHERE email = '".$ses_email."'")) {
						$upd_stmt->execute();
					}
					$_SESSION = array();
					$params = session_get_cookie_params();
					setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
					session_destroy();
					sec_session_start();
					if(login($_SESSION['email'], $_POST['pass_new'], $mysqli) == true) {
						echo "<script language=\"JavaScript\" type=\"Text/JavaScript\">alert(\"Password has been updated. Please remember the new password.\")</script>";
					}
				} else {
					echo "<script language=\"JavaScript\" type=\"Text/JavaScript\">alert(\"Sorry, confirm password mismatched with the new password. Please try again.\")</script>";
				}
			} else {
				echo "<script language=\"JavaScript\" type=\"Text/JavaScript\">alert(\"Sorry, old password is wrong. Please try again.\")</script>";
			}
			
		}
?>
			<div id="subpage">
				<div class="panel_title">
					<img border="0" src="<?php echo SYS_DIR; ?>/images/admin_icon_config.png">
					<h3>Pengaturan Sistem</h3>
				</div>
				<div style="float: left; margin: 10px 0; width: 100%;">
					<form action="" method="post" enctype="multipart/form-data">
					<table id="list" class="list_border" cellspacing="0" align="center">
						<tr>
							<th colspan="2">Tesis Digital</th>
						</tr>
						<tr>
							<td><b>Judul Situs</b></td>
							<td><input type="text" name="t_title" size="60" value="<?php echo $a_t_title; ?>" /></td>
						</tr>
						<tr>
							<td><b>Teks Judul</b></td>
							<td>
								<input type="text" name="t_name" size="60" value="<?php echo $a_t_name; ?>" style="width: 75%" />
								<font style="font-size:11px; margin-left: 5px;">Teks di bawah logo</font>
							</td>
						</tr>
						<tr>
							<td><b>Sub Judul</b></td>
							<td><input type="text" name="t_sub" size="60" value="<?php echo $a_t_sub; ?>" style="width: 75%" />
								<font style="font-size:11px; margin-left: 5px;">Teks di atas pewaktu</font>
							</td>
						</tr>
						<tr>
							<td><b>Berkas Header</b></td>
							<td>
								<input type="text" name="t_header" size="60" value="<?php echo $a_t_header; ?>" style="width: 75%" />
								<font style="font-size:11px; margin-left: 5px;">Berkas di folder /system/images/</font>
							</td>
						</tr>
						<tr>
							<td><b>Teks Selamat Datang</b></td>
							<td><textarea name="t_welcome" rows="6"><?php echo $a_t_welcome; ?></textarea></td>
						</tr>
						<tr>
							<th colspan="2">Jurnal Online</th>
						</tr>
						<tr>
							<td><b>Judul Situs</b></td>
							<td><input type="text" name="j_title" size="60" value="<?php echo $a_j_title; ?>" /></td>
						</tr>
						<tr>
							<td><b>Teks Judul</b></td>
							<td>
								<input type="text" name="j_name" size="60" value="<?php echo $a_j_name; ?>" style="width: 75%" />
								<font style="font-size:11px; margin-left: 5px;">Teks di bawah logo</font>
							</td>
						</tr>
						<tr>
							<td><b>Sub Judul</b></td>
							<td>
								<input type="text" name="j_sub" size="60" value="<?php echo $a_j_sub; ?>" style="width: 75%" />
								<font style="font-size:11px; margin-left: 5px;">Teks di atas pewaktu</font>
							</td>
						</tr>
						<tr>
							<td><b>Berkas Header</b></td>
							<td>
								<input type="text" name="j_header" size="60" value="<?php echo $a_j_header; ?>" style="width: 75%" />
								<font style="font-size:11px; margin-left: 5px;">Berkas di folder /system/images/</font>
							</td>
						</tr>
						<tr>
							<td><b>Teks Selamat Datang</b></td>
							<td><textarea name="j_welcome" rows="6"><?php echo $a_j_welcome; ?></textarea></td>
						</tr>
						<tr>
							<td><b>Editorial Jurnal</b></td>
							<td><textarea name="j_editor" rows="6"><?php echo $a_j_editor; ?></textarea></td>
						</tr>
						<tr>
							<th colspan="2">Akses Dokumen</th>
						</tr>
						<tr>
							<td><b>Akses Full Text</b></td>
							<td>
								<select name="t_ftxtsa">
									<option value="TRUE"<?php echo ($a_t_ftxtsa=="TRUE" ? " selected" : ""); ?>>Tesis: Izinkan akses</option>
									<option value="FALSE"<?php echo ($a_t_ftxtsa=="FALSE" ? " selected" : ""); ?>>Tesis: Jangan izinkan</option>
								</select>
								<select name="j_ftxtsa">
									<option value="TRUE"<?php echo ($a_j_ftxtsa=="TRUE" ? " selected" : ""); ?>>Jurnal: Izinkan akses</option>
									<option value="FALSE"<?php echo ($a_j_ftxtsa=="FALSE" ? " selected" : ""); ?>>Jurnal: Jangan izinkan</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><b>Pesan Tidak Diizinkan</b></td>
							<td><input type="text" name="ftxtmd" value="<?php echo $a_ftxtmd; ?>" /></td>
						</tr>
						<tr>
							<td><b>Tolak Akses IP</b></td>
							<td><input type="text" name="ftxtip" value="<?php echo $a_ftxtip; ?>" /></td>
						</tr>
					</table>
					<br><input type="submit" name="save" value="Simpan Pengaturan">
					</form>
					<br>
					<form action="" method="post" enctype="multipart/form-data">
					<table id="list" class="list_border" cellspacing="0" align="center">
						<tr>
							<th colspan="2">Ubah Kata Sandi</th>
						</tr>
						<tr>
							<td><b>Nama Pengguna</b></td>
							<td><input type="text" name="email" size="60" value="<?php echo $_SESSION['email']; ?>" disabled="disabled" /></td>
						</tr>
						<tr>
							<td><b>Kata Sandi Lama</b></td>
							<td><input type="password" name="pass_old" size="60" value="" /></td>
						</tr>
						<tr>
							<td><b>Kata Sandi Baru</b></td>
							<td><input type="password" name="pass_new" size="60" value="" /></td>
						</tr>
						<tr>
							<td><b>Ulangi Kata Sandi Baru</b></td>
							<td><input type="password" name="pass_con" size="60" value="" /></td>
						</tr>
					</table>
					<br><input type="submit" name="a_update" value="Perbarui Kata Sandi">
					</form>
				</div>
			</div>
