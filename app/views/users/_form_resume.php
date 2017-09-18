<?php

use yii\easyii\models\Tag;
use yii\easyii\models\TagAssign;
use yii\easyii\widgets\TagsInput;
use yii\helpers\Html;
use app\models\Resume;
use yii\helpers\Url;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use yii\easyii\widgets\Redactor;

use richardfan\widget\JSRegister;


//$action = $this->context->module->module->module->controller->action->id;
$module = $this->context->module->id;
$baseUrl = \yii\helpers\Url::base(true);
//echo Yii::$app->session->getFlash('error');
$pathinfo=  $cv->resume_file;

if(($pos=strrpos($pathinfo,'.'))!==false):
   $extension=substr($pathinfo,$pos+1);
endif;
   //echo $extension;
   

?>


<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => FALSE,
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

<div class="panel panel-primary">
    <div class="panel-heading">Your Resume</div>
    <div class="panel-body">
      
        <!-- Image-->
        <div >
           <label class="control-label" for="candidates-cv">Upload your CV</label>
           <?php if ($cv->resume_file): ?>
             <?php if ($extension == 'pdf'):?>
              ( <i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size:24px"></i> <a href="<?=  Url::to([$cv->resume_file])?>">View Your Resume</a> )  
             <?php endif;?>  
              <?php if ($extension == 'doc' || $extension == 'docx'):?>
              (<i class="fa fa-file-doc-o" aria-hidden="true" style="font-size:24px"></i>  <a href="<?=  Url::to([$cv->resume_file])?>">View Your Resume</a> )  
             <?php endif;?>  
           <?php endif; ?>
            
           <?php
             echo $form->field($cv, 'resume_file')->widget(FileInput::classname(),[
              'pluginOptions' => [
                
                'initialPreviewAsData'=>true,
                'overwriteInitial'=>true
              ]
             ])->label(FALSE);
           ?>
           
           <label class="control-label">Your Skills</label>
           <?php
             $tagNames = '';
             $tag_ids = TagAssign::find()
                     ->where(['item_id'=>$user_id])
                     ->andWhere(['class'=>Resume::className()])
                     ->all();
             foreach ($tag_ids as $item):
                 $skills = Tag::findAll(['tag_id'=>$item->tag_id]);
                 foreach ($skills as $skill):
                       $tagNames .= $skill->name.',';
                 endforeach;
             endforeach;
             $model->tagNames = substr($tagNames, 0, -1);
           ?>
           <?= $form->field($model, 'tagNames')->widget(TagsInput::className())->label(FALSE) ?>
            <label class="control-label">About your self</label>
             <?= $form->field($cv, 'about')->widget(Redactor::className(),[
                    'options' => [
                        'minHeight' => 200,
                        'imageUpload' => FALSE,
                        'fileUpload' => FALSE,
                        'plugins' => ['fullscreen']
                    ]
                ])->label(FALSE) ?>
        </div>
    </div>
</div>



<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>


