
						<div id="subpage">
							<div class="diva">
								<img src="<?php echo SYS_DIR; ?>/images/newdocs.png" border="0"><br>
								<ul class="new_pop">
<?php
	$sql_new = "SELECT * FROM `".TB_DOC."` WHERE `jenis` = '$sitetype' ORDER BY `tanggal` DESC LIMIT 5";
	$que_new = @mysql_query($sql_new, $connection);
	while($row_new = mysql_fetch_array($que_new)) {
		echo "<li><a href=\"?page=detail&docID=".$row_new['id']."\">".$row_new['judul']." ".
			 "<small>(".date('d/m/Y', strtotime($row_new['tanggal'])).")</small></a></li>";
	}
?>
								</ul>
							</div>
							<div class="divb">
								<img src="<?php echo SYS_DIR; ?>/images/populars.png" border="0"><br>
								<ul class="new_pop">
<?php
	$sql_pop = "SELECT *, COUNT(*) AS `counts` FROM `".TB_STT."` 
				WHERE `type` = 'view' AND `site` = '".$sitetype."' 
				GROUP BY `stamp` ORDER BY `counts` DESC LIMIT 5";
	$que_pop = @mysql_query($sql_pop, $connection);
	while($row_pop = mysql_fetch_array($que_pop)) {
		$sql_pod = "SELECT * FROM `".TB_DOC."` WHERE `id` = '".$row_pop['stamp']."'";
		$que_pod = @mysql_query($sql_pod, $connection);
		$row_pod = mysql_fetch_array($que_pod);
		echo "<li><a href=\"?page=detail&docID=".$row_pod['id']."\">".$row_pod['judul']." ".
			 "<small>(".$row_pop['counts']." kali dilihat)</small></a></li>";
	}
?>
								</ul>
							</div>
						</div>
