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
        //parent::__checkManagePrivate();

        // if (!Api::cookies()->getDoCookie('o2State')) {
        //     Api::cookies()->setCookie('bm', '1');
        //     Api::cookies()->setDoCookie('o2State', '1');
        // } else {
        //     Api::cookies()->setCookie('bm', Api::cookies()->getDoCookie('o2State'));
        // }

        // echo Api::coms()->getMsectime();

        // $data['name'] = '昵称';
        // $data['age'] = '26';
        // $data['title'] = '地球村';
        // $data['english'] = 'baidu.com';

        // $srt = Api::coms()->getRSA('re',$data);
        // echo $srt.PHP_EOL;
        // $srt = Api::coms()->getRSA('ud',$srt);
        // echo $srt.PHP_EOL;
        // $srt = Api::coms()->getRSA('ue',$data);
        // echo $srt.PHP_EOL;
        // $srt = Api::coms()->getRSA('rd',$srt);
        // echo $srt.PHP_EOL;
        // $srt1 = Api::coms()->getRSA('rs',$data);
        // echo $srt1.PHP_EOL;
        // $srt = Api::coms()->getRSA('uv',$data,$srt1);
        // echo $srt.PHP_EOL;
        // $srt = Api::coms()->getRSA('tv',$data,$srt1,'alipay'); // 留空为公共密钥，alipay为第三次密钥
        // echo $srt.PHP_EOL;

        // print_r(Api::coms()->getDB()->field('*')->where(array('user_md5'=>'21232f297a57a5a743894a0e4a801fc3'))->limit(1)->select('user'));

        Api::render('index', array('title' => Api::coms()->getTitle(), 'site_url' => Api::coms()->getSiteURL(), 'email' => Api::coms()->getSupport()));
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
     * 联系定制
     */
    public static function contact()
    {
        $inEmail = Api::coms()->getSrt('email', trim(Api::request()->data['email']));

        if(md5($inEmail) === md5(Api::request()->data['email'])) {
            if(Api::coms()->getSMTP($inEmail, trim($inEmail), '[' . Api::coms()->getTitle() . '] 定制设计说明', Api::coms()->getContactMB($inEmail))) {
                Api::json(array('type' => 'success', 'message' => '您的留言已收到，请前往电子邮箱回复《项目需求方案说明书》!!'));
            } else {
                Api::json(array('type' => 'warning', 'message' => '此电子邮件地址无效,我们无法联系到您!!'));
            }
        } else {
            Api::json(array('type' => 'danger', 'message' => '恶意提交，您的ip已永久记录在数据库中!!'));
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
