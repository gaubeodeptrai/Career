<?php
  use yii\helpers\Url;
  use app\modules\candidates\models\Candidates;
  $this->title = '';
  
?>
<section class="breadcrumb-search parallex">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                <div class="col-md-8 col-sm-12 col-md-offset-2 col-xs-12 nopadding">
                    <div class="search-form-contaner">
                         <?=$this->render('/site/_search_form_company',[]);?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
 </section>
<section class="categories-list-page light-grey">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12 nopadding">
                   <?=$this->render('_candidate_item',['candidates'=>$candidates])?>
                        
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
                        <div class="widget-heading"><span class="title">Candide Summary</span></div>
                        <ul class="categories-module">
                           <?php foreach ($cat_jobs as $cat):?> 
                            <li> 
                                <?php $total = Candidates::find()
                                        ->where(['category_id'=>$cat->category_id])
                                        ->andWhere(['status'=>1])
                                        ->count(); ?>
                                <a href="<?=  Url::to(['candidate/cat/'.$cat->slug])?>"> <?=$cat->title?> 
                                    <span>( <?=$total?> )</span> 
                                </a> 
                            </li>
                           <?php endforeach;?> 
                           
                        </ul>
                    </div>
                   

                  </aside>
               </div> 
            </div>
        </div>
    </div>
</section>