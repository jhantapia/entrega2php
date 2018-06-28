<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CrudHelper\ControllerCrud;
use App\Model\Publisher;


class PublishersController extends ControllerCrud
{
    public function __construct()
    {
        parent::__construct(Publisher::class);
        parent::setIndexPage('sections.config.publishers');
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
