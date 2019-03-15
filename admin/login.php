				<script type="text/javascript" src="sha512.js"></script>
				<script type="text/javascript" src="forms.js"></script>
				<div id="title">
					<img src="<?php echo SYS_DIR; ?>/images/logo.png" border="0"><br>
					<span style="font-size: 26px; font-weight: bold; line-height: 21px;">
						Administrator<br>Tesis & Jurnal Online
					</span><br>
					<img src="<?php echo SYS_DIR; ?>/images/maksi.png" border="0" style=" margin: 5px 0 20px;">
				</div>
				<div id="content" style="text-align: center;">
					<form action="login_proc.php" method="post" name="login_form" onsubmit="formhash(this.form, this.form.password);">
						<label>Nama Pengguna</label><br>
						<input type="text" name="email" style="text-align: center;"><br>
						<label>Kata Sandi</label><br>
						<input type="password" name="p" id="password" style="text-align: center;"><br>
						<input type="submit" value="Masuk Log" style="margin: 10px 0;">
					</form>
					<?php
						if(isset($_GET['error'])) { 
							echo '<font color=red>Login Gagal. Mungkin Username/Password Anda Salah.</font>';
						}
					?>
				</div>
