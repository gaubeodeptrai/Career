<?php
namespace app\modules\spokenlanguages\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\easyii\behaviors\Taggable;
use yii\helpers\StringHelper;

class Spokenlanguages extends \yii\easyii\components\ActiveRecord
{
    const STATUS_OFF = 0;
    const STATUS_ON = 1;

    public static function tableName()
    {
        return 'spoken_languages';
    }

    public function rules()
    {
        return [
            [['language_name'], 'string'],
            [['time', 'status'], 'integer'],
            ['time', 'default', 'value' => time()],
            ['slug', 'match', 'pattern' => self::$SLUG_PATTERN, 'message' => Yii::t('easyii', 'Slug can contain only 0-9, a-z and "-" characters (max: 128).')],
            ['slug', 'default', 'value' => null],
            ['status', 'default', 'value' => self::STATUS_ON],
        ];
    }

    public function attributeLabels()
    {
        return [
            'language_name' => "Language name",
        ];
    }

    public function behaviors()
    {
        return [
            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'language_name',
                'ensureUnique' => true
            ],
        ];
    }
}