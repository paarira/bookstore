<?php
/**
 * @var \yii\web\View $this
 * @var \app\infotech\authors\forms\AuthorForm $authorForm
 */
$this->title = 'Добавить автора';
$this->params['breadcrumbs'][] = ['label' => 'Авторы', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <?= $this->render('_form', [
        'model' => $authorForm
    ]) ?>
</div>
