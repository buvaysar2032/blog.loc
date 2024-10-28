<?php

namespace admin\components\uploadForm\models;

use common\models\CodeCategory;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Основа модели для загрузки файлов
 *
 * Можно использовать как основу, наследуясь от неё
 *
 * @package admin\components\uploadForm\models
 * @author  m.kropukhinsky <m.kropukhinsky@peppers-studio.ru>
 */
class UploadForm extends Model
{
    /**
     * Аттрибут файла
     */
    public null|string|UploadedFile $file = null;

    /**
     * Label input-а
     */
    public string $label = 'Загрузите файл';

    /**
     * Допустимые расширения файла
     */
    public string $extensions = 'csv,xlsx,ods';

    /**
     * Код категории
     */
    public ?int $code_category_id = null;

    /**
     * {@inheritdoc}
     */
    final public function rules(): array
    {
        return [
            [
                'file',
                'file',
                'skipOnEmpty' => false,
                'extensions' => $this->extensions,
                'checkExtensionByMimeType' => false,
            ],
            [['code_category_id'], 'integer'],
            [['code_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => CodeCategory::class, 'targetAttribute' => ['code_category_id' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return ['file' => $this->label];
    }
}
