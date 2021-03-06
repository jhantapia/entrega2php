<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'id', 'title','pages','publisher_id','author_id','description','label'
    ];
}
