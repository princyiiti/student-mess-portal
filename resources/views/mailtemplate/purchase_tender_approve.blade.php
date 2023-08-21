<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title></title>
    </head>

    <body style="font-family: sans-serif;color: #5a5a5a;">

        <table width="650" cellpadding="0" cellspacing="0" align="center" style="background-color: #f4f4f4;
               padding: 20px; font-family: sans-serif;">
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" align="center" width="100%">
                        <tr>

                            <td style="background-color: #fff; padding: 20px; border-radius: 0px 0px 5px 5px;
                                font-size: 14px;">
                                <div style="width: 100%;">
                                    <p style="color: #222; line-height: 20px; text-align: center;font-size: 24px;">
                                       Indian Institute of Technology Indore
                                    </p>

                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 30px; line-height: 30px">Dear Mr./Mrs. <b>{{$model->indent->name}}</b>
                                <br> A Purchase Indent has been filled by Indentor Name=><b> Mr./Mrs.{{$model->indentor->name}}</b> and He is Waiting for your Approving ,<br>
                                for further details Please visit <a href="http://erp.iiti.ac.in/">http://erp.iiti.ac.in/</a>
                                <div style="text-align: center; padding: 20px"> 
                                    <a class="button" style=" background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;" href="{{ url('/activationpurchaseindent/' . $model->active_code) }}">Click here for Approving </a>
                                    <a class="button" style=" background-color: #FF0000;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;" href="{{ url('/rejectionpurchaseindent/' . $model->active_code) }}">Click here for Rejection </a>
                                    
                                    </div> </td>
                        </tr><tr>
                            <td style="background-color: #fff; border-top: dashed thin #ccc; padding: 20px; font-size: 14px;
                                border-radius: 0px 0px 5px 5px;">
                                <h2 style="color: #4b4848; font-size: 16px;">
                                    Regards</p>
                                    <h2 style="color: #157abe; font-size: 16px;">
                                        IIT Indore<br><br>
                                      


                                    </h2>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 15px; font-size: 12px; color: #666; line-height: 20px; border-radius: 5px 5px 0px 0px;">
                    Please do not reply to this e-mail. For further assistance, please contact us at njadhav@iiti.ac.in
                </td>
            </tr>
        </table>

    </body>
</html>
