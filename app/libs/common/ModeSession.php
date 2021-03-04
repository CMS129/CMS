<?php

namespace app\libs\common;

class ModeSession extends Common
{

    /**
     * session初始化
     * @access public
     * @return void
     */
    public function Session()
    {
        register_shutdown_function('session_write_close');
        if (PHP_VERSION_ID < 70300) {
            session_set_cookie_params($this->getSessionTime(), '/; samesite=lax', $this->getDomain(), ((strtolower($this->request()->scheme) === 'http') ? FALSE : TRUE), TRUE);
        } else {
            session_set_cookie_params([
                'lifetime' => $this->getSessionTime(),
                'path' => '/',
                'domain' => $this->getDomain(),
                'secure' => ((strtolower($this->request()->scheme) === 'http') ? FALSE : TRUE),
                'httponly' => TRUE,
                'samesite' => 'lax'
            ]);
        }
        session_name($this->getSessionName());
        session_start();

        setcookie($this->getSessionName(), session_id(), time() + $this->getSessionTime(), '/; samesite=lax', $this->getDomain(), ((strtolower($this->request()->scheme) === 'http') ? FALSE : TRUE), TRUE);

        if (empty($this->getSession('key')) || $this->getMsectime() > unserialize($this->getSession('key'))['time']) {
            $this->setSession('key', serialize(array('id' => md5(uniqid() . $this->getMsectime()), 'time' => $this->getMsectime() + $this->getTokenTime() * 1000)));
        }
    }

    /**
     * session设置
     * @access public
     * @param string $name  session名称
     * @param mixed  $value session值
     * @return void
     */
    public function setSession($name, $value)
    {
        $_SESSION[$name] = $value;
    }


    /**
     * session获取
     * @access public
     * @param string $name    session名称
     * @param mixed  $default 默认值
     * @return mixed
     */
    public function getSession($name)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else {
            return false;
        }
    }

    /**
     * 删除session数据
     * @access public
     * @param string $name session名称
     * @return void
     */
    public function delSession($name)
    {
        unset($_SESSION[$name]);
    }

    /**
     * 销毁session
     */
    public function destroy()
    {
        $_SESSION = array();
        session_destroy();
    }
}
