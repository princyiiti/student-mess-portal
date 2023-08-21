<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserProfile;
use App\StudentTotalFee;
use App\Donation;
use App\FeeStudent;
use DB;
use PaytmWallet;
use App\User;
use Log;
use Mail;
use PDF;
use App;
class OrderController extends Controller
{
    public function paymentCallback(Request $request)
    {
        //===================DONATION DATE==========================
        $input=$request->all();
       // print_r($request->all());exit;
         if($input['status']==='success'){
             $amountmodel=StudentTotalFee::where('reference_no',$input['txnid'])->first();
            //  dd($amountmodel);
              $filename=$amountmodel->reference_no.'.pdf'; 
             if( $amountmodel->due_amount>0){
      StudentTotalFee::where('reference_no',$input['txnid'])->update(['status'=>3,'type'=>2, 'partial_transaction_id'=>$input['hash'], 'payment_date'=>date('Y-m-d H:i:s')]);
            }else{
     StudentTotalFee::where('reference_no',$input['txnid'])->update(['status'=>2,'fee_type'=>'Full Paid','type'=>3, 'transaction_id'=>$input['hash'],
      'paid_amount'=>$amountmodel->totalamount, 'paid_date'=>date('Y-m-d H:i:s'),'file'=>'public/uploads/'.$filename]);
      Log::debug('receive getTransactionId:');
      Log::debug($input['txnid']);
      Log::debug($amountmodel);

      Log::debug('receive getTransactionId END :');

                 }
        $totalamount=StudentTotalFee::where('reference_no',$input['txnid'])->first();  
        $studentamount=FeeStudent::where('rollno',$totalamount->rollno)
        ->where('rollno',$totalamount->rollno)
        ->where('academic_year',$totalamount->academic_year)
        ->where('academic_tearm',$totalamount->academic_tearm)->get();
        $studentprofile=DB::table('new_autumn_2021')->where('rollno',$totalamount->rollno)->first();
 
  	$word = $this->numberToWord($totalamount->totalamount);
           $pdf = App::make('dompdf.wrapper');     
           $pdf->loadHTML(view('receiptpdf', compact('studentamount','totalamount','studentprofile','word')));

           
          
           //$pdf->save(storage_path().'_filename.pdf');
           file_put_contents('public/uploads/'.$filename, $pdf->output()); 

           //return $pdf->download('receiptpdf.pdf');

         //  $pdf = PDF::loadView('receiptpdf', compact('studentamount', 'totalamount','studentprofile'));
         //  return  $pdf->view('itsolutionstuff.pdf');
          //file_put_contents('public/uploads/'.$filename, $pdf->output()); 

          $subject='Your Amount has been recived to IIT Indore';
       

       User::sendmailtcompleted('completed', $subject, $studentprofile->email, $studentprofile);
    
       //return view('finalview', compact('amountmodel','studentprofile'));
       return redirect('/home');//view('feepay', compact('amountmodel','studentprofile'));
     }
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


    public function subscribecancel(Request $request){
       $input=$request->all();
       //dd($input);
        if(!empty($input)){
            if($input['status']=='failure'){
                  $amountmodel=StudentTotalFee::where('reference_no',$input['txnid'])->first();
                StudentTotalFee::where('reference_no',$input['txnid'])->update(['status'=>'9', 'transaction_id'=>$input['hash']]);
                Log::debug('receive user details Failed:');
                Log::debug( $input['txnid']);
                 Log::debug( $input['hash']);
               Log::debug($amountmodel);
                Log::debug('receive user details Failed:END');
                  
                return view('finalviewcancel');  
            }else{

            }         
        }
       
        return redirect('/feepay');
    }  
}