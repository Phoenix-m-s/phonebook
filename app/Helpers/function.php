<?php
use App\Helpers\Auth;
function redirect($param=NULL){
    if(is_null($param))
        $param=site_adress();
    header('location:'.$param);
    exit();
}
function site_adress(){
    return 'http://localhost:8888';
}
function checkLogin(){
    if(Auth::Check() ==true){
        redirect();
    }
}
function checkUser(){
    if(Auth::Check() !==true){
        redirect();
    }
}