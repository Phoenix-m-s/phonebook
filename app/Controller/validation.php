<?php
namespace App\Controller;

use App\DB;

class Validation
{
    /**
     * @var
     */
    private $errors;

    /**
     * @var
     */
    private $data;

    /**
     * @param array $data
     * @param array $rules
     * @return bool
     */
    public  function  make(Array $data, Array $rules){
        $valid=true;

        $this->data=$data;

        foreach($rules as $item=>$ruleset){

            $ruleset=explode('|',$ruleset);

            foreach($ruleset as $rule) {

                $pos = strpos($rule, ':');

                if($pos !==false){

                    $parametr=substr($rule,$pos+1);
                    $rule=substr($rule,0,$pos);
                }else
                    {
                    $parametr="";
                     }

                $MethodName=ucfirst($rule);

                $value=isset($data[$item])?$data[$item]:null;

                if(method_exists($this,$MethodName)){
                    $this->{$MethodName}($item,$value,$parametr) or $valid=false;
                  }
            }

        }
        return $valid;
    }

    /**
     * @return mixed
     */
    public function getErrors(){
        return $this->errors;
    }
    /*
	* Validation rules
	*
	* Each function should return TRUE if successfully validated
	*/
    /**
     * @param $item
     * @param $value
     * @return bool
     */
    public function required($item,$value){
        if(strlen($value)===0){
            $this->errors[$item][]='پر کردن فیلد ' . $item . ' الزامیست';
            return false;
        }
        return true;
    }

    /**
     * @param $item
     * @param $param
     * @return bool
     */
    public function confirme($item,$value,$param){
        $orginal=isset($this->data[$item])? $this->data[$item]: null;

            $confirm=isset($this->data[$param])? $this->data[$param]: null;
        if($orginal!==$confirm){
            $this->errors[$item][]="فیلد {$item} با فیلد {$param} برابر نیست";
            return false;
        }
        return true;
    }

    /**
     * @param $item
     * @param $value
     * @param $param
     * @return bool
     */
    public function email($item,$value,$param){
        if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
            $this->errors[$item][]="فرمت ایمیل وارد شده صحیح نیست";
            return false;
        }
        return true;
    }

    /**
     * @param $item
     * @param $value
     * @param $param
     * @return bool
     */
    public function min($item,$value,$param){
        if(strlen($value)<$param){
            $this->errors[$item][]="طول فیلد {$item} کمتر از {$param} کاراکتر است";
            return false;
        }
        return true;
    }

    /**
     * @param $item
     * @param $value
     * @param $param
     * @return bool
     */
    public function max($item,$value,$param){
        if(strlen($value)>$param){
            $this->errors[$item][]="طول فیلد نمیتواند {$item} بیشتر از {$param} کاراکتر باشد";
            return false;
        }
        return true;
    }


    public  function unique($item,$value,$param)
    {
        $DB = new DB();

        if (is_null($param))
            return false;

        $DB->setTable($param);

        $data=(strlen($this->data[$item])>0)? $this->data[$item]:NULL;

        if(is_null($data)){
            return false;
        }

        if($DB->find($item,$value) !==false){

            $this->errors[$item][]="مقدار  {$item} تکراری می باشد";

            return false;
        }
        return true;

    }


}