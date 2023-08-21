<?php

namespace App\Http\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Notification;
use App\FeeStudent;
Use Redirect;
use PaytmWallet;
Use PDFMerger;
Use Imagick;
use File;
use Log;
use App\Rebate;
use App\Attendance;
use Illuminate\Support\Facades\Crypt;
use App\StudentTotalFee;
// use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Feestructure;
use App\Courseregiration;
use PDF;
use App;
//require 'vendor/autoload.php';
class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
      $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

   
    public function index() {
      //dd(auth()->user()->email);
      return view('dashboard.v2');
  
    }


//REmission Work ============================

public function saveremissiondata(Request $request){
    //dd($request);
  //  use App\StudentTotalFee;
     if ($request->hasFile('income_file')) {
  
             $image = $request->file('income_file');         
             $path_image = Storage::putFile(auth()->user()->email, $image);   
             $remission_amount="";
             if($request->post('remissiontype')==="1/3"){
                $remission_amount="66667";
             }
             if($request->post('remissiontype')==="full")
             {
                $remission_amount="100000";
             }
            DB::table('student_total_fees')->where('id', $request->post('id'))->update(['income_file' =>$path_image,'parentalincome' =>$request->post('parentalincome'),'remission' =>$request->post('remission'),'remissiontype' =>$request->post('remissiontype'),'remission_amount'=>$remission_amount]);
             return redirect('feepay')->with('flash_message', 'Your Fee Remission has been submit');
          }

}

    public function importnewuser()
    {
         $studentprofilelist = DB::table('new_autumn_2021')->where('batch_year','2023')->get();
foreach( $studentprofilelist as $val){
        $userdata= DB::table('users')->where('email',$val->email)->first();
         if(empty($userdata)){
                   $user = new User;
                    $user->name = $val->name;
                    $user->email = $val->email;
                    $user->role_id=3;            
                    $user->password = bcrypt('admin123!@#');                  
                    $user->save();
                    echo $val->rollno.'<br>';
                }
            }
    }


//======================ELECTIVE COURSE WORK  ==================


      public function electivelist(){
           $electivelist= DB::table('electivecourse')->where('acadyear','2021')->where('acadsem','1')->get();

         return view('courselist',compact('electivelist'));
       }

 public function addelectivelist(){
    $courselist= DB::table('courselist')->orderBy('crsecode')->get();
     return view('electiveform',compact('courselist'));
 }
  public function saveelectivelist(Request $request){ 
    
     DB::insert('insert into electivecourse (year,crsecode,acadyear,acadsem,type)
                        values (?,?,?,?,?)', [$request->post('year'),$request->post('crsecode'),$request->post('acadyear'),$request->post('acadsem'),$request->post('programtype')]);
     return redirect('electivelist')->with('flash_message', 'This Student Password Updated');
 }

public function deletecouse($id){
    
     DB::table('electivecourse')->where('id', $id)->delete();
    
     return redirect('electivelist')->with('flash_message', 'This Course Deleted');
 }
 public function newstudentregistration(){
    $departmentlist= DB::table('department')->orderBy('deptname')->get();
//$castlist= DB::table('new_autumn_2021')->groupBy('caste')->get();
$castlist= DB::table('new_autumn_2021')
                 ->select('caste as caste')
                 ->groupBy('caste')
                 ->get();
    return view('newstudentform',compact('departmentlist','castlist'));

 }
 public function savestudentdata(Request $request){
$newpass='';
 DB::insert('insert into new_autumn_2021 (rollno,name,prog,dept,father_name,caste,p_email,email
    ,contact,permanent_address,permanent_state,
    permanent_pincode,permanent_city,
    correspondence_address,
    correspondence_city,
    correspondence_state,
    correspondence_pincode,
    qexam,
    spec,gender,funding,batch_year)
                        values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$request->post('rollno'),$request->post('name'),
                        $request->post('prog'),
                        $request->post('dept'),$request->post('father_name'),$request->post('caste'),$request->post('p_email')
                        ,$request->post('email'),
                        $request->post('contact')
                        ,$request->post('email'),
                       '-',
                       '-',
                       '-',
                       '-',
                       '-',
                       '-',
                       '-','GATE',$request->post('spec'),$request->post('gender'),'-','2023']);
  $pass_array=str_split($request->post('contact'));
     for($i=0;$i<count($pass_array);$i++){
        $newpass.=$i.$pass_array[$i];
    }// This loop for password only 
    
