
<?php if (!isset($_GET['alias'])) { ?>
						<div id="page_title">
							<h1>Daftar Edisi Jurnal</h1>
						</div>
						<style>
						.doc_ed_item {
							background: url('<?php echo SYS_DIR; ?>/images/book.png') top left no-repeat;
							background-size: 84px;
						}
						</style>
						<div id="doc_post">
						<?php
							$sql_ed = "SELECT * FROM `".TB_EDT."` ORDER BY `tanggal` DESC";
							$que_ed = @mysql_query($sql_ed, $connection);
							while($row_ed = mysql_fetch_array($que_ed)) {
								$sql_edc = "SELECT COUNT(*) AS total FROM `".TB_DOC."` WHERE `kategori` = '".$row_ed['id']."' 
											AND `jenis` = '".$sitetype."' AND `kondisi` = 'publish'";
								$que_edc = @mysql_query($sql_edc, $connection);
								$row_edc = mysql_fetch_array($que_edc);
								$entrydate = date('j ', strtotime($row_ed['tanggal'])).
											 $array_bulan[date('n', strtotime($row_ed['tanggal']))].
											 date(' Y', strtotime($row_ed['tanggal']));
						?>
							<div class="doc_edition">
								<a class="doc_ed_item" href="./?page=edition&alias=<?php echo $row_ed['alias']; ?>">
									<h5><?php echo $row_ed['nama']; ?></h5>
									<div style="margin-bottom:4px;"><?php echo $row_ed['catatan']; ?></div>
									Tanggal Rilis: <?php echo $entrydate; ?><br>
									Total Dokumen: <?php echo $row_edc['total']; ?> Judul<br>
									<div style="margin-top:4px;"><b>Lihat selengkapnya</b></div>
								</a>
							</div>
						<?php } ?>
						</div>
<?php } else { ?>
	<?php
		$sql_eda = "SELECT * FROM `".TB_EDT."` WHERE `alias` = '".$_GET['alias']."'";
		$que_eda = @mysql_query($sql_eda, $connection);
		$row_eda = mysql_fetch_array($que_eda);
	?>
						<div id="doc_title">
							<h1><?php echo $row_eda['nama']; ?></h1>
						</div>
	<?php
		$where = "WHERE `kategori` = '".$row_eda['id']."'";
		$get_input_term = "<input type=\"hidden\" name=\"alias\" value=\"".$_GET['alias']."\">";
		$sql_count = "SELECT *, COUNT(*) AS 'total' FROM `".TB_DOC."` ".$where." AND `jenis` = '".$sitetype."' AND `kondisi` = 'publish'";
		$res_count = @mysql_query($sql_count, $connection) or die(mysql_error());
		$row_count = mysql_fetch_array($res_count);
		if ($row_count['total'] == 0) {
			echo "<div id=\"doc_post\"><b>Edisi ini belum diisi.</b></div>";
		} else {
			include('result.php');
		}
	?>
<?php } ?>
