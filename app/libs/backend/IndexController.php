<?php

namespace app\libs\backend;

use Api;

class IndexController extends BaseController
{

    /**
     * 登陆后首页
     */
    public static function index()
    {
        parent::__checkManagePrivate();

        $CMSCO = ['user' => unserialize(Api::session()->getSession('user'))['user'], 'title' => '管理后台-' . Api::coms()->getTitle(), 'site_url' => Api::coms()->getSiteURL()];
        Api::render('admin/index', $CMSCO);
    }

}
