<?php if (!isset($disp_no)) {$disp_no = "display:none; ";} ?>
	<div id="doc_post" class="doc_post" style="<?php echo $disp_no; ?>padding:0;width:690px;">
		<div>
			<iframe src="<?php echo SYS_DOC; ?>/pdf/<?php echo $row_view['file']; ?>" frameborder="0" width="100%" height="96%"></iframe>
		</div>
	</div>