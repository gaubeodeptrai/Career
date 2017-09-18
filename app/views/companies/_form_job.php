<?php
  use yii\bootstrap\ActiveForm;
  use kartik\file\FileInput;
  use yii\helpers\Url;
  use kartik\select2\Select2;
  use yii\helpers\ArrayHelper;
  use yii\easyii\modules\catalog\models\Category;
  use yii\easyii\widgets\Redactor;
  use kartik\date\DatePicker;
  
?> 


<div class="profile-edit row">
    
    <?php $form = ActiveForm::begin([
                    'enableAjaxValidation' => FALSE,
                    'enableClientValidation' => TRUE, 
                    'options' => ['enctype' => 'multipart/form-data'] 
                ]); ?>
        <div class="col-md-12 col-sm-12">
            
                <label>Job Categories: <span class="required">*</span></label>
                <?=
                $form->field($jobs, 'category_id')->widget(Select2::className(), [
                    'data' => ArrayHelper::map(Category::find()->all(), 'category_id', 'title'),
                    'size' => Select2::LARGE,
                    'options' => [
                        'placeholder' => 'Select job category...'
                    ]
                ])->label(FALSE);
            ?>
        </div>
    
    
    
        <div class="col-md-12 col-sm-12">
           
                <label>Job title <span class="required">*</span></label>
                <?= $form->field($jobs, 'title')->label(FALSE) ?>
            
        </div>
        
        <div class="col-md-12 col-sm-12">
           
                <label>Salary <span class="required">*</span></label>
                <?= $form->field($jobs, 'salary')->label(FALSE) ?>
            
        </div>
    
         <div class="col-md-6 col-sm-12">
           
                <label>Expiration date <span class="required">*</span></label>
                <?php
                   //$newDate = Datetime::createFromFormat('d-m-Y H:i:s', $jobs->expiration_date)->format('Y-m-d h:i:s');
                   echo $form->field($jobs, 'expiration_date')->widget(DatePicker::classname(), [
                       'options' => ['placeholder' => 'Expiration date for this job'],
                       'pluginOptions' => [
                           'todayHighlight' => true,
                           'todayBtn' => true,    
                           'startDate' => '+0d',
                           'type' => DatePicker::TYPE_INPUT,     
                           'autoclose'=>true,
                           'format' => 'dd-mm-yyyy'    
                       ]
                    ])->label(FALSE);
                ?>
            
        </div>
        <div class="col-md-6 col-sm-12">
           
                <label>Work Time <span class="required">*</span></label>
                <?= $form->field($jobs, 'work_time')->inline(true)->radioList(['parttime' => 'Part time','fulltime' => 'Full Time','remote'=>'Remote' ])->label(false) ?>
            
        </div>
        
        <div class="col-md-12 col-sm-12">
           
                <label>Job Experience:<span class="required">*</span></label>
                 <?= $form->field($jobs, 'experience')->label(FALSE) ?>
            
        </div>
    
        <div class="col-md-12 col-sm-12">
           
                <label>Job descriptions <span class="required">*</span></label>
                <?= $form->field($jobs, 'description')->widget(Redactor::className(),[
                    'options' => [
                        'minHeight' => 200,
                        'imageUpload' => FALSE,
                        'fileUpload' => FALSE,
                        'plugins' => ['fullscreen']
                    ]
                ])->label(FALSE) ?>
            
        </div>
         <div class="col-md-12 col-sm-12">
           
                <label>Job requirement <span class="required">*</span></label>
                <?= $form->field($jobs, 'requirement')->widget(Redactor::className(),[
                    'options' => [
                        'minHeight' => 200,
                        'imageUpload' => FALSE,
                        'fileUpload' => False,
                        'plugins' => ['fullscreen']
                    ]
                ])->label(FALSE) ?>
            
        </div>
        
       <div class="col-md-12 col-sm-12">
            <button class="btn btn-default pull-right" type="submit"> Save this Job <i class="fa fa-angle-right"></i></button>
        </div>

   <?php ActiveForm::end(); ?>
    

</div>