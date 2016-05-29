<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width"/>
	<title><?= $title ?></title>
	<link rel="stylesheet" type="text/css" href="<?= base_url("/application/views/css") ?>/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?= $css_url ?>/wap_head.css"/>
	<link rel="shortcut icon" href="<?= $image_url ?>/favicon.png">
	<script language="JavaScript">
		function goto_page() {
			var page_id = document.getElementById("page_goto_num").value;
			if (page_id != "" || page_id != NULL) {
				var goto_url = "<?=site_url()?>" + "/bbq/index/" + page_id;
				window.location.href = goto_url;
			}
		}
	</script>
</head>

<body>

<div class="nav">表白墙</div>

<div class="text">

	<button class="write_btn" onClick="window.location.href='<?php echo site_url("/commit"); ?>'">我也要写</button>
	<?php foreach ($ano->result() as $row): ?>
		<div class="box">
			<a href="<?= site_url("bbq/pid/$page/$row->id") ?>"><?= $row->nick ?>:</a>
			<br/>

			<p>
				<?= $row->txt ?>
			</p>
			<span id="ttime"><?= date("Y-m-d h:i:s a", $row->time) ?> </span>
			<span id="fid"><?= $row->id ?> 楼</span>
			<br/>
			<a href="<?= site_url("/bbq/pid/$page/$row->id") ?>" class="comment_num">评论(<?= $comment_num["$row->id"] ?>
				)</a>
		</div>
	<?php endforeach; ?>
	<div style="text-align: center;">
		<ul class="pagination pagination-lg">
			<li>
				<a href="<?=site_url("/bbq/index/$page_p");?>" aria-label="Previous">
					<span aria-hidden="true">&laquo;</span>
				</a>
			</li>
			<?php if ($page1 >0):?>
			<li><a href="<?=site_url("/bbq/index/$page1");?>"><?=$page-2 ?></a></li>
			<?php endif;?>
			<?php if ($page2 >0):?>
			<li><a href="<?=site_url("/bbq/index/$page2");?>"><?=$page-1 ?></a></li>
			<?php endif;?>
			<li><a href="<?=site_url("/bbq/index/$page");?>"><?=$page ?></a></li>
			<?php if ($page4 <= $page_max):?>
			<li><a href="<?=site_url("/bbq/index/$page4");?>"><?=$page+1 ?></a></li>
			<?php endif;?>
			<?php if ($page5 <= $page_max):?>
			<li><a href="<?=site_url("/bbq/index/$page5");?>"><?=$page+2 ?></a></li>
			<?php endif;?>
			<li>
				<a href="<?=site_url("/bbq/index/$page_n");?>" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
				</a>
			</li>
		</ul>
	</div>
	<div class="page_div">
		<input type="number" id="page_goto_num">
		<button class="page goto" onclick="goto_page()">跳转到...</button>
	</div>
</div>

<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1254130709'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254130709%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>

</body>

</html>