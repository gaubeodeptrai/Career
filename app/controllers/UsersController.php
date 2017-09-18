<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\modules\candidates\models\Candidates;
use app\models\LastJob;
use app\models\Parttime;
use yii\web\UploadedFile;
use yii\easyii\helpers\Image;
use app\models\Applies;
use app\models\Resume;
use dektrium\user\models\SettingsForm;
use yii\data\Pagination;


class UsersController extends Controller
{
    
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
    
    public function actionLogin()
    {
        return $this->render('login');
    }
    
    public function actionRegister()
    {
        return $this->render('register');    
    }
    
    public function actionProfile($id)
    {
        $model = Candidates::findOne(['user_id'=>$id]);
       
        return $this->render('profile',
                [
                    'model'=>$model,
                    
                ]
        );    
    }
    
    public function actionResume($id)
    {
        $model = Candidates::findOne(['user_id'=>$id]);
        $count = Resume::find()->where(['user_id'=>$id])->count();
        
        if ($count > 0):
           $cv = Resume::findOne(['user_id'=>$id]); 
        else:
           $cv = new Resume();
        endif;
       /* echo "<pre>"; 
        var_dump(Yii::$app->request->post()["Candidates"]["tagNames"]);
        echo "</pre>";*/
        if($cv->load(Yii::$app->request->post())){
        $tags = (Yii::$app->request->post()["Candidates"]["tagNames"]); 
        if($tags):
        $arr_tag = explode(",",$tags);
        //print_r($arr_tag);
       
            $model_skill_user = new \yii\easyii\models\TagAssign();
            $model_skill_user->deleteAll(['item_id'=>$id]);  
            for($i=0;$i<count($arr_tag);$i++):

            if (\yii\easyii\models\Tag::find()->where(['name'=>$arr_tag[$i]])->count()==0):    
              $model_skill = new \yii\easyii\models\Tag();
              $model_skill->name = trim($arr_tag[$i]);
              $model_skill->frequency = 1;
              $model_skill->save();
            else:
               $model_skill = \yii\easyii\models\Tag::findOne(['name'=>$arr_tag[$i]]);
               $model_skill->frequency = $model_skill->frequency + 1;
               $model_skill->save();
            endif;  
                  $model_skill_user = new \yii\easyii\models\TagAssign();
                  $model_skill_user->tag_id = $model_skill->tag_id;
                  $model_skill_user->class = Resume::className();
                  $model_skill_user->item_id = $id;
                  $model_skill_user->save();
            endfor;
        endif;
        //$cv->resume_file = UploadedFile::getInstance($cv, 'resume_file');
        if(isset($_FILES))
        {
            /*$uploadPath = 'uploads/candidates/resume_file';
            FileHelper::createDirectory($uploadPath);
            $cv->resume_file->saveAs($uploadPath . '/' .$model->slug.'-'.$id.'.'.$cv->resume_file->extension);
            $cv->resume_file = $uploadPath . '/' .$model->slug.'-'.$id.'.'.$cv->resume_file->extension;*
             * 
             
            
        }else
         if($cv->resume_file)    
         {
            $cv->resume_file = $cv->oldAttributes['resume_file'];
         }
             * 
             */
                    $cv->resume_file = UploadedFile::getInstance($cv, 'resume_file');
                    if($cv->resume_file && $cv->validate(['resume_file'])){
                        $cv->resume_file = Image::upload($cv->resume_file, 'candidates/resume_file');
                    }
                    else
                    if($cv->resume_file)    
                    {
                        $cv->resume_file = $cv->oldAttributes['resume_file'];
                    }
        }
        
        $cv->user_id = $id;
        if ($cv->save()):
            Yii::$app->getSession()->setFlash('success_cv', [
                        'type' => 'success',
                        'duration' => 12000,
                        'icon' => 'fa fa-users',
                        'message' => 'Updated',
                        'title' => 'Update user infomation',
                        'positonY' => 'top',
                        'positonX' => 'left'
                    ]);
            return $this->redirect(['/users/profile/'.$id]); 
        endif;
        }
        return $this->render('resume',
                [
                    'model'=>$model,
                    'cv' => $cv,
                ]
        );    
    }
    
