<?php

namespace app\libs\common;

use app;

class Common extends app\Engine
{

    // 网站名称
    public function getTitle()
    {
        return trim($this->getDatas()['title']);
    }

    // 网站域名
    public function getSiteURL()
    {
        return trim($this->getDatas()['site.url']);
    }

    // 网站法务邮箱
    public function getSupport()
    {
        return trim($this->getDatas()['support']);
    }

    // 市场部邮箱
    public function getSales()
    {
        return trim($this->getDatas()['sales']);
    }

    // COOKIES 有效时长
    public function getCookieTime()
    {
        return trim(ceil($this->getDatas()['cookiestime']));
    }

    // SESSION 有效时长
    public function getSessionTime()
    {
        return trim(ceil($this->getDatas()['sessiontime']));
    }

    // 帐号锁定有效时长
    public function getLookTime()
    {
        return trim(ceil($this->getDatas()['lock']) * 1000);
    }

    // TOKEN 有效时长
    public function getTokenTime()
    {
        return trim(ceil($this->getDatas()['token']) * 1000);
    }

    // 访问协议
    public function getScheme()
    {
        return trim($this->request()->scheme);
    }

    // COOKIES Name ID
    public function getCookiesName()
    {
        return trim($this->getDatas()['cook.name']);
    }

    // SESSION Name ID
    public function getSessionName()
    {
        return trim($this->getDatas()['sess.name']);
    }

    // 作用域
    public function getDomain()
    {
        return trim($this->getDatas()['sess.domain']);
    }

    // Token
    public function getToken($value = null)
    {
        if (!empty($value) || empty($this->session()->getSession('token')) || $this->getMsectime() > unserialize($this->session()->getSession('token'))['time']) {
            $getToken = $this->getTokenID('GET');
            $postToken = $this->getTokenID('POST');
            $token = md5($getToken . uniqid() . $this->getMsectime() . $postToken);
            $this->session()->setSession('token', serialize(array('token' => $token, 'get' => $getToken, 'post' => $postToken, 'time' => $this->getMsectime() + $this->coms()->getTokenTime())));
            return $token;
        } else {
            $token = unserialize($this->session()->getSession('token'))['token'];
            return $token;
        }
    }

    // GET|POST MD5
    public function getTokenID($value = 'GET')
    {
        return md5(md5($value) . md5(htmlspecialchars($this->request()->url, ENT_QUOTES, 'UTF-8')) . md5($this->request()->scheme) . md5($this->request()->user_agent) . md5($this->request()->cookies[$this->coms()->getSessionName()]) . md5($this->request()->accept) . unserialize($this->session()->getSession('key'))['id']);
    }

    // RSA 私有获取数据
    private function getThird()
    {
        return $this->get('web.third')['private'];
    }

    // 获取默认数据
    private function getDatas()
    {
        return $this->get('web.config');
    }

    // 获取替换词典
    private function getDict()
    {
        return $this->get('web.dict');
    }

    // RSA 公共证书
    public function getKey($value = 'public')
    {
        return trim(preg_replace('/[\r\n]/', '', $this->get('web.third')[$value . '.third']));
    }

