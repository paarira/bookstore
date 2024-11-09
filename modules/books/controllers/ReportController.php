<?php

namespace app\modules\books\controllers;

use app\infotech\authors\forms\GenerateReportForm;
use app\infotech\authors\services\ReportService;
use yii\filters\AccessControl;
use yii\web\Controller;

class ReportController extends Controller
{
    private ReportService $reportService;

    public function __construct($id, $module, ReportService $reportService, $config = [])
    {
        $this->reportService = $reportService;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@', '?'],
                ],
            ]
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        $form = new GenerateReportForm();

        if (\Yii::$app->request->isPost) {
            if ($form->load(\Yii::$app->request->post()) && $form->validate()) {
                $dataProvider = $this->reportService->generate($form);
                return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model'        => $form
                ]);
            }
        }

        return $this->render('index', [
            'dataProvider' => null,
            'model'        => $form
        ]);
    }
}