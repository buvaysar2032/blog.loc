<?php

use common\components\helpers\UserUrl;
use common\models\CodeCategorySearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\CodeCategory
 */

$this->title = Yii::t('app', 'Create Code Category');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Code Categories'),
    'url' => UserUrl::setFilters(CodeCategorySearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="code-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
