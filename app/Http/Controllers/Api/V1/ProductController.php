<?php

namespace App\Http\Controllers\Api\V1;
use App\Models\Product\Product;

use Illuminate\Http\Request;

class ProductController extends APIController
{
  
    //======================== index product  ======================
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    //======================== create product  ======================
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required|unique:products',
            'price'=> ' required|regex:/^\d+(\.\d{1,2})?$/',

            ]);
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

        $data = $request->only('name','description','price');
        $product = array_merge($data ,  ['image' => $fileNameToStore]);
        Product::create($product);
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
        $product = Product::findOrFail($id);
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
            $product = Product::findOrFail($id);
            $fileNameToStore = $product->image;
        }    
                    $product = Product::findOrFail($id);
                    $data = $request->only('name','description','price');
                    $productData = array_merge($data ,  ['image' => $fileNameToStore]);
                    $product->update($productData);

                    return response()->json($product);
                 }

    //======================== delete product  ======================

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product -> delete();  
        return response()->json("deleted successfully");
     }
}
