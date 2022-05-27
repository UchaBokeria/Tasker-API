<?php

/**
 * The Base Controller
 * Structural Example
 * 
 * @package     First Example Controller
 * @version     1.0
 * @author      Ucha Bokeria <
 * @link        https://github.com/UchaBokeria/
 * 
 */

class Tasks extends Database
{

    public function __construct() 
    {

        /* RECALL DATABASE */
        parent::__construct();

    }

    public function Read()
    {
        
        Get();
        die("    SELECT    tasks.id, 
                                          tasks.title, 
                                          tasks.description, 
                                          tasks.todo_datetime,
                                          status.name AS status, 
                                          projects.name AS project,
                                          priority.name AS priority
                                FROM      tasks
                                LEFT JOIN projects ON tasks.project_id = projects.id
                                LEFT JOIN priority ON tasks.priority_id = priority.id
                                LEFT JOIN status ON tasks.status_id = status.id
                                WHERE     user_id = '$_GET[user_id]'"
                            );

    }

    public function Create()
    {

        Post();
        FirstExampleScheme::Create();

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

        put();
        Guardian();

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

        Delete();
        Guardian();

        FirstExampleScheme::Delete();
        return parent::SET(" DELETE FROM users WHERE id = :ID ", [ "ID" => $_POST["id"] ] );

    }

}