<?php
namespace App;
class User extends  DB{
    protected $table='users';
protected $fillable=['name','email','password'];
    public function dataUser($email,$password){
        $stmt=$this->pdo->prepare("SELECT * FROM {$this->table} WHERE email=:email AND password=:password");
        $stmt->bindValue(':email',$email);
        $stmt->bindValue(':password',$password);
        $stmt->execute();
        return $stmt->fetch($this->fetchMode);
    }

}