    // 注册成功模板
    public function getRegisterMB($username, $email, $value)
    {
        return "<div style='width:640px; background:#fff; border:solid 1px #efefef; margin:0 auto; padding:35px 0 35px 0'><table width='560' border='0' align='center' cellpadding='0' cellspacing='0' style='margin:0 auto; margin-left:30px; margin-right:30px;'><tbody><tr><th valign='middle' style='height: 25px; line-height: 25px; padding: 15px 35px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: #42a3d3; background-color: #49bcff; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;'><font face='微软雅黑' size='5' style='color: rgb(255, 255, 255); '>注册成功! （" . $this->getTitle() . "）</font></th></tr><tr><td><h3 style='font-weight:normal; font-size:18px; padding:25px 0px 0px 0px;'>尊敬的用户：<span style='font-weight:bold; margin-left:5px;'>" . $username . "</span></h3><p style='color:#666; font-size:14px'>首先感谢您加入" . $this->getTitle() . "！下面是您的帐号信息：<br>您的帐号：<b>" . $username . "</b><br>您的密码：<b>********</b><br>您的邮箱：<b>" . $email . "</b><br>您的激活码：<b>" . $value . "</b><br>您注册时的日期：<b>" . date("Y-m-d H:i:s", time()) . "</b><br>您注册时的IP：<b>" . trim($this->getSrt('ip', $this->request()->ip)) . "</b><br>当您点击登录和注册即代表同意《<a href='" . $this->getSiteURL() . "/terms' target='_blank'>服务条例</a>》与《<a href='" . $this->getSiteURL() . "/privacy' target='_blank'>隐私声明</a>》。<br>如果您对" . $this->getTitle() . "的隐私政策或做法有任何问题或疑虑，请通过以下地址联系：<br>电子邮箱：" . $this->getSupport() . "</p><p align='right'>" . $this->getTitle() . "</p><p align='right'>" . date("Y年m月d日", time()) . "</p><div style='width:580px;margin:0 auto;'><div style='padding:10px 10px 0;border-top:1px solid #ccc;color:#747474;margin-bottom:20px;line-height:1.3em;font-size:12px;'><p>此为系统邮件，请勿直接回复！<br>请保管好您的邮箱地址，避免帐号被他人盗用。 <br><a href='" . $this->getSiteURL() . "/terms' target='_blank'>服务条例</a> | <a href='" . $this->getSiteURL() . "/privacy' target='_blank'>隐私声明</a></p></div></div></td></tr></tbody></table></div>";
    }

    // 用户找回密码模板
    public function getForgotMB($username, $email, $toKCode)
    {
        return "<div style='width:640px; background:#fff; border:solid 1px #efefef; margin:0 auto; padding:35px 0 35px 0'><table width='560' border='0' align='center' cellpadding='0' cellspacing='0' style='margin:0 auto; margin-left:30px; margin-right:30px;'><tbody><tr><th valign='middle' style='height: 25px; line-height: 25px; padding: 15px 35px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: #42a3d3; background-color: #49bcff; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;'><font face='微软雅黑' size='5' style='color: rgb(255, 255, 255); '>重置密码! （" . $this->getTitle() . "）</font></th></tr><tr><td><h3 style='font-weight:normal; font-size:18px; padding:25px 0px 0px 0px;'>尊敬的用户：<span style='font-weight:bold; margin-left:5px;'>" . $username . "</span></h3><p style='color:#666; font-size:14px'>请在24小时内点击下面链接找回您的登录密码：<a href='" . $this->getSiteURL() . "/forgot-password?email=" . $email . "&amp;toKCode=" . $toKCode . "' target='_blank' style='display:block; margin-top:10px; color:#2980b9; line-height:24px; text-decoration:none;word-break:break-all; width:575px;'>" . $this->getSiteURL() . "/forgot-password?email=" . $email . "&amp;toKCode=" . $toKCode . "</a></p><p style='margin:0 0 5px 0; padding:0 0 3px 0;'><a href='" . $this->getSiteURL() . "/forgot-password?email=" . $email . "&amp;toKCode=" . $toKCode . "' style='display:inline-block; width:105px; text-align:center; background:#2980b9; color:#fff;  font-size:16px; text-decoration:none; line-height:34px; padding:0;border-radius:5px;' target='_blank'>查看详情</a></p><p style='margin:10px 0 5px 0; padding:3px 0;color:#666; font-size:14px'>如果您无法访问此链接，请将地址复制到您的浏览器（例如：Edge）的地址栏再访问。</p><p style='margin:5px 0; padding:3px 0;color:#666; font-size:14px'>如果链接已经失效，请重新到 <a href='" . $this->getSiteURL() . "' target='_blank' style='color:#2980b9;'>" . $this->getSiteURL() . "</a> 找回您的密码！</p><p align='right'>" . $this->getTitle() . "</p><p align='right'>" . date("Y-m-d H:i:s", time()) . "</p><div style='width:580px;margin:0 auto;'><div style='padding:10px 10px 0;border-top:1px solid #ccc;color:#747474;margin-bottom:20px;line-height:1.3em;font-size:12px;'><p>此为系统邮件，请勿直接回复！<br>请保管好您的邮箱地址，避免帐号被他人盗用。 <br><a href='" . $this->getSiteURL() . "/terms' target='_blank'>服务条例</a> | <a href='" . $this->getSiteURL() . "/privacy' target='_blank'>隐私声明</a></p></div></div></td></tr></tbody></table></div>";
    }

