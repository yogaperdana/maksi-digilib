				<div id="menu">
					<?php /*if ($sitetype == "database") { ?>
					<ul style="margin-bottom: 20px;"><?php
						$sqldbm = "SELECT * FROM `".TB_DBT."`";
						$quedbm = @mysql_query($sqldbm, $connection);
						while($rowdbm = mysql_fetch_array($quedbm)) {
							echo "<li><a href=\"?page=".$rowdbm['alias']."\">".$rowdbm['name']."</a></li>";
						}
					?></ul>
					<?php } */?>
					<ul>
						<?php if ($_GET['page'] != 'home') { ?>
						<li><a href="./?ref=home">Beranda</a></li>
<?php
	}
	switch ($sitetype) {
		case "theses":
			$menu_field = "`type` = 't_page' OR `type` = 't_link'";
			break;
		case "journal":
			$menu_field = "`type` = 'j_page' OR `type` = 'j_link'";
			echo "<li><a href=\"?page=edition\">Daftar Edisi Lengkap</a></li>";
			break;
		case "database":
			$menu_field = "`type` = 'd_page' OR `type` = 'd_link'";
			break;
		case "admin":
			$menu_field = "`type` = 'a_page' OR `type` = 'a_link'";
			break;
	}
	$s_menu = "SELECT * FROM `".TB_PGM."` WHERE ".$menu_field."";
	$q_menu = @mysql_query($s_menu, $connection);
	while($f_menu = mysql_fetch_array($q_menu)) {
		if ( ($f_menu['type'] == 't_page') || ($f_menu['type'] == 'j_page') || ($f_menu['type'] == 'd_page') || ($f_menu['type'] == 'a_page') ) {
			echo "<li><a href=\"?page=".$f_menu['alias']."\">".$f_menu['name']."</a></li>\n";
		} else
		if ( ($f_menu['type'] == 't_link') || ($f_menu['type'] == 'j_link') || ($f_menu['type'] == 'd_link') || ($f_menu['type'] == 'a_link') ) {
			echo "<li><a href=\"".$f_menu['link']."\" target=\"_blank\">".$f_menu['name']."</a></li>\n";
		}
	}
?>
					</ul>
				</div>
