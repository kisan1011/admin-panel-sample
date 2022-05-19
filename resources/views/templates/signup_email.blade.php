<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<html>
    <head>
        <style>
            .banner-color {
            background-color: #eb681f;
            }
            .title-color {
            color: #0066cc;
            }
            .button-color {
            background-color: #0066cc;
            }
            .table td, .table th {
                padding: .75rem;
                vertical-align: top;
                border-top: none !important ; 
            }
            @media screen and (min-width: 500px) {
                .banner-color {
                background-color: #0066cc;
                }
                .title-color {
                color: #eb681f;
                }
                .button-color {
                background-color: #eb681f;
                }
            } 
        </style>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css">
        <style type="text/css">
            p {
                font-weight:200;
                font-family:"Helvetica,Arial,sans-serif";
                color: rgb(76, 76, 76);
            }
        </style>
    </head>
    <body style="background-color:#ececec;">
        <div>
            <table class="table table-responsive" style="max-width:512px;margin: 0 auto !important;">
                <tbody>
                    <tr>
                        <td bgcolor="#F3F3F3" width="100%" style="background-color:#f3f3f3;padding:12px;border-bottom:1px solid #ececec">
                            <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;width:100%!important;font-family:Helvetica,Arial,sans-serif;min-width:100%!important" width="100%">
                                <tbody>
                                    <tr>
                                        <td align="left" valign="middle" width="50%"><span style="margin:0;color:#4c4c4c;white-space:normal;display:inline-block;text-decoration:none;font-size:12px;line-height:20px">{{\Config::get('app.name')}}</span></td>
                                        <td valign="middle" width="50%" align="right"><span style="margin:0;color:#4c4c4c;white-space:normal;display:inline-block;text-decoration:none;font-size:12px;line-height:20px"><?php echo date("l jS \of F Y ") ?></span></td>
                                        <td width="1">&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                <tbody>
                                    <tr>
                                        <td width="100%">
                                            <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td align="center" bgcolor="#8BC34A" style="padding:20px 48px;color:#ffffff" class="banner-color">
                                                            <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" width="100%">
                                                                            <h1 style="padding:0;margin:0;color:#ffffff;font-weight:500;font-size:20px;line-height:24px">{{\Config::get('app.name')}} App</h1>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="padding:20px 0 10px 0">
                                                            <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" width="100%" style="padding: 0 15px;text-align: justify;color: rgb(76, 76, 76);font-size: 12px;line-height: 18px;">
                                                                            <h3 style="font-weight: 600; padding: 0px; margin: 0px; font-size: 16px; line-height: 24px; text-align: center;" class="title-color">Hi {{$name}},</h3>
                                                                            <p style="margin: 20px 0 30px 0;font-size: 15px;text-align: center;">
                                                                                Congratulations! You’ve successfully registered in {{\Config::get('app.name')}} Application.
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="font-size: 15px;font-family:Helvetica,Arial,sans-serif;text-align: center;color: rgb(76, 76, 76);">
                                                                            <td>
                                                                                 <p>Click on the link below to verify your email address and get started.</p> <br>
                                                                                 
                                                                                 <a href ="{{$link}}" target="_blank" title="{{$link}}"><u>VERIFY YOUR ACCOUNT</u></a>
                                                                            </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            <table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0" style="padding:0 24px;color:#999999;font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                <tbody>
                                    <tr>
                                        <td align="center" width="100%">
                                            <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td align="center" valign="middle" width="100%" style="border-top:none;padding:12px 0px 20px 0px;text-align:center;color:#4c4c4c;font-weight:200;font-size:12px;line-height:18px">Regards,
                                                            <br><b>{{\Config::get('app.name')}} Support Team</b>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="100%">
                                            <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td align="center" style="padding:0 0 8px 0" width="100%"></td>
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
        </div>
    </body>
</html>

