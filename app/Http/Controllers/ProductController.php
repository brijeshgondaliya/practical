<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of all products.
     *
     * @author Brijesh
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_product = Product::orderBy('id','DESC')->get();
        return view('product',['all_product' => $all_product]);
    }

    /**
     * Product Add/Update 
     * 
     * @author brijesh
     * @param array
     * @return json
     */
    public function productAddUpdate(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'upc_no' => 'required',
            'price' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
       ]);
        
        $product_data = [
            'name' => $request->product_name,
            'price' => $request->price,
            'upc' => $request->upc_no,
            'status' => $request->status
        ];
        if ($files = $request->file('image')) {
            //insert new image
            $filename_extention = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filename_extention, PATHINFO_FILENAME);
            $new_file_name = time() . '_' . $filename;
            $extension = $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image')->storeAs("public/product/",       $new_file_name . "." . $extension);

            $image = $new_file_name . "." . $extension;
            $product_data['image'] = $image;
        }
        $product_add = Product::create($product_data);
        $all_product = Product::orderBy('id','DESC')->get();
        $view = view('product-table', ['all_product' => $all_product])->render();
        return response()->json(['view' => $view]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
