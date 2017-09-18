<?php
  $active_profie = '';
  $active_edit = '';
  $active_applied = '';
  $active_activejobs = '';
  $active_followed = '';
  $active_newjob = '';
  $active_account = '';
  if (Yii::$app->controller->action->id == 'profile'):
      $active_profie = 'active';
  elseif(Yii::$app->controller->action->id == 'edit'):
      $active_edit = 'active';
  elseif(Yii::$app->controller->action->id == 'applied'):
      $active_applied = 'active';
   elseif(Yii::$app->controller->action->id == 'activejobs'):
      $active_activejobs = 'active';
    elseif(Yii::$app->controller->action->id == 'followed'):
      $active_followed = 'active';
    elseif(Yii::$app->controller->action->id == 'newjob'):
      $active_newjob = 'active';
     elseif(Yii::$app->controller->action->id == 'account'):
      $active_account = 'active';
  endif;
?>
<div class="profile-nav">
    <div class="panel">
        <ul class="nav nav-pills nav-stacked">
            <li class="<?=$active_profie?>">
                <a href="<?=  \yii\helpers\Url::to(['/companies/profile/'.$user_id])?>"> <i class="fa fa-user"></i> Dashboard</a>
            </li>
            <li class="<?=$active_edit?>">
                <a href="<?=  \yii\helpers\Url::to(['/companies/edit/'.$user_id])?>"> <i class="fa fa-edit"></i> Edit Profile</a>
            </li>
            <li class="<?=$active_applied?>">
                <a href="<?=  \yii\helpers\Url::to(['/companies/applied/'.$user_id])?>"> <i class="fa fa-file-o"></i>Candidates Applied </a>
            </li>
            <li class="<?=$active_activejobs?>">
                <a href="<?=  \yii\helpers\Url::to(['/companies/activejobs/'.$user_id])?>"> <i class="fa  fa-list-ul"></i> List Jobs</a>
            </li>
            <li class="<?=$active_newjob?>">
                <a href="<?=  \yii\helpers\Url::to(['/companies/newjob/'.$user_id])?>"> <i class="fa  fa-list-alt"></i> Post New Jobs</a>
            </li>
            <li class="<?=$active_followed?>">
                <a href="<?=  \yii\helpers\Url::to(['/companies/followed/'.$user_id])?>"> <i class="fa  fa-bookmark-o"></i> Followers </a>
            </li>
        </ul>
    </div>
</div>
<hr/>
<div class="profile-nav">
    <div class="panel">
        <ul class="nav nav-pills nav-stacked">
            <li class="<?=$active_account?>">
                <a href="<?=  \yii\helpers\Url::to(['/companies/account/'])?>"> <i class="fa fa-lock"></i> Company Account</a>
            </li>
           
        </ul>
    </div>
</div>