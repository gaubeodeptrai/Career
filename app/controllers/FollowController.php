<?php
namespace app\controllers;
use Yii;

class FollowController extends \yii\web\Controller
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
        $model = new \app\models\Followed();
        if ($model->load(Yii::$app->request->post())){
           $page = Yii::$app->request->get('page');
                 
           if ($model->save()){
              if ($page == 'home'){
                  Yii::$app->session->setFlash('followed', 'success'); 
                  $this->redirect(['site/index']);   
              }
              else
              if ($page == 'job_view'){
                  Yii::$app->session->setFlash('followed', 'success'); 
                  $this->redirect(['job/view/'.\Yii::$app->request->get('slug')]);   
              } 
              else
              if ($page == 'company_view'){
                  Yii::$app->session->setFlash('followed', 'success'); 
                  $this->redirect(['company/view/'.\Yii::$app->request->get('slug')]);   
              } 
              if ($page == 'candidate_view'){
                  Yii::$app->session->setFlash('followed', 'success'); 
                  $this->redirect(['candidate/view/'.\Yii::$app->request->get('slug')]);   
              } 
           }
        }
        else{
           echo "Not apply"; 
        }
    }
    
    
}
