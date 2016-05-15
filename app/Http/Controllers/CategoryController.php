<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\Category;
use App\Models\Cuisine;

class CategoryController extends Controller
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

        $cuisines = Cuisine::lists('name', 'id');
        $cuisines->prepend('None');             

        $categories = Category::all();
        
        return view('pages.admin.categories.index')->with('categories', $categories)->with('cuisines', $cuisines);
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

        $cuisines = Cuisine::lists('name','id');

        return view('pages.admin.categories.add')->with('cuisines', $cuisines);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //file handle
        $file_thumnail = $request->file('thumbnail');
        $file_header = $request->file('header');                        
        $file_header_strip = $request->file('headerStrip');

        $category = new Category;

        $category->name = $request->name;
        $category->description = $request->description; 
        $category->cuisine_id = $request->cuisine_id;         
        $category->save();

        //file upload options
        $destination = public_path().'/images/uploads/category/';
        $base_code = 'category-'.$category->id;

        //update id specific columns
        $category->categoryCode = $base_code;             

        $category->save();     

        //file optreations
        if($request->file('thumbnail')!=null){

            $file_thumnail = $request->file('thumbnail');
            $category->thumbnail = $base_code . '-thumbnail.'. $file_thumnail->getClientOriginalExtension();

            $category->save();  

            $file_thumnail->move(
                $destination , 
                $base_code . '-thumbnail.' . $file_thumnail->getClientOriginalExtension()
            );

        }

        if($request->file('header')!=null){

            $file_header = $request->file('header');
            $category->header = $base_code . '-header.'. $file_header->getClientOriginalExtension();

            $category->save();  

            $file_header->move(
                $destination , 
                $base_code . '-header.' . $file_header->getClientOriginalExtension()
            );

        }                 

        if($request->file('headerStrip')!=null){

            $file_header_strip = $request->file('headerStrip');
            $category->headerStrip = $base_code . '-headerStrip.'. $file_header_strip->getClientOriginalExtension();

            $category->save();  

            $file_header_strip->move(
                $destination , 
                $base_code . '-headerStrip.' . $file_header_strip->getClientOriginalExtension()
            );

        }     
            
       return redirect()->route('category.index');
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
                
        return redirect('product/'.$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $category = Category::find($id);
        $cuisines = Cuisine::lists('name','id');

        return view('pages.admin.categories.edit')->with('category', $category )->with('cuisines', $cuisines);
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
        $category = Category::find($id);

        //file handle
        $file_thumnail = $request->file('thumbnail');
        $file_header = $request->file('header');                        
        $file_header_strip = $request->file('headerStrip');

        $category->name = $request->name;
        $category->description = $request->description; 
        $category->cuisine_id = $request->cuisine_id;         
        $category->save();

        //file upload options
        $destination = public_path().'/images/uploads/category/';
        $base_code = 'category-'.$category->id;

        //update id specific columns
        $category->categoryCode = $base_code;          

        $category->save();     

        //file optreations
        if($request->file('thumbnail')!=null){

            $file_thumnail = $request->file('thumbnail');
            $category->thumbnail = $base_code . '-thumbnail.'. $file_thumnail->getClientOriginalExtension();

            $category->save();  

            $file_thumnail->move(
                $destination , 
                $base_code . '-thumbnail.' . $file_thumnail->getClientOriginalExtension()
            );

        }

        if($request->file('header')!=null){

            $file_header = $request->file('header');
            $category->header = $base_code . '-header.'. $file_header->getClientOriginalExtension();

            $category->save();  

            $file_header->move(
                $destination , 
                $base_code . '-header.' . $file_header->getClientOriginalExtension()
            );

        }                 

        if($request->file('headerStrip')!=null){

            $file_header_strip = $request->file('headerStrip');
            $category->headerStrip = $base_code . '-headerStrip.'. $file_header_strip->getClientOriginalExtension();

            $category->save();  

            $file_header_strip->move(
                $destination , 
                $base_code . '-headerStrip.' . $file_header_strip->getClientOriginalExtension()
            );

        }     

       return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
       Category::find($id)->delete();
       
       return "delete success.";
    }
}
