<?php
@session_start();
include '../vendor/autoload.php';
checkUser();
use App\PhoneBook as modelPone;
use App\Controller\PhoneBook as Controlphone;

if(!empty($_GET)){
    $phonebook=new Controlphone();
    $phonebook->delete($_GET);
}


$phonebooks=new modelPone();
$phonebooks=$phonebooks->select(['id','name','adress','phone']);

?>


<?php require_once('view/header.php');?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 title">
            <h2>پنل مدیریت</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h3 class="sub-header">لیست دفترچه تلفن <a href="/dashboard/phonebook.php"><button class="btn btn-xs btn-success">ایجاد شماره جدید</button></a></h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>شماره سطر</th>
                        <th>نام</th>
                        <th>شماره تلفن</th>
                        <th>آدرس</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($phonebooks as $key=>$phonebook) :?>
                    <tr>
                        <td><?=++$key ?></td>
                        <td><?= $phonebook->name ?></td>
                        <td><?= $phonebook->phone ?></td>
                        <td><?= $phonebook->adress ?></td>
                        <td>
                            <a href="/dashboard/index.php?delete=true&id=<?= $phonebook->id ?>"><button type="button" class="btn btn-danger btn-sm">حذف</button></a>
                            <a href="/dashboard/edit-phonebook.php?id=<?= $phonebook->id ?>"><button type="button" class="btn btn-primary btn-sm">ویرایش</button></a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once ('../view/footer.php');?>

