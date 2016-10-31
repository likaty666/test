<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 19.10.2016
 * Time: 11:24
 */

namespace app\models;


use yii\db\ActiveRecord;

class Blog extends ActiveRecord
{
//    public $name;
//    public  $comment;
    public function rules(){
        return [
            ['name','required'],
            ['comment','required']
        ];
    }
}