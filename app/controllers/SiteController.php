<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\modules\companies\models\Companies;
use dektrium\user\models\User;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest){
            $user_type = User::findOne(['id'=>Yii::$app->user->id])->user_type;
            
             if ($user_type=='candidate'){
               return $this->render('index');
            }
            else
            if ($user_type=='business'){    
               return $this->render('company');   
            }
        }
        else{
          return $this->render('index'); 
        }
    }
   
}