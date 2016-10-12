<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 12.10.2016
 * Time: 11:36
 */

namespace app\models;


use yii\base\Model;

class EntryForm extends Model
{
    public $name;
    public $email;

    public function rules()
    {
        return [
            [['email','name'],'required'],
            ['email','email']
        ];
      //  return parent::rules(); // TODO: Change the autogenerated stub
    }

}