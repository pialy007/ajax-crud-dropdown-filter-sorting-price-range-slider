<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CategoryController extends Controller
{
    function category(){
        return view('filter.category');
    }

    function category_store(Request $request){

        $category = new Category();
        $category->c_name = $request->c_name;
        $category->created_at = Carbon::now();
        $category->save();
        return response()->json(['res' => 'Category created Successfully']);
    }

}
