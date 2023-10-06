<?php

namespace App\Http\Controllers;

use App\Models\Product_filter;
use Illuminate\Http\Request;

class ProductFilterController extends Controller
{
    function add_product(){
        $all_products = Product_filter::latest()->get();
        return view('PriceRangeSlider.add_product', [
            'all_products'=>$all_products,
        ]);
    }

    function productfilter_store(Request $request){
        $file = $request->file('image');
        $fileName = time().''.$file->getClientOriginalName();
        $filePath = $file->storeAs('images', $fileName, 'public');
        $product = new Product_filter;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image = $filePath;
        $product->save();

        return response()->json(['res' => 'Product Inserted Successfully' ]);
    }

    public function all_product(){
        $all_products = Product_filter::all();
        return view('PriceRangeSlider.all_product',[
            'all_products' => $all_products,
        ]);
    }

    public function search_products(Request $request){
    $all_products = Product_filter::whereBetween('price',[$request->left_value, $request->right_value])->get();
    return view('PriceRangeSlider.search_result',[
        'all_products'=> $all_products])->render();
    }

    public function sort_by(Request $request){
        if($request->sort_by == 'lowest_price'){
            $all_products = Product_filter::orderBy('price','asc')->get();
        }
        if($request->sort_by == 'highest_price'){
            $all_products = Product_filter::orderBy('price','desc')->get();
        }
        return view('PriceRangeSlider.search_result',[
            'all_products'=> $all_products])->render();
    }

}
