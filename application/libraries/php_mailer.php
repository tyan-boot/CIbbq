<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-1-24
 * Time: 下午5:07
 */

require "class.phpmailer.php";
require "class.smtp.php";
require "mail_cfg.php";


class PHP_Mailer
{

public  function send_mail($email,$nick,$txt,$id)
{
    $mail = new PHPMailer;

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = HOST;  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = USERNAME;                 // SMTP username
    $mail->Password = PASSWD;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 25;                                    // TCP port to connect to

    $mail->From = USERNAME;
    $mail->FromName = '表白墙';
    $mail->addAddress("$email");     // Add a recipient
    $mail->addReplyTo(USERNAME, '表白墙反馈');
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = '表白墙通知';
    $mail->CharSet = "UTF-8";
    $mail->Body = <<<body
<p>你好：</p><p>有一个叫做 $nick 的用户在表白墙给您写了匿名消息,Ta说:<br /><p>$txt</p>点击下面的链接查看</p><a href=http://bbq.tyanboot.pw/index.php/bbq/pid/1/$id>http://bbq.tyanboot.pw/index.php/bbq/pid/1/$id</a><p>如果你不能正常访问，请将上述链接复制到浏览器当中打开</p><p>请勿回复此邮件，如果你有任何疑问，请回复<a href=mailto:xdyz-bbq@outlook.com?subject=表白墙反馈>xdyz-bbq@outlook.com</a>这个邮箱，谢谢合作</p><br /><b>Tyan-Boot 敬上！</b>
body;

    $mail->AltBody = <<<altbody
你好：
有一个叫做 $nick 的用户在表白墙给您写了匿名消息，Ta说:

$txt

点击下面的链接查看
http://bbq.tyanboot.pw/index.php/bbq/pid/1/$id
如果你不能正常访问，请将上述链接复制到浏览器当中打开

请勿回复此邮件，如果你有任何疑问，请回复xdyz-bbq@outlook.com这个邮箱，谢谢合作


Tyan-Boot 敬上！
altbody;

    if ($mail->send())
    {
        return true;
    }
    else return false;
}

}