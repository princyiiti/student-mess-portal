<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Reciept!</title>
<style>
@page    {
  margin: 3px;
   size: A4;

/*    margin: 07mm 16mm 27mm 00mm;*/
}

</style>
<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .table-borderless > tbody > tr > td,
.table-borderless > tbody > tr > th,
.table-borderless > tfoot > tr > td,
.table-borderless > tfoot > tr > th,
.table-borderless > thead > tr > td,
.table-borderless > thead > tr > th {
    border: none;
}
<style type="text/css">
    .ritz .waffle a {
        color: inherit;
    }
    .ritz .waffle {
        border-left: 2px SOLID #000000;
    }

    .ritz .waffle .s8 {
        border-bottom: 2px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #bfbfbf;
        text-align: left;
        font-weight: bold;
        font-style: italic;
        text-decoration: underline;
        -webkit-text-decoration-skip: none;
        text-decoration-skip-ink: none;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s20 {
        border-bottom: 2px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s25 {
        border-bottom: 2px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #bfbfbf;
        text-align: right;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s1 {
        border-bottom: 2px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
        font-size: 14pt;
        vertical-align: middle;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s10 {
        border-bottom: 2px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s15 {
        border-bottom: 2px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s30 {
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s9 {
        border-bottom: 2px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s2 {
        border-bottom: 2px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #bfbfbf;
        text-align: center;
        font-weight: bold;
        font-style: italic;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
        font-size: 14pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s12 {
        border-bottom: 2px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #bfbfbf;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s17 {
        border-bottom: 2px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #bfbfbf;
        text-align: right;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s33 {
        border-bottom: 2px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
        font-size: 9pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s14 {
        border-bottom: 1px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s5 {
        border-bottom: 2px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s21 {
        border-bottom: 1px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s22 {
        border-bottom: 1px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s23 {
        border-bottom: 1px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: right;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s11 {
        border-bottom: 2px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #bfbfbf;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
        font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s6 {
        border-bottom: 2px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s19 {
        border-bottom: 2px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: normal;
        overflow: hidden;
        word-wrap: break-word;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s24 {
        border-bottom: 2px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: right;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s31 {
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s26 {
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        text-decoration: underline;
        -webkit-text-decoration-skip: none;
        text-decoration-skip-ink: none;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s29 {
        background-color: #ffffff;
        text-align: left;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s4 {
        border-bottom: 1px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s18 {
        border-bottom: 2px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #bfbfbf;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s13 {
        border-bottom: 1px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s16 {
        border-bottom: 2px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
    }

    .ritz .waffle .s0 {
        border-bottom: 1px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #ffffff;
        text-align: center;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
        font-size: 15pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
        border-top: 2px solid black;
       
    }

    .ritz .waffle .s3 {
        border-bottom: 1px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
       
    }

    .ritz .waffle .s7 {
        border-bottom: 2px SOLID #000000;
        border-right: 2px SOLID #000000;
        background-color: #bfbfbf;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
        
    }

    .ritz .waffle .s32 {
        border-bottom: 2px SOLID #000000;
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
        font-size: 9pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
        
    }

    .ritz .waffle .s27 {
        border-right: 1px SOLID #000000;
        background-color: #ffffff;
        text-align: left;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
        
    }

    .ritz .waffle .s28 {
        background-color: #ffffff;
        text-align: left;
        font-weight: bold;
        color: #000000;
        font-family: 'docs-Quattrocento Sans', Arial;
         font-size: 10pt;
        vertical-align: middle;
        white-space: nowrap;
        direction: ltr;
         padding: 0px 3px 0px -1px;
        
    }

</style>

</head>
<body>


    <div class="ritz grid-container"  dir="ltr">
    <table class="waffle" style="width:90%"  cellspacing="0" cellpadding="0">
        <tbody>
            <tr style="height: 23px">
                <td>
                    <div style="height: 135px;width: 180px;border-bottom: 1px solid black;border-top: 1px solid black;">
                <img src="<?php echo e(asset('/iit_image.png')); ?>" height="100%" width="100%"  />
                </div>
                </td>
            
                <td class="s0" colspan="6"> INDIAN INSTITUTE OF TECHNOLOGY INDORE</td>

            </tr>
            <tr style="height: 23px">
                   <td class="s1" colspan="6"> Khandwa Road, Simrol, Indore 453552</td>
              
            </tr>
            <tr style="height: 27px">
             
                <td class="s2" colspan="6">FEE RECEIPT ( <?php echo e($totalamount->academic_tearm); ?> <?php echo e($totalamount->academic_year); ?>)</td>
            </tr>
            <tr style="height: 21px">
               
                <td class="s3">RECEIPT NO.</td>
                <td class="s4"><?php echo e($totalamount->rollno); ?></td>
                <td class="s3" colspan="2">DATE</td>
                <td class="s4" colspan="2"><?php echo e(now()->format('d-m-Y')); ?></td>
            </tr>
            <tr style="height: 22px">
              
                <td class="s5">ROLL NO.</td>
                <td class="s6"><?php echo e($totalamount->rollno); ?></td>
                <td class="s5" colspan="2">COURSE</td>
                <td class="s6" colspan="2"><?php echo e($totalamount->program); ?></td>
            </tr>
            <tr style="height: 32px">
              
                <td class="s7">NAME</td>
                <td class="s8" colspan="5"><?php echo e($totalamount->student_name); ?></td>
            </tr>
            <tr style="height: 23px">
                
                <td class="s9">CATEGORY</td>
                <td class="s9"><?php echo e($totalamount->category); ?></td>
                <td class="s10" colspan="2">DEPARTMENT</td>
                <td class="s10" colspan="2"><?php echo e($studentprofile->dept); ?></td>
            </tr>
            <tr style="height: 19px">
               
                <td class="s11">SR.NO.</td>
                <td class="s11" colspan="3">PARTICULARS</td>
                <td class="s12" colspan="2">AMOUNT (<span
                        style="font-size:10pt;font-family:Rupee Foradian,Arial;font-weight:bold;color:#000000;">`</span><span
                        style="font-size:10pt;font-family:Segoe UI,Arial;font-weight:bold;color:#000000;">)</span></td>
            </tr>
            <?php $__currentLoopData = $totalamount->Feestructuredata->FeeDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr style="height: 21px">
               
                <td class="s4"><?php echo e($index +1); ?></td>
                <td class="s13" colspan="3"><?php echo e($list->fee_type); ?></td>
                <td class="s14" colspan="2"><?php echo e($list->amount); ?> </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            <tr style="height: 22px">
               
                <td class="s17" colspan="4">TOTAL</td>
                <td class="s18" colspan="2"> <?php echo e($totalamount->totalamount); ?> </td>
            </tr>
            <?php if($totalamount->remission_amount!=''): ?>
            <tr style="height: 21px">
               
                <td class="s13" colspan="4">Less: Remission 
                    <?php if($totalamount->remissiontype=='1/3'): ?>
                2/3 
                <?php else: ?>
                 <?php echo e($totalamount->remissiontype); ?>

                 <?php endif; ?>
            Tuition Fee </td>
                <td class="s14" colspan="2"><?php echo e($totalamount->remission_amount); ?> </td>
            </tr>
            <?php endif; ?>
            <tr style="height: 22px">
              
                <td class="s15" colspan="4">TOTAL FEE RECEIVABLE</td>
                  <?php if($totalamount->remission_amount!=''): ?>
                <td class="s16" colspan="2"> <?php echo e($totalamount->totalamount-$totalamount->remission_amount); ?> </td>
                <?php else: ?>
                <td class="s16" colspan="2"> <?php echo e($totalamount->totalamount); ?> </td>
                <?php endif; ?>
              
            </tr>
            <tr style="height: 22px">
              
                <td class="s17" colspan="4">FEE RECEIVED</td>
                  <?php if($totalamount->remission_amount!=''): ?>
                <td class="s18" colspan="2"> <?php echo e($totalamount->totalamount-$totalamount->remission_amount); ?> </td>
                <?php else: ?>
                 <td class="s18" colspan="2"> <?php echo e($totalamount->totalamount); ?> </td>
                 <?php endif; ?>
            </tr>
            <tr style="height: 44px">
               
                <td class="s19">AMOUNT IN WORDS (<span
                        style="font-size:11pt;font-family:Rupee Foradian,Arial;color:#000000;">`</span><span
                        style="font-size:11pt;font-family:Segoe UI,Arial;color:#000000;">):-</span></td>
                <td class="s20" colspan="5"><?php echo e($word); ?></td>
            </tr>
            <tr style="height: 22px">
                
                <td class="s18" colspan="6">DETAILS OF FEES RECEIVED</td>
            </tr>
            <tr style="height: 38px">
                
                <td class="s21">DD/REFERENCE NO.</td>
                <td class="s22"><?php echo e($totalamount->transaction_id); ?></td>
                <td class="s13" colspan="2">DD/TRANSACTION DATE</td>
                <td class="s23" colspan="2"><?php echo e($totalamount->paid_date); ?></td>
            </tr>
            <tr style="height: 21px">
                
                <td class="s13">BANK NAME</td>
                <td class="s22"> CANARA </td>
                <td class="s15" colspan="2" rowspan="2">AMOUNT (Rs)</td>
                <?php if($totalamount->remission_amount!=''): ?>
                <td class="s24" colspan="2" rowspan="2"> <?php echo e($totalamount->totalamount-$totalamount->remission_amount); ?></td>
                <?php else: ?>
                 <td class="s24" colspan="2" rowspan="2"> <?php echo e($totalamount->totalamount); ?></td>
                 <?php endif; ?>
            </tr>
            <tr style="height: 22px">
               
                <td class="s15">MODE OF PAYMENT</td>
                <td class="s6"> PAYU </td>
            </tr>
            <tr style="height: 22px">
               
                <td class="s17" colspan="4">NET RECEIVABLE/(PAYABLE) Rs.</td>
                <td class="s25" colspan="2"> - </td>
            </tr>
            
            <tr style="height: 66px">
               
                <td class="s32" colspan="2">*DD /cheque/SB-collect subject to realization/confirmation.</td>
                <td class="s33" colspan="4">Receiver&#39;s signature with office seal</td>
            </tr>
              

        </tbody>
    </table>
    This is computer generated recipet, no signature is required.
</div>

</body>
</html>