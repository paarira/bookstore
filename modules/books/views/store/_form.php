<?php

/**
 * @var app\infotech\books\forms\BookCreateForm $model
 */
?>

<div class="col-md-12">
    <?php $form = yii\bootstrap5\ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput() ?>
    <?= $form->field($model, 'description')->textarea() ?>
    <?= $form->field($model, 'year')->textInput() ?>
    <?= $form->field($model, 'isbn')->textInput() ?>
    <?= $form->field($model, 'image')->fileInput() ?>
    <?= $form->field($model, 'authors')->widget(\kartik\select2\Select2::class, [
        'data'          => \yii\helpers\ArrayHelper::map(\app\infotech\authors\models\Author::find()->all(), 'id',
            'full_name'),
        'pluginOptions' => [
            'tags'               => true,
            'tokenSeparators'    => [',', ' '],
            'maximumInputLength' => 10
        ],
        'options'       => [
            'multiple' => true
        ],
    ]) ?>

    <div class="row">
        <div class="col-md-12 d-flex justify-content-end">
            <?= \yii\bootstrap5\Html::button('Сохранить', ['type' => 'submit', 'class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php yii\bootstrap5\ActiveForm::end(); ?>
</div>
