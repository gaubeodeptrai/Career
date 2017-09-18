<?php
  use yii\helpers\Url;
  use dektrium\user\models\User;
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
                             if (count(Yii::$app->session->getFlash('success_edit')) > 0 ):
                            ?>
                            <div role="alert" class="alert alert-success alert-dismissible">
                              <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                              <strong>Success! </strong> Company profile has been update 
                            </div>
                            <?php endif;?>
                            <div class="heading-inner first-heading">
                                <p class="title">Followed</p>
                            </div>
                            <div class="follower-section">
                                <div class="" id="followers">

                                    <?php
                                     $follow = app\models\Followed::find()->where('company_id = '.$model->company_id)
                                             ->andWhere(['follow_type'=>'company-follow'])
                                             ->all();                                                 
                                    ?>
                                    <?php 
                                      foreach ($follow as $item):

                                        ?>

                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="list-group-item">
                                        <div class="media">
                                            <div class="media-left">
                                                <a class="avatar avatar-online" href="javascript:void(0)">
                                                    <img src="<?=  Url::base()?><?=$item->candidate->image?>" class="img-responsive" alt="">
                                                    <i></i>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="pull-right">
                                                    <button type="button" class="btn btn-default btn-sm">Hire</button>
                                                </div>
                                                <div><a class="name" href="<?=  Url::to(['candidate/view/'.$item->candidate->slug])?>">
                                                      <?= $item->candidate->fullname?>
                                                    </a></div>
                                                <small>
                                                   <?=  User::findIdentity($item->candidate->user_id)->email?> 
                                                </small>
                                            </div>
                                        </div>
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