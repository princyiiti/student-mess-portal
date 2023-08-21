<?php

namespace App;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Auth;
use DB;
class User extends Authenticatable
{
    const ADMIN=1;
     const MMSU=2;
     const NormalUser=3;
     const Finance=4;
     const StoreUser=5;

use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','extension','designation_id','department_id','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return $this->hasRole('admin') ? true : false;
    }
      public static function isAdminL()
    {
        return (auth()->user()->role_id==self::ADMIN) ? true : false;
    }
     public static function isFinance()
    {
        return (auth()->user()->role_id==self::Finance) ? true : false;
    }
       public static function isMMSUser()
    {
        return (auth()->user()->role_id==self::MMSU) ? true : false;
    }
       public static function isNormalUser()
    {
        return (auth()->user()->role_id==self::NormalUser) ? true : false;
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function department()
    {
        return $this->belongsTo(department::class, 'department_id');
    }
    public function designation()
    {
        return $this->belongsTo(designation::class, 'designation_id');
    }
    
    public static function countdata($crsecode,$facultyname){
        // if($crsecode=='MA 105(A)'||$crsecode=='MA 105(B)'){
        //     $crsecode='MA 105';
        //         $course_allocationdata=  DB::table('course_allocation')
        //   ->where('crsecode',$crsecode)->where('acadyear','2020')->Where('acadsem','1')->where('facultyname','!=','To be announced later')->where('facultyname','!=','')
        //     ->get();
        // }else{
        // $course_allocationdata=  DB::table('course_allocation')
        //   ->where('crsecode',$crsecode)->where('acadyear','2020')->where('acadsem','9')->where('facultyname','!=','To be announced later')->where('facultyname','!=','')
        //     ->get();
        // }
            $course_allocationdata=  DB::table('faculty_feedback')
          ->where('crsecode',$crsecode)->where('username',$facultyname)->where('acadyear','2022')->where('acadsem','1')->get();       
          return count($course_allocationdata);
    }
    public static function Totalstudent($crsecode,$acadyear,$acadsem,$facultyname){
          $course_allocationdata=  DB::table('student_curr_course')
          ->where('crsecode',$crsecode)->where('acadyear',$acadyear)->where('acadsem',$acadsem)->get();  
         //  $course_allocationdataA=  DB::table('student_curr_course')
        //  ->where('crsecode',$crsecode)->where('acadyear',$acadyear)->Where('acadsem','=','6')->get();  
         //  $course_allocationdataB=  DB::table('student_curr_course')
         // ->where('crsecode',$crsecode)->where('acadyear',$acadyear)->Where('acadsem','=','7')->get();      
          return count($course_allocationdata);//+count($course_allocationdataA)+count($course_allocationdataB);

    }
     public static function viewdata($crsecode){
        // if($crsecode=='MA 105(A)'||$crsecode=='MA 105(B)'){
        //     $crsecode='MA 105';
        //         $course_allocationdata=  DB::table('course_allocation')
        //   ->where('crsecode',$crsecode)->where('acadyear','2020')->Where('acadsem','1')->where('facultyname','!=','To be announced later')->where('facultyname','!=','')
        //     ->get();
        // }else{
        // $course_allocationdata=  DB::table('course_allocation')
        //   ->where('crsecode',$crsecode)->where('acadyear','2020')->where('acadsem','9')->where('facultyname','!=','To be announced later')->where('facultyname','!=','')
        //     ->get();
        // }
          $course_allocationdata=  DB::table('feedback_allocations')->leftJoin('faculty_profile', 'feedback_allocations.facultyname', '=', 'faculty_profile.username')
          ->where('crsecode',$crsecode)->where('acadyear','2022')->where('acadsem','2')->where('facultyname','!=','To be announced later')->where('facultyname','!=','')->where('facultyname','!=','-')
            ->get();
       
          return $course_allocationdata;
    }
    public static function gradepoint($grade){
 $grade_point= DB::table('grades')->where('gradcode',$grade)->first();
 return  $grade_point;

    }
    public static function previousFRcheck($item,$stuval){
for($i=$item->acadyear; $i<= $item->batchyear;$i++){
          
if($item->acadsem==2)
          $studentcourse = DB::table('grades_sub')->where('rollno',$item->rollno)->where('acadyear',$i)->where('acadsem','=',$item->acadsem-1)->where('crsecode','=',$stuval->crsecode)->where('grade','=','FR')->first();
       if(!empty($studentcourse)){
            return 0;
        } 
      else
          $studentcoursetwo = DB::table('grades_sub')->where('rollno',$item->rollno)->where('acadyear',$i)->where('acadsem','=',$item->acadsem)->where('crsecode','=',$stuval->crsecode)->where('grade','=','FR')->first();
        if(!empty($studentcoursetwo)){
            return 0;
        } 

  }
  return $stuval->credit;
    

    }
    public static function trancourse($item){
        
         $transcourse= DB::table('transcript_course')->where('studentid',$item->studentid)->where('acadyear','=',$item->acadyear)->where('acadsem','=',$item->acadsem)->get();
         return $transcourse;
    }


    public static function studentcurrent($item){
        $studentcourse = DB::table('student_curr_course')->where('rollno',$item->rollno)->where('acadyear','=',$item->acadyear)->where('acadsem','=',$item->acadsem)->orderBy('crsecode', 'DESC')->get();
         return $studentcourse;
    }
    public  static function coursename($coursecode){
        // $studentcourse = DB::table('courselist')->where('crsecode',trim($coursecode))->first();
         $studentcourse = DB::table('courselist')->where('crsecode',$coursecode)->first();
         if(!empty($studentcourse))
         return $studentcourse->crsename;
         else
            return "GOLDY";
    }

    public static function gradelist($val){
        $studentcourse = DB::table('grades_sub')->where('rollno',$val->rollno)->whereIN('acadyear',['2021'])->where('acadsem','=',2)->where('grade','=','FR')->get();
       return  $studentcourse;
    }
     public static function checkdata($username,$crsecode){
         //DB::enableQueryLog();
           $dataval=  DB::table('feedback_statuses')
          ->where('subject',$crsecode)->where('facultyname',$username)->Where('email',auth()->user()->email)->get();
          // echo   $dataval->count();
           //dd(DB::getQueryLog());
           if($dataval->count()==1){
               return true;
           }else{
               return false;
           }
        }
    
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static  function sendmailtcompleted($filename,$subject,$sendemail,$model) {


// Load Composer's autoloader
//require 'vendor/autoload.php';
// Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host = "smtp.gmail.com"; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                       
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                
            $mail->Username =  'admission@iiti.ac.in';//"transportbookings@iiti.ac.in";
            $mail->Password ='odbwvwlkwgotuejr';//MAIL_PASSWORD "mniayodupfsnxxxs"; //"vbs@iit#indore";
            $mail->SetFrom( 'admission@iiti.ac.in'); 
            $mail->addAddress($sendemail);               // Name is optional
            $mail->addBCC('rajpoots@iiti.ac.in');
            // Attachments
            $mail->isHTML(true);                                
            $mail->Subject = $subject;
            $mail->Body = view('mailtemplate/'.$filename, ['model' => $model]);       
            $mail->send();        
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
