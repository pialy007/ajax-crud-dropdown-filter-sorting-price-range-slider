<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function product(){
        $products = Product::latest()->get();
        $categories = Category::latest()->get();

        return view('filter.product', [
            'products'=>$products,
            'categories'=>$categories,
        ]);
    }

    function product_store(Request $request){

        $product = new Product();
        $product->p_name = $request->p_name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->c_id = $request->c_id;
        $product->save();

        return response()->json(['res' => 'Product Inserted Successfully' ]);
    }

    function product_filter(Request $request){

        $products = Product::latest()->get();
        $categories = Category::latest()->get();

        if($request->ajax()){
            $products = Product::where('c_id', $request->category)->get();
            return response()->json(['products'=>$products]);
        }

        return view('filter.product_filter', compact('products', 'categories'));
    }

}
