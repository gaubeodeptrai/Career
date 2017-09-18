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
                            <?php echo $this->render('_menu-company',['user_id'=>  Yii::$app->user->id])?>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            
                            
                             <div class="job-short-detail">
                                <div class="heading-inner">
                                    <p class="title">Profile detail</p>
                                </div>
                                <dl>
                                    <dt>Company name:</dt>
                                    <dd> <?=$model->company_name?></dd>

                                    <dt>Type of Business:</dt>
                                    <dd><?=$model->business?> </dd>

                                    <dt>Address:</dt>
                                    <dd> <?=$model->company_address?> </dd>

                                    <dt>Phone:</dt>
                                    <dd><?=$model->company_tel?> </dd>

                                    <dt>Email:</dt>
                                    <dd><?=  Yii::$app->user->identity->email?> </dd>

                                    <dt>No. of Employees:</dt>
                                    <dd><?=$model->company_size?></dd>

                                    
                                    <dt>Website:</dt>
                                    <dd><?=$model->company_site?> </dd>
                                </dl>
                            </div>
                            <div class="heading-inner">
                                <p class="title">Some Line About Our Company</p>
                            </div>
                            <p>
                                <?=$model->about?>
                            </p>
                        
                            
                            </div>
                        
                           
                            

                        </div>
                    </div>
                </div>
            </div>
        </section>