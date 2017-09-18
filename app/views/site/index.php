<?php

    use yii\helpers\Url;
    use yii\easyii\modules\catalog\models\Item as Jobs;
    use richardfan\widget\JSRegister;
    $basePathToTemplate = Url::base(true).'/app/media/template/';
    $baseUrl = Url::base(true);
    $this->title = 'Carrer';  
    
    $jobs_by_category = Jobs::find()->where(['status'=>1])->orderBy(['category_id'=>SORT_ASC])->limit(5)->all();
    $jobs_by_lastest = Jobs::find()->where(['status'=>1])->orderBy(['time'=>SORT_DESC])->limit(5)->all();
    $jobs_by_time = Jobs::find()->where(['status'=>1])->orderBy(['work_time'=>SORT_DESC])->limit(5)->all();
    $job_featured = Jobs::find()->where(['status'=>1])->orderBy(['time'=>SORT_DESC])->limit(3)->all();
    
?>
  <section class="main-section parallex">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-sm-12 col-md-offset-1 col-xs-12 nopadding">
                    <div class="search-form-contaner">
                        <h1 class="search-main-title"> Ten million success stories. Start yours today </h1>
                         <?=$this->render('_search_form',[]);?>
                    </div>
                </div>
            </div>
        </div>
    </section>
  <section class="cat-tabs cat-tab-index-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="cat-title">Browse Jobs</div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading"> 
                                <!-- Tabs -->
                                <ul class="nav panel-tabs">
                                    <li class="active"> <a href="#job_category" data-toggle="tab"><i class="icofont icon-ribbon"></i><span class="hidden-xs hidden-sm">By Job Categories</span></a> </li>
                                    <li> <a href="#lastest_jobs" data-toggle="tab"><i class="icofont icon-layers"></i><span class="hidden-xs hidden-sm">By Latest Jobs</span></a> </li>
                                    <li > <a href="#job_time" data-toggle="tab"><i class="icofont icon-global"></i><span class="hidden-xs hidden-sm">By Work Time</span></a> </li>
                         
                                  
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane active tab-pane animated fadeInUp" id="job_category" >
                                    <?=$this->render('_jobs',[
                                        
                                        'basePathToTemplate'=>$basePathToTemplate,
                                        'jobs' => $jobs_by_category
                                    ])?>
                                </div>
                                <div class="tab-pane animated fadeInDown" id="lastest_jobs">
                                   <?=$this->render('_jobs',[
                                        
                                        'basePathToTemplate'=>$basePathToTemplate,
                                        'jobs' => $jobs_by_lastest
                                    ])?>
                                </div>
                                <div class="tab-pane animated fadeInLeft" id="job_time">
                                    <?=$this->render('_jobs',[
                                       
                                        'basePathToTemplate'=>$basePathToTemplate,
                                        'jobs' => $jobs_by_time
                                    ])?>
                                </div>
                             
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="facts">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-3 col-xs-6">
                    <div class="fact-box">
                        <div class="single-facts-area">
                            <div class="facts-icon"> <i class="icon-megaphone"></i> </div>
                            <span class="counter">
                                <?php
                                 $count_job = Jobs::find()->count();
                                 echo $count_job;
                                ?>
                            </span>
                            <h3>Jobs</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-xs-6">
                    <div class="fact-box">
                        <div class="single-facts-area">
                            <div class="facts-icon"> <i class="icon-document"></i> </div>
                            <span class="counter">
                               <?php
                                $count_resume = app\models\Resume::find()->count();
                                echo $count_resume;
                               ?> 
                            </span>
                            <h3> Resume </h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-xs-6">
                    <div class="fact-box">
                        <div class="single-facts-area">
                            <div class="facts-icon"> <i class="icon-profile-male"></i> </div>
                            <span class="counter">
                                <?php
                                 $count_user = \dektrium\user\models\User::find()
                                         ->where('admin_level = 10') 
                                         ->count();
                                 echo $count_user;
                                ?>
                            </span>
                            <h3>Members</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-xs-6">
                    <div class="fact-box">
                        <div class="single-facts-area">
                            <div class="facts-icon"> <i class="icon-toolbox"></i> </div>
                            <span class="counter">
                               <?php
                                 $count_company = app\modules\companies\models\Companies::find()->count();
                                 echo $count_company
                               ?> 
                            </span>
                            <h3>Company</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="featured-jobs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="Heading-title black">
                            <h1>Featured Jobs</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium</p>
                        </div>
                    </div>
                     
                         <?php   echo $this->render('/job/_job_item',['jobs'=>$job_featured]); ?>
                       
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    	<div class="load-more-btn">
                            <a href="<?=  Url::to(['job/'])?>">  
                              <button class="btn-default"> View All <i class="fa fa-angle-right"></i> </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
        
    <?=$this->render('_blog',['basePathToTemplate'=>$basePathToTemplate])?>
    <?=$this->render('_client',['basePathToTemplate'=>$basePathToTemplate])?>

    
<?php
   if (count(Yii::$app->session->getFlash('applied')) > 0 ):
?>
    <?php JSRegister::begin();?>
   <script>
            toastr.options = {
                "closeButton": true,
                "positionClass": "toast-bottom-right",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr["success"]("You have successfully applied", "Congratulations!", {
                timeOut: 9000
            })
   </script>
<?php JSRegister::end();?>
<?php Yii::$app->session->remove('applied')?>   
<?php else:
    echo "";
endif;
?>