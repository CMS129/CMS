<?php

namespace app\libs\backend;

use Api;

class UserController extends BaseController
{

    /**
     * 帐号首页
     */
    public static function settings()
    {
        parent::__checkManagePrivate();

        $CMSCO = ['user' => unserialize(Api::session()->getSession('user'))['user'], 'title' => '帐号设置-' . Api::coms()->getTitle(), 'site_url' => Api::coms()->getSiteURL()];
        Api::render('user/settings', $CMSCO);
    }

    /**
     * 帐号登陆
     */
    public static function login()
    {
        if (Api::request()->method === 'GET') {
            $token = Api::coms()->getToken(1);
        }

        if (Api::request()->method === 'POST') {
            $toke = unserialize(Api::session()->getSession('token'));

            if (Api::coms()->getMsectime() > $toke['time']) {
                Api::redirect('/login', 302);
            }

            if (isset(Api::request()->data['__hash__']) && (md5($toke['token']) === md5(Api::request()->data['__hash__'])) && ($toke['get'] === Api::coms()->getTokenID('GET')) && ($toke['post'] === Api::coms()->getTokenID('POST'))) {
                Api::session()->delSession('token');

                $proxy_ip = Api::coms()->getSrt('ip', Api::request()->proxy_ip);
                if (!empty($proxy_ip)) {
                    Api::render('error');
                }

                $loginpwd = trim(Api::coms()->getRSA('rd', Api::request()->data['nloginpwd']));
                if (md5(substr($loginpwd, -32)) != md5($toke['token'])) {
                    Api::redirect('/login', 302);
                }

                $inUser = Api::coms()->getSrt('user', trim(Api::request()->data['loginname']));
                $nloginpwd = md5(substr($loginpwd, 0, -32));

                $option = array('user_md5' => md5($inUser));
                $dbData = Api::coms()->getDB()->field('user_id,user_name,user_pwd,user_lock,user_session,user_del')->where($option)->limit(1)->select('user');

                if (!empty($dbData[0]) && (Api::request()->data['loginname'] === trim($dbData[0]['user_name'])) && ($nloginpwd === trim($dbData[0]['user_pwd'])) && (trim($dbData[0]['user_del']) === '0')) {

                    if ($dbData[0]['user_session'] != md5('000000')) {
                        Api::coms()->getDB()->where(array('user_id' => $dbData[0]['user_id']))->update('user', array('user_session' => md5(Api::request()->cookies[Api::coms()->getSessionName()]), 'user_ip' => trim(Api::coms()->getSrt('ip', Api::request()->ip)), 'user_logintime' => time()));
                        $dbSession = md5(Api::request()->cookies[Api::coms()->getSessionName()]);
                    } else {
                        $dbSession = md5('000000');
                    }

                    Api::session()->setSession('user', serialize(array('id' => $dbData[0]['user_id'], 'user' => $dbData[0]['user_name'], 'lock' => $dbData[0]['user_lock'], 'sess' => $dbSession, 'del' => trim($dbData[0]['user_del']))));

                    Api::cookies()->setCookie('sid', array('id' => md5($dbData[0]['user_id']), 'sess' => $dbSession, 'del' => trim($dbData[0]['user_del'])));

                    Api::cookies()->setCookie('lock', array('time' => Api::coms()->getMsectime()));

                    Api::redirect('/user-index', 302);
                } else {
                    Api::redirect('/login', 302);
                }
            } else {
                Api::redirect('/login', 302);
            }
        }

        Api::render('user/login', array('pubKey' => base64_encode(Api::coms()->getKey('public')), 'token' => $token, 'title' => '帐号登录-' . Api::coms()->getTitle(), 'site_url' => Api::coms()->getSiteURL()));
    }

    /**
     * 帐号退出登录
     */
    public static function logout()
    {
        parent::__checkManagePrivate();

        Api::session()->delSession('token');
        header("Cache-control:no-cache,no-store,must-revalidate");
        header("Pragma:no-cache");
        header("Expires:0");
        Api::session()->delSession('user');
        Api::session()->destroy();
        Api::cookies()->delCookie('sid');
        Api::cookies()->delCookie('lock');
        Api::redirect('/', 302);
    }

