<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%code_category}}".
 *
 * @property int         $id
 * @property string      $name
 *
 * @property-read Code[] $codes
 */
class CodeCategory extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%code_category}}';
    }

    public static function findList()
    {
        //return ArrayHelper::map(self::find()->all(), 'id', 'name');
        return self::find()->select(['name', 'id'])->indexBy('id')->column();
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    final public function getCodes(): ActiveQuery
    {
        return $this->hasMany(Code::class, ['code_category_id' => 'id']);
    }
}
