<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Program;
use DB;
// use Yajra\DataTables\Facades\DataTables;
use DataTables;
use App\FeesDetail;
use App\StudentMasterFee;
use Response;
use App\StudentTotalFee;
use App\FeeType;
use App\Feestructure;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FinaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $program= DB::table('new_autumn_2021')
                 ->select('prog as program')
                 ->groupBy('prog')
                 ->get();
        $category= DB::table('new_autumn_2021')
                 ->select('caste as castcategory')
                 ->groupBy('caste')
                 ->get();
        
        return view('admin.finance.index_new',compact('category','program'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function view(Request $request)
     {
        //dd($request->ajax());
        if ($request->ajax()) {

            $input = $request->all();

            if(isset($input['from_date']) && isset($input['to_date'])){
                $startDate = Carbon::createFromFormat('Y-m-d', $input['from_date'])->startOfDay();
                $endDate = Carbon::createFromFormat('Y-m-d',$input['to_date'])->endOfDay();
            }
            if(isset($input['from_date'])){
                $startDate = Carbon::createFromFormat('Y-m-d', $input['from_date'])->startOfDay();
            }
            if(isset($input['to_date'])){
                $toDate = Carbon::createFromFormat('Y-m-d', $input['to_date'])->startOfDay();
            }

            //dd($startDate,$endDate);

            $data = StudentTotalFee::select('*');

            //dd($data[0]['payment_date']);

            if(isset($input['from_date']) ){
                
                $data = $data->whereDate('paid_date','>=',$startDate);
            }

            if(isset($input['to_date']) ){
                
                $data = $data->whereDate('paid_date','<=',$toDate);
            }
            
            if(isset($input['from_date']) && isset($input['to_date'])) {
                //$data = $data->whereBetween('paid_date', [$input['from_date'], $input['to_date']]);
                $data = $data->whereDate('paid_date', '>=', $startDate)
                ->whereDate('paid_date', '<=', $endDate);
            }
            if(isset($input['filter_category'])) {
                $data = $data->where('category', $input['filter_category']);
            }
            if(isset($input['filter_program'])) {
                $data = $data->where('program', $input['filter_program']);
            }
            if(isset($input['filter_status'])) {
                $data = $data->where('status', $input['filter_status']);
            }
            $data = $data->get();


            


           
            return \DataTables::of($data)
                ->addColumn('Actions', function($data) {

                    if($data->status == 2){
                        return '<a href="/admin/studenttotalfee/'.$data->id.'" class="btn btn-info">view</a><br>      
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                         
                        <a href="/'.$data->file.'" class="btn btn-primary" download="'.$data->file.'" title="'.$data->file.'" ><i class="fa fa-print nav-icon"></i>Print Fee Receipt</a></a>
                        ';
                    }else{
                        return '<a href="/admin/studenttotalfee/'.$data->id.'" class="btn btn-info">view</a>
                    ';
                    }
                    
                })
                ->addColumn('status', function($row){
                    if($row->status  == 0){
                       return '<span class="badge badge-danger">Unpaid</span>';
                    }else if($row->status == 2){
                       return '<span class="badge badge-primary">Paid</span>';
                    }else if($row->status == 9){
                         return '<span class="badge badge-danger">Transaction Failed</span>';
                    }
                    else{

                        return '<span class="badge badge-warning">Partial Payment Amount</span>';
                    }
               })
               ->addColumn('transaction_id',function($row){
                    return '<p id="copytext">'.Str::limit($row->transaction_id, 20 ).'</p>
                    ';
               })
               ->addColumn('email',function($row){
                    return $row->registerstudent->email;
                })
               ->addColumn('total_paid_amount',function($row){
                    return $row->paid_amount-$row->remission_amount;
                })
                ->rawColumns(['Actions','status','transaction_id'])
                ->make(true);
        }
    
        $program= DB::table('new_autumn_2021')
                 ->select('prog as program')
                 ->groupBy('prog')
                 ->get();
        $category= DB::table('new_autumn_2021')
                 ->select('caste as castcategory')
                 ->groupBy('caste')
                 ->get();
        return view('admin.finance.index_new',compact('category','program'));
        
     }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    function exportExcel(Request $request)
    {

        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
        ,   'Content-type'        => 'text/csv'
        ,   'Content-Disposition' => 'attachment; filename=Fees.csv'
        ,   'Expires'             => '0'
        ,   'Pragma'              => 'public'
        ];

        $list = StudentMasterFee::all()->toArray();

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

        $filename = 'Fees';

        return response()->stream($callback, 200, $headers);
    }

    function viewdetails($id){

        return view('admin.finance.fees_details');
    }

    function studentmasterfees()
    {
        $category = Category::all();
        $program = Program::all();
        return view('admin.finance.index_new',compact('category','program'));
        //return view('admin.finance.index_new');
    }

    public function feesallocationslist(){
        

        $data = StudentTotalFee::select('ademission_year','program','academic_tearm','feestructure_id')
        ->groupBy('ademission_year','program','academic_tearm','feestructure_id')
        ->with('Feestructuredata')
        ->get();

        $FeeType = FeeType::all();

        return view('admin.FeesAllocation.index',compact('data','FeeType'));
    }

    public function feereport(){
        // $program= DB::table('student_profile')
        // ->select('program')
        // ->groupBy('program')
        // ->get();
        // $category= DB::table('student_profile')
        // ->select('castcategory')
        // ->groupBy('castcategory')
        // ->get();
        $program= DB::table('new_autumn_2021')
                 ->select('prog as program')
                 ->groupBy('prog')
                 ->get();
        $category= DB::table('new_autumn_2021')
                 ->select('caste as castcategory')
                 ->groupBy('caste')
                 ->get();

        return view('admin.Report.index',compact('category','program'));
    }

    public function studentfeeslist(Request $request){

        $input = $request->all();
        $val = StudentTotalFee::first();
        $feetypelist=Feetype::get();


        $feestructure = Feestructure::select('*')
        ->where('ademission_year',$input['admission_year'])
        ->where('program',$input['program'])
        ->where('category',$input['category'])
        ->where('academic_year',$input['academic_year'])
        ->where('academic_tearm',$input['academic_tearm'])
        ->first();

       // dd($feestructure->FeeDetails);
        
        // $view = StudentTotalFee::select('*')
        // ->where('rollno',220002021)
        // ->where('ademission_year',$input['admission_year'])
        // ->where('program',$input['program'])
        // ->where('category',$input['category'])
        // ->get()->groupBy('rollno');

        $view = StudentTotalFee::select('*')
        ->where('ademission_year',$input['admission_year'])
        ->where('program',$input['program'])
        ->where('category',$input['category'])
        ->where('academic_year',$input['academic_year'])
        ->where('academic_tearm',$input['academic_tearm'])
        ->get();

        $data = $view;


        // foreach ($data as $key => $value) {
        //     foreach($value as $li){
        //         dd($li->feestructure_id);
        //     }
        // }


        $html = view('admin.Report.studentlist', compact('data','feestructure'))->render();

        $response = array(
            'count' => 1,
            'html' => $html,
        );
        return response()->json($response);
    }

    
}


