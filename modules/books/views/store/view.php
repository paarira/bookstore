<?php
/**
 * @var \yii\web\View $this
 * @var \app\infotech\books\models\Book $book
 */

$this->title = $book->title;
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <?= \yii\widgets\DetailView::widget([
            'model' => $book
        ]) ?>
    </div>
</div>
