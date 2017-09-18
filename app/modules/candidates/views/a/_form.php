<?php
use yii\easyii\widgets\DateTimePicker;
use yii\easyii\helpers\Image;
use yii\easyii\widgets\TagsInput;
use yii\helpers\Html;
use yii\helpers\Url;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\easyii\widgets\Redactor;
use yii\easyii\widgets\SeoForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\modules\nationals\models\Nationals;
use app\modules\spokenlanguages\models\Spokenlanguages;
use yii\easyii\modules\catalog\models\Category;
use kartik\date\DatePicker;
use yii\bootstrap\Modal;

use richardfan\widget\JSRegister;
use yii2assets\pdfjs\PdfJs;

$action = $this->context->module->module->module->controller->action->id;
$module = $this->context->module->id;
$baseUrl = \yii\helpers\Url::base(true);
?>

<?php if($model->cv):?>
    <div class='row'>
        <?php
            Modal::begin([
                'header' => '<h3 style="text-align: center">CV - '.$model->fullname.'</h3>',
            ]);
                echo PdfJs::widget([
                    'url' => $baseUrl.'/'.$model->cv,
                ]);
            Modal::end();
        ?>
    </div>
<?php endif;?>
<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'options' => ['enctype' => 'multipart/form-data', 'class' => 'model-form', 'id' => 'myForm']
]); ?>

