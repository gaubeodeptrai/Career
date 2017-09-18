<?php
  use yii\helpers\Url;
  use yii\easyii\models\Tag;
  use yii\easyii\models\TagAssign;
  use app\models\Resume;
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
                             if (count(Yii::$app->session->getFlash('success_update')) > 0 ):
                            ?>
                            <div role="alert" class="alert alert-success alert-dismissible">
                              <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                              <strong>Success! </strong> Your profile has been update 
                            </div>
                            <?php endif;?>
                            
                            <?php
                             if (count(Yii::$app->session->getFlash('success_cv')) > 0 ):
                            ?>
                            <div role="alert" class="alert alert-success alert-dismissible">
                              <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                              <strong>Success! </strong> Your resume has been update
                            </div>
                            <?php endif;?>
                            <div class="job-short-detail">
                                <div class="heading-inner">
                                    <p class="title">Profile detail</p>
                                </div>
                                <dl>
                                    
                                    <dt>Fullname:</dt>
                                    <dd> <?=$model->fullname?> </dd>

                                    <dt>Age:</dt>
                                    <dd> <?=$model->age?></dd>

                                    <dt>Phone:</dt>
                                    <dd><?=$model->contact_number?> </dd>

                                    <dt>Email:</dt>
                                    <dd><?=  Yii::$app->user->identity->email?> </dd>

                                    <dt>Last Education:</dt>
                                    <dd><?=$model->education_level?></dd>

                                    <dt>Place of Residence:</dt>
                                    <dd><?=$model->place_of_residence?></dd>

                                    <dt>Visa Status:</dt>
                                    <dd>
                                      <?=$model->visa_status?>
                                    </dd>

                                    <dt>Marital:</dt>
                                    <dd>
                                         <?php if($model->marital == 1):?>
                                             Married
                                         <?php else:?>
                                             Single
                                         <?php endif;?>
                                    </dd>

                                    <dt>National:</dt>
                                    
                                    <dd>
                                        <?php if ($model->getNationals()->exists()){?>
                                         <?=$model->nationals->title?>
                                        <?php }?>
                                    </dd>
                                    
                                    <dt>Languages:</dt>
                                    <dd>
                                        <?php
                                          $arr_langs = json_decode($model->spoken_language_id, true);
                                           $arr = array();
                                           for ($i=0;$i<count($arr_langs);$i++){
                                             //echo $arr_langs[$i];
                                            echo app\modules\spokenlanguages\models\Spokenlanguages::findOne(['language_id'=>$arr_langs[$i]])->language_name;
                                            if ($i == count($arr_langs) - 1):
                                               echo '  '; 
                                            else:
                                              echo ' , ';
                                            endif;
                                           }

                                        ?>
                                    </dd>
                                </dl>
                            </div>
                            
                      
                            <div class="heading-inner">
                                    <p class="title">Working Preferences </p>
                            </div>
                            <table class="table" style="font-size: 16px">
                                <tr>
                                    <td>Expected Salary: </td> 
                                    <td>
                                         <?php $arr_expected_salary = json_decode($model->expected_salary, true);?> 
                                       <?php
                                         echo $arr_expected_salary['amount'];
                                         echo ' ';
                                         echo strtoupper($arr_expected_salary['unit']);
                                       ?>
                                    </td> 
                                </tr>
                                <tr>
                                    <td>Employment Status: </td> 
                                    <td><?=$model->employment_status?></td> 
                                </tr>
                                <tr>
                                    <td>Categories: </td> 
                                    <?php if ($model->getCategory()->exists()):?>
                                    <td><?=$model->category->title?></td> 
                                    <?php endif;?>
                                </tr>
                                <tr>
                                    <td>Work Time: </td> 
                                    <td><?=$model->work_time?></td> 
                                </tr>
                                <tr>
                                    <td>Skills: </td> 
                                    <td>
                                        <?php
                                         $tagNames = '';
                                         $tag_ids = TagAssign::find()
                                                 ->where(['item_id'=>$user_id])
                                                 ->andWhere(['class'=>Resume::className()])
                                                 ->all();
                                         foreach ($tag_ids as $item):
                                             $skills = Tag::findAll(['tag_id'=>$item->tag_id]);
                                             foreach ($skills as $skill):
                                                   $tagNames .= $skill->name.' , ';
                                             endforeach;
                                         endforeach;
                                         echo $tagNames;
                                      ?>
                                    </td> 
                                </tr>
                            </table>
                            
                            
                            
                            
                            <?php if ($model->work_time == 'parttime'):?>
                                <div class="heading-inner">
                                    <p class="title">Part Time </p>
                            </div>
                            <table class="table" style="font-size: 16px">
                                <tr>
                                    <td>Work Period: </td> 
                                    <td>
                                        <?=$model->parttime->work_period?>
                                    </td> 
                                </tr>
                                <tr>
                                    <td>Number Of Hours: </td> 
                                    <td><?=$model->parttime->number_hours?></td> 
                                </tr>
                                <tr>
                                    <td>Availability: </td> 
                                    <td>Start date : <?=date('d/M/Y', $model->parttime->start_date);?></td> 
                                    <td>End date : <?=date('d/M/Y', $model->parttime->end_date);?></td> 
                                </tr>  
                            </table>
                            <?php endif;?>
                            
                             <div class="heading-inner">
                                    <p class="title">Current/Last Job</p>
                            </div>
                            <table class="table" style="font-size: 16px">
                                
                                <tr>
                                    <td>Working Time :  </td> 
                                     <?php if ($model->getLastJob()->exists()):?>
                                    <td>Year Join : <?=$model->lastJob->year_join?></td> 
                                    <td>Year Left : <?=$model->lastJob->year_left?></td> 
                                    <?php endif;?>
                                </tr>
                                <tr>
                                    <td>Position :  </td> 
                                    <?php if ($model->getLastJob()->exists()):?>
                                    <td>Work At : <?=$model->lastJob->work_at?></td> 
                                     <?php endif;?>
                                    <td>
                                        Work as : 
                                        <?php if ($model->getLastJob()->exists()):?>
                                        <?php
                                          $work_as = yii\easyii\modules\catalog\models\Category::findOne(['category_id'=>$model->lastJob->work_as_id])->title;
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
                                        if ($model->getLastJob()->exists()):
                                         $arr_expected_salary = json_decode($model->lastJob->salary, true);
                                         echo $arr_expected_salary['amount'];
                                         echo ' ';
                                         echo strtoupper($arr_expected_salary['unit']);
                                        endif; 
                                        ?>
                                    </td> 
                                </tr>
                               
                            </table>
                            <div class="heading-inner">
                                <p class="title">Some Line About Me</p>
                            </div>
                            <?php if ($model->getResume()->exists()):?>
                            <p><?=$model->resume->about?></p>
                            <?php endif;?>
                            </div>
                        
                           
                            

                        </div>
                    </div>
                </div>
            </div>
        </section>