<?php
@session_start();
include '../vendor/autoload.php';
checkUser();
use App\Controller\PhoneBook;
use Plasticbrain\FlashMessages\FlashMessages;

$phonebook=new App\Controller\PhoneBook();
if($_SERVER['REQUEST_METHOD']=='POST'){
    $phonebook->add($_POST);
}
$msg=new FlashMessages();

?>

<?php require_once 'view/header.php'?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 title">
            <h2>ایجاد شماره جدید</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <form action="/dashboard/phonebook.php" method="POST">
                <div class="form-group">
                    <label>نام</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label>شماره تلفن</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                <div class="form-group">
                    <label>آدرس</label>
                    <textarea name="adress" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger">ذخیره</button>
                </div>
            </form>
            <?php if(
            $msg->hasMessages()){
                $msg->display();
            }
            ?>

        </div>
    </div>
</div>
<?php require_once '../view/footer.php';?>