   public function actionEdit($id) {
       $model = Candidates::findOne(['user_id'=>$id]);
    /* echo "<pre>";
       echo var_dump(Yii::$app->request->post()["Candidates"]["spoken_language_id"]);
     echo "</pre>"   ;*/
       
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
                $langs = '[';
                 for($i=0;$i<count(Yii::$app->request->post()["Candidates"]["spoken_language_id"]);$i++){
                     $langs .= Yii::$app->request->post()["Candidates"]["spoken_language_id"][$i];

                     if ($i==count(Yii::$app->request->post()["Candidates"]["spoken_language_id"])-1):
                      $langs .= '';   
                     else:
                         $langs .= ',';
                     endif;
                 }
                $langs .= ']';
                
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
                $model->spoken_language_id = $langs;
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
//                                      
                                        //Save Candidates successfull
                                       Yii::$app->getSession()->setFlash('success_update', [
                                            'type' => 'success',
                                            'duration' => 12000,
                                            'icon' => 'fa fa-users',
                                            'message' => 'Updated',
                                            'title' => 'Update user infomation',
                                            'positonY' => 'top',
                                            'positonX' => 'left'
                                        ]);
                                         return $this->redirect(['/users/profile/'.$id]); 
                                    } else {
                                        //Save lastjob failed Warning 
                                        Yii::$app->getSession()->setFlash('warning_update', [
                                            'type' => 'success',
                                            'duration' => 12000,
                                            'icon' => 'fa fa-users',
                                            'message' => 'Updated',
                                            'title' => 'Update user infomation',
                                            'positonY' => 'top',
                                            'positonX' => 'left'
                                        ]);
                                        
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
                    Yii::$app->getSession()->setFlash('success_update', [
                        'type' => 'success',
                        'duration' => 12000,
                        'icon' => 'fa fa-users',
                        'message' => 'Updated',
                        'title' => 'Update user infomation',
                        'positonY' => 'top',
                        'positonX' => 'left'
                    ]);
                     return $this->redirect(['/users/profile/'.$id]); 
                } else {
                    Yii::$app->getSession()->setFlash('error_update', 'Create error');
                    return $this->refresh();
                }
            }
        }
        return $this->render('edit', [
            'model' => $model
        ]);
    }
    
    public function actionApplied($id){
        $model = Candidates::findOne(['user_id'=>$id]);
        $query = Applies::find()->where(['candidate_id'=>$model->candidate_id])->orderBy(['time'=>SORT_DESC]);
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize'=>6]);
        $applied_jobs = $query->offset($pagination->offset)
                      ->limit($pagination->limit)
                      ->all();
         return $this->render('applied', [
            'model' => $model,
            'applied_jobs' => $applied_jobs, 
            'pagination'=>$pagination, 
            'total'=>$query->count() 
        ]);
    }
    
    
    public function actionFollowed($id){
         $model = Candidates::findOne(['user_id'=>$id]);
         return $this->render('followed', [
            'model' => $model
        ]);
    }

    public function actionClearImage($id) {
         $model = Candidates::findOne(['user_id'=>$id]);
       
        if ($model === null) {
            \Yii::$app->session->setFlash('error', Yii::t('easyii', 'Not found'));
        } else {
            $model->image = '';
            if ($model->update()) {
                @unlink(Yii::getAlias('@webroot') . $model->image);
                Yii::$app->session->setFlash('success', Yii::t('easyii', 'Image cleared'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('easyii', 'Update error. {0}', $model->formatErrors()));
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
    
    public function actionAccount() {
        $model = Candidates::findOne(['user_id'=>  \Yii::$app->user->id]);
        $account_model = \Yii::createObject(SettingsForm::className());
        
        return $this->render('account',['model'=>$model,'account_model'=>$account_model]);
    }
}