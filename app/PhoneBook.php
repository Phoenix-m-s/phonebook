<?php namespace App;

Class PhoneBook extends DB{

    protected $table = 'list_phonebook';
    protected $fillable=['name','adress','phone'];

}
