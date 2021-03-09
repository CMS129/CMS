<?php

namespace app\libs\frontend;

use Api;

class IndexController extends BaseController
{

    /**
     * 首页
     * @param  [type] $cid  [description]
     * @param  [type] $page [description]
     * @return [type]       [description]
     */
    public static function index()
    {
        // parent::__checkManagePrivate();

        Api::render('index', array('title' => Api::coms()->getTitle(), 'seo_title' => 'CMS内容管理系统', 'site_url' => Api::coms()->getSiteURL(), 'email' => Api::coms()->getSupport()));
    }

    /**
     * 服务条例
     */
    public static function terms()
    {
        Api::render('terms', array('title' => Api::coms()->getTitle(), 'seo_title' => '服务条例', 'site_url' => Api::coms()->getSiteURL(), 'email' => Api::coms()->getSupport()));
    }

    /**
     * 隐私声明
     */
    public static function privacy()
    {
        Api::render('privacy', array('title' => Api::coms()->getTitle(), 'seo_title' => '隐私声明', 'site_url' => Api::coms()->getSiteURL(), 'email' => Api::coms()->getSupport()));
    }


    /**
     * 伪原创
     */
    public static function word()
    {
        Api::render('word', array('title' => Api::coms()->getTitle(), 'seo_title' => 'AI伪原创', 'site_url' => Api::coms()->getSiteURL(), 'email' => Api::coms()->getSupport()));
    }

    /**
     * POST数据处理  联系定制 发送邮件
     */
    public static function contact()
    {
        $inEmail = Api::coms()->getSrt('email', trim(Api::request()->data['email']));

        if (md5(trim($inEmail)) === md5(trim(Api::request()->data['email']))) {
            if (Api::coms()->getSMTP($inEmail, trim($inEmail), '[' . Api::coms()->getTitle() . '] 定制设计说明', Api::coms()->getContactMB($inEmail))) {
                Api::json(array('type' => 'success', 'message' => '您的留言已收到，请前往电子邮箱回复《项目需求方案说明书》!!'));
            } else {
                Api::json(array('type' => 'warning', 'message' => '此电子邮件地址无效,我们无法联系到您!!'));
            }
        } else {
            Api::json(array('type' => 'danger', 'message' => '恶意提交，您的ip已永久记录在数据库中!!'));
        }
    }

    /**
     * POST数据处理 伪原创
     */
    public static function wyc()
    {
        $inWord = Api::coms()->getSrt('content', trim(Api::request()->data['word']));

        if (md5(trim($inWord)) === md5(trim(Api::request()->data['word']))) {
            $newWord = Api::coms()->getReplace($inWord);
            Api::json(array('type' => 'success', 'data' => $newWord[0], 'message' => '总切词 '.mb_strlen($newWord[0],'UTF8').' 个，免费用户随机替换 '.count($newWord[1]).' 个【升级VIP后可替换到 '.count($newWord[1]).' 个】，伪原创模式 轻微伪原创 '.ceil(ceil(mb_strlen(implode("", $newWord[1]),'UTF8'))/ceil(mb_strlen($newWord[0],'UTF8'))*100).'%'));
        } else {
            Api::json(array('type' => 'danger', 'message' => '恶意提交，内容中有非法字符串!!'));
        }
    }

    /**
     * 错误页面
     */
    public static function error()
    {
        Api::render('error');
    }
}
