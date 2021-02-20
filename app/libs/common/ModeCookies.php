<?php

namespace app\libs\common;

class ModeCookies extends Common
{

    private $_securekey;

    /**
     * 防止克隆
     * @var string
     */
    private function __clone()
    {
        $this->_securekey = null;
    }

    /** 设置cookie 
     * @param String $name  cookie name 
     * @param mixed $value cookie value 可以是字符串,数组,对象等 
     * @param int  $expire 过期时间 
     */
    public function setCookie($name, $value, $expire = 0)
    {

        $cookie_name = $this->getName($name);
        $cookie_expire = time() + ($expire ? $expire : $this->getCookieTime());
        $cookie_value = $this->packCookie($value, $cookie_expire);
        $cookie_value = $this->authcodeCookie($cookie_value, 'ENCODE');

        if ($cookie_name && $cookie_value && $cookie_expire) {
            if (PHP_VERSION_ID < 70300) {
                setcookie($cookie_name, $cookie_value, $cookie_expire, '/; samesite=lax', $this->getDomain(), ((strtolower($this->request()->scheme) == 'http') ? FALSE : TRUE), TRUE);
            } else {
                setcookie($cookie_name, $cookie_value, [
                    'expires' => $cookie_expire,
                    'path' => '/',
                    'domain' => $this->getDomain(),
                    'secure' => ((strtolower($this->request()->scheme) == 'http') ? FALSE : TRUE),
                    'httponly' => true,
                    'samesite' => 'lax'
                ]);
            }
        }
    }

    /** 读取cookie 
     * @param String $name  cookie name 
     * @return mixed cookie value 
     */
    public function getCookie($name)
    {

        $cookie_name = $this->getName($name);

        if (isset($_COOKIE[$cookie_name])) {

            $cookie_value = $this->authcodeCookie($_COOKIE[$cookie_name], 'DECODE');
            $cookie_value = $this->unpackCookie($cookie_value);

            return isset($cookie_value[0]) ? $cookie_value[0] : null;
        } else {
            return null;
        }
    }

    /** 直接设置cookie 
     * @param String $name  cookie name 
     * @return mixed cookie value 
     */
    public function setDoCookie($name, $value, $expire = 0)
    {

        $cookie_expire = time() + ($expire ? $expire : $this->getCookieTime());

        if ($name && $value && $cookie_expire) {
            if (PHP_VERSION_ID < 70300) {
                setcookie($name, $value, $cookie_expire, '/; samesite=lax', $this->getDomain(), ((strtolower($this->request()->scheme) == 'http') ? FALSE : TRUE), TRUE);
            } else {
                setcookie($name, $value, [
                    'expires' => $cookie_expire,
                    'path' => '/',
                    'domain' => $this->getDomain(),
                    'secure' => ((strtolower($this->request()->scheme) == 'http') ? FALSE : TRUE),
                    'httponly' => true,
                    'samesite' => 'lax'
                ]);
            }
        }
    }

    /** 直接读取cookie 
     * @param String $name  cookie name 
     * @return mixed cookie value 
     */
    public function getDoCookie($name)
    {

        if (isset($_COOKIE[$name])) {

            return isset($_COOKIE[$name]) ? ceil($_COOKIE[$name]) : null;
        } else {
            return null;
        }
    }

