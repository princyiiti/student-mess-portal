<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Feedback_allocation;
use Illuminate\Http\Request;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
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
        
        //Excel::loadView('folder.file', array('data'))->export('xls');
  $something2='';
    $something='';

    // Excel::create('Laravel Excel', function($excel) use ($something, $something2) {

    //     $excel->sheet('Excel sheet', function($sheet) use ($something, $something2) {
    //         $sheet->loadView('admin.feedback_allocation.excel')->with('something',$something)
    //                                      ->with('something2',$something2);
    //         $sheet->setOrientation('landscape');
    //     });

    // })->export('csv');

        $keyword = $request->get('search');
        $perPage = 800;
 $feedback_allocation='';
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
          $couse_list = DB::table('course_allocation')->where('acadyear','2021')->where('acadsem','1')->get();
//$dd=false;

//     if($dd==true){
//  $model=DB::table('trans_student')->where('program','Ph.D.')->get();
//  foreach($model as $val){
//     $model2 =DB::table('transcript_course')->where('studentid',$val->studentid)->where('acadyear','2020')->where('acadsem','2')->get();
// if(!$model2->isEmpty()){
//     // print_r($model2);
//     DB::table('transcript_course')->where('studentid',$val->studentid)->where('acadyear','2020')->where('acadsem','2')->delete();
// }
   
