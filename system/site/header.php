<html>
	<head>
		<title><?php echo $site_title; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Yoga Perdana Putra">
		<link rel="shortcut icon" href="<?php echo SYS_DIR; ?>/images/favicon.png" />
		<link rel="stylesheet" href="<?php echo SYS_DIR; ?>/style/style.css">
		<?php if ($sitetype == 'admin') { ?>
		<link rel="stylesheet" href="<?php echo SYS_DIR; ?>/style/admin.css">
		<script language="JavaScript" src="<?php echo SYS_DIR; ?>/java/FusionCharts.js"></script>
		<script type="text/javascript" src="<?php echo SYS_DIR; ?>/package/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript">
			tinyMCE.init({
				mode : "textareas",
				theme : "advanced",
				plugins : "autolink,lists,table,advimage,advlink,inlinepopups,insertdatetime,searchreplace,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,wordcount,advlist",
				theme_advanced_buttons1 : "fontselect,fontsizeselect,|,bold,italic,underline,strikethrough,|,sub,sup,|,justifyleft,justifycenter,justifyright,justifyfull,|,forecolor,backcolor,|,removeformat,fullscreen",
				theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,undo,redo,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : true,
			});
		</script>
		<?php } ?>
		<script src="<?php echo SYS_DIR; ?>/java/jquery-1.9.1.min.js"></script>
		<script src="<?php echo SYS_DIR; ?>/java/modernizr-2.6.2.min.js"></script>
		<script src="<?php echo SYS_DIR; ?>/java/placeholder.js"></script>
		<script>
		$(function() {
			$(".button_sa").click(function() {
				$(".search").slideToggle("fast");
				return false;
			});
			$(".btn_full").click(function() {
				$(".doc_post").slideToggle("fast");
				$(".btn_full").slideToggle("fast");
				return false;
			});
		});
		</script>
		<style>
			#page_title, .homebg {
				background: url('<?php echo SYS_DIR; ?>/images/<?php echo $site_header_image; ?>') bottom repeat-x;
			}
		</style>
	</head>
	<body onload="ShowClock();">
		<div id="page">
