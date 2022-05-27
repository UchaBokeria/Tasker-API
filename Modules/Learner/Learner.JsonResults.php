<?php

$URI = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$CALL = explode("/", $URI);
$EUPES = array_count_values($CALL)[""];
for ($i=0; $i < $EUPES; $i++)  unset($CALL[array_search("",$CALL)]);

$callName = str_replace('-','',$CALL[COUNT($CALL)-1]);
$Request = str_replace('-','',$CALL[COUNT($CALL)]);

if (!class_exists($callName)) 
{

    if(!$_SERVER["REQUEST_METHOD"] == "GET") 
    {
        
        header('http/1.1 404 Not Found');
        die(json_encode(NOT_FOUND));
        
    } 
   
    $callName = str_replace('-','',$CALL[COUNT($CALL)-2]);
    $Request = str_replace('-','',$CALL[COUNT($CALL)-1]);

    define('FINDBYURLPARAMETER' ,$CALL[COUNT($CALL)]);

}

$Router = new $callName();
if(!method_exists($Router, $Request)) 
{

    header('http/1.1 404 Not Found');
    die(json_encode(NOT_FOUND));

}

define( 'API_RESULT_JSON' , 
    array_merge(
        [ "result" => $Router->$Request() ], SUCCESS_STATUS) );