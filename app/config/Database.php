<?php 

return array(
# ======> 公共配置
    # 网站名称
    'title' => '地球村',
    # 法务邮箱
    'support' => 'support@129.co',
    # 市场邮箱
    'sales' => 'sales@129.co',
    # TOKEN 有效时长 秒
    'token' => '120',
    # 登陆锁屏时间 秒
    'lock' => '120',
    # COOKIES 数据用户未登录过期时间 秒
    'cookiestime' => '86400',
    # SESSION 数据用户登陆后过期时间 秒
    'sessiontime' => '86400',
    # 网站域名
    'site.url' => 'http://a.com',
    # cookies 前缀名称
    'cook.name' => '__cf',
    # SESSION 前缀名称
    'sess.name' => '__cflb',
    # SESSION 作用域
    'sess.domain' => '.a.com',
# ======> Mysql数据库配置
    # 数据库主机地址
    'db.host' => '127.0.0.1',
    # 数据库端口
    'db.port' => '3306',
    # 数据库用户名
    'db.user' => 'root',
    # 数据库密码
    'db.pass' => 'root',
    # 数据库名称
    'db.name' => 'root',
    # 数据库表前缀
    'db.prefix'=>'info_',
    # 数据库编码，默认utf8
    'db.charset' => 'utf8',
# ======> SMTP 配置
    'smtp.host' =>'smtp.qiye.aliyun.com',
    'smtp.user' =>'support@129.co',
    'smtp.pass' =>'',
    'smtp.port' =>'465',
    # port:465 tlss:ssl
    # port:587 tlss:tls
    'smtp.tlss' =>'ssl',
);
