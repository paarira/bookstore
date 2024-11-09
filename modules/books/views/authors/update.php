<?php
/**
 * @var \yii\web\View $this
 * @var \app\infotech\authors\forms\AuthorForm $authorForm
 * @var \app\infotech\authors\models\Author $author
 */
$this->title = 'Редактировать';
$this->params['breadcrumbs'][] = ['label' => 'Авторы', 'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => $author->full_name, 'url' => ['view', 'id' => $author->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <?= $this->render('_form', [
        'model' => $authorForm
    ]) ?>
</div>
