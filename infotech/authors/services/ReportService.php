<?php

namespace app\infotech\authors\services;

use app\infotech\authors\forms\GenerateReportForm;
use app\infotech\authors\repositories\AuthorRepository;
use yii\data\ArrayDataProvider;

class ReportService
{
    private AuthorRepository $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function generate(GenerateReportForm $form): ArrayDataProvider
    {
        return $this->authorRepository->findTopAuthorsReportByYear($form->year);
    }
}