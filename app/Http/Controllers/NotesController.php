<?php

namespace App\Http\Controllers;

use App\Card;
use App\Note;
use Illuminate\Http\Request;

use App\Http\Requests;

class NotesController extends Controller
{
    public function store(Request $request, Card $card) {
        //$note = new Note;

        //$note->body = $request->body;

        //$card->notes()->save($note);


        // THIS METHOD NEEDS TO HAVE THE 'body'
        // PROPERTY OF THE 'Note' MODEL AS '$fillable'
        // $card->notes()->save(
        //     new Note(['body' => $request->body])
        // );

        // $card->notes()->create([
        //     'body' => $request->body
        // ]);

        $card->addNote(
            new Note($request->all())
        );

        // redirects to the Card page
        return back();
    }
}
