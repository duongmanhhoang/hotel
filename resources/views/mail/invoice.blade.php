<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <style type="text/css">

        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }


        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        @media screen and (max-width: 480px) {
            .mobile-hide {
                display: none !important;
            }

            .mobile-center {
                text-align: center !important;
            }

            .align-center {
                max-width: initial !important;
            }

            h1 {
                display: inline-block;
                margin-right: auto !important;
                margin-left: auto !important;
            }
        }

        @media screen and (min-width: 480px) {
            .mw-50 {
                max-width: 50%;
            }
        }

        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

        :root {
            --purple: #5a3aa5;
            --pink: #b91bab;
            --blue: #2cbaef;
            --green: #23c467;
        }
    </style>
</head>

<body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">

<div
    style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Open Sans, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
    {{ __('label.Mail_booking') }}
</div>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:100%;">
                <tr>
                    <td align="center" height="6"
                        style="background-image: linear-gradient(to right, #b91bAb, #5a3aa5); background-color: #b91bAb;"
                        bgcolor="#b91bAb"></td>
                </tr>
            </table>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:800px;">
                <tr>
                    <td align="center" valign="top"
                        style="background-color: #ffffff; font-size:0; padding: 35px 35px 0;" bgcolor="#ffffff">
                        <div class="align-center"
                             style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
                            <table class="align-center" align="left" border="0" cellpadding="0" cellspacing="0"
                                   width="100%" style="max-width:800px;">
                                <tr>
                                    <td align="left" height="48" valign="center"
                                        style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size:48px; font-weight: 800; line-height: 48px;"
                                        class="mobile-center">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div
                            style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;"
                            class="mobile-hide">
                            <table align="right" border="0" cellpadding="0" cellspacing="0" width="100%"
                                   style="max-width:300px;">
                                <tr>

                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding: 0 15px 20px 15px; background-color: #ffffff;" bgcolor="#ffffff">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                               style="max-width:600px;">
                            <tr>
                                <td align="center"
                                    style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                                    <img src="http://getdrawings.com/free-icon/check-icon-55.png" width="125"
                                         height="120" style="display: block; border: 0px;"/><br>
                                    <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">
                                        {{ __('messages.thanks_booking') }}
                                    </h2>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"
                                    style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                                    <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777; padding: 0 30px;">
                                        {{ __('messages.mail_booking_messages') }}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="padding-top: 20px;">
                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <tr>
                                            <td width="75%" align="left" bgcolor="#eeeeee"
                                                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
                                                {{ __('label.Invoice_code') }}
                                            </td>
                                            <td width="25%" align="left" bgcolor="#eeeeee"
                                                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
                                                {{ $code }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="75%" align="left"
                                                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                                {{ __('label.Check_in') }}
                                            </td>
                                            <td width="25%" align="left"
                                                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 600; line-height: 24px; padding: 15px 10px 5px 10px;">
                                                {{ $checkIn }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="75%" align="left"
                                                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                                {{ __('label.Check_out') }}
                                            </td>
                                            <td width="25%" align="left"
                                                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 600; line-height: 24px; padding: 15px 10px 5px 10px;">
                                                {{ $checkOut }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="75%" align="left"
                                                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                                {{ __('label.Full_name') }}
                                            </td>
                                            <td width="25%" align="left"
                                                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 600; line-height: 24px; padding: 5px 10px;">
                                                {{ $customer_name }}
                                            </td>
                                        <tr>
                                            <td width="75%" align="left"
                                                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                                {{ __('label.Phone') }}
                                            </td>
                                            <td width="25%" align="left"
                                                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 600; line-height: 24px; padding: 5px 10px;">
                                                {{ $customer_phone }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="75%" align="left"
                                                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                                {{ __('label.Room_name') }}
                                            </td>
                                            <td width="25%" align="left"
                                                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 600; line-height: 24px; padding: 5px 10px;">
                                                {{ $roomName }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="75%" align="left"
                                                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                                {{ __('label.Room_number') }}
                                            </td>
                                            <td width="25%" align="left"
                                                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 600; line-height: 24px; padding: 5px 10px;">
                                                {{ $roomNumber }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="75%" align="left"
                                                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">
                                                {{ __('label.Price') }}
                                            </td>
                                            <td width="25%" align="left"
                                                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 600; line-height: 24px; padding: 5px 10px;">
                                                {{ $price }} {{ $currency }}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="padding-top: 20px;">
                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <tr>
                                            <td width="75%" align="left"
                                                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 2px solid #eeeeee; border-bottom: 2px solid #eeeeee;">
                                                {{ __('label.Total') }}
                                            </td>
                                            <td width="25%" align="left"
                                                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 2px solid #eeeeee; border-bottom: 2px solid #eeeeee;">
                                                {{ $total }} {{ $currency }}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding: 35px 35px 15px; background-color: #ffffff;" bgcolor="#ffffff">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                               style="max-width:600px;">
                            <tr>
                            </tr>
                            <tr>
                                <td align="center"
                                    style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 24px;">
                                    <p style="font-size: 14px; font-weight: 400; line-height: 20px; color: #666666; padding: 0 25px; max-width: 400px;">
                                        <span
                                            style="color: #888888; display: block; font-size: 90%; font-weight: 600; padding-top: 15px;">&copy; 2019 Atlantic. All rights reserved.</span>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>

</html>
