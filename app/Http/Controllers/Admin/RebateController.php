<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Rebate;
use App\Student_mess_data;
use App\StudnetCurrentSubcription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Messlist;
use App\user;
use Carbon\Carbon;
use DateTime;
use Mail;
use App\Mail\MailUser;
use App\Mail\CatererMail;
class RebateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $Rebate = Rebate::where('title', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
             if(auth()->user()->role_id==3){
                $Rebate = Rebate::Where('created_by', auth()->user()->id)->latest()->paginate($perPage);
            }else{
                $Rebate = Rebate::where('from_date', 'LIKE', "%$keyword%")
                    ->latest()->paginate($perPage);
            }
        }

       

        

        return view('admin.Rebate.index', compact('Rebate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        $messlist=DB::table('messlist')->get();
         $hostellist=DB::table('hostel_lists')->get();
        //$programlist=DB::table('program')->get();
        $programlist= DB::table('student_profile')
        ->select('program')
        ->groupBy('program')
        ->get();
        // $student_sub_data = StudnetCurrentSubcription::where('student_email',auth()->user()->email)->where('status',1)->get();
        $model=\App\User::whereEmail(auth()->user()->email)->first();
        $student_sub_data = \App\Student_mess_data::where('created_by',$model->id)->where('status',1)->get();
        return view('admin.Rebate.create',compact('messlist','programlist','hostellist','student_sub_data'));
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
             'to_date' => 'required',
             'from_date' => 'required',
             'type_rebate'=>'required',
             'reason'=>'required',
             'file' => 'mimes:pdf|max:2048'
  
        ]);
 
         //dd($request->all());
 
        if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $destinationPath = 'public/uploads/longtermdoc';
            $request->file->move($destinationPath,$fileName);
 
            $file_path = 'uploads/longtermdoc/'.$fileName;
 
        }else{
            $file_path = null;
        }
         
 
        $startDate = Carbon::parse($request->post('from_date'));
        $endDate = Carbon::parse($request->post('to_date'));
 
        $diffInDays = $endDate->diffInDays($startDate);
 
 
        $form_date = date("d-m-Y", strtotime($request->get('from_date')));
        $to_date = date("d-m-Y", strtotime($request->get('to_date')));

         //dd($form_date,$startDate);
 
 
        $totalday = $diffInDays +1;
 
         //both rebates type condition check
 
         //1.invalidate date 
 
        if($request->to_date < $request->from_date){
            return redirect('admin/rebate/create')->with('flash_message', 'Invalide Date Input');
        }
         //2.active subcription period are applied the rebate
 
        $active_period_data = StudnetCurrentSubcription::where('student_email',auth()->user()->email)->where('status',1)->first();
 
        if($active_period_data == null){
            return redirect('admin/rebate/create')->with('flash_message', 'Your Current Subcription is not active! Please Contact to Student Affairs');
        }
 
        //3.overlape condition check
 
        $modelold=Rebate::where('created_by',\Auth::user()->id)->get();
 
        if($modelold){
             foreach ($modelold as $key => $value) {
                 $data_to_date = strtotime($value->to_date);
                 $data_from_date = strtotime($value->from_date);
                 $d_from_date = strtotime($to_date);
                 $d_to_date = strtotime($form_date);
 
                 if (($data_from_date <= $d_from_date) && ($data_to_date >= $d_to_date)){
                    return redirect('admin/rebate/create')->with('flash_message', 'You have already apply this date');
                 }
             }
                 
        }
 
        //split the rebate form date and end date
 
        $form_time=strtotime($request->get('from_date'));
        $to_time=strtotime($request->get('to_date'));
        //start month and end month 
        $form_month=date("m",$form_time);
        $to_month =date("m",$to_time);
 
        $monthdifferance = $to_month - $form_month;
 
        if($monthdifferance > 1){
            return redirect('admin/rebate/create')->with('flash_message', 'You can apply rebates manual');
        }
 
         //test condition short term
 
 
             // start validation code 
             //1.rebate can be applied for a minimum of 2-7 consecutive days (Short Term Rebate) 
 
 
             if($request->post('type_rebate') == 'Short Term Rebate' && $totalday > 7){
 
                return redirect('admin/rebate/create')->with('flash_message', 
                 'rebate can be applied for 2 to 7 consecutive days only');
             }

             if($request->post('type_rebate') == 'Long Term Rebate' && $totalday <= 7){
 
                return redirect('admin/rebate/create')->with('flash_message', 
                'Duration of rebate must be greater than or equal to 8 Days for Long term Rebate');
            }
 
             if($form_month != $to_month){
 
                 //make to rebate date 
                 //first rebate form date and to date 
 
                 $first_form_date = Carbon::parse($form_date);
                 $first_end_date = Carbon::parse(date("t-m-Y", strtotime($form_date)));
 
                 //second rebate form date and to date 
 
                 $second_form_date =  Carbon::parse(date("01-m-Y", strtotime($to_date)));
                 $second_to_date = Carbon::parse($to_date);

 
                 //date differance in case date spilt
 
                 $startDatefirst = Carbon::parse($first_form_date);
                 $endDatefirst = Carbon::parse($first_end_date);
 
                 $startDatesecond = Carbon::parse($second_form_date);
                 $endDatesecond = Carbon::parse($second_to_date);
 
                 $firstdiffInDays = $endDatefirst->diffInDays($startDatefirst);
                 $seconddiffInDays = $endDatesecond->diffInDays($startDatesecond);
 
                 $totaldayfirst = $firstdiffInDays+1;
                 $totaldaysecond = $seconddiffInDays+1;
 
     
                 $subcription_id_first=Student_mess_data::Where('created_by', auth()->user()->id)->whereMonth('from_date','=',$form_month)->first();
                 $subcription_id_second=Student_mess_data::Where('created_by', auth()->user()->id)->whereMonth('to_date','=',$to_month)->first();
 
                 //dd($subcription_id_first,$subcription_id_second,$form_month,$to_month);
 
 
 
                 if($subcription_id_first){
                    $subcription_data_first = $subcription_id_first->id;
                    $value = $this->checkmonth($request,$subcription_data_first,$totaldayfirst);
                    if($value){
                        return redirect('admin/rebate/create')->with('flash_message', 'maximum limit for short term rebate in a month is 8 days');
                    }
                 }else{
                     $subcription_data_first = null;
                 }
 
                 if($subcription_id_second){
                    $subcription_data_second = $subcription_id_second->id;

                    $value = $this->checkmonth($request,$subcription_data_second,$totaldaysecond);
                    if($value){
                        return redirect('admin/rebate/create')->with('flash_message', 'maximum limit for short term rebate in a month is 8 days');
                    }
 
                 }else{
                     $subcription_data_second = null;
                 }
 
             }else{
                 $subcription_id =Student_mess_data::Where('created_by', auth()->user()->id)->whereMonth('from_date','=',$form_month)->first();

                 if($subcription_id){
                    $subcription_data = $subcription_id->id;
                }else{
                    $subcription_data = null;
                }

                $value = $this->checkmonth($request,$subcription_data,$totalday);

            
                if($value){
                    return redirect('admin/rebate/create')->with('flash_message', 'maximum limit for short term rebate in a month is 8 days');
                }
 
            }
 
         if($form_month != $to_month){
            $this->rebatecreate($active_period_data,$totaldayfirst,$first_form_date,$first_end_date,$subcription_data_first,$request,$file_path);
            $this->rebatecreate($active_period_data,$totaldaysecond,$second_form_date,$second_to_date,$subcription_data_second,$request,$file_path);
            return redirect('admin/rebate')->with('flash_message', 'Rebate added!');
         }else{

            $this->rebatecreate($active_period_data,$totalday,$startDate,$endDate,$subcription_data,$request,$file_path);
            return redirect('admin/rebate')->with('flash_message', 'Rebate added!');
         }
         
    }

    public function rebatecreate($active_period_data,$totalday,$startDate,$endDate,$subcription_data,$request,$file_path){

        $rebate_second = new Rebate;
        $rebate_second->status = 2;
        $rebate_second->created_by = \Auth::user()->id;
        $rebate_second->mess_name = $active_period_data->mess_name;
        $rebate_second->total_rebate_day = $totalday;
        $rebate_second->from_date = $startDate;
        $rebate_second->to_date = $endDate;
        $rebate_second->mess_subcription_id = $subcription_data;
        $rebate_second->type_rebate = $request->post('type_rebate');
        $rebate_second->reason = $request->post('reason');
        $rebate_second->file_path =$file_path;
        $rebate_second->save();

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
        $Rebate = Rebate::findOrFail($id);

        return view('admin.Rebate.show', compact('Rebate'));
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
        $Rebate = Rebate::findOrFail($id);

        return view('admin.Rebate.edit', compact('Rebate'));
    }
     public function ajaxupdate($id)
    {
        if (User::isAdminL()){
        $Rebate = Rebate::findOrFail($id);
         $Rebate = Rebate::findOrFail($id);
     }
        return view('admin.Rebate.edit', compact('Rebate'));
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
        
        $Rebate = Rebate::findOrFail($id);
        $Rebate->update($requestData);

        return redirect('admin/rebate')->with('flash_message', 'Rebate updated!');
    }
    public function active(Request $request)
    {

        $Rebate = Rebate::findOrFail($request->id);

        $data = User::find($Rebate->created_by);

        $messdata = messlist::where('title',$Rebate->mess_name)->first();

        //dd($Rebate,$data,$messdata);

        
        $Rebate->status=$request->status;
        $Rebate->save();
        $to = 'princy@iiti.ac.in';
        $Catereremail = $messdata->email;
        
        if($request->status == 1){
            Mail::to($to)->send(new MailUser($data,$messdata,$Rebate));
            Mail::to($Catereremail)->send(new CatererMail($data,$messdata,$Rebate));
        }
        if($request->status == 0){
            Mail::to($to)->send(new MailUser($data,$messdata,$Rebate));
        }
        if($Rebate){
            $msg = "Rebate status changed sucessfully ";

            $response = array('count' => 1,'status'=> true,'html' =>$msg );
        }else{
            $msg = "invalid data select";
            $response = array('count' => 0,'status'=> true,'html' =>$msg );
        }



        return response()->json($response);
        return redirect('admin/rebate')->with('flash_message', 'Rebate updated!');
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
        Rebate::destroy($id);

        return redirect('admin/rebate')->with('flash_message', 'Rebate deleted!');
    }

    public function demolist(Request $request){
        
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
    
                $data = Rebate::select('*');
    
                //dd($data[0]['payment_date']);
    
                if(isset($input['from_date']) ){
                    
                    $data = $data->whereDate('from_date','>=',$startDate);
                }
    
                if(isset($input['to_date']) ){
                    
                    $data = $data->whereDate('to_date','<=',$toDate);
                }
                
                if(isset($input['from_date']) && isset($input['to_date'])) {
                    $data = $data->whereDate('from_date', '>=', $startDate)
                    ->whereDate('to_date', '<=', $endDate);
                }
                if(isset($input['status'])) {
                    $data = $data->where('status', $input['status']);
                }
                if(isset($input['mess_name'])) {
                    $data = $data->where('mess_name', $input['mess_name']);
                }
                $data = $data->get();

                //dd($data);

               
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
                        if($row->status == 1){
                            return '<span style="color: green;">Approved</span>';
                         }elseif($row->status == 2){
                            return '<span style="color: #007bff;">Pending</span>';
                         }else{
                            return '<span style="color: red;">Reject</span>';
                         }
                   })
                   ->addColumn('student_name',function($row){
                        return $row->userdata->name;
                    })
            
                    ->rawColumns(['Actions','status','student_name'])
                    ->make(true);
            }
            $messlistst = Messlist::get();
            
            return view('admin.Rebate.rebatereport',compact('messlistst'));
            
         }
    }
    public function Allmessrebat(){

        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
        ,   'Content-type'        => 'text/csv'
        ,   'Content-Disposition' => 'attachment; filename=Rebate.csv'
        ,   'Expires'             => '0'
        ,   'Pragma'              => 'public'
        ];

        $list = Rebate::get();
       
        $data =array();

        foreach ($list as $key => $value) {

            if($value->status == 1){
                $status = 'Approved';
            }elseif($value->status == 2){
                $status = 'Pending';
            }else{
                $status = 'Rejected';
            }

            $user = User::find($value->created_by);


            $data[] = [
                'Student Name'=>$user->name,
                'Email'=>$user->email,
                'Mess name' =>$value->mess_name,
                'Rebate Type'=>$value->type_rebate,
                'Form Date'=>$value->from_date,
                'TO Date' =>$value->to_date,
                'Total rebate day' =>$value->total_rebate_day,
                'Status' =>$status,
            ];
            
        }



        if($data){
            # add headers for each column in the CSV download
            array_unshift($data, array_keys($data[0]));

            $callback = function() use ($data) 
            {
                $FH = fopen('php://output', 'w');
                foreach ($data as $row) { 
                    fputcsv($FH, $row);
                }
                fclose($FH);
            };

            $filename = 'Rebate Report';

            return response()->stream($callback, 200, $headers);
        }else{
            return redirect('admin/student_mess_data')->with('flash_message', 'invalid data download!');
        }
    }

    public function deletecurrentplan(){

        $data = StudnetCurrentSubcription::all();

        return view('admin.Rebate.activeplan',compact('data'));
    }

    public function deleteplan($id){

        StudnetCurrentSubcription::destroy($id);


        return redirect('current-plan')->with('flash_message', 'Rebate deleted!');

    }
    public function checkmonth($request,$subcription_id,$totalday){

        $rebateapplieddata= DB::table('rebates')->Select('rebates.*')
        ->Where('created_by', auth()->user()->id)
        ->where('type_rebate','Short Term Rebate')
        ->where('mess_subcription_id',$subcription_id)->sum('rebates.total_rebate_day');

        

        if($request->post('type_rebate') == 'Short Term Rebate'){
            $addnewcount = $rebateapplieddata + $totalday;

            
            if(($rebateapplieddata >=8) || ($addnewcount >= 8) ){
                //return redirect('admin/rebate/create')->with('flash_message', 'maximum limit for short term rebate in a month is 8 days');
                return $addnewcount;
            }
        }

       
    }

    public function rebate_approved(Request $request){

        $rebate_data = $request->rebates;
        $status = $request->status;

        if($rebate_data){
            foreach ($rebate_data as $key => $value) {

                $Rebate = Rebate::findOrFail($value);
    
                $data = User::find($Rebate->created_by);
        
                $messdata = messlist::where('title',$Rebate->mess_name)->first();
    
                $Rebate->status=$status;
                $Rebate->save();
                
            }
            if($status == 1){
                $msg = "All data Approved Sucessfully";
            }else{
                $msg = "All data Rejected Sucessfully";
            }
            
            $response = array('count' => 1,'status'=> true,'html' =>$msg );
        }else{
            $msg = "invalid data select";
            $response = array('count' => 0,'status'=> true,'html' =>$msg );
        }


        // $to = 'princy@iiti.ac.in';
        // if($state == 1){
        //     Mail::to($to)->send(new MailUser($data,$messdata,$Rebate));
        // }
        // if($state == 0){
        //     Mail::to($to)->send(new MailUser($data,$messdata,$Rebate));
        // }
        return response()->json($response);
        
       
        //return redirect('admin/rebate')->with('flash_message', 'Rebate updated!');

    }
}