<div class="panel panel-primary">
    <div class="panel-heading">Candidate information</div>
    <div class="panel-body">
        <!-- Full name -->
        <div class="col-md-9">
            <?= $form->field($model, 'fullname')?>
        </div>
        
        <!-- Age -->
        <div class="col-md-3">
            <?= $form->field($model, 'age')->textInput(['id' => 'age'])?>
        </div>
        
        <!-- Image-->
        <div class='col-md-12'>
            <div class="col-md-6 col-xs-12 col-sm-12">
                <?php if($model->image) : ?>
                    <img src="<?= Image::thumb($model->image, 240) ?>">
                    <a href="<?= Url::to(['/admin/'.$module.'/a/clear-image', 'id' => $model->candidate_id]) ?>" class="text-danger confirm-delete" title="<?= Yii::t('easyii', 'Clear image')?>"><?= Yii::t('easyii', 'Clear image')?></a>
                <?php endif; ?>
                <?= $form->field($model, 'image')->fileInput() ?>
            </div>
            <!--Cv-->
            <div class='col-md-6 col-sm-12 col-xs-12'>
                <?php if($model->cv) : ?>
                    <?= $form->field($model, 'cv')->fileInput()->label('<button type="button" class="btn btn-primary" data-toggle = "modal" data-target = "#w0">View CV</button>') ?>
                <?php else:?>
                    <?= $form->field($model, 'cv')->fileInput() ?>
                <?php endif;?>
                    
            </div>
        </div>
        <!-- Marital-->
        <div class="col-md-3">
            <?=
                $form->field($model, 'marital')->widget(Select2::className(), [
                    'data' => [
                        '0' => 'Single',
                        '1' => 'Married'
                    ],
                    'options' => [
                        'placeholder' => 'Select marital...'
                    ]
                ])
            ?>
        </div>
        
        <!-- Nationality-->
        <div class="col-md-3">
            <?=
                $form->field($model, 'nationality_id')->widget(Select2::className(), [
                    'data' => ArrayHelper::map(Nationals::find()->all(), 'national_id', 'title'),
                    'options' => [
                        'placeholder' => 'Select national...'
                    ]
                ])
            ?>
        </div>
        
        <!-- Visa status-->
        <div class="col-md-3">
            <?=
                $form->field($model, 'visa_status')->widget(Select2::className(), [
                    'data' => [
                        'pr' => 'PR',
                        'wp' => 'WP',
                        'spass' => 'SPASS'
                    ],
                    'options' => [
                        'placeholder' => 'Select visa...'
                    ]
                ])
            ?>
        </div>
        
        <!-- spoken language-->
        <div class="col-md-3">
            <?=
                $form->field($model, 'spoken_language_id')->widget(Select2::className(), [
                    'data' => ArrayHelper::map(Spokenlanguages::find()->all(), 'language_id', 'language_name'),
                    'options' => [
                        'placeholder' => 'Spoken language...'
                    ]
                ])
            ?>
        </div>
        
        <!-- Place of residence-->
        <div class="col-md-4">
            <?=
                $form->field($model, 'place_of_residence');
            ?>
        </div>
        
        <div class="col-md-4">
            <!-- Expected number-->
            <div class="form-group" style="margin-bottom: 0px !important">
                <label class="control-label">Expected salary</label>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-5 col-xs-4" style='padding-right: -20px !important;'>
                    <?= 
                        $form->field($model, 'expected_salary_amount')->textInput(['placeholder' => 'Enter salary...', 'style' => 'text-align: right'])->label(FALSE);
                    ?>
                </div>

                <div class="col-md-6 col-sm-7 col-xs-8" style='padding-left: 0px !important'>
                    <?=
                        $form->field($model, 'expected_salary_currency_unit')->widget(Select2::className(), [
                            'data' => [
                                'usd' => 'USD',
                                'sgd' => 'SGD'
                            ],
                            'options' => [
                                'placeholder' => 'Select currency unit...',
                            ]
                        ])->label(FALSE);
                    ?>
                </div>
            </div>
        </div>
        
        <!-- Education_level-->
        <div class="col-md-4">
            <?=
                $form->field($model, 'education_level')->widget(Select2::className(), [
                    'data' => [
                        'primary' => 'Primary',
                        'secondary' => 'Secondary',
                        'poly' => 'Poly',
                        'jc' => 'JC',
                        'tertiary' => 'Tertiary',
                        'none' => 'None'
                    ],
                    'options' => [
                        'placeholder' => 'Select education level...'
                    ]
                ])
            ?>
        </div>
        
        <!-- Contact number-->
        <div class="col-md-4">
            <?=
                $form->field($model, 'contact_number');
            ?>
        </div>
        
        <!-- Employment status-->
        <div class="col-md-4">
            <?=
                $form->field($model, 'employment_status')->widget(Select2::className(),[
                    'data' => [
                        'retired' => 'RETIRED',
                        'student' => 'STUDENT',
                        'housewife' => 'HOUSEWIFE',
                        'inbetweenjobs' => 'IN BETWEEN JOBS',
                        'employed' => 'EMPLOYED',
                        'unemployed' => 'UNEMPLOYED'
                    ],
                    'options' => [
                        'placeholder' => 'Select employment status...'
                    ]
                ])
            ?>
        </div>
        
        <!-- Job categories-->
        <div class="col-md-4">
            <?=
                $form->field($model, 'category_id')->widget(Select2::className(), [
                    'data' => ArrayHelper::map(Category::find()->all(), 'category_id', 'title'),
                    'options' => [
                        'placeholder' => 'Select job category...'
                    ]
                ])
            ?>
        </div>
        
        <!-- Work time-->
        <div class="col-md-4">
            <?php
                if(!$model->work_time)
                {
                    $model->work_time = 'fulltime';
                }
            ?>
            <div class="form-group" style="margin-bottom: 0px !important">
                <label class="control-label">Work time</label>
            </div>
            
            <div class="row">
                <div class='col-md-12 col-sm-12 col-xs-12'>
                    <?= $form->field($model, 'work_time')->inline(true)->radioList(['fulltime' => 'Full-time', 'parttime' => 'Part-time'])->label(false) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-primary" id="parttime" style="display : none">
    <div class="panel-heading">Candidate parttime information</div>
    <div class="panel-body">
        <div>
            <!-- Work period -->
            <div class="col-md-8">
                <?=
                    $form->field($model, 'work_period')->widget(Select2::className(), [
                        'data' => [
                            'weekday_day' => 'Weekday day',
                            'weekday_night' => 'Weekday night',
                            'weekend_day' => 'Weekend day',
                            'weekend_night' => 'Weekend night'
                        ],
                        'options' => [
                            'placeholder' => 'Select work period...'
                        ]
                    ])
                ?>
            </div>
            
            <!--  Number of hours-->
            <div class="col-md-4">
                <?=
                    $form->field($model, 'number_of_hours')->widget(Select2::className(), [
                        'data' => [
                            1 => 1,
                            2 => 2,
                            3 => 3,
                            4 => 4,
                            5 => 5,
                            6 => 6,
                            7 => 7,
                            8 => 8,
                            9 => 9,
                            10 => 10,
                            11 => 11,
                            12 => 12
                        ],
                        'options' => [
                            'placeholder' => 'Select number of hours...'
                        ]
                    ])
                ?>
            </div>
            
            <!--  Availability Start date and End Date-->
            <?php
            $date_ranger = <<< HTML
    <span class="input-group-addon" style="text-align: center">Start Date</span>
    {input1}
    <span class="input-group-addon" style="text-align: center">End Date</span>
    {input2}
    <span class="input-group-addon kv-date-remove" style="text-align : center">
        <i class="glyphicon glyphicon-remove"></i>
    </span>
