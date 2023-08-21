<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Feedback_allocation;
use Illuminate\Http\Request;
use App\User;
class Feedback_allocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 200;

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
            $feedback_allocation = Feedback_allocation::latest()->orderBy('dept', 'ASC')->paginate($perPage);
        }

        return view('admin.feedback_allocation.index', compact('feedback_allocation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */

public function password(){

    //echo'ss';exit;
    $pass="abcdef";
    $newpass="";
    $pass_array=str_split($pass);
    for($i=0;$i<count($pass_array);$i++){
        $newpass.=$i.$pass_array[$i];
    }
   // echo $newpass;exit;
     return view('admin.feedback_allocation.password');
    
}
 
 public function passwordsave(Request $request){
//DB::enableQueryLog();


$pass=$request->input('pass');
    $newpass="";
    $pass_array=str_split($pass);
    for($i=0;$i<count($pass_array);$i++){
        $newpass.=$i.$pass_array[$i];
    }
    
$rolmodel=DB::table('login')->where('email',$request->input('rollno'))->first();
    //dd($rolmodel);
    if(!$rolmodel){
        DB::insert('insert into login (email,pass,usertype)
                         values (?,?,?)', [$request->input('rollno'),$newpass,'3']);
        return redirect('admin/password')->with('flash_message', 'This Student Password Updated');
}else{
$affected = DB::table('login')
              ->where('email', $request->input('rollno'))
              ->update(['pass' => $newpass]);
            //  dd(DB::getQueryLog());
//exit;
              return redirect('admin/password')->with('flash_message', 'This Student Password Updated');
     // DB::insert('insert into nodues (rollno, name,program,dept,acadyear,acadsem)
     //                     values (?, ?, ?, ?, ?, ?)', [$request->input('rollno'),NULL,NULL,NULL,$request->input('acadyear'),$request->input('acadsem')]);
 }
     
    //echo'ss';exit;
    // return view('admin.feedback_allocation.password');
}
    public function sendmailcandidate(){

//         $model=DB::table('phd_newregnew')->where('refno','100000')->get();
//         $j=2;
//         foreach($model as $val){
//            // if($val->altemail=='ambardixit@gmail.com'){
//                 //print_r($val);
//                 $val->refno=$val->refno+$j;
//                              DB::table('phd_newregnew')->where('altemail', $val->altemail)->update(array(
//                                  'refno'=>$val->refno,
// ));
//                // User::sendmailtemp('candidatemail', 'IIT INDORE Application for Ph.D', $val->altemail, $val); 
   
//             //}
// $j++;
//         }
      //  dd($model);
    }
    public function create()
    {
            $moduleadmin = DB::table('admin_course_allocation')->get();//Admin_course_alloca::get();
            $faculty_profile =DB::table('faculty_profile')->get();//Faculty_profile::get();
            //SQL Print =======================
          //  "SELECT *FROM login.course_allocation left outer join login.courselist on login.course_allocation.crsecode=login.courselist.crsecode  where course_allocation.acadyear='2020'and course_allocation.acadsem='2' and courselist.type='T';"

//             $insertdata2= DB::table('course_allocation')
//             ->leftJoin('courselist', 'course_allocation.crsecode', '=', 'courselist.crsecode')->select('course_allocation.crsecode','course_allocation.dept','course_allocation.facultyname')->where('course_allocation.acadyear','2020')->whereNotIn('course_allocation.crsecode', ['PH 105','PH 106','CH 103','PH 798','ME 798'])->where('course_allocation.acadsem','2')->where('courselist.type','T')->where('course_allocation.facultyname','!=','To be assigned later')
//             ->get();
//              $insertdata=$insertdata2->unique();
//              foreach($insertdata as $val){
//                 echo $val->facultyname;
//                 echo $val->crsecode;
//                 echo $val->dept;
// $course_allocation = DB::table('feedback_allocation')
//              ->select("*")
//              ->where('crsecode', $val->crsecode)->where('facultyname', $val->facultyname)->where('acadsem', '2')->where('acadyear', '2020')
//              ->first();
//              if(!$course_allocation){
//                 $model = new Feedback_allocation();
//                 $model->facultyname=$val->facultyname;
//                 $model->dept=$val->dept;
//                 $model->crsecode=$val->crsecode;
//                  $model->acadsem=2;
//                  $model->acadyear=2020;
//                  $model->save();
//                //
//                     //==============Insert SQL ============================================== 
//   DB::insert('insert into feedback_allocation (acadyear, facultyname,acadsem,crsetype,crsecordi,dept,program,lock,crsecode)
//                         values (?, ?, ?, ?, ?, ?, ?, ?, ?)', ['2020',$val->facultyname,'2',0,0 ,$val->dept,NULL,0,$val->crsecode]); 
             // }else{
             //    // echo "no record found<br>";
             //    // print_r($course_allocation);
             // }
           
            // }
             //exit;
           // dd($insertdata);
            //SQL END =========================

    //  dd($moduleadmin);
            //  $department = DB::table('department')->get();
        return view('admin.feedback_allocation.create',compact('moduleadmin','faculty_profile'));
    }
      public function noduesactivation()
    {
     //   dd('sss');
         
        return view('admin.feedback_allocation.noduesactivation');
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
        
        $requestData = $request->all();
        DB::insert('insert into feedback_allocation (acadyear, facultyname,acadsem,crsetype,crsecordi,dept,program,lock,crsecode)
                         values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$request->input('acadyear'), $request->input('facultyname'),$request->input('acadsem'),0,0 ,$request->input('dept'),NULL,0,$request->input('crsecode')]);
        Feedback_allocation::create($requestData);

        return redirect('admin/feedback_allocation')->with('flash_message', 'Feedback_allocation added!');
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

        return view('admin.feedback_allocation.show', compact('feedback_allocation'));
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
        return view('admin.feedback_allocation.edit', compact('feedback_allocation','faculty_profile','moduleadmin','department'));
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

        return redirect('admin/feedback_allocation')->with('flash_message', 'Feedback_allocation updated!');
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
             $feedback_allocation = Feedback_allocation::findOrFail($id);
                // DB::insert('insert into feedback_allocation (acadyear, facultyname,acadsem,crsetype,crsecordi,dept,program,lock,crsecode)
                //          values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$request->input('acadyear'), $request->input('facultyname'),$request->input('acadsem'),0,0 ,$request->input('dept'),NULL,0,$request->input('crsecode')]);
             DB::table('feedback_allocation')->where('facultyname', $feedback_allocation->facultyname)->where('acadyear', $feedback_allocation->acadyear)->where('crsecode', $feedback_allocation->crsecode)->where('acadsem', $feedback_allocation->acadsem)->delete();
        Feedback_allocation::destroy($id);

        return redirect('admin/feedback_allocation')->with('flash_message', 'Feedback_allocation deleted!');
    }
}
