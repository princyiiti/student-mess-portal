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
use Carbon\Carbon;
use DateTime;
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
        $perPage = 25;

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

         //dd($Rebate[0]->subcription_data);

        

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
            //'mess_subcription_id'=>'required',
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

        //dd($form_date,$to_date);

        $totalday = $diffInDays +1;



        // start validation code 
        //1.rebate can be applied for a minimum of 2-7 consecutive days (Short Term Rebate) 


        if($request->post('type_rebate') == 'Short Term Rebate' && $totalday > 7){

            return redirect('admin/rebate/create')->with('flash_message', 
            'rebate can be applied for a minimum of 2-7 consecutive days');
        }

         //2.invalidate date 

         if($request->to_date < $request->from_date){
            return redirect('admin/rebate/create')->with('flash_message', 'Invalide Date Input');
        }


         //5.active subcription period are applied the rebate'


         //$active_period_data=Student_mess_data::where('id',$request->mess_subcription_id)->first();
         $active_period_data = StudnetCurrentSubcription::where('student_email',auth()->user()->email)->where('status',1)->first();

         if($active_period_data == null){
            return redirect('admin/rebate/create')->with('flash_message', 'Your Current Subcription is not active! Please Contact to Student Affaiers');
         }
         
         $str_per_to_date = strtotime($active_period_data->end_date);
         $str_per_form_date = strtotime($active_period_data->start_date);
         $str_to_date = strtotime($endDate);
         $str_form_date = strtotime($startDate);


         //4.overlape condition check

        $modelold=Rebate::where('created_by',\Auth::user()->id)->get();

        //dd($modelold);

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

         

        //check condition for date spilt (single month rebate apply and two month between rebate apply)

        $form_time=strtotime($request->get('from_date'));
        $to_time=strtotime($request->get('to_date'));
        //start month and end month 
        $form_month=date("m",$form_time);
        $to_month =date("m",$to_time);

        $monthdifferance = $form_month - $to_month;

        if($monthdifferance > 1){
            return redirect('admin/rebate/create')->with('flash_message', 'Inalid month');
        }

        if(($str_per_form_date <= $str_form_date) && ($str_per_to_date >= $str_to_date) ){

            if($form_month != $to_month){


                //make to rebate date 
                //first rebate form date and to date 

                $first_form_date = $form_date;
                $first_end_date = date("t-m-Y", strtotime($form_date));

                //second rebate form date and to date 

                $second_form_date =  date("01-m-Y", strtotime($to_date));
                $second_to_date = $to_date;

                //date differance in case date spilt

                $startDatefirst = Carbon::parse($first_form_date);
                $endDatefirst = Carbon::parse($first_end_date);

                $startDatesecond = Carbon::parse($second_form_date);
                $endDatesecond = Carbon::parse($second_to_date);

                $firstdiffInDays = $endDatefirst->diffInDays($startDatefirst);
                $seconddiffInDays = $endDatesecond->diffInDays($startDatesecond);

                $totaldayfirst = $firstdiffInDays+1;
                $totaldaysecond = $seconddiffInDays+1;



                // $subcription_id_first=Student_mess_data::Where('created_by', auth()->user()->id)->whereDate('from_date','>=', $form_date)->WhereDate('to_date','<=', $endDate)->get();
                $subcription_id_first=Student_mess_data::Where('created_by', auth()->user()->id)->whereMonth('from_date','=',$form_month)->first();
                $subcription_id_second=Student_mess_data::Where('created_by', auth()->user()->id)->whereMonth('to_date','=',$to_month)->first();

                //dd($subcription_id_first,$subcription_id_second,$form_month,$to_month);

                if($subcription_id_first == null && $subcription_id_second == null){
                    return redirect('admin/rebate/create')->with('flash_message', 'invalid');
                }


                $rebateapplieddata_first= DB::table('rebates')->Select('rebates.*')
                ->Where('created_by', auth()->user()->id)
                ->where('type_rebate','Short Term Rebate')
                ->where('mess_subcription_id',$subcription_id_first->id)->sum('rebates.total_rebate_day');

                $rebateapplieddata_second= DB::table('rebates')->Select('rebates.*')
                ->Where('created_by', auth()->user()->id)
                ->where('type_rebate','Short Term Rebate')
                ->where('mess_subcription_id',$subcription_id_second->id)->sum('rebates.total_rebate_day');

                //3.maximum limit for short term rebate in a month is 8 days

                if($request->post('type_rebate') == 'Short Term Rebate'){
                    $addnewcount_first = $rebateapplieddata_first + $totaldayfirst;

        
                    if(($rebateapplieddata_first) >=8 && ($addnewcount_first >= 8) ){
    
                        return redirect('admin/rebate/create')->with('flash_message', 'maximum limit for short term rebate in a month is 8 days');
                    }
    
                    //4.maximum limit for short term rebate in a month is 8 days
    
                    $addnewcount_second = $rebateapplieddata_second + $totaldaysecond;
    
            
                    if(($addnewcount_second) >=8 && ($addnewcount_second >= 8) ){
    
                        return redirect('admin/rebate/create')->with('flash_message', 'maximum limit for short term rebate in a month is 8 days');
                    }

                }

            
                $rebate_first = new Rebate;
                $rebate_first->status = 2;
                $rebate_first->created_by = \Auth::user()->id;
                $rebate_first->mess_name = $active_period_data->mess_name;
                $rebate_first->total_rebate_day = $totaldayfirst;
                $rebate_first->from_date = $first_form_date;
                $rebate_first->to_date = $first_end_date;
                $rebate_first->mess_subcription_id = $subcription_id_first->id;
                $rebate_first->type_rebate = $request->post('type_rebate');
                $rebate_first->reason = $request->post('reason');
                $rebate_first->file_path =$file_path;
                $rebate_first->save();

                $rebate_second = new Rebate;
                $rebate_second->status = 2;
                $rebate_second->created_by = \Auth::user()->id;
                $rebate_second->mess_name = $active_period_data->mess_name;
                $rebate_second->total_rebate_day = $totaldaysecond;
                $rebate_second->from_date = $second_form_date;
                $rebate_second->to_date = $second_to_date;
                $rebate_second->mess_subcription_id = $subcription_id_second->id;
                $rebate_second->type_rebate = $request->post('type_rebate');
                $rebate_second->reason = $request->post('reason');
                $rebate_second->file_path =$file_path;
                $rebate_second->save();

    
                return redirect('admin/rebate')->with('flash_message', 'Rebate added!');
                
            }else{
                $subcription_id =Student_mess_data::Where('created_by', auth()->user()->id)->whereMonth('from_date','=',$form_month)->first();

                if($subcription_id == null){
                    return redirect('admin/rebate/create')->with('flash_message', 'invalid');
                }

                $rebateapplieddata= DB::table('rebates')->Select('rebates.*')
                ->Where('created_by', auth()->user()->id)
                ->where('type_rebate','Short Term Rebate')
                ->where('mess_subcription_id',$subcription_id->id)->sum('rebates.total_rebate_day');

                //5.maximum limit for short term rebate in a month is 8 days

                $addnewcount = $rebateapplieddata + $totalday;

        
                if(($rebateapplieddata) >=8 && ($addnewcount >= 8) ){

                    return redirect('admin/rebate/create')->with('flash_message', 'maximum limit for short term rebate in a month is 8 days');
                }

                $rebate_second = new Rebate;
                $rebate_second->status = 2;
                $rebate_second->created_by = \Auth::user()->id;
                $rebate_second->mess_name = $active_period_data->mess_name;
                $rebate_second->total_rebate_day = $totalday;
                $rebate_second->from_date = $form_date;
                $rebate_second->to_date = $to_date;
                $rebate_second->mess_subcription_id = $subcription_id->id;
                $rebate_second->type_rebate = $request->post('type_rebate');
                $rebate_second->reason = $request->post('reason');
                $rebate_second->file_path =$file_path;
                $rebate_second->save();

                // $request->request->add(['status' => 2]);
                // $request->request->add(['created_by' => \Auth::user()->id]);
                // $request->request->add(['mess_name' => $active_period_data->mess_name]);
                // $request->request->add(['total_rebate_day' =>$totalday]);
                // $request->request->add(['mess_subcription_id'=>$subcription_id->id]);
                // $request->request->add(['file_path'=>$file_path]);
                // $requestData = $request->all();       
                // Rebate::create($requestData);
    
                return redirect('admin/rebate')->with('flash_message', 'Rebate added!');

            }
        }else{
            return redirect('admin/rebate/create')
            ->with('flash_message', 'The date you have selected is not in the period of your active plan');
        }

        //end date spilt code 
        
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
public function active($id,$state)
{
    $Rebate = Rebate::findOrFail($id);
    $Rebate->status=$state;
    $Rebate->save();
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

        $list = Rebate::all()->toArray();

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

        $filename = 'Rebate Report';

        return response()->stream($callback, 200, $headers);
    }

    public function deletecurrentplan(){

        $data = StudnetCurrentSubcription::all();

        return view('admin.Rebate.activeplan',compact('data'));
    }

    public function deleteplan($id){

        StudnetCurrentSubcription::destroy($id);


        return redirect('current-plan')->with('flash_message', 'Rebate deleted!');

    }
}