<?php
	if (!isset($_POST['auth_pass_fdoc'])) {
		$disp_no = "display:none; ";
		$disp_yes = "";
	} else {
		$disp_no = "";
		$disp_yes = "display:none; ";
	}
	$sql_view = "SELECT *, COUNT(*) AS found FROM `".TB_DBD."` ".
				"LEFT JOIN `".TB_DBG."` ON `".TB_DBG."`.`id_group` = `".TB_DBD."`.`id_group`".
				"WHERE `id_doc` = '".$_GET['docID']."'";
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
<?php } else { ?>
	<div id="doc_title">
		<h1><?php echo $row_view['title']; ?></h1>
	</div>
	<div id="doc_meta">
		<div class="div1">
			<small>
				Kategori: <?php echo $row_view['name']; ?><br>
				Tanggal Entri: <?php
					echo date('j ', strtotime($row_view['date_create'])).
						 $array_bulan[date('n', strtotime($row_view['date_create']))].
						 date(' Y', strtotime($row_view['date_create']));
					?><br>
				Tanggal Update: <?php
					echo date('j ', strtotime($row_view['date_modify'])).
						 $array_bulan[date('n', strtotime($row_view['date_modify']))].
						 date(' Y', strtotime($row_view['date_modify']));
					?>
			</small>
			<?php
			//if (ftxt_permission($ip) == TRUE) {
				if (empty($row_view['file'])) { ?>
				<div style="margin-top: 5px; color: red; font-weight: bold;">Berkas lengkap belum tersedia.</div>
				<?php } else { ?>
				<div id="btn_full" class="btn_full" style="<?php echo $disp_yes; ?>"><span>Lihat Teks Lengkap</span></div>
				<div id="btn_full" class="btn_full" style="<?php echo $disp_no; ?>"><span>Lihat Ringkasan</span></div>
				<?php }
			//} ?>
		</div>
		<div class="div2" align="right">
			<small>Penulis</small><br>
			<p style="font-size: 135%; margin: -4px 0;"><b><?php echo $row_view['author']; ?></b></p>
		</div>
	</div>
	<div id="doc_post" class="doc_post" style="<?php echo $disp_yes; ?>">
		<p class="doc_sub"><b>DESKRIPSI</b></p>
		<p class="doc_text"><?php echo $row_view['description']; ?></p>
	</div>
<?php
	if (empty($row_view['file'])) {
			echo "<div id=\"doc_post\" class=\"doc_post\" style=\"display:none;\">".
				 "<b>Maaf, berkas belum tersedia. Mohon hubungi administrator.</b></div>";
	} else {
		//if (ftxt_permission($ip) == TRUE) {
			$fdoc_enterpass1 = "
	<div id=\"doc_post\" class=\"doc_post\" style=\"".$disp_no."text-align: center\">
	<br><br><br><b>Masukkan kata sandi (password) untuk melihat isi dokumen ini.</b><br>
	<form action=\"\" method=\"post\">
		<input type=\"text\" name=\"pass_fdoc\" value=\"\">
		<input type=\"submit\" name=\"auth_pass_fdoc\" value=\"Lihat Dokumen\">
	</form><br>";
			$fdoc_enterpass2 = "<br><br></div>";
			if (!isset($_POST['auth_pass_fdoc'])) {
				echo $fdoc_enterpass1.$fdoc_enterpass2;
			} else {
				$sql_pfd = "SELECT *, COUNT(*) AS found FROM `".TB_PWD."` WHERE `sandi` = '".$_POST['pass_fdoc']."' AND `akses` LIKE '%D%'";
				$res_pfd = @mysql_query($sql_pfd, $connection) or die(mysql_error());
				$row_pfd = mysql_fetch_array($res_pfd);
				if ($row_pfd['found'] == 0) {
					echo $fdoc_enterpass1 . "<font color=red>Password salah, mohon cek kembali.</font><br><br>" . $fdoc_enterpass2;
				} else {
					if ($row_pfd['waktu'] == '0000-00-00 00:00:00') {
						$sql_upf = "UPDATE `".TB_PWD."` SET `waktu` = NOW() WHERE `sandi` = '".$_POST['pass_fdoc']."'";
						$res_upf = mysql_query($sql_upf) or die(mysql_error());
						include('viewer-pdf.php');
					} else {
						$futureDate = strtotime($row_pfd['waktu'])+(60*$row_pfd['masa']);
						if (time() < $futureDate) {
							include('viewer-pdf.php');
						} else {
							echo $fdoc_enterpass1 . "<font color=red>Mohon maaf, password yang anda masukkan telah habis masa berlakunya. Mohon gunakan password baru lainnya.</font><br><br>" . $fdoc_enterpass2;
						}
					}
				}
			}
		//} else {
		//	echo "<div id=\"doc_post\" class=\"doc_post\" style=\"display:none;\">".
		//		 "<b>Maaf, anda tidak diizinkan untuk melihat dokumen ini.</b></div>";
		//}
	}
	if ( (ftxt_permission($ip) != TRUE) && ($sitetype != 'admin') ) {
?>
<div id="doc_post" class="doc_post" style="background:#25a;color:#fff;padding:5px 10px;text-align:center;">
	<b><?php echo def_var("all", "site", "ftxt_msg_deny"); ?></b>
</div>
<?php } ?>
<?php } ?>
