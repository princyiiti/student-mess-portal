<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\StudentTotalFee;
use Illuminate\Http\Request;
use App\Feestructure;
use Validator;
class StudentTotalFeeController extends Controller
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
            $StudentTotalFee = StudentTotalFee::where('rollno', 'LIKE', "%$keyword%")
            ->orWhere('student_name','iLIKE', "%$keyword%")
            ->orWhere('academic_year',$keyword)
            ->orWhere('academic_tearm',$keyword)
            ->latest()->paginate($perPage);
        } else {
            $StudentTotalFee = StudentTotalFee::latest()->paginate($perPage);
        }

        return view('admin.StudentTotalFee.index', compact('StudentTotalFee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $feestructurelist= Feestructure::get();
          $rollnolist= DB::table('student_profile')
                 ->select('rollno')->where('present','Studying')               
                 ->get();
       $programlist= DB::table('student_profile')
                 ->select('program')
                 ->groupBy('program')
                 ->get();
     $castcategorylist= DB::table('student_profile')
                 ->select('castcategory')
                 ->groupBy('castcategory')
                 ->get();
      
        return view('admin.StudentTotalFee.create',compact('feestructurelist','rollnolist','programlist','castcategorylist'));
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
         $validator = Validator::make($request->all(), [
            'title' => 'required',
           
        ]);
 
        if ($validator->fails()) {
            return redirect('admin/StudentTotalFee/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        StudentTotalFee::create($requestData);
   

        return redirect('admin/StudentTotalFee')->with('flash_message', 'StudentTotalFee added!');
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
        $model = StudentTotalFee::findOrFail($id);

        return view('admin.StudentTotalFee.show', compact('model'));
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

        $StudentTotalFee = StudentTotalFee::findOrFail($id);

        return response()->json($StudentTotalFee);

       

        //return view('admin.StudentTotalFee.edit', compact('StudentTotalFee'));
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
        $datechange = date('Y-m-d H:i:s', strtotime($requestData['extend_date']));
        $StudentTotalFee = StudentTotalFee::findOrFail($id);
        $StudentTotalFee->extend_date = $datechange;
        $StudentTotalFee->save();

        

        //return redirect('admin/StudentTotalFee')->with('flash_message', 'StudentTotalFee updated!');
        return response()->json(['success'=>'Student Data Update Sucessfully.']);
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
        StudentTotalFee::destroy($id);

        return redirect('admin/StudentTotalFee')->with('flash_message', 'StudentTotalFee deleted!');
    }
}
