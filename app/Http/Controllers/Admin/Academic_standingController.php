<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Feedback_allocation;
use Illuminate\Http\Request;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
use DateTime;
use DatePeriod;
use DateInterval;
class Academic_standingController extends Controller
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
      

        return view('admin.academic_standing.index');
      }

public function standing(Request $request){

           $program= $request->input('program');//'B.Tech.';
       $rollno1=['200001014'];
          $batchyear=$request->input('batchyear');//'2018';
           $acadsem=$request->input('acadsem');//1; echo'<br>';
           $acadyear=$request->input('acadyear');//2021;
             if($acadsem==2){
            $acadsem_previous=1;
          $acadyear_previous=$acadyear;
           }else{
         $acadsem_previous=2;
        $acadyear_previous=$acadyear-1;
       }

        $studentprofile = DB::table('student_profile')->where('rollno',"2203141007")->where('program',$program)->where('batchyear',$batchyear)->get();
        foreach($studentprofile as $stuval)
        {
             $currentone='';$currenttwo='';$currentthree='';$currentfour='';$currentfive='';
             $previousone='';$previoustwo='';$previousthree='';$previousfour='';$previousfive='';
             $academic_standing='';
             //Section for current semester work start 
           //  $studentgrade_current=DB::table('grades_sub')->where('rollno',$stuval->rollno)->where('acadsem',$acadsem)->where('acadyear',$acadyear)->where('grade','>','2')->whereIn('grade', ['XX', 'FR'])->get();
          // print_r($stuval->rollno);exit;
               $studentgrade_current=DB::table('grades_sub')->join('courselist', 'grades_sub.crsecode', '=', 'courselist.crsecode')->where('courselist.totcred', '>=',3 )->where('grades_sub.rollno',$stuval->rollno)->where('grades_sub.acadsem',$acadsem)->where('grades_sub.acadyear',$acadyear)->whereIn('grades_sub.grade', ['XX', 'FR'])->get();
       // $join->on('grades_sub.crsecode', '=', 'courselist.crsecode')->where('courselist.totcred', '>=',3 )->where('grades_sub.rollno','200001014')->where('grades_sub.acadsem',$acadsem)->where('grades_sub.acadyear',$acadyear)->whereIn('grades_sub.grade', ['XX', 'FR']);
       // })->get();
           //  print_r($studentgrade_current);
            if(!empty($studentgrade_current)){
                if(count($studentgrade_current)==1){
                   $currentthree='yes';
                }elseif(count($studentgrade_current)==2){
                   $currentfour='yes';
                }elseif(count($studentgrade_current)>=3){
                   $currentfive='yes';
                }
                echo  "Demo =>".$currentfive;
              //  print_r($studentgrade_current);echo '<br>SS'.count($studentgrade_current);
                if(count($studentgrade_current)==0){
                     $transdata=DB::table('trans_student')->where('rollno',$stuval->rollno)->where('acadsem',$acadsem)->where('acadyear',$acadyear)->where('cpi','>','7')->first();

                  if(!empty($transdata)){
                    $currentone='yes';
                  }else{
                    $currenttwo='yes';
                  }
                }
              }
              // else{
                 
              // }
              //=======End current semester work =========================
              // Previous Semester Work =================================
                $studentgrade_previous=DB::table('grades_sub')->join('courselist', 'grades_sub.crsecode', '=', 'courselist.crsecode')->where('courselist.totcred', '>=',3 )->where('grades_sub.rollno',$stuval->rollno)->where('grades_sub.acadsem',$acadsem_previous)->where('grades_sub.acadyear',$acadyear_previous)->where('grades_sub.grade','>=',3)->whereIn('grade', ['XX', 'FR'])->get();
              if(!empty($studentgrade_previous)){
                if(count($studentgrade_previous)==1){
                   $previousthree='yes';
                }elseif(count($studentgrade_previous)==2){
                   $previousfour='yes';
                }elseif(count($studentgrade_previous)>=3){
                   $previousfive='yes';
                }
              }else{
                  // $transdata=DB::table('trans_student')->where('rollno',$stuval->rollno)->where('acadsem',$acadsem_previous)->where('acadyear',$acadyear_previous)->where('cpi','>=','8')->first();
                  // if(!empty($transdata)){
                  //   $previousone='yes';
                  // }else{
                  //   $previoustwo='yes';
                  // }
               }
               echo 'PRE=>'.$previousfour;
              //================ End privous semester work ==================================
             if($previousthree=='yes'||$currentthree=='yes'){
                if($currentthree=='yes')
                $academic_standing=3;
               if($previousthree=='yes')
                 $academic_standing=3;
             }
             if ($previousfour=='yes'||$currentfour=='yes'){
                if($currentfour=='yes')
                $academic_standing=4;
            if($previousfour=='yes')
                $academic_standing=4;
             }
              if ($previousfive=='yes'||$currentfive=='yes'){
                if($previousfive=='yes')
              $academic_standing=5;
           if($currentfive=='yes')
              $academic_standing=5;
             }
              if($previousfive!='yes'||$currentfive!='yes'||$previousfour!='yes'||$currentfour!='yes'||$previousthree!='yes'||$currentthree!='yes'){
              if ($currentone=='yes'){
              $academic_standing=1;
             }else if ($currenttwo=='yes'){
              $academic_standing=2;
             }
         }

           echo 'Rollno ACADEMIC=>'.$stuval->rollno.'Standing=>'.$academic_standing.'<br>';
           DB::table('student_profile')->where('rollno',$stuval->rollno)->update(['academic_standing' =>$academic_standing]);
           //$studentgrade_previous=  DB::table('grades_sub')->where('rollno',$stuval->rollno)->where('acadsem',$acadsem_previous)->where('acadyear',$acadyear_previous)->where('grade','FR')->get();
        }

}

