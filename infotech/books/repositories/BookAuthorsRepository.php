<?php

namespace app\infotech\books\repositories;

use app\infotech\basis\BaseRepository;
use app\infotech\books\models\BookAuthor;

class BookAuthorsRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(BookAuthor::class);
    }

    public function findAuthorIdsByBookId(int $book_id): ?array
    {
        return BookAuthor::find()
            ->select('id')
            ->andWhere(['book_id' => $book_id])
            ->asArray()
            ->column();
    }
}