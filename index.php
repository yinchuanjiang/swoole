<?php

$http = new swoole_http_server('0.0.0.0',8011);
$http->set([
    'enable_static_handler' => true,
    'document_root' => '/www/wwwroot/swoole-time/',
    'worker_num' => 8,    //开启的进程数  cup的核数 1-4倍
    'max_request' => 10000,
]);
$http->on('request',function ($request,$response){
    $timer_id = swoole_timer_tick( 1000 , function($timer_id , $params) use ($response) {
       echo $response->end(date('Y-m-d H:i:s'));
    });
});
$http->start();