public function removecourse(){
    
      $studentcourse= DB::table('student_curr_course')->where('acadyear','=','2022')->where('acadsem','=','1')->get();
      foreach($studentcourse as $val){
          $studentprofile= DB::table('student_profile')->where('present','!=','Studying')->where('rollno',$val->rollno)->first();
        if(!empty($studentprofile)){
          //  if($studentprofile->rollno!='2003171006'||$studentprofile->rollno!='1801251001')
         //   DB::table('student_curr_course')->where('acadyear','=','2022')->where('rollno',$studentprofile->rollno)->update(['acadsem'=>'6']);
           echo $studentprofile->rollno.' '.$studentprofile->name.$studentprofile->program.'<br>' ;
        }

      }

    
          // dd($notifications);
}

public function readfilecustome(){
    //echo public_path('demodata_import.xlsx');exit;
    //$results =[];
    Excel::load(public_path('Dropcourse.xlsx'), function($reader) {

    // Getting all results
    $results = $reader->get();

    // ->all() is a wrapper for ->get() and will work the same
    $results = $reader->all();
      echo '<pre>';
   // print_r($results);
  
  //  echo '<pre>';
  // //  exit;
    foreach($results as $val){
     
          echo 'Record Updated=>'.$val->rollno.'add1=>'.$val->drop1.'add2=>'.$val->drop2.'add3=>'.trim($val->drop3).'<br>';

      if($val->drop1!=''){
      DB::table('student_curr_course')->where('rollno',$val->rollno)->where('crsecode',$val->drop1)->where('acadsem','2')->where('acadyear','2022')->delete();
  }
if($val->drop2!=''){
      DB::table('student_curr_course')->where('rollno',$val->rollno)->where('crsecode',$val->drop2)->where('acadsem','2')->where('acadyear','2022')->delete();
  }
          if($val->drop3!=''){ 
      DB::table('student_curr_course')->where('rollno',$val->rollno)->where('crsecode',$val->drop3)->where('acadsem','2')->where('acadyear','2022')->delete();
  }
//   if($val->add1!=''){
// DB::table('student_curr_course')->insert(['rollno' => $val->rollno, 'acadsem' => '2', 'acadyear' => '2022','crsecode'=>$val->add1]);
//  echo 'Record Updated=>'.$val->rollno.'add1=>'.$val->add1.'<br>';
// }
//   if($val->add2!=''){
// DB::table('student_curr_course')->insert(['rollno' => $val->rollno, 'acadsem' => '2', 'acadyear' => '2022','crsecode'=>$val->add2]);
//  echo 'Record Updated=>'.$val->rollno.'add2=>'.$val->add2.'<br>';
// }
//   if($val->add3!=''){
// DB::table('student_curr_course')->insert(['rollno' => $val->rollno, 'acadsem' => '2', 'acadyear' => '2022','crsecode'=>$val->add3]);
//  echo 'Record Updated=>'.$val->rollno.'add3=>'.$val->add3.'<br>';
// }
//   if($val->add4!=''){
// DB::table('student_curr_course')->insert(['rollno' => $val->rollno, 'acadsem' => '2', 'acadyear' => '2022','crsecode'=>$val->add4]);
//  echo 'Record Updated=>'.$val->rollno.'add4'.$val->add4.'<br>';
// }
      
    }
    exit;
 //   print_r($results);

});
    
}


