        <?php
@session_start();
include 'vendor\autoload.php';

use App\Controller\User;
use App\Helpers\Auth;
use Plasticbrain\FlashMessages\FlashMessages;


checkLogin();

$user=new User();
if($_SERVER['REQUEST_METHOD']=='POST'){
    $user->login($_POST);

}

$msg=new FlashMessages();
?>

<?php require_once('view/header.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ورود به سایت</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="#">

                        <div class="form-group">
                            <label class="col-md-4 control-label">آدرس ایمیل</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" >


                                    <span class="help-block">
                                        <strong>لطفا ایمیل را وارد کنید</strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group has-error">
                            <label class="col-md-4 control-label">پسورد</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">


                                    <span class="help-block">
                                        <strong>لطفا پسورد را وارد کنید</strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> من را به یاد داشته باش
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>ورود
                                </button>
                            </div>
                        </div>
                    </form>
                 </div>
               </div>
             <div class="col-lg-12">
                 <?php
                 if($msg->hasMessages()){
                     $msg->display();
                 }
                 ?>

             </div>
        </div>
    </div>
</div>

<?php require_once ('view/footer.php'); ?>
