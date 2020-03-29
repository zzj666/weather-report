<?php
    
function show_weather(){

    function weatherTxt($weatherType,$key,$location){
        $weatherUrl='https://free-api.heweather.net/s6/weather/'.$weatherType.'?location='.$location.'&key='.$key;
        $weatherContent = file_get_contents($weatherUrl);
        return $weatherContent;
    }

    $key ="322389fe745246a88c9371a867475438";
    $location = "合肥";
    
    // 分别获取 当前的天气、预报天气、当前空气质量信息
    $nowWeather=weatherTxt('now',$key,$location);
    $daysWeather=weatherTxt('forecast',$key,$location);
    $lifeInfor=weatherTxt('lifestyle',$key,$location);
    
    // 调试信息显示
    //echo $nowWeather;
    //echo $daysWeather;
    //echo $lifeInfor;
    
    // 解析Json数据
    $nowObj  = json_decode($nowWeather);
    $daysObj = json_decode($daysWeather);
    $lifeObj = json_decode($lifeInfor);
    
    // 解析当前天气的 地点、更新时间
    $weatherLoc = $nowObj->{'HeWeather6'}[0]->{'basic'}->{'location'};
    $updateTime = $nowObj->{'HeWeather6'}[0]->{'update'}->{'loc'};
    
    // 解析当前 天气信息、温度、风向、风级
    $now_cond_txt = $nowObj->{'HeWeather6'}[0]->{'now'}->{'cond_txt'};
    $now_tmp      = $nowObj->{'HeWeather6'}[0]->{'now'}->{'tmp'};
    $now_wind_dir = $nowObj->{'HeWeather6'}[0]->{'now'}->{'wind_dir'};
    $now_wind_sc  = $nowObj->{'HeWeather6'}[0]->{'now'}->{'wind_sc'};
    
    // 解析当前空气质量
    $now_qlty = $lifeObj->{'HeWeather6'}[0]->{'lifestyle'}[7]->{'brf'};

    // 解析三天 天气信息、温度、风向、风级
    $day0_date       = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[0]->{'date'};
    $day0_cond_txt_d = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[0]->{'cond_txt_d'};
    $day0_cond_txt_n = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[0]->{'cond_txt_n'};
    $day0_wind_dir   = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[0]->{'wind_dir'};
    $day0_wind_sc    = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[0]->{'wind_sc'};
    $day0_tmp_min    = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[0]->{'tmp_min'};
    $day0_tmp_max    = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[0]->{'tmp_max'};
    
    $day1_date       = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[1]->{'date'};
    $day1_cond_txt_d = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[1]->{'cond_txt_d'};
    $day1_cond_txt_n = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[1]->{'cond_txt_n'};
    $day1_wind_dir   = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[1]->{'wind_dir'};
    $day1_wind_sc    = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[1]->{'wind_sc'};
    $day1_tmp_min    = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[1]->{'tmp_min'};
    $day1_tmp_max    = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[1]->{'tmp_max'};
    
    $day2_date       = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[2]->{'date'};
    $day2_cond_txt_d = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[2]->{'cond_txt_d'};
    $day2_cond_txt_n = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[2]->{'cond_txt_n'};
    $day2_wind_dir   = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[2]->{'wind_dir'};
    $day2_wind_sc    = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[2]->{'wind_sc'};
    $day2_tmp_min    = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[2]->{'tmp_min'};
    $day2_tmp_max    = $daysObj->{'HeWeather6'}[0]->{'daily_forecast'}[2]->{'tmp_max'};
    
    // 拼接天气信息
    $greetMsg  = $weatherLoc.'天气预报';
    $updateMsg = '更新时间：'.$updateTime;
    $nowMsg    = $weatherLoc.'当前：'.$now_cond_txt.'，'.$now_tmp.'℃，'.$now_wind_dir.$now_wind_sc.'级';
    $qltyMsg   = '空气质量：'.$now_qlty; 
    
    $day0_txt  = '今天（'.$day0_date.'），'.$day0_cond_txt_d.'-'.$day0_cond_txt_n.'，'.$day0_wind_dir.$day0_wind_sc.'级，'.$day0_tmp_min.'-'.$day0_tmp_max.'℃。';
    $day1_txt  = '明天（'.$day1_date.'），'.$day1_cond_txt_d.'-'.$day1_cond_txt_n.'，'.$day1_wind_dir.$day1_wind_sc.'级，'.$day1_tmp_min.'-'.$day1_tmp_max.'℃。';
    $day2_txt  = '后天（'.$day2_date.'），'.$day2_cond_txt_d.'-'.$day2_cond_txt_n.'，'.$day2_wind_dir.$day2_wind_sc.'级，'.$day2_tmp_min.'-'.$day2_tmp_max.'℃。';
    
    // 画横线
    function drawTxtLn($arg1, $arg2, $arg3){
        $l1 = strlen($arg1);
        $l2 = strlen($arg2);
        $l3 = strlen($arg3);
        $a  = array($l1, $l2, $l3);
        $max= max($a);
        for ($x=0; $x<$max; $x++){
            echo '-';
        }
        
    }

    drawTxtLn($updateMsg, $nowMsg, $qltyMsg);echo '<br />';    
    echo $greetMsg.'<br />';
    echo $updateMsg.'<br />'.$nowMsg.'<br />'.$qltyMsg.'<br />';
    drawTxtLn($day0_txt, $day1_txt, $day2_txt);echo '<br />';
    echo $day0_txt.'<br />'.$day1_txt.'<br />'.$day2_txt.'<br />';
    drawTxtLn($day0_txt, $day1_txt, $day2_txt);
}
?>