// public function readfilecustome(){
//     //echo public_path('demodata_import.xlsx');exit;
//     //$results =[];
//     Excel::load(public_path('Name hindiphd 2022 (3).xlsx'), function($reader) {

//     // Getting all results
//     $results = $reader->get();

//     // ->all() is a wrapper for ->get() and will work the same
//     $results = $reader->all();
//       echo '<pre>';
//   //  print_r($results);
  
//   //  echo '<pre>';
//   //  exit;
//     foreach($results as $val){
//        // dd($val->qexam);
//       echo $val->roll;
      
//     //    echo $val->roll;
//          DB::table('student_profile')->where('rollno',$val->roll)->update(['dviva' =>date("d M Y",strtotime($val->hname))]);
//            echo 'Record Updated=>'.$val->roll.'<br>'.' '.date("d M Y",strtotime($val->hname)).'<br>';
//     }
//     exit;
//  //   print_r($results);

// });
    
// }


public function exportexcel(){
  
      
   // $section="B.Tech. Section B First sem";
  //$arraydept=  ['Electrical Engineering','Mechanical Engineering'];
 // $arraydept=['Computer Science & Engineering','Civil Engineering','Metallurgy Engineering and Materials Science'];
  $section="B.Tech. Section A First sem";
   $arraydept=['Computer Science & Engineering','Civil Engineering','Metallurgy Engineering and Materials Science','Electrical Engineering','Mechanical Engineering'];
  $program=['Computer Science & Engineering'=>'B.Tech IV Sem CSE','Civil Engineering'=>'B.Tech IV Sem CE','Metallurgy Engineering and Materials Science'=>'B.Tech IV Sem MEMS','Electrical Engineering'=>'B.Tech IV Sem EE','Mechanical Engineering'=>'B.Tech IV Sem ME'];
     $studentcourse= DB::table('trans_student')->whereIn('dept',$arraydept)->where('acadyear','=','2019')->where('acadsem','=','2')->where('program','=','B.Tech.')->Where('rollno', 'LIKE', "%19000%")->get();
      
     return view('exportdata.index',compact('studentcourse','section'));
    
}

