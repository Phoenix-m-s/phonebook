<?php
@session_start();
include'vendor/autoload.php';
use App\Helpers\Auth;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title>PhoneBook</title>
    <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="/">
                دفترچه تلفن آنلاین
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <?php if(Auth::check()==true):?>
                <li><a href="/dashboard/index.php">داشبورد</a></li>
                <?php endif ?>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-left">
                <!-- Authentication Links -->
                <?php if(Auth::check()!=true):?>
                <li><a href="login.php">ورود</a></li>
                <li><a href="register.php">عضويت</a></li>
               <?php else :?>
 
                <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                       <?=Auth::user()->name?><span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="\logout.php"><i class="fa fa-btn fa-sign-out"></i>خروج</a></li>
                    </ul>
                </li>
                <?php endif ?>

            </ul>
        </div>
    </div>
</nav>