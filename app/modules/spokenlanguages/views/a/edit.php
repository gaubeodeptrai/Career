<?php
$this->title = $model->language_name;
?>
<?= $this->render('_menu') ?>

<?php echo $this->render('_submenu', ['model' => $model]) ?>

<?= $this->render('_form', ['model' => $model]) ?>