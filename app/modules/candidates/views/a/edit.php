<?php
$this->title = $model->fullname;
?>
<?= $this->render('_menu') ?>

<?php echo $this->render('_submenu', ['model' => $model]) ?>

<?= $this->render('_form', ['model' => $model]) ?>