$rolmodel=DB::table('login')->where('email',$request->post('rollno'))->first();
//print_r($rolmodel);echo "<br>";
   
    if(!$rolmodel){
       DB::insert('insert into login (email,pass,usertype)
                        values (?,?,?)', [$request->post('rollno'),$newpass,'3']);
          DB::insert('insert into email (rollno,ins_email)
                        values (?,?)', [$request->post('rollno'),$request->post('email')]);
      
           echo 'Saved Record <br>';
}
 }
    //===========================    ============================
      public function newusercreateform(){

         return view('newuserform');
    }


    public function newusercreate(Request $request){

         $pass_array=str_split($request->post('password'));
      $newpass="";
        for($i=0;$i<count($pass_array);$i++){
        $newpass.=$i.$pass_array[$i];
    }
    // This loop for password only 
   // echo $newpass;
  //  dd($request->all());

        DB::insert('insert into login (email,pass,usertype)
                        values (?,?,?)', [$request->post('usename'),$newpass,$request->post('role')]);
          DB::insert('insert into email (rollno,ins_email)
                        values (?,?)', [$request->post('usename'),$request->post('email')]);

    }

     public function copycourseallocation()
    {
         $studentprofilelist = DB::table('course_allocation')->where('acadyear','2023')->where('crsecordi','!=','2')->get();
foreach( $studentprofilelist as $val){
        $userdata= DB::table('currsemfaculty')->where('username',$val->facultyname)->where('acadyear','2023')->where('crsecode',$val->crsecode)->where('crsecordi',$val->crsecordi)->first();
         if(empty($userdata)){

                     DB::insert('insert into currsemfaculty (username,crsecode,crsecordi,acadyear,acadsem)
                        values (?,?,?,?,?)', [$val->facultyname,$val->crsecode,$val->crsecordi,$val->acadyear,$val->acadsem]);
                    echo $val->facultyname.'CRSECODE=>'.$val->crsecode.'<br>';
                }
            }
    }
     public function adminremovecourse($rollno)
    {
        // $studentprofilelist = DB::table('new_autumn_2021')->where('batch_year','2023')->get();
             DB::table('student_curr_course')->where('acadyear','2023')->where('rollno', $rollno)->delete();
             echo "Record has been removed";
     }

    //==============================Statrt Fee Allocation Work ================================
    public function courseregistration(){
         $studentprofile = DB::table('new_autumn_2021')->where('email',auth()->user()->email)->first();
          $coursemodel=DB::table('student_curr_course')->where('rollno', $studentprofile->rollno)->first();
          if(empty($coursemodel)){
         if($studentprofile->prog!='M.Tech.')
        $courseregiration = Courseregiration::where('department',$studentprofile->dept)->where('program',$studentprofile->prog)->first();
    else
        $courseregiration = Courseregiration::where('department',$studentprofile->spec)->where('program',$studentprofile->prog)->first();

 $electivecourselist= DB::table('electivecourse')
                 ->where('acadyear','2021')->where('acadsem','1')            
                 ->get();
              //   dd($courseregiration);

   return view('courseregitration',compact('courseregiration','studentprofile','electivecourselist'));
}
    }


public function courseregirationsave(Request $request)
{
   
//print_r($request->input('coursecode'));electivecourse
   // echo count($request->input('electivecourse'));
   //  print_r($request->input('electivecourse'));
    // exit;
   $studentprofile = DB::table('new_autumn_2021')->where('email',auth()->user()->email)->first();
for($i=0;$i<count($request->input('coursecode'));$i++){
     $rolmodel=DB::table('student_curr_course')->where('rollno', $studentprofile->rollno)->where('crsecode', $request->input('coursecode')[$i])->first();
      if(empty($rolmodel)){
         DB::insert('insert into student_curr_course (rollno,acadyear,acadsem,crsecode,minor,pref,date1)
                          values (?, ?, ?, ?, ?, ?,?)', [$studentprofile->rollno,'2023','1',$request->input('coursecode')[$i],'0','0',date("d-m-Y")]);
      }
}
//print_r($request->input('coreelective'));
if(!empty($request->input('coreelective'))){
for($i=0;$i<count($request->input('coreelective'));$i++){
     $rolmodelelec=DB::table('student_curr_course')->where('rollno', $studentprofile->rollno)->where('crsecode', $request->input('coreelective')[$i])->first();
      if(empty($rolmodelelec)){
         DB::insert('insert into student_curr_course (rollno,acadyear,acadsem,crsecode,minor,pref,date1)
                          values (?, ?, ?, ?, ?, ?,?)', [$studentprofile->rollno,'2023','1',$request->input('coreelective')[$i],'0','0',date("d-m-Y")]);
      }
}
}
//OPen Elective Work 

    if(!empty($request->input('electivecourse'))){  
for($i=0;$i<count($request->input('electivecourse'));$i++){
     $rolmodelopen=DB::table('student_curr_course')->where('rollno', $studentprofile->rollno)->where('crsecode', $request->input('electivecourse')[$i])->first();
      if(empty($rolmodelopen)){

      $departmentmodel= DB::table('department')->where('deptname', $studentprofile->dept)->first();
      $coursecodinator= DB::table('currsemfaculty')->where('crsecode',$request->input('electivecourse')[$i])->where('acadyear','2023')->where('crsecordi','1')->first();
if(!empty($coursecodinator)){
  DB::table('student_curr_course')->where('rollno', $studentprofile->rollno)->where('crsecode', $request->input('electivecourse')[$i])->first();
$faculty_profile= DB::table('faculty_profile')->where('username',$coursecodinator->username)->first();
if($studentprofile->prog=="B.Tech.")
{
    $dpgc_dugc=  $departmentmodel->dugc;

}else
    {
       $dpgc_dugc=  $departmentmodel->arol_dpgc;
    }
         DB::insert('insert into student_curr_course (rollno,acadyear,acadsem,crsecode,minor,pref,date1,coordinator,dpgc_dugc)
                          values (?, ?, ?, ?, ?, ?,?,?,?)', [$studentprofile->rollno,'2023','1',$request->input('electivecourse')[$i],'0','0',date("d-m-Y"),$faculty_profile->name,$dpgc_dugc,]);
    }
      }
}}
          //==========END Open Elective Work 

         // dd($request);
    return Redirect::to('https://academic.iiti.ac.in:8443/courseList_first.jsp');

}
//=================================Course Allocation work =======================================

    public function feepay(){
      $rolmodel=DB::table('users')->where('email',auth()->user()->email)->first();
      if(!empty($rolmodel)){
        $studentprofile = DB::table('new_autumn_2021')->where('email',auth()->user()->email)->first();
        $studentdata=StudentTotalFee::where('rollno',$studentprofile->rollno)->get();
        return view('paymentlist',compact('studentdata'));
      }
    }
public function feedetails(Request $request){
  $idkey=  $request->input('idkey');
  $id = decrypt($idkey);
  $rolmodel=DB::table('users')->where('email',auth()->user()->email)->first();
  
  if(!empty($rolmodel)){
    $studentprofile = DB::table('new_autumn_2021')->where('email',auth()->user()->email)->first();
    $studentdata=StudentTotalFee::where('rollno',$studentprofile->rollno)->where('id',$id)->first();
    
    if(!empty($studentdata)){
      $dataAll=  FeeStudent::where('rollno', '=',$studentdata->rollno)
      ->where('academic_tearm', '=',$studentdata->academic_tearm)
      ->where('academic_year', '=',$studentdata->academic_year)
      ->get();
      //$studentprofile=DB::table('student_profile')->where('rollno',$rolmodel->rollno)->first();
      $feestructure = Feestructure::findOrFail($studentdata->feestructure_id);  
      //dd($feestructure); 
      return view('feedetails',compact('studentdata','rolmodel','studentprofile','dataAll','feestructure'));
    }
  }
  return back()->with('danger', 'Invalid request.');

}

// PAYTM DETAILS WORK ============================
public function feedetailspaytm(Request $request){
   $idkey=  $request->input('idkey');
    $id = decrypt($idkey);
    $rolmodel=DB::table('email')->where('ins_email',auth()->user()->email)->first();
// print_r($rolmodel);exit;
if(!empty($rolmodel)){
     $studentdata='';
     $studentdata=StudentTotalFee::where('rollno',$rolmodel->rollno)->where('id',$id)->first();
       if(!empty($studentdata)){
        $dataAll=  FeeStudent::where('rollno', '=',$studentdata->rollno)
     ->where('academic_tearm', '=',$studentdata->academic_tearm)
      ->where('academic_year', '=',$studentdata->academic_year)->where('type', '=',1)
    ->get();
        $studentprofile=DB::table('new_autumn_2021')->where('rollno',$rolmodel->rollno)->first();   
        return view('paydetailspaytm',compact('studentdata','rolmodel','studentprofile','dataAll'));
       }
 }

}
public function payment($idkey){
  $id = decrypt($idkey);
  $rolmodel=DB::table('users')->where('email',auth()->user()->email)->first();
  if(!empty($rolmodel)){
      $studentprofile = DB::table('new_autumn_2021')->where('email',auth()->user()->email)->first();
      $studentdata=StudentTotalFee::where('rollno',$studentprofile->rollno)->where('id',$id)->first();
      if(!empty($studentdata)){
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $val = StudentTotalFee::where('id',$id)->update(['reference_no'=>$txnid]);
        //$studentprofile=DB::table('student_profile')->where('rollno',$rolmodel->rollno)->first();
        //dd($val);
        $feestructure = Feestructure::findOrFail($studentdata->feestructure_id); 
        return view('pay-with-Payumoney',compact('studentdata','rolmodel','studentprofile','txnid','feestructure'));
      }
  }
}

public function paymentpartial($idkey){
// $pass=$request->input('id');
     $id = decrypt($idkey);
  $rolmodel=DB::table('email')->where('ins_email',auth()->user()->email)->first();

if(!empty($rolmodel)){
     $studentdata='';
     $studentdata=StudentTotalFee::where('rollno',$rolmodel->rollno)->where('id',$id)->first();
     if(!empty($studentdata)){
         $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        StudentTotalFee::where('id',$id)->update(['reference_no'=>$txnid]);
        $studentprofile=DB::table('new_autumn_2021')->where('rollno',$rolmodel->rollno)->first();
    // $studentdata=StudentTotalFee::where('rollno',$rolmodel->rollno)->where('id',$id)->get();
     // $txnid="sss";
        // print($studentdata);
        // print_r($studentprofile);
        // exit;
     return view('pay-with-Payumoney',compact('studentdata','rolmodel','studentprofile','txnid'));
 }
 }
}

public function subscribecancel(Request $request){
    //print_r($request->all());exit;
    return redirect('/feepay');

}
public function paymentpaytm($id){
     $idkey=  $id;
    $id = decrypt($idkey);
    //dd($id);
    $rolmodel=DB::table('email')->where('ins_email',auth()->user()->email)->first();
   // dd($rolmodel);
if(!empty($rolmodel)){
     $studentdata='';
     $studentdata=StudentTotalFee::where('rollno',$rolmodel->rollno)->where('id',$id)->first();
       if(!empty($studentdata)){
        $dataAll=  FeeStudent::where('rollno', '=',$studentdata->rollno)
     ->where('academic_tearm', '=',$studentdata->academic_tearm)
      ->where('academic_year', '=',$studentdata->academic_year)->where('type', '=',1)
    ->get();
        $studentprofile=DB::table('new_autumn_2021')->where('rollno',$rolmodel->rollno)->first();   
}}
//if(!empty($studentdata)){
  // if(count($requrimentmodel)){
        $input['order_id'] = $studentdata->reference_no;//contact_no.rand(1,100);
        $input['fee'] = 100;
        // EventRegistration::create($input);
 Log::debug('send data Paytm paymant getway',[

          'order' => $input['order_id'],
          'user' => $studentprofile->name,
          'mobile_number' => '7999406796',
          'email' => auth()->user()->email,
          'amount' => $input['fee'],
          'callback_url' => url('api/payment/status')
        ]);
        $payment = PaytmWallet::with('receive');
        $payment->prepare([
          'order' => $input['order_id'],
          'user' => $usermodel->contact_no,
          'mobile_number' => $usermodel->contact_no,
          'email' => auth()->user()->email,
          'amount' => $input['fee'],
          'callback_url' => url('api/payment/status')
        ]);
        return $payment->receive();
    //}
    
//}
}


public function previewpdf(){


  $rolmodel=DB::table('users')->where('email',auth()->user()->email)->first();

  $studentprofile=DB::table('new_autumn_2021')->where('email',$rolmodel->email)->first();

  //dd($studentprofile);

  // $studentdata=StudentTotalFee::where('rollno',$rolmodel->rollno)->where('id',$id)->first();

  // $studentprofile=DB::table('student_profile')->where('rollno',$rolmodel->rollno)->first();

  $totalamount=StudentTotalFee::where('rollno',$studentprofile->rollno)->first();

  $filename=$totalamount->reference_no.'.pdf'; 

  //dd($totalamount);
 
  $studentamount=FeeStudent::where('rollno',$totalamount->rollno)
  ->where('academic_year',$totalamount->academic_year)->where('academic_tearm',$totalamount->academic_tearm)->get();
  $amount="";
   if($totalamount->remission_amount!=''){
$amount=$totalamount->totalamount-$totalamount->remission_amount;
}else{
$amount=$totalamount->totalamount;
}

  $word = $this->numberToWord($amount);




  $pdf = App::make('dompdf.wrapper');     
  $pdf->loadHTML(view('receiptpdf', compact('studentamount','totalamount','studentprofile','word')));

  
 
  //$pdf->save(storage_path().'_filename.pdf');
  file_put_contents('public/uploads/'.$filename, $pdf->output()); 

  

  return view('receiptpdf', compact('studentamount','totalamount','studentprofile','word'));

}



public function previewpdfdemo(){


   $rolmodel=DB::table('users')->where('email','mems230005049@iiti.ac.in')->first();

  $studentprofile=DB::table('new_autumn_2021')->where('email',$rolmodel->email)->first();

  //dd($studentprofile);

  // $studentdata=StudentTotalFee::where('rollno',$rolmodel->rollno)->where('id',$id)->first();

  // $studentprofile=DB::table('student_profile')->where('rollno',$rolmodel->rollno)->first();

  $totalamount=StudentTotalFee::where('rollno',$studentprofile->rollno)->first();

  $filename=$totalamount->reference_no.'.pdf'; 

  //dd($totalamount);
 
  $studentamount=FeeStudent::where('rollno',$totalamount->rollno)
  ->where('academic_year',$totalamount->academic_year)->where('academic_tearm',$totalamount->academic_tearm)->get();
  $amount="";
   if($totalamount->remission_amount!=''){
$amount=$totalamount->totalamount-$totalamount->remission_amount;
}else{
$amount=$totalamount->totalamount;
}

  $word = $this->numberToWord($amount);




  $pdf = App::make('dompdf.wrapper');     
  $pdf->loadHTML(view('receiptpdf', compact('studentamount','totalamount','studentprofile','word')));
 file_put_contents('public/uploads/'.$filename, $pdf->output());
  return $pdf->stream();
 
  //$pdf->save(storage_path().'_filename.pdf');
  

  

  return view('receiptpdf', compact('studentamount','totalamount','studentprofile','word'));

}

public function numberToWord($num = '')
    {
        $num    = ( string ) ( ( int ) $num );
        
        if( ( int ) ( $num ) && ctype_digit( $num ) )
        {
            $words  = array( );
             
            $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );
             
            $list1  = array('','one','two','three','four','five','six','seven',
                'eight','nine','ten','eleven','twelve','thirteen','fourteen',
                'fifteen','sixteen','seventeen','eighteen','nineteen');
             
            $list2  = array('','ten','twenty','thirty','forty','fifty','sixty',
                'seventy','eighty','ninety','hundred');
             
            $list3  = array('','thousand','million','billion','trillion',
                'quadrillion','quintillion','sextillion','septillion',
                'octillion','nonillion','decillion','undecillion',
                'duodecillion','tredecillion','quattuordecillion',
                'quindecillion','sexdecillion','septendecillion',
                'octodecillion','novemdecillion','vigintillion');
             
            $num_length = strlen( $num );
            $levels = ( int ) ( ( $num_length + 2 ) / 3 );
            $max_length = $levels * 3;
            $num    = substr( '00'.$num , -$max_length );
            $num_levels = str_split( $num , 3 );
             
            foreach( $num_levels as $num_part )
            {
                $levels--;
                $hundreds   = ( int ) ( $num_part / 100 );
                $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
                $tens       = ( int ) ( $num_part % 100 );
                $singles    = '';
                 
                if( $tens < 20 ) { $tens = ( $tens ? ' ' . $list1[$tens] . ' ' : '' ); } else { $tens = ( int ) ( $tens / 10 ); $tens = ' ' . $list2[$tens] . ' '; $singles = ( int ) ( $num_part % 10 ); $singles = ' ' . $list1[$singles] . ' '; } $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' ); } $commas = count( $words ); if( $commas > 1 )
            {
                $commas = $commas - 1;
            }
             
            $words  = implode( ', ' , $words );
             
            $words  = trim( str_replace( ' ,' , ',' , ucwords( $words ) )  , ', ' );
            if( $commas )
            {
                $words  = str_replace( ',' , ' and' , $words );
            }
             
            return $words;
        }
        else if( ! ( ( int ) $num ) )
        {
            return 'Zero';
        }
        return '';
    }

    public function todayattendances(){
      $attendances = Attendance::where('mess_name', '=', auth()->user()->name)->where('attan_date', '=', date("m/d/Y"))
                   ->latest()->get();//->paginate($perPage);
   
   return view('todayattendances',compact('attendances'));
   }
   
   public function todayrebate(){
     $listrebate=Rebate::where('to_date','<=',date('m/d/Y'))->where('from_date','>=',date('m/d/Y'))->where('status',1)->where('mess_name',auth()->user()->name)->get();
     return view('todayrebate',compact('listrebate'));
   }


public function bhranchange(){
    
}



   

}