<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Student_mess_data;
use App\Slot;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Messlist;
use Carbon\Carbon;
use App\Rebate;
use DateTime;
class Student_mess_dataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        //dd($request->all());
        $keyword = $request->get('student_name');
        $re_form_date = $request->get('form_date');
        $re_to_date = $request->get('to_date');

        $mess_name = $request->get('mess_name');
        $rollno = $request->get('rollno');
        $perPage = 25;

         if(auth()->user()->role_id==3){
            $Student_mess_data = Student_mess_data::Where('created_by', auth()->user()->id)->get()->sortByDesc("id");
           }elseif(auth()->user()->role_id==5) {
            $Student_mess_data = Student_mess_data::Where('mess_name','Kanaka Caterer')->get();
            //dd($Student_mess_data);
           }else{
                if (!empty($keyword)) {
                    $Student_mess_data = Student_mess_data::where('student_name', 'LIKE', "%$keyword%")
                        ->latest()->paginate($perPage);
                } elseif ( !empty($mess_name) ) {
                    $Student_mess_data = Student_mess_data::where('mess_name', 'LIKE', "%$mess_name%")
                        ->latest()->paginate($perPage);
                }
                elseif ( !empty($re_form_date) and !empty($re_to_date)  ) {
                    $form_date = \Carbon\Carbon::createFromFormat('Y-m-d', $re_form_date)
                    ->format('d-m-Y');

                    $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $re_to_date)
                    ->format('d-m-Y');
                    $Student_mess_data = Student_mess_data::whereBetween('from_date',[$form_date,$to_date])->whereBetween('to_date', [$form_date,$to_date])
                        ->latest()->paginate($perPage);
                }elseif(!empty($re_form_date)){
                    $form_date = \Carbon\Carbon::createFromFormat('Y-m-d', $re_form_date)
                    ->format('d-m-Y');
                    $Student_mess_data = Student_mess_data::where('from_date','=', $form_date)
                        ->latest()->paginate($perPage);
                }elseif(!empty($re_to_date)){
                    $to_date = \Carbon\Carbon::createFromFormat('Y-m-d', $re_to_date)
                    ->format('d-m-Y');
                    $Student_mess_data = Student_mess_data::where('to_date', '=', $to_date)
                        ->latest()->paginate($perPage);
                }
                else {
                    $Student_mess_data = Student_mess_data::where('student_name', 'LIKE', "%$keyword%")
                        ->latest()->paginate($perPage);
                }
        //dd($Student_mess_data,$form_date,$newDate);
        }
        //dd($Student_mess_data);
        $messlistst = Messlist::get();
        
        return view('admin.Student_mess_data.index', compact('messlistst'));
    }

    public function Studentmessdata(Request $request){

        if ($request->ajax()) {
    
            $input = $request->all();

            if(isset($input['from_date']) && isset($input['to_date'])){
                $startDate = Carbon::createFromFormat('Y-m-d', $input['from_date']);
                $endDate = Carbon::createFromFormat('Y-m-d',$input['to_date']);
            }
            if(isset($input['from_date'])){
                $startDate = Carbon::createFromFormat('Y-m-d', $input['from_date']);
            }
            if(isset($input['to_date'])){
                $toDate = Carbon::createFromFormat('Y-m-d', $input['to_date']);
            }

            //dd($input['from_date']);


            $data = Student_mess_data::select('*');

            //dd($data->get());


            if(isset($input['from_date']) ){
                
                $data = $data->whereDate('from_date','>=',$startDate);

                
            }

            if(isset($input['to_date']) ){
                
                $data = $data->whereDate('to_date','<=',$input['to_date']);
            }

            //dd($data->get());
            
            if(isset($input['from_date']) && isset($input['to_date'])) {
                $data = $data->whereDate('from_date', '>=', $startDate)
                ->whereDate('to_date','<=',$input['to_date']);
            }

            //dd($data->get());

            
            
            if(isset($input['status'])) {
                $data = $data->where('status', $input['status']);
            }
            if(isset($input['mess_name'])) {
                $data = $data->where('mess_name', $input['mess_name']);
            }
            $data = $data->get();
           
            return \DataTables::of($data)
                ->addColumn('Actions', function($row) {
                    return '<a href="mess_data/delete/'.$row->id.'" class="btn btn-danger">Delete</a>';
                   
                })
                ->addColumn('rebat_day', function($row){

                    $countday =  Rebate::countday($row);
                  
                    return '<span>'.$countday.'</span>';
                     
               })
               ->addColumn('totalday', function($row){
                    $countday =  Rebate::countday($row);

                    $date1 = new DateTime($row->to_date);
                    $date2 = new DateTime($row->from_date);
                    $days  = $date2->diff($date1)->format('%a');
                    $totalday =($days+1)-$countday;
                  
                return '<span style="color: green;">'.$totalday.'</span>';
                 
                })
                ->addColumn('from_date', function($row){

                    $f_date = \Carbon\Carbon::createFromFormat('Y-m-d', $row->from_date)->format('d M Y');
                  
                    return $f_date;
                     
                })
                ->addColumn('to_date', function($row){

                    $t_date = \Carbon\Carbon::createFromFormat('Y-m-d', $row->to_date)->format('d M Y');
                  
                    return $t_date;
                     
                })
                ->rawColumns(['Actions','rebat_day','totalday'])
                ->make(true);
        }


        $messlistst = Messlist::get();

        return view('admin.Student_mess_data.index', compact('messlistst'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
         
        $Slot=Slot::where('to_date','<=',date('m/d/Y'))->where('from_date','>=',date('m/d/Y'))->where('status',1)->first(); 
 
        $userlist=User::get()->sortByDesc("email");
     // if(!empty($Slot)){
        // $olddata=Student_mess_data::where('slot_id','=',$Slot->id)->where('created_by',\Auth::user()->id)->first();
        // if(empty($olddata)){
        $messlist=DB::table('messlist')->get();
         $hostellist=DB::table('hostel_lists')->get();
        //$programlist=DB::table('programs')->get();
        $programlist= DB::table('student_profile')
                 ->select('program')
                 ->groupBy('program')
                 ->get();
        //dd($programlist);
        return view('admin.Student_mess_data.create',compact('messlist','programlist','hostellist','Slot','userlist'));
        //                   
    // }else{
    //    return view('admin.Student_mess_data.overdate');  
    // }

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
        $Slot=Slot::where('to_date','<=',date('m/d/Y'))->where('from_date','>=',date('m/d/Y'))->where('status',1)->first();
       // dd($Slot);
     //if(!empty($Slot)){
        
        $this->validate($request, [			
            'room_no' => 'required',
             'hostel_name' => 'required',
            'program' => 'required',
            'to_date' => 'required',
             'from_date' => 'required',
              'mess_name' => 'required',
              'plan_type'=>'required'

		]);
          if(\Auth::user()->role_id==3){
        $request->request->add(['to_date' => $request->post('to_date')]);
        $request->request->add(['from_date' => $request->post('from_date')]);
           // $request->request->add(['slot_id' => $Slot->id]);
            $request->request->add(['created_by' => \Auth::user()->id]);
     }
     if(\Auth::user()->role_id==1){
         $request->request->add(['to_date' => $request->post('to_date')]);
        $request->request->add(['from_date' => $request->post('from_date')]);
           // $request->request->add(['slot_id' => $Slot->id]);           
           $userdata = User::findOrFail($request->post('created_by'));
            $request->request->add(['student_name' => $userdata->name]);
                            }
        $requestData = $request->all();
        Student_mess_data::create($requestData);

        return redirect('admin/student_mess_data')->with('flash_message', 'student_mess_data added!');
        // }else{
        //     return view('admin.Student_mess_data.overdate');
        // }
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
        $Student_mess_data = Student_mess_data::findOrFail($id);
        //dd($Student_mess_data);

        return view('admin.Student_mess_data.show', compact('Student_mess_data'));
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
        $Student_mess_data = Student_mess_data::findOrFail($id);
$userlist=User::get()->sortByDesc("email");
$messlist=DB::table('messlist')->get();
         $hostellist=DB::table('hostel_lists')->get();
        // $programlist=DB::table('programs')->get();
        $programlist= DB::table('student_profile')
                 ->select('program')
                 ->groupBy('program')
                 ->get();
     
        return view('admin.Student_mess_data.edit', compact('Student_mess_data','userlist','messlist','hostellist','programlist'));
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
        
        $Student_mess_data = Student_mess_data::findOrFail($id);
        $Student_mess_data->update($requestData);

        return redirect('admin/student_mess_data')->with('flash_message', 'Student_mess_data updated!');
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
        //dd($id);
        //Student_mess_data::destroy($id);
        $messdata = Student_mess_data::find($id);
        $messdata->delete();

        return redirect('admin/student_mess_data')->with('flash_message', 'Student_mess_data deleted!');
    }
}
