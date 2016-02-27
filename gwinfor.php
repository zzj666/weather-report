<?php
    $ch = curl_init();
    $citySet = 'hefei'; //预设天气预报地点，在这里.
    $urlSet = 'http://apis.baidu.com/heweather/weather/free?city='; // + $wcity;
    $url = $urlSet.$citySet ;
    
    //print( $url ); 调试网址
    
    $header = array(
        'apikey: a51c911b1e90125da234ef805dead41e',
    );
    // 添加apikey到header
    curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // 执行HTTP请求
    curl_setopt($ch , CURLOPT_URL , $url);
    //curl_setopt($ch , CURLOPT_SSL_VERIFYPEER , false);
    $res = curl_exec($ch);
    //print $res;
        
    $wobj = json_decode($res);
    
    //var_dump(json_decode($res,true));
    //打印json的变量信息
    
    $wcity = $wobj->{'HeWeather data service 3.0'}[0]->{'basic'}->{'city'} ;
    $updatetime = $wobj->{'HeWeather data service 3.0'}[0]->{'basic'}->{'update'}->{'loc'} ;
    
    // Weather Informations of Today
    $qltyToday =  $wobj->{'HeWeather data service 3.0'}[0]->{'aqi'}->{'city'}->{'qlty'};
    $dateToday =  $wobj->{'HeWeather data service 3.0'}[0]->{'daily_forecast'}[0]->{'date'} ;
    $dayWeatherToday = $wobj->{'HeWeather data service 3.0'}[0]->{'daily_forecast'}[0]->{'cond'}->{'txt_d'} ;
    $nightWeatherToday = $wobj->{'HeWeather data service 3.0'}[0]->{'daily_forecast'}[0]->{'cond'}->{'txt_n'} ;
    $maxTempToday = $wobj->{'HeWeather data service 3.0'}[0]->{'daily_forecast'}[0]->{'tmp'}->{'max'} ;
    $minTempToday = $wobj->{'HeWeather data service 3.0'}[0]->{'daily_forecast'}[0]->{'tmp'}->{'min'} ;
    
    // Weather Information of Tomorrow
    $dateTomorrow =  $wobj->{'HeWeather data service 3.0'}[0]->{'daily_forecast'}[1]->{'date'} ;
    $dayWeatherTomorrow = $wobj->{'HeWeather data service 3.0'}[0]->{'daily_forecast'}[1]->{'cond'}->{'txt_d'} ;
    $nightWeatherTomorrow = $wobj->{'HeWeather data service 3.0'}[0]->{'daily_forecast'}[1]->{'cond'}->{'txt_n'} ;
    $maxTempTomorrow = $wobj->{'HeWeather data service 3.0'}[0]->{'daily_forecast'}[1]->{'tmp'}->{'max'} ;
    $minTempTomorrow = $wobj->{'HeWeather data service 3.0'}[0]->{'daily_forecast'}[1]->{'tmp'}->{'min'} ;
    
    // Weather Information of The Day After Tomorrow
    $dateAfTomorrow =  $wobj->{'HeWeather data service 3.0'}[0]->{'daily_forecast'}[2]->{'date'} ;
    $dayWeatherAfTomorrow = $wobj->{'HeWeather data service 3.0'}[0]->{'daily_forecast'}[2]->{'cond'}->{'txt_d'} ;
    $nightWeatherAfTomorrow = $wobj->{'HeWeather data service 3.0'}[0]->{'daily_forecast'}[2]->{'cond'}->{'txt_n'} ;
    $maxTempAfTomorrow = $wobj->{'HeWeather data service 3.0'}[0]->{'daily_forecast'}[2]->{'tmp'}->{'max'} ;
    $minTempAfTomorrow = $wobj->{'HeWeather data service 3.0'}[0]->{'daily_forecast'}[2]->{'tmp'}->{'min'} ;
    
    // Now Let's Weather Report Now ! :)
    $weatherToday = $wcity.'今天('.$dateToday.')'.$dayWeatherToday.'到'.$nightWeatherToday.','.$maxTempToday.'-'.$minTempToday.'°C,'.$qltyToday;  //
    $weatherTomorrow = '明天('.$dateAfTomorrow.')'.$dayWeatherTomorrow.'到'.$nightWeatherTomorrow.','.$maxTempTomorrow.'-'.$minTempTomorrow.'°C,';
    $weatherAfTomorrow = '后天('.$dateAfTomorrow.')'.$dayWeatherAfTomorrow.'到'.$nightWeatherAfTomorrow.','.$maxTempTomorrow.'-'.$minTempAfTomorrow.'°C';
    
    echo $updatetime.'更新:'.$weatherToday.$weatherTomorrow.$weatherAfTomorrow.'<br />' ;




?>
