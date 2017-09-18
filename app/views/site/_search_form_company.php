<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\easyii\modules\catalog\models\Category;
use app\modules\nationals\models\Nationals;

$categories = Category::find()->where(['status'=>1])->all();
$locations = Nationals::find()->all();

$text = '';
if (Yii::$app->request->get('text')):
  $text =   Yii::$app->request->get('text');
endif;
?>


<?= Html::beginForm(Url::to(['/candidate/search']), 'get', ['class' => 'form-inline']) ?>
    <div class="col-md-7 col-sm-7 col-xs-12 nopadding">
        <div class="form-group">

            
            <?= Html::textInput('text', $text, ['class' => 'form-control', 'placeholder' => 'Type keywords to find candidates']) ?>
            <i class="icon-magnifying-glass"></i>
        </div>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-12 nopadding">
        <div class="form-group">
            <select class="select-category form-control" name="cat">
                <option label="Select Option"></option>
                <?php 
                   
                   foreach ($categories as $cat):
                       if ($cat->category_id == Yii::$app->request->get('cat')):
                          $select = 'selected'; 
                       else:
                           $select = '';
                       endif;
                ?>
                   <option value="<?=$cat->category_id?>" <?=$select?>><?=$cat->title?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    
    <div class="col-md-2 col-sm-2 col-xs-12 nopadding">
        <div class="form-group form-action">
            <button type="submit" class="btn btn-default btn-search-submit">Search <i class="fa fa-angle-right"></i> </button>
        </div>
    </div>
<?= Html::endForm() ?>
<div style="text-align: center; ">
    <p>  
        <a href="<?=  Url::to(['candidate/advance_search'])?>" style="color: ivory; text-decoration: underline;">Advance Search</a>
    </p>
</div>