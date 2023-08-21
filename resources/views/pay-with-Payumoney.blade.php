<?php
   $MERCHANT_KEY = "w79Eq1";//"f3zR9gxP"; // 160569 add your id
   $SALT = "FZiUPMLD"; // add your id
   //$PAYU_BASE_URL = "https://test.payu.in";
   $PAYU_BASE_URL = "https://secure.payu.in";
   $action = '';
  // $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
   $totalamount="";
   if($studentdata->remission=="Yes" && $studentdata->remission!="")
    {
        $totalamount= $studentdata->totalamount-$studentdata->remission_amount;

    }else{
 $totalamount=$studentdata->totalamount;
    }
   $posted = array();
   $posted = array(
       'key' => $MERCHANT_KEY,
       'txnid' => $txnid,
       'amount' => $totalamount,
       'firstname' => $studentprofile->name,
       'email' => $rolmodel->email,
       'productinfo' => 'IIT Indore',
       'surl' => 'https://epayments.iiti.ac.in/api/payment/status/',
       'furl' => 'https://epayments.iiti.ac.in/api/payment/subscribecancel/',
       'service_provider' => 'payu_paisa',
   );
//dd($posted);
   if(empty($posted['txnid'])) {
       $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
   }
   else
   {
       $txnid = $posted['txnid'];
   }
   $hash = '';
   $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
   if(empty($posted['hash']) && sizeof($posted) > 0) {
       $hashVarsSeq = explode('|', $hashSequence);
       $hash_string = '';
       foreach($hashVarsSeq as $hash_var) {
           $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
           $hash_string .= '|';
       }
       $hash_string .= $SALT;
       $hash = strtolower(hash('sha512', $hash_string));
       $action = $PAYU_BASE_URL . '/_payment';
   }
   elseif(!empty($posted['hash']))
   {
       $hash = $posted['hash'];
       $action = $PAYU_BASE_URL . '/_payment';
   }
?>
<html>
 <head>
 <script>
   var hash = '<?php echo $hash ?>';
   function submitPayuForm() {
     if(hash == '') {
       return;
     }
     var payuForm = document.forms.payuForm;
          payuForm.submit();
   }
 </script>
 </head>
 <?php //dd($txnid);?>
 <body onload="submitPayuForm()">
   Processing.....
       <form action="<?php echo $action; ?>" method="post" name="payuForm"><br />
           <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" /><br />
           <input type="hidden" name="hash" value="<?php echo $hash ?>"/><br />
           <input type="hidden" name="txnid" value="<?php echo $txnid ?>" /><br />
           <input type="hidden" name="amount" value="<?=$totalamount?>" /><br />
           <input type="hidden" name="firstname" id="firstname" value="<?=$studentprofile->name?>" /><br />
           <input type="hidden" name="email" id="email" value="<?=$rolmodel->email?>" /><br />
           <input type="hidden" name="productinfo" value="IIT Indore"><br />
           <input type="hidden" name="surl" value="https://epayments.iiti.ac.in/api/payment/status" /><br />
           <input type="hidden" name="furl" value="https://epayments.iiti.ac.in/api/payment/subscribecancel" /><br />
           <input type="hidden" name="service_provider" value="payu_paisa" /><br />
           <?php
           if(!$hash) { ?>
               <input type="submit" value="Submit" />
           <?php } ?>
       </form>
 </body>
</html>