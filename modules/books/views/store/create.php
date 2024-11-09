<?php
/**
 * @var \yii\web\View $this
 * @var \app\infotech\books\forms\BookCreateForm $bookForm
 */
$this->title = 'Добавить книгу';
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <?= $this->render('_form', [
        'model' => $bookForm
    ]) ?>
</div>
