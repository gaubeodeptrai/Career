<?php
namespace app\models;
use yii\easyii\components\ActiveRecord;
class Followed extends ActiveRecord
{
    public static function tableName() {
        return "followed";
    }
    
    public function rules() {
        return [
            ['company_id', 'integer'],
            ['follow_type', 'safe'],
            [['candidate_id','time'], 'integer'],
            ['time', 'default', 'value' => time()],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            
        ];
    }
    public function getCandidate(){
        return $this->hasOne(\app\modules\candidates\models\Candidates::className(), ['candidate_id' => 'candidate_id']);
    }
    
}