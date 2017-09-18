<?php
    use yii\helpers\Html;
    $homePath = \yii\helpers\Url::base(true);
    use yii\easyii\modules\catalog\models\Category;
?>
<div id='product_detail'>
    <h3>
        <?= $model->fullname;?>
    </h3>

    <div class="row">
        <div class='col-sm-3'>
            <div id='product_img_thumbnail'>
                <?php if($model->image):?>
                    <img src='<?= $homePath . $model->image ?>' style='padding: 2px; width: 100%'/>
                <?php else:?>
                    <img src='<?= $homePath . '/uploads/worker.jpg' ?>' style='padding: 2px; width: 100%'/>
                <?php endif;?>
                <div style="text-align: center">Published : <?= date('d-m-Y', $model->time) ?></div>
            </div>
            
            <div style="margin-top: 10px; text-align: center">
                <?= 
                    Html::a('<span class="glyphicon glyphicon-shopping-cart"></i>',
                            ['#'],
                            [
                                'class' => 'btn btn-default btn-lg',
                                'style' => 'border-radius: 6px !important;',
                                'title' => Yii::t('kvgrid', 'Add Book'),
                            ])
                ?>
                
                <?= 
                    Html::a('<span class="glyphicon glyphicon-earphone"></i>',
                            ['#'],
                            [
                                'class' => 'btn btn-default btn-lg',
                                'style' => 'border-radius: 6px !important',
                                'title' => Yii::t('kvgrid', 'Call for detail'),
                            ])
                ?>
                
                <?= 
                    Html::a('<span class="glyphicon glyphicon-envelope"></i>',
                            ['#'],
                            [
                                'class' => 'btn btn-default btn-lg',
                                'style' => 'border-radius: 6px !important',
                                'title' => Yii::t('kvgrid', 'Email for detail'),
                            ])
                ?>
            </div>
        </div>
        
        <div class="col-sm-9">
            <?php if(count($model_parttime) > 0):?>
            <div class="col-sm-6">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="danger">
                            <td colspan="2" class="text-center text-danger">
                                Part-time
                            </td>
                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left text-bold" >Work period</th>
                            <td class="text-right"><?= $model_parttime->work_period?></td>

                        </tr>
                        <tr>
                            <td class="text-left text-bold">Number of hours</th>
                            <td class="text-right"><?= $model_parttime->number_hours?></td>
                        </tr>

                        <tr>
                            <td class="text-left text-bold">Start date</th>
                            <td class="text-right"><?= date('d-m-Y', $model_parttime->start_date)?></td>
                        </tr>
                        
                        <tr>
                            <td class="text-left text-bold">End date</th>
                            <td class="text-right"><?= date('d-m-Y', $model_parttime->end_date)?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php else :?>
            <div class="col-sm-6">
                No Part-time
            </div>
            <?php endif;?>
            
            <?php if(count($model_lastjob) > 0):?>
            <div class="col-sm-6">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr class="danger">
                            <td colspan="2" class="text-center text-danger">
                                Last job
                            </td>
                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left text-bold" >Work at</th>
                            <td class="text-right"><?= $model_lastjob->work_at?></td>

                        </tr>
                        <tr>
                            <td class="text-left text-bold">Work as</th>
                            <td class="text-right"><?= Category::find()->where(['category_id' => $model_lastjob->work_as_id])->one()['title']?></td>
                        </tr>

                        <tr>
                            <td class="text-left text-bold">Salary</th>
                            <td class="text-right">
                                <?php
                                    $arr_salary = json_decode($model_lastjob->salary, true);
                                    echo $arr_salary['amount'].' '.strtoupper($arr_salary['unit']);
                                ?>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="text-left text-bold">Year join</th>
                            <td class="text-right"><?= $model_lastjob->year_join;?></td>
                        </tr>
                        
                        <tr>
                            <td class="text-left text-bold">Year left</th>
                            <td class="text-right"><?= $model_lastjob->year_left;?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php else :?>
            <div class="col-sm-6">
                No Last job
            </div>
            <?php endif;?>
            
        </div>
    </div>
</div>