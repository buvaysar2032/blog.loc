<?php

use admin\components\widgets\detailView\Column;
use admin\modules\rbac\components\RbacHtml;
use common\components\helpers\UserUrl;
use common\models\CodeSearch;
use yii\widgets\DetailView;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Code
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Codes'),
    'url' => UserUrl::setFilters(CodeSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="code-view">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <p>
        <?= RbacHtml::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= RbacHtml::a(
            Yii::t('app', 'Delete'),
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post'
                ]
            ]
        ) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            Column::widget(),
            Column::widget(['attr' => 'code']),
            Column::widget(['attr' => 'promocode']),
            Column::widget(['attr' => 'code_category_id']),
            Column::widget(['attr' => 'user_id']),
            Column::widget(['attr' => 'taken_at']),
            Column::widget(['attr' => 'user_ip']),
            Column::widget(['attr' => 'public_status']),
        ]
    ]) ?>

</div>
