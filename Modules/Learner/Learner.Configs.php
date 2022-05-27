<?php

/* Learn Configs */
Learn('Configs', "json", function($dir,$filename) {
    $parameters = json_decode(file_get_contents("./$dir/$filename"),true);
    foreach ($parameters as $key => $value) define(strtoupper($key), $value);
});