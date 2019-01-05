<?php
     namespace App\Controller;

     use App\Controller\validation;

     use Plasticbrain\FlashMessages\FlashMessages;
     use App\Helpers\Auth;

     use App\User as DataUser;

 class User
 {
     public function register($data)
     {
         $validation = new Validation();
         $rule = [
             'name' => 'required',
             'email' => 'required|email|unique:users',
             'password' => 'required|min:6|max:10',
             'password_confirmation' => 'required|confirme:password|min:6',
         ];
         $valid = $validation->make($data, $rule);

         $msg=new FlashMessages();

         if($valid !==true){

             // Add a few messages
             foreach($validation->getErrors() as $error){
                 $msg->error($error[0]);
             }

             return;
         }
         $user=new DataUser();

         $success=$user->insert([
             'name'=>$data['name'],
             'email'=>$data['email'],
             'password'=>password_hash(($data['password']),PASSWORD_BCRYPT,['cost'=>12])
         ]);

         if($success===true){
             $user->find('email',$data['email']);
             auth::login($user);
         }

         $msg->success('عضویت شما با موفقیت انجام شد');

         header('location:'.$_SERVER['REQUEST_URI']);
         exit();

     }

     public function login($data){

         $validation=new validation();

         $rule=[
             'email'=>'required|email',
             'password'=>'required|min:6',
         ];
         $valid = $validation->make($data, $rule);

         $msg=new FlashMessages();

         if($valid !==true){

             // Add a few messages
             foreach($validation->getErrors() as $error){
                 $msg->error($error[0]);
             }

             return;

     }
         $email=$data['email'];
         $password=$data['password'];

         $user=new DataUser();
         $user=$user->find('email',$email);
         if($user!==false){
            $login=password_verify($password,$user->password);
             if($login==true){
                 $remember=false;
                 if(isset($data['remember']))
                     $remember=true;

                 Auth::login($user,$remember);
                 redirect();

             }

             $msg->error('پسورد صحیح نمی باشد');
             return ;
         }
         $msg->error('چنین ایمیلی وجود ندارد');
         return ;
     }




 }