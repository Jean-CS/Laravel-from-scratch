<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middlware' => ['web']], function() {

    Route::get('dummy', function() {
        /*
        There are several ways to flash to the session

            Session::flash('status', 'Hello there');

                session(['foo' => 'bar']);
            EQUIVALENT TO
                Session::put('foo', 'bar');

                session('foo'); Returns 'bar'
            EQUIVALENT TO
                Session::get('foo');
         */

        // Helper function from app/Helpers/flash.php
        flash('You are now signed in', 'success'); // success; error; default is info
        return redirect('/');
    });
    Route::get('/', function() {
        return view('welcome');
    });

    Route::get('cards', 'CardsController@index');
    Route::get('cards/{card}', 'CardsController@show');

    Route::post('cards/{card}/notes', 'NotesController@store');

    Route::get('/notes/{note}/edit', 'NotesController@edit');
    Route::patch('notes/{note}', 'NotesController@update');
});


// Route::get('cards/create', 'CardsController@create');
// Route::post('cards', 'CardsController@store');

// Route::get('/', function () {
//     $people = ['Jean', 'Diogo', 'Joana'];
//
//     // return View::make();
//     // return view('welcome', [
//     //     'people' => $people
//     // ]);
//        return view('welcome', compact('people'));
//     // return view('welcome')->with(['people' => $people]);
//     // return view('welcome')->with('people', $people);
//     // return view('welcome')->withPeople($people);
// });
