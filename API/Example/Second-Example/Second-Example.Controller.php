<?php

/**
 * The Base Controller
 * Structural Example
 * 
 * @package     Second Example Controller
 * @version     1.0
 * @author      Ucha Bokeria <
 * @link        https://github.com/UchaBokeria/
 * 
 */

class SecondExample extends Database
{

    public function Read()
    {

        Get(':id');
        return parent::GET("SELECT * FROM users WHERE id = :id", ["id" => $_GET["id"]]);

    }

    public function Create()
    {

        SecondExampleScheme::Create($this);
        return  parent::SET("INSERT INTO users SET firstname = :NAME, 
                                                   email = :EMAIL, 
                                                   password = :PASSWORD, 
                                                   last_login_datetime = NOW() ",

                            [   "NAME" => $_POST["name"],
                                "EMAIL" => $_POST["email"],
                                "PASSWORD" => $_POST["password"] ]);

    }

    public function Update()
    {

        return parent::SET("    UPDATE users SET firstname = :NAME, 
                                                 email = :EMAIL, 
                                                 password = :PASSWORD, 
                                                 last_login_datetime = NOW() 
                                                 
                                WHERE id = :ID ",

                            [   "NAME" => $_POST["name"],
                                "EMAIL" => $_POST["email"],
                                "PASSWORD" => $_POST["password"],
                                "ID" => $_POST["id"] ]);

    }

    public function Delete()
    {

        SecondExampleScheme::Delete();
        return parent::SET("DELETE FROM users WHERE id = :ID ", [ "ID" => $_POST["id"] ] );

    }

}