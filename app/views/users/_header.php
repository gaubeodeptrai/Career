<?php
  use yii\helpers\Url;
?> 
<section class="dashboard parallex">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                        <div class="dashboard-header">
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <div class="user-avatar ">
                                    <img src="<?=  Url::base()?><?=$model->image?>" alt="" class="img-responsive center-block "></a>
                                     <h3><?=$model->fullname?></h3>
                                     <?php if ($model->getLastJob()->exists()):?>
                                     <span style="color: white"><?=$model->lastJob->work_at?></span> 
                                     <?php endif;?>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="rad-info-box rad-txt-success">
                                    <i class="icon icon-presentation"></i>
                                    <span class="title-dashboard">Followings</span>
                                    <span class="value"><span>
                                        <?php
                                 echo \app\models\Followed::find()->where(['candidate_id'=>$model->candidate_id])->count();
                                 ?>
                                        </span></span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="rad-info-box rad-txt-success">
                                    <i class="icon icon-aperture"></i>
                                    <span class="title-dashboard">Jobs Applied</span>
                                    <span class="value"><span>
                                       <?php
                                         $total_applied = app\models\Applies::find()
                                                 ->where(['candidate_id'=>$model->candidate_id])
                                                 ->count();
                                         echo $total_applied;
                                       ?>    
                                    </span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>