<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function home() {
        $people = ['Jean', 'Diogo', 'Joana'];

        // return View::make();
        // return view('welcome', [
        //     'people' => $people
        // ]);
           return view('welcome', compact('people'));
        // return view('welcome')->with(['people' => $people]);
        // return view('welcome')->with('people', $people);
        // return view('welcome')->withPeople($people);
    }

    public function about() {
        return view('about');
    }
}
