<?php
/**
 * @var \yii\web\View $this
 * @var \app\infotech\authors\models\Author $author
 */

$this->title = $author->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Авторы', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <?= \yii\widgets\DetailView::widget([
            'model' => $author
        ]) ?>
    </div>
</div>
