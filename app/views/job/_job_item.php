<?php
  foreach ($jobs as $job): 
    $company = \app\modules\companies\models\Companies::findOne(['company_id'=>$job->company_id]);
?>
<div class="col-md-4 col-sm-6 col-xs-12">
    <div class="featured-image-box">
        <div class="img-box"><img src="<?=  yii\helpers\Url::base()?><?=$company->logo?>" style="max-height: 65px" class="img-responsive center-block" alt=""></div>
        <div class="content-area">
            <div class="">
                <h4><a href="<?=  yii\helpers\Url::to(['job/view/'.$job->slug])?>"> <?=$job->title?> </a></h4>
                <p> <?=$company->company_name?> </p>
            </div>
            <div class="feature-post-meta">
                <a href="#"> 
                    <i class="fa fa-clock-o"></i>
                    days remaining
                      <?php
                      $timeleft = $job->expiration_date - $job->time;
                      $daysleft = round((($timeleft/24)/60)/60); 
                      echo ' : '.$daysleft.' days';
                    ?>
                </a> 
                <?php
                  
                  if ($job->work_time=='fulltime'):
                     
                      $time = 'Full time'; 
                  elseif ($job->work_time=='parttime'):
                      
                      $time = 'Part Time'; 
                  elseif ($job->work_time=='remote'):
                     
                      $time = 'Remote';
                  endif;
                ?>
                <a href="#" class="mata-detail part"><?=$time?></a> </div>
                <div class="feature-post-meta-bottom"> 
                    <span><?=$job->salary?><small>/ month</small></span> 
                    <!--<a href="#" class="apply pull-right"> Apply Now</a> -->
                </div>
        </div>
    </div>
</div>
<?php endforeach;?>