<?php

use admin\components\GroupedActionColumn;
use admin\components\uploadForm\UploadFormWidget;
use admin\components\widgets\gridView\Column;
use admin\components\widgets\gridView\ColumnDate;
use admin\components\widgets\gridView\ColumnSelect2;
use admin\modules\rbac\components\RbacHtml;
use admin\widgets\sortableGridView\SortableGridView;
use common\enums\CodeStatus;
use common\models\CodeCategory;
use kartik\grid\SerialColumn;
use yii\helpers\Url;
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
        <?php
            echo RbacHtml::a(Yii::t('app', 'Create Code'), ['create'], ['class' => 'btn btn-success']);
            // $this->render('_create_modal', ['model' => $model]);
            echo UploadFormWidget::widget([
                'action' => Url::to(['code/upload']),
                'btnMessage' => 'Загрузить из файла',
                'title' => 'Загрузить викторину',
            ])
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
            ColumnSelect2::widget(['attr' => 'code_category_id', 'items' => CodeCategory::findList(), 'hideSearch' => true]),
            ColumnSelect2::widget([
                'attr' => 'user_id',
                'viewAttr' => 'user.username',
                'pathLink' => 'user/user',
                'editable' => false,
                'placeholder' => Yii::t('app', 'Search...'),
                'ajaxSearchConfig' => [
                    'url' => Url::to(['/user/user/list']),
                    'searchModel' => $searchModel
                ]
            ]),
            ColumnDate::widget(['attr' => 'taken_at', 'searchModel' => $searchModel, 'editable' => false]),
            Column::widget(['attr' => 'user_ip', 'format' => 'ip', 'editable' => false]),
            ColumnSelect2::widget(['attr' => 'public_status', 'items' => CodeStatus::indexedDescriptions()]),

            ['class' => GroupedActionColumn::class]
        ]
    ]) ?>
</div>
