<?php

namespace app\infotech\books\services;

use app\infotech\authors\models\Author;
use app\infotech\authors\repositories\AuthorRepository;
use app\infotech\books\forms\BookCreateForm;
use app\infotech\books\forms\BookEditForm;
use app\infotech\books\models\Book;
use app\infotech\books\models\BookAuthor;
use app\infotech\books\repositories\BookAuthorsRepository;
use app\infotech\books\repositories\BookRepository;
use yii\db\Exception;
use yii\web\UploadedFile;

class BookService
{
    private BookRepository $bookRepository;
    private AuthorRepository $authorRepository;
    private BookAuthorsRepository $bookAuthorsRepository;

    public function __construct(
        BookRepository $bookRepository,
        AuthorRepository $authorRepository,
        BookAuthorsRepository $bookAuthorsRepository
    ) {
        $this->bookRepository = $bookRepository;
        $this->authorRepository = $authorRepository;
        $this->bookAuthorsRepository = $bookAuthorsRepository;
    }

    public function create(BookCreateForm $form): Book
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $book = new Book([
                'title'       => $form->title,
                'description' => $form->description,
                'year'        => $form->year,
                'isbn'        => $form->isbn,
                'image_path'  => $form->image ? $this->loadImage($form->image) : null
            ]);

            $book = $this->bookRepository->save($book);

            foreach ($form->authors as $authorId) {
                $author = $this->authorRepository->get($authorId);
                $bookAuthor = new BookAuthor([
                    'book_id'   => $book->id,
                    'author_id' => $author->id
                ]);
                $this->bookAuthorsRepository->save($bookAuthor);
            }
            $transaction->commit();
            return $book;
        } catch (\DomainException $e) {
            $transaction->rollBack();
            throw new \DomainException($e->getMessage());
        }
    }

    public function edit(BookEditForm $form, Book $book, array $currentAuthors): Book
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $book->title = $form->title;
            $book->description = $form->description;
            $book->year = $form->year;
            $book->isbn = $form->isbn;

            if ($form->image) {
                $book->image_path = $this->loadImage($form->image);
                if (is_file(\Yii::$app->params['uploadPath'] . $form->image_old)) {
                    unlink(\Yii::$app->params['uploadPath'] . $form->image_old);
                }
            }

            $book = $this->bookRepository->save($book);

            $removeAuthorIds = array_diff($currentAuthors, $form->authors);
            $newAuthorIds = array_diff($form->authors, $currentAuthors);

            // Append new authors
            foreach ($newAuthorIds as $authorId) {
                $author = $this->authorRepository->get($authorId);
                $bookAuthor = new BookAuthor([
                    'book_id'   => $book->id,
                    'author_id' => $author->id
                ]);
                if ($bookAuthor->validate()) {
                    $this->bookAuthorsRepository->save($bookAuthor);
                } else {
                    throw new \DomainException('Не удалось сохранить авторов');
                }
            }

            // Removed authors
            foreach ($removeAuthorIds as $authorId) {
                $author = $this->bookAuthorsRepository->get($authorId);
                $this->bookAuthorsRepository->delete($author);
            }

            $transaction->commit();
            return $book;
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function delete(Book $book): void
    {
        $image = $book->image_path;
        if ($book->delete()) {
            if (is_file(\Yii::$app->params['uploadPath'] . $image)) {
                unlink(\Yii::$app->params['uploadPath'] . $image);
            }
        }
    }

    private function loadImage(UploadedFile $image): string
    {
        $imageName = $image->baseName . '_' . time() . '.' . $image->extension;
        $image->saveAs(\Yii::$app->params['uploadPath'] . $imageName);
        return $imageName;
    }
}