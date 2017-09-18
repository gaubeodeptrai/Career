<?php
use yii\helpers\Url;
use app\modules\candidates\models\Candidates;
use app\modules\companies\models\Companies;
$basePathToTemplate = Url::base(true).'/app/media/template/';      
?>
<?php $this->beginContent('@app/views/layouts/base.php'); ?>
<div class="page">
    <!--<div id="spinner">
        <div class="spinner-img"> <img alt="Opportunities Preloader" src="images/loader.gif" />
            <h2>Please Wait.....</h2>
        </div>
    </div>-->
    <nav id="menu-1" class="mega-menu fa-change-black"> 
        <section class="menu-list-items container"> 
            <ul class="menu-logo">
                <li> <a href="<?=Url::to(['/'])?>"> <img src="<?= $basePathToTemplate;?>images/logo.png" alt="logo" class="img-responsive"> </a> </li>
            </ul>
            <ul class="menu-links pull-right">
                <li  class="active"> <a href="<?=Url::to(['/'])?>"> Home </a></li>
                <?php //if (Yii::$app->user->isGuest || Yii::$app->user->identity->user_type == 'candidate'):?>
                 <li><a href="<?=  Url::to(['job/'])?>"> All Jobs </a> </li>
                <?php //else:?>
                 <li><a href="<?=  Url::to(['candidate/'])?>"> All Candidates </a> </li>
                <?php //endif;?> 
                <li><a href="<?=  Url::to(['about/'])?>">About Us</a> </li>
                <li><a href="<?=  Url::to(['contact/'])?>">Contact</a> </li>
                
                <li>
                    <?php
                      if (!Yii::$app->user->isGuest):
                        if (Yii::$app->user->identity->user_type == 'candidate'):
                           
                          $image_user = Candidates::findOne(['user_id'=>  Yii::$app->user->id])->image; 
                          $profile = 'My Profile';
                          $link_profile = '/users/profile/';
                          $job = 'Jobs Applied';
                          $job_link = '/users/applied/';
                          $link_account = '/users/account';
                          if (!$image_user):
                            $image_user = '/images/candidate.jpg';
                          endif;   
                        elseif (Yii::$app->user->identity->user_type == 'business'):
                            $profile = 'Company Profile';
                            $link_profile = '/companies/profile/';
                            $link_account = '/companies/account';
                            
                             $job = 'Post New Job';
                             $job_link = '/companies/newjob/';
                          $image_user = Companies::findOne(['user_id'=>  Yii::$app->user->id])->logo; 
                        if (!$image_user):
                            $image_user = '/images/company.png';
                          endif;    
                        endif;
                      
                    ?>
                       <li class="profile-pic">
                           <a href="javascript:void(0)"> <img src="<?=  Url::base()?><?=$image_user?>" alt="user-img" class="img-circle" width="36">
                               <span class="hidden-xs hidden-sm"><?=  Yii::$app->user->identity->username?>  </span>
                               <i class="fa fa-angle-down fa-indicator"></i> 
                           </a>
                        
                        <ul class="drop-down-multilevel left-side">
                            <li>
                                <a href="<?= Url::to([$link_profile.Yii::$app->user->id])?>">
                                  <i class="fa fa-user"></i> <?=$profile?>
                                </a>
                            </li>
                            <li>
                                <a href="<?= Url::to([$job_link.Yii::$app->user->id])?>">
                                    <i class="fa fa-mail-forward"></i> <?=$job?>
                                </a>
                            </li>
                            <li>
                                <a href="<?=  Url::to([$link_account]) ?>">
                                    <i class="fa fa-gear"></i> Account Setting
                                </a>
                            </li>
                            <li>
                                <a href="<?= Url::to(['/user/security/logout'])?>" data-method="post">
                                    <i class="fa fa-power-off"></i> Logout
                                </a>
                            </li>
                        </ul>
                        
                           
                      </li>
                     
                   <?php else:?>
                       <li class="no-bg login-btn-no-bg"><a href="<?= Url::to(['/users/login'])?>" class="login-header-btn"><i class="fa fa-sign-in"></i> Log in</a></li>
                       <li class="no-bg"><a href="<?= Url::to(['/users/register'])?>" class="p-job"><i class="fa fa-plus-square"></i> Register</a></li>
                   <?php endif;?>    
                </li>
            </ul>
        </section>
    </nav>
    
    <?= $content;?>
    
    <div class="fixed-footer">
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-3 col-xs-12">
                        <div class="footer_block"> <a href="index-2.html" class="f_logo"><img src="<?= $basePathToTemplate;?>images/logo.png" class="img-responsive" alt="logo"></a>
                            <p>Aoluptas sit aspernatur aut odit aut fugit, sed elits quias horisa hinoe magni  magni dolores eos qui ratione volust luptatem sequised .</p>
                            <div class="social-bar">
                                <ul>
                                    <li><a class="fa fa-twitter" href="#"></a></li>
                                    <li><a class="fa fa-pinterest" href="#"></a></li>
                                    <li><a class="fa fa-facebook" href="#"></a></li>
                                    <li><a class="fa fa-behance" href="#"></a></li>
                                    <li><a class="fa fa-instagram" href="#"></a></li>
                                    <li><a class="fa fa-linkedin" href="#"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2 col-xs-12">
                        <div class="footer_block">
                            <h4>Hot Links</h4>
                            <ul class="footer-links">
                                <li> <a href="#">Home</a> </li>
                                <li> <a href="#">About Us</a> </li>
                                <li> <a href="#">Privacy</a> </li>
                                <li> <a href="#">Contact Us</a> </li>
                                <li> <a href="#">Term & Conditions</a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-xs-12">
                        <div class="footer_block dark_gry">
                            <h4>Recent Posts</h4>
                            <ul class="recentpost">
                                <li> <span><a class="plus" href="#"><img src="<?= $basePathToTemplate;?>images/footer/1.png" alt="" /><i>+</i></a></span>
                                    <p><a href="#">Fusce gravida tortor felis, ac dictum risus sagittis</a></p>
                                    <h3>Sep 15, 2016</h3>
                                </li>
                                <li> <span><a class="plus" href="#"><img src="<?= $basePathToTemplate;?>images/footer/2.png" alt="" /><i>+</i></a></span>
                                    <p><a href="#">Fusce gravida tortor felis, ac dictum risus sagittis</a></p>
                                    <h3>Fab 10, 2016</h3>
                                </li>
                                <li> <span><a class="plus" href="#"><img src="<?= $basePathToTemplate;?>images/footer/3.png" alt="" /><i>+</i></a></span>
                                    <p><a href="#">Fusce gravida tortor felis, ac dictum risus sagittis</a></p>
                                    <h3>Fab 10, 2016</h3>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-xs-12">
                        <div class="footer_block">
                            <h4>Contact Information</h4>
                            <ul class="personal-info">
                                <li><i class="fa fa-map-marker"></i> 3rd Floor,Link Arcade Model Town, BBL, USA.</li>
                                <li><i class="fa fa-envelope"></i> Support@domain.com</li>
                                <li><i class="fa fa-phone"></i> (0092)+ 124 45 78 678 </li>
                                <li><i class="fa fa-clock-o"></i> Mon - Sun: 8:00 - 16:00</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <section class="footer-bottom-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="footer-bottom">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p>Copyright ©2017 Career Builder  
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 hidden-xs hidden-sm">
                                    <ul class="footer-menu">
                                        <li> <a href="#">Jobs in australia</a> </li>
                                        <li> <a href="#">Jobs in malaysia</a> </li>
                                        <li> <a href="#">Jobs in england</a> </li>
                                        <li> <a href="#">Jobs in saudi arabia</a> </li>
                                        <li> <a href="#">Jobs in south africa</a> </li>
                                        <li> <a href="#">Jobs in saudi Pakistan</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <a href="#" class="scrollup"><i class="fa fa-chevron-up"></i></a>
</div>
<?php $this->endContent(); ?>
