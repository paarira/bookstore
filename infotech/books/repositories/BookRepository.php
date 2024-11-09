<?php

namespace app\infotech\books\repositories;

use app\infotech\basis\BaseRepository;
use app\infotech\books\models\Book;
use yii\data\ActiveDataProvider;

/**
 * @method Book get($id)
 * @method Book|null find($id)
 * @method Book save(Book $model)
 */
class BookRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Book::class);
    }

    public function findAll(): array
    {
        return Book::find()->joinWith(['bookAuthors'])->all();
    }

    public function findAllDataProvider(): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => Book::find()->joinWith(['bookAuthors'])
        ]);
    }

    public function findAllAsArray(): array
    {
        return Book::find()->joinWith(['bookAuthors'])->asArray()->all();
    }
}