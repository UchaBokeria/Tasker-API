<?php

class Logger
{
    
    public function __construct() 
    {
        
    }

    public function Log($type, $message)
    {

        $dir = "./Assets/Log/";
        $file = "log.txt";

        chmod($dir, 0777);
        $res = file_put_contents($file, $message, FILE_APPEND);
        
    }


}