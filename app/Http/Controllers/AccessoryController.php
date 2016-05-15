<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\Accessory;

class AccessoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accessories = Accessory::all();
        
        return view('pages.admin.accessories.index')->with('accessories', $accessories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.accessories.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $accessory = Accessory::Create($inputs);
            
       return redirect()->route('accessory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $accessory = Accessory::find($id);

        return view('pages.admin.accessories.detail')->with('accessory', $accessory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $accessory = Accessory::find($id);

        return view('pages.admin.accessories.edit')->with('accessory', $accessory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $accessory = Accessory::find($id);

        $accessory->accessoryCode = $request->accessoryCode;
        $accessory->name = $request->name;
        $accessory->description = $request->description;
        $accessory->type = $request->type;
        $accessory->price = $request->price;

        $accessory->save();

       return redirect()->route('accessory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Accessory::find($id)->delete();
       
       return redirect()->route('accessory.index');
    }
}
