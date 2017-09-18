<?php
  use yii\bootstrap\ActiveForm;
  use yii\helpers\Url;
  use yii\helpers\Html;
  use dektrium\user\models\RegistrationForm;
  
  $base = yii\helpers\Url::base();
  $model = Yii::createObject(RegistrationForm::className());
  $this->title = 'Register';
?>
<section class="login-page-4 parallex">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="login-container">
                            <div class="loginbox">
                                <div class="loginbox-title">Sign Up using social accounts</div>
                                <ul class="social-network social-circle onwhite">
                                    <li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#" class="icoLinkedin" title="Linkedin +"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                                <div class="loginbox-or">
                                    <div class="or-line"></div>
                                    <div class="or">OR</div>
                                </div>
                                
                <?php $form = ActiveForm::begin([
                    'id' => 'registration-form',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => TRUE,
                    'action' => $base.'/user/registration/register',            
                    //'action' => $base.'/user/admin/create',
                ]); ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'username') ?>

                
                    <?= $form->field($model, 'password')->passwordInput() ?>
         
                 <?= $form->field($model, 'user_type')->inline(true)->radioList(['candidate' => 'You are Candidate','business' => 'You are Business', ])->label(false) ?>
                <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-success btn-block']) ?>

                <?php ActiveForm::end(); ?>
                                <div class="loginbox-signup"> Already have account <a href="<?= Url::to(['/users/login'])?>">Sign in</a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>