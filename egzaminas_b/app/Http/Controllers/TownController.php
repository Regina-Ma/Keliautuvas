<?php

namespace App\Http\Controllers;

use App\Country;
use App\Town;
use Illuminate\Http\Request;

class TownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $towns=Town::orderBy('title')->get();
        return view('towns.index', ['towns'=>$towns]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::orderBy('title')->get();
        return view('towns.create',['countries'=>$countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $town = new Town;
        $this->validate($request, [
            'title'=>'required|min:3|max:30|alpha',
            'population'=>'nullable|digits_between:3,8',
            'country_id'=>'required'
        ],[
            'title.required'=>"Laukelis yra privalomas",
            'title.min'=>"Laukelį turi sudaryti mažiausiai 3 simboliai.",
            'title.max'=>"Laukelį turi sudaryti ne daugiau 30 simbolių.",
            'title.alpha'=>"Laukelį turi sudaryti tik raidės.",
            'population.digits_between'=>"Laukelį turi sudaryti mažiausiai 3 ir daugiausiai 8 skaitmenys.",
            'country_id.required'=>"Laukelyje privaloma pasirinkti šalį."
        ]);
        $town->fill($request->all());
//         $town->title=$request->title;
//         $town->population=$request->population;
//         $town->country_id=$request->country_id;
        $town->save();
        
        return redirect()->route('towns.index')->with('success','Miestas '.$town->title.' sėkmingai pridėtas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Town  $town
     * @return \Illuminate\Http\Response
     */
    public function show(Town $town)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Town  $town
     * @return \Illuminate\Http\Response
     */
    public function edit(Town $town)
    {
        $countries = Country::orderBy('title')->get();
        return view('towns.edit',['town'=>$town, 'countries'=>$countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Town  $town
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Town $town)
    {
        $this->validate($request, [
            'title'=>'required|min:3|max:30|alpha',
            'population'=>'nullable|digits_between:3,8',
            'country_id'=>'required'
        ],[
            'title.required'=>"Laukelis yra privalomas",
            'title.min'=>"Laukelį turi sudaryti mažiausiai 3 simboliai.",
            'title.max'=>"Laukelį turi sudaryti ne daugiau 30 simbolių.",
            'title.alpha'=>"Laukelį turi sudaryti tik raidės.",
            'population.digits_between'=>"Laukelį turi sudaryti mažiausiai 3 ir daugiausiai 8 skaitmenys.",
            'country_id.required'=>"Laukelyje privaloma pasirinkti šalį."
        ]);
        $town->fill($request->all());
//         $town->title=$request->title;
//         $town->population=$request->population;
//         $town->country_id=$request->country_id;
        $town->save();
        return redirect()->route('towns.index')->with('success','Miestas '.$town->title.' sėkmingai atnaujintas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Town  $town
     * @return \Illuminate\Http\Response
     */
    public function destroy(Town $town)
    {
        $town->delete();
        return redirect()->route('towns.index')->with('success','Miestas sėkmingai ištrintas');
    }
}
