<?php
  use yii\helpers\Url;
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
                               <p class="title">Edit Job</p>
                           </div>
                           <?=$this->render('_form_job',['model'=>$model,'jobs'=>$jobs])?>
                </div>
            </div>
        </div>
    </div>
</section>