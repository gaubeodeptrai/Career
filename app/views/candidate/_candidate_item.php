<?php
  use yii\helpers\Url;
  use yii\easyii\modules\catalog\models\Category;
  use yii\easyii\models\TagAssign;
  use yii\easyii\models\Tag;
  use app\models\Resume;  
?>
<?php 
        foreach($candidates as $item) :
?>
     <div class="col-md-6 col-sm-12 col-xs-12">      
         <div class="profile-content" style="text-align: center">
            <div class="card">
              <a href="<?=  Url::to(['candidate/view/'.$item->slug])?>">
                <?php
                if ($item->image):
                ?>
                <img src="<?=  Url::base()?><?=$item->image?>" alt="<?=$item->fullname?>" class="img-circle" style="max-height: 200px" />
                <?php elseif($item->sex=='male'):?>
                  <img src="<?=  Url::base()?>/images/no_person.png" alt="<?=$item->fullname?>" class="img-circle " style="max-height: 200px" />
                <?php elseif($item->sex=='female'):?>
                  <img src="<?=  Url::base()?>/images/no_person_femail.png" alt="<?=$item->fullname?>" class="img-circle " style="max-height: 200px"/>
                <?php else:?>
                  <img src="<?=  Url::base()?>/images/no_person.png" alt="<?=$item->fullname?>" class="img-circle " style="max-height: 200px"/>  
                <?php endif;?>  
            </a>   
                <div class="profileinfo">
                    <h4> 
                        <a href="<?=  Url::to(['candidate/view/'.$item->slug])?>"> <?=$item->fullname?></a>
                        ( <?php
                         if ($item->category_id):
                           echo Category::findOne(['category_id'=>$item->category_id])->title;
                         endif;
                        ?> )
                    </h4>


                     <?php
                      $color='';
                      if ($item->work_time=='fulltime'):
                          $color = 'job-type jt-full-time-color';
                          $time = 'Full time'; 
                      elseif ($item->work_time=='parttime'):
                          $color = 'job-type jt-part-time-color';
                          $time = 'Part Time'; 
                      elseif ($item->work_time=='remote'):
                          $color = 'job-type jt-remote-color';
                          $time = 'Remote';
                      endif;
                    ?>
                    <a href="#" class="<?=$color?>">
                        <i class="fa fa-clock-o"></i> <?=$time?>
                    </a>

                    <p class="bio">

                    </p>
                    <div class="profile-skills" style="word-wrap: normal">
                        <!--<span> wordpress </span> <span> css3 </span> <span> javascript </span> <span> php </span> <span> laravel </span> <span> woocommerce </span>-->
                      <?php
                         $tagNames = '';
                         $tag_ids = TagAssign::find()
                                 ->where(['item_id'=>$item->user_id])
                                 ->andWhere(['class'=>Resume::className()])
                                 ->all();

                         foreach ($tag_ids as $item):
                             $skills = Tag::findAll(['tag_id'=>$item->tag_id]);
                             foreach ($skills as $skill):
                                   $tagNames .='<span>';
                                   $tagNames .='<a href="'.Url::base().'/candidate/index/?skill='.$skill->name.'">';
                                   $tagNames .= $skill->name;
                                   $tagNames .='</a>';
                                   $tagNames .= '</span>';
                             endforeach;
                         endforeach;
                         echo $tagNames;
                      ?>
                    </div>

                </div>

        </div>
    </div>
     </div>      
                   <?php endforeach;?>