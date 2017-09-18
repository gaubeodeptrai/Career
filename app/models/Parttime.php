<?php
namespace app\models;
use yii\easyii\components\ActiveRecord;
class Parttime extends ActiveRecord
{
    public static function tableName() {
        return "parttime";
    }
    
    public function rules() {
        return [
            [['number_hours', 'candidate_id', 'start_date', 'end_date'], 'integer'],
            ['work_period', 'string', 'max' => 100]
        ];
    }
}