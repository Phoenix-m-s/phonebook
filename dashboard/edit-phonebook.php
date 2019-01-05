<?php
@session_start();
include '../vendor/autoload.php';
checkUser();
use App\Controller\PhoneBook;
use Plasticbrain\FlashMessages\FlashMessages;
$phonebookController=new PhoneBook();
if($_SERVER['REQUEST_METHOD']=='POST') {
    $phonebookController->Update($_POST);
}
if(!isset($_GET['id']))
        redirect(site_adress().'dashboard/index.php');
$phonebook=new \App\PhoneBook();
$phone=$phonebook->find('id', $_GET['id']);
$msg=new FlashMessages();
?>

    <?php require_once('view/header.php');?>

    <div class="container">

    <div class="row">

        <div class="col-lg-12 title">
            <h2>ویرایش شماره </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <form action="/dashboard/edit-phonebook.php?id=<?=$phone->id ?>" method="post">
                <input type="hidden" name="id" value="<?php echo $phone->id ?>">
                <div class="form-group">
                    <label>نام</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $phone->name ?>">
                </div>
                <div class="form-group">
                    <label>شماره تلفن</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo $phone->phone?>">
                </div>
                <div class="form-group">
                    <label>آدرس</label>
                    <textarea name="adress" rows="10" class="form-control"><?php echo $phone->adress ?></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger">ویرایش</button>
                </div>
            </form>
            <?php
            if($msg->hasMessages()){
                $msg->display();
            }
            ?>
        </div>
    </div>
</div>
<?php require_once('../view/footer.php');?>
