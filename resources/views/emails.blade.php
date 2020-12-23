<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Neopolitan Ping Email</title>
    <style type="text/css">
        @import url(http://fonts.googleapis.com/css?family=Droid+Sans);

        /* Take care of image borders and formatting */

        img {
            max-width: 600px;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        a {
            text-decoration: none;
            border: 0;
            outline: none;
            color: #bbbbbb;
        }

        a img {
            border: none;
        }

        /* General styling */

        td, h1, h2, h3  {
            font-family: Helvetica, Arial, sans-serif;
            font-weight: 400;
        }

        td {
            text-align: center;
        }

        body {
            -webkit-font-smoothing:antialiased;
            -webkit-text-size-adjust:none;
            width: 100%;
            height: 100%;
            color: #37302d;
            background: #ffffff;
            font-size: 16px;
        }

        table {
            border-collapse: collapse !important;
        }

        .headline {
            color: #ffffff;
            font-size: 36px;
        }

        .force-full-width {
            width: 100% !important;
        }

    </style>

    <style type="text/css" media="screen">
        @media screen {
            /*Thanks Outlook 2013! http://goo.gl/XLxpyl*/
            td, h1, h2, h3 {
                font-family: 'Droid Sans', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
            }
        }
    </style>

    <style type="text/css" media="only screen and (max-width: 480px)">
        /* Mobile styles */
        @media only screen and (max-width: 480px) {

            table[class="w320"] {
                width: 320px !important;
            }


        }
    </style>
</head>
<body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
<table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%" >
    <tr>
        <td align="center" valign="top" bgcolor="#ffffff"  width="100%">
            <center>
                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="600" class="w320">
                    <tr>
                        <td align="center" valign="top">

                            <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%" style="margin:0 auto;">
                                <tr>
                                    <td style="font-size: 30px; text-align:center;">
                                        <br>
                                        Notification
                                        <br>
                                        <br>
                                    </td>
                                </tr>
                            </table>

                            @if($user->status == 1 )
                            <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%" bgcolor="#4dbfbf">
                            @else
                                    <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%" bgcolor="#ff4d4d">
                            @endif
                                <tr>
                                    <td>
                                        <br>
                                        <img src="https://i.ibb.co/k9hcTCW/user-shape.png" width="216" height="189" alt="robot picture">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="headline">
                                        Hi {{ $user->name }}!
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @if($user->status == 0)
                                        <center>
                                            <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="60%">
                                                <tr>
                                                    <td style="color:#187272;">
                                                        <br>
                                                        Your account has been blocked by admin!
                                                        <br>
                                                        <br>
                                                        <br>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                        @else
                                        <center>
                                            <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="60%">
                                                <tr>
                                                    <td style="color:#187272;">
                                                        <br>
                                                        Your account has been unblocked by admin!
                                                        <br>
                                                        <br>
                                                        <br>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                        @endif
                                    </td>
                                </tr>
                            </table>

                            <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%" bgcolor="#f5774e">
                                <tr>
                                    <td>
                                        <br>
                                        <img src="https://www.filepicker.io/api/file/hkpp4OzbQme8bszfOs1k" width="113" height="100" alt="meter image">
                                    </td>
                                </tr>
                                <tr>
                                    <td>

                                        <center>
                                            <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="60%">
                                                <tr>
                                                    @if($user->status == 0)
                                                        <td style="color:#933f24;">
                                                            Thanks for was a customer!<br>
                                                            <br><br>
                                                        </td>
                                                    @else
                                                        <td style="color:#933f24;">
                                                            Thanks for using my service!<br>
                                                            <br><br>
                                                        </td>
                                                    @endif
                                                </tr>
                                            </table>
                                        </center>

                                    </td>
                                </tr>
                            </table>

                            <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#414141" style="margin: 0 auto">
                                <tr>
                                    <td style="background-color:#414141;">
                                        <br>
                                        <br>
                                        <img src="https://www.filepicker.io/api/file/R4VBTe2UQeGdAlM7KDc4" alt="google+">
                                        <img src="https://www.filepicker.io/api/file/cvmSPOdlRaWQZnKFnBGt" alt="facebook">
                                        <img src="https://www.filepicker.io/api/file/Gvu32apSQDqLMb40pvYe" alt="twitter">
                                        <br>
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#bbbbbb; font-size:12px;">
                                        <a href="http://socialloginnam.herokuapp.com/">View in browser</a> | <a href="#">Unsubscribe</a> | <a href="#">Contact</a>
                                        <br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#bbbbbb; font-size:12px;">
                                        © 2014 All Rights Reserved
                                        <br>
                                        <br>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </center>
        </td>
    </tr>
</table>
</body>
</html>
