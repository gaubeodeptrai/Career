<?php
namespace app\controllers;

use app\modules\companies\api\Companies;
use app\modules\companies\models\Companies as Model;

class CompanyController extends \yii\web\Controller
{
    public function actionIndex($tag = null)
    {
        return $this->render('index',[
            'company' => Companies::items(['tags' => $tag, 'pagination' => ['pageSize' => 2]])
        ]);
    }

    public function actionView($slug)
    {
        $company = Companies::get($slug);
        
        if(!$company){
            throw new \yii\web\NotFoundHttpException('News not found.');
        }

        return $this->render('view', [
            'company' => $company
        ]);
    }
}
