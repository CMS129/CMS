<?php 

// 路由映射表
return array(
    'auth'=>'index,admin,list,user,data,error', // 默认需要认证模型
    'index' => array(
        array('GET|POST /((@cid:[0-9]+/)@page:[0-9]+)', 'frontend\Index:index'),
        array('GET /terms', 'frontend\Index:terms'),
        array('GET /search', 'frontend\Index:search'),
        array('GET /privacy', 'frontend\Index:privacy'),
    ),
    'admin' => array(
        array('GET|POST /login', 'backend\User:login'),
        array('GET|POST /active', 'backend\User:active'),
        array('GET|POST /logout', 'backend\User:logout'),
        array('GET|POST /register', 'backend\User:register'),
        array('GET|POST /admin-lock', 'backend\User:lock'),
        array('GET|POST /admin-index', 'backend\Index:index'),
        array('GET|POST /forgot-password', 'backend\User:forgot_password'),
    ),
    'list' => array(
        array('GET|POST /list', 'frontend\Index:list'),
    ),
    'user' => array(
        array('GET|POST /user', 'frontend\Index:user'),
    ),
    'data' => array(
        array('GET|POST /data', 'frontend\Index:data'),
    ),
    'error' => array(
        array('GET /error.html', 'frontend\Index:error'),
    ),
);
