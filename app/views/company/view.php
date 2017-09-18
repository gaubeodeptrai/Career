<?php
  use yii\helpers\Url;
  use yii\bootstrap\ActiveForm;
  use richardfan\widget\JSRegister;
  use yii\easyii\modules\catalog\models\Item as Jobs;
  $this->title = $company->model->company_name
?>
<section class="job-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-7 co-xs-12 text-left">
                <h3><?=$company->model->company_name?></h3>
            </div>
            <div class="col-md-6 col-sm-5 co-xs-12 text-right">
                <div class="bread">
                    <ol class="breadcrumb">
                        <li><a href="<?=  Url::base()?>/">Home</a> </li>
                        <li class="active"><?=$company->model->company_name?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="single-job-section single-job-section-2">
    <div class="container">
        <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="single-job-detail-box" style="margin-bottom: 30px">
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="company-img">
                            <img src="<?=  Url::base()?><?=$company->model->logo?>" alt="">
                        </div>
                        <div class="job-detail-2">
                            <h2><?=$company->model->company_name?></h2>

                            <div class="b-socials full-socials" style="margin-top: 0px">
                               <ul class="list-unstyled">
                                  <li><a href="<?=$company->model->twitter?>"><i class="fa fa-twitter fa-fw"></i>Tweet</a></li>
                                  <li><a href="<?=$company->model->linkedin?>"><i class="fa fa-linkedin fa-fw"></i>Linkedin</a></li>
                                  <li><a href="<?=$company->model->googleplus?>"><i class="fa fa-google-plus fa-fw"></i>Google+</a></li>
                                  <li><a href="<?=$company->model->facebook?>"><i class="fa fa-facebook fa-fw"></i>Facebook</a></li>
                               </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="apply-job">
                            <?php
                             if (!Yii::$app->user->isGuest):
                                $candidate_id = app\modules\candidates\models\Candidates::findOne(['user_id'=>  Yii::$app->user->id])->candidate_id;

                            else:
                                $candidate_id = 0; 

                            endif;
                            $check_follow = \app\models\Followed::find()
                                        ->where(['candidate_id'=>$candidate_id])
                                        ->andWhere(['company_id'=>$company->model->company_id])
                                        ->andWhere(['follow_type'=>'candidate-follow']) 
                                        ->count();
                            if ($check_follow == 0):
                                $model = Yii::createObject(\app\models\Followed::className());
                                $form = ActiveForm::begin([
                                'enableAjaxValidation' => FALSE,
                                'enableClientValidation' => TRUE, 
                                'action'=>  Url::to(['follow/index/?page=company_view&slug='.$company->slug])
                            ]); ?>
                           <?= $form->field($model, 'candidate_id')->hiddenInput(['value'=> $candidate_id ])->label(false); ?>
                           <?= $form->field($model, 'company_id')->hiddenInput(['value'=> $company->model->company_id])->label(false); ?>
                           <?= $form->field($model, 'follow_type')->hiddenInput(['value'=>'candidate-follow'])->label(false); ?>     
                                 <button class="btn btn-default btn-block"><i class="fa fa-star" style="padding-right: 5px; "></i> Follow this Company</button>    
                                 <br/>
                           <?php ActiveForm::end(); ?>
                       <?php else:?>

                          <button class="btn btn-default btn-block"><i class="fa fa-check" style="padding-right: 5px;"></i> Followed this Company</button>    
                        <br/>        

                       <?php endif;?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="single-job-page-2 job-short-detail">
                        <div class="heading-inner">
                            <p class="title">Contact</p>
                        </div>
                        <div class="job-desc job-detail-boxes">
                            <ul class="desc-points" style="font-size: 16px; margin-left: 20px">
                                    <li>
                                        <i class="fa fa-envelope"></i> 
                                        <a href="mailto:<?=  \dektrium\user\models\User::findOne(['id'=>$company->model->user_id])->email?>">
                                    <?=  \dektrium\user\models\User::findOne(['id'=>$company->model->user_id])->email?>
                                       </a>
                                    </li>
                                    <li><i class="fa fa-phone"></i> <?=$company->model->company_tel?></li>
                                    <li><i class="fa fa-building-o"></i> <?=$company->model->business?></li>
                                    <li><i class="fa fa-users"></i> <?=$company->model->company_size?></li>
                                    <li><i class="fa fa-location-arrow"></i><?=$company->model->company_address?></li>
                                    <li>
                                        <i class="fa fa-internet-explorer"></i> 
                                        <a href="<?=$company->model->company_site?>" target="_blank"> 
                                         <?=$company->model->company_site?>
                                        </a>    
                                    </li>
                                    </ul>

                            <div class="heading-inner">
                                <p class="title">About us:</p>
                            </div>
                            <?=$company->model->about?>


                        </div>

                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="widget">
                        <div class="widget-heading"><span class="title">Lastest Jobs from this company</span></div>
                        <ul class="related-post">
                            <?php
                             $jobs = Jobs::find()->where(['company_id'=>$company->model->company_id])
                                     ->andWhere(['status'=>1])->limit(8)
                                     ->all();
                            ?>
                            <?php foreach ($jobs as $job):?>
                            <li>
                                <a href="<?=  Url::to(['job/view/'.$job->slug])?>"><?=$job->title?> </a>
                                <span><i class="fa fa fa-money"></i><?=$job->salary?></span>
                                <span><i class="fa fa-calendar"></i><?= date('d-m-Y', $job->time);?> - <?= date('d-m-Y', $job->expiration_date);?> </span>
                            </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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