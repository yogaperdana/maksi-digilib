<?php
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);
	$dtf = "../docs/pdf/";
	
	for ($x = 1; $x <= 20; $x++) {
		
		//if (!empty($_POST['title['.$x.']']))
		
		$p_type			= mysql_real_escape_string($_POST['type']);
		$p_group[$x]	= mysql_real_escape_string($_POST['group['.$x.']']);
		$p_title[$x]	= mysql_real_escape_string($_POST['title['.$x.']']);
		$p_author[$x]	= mysql_real_escape_string($_POST['author['.$x.']']);
		$p_number[$x]	= mysql_real_escape_string($_POST['number['.$x.']']);
		$p_date[$x]		= mysql_real_escape_string($_POST['date['.$x.']']);
		$p_status[$x]	= mysql_real_escape_string($_POST['status['.$x.']']);
		
		$dfn	= $_FILES['file['.$x.']']['name'];
		$dbn	= substr($dfn, 0, strripos($dfn, '.'));
		$dfx	= substr($dfn, strripos($dfn, '.'));
		if (empty($dbn)) {
			$p_file[$x] = ""; $error1 = 0;
		} else {
			if ($dfx == ".pdf") {
				$ndfn = str_replace(' ', '_', $dbn).$dfx;
				$dan = pathinfo($ndfn, PATHINFO_FILENAME);
				$don = $dan;
				$ext = pathinfo($ndfn, PATHINFO_EXTENSION);
				$i = 1;
				while(file_exists($dtf.$dan.".".$ext)) {           
					$dan = (string)$don.$i;
					$ndfn = $dan.".".$ext;
					$i++;
				}
				$p_file[$x] = $dtf.$ndfn;
				move_uploaded_file($_FILES['file['.$x.']']['tmp_name'], $p_file);
				$error1 = 0;
			} else {
				$error1 = 1;
				echo "Hanya diizinkan mengunggah berkas dokumen dengan ekstensi: <b>.pdf</b>!<br>";
				unlink($_FILES['file['.$x.']']['tmp_name']);
			}
			$p_file[$x] = $ndfn;
		}
		
		if ($error1 == 0) {
			if ($_GET['page'] == 'new') {
				$sqla = "INSERT INTO `".TB_DBD."` (
							`date_create`, `date_modify`, `id_group`, `title`, `author`, `number`, `date`, `file`, `status`
						) VALUES (
							NOW(), NOW(), '".$p_group[$x]."', '".$p_title[$x]."', '".$p_author[$x]."', '".$p_number[$x]."', 
							'".$p_date[$x]."', '".$p_file[$x]."', '".$p_status[$x]."'
						);";
				$resa = mysql_query($sqla) or die(mysql_error());
			}
		} else {
			echo "<b>Terjadi kesalahan!</b> [<a href=\"javascript:history.back(-1);\">Kembali</a>]";
		}
		
		
	}
	
	/*
	if ($error1 == 0) {
		if ($_GET['page'] == 'new') {
			$sql_add = "INSERT INTO `".TB_DBD."` (
							`date_create`, `date_modify`, `id_group`, `title`, `author`, `number`, `date`, `description`, `file`, `status`
						) VALUES (
							NOW(), NOW(), '".$p_group."', '".$p_title."', '".$p_author."', '".$p_number."', 
							'".$p_date."', '".$p_desc."', '".$p_file."', '".$p_status."'
						);";
			$res_add = mysql_query($sql_add) or die(mysql_error());
		}
		echo "<script language=\"JavaScript\" type=\"Text/JavaScript\">alert(\"Penyimpanan dokumen sukses!.\")</script>";
		echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=?page=manage&type=database\">";
		exit;
	} else {
		echo "<b>Terjadi kesalahan!</b> [<a href=\"javascript:history.back(-1);\">Kembali</a>]";
	}*/
?>