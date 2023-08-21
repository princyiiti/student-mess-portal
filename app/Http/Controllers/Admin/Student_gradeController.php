<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Feedback_allocation;
use Illuminate\Http\Request;

class Student_gradeController extends Controller
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
            $feedback_allocation = Feedback_allocation::where('crsecode', 'LIKE', "%$keyword%")
                ->orWhere('acadsem', 'LIKE', "%$keyword%")
                ->orWhere('acadyear', 'LIKE', "%$keyword%")
                ->orWhere('crsecordi', 'LIKE', "%$keyword%")
                ->orWhere('facultyname', 'LIKE', "%$keyword%")
                ->orWhere('dept', 'LIKE', "%$keyword%")
                ->orWhere('program', 'LIKE', "%$keyword%")
                ->orWhere('lock', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $feedback_allocation = DB::table('transcript_course')->limit(1000)->get();
        }
//dd($feedback_allocation);
        return view('admin.transcript_course.index', compact('feedback_allocation'));
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
        return view('admin.transcript_course.create',compact('moduleadmin','faculty_profile','department'));
    }
      public function noduesactivation()
    {
     //   dd('sss');
         
        return view('admin.transcript_course.noduesactivation');
    }

public function savenoduesactivation(Request $request){

$rolmodel=DB::table('tobepassout')->where('rollno',$request->input('rollno'))->first();
    //dd($rolmodel);
    if(!$rolmodel){
        DB::insert('insert into tobepassout (rollno)
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
        //dd($request);
        $feedback_allocation = new Feedback_allocation;
       $feedback_allocation = $request->all();
      // dd( $feedback_allocation);
        $acadyear=$request->input('acadyear');
        $acadsem=$request->input('acadsem');
       $crsecode= $request->input('crsecode');
         $modulecourselist = DB::table('courselist')->where('crsecode',$request->input('crsecode'))->first();
           $modulegrades_sublist2 = DB::table('grades_sub')->
           rightJoin('trans_student', 'grades_sub.rollno', '=', 'trans_student.rollno')->where('grades_sub.crsecode',$request->input('crsecode'))->where('grades_sub.acadyear',$request->input('acadyear'))->where('grades_sub.acadsem',$request->input('acadsem'))->select('grades_sub.*', 'trans_student.studentid', 'trans_student.rollno')->get();
            $modulegrades_sublist=$modulegrades_sublist2->unique();

        // $modulegrades_sublist=$modulegrades_sublist->groupBy('grades_sub.rollno');
          //  $modulegrades_sublist->
    //     dd($modulegrades_sublist);
        // $requestData = $request->all();
        // DB::insert('insert into feedback_allocation (acadyear, facultyname,acadsem,crsetype,crsecordi,dept,program,lock,crsecode)
        //                  values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$request->input('acadyear'), $request->input('facultyname'),$request->input('acadsem'),0,0 ,$request->input('dept'),NULL,0,$request->input('crsecode')]);
        // Feedback_allocation::create($requestData);
return view('admin.transcript_course.greade_sub',compact('modulegrades_sublist','acadyear','acadsem','crsecode','modulecourselist'));
       // return redirect('admin/transcript_course')->with('flash_message', 'Feedback_allocation added!');
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
        $feedback_allocation = Feedback_allocation::findOrFail($id);

        return view('admin.transcript_course.show', compact('feedback_allocation'));
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
        $feedback_allocation = Feedback_allocation::findOrFail($id);
   $moduleadmin = DB::table('admin_course_allocas')->get();//Admin_course_alloca::get();
            $faculty_profile =DB::table('faculty_profile')->get();//Faculty_profile::get();
    //  dd($moduleadmin);
              $department = DB::table('department')->get();
        return view('admin.transcript_course.edit', compact('feedback_allocation','faculty_profile','moduleadmin','department'));
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
        
        $feedback_allocation = Feedback_allocation::findOrFail($id);
        $feedback_allocation->update($requestData);

        return redirect('admin/transcript_course')->with('flash_message', 'Feedback_allocation updated!');
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
        Feedback_allocation::destroy($id);

        return redirect('admin/transcript_course')->with('flash_message', 'Feedback_allocation deleted!');
    }
}
