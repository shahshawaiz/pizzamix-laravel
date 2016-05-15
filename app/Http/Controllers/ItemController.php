<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        //check if admin
        (new SecurityController)->checkIfAdmin();

        $items = Item::all();
        
        return view('pages.admin.items.index')->with('items', $items);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        //check if admin
        (new SecurityController)->checkIfAdmin();

        if($type=='ingredient')
            $type = 1;
        elseif($type=='accessory')
            $type = 2;
        elseif($type=='sideDish')
            $type = 3;
        else
            $type = null;

        return view('pages.admin.items.add')->with('type', $type);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $item = new Item;

        $item->name = $request->name;
        $item->description = $request->description; 

        switch($request->type){
            case 'Ingredient':
                $type = 1;
                break;

            case 'Accessory':
                $type = 2;
                break;

            case 'Side Dish':
                $type = 3;
                break;                

            default:
                $type = 2;
                break;             
        }

        $item->type = $type;         
        $item->price = $request->price;        
        $item->save();

        //file upload options
        $destination = public_path().'/images/uploads/item/';
        $base_code = 'item-'.$item->id;

        //update id specific columns
        $item->itemCode = $base_code;

        $item->save();     

        //file optreations
        if($request->file('thumbnail')!=null){

            $file_thumnail = $request->file('thumbnail');
            $item->thumbnail = $base_code . '-thumbnail.'. $file_thumnail->getClientOriginalExtension();

            $item->save();  

            $file_thumnail->move(
                $destination , 
                $base_code . '-thumbnail.' . $file_thumnail->getClientOriginalExtension()
            );

        }
            
       return redirect()->route('item.index');
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

        return redirect('item/'.$id);
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
                
        $item = Item::find($id);

        return view('pages.admin.items.edit')->with('item', $item);
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
        $item = Item::find($id);

        $item->name = $request->name;
        $item->description = $request->description; 
        $item->type = $request->type;         
        $item->price = $request->price;        
        $item->save();

        //file upload options
        $destination = public_path().'/images/uploads/item/';
        $base_code = 'item-'.$item->id;

        //update id specific columns
        $item->itemCode = $base_code;            

        $item->save();     

        //file optreations
        if($request->file('thumbnail')!=null){

            $file_thumnail = $request->file('thumbnail');
            $item->thumbnail = $base_code . '-thumbnail.'. $file_thumnail->getClientOriginalExtension();

            $item->save();  

            $file_thumnail->move(
                $destination , 
                $base_code . '-thumbnail.' . $file_thumnail->getClientOriginalExtension()
            );

        }
        
       return redirect()->route('item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Item::find($id)->delete();
       
       return "Item deletion success.";
    }
}
