<?php
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);
	$target_folder_doc	= "../docs/pdf/";
	
	$p_type			= mysql_real_escape_string($_POST['type']);
	$p_group		= mysql_real_escape_string($_POST['group']);
	$p_title		= mysql_real_escape_string($_POST['title']);
	$p_author		= mysql_real_escape_string($_POST['author']);
	$p_number		= mysql_real_escape_string($_POST['number']);
	$p_date			= mysql_real_escape_string($_POST['date']);
	$p_desc			= mysql_real_escape_string($_POST['desc']);
	$p_status		= mysql_real_escape_string($_POST['status']);
	
	if ($_GET['page'] == 'edit') {
		$sql_edit = "SELECT * FROM `".TB_DBD."` WHERE `id_doc` = '".mysql_real_escape_string($_GET['docID'])."'";
		$res_edit = @mysql_query($sql_edit, $connection) or die(mysql_error());
		$row_edit = mysql_fetch_array($res_edit);
	}
	
	if ($_POST['doc_file'] == "upload") {
		$filename_doc		= $_FILES["file"]["name"];
		$file_basename_doc	= substr($filename_doc, 0, strripos($filename_doc, '.'));
		$file_ext_doc		= substr($filename_doc, strripos($filename_doc, '.'));
		if (empty($file_basename_doc)) {
			if ($_GET['page'] == 'new') {
				$p_file = "";
				$error1 = 0;
			} else
			if ($_GET['page'] == 'edit') {
				$p_file = $row_edit['file'];
				$error1 = 0;
			}
		} else {
			if ($file_ext_doc == ".pdf") {
				$newfilename_doc = str_replace(' ', '_', $file_basename_doc).$file_ext_doc;
				$actual_name = pathinfo($newfilename_doc, PATHINFO_FILENAME);
				$original_name = $actual_name;
				$extension = pathinfo($newfilename_doc, PATHINFO_EXTENSION);
				$i = 1;
				while(file_exists($target_folder_doc.$actual_name.".".$extension)) {           
					$actual_name = (string)$original_name.$i;
					$newfilename_doc = $actual_name.".".$extension;
					$i++;
				}
				$p_file = $target_folder_doc.$newfilename_doc;
				move_uploaded_file($_FILES["file"]['tmp_name'], $p_file);
				if (!empty($row_edit['file'])) {
					unlink($target_folder_doc.$_POST['doc_old']);
				}
				$error1 = 0;
			} else {
				$error1 = 1;
				echo "Hanya diizinkan mengunggah berkas dokumen dengan ekstensi: <b>.pdf</b>!<br>";
				unlink($_FILES["file"]['tmp_name']);
			}
			$p_file = $newfilename_doc;
		}
	} else if ($_POST['doc_file'] == "delete") {
		$p_file = "";
		unlink($target_folder_doc.$_POST['doc_old']);
		$error1 = 0;
	} else {
		$p_file = $_POST['doc_old']; $error1 = 0;
	}
	
	if ($error1 == 0) {
		if ($_GET['page'] == 'new') {
			$sql_add = "INSERT INTO `".TB_DBD."` (
							`date_create`, `date_modify`, `id_group`, `title`, `author`, `number`, `date`, `description`, `file`, `status`
						) VALUES (
							NOW(), NOW(), '".$p_group."', '".$p_title."', '".$p_author."', '".$p_number."', 
							'".$p_date."', '".$p_desc."', '".$p_file."', '".$p_status."'
						);";
			$res_add = mysql_query($sql_add) or die(mysql_error());
		} else
		if ($_GET['page'] == 'edit') {
			$sql_save = "UPDATE `".TB_DBD."` SET 
							`date_modify`	= NOW(),
							`id_group`		= '".$p_group."',
							`title`			= '".$p_title."',
							`author`		= '".$p_author."',
							`number`		= '".$p_number."',
							`date`			= '".$p_date."',
							`description`	= '".$p_desc."',
							`file`			= '".$p_file."',
							`status`		= '".$p_status."'
						WHERE `id_doc`			= '".mysql_real_escape_string($_POST['id_doc'])."';";
			$res_save = mysql_query($sql_save) or die(mysql_error());
		}
		echo "<script language=\"JavaScript\" type=\"Text/JavaScript\">alert(\"Penyimpanan dokumen sukses!.\")</script>";
		echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=?page=manage&type=database\">";
		exit;
	} else {
		echo "<b>Terjadi kesalahan!</b> [<a href=\"javascript:history.back(-1);\">Kembali</a>]";
	}
?>