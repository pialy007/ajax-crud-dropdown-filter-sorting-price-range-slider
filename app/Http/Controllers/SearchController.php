<?php

namespace App\Http\Controllers;
use App\Models\Student;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search_student( Request $request){

        $query = Student::query();

        if ($request->ajax()){
            $students = $query->where('name','LIKE','%'.$request->search.'%')
            ->orWhere('email','LIKE','%'.$request->search.'%')
            ->get();
            return response()->json([
                'students'=>$students,
            ]);

        }
        else{
            $students = $query->get();
            return view('all_student_view',[
                'students'=>$students,
            ]);
        }


    }
}
