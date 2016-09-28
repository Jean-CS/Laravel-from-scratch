<?php

namespace App\Http\Controllers;
// Traditional way
// use DB;

// Eloquent way
use App\Card;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CardsController extends Controller
{
    public function index() {
        // Traditional way
        // $cards = DB::table('cards')->get();

        // Eloquent way
        $cards = Card::all();

        return view('cards.index', compact('cards'));
    }

    // Route-Model-Binding
    public function show(Card $card) {
        // Query the database for the Card-Notes relationship and also the User relationship. Thus avoiding the N + 1 problem.
        $card->load('notes.user'); // EAGER LOAD (Query everything you need at once to avoid querying the database unnecessarily)

        // Looks for a 'show.blade.php' file in 'resources/views/cards'
        return view('cards.show', compact('card'));
    }

    // ALTERNATIVE WAY
    // public function show($id) {
    //     $card = Card::find($id);
    //
    //     return view('cards.show', compact('card'));
    //
    //     // JSON
    //     // return $card;
    // }

}
