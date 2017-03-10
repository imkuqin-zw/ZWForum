<?php
    if(!function_exists("date_former")){
        function date_former($time){
            $tmp = time() -  strtotime($time);
            if($tmp && $tmp < 60 ) {
                return ceil($tmp) . '秒前';
            }
            elseif($tmp >= 60 && $tmp < 3600 ) {
                return ceil($tmp / 60) . '分钟前';
            }
            elseif($tmp >= 3600 && $tmp < 86400) {
                return ceil($tmp / 3600) . '小时前';
            }
            elseif($tmp >= 86400 && $tmp < 2592000 ){
                return ceil($tmp / 864000) . '天前';
            }else{
                return date('Y-m-d',strtotime($time));
            }
        }
    }