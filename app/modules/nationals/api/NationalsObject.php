<?php
namespace app\modules\nationals\api;

use Yii;
use yii\easyii\components\API;
use yii\easyii\models\Photo;
use app\modules\nationals\models\Nationals as NationalsModel;
use yii\helpers\Url;

class NationalsObject extends \yii\easyii\components\ApiObject
{
    public $slug;
    public $time;

    public function getTitle(){
        return LIVE_EDIT ? API::liveEdit($this->model->title, $this->editLink) : $this->model->title;
    }

    public function getDate(){
        return Yii::$app->formatter->asDate($this->time);
    }

    public function  getEditLink(){
        return Url::to(['/admin/nationals/a/edit/', 'id' => $this->id]);
    }
}