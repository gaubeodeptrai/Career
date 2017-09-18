<?php
  use yii\helpers\Url;
  use yii\bootstrap\ActiveForm;
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
                    <?php echo $this->render('_menu-user',['user_id'=>  Yii::$app->user->id])?>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12">
                     <?php
                             if (count(Yii::$app->session->getFlash('success_cadidate_account')) > 0 ):
                            ?>
                            <div role="alert" class="alert alert-success alert-dismissible">
                              <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                              <strong>Success! </strong> Your account details have been updated
                            </div>
                            <?php endif;?>
                           <div class="heading-inner first-heading">
                               <p class="title">Account Information</p>
                           </div>
                           <?php $form = ActiveForm::begin([
                                'id' => 'registration-form',
                                'enableAjaxValidation' => true,
                                'enableClientValidation' => TRUE,
                                'action'=>  Url::to(['user/settings/account','user_type'=>'candidate']),           
                            ]); ?>
                           <div class="col-md-12 col-sm-12">
                            <?= $form->field($account_model, 'email') ?>
                           </div>
                           <div class="col-md-12 col-sm-12">     
                            <?= $form->field($account_model, 'username') ?>
                           </div>
                           <div class="col-md-12 col-sm-12">     
                            <?= $form->field($account_model, 'new_password')->passwordInput() ?>
                           </div> 
                            <hr/>
                           <div class="col-md-12 col-sm-12">
                            <?= $form->field($account_model, 'current_password')->passwordInput() ?>
                           </div>
               
                       
                    <div class="col-md-12 col-sm-12">
            <button class="btn btn-default pull-right" type="submit"> Save <i class="fa fa-angle-right"></i></button>
        </div>

                <?php ActiveForm::end(); ?>
                          
                </div>
            </div>
        </div>
    </div>
</section>