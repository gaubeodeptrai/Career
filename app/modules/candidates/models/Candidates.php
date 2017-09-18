<?php
namespace app\modules\candidates\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\easyii\behaviors\SeoBehavior;
use yii\easyii\behaviors\Taggable;
use yii\easyii\models\Photo;
use yii\helpers\StringHelper;

//Relationship
use app\modules\nationals\models\Nationals;
use app\modules\spokenlanguages\models\Spokenlanguages;
use yii\easyii\modules\catalog\models\Category;
use app\models\LastJob;

class Candidates extends \yii\easyii\components\ActiveRecord
{
    const STATUS_OFF = 0;
    const STATUS_ON = 1;
    public $work_at;
    public $work_as_id;
    public $salary_currency_unit;
    public $salary_amount;
    public $year_join;
    public $year_left;
    
    public $work_period;
    public $number_of_hours;
    public $start_date;
    public $end_date;
    
    public $expected_salary_currency_unit;
    public $expected_salary_amount;
    
    public static function tableName()
    {
        return 'candidates';
    }

    public function rules()
    {
        return [
            [
                [
                    'fullname','age', 'marital', 'nationality_id', 'visa_status', 'spoken_language_id',
                    'place_of_residence', 'expected_salary_currency_unit', 'expected_salary_amount',
                    'education_level', 'contact_number', 'employment_status', 'category_id', 'work_time',
                    'year_join', 'year_left', 'work_at', 'work_as_id',
                    'salary_currency_unit', 'salary_amount', 'sex'
                ], 
                'required'
            ],
            [
                ['work_period','number_of_hours'],
                'required', 
                'when' => function($model) {
                    return $model->work_time == 'parttime';
                },
                'whenClient' => "function (attribute, value) {
                        return $('#candidates-work_time input:checked').val() == 'parttime';
                }"
            ],
            [['fullname', 'visa_status', 'place_of_residence', 'education_level', 'employment_status', 'work_time'], 'string'],
            [['contact_number'], 'string', 'max' => 12],
            ['image', 'image', 'extensions' => 'png, jpg, gif'],
            [['cv'], 'file', 'extensions'=>'pdf,doc,docx'],
            [['marital', 'nationality_id','job_id' ,'category_id','user_id' ,'last_job_id', 'parttime_id', 'age', 'expected_salary_amount', 'salary_amount'], 'integer'],
            ['expected_salary', 'string', 'max' => 64],
            ['time', 'default', 'value' => time()],
            ['slug', 'match', 'pattern' => self::$SLUG_PATTERN, 'message' => Yii::t('easyii', 'Slug can contain only 0-9, a-z and "-" characters (max: 128).')],
            ['slug', 'default', 'value' => null],
            ['status', 'default', 'value' => self::STATUS_ON],
            ['text', 'safe'],            
        ];
    }

    public function attributeLabels()
    {
        return [
            'place_of_residence' => 'Place of residence',
            'expected_salary' => 'Expected salary',
            'education_level' => 'Education level',
            'contact_number' => 'Contact number',
            'employment_status' => "Employment status",
            'work_time' => 'Work time',
            'spoken_language_id' => 'Spoken language',
            'nationality_id' => "National",
            'work_as_id' => 'Work as',
            'category_id' => 'Job categories',
            'cv' => 'CV'
        ];
    }

    public function behaviors()
    {
        return [
            'seoBehavior' => SeoBehavior::className(),
            'taggabble' => Taggable::className(),
            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'fullname',
                'ensureUnique' => true
            ],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(\dektrium\user\models\User::className(),['id'=>'user_id']);
    }
    
    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['item_id' => 'candidate_id'])->where(['class' => self::className()])->sort();
    }



    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if(!$insert && $this->image != $this->oldAttributes['image'] && $this->oldAttributes['image']){
                @unlink(Yii::getAlias('@webroot').$this->oldAttributes['image']);
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterDelete()
    {
        parent::afterDelete();

        if($this->image){
            @unlink(Yii::getAlias('@webroot').$this->image);
        }

        foreach($this->getPhotos()->all() as $photo){
            $photo->delete();
        }
    }

    public function getNationals()
    {
        return $this->hasOne(Nationals::className(), ['national_id' => 'nationality_id']);
    }
    
    public function getResume()
    {
        return $this->hasOne(\app\models\Resume::className(), ['user_id' => 'user_id']);
    }
    
    public function getSpokenlanguages()
    {
        return $this->hasOne(Spokenlanguages::className(), ['language_id' => 'spoken_language_id']);
    }
    
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
    }
    
    public function getLastJob()
    {
        return $this->hasOne(LastJob::className(), ['candidate_id' => 'candidate_id']);
    }
    
    public function getParttime()
    {
        return $this->hasOne(\app\models\Parttime::className(), ['candidate_id' => 'candidate_id']);
    }
    
    public function getTagassign()
    {
        return $this->hasMany(\yii\easyii\models\TagAssign::className(), ['item_id' => 'candidate_id']);
    }
    
}