    /** 更新cookie,只更新内容,如需要更新过期时间请使用set方法 
     * @param String $name  cookie name 
     * @param mixed $value cookie value 
     * @return boolean 
     */
    public function upCookie($name, $value)
    {

        $cookie_name = $this->getName($name);

        if (isset($_COOKIE[$cookie_name])) {

            $old_cookie_value = $this->authcodeCookie($_COOKIE[$cookie_name], 'DECODE');
            $old_cookie_value = $this->unpackCookie($old_cookie_value);

            if (isset($old_cookie_value[1]) && $old_cookie_value[1] > 0) { // 获取之前的过期时间 

                $cookie_expire = $old_cookie_value[1];

                // 更新数据 
                $cookie_value = $this->packCookie($value, $cookie_expire);
                $cookie_value = $this->authcodeCookie($cookie_value, 'ENCODE');

                if ($cookie_name && $cookie_value && $cookie_expire) {
                    if (PHP_VERSION_ID < 70300) {
                        setcookie($cookie_name, $cookie_value, $cookie_expire, '/; samesite=lax', $this->getDomain(), ((strtolower($this->request()->scheme) == 'http') ? FALSE : TRUE), TRUE);
                    } else {
                        setcookie($cookie_name, $cookie_value, [
                            'expires' => $cookie_expire,
                            'path' => '/',
                            'domain' => $this->getDomain(),
                            'secure' => ((strtolower($this->request()->scheme) == 'http') ? FALSE : TRUE),
                            'httponly' => true,
                            'samesite' => 'lax'
                        ]);
                    }
                    return true;
                }
            }
        }
        return false;
    }

    /** 清除cookie 
     * @param String $name  cookie name 
     */
    public function delCookie($name)
    {

        $cookie_name = $this->getName($name);
        if (PHP_VERSION_ID < 70300) {
            setcookie($cookie_name, "", time() - $this->getCookieTime(), '/; samesite=lax', $this->getDomain(), ((strtolower($this->request()->scheme) == 'http') ? FALSE : TRUE), TRUE);
        } else {
            setcookie($cookie_name, "", [
                'expires' => time() - $this->getCookieTime(),
                'path' => '/',
                'domain' => $this->getDomain(),
                'secure' => ((strtolower($this->request()->scheme) == 'http') ? FALSE : TRUE),
                'httponly' => true,
                'samesite' => 'lax'
            ]);
        }
    }

    /** 获取cookie name 
     * @param String $name 
     * @return String 
     */
    private function getName($name)
    {
        return $this->getCookiesName() ? $this->getCookiesName() . '_' . $name : $name;
    }

    /** pack 
     * @param Mixed $data   数据 
     * @param int  $expire  过期时间 用于判断
     * @return 
     */
    private function packCookie($data, $expire)
    {

        if ($data === '') {
            return '';
        }

        $cookie_data = array();
        $cookie_data['value'] = $data;
        $cookie_data['expire'] = $expire;
        return json_encode($cookie_data);
    }

    /** unpack 
     * @param Mixed $data 数据 
     * @return       array(数据,过期时间) 
     */
    private function unpackCookie($data)
    {

        if ($data === '') {
            return array('', 0);
        }

        $cookie_data = json_decode($data, true);

        if (isset($cookie_data['value']) && isset($cookie_data['expire'])) {

            if (time() < $cookie_data['expire']) { // 未过期 
                return array($cookie_data['value'], $cookie_data['expire']);
            }
        }
        return array('', 0);
    }

    /** 加密/解密数据 
     * @param String $str    原文或密文 
     * @param String $operation ENCODE or DECODE 
     * @return String      根据设置返回明文活密文 
     */
    private function authcodeCookie($string, $operation = 'DECODE')
    {

        $this->_securekey = md5($this->getKey('token'));
        $key_length = strlen($this->_securekey);
        $string = (($operation === 'DECODE') ? base64_decode(str_replace(array('-', '_', '~'), array('+', '/', '='), $string)) : substr(md5($string . $this->_securekey), 0, 32) . $string);
        $string_length = strlen($string);
        $rndkey = $box = array();
        $result = '';
        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($this->_securekey[$i % $key_length]);
            $box[$i] = $i;
        }
        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        if ($operation === 'DECODE') {
            if (substr($result, 0, 32) == substr(md5(substr($result, 32) . $this->_securekey), 0, 32)) {
                return substr($result, 32);
            } else {
                return '';
            }
        } else {
            return str_replace(array('+', '/', '='), array('-', '_', '~'), base64_encode($result));
        }
    }
}
