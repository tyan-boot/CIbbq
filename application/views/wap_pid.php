<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width"/>
	<title><?= $title ?></title>
	<link rel="stylesheet" type="text/css" href="<?= $css_url ?>/wap_head.css"/>
	<link rel="shortcut icon" href="<?= $image_url ?>/favicon.png">
</head>

<body>



<div class="nav">表白墙</div>

<div class="text">
	<div class="box">
		<span id="tid"><?= $sql->nick ?>:</span>
		<br/>

		<p>
			<?= $sql->txt ?>
		</p>
		<span id="ttime"><?= date("Y-m-d h:i:s a", $sql->time) ?> </span>
		<span id="fid"><?= $sql->id ?> 楼</span>

		<br/>

		<div class="comment">
			<ul>
				<?php foreach ($comment->result() as $comment_single): ?>
					<li id="comment_s"><?= $comment_single->nick ?>:<?= $comment_single->comment ?></li>
					<?= date("Y-m-d h:i:s a", $comment_single->time) ?>
					<br/>
				<?php endforeach; ?>
			</ul>
		</div>

		<div id="write_comment">
			<?= form_open("/commit/comment/$page") ?>
			<?= form_hidden('parent_id', $sql->id) ?>
			昵称:
			<?= form_input(array('id' => "comment_nick", 'name' => "comment_nick")) ?>
			<br/><br/>
			评论:
			<?= form_textarea(array(
				'name' => 'comment_txt',
				'rows' => 2), '') ?>
			<br/>
			<?= form_submit('submit', '提交'); ?>
			</form>
		</div>

	</div>

	<button class="return_btn" onclick="window.location.href='<?= site_url("/bbq/index/$page") ?>'">返回</button>
</div>

<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1254130709'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254130709%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>

</body>

</html>

