<?php
  use yii\bootstrap\ActiveForm;
  use kartik\file\FileInput;
  use yii\helpers\Url;
  use kartik\select2\Select2;
  use yii\helpers\ArrayHelper;
  use app\modules\nationals\models\Nationals;
?> 
<div class="heading-inner first-heading">
    <p class="title">Edit Profile</p>
</div>

<div class="profile-edit row">
    
    <?php $form = ActiveForm::begin([
                    'enableAjaxValidation' => FALSE,
                    'enableClientValidation' => TRUE, 
                    'options' => ['enctype' => 'multipart/form-data'] 
                ]); ?>
        <div class="col-md-6 col-sm-12">
            
                <label>Company name: <span class="required">*</span></label>
                <?= $form->field($model, 'company_name')->label(FALSE) ?>
        </div>
        <div class="col-md-6 col-sm-12">
           
                <label>Type of Business Entity <span class="required">*</span></label>
                <?= $form->field($model, 'business')->label(FALSE) ?>
            
        </div>
        <div class="col-md-6 col-sm-12">
            
                <label>Address: <span class="required">*</span></label>
                <?= $form->field($model, 'company_address')->label(FALSE) ?>
        </div>
         <div class="col-md-6 col-sm-12">
            
                <label>Location: <span class="required">*</span></label>
                <?=
                $form->field($model, 'location_id')->widget(Select2::className(), [
                    'data' => ArrayHelper::map(Nationals::find()->all(), 'national_id', 'title'),
                    'size' => Select2::LARGE,
                    'options' => [
                        'placeholder' => 'Select national...'
                    ]
                ])->label(FALSE)
            ?>
        </div>
        <div class="col-md-6 col-sm-12">
            
                <label>Telephone number: <span class="required">*</span></label>
                <?= $form->field($model, 'company_tel')->label(FALSE) ?>
        </div>
        <div class="col-md-12 col-sm-12">
            
                <label>Logo: </label>
                 <?php
                
                   if ($model->logo):
                   echo $form->field($model, 'logo')->widget(FileInput::classname(),[
                    'pluginOptions' => [
                    'initialPreview'=>[
                        Url::base().$model->logo
                      ],
                    'filecount'=>FALSE,    
                    'initialPreviewAsData'=>true,
                    'overwriteInitial'=>true
                   ]
                 ])->label(FALSE);
                  else:
                     echo $form->field($model, 'logo')->widget(FileInput::classname(),[
                    'pluginOptions' => [
                    'filecount'=>FALSE,    
                    'initialPreviewAsData'=>true,
                    'overwriteInitial'=>true
                   ]
                 ])->label(FALSE); 
                  endif; 
                ?>
        </div>
         <div class="col-md-6 col-sm-12">
            
                <label>Number of employees <span class="required">*</span></label>
                <?= $form->field($model, 'company_size')->label(FALSE) ?>
        </div>
       <div class="col-md-6 col-sm-12">
                <label>Website</label>
                <?= $form->field($model, 'company_site')->label(FALSE) ?>
        </div>
        <div class="col-md-12 col-sm-12">
           <label>About</label>
           <?= $form->field($model, 'about')->textarea(['rows' => '6'])->label(FALSE) ?>
        </div>
        
       <div class="col-md-6 col-sm-12">
                <label>Facebook</label>
                <?= $form->field($model, 'facebook')->label(FALSE) ?>
        </div>
       <div class="col-md-6 col-sm-12">
                <label>Linkedin</label>
                <?= $form->field($model, 'linkedin')->label(FALSE) ?>
        </div>
        <div class="col-md-6 col-sm-12">
                <label>Twitter</label>
                <?= $form->field($model, 'twitter')->label(FALSE) ?>
        </div>
        <div class="col-md-6 col-sm-12">
                <label>Googleplus</label>
                <?= $form->field($model, 'googleplus')->label(FALSE) ?>
        </div>
    
       <div class="col-md-12 col-sm-12">
            <button class="btn btn-default pull-right" type="submit"> Save Profile <i class="fa fa-angle-right"></i></button>
        </div>

   <?php ActiveForm::end(); ?>
    

</div>