    // 帐号注册
    public static function register()
    {
        if (Api::request()->method === 'GET') {
            $token = Api::coms()->getToken(1);
        }
        if (Api::request()->method === 'POST') {
            $toke = unserialize(Api::session()->getSession('token'));

            if (Api::coms()->getMsectime() > $toke['time']) {
                Api::redirect('/register', 302);
            }

            if (isset(Api::request()->data['__hash__']) && (md5($toke['token']) === md5(Api::request()->data['__hash__'])) && ($toke['get'] === Api::coms()->getTokenID('GET')) && ($toke['post'] === Api::coms()->getTokenID('POST'))) {
                Api::session()->delSession('token');

                $proxy_ip = Api::coms()->getSrt('ip', Api::request()->proxy_ip);
                if (!empty($proxy_ip)) {
                    Api::render('error');
                }

                $loginpwd = trim(Api::coms()->getRSA('rd', Api::request()->data['nloginpwd']));
                if (md5(trim(substr($loginpwd, -32))) != md5($toke['token'])) {
                    Api::redirect('/register', 302);
                }

                $inIP = Api::coms()->getSrt('ip', Api::request()->ip);
                $inPwd = Api::coms()->getSrt('passwd', trim(substr($loginpwd, 0, -32)));
                $inUser = Api::coms()->getSrt('user', trim(Api::request()->data['loginname']));
                $inEmail = Api::coms()->getSrt('email', trim(Api::request()->data['loginmail']));

                if (empty($inPwd) || empty($inUser) || empty($inEmail) || trim($inUser) !== trim(Api::request()->data['loginname']) || trim($inPwd) !== trim(substr($loginpwd, 0, -32)) || trim($inEmail) !== trim(Api::request()->data['loginmail'])) {
                    Api::redirect('/register', 302);
                }

                if (!empty(Api::coms()->getDB()->field('user_id')->where(array('user_md5' => md5(trim($inUser)), 'user_email' => array($inEmail, '=', 'or')))->limit(1)->select('user')[0])) {
                    Api::redirect('/register', 302);
                } else {
                    $inLook = mt_rand(100000, 900000);
                    $option = array('user_name' => trim($inUser), 'user_pwd' => md5($inPwd), 'user_md5' => md5($inUser), 'user_lock' => md5($inLook), 'user_session' => md5('000000'), 'user_ok' => '1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 'user_email' => trim($inEmail), 'user_del' => 0, 'user_ip' => trim($inIP), 'user_logintime' => time());

                    Api::coms()->getDB()->insert('user', $option);
                    Api::coms()->getSMTP($inEmail, $inUser, '[' . Api::coms()->getTitle() . '] 注册成功说明', Api::coms()->getRegisterMB($inUser, $inEmail, $inLook));

                    Api::redirect('/login', 302);
                }
            } else {
                Api::redirect('/register', 302);
            }
        }
        Api::render('user/register', array('pubKey' => base64_encode(Api::coms()->getKey('public')), 'token' => $token, 'site_url' => Api::coms()->getSiteURL(), 'title' => '帐号注册-' . Api::coms()->getTitle()));
    }

    // 帐号激活
    public static function active()
    {
        parent::__checkManagePrivate();

        if (unserialize(Api::session()->getSession('user'))['sess'] === md5(Api::request()->cookies[Api::coms()->getSessionName()])) {
            Api::redirect('/user-index', 302);
        }

        if (Api::request()->method === 'GET') {
            $token = Api::coms()->getToken(1);
        }

        if (Api::request()->method === 'POST') {
            $toke = unserialize(Api::session()->getSession('token'));
            if (Api::coms()->getMsectime() > $toke['time']) {
                Api::redirect('/active', 302);
            }

            if (isset(Api::request()->data['__hash__']) && (md5($toke['token']) === md5(Api::request()->data['__hash__'])) && ($toke['get'] === Api::coms()->getTokenID('GET')) && ($toke['post'] === Api::coms()->getTokenID('POST'))) {
                Api::session()->delSession('token');

                $proxy_ip = Api::coms()->getSrt('ip', Api::request()->proxy_ip);
                if (!empty($proxy_ip)) {
                    Api::render('error');
                }

                $loginpwd = trim(Api::coms()->getRSA('rd', Api::request()->data['nloginpwd']));
                if (md5(trim(substr($loginpwd, -32))) != md5($toke['token'])) {
                    Api::redirect('/active', 302);
                }

                $inPwd = Api::coms()->getSrt('active', trim(substr($loginpwd, 0, -32)));
                $dbData = Api::coms()->getDB()->field('user_id,user_pwd,user_lock,user_session')->where(array('user_id' => unserialize(Api::session()->getSession('user'))['id']))->limit(1)->select('user');

                if (($dbData[0]['user_session'] === md5('000000')) && ($dbData[0]['user_lock'] === md5($inPwd))) {
                    Api::coms()->getDB()->where(array('user_id' => trim($dbData[0]['user_id'])))->update('user', array('user_lock' => $dbData[0]['user_pwd'], 'user_session' => md5(Api::request()->cookies[Api::coms()->getSessionName()]), 'user_ip' => trim(Api::coms()->getSrt('ip', Api::request()->ip)), 'user_logintime' => time()));

                    Api::redirect('/login', 302);
                } else {
                    header("Cache-control:no-cache,no-store,must-revalidate");
                    header("Pragma:no-cache");
                    header("Expires:0");
                    Api::session()->delSession('user');
                    Api::session()->destroy();
                    Api::redirect('/login', 302);
                }
            } else {
                Api::redirect('/register', 302);
            }
        }
        Api::render('user/active', array('pubKey' => base64_encode(Api::coms()->getKey('public')), 'token' => $token, 'site_url' => Api::coms()->getSiteURL(), 'title' => '帐号激活-' . Api::coms()->getTitle()));
    }

    // 用户找回密码
    public static function forgot_password()
    {
        if (Api::request()->method === 'GET') {
            $token = Api::coms()->getToken(1);

            // 重置密码
            if (!empty(Api::request()->query['email']) && Api::request()->query['toKCode']) {

                $inEmail = Api::coms()->getSrt('email', trim(Api::request()->query['email']));
                $toKCode = Api::coms()->getSrt('toKCode', trim(Api::request()->query['toKCode']));
                if (empty($inEmail) || empty($toKCode)) {
                    Api::redirect('/forgot-password', 302);
                }

                Api::render('user/reset-password', array('pubKey' => base64_encode(Api::coms()->getKey('public')), 'toKCode' => $toKCode, 'inEmail' => $inEmail, 'token' => $token, 'site_url' => Api::coms()->getSiteURL(), 'title' => '重置密码-' . Api::coms()->getTitle()));
                exit();
            }
        }

        if (Api::request()->method === 'POST') {
            $toke = unserialize(Api::session()->getSession('token'));
            if (Api::coms()->getMsectime() > $toke['time']) {
                Api::redirect('/forgot-password', 302);
            }
            if (isset(Api::request()->data['__hash__']) && (md5($toke['token']) === md5(Api::request()->data['__hash__'])) && ($toke['get'] === Api::coms()->getTokenID('GET')) && ($toke['post'] === Api::coms()->getTokenID('POST'))) {
                Api::session()->delSession('token');

                $proxy_ip = Api::coms()->getSrt('ip', Api::request()->proxy_ip);
                if (!empty($proxy_ip)) {
                    Api::render('error');
                }

                // 重置密码
                if (!empty(Api::request()->query['email']) && Api::request()->query['toKCode']) {

                    $inEmail = Api::coms()->getSrt('email', trim(Api::request()->query['email']));
                    $toKCode = Api::coms()->getSrt('toKCode', trim(Api::request()->query['toKCode']));
                    if (empty($inEmail) || empty($toKCode)) {
                        Api::redirect('/forgot-password', 302);
                    }

                    $loginpwd = trim(Api::coms()->getRSA('rd', Api::request()->data['nloginpwd']));
                    if (md5(substr($loginpwd, -32)) != md5($toke['token'])) {
                        Api::redirect('/forgot-password', 302);
                    }

                    $loginpwd = Api::coms()->getSrt('passwd', trim(substr($loginpwd, 0, -32)));
                    if (empty($loginpwd)) {
                        Api::redirect('/forgot-password', 302);
                    }

                    $dbData = Api::coms()->getDB()->field('user_id,user_name,user_session,user_del,user_logintime')->where(array('user_email' => $inEmail))->limit(1)->select('user');
                    if (!empty($dbData[0]) && (trim($dbData[0]['user_session']) === $toKCode) && (trim($dbData[0]['user_del']) === '2') && ((trim($dbData[0]['user_logintime']) + 86400) > time())) {

                        Api::coms()->getDB()->where(array('user_id' => $dbData[0]['user_id']))->update('user', array('user_pwd' => md5($loginpwd), 'user_lock' => md5($loginpwd), 'user_session' => md5(Api::request()->cookies[Api::coms()->getSessionName()]), 'user_del' => 0, 'user_ip' => trim(Api::coms()->getSrt('ip', Api::request()->ip)), 'user_logintime' => time()));

                        Api::coms()->getSMTP($inEmail, trim($dbData[0]['user_name']), '[' . Api::coms()->getTitle() . '] 密码重置成功说明', Api::coms()->getResetMB(trim($dbData[0]['user_name']), $inEmail));

                        Api::redirect('/login', 302);
                    } else {
                        Api::redirect('/forgot-password', 302);
                    }
                }

                // 用户找回密码
                $inEmail = trim(Api::coms()->getRSA('rd', Api::request()->data['loginmail']));
                if (md5(substr($inEmail, -32)) != md5($toke['token'])) {
                    Api::redirect('/forgot-password', 302);
                }

                $inEmail = Api::coms()->getSrt('email', trim(substr($inEmail, 0, -32)));
                if (empty($inEmail)) {
                    Api::redirect('/forgot-password', 302);
                }

                $dbData = Api::coms()->getDB()->field('user_id,user_name,user_del')->where(array('user_email' => $inEmail))->limit(1)->select('user');
                if (!empty($dbData[0]) && ((trim($dbData[0]['user_del']) === '0') || (trim($dbData[0]['user_del']) === '2'))) {
                    $outToken = md5(uniqid() . Api::request()->cookies[Api::coms()->getSessionName()]);

                    Api::coms()->getDB()->where(array('user_id' => trim($dbData[0]['user_id'])))->update('user', array('user_session' => md5($outToken), 'user_del' => 2, 'user_ip' => trim(Api::coms()->getSrt('ip', Api::request()->ip)), 'user_logintime' => time()));

                    Api::coms()->getSMTP($inEmail, trim($dbData[0]['user_name']), '[' . Api::coms()->getTitle() . '] 重置密码说明', Api::coms()->getForgotMB(trim($dbData[0]['user_name']), $inEmail, md5($outToken)));

                    Api::redirect('/login', 302);
                } else {
                    Api::redirect('/forgot-password', 302);
                }
            } else {
                Api::redirect('/forgot-password', 302);
            }
        }
        Api::render('user/forgot-password', array('pubKey' => base64_encode(Api::coms()->getKey('public')), 'token' => $token, 'site_url' => Api::coms()->getSiteURL(), 'title' => '用户找回密码-' . Api::coms()->getTitle()));
    }

    // 帐号解锁
    public static function lock()
    {
        parent::__checkManagePrivate();

        if (Api::request()->method === 'GET') {
            $token = Api::coms()->getToken(1);
        }

        if (Api::request()->method === 'POST') {
            $toke = unserialize(Api::session()->getSession('token'));

            if (Api::coms()->getMsectime() > $toke['time']) {
                Api::redirect('/user-lock', 302);
            }

            if (isset(Api::request()->data['__hash__']) && (md5($toke['token']) === md5(Api::request()->data['__hash__'])) && ($toke['get'] === Api::coms()->getTokenID('GET')) && ($toke['post'] === Api::coms()->getTokenID('POST'))) {
                Api::session()->delSession('token');

                $proxy_ip = Api::coms()->getSrt('ip', Api::request()->proxy_ip);
                if (!empty($proxy_ip)) {
                    Api::render('error');
                }

                $loginpwd = trim(Api::coms()->getRSA('rd', Api::request()->data['nloginpwd']));
                if (md5(trim(substr($loginpwd, -32))) != md5($toke['token'])) {
                    Api::redirect('/user-lock', 302);
                }

                $loginpwd = Api::coms()->getSrt('passwd', trim(substr($loginpwd, 0, -32)));
                if (empty($loginpwd)) {
                    Api::redirect('/user-lock', 302);
                }

                if (unserialize(Api::session()->getSession('user'))['lock'] === md5($loginpwd)) {
                    Api::cookies()->setCookie('lock', array('time' => Api::coms()->getMsectime()));
                    Api::redirect('/user-index', 302);
                } else {
                    header("Cache-control:no-cache,no-store,must-revalidate");
                    header("Pragma:no-cache");
                    header("Expires:0");
                    Api::session()->delSession('user');
                    Api::session()->destroy();
                    Api::redirect('/login', 302);
                }
            } else {
                Api::redirect('/user-lock', 302);
            }
        }
        Api::render('user/lock', array('uname' => trim(unserialize(Api::session()->getSession('user'))['user']), 'pubKey' => base64_encode(Api::coms()->getKey('public')), 'token' => $token, 'site_url' => Api::coms()->getSiteURL(), 'title' => '帐号解锁-' . Api::coms()->getTitle()));
    }

    public static function error()
    {
        Api::render('error');
    }
}
