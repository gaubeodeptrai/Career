<?php
  use dektrium\user\models\LoginForm;
  use yii\bootstrap\ActiveForm;
  use yii\helpers\Url;
  use yii\helpers\Html;
  $base = Url::base();
  $this->title = 'Login';
?>
<div class="page category-page">
       
        <section class="login-page-4 parallex">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="login-container">
                            <div class="loginbox">
                                <img src="<?=$base?>/images/logo.png" alt="logo" class="img-responsive center-block">
                                <div class="loginbox-title">sign in using social accounts</div>
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
                               
                                
                                
                                 <?php $model = Yii::createObject(LoginForm::className());?>
           <?php $form = ActiveForm::begin([
                     'action' => $base.'/user/security/login',
                     'enableAjaxValidation' => true,
                    'enableClientValidation' => true,
                    'validateOnBlur' => true,
                    'validateOnType' => TRUE,
                    'validateOnChange' => true,
                ]) ?>

                    <?= $form->field($model, 'login');?>
                    <?= $form->field($model,'password')->passwordInput()?>
                    <?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '3']) ?>
                    <?= Html::submitButton(
                        Yii::t('user', 'Sign in'),
                        ['class' => 'btn btn-primary btn-block', 'tabindex' => '4']
                    ) ?>

                <?php ActiveForm::end(); ?>
        <p class="text-center">
                <?= Html::a(Yii::t('user', 'Didn\'t receive confirmation message?'), ['/user/registration/resend']) ?>
            </p>
            <p class="text-center">
                <?=Html::a(
                                    Yii::t('user', 'Forgot password?'),
                                    ['/user/recovery/request']
                                    
                                )?>
            </p>
             <p class="text-center">
                <?php //echo Html::a(Yii::t('user', 'Don\'t have an account? Sign up!'), ['/user/registration/register']) ?>
                 <a href="<?=$base?>/users/register" class="fancybox"><?=Yii::t('user', 'Don\'t have an account? Sign up!')?></a>
            </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <a href="#" class="scrollup"><i class="fa fa-chevron-up"></i></a>

        

    </div>