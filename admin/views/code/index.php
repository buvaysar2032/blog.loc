<?php

use admin\components\GroupedActionColumn;
use admin\components\widgets\gridView\Column;
use admin\modules\rbac\components\RbacHtml;
use admin\widgets\sortableGridView\SortableGridView;
use kartik\grid\SerialColumn;
use yii\widgets\ListView;

/**
 * @var $this         yii\web\View
 * @var $searchModel  common\models\CodeSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\Code
 */

$this->title = Yii::t('app', 'Codes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="code-index">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <div>
        <?=
            RbacHtml::a(Yii::t('app', 'Create Code'), ['create'], ['class' => 'btn btn-success']);
//           $this->render('_create_modal', ['model' => $model]);
        ?>
    </div>

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'pjax' => true,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],

            Column::widget(),
            Column::widget(['attr' => 'code']),
            Column::widget(['attr' => 'promocode']),
            Column::widget(['attr' => 'code_category_id']),
            Column::widget(['attr' => 'user_id']),
            Column::widget(['attr' => 'taken_at']),
            Column::widget(['attr' => 'user_ip']),
            Column::widget(['attr' => 'public_status']),

            ['class' => GroupedActionColumn::class]
        ]
    ]) ?>
</div>
