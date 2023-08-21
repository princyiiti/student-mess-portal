<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\FeeStudent;
use App\StudentTotalFee;
use Illuminate\Http\Request;
use Validator;
//use Excel;
use App\Exports\StudentTotalFeeExport;
use Maatwebsite\Excel\Facades\Excel;
class FeeStudentController extends Controller
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
            $FeeStudent = FeeStudent::where('rollno', 'LIKE', "%$keyword%")
            ->orwhere('student_name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $FeeStudent = FeeStudent::latest()->paginate($perPage);
        }

        return view('admin.FeeStudent.index', compact('FeeStudent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
          $feetype = DB::table('fee_types')->get();
        return view('admin.FeeStudent.create',compact('feetype'));
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
            'rollno' => 'required',
            'amount' => 'required',
            'amount' => 'required',
            'academic_tearm'=> 'required',
            'academic_year'=> 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect('admin/feestudent/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        FeeStudent::create($requestData);
   

        return redirect('admin/feestudent')->with('flash_message', 'FeeStudent added!');
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
        $FeeStudent = FeeStudent::findOrFail($id);

        return view('admin.FeeStudent.show', compact('FeeStudent'));
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
        $feestudent = FeeStudent::findOrFail($id);
        $feetype = DB::table('fee_types')->get();
        return view('admin.FeeStudent.edit', compact('feestudent','feetype'));
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
        
        $FeeStudent = FeeStudent::findOrFail($id);
        $FeeStudent->update($requestData);

        return redirect('admin/feestudent')->with('flash_message', 'FeeStudent updated!');
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
        FeeStudent::destroy($id);

        return redirect('admin/feestudent')->with('flash_message', 'FeeStudent deleted!');
    }
    public function active(Request $request,$id,$type){
       
         $request->request->add(['type' => $type]);
         $requestData = $request->all();
    

         $FeeStudent = FeeStudent::findOrFail($id);
         $FeeStudent->update($requestData);
          $dataAll=  FeeStudent::where('rollno', '=',$FeeStudent->rollno)
     ->where('academic_tearm', '=',$FeeStudent->academic_tearm)
      ->where('academic_year', '=',$FeeStudent->academic_year)->where('type', '=',0)
    ->get();
    $totalamount=0;
    foreach($dataAll as $vall){
        $totalamount=$vall->amount+$totalamount;
    }

        $dataAll=  FeeStudent::where('rollno', '=',$FeeStudent->rollno)
     ->where('academic_tearm', '=',$FeeStudent->academic_tearm)
      ->where('academic_year', '=',$FeeStudent->academic_year)->where('type', '=',1)
    ->get();
    $dueamount=0;
    foreach($dataAll as $vall){
        $dueamount=$vall->amount+$dueamount;
    }
  //  echo 'DUE AMOUNT=>'.$dueamount;exit;

    $olddata=StudentTotalFee::where('rollno', '=',$FeeStudent->rollno)
     ->where('academic_tearm', '=',$FeeStudent->academic_tearm)
      ->where('academic_year', '=',$FeeStudent->academic_year)
    ->first();
    if(empty($olddata)){
     // $newmodel =new StudentTotalFee();
     //    $newmodel->rollno=  $FeeStudent->rollno;
          
     //        $newmodel->academic_tearm= $FeeStudent->academic_tearm;
     //        $newmodel->academic_year=  $FeeStudent->academic_year;
         
     //      $newmodel->fee_type="OK";
     //      $newmodel->status=0;
     //      $newmodel->type=0;
     //        $newmodel->totalamount= $FeeStudent->amount;
     //        $newmodel->save();
    }else{
        if($dueamount>0){
        $olddata->due_amount=$dueamount;
        $olddata->status=1;
    }else{
        $olddata->due_amount=$dueamount;
        $olddata->status=0;
    }
      $olddata->totalamount=$totalamount;
      $olddata->save();
    }
    // echo $totalamount.'=>';
    // echo $model->rollno.'<br>';
          return redirect('admin/feestudent')->with('flash_message', 'FeeStudent updated!');
    }

    public function importcsv(){
       
        return view('admin.FeeStudent.importcsv');
    }

     public function uploadcsv(Request $request) {
       
        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();
        $header=Excel::load($path)->first()->keys()->toArray();
          return view('admin.FeeStudent.previewupload', compact('header','data'));
       
    }

    public function savedatacsv(Request $request) {
        
         $requestData = $request->all();
      
         
         $manage = json_decode($request->input('data'), true);
      
         if(!empty($manage))
         {
            $totalamount=0;
         foreach($manage as $val)
         {
            $model = new FeeStudent();
            $model->rollno=  trim($val['rollno']);
            $model->student_name=  trim($val['student_name']);
            $model->academic_tearm=  trim($val['academic_tearm']);
            $model->academic_year=  trim($val['academic_year']);
            $model->fee_type=  trim($val['fees_type']);
            $model->created_by=  auth()->user()->id;
            $model->amount=  trim($val['amount']);
            $model->save();
        
        
         }
        
     }
        // print_r($request->input('data'));
          return redirect('admin/feestudent')->with('flash_message', 'Successfully Uploaded');
        // $request->validate([
        //     'import_file' => 'required'
        // ]);

        // $path = $request->file('import_file')->getRealPath();
        // $data = Excel::load($path)->get();
        // $header=Excel::load($path)->first()->keys()->toArray();
        //   return view('admin.FeeStudent.previewupload', compact('header','data'));
          // echo "<pre>";
          //  print_r($data);
          //  exit;
    }
    Public function Allfeeexport(){


        //return Excel::download(new StudentTotalFeeExport, 'TotalStudentFee.xlsx');
        // $data = StudentTotalFee::all()->toArray();
        // $type= 'csv';

        // //dd($data);
            
        // return Excel::create('Student Fee', function($excel) use ($data) {
        //     $excel->sheet('mySheet', function($sheet) use ($data)
        //     {
        //         $sheet->fromArray($data);
        //     });
        // })->download($type);

        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
        ,   'Content-type'        => 'text/csv'
        ,   'Content-Disposition' => 'attachment; filename=StudentFeeReport.csv'
        ,   'Expires'             => '0'
        ,   'Pragma'              => 'public'
        ];

        $list = StudentTotalFee::all()->toArray();

        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));

        $callback = function() use ($list) 
        {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) { 
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        $filename = 'Student Fee Report';

        return response()->stream($callback, 200, $headers);
        
    }
}
