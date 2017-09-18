<?php
  use yii\helpers\Url;
  $base = Url::base(); 
?> 
<section class="company-dashboard">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="dashboard-header">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="dashboard-header-logo-box">
                            <div class="company-logo">
                               <?php if ($model->logo):?> 
                                <img src="<?=$base?><?=$model->logo?>" alt="" class="img-responsive center-block ">
                               <?php else: ?>
                                <img src="<?=$base?>/images/company.png" alt="" class="img-responsive center-block ">
                               <?php endif;?> 
                            </div>
                            <h3><?=$model->company_name?></h3>
                            <p><?=$model->company_address?></p>
                            <ul class="social-links list-inline">
                                <li> <a href="<?=$model->facebook?>" target="_blank"><i class="icon-facebook"></i></a></li>
                                <li> <a href="<?=$model->linkedin?>" target="_blank"><i class="icon-twitter"></i></a></li>
                                <li> <a href="<?=$model->twitter?>" target="_blank"><i class="icon-googleplus"></i></a></li>
                                <li> <a href="<?=$model->googleplus?>" target="_blank"><i class="icon-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="rad-info-box">
                            <i class="icon icon-profile-male"></i>
                            <span class="title-dashboard">Followers</span>
                            <span class="value">
                                <span>
                                    <?=
                                    app\models\Followed::find()
                                       ->where(['company_id'=>$model->company_id])
                                       ->andWhere(['follow_type'=>'company-follow'])
                                       ->count();
                                     ?>
                                </span>
                            </span>
                        </div>
                        <div class="rad-info-box">
                            <i class="icon icon-presentation"></i>
                            <span class="title-dashboard">Jobs Posted</span>
                            <span class="value">
                                <span>
                                       <?=  
                                         yii\easyii\modules\catalog\models\Item::find()
                                              ->where(['status'=>1])
                                              ->andWhere(['company_id'=>$model->company_id])
                                              ->count()
                                       ?>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="rad-info-box">
                            <i class="icon icon-documents"></i>
                            <span class="title-dashboard">New resume</span>
                            <span class="value"><span> 0</span></span>
                        </div>
                        <div class="rad-info-box rad-txt-success">
                            <i class="icon icon-briefcase"></i>
                            <span class="title-dashboard">Hired</span>
                            <span class="value"><span> 0</span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>