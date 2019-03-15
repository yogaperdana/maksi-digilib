						<?php
							if ( $sitetype == 'journal' ) {
								$sql_ned = "SELECT * FROM `".TB_EDT."` ORDER BY `tanggal` DESC LIMIT 1";
								$que_ned = @mysql_query($sql_ned, $connection);
								$row_ned = mysql_fetch_array($que_ned);
						?>
						<div id="subpage">
							<div class="diva">
								<img src="<?php echo SYS_DIR; ?>/images/newedition.png" border="0"><br>

		<div style="width: 320px;">
				<div style="background: url('<?php echo SYS_DIR; ?>/images/abisjurnal_cover_header.jpg') top center no-repeat; background-size: 320px 108px; width: 100%; height: 108px; float: left; margin: 3px 0 0 0;">
					<p style="font-size: 8pt; margin: 82px 0 0 8px; text-align: left;">
						<a href="<?php echo SITE_DIR; ?>/?page=edition&alias=<?php echo $row_ned['alias']; ?>" style="color: black;">
							<?php echo $row_ned['nama']; ?>
						</a>
					</p>
				</div>
				<div style="background: url('<?php echo SYS_DIR; ?>/images/abisjurnal_cover_backlogo.png') center no-repeat #ACD8BB; width: 100%; height: 265px; float: left; margin: 0;">
					<p style="margin-top: 8px;">
						<?php
							$sql_nel = "SELECT * FROM `".TB_DOC."` WHERE `kategori` = '".$row_ned['id']."' ".
										"AND `jenis` = '".$sitetype."' AND `kondisi` = 'publish' LIMIT 5";
							$res_nel = @mysql_query($sql_nel, $connection) or die(mysql_error());
							while($row_nel = mysql_fetch_array($res_nel)) {
								echo "\n<p style=\"margin:0 8px 5px;font-size:11px;line-height:11px;\">".$row_nel['judul']."</p>\n";
							}
						?>
						<a style="margin:0 8px 5px;font-size:11px;line-height:11px;" 
						href="<?php echo SITE_DIR; ?>/?page=edition&alias=<?php echo $row_ned['alias']; ?>">...dan lain-lain.</a>
					</p>
				</div>
				<div style="background: #DF7217; width: 100%; height: 65px; float: left; margin: 0;">
					<p style="font-size: 8pt; color: black; font-weight: bold; text-align: center; margin-top: 10px;">Program Magister Akuntansi<br>Fakultas Ekonomika dan Bisnis<br>Universitas Gadjah Mada</p>
				</div>
		</div>

							</div>
							<div class="divb">
								<img src="<?php echo SYS_DIR; ?>/images/editorial.png" border="0"><br>
								<?php echo $site_editor; ?>
							</div>
						<div>
						<?php } ?>