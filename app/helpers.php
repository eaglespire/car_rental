<?php

if (!function_exists('set_active_url')){
    function set_active_url(String $routeNameToPass) : String {
         if (route($routeNameToPass) == url()->current()){
             return 'active';
         } else{
             return '';
         }
    }
}

?>
