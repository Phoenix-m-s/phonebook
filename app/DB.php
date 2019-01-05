<?php

namespace App;

Class DB {


    protected $pdo ;
    private $DBname;
    private $DBuser;
    private $DBpass;
    protected $table ;
    protected $fetchMode = \PDO::FETCH_OBJ;


    public function __construct($DBname = 'phonebook' , $DBuser ='root' , $DBpass ='')
    {
        $this->conn = false;
        $this->DBname = $DBname;
        $this->DBuser = $DBuser;
        $this->DBpass = $DBpass;
        $this->connect();
    }



    private function connect(){
        try {
            $this->pdo = new \PDO("mysql:host=localhost;dbname={$this->DBname}", $this->DBuser, $this->DBpass);
            $this->conn = true;
        } catch(Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }

    public function setTable($value)
    {
        $this->table = $value;
    }

    public function select($name){
        if(is_array($name))
            $name=implode(',',$name);

        $stmt=$this->pdo->prepare("SELECT {$name} FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll($this->fetchMode);
    }
public function insert($data){
    $field='`'.implode('`,`' , $this->fillable).'`';
        $param=':' .implode(",:", $this->fillable);

    $stmt=$this->pdo->prepare("INSERT INTO {$this->table} ({$field}) VALUES ({$param})");
    $this->PDOBindArray($stmt,$data);
    return $stmt->execute();
}


    protected function PDOBindArray($PoStatment,$PaArray){
        foreach($PaArray as $key=>$value){
            $PoStatment->bindValue(':'.$key,$value);
        }
    }
    public function find($name,$value){
        if(is_array($name)||is_array($value))
            die('not allow array');
        $stmt=$this->pdo->prepare("SELECT * FROM {$this->table} WHERE {$name}= :{$name}");
        $stmt->bindValue(':'.$name,$value);
        $stmt->execute();
        return $stmt->fetch($this->fetchMode);
    }
    public function like($name,$value){
        $stmt=$this->pdo->prepare("SELECT * FROM {$this->table} WHERE {$name} LIKE :{$name}");
        $stmt->bindValue(':'.$name,'%'.$value.'%');
        $stmt->execute();
        return $stmt->fetchAll($this->fetchMode);
    }
    public function update($id,$data){

        if(!is_numeric($id))
            die('first argument should number');
        $this->checkIdExists($id);
        $fieldForUpdate=$this->fieldForUpdate($data);
        $stmt=$this->pdo->prepare("UPDATE {$this->table} SET {$fieldForUpdate} WHERE id=:id");
        $stmt->bindValue(':id',$id);
        $this->PDOBindArray($stmt,$data);
        return $stmt->execute();

    }
    public function delete($id){
        if(!is_numeric($id))
            die('first argument should number');
        $this->checkIdExists($id);
        $stmt=$this->pdo->prepare("DELETE FROM {$this->table} WHERE id=:id");
        $stmt->bindValue(':id',$id);
        return $stmt->execute();
    }



    private function checkIdExists($id){
        $stmt=$this->pdo->prepare("SELECT * FROM {$this->table} WHERE id=:id LIMIT 1");
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        if($stmt->rowCount() !==1)
            die('this is not current');

    }
    private function fieldForUpdate($data){
        $fieldNames=array_keys($data);
            $field=[];
        foreach($fieldNames as $fieldName){
           $field[]= $fieldName . "=:".$fieldName;
        }
        return implode(',' , $field);
    }

}

