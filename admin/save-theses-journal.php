<?php
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);
	$target_folder_doc	= "../docs/";
	
	$p_jenis			= mysql_real_escape_string($_POST['jenis']);
	$p_kategori			= mysql_real_escape_string($_POST['kategori']);
	$p_kondisi			= mysql_real_escape_string($_POST['kondisi']);
	$p_judul			= mysql_real_escape_string($_POST['judul']);
	$p_penulis			= mysql_real_escape_string($_POST['penulis']);
	$p_nim				= mysql_real_escape_string($_POST['nim']);
	$p_dosen			= mysql_real_escape_string($_POST['dosen']);
	$p_konsentrasi		= mysql_real_escape_string($_POST['konsentrasi']);
	$p_angkatan			= mysql_real_escape_string($_POST['angkatan']);
	$p_wisuda			= mysql_real_escape_string($_POST['wisuda']);
	$p_bahasa			= mysql_real_escape_string($_POST['bahasa']);
	$p_lokasi			= mysql_real_escape_string($_POST['lokasi']);
	$p_penerbit			= mysql_real_escape_string($_POST['penerbit']);
	$p_intisari			= trim(preg_replace('/\s+/', ' ', mysql_real_escape_string($_POST['intisari'])));
	$p_abstrak			= trim(preg_replace('/\s+/', ' ', mysql_real_escape_string($_POST['abstrak'])));
	$p_katakunci		= mysql_real_escape_string($_POST['katakunci']);
	$p_keyword			= mysql_real_escape_string($_POST['keyword']);
	$p_deskripsi		= mysql_real_escape_string($_POST['deskripsi']);
	
	if ($_GET['page'] == 'edit') {
		$sql_edit = "SELECT * FROM `".TB_DOC."` WHERE `id` = '".mysql_real_escape_string($_GET['docID'])."'";
		$res_edit = @mysql_query($sql_edit, $connection) or die(mysql_error());
		$row_edit = mysql_fetch_array($res_edit);
	}
	
	if ($_POST['doc_file'] == "upload") {
		$filename_doc		= $_FILES["berkas"]["name"];
		$file_basename_doc	= substr($filename_doc, 0, strripos($filename_doc, '.'));
		$file_ext_doc		= substr($filename_doc, strripos($filename_doc, '.'));
		if (empty($file_basename_doc)) {
			if ($_GET['page'] == 'new') {
				$p_berkas = "";
				$error1 = 0;
			} else
			if ($_GET['page'] == 'edit') {
				$p_berkas = $row_edit['berkas'];
				$error1 = 0;
			}
		} else {
			if ($file_ext_doc == ".swf") {
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
				$p_berkas = $target_folder_doc.$newfilename_doc;
				move_uploaded_file($_FILES["berkas"]['tmp_name'], $p_berkas);
				if (!empty($row_edit['berkas'])) {
					unlink($target_folder_doc.$_POST['berkas_lama']);
				}
				$error1 = 0;
			} else {
				$error1 = 1;
				echo "Hanya diizinkan mengunggah berkas dokumen dengan ekstensi: <b>.swf</b>!<br>";
				unlink($_FILES["berkas"]['tmp_name']);
			}
			$p_berkas = $newfilename_doc;
		}
	} else if ($_POST['doc_file'] == "delete") {
		$p_berkas = "";
		unlink($target_folder_doc.$_POST['berkas_lama']);
		$error1 = 0;
	} else {
		$p_berkas = $_POST['berkas_lama'];
		$error1 = 0;
	}
	
	if ($error1 == 0) {
		if ($_GET['page'] == 'new') {
			$sql_add = "INSERT INTO `".TB_DOC."` (
							`tanggal`, `jenis`, `kategori`, `kondisi`, `judul`, 
							`penulis`, `nim`, `dosen`, `konsentrasi`, `angkatan`, 
							`wisuda`, `bahasa`, `lokasi`, `penerbit`, `intisari`, 
							`abstrak`, `katakunci`, `keyword`, `deskripsi`, `berkas`
						) VALUES (
							NOW(), '".$p_jenis."', '".$p_kategori."', '".$p_kondisi."', '".$p_judul."', 
							'".$p_penulis."', '".$p_nim."', '".$p_dosen."', '".$p_konsentrasi."', '".$p_angkatan."', 
							'".$p_wisuda."', '".$p_bahasa."', '".$p_lokasi."', '".$p_penerbit."', '".$p_intisari."', 
							'".$p_abstrak."', '".$p_katakunci."', '".$p_keyword."', '".$p_deskripsi."', '".$p_berkas."'
						);";
			$res_add = mysql_query($sql_add) or die(mysql_error());
		} else
		if ($_GET['page'] == 'edit') {
			$sql_save = "UPDATE `".TB_DOC."` SET 
							`jenis`			= '".$p_jenis."',
							`kategori`		= '".$p_kategori."',
							`kondisi`		= '".$p_kondisi."',
							`judul`			= '".$p_judul."',
							`penulis`		= '".$p_penulis."',
							`nim`			= '".$p_nim."',
							`dosen`			= '".$p_dosen."',
							`konsentrasi`	= '".$p_konsentrasi."',
							`angkatan`		= '".$p_angkatan."',
							`wisuda`		= '".$p_wisuda."',
							`bahasa`		= '".$p_bahasa."',
							`lokasi`		= '".$p_lokasi."',
							`penerbit`		= '".$p_penerbit."',
							`intisari`		= '".$p_intisari."',
							`abstrak`		= '".$p_abstrak."',
							`katakunci`		= '".$p_katakunci."',
							`keyword`		= '".$p_keyword."',
							`deskripsi`		= '".$p_deskripsi."',
							`berkas`		= '".$p_berkas."'
						WHERE `id`			= '".mysql_real_escape_string($_POST['docID'])."';";
			$res_save = mysql_query($sql_save) or die(mysql_error());
		}
		echo "<script language=\"JavaScript\" type=\"Text/JavaScript\">alert(\"Penyimpanan dokumen sukses!.\")</script>";
		echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=?page=manage&type=".$p_jenis."\">";
	} else {
		echo "<b>Terjadi kesalahan!</b> [<a href=\"javascript:history.back(-1);\">Kembali</a>]";
	}
?>