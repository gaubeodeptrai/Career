<?php
namespace app\models;
use yii\easyii\components\ActiveRecord;
class Applies extends ActiveRecord
{
    public static function tableName() {
        return "applies";
    }
    
    public function rules() {
        return [
            ['job_id', 'integer'],
            [['candidate_id','time'], 'integer'],
            ['time', 'default', 'value' => time()],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            
        ];
    }
}