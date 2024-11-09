<?php

namespace app\modules\books\controllers;

use app\infotech\authors\forms\AuthorForm;
use app\infotech\authors\repositories\AuthorRepository;
use app\infotech\authors\services\AuthorService;
use yii\filters\AccessControl;

class AuthorsController extends \yii\web\Controller
{
    private AuthorRepository $authorRepository;
    private AuthorService $authorService;

    public function __construct(
        $id,
        $module,
        AuthorRepository $authorRepository,
        AuthorService $authorService,
        $config = []
    ) {
        $this->authorRepository = $authorRepository;
        $this->authorService = $authorService;
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
                    'roles' => ['@'],
                ],
                [
                    'actions' => ['error'],
                    'allow'   => true,
                    'roles'   => ['?'],
                ],
            ]
        ];
        return $behaviors;
    }

    public function actionList()
    {
        $dataProvider = $this->authorRepository->findAllDataProvider();

        return $this->render('list', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id)
    {
        $author = $this->authorRepository->get($id);

        return $this->render('view', [
            'author' => $author
        ]);
    }

    public function actionCreate()
    {
        $authorForm = new AuthorForm();

        if (\Yii::$app->request->isPost) {
            if ($authorForm->load(\Yii::$app->request->post()) && $authorForm->validate()) {
                $author = $this->authorService->create($authorForm);
                return $this->redirect(['view', 'id' => $author->id]);
            }
        }

        return $this->render('create', [
            'authorForm' => $authorForm
        ]);
    }

    public function actionUpdate($id)
    {
        $author = $this->authorRepository->get($id);
        $form = new AuthorForm([
            'full_name' => $author->full_name
        ]);

        if (\Yii::$app->request->isPost) {
            if ($form->load(\Yii::$app->request->post()) && $form->validate()) {
                $author = $this->authorService->edit($form, $author);
                return $this->redirect(['view', 'id' => $author->id]);
            }
        }

        return $this->render('create', [
            'authorForm' => $form,
            'author'     => $author
        ]);
    }

    public function actionDelete($id)
    {
        $author = $this->authorRepository->get($id);
        $this->authorService->delete($author);
        $this->redirect(['list']);
    }
}