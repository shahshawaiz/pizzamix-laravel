<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Cuisine;
use Validator;
use File;
use Auth;

class CuisineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //check if admin
        (new SecurityController)->checkIfAdmin();

        $cuisines = Cuisine::all();
        
        return view('pages.admin.cuisines.index')->with('cuisines', $cuisines);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        //check if admin
        (new SecurityController)->checkIfAdmin();

        return view('pages.admin.cuisines.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $cuisine = new Cuisine;

        $cuisine->name = $request->name;
        $cuisine->description = $request->description; 
        $cuisine->save();

        //file upload options
        $destination = public_path().'/images/uploads/cuisine/';
        $base_code = 'cuisine-'.$cuisine->id;

        //update id specific columns
        $cuisine->cuisineCode = $base_code;

        $cuisine->save();     

        //file optreations
        if($request->file('thumbnail')!=null){

            $file_thumnail = $request->file('thumbnail');
            $cuisine->thumbnail = $base_code . '-thumbnail.'. $file_thumnail->getClientOriginalExtension();

            $cuisine->save();  

            $file_thumnail->move(
                $destination , 
                $base_code . '-thumbnail.' . $file_thumnail->getClientOriginalExtension()
            );

        }

        if($request->file('header')!=null){

            $file_header = $request->file('header');
            $cuisine->header = $base_code . '-header.'. $file_header->getClientOriginalExtension();

            $cuisine->save();  

            $file_header->move(
                $destination , 
                $base_code . '-header.' . $file_header->getClientOriginalExtension()
            );

        }                 

        if($request->file('headerStrip')!=null){

            $file_header_strip = $request->file('headerStrip');
            $cuisine->headerStrip = $base_code . '-headerStrip.'. $file_header_strip->getClientOriginalExtension();

            $cuisine->save();  

            $file_header_strip->move(
                $destination , 
                $base_code . '-headerStrip.' . $file_header_strip->getClientOriginalExtension()
            );

        }                        

       return redirect()->route('cuisine.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        //check if admin
        (new SecurityController)->checkIfAdmin();

        $cuisine = Cuisine::find($id);

        return view('pages.admin.cuisines.detail')->with('cuisine', $cuisine);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        //check if admin
        (new SecurityController)->checkIfAdmin();

        $cuisine = Cuisine::find($id);

        return view('pages.admin.cuisines.edit')->with('cuisine', $cuisine);
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
        $cuisine = Cuisine::find($id);

        $cuisine->name = $request->name;
        $cuisine->description = $request->description; 
        $cuisine->save();

        //file upload options
        $destination = public_path().'/images/uploads/cuisine/';
        $base_code = 'cuisine-'.$cuisine->id;

        //update id specific columns
        $cuisine->cuisineCode = $base_code;

        $cuisine->save();     

        //file optreations
        if($request->file('thumbnail')!=null){

            $file_thumnail = $request->file('thumbnail');
            $cuisine->thumbnail = $base_code . '-thumbnail.'. $file_thumnail->getClientOriginalExtension();

            $cuisine->save();  

            $file_thumnail->move(
                $destination , 
                $base_code . '-thumbnail.' . $file_thumnail->getClientOriginalExtension()
            );

        }

        if($request->file('header')!=null){

            $file_header = $request->file('header');
            $cuisine->header = $base_code . '-header.'. $file_header->getClientOriginalExtension();

            $cuisine->save();  

            $file_header->move(
                $destination , 
                $base_code . '-header.' . $file_header->getClientOriginalExtension()
            );

        }                 

        if($request->file('headerStrip')!=null){

            $file_header_strip = $request->file('headerStrip');
            $cuisine->headerStrip = $base_code . '-headerStrip.'. $file_header_strip->getClientOriginalExtension();

            $cuisine->save();  

            $file_header_strip->move(
                $destination , 
                $base_code . '-headerStrip.' . $file_header_strip->getClientOriginalExtension()
            );

        }     


       return redirect()->route('cuisine.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
       Cuisine::find($id)->delete();
       
       return redirect()->route('cuisine.index');
    }


}
