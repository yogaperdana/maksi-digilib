<div id="subpage">
	<div class="panel_title">
		<img border="0" src="<?php echo SYS_DIR; ?>/images/admin_icon_manage.png">
		<?php
			switch ($_GET['type']) {
				case "theses": echo "<h3>Kelola Dokumen Tesis</h3>"; break;
				case "journal": echo "<h3>Kelola Dokumen Jurnal</h3>"; break;
				case "database": echo "<h3>Kelola Database</h3>"; break;
				default: echo "<h3>Pengelolaan Dokumen</h3>";
			}
		?>
		<?php if (!empty($_GET['type'])) { ?>
		<div style="float:right;margin-top:7px;">
			<form action="" method="get">
				<input type="hidden" name="page" value="<?php echo $_GET['page'] ?>">
				<input type="hidden" name="type" value="<?php echo $_GET['type'] ?>">
				<input type="text" name="term" value="<?php echo $_GET['term'] ?>" placeholder="Pencarian Dokumen...">
				<input type="submit" value="Cari">
			</form>
		</div>
		<?php } ?>
	</div>
	<div style="float: left; margin: 10px 0; width: 100%;">
		<?php if (empty($_GET['type'])) { ?>
		<div class="diva" align="center">
			<a href="<?php echo SITE_DIR; ?>/?page=manage&type=theses">
				<img border="0" src="<?php echo SYS_DIR; ?>/images/book.png">
				<br><h3>Kelola Dokumen Tesis</h3>
			</a>
		</div>
		<div class="divb" align="center">
			<a href="<?php echo SITE_DIR; ?>/?page=manage&type=journal">
				<img border="0" src="<?php echo SYS_DIR; ?>/images/paper.png">
				<br><h3>Kelola Dokumen Jurnal</h3>
			</a>
		</div>
		<div class="divc" align="center">
			<a href="<?php echo SITE_DIR; ?>/?page=manage&type=database">
				<img border="0" src="<?php echo SYS_DIR; ?>/images/paper.png">
				<br><h3>Kelola Database</h3>
			</a>
		</div>
		<?php } else {
			if (($_GET['type'] == 'theses') || ($_GET['type'] == 'journal')) {
				include('manage-theses-journal.php');
			} else if ($_GET['type'] == 'database') {
				include('manage-database.php');
			}
		} ?>
	</div>
</div>