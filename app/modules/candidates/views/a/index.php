<?php
use app\modules\candidates\models\Candidates;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\easyii\modules\catalog\models\Category;
use app\models\Parttime;
use app\models\LastJob;

$this->title = 'Candidates';

$module = $this->context->module->id;
?>

<?php

$gridColumns = [
// the name column configuration
    [
        'class' =>  'kartik\grid\SerialColumn',
        'width' =>  '10px',
    ],
    [
        'class' =>  'kartik\grid\ExpandRowColumn',
        'width' =>  '10px',
        'value' =>  function($model, $key, $index, $column)
        {
            return GridView::ROW_COLLAPSED;
        },
        'detail'    =>  function($model, $key, $index, $column)
        {
            $model_parttime = Parttime::find()->where(['parttime_id' => $model->parttime_id])->one();
            $model_lastjob = LastJob::find()->where(['lastjob_id' => $model->last_job_id])->one();

            if(count($model_parttime) == 0)
            {
                $model_parttime = [];
            }
            if(count($model_lastjob) == 0)
            {
                $model_lastjob = [];
            }
            return Yii::$app->controller->renderPartial('_candidate_detail', [
                'model' => $model,
                'model_parttime' => $model_parttime,
                'model_lastjob' => $model_lastjob
            ]);
        },
        'detailAnimationDuration' => 'fast'
    ],
    [
        'attribute' =>  'category_id',
        'value'     =>  'category.title',
        'vAlign'    =>  'middle',
        'headerOptions' => ['class' => 'kv-sticky-column', 'style' => 'width:10%'],
        'contentOptions' => ['class' => 'kv-sticky-column'],
    ],
    [
        'attribute' => 'fullname',
        'vAlign' => 'middle',
        'headerOptions' => ['class' => 'kv-sticky-column', 'style' => 'width:20%'],
        'contentOptions' => ['class' => 'kv-sticky-column'],
    ],
    [
        'attribute' => 'age',
        'vAlign' => 'middle',
        'width' => '62px',
        'contentOptions' => ['style' => 'text-align:center'],
    ],
    [
        'attribute' => 'expected_salary',
        'value' => function($model)
        {
            $arr_expected_salary = json_decode($model->expected_salary, true);
            return $arr_expected_salary['amount'].' '.strtoupper($arr_expected_salary['unit']);
        },
        'vAlign' => 'middle',
        'width' => '100px',
        'contentOptions' => ['style' => 'text-align:center'],
    ],
    [
        'class'=>'kartik\grid\BooleanColumn',
        'attribute' =>  'status', 
        'vAlign'    =>  'middle',
        'width'     =>  '91px',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) 
        { 
            if($action == 'update')
            {
                $action = 'edit';
            }
            
            return Url::to(["a/". $action, "id" => $model->candidate_id]);
        },
        'updateOptions'=>['title'=>'Edit product informations', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['title'=>'Delete product', 'data-toggle'=>'tooltip'], 
    ],
];

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
//    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
    'toolbar' => [
        [
            'content' =>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['data-pjax' => 0, 'class' => 'btn btn-success', 'title' => 'Add Candidate', 'style' => 'height:34px']). ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => 'Reset Grid', 'style' => 'height:34px'])
        ],
        '{export}',
        '{toggleData}'
    ],
    'pjax' => true,
    'bordered' => true,
    'striped' => false,
    'condensed' => false,
    'responsive' => true,
    'hover' => true,
//    'floatHeader' => true,
//    'floatHeaderOptions' => ['scrollingTop' => $scrollingTop],
    'showPageSummary' => false,
    'panel' => [
        'type' => GridView::TYPE_PRIMARY
    ],
]);
?>