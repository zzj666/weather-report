<?php

    $ch = curl_init();
    $url = 'http://apis.baidu.com/apistore/weatherservice/recentweathers?cityname=合肥&cityid=101220101';
    $header = array(
        'apikey: a51c911b1e90125da234ef805dead41e',
    );
    // 添加apikey到header
    curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // 执行HTTP请求
    curl_setopt($ch , CURLOPT_URL , $url);
    $res = curl_exec($ch);

    var_dump(json_decode($res));
        
    ?>