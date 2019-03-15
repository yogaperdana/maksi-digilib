
			<div id="left">
				<div id="title">
					<img src="<?php echo SYS_DIR; ?>/images/logo.png" border="0"><br>
					<span style="font-size: 26px; font-weight: bold;"><?php echo $site_name; ?></span><br>
					<img src="<?php echo SYS_DIR; ?>/images/maksi.png" border="0">
					<?php echo "\n".$site_note; ?>
				</div>
				<div id="date">
					<?php echo $hari.", ".$tanggal." ".$bulan." ".$tahun; ?>. 
					<script src="<?php echo SYS_DIR; ?>/java/time.js" type="text/javascript"></script>
				</div>
<?php if ( $sitetype != 'admin' ) { ?>
				<div id="search" class="search">
					<form action="" method="get">
						<input type="hidden" name="page" value="search">
						<input type="hidden" name="method" value="simple">
						<input type="text" name="term" value="<?php echo $_GET['term'] ?>" placeholder="Pencarian...">
						<input type="submit" value="Cari">
						<div class="button_sa">Advanced Search</div>
					</form>
				</div>
				<div id="search" class="search" style="display:none;">
					<form action="" method="get">
						<input type="hidden" name="page" value="search">
						<input type="hidden" name="method" value="advanced">
						<input type="text" name="title" value="<?php echo $_GET['title'] ?>" placeholder="Judul Dokumen"><br>
						<input type="text" name="author" value="<?php echo $_GET['author'] ?>" placeholder="Nama Penulis"><br>
						<input type="text" name="keyword" value="<?php echo $_GET['keyword'] ?>" placeholder="Kata Kunci"><br>
						<input type="submit" value="Cari">
						<div class="button_sa">Simple Search</div>
					</form>
				</div>
<?php } ?>
<?php include('menu.php'); ?>
				<div id="stat">
					Total Akses: <b><?php echo $stat_total_access; ?></b><br>
					Total Dokumen: <b><?php echo $stat_total_docs; ?></b>
				</div>
				<div id="copy">
					<?php echo $site_version; ?><br><?php echo $site_copyright."\n"; ?>
				</div>
			</div>
