<!DOCTYPE html>
<html>

<head>
    <title>Rebate Approval</title>
</head>

<body>
    <div>
        <h2>
            <!-- © 2018 Shift Technologies. All rights reserved. -->
            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                style="table-layout:fixed;background-color:#f9f9f9" id="bodyTable">
                <tbody>
                    <tr>
                        <td style="padding-right:10px;padding-left:10px;" align="center" valign="top" id="bodyCell">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="wrapperBody"
                                style="max-width:600px">
                                <tbody>
                                    <tr>
                                        <td align="center" valign="top">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                                class="tableCard"
                                                style="background-color:#fff;border-color:#e5e5e5;border-style:solid;border-width:0 1px 1px 1px;">
                                                <tbody>
                                                    <tr>
                                                        <td style="background-color:#00d2f4;font-size:1px;line-height:3px"
                                                            class="topBorder" height="3">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;"
                                                            align="center" valign="top" class="mainTitle">
                                                            <h2 class="text"
                                                                style="color:#000;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:28px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;text-align:center;padding:0;margin:0">
                                                                <?php echo e($data->name); ?></h2>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-bottom: 30px; padding-left: 20px; padding-right: 20px;"
                                                            align="center" valign="top" class="subTitle">
                                                            <h4 class="text"
                                                                style="color:#999;font-family:Poppins,Helvetica,Arial,sans-serif;font-size:16px;font-weight:500;font-style:normal;letter-spacing:normal;line-height:24px;text-transform:none;text-align:center;padding:0;margin:0">
                                                                Your Rebate Request Has Been <?php if($Rebate->status == 1): ?> Approved! <?php else: ?> Reject <?php endif; ?></h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table
                                                                style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; mso-table-lspace:0pt; mso-table-rspace:0pt; border-collapse:collapse !important">
                                                                <tbody>
                                                                    <tr>
                                                                        <td
                                                                            style="-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; mso-table-lspace:0pt; mso-table-rspace:0pt; padding:10px 25px">
                                                                            
                                                                            <p
                                                                                style="margin-bottom: 1em; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%">
                                                                                Here are the details of rebate:</p>
                                                                            <ul>
                                                                                <li style="font-size: smaller;font-weight: 400;">
                                                                                    Rebate From Date:  &nbsp;&nbsp; <?php echo e($Rebate->from_date); ?></li>
                                                                                <li
                                                                                style="font-size: smaller;font-weight: 400;">
                                                                                    Rebate End Date &nbsp;&nbsp; <?php echo e($Rebate->to_date); ?>

                                                                                </li>
                                                                                <li
                                                                                style="font-size: smaller;font-weight: 400;">
                                                                                    Total Days &nbsp;&nbsp; <?php echo e($Rebate->total_rebate_day); ?></li>
                                                                                    <li
                                                                                style="font-size: smaller;font-weight: 400;">
                                                                                Caterer Name &nbsp;&nbsp; <?php echo e($Rebate->mess_name); ?></li>
                                                                                    <li
                                                                                style="font-size: smaller;font-weight: 400;">
                                                                                    Status &nbsp;&nbsp; 
                                                                                    <?php if($Rebate->status == 1): ?>

                                                                                    <span style="color: green;font-weight: 700;"> Approved</span>
                                                                                    <?php else: ?>
                                                                                    <span style="color: red;font-weight: 700;"> Rejected</span>
                                                                                    <?php endif; ?>
                                                                                
                                                                                </li>
                                                                            </ul>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-left:20px;padding-right:20px" align="center"
                                                            valign="top" class="containtTable ui-sortable">
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                width="100%" class="tableDescription" style="">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="padding-bottom: 20px;" align="center"
                                                                            valign="top" class="description">
                                                                            <p class="text"
                                                                                style="color:#666;font-family:'Open Sans',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:22px;text-transform:none;text-align:center;padding:0;margin:0">
                                                                                If you have any questions or need further assistance, please  contact to the Student Affairs.</p>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size:1px;line-height:1px" height="20">&nbsp;
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                                class="space">
                                                <tbody>
                                                    <tr>
                                                        <td style="font-size:1px;line-height:1px" height="30">&nbsp;
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h2>
    </div>
</body>

</html>