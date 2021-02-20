<?php

namespace app\libs\backend;

use Api;

class BaseController
{
    /**
     * 检测管理员权限
     * @param  boolean $force [description]
     * @return [type]         [description]
     */
    protected static function __checkManagePrivate()
    {
        if (!empty(unserialize(Api::session()->getSession('user'))['sess']) && !empty(Api::cookies()->getCookie('sid')['sess']) && (unserialize(Api::session()->getSession('user'))['sess'] === Api::cookies()->getCookie('sid')['sess']) && (unserialize(Api::session()->getSession('user'))['del'] === '0')) {
            if ((Api::request()->url != '/active') && (Api::cookies()->getCookie('sid')['sess'] != md5(Api::request()->cookies[Api::coms()->getSessionName()]))) {
                Api::redirect('/active', 302);
            }

            if ((Api::request()->url != '/admin-lock') && ((ceil(Api::cookies()->getCookie('lock')['time']) + ceil(Api::coms()->getLookTime())) < Api::coms()->getMsectime())) {
                Api::redirect('/admin-lock', 302);
            }

            if (Api::request()->url != '/admin-lock') {
                Api::cookies()->setCookie('lock', array('time' => Api::coms()->getMsectime()));
            }

            return true;
        } else {
            header("Cache-control:no-cache,no-store,must-revalidate");
            header("Pragma:no-cache");
            header("Expires:0");
            Api::session()->delSession('user');
            Api::session()->destroy();
            Api::redirect('/error.html', 301);
        }
    }

}
