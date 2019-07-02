<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use Illuminate\Http\Request;

class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Counter $counter)
    {   

        $counts = Counter::first()->counts;

        return view('counter.index', compact('counts'));
    }
    public function showCounterButton(){
        return view('counter.show');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Counter $counter)
    {   
        if($request->ajax()){

            dd('ajax');
            if(Counter::first() == null){
                $counter = new Counter();
                $counter->counts = 1;
                $counter->save();
                dd($counter.'first');
            }else{
                $counter = Counter::first();
                $counter->counts++;
                $counter->save();
                dd($counter.'second');
            }

        }
        return Response("success");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function edit(Counter $counter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Counter $counter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Counter $counter)
    {
        //
    }
}
