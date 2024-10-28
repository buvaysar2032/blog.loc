<?php

namespace api\modules\v1\controllers;

use common\models\CodeCategory;
use yii\helpers\ArrayHelper;

class CategoryController extends AppController
{
    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'auth' => [
                'except' => ['index']
            ]
        ]);
    }

    public function actionIndex(): array
    {
        $category = CodeCategory::find()->all();

        return $this->returnSuccess([
            'category' => $category
        ]);
    }
}
