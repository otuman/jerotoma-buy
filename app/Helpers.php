<?php

 function set_active($path, $active='active'){
    return Request::is($path) || Request::is($path . '/*') ? $active: '';
 }

 function toObject(array $array){
    return (object)$array;
 }
