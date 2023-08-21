<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Feestructure;
use App\FeeType;
use App\Feestructuredetail;
use Illuminate\Http\Request;
use Validator;
use App\StudentTotalFee;
use Illuminate\Support\Str;
class FeestructureController extends Controller
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

        $feestructure = Feestructure::all();

        //dd($feestructure);

        if (!empty($keyword)) {
            $feestructure = Feestructure::where('category', 'LIKE', "%$keyword%")
            ->orWhere('academic_tearm','LIKE',"%$keyword%")
            ->orWhere('academic_year','LIKE',"%$keyword%")
            ->orwhere('ademission_year','LIKE',"%$keyword%")
            ->orwhere('program','LIKE',"%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $feestructure = Feestructure::latest()->paginate($perPage);
        }

        return view('admin.Feestructure.index', compact('feestructure'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $feetypelist=Feetype::get();
       $programlist= DB::table('new_autumn_2021')
                 ->select('prog as program')
                 ->groupBy('prog')
                 ->get();
     $castcategorylist= DB::table('new_autumn_2021')
                 ->select('caste as castcategory')
                 ->groupBy('caste')
                 ->get();
        return view('admin.Feestructure.create',compact('feetypelist','castcategorylist','programlist'));
    }
    public function structurelistajax(Request $request){
        // print_r($request->all());exit;
        $feestructure = feestructure::where('program', $request->post('program'))->where('ademission_year', $request->post('admission_year'))->get();
      return  response()->json($feestructure);
    }
    public function studentlistajax(Request $request){
        $feestructure = Feestructure::findOrFail($request->post('feestructure'));
        $newcategory = Str::upper($feestructure->category);
        if(!empty($feestructure)){

            //$studentlist =  DB::table('new_autumn_2021')->where('caste',$feestructure->category)->get();
            $studentlist = DB::table('new_autumn_2021')
            ->where('prog',$feestructure->program)
            ->where('batch_year',$feestructure->ademission_year)
            ->where('caste',$feestructure->category)
            ->get();
            $html = view('admin.Feestructure.studentlist', compact('studentlist','feestructure'))->render();
            $response = array(
                'count' => 1,
                'html' => $html,
            );
            return response()->json($response);
        }
    }

    public function uploaddataajax(Request $request){
        $feestructure = Feestructure::findOrFail($request->post('feestructure'));
        if(!empty($feestructure)){
            // $studentlist= DB::table('student_profile')->where('present','Studying')->where('program',$feestructure->program)
            // ->where('batchyear',$feestructure->ademission_year)->where('castcategory',$feestructure->category)->get();
            $studentlist = DB::table('new_autumn_2021')
            ->where('prog',$feestructure->program)
            ->where('batch_year',$feestructure->ademission_year)
            ->where('caste',$feestructure->category)
            ->get();
            foreach($studentlist as $stuval)
            { 
                $olddata= StudentTotalFee::where('rollno',$stuval->rollno)->where('program',$request->program)->where('ademission_year',$feestructure->ademission_year)
                ->where('academic_tearm',$feestructure->academic_tearm)->first();
                     //dd($olddata);
                    if($olddata == null){
                      $modelstuden= new StudentTotalFee();
                      $modelstuden->rollno=$stuval->rollno;
                      $modelstuden->student_name=$stuval->name;
                      $modelstuden->ademission_year=$feestructure->ademission_year;
                      $modelstuden->program=$feestructure->program;
                      $modelstuden->category = $feestructure->category;                      
                      $modelstuden->academic_year=$feestructure->academic_year;
                      $modelstuden->academic_tearm=$feestructure->academic_tearm;
                      $modelstuden->totalamount=$feestructure->totalamount;
                      $modelstuden->feestructure_id=$feestructure->id;
                      $modelstuden->fee_type='OK';
                      $modelstuden->status=0;
                      $modelstuden->type=0;
                      $modelstuden->save();
                      
                      //$response = array('count' => 1,'status'=> true,'html' =>$modelstuden );
                      
                      
                    }else {
                        //return response()->json(['error'=>'<strong>Error!</strong>Already Data Uploaded']);
                    }

                   

            }
            return response()->json(['success'=>'<strong>Success!</strong>Student Fee Allocation Sucessfully']);
                 //return response()->json($response);
             }

        
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
            'category' => 'required',
             'academic_tearm' => 'required',
              'academic_year' => 'required',
               'program' => 'required',
                'ademission_year' => 'required',
            
        ]);
    $olddata=  Feestructure::where('category',$request->post('category'))->where('academic_tearm',$request->post('academic_tearm'))->where('academic_year',$request->post('academic_year'))->where('program',$request->post('program'))->where('ademission_year',$request->post('ademission_year'))->first();
    //print_r($olddata);exit;
       if(!empty($olddata)){
        $messages = array(
    'repeted' => 'This Record is already exists'
);
return back()->withInput()->withErrors($messages);
                       
//return redirect('admin/feestructure/create')->back()->with('program', 'This Record is already exists'); 
       }
        if ($validator->fails()) {
            return redirect('admin/feestructure/create')
                        ->withErrors($validator)
                        ->withInput();
        }
    
        // if()
      // dd($request->all());

        $id=Feestructure::create($requestData)->id;
        for($i=0; $i< count($request->post('amount')); $i++){
            $feedetails=new Feestructuredetail();
            $feedetails->fee_type=$request->post('fee_type')[$i];
            $feedetails->amount=$request->post('amount')[$i];
             $feedetails->feestructure_id=$id;
            $feedetails->save();
        }
        

        return redirect('admin/feestructure')->with('flash_message', 'feestructure added!');
   

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
        
        $feestructure = Feestructure::findOrFail($id);

        //dd($feestructure);

        return view('admin.Feestructure.show', compact('feestructure'));
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
        // dd('ddd');
        $programlist= DB::table('student_profile')
        ->select('program')
        ->groupBy('program')
        ->get();
        $castcategorylist= DB::table('student_profile')
        ->select('castcategory')
        ->groupBy('castcategory')
        ->get();
        $feestructure = Feestructure::findOrFail($id);
        

        //dd($feestructure);

        return view('admin.Feestructure.edit', compact('programlist','castcategorylist','feestructure'));
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

        // dd($requestData['amount']);

        $feestructure = Feestructure::findOrFail($id);
        //$feestructure->update($requestData);


        for ($i=0; $i < count($requestData['fee_details_id']) ; $i++) {

            $feedetialsdata = Feestructuredetail::findOrFail($requestData['fee_details_id'][$i]);
            $feedetialsdata->amount = $request['amount'][$i];
            $feedetialsdata->save();
            
        }

        return redirect('admin/feestructure')->with('flash_message', 'feestructure updated!');
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
        Feestructure::destroy($id);

        return redirect('admin/feestructure')->with('flash_message', 'feestructure deleted!');
    }

    
}