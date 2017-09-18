<?php
namespace app\modules\companies\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\easyii\behaviors\SeoBehavior;
use yii\easyii\behaviors\Taggable;
use yii\easyii\models\Photo;
use yii\helpers\StringHelper;

class Companies extends \yii\easyii\components\ActiveRecord
{
    const STATUS_OFF = 0;
    const STATUS_ON = 1;

    public static function tableName()
    {
        return 'companies';
    }

    public function rules()
    {
        return [
            [['company_name','business', 'company_address', 'company_tel', 'company_size'], 'required'],
            [['views','time', 'status','user_id','location_id'], 'integer'],
            ['logo', 'image'],
            [['company_site','facebook','linkedin','twitter','googleplus'],'url'],
            ['about', 'safe'],
            ['time', 'default', 'value' => time()],
            ['slug', 'match', 'pattern' => self::$SLUG_PATTERN, 'message' => Yii::t('easyii', 'Slug can contain only 0-9, a-z and "-" characters (max: 128).')],
            ['slug', 'default', 'value' => null],
            ['status', 'default', 'value' => self::STATUS_ON],
        ];
    }

    public function attributeLabels()
    {
        return [
            'company_name' => "Company name",
            'company_address' => "Company address",
            'company_tel' => "Company telephone",
            'company_site' => "Company site",
            'company_size' => "Company size"
        ];
    }

    public function behaviors()
    {
        return [
            'sluggable' => [
                //'seoBehavior' => SeoBehavior::className(), 
                'class' => SluggableBehavior::className(),
                'attribute' => 'company_name',
                'ensureUnique' => true
            ],
        ];
    }

    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['item_id' => 'company_id'])->where(['class' => self::className()])->sort();
    }
    
    public function getUser()
    {
        return $this->hasOne(\dektrium\user\models\User::className(),['id'=>'user_id']);
    }
    
    public function getJob(){
        return $this->hasOne(\yii\easyii\modules\catalog\models\Item::className(),['company_id'=>'company_id'] );
    }
    
}