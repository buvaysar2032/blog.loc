<?php

use common\components\helpers\UserUrl;
use common\models\CodeSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Code
 */

$this->title = Yii::t('app', 'Create Code');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Codes'),
    'url' => UserUrl::setFilters(CodeSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="code-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
