<?php

use Illuminate\Support\Str;

if(!function_exists("excerpt")){
    function excerpt($text, $limit = 20, $end = '...'){
        return Str::words($text, $limit, $end);
    }
}