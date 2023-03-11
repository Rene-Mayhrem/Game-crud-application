<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    //
     /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $games = Game::orderBy('id','desc')->paginate(5);
        return view('games.index', compact('games'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('games.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'genre' => 'required',
            'developer' => 'required',
        ]);
        
        Game::create($request->post());

        return redirect()->route('games.index')->with('success','A game has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\game 
    * @return \Illuminate\Http\Response
    */
    public function show(Game $game)
    {
        return view('games.show',compact('game'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function edit(Game $game)
    {
        return view('games.edit',compact('game'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Game $game)
    {
        $request->validate([
            'name' => 'required',
            'genre' => 'required',
            'developer' => 'required',
        ]);
        
        $game->fill($request->post())->save();

        return redirect()->route('games.index')->with('success','A game Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('games.index')->with('success','A game has been deleted successfully');
    }
}
