<?php
/**
 * @var \yii\web\View $this
 * @var \yii\data\ArrayDataProvider $dataProvider
 */
?>

<div class="row">
    <div class="col-md-12 d-flex justify-content-end">
        <?= \yii\bootstrap5\Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="col-md-12">
        <div>
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'columns'      => [
                    'id',
                    'title',
                    'description',
                    'year',
                    'isbn',
                    'image_path',
                    [
                        'attribute' => 'created_at',
                        'value'     => function ($model) {
                            return Yii::$app->formatter->asDatetime($model->created_at, 'php:d.m.Y H:i:s');
                        }
                    ],
                    [
                        'attribute' => 'updated_at',
                        'value'     => function ($model) {
                            return Yii::$app->formatter->asDatetime($model->updated_at, 'php:d.m.Y H:i:s');
                        }
                    ],
                    [
                        'class' => \yii\grid\ActionColumn::class
                    ]
                ]
            ]) ?>
        </div>
    </div>
</div>
