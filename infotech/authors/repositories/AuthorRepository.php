<?php

namespace app\infotech\authors\repositories;

use app\infotech\authors\models\Author;
use app\infotech\basis\BaseRepository;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

/**
 * @method Author get($id)
 * @method Author|null find($id)
 * @method Author save(Author $model)
 */
class AuthorRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Author::class);
    }

    public function findAllDataProvider(): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => Author::find()
        ]);
    }

    public function findTopAuthorsReportByYear(int $year): ArrayDataProvider
    {
        $sql = <<<SQL
        SELECT COUNT(*) AS quantity, a.full_name
            FROM `books` AS b
        LEFT JOIN `book_authors` AS ba ON b.id = ba.book_id
        LEFT JOIN `authors` AS a ON ba.author_id = a.id
        WHERE b.year = :year
        GROUP BY a.id
        ORDER BY quantity DESC LIMIT 10
        SQL;

        $command = \Yii::$app->getDb()
            ->createCommand($sql)
            ->bindValue(':year', $year)
            ->queryAll();

        return new ArrayDataProvider([
            'allModels' => $command
        ]);
    }
}