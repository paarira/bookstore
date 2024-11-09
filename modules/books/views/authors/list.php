<?php
/**
 * @var \yii\web\View $this
 * @var \yii\data\ArrayDataProvider $dataProvider
 */
?>

<div class="row">
    <div class="col-md-12 d-flex justify-content-end">
        <?= \yii\bootstrap5\Html::a('Добавить автора', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="col-md-12">
        <div>
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'columns'      => [
                    'id',
                    'full_name',
                    [
                        'class' => \yii\grid\ActionColumn::class
                    ]
                ]
            ]) ?>
        </div>
    </div>
</div>
