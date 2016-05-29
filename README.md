# CIbbq
###使用codeigniter 3.0 重写的匿名表白墙

#数据库创建

##主表
```sql
CREATE TABLE bbq
(nick varchar(64) character set utf8,
time int(12),
id int (5),
txt text character set utf8,
ip varchar(15),
to_mail varchar(320),
is_send varchar (1),
hide varchar(1)
)
```
##评论表
```sql
CREATE TABLE bbq_comment
(
parent_id int(11),
comment_id int(11),
time int(12),
nick text character set utf8,
comment text character set utf8
)
```
#数据库配置文件
**application/config/database.php**

```php
$db['default'] = array(
  ......
	'hostname' => '127.0.0.1',    //推荐127.0.0.1
	'username' => 'root',         //数据库用户名
	'password' => '',             //数据库密码
	'database' => 'bbq',          //数据库名
	'dbdriver' => 'mysqli',       //默认mysqli
	......
);
```
#如有疑问请联系:tyan-boot@outlook.com
