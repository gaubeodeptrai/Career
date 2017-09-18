<?php
   use yii\helpers\Url;
   use yii\easyii\models\TagAssign;
   use app\models\Resume;
   use yii\easyii\models\Tag;
   use yii\bootstrap\ActiveForm;
   use richardfan\widget\JSRegister;
   $this->title = 'Candidate - '.$item->fullname;
?>
<section class="job-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-7 co-xs-12 text-left">
                <h3><?=$item->fullname?> - <?=$category_job->title?></h3>
            </div>
            <div class="col-md-6 col-sm-5 co-xs-12 text-right">
                <div class="bread">
                    <ol class="breadcrumb">
                        <li><a href="<?=  Url::base()?>/">Home</a> </li>
                        <li><a href="<?=  Url::base()?>/candidate">Candidates</a></li>
                        <li class="active"><?=$item->fullname?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="light-grey">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="col-md-4 col-sm-4 col-xs-12 col-md-push-8">
                    <div class="about-image">
                       
                         <?php
                                if ($item->image):
                                ?>
                                <img src="<?=  Url::base()?><?=$item->image?>" alt="<?=$item->fullname?>" class="img-responsive" />
                                <?php elseif($item->sex=='male'):?>
                                  <img src="<?=  Url::base()?>/images/no_person.png" alt="<?=$item->fullname?>" class="img-responsive" />
                                <?php elseif($item->sex=='female'):?>
                                  <img src="<?=  Url::base()?>/images/no_person_femail.png" alt="<?=$item->fullname?>" class="img-responsive" />
                                <?php else:?>
                                  <img src="<?=  Url::base()?>/images/no_person.png" alt="<?=$item->fullname?>" class="img-responsive" />  
                                <?php endif;?>  
                    </div>
                    <br/><br/>
                        <button class="btn btn-primary btn-block"><i class="fa fa-location-arrow" style="padding-right: 5px;"></i> Hire this Candidate</button>
                        
                        
                        <?php
                             if (!Yii::$app->user->isGuest):
                                $company_id = \app\modules\companies\models\Companies::findOne(['user_id'=>  Yii::$app->user->id])->company_id;

                            else:
                                $company_id = 0; 

                            endif;
                            $check_follow = \app\models\Followed::find()
                                        ->where(['candidate_id'=>$item->candidate_id])
                                        ->andWhere(['company_id'=>$company_id])
                                        ->andWhere(['follow_type'=>'company-follow']) 
                                        ->count();
                            if ($check_follow == 0):
                                $model = Yii::createObject(\app\models\Followed::className());
                                $form = ActiveForm::begin([
                                'enableAjaxValidation' => FALSE,
                                'enableClientValidation' => TRUE, 
                                'action'=>  Url::to(['follow/index/?page=candidate_view&slug='.$item->slug])
                            ]); ?>
                           <?= $form->field($model, 'candidate_id')->hiddenInput(['value'=> $item->candidate_id ])->label(false); ?>
                           <?= $form->field($model, 'company_id')->hiddenInput(['value'=> $company_id])->label(false); ?>
                           <?= $form->field($model, 'follow_type')->hiddenInput(['value'=>'company-follow'])->label(false); ?>     
                                 <button class="btn btn-default btn-block"><i class="fa fa-star" style="padding-right: 5px; "></i> Follow this Candidate</button>    
                                 <br/>
                           <?php ActiveForm::end(); ?>
                       <?php else:?>

                          <button class="btn btn-default btn-block"><i class="fa fa-check" style="padding-right: 5px;"></i> Followed</button>    
                        <br/>        

                       <?php endif;?>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-12 col-md-pull-4">

                    <div class="resume-box">
                        <div class="heading-inner">
                            <p class="title light-grey">Personal Information</p>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-xs-12 col-sm-4">
                                <div class="my-contact">
                                    <div class="contact-icon">
                                        <?php if ($item->sex=='male'):?>
                                          <span class="icon-profile-male"></span>
                                        <?php else:?>
                                          <span class="icon-profile-female"></span>
                                        <?php endif;?>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Name: </h4>
                                        <p><?=$item->fullname?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 col-sm-4">
                                <div class="my-contact">
                                    <div class="contact-icon">
                                        <span class=" icon-envelope"></span>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Email: </h4>
                                        <p><a href="mailto:<?=$user['email']?>"><?=$user['email']?></a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 col-sm-4">
                                <div class="my-contact">
                                    <div class="contact-icon">
                                        <span class=" icon-phone"></span>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Phone: </h4>
                                        <p><a href="tel:<?=$item->contact_number?>"><?=$item->contact_number?></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-xs-12 col-sm-4">
                                <div class="my-contact">
                                    <div class="contact-icon">
                                        <span class="icon-calendar"></span>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Age: </h4>
                                        <p><?=$item->age?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 col-sm-4">
                                <div class="my-contact">
                                    <div class="contact-icon">
                                        <span class="icon-map-pin"></span>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Address: </h4>
                                        <p><?=$item->place_of_residence?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 col-sm-4">
                                <div class="my-contact">
                                    <div class="contact-icon">
                                        <span class="icon-flag"></span>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Spoken Languages: </h4>
                                        <p>
                                            <?php
                                          $arr_langs = json_decode($item->spoken_language_id, true);
                                           $arr = array();
                                           for ($i=0;$i<count($arr_langs);$i++){
                                             //echo $arr_langs[$i];
                                            echo app\modules\spokenlanguages\models\Spokenlanguages::findOne(['language_id'=>$arr_langs[$i]])['language_name'];
                                            if ($i == count($arr_langs) - 1):
                                               echo '  '; 
                                            else:
                                              echo ' , ';
                                            endif;
                                           }

                                        ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                  
                            <div class="col-md-3 col-xs-12 col-sm-4">
                                <div class="my-contact">
                                    <div class="contact-icon">
                                        <i class="fa fa-diamond" aria-hidden="true"></i>

                                    </div>
                                    <div class="contact-info">
                                        <h4>Marital: </h4>
                                        <p>
                                          <?php if ($item->marital == 1): ?>  
                                             Married
                                          <?php else:?>
                                             Single
                                          <?php endif;?>   
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-xs-12 col-sm-4">
                                <div class="my-contact">
                                    <div class="contact-icon">
                                       <i class="fa fa-cc-visa" aria-hidden="true"></i>

                                    </div>
                                    <div class="contact-info">
                                        <h4>Visa status: </h4>
                                        <p>
                                          <?=$item->visa_status?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-3 col-xs-12 col-sm-4">
                                <div class="my-contact">
                                    <div class="contact-icon">
                                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Education Level: </h4>
                                        <p>
                                          <?=$item->education_level?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-12 col-sm-4">
                                <div class="my-contact">
                                    <div class="contact-icon">
                                        <span class="icon-flag"></span>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Nationality: </h4>
                                        <p><?=$national->title?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="about-me">
                          <?=$resume['about']?>
                        </p>    
                        </div>
                   
                    <div class="resume-box">
                        <div class="heading-inner">
                                    <p class="title">Working Preferences </p>
                            </div>
                            <table class="table" style="font-size: 18px">
                                <tr>
                                    <td>Expected Salary: </td> 
                                    <td>
                                         <?php $arr_expected_salary = json_decode($item->expected_salary, true);?> 
                                       <?php
                                         echo $arr_expected_salary['amount'];
                                         echo ' ';
                                         echo strtoupper($arr_expected_salary['unit']);
                                       ?>
                                    </td> 
                                </tr>
                                <tr>
                                    <td>Employment Status: </td> 
                                    <td><?=$item->employment_status?></td> 
                                </tr>
                                <tr>
                                    <td>Categories: </td> 
                                    <td>
                                    <?=$category_job->title?>
                                    </td>    
                                </tr>
                                <tr>
                                    <td>Work Time: </td> 
                                    <td><?=$item->work_time?></td> 
                                </tr>
                                <tr>
                                    <td>Skills: </td> 
                                    <td>
                                        <?php
                                         $tagNames = '';
                                         $tag_ids = TagAssign::find()
                                                 ->where(['item_id'=>$item->user_id])
                                                 ->andWhere(['class'=>Resume::className()])
                                                 ->all();
                                         foreach ($tag_ids as $tag):
                                             $skills = Tag::findAll(['tag_id'=>$tag->tag_id]);
                                             foreach ($skills as $skill):
                                                   $tagNames .= $skill->name.' , ';
                                             endforeach;
                                         endforeach;
                                         echo $tagNames;
                                      ?>
                                    </td> 
                                </tr>
                                
                            </table>
                    </div>
                

                    <div class="resume-box">
                       <?php if ($item->work_time == 'parttime'):?>
                                <div class="heading-inner">
                                    <p class="title">Part Time </p>
                            </div>
                            <table class="table" style="font-size: 18px">
                                <tr>
                                    <td>Work Period: </td> 
                                    <td>
                                        <?=$item->parttime->work_period?>
                                    </td> 
                                </tr>
                                <tr>
                                    <td>Number Of Hours: </td> 
                                    <td><?=$item->parttime->number_hours?></td> 
                                </tr>
                                <tr>
                                    <td>Availability: </td> 
                                    <td>
                                        Start date : <?=date('d/M/Y', $item->parttime->start_date);?>
                                        <br/>
                                        End date : <?=date('d/M/Y', $item->parttime->end_date);?>
                                    </td> 
                                    
                                </tr>  
                            </table>
                            <?php endif;?>
                    </div>
             
                
                
                    <div class="heading-inner">
                                    <p class="title">Current/Last Job</p>
                            </div>
                            <table class="table" style="font-size: 18px">
                                
                                <tr>
                                    <td>Working Time :  </td> 
                                     <?php if ($item->getLastJob()->exists()):?>
                                    <td>Year Join : <?=$item->lastJob->year_join?></td> 
                                    <td>Year Left : <?=$item->lastJob->year_left?></td> 
                                    <?php endif;?>
                                </tr>
                                <tr>
                                    <td>Position :  </td> 
                                    <?php if ($item->getLastJob()->exists()):?>
                                    <td>Work At : <?=$item->lastJob->work_at?></td> 
                                     <?php endif;?>
                                    <td>
                                        Work as : 
                                        <?php if ($item->getLastJob()->exists()):?>
                                        <?php
                                          $work_as = yii\easyii\modules\catalog\models\Category::findOne(['category_id'=>$item->lastJob->work_as_id])->title;
                                          echo $work_as;
                                        ?>
                                        <?php endif;?>
                                    </td> 
                                </tr>
                                <tr>    
                                    <td>
                                        Salary :
                                    </td>
                                    <td>
                                        <?php
                                        if ($item->getLastJob()->exists()):
                                         $arr_expected_salary = json_decode($item->lastJob->salary, true);
                                         echo $arr_expected_salary['amount'];
                                         echo ' ';
                                         echo strtoupper($arr_expected_salary['unit']);
                                        endif; 
                                        ?>
                                    </td> 
                                </tr>
                               
                            </table>
             
                </div>
                
         

            </div>
        </div>
    </div>
</section>
<?php
   if (count(Yii::$app->session->getFlash('followed')) > 0 ):
?>
    <?php JSRegister::begin();?>
   <script>
            toastr.options = {
                "closeButton": true,
                "positionClass": "toast-bottom-right",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr["success"]("You have successfully followed", "Congratulations!", {
                timeOut: 9000
            })
   </script>
<?php JSRegister::end();?>
<?php Yii::$app->session->remove('followed')?>   
<?php else:
    echo "";
endif;
?>   