<?php

class Auth extends Database
{

    private $mailer;

    public function __construct() 
    {
        parent::__construct();
        $this->mailer = new SmtpMailer();
    }

    public function Login()
    {

        Post();
        AuthScheme::Login();

        $email = $_POST["email"];
        $Password = $_POST["pass"];

        $User = parent::GET("   SELECT * 
                                FROM users  
                                WHERE email = :email 
                                LIMIT 1; ", 
                                [ 'email' => $email ])[0];
        $id = $User["id"];
        $HashPassword = $User["password"];

        if(!password_verify($Password, $HashPassword)) 
            return [ 'error' => true, 'msg' => 'Provided Password Or email Is Wrong'];
        $NewToken = bin2hex(openssl_random_pseudo_bytes(16) . date('y_m_d.hms') .  $email);
        
        parent::SET("   UPDATE  users SET   logged = 1,
                                            last_ip_address = :ip,
                                            last_login_datetime = NOW(),
                                            token = :token

                        WHERE   id = :id;",
                        [   "token" => $NewToken,
                            "ip" => IP_ADDRESS,
                            "id" => $id ]);

        unset($User['logged']);
        unset($User['password']);
        unset($User['last_ip_address']);
        unset($User['last_login_datetime']);

        return [ 'error' => false, 'token' => $NewToken, 'userData' => $User ];

    }

    public function Logout()
    {

        Guardian();

        parent::SET("   UPDATE users SET logged = 0, 
                                         token = '', 
                                         last_ip_address = :ip,
                                         last_login_datetime = NOW() 

                        WHERE id = :id ;",
                        [
                            'ip' => IP_ADDRESS,
                            'id' => $_SESSION["USER"]["id"]
                        ]);

        session_destroy();
        return ["msg" => "You Has Been Logged Out"];

    }

    public function SignUp()
    {

        Post();
        AuthScheme::SignUp();
        
        parent::GET("   SELECT  id 
                        FROM    users 
                        WHERE   email = :email; ", 
                        [ 'email' => $_POST["email"] ]);
        if(parent::GetNumRows() >= 1) HttpConflict();
        
        parent::SET(" INSERT INTO users SET firstname = :firstname,
                                            lastname = :lastname,
                                            middlename = :middlename,
                                            phone = :phone,
                                            email = :email,
                                            username = :username,
                                            password = :password,
                                            token = :token,
                                            gender = :gender,
                                            salutation = :salutation,
                                            profession = :profession,
                                            addressType = :addressType,
                                            institution = :institution,
                                            department = :department,
                                            country = :country,
                                            city = :city,
                                            last_ip_address = :last_ip_address,
                                            last_login_datetime = NOW(); ",
                                        [
                                            'firstname' => $_POST["firstname"],
                                            'lastname' => $_POST["lastname"],
                                            'middlename' => $_POST["middlename"],
                                            'phone' => $_POST["phone"],
                                            'email' => $_POST["email"],
                                            'username' => $_POST["username"],
                                            'password' => password_hash( $_POST["password"], PASSWORD_BCRYPT ),
                                            'token' => bin2hex(openssl_random_pseudo_bytes(16) . date('y_m_d.hms') . $_POST["email"]),
                                            'gender' => $_POST["gender"],
                                            'salutation' => $_POST["salutation"],
                                            'profession' => $_POST["profession"],
                                            'addressType' => $_POST["addressType"],
                                            'institution' => $_POST["institution"],
                                            'department' => $_POST["department"],
                                            'country' => $_POST["country"],
                                            'city' => $_POST["city"],
                                            'last_ip_address' => IP_ADDRESS
                                        ]
                                    );

        $SignUpMail = $this->mailer->Send([
            'subject' => "Subject",
            'address' => $_POST["email"],
            'body' => $this->mailer->TemplateBuild($_POST, "./Sources/Doc/SignUp.Template.html")
        ]);

        return [ 'error' => $SignUpMail["error"] , 'msg' => $SignUpMail["msg"] ];

    }

    public function ResetLink()
    {

        $info = parent::GET("   SELECT  id, 
                                        CONCAT(firstname,' ',lastname) AS fullname, 
                                        salutation 

                                FROM    users 
                                WHERE   email = :email", 
                                [ 'email' => $_POST["email"] ])[0];

        if(!parent::Exists()) 
            return [ "error" => true, "msg" => "Provided Email Does Not Exist"];

        $key =  bin2hex(openssl_random_pseudo_bytes(16) . date('y_m_d.hms') . 
                openssl_random_pseudo_bytes(16) .  $_POST["email"] . "c9x2d");
        
        $ResetMail = $this->mailer->Send([
            'subject' => "Subject",
            'address' => $_POST["email"],
            'body' => $this->mailer->TemplateBuild($_POST, "./Assets/Templates/Reset.Template.html")
        ]);
        
        parent::SET("   UPDATE users SET    reset_key = :key,
                                            last_ip_address = :ip,
                                            last_login_datetime = NOW(),
                                            reset_pendding = 1
                        WHERE id = :id ; ", 
                        [   'key' => $key,
                            'ip' => IP_ADDRESS,
                            'id' => $info["id"] ]);
        
        return [ "error" => $ResetMail["error"], "msg" => $ResetMail["msg"] ];

    }

    public function ResetPassword()
    {
        
        $info = parent::GET("   SELECT  id 
                                FROM    users 
                                WHERE   reset_key = :key", 
                                [ 'key' => $_POST["key"] ])[0];
                                
        if(!parent::Exists()) 
            return [ "error" => true, "msg" => "Provided Reset Token Is Wrong "];

        parent::SET("   UPDATE users SET    password = :password,
                                            token = :token,
                                            last_ip_address = :ip,
                                            last_login_datetime = NOW(),
                                            reset_pendding = 0,
                                            logged = 0,
                                            reset_key = ''
                        WHERE id = :id ; ", 
                        [ 'token' => bin2hex(openssl_random_pseudo_bytes(16) . date('y_m_d.hms') . "sad4312sa%$13"),
                          'password' => password_hash($_POST["password"], PASSWORD_BCRYPT ),
                          'id' => $info["id"],
                          'ip' => IP_ADDRESS ]);

        return [ "error" => false, "msg" => 'Password Has Been Reseted' ];
                                        
    }

}