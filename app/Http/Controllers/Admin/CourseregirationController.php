<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Courseregiration;
use Illuminate\Http\Request;
use App\Courseregirationchiled;
class CourseregirationController extends Controller
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
            $courseregirations = Courseregiration::where('title', 'LIKE', "%$keyword%")
                ->get();//->paginate($perPage);
        } else {
            $courseregirations = Courseregiration::get()->sortByDesc("id");//->paginate($perPage);
        }
        return view('admin.Courseregiration.index', compact('courseregirations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

      //  $programlist=
        $programlist= DB::table('student_profile')
                 ->select('program')
                 ->groupBy('program')
                 ->get();
        $departmentlist= DB::table('department')->get();
        $courselist= DB::table('courselist')->orderBy('crsecode', 'asc')->get();
        return view('admin.Courseregiration.create',compact('departmentlist','programlist','courselist'));
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
        $this->validate($request, [
			//'department' => 'required|unique:Courseregiration',
            'department' => 'required',
           // 'program' => 'required|integer'
             'program' => 'required'
		]);
         $request->request->add(['created_by' => auth()->user()->id]);
        $requestData = $request->all();
        
      $id=  Courseregiration::create($requestData)->id;
              
                for($i=0;$i<count($request->post('coursecode'));$i++){
                       $chiledtabel=new Courseregirationchiled();
                       $chiledtabel->coursecode=$request->post('coursecode')[$i];
                       $coursedata= DB::table('courselist')->where('crsecode',$request->post('coursecode')[$i])->first();
                       $chiledtabel->coursename= $coursedata->crsename;
                       $chiledtabel->coursetype=$request->post('coursetype')[$i];
                       $chiledtabel->courseregiration_id=$id;
                       $chiledtabel->created_by=auth()->user()->id;
                       $chiledtabel->save();



                }
        return redirect('admin/courseregiration')->with('flash_message', 'Courseregiration added!');
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
        $Courseregiration = Courseregiration::findOrFail($id);

        return view('admin.Courseregirations.show', compact('Courseregiration'));
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
        $model = Courseregiration::findOrFail($id);
        $programlist= DB::table('student_profile')
                 ->select('program')
                 ->groupBy('program')
                 ->get();
        // $programlist= DB::table('student_profile')
        //          ->select('program')
        //          ->groupBy('program')
        //          ->get();
        $departmentlist= DB::table('department')->get();
        $courselist= DB::table('courselist')->orderBy('crsecode', 'asc')->get();
       // dd($model->Chieldlist);

        return view('admin.Courseregiration.edit', compact('model','departmentlist','courselist','programlist'));
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
        
        $Courseregiration = Courseregiration::findOrFail($id);
        $Courseregiration->update($requestData);
         for($i=0;$i<count($request->post('coursecode'));$i++){
             $chiledtabel= Courseregirationchiled::where('coursecode',$request->post('coursecode')[$i])->where('courseregiration_id',$id)->first();
                    if(empty($chiledtabel)){
                       $chiledtabel=new Courseregirationchiled();
                       }
                       $chiledtabel->coursecode=$request->post('coursecode')[$i];
                       $coursedata= DB::table('courselist')->where('crsecode',$request->post('coursecode')[$i])->first();
                       $chiledtabel->coursename= $coursedata->crsename;
                       $chiledtabel->coursetype=$request->post('coursetype')[$i];
                       $chiledtabel->courseregiration_id=$id;
                       $chiledtabel->created_by=auth()->user()->id;
                       $chiledtabel->save();



                }

        return redirect('admin/courseregiration')->with('flash_message', 'Courseregiration updated!');
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
        //Courseregiration::destroy($id);
        $messdata = Courseregiration::find($id);
        DB::table('courseregirationchileds')->where('courseregiration_id', $id)->delete();
        $messdata->delete();

        return redirect('admin/courseregiration')->with('flash_message', 'Courseregiration deleted!');
    }

     public function deletchield($id)
    {
        //Courseregiration::destroy($id);
        $messdata = Courseregirationchiled::find($id);
        DB::table('courseregirationchileds')->where('courseregiration_id', $id)->delete();
        $messdata->delete();

        return redirect()->getUrlGenerator()->previous();//redirect('admin/courseregiration')->with('flash_message', 'Courseregiration deleted!');
    }
}