public function exportgradebatch(){
  
      
    $section="B.Tech. Section B II sem";
  $arraydept=  ['Electrical Engineering','Mechanical Engineering','Computer Science & Engineering','Civil Engineering','Metallurgy Engineering and Materials Science'];
 // $arraydept=['Computer Science & Engineering','Civil Engineering','Metallurgy Engineering and Materials Science'];
 //  $section="B.Tech. Section A II sem";
  // $arraydept=['Computer Science & Engineering','Civil Engineering','Metallurgy Engineering and Materials Science','Electrical Engineering','Mechanical Engineering'];

   $program=['Computer Science & Engineering'=>'B.Tech III Sem CSE','Civil Engineering'=>'B.Tech III Sem CE','Metallurgy Engineering and Materials Science'=>'B.Tech III Sem MEMS','Electrical Engineering'=>'B.Tech III Sem EE','Mechanical Engineering'=>'B.Tech III Sem ME'];
  // $program=['Computer Science & Engineering'=>'B.Tech IV Sem CSE','Civil Engineering'=>'B.Tech IV Sem CE','Metallurgy Engineering and Materials Science'=>'B.Tech IV Sem MEMS','Electrical Engineering'=>'B.Tech IV Sem EE','Mechanical Engineering'=>'B.Tech IV Sem ME'];
  // $program=['Computer Science & Engineering'=>'B.Tech V Sem CSE','Civil Engineering'=>'B.Tech V Sem CE','Metallurgy Engineering and Materials Science'=>'B.Tech V Sem MEMS','Electrical Engineering'=>'B.Tech V Sem EE','Mechanical Engineering'=>'B.Tech V Sem ME'];
 // $program=['Computer Science & Engineering'=>'B.Tech VI Sem CSE','Civil Engineering'=>'B.Tech VI Sem CE','Metallurgy Engineering and Materials Science'=>'B.Tech VI Sem MEMS','Electrical Engineering'=>'B.Tech VI Sem EE','Mechanical Engineering'=>'B.Tech VI Sem ME'];
     $studentcourse= DB::table('trans_student')->whereIn('dept',$arraydept)->where('acadyear','=','2020')->where('acadsem','=','1')->where('program','=','B.Tech.')->Where('rollno', 'LIKE', "%19000%")->get();
      
     return view('exportdata.batchgrade',compact('studentcourse','program'));
    
}
//===================== For first year Studnet only =========================
public function exportgradebatchforfirstyear(){
  
      
   // $program="B.Tech. Section B II sem";
  $arraydept=  ['Electrical Engineering','Mechanical Engineering','Computer Science & Engineering','Civil Engineering','Metallurgy Engineering and Materials Science'];
 // $arraydept=['Computer Science & Engineering','Civil Engineering','Metallurgy Engineering and Materials Science'];

   $program=['Computer Science & Engineering'=>'B.Tech. Section A II sem','Civil Engineering'=>'B.Tech. Section A II sem','Metallurgy Engineering and Materials Science'=>'B.Tech. Section A II sem','Electrical Engineering'=>'B.Tech. Section B II sem','Mechanical Engineering'=>'B.Tech. Section B II sem'];
 //  $section="B.Tech. Section A II sem";
  // $arraydept=['Computer Science & Engineering','Civil Engineering','Metallurgy Engineering and Materials Science','Electrical Engineering','Mechanical Engineering'];

  
  // $program=['Computer Science & Engineering'=>'B.Tech IV Sem CSE','Civil Engineering'=>'B.Tech IV Sem CE','Metallurgy Engineering and Materials Science'=>'B.Tech IV Sem MEMS','Electrical Engineering'=>'B.Tech IV Sem EE','Mechanical Engineering'=>'B.Tech IV Sem ME'];
  // $program=['Computer Science & Engineering'=>'B.Tech V Sem CSE','Civil Engineering'=>'B.Tech V Sem CE','Metallurgy Engineering and Materials Science'=>'B.Tech V Sem MEMS','Electrical Engineering'=>'B.Tech V Sem EE','Mechanical Engineering'=>'B.Tech V Sem ME'];
 // $program=['Computer Science & Engineering'=>'B.Tech VI Sem CSE','Civil Engineering'=>'B.Tech VI Sem CE','Metallurgy Engineering and Materials Science'=>'B.Tech VI Sem MEMS','Electrical Engineering'=>'B.Tech VI Sem EE','Mechanical Engineering'=>'B.Tech VI Sem ME'];
     $studentcourse= DB::table('trans_student')->whereIn('dept',$arraydept)->where('acadyear','=','2019')->where('acadsem','=','2')->where('program','=','B.Tech.')->Where('rollno', 'LIKE', "%19000%")->get();
      
     return view('exportdata.batchgrade',compact('studentcourse','program'));
    
}

