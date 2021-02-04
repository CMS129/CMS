<?php

namespace app\libs\frontend;

use Api;

class IndexController extends BaseController{

    /**
     * 首页
     * @param  [type] $cid  [description]
     * @param  [type] $page [description]
     * @return [type]       [description]
     */
    public static function index() {
        //parent::__checkManagePrivate();

        // if(!Api::cookies()->getDoCookie('o2State')) {
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

        Api::render('index', array('title' => Api::coms()->getTitle(), 'site_url' => Api::coms()->getSiteURL()));
    }

    /**
     * 服务条例
     */
    public static function terms() {
        Api::render('terms', array('title' => Api::coms()->getTitle(), 'seo_title' => '服务条例', 'site_url' => Api::coms()->getSiteURL(), 'email' => Api::coms()->getEmail()));
    }

    /**
     * 隐私声明
     */
    public static function privacy() {
        Api::render('privacy', array('title' => Api::coms()->getTitle(), 'seo_title' => '隐私声明', 'site_url' => Api::coms()->getSiteURL(), 'email' => Api::coms()->getEmail()));
    }

    /**
     * 错误页面
     */
    public static function error() {
        Api::render('error');
    }

}
