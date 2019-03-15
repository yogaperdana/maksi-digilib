<?php
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);
	if ($_GET['page'] == 'new') {
		switch ($_GET['view']) {
			case "theses": $page_title = "Tambah Tesis Baru"; break;
			case "journal": $page_title = "Tambah Jurnal Baru"; break;
			case "database": $page_title = "Tambah Database Baru"; break;
			default: $page_title = "Tambah Dokumen Baru";
		}
	} else
	if ($_GET['page'] == 'edit') {
		switch ($_GET['view']) {
			case "theses": $page_title = "Sunting Dokumen Tesis"; break;
			case "journal": $page_title = "Sunting Dokumen Jurnal"; break;
			case "database": $page_title = "Sunting Database"; break;
			default: $page_title = "Sunting Dokumen";
		}
	}
?>
<div id="subpage">
	<div class="panel_title">
		<img border="0" src="<?php echo SYS_DIR; ?>/images/admin_icon_new.png">
		<h3><?php echo $page_title; ?></h3>
		
		<?php if ($_GET['page'] == 'edit') { ?>
		<div class="panel_opt">
			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $_GET['docID']; ?>" />
				<?php if ($_GET['view'] != "database") { ?>
				<a href="<?php echo SITE_DIR; ?>/?page=detail&docID=<?php echo $_GET['docID']; ?>">
					<img border="0" src="<?php echo SYS_DIR; ?>/images/admin_icon_preview.png">
				</a>
				<?php } ?>
				<button type="submit" name="doc-delete" onclick="return confirm('Apakah anda yakin ingin menghapus dokumen ini? Perhatian: Setelah dihapus, dokumen tidak bisa dikembalikan.');">
					<img border="0" src="<?php echo SYS_DIR; ?>/images/admin_icon_delete.png">
				</button>
			</form>
		</div>
		<?php } ?>
		
	</div>
	<div style="float: left; margin: 10px 0;">
<?php
	if (isset($_POST['doc-save'])) {
		switch ($_GET['view']) {
			case "database": include('save-database.php'); break;
			case "database-multi": include('save-database-multi.php'); break;
			default: include('save-theses-journal.php');
		} exit;
	}
	if (isset($_POST['doc-delete'])) {
		if ($_GET['view'] == "database") {
			$target_folder_doc = "../docs/pdf/";
			$sql_edit = "SELECT * FROM `".TB_DBD."` WHERE `id_doc` = '".$_GET['docID']."'";
			$res_edit = @mysql_query($sql_edit, $connection) or die(mysql_error());
			$row_edit = mysql_fetch_array($res_edit);
			$p_jenis = 'database';
			if (!empty($row_edit['file'])) {unlink($target_folder_doc.$row_edit['file']);}
			$sql_del = "DELETE FROM `".TB_DBD."` WHERE `id_doc` = '".$_POST['id']."'";
			$res_del = mysql_query($sql_del) or die(mysql_error());
		} else {
			$target_folder_doc = "../docs/";
			$sql_edit = "SELECT * FROM `".TB_DOC."` WHERE `id` = '".$_GET['docID']."'";
			$res_edit = @mysql_query($sql_edit, $connection) or die(mysql_error());
			$row_edit = mysql_fetch_array($res_edit);
			$p_jenis = $row_edit['jenis'];
			if (!empty($row_edit['berkas'])) {unlink($target_folder_doc.$row_edit['berkas']);}
			$sql_del = "DELETE FROM `".TB_DOC."` WHERE `id` = '".$_POST['id']."'";
			$res_del = mysql_query($sql_del) or die(mysql_error());
		}
		echo "<script language=\"JavaScript\" type=\"Text/JavaScript\">alert(\"Dokumen berhasil dihapus!.\")</script>";
		echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=?page=manage&type=".$p_jenis."\">";
		exit;
	}
	switch ($_GET['view']) {
		case "theses":
			include('form-theses-journal.php');
			break;
		case "journal":
			include('form-theses-journal.php');
			break;
		case "database":
			include('form-database.php');
			break;
		case "database-multi":
			include('form-database-multi.php');
			break;
		default:
?>
		<div class="diva" align="center">
			<a href="<?php echo SITE_DIR; ?>/?page=new&view=theses">
				<img border="0" src="<?php echo SYS_DIR; ?>/images/book.png">
				<br><h3>Tambah Tesis Baru</h3>
			</a>
		</div>
		<div class="divb" align="center">
			<a href="<?php echo SITE_DIR; ?>/?page=new&view=journal">
				<img border="0" src="<?php echo SYS_DIR; ?>/images/paper.png">
				<br><h3>Tambah Jurnal Baru</h3>
			</a>
		</div>
		<div class="divc" align="center">
			<a href="<?php echo SITE_DIR; ?>/?page=new&view=database">
				<img border="0" src="<?php echo SYS_DIR; ?>/images/paper.png">
				<br><h3>Tambah Database Baru</h3>
			</a>
		</div>
<?php
	}
?>
	</div>
</div>