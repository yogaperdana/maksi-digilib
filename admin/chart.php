<?php

	$c_xml_1 = '<chart caption="Statistik Dokumen Tesis" xAxisName="Month" yAxisName="Units" showValues="1" decimals="0" formatNumberScale="0">';
	$sc1 = "SELECT YEAR(`tanggal`) AS THN, COUNT(*) AS JML FROM `mds_document` WHERE `jenis` = 'theses' GROUP BY YEAR(`tanggal`)";
	$qc1 = @mysql_query($sc1, $connection);
	while ($rc1 = mysql_fetch_array($qc1)) {
		$c_xml_1 .= '<set label="'.$rc1['THN'].'" value="'.$rc1['JML'].'" />';
	}
	$c_xml_1 .= '</chart>';

	$c_xml_2 = '<chart caption="Statistik Dokumen Jurnal" xAxisName="Month" yAxisName="Units" showValues="1" decimals="0" formatNumberScale="0">';
	$sc2 = "SELECT YEAR(`tanggal`) AS THN, COUNT(*) AS JML FROM `mds_document` WHERE `jenis` = 'journal' GROUP BY YEAR(`tanggal`)";
	$qc2 = @mysql_query($sc2, $connection);
	while ($rc2 = mysql_fetch_array($qc2)) {
		$c_xml_2 .= '<set label="'.$rc2['THN'].'" value="'.$rc2['JML'].'" />';
	}
	$c_xml_2 .= '</chart>';
	
	$c_xml_3 = '<chart caption="Statistik Akses" xAxisName="Month" yAxisName="Units" showValues="1" decimals="0" formatNumberScale="0">';
	$sc3 = "SELECT `site` AS JNS, COUNT(*) AS JML FROM `".TB_STT."` WHERE `site` <> '' AND `type` = 'visit' GROUP BY `site`";
	$qc3 = @mysql_query($sc3, $connection);
	while ($rc3 = mysql_fetch_array($qc3)) {
		$c_xml_3 .= '<set label="'.$rc3['JNS'].'" value="'.$rc3['JML'].'" />';
	}
	$c_xml_3 .= '</chart>';
?>