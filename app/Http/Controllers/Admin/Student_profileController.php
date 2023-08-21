<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Student_profile;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class Student_profileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $student_profile = Student_profile::where('crsecode', 'LIKE', "%$keyword%")
                ->orWhere('acadsem', 'LIKE', "%$keyword%")
                ->orWhere('acadyear', 'LIKE', "%$keyword%")
                ->orWhere('crsecordi', 'LIKE', "%$keyword%")
                ->orWhere('facultyname', 'LIKE', "%$keyword%")
                ->orWhere('dept', 'LIKE', "%$keyword%")
                ->orWhere('program', 'LIKE', "%$keyword%")
                ->orWhere('lock', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $student_profile = Student_profile::get();
        }
           $model = new Student_profile();
        dd($model->getTableColumns('student_profile'));
        dd($student_profile);

        return view('admin.student_profile.index', compact('student_profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
            $moduleadmin = DB::table('admin_course_allocation')->get();//Admin_course_alloca::get();
            $faculty_profile =DB::table('faculty_profile')->get();//Faculty_profile::get();
    //  dd($moduleadmin);
              $department = DB::table('department')->get();
        return view('admin.student_profile.create',compact('moduleadmin','faculty_profile','department'));
    }
      public function noduesactivation()
    {
     //   dd('sss');
         
        return view('admin.student_profile.noduesactivation');
    }

public function savenoduesactivation(Request $request){

$rolmodel=DB::table('tobepassout')->where('rollno',$request->input('rollno'))->get();
    
    if(empty($rolmodel)){DB::insert('insert into tobepassout (rollno)
                         values (?)', [$request->input('rollno')]);
}
     DB::insert('insert into nodues (rollno, name,program,dept,acadyear,acadsem)
                         values (?, ?, ?, ?, ?, ?)', [$request->input('rollno'),NULL,NULL,NULL,$request->input('acadyear'),$request->input('acadsem')]);
     return redirect('admin/noduesactivation')->with('flash_message', 'This Student No-Dues is Activated!');

}
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        DB::insert('insert into student_profile (acadyear, facultyname,acadsem,crsetype,crsecordi,dept,program,lock,crsecode)
                         values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$request->input('acadyear'), $request->input('facultyname'),$request->input('acadsem'),0,0 ,$request->input('dept'),NULL,0,$request->input('crsecode')]);
        student_profile::create($requestData);

        return redirect('admin/student_profile')->with('flash_message', 'student_profile added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $student_profile = student_profile::findOrFail($id);

        return view('admin.student_profile.show', compact('student_profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $student_profile = student_profile::findOrFail($id);
   $moduleadmin = DB::table('admin_course_allocas')->get();//Admin_course_alloca::get();
            $faculty_profile =DB::table('faculty_profile')->get();//Faculty_profile::get();
    //  dd($moduleadmin);
              $department = DB::table('department')->get();
        return view('admin.student_profile.edit', compact('student_profile','faculty_profile','moduleadmin','department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $student_profile = student_profile::findOrFail($id);
        $student_profile->update($requestData);

        return redirect('admin/student_profile')->with('flash_message', 'student_profile updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        student_profile::destroy($id);

        return redirect('admin/student_profile')->with('flash_message', 'student_profile deleted!');
    }
}
