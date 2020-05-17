<?php

namespace App\Http\Controllers;

use App\Country;
use App\Customer;
use App\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::orderBy('title')->get();
        return view('countries.index', ['countries'=>$countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = new Country;
        $this->validate($request, [
            'title'=>[ 'required',Rule::unique('countries')->ignore($country->id),],'|min:3|max:30|alpha|unique:countries,title',
            'description'=>'nullable',
            'distance'=>'nullable|digits_between:3,5'
        ],[
            'title.min'=>"Laukelį turi sudaryti mažiausiai 3 simboliai.",
            'title.max'=>"Laukelį turi sudaryti ne daugiau 30 simbolių.",
            'title.alpha'=>"Laukelį turi sudaryti tik raidės.",
            'title.unique'=>"Šalis tokiu pavadinimu jau yra įvesta.",
            'distance.digits_between'=>"Laukelyje įrašykite skaičių tarp 100 ir 40057."
        ]);

        $country->fill($request->all());
//         $country->title=$request->title;
//         $country->description=$request->description;
//         $country->distance=$request->distance;
        $country->save();
        
        return redirect()->route('countries.index')->with('success','Šalis '.$country->title.' sėkmingai pridėta');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        $towns = Town::orderBy('title')->get();
//      $towns= Town::where('country_id', $country->id)->orderBy('title')->get();
        return view('countries.show',['country'=>$country, 'towns'=>$towns]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('countries.edit',['country'=>$country]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $this->validate($request, [
            'title'=>[
                'required',
                Rule::unique('countries')->ignore($country->id),
            ],'|min:3|max:30|alpha|unique:countries,title',
            
            'description'=>'nullable',
            'distance'=>'nullable|digits_between:3,5'
        ],[
            'title.min'=>"Laukelį turi sudaryti mažiausiai 3 simboliai.",
            'title.max'=>"Laukelį turi sudaryti ne daugiau 30 simbolių.",
            'title.alpha'=>"Laukelį turi sudaryti tik raidės.",
            'title.unique'=>"Šalis tokiu pavadinimu jau yra įvesta.",
            'distance.digits_between'=>"Laukelyje įrašykite skaičių tarp 100 ir 40057."
        ]);
        $country->fill($request->all());
//         $country->title=$request->title;
//         $country->description=$request->description;
//         $country->distance=$request->distance;
        $country->save();
        
        return redirect()->route('countries.index')->with('success','Šalis '.$country->title.' sėkmingai atnaujinta');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Country $country)
    {
        $customers=Customer::where('country_id',$country->id)->get()->isEmpty();
        $towns=Town::where('country_id',$country->id)->get()->isEmpty();
        if($towns){
            if($customers){
                $country->delete();
                return redirect()->route('countries.index')->with('success','Šalis sėkmingai ištrinta');
            } else {
                return redirect()->route('countries.index')->with('error','Šalies '.$country->title.' ištrinti negalima - ji turi susijusių "Miestai" įrašų');
            }
        } else {
            return redirect()->route('countries.index')->with('error','Šalies '.$country->title.' ištrinti negalima - ji turi susijusių "Miestai" arba "Klientai" įrašų');
        }
    }
}
