<?php
  use yii\helpers\Url;
  use yii\bootstrap\ActiveForm;
  use richardfan\widget\JSRegister;
  $this->title = $cat->title;
  
?>
<section class="breadcrumb-search parallex">
    <div class="container-fluid">
        <div class="row">
           <div class="col-md-10 col-sm-12 col-md-offset-1 col-xs-12 nopadding">
                    <div class="search-form-contaner">
                         <?=$this->render('/site/_search_form',[]);?>
                    </div>
                </div>
        </div>
    </div>
</section>

<section class="categories-list-page light-grey">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
              <h1><?=$cat->title?></h1>
                <div class="col-md-8 col-sm-12 col-xs-12">
                    
                    <?=$this->render('_job_list',['jobs'=>$Jobs])?>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                       <div class="pagination-box clearfix">
                            <?php
                                echo \yii\widgets\LinkPager::widget([
                                  'pagination' => $pagination,
                                ]);
                              ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <aside>
                        <div class="widget">
                            <div class="widget-heading"><span class="title">Hot Categories</span></div>
                            <ul class="categories-module">
                              <?php
                                $cat_jobs = \yii\easyii\modules\catalog\models\Category::find()
                                        ->where(['status'=>1])
                                        ->all();
                               
                              ?> 
                                <?php 
                                  foreach ($cat_jobs as $job):
                                       $total_job = yii\easyii\modules\catalog\models\Item::find()
                                        ->where(['category_id'=>$job->category_id])
                                        ->count();  
                                ?>
                                <li> <a href="#"> <?=$job->title?> <span>(<?=$total_job?>)</span> </a> </li>
                                <?php endforeach;?>
                               
                            </ul>
                        </div>
                        

                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
