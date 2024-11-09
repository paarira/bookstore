<?php

namespace app\infotech\authors\services;

use app\infotech\authors\forms\AuthorForm;
use app\infotech\authors\models\Author;
use app\infotech\authors\repositories\AuthorRepository;

class AuthorService
{
    private AuthorRepository $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function create(AuthorForm $form): Author
    {
        $authorModel = new Author([
            'full_name' => $form->full_name
        ]);

        return $this->authorRepository->save($authorModel);
    }

    public function edit(AuthorForm $form, Author $author): Author
    {
        $author->full_name = $form->full_name;

        return $this->authorRepository->save($author);
    }

    public function delete(Author $author): void
    {
        $this->authorRepository->delete($author);
    }
}