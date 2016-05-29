<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<!--
	<meta name="viewport" content="width=device-width"/>
	-->
	<title><?= $title ?></title>
	<link rel="stylesheet" type="text/css" href="<?= $css_url ?>/head.css"/>
</head>

<body>
<?php include_once 'head.php' ?>
<div class="text">
	<div class="write">
		<!--<form action="save.php" method="post" name="write" onsubmit="return verify(this)"> -->
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
		<br/>
		<br/>
	</div>
	<div id="foot">Copyright 2014 Boot. All Rights Reserved.<br/>Mail:xdyz-bbq@outlook.com</div>
</div>
</body>
</html>