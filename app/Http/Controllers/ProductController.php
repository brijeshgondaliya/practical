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
            // 'product_name' => 'required',
            // 'upc_no' => 'required',
            // 'price' => 'required',
            // 'status' => 'required',
            // 'image' => 'image|mimes:jpeg,png,jpg|max:2048',
       ]);
        $product_id = $request->product_id; // for update time
        $product_data = $request->all();
        // $product_data = [
        //     'username' => $request->username,
        // ];
        // if ($files = $request->file('image')) {
        //     if(!empty($request->hidden_image)){
        //         // remove old image
        //         \File::delete(storage_path().'/app/public/product/'.$request->hidden_image);
        //     }
        //     //insert new image
        //     $filename_extention = $request->file('image')->getClientOriginalName();
        //     $filename = pathinfo($filename_extention, PATHINFO_FILENAME);
        //     $new_file_name = time() . '_' . $filename;
        //     $extension = $request->file('image')->getClientOriginalExtension();
        //     $file = $request->file('image')->storeAs("public/product/",       $new_file_name . "." . $extension);

        //     $image = $new_file_name . "." . $extension;
        //     $product_data['image'] = $image;
        // }
        $product_add_update = Product::updateOrCreate(['id' => $product_id], $product_data);
        $all_product = Product::orderBy('id','DESC')->get();
        $view = view('product-table', ['all_product' => $all_product])->render();
        return response()->json(['view' => $view]);
    }

    /**
     * Get Product Details From Product Id
     *
     * @author Brijesh
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function productDetails($id)
    {
        $product_detail = Product::where('id', $id)->first();
        return response()->json($product_detail);
    }

    /**
     * Delete the specified product.
     *
     * @author Brijesh
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function productDelete($id)
    {
        // $product_data = Product::where('id',$id)->first(['image']);
        // \File::delete(storage_path().'/app/public/product/'.$product_data->image);
        $product = Product::where('id',$id)->delete();

        $all_product = Product::orderBy('id','DESC')->get();
        $view = view('product-table', ['all_product' => $all_product])->render();
        
        return response()->json(['view' => $view]);
    }

    /**
     * Delete the multiple product.
     *
     * @author Brijesh
     * @param  $request arrray
     * @return \Illuminate\Http\Response
     */
    public function deleteMultiple(Request $request)
    {
        $ids = $request->ids;
        Product::whereIn('id',explode(",",$ids))->delete();
    
        $all_product = Product::orderBy('id','DESC')->get();
        $view = view('product-table', ['all_product' => $all_product])->render();
        
        return response()->json(['view' => $view]);
    }
}
