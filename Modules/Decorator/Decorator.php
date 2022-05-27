<?php

/* AUTH DECORATORS */
function Guardian() 
{

    if(!(new Guardian())->checkToken()) 
    {
        
        header("HTTP/1.1 401 Unauthorized");
        Unauthorized();

    }

}

function Unauthorized() 
{

    header("HTTP/1.1 401 Unauthorized");
    die(json_encode(UNAUTHORIZED_STATUS));

}

/* METHOD DECORATORS */
function Get($PARAMETER = null)
{

    $_GET[str_replace(':','',$PARAMETER)] = FINDBYURLPARAMETER;

    // MUST_BE_GET
    if($_SERVER["REQUEST_METHOD"] != "GET") 
    {

        header('http/1.1 405 Method Not Allowed');
        die(json_encode(MUST_BE_GET));

    }
}

function Post()
{

    // MUST_BE_POST
    if($_SERVER["REQUEST_METHOD"] != "POST") 
    {

        header('http/1.1 405 Method Not Allowed');
        die(json_encode(MUST_BE_POST));

    }
}

function Put()
{

    // MUST_BE_PUT
    if($_SERVER["REQUEST_METHOD"] != "PUT") 
    {

        header('http/1.1 405 Method Not Allowed');
        die(json_encode(MUST_BE_PUT));

    }
}

function Delete()
{

    // MUST_BE_DELETE
    if($_SERVER["REQUEST_METHOD"] != "DELETE") 
    {

        header('http/1.1 405 Method Not Allowed');
        die(json_encode(MUST_BE_DELETE));

    }
}

/* BAD REQUEST DECORATORS */
function HttpBadRequest($msg)
{
    
    header("HTTP/1.1 400 Bad Request");
    die(json_encode(
        array_merge(
            ["msg" => $msg], BAD_REQUEST_STATUS)));

}

/* CONFLICT REQUEST DECORATORS */
function HttpConflict()
{
    
    header('http/1.1 409 Conflict'); 
    die(json_encode(CONFLICT));

}