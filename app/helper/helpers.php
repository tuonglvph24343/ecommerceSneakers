<?php

use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Session;

/** Set Sidebar item active */

function setActive(array $route){
    if(is_array($route)){
        foreach($route as $r){
            if(request()->routeIs($r)){
                return 'active';
            }
        }
    }
}
