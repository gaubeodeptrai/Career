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


<?= Html::beginForm(Url::to(['/job/search']), 'get', ['class' => 'form-inline']) ?>
    <div class="col-md-4 col-sm-4 col-xs-12 nopadding">
        <div class="form-group">

            
            <?= Html::textInput('text', $text, ['class' => 'form-control', 'placeholder' => 'Type keywords to find jobs']) ?>
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
    <div class="col-md-3 col-sm-3 col-xs-12 nopadding">
        <div class="form-group">
            <?php
              $select_fulltime = '';
              $select_parttime = '';
              $select_remote = '';
              $select_free = '';
              if (Yii::$app->request->get('worktime')=='fulltime'):
                          $select_fulltime = 'selected'; 
             elseif (Yii::$app->request->get('worktime')=='parttime'):
                           $select_parttime = 'selected';
              elseif (Yii::$app->request->get('worktime')=='remote'):
                           $select_remote = 'selected';
               elseif (Yii::$app->request->get('worktime')=='freelance'):
                           $select_free = 'selected';
             endif;
            ?>
            <select class="select-worktime form-control" name="worktime">
                   <option value="">&nbsp;</option>
                   <option value="fulltime" <?=$select_fulltime?>>Full Time</option>
                   <option value="parttime" <?=$select_parttime?>>Part Time</option>
                   <option value="remote" <?=$select_remote?>>Remote</option>
                   <option value="freelance" <?=$select_free?>>Freelance</option>
                
            </select>
        </div>
    </div>
    <div class="col-md-2 col-sm-2 col-xs-12 nopadding">
        <div class="form-group form-action">
            <button type="submit" class="btn btn-default btn-search-submit">Search <i class="fa fa-angle-right"></i> </button>
        </div>
    </div>
<?= Html::endForm() ?>