<?php

include 'vendor/autoload.php';
@session_start();
use Plasticbrain\FlashMessages\FlashMessages;
if($_SERVER['REQUEST_METHOD']=='POST'){
    $phonebook=new \App\Controller\PhoneBook();
    $phonse= $phonebook->show($_POST);
}
$msg=NEW FlashMessages();


?>


<?php require_once ('view/header.php');?>


<div class="container">
    <div class="row">
        <div class="col-lg-12 title">
            <h2>جستجو شماره مورد نظر</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <form action="/" method="POST">
                <div class="form-group">
                    <input name="search" type="text" class="form-control" placeholder="لطفا نام فرد مورد نظر خود را وارد کنید . . .">
                    <button type="submit" class="btn btn-danger button--phone">جستجو</button>
                </div>
            </form>
        </div>

    </div>
    <?php if(isset($phonse) && count($phonse)>0) : ?>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>شماره سطر</th>
                        <th>نام</th>
                        <th>شماره تلفن</th>
                        <th>آدرس</th>
                    </tr>
                    </thead>
                    <tbody>
                         <?php foreach($phonse as $key=>$phone) :?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $phone->name?></td>
                            <td><?= $phone->phone?></td>
                            <td><?= $phone->adress?></td>
                        </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php else :?>
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4" style="margin-top: 10px">
            <?php if($msg->hasMessages()){
                     $msg->display();
            }
            ?>
        </div>
    </div>
    <?php endif ?>

</div>
<?php require_once('view/footer.php');?>