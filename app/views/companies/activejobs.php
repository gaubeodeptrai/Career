<?php
  use yii\helpers\Url;
  use yii\helpers\Html;
  $user_id = Yii::$app->user->id;
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
                    <?php echo $this->render('_menu-company',['user_id'=>  Yii::$app->user->id])?>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12">
                     <?php
                           if (count(Yii::$app->session->getFlash('success_new_job')) > 0 ):
                            ?>
                            <div role="alert" class="alert alert-success alert-dismissible">
                              <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                              <strong>Success! </strong> Add new Job success. 
                            </div>
                            <?php endif;?>
                           
                     <?php
                        if (count(Yii::$app->session->getFlash('success_delete')) > 0 ):
                            ?>
                            <div role="alert" class="alert alert-success alert-dismissible">
                              <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                              <strong>Success! </strong> Job Deleted. 
                            </div>
                            <?php endif;?>
                     <?php
                        if (count(Yii::$app->session->getFlash('success_update_job')) > 0 ):
                            ?>
                            <div role="alert" class="alert alert-success alert-dismissible">
                              <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                              <strong>Success! </strong> Job Updated. 
                            </div>
                            <?php endif;?>
                    
                    
                         <div class="all-jobs-list-box2">
                            <div class="heading-inner first-heading">
                                <p class="title">List Jobs</p>
                            </div>
                           <?php foreach ($jobs as $job):?>  
                            <div class="job-box job-box-2 expire-box ribbon-content">
                                    <div class="job-title-box">
                                        <a href="#">
                                            <div class="job-title"><?=$job->title?></div>
                                        </a>
                                        <a href="#"><span class="comp-name"><?=$model->company_name?> </span></a>
                                        <?php
                                          $color='';
                                          if ($job->work_time=='fulltime'):
                                              $color = 'job-type jt-full-time-color';
                                          elseif ($job->work_time=='parttime'):
                                              $color = 'job-type jt-part-time-color';
                                          elseif ($job->work_time=='remote'):
                                              $color = 'job-type jt-remote-color';
                                          endif;
                                        ?>
                                        <a href="#" class="<?=$color?>">
                                            
                                            <i class="fa fa-clock-o"></i> <?=$job->work_time?>
                                            
                                        </a>
                                    </div>
                                    <div class="expire-job-box">
                                        <span class="expire-date"> This job will Expire on <strong><?=date('d/M/Y', $job->expiration_date);?></strong>
                                            <?php
                                              $timeleft = $job->expiration_date - $job->time;
                                              $daysleft = round((($timeleft/24)/60)/60); 
                                              echo '( '.$daysleft.' days )';
                                            ?>
                                        </span>
                                        <span class="pull-right">
                                            <a href="<?=  Url::to(['companies/editjob/'.$job->item_id])?>" class="btn btn-default"> Edit job</a>
                                                <?= Html::a('Delete job', 
                                                        ['/companies/delete/'.$job->item_id], 
                                                        [
                                                            'class'=>'btn btn-danger',
                                                            'data' => [
                                                                'confirm' => 'Are you sure to detete this job?',
                                                            ],
                                                        ]
                                                ) ?>
                                               
                                   </span>
                                    </div>
                                    <div class="job-salary">
                                        <i class="fa fa-money"></i> <?=$job->salary?>
                                    </div>
                                </div>
                           <?php endforeach;?>     
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