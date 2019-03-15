<?php if (!isset($disp_no)) {$disp_no = "display:none; ";} ?>
						<div id="doc_post" class="doc_post" style="<?php echo $disp_no; ?>padding:0;width:690px;">
							<div>
								<div id="flashContent">
									<p>
										To view this page ensure that Adobe Flash Player version 9.0.124 or greater is installed.
									</p>
									<script type="text/javascript">
										var pageHost = ((document.location.protocol == "https:") ? "https://" :	"http://");
										document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='" + pageHost 
										+ "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" );
									</script>
								</div>
								<script type="text/javascript" src="<?php echo SYS_DIR; ?>/java/swfobject.js"></script>
								<script type="text/javascript">
									var flashvars = { 
										SwfFile : escape('<?php echo SYS_DOC.'/'.$row_view['berkas']; ?>'), 
										Scale : 1.0, 
										ZoomTransition : "easeOut",
										ZoomTime : 0.5,
										ZoomInterval : 0.1,
										FitPageOnLoad : true,
										FitWidthOnLoad : false,
										PrintEnabled : false,
										FullScreenAsMaxWindow : false,
										ProgressiveLoading : true,
										localeChain: "en_US"
									};
								</script>
								<script type="text/javascript" src="<?php echo SYS_DIR; ?>/java/script.js"></script>
								<script type="text/javascript">
									swfobject.embedSWF(
										"<?php echo SYS_DIR; ?>/viewer/FlexPaperViewer.swf", "flashContent", "100%", "96%", 
										swfVersionStr, xiSwfUrlStr, flashvars, params, attributes
									);
								</script>
							</div>
						</div>