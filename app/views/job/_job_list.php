<?php
  use yii\helpers\Url;
  use app\modules\companies\models\Companies;
  use yii\bootstrap\ActiveForm;
?>
<div class="all-jobs-list-box">
    <?php 
      foreach ($jobs as $job):
          $company = Companies::find()
            ->where(['company_id'=>$job->company_id])
            ->andWhere(['status'=>1])
            ->one();
    ?>
    <div class="job-box">
        <div class="col-md-2 col-sm-2 col-xs-12 hidden-xs hidden-sm">
            <div class="comp-logo">
                <a href="#"> <img src="<?=  Url::base()?><?=$company->logo?>" class="img-responsive" alt="<?=$company->company_name?>""></a>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 nopadding">
            <div class="job-title-box">
                <a href="<?=  Url::to(['job/view/'.$job->slug])?>">
                    <div class="job-title"> <?=$job->title?></div>
                </a>
                <a href="#"><span class="comp-name"><?=$company->company_name?></span></a>
            </div>
        </div>

        <div class="col-md-2 col-sm-3 col-xs-6">
             <?php
              $color='';
              if ($job->work_time=='fulltime'):
                  $color = 'job-type jt-full-time-color';
                  $time = 'Full time'; 
              elseif ($job->work_time=='parttime'):
                  $color = 'job-type jt-part-time-color';
                  $time = 'Part Time'; 
              elseif ($job->work_time=='remote'):
                  $color = 'job-type jt-remote-color';
                  $time = 'Remote';
              endif;
            ?>
            <a href="#" class="<?=$color?>">

                <i class="fa fa-clock-o"></i> <?=$time?>

            </a>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-12 nopadding">
           <?php 
                    if (!Yii::$app->user->isGuest):
                        $candidate_id = app\modules\candidates\models\Candidates::findOne(['user_id'=>  Yii::$app->user->id])['candidate_id'];
                    else:
                        $candidate_id = 0; 
                    endif;
                        $check_apply = app\models\Applies::find()
                                ->where(['candidate_id'=>$candidate_id])
                                ->andWhere(['job_id'=>$job->item_id])
                                ->count();
                    if ($check_apply == 0):
                        $model = Yii::createObject(app\models\Applies::className());
                        $form = ActiveForm::begin([
                        'enableAjaxValidation' => FALSE,
                        'enableClientValidation' => TRUE, 
                        'action'=>  Url::to(['apply/index/?page=job&slug='.$job->slug])
                    ]); ?>
                   <?= $form->field($model, 'candidate_id')->hiddenInput(['value'=> $candidate_id ])->label(false); ?>
                   <?= $form->field($model, 'job_id')->hiddenInput(['value'=> $job->item_id])->label(false); ?>
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