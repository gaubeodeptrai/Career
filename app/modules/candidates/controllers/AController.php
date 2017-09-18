<?php

namespace app\modules\candidates\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\easyii\behaviors\SortableDateController;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;
use yii\easyii\components\Controller;
use app\modules\candidates\models\Candidates;
use app\modules\candidates\models\CandidatesSearch;
use yii\easyii\helpers\Image;
use yii\easyii\behaviors\StatusController;
use yii\filters\VerbFilter;
//use yii\web\NotFoundHttpException;
use yii\helpers\Json;

use app\models\Parttime;
use app\models\LastJob;

use yii\helpers\FileHelper;

class AController extends Controller {

    public function behaviors() {
        return [
            [
                'class' => SortableDateController::className(),
                'model' => Candidates::className(),
            ],
            [
                'class' => StatusController::className(),
                'model' => Candidates::className()
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $searchModel = new CandidatesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $candidateId = Yii::$app->request->post('editableKey');
            $model = Candidates::findOne($candidateId);

            // store a default json response as desired by editable
            $out = Json::encode(['output' => '', 'message' => '']);
            // fetch the first entry in posted data (there should only be one entry 
            // anyway in this array for an editable submission)
            // - $posted is the posted data for Book without any indexes
            // - $post is the converted array for single model validation
            $posted = current($_POST['Posts']);
            $post = ['Posts' => $posted];

            // load model like any single model validation
            if ($model->load($post)) {
                // can save model or do something before saving model
                $model->save();

                // custom output to return to be displayed as the editable grid cell
                // data. Normally this is empty - whereby whatever value is edited by
                // in the input by user is updated automatically.
                $output = '';

                // specific use case where you need to validate a specific
                // editable column posted when you have more than one
                // EditableColumn in the grid view. We evaluate here a
                // check to see if buy_amount was posted for the Book model
                // similarly you can check if the name attribute was posted as well
                // if (isset($posted['name'])) {
                // $output = ''; // process as you need
                // }
                $out = Json::encode(['output' => $output, 'message' => '']);
            }
            // return ajax json encoded response and exit
            echo $out;
            return;
        }

        // non-ajax - render the grid by default
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionCreate() {
        $model = new Candidates();
        $model->time = time();
        $parttime_id = 0;
        $last_job_id = 0;

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            } else {
                $result = \Yii::$app->request->post();
                //Image and Cv
                if (isset($_FILES)) {
                    //Image
                    $model->image = UploadedFile::getInstance($model, 'image');
                    if ($model->image && $model->validate(['image'])) {
                        $model->image = Image::upload($model->image, 'candidates');
                    } else {
                        $model->image = '';
                    }
                    //CV pdf
                    $model->cv = UploadedFile::getInstance($model, 'cv');
                    if($model->cv && $model->validate(['cv']))
                    {
                        $uploadPath = 'uploads/candidates/cv';
                        FileHelper::createDirectory($uploadPath);
                        $model->cv->saveAs($uploadPath . '/' .$model->slug.'-'.$model->time.'.'.$model->cv->extension);
                        $model->cv = $uploadPath . '/' .$model->slug.'-'.$model->time.'.'.$model->cv->extension;
                    }else
                    {
                        $model->cv = '';
                    }
                }
                //expected_salary
                
                if($result['Candidates']['expected_salary_amount'] && $result['Candidates']['expected_salary_currency_unit'])
                {
                    $expected_salary_amount = $result['Candidates']['expected_salary_amount'];
                    $expected_salary_currency_unit = $result['Candidates']['expected_salary_currency_unit'];
                    $arr_expected_salary = [];
                    $arr_expected_salary['amount'] = $expected_salary_amount;
                    $arr_expected_salary['unit'] = $expected_salary_currency_unit;
                    
                    $model->expected_salary = json_encode($arr_expected_salary);
                }else
                {
                    $model->expected_salary = '';
                }
                
                if ($model->save()) {
                    $candidate_id = $model->candidate_id;
                    //Save Parttime if work_time == parttime
                    if($result['Candidates']['work_time'] == 'parttime')
                    {
                        $model_parttime = new Parttime();
                        $model_parttime->work_period = $result['Candidates']['work_period'];
                        $model_parttime->number_hours = $result['Candidates']['number_of_hours'];
                        $model_parttime->candidate_id = $candidate_id;
                        $model_parttime->start_date = strtotime($result['start_date']);
                        $model_parttime->end_date = strtotime($result['end_date']);
                        
                        if($model_parttime->save())
                        {
                            $parttime_id = $model_parttime->parttime_id;
                            //Update last_job_id and parttime_id;
                            Candidates::updateAll(['parttime_id' => $parttime_id], ['candidate_id' => $candidate_id]);
                            
                            //Save last job if have year join, year left,
                            if($result['Candidates']['year_join'] && $result['Candidates']['year_left'])
                            {
                                $model_lastjob = new LastJob();
                                $model_lastjob->candidate_id = $candidate_id;
                                $model_lastjob->year_join = $result['Candidates']['year_join'];
                                $model_lastjob->year_left = $result['Candidates']['year_left'];
                                $model_lastjob->work_at = $result['Candidates']['work_at'];
                                $model_lastjob->work_as_id = $result['Candidates']['work_as_id'];
                                $model_lastjob->time = time();
                                //Salary json
                                if($result['Candidates']['salary_currency_unit'] && $result['Candidates']['salary_amount'])
                                {
                                    $salary_unit = $result['Candidates']['salary_currency_unit'];
                                    $salary_amount = $result['Candidates']['salary_amount'];
                                    $salary = [];
                                    $salary['amount'] = $salary_amount;
                                    $salary['unit'] = $salary_unit;
                                    $model_lastjob->salary = json_encode($salary);
                                }else
                                {
                                    $model_lastjob->salary = '';
                                }
                                
                                //Save table last current job
                                if ($model_lastjob->save()) 
                                { 
                                    $last_job_id = $model_lastjob->lastjob_id;
                                    //Update last_job_id and parttime_id;
                                    Candidates::updateAll(['last_job_id' => $last_job_id], ['candidate_id' => $candidate_id]);
                                    //Save product and stock successfull
                                    $this->flash('success', 'Candidates created');
                                } else {
                                    //Save lastjob failed Warning 
                                    $this->flash('warning', 'Candidates and parttime is created but Lastjob is not');
                                }
                                return $this->redirect(['/admin/' . $this->module->id]);
                            }
                        }
                        else
                        {
                            //Save parttime failed Warning 
                            $this->flash('warning', 'Candidates is created but Lastjob and parttime is not');
                            return $this->redirect(['/admin/' . $this->module->id]);
                        }
                    }else
                    {
                        //Save last job if have year join, year left,
                        if($result['Candidates']['year_join'] && $result['Candidates']['year_left'])
                        {
                            $model_lastjob = new LastJob();
                            $model_lastjob->candidate_id = $candidate_id;
                            $model_lastjob->year_join = $result['Candidates']['year_join'];
                            $model_lastjob->year_left = $result['Candidates']['year_left'];
                            $model_lastjob->work_at = $result['Candidates']['work_at'];
                            $model_lastjob->work_as_id = $result['Candidates']['work_as_id'];
                            $model_lastjob->time = time();
                            //Salary json
                            if($result['Candidates']['salary_currency_unit'] && $result['Candidates']['salary_amount'])
                            {
                                $salary_unit = $result['Candidates']['salary_currency_unit'];
                                $salary_amount = $result['Candidates']['salary_amount'];
                                $salary = [];
                                $salary['amount'] = $salary_amount;
                                $salary['unit'] = $salary_unit;
                                $model_lastjob->salary = json_encode($salary);
                            }else
                            {
                                $model_lastjob->salary = '';
                            }

                            //Save table last current job
                            if ($model_lastjob->save()) 
                            { 
                                $last_job_id = $model_lastjob->lastjob_id;
                                //Update last_job_id and parttime_id;
                                Candidates::updateAll(['last_job_id' => $last_job_id], ['candidate_id' => $candidate_id]);
                                //Save product and stock successfull
                                $this->flash('success', 'Candidates created');
                            } else {
                                //Save lastjob failed Warning 
                                $this->flash('warning', 'Candidates is created but Lastjob is not');
                            }
                            return $this->redirect(['/admin/' . $this->module->id]);
                        }
                    }
                } else {
                    $this->flash('error', 'Create error');
                    return $this->refresh();
                }
            }
        }
        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionEdit($id) {
        $model = Candidates::findOne($id);
        //Get salary from lastjob
        $lastjob = LastJob::find()->where(['candidate_id' => $model->candidate_id])->one();
        $parttime = Parttime::find()->where(['candidate_id' => $model->candidate_id])->one();
        $number_lastjob = count($lastjob);
        $number_parttime = count($parttime);
        
        if($number_lastjob > 0) //Last job already
        {
            $model->work_at = $lastjob['work_at'];
            $model->work_as_id = $lastjob['work_as_id'];
            $arr_salary = json_decode($lastjob['salary'], true);
            $model->salary_amount = $arr_salary['amount'];
            $model->salary_currency_unit = $arr_salary['unit'];
            $model->year_join = $lastjob['year_join'];
            $model->year_left = $lastjob['year_left'];
        }
        
        if($number_parttime > 0)
        {
            $model->work_period = $parttime['work_period'];
            $model->number_of_hours = $parttime['number_hours'];
            $model->start_date = date('d-m-Y', $parttime['start_date']);
            $model->end_date = date('d-m-Y', $parttime['end_date']);
        }
        //expected salary
        $arr_expected_salary = json_decode($model->expected_salary, true);
        $model->expected_salary_currency_unit = $arr_expected_salary['unit'];
        $model->expected_salary_amount = $arr_expected_salary['amount'];

        if ($model === null) {
            $this->flash('error', Yii::t('easyii', 'Not found'));
            return $this->redirect(['/admin/' . $this->module->id]);
        }

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            } else {
                $result = \Yii::$app->request->post();
                //Image and Cv
                if (isset($_FILES)) {
                    //Image
                    $model->image = UploadedFile::getInstance($model, 'image');
                    if($model->image && $model->validate(['image'])){
                        $model->image = Image::upload($model->image, 'candidates');
                    }
                    else{
                        $model->image = $model->oldAttributes['image'];
                    }
                    //Cv pdf
                    //CV pdf
                    $model->cv = UploadedFile::getInstance($model, 'cv');
                    if($model->cv && $model->validate(['cv']))
                    {
                        $uploadPath = 'uploads/candidates/cv';
                        FileHelper::createDirectory($uploadPath);
                        $model->cv->saveAs($uploadPath . '/' .$model->slug.'-'.$model->time.'.'.$model->cv->extension);
                        $model->cv = $uploadPath . '/' .$model->slug.'-'.$model->time.'.'.$model->cv->extension;
                    }else
                    {
                        $model->cv = $model->oldAttributes['cv'];
                    }
                }
                //expected_salary
                
                if($result['Candidates']['expected_salary_amount'] && $result['Candidates']['expected_salary_currency_unit'])
                {
                    $expected_salary_amount = $result['Candidates']['expected_salary_amount'];
                    $expected_salary_currency_unit = $result['Candidates']['expected_salary_currency_unit'];
                    $arr_expected_salary = [];
                    $arr_expected_salary['amount'] = $expected_salary_amount;
                    $arr_expected_salary['unit'] = $expected_salary_currency_unit;
                    
                    $model->expected_salary = json_encode($arr_expected_salary);
                }else
                {
                    $model->expected_salary = '';
                }
                
                if ($model->save()) {
                    $candidate_id = $model->candidate_id;
                    //TH1 : parttime and lastjob already -> Edit 2 table
                    if($number_lastjob > 0 && $number_parttime > 0)
                    {
                        //Lastjob
                        $lastjob->year_join = $result['Candidates']['year_join'];
                        $lastjob->year_left = $result['Candidates']['year_left'];
                        $lastjob->work_at = $result['Candidates']['work_at'];
                        $lastjob->work_as_id = $result['Candidates']['work_as_id'];
                        ////Salary json
                        if($result['Candidates']['salary_currency_unit'] && $result['Candidates']['salary_amount'])
                        {
                            $salary_unit = $result['Candidates']['salary_currency_unit'];
                            $salary_amount = $result['Candidates']['salary_amount'];
                            $salary = [];
                            $salary['amount'] = $salary_amount;
                            $salary['unit'] = $salary_unit;
                            $lastjob->salary = json_encode($salary);
                        }else
                        {
                            $lastjob->salary = '';
                        }
                        
                        //Parttime
                        $parttime->work_period = $result['Candidates']['work_period'];
                        $parttime->number_hours = $result['Candidates']['number_of_hours'];
                        $parttime->start_date = strtotime($result['start_date']);
                        $parttime->end_date = strtotime($result['end_date']);
                        
                        //Save 2 table
                        $lastjob->save();
                        $parttime->save();
                    }
                    //TH 2 : parttime and lastjob not already -> Create new 2 table
                    else if($number_lastjob == 0 && $number_parttime == 0)
                    {
                        //Save Parttime if work_time == parttime
                        if($result['Candidates']['work_time'] == 'parttime')
                            {
                                $model_parttime = new Parttime();
                                $model_parttime->work_period = $result['Candidates']['work_period'];
                                $model_parttime->number_hours = $result['Candidates']['number_of_hours'];
                                $model_parttime->candidate_id = $candidate_id;
                                $model_parttime->start_date = strtotime($result['start_date']);
                                $model_parttime->end_date = strtotime($result['end_date']);

                                if($model_parttime->save())
                                {
                                    $parttime_id = $model_parttime->parttime_id;
                                    Candidates::updateAll(['parttime_id' => $parttime_id], ['candidate_id' => $candidate_id]);
                                    //Save last job if have year join, year left,
                                    if($result['Candidates']['year_join'] && $result['Candidates']['year_left'])
                                    {
                                        $model_lastjob = new LastJob();
                                        $model_lastjob->candidate_id = $candidate_id;
                                        $model_lastjob->year_join = $result['Candidates']['year_join'];
                                        $model_lastjob->year_left = $result['Candidates']['year_left'];
                                        $model_lastjob->work_at = $result['Candidates']['work_at'];
                                        $model_lastjob->work_as_id = $result['Candidates']['work_as_id'];
                                        $model_lastjob->time = time();
                                        //Salary json
                                        if($result['Candidates']['salary_currency_unit'] && $result['Candidates']['salary_amount'])
                                        {
                                            $salary_unit = $result['Candidates']['salary_currency_unit'];
                                            $salary_amount = $result['Candidates']['salary_amount'];
                                            $salary = [];
                                            $salary['amount'] = $salary_amount;
                                            $salary['unit'] = $salary_unit;
                                            $model_lastjob->salary = json_encode($salary);
                                        }else
                                        {
                                            $model_lastjob->salary = '';
                                        }

                                        //Save table last current job
                                        if ($model_lastjob->save()) 
                                        { 
                                            $last_job_id = $model_lastjob->lastjob_id;
                                            //Update last_job_id and parttime_id;
                                            Candidates::updateAll(['last_job_id' => $last_job_id, 'parttime_id' => $parttime_id], ['candidate_id' => $candidate_id]);
//                                            $model_candidate = Candidates::findOne(['candidate_id' => $candidate_id]);
//                                            $model_candidate->parttime_id = $parttime_id;
//                                            $model_candidate->last_job_id = $last_job_id;
//                                            $model_candidate->save();
                                            //Save product and stock successfull
                                            $this->flash('success', 'Candidates created');
                                        } else {
                                            //Save lastjob failed Warning 
                                            $this->flash('warning', 'Candidates and parttime is created but Lastjob is not');
                                        }
                                        return $this->redirect(['/admin/' . $this->module->id]);
                                    }
                                }
                                else
                                {
                                    //Save parttime failed Warning 
                                    $this->flash('warning', 'Candidates is created but Lastjob and parttime is not');
                                    return $this->redirect(['/admin/' . $this->module->id]);
                                }
                            }
                        else
                            {
                                //Save last job if have year join, year left,
                                if($result['Candidates']['year_join'] && $result['Candidates']['year_left'])
                                {
                                    $model_lastjob = new LastJob();
                                    $model_lastjob->candidate_id = $candidate_id;
                                    $model_lastjob->year_join = $result['Candidates']['year_join'];
                                    $model_lastjob->year_left = $result['Candidates']['year_left'];
                                    $model_lastjob->work_at = $result['Candidates']['work_at'];
                                    $model_lastjob->work_as_id = $result['Candidates']['work_as_id'];
                                    $model_lastjob->time = time();
                                    //Salary json
                                    if($result['Candidates']['salary_currency_unit'] && $result['Candidates']['salary_amount'])
                                    {
                                        $salary_unit = $result['Candidates']['salary_currency_unit'];
                                        $salary_amount = $result['Candidates']['salary_amount'];
                                        $salary = [];
                                        $salary['amount'] = $salary_amount;
                                        $salary['unit'] = $salary_unit;
                                        $model_lastjob->salary = json_encode($salary);
                                    }else
                                    {
                                        $model_lastjob->salary = '';
                                    }

                                    //Save table last current job
                                    if ($model_lastjob->save()) 
                                    { 
                                        $last_job_id = $model_lastjob->lastjob_id;
                                        //Update last_job_id and parttime_id;
                                        Candidates::updateAll(['last_job_id' => $last_job_id], ['candidate_id' => $candidate_id]);
//                                        $model_candidate = Candidates::findOne(['candidate_id' => $candidate_id]);
//                                        $model_candidate->last_job_id = $last_job_id;
//                                        $model_candidate->save();
                                        //Save Candidates successfull
                                        $this->flash('success', 'Candidates created');
                                    } else {
                                        //Save lastjob failed Warning 
                                        $this->flash('warning', 'Candidates is created but Lastjob is not');
                                    }
                                    return $this->redirect(['/admin/' . $this->module->id]);
                                }
                            }
                    }
                    //TH 3 : parttime already, last job not already -> Edit parttime and create new last job
                    else if($number_parttime >0 && $number_lastjob == 0)
                    {
                        //Update parttime
                        $parttime->work_period = $result['Candidates']['work_period'];
                        $parttime->number_hours = $result['Candidates']['number_of_hours'];
                        $parttime->start_date = strtotime($result['start_date']);
                        $parttime->end_date = strtotime($result['end_date']);
                        
                        //Create new last job
                        $model_lastjob = new LastJob();
                        $model_lastjob->candidate_id = $candidate_id;
                        $model_lastjob->year_join = $result['Candidates']['year_join'];
                        $model_lastjob->year_left = $result['Candidates']['year_left'];
                        $model_lastjob->work_at = $result['Candidates']['work_at'];
                        $model_lastjob->work_as_id = $result['Candidates']['work_as_id'];
                        $model_lastjob->time = time();
                            ////Salary json
                        if($result['Candidates']['salary_currency_unit'] && $result['Candidates']['salary_amount'])
                        {
                            $salary_unit = $result['Candidates']['salary_currency_unit'];
                            $salary_amount = $result['Candidates']['salary_amount'];
                            $salary = [];
                            $salary['amount'] = $salary_amount;
                            $salary['unit'] = $salary_unit;
                            $model_lastjob->salary = json_encode($salary);
                        }else
                        {
                            $model_lastjob->salary = '';
                        }
                            ////Save lastjob and update last_job_id table candidate
                        if($model_lastjob->save())
                        {
                            $new_last_job_id = $model_lastjob->lastjob_id;
                            $parttime->save();
//                            $model_candidate = Candidates::find()->where(['candidate_id' => $candidate_id])->one();
//                            $model_candidate->last_job_id = $model_lastjob->lastjob_id;
//                            $model_candidate->save();
                            Candidates::updateAll(['last_job_id' => $new_last_job_id], ['candidate_id' => $candidate_id]);
                        }
                    }
                    //TH 4 : parttime not already, last job already -> create new parttime and update last job
                    else if($number_parttime == 0 && $number_lastjob > 0)
                    {
                        //Update lastjob
                        $lastjob->year_join = $result['Candidates']['year_join'];
                        $lastjob->year_left = $result['Candidates']['year_left'];
                        $lastjob->work_at = $result['Candidates']['work_at'];
                        $lastjob->work_as_id = $result['Candidates']['work_as_id'];
                            ////Salary json
                        if($result['Candidates']['salary_currency_unit'] && $result['Candidates']['salary_amount'])
                        {
                            $salary_unit = $result['Candidates']['salary_currency_unit'];
                            $salary_amount = $result['Candidates']['salary_amount'];
                            $salary = [];
                            $salary['amount'] = $salary_amount;
                            $salary['unit'] = $salary_unit;
                            $lastjob->salary = json_encode($salary);
                        }else
                        {
                            $lastjob->salary = '';
                        }
                        
                        //Create new parttime
                        $model_parttime = new Parttime();
                        $model_parttime->work_period = $result['Candidates']['work_period'];
                        $model_parttime->number_hours = $result['Candidates']['number_of_hours'];
                        $model_parttime->candidate_id = $candidate_id;
                        $model_parttime->start_date = strtotime($result['start_date']);
                        $model_parttime->end_date = strtotime($result['end_date']);
                        
                        if($model_parttime->save())
                        {
                            $new_parttime_id = $model_parttime->parttime_id;
                            $lastjob->save();
//                            $model_candidate = Candidates::find()->where(['candidate_id' => $candidate_id])->one();
//                            $model_candidate->parttime_id = $model_parttime->parttime_id;
//                            $model_candidate->save();
                            Candidates::updateAll(['parttime_id' => $new_parttime_id], ['candidate_id' => $candidate_id]);
                        }
                    }
                    
                } else {
                    $this->flash('error', 'Create error');
                    return $this->refresh();
                }
            }
        }
        return $this->render('edit', [
            'model' => $model
        ]);
    }

    public function actionPhotos($id) {
        if (!($model = Candidates::findOne($id))) {
            return $this->redirect(['/admin/' . $this->module->id]);
        }

        return $this->render('photos', [
                    'model' => $model,
        ]);
    }

    public function actionDelete($id) {
        if (($model = Candidates::findOne($id))) {
            $model->delete();
        } else {
            $this->error = Yii::t('easyii', 'Not found');
        }
        return $this->formatResponse(Yii::t('easyii/candidates', 'Candidates deleted'));
    }

    public function actionClearImage($id) {
        $model = Candidates::findOne($id);

        if ($model === null) {
            $this->flash('error', Yii::t('easyii', 'Not found'));
        } else {
            $model->image = '';
            if ($model->update()) {
                @unlink(Yii::getAlias('@webroot') . $model->image);
                $this->flash('success', Yii::t('easyii', 'Image cleared'));
            } else {
                $this->flash('error', Yii::t('easyii', 'Update error. {0}', $model->formatErrors()));
            }
        }
        return $this->back();
    }

    public function actionUp($id) {
        return $this->move($id, 'up');
    }

    public function actionDown($id) {
        return $this->move($id, 'down');
    }

    public function actionOn($id) {
        return $this->changeStatus($id, Candidates::STATUS_ON);
    }

    public function actionOff($id) {
        return $this->changeStatus($id, Candidates::STATUS_OFF);
    }

}
