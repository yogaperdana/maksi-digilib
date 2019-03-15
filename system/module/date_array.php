<?php
	$array_hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
	$array_bulan = array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	$hari = $array_hari[date("N")];
	$tanggal = date("j");
	$bulan = $array_bulan[date("n")];
	$tahun = date("Y");
?>