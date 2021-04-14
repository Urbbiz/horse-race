<?php

namespace App\Http\Controllers;

use App\Models\Better;
use Illuminate\Http\Request;
use App\Models\Horse;
use Validator;

class BetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $betters = Better::all();
        return view('better.index', ['betters' => $betters]);
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         // return view('better.create');
         $horses = Horse::orderBy('name')->get();
         return view('better.create', ['horses' => $horses->sortBy('title')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
             [
           'better_name' => ['required','regex:/^[\pL\s\-]+$/u', 'min:3', 'max:100'],
           'better_surname' => ['required','regex:/^[A-Z][a-zA-z\s\'\-]*[a-z]$/', 'min:3', 'max:150'],
           'better_bet' => ['required', 'numeric', 'min:1','max:10000000'],  //'gt:meat'   arba  ,'lt:better_experience'
           'horse_id' => ['required',],
            ],
            [
            'better_surname.required' => 'Name cannot be empty!',
            'better_surname.min' => 'To short ssurname',
            'better_name.required' => 'Surname cannot be empty',
            'better_name.regex' => 'be kableliu',
            ]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

        $better = new Better;
    $better->name = $request->better_name;
    $better->surname = $request->better_surname;
    $better->bet = $request->better_bet;
    $better->horse_id = $request->horse_id;
    $better->save();
    return redirect()->route('better.index')->with('success_message', 'New better added!');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function show(Better $better)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function edit(Better $better)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Better $better)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function destroy(Better $better)
    {
        //
    }
}
