<?php

trait AuthScheme
{

    public static function Login()
    {

        $RequiredFields = RequireFields(["email","pass"]);
        if(!$RequiredFields["missing"]) HttpBadRequest($RequiredFields["msg"]);

    }
    
    public static function SignUp()
    {

        $RequiredFields = RequireFields([
            "firstname", "lastname",  "middlename",
            "phone", "email", "username", "password",
            "gender", "salutation", "profession", "addressType",
            "institution", "department", "country", "city"
        ]);


        if(!$RequiredFields["missing"]) HttpBadRequest($RequiredFields["msg"]);

    }

    public static function ResetLink()
    {

        $RequiredFields = RequireFields(["email"]);
        if(!$RequiredFields["missing"]) HttpBadRequest($RequiredFields["msg"]);

    }

    public static function ResetPassword() 
    {

        $RequiredFields = RequireFields(["key", "password"]);
        if(!$RequiredFields["missing"])  HttpBadRequest($RequiredFields["msg"]);

    }

}