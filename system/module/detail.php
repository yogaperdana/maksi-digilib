<?php
	
	if ( $sitetype == 'admin' ) {
		$site_type = "1=1";
	} else {
		$site_type = "`jenis` = '".$sitetype."'";
	}
	if (!isset($_POST['auth_pass_fdoc'])) {
		$disp_no = "display:none; ";
		$disp_yes = "";
	} else {
		$disp_no = "";
		$disp_yes = "display:none; ";
	}
	$sql_view = "SELECT *, COUNT(*) AS found FROM `".TB_DOC."` WHERE `id` = '".$_GET['docID']."' AND ".$site_type."";
	$que_view = @mysql_query($sql_view, $connection);
	$row_view = mysql_fetch_array($que_view);
	if ($row_view['found'] == 0) {
?>
						<div id="doc_title">
							<h1>Dokumen tidak tersedia</h1>
						</div>
						<div id="doc_post" class="doc_post">
							<b>Maaf, dokumen tidak tersedia. Periksa kembali penulisan URL anda atau dokumen telah dihapus.</b>
						</div>
<?php
	} else {
		$sql_dvc = "SELECT *, COUNT(*) AS `counts` FROM `".TB_STT."` 
					WHERE `type` = 'view' AND `stamp` = '".$row_view['id']."'";
		$que_dvc = @mysql_query($sql_dvc, $connection);
		$row_dvc = mysql_fetch_array($que_dvc);
?>
						<?php if ( $sitetype == 'admin' ) { ?>
						<div id="doc_preview">
							<b>Mode Pratinjau Dokumen</b> [<a href="javascript:history.back();">Kembali</a>]
						</div>
						<?php } ?>
						<div id="doc_title" <?php if ($sitetype == 'admin' ) { echo 'style="width:100%;"'; } ?>>
							<h1><?php echo $row_view['judul']; ?></h1>
						</div>
						<div id="doc_meta" <?php if ($sitetype == 'admin' ) { echo 'style="width:98%;"'; } ?>>
							<div class="div1">
								<small>
									<?php if ($sitetype == 'journal') {
										$sql_ed = "SELECT * FROM `".TB_EDT."` WHERE `id` = '".$row_view['kategori']."'";
										$que_ed = @mysql_query($sql_ed, $connection);
										$row_ed = mysql_fetch_array($que_ed);
										echo "Edisi Jurnal: <a href=\"./?page=edition&alias=".$row_ed['alias']."\">".$row_ed['nama']."</a><br>";
									}
									if ($sitetype != 'journal') { ?>
									Periode Wisuda: <?php echo $row_view['wisuda']; ?><br>
									<?php } ?>
									Tanggal Entri: <?php
										echo date('j ', strtotime($row_view['tanggal'])).
											 $array_bulan[date('n', strtotime($row_view['tanggal']))].
											 date(' Y', strtotime($row_view['tanggal']));
										?><br>
									Dilihat: <?php echo $row_dvc['counts']; ?> kali<br>
									<?php if ($sitetype == 'theses') {
										echo "Lokasi: ".$row_view['lokasi']."<br>\nBahasa: ".$row_view['bahasa']."";
									} ?>
								</small>
								<?php
								if ( (ftxt_permission($ip) == TRUE) || ($sitetype == 'admin') ) {
									if (empty($row_view['berkas'])) { ?>
									<div style="margin-top: 5px; color: red; font-weight: bold;">Berkas lengkap belum tersedia.</div>
									<?php } else { ?>
									<div id="btn_full" class="btn_full" style="<?php echo $disp_yes; ?>"><span>Lihat Teks Lengkap</span></div>
									<div id="btn_full" class="btn_full" style="<?php echo $disp_no; ?>"><span>Lihat Ringkasan</span></div>
									<?php }
								} ?>
							</div>
							<div class="div2" align="right">
								<small>Penulis</small><br>
								<?php if ($sitetype == 'journal') { ?>
								<p style="font-size: 135%; margin: 0;"><b><?php echo $row_view['penulis']; ?></b></p>
								<p style="font-size: 135%; margin: -3px 0 0 0;"><b><?php echo $row_view['dosen']; ?></b></p>
								<?php } else { ?>
								<p style="font-size: 135%; margin: -4px 0;"><b><?php echo $row_view['penulis']; ?></b></p>
								<p style="margin-bottom: 3px;"><small style="color: black;">NIM: <?php echo $row_view['nim']; ?></small></p>
								<small>Dosen Pembimbing</small><br>
								<p><?php echo $row_view['dosen']; ?></p>
								<small>Konsentrasi/Angkatan</small><br>
								<p style="margin-bottom: 0;"><?php echo $row_view['konsentrasi']."/".$row_view['angkatan']; ?></p>
								<?php } ?>
							</div>
						</div>
						<div id="doc_post" class="doc_post" style="<?php echo $disp_yes; ?>">
							<p class="doc_sub"><b>INTISARI</b></p>
							<p class="doc_text"><?php echo $row_view['intisari']; ?></p>
							<p class="doc_text"><b>Kata Kunci</b>: <?php echo $row_view['katakunci']; ?></p><br>
							<?php if (!empty($row_view['abstrak'])) { ?>
							<p class="doc_sub"><b>ABSTRACT</b></p>
							<p class="doc_text"><?php echo $row_view['abstrak']; ?></p>
							<p class="doc_text"><b>Keywords</b>: <em><?php echo $row_view['keyword']; ?></em></p>
							<?php } ?>
							</p>
						</div>
						<?php
							if (empty($row_view['berkas'])) {
									echo "<div id=\"doc_post\" class=\"doc_post\" style=\"display:none;\">".
										 "<b>Maaf, berkas belum tersedia. Mohon hubungi administrator.</b></div>";
							} else {
								if ($sitetype == 'admin') {
									include('viewer.php'); //load viewer
								} else {
									if (ftxt_permission($ip) == TRUE) {
										$fdoc_enterpass1 = "
						<div id=\"doc_post\" class=\"doc_post\" style=\"".$disp_no."text-align: center\">
						<br><br><br><b>Masukkan kata sandi (password) untuk melihat isi dokumen ini.</b><br>
						<form action=\"\" method=\"post\">
							<input type=\"text\" name=\"pass_fdoc\" value=\"\">
							<input type=\"submit\" name=\"auth_pass_fdoc\" value=\"Lihat Dokumen\">
						</form><br>";
										$fdoc_enterpass2 = "<br><br>
						</div>";
										if (!isset($_POST['auth_pass_fdoc'])) {
											echo $fdoc_enterpass1.$fdoc_enterpass2;
										} else {
											switch ($sitetype) {
												case "theses": $wa = " AND `akses` LIKE '%T%'"; break;
												case "journal": $wa = " AND `akses` LIKE '%J%'"; break;
												default: $wa = " AND `akses` LIKE '%X%'";
											}
											$sql_pfd = "SELECT *, COUNT(*) AS found FROM `".TB_PWD."` WHERE `sandi` = '".$_POST['pass_fdoc']."'".$wa;
											$res_pfd = @mysql_query($sql_pfd, $connection) or die(mysql_error());
											$row_pfd = mysql_fetch_array($res_pfd);
											if ($row_pfd['found'] == 0) {
												echo $fdoc_enterpass1 . "<font color=red>Password salah, mohon cek kembali.</font><br><br>" . $fdoc_enterpass2;
											} else {
												if ($row_pfd['waktu'] == '0000-00-00 00:00:00') {
													$sql_upf = "UPDATE `".TB_PWD."` SET `waktu` = '".date('Y-m-d H:i:s')."' WHERE `sandi` = '".$_POST['pass_fdoc']."'";
													$res_upf = mysql_query($sql_upf) or die(mysql_error());
													include('viewer.php'); //load viewer
												} else {
													$futureDate = strtotime($row_pfd['waktu'])+(60*$row_pfd['masa']);
													if (time() < $futureDate) {
														include('viewer.php'); //load viewer
													} else {
														echo $fdoc_enterpass1 . "<font color=red>Mohon maaf, password yang anda masukkan telah habis masa berlakunya. Mohon gunakan password baru lainnya.</font><br><br>" . $fdoc_enterpass2;
													}
												}
											}
										}
									} else {
										echo "<div id=\"doc_post\" class=\"doc_post\" style=\"display:none;\">".
											 "<b>Maaf, anda tidak diizinkan untuk melihat dokumen ini.</b></div>";
									}
								}
							}
							if ( (ftxt_permission($ip) != TRUE) && ($sitetype != 'admin') ) {
						?>
						<div id="doc_post" class="doc_post" style="background:#25a;color:#fff;padding:5px 10px;text-align:center;">
							<b><?php echo def_var("all", "site", "ftxt_msg_deny"); ?></b>
						</div>
						<?php } ?>
<?php } ?>
