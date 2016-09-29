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
        $this->validate($request, [
            'body' => 'required|min:10',
        ]);

        $note = new Note($request->all());
        $card->addNote($note, 1);

        // redirects to the Card page
        return back();
    }

    public function edit(Note $note) {
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note) {
        $note->update($request->all());

        return back();
    }
}