    // 重置密码提醒模板
    public function getResetMB($username, $email)
    {
        return "<div style='width:640px; background:#fff; border:solid 1px #efefef; margin:0 auto; padding:35px 0 35px 0'><table width='560' border='0' align='center' cellpadding='0' cellspacing='0' style='margin:0 auto; margin-left:30px; margin-right:30px;'><tbody><tr><th valign='middle' style='height: 25px; line-height: 25px; padding: 15px 35px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: #42a3d3; background-color: #49bcff; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;'><font face='微软雅黑' size='5' style='color: rgb(255, 255, 255); '>密码重置成功! （" . $this->getTitle() . "）</font></th></tr><tr><td><h3 style='font-weight:normal; font-size:18px; padding:25px 0px 0px 0px;'>尊敬的用户：<span style='font-weight:bold; margin-left:5px;'>" . $username . "</span></h3><p style='color:#666; font-size:14px'>首先感谢您加入" . $this->getTitle() . "！下面是您的帐号密码重置信息：<br>您的帐号：<b>" . $username . "</b><br>您的密码：<b>********</b><br>您的邮箱：<b>" . $email . "</b><br>您重置时的日期：<b>" . date("Y-m-d H:i:s", time()) . "</b><br>您重置时的IP：<b>" . trim($this->getSrt('ip', $this->request()->ip)) . "</b><br>当您点击登录和注册即代表同意《<a href='" . $this->getSiteURL() . "/terms' target='_blank'>服务条例</a>》与《<a href='" . $this->getSiteURL() . "/privacy' target='_blank'>隐私声明</a>》。<br>如果您对" . $this->getTitle() . "的隐私政策或做法有任何问题或疑虑，请通过以下地址联系：<br>电子邮箱：" . $this->getSupport() . "</p><p align='right'>" . $this->getTitle() . "</p><p align='right'>" . date("Y年m月d日", time()) . "</p><div style='width:580px;margin:0 auto;'><div style='padding:10px 10px 0;border-top:1px solid #ccc;color:#747474;margin-bottom:20px;line-height:1.3em;font-size:12px;'><p>此为系统邮件，请勿直接回复！<br>请保管好您的邮箱地址，避免帐号被他人盗用。 <br><a href='" . $this->getSiteURL() . "/terms' target='_blank'>服务条例</a> | <a href='" . $this->getSiteURL() . "/privacy' target='_blank'>隐私声明</a></p></div></div></td></tr></tbody></table></div>";
    }

    // 定制设计回复模板
    public function getContactMB($email)
    {
        return "<div style='width:640px; background:#fff; border:solid 1px #efefef; margin:0 auto; padding:35px 0 35px 0'><table width='560' border='0' align='center' cellpadding='0' cellspacing='0' style='margin:0 auto; margin-left:30px; margin-right:30px;'><tbody><tr><th valign='middle' style='height: 25px; line-height: 25px; padding: 15px 35px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: #42a3d3; background-color: #49bcff; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;'><font face='微软雅黑' size='5' style='color: rgb(255, 255, 255); '>定制设计说明! （" . $this->getTitle() . "）</font></th></tr><tr><td><h3 style='font-weight:normal; font-size:18px; padding:25px 0px 0px 0px;'>尊敬的用户：<span style='font-weight:bold; margin-left:5px;'>" . $email . "</span></h3><p style='color:#666; font-size:14px'>首先感谢您选择" . $this->getTitle() . "！为您提供高端定制设计服务：<br>您的邮箱：<b>" . $email . "</b><br>咨询日期：<b>" . date("Y-m-d H:i:s", time()) . "</b><br>您咨询时的IP：<b>" . trim($this->getSrt('ip', $this->request()->ip)) . "</b><br><br>请将《项目需求方案说明书》已附件形式发送至以下电子邮箱：<br>市场部经理：<b>" . $this->getSales() . "</b><br>收到邮件后会有专人为您提供服务。</p><p align='right'>" . $this->getTitle() . "</p><p align='right'>" . date("Y年m月d日", time()) . "</p><div style='width:580px;margin:0 auto;'><div style='padding:10px 10px 0;border-top:1px solid #ccc;color:#747474;margin-bottom:20px;line-height:1.3em;font-size:12px;'><p>此为系统邮件，请勿直接回复！<br>请保管好您的邮箱地址，避免帐号被他人盗用。 <br><a href='" . $this->getSiteURL() . "/terms' target='_blank'>服务条例</a> | <a href='" . $this->getSiteURL() . "/privacy' target='_blank'>隐私声明</a></p></div></div></td></tr></tbody></table></div>";
    }

