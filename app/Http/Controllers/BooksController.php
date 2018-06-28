<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CrudHelper\ControllerCrud;
use App\Http\Controllers\CrudHelper\ControllerUtils;
use Illuminate\Support\Facades\Validator;
use App\Model\Book;
use App\Model\Author;
use App\Model\Publisher;
use Illuminate\Http\Request;


class BooksController extends ControllerCrud
{
    public function __construct()
    {
        parent::__construct(Book::class);
    }

    public function index()
    {

        $authors = Author::where('active', '=', 1)->get();
        $publishers = Publisher::where('active', '=', 1)->get();
        return view('sections.config.books')->with(['authors' => $authors, 'publishers' => $publishers]);
    }
    public function store(Request $request)
    {
        //dd($request->file('cover')->store('public/cover'));
        $rules = [
            'isbn' => 'required',
            'publisher_id' => 'required',
            'author_id' => 'required',
            'title' => 'required',
            'pages' => 'required|numeric|min:1'
        ];

        $messages = [
            'isbn.required' => 'El ISBN es obligatorio',
            'publisher_id.required' => 'La Editorial es obligatiria',
            'author_id.required' => 'El autor es obligatirio',
            'title.required' => 'El título es obligatirio',
            'pages.numeric' => 'El campo páginas debe ser numérico'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {

            $book =  new Book();

            if ($request->hasFile('cover')) {
                $book->label = $request->file('cover')->store('public/cover');
            }
            $book->isbn = $request->isbn;
            $book->title = $request->title;
            $book->pages = $request->pages;
            $book->publisher_id = $request->publisher_id;
            $book->author_id = $request->author_id;
            $book->description = $request->description;
            $book->save();

            if ($book) {
                return ControllerUtils::successResponseJson($book->title, "Registro creado correctamente.");
            }
            return ControllerUtils::errorResponseJson('No se ha podido realizar el registro.');
        }
        return ControllerUtils::errorResponseValidation($validator);
    }


    public function update(Request $request)
    {
        //dd($request->file('cover')->store('public/cover'));
        //dd($request);
        $rules = [
            'name' => 'required',
            'companies_id' => 'required',
            'categories_id' => 'required',
            'description' => 'required',
            'game_types_id' => 'required',
            'plataforms_id' => 'required',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|numeric|min:1'
        ];

        $messages = [
            'name.required' => 'El nombre del juego es obligatorio',
            'price.required' => 'El precio es obligatirio',
            'plataforms_id.required' => 'El campo plataforma es obligatirio',
            'price.numeric' => 'El precio debe ser numérico',
            'game_types_id.required' => 'El tipo de Juego es obligatirio',
            'companies_id.required' => 'La compañia del Juego es obligatirio',
            'categories_id.required' => 'La categoria del Juego es obligatirio',
            'price.min' => 'El valor del precio debe ser mayor a $1',
            'description.required' => 'La descripción es requerida',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {

            $game = Game::where('id','=',$request->id)->first();
            if ($request->hasFile('cover')) {
                $game->cover = $request->file('cover')->store('public/cover');
            }
            $game->price = $request->price;
            $game->stock = $request->stock;
            $game->link = $request->web;
            $game->plataforms_id = $request->plataforms_id;
            $game->categories_id = $request->categories_id;
            $game->game_types_id = $request->game_types_id;
            $game->companies_id = $request->companies_id;
            $game->description = $request->description;
            $game->save();

            if($game){
                return ControllerUtils::successResponseJson($game, "Registro actualizado correctamente.");
            }
            return ControllerUtils::errorResponseJson('No se ha podido actualizar el registro.');
        }
        return ControllerUtils::errorResponseValidation($validator);

    }

}
