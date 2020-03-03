<?php

namespace App\Http\Controllers;
use App\products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  
    //======================== index product  ======================
    public function index()
    {
        $products = products::all();
        return response()->json($products);
    }

    //======================== create product  ======================
    public function store(Request $request)
    {

    try{
        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/product_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }


        $product = new products;
        $product->name= $request->name;
        $product->description= $request->description;
        $product->image= $fileNameToStore;
        $product->price= $request->price;
        $product->save();
        return response()->json($product);


    } catch(\Illuminate\Database\QueryException $e){
        $errorCode = $e->errorInfo[1];
        if($errorCode == '1062'){
            return response()->json("this product is already registered!" );
        }}
    }

    //======================== show product  ======================
    
    public function show($id)
    {
        $product = products::findOrFail($id);
        return response()->json($product);
    }


    //======================== update product  ======================

    public function update(Request $request, $id)
    {
        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/product_images', $fileNameToStore);
        } else {
            $product = products::findOrFail($id);
            $fileNameToStore = $product->image;
        }    
              
                    $product = products::findOrFail($id);
                    $product->name= $request->name;
                    $product->description= $request->description;
                    $product->image= $fileNameToStore;
                    $product->price= $request->price;
                    $product->save();

                    return response()->json($product);
                 }

    //======================== delete product  ======================

    public function destroy($id)
    {
        $product = products::findOrFail($id);
        $product -> delete();  
        return response()->json("deleted successfully");
 
     }
}
