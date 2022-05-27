<?php

trait SecondExampleScheme
{

    public static function Create($controllerObject)
    {
        
        Post();
        Guardian();
        $parent = get_parent_class($controllerObject);

        $Database = new $parent();
        $Database->GET("    SELECT id 
                            FROM users 
                            WHERE email = :EMAIL", 
                            [ "EMAIL" => $_GET["email"] ]
                        );
        
        $Database->Exists() ? HttpConflict() : 

        $RequiredFields = RequireFields(["name","email","password"]);

        if(!$RequiredFields["missing"])
            HttpBadRequest($RequiredFields["msg"]);

    }

    public static function Delete()
    {

        Post();
        Guardian();

        if( $_POST["id"] == "" ) 
            HttpBadRequest("id - Must Be Provided");

    }

}