HTML;
            echo '<div class = "col-md-12">';
            echo '<label class="control-label">Availability</label>';
            if($model->work_time == 'parttime')
            {
                echo DatePicker::widget([
                    'type' => DatePicker::TYPE_RANGE,
                    'name' => 'start_date',
                    'value' => $model->start_date,
                    'name2' => 'end_date',
                    'value2' => $model->end_date,
                    'separator' => '<i class="glyphicon glyphicon-resize-horizontal"></i>',
                    'layout' => $date_ranger,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-M-yyyy'
                    ]
                ]);
            }else
            {
                echo DatePicker::widget([
                    'type' => DatePicker::TYPE_RANGE,
                    'name' => 'start_date',
                    'value' => date('d-M-Y'),
                    'name2' => 'end_date',
                    'value2' => date('d-M-Y'),
                    'separator' => '<i class="glyphicon glyphicon-resize-horizontal"></i>',
                    'layout' => $date_ranger,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-M-yyyy'
                    ]
                ]);
            }
            echo '</div>';
?>
        </div>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">Candidate last job information</div>
    <div class="panel-body">
        <?php
            $current_year = date('Y');
            $min_year = $current_year - 10;
            $data = [];
            for($i = $min_year; $i<= $current_year; $i++)
            {
                $data[$i] = $i; 
            }
        ?>
        <!-- Year join-->
        <div class="col-md-6">
            <?=
                $form->field($model, 'year_join')->widget(Select2::className(), [
                    'data' => $data,
                    'options' => [
                        'placeholder' => 'Select year join...'
                    ]
                ])
            ?>
        </div>
        
        <!-- Year left-->
        <div class="col-md-6">
            <?=
                $form->field($model, 'year_left')->widget(Select2::className(), [
                    'data' => $data,
                    'options' => [
                        'placeholder' => 'Select year left...'
                    ]
                ])
            ?>
        </div>
        
        <!-- Work at-->
        <div class="col-md-6">
            <?= $form->field($model, 'work_at')?>
        </div>
        
        <!-- Work as-->
        <div class="col-md-6">
            <?=
                $form->field($model, 'work_as_id')->widget(Select2::className(), [
                    'data' => ArrayHelper::map(Category::find()->all(), 'category_id', 'title'),
                    'options' => [
                        'placeholder' => 'Work as...'
                    ]
                ])
            ?>
        </div>
        
        
        <!-- Salary-->
        <div class="col-md-12">
            <div class="form-group" style="margin-bottom: 0px !important">
                <label class="control-label">Salary</label>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= 
                        $form->field($model, 'salary_amount')->textInput(['placeholder' => 'Enter salary...'])->label(FALSE);
                    ?>
                </div>

                <div class="col-md-6">
                    <?=
                        $form->field($model, 'salary_currency_unit')->widget(Select2::className(), [
                            'data' => [
                                'usd' => 'USD',
                                'sgd' => 'SGD'
                            ],
                            'options' => [
                                'placeholder' => 'Select currency unit...',
                            ]
                        ])->label(FALSE);
                    ?>
                </div>
            </div>
        </div>
        
    </div>
</div>

<?= Html::submitButton(Yii::t('easyii', 'Save'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>

<?php JSRegister::begin();?>
<script>
//Get checked work_time
    var work_time_checked = $('input[name="Candidates[work_time]"]:checked', '#myForm').val();
    if(work_time_checked == 'parttime')
    {
        $('#parttime').css({'display' : 'block'});
    }
    $('#myForm input').on('change', () => {
        var work_time_change_checked =  $('input[name="Candidates[work_time]"]:checked', '#myForm').val();
        if(work_time_change_checked == 'parttime')
        {
            $('#parttime').css({'display' : 'block'});
        }
        else if(work_time_change_checked == 'fulltime')
        {
            $('#parttime').css({'display' : 'none'});
        }
    });
</script>
<?php JSRegister::end();?>
