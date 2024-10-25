<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%code}}".
 *
 * @property int               $id
 * @property string            $code
 * @property string            $promocode
 * @property int               $code_category_id
 * @property int               $user_id
 * @property int|null          $taken_at
 * @property int|null          $user_ip
 * @property int|null          $public_status
 *
 * @property-read CodeCategory $codeCategory
 */
class Code extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%code}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['code', 'promocode', 'code_category_id', 'user_id'], 'required'],
            [['code_category_id', 'user_id', 'taken_at', 'user_ip', 'public_status'], 'integer'],
            [['code'], 'string', 'max' => 6],
            [['promocode'], 'string', 'max' => 255],
            [['code_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => CodeCategory::class, 'targetAttribute' => ['code_category_id' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'promocode' => Yii::t('app', 'Promocode'),
            'code_category_id' => Yii::t('app', 'Code Category ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'taken_at' => Yii::t('app', 'Taken At'),
            'user_ip' => Yii::t('app', 'User Ip'),
            'public_status' => Yii::t('app', 'Public Status'),
        ];
    }

    final public function getCodeCategory(): ActiveQuery
    {
        return $this->hasOne(CodeCategory::class, ['id' => 'code_category_id']);
    }
}
