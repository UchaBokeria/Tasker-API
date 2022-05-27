<?php

trait FirstExampleScheme
{

    public static function Create()
    {
        
        $RequiredFields = RequireFields(["name","email","password"]);

        if(!$RequiredFields["missing"])
            HttpBadRequest($RequiredFields["msg"]);

    }

    public static function Delete()
    {

        if( $_POST["id"] == "" ) 
            HttpBadRequest("id - Must Be Provided");

    }

}