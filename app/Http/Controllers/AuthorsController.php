<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CrudHelper\ControllerCrud;
use App\Model\Author;


class AuthorsController extends ControllerCrud
{
    public function __construct()
    {
        parent::__construct(Author::class);
        parent::setIndexPage('sections.config.authors');
        //validate store
        parent::setValidationStore([
            'name' => 'required|max:50|min:1'
        ]);
        //validate update
        parent::setValidationUpdate([
            'name' => 'required|max:50|min:1'
        ]);
    }

}