//  }
// }
//dd('');

       // return view('admin.feedback_allocation.index', compact('feedback_allocation'));
            $couse_listone=$couse_list->unique();
           return view('admin.feedback_allocation.indexcheck', compact('couse_listone'));
    }


      public function create()
    {
            $moduleadmin = DB::table('admin_course_allocation')->get();//Admin_course_alloca::get();
            $faculty_profile =DB::table('faculty_profile')->get();//Faculty_profile::get();
            //SQL Print =======================
          //  "SELECT *FROM login.course_allocation left outer join login.courselist on login.course_allocation.crsecode=login.courselist.crsecode  where course_allocation.acadyear='2020'and course_allocation.acadsem='2' and courselist.type='T';"

            $insertdata2= DB::table('course_allocation')
            ->leftJoin('courselist', 'course_allocation.crsecode', '=', 'courselist.crsecode')->select('course_allocation.crsecode','course_allocation.dept','course_allocation.facultyname')->where('course_allocation.acadyear','2021')->where('course_allocation.acadsem','1')->where('courselist.type','T')->where('course_allocation.facultyname','!=','Will be assigned later')->where('course_allocation.facultyname','!=','To be assigned later')
            ->get();

             $insertdata=$insertdata2->unique();
         
             foreach($insertdata as $val){
               // echo $val->facultyname;
                //echo $val->crsecode;
                //echo $val->dept;
$course_allocation = DB::table('feedback_allocation')
             ->select("*")
             ->where('crsecode', $val->crsecode)->where('facultyname', $val->facultyname)->where('acadsem', '1')->where('acadyear', '2021')
             ->first();
               // dd($course_allocation);
             if(empty($course_allocation)){
           //   echo $val->crsecode;exit;

                $model = new Feedback_allocation();
                $model->facultyname=$val->facultyname;
                $model->dept=$val->dept;
                $model->crsecode=$val->crsecode;
                 $model->acadsem=1;
                 $model->acadyear=2021;
                 $model->save();
// //                //
//                     //==============Insert SQL ============================================== 
   DB::insert('insert into feedback_allocation (acadyear, facultyname,acadsem,crsetype,crsecordi,dept,program,lock,crsecode)
                        values (?, ?, ?, ?, ?, ?, ?, ?, ?)', ['2021',$val->facultyname,'1',0,0 ,$val->dept,NULL,0,$val->crsecode]); 
              }else{
               //  echo "no record found<br>"; exit;
                // print_r($course_allocation);
             }
           
            }
             //exit;
           // dd($insertdata);
            //SQL END =========================

    //  dd($moduleadmin);
              $department = DB::table('department')->get();
        return view('admin.feedback_allocation.create',compact('moduleadmin','faculty_profile','department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    // public function gradecal(){

    //      return view('admin.feedback_allocation.gradecal');
    // }

   //  public function profileupdate(){
   //           $program='MS (Research)';
   //      $batchyear='2021';
   //         $studentprofile = DB::table('student_profile')->where('program',$program)->where('batchyear',$batchyear)->get();
   //         foreach($studentprofile as $val){
   // DB::table('trans_student')
   //           ->where('rollno',$val->rollno)
   //           ->update(['dept' =>$val->specialization]);
   //           echo"update"
   //         }
   //  }


    public function coursereaddd(){

$i=1;
 $studentprofile = DB::table('student_curr_course')->where('crsecode','EE 302')->where('acadyear','2021')->where('acadsem','2')->get();
//dd($studentprofile);
foreach($studentprofile as $val){
    $old = DB::table('student_curr_course')->where('crsecode','EE 304')->where('acadyear','2021')->where('acadsem','2')->where('rollno',$val->rollno)->first();
    if(empty($old)){
        echo $i."==". $val->rollno.'<br>';
        $i++;
                 DB::insert('insert into student_curr_course (rollno,acadyear,acadsem,crsecode,stime)
                          values (?, ?, ?, ?,? )', [$val->rollno,'2021','2','EE 304','Thu Dec 16 17:16:11 IST 2021']);

    }
 
}



    }
    public function gracalform(){
        return view('gradecal');

    }
     public function gradecalculate(Request $request){
    
    

  //  $rollnolist= DB::table('login')->where('usertype',3)->get();
        $rollno='190001064';
         $rollno1=['150001004','150003024'];
          $rollno3='170005038';
        //'190002007' EE
       $program= $request->input('program');//'B.Tech.';
          // $program='MSPh.D.';
        $batchyear=$request->input('batchyear');//'2018';
          echo $acadsem=$request->input('acadsem');//1; echo'<br>';
          echo $acadyear=$request->input('acadyear');//2021;
           $go=0;
           $rollno='160002017';
       //  $studentprofile = DB::table('student_profile')->where('rollno',$rollno)->where('program',$program)->where('batchyear',$batchyear)->get();
       //$studentprofile = DB::table('student_profile')->where('rollno',$rollno)->where('program',$program)->where('batchyear',$batchyear)->get();
     //210115
 //$studentprofile = DB::table('student_profile')->whereIn('rollno',$rollno)->where('program',$program)->where('batchyear',$batchyear)->get();
       $studentprofile = DB::table('student_profile')->where('rollno',$rollno)->where('program',$program)->where('batchyear',$batchyear)->get();

     //  $studentprofile = DB::table('student_profile')->where('program',$program)->where('batchyear',$batchyear)->where('present',"Studying")->get();
    //   echo'<pre>';
//dd($studentprofile);
       // change acasem and acadyear 
       //This section for calculateting previus Record 
    
       if($acadsem==2){
        $acadsem_previous=1;
          $acadyear_previous=$acadyear;
       }else{
         $acadsem_previous=2;
        $acadyear_previous=$acadyear-1;
       }
       foreach($studentprofile as $valstudent){
       // $studentprofile->specialization
       // end section 
        echo 'GOldy=>'.$go++;
       $trans_student= DB::table('trans_student')->where('rollno',$valstudent->rollno)->where('acadsem',$acadsem)->where('acadyear',$acadyear)->first();
      
     
   
     echo "trans_student";
//print_r($trans_student);
 $geted_grad_point=[];
$cousecode_array=[];
$cousetotalcredit_array=[];
$cousecode_array=[];
$cousename_array=[];
$cousetype_array=[];
$cousestate_array=[];
$semcredits=0;
$semgradepts=0;   
$totcredits=0;
//Minor and addetional var declear 
$mtotcredits=0;
$mtotgradepts=0;$mcpi=0;
//=================
         $totgradepts=0;
         $cpi=0.0;
         $spi=0; 
         $total_grade_pointM=0;
         $semcreditsM=0;
         $semgradeptsM=0;
         $totcreditsM=0;
         $totgradeptsM=0;
         $totgradeptsA=0;
         $total_grade_pointA=0;
         $semcreditsA=0;
         $semgradeptsA=0;
         $totcreditsA=0;
         $geted_grad_point_m=[];
         $cousetotalcredit_array_m=[];
         $cousetype_array_m=[];
         $cousecode_array_m=[];
         $cousestate_array_m=[];
          $mcpi=0;
            $acpi=0;
            $mspi=0;
            $aspi=0;
         //=======================  
          //=======================  
             $total_grade_point_FR=0;
           $semcredits_FR=0;
           $semcredits_FR_array=[];
           $semcredits_FR_coursecode=[];
            $semgradepts_FR=0;
          //=======================  
       
        $rollnolist= DB::table('grades_sub')->where('rollno',$valstudent->rollno)->where('acadsem',$acadsem)->where('acadyear',$acadyear)->get();
        foreach($rollnolist as $val){
         
          //  echo $val->grade;
          //DB::connection()->enableQueryLog();
          //echo $val->crsecode;
            $minoracheck= DB::table('student_curr_course')->where('rollno',$valstudent->rollno)->where('minor','M')->where('crsecode',$val->crsecode)->where('acadsem',$acadsem)->where('acadyear',$acadyear)->first();
// print_r(DB::getQueryLog());
//========================Minor check Couser condition ================
               if(empty($minoracheck)){

                $addtioncheck= DB::table('student_curr_course')->where('rollno',$valstudent->rollno)->where('minor','A')->where('crsecode',$val->crsecode)->where('acadsem',$acadsem)->where('acadyear',$acadyear)->first();
                //====================== Addetional Learing Couser condition  ==================
                if(empty($addtioncheck)){
//DB::connection()->enableQueryLog();
             $rollnolistFR= DB::table('grades_sub')->where('rollno',$valstudent->rollno)->where('grade','=','FR')->where('crsecode','=',$val->crsecode)->where('acadsem','=',$acadsem_previous)->where('acadyear','=',$acadyear_previous)->first();
                 //  print_r(DB::getQueryLog());
                  // echo '<br>';
                    // $rollnolistFR= DB::table('grades_sub')->where('rollno',$valstudent->rollno)->where('grade','=','FR')->where('crsecode',$val->crsecode)->first();
             //===========FR==================
                      $grade_point= DB::table('grades')->where('gradcode',$val->grade)->first();
          $coursedetails= DB::table('courselist')->where('crsecode',$val->crsecode)->first();
              if(empty($rollnolistFR)){
                     $total_grade_point=$coursedetails->totcred*$grade_point->gradpoint;
                  $semcredits= $coursedetails->totcred+$semcredits;
                     $semgradepts=$total_grade_point+$semgradepts;
                     $coursedetails->totcred.'<br>';
                      $semcredits.'<br>';
               }else{
              //   echo $val->crsecode;
                if($val->grade!='FR'){
                  $total_grade_point=$coursedetails->totcred*$grade_point->gradpoint;
                  $semcredits= $coursedetails->totcred+$semcredits;
                   echo  $semgradepts=$total_grade_point+$semgradepts;
                    echo $coursedetails->totcred.'<br>';
                }
                $rollnolistFRNOT= DB::table('grades_sub')->where('rollno',$valstudent->rollno)->where('grade','!=','FR')->where('crsecode',$val->crsecode)->where('acadsem',$acadsem)->where('acadyear',$acadyear)->first();
                if(empty( $rollnolistFRNOT)){
                          $total_grade_point=$coursedetails->totcred*$grade_point->gradpoint;
                        $semgradepts=$total_grade_point+$semgradepts;
                }
              }
         
           
        
         
           // Grade Earn by Student 
       
            $geted_grad_point[]=$val->grade;
            // Grade Total Registed Geade Point in the course 
              $cousetotalcredit_array[]=$coursedetails->totcred;
              //Course Name 
              $cousename_array[]=$coursedetails->crsename;
               $cousetype_array[]=$coursedetails->type;
               if($val->crsecode=='MA 106(A)'||$val->crsecode=='MA 106(B)'){
                $val->crsecode='MA 106';
               }
                if($val->crsecode=='MA 105(A)'||$val->crsecode=='MA 105(B)'){
                $val->crsecode='MA 105';
               }
              $cousecode_array[]=$val->crsecode;
                if($val->grade!="FR"){
            $cousestate_array[]="P";
           }else{
            $cousestate_array[]="F";
           }
    //=========================================================================
       //=========================== sem semeter calculate FR add===================
           //===========================================================
             for($i=$acadyear-1;$i>$acadyear-8;$i--){
   //     echo $i;
      //  echo'=>GOOOOOO<br>';
    $rollnolistFR_current= DB::table('grades_sub')->select('grades_sub.crsecode','grades_sub.grade','grades_sub.acadyear','grades_sub.acadsem')->whereIn('grade', array('XX', 'FR'))->where('rollno',$valstudent->rollno)->where('acadyear',$i)->where('crsecode',$val->crsecode)->get()->toArray();
        //$arrayF[]=(array)$rollnolistFR_current;
       // $rollnolistFR_current  = collect( $rollnolistFR_current )->unique();
       // print_r($val->crsecode.'COUNT=>'.count($rollnolistFR_current).'<br>');
             //===========FR current samater work ==================
             if(!empty($rollnolistFR_current)){

              foreach($rollnolistFR_current as $frval){
              //  if($frval->acadyear!=$acadyear && $frval->acadsem!=$acadsem){
              //  if(DB::table('grades_sub')->where('rollno',$valstudent->rollno)->where('grade','=','FR')->where('acadyear',$acadyear)->where('acadsem',$acadsem)->where('crsecode',$val->crsecode)->count()!=1){
          $grade_point= DB::table('grades')->where('gradcode',$frval->grade)->first();
          $coursedetails= DB::table('courselist')->where('crsecode',$frval->crsecode)->first();
            $total_grade_point_FR=$coursedetails->totcred*$grade_point->gradpoint;
          echo  $semcredits_FR_array[]= $coursedetails->totcred;echo'SSSSSSS=>'.$frval->crsecode .'<br>';
          $semcredits_FR_coursecode[]=$frval->crsecode;
             $semgradepts_FR=$total_grade_point_FR+$semgradepts_FR;

           // Grade Earn by Student 
            
        // }
      }
       
      }
        //=======================================
          }

   }else{ 

//===================================================================================
//=========== Addetional learning  calculation ================================
//====================================================================================
   $rollnolistFR= DB::table('grades_sub')->where('rollno',$valstudent->rollno)->where('grade','FR')->where('crsecode',$val->crsecode)->where('acadsem',$acadsem_previous)->where('acadyear',$acadyear_previous)->first();
             //===========FR==================
              if(empty($rollnolistFR)){
           //     if($val->grade!='FR'){
 $grade_point= DB::table('grades')->where('gradcode',$val->grade)->first();
          $coursedetails= DB::table('courselist')->where('crsecode',$val->crsecode)->first();
          echo 'Course Code=>'.$val->crsecode;
            echo '<br>';
        echo 'total_grade_pointA=>'.   $total_grade_pointA=$coursedetails->totcred*$grade_point->gradpoint;
        echo '<br>';
         echo 'semcreditsA=>'.  $semcreditsA= $coursedetails->totcred+$semcreditsA;
         echo '<br>';
        echo 'semgradeptsA=>'.   $semgradeptsA=$total_grade_pointA+$semgradeptsA;
        echo '<br>';
           // Grade Earn by Student 
        echo 'Grade A=>'.$val->grade;
            $geted_grad_point_m[]=$val->grade;
            // Grade Total Registed Geade Point in the course 
              $cousetotalcredit_array_m[]=$coursedetails->totcred;
              //Course Name 
              $cousename_array_m[]=$coursedetails->crsename;
               $cousetype_array_m[]=$coursedetails->type;
                $cousecode_array_m[]=$val->crsecode;
     if($val->grade!="FR"){
            $cousestate_array_m[]="P";
           }else{
            $cousestate_array_m[]="F";
           }
    //   }
     }
}
}else{ 
//===================================================================================
//=========== minor calculation ================================
//====================================================================================
  echo "SSSSSSSSS<br>";
   $rollnolistFR= DB::table('grades_sub')->where('rollno',$valstudent->rollno)->where('grade','!=','FR')->where('crsecode',$val->crsecode)->where('acadsem',$acadsem_previous)->where('acadyear',$acadyear_previous)->first();
             //===========FR==================
              if(empty($rollnolistFR)){
           //     if($val->grade!='FR'){
 $grade_point= DB::table('grades')->where('gradcode',$val->grade)->first();
          $coursedetails= DB::table('courselist')->where('crsecode',$val->crsecode)->first();
            echo 'Course Code=>'.$val->crsecode;
            echo '<br>';
        echo 'total_grade_pointM=>'.   $total_grade_pointM=$coursedetails->totcred*$grade_point->gradpoint;
        echo '<br>';
         echo 'semcreditsM=>'.  $semcreditsM= $coursedetails->totcred+$semcreditsM;
         echo '<br>';
        echo 'semgradeptsM=>'.   $semgradeptsM=$total_grade_pointM+$semgradeptsM;
        echo '<br>';
           // Grade Earn by Student 
        echo 'Grade M=>'.$val->grade;
           // Grade Earn by Student 
           echo 'Grade=>'.$val->grade;
            $geted_grad_point_m[]=$val->grade;
            // Grade Total Registed Geade Point in the course 
              $cousetotalcredit_array_m[]=$coursedetails->totcred;
              //Course Name 
              $cousename_array_m[]=$coursedetails->crsename;
               $cousetype_array_m[]=$coursedetails->type;
                $cousecode_array_m[]=$val->crsecode;
     if($val->grade!="FR"){
            $cousestate_array_m[]="P";
           }else{
            $cousestate_array_m[]="F";
           }
    //   }
     }
}
         // }
        }

      
//if($semcredits!=0){
 
   // print_r( $cousecode_array);
   //dd($valstudent->rollno);
//}
       
//print_r($cousename_array);
         //Calculation of SPI 
        echo '=======================  <br>';
 echo '<br>';
            print_r("semgradepts:".$semgradepts); // Semeter Total Grade Point     
         echo '<br>';
         print_r("semcredits:<p style='color:red'>".$semcredits."</p>");// Semester Total Registered Course Sum  
         echo '<br>';
         if($semcredits!=0){
         $spi=round($semgradepts/$semcredits,2);
     }
        print_r("SPI:".$spi);      //Semester Calculate SPI 
        echo '<br>'; 
        //========MSPI and ASPI calculate============

if($semgradeptsM!=0){
  $mspi=round($semgradeptsM/$semcreditsM,2);
}
if($semgradeptsA!=0){
  $aspi=round($semgradeptsA/$semcreditsA,2);
}
        //======================

         //=======================  
        //END SPI SECTION
       //=======================  

         // calculation of  CPI 
          $trans_student_previus= DB::table('trans_student')->where('rollno',$valstudent->rollno)->where('acadsem',$acadsem_previous)->where('acadyear',$acadyear_previous)->first();
       //   print_r( $trans_student_previus);
     if(!empty($trans_student_previus)){ // check trans Student empty or not 
                

                  //=======================  
        ///// MCPI SECTION Work Minor
 //=======================  
         echo'totgradeptsM=>'. $totgradeptsM=$trans_student_previus->mtotgradepts+$semgradeptsM; //Total credit Registerd 
         echo'<br>';
       echo 'totcreditsM=>'.  $totcreditsM=$trans_student_previus->mtotcredits+$semcreditsM;  //Total Grade Point 
       echo'<br>';
         if($totgradeptsM!=0) 
         $mcpi=round($totgradeptsM/$totcreditsM,2);
       //ADDETIONAL CREDIT =====
          echo'totgradeptsA=>'. $totgradeptsA=$trans_student_previus->atotgradepts+$semgradeptsA; //Total credit Registerd 
          echo'<br>';
       echo 'totcreditsA=>'.  $totcreditsA=$trans_student_previus->atotcredits+$semcreditsA;  //Total Grade Point 
       echo'<br>';
         if($totgradeptsA!=0) 
         $acpi=round($totgradeptsA/$totcreditsA,2);
//============================================================================
       print_r(array_combine($semcredits_FR_coursecode,$semcredits_FR_array));
       print_r(array_unique(array_combine($semcredits_FR_coursecode,$semcredits_FR_array)));
      $semcredits_FR= array_sum(array_combine($semcredits_FR_coursecode,$semcredits_FR_array));
echo '=======================  <br>';
  echo 'total_grade_point_FR'.$total_grade_point_FR;
         echo '<br>';
         echo 'semcredits_FR:'.$semcredits_FR; 
         echo '<br>';
         echo 'semgradepts_FR'.$semgradepts_FR;
      echo '=======================  <br>';
//============================================================================       
echo'ACPI=>'.$acpi.'<br>';
echo'MCPI=>'.$mcpi.'<br>';
        //=======================  
        ///// CPI SECTION Work 
 //=======================  
         $totgradepts=$trans_student_previus->totgradepts+$semgradepts; //Total credit Registerd 
         if($semcredits_FR!=0){
         $totcredits=$trans_student_previus->totcredits+$semcredits-$semcredits_FR;  //Total Grade Point 
       }else{
   $totcredits=$trans_student_previus->totcredits+$semcredits;
       }
         if($totgradepts!=0) 
         $cpi=round($totgradepts/$totcredits,2);
            
         echo '=======================  <br>';
          print_r("totgradepts:".$totgradepts);//  Total Registered Course Sum  
            echo '<br>';
          print_r("totcredits:".$totcredits); //  Total Grade Point 
         echo '<br>';
         echo "CPI".$cpi;
         echo '<br>';
           echo 'previus Trans Script ';
     //print_r($trans_student_previus);
        
       }
  //=======================  
        ///// End  CPI SECTION Work 
 //=======================          echo '<br>';
       echo '=======================  <br>';
        echo "CPI".$cpi;
        echo '<br>';
        echo '<br> CPI VAL:'.$cpi;
         if($cpi==0){
        $cpi=$spi;
        $totgradepts=  $semgradepts;
        $totcredits=$semcredits;
       }
       echo '=======================  <br>';
        echo "<br> updated CPI:".$cpi;
        echo "<br> updated totgradepts:".$totgradepts;
        echo "<br> updated totcredits:<b  style='color:red'> <p>".$totcredits.'</p></b>';
        echo "<br>geted_grad_point:";
        print_r($geted_grad_point);
        echo "Total Ragistered Course point:";
        //print_r($cousetotalcredit_array);
        echo "cousecode_array:";
        print_r($cousecode_array);
        //echo "cousename_array:";
      //  print_r($cousename_array);
       // echo "cousetype_array:";
       // print_r($cousetype_array);
        echo "cousetotalcredit_array:";
        print_r($cousetotalcredit_array);

        ////////////////////// INSER and Update DATA trans_student and trans_course table 
if(!empty($cousecode_array)){ // if any agrade not in this semester 
     
          if(!empty($trans_student)){
             echo '<br>== Update Record ==============='.$valstudent->rollno;
DB::table('trans_student')
             ->where('rollno',$valstudent->rollno)->where('acadsem',$acadsem)->where('acadyear',$acadyear)
             ->update(['semcredits' => $semcredits,'semgradepts' => $semgradepts,'spi' => $spi,'totcredits' => $totcredits,'totgradepts' => $totgradepts,'cpi' => $cpi,'msemcredits'=>$semcreditsM,'msemgradepts'=>$semgradeptsM,'mspi'=>$mspi,'dept'=>$valstudent->specialization,'sex'=>$valstudent->sex,'mtotcredits'=>$totcreditsM,'mtotgradepts'=>$totgradeptsM,'mcpi'=>$mcpi,'asemcredits'=>$semcreditsA,'asemgradepts'=>$semgradeptsA,'aspi'=>$aspi,'atotcredits'=>$totcreditsA,'atotgradepts'=>$totgradeptsA,'acpi'=>$acpi]);  
               $studentid =$trans_student->studentid;
     }else{
   //echo "MAX";
          echo '<br>==Insert Record ==============='.$valstudent->rollno;
      $studentid=DB::table('trans_student')->max('studentid')+1;
          DB::insert('insert into trans_student (studentid,acadyear,acadsem,rollno,name,program,dept,parent,paddr1,batchyear,semcredits,semgradepts,spi,totcredits,totgradepts,cpi,curryear,dob,contactno,category,altemail,bchange)
                          values (?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?)', [$studentid,$acadyear,$acadsem, 
                            $valstudent->rollno,$valstudent->name,$valstudent->program,$valstudent->dept,$valstudent->parent,$valstudent->per_address,$valstudent->batchyear,$semcredits,$semgradepts,$spi,$totcredits,$totgradepts,$cpi,$valstudent->curryear,$valstudent->dob,$valstudent->contactno,$valstudent->castcategory,$valstudent->email,0]);
        
     }

     //=============loop start 
     for($i=0;$i<count($cousecode_array);$i++){
         $transcript_course= DB::table('transcript_course')->where('studentid',$studentid)->where('acadsem',$acadsem)->where('crsecode',$cousecode_array[$i])->where('acadyear',$acadyear)->first();
             if(!empty($transcript_course)){
                  DB::table('transcript_course')
             ->where('studentid',$studentid)->where('acadsem',$acadsem)->where('acadyear',$acadyear)->where('crsecode',$cousecode_array[$i])
             ->update(['grade' =>$geted_grad_point[$i],'gradstat' => $cousestate_array[$i]]);
             }else{
                DB::insert('insert into transcript_course (studentid,acadyear,acadsem,crsecode,crsename,crsetype,credit,grade,gradstat)
                          values (?, ?, ?, ?, ?, ?, ?,?,? )', [$studentid,$acadyear,$acadsem, 
                           $cousecode_array[$i],$cousename_array[$i],$cousetype_array[$i],$cousetotalcredit_array[$i],$geted_grad_point[$i],$cousestate_array[$i]]);
             }
     }


     
 }//========End if Array 

   //===========loop start Insert Minor/addetion course ====================

      // if(!empty($cousename_array_m)){

        //    $cousename_array array_merge($cousename_array,$cousename_array_m);
        //      $geted_grad_point array_merge($geted_grad_point,$geted_grad_point_m);
        //        $cousetotalcredit_array array_merge($cousetotalcredit_array,$cousetotalcredit_array_m);
        //        $cousetype_array array_merge($cousetype_array,$cousetype_array_m);
        //        $cousecode_array array_merge($cousetype_array,$cousecode_array_m);
     // cousestate_array_m
        // }
 if(!empty($cousecode_array_m)){
      if(!empty($trans_student)){
             echo '<br>== Update Record ==============='.$valstudent->rollno;
DB::table('trans_student')
             ->where('rollno',$valstudent->rollno)->where('acadsem',$acadsem)->where('acadyear',$acadyear)
             ->update(['mtotcredits'=>$totcreditsM,'mtotgradepts'=>$totgradeptsM,'mcpi'=>$mcpi]);  
               $studentid =$trans_student->studentid;
     }else{
   //echo "MAX";
          echo '<br>==Insert Record ==============='.$valstudent->rollno;
      // $studentid=DB::table('trans_student')->max('studentid')+1;
      //     DB::insert('insert into trans_student (studentid,acadyear,acadsem,rollno,name,program,dept,parent,paddr1,batchyear,semcredits,semgradepts,spi,totcredits,totgradepts,cpi,curryear,dob,contactno,category,altemail,bchange)
      //                     values (?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?)', [$studentid,$acadyear,$acadsem, 
      //                       $valstudent->rollno,$valstudent->name,$valstudent->program,$valstudent->dept,$valstudent->parent,$valstudent->per_address,$valstudent->batchyear,$semcredits,$semgradepts,$spi,$totcredits,$totgradepts,$cpi,$valstudent->curryear,$valstudent->dob,$valstudent->contactno,$valstudent->castcategory,$valstudent->email,0]);
        
     }
     for($i=0;$i<count($cousecode_array_m);$i++){
         $transcript_course= DB::table('transcript_course')->where('studentid',$studentid)->where('acadsem',$acadsem)->where('crsecode',$cousecode_array_m[$i])->where('acadyear',$acadyear)->first();
             if(!empty($transcript_course)){
                  DB::table('transcript_course')
             ->where('studentid',$studentid)->where('acadsem',$acadsem)->where('acadyear',$acadyear)->where('crsecode',$cousecode_array_m[$i])
             ->update(['grade' =>$geted_grad_point_m[$i],'gradstat' => $cousestate_array_m[$i]]);
             }else{
                DB::insert('insert into transcript_course (studentid,acadyear,acadsem,crsecode,crsename,crsetype,credit,grade,gradstat,minor)
                          values (?, ?, ?, ?, ?, ?, ?,?,?,? )', [$studentid,$acadyear,$acadsem, 
                           $cousecode_array_m[$i],$cousename_array_m[$i],$cousetype_array_m[$i],$cousetotalcredit_array_m[$i],$geted_grad_point_m[$i],$cousestate_array_m[$i],'M']);
             }
     }


 }
     //==========loop end =========
         //$grade_point= DB::table('grades')->whereIn('gradcode',$geted_grad_point)->get();
     
  //  }// ====================if Not Eqaul 0 Semcredit
  }//==========================================End Outer Loop 
        //whereIn
      //   $rollnolist= DB::table('grades')->get();
       // dd($rollnolist);
  dd($studentprofile);
      return view('admin.studentgrade.list', compact('rollnolist'));

}


//else{
            // Second table check 
      //     $trans_student_second_table= DB::table('trans_student_2')->where('rollno',$rollno)->where('acadsem',$acadsem_previous)->where('acadyear',$acadyear_previous)->first();
      //      if(!empty($trans_student_second_table)){
      //        //=======================  
      //   ///// CPI SECTION Work Second Table 
      //   //=======================
      //         $totcredits=$trans_student_second_table->semgradepts+$semgradepts; //Total credit Registerd 
      //   $totgradepts=$trans_student_second_table->semcredits+$semcredits;  //Total Grade Point  
      // $cpi=round($totcredits/$totgradepts,2);
      //     print_r("totcredits:".$totcredits); //  Total Grade Point     
      //    echo '<br>';
      //    print_r("totgradepts:".$totgradepts);//  Total Registered Course Sum  
      //    echo '<br>';
      // echo "CPI".$cpi;

      //      }else{

      //      }

         //}
public function gradecal(){

    $rollnolist= DB::table('login')->where('usertype',3)->get();
    $programlist=['Ph.D.','M.Tech.','B.Tech.','M.Sc.'];
      return view('admin.studentgrade.list', compact('rollnolist','programlist'));

}
public function courseregistration(){
   $branch=['Computer Science & Engineering','Metallurgy Engineering and Materials Science','Civil Engineering'];//,'Electrical Engineering'
   // $branch=['Electrical Engineering','Mechanical Engineering'];//,'Electrical Engineering'
     $coursearray=['NO 101'];
   // $studenlist=DB::table('student_profile')->where('program','B.Tech.')->where('rollno','210001001')->where('batchyear','2021')->get();
   // $coursearray=['CH 103','CH 153','CS 103','HS 159','IC 151','IC 153','MA 105(A)','NO 101','PH 105'];
     //  $coursearray=['PCH 101','PMA 101','PPH 101','PHS 101'];
 $studenlist=DB::table('new_autumn_2021')->where('prog','B.Tech.')->whereIn('dept', $branch)->get();
 
    foreach($studenlist as $stuval){
         // DB::table('login')
         //     ->where('email', $val->rollno)
         //     ->update(['pass' => $newpass]);
        for($i=0;$i<count($coursearray);$i++){
$oldstudent=DB::table('student_curr_course')->where('rollno',$stuval->rollno)->where('crsecode',$coursearray[$i])->first();
    //dd($rolmodel);
    if(!$oldstudent){
          DB::insert('insert into student_curr_course (rollno,acadyear ,acadsem,crsecode ,crseflag,audit,stime )
                        values (?,?,?,?,?,?,?)', [$stuval->rollno,'2021','1',$coursearray[$i],'0','0',date("Y-m-d h:i:s a")]);
      }
      }
    }
 dd($studenlist);

}

public function password(){

    //echo'ss';exit;
    $pass="abcdef";
 
    $newpass="";
    $pass_array=str_split($pass);
    for($i=0;$i<count($pass_array);$i++){
        $newpass.=$i.$pass_array[$i];
    }
  //  $listnew=DB::table('student_profile')->get();
     $listnew=DB::table('new_autumn_2021')->where('prog','Ph.D.')->get();
  //  echo'<pre>';
   // dd($listnew);
    foreach($listnew as $val){
        //========= list loop 
           $newpass="";
  $pass_array=str_split($val->contact);

        for($i=0;$i<count($pass_array);$i++){
        $newpass.=$i.$pass_array[$i];
    }// This loop for password only 
    
$rolmodel=DB::table('login')->where('email',$val->rollno)->first();
    //dd($rolmodel);
    if(!$rolmodel){
       DB::insert('insert into login (email,pass,usertype)
                        values (?,?,?)', [$val->rollno,$newpass,'3']);
          DB::insert('insert into email (rollno,ins_email)
                        values (?,?)', [$val->rollno,$val->email]);
       // return redirect('admin/password')->with('flash_message', 'This Student Password Updated');
           echo 'Saved';
}else{
$affected = DB::table('login')
             ->where('email', $val->rollno)
             ->update(['pass' => $newpass]);
             //   echo 'Updated';
            //  dd(DB::getQueryLog());
//exit;
           //   return redirect('admin/password')->with('flash_message', 'This Student Password Updated');
     // DB::insert('insert into nodues (rollno, name,program,dept,acadyear,acadsem)
     //                     values (?, ?, ?, ?, ?, ?)', [$request->input('rollno'),NULL,NULL,NULL,$request->input('acadyear'),$request->input('acadsem')]);
 }
 //===========================================
    }
  //  dd('');
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
public function savebatch(Request $request){


    $list_student=DB::table('student_profile')->where('program','MS (Research)')->where('batchyear','2019')->get();
    echo $list_student;
    //dd($rolmodel);
    foreach($list_student as $val){
   // if(!$rolmodel){
        $rolmodel=DB::table('tobepassout')->where('rollno',$val->rollno)->first();
    //dd($rolmodel);
    if(!$rolmodel){
        DB::insert('insert into tobepassout (rollno)
                         values (?)', [$val->rollno]);
        DB::insert('insert into nodues (rollno, name,program,dept,acadyear,acadsem)
                         values (?, ?, ?, ?, ?, ?)', [$val->rollno,NULL,NULL,NULL,'2020','2']);
}
 //       DB::insert('insert into tobepassout (rollno)
                     //    values (?)', [$val->rollno]);
//}
     
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
         Feedback_allocation::create($requestData);
         $course_allocation = DB::table('feedback_allocation')
             ->select("*")
             ->where('crsecode', $request->input('crsecode'))->where('facultyname', $request->input('facultyname'))->where('acadsem', '2')->where('acadyear', '2020')
             ->first();
             if(!$course_allocation){
        DB::insert('insert into feedback_allocation (acadyear, facultyname,acadsem,crsetype,crsecordi,dept,program,lock,crsecode)
                         values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [$request->input('acadyear'), $request->input('facultyname'),$request->input('acadsem'),0,0 ,$request->input('dept'),NULL,0,$request->input('crsecode')]);
        //Feedback_allocation::create($requestData);
}
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
