<?php

namespace App\Helpers;
use App\User;

class Auth
{
    public function  login($user, $remember = false)
    {
        $_SESSION['username'] = $user->email;
        if ($remember == true) {
            setcookie('email', $user->email, strtotime('+30 day'));
            setcookie('password', $user->password, strtotime('+30 day'));
        }
        return true;
    }
    public function check(){
        if(isset($_SESSION)&&isset($_SESSION['username'])){
            return true;
        }
        elseif(isset($_COOKIE['email']) && isset($_COOKIE['password'])){
            $email=$_COOKIE['email'];
            $password=$_COOKIE['password'];
            if(self::checkCookie($email,$password)===false){
                return false;
            }

             $user=new\stdClass();
            $user->email=$email;
            $user->password=$password;
            self::login($user);
            return true;
        }
        return false;
    }

    public function logout(){
        if(isset($_COOKIE['email'])&&isset($_COOKIE['password'])){
            setcookie('email','',strtotime('-5 day'),'/');
            setcookie('password','',strtotime('-5 day'),'/');
        }
        session_destroy();
        redirect();
    }


    public function checkCookie($email,$password){
        $DB=new User();
        return $DB->dataUser($email,$password);
    }

    public function user(){
        if(self::check()===false)
            return NULL;
        $email=$_SESSION['username'];
        $DB=new User();
        return $DB->find('email',$email);
    }


}


