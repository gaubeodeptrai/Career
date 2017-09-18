<?php
namespace app\models;
use yii\easyii\components\ActiveRecord;
class Resume extends ActiveRecord
{
    public static function tableName() {
        return "resume";
    }
    
    public function rules() {
        return [
            ['about', 'trim'],
            ['resume_file', 'file'],
            
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'about' => 'About me',
            'resume_file' => 'Your CV',
        ];
    }
}