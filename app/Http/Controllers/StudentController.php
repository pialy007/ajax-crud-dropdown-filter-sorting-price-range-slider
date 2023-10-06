<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function add_student(){
        
        return view('add_student_form');

    }
    public function addstudent_store(Request $request){
        $file = $request->file('image');
        $fileName = time().''.$file->getClientOriginalName();
        $filePath = $file->storeAs('images', $fileName, 'public');
        $student = new Student;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->image = $filePath;
        $student->save();

        return response()->json(['res'=>'Student Created Successfully']);

    }

    public function all_student(){

        return view('all_student_view');

    }

    public function allstudent_view(){
        $students = Student::all();
        return response()->json([
            'students' =>$students,
        ]);

    }

    public function getstudent($id){
        $student = Student::where('id',$id)->get();
        return view('edit_user',[
            'student'=>$student
        ]);
    }
    public function updatestudent(Request $request){
        $student = Student::find($request->id);
        $student->name = $request->name;
        $student->email = $request->email;

        if($request->file('image')){
            $file = $request->file('image');
            $fileName = time().''.$file->getClientOriginalName();
            $filePath = $file->storeAs('images', $fileName, 'public');
            $student->image = $filePath;
        }
        $student->save();
        return response()->json(['result'=>'Student Updated Successfully']);
    }

    public function deletedata($id){
        Student::where('id',$id)->delete();
        return response()->json(['result'=>'Student deleted']);
    }

}
