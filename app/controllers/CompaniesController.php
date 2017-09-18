<?php

namespace app\controllers;
use app\modules\companies\models\Companies;
use yii\web\UploadedFile;
use yii\easyii\helpers\Image;
use yii\easyii\modules\catalog\models\Item;
use yii\data\Pagination;
use Yii;
use dektrium\user\models\SettingsForm;
//Tạm thời sử dụng bảng Item làm bảng Job
class CompaniesController extends \yii\web\Controller
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
    public function actionProfile($id)
    {
        $model = Companies::findOne(['user_id'=>$id]);
       
        return $this->render('profile',['model'=>$model]);
    }
    
    public function actionEdit($id)
    {
        $model = Companies::findOne(['user_id'=>$id]);
        if ($model->load(\Yii::$app->request->post())){
          $model->user_id = $id;
            if (isset($_FILES)) {
                    //Image
                    $model->logo = UploadedFile::getInstance($model, 'logo');
                    if($model->logo && $model->validate(['logo'])){
                        $model->logo = Image::upload($model->logo, 'companies');
                    }
                    else{
                        $model->logo = $model->oldAttributes['logo'];
                    }
            }
            if ($model->save()){
              \Yii::$app->session->setFlash('success_edit');
          }
        } 
        return $this->render('edit',['model'=>$model]);
    }
    
    public function actionApplied($id)
    {
        $model = Companies::findOne(['user_id'=>$id]);
       
        return $this->render('applied',['model'=>$model]);
    }
    
    public function actionActivejobs($id)
    {
        $model = Companies::findOne(['user_id'=>$id]);
        $query = Item::find()->where(['company_id'=>$model->company_id])->andWhere(['status'=>1])->orderBy(['time'=>SORT_DESC]);
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize'=>10]);
        $jobs = $query->offset($pagination->offset)
                     
                      ->limit($pagination->limit)
                      
                      ->all();
        //echo $model->job->title;
        return $this->render('activejobs',
                [
                    'model'=>$model, 
                    'jobs'=>$jobs,
                    'pagination'=>$pagination, 
                    'total'=>$query->count()
                ]
        );
    }
    
    public function actionFollowed($id)
    {
        $model = Companies::findOne(['user_id'=>$id]);
       
        return $this->render('followed',['model'=>$model]);
    }
    
    public function actionNewjob($id)
    {
        $model = Companies::findOne(['user_id'=>$id]);
        
        $jobs = new Item();
        if ($jobs->load(\Yii::$app->request->post())){
           $jobs->company_id = $model->company_id;
           $jobs->expiration_date =  strtotime(\Yii::$app->request->post()['Item']["expiration_date"]);
           
           if ($jobs->save()){
              \Yii::$app->session->setFlash('success_new_job'); 
              return $this->redirect(['/companies/activejobs/', 'id' => $id]);
              
           }
        }
        return $this->render('newjob',['model'=>$model,'jobs'=>$jobs]);
    }
    
    public function actionEditjob($id){
        $model = Companies::findOne(['user_id'=>  \Yii::$app->user->id]);
        $jobs = Item::findOne($id);
        $jobs->expiration_date = date('d-m-Y', $jobs->expiration_date);
        if ($jobs->load(\Yii::$app->request->post())){
              $jobs->expiration_date =  strtotime(\Yii::$app->request->post()['Item']["expiration_date"]);
             if ($jobs->save()){
              \Yii::$app->session->setFlash('success_update_job'); 
              return $this->redirect(['/companies/activejobs/', 'id' => \Yii::$app->user->id]);
              
           }
        }
        
        return $this->render('editjob',['jobs'=>$jobs,'model'=>$model]);
    }

        public function actionDelete($id)
        {
            if(($model = Item::findOne($id))){
                $model->delete();
                \Yii::$app->session->setFlash('success_delete');
            } else {
                $this->error = 'Not found';
            }
            return $this->redirect(['/companies/activejobs/', 'id' => \Yii::$app->user->id]);
        }
    
    public function actionAccount() {
        $model = Companies::findOne(['user_id'=>  \Yii::$app->user->id]);
        $account_model = \Yii::createObject(SettingsForm::className());
        
        return $this->render('account',['model'=>$model,'account_model'=>$account_model]);
    }
    
}