    // RSA 加密, 解密, 签名, 验签 返回JSON
    public function getRSA($id = 're', $data = false, $sign = false, $third = false)
    {
        $this->loader->register('getRsaSrt', '\app\libs\common\ModeRSA', array(
            $this->getKey(),
            $this->getThird(),
            (empty($third) ? $this->getKey() : $this->getKey($third)),
        ));
        $value = $this->getRsaSrt();
        switch ($id) {
            case 're':
                return $value->privEncrypt($data); // 私钥加密
                break;
            case 'ud':
                return $value->publicDecrypt($data); // 公钥解密
                break;
            case 'ue':
                return $value->publicEncrypt($data); // 公钥加密
                break;
            case 'rd':
                return $value->privDecrypt($data); // 私钥解密
                break;
            case 'rs':
                return $value->privSign($data); // 私钥签名
                break;
            case 'uv':
                return $value->publicVerifySign($data, $sign); // 公钥验证
                break;
            case 'tv':
                return $value->publicVerifySignThird($data, $sign); // 第三方公钥验证
                break;
            default:
                return 'RSA Error: Data not';
        }
    }

    // 设置数据库链接
    public function getDB($value = 'db')
    {
        if (!isset(self::$dbsInstance[$value])) {
            $this->loader->register('getDbPdo', '\app\libs\common\MySQLPDO', array(
                $this->getDatas()[$value . '.host'],    // 数据库主机地址 默认='127.0.0.1'
                $this->getDatas()[$value . '.user'],    // 数据库用户名
                $this->getDatas()[$value . '.pass'],    // 数据库密码
                $this->getDatas()[$value . '.name'],    // 数据库名称
                $this->getDatas()[$value . '.charset'], // 数据库编码 默认=utf8
                $this->getDatas()[$value . '.port'],    // 数据库端口 默认=3306
                $this->getDatas()[$value . '.prefix'],  // 数据库表前缀
            ));
            try {
                $name = $this->getDbPdo();
                if (!$name) {
                    throw new \Exception();
                }
                self::$dbsInstance[$value] = $name;
            } catch (\Exception $e) {
                die(json_encode(array('code' => 500, 'msg' => 'Mysqli数据库连接失败', 'data' => false), JSON_UNESCAPED_UNICODE));
            }
        }
        return self::$dbsInstance[$value];
    }

