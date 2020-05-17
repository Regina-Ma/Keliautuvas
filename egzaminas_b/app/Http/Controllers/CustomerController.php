<?php

namespace App\Http\Controllers;

use App\Country;
use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->country_id) && ($request->country_id!=0)) {
            $country_id=$request->country_id;
            $customers=Customer::where('country_id',$country_id)->orderBy('surname')->get();
        } else {
            $country_id=0;
            $customers=Customer::orderBy('surname')->get();
        }
       
        return view('customers.index', ['countries'=>Country::orderBy('title')->get(),'customers'=>$customers, 'country_id'=>$country_id]);
    }
    
    public function filter(Request $request)
    {
        if (isset($request->country_id) && ($request->country_id!=0)) {
            $country_id=$request->country_id;
            $customers=Customer::where('country_id',$country_id)->orderBy('surname')->get();
        } else {
            $country_id=0;
            $customers=Customer::orderBy('surname')->get();
        }
        
        return view('customers.index', ['countries'=>Country::orderBy('title')->get(),'customers'=>$customers, 'country_id'=>$country_id]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::orderBy('title')->get();
        return view('customers.create',['countries'=>$countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new Customer;
        $this->validate($request, [
            'name'=>'required|min:2|max:64|alpha',
            'surname'=>'required|min:2|max:64|alpha',
            'email'=>'email:rfc,dns',
            'phone'=>'digits:11'
        ],[
            'name.required'=>"Laukelis yra privalomas",
            'name.min'=>"Laukelį turi sudaryti mažiausiai 2 simboliai.",
            'name.max'=>"Laukelį turi sudaryti ne daugiau 64 simbolių.",
            'name.alpha'=>"Laukelį turi sudaryti tik raidės.",
            'surname.required'=>"Laukelis yra privalomas",
            'surname.min'=>"Laukelį turi sudaryti mažiausiai 2 simboliai.",
            'surname.max'=>"Laukelį turi sudaryti ne daugiau 64 simbolių.",
            'surname.alpha'=>"Laukelį turi sudaryti tik raidės.",
            'email.email' => "Laukelyje reikia įvesti elektroninio pašto adresą",
            'phone.digits'=>"Laukelį turi sudaryti  11 skaitmenų (370 XXX XXXXX)."
        ]);
        $customer->fill($request->all());
//         $customer->name=$request->name;
//         $customer->surname=$request->surname;
//         $customer->email=$request->email;
//         $customer->phone=$request->phone;
//         $customer->country_id=$request->country_id;
        $customer->save();
        
        return redirect()->route('customers.index')->with('success','Klientas '.$customer->name.$customer->surname.' sėkmingai pridėta');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $countries = Country::orderBy('title')->get();
        return view('customers.edit',['customer'=>$customer, 'countries'=>$countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'name'=>'required|min:2|max:64|alpha',
            'surname'=>'required|min:2|max:64|alpha',
            'email'=>'email:rfc,dns',
            'phone'=>'digits:11'
        ],[
            'name.required'=>"Laukelis yra privalomas",
            'name.min'=>"Laukelį turi sudaryti mažiausiai 2 simboliai.",
            'name.max'=>"Laukelį turi sudaryti ne daugiau 64 simbolių.",
            'name.alpha'=>"Laukelį turi sudaryti tik raidės.",
            'surname.required'=>"Laukelis yra privalomas",
            'surname.min'=>"Laukelį turi sudaryti mažiausiai 2 simboliai.",
            'surname.max'=>"Laukelį turi sudaryti ne daugiau 64 simbolių.",
            'surname.alpha'=>"Laukelį turi sudaryti tik raidės.",
            'email.email' => "Laukelyje reikia įvesti elektroninio pašto adresą",
            'phone.digits'=>"Laukelį turi sudaryti  11 skaitmenų (370 XXX XXXXX)."
        ]);
        $customer->fill($request->all());
//         $customer->name=$request->name;
//         $customer->surname=$request->surname;
//         $customer->email=$request->email;
//         $customer->phone=$request->phone;
//         $customer->country_id=$request->country_id;
        $customer->save();
        return redirect()->route('customers.index')->with('success','Klientas '.$customer->name.$customer->surname.' sėkmingai atnaujintas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success','Klientas sėkmingai ištrintas');
    }
}
