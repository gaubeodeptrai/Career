<?php
  use yii\helpers\Url;
  use app\modules\companies\models\Companies;
  use yii\easyii\modules\catalog\models\Item;
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
                                <p class="title">My Followings</p>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                                <div class="company-list">
                                   <?php
                                     $follows = \app\models\Followed::find()
                                             ->where(['candidate_id'=>$model->candidate_id])
                                             ->all();
                                     foreach ($follows as $item):
                                          $company = Companies::find()
                                            ->where(['company_id'=>$item->company_id])
                                            ->andWhere(['status'=>1])
                                            ->one();
                                         $total_job = Item::find()->where(['company_id'=>$company->company_id])->count();
                                   ?> 
                                    <div class="company-box">
                                        <div class="col-md-2 col-sm-2 col-xs-12 nopadding">
                                            <a href="#">
                                                <div class="company-list-img"><img src="<?=$base?><?=$company->logo?>" alt="" class="img-responsive"></div>
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12 nopadding">
                                            <div class="company-list-name">
                                                <a href="#"><h5><?=$company->company_name?></h5> </a>
                                                <p><?=$company->company_address?></p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2 col-sm-2 col-xs-6 nopadding">
                                            <span class="pull-right">Total Jobs <span class="badge">(<?=$total_job?>)</span></span>
                                        </div>
                                    </div>
                                   <?php endforeach;?>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </section>