    // 发送 SMTP 邮件
    public function getSMTP($email = null, $value = null, $Subject = null, $body = null)
    {
        $this->loader->register('getSMTPPOP', '\app\libs\common\PHPMailer', array(TRUE));
        try {
            // 服务器设置
            $this->getSMTPPOP()->SMTPDebug  = SMTP::DEBUG_OFF;                          // 启用详细调试输出
            $this->getSMTPPOP()->isSMTP();                                              // 使用SMTP发送
            $this->getSMTPPOP()->Host       = trim($this->getDatas()['smtp.host']);     // 设置SMTP服务器进行发送
            $this->getSMTPPOP()->SMTPAuth   = true;                                     // 启用SMTP身份验证
            $this->getSMTPPOP()->Username   = trim($this->getDatas()['smtp.user']);     // SMTP用户名
            $this->getSMTPPOP()->Password   = trim($this->getDatas()['smtp.pass']);     // SMTP密码
            $this->getSMTPPOP()->SMTPSecure = trim($this->getDatas()['smtp.tlss']);     // 启用TLS加密或者SSL加密
            $this->getSMTPPOP()->Port       = trim($this->getDatas()['smtp.port']);     // 要连接到TCP 465端口, 请在上面使用 ssl 模式
            $this->getSMTPPOP()->CharSet    = "utf-8";

            //收件人
            $this->getSMTPPOP()->setFrom(trim($this->getDatas()['smtp.user']), $this->getTitle());    // 设置发件人
            $this->getSMTPPOP()->addAddress(trim($email), trim($value));                               // 添加收件人
            //$this->getSMTPPOP()->addAddress('ellen@example.com');                                   // 名称可写项
            $this->getSMTPPOP()->addReplyTo(trim($this->getDatas()['smtp.user']), $this->getTitle()); // 添加回复人
            //$this->getSMTPPOP()->addCC('cc@example.com');
            //$this->getSMTPPOP()->addBCC('bcc@example.com');

            // 附件
            //$this->getSMTPPOP()->addAttachment('/var/tmp/file.tar.gz');               // 添加附件
            //$this->getSMTPPOP()->addAttachment('/tmp/image.jpg', 'new.jpg');          // Optional name

            // 内容
            $this->getSMTPPOP()->isHTML(true);                                          // 将电子邮件格式设置为HTML
            $this->getSMTPPOP()->Subject = trim($Subject);
            $this->getSMTPPOP()->Body    = trim($body);
            //$this->getSMTPPOP()->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->getSMTPPOP()->send();
            return TRUE;
        } catch (Exception $e) {
            return FALSE; // $this->getSMTPPOP()->ErrorInfo
        }
    }

    // 正则过滤
    public function getSrt($type = null, $value = null)
    {
        $pattern = '';
        switch ($type) {
            case "user":
                $pattern = '/^[\w\-\.]{1,32}$/ui';
                break;
            case "passwd":
                $pattern = '/(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,32}/ui';
                break;
            case "email":
                $pattern = '/([a-z0-9]*[-_\.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?/ui';
                break;
            case "tel":
                $pattern = '/^1[34578]\d{9}$/ui';
                break;
            case "ip":
                if (strpos($value, ':') !== false) {
                    $pattern = '/^((([0-9A-Fa-f]{1,4}:){7}(([0-9A-Fa-f]{1,4}){1}|:))|(([0-9A-Fa-f]{1,4}:){6}((:[0-9A-Fa-f]{1,4}){1}|((22[0-3]|2[0-1][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})([.](25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})){3})|:))|(([0-9A-Fa-f]{1,4}:){5}((:[0-9A-Fa-f]{1,4}){1,2}|:((22[0-3]|2[0-1][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})([.](25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})){3})|:))|(([0-9A-Fa-f]{1,4}:){4}((:[0-9A-Fa-f]{1,4}){1,3}|:((22[0-3]|2[0-1][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})([.](25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})){3})|:))|(([0-9A-Fa-f]{1,4}:){3}((:[0-9A-Fa-f]{1,4}){1,4}|:((22[0-3]|2[0-1][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})([.](25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})){3})|:))|(([0-9A-Fa-f]{1,4}:){2}((:[0-9A-Fa-f]{1,4}){1,5}|:((22[0-3]|2[0-1][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})([.](25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})){3})|:))|(([0-9A-Fa-f]{1,4}:){1}((:[0-9A-Fa-f]{1,4}){1,6}|:((22[0-3]|2[0-1][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})([.](25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})){3})|:))|(:((:[0-9A-Fa-f]{1,4}){1,7}|(:[fF]{4}){0,1}:((22[0-3]|2[0-1][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})([.](25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})){3})|:)))$/ui';
                } else {
                    $pattern = '/^(?:(?:2[0-4][0-9]\.)|(?:25[0-5]\.)|(?:1[0-9][0-9]\.)|(?:[1-9][0-9]\.)|(?:[0-9]\.)){3}(?:(?:2[0-5][0-5])|(?:25[0-5])|(?:1[0-9][0-9])|(?:[1-9][0-9])|(?:[1-9]))$/ui';
                }
                break;
            case "content":
                $pattern = '/([a-zA-Z0-9\/\_\～\+\-\.\:\·\,\，\。\？\！\?\!\%\\\、\（\）\s]+|[\x{4e00}-\x{9fff}]+|[\x{0800}-\x{4e00}]+|[\x{AC00}-\x{D7A3}]+)/ui';
                break;
            default:
                $pattern = '/^[\w\-\.]{1,32}$/ui';
        }
        preg_match_all($pattern, $value, $match);
        return !empty($match[0]) ? trim(implode('', $match[0])) : FALSE;
    }

