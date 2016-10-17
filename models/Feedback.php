<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 17.10.2016
 * Time: 11:01
 */

namespace app\models;


use yii\base\Model;

class Feedback extends Model
{
    public $name;
    public $email;
    public $age;
    public $about;
    public $inn;
    public $file;

    public function rules(){
        return [
            [['name','email'],'required'],
            ['age','number'],
//            ['inn','compare','compareValue' => 123, 'operator' => '=='],
            ['inn','integer'],
            ['inn','validateId'],
            ['about','string'],
            ['file','file','extensions'=>"pdf"]
        ];
    }

    public function validateId($attr)
    {

        if($this->$attr==123){
            return true;
        }else
            return false;
    }
}