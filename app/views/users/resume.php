<?php
  use yii\helpers\Url;
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
                            <div class="post-job2-panel">  
                             
                                 <?= $this->render('_form_resume', ['model' => $model,'cv'=>$cv,'user_id'=>  Yii::$app->user->id]) ?> 
                                
                            </div>
                            
                            
                        </div>
                        
                          

                        </div>
                    </div>
                </div>
            </div>
        </section>