<?php
/**
 * @var \yii\web\View $this
 * @var \app\infotech\authors\forms\GenerateReportForm $model
 * @var \yii\data\SqlDataProvider|null $dataProvider
 */
?>

<div class="row">
    <div class="col-md-12">
        <?php $form = \yii\bootstrap5\ActiveForm::begin(); ?>

        <?= $form->field($model, 'year')->textInput() ?>
        <?= \yii\bootstrap5\Html::button('Сформировать', ['type' => 'submit', 'class' => 'btn btn-success']) ?>

        <?php \yii\bootstrap5\ActiveForm::end(); ?>
    </div>
    <div class="col-md-12">
        <?php if ($dataProvider) :?>
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider
            ]) ?>
        <?php endif; ?>
    </div>
</div>
