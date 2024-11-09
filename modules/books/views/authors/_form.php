<?php

/**
 * @var \app\infotech\authors\forms\AuthorForm $model
 */
?>

<div class="col-md-12">
    <?php $form = yii\bootstrap5\ActiveForm::begin(); ?>

    <?= $form->field($model, 'full_name')->textInput() ?>

    <div class="row">
        <div class="col-md-12 d-flex justify-content-end">
            <?= \yii\bootstrap5\Html::button('Сохранить', ['type' => 'submit', 'class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php yii\bootstrap5\ActiveForm::end(); ?>
</div>
