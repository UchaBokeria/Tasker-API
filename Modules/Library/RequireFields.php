<?php

function RequireFields($fields)
{

    $diff = array_diff($fields, array_keys(
        $_SERVER["REQUEST_METHOD"] == "GET" ? $_GET : $_POST));
    $count = COUNT($diff);
    
    return [
        'missing' => ($count > 0) ? false : true,
        'msg' => implode(", ", $diff) . " Must Be Provided"
    ];

}