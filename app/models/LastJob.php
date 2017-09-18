<?php
namespace app\models;
use yii\easyii\components\ActiveRecord;

class LastJob extends ActiveRecord
{
    public static function tableName() {
        return "last_current_jobs";
    }
    
    public function rules() {
        return [
            [['year_join', 'year_left', 'work_as_id', 'candidate_id'], 'integer'],
            [['salary'], 'string', 'max' => 64],
            ['work_at', 'string', 'max' => 250]
        ];
    }
}