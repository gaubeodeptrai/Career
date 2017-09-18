<?php
  use yii\helpers\Url;
  use dektrium\user\models\User;
  use yii\bootstrap\ActiveForm;
  use yii\easyii\modules\catalog\models\Item as Jobs;
  use richardfan\widget\JSRegister;
  $this->title = $item->title;
?> 
<section class="job-breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-7 co-xs-12 text-left">
                        <h3><?=$item->title;?> (<?=$item->model->experience?>)</h3>
                    </div>
                    <div class="col-md-6 col-sm-5 co-xs-12 text-right">
                        <div class="bread">
                            <ol class="breadcrumb">
                                <li><a href="<?=  Url::base()?>/">Home</a> </li>
                                <li class="active">job Detail</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="single-job-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="single-job-page-2 job-short-detail">
                                <div class="heading-inner">
                                    <p class="title">Job Description</p>
                                </div>
                                <div class="job-desc job-detail-boxes">
                                    <p>
                                        <?=$item->description?>
                                    </p>
                                    <div class="heading-inner">
                                        <p class="title">Job Requirements</p>
                                    </div>
                                    <?=$item->model->requirement?>

                                    
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="widget">
                                <div class="widget-heading"><span class="title">Short Discription</span></div>
                                <ul class="short-decs-sidebar">
                                    <li>
                                        <div>
                                            <h4>Job Type:</h4></div>
                                        <?php
                                          if ($item->model->work_time=='fulltime'):
                                              
                                              $time = 'Full time'; 
                                          elseif ($item->model->work_time=='parttime'):
                                              
                                              $time = 'Part Time'; 
                                          elseif ($item->model->work_time=='remote'):
                                             
                                              $time = 'Remote';
                                          endif;
                                        ?>
                                        <div><i class="fa fa-bars"></i><?=$time?> </div>
                                    </li>
                                    <li>
                                        <div>
                                            <h4>Job Experience:</h4></div>
                                        <div><i class="fa fa-clock-o"></i><?=$item->model->experience?></div>
                                    </li>
                                    
                                    <li>
                                        <div>
                                            <h4>Posted On:</h4></div>
                                        <div><i class="fa fa-calendar"></i><?=date('d-m-Y', $item->time);?></div>
                                    </li>
                                    <li>
                                        <div>
                                            <h4>Expiration Date:</h4></div>
                                        <div><i class="fa fa-calendar"></i><?=date('d-m-Y', $item->model->expiration_date);?></div>
                                    </li>
                                    
                                    <li>
                                        <div>
                                            <h4>Expected Salary:</h4></div>
                                        <div><i class="fa fa-dollar"></i><?=$item->model->salary?>/month </div>
                                    </li>
                                </ul>
                            </div>
                            <aside>
                                <div class="apply-job">
                                    <?php 
                                if (!Yii::$app->user->isGuest):
                                        $candidate_id = app\modules\candidates\models\Candidates::findOne(['user_id'=>  Yii::$app->user->id])->candidate_id;
                                       
                                    else:
                                        $candidate_id = 0; 
                                       
                                    endif;
                                    $check_apply = app\models\Applies::find()
                                                ->where(['candidate_id'=>$candidate_id])
                                                ->andWhere(['job_id'=>$item->model->item_id])
                                                ->count();
                                    if ($check_apply == 0):
                                        $model = Yii::createObject(app\models\Applies::className());
                                        $form = ActiveForm::begin([
                                        'enableAjaxValidation' => FALSE,
                                        'enableClientValidation' => TRUE, 
                                        'action'=>  Url::to(['apply/index/?page=job_view&slug='.$item->slug])
                                    ]); ?>
                                   <?= $form->field($model, 'candidate_id')->hiddenInput(['value'=> $candidate_id ])->label(false); ?>
                                   <?= $form->field($model, 'job_id')->hiddenInput(['value'=> $item->model->item_id])->label(false); ?>
                                        <button class="btn btn-primary btn-block"><i class="fa fa-upload" style="padding-right: 5px;"></i> Apply For Position</button>
                                        <br/>
                                   <?php ActiveForm::end(); ?>
                               <?php else:?>
                                  <button class="btn btn-primary btn-block" style="font-size: 18px">
                                  <i class="fa fa-check" aria-hidden="true"></i> Applied
                                 </button>
                               <?php endif;?>
                                        
                                
                                <?php
                                   $check_follow = \app\models\Followed::find()
                                                ->where(['candidate_id'=>$candidate_id])
                                                ->andWhere(['company_id'=>$company->company_id])
                                                ->andWhere(['follow_type'=>'candidate-follow']) 
                                                ->count();
                                    if ($check_follow == 0):
                                        $model = Yii::createObject(\app\models\Followed::className());
                                        $form = ActiveForm::begin([
                                        'enableAjaxValidation' => FALSE,
                                        'enableClientValidation' => TRUE, 
                                        'action'=>  Url::to(['follow/index/?page=job_view&slug='.$item->slug])
                                    ]); ?>
                                   <?= $form->field($model, 'candidate_id')->hiddenInput(['value'=> $candidate_id ])->label(false); ?>
                                   <?= $form->field($model, 'company_id')->hiddenInput(['value'=> $company->company_id])->label(false); ?>
                                   <?= $form->field($model, 'follow_type')->hiddenInput(['value'=>'candidate-follow'])->label(false); ?>     
                                         <button class="btn btn-default btn-block"><i class="fa fa-star" style="padding-right: 5px;"></i> Follow this Company</button>    
                                         <br/>
                                   <?php ActiveForm::end(); ?>
                               <?php else:?>
                                 
                                  <button class="btn btn-default btn-block"><i class="fa fa-check" style="padding-right: 5px;"></i> Followed this Company</button>    
                                <br/>        
                                         
                               <?php endif;?>
                               
                                        
                                        
                               
                                 
                                </div>
                                <div class="company-detail">
                                    <div class="company-img">
                                        <a href="<?=  Url::to(['company/view/'.$company->slug])?>">  
                                        <img src="<?=  Url::base()?><?=$company->logo?>" class="img-responsive" alt="">
                                        </a>    
                                    </div>
                                    <div class="company-contact-detail">
                                        <table>
                                            <tr>
                                                <th>Company:</th>
                                                <td> <?=$company->company_name?></td>
                                            </tr>
                                            <tr>
                                                <th>Employees:</th>
                                                <td> <?=$company->company_size?></td>
                                            </tr>
                                            
                                            <tr>
                                                <th>Email:</th>
                                                <td> <?=  User::findOne(['id'=>$company->user_id])->email?></td>
                                            </tr>
                                            <tr>
                                                <th>Phone:</th>
                                                <td> <?=$company->company_tel?></td>
                                            </tr>
                                            <tr>
                                                <th>Website:</th>
                                                <td><?=$company->company_site?></td>
                                            </tr>
                                            <tr>
                                                <th>Address:</th>
                                                <td> <?=$company->company_address?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </aside>
                            <div class="single-job-map">
                                <div id="map-contact">
                                    <?php
                                      echo yii2mod\google\maps\markers\GoogleMaps::widget([
                                           'userLocations' => [
                                            [
                                                'location' => [
                                                    'address' => $company->company_address,
                                                    
                                                ],
                                                'htmlContent' => $company->company_name,
                                            ],
                                        ],
                                        'googleMapsUrlOptions' => [
                                            'key' => 'AIzaSyBdcbfLOinjh8ZXbmNjxwRU8MaItj9dSmw',
                                            'language' => 'en-US',
                                            'version' => '3.1.18',
                                        ],
                                        'googleMapsOptions' => [
                                            'mapTypeId' => 'roadmap',
                                            'tilt' => 5,
                                            'zoom' => 5,
                                        ],
                                    ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="featured-jobs">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="Heading-title-left black small-heading">
                                <h3>Related Jobs</h3>
                            </div>
                        </div>
                        <?php
                          $related_jobs = Jobs::find()
                                  ->where(['status'=>1])
                                  ->andWhere(['category_id'=>$item->category_id])
                                  ->andWhere('item_id <> '.$item->model->item_id)
                                  ->limit(3)
                                  ->all();
                         
                        ?>
                        <?=$this->render('_job_item',['jobs'=>$related_jobs])?>
                       
                    </div>
                </div>
            </div>
        </section>
<?php
   if (count(Yii::$app->session->getFlash('applied')) > 0 ):
?>
    <?php JSRegister::begin();?>
   <script>
            toastr.options = {
                "closeButton": true,
                "positionClass": "toast-bottom-right",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr["success"]("You have successfully applied", "Congratulations!", {
                timeOut: 9000
            })
   </script>
<?php JSRegister::end();?>
<?php Yii::$app->session->remove('applied')?>   
<?php else:
    echo "";
endif;
?>

<?php
   if (count(Yii::$app->session->getFlash('followed')) > 0 ):
?>
    <?php JSRegister::begin();?>
   <script>
            toastr.options = {
                "closeButton": true,
                "positionClass": "toast-bottom-right",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr["success"]("You have successfully followed", "Congratulations!", {
                timeOut: 9000
            })
   </script>
<?php JSRegister::end();?>
<?php Yii::$app->session->remove('followed')?>   
<?php else:
    echo "";
endif;
?>   
