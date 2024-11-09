<?php
/**
 * @var \yii\web\View $this
 * @var \app\infotech\books\forms\BookCreateForm $bookForm
 * @var \app\infotech\books\models\Book $book
 */

$this->title = 'Редактировать';
$this->params['breadcrumbs'][] = ['label' => 'Каталолг', 'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => $book->title, 'url' => ['view', 'id' => $book->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <?= $this->render('_form', [
        'model' => $bookForm
    ]) ?>
</div>
