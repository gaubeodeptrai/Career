<?php
namespace app\controllers;
use Yii;

class ApplyController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function () {
                  return Yii::$app->response->redirect(['users/login']);
                },
            ],
        ];
    }
    public function actionIndex()
    {
        
        $model = new \app\models\Applies();
        if ($model->load(Yii::$app->request->post())){
           $page = Yii::$app->request->get('page'); 
           if ($model->save()){
              if ($page == 'home'){
                  Yii::$app->session->setFlash('applied', 'success'); 
                  $this->redirect(['site/index']);   
              }
              else
               if ($page == 'job'){
                  Yii::$app->session->setFlash('applied', 'success'); 
                  $this->redirect(['job/view/'.\Yii::$app->request->get('slug')]);   
              }
              else    
              if ($page == 'job_view'){
                  Yii::$app->session->setFlash('applied', 'success'); 
                  $this->redirect(['job/view/'.\Yii::$app->request->get('slug')]);   
              }    
           }
        }
        else{
           echo "Not apply"; 
        }
    }
    
    
}
