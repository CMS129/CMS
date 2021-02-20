<?php 

// 路由映射表
return array(
    'auth'=>'index,user,admin,list,data,error', // 默认需要认证模型
    'index' => array(
        array('GET|POST /((@cid:[0-9]+/)@page:[0-9]+)', 'frontend\Index:index'),
        array('GET /terms', 'frontend\Index:terms'),
        array('GET /search', 'frontend\Index:search'),
        array('GET /privacy', 'frontend\Index:privacy'),
        array('POST /contact', 'frontend\Index:contact'),
    ),
    'user' => array(
        array('GET|POST /login', 'backend\User:login'),
        array('GET|POST /active', 'backend\User:active'),
        array('GET|POST /logout', 'backend\User:logout'),
        array('GET|POST /register', 'backend\User:register'),
        array('GET|POST /user-lock', 'backend\User:lock'),
        array('GET|POST /user-index', 'backend\Index:index'),
        array('GET|POST /user-settings', 'backend\User:settings'),
        array('GET|POST /forgot-password', 'backend\User:forgot_password'),
    ),
    'admin' => array(
        array('GET|POST /user', 'frontend\Index:user'),
    ),
    'list' => array(
        array('GET|POST /list', 'frontend\Index:list'),
    ),
    'data' => array(
        array('GET|POST /data', 'frontend\Index:data'),
    ),
    'error' => array(
        array('GET /error.html', 'frontend\Index:error'),
    ),
);
