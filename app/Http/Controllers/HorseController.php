<?php

namespace App\Http\Controllers;

use App\Models\Horse;
use Illuminate\Http\Request;
use Validator;

class HorseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
       
       
         if ('runs' == $request->sort) {
            $horses = Horse::orderBy('runs')->get();
        }
        elseif ('wins' == $request->sort) {
            $horses = Horse::orderBy('wins')->get();
        }
        else {
            $horses = Horse::all();
            $horses = Horse::orderBy('name')->get();
           
           
        }
       
        return view('horse.index', ['horses' => $horses]);
    }

    // public function index()
    // {
    //     $horses = Horse::all();
    //    return view('horse.index', ['horses' => $horses]);

    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $horses = Horse::all();
        return view('horse.create', ['horses' => $horses]);
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
           'horse_name' => ['required','regex:/^[A-Z][a-zA-z\s\'\-]*[a-z]$/', 'min:3', 'max:100'],
           'horse_runs' => ['required', 'numeric', 'min:0','max:2000'],
           'horse_wins' => ['required', 'numeric', 'min:0','max:2000'],
           'horse_about' => ['required', 'min:3', 'max:2000'],
           
             ],
             [

             ]
            
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }
      

        $horse = new Horse;
       $horse->name = $request->horse_name;
       $horse->runs = $request->horse_runs;
       $horse->wins = $request->horse_wins;
       $horse->about = $request->horse_about;
       $horse->save();
       return redirect()->route('horse.index')->with('success_message', 'Horse created!');
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function show(Horse $horse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function edit(Horse $horse)
    {
      // $horse = Horse::all();
      return view('horse.edit', ['horse' => $horse]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horse $horse)
    {
        $validator = Validator::make(
            $request->all(),
             [
           'horse_name' => ['required','regex:/^[A-Z][a-zA-z\s\'\-]*[a-z]$/', 'min:3', 'max:100'],
           'horse_runs' => ['required', 'numeric', 'min:0','max:2000'],
           'horse_wins' => ['required', 'numeric', 'min:0','max:2000'],
           'horse_about' => ['required', 'min:3', 'max:2000'],
           
             ],
             [

             ]
            
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }
      

        
       $horse->name = $request->horse_name;
       $horse->runs = $request->horse_runs;
       $horse->wins = $request->horse_wins;
       $horse->about = $request->horse_about;
       $horse->save();
       return redirect()->route('horse.index')->with('success_message', 'Horse created!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horse $horse)
    {
        
        if($horse->horseBetter->count() !==0){
            
            return redirect()->back()->with('info_message', 'Cannot delete horse, because it linked to better');
        }
        $horse->delete();
        return redirect()->route('horse.index')->with('success_message', 'Horse deleted!');
    
    }
}
