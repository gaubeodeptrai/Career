<?php
namespace app\modules\companies\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\easyii\behaviors\SortableDateController;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;

use yii\easyii\components\Controller;
use app\modules\companies\models\Companies;
use yii\easyii\helpers\Image;
use yii\easyii\behaviors\StatusController;

class AController extends Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => SortableDateController::className(),
                'model' => Companies::className(),
            ],
            [
                'class' => StatusController::className(),
                'model' => Companies::className()
            ]
        ];
    }

    public function actionIndex()
    {
        $data = new ActiveDataProvider([
            'query' => Companies::find()->sortDate(),
        ]);

        return $this->render('index', [
            'data' => $data
        ]);
    }

    public function actionCreate()
    {
        $model = new Companies;
        $model->time = time();

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if(isset($_FILES)){
                    $model->logo = UploadedFile::getInstance($model, 'logo');
                    if($model->logo && $model->validate(['logo'])){
                        $model->logo = Image::upload($model->logo, 'companies');
                    }
                    else{
                        $model->logo = '';
                    }
                }
                if($model->save()){
                    $this->flash('success', Yii::t('easyii/companies', 'Companies created'));
                    return $this->redirect(['/admin/'.$this->module->id]);
                }
                else{
                    $this->flash('error', Yii::t('easyii', 'Create error. {0}', $model->formatErrors()));
                    return $this->refresh();
                }
            }
        }
        else {
            return $this->render('create', [
                'model' => $model
            ]);
        }
    }

    public function actionEdit($id)
    {
        $model = Companies::findOne($id);

        if($model === null){
            $this->flash('error', Yii::t('easyii', 'Not found'));
            return $this->redirect(['/admin/'.$this->module->id]);
        }

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if(isset($_FILES)){
                    $model->logo = UploadedFile::getInstance($model, 'logo');
                    if($model->logo && $model->validate(['logo'])){
                        $model->logo = Image::upload($model->logo, 'companies');
                    }
                    else{
                        $model->logo = $model->oldAttributes['logo'];
                    }
                }

                if($model->save()){
                    $this->flash('success', Yii::t('easyii/companies', 'Companies updated'));
                }
                else{
                    $this->flash('error', Yii::t('easyii', 'Update error. {0}', $model->formatErrors()));
                }
                return $this->refresh();
            }
        }
        else {
            return $this->render('edit', [
                'model' => $model
            ]);
        }
    }

    public function actionPhotos($id)
    {
        if(!($model = Companies::findOne($id))){
            return $this->redirect(['/admin/'.$this->module->id]);
        }

        return $this->render('photos', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        if(($model = Companies::findOne($id))){
            $model->delete();
        } else {
            $this->error = Yii::t('easyii', 'Not found');
        }
        return $this->formatResponse(Yii::t('easyii/companies', 'Companies deleted'));
    }

    public function actionClearImage($id)
    {
        $model = Companies::findOne($id);

        if($model === null){
            $this->flash('error', Yii::t('easyii', 'Not found'));
        }
        else{
            $model->logo = '';
            if($model->update()){
                @unlink(Yii::getAlias('@webroot').$model->logo);
                $this->flash('success', Yii::t('easyii', 'Logo cleared'));
            } else {
                $this->flash('error', Yii::t('easyii', 'Update error. {0}', $model->formatErrors()));
            }
        }
        return $this->back();
    }

    public function actionUp($id)
    {
        return $this->move($id, 'up');
    }

    public function actionDown($id)
    {
        return $this->move($id, 'down');
    }

    public function actionOn($id)
    {
        return $this->changeStatus($id, Companies::STATUS_ON);
    }

    public function actionOff($id)
    {
        return $this->changeStatus($id, Companies::STATUS_OFF);
    }
}