    // 获取运行毫秒
    public function getMsectime()
    {
        list($msec, $sec) = explode(' ', microtime());
        $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
        return $msectime;
    }

    // 伪原创替换内容
    public function getReplace($value)
    {
        $replaced = array();

        $value = $this->getSrt('content', $value);

        foreach ($this->getDict() as $key => $val) {
            if (preg_match("/" . $key . "/", $value) && !in_array($key, $replaced)) {
                $value = str_replace($key, $val, $value);
                array_push($replaced, $val);
            }
        }

        return $value;
    }

    // 远程获取内容
    public function getJson($value)
    {
        $randIP = $this->getRandIP();
        $user_agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:75.0) Gecko/20100101 Firefox/75.0';
        $options =  array(
            CURLOPT_URL => $value,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_HTTPGET => TRUE,
            CURLOPT_NOBODY => FALSE,
            CURLOPT_HEADER => FALSE,
            CURLOPT_REFERER => $value,
            CURLOPT_USERAGENT => $user_agent,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_FOLLOWLOCATION => TRUE,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_SSL_VERIFYHOST => FALSE,
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain', 'X-FORWARDED-FOR:' . $randIP, 'CLIENT-IP:' . $randIP),
        );

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        $Code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return array(str_replace(array("\r", "\n", "\r\n"), "", $this->str_to_utf8($result)), $Code);
    }

    // 访问内容 IP
    private function getRandIP()
    {
        $ip2id = round(rand(600000, 2550000) / 10000);
        $ip3id = round(rand(600000, 2550000) / 10000);
        $ip4id = round(rand(600000, 2550000) / 10000);
        $_array = array('218', '218', '66', '66', '218', '218', '60', '60', '202', '204', '66', '66', '66', '59', '61', '60', '222', '221', '66', '59', '60', '60', '66', '218', '218', '62', '63', '64', '66', '66', '122', '211');
        $randarr = mt_rand(0, count($_array) - 1);
        $ip1id = $_array[$randarr];
        return $ip1id . '.' . $ip2id . '.' . $ip3id . '.' . $ip4id;
    }

    // 内容转码 UTF-8
    private function str_to_utf8($value = '')
    {
        $current_encode = mb_detect_encoding($value, array("ASCII", "GB2312", "GBK", 'BIG5', 'UTF-8'));
        $encoded_str = mb_convert_encoding($value, 'UTF-8', $current_encode);
        return $encoded_str;
    }

    // Unicode 编码
    public function unicode_encode($value)
    {
        $value = $this->getSrt('content', $value);
        $strArr = preg_split('/(?<!^)(?!$)/u', $value);
        $resUnicode = '';
        foreach ($strArr as $str) {
            $bin_str = '';
            $arr = is_array($str) ? $str : str_split($str);
            foreach ($arr as $value) {
                $bin_str .= decbin(ord($value));
            }
            $bin_str = preg_replace('/^.{4}(.{4}).{2}(.{6}).{2}(.{6})$/', '$1$2$3', $bin_str);
            $unicode = dechex(bindec($bin_str));
            $_sup = '';
            for ($i = 0; $i < 4 - strlen($unicode); $i++) {
                $_sup .= '0';
            }
            $str = '\\u' . $_sup . $unicode;
            $resUnicode .= $str;
        }
        return $resUnicode;
    }

    // Unicode 解码
    public function unicode_decode($value)
    {
        $value = $this->getSrt('content', $value);
        $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
        preg_match_all($pattern, $value, $matches);
        if (!empty($matches)) {
            $value = '';
            for ($j = 0; $j < count($matches[0]); $j++) {
                $str = $matches[0][$j];
                if (strpos($str, '\\u') === 0) {
                    $code = base_convert(substr($str, 2, 2), 16, 10);
                    $code2 = base_convert(substr($str, 4), 16, 10);
                    $c = chr($code) . chr($code2);
                    $c = iconv('UCS-2', 'UTF-8', $c);
                    $value .= $c;
                } else {
                    $value .= $str;
                }
            }
        }
        return $value;
    }
}