public function exportexcelresult(){
  
      
   // $section="B.Tech. Section B First sem";
  //$arraydept=  ['Electrical Engineering','Mechanical Engineering'];
 $arraydept=['Computer Science & Engineering','Civil Engineering','Metallurgy Engineering and Materials Science'];
  $section="B.Tech. Section A First sem";
     $studentcourse= DB::table('trans_student')->where('acadyear','=','2022')->where('acadsem','=','1')->where('program','=','B.Tech.')->Where('rollno', 'LIKE', "%19000%")->get();
      
     return view('exportdata.result',compact('studentcourse','section'));
    
}
public function Program_Enrollmentexport(){
  
      
    $section="B.Tech. Section B II sem";
  $arraydept=  ['Electrical Engineering','Mechanical Engineering'];
 //$arraydept=['Computer Science & Engineering','Civil Engineering','Metallurgy Engineering and Materials Science'];

  //$section="B.Tech. Section A II sem";
     $studentcourse= DB::table('trans_student')->where('acadyear','=','2020')->whereIn('dept',$arraydept)->where('acadsem','=','2')->where('program','=','B.Tech.')->Where('rollno', 'LIKE', "%19000%")->get();
      
     return view('exportdata.programenroll',compact('studentcourse','section'));
    
}

public function Program_EnrollmentBranch(){


     //$arraydept=  ['Electrical Engineering','Mechanical Engineering'];
 $arraydept=['Computer Science & Engineering','Civil Engineering','Metallurgy Engineering and Materials Science','Electrical Engineering','Mechanical Engineering'];
 //$program=['Computer Science & Engineering'=>'B.Tech III Sem CSE','Civil Engineering'=>'B.Tech III Sem CE','Metallurgy Engineering and Materials Science'=>'B.Tech III Sem MEMS','Electrical Engineering'=>'B.Tech III Sem EE','Mechanical Engineering'=>'B.Tech III Sem ME'];
// $program=['Computer Science & Engineering'=>'B.Tech IV Sem CSE','Civil Engineering'=>'B.Tech IV Sem CE','Metallurgy Engineering and Materials Science'=>'B.Tech IV Sem MEMS','Electrical Engineering'=>'B.Tech IV Sem EE','Mechanical Engineering'=>'B.Tech IV Sem ME'];

 $program=['Computer Science & Engineering'=>'B.Tech IV Sem CSE','Civil Engineering'=>'B.Tech IV Sem CE','Metallurgy Engineering and Materials Science'=>'B.Tech IV Sem MEMS','Electrical Engineering'=>'B.Tech IV Sem EE','Mechanical Engineering'=>'B.Tech IV Sem ME'];

 $studentcourse= DB::table('trans_student')->where('acadyear','=','2022')->whereIn('dept',$arraydept)->where('acadsem','=','1')->where('program','=','B.Tech.')->Where('rollno', 'LIKE', "%19000%")->get();
    return view('exportdata.programenrollBranch',compact('studentcourse','program'));
}

public function academicstanding(){
  
      
    $section="B.Tech. Section B First sem";
  $arraydept=  ['Electrical Engineering','Mechanical Engineering'];
 //$arraydept=['Computer Science & Engineering','Civil Engineering','Metallurgy Engineering and Materials Science'];
  //$section="B.Tech. Section A II sem";
     $studentlist= DB::table('student_profile')->where('present','=','Studying')->whereIn('academic_standing',[3,4,5])->where('program','=','B.Tech.')->get();
      
     return view('exportdata.standinglist',compact('studentlist','section'));

//      public function academicstandinglist(){
  
      
//    // $section="B.Tech. Section B First sem";
//  // $arraydept=  ['Electrical Engineering','Mechanical Engineering'];['academic_standing' =>$academic_standing]
//  $arraydept=['Computer Science & Engineering','Civil Engineering','Metallurgy Engineering and Materials Science'];
//   $section="B.Tech. Section A II sem";
//      $studentcourse= DB::table('trans_student')->where('present','!=','Studying')->whereIn('dept',$arraydept)->where('acadsem','=','2')->where('program','=','B.Tech.')->Where('rollno', 'LIKE', "%19000%")->get();
      
//      return view('exportdata.programenroll',compact('studentcourse','section'));
    
// }
    
}

}