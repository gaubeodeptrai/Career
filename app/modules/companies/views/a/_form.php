<?php
use yii\easyii\widgets\DateTimePicker;
use yii\easyii\helpers\Image;
use yii\easyii\widgets\TagsInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\easyii\widgets\Redactor;
use yii\easyii\widgets\SeoForm;

$module = $this->context->module->id;
?>
<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'options' => ['enctype' => 'multipart/form-data', 'class' => 'model-form']
]); ?>
<?= $form->field($model, 'company_name') ?>

<?php if($model->logo) : ?>
    <img src="<?= Image::thumb($model->logo, 240) ?>">
    <a href="<?= Url::to(['/admin/'.$module.'/a/clear-image', 'id' => $model->company_id]) ?>" class="text-danger confirm-delete" title="Clear logo">Clear logo</a>
<?php endif; ?>
<?= $form->field($model, 'logo')->fileInput() ?>

<?= $form->field($model, 'company_address')?>

<?= $form->field($model, 'company_tel')?>

<?= $form->field($model, 'company_site')?>

<?= $form->field($model, 'company_size')?>

<?= $form->field($model, 'time')->widget(DateTimePicker::className()); ?>

<?php if(IS_ROOT && $model->slug) : ?>
    <?= $form->field($model, 'slug') ?>
<?php endif; ?>

<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
