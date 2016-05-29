<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width"/>
	<title><?= $title ?></title>
	<link rel="stylesheet" type="text/css" href="<?= $css_url ?>/wap_head.css"/>
</head>

<body>

<div class="nav">表白墙</div>

<div class="text">
	<div class="write_box">
		<?php echo form_open('commit/save'); ?>
		<p>注：
			<spwn style="color:#F00;">*</spwn>
			项目为必填<br/>
		</p>
		<p>显示昵称:<input type="text" name="n_name" value="<?php echo set_value('n_name'); ?>"/>
			<spwn style="color:#F00;"><?= $f_nick ?></spwn>
		</p>

		<p>对方邮箱:<input type="text" name="email"/> # 可选，如果填写，则向Ta的邮箱发送一封邮件通知^_^</p>

		<p><?= $f_txt ?><br/>

		<p><textarea cols=auto rows="10" name="txt"></textarea value="
<?php echo set_value('txt'); ?>"></p></p>
		<p><input type="submit" value="提交匿名表白"/></p>
		</form>

	</div>
</div>
</body>
</html>