<?php
namespace App\Controller;
use Plasticbrain\FlashMessages\FlashMessages;
class PhoneBook{
    public function show($word){
        $validation=new Validation();
        $rule=[
            'search'=>'required|min:3'
        ];
        $valid=$validation->make($word,$rule);
        $msg=new FlashMessages();
        if($valid!==true){
            foreach($validation->getErrors() as $error){
                $msg->error($error[0]);
            }
            return;
        }
        $phonebook=new \App\PhoneBook();
        $phones=$phonebook->like('name',$_POST['search']);
        if(count($phones)==0)
            $msg->error("شماره تلفنی برای این نتیجه وجود ندارد");
        return $phones;
    }

    public function delete($data){
        if($data['delete']==='true'){
            $phone=new \App\PhoneBook();
            $phone->delete($data['id']);
            redirect(site_adress(). '/dashboard/index.php');
        }
    }
    public function Update($data){
        $validation=new Validation();
        $rule=[
            'id'=>'required',
            'name'=>'required',
            'adress'=>'required',
            'phone'=>'required'
        ];
        $vaild=$validation->make($data,$rule);
        $msg=new FlashMessages();
        if($vaild !== true) {
            foreach ($validation->getErrors() as $error) {
                $msg->error($error[0]);
            }
            return ;
        }
        $phonebook=new \App\PhoneBook();
        $phonebook->update($data['id'],
        [
            'name'=>$data['name'],
            'adress'=>$data['adress'],
            'phone'=>$data['phone']
        ]);

        $msg->success('شماره مورد نظر با موفقیت ویرایش شد ');
        redirect(site_adress().$_SERVER['REQUEST_URI']);
    }

}