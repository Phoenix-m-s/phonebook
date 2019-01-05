<?php
@session_start();
include 'vendor/autoload.php';
use App\Helpers\Auth;
Auth::logout();
?>