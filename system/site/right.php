
			<div id="right">
				<div class="content">
					<div id="content">
						<?php
							if ( $sitetype == 'admin' ) {
								include('right_admin.php');
							} else {
								if ($_GET['page'] == 'home') {
									include('../system/module/welcome.php');
									switch ($sitetype) {
										case "theses": include('../system/module/new_popular.php'); break;
										case "journal": include('../system/module/journal_editorial.php'); break;
										case "database": include('../system/module/home-database.php'); break;
									}
								} else
								if ($_GET['page'] == 'detail') {
									switch ($sitetype) {
										case "database": include('../system/module/detail-database.php'); break;
										default: include('../system/module/detail.php');
									}
								} else
								if ($_GET['page'] == 'search') {
									switch ($sitetype) {
										case "database": include('../system/module/search-database.php'); break;
										default: include('../system/module/search.php');
									}
								} else
								if ($_GET['page'] == 'edition') {
									if ( $sitetype == 'journal' ) {
										include('../system/module/edition.php');
									} else {
										header("location:".SITE_DIR."");
									}
								} else {
									switch ($sitetype) {
										case "theses": $page_field = "t_page"; break;
										case "journal": $page_field = "j_page"; break;
										case "database": $page_field = "d_page"; break;
									}
									$s_page = "SELECT *, COUNT(*) AS found FROM `".TB_PGM."` WHERE `type` = '".$page_field."'";
									$q_page = @mysql_query($s_page, $connection);
									while($f_page = mysql_fetch_array($q_page)) {
										if ($f_page['found'] == 0) {
											header("location:".SITE_DIR."");
										} else {
											if ($_GET['page'] == $f_page['alias']) {
												echo "<div id=\"page_title\"><h1>".$f_page['name']."</h1></div>\n";
												echo "<div id=\"subpage\">\n".$f_page['text']."\n</div>\n";
											}
										}
									}
								}
							}
						?>
					</div>
				</div>
			</div>
