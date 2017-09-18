<?php
  use app\modules\companies\models\Companies;
  use yii\helpers\Url;
  use app\modules\nationals\models\Nationals;
  use yii\bootstrap\ActiveForm;
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <?php 
       foreach ($jobs as $item):
        $company = Companies::findOne(['company_id'=>$item->company_id]);
        $loction = Nationals::findOne(['national_id'=>$company->location_id])
    ?>
    <div class="job-box">
        <div class="col-md-2 col-sm-2 col-xs-12 nopadding hidden-xs hidden-sm">
            <div class="comp-logo"> <img src="<?=  Url::base()?><?=$company->logo?>" class="img-responsive" alt="scriptsbundle"> </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="job-title-box"> 
                <div class="job-title"> 
                    <a href="<?=  Url::to(['job/view/'.$item->slug])?>">  
                      <?=$item->title?>
                    </a>     
                </div>
                 <a href="#"><span class="comp-name"><?=$company->company_name?></span></a> </div>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-6">
            <div class="job-location"> <i class="fa fa-location-arrow"></i> <?=$loction->title?> </div>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-6">
            <?php
                                          $color='';
                                          if ($item->work_time=='fulltime'):
                                              $color = 'job-type jt-full-time-color';
                                              $time = 'Full time'; 
                                          elseif ($item->work_time=='parttime'):
                                              $color = 'job-type jt-part-time-color';
                                              $time = 'Part Time'; 
                                          elseif ($item->work_time=='remote'):
                                              $color = 'job-type jt-remote-color';
                                              $time = 'Remote';
                                          endif;
                                        ?>
            <div class="<?=$color?>"> <i class="fa fa-clock-o"></i> <?=$time?> </div>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-12">
           
             <?php 
                    if (!Yii::$app->user->isGuest):
                        $candidate_id = app\modules\candidates\models\Candidates::findOne(['user_id'=>  Yii::$app->user->id])->candidate_id;
                    else:
                        $candidate_id = 0; 
                    endif;
                        $check_apply = app\models\Applies::find()
                                ->where(['candidate_id'=>$candidate_id])
                                ->andWhere(['job_id'=>$item->item_id])
                                ->count();
                    if ($check_apply == 0):
                        $model = Yii::createObject(app\models\Applies::className());
                        $form = ActiveForm::begin([
                        'enableAjaxValidation' => FALSE,
                        'enableClientValidation' => TRUE, 
                        'action'=>  Url::to(['apply/index/?page=home'])
                    ]); ?>
                   <?= $form->field($model, 'candidate_id')->hiddenInput(['value'=> $candidate_id ])->label(false); ?>
                   <?= $form->field($model, 'job_id')->hiddenInput(['value'=> $item->item_id])->label(false); ?>
                <button class="btn btn-primary btn-custom" type="submit">Apply Now</button>
                <?php ActiveForm::end(); ?>
                  <?php else:?>
                   <button class="btn btn-primary btn-custom">
                       <i class="fa fa-check" aria-hidden="true"></i> Applied
                   </button>
                  <?php endif;?>
                   
        </div>
    </div>
   <?php endforeach;?>
</div>