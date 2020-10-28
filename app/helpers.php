<?php

use App\Models\Settings;
use Illuminate\Support\Facades\Cache;

if (!function_exists('get_settings')){
    function get_settings($key){

        // $all_settings = Cache::rememberForever('all_settings', function (){
        //     return Settings::all();
        // });

        $expire_minute = 60;

        $all_settings = Cache::remember('all_settings', $expire_minute, function (){
            return Settings::all();
        });

        return $all_settings->where('key', $key)->first()->value;
    }
}
