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

    public function index(Request $request)
    {
       //FILTRAVIMAS
       $horses = Horse::all();
       $horses = Horse::orderBy('name')->get();  //sita eilute dedam jeigu iskart norim isrusiuoti pagal kazka
      
       

       if($request->horse_id) {
           $betters = Better::where('horse_id',$request->horse_id) ->get();
           $filterBy = $request->horse_id;
        //    $betters->append(['horse_id' => $request->horse_id]);
           
           
       }
       else {
        
        $betters = Better::all();
        $betters = Better::orderByDesc('bet')->get();   // sortinimas is db
        
       }

       // Rusiavimas SORT
       if($request->sort && 'asc' == $request->sort) {
           $betters = $betters ->sortBy('surname');
           $sortBy = 'asc';
       }
       elseif($request->sort && 'desc' == $request->sort) {
           $betters = $betters ->sortByDesc('surname');
           $sortBy = 'desc';
       }

   return view('better.index', [
       
    // $horses = Horse::orderBy('title')->get();
       'horses' => $horses, 
       'betters' => $betters,
       'filterBy'=>$filterBy ?? 0,
       'sortBy' => $sortBy ?? ''
       ]);
   }
    // public function index()
    // {
    //     $betters = Better::all();
    //     return view('better.index', ['betters' => $betters]);
 
    // }

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
        $horses = Horse::orderBy('name')->get();
        return view('better.edit', ['better' => $better,'horses' => $horses->sortBy('title')]);
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

        
    $better->name = $request->better_name;
    $better->surname = $request->better_surname;
    $better->bet = $request->better_bet;
    $better->horse_id = $request->horse_id;
    $better->save();
    return redirect()->route('better.index')->with('success_message', 'New better added!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function destroy(Better $better)
    {
        $better->delete();
        return redirect()->route('better.index')->with('success_message', 'Better deleted!');
    }
}
