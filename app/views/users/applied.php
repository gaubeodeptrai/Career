<?php
  use yii\helpers\Url;
  use app\models\Applies;
  use app\modules\companies\models\Companies;
  use yii\easyii\modules\catalog\models\Item as Jobs;
 
  $user_id = Yii::$app->user->id;
  $base = Url::base();
  $this->title = Yii::$app->user->identity->username;
  
  
?>   
        <?php
          echo $this->render('_header',['model'=>$model]);
        ?>
        <section class="dashboard-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <?php echo $this->render('_menu-user',['user_id'=>  Yii::$app->user->id])?>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                           <div class="heading-inner first-heading">
                                <p class="title">Job applied</p>
                            </div>
                            <div class="all-jobs-list-box2">
                              <?php
                                foreach ($applied_jobs as $apply):
                                    $job = Jobs::find()
                                            ->where(['item_id'=>$apply->job_id])
                                            ->andWhere(['status'=>1])
                                            ->one();
                                    $company = Companies::find()
                                        ->where(['company_id'=>$job->company_id])
                                        ->andWhere(['status'=>1])
                                        ->one();
                                    
                                            
                              ?>  
                                <div class="job-box job-box-2">
                                    <div class="col-md-2 col-sm-2 col-xs-12 hidden-xs hidden-sm">
                                        <div class="comp-logo">
                                            <a href="#"><img src="<?=$base?><?=$company->logo?>" class="img-responsive" alt="scriptsbundle"> </a>
                                        </div>

                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-12">
                                        <div class="job-title-box">
                                            <a href="<?=  Url::to(['job/view/'.$job->slug])?>">
                                                <div class="job-title"> <?=$job->title?></div>
                                            </a>
                                            <a href="#"><span class="comp-name"><?=$company->company_address?> </span></a>
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
                                            <p> <?=$job->experience?> experiences </p> 
                                        </div>
                                      
                                    </div>
                                    <div class="job-salary">
                                        <i class="fa fa-money"></i> <?=$job->salary?>
                                        
                                    </div>
                                </div>
                               <?php
                               endforeach;
                               ?>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                               <div class="pagination-box clearfix">
                                    <?php
                                        echo \yii\widgets\LinkPager::widget([
                                          'pagination' => $pagination,
                                        ]);
                                      ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>