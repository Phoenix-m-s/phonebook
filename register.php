<?php
@session_start();
include 'vendor\autoload.php';
use App\Controller\User;
use Plasticbrain\FlashMessages\FlashMessages;
$user=new User();
if($_SERVER['REQUEST_METHOD']=='POST') {
    $user->register($_POST);
}
    $msg=new FlashMessages() ;
    ?>
<?php require_once ('view/header.php');?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">عضویت</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="register.php">


                        <div class="form-group">
                            <label class="col-md-4 control-label">نام</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">آدرس ایمیل</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">پسورد</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">تایید پسورد</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>عضویت
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

<?php require_once ('view/footer.php')?>