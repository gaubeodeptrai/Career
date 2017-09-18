<?php
  $active_profie = '';
  $active_edit = '';
  $active_resume = '';
  $active_applied = '';
  $active_followed = '';
  $active_account = '';
  if (Yii::$app->controller->action->id == 'profile'):
      $active_profie = 'active';
  elseif(Yii::$app->controller->action->id == 'edit'):
      $active_edit = 'active';
  elseif(Yii::$app->controller->action->id == 'resume'):
      $active_resume = 'active';
   elseif(Yii::$app->controller->action->id == 'applied'):
      $active_applied = 'active';
    elseif(Yii::$app->controller->action->id == 'followed'):
      $active_followed = 'active';
    elseif(Yii::$app->controller->action->id == 'account'):
      $active_account = 'active';
  endif;
?>
<div class="profile-nav">
    <div class="panel">
        <ul class="nav nav-pills nav-stacked">
            <li class="<?=$active_profie?>">
                <a href="<?=  \yii\helpers\Url::to(['/users/profile/'.$user_id])?>"> <i class="fa fa-user"></i> Profile</a>
            </li>
            <li class="<?=$active_edit?>">
                <a href="<?=  \yii\helpers\Url::to(['/users/edit/'.$user_id])?>"> <i class="fa fa-edit"></i> Edit Profile</a>
            </li>
            <li class="<?=$active_resume?>">
                <a href="<?=  \yii\helpers\Url::to(['/users/resume/'.$user_id])?>"> <i class="fa fa-file-o"></i>Resume </a>
            </li>
            
            <li class="<?=$active_applied?>">
                <a href="<?=  \yii\helpers\Url::to(['/users/applied/'.$user_id])?>"> <i class="fa  fa-list-ul"></i> Jobs Applied</a>
            </li>
            <li class="<?=$active_followed?>">
                <a href="<?=  \yii\helpers\Url::to(['/users/followed/'.$user_id])?>"> <i class="fa  fa-bookmark-o"></i> Followed Companies </a>
            </li>
        </ul>
    </div>
</div>
<hr/>
<div class="profile-nav">
    <div class="panel">
        <ul class="nav nav-pills nav-stacked">
            <li class="<?=$active_account?>">
                <a href="<?=  \yii\helpers\Url::to(['/users/account/'])?>"> <i class="fa fa-lock"></i> Your Account</a>
            </li>
           
        </ul>
    </div>
</div>