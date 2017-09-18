<?php
use yii\easyii\widgets\Photos;

$this->title = $model->company_name;
?>

<?= $this->render('_menu') ?>
<?= $this->render('_submenu', ['model' => $model]) ?>

<?= Photos::widget(['model' => $model])?>