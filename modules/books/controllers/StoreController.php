<?php

namespace app\modules\books\controllers;

use app\infotech\books\forms\BookCreateForm;
use app\infotech\books\forms\BookEditForm;
use app\infotech\books\repositories\BookAuthorsRepository;
use app\infotech\books\repositories\BookRepository;
use app\infotech\books\services\BookService;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;

class StoreController extends Controller
{
    private BookRepository $bookRepository;
    private BookAuthorsRepository $bookAuthorsRepository;
    private BookService $bookService;


    public function __construct(
        $id,
        $module,
        BookRepository $bookRepository,
        BookAuthorsRepository $bookAuthorsRepository,
        BookService $bookService,
        $config = []
    ) {
        $this->bookRepository = $bookRepository;
        $this->bookAuthorsRepository = $bookAuthorsRepository;
        $this->bookService = $bookService;
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
                    'actions' => ['error', 'list', 'view'],
                    'allow'   => true,
                    'roles'   => ['?'],
                ],
            ]
        ];
        return $behaviors;
    }

    public function actionList()
    {
        $dataProvider = $this->bookRepository->findAllDataProvider();

        return $this->render('list', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id)
    {
        $book = $this->bookRepository->get($id);

        return $this->render('view', [
            'book' => $book
        ]);
    }

    public function actionCreate()
    {
        $bookForm = new BookCreateForm();

        if (\Yii::$app->request->isPost) {
            if ($bookForm->load(\Yii::$app->request->post())) {
                $bookForm->image = UploadedFile::getInstance($bookForm, 'image');

                if (!$bookForm->image) {
                    $bookForm->addError('image', 'File not uploaded.');
                }

                if ($bookForm->validate()) {
                    $book = $this->bookService->create($bookForm);
                    return $this->redirect(['view', 'id' => $book->id]);
                }
            }
        }

        return $this->render('create', [
            'bookForm' => $bookForm
        ]);
    }

    public function actionUpdate($id)
    {
        $bookModel = $this->bookRepository->get($id);
        $authorIds = $this->bookAuthorsRepository->findAuthorIdsByBookId($bookModel->id);

        $bookForm = new BookEditForm([
            'title'       => $bookModel->title,
            'description' => $bookModel->description,
            'year'        => $bookModel->year,
            'isbn'        => $bookModel->isbn,
            'image_old'   => $bookModel->image_path,
            'authors'     => $authorIds
        ]);

        if (\Yii::$app->request->isPost) {
            if ($bookForm->load(\Yii::$app->request->post())) {
                $bookForm->image = UploadedFile::getInstance($bookForm, 'image');

                if (!$bookForm->image) {
                    $bookForm->addError('image', 'File not uploaded.');
                }

                if ($bookForm->validate()) {
                    $book = $this->bookService->edit($bookForm, $bookModel, $authorIds);
                    return $this->redirect(['view', 'id' => $book->id]);
                }
            }
        }

        return $this->render('update', [
            'bookForm' => $bookForm,
            'book'     => $bookModel
        ]);
    }

    public function actionDelete($id)
    {
        $book = $this->bookRepository->get($id);
        $this->bookService->delete($book);
        return $this->redirect('list');
    }

    public function actionSubscribe()
    {

    }
}