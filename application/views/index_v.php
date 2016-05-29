<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title><?= $title ?></title>
	<link rel="stylesheet" type="text/css" href="<?= $css_url ?>/head.css"/>
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
<?php include_once 'head.php'; ?>
<div class="text">
	<button onclick="window.location.href='<?php echo site_url("/commit"); ?>'" class="button black">
	我也要写表白</button>
	<button
		<?php if ($page_p > 0): ?>onclick="window.location.href='<?php echo site_url("/bbq/index/$page_p"); ?>'"<?php endif; ?>
		class="page">
	上一页</button>
	<button class="page">
	第<?= $page ?>/<?= $page_max ?>页</button>
	<button
		<?php if ($page_n <= $page_max): ?>onclick="window.location.href='<?php echo site_url("/bbq/index/$page_n"); ?>'"<?php endif; ?>
		class="page">
	下一页</button>

	<input type="number" id="page_goto_num">
	<button class="page goto" onclick="goto_page()">跳转到...</button>
	<div class="box">
		<b>02^华:</b>

		<p>欢迎来到表白墙，在这里你所发送的消息通通是匿名的！ 如果有疑问，请发送邮件到<a
				href=mailto:xdyz-bbq@outlook.com?subject=表白墙反馈>xdyz-bbq@outlook.com</a>有什么想写给Ta但是又不好意思直说的，这里可以满足你的要求！
		</p>
	</div>
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
</div>

<script
	type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
	document.write(unescape("%3Cspan id='cnzz_stat_icon_1254130709'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254130709%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
</body>
</html>