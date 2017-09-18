<?php
namespace app\modules\spokenlanguages\api;

use Yii;
use yii\easyii\components\API;
use yii\easyii\models\Photo;
use app\modules\spokenlanguages\models\Spokenlanguages as SpokenlanguagesModel;
use yii\helpers\Url;

class SpokenlanguagesObject extends \yii\easyii\components\ApiObject
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
        return Url::to(['/admin/spokenlanguages/a/edit/', 'id' => $this->id]);
    }
}