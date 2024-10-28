<?php

use admin\components\widgets\detailView\Column;
use admin\components\widgets\gridView\ColumnDate;
use admin\components\widgets\gridView\ColumnSelect2;
use admin\modules\rbac\components\RbacHtml;
use common\components\helpers\UserUrl;
use common\enums\CodeStatus;
use common\models\CodeCategory;
use common\models\CodeSearch;
use yii\helpers\Url;
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
            ColumnSelect2::widget(['attr' => 'code_category_id', 'items' => CodeCategory::findList(), 'hideSearch' => true]),
            ColumnSelect2::widget([
                'attr' => 'user_id',
                'viewAttr' => 'user.username',
                'pathLink' => 'user/user',
                'editable' => false,
                'placeholder' => Yii::t('app', 'Search...'),
            ]),
            ColumnDate::widget(['attr' => 'taken_at', 'searchModel' => $model]),
            Column::widget(['attr' => 'user_ip', 'format' => 'ip']),
            ColumnSelect2::widget(['attr' => 'public_status', 'items' => CodeStatus::indexedDescriptions()]),
        ]
    ]) ?>

</div>
