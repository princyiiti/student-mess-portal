<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\NewAutumn2021;
use App\Rebate;
use App\StudnetCurrentSubcription;
use Carbon\Carbon;
use Redirect;
//use Excel;
class UsersController extends Controller
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
            $user = User::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")            
                ->latest()->paginate($perPage);
        } else {
            $user = User::latest()->paginate($perPage);
        }
        if (User::isAdminL()||User::isMMSUser()) {
         
      
       // $designations =  DB::table('designations')->orderBy("title")->get();
        return view('admin.users.index', compact('user'));
    }
    }
    public function updateajax(Request $request){
          if (User::isAdminL()||User::isMMSUser()) {
            $requestData = $request->all();
            if( !empty($request->role_id)){
            DB::table('users')
            ->where('id',$request->id)
            ->update(['role_id' =>$request->role_id]);      
            }elseif(!empty($request->designation_id)){
                DB::table('users')
                ->where('id',$request->id)
                ->update(['designation_id' =>$request->designation_id]);   
            }
            else{
             DB::table('users')
            ->where('id',$request->id)
            ->update(['department_id' =>$request->department_id]);    
            }
        $response = array(
            'status' => 'success',
            'msg' => $request->id,
        );
        return response()->json($response); 
    }
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $modal =new User();
        $department =  DB::table('departments')->orderBy("name")->get();
        $designations =  DB::table('designations')->orderBy("title")->get();
        return view('admin.users.create', compact('department','designations','modal'));
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param \Illuminate\Http\Request $request
    //  *
    //  * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    //  */
    public function add(Request $request)
    {
       // dd( $request->all());
                $validatedData = $request->validate([
    'email' => ['required', 'unique:users', 'max:255'],
    'name' => ['required'],
]);
       $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
       $pin = mt_rand(10000, 999999999). mt_rand(100000, 999999999). $characters[rand(0, strlen($characters) - 1)];  
       $request->request->add(['password' =>md5($pin)]); //add request
       $request->request->add(['role_id' =>3]); //add request
      // print_r($request->all());exit;
        $requestData = $request->all();
     
        User::create($requestData);

        return redirect('admin/purchase_indent/create')->with('flash_message', 'Indent User added!');
    }


    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  *
    //  * @return \Illuminate\View\View
    //  */
    // public function show($id)
    // {
    //     $brand = Brand::findOrFail($id);

    //     return view('admin.brand.show', compact('brand'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  *
    //  * @return \Illuminate\View\View
    //  */
    public function edit($id)
    {
        $modal = User::findOrFail($id);
        //$department =  DB::table('departments')->orderBy("name")->get();
        
        //$designations =  DB::table('designations')->orderBy("title")->get();
        $department = null;
        $designations = null;
        return view('admin.users.edit', compact('modal','department','designations'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param \Illuminate\Http\Request $request
    //  * @param  int  $id
    //  *
    //  * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    //  */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $brand = User::findOrFail($id);
        $brand->update($requestData);

        return redirect('admin/users')->with('flash_message', 'User updated!');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  *
    //  * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    //  */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect('admin/users')->with('flash_message', 'User deleted!');
    }

    //Import User CSV formate Only 

     public function importcsv(){
        return view('admin.users.importcsv');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'import_file' => 'required'
        ]);
 
        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();
        $allreadydata = [];
        if($data->count()){
            foreach ($data as $key => $value) {
                if($value->email!=''){
                    $model=\App\User::whereEmail($value->email)->first();
                    $model = new \App\User();
                    $model->email = $value->email;
                    $model->name = $value->name;
                    $model->password = Hash::make('admin123!@#');
                    $model->role_id= 3;    
                    $model->remember_token='wFWBV7O8gBsdSmSOdDWTZnoo2Y9UxAT8cZENlADbFwiD1mjVUQWhBQzHe';
                    //$model->email_verified_at='2023-02-02 17:21:53';    
                    $model->save();
                }
                
                $Newstudentdata = NewAutumn2021::where('rollno', $value->rollno)->first();
                //$allreadydata.push($Newstudentdata->roll);

                $arr[] = [
                    'rollno' => $value->rollno, 
                    'name' => $value->name,
                    'prog'=>$value->prog,
                    'dept'=>$value->dept,
                    'father_name'=>$value->father_name,
                    'caste'=>$value->caste,
                    'p_email'=>$value->p_email,
                    'email'=>$value->email,
                    'contact'=>$value->contact,
                    'permanent_address'=>$value->permanent_address,
                    'permanent_state'=>$value->permanent_state,
                    'qexam'=>$value->qexam,
                    'spec'=>$value->spec,
                    'gender'=>$value->gender,
                    'funding'=>$value->funding,
                    'batch_year'=>$value->batch_year,
                ];
            }
            //if($allreadydata){
                if(!empty($arr)){
                    //NewAutumn2021::insert($arr);
                }
            //}
        }
 
        return back()->with('success', 'Insert Record successfully.');
    }
    public function uploadcsv(Request $request) {

        $request->validate([
            'import_file' => 'required'
        ]);
 
        $path = $request->file('import_file')->getRealPath();
        
        $allowedfileExtension=['csv','xlsx'];
 
        $extension = $request->file('import_file')->getClientOriginalExtension();
 
        $check=in_array($extension,$allowedfileExtension);
 
        if(!$check){
             $messages = array(
                 'repeted' => 'Only xlsx and csv file extenstion are uploaded! please check the file format'
             );
             return back()->withInput()->withErrors($messages);
         }
     
        $data = Excel::load($path)->get();

        //dd($data);
     
        $validator = Validator::make($data->toArray(),[
         '*.email_address' => 'required|email',
         '*.name' => 'required|regex:/^[a-zA-Z ]+$/',
         '*.from_date' => 'required|date',
         '*.to_date' => 'required|date',
         '*.roll_no' => 'required',
         '*.course'=>'required|regex:/^[a-z.0-9 ]+$/i',
         '*.department'=>'required|alpha',
         '*.name_of_hostel' => 'required|alpha',
         '*.unit_number_in_hostel'=>'required|numeric|min:3',
         '*.room_number'=>'required|alpha',
         '*.caterer_name'=>'required|regex:/^[a-zA-Z ]+$/|in:Kanaka Caterer,Gauri Caterer',
         '*.plan_type'=>'required|alpha|in:NHT,HT',
 
        ]);
 
         if($validator->fails()){
             //return back()->response($validator->messages(), 200);
             return Redirect::back()->withErrors($validator);
         }
 
             
         foreach ($data as $key => $value) {
             $email= str_replace( ',', '', $value->email_address);
             $email= preg_replace('/\s+/', '', $value->email_address);
          
               
             if($email!=''){
                 $model=\App\User::whereEmail($email)->first();
                 if(empty($model)){
                     $model = new \App\User();
                     $model->email = $email;
                     $model->name = $value->name;
                     $model->password = Hash::make('admin123!@#');
                     $model->role_id= 3;    
                     $model->remember_token='wFWBV7O8gBsdSmSOdDWTZnoo2Y9UxAT8cZENlADbFwiD1mjVUQWhBQzHe';
                     //$model->email_verified_at='2023-02-02 17:21:53';    
                     $model->save();  
                 }
 
                 $startDate = Carbon::parse($value->from_date);
                 $endDate = Carbon::parse($value->to_date);
                 $formtime=strtotime($value->from_date);
                 $totime=strtotime($value->to_date);
                 $form_month=date("m",$formtime);
                 $to_month = date("m",$totime);
 
                 $monthdifferance = $to_month - $form_month;
                 if($monthdifferance > 1){
                     return redirect('admin/rebate/create')->with('flash_message', 'Invalid Entry');
                 }
 
                 //future rebate data get 
 
                // dd($form_month,$to_month);
 
                 $studentmessdataformmonth = \App\Student_mess_data::where('student_rollno',$value->roll_no)
                 ->where('mess_name',$value->caterer_name)
                 ->where('status',1)
                 ->whereMonth('from_date','=',$form_month)->first();
 
                 $studentmessdatatommonth = \App\Student_mess_data::where('student_rollno',$value->roll_no)
                 ->where('mess_name',$value->caterer_name)
                 ->where('status',1)
                 ->whereMonth('to_date','=',$to_month)->first();
 
                 // if(count($studentmessfee) >= 1){
                 //     $messages = array(
                 //         'repeted' => 'Some Users Record is already exists ! Please Check the Mess Subscription list'
                 //     );
                 //     return back()->withInput()->withErrors($messages);
                 // }
 
                 // end validation code
 
                 if($studentmessdataformmonth == null && $studentmessdatatommonth == null){
 
         
                     $modelstudent = new \App\Student_mess_data();
                     $modelstudent->student_name=$value->name;
                     $modelstudent->hostel_name=$value->name_of_hostel;
                     $modelstudent->student_rollno = $value->roll_no;
                     $modelstudent->room_no=$value->room_number;
                     $modelstudent->program=$value->course;
                     $modelstudent->from_date=$startDate;//'02/01/2023';
                     $modelstudent->to_date=$endDate;//'02/28/2023'; 
                     $modelstudent->status = 1;      
                     $modelstudent->mess_name=$value->caterer_name;
                     $modelstudent->plan_type=$value->plan_type;
                     $modelstudent->created_by=$model->id;
                     $modelstudent->save();
                     $msg="Data upload successfully";
 
                     //one time subcription Allocation 
 
                     $oldStudnetCurrentSubcription = StudnetCurrentSubcription::where('student_email',$value->email_address)->first();
 
                     if($oldStudnetCurrentSubcription == null){
 
                         $val = new \App\StudnetCurrentSubcription();
                         $val->student_name=$value->name;
                         $val->student_email = $value->email_address;
                         $val->student_roll_no=$value->roll_no;
                         $val->plan_type=$value->plan_type;
                         $val->mess_name=$value->caterer_name;
                         $val->start_date=$startDate;
                         $val->end_date=$endDate;
                         $val->subcription_id = $modelstudent->id;
                         $val->status = 1;
                         $val->save();
 
                     }else{
                         $oldStudnetCurrentSubcription->end_date = $value->to_date;
                         $oldStudnetCurrentSubcription->subcription_id = $modelstudent->id;
                         $oldStudnetCurrentSubcription->save();
 
                     }
                     $this->rebate_data_update($model,$value,$modelstudent,$form_month,$to_month);
                 }
 
             }
         }
        return redirect('admin/student_mess_data')->with('flash_message', 'Data upload successfully');
    }
    function rebate_data_update($model,$value,$modelstudent,$form_month,$to_month){
        $rebates_data = Rebate::where('created_by',$model->id)->whereNull('mess_subcription_id')->where('mess_name',$value->caterer_name)->get();
        if($form_month == $to_month){
            if($rebates_data){
                foreach ($rebates_data as $key => $reb) {
                    $rebates_month_data = Rebate::where('id',$reb->id)
                    ->whereMonth('from_date','=',$form_month)
                    ->first();

                    if($rebates_month_data){
                        $rebates_month_data->mess_subcription_id = $modelstudent->id;
                        $rebates_month_data->save();
                    }
                }
            }

        }else{
            if($rebates_data){
                foreach ($rebates_data as $key => $reb) {
                    $rebates_month_data_start = Rebate::where('id',$reb->id)
                    ->whereMonth('from_date','=',$form_month)
                    ->first();

                    $rebates_month_data_end = Rebate::where('id',$reb->id)
                    ->whereMonth('to_date','=',$to_month)
                    ->first();

                    if($rebates_month_data_start){
                        $rebates_month_data_start->mess_subcription_id = $modelstudent->id;
                        $rebates_month_data_start->save();
                    }

                    if($rebates_month_data_end){
                        $rebates_month_data_end->mess_subcription_id = $modelstudent->id;
                        $rebates_month_data_end->save();
                    }
                    
                }
            }
        }        
    }
}