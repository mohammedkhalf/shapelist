<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:v="urn:schemas-microsoft-com:vml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <meta name="viewport" content="width=600,initial-scale = 2.3,user-scalable=no">
    <!--<![if !mso]-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans|Fira+Sans+Condensed|Raleway" rel="stylesheet">
    <!--<![endif]-->

    <title>@yield('title', app_name())</title>

    <style type="text/css">
        body {
            width: 100%;
            margin: 0;
            padding: 0;
            mso-margin-top-alt: 0px;
            mso-margin-bottom-alt: 0px;
            mso-padding-alt: 0px 0px 0px 0px;
            -webkit-font-smoothing: antialiased;
            background-color: #D1CDCD;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%23a594c1' fill-opacity='0.4'%3E%3Cpath opacity='.5' d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9z'/%3E%3Cpath d='M6 5V0H5v5H0v1h5v94h1V6h94V5H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            font-family: 'Montserrat', sans-serif;
        }

        td{
            font-family: 'Montserrat', sans-serif;
        }

        span.preheader {
            display: none;
            font-size: 1px;
        }

        html {
            width: 100%;
        }

        table {
            font-size: 14px;
            border: 0;
            padding:10px;
            width: 100%;
        }

        .lap{
            color: #007bff;
            text-decoration: none;
            background-color: transparent;
        }

        .container{
            margin-top: 25px;
            margin-left: 25px;
            margin-right: 25px;
        }

        .main-header {
            color: #343434; 
            font-size: 24px; 
            font-weight:300; 
            line-height: 35px;
        }

        .main-header .brand {
            letter-spacing: 5px;
            font-size: 28px;
        }

        .main-header .tagline {
            font-size: 16px;
        }

        .small {
            font-size: 10px;
        }

        .center {
            text-align: center;
        }
        .fd-header{
                position: absolute;
                padding-top: 10px;
                top: 78px;
                left: 51px;
                width: 498px;
                height: 148px;
                /* UI Properties */
                background: #21A67D 0% 0% no-repeat padding-box;
                border-bottom: 1px solid #7070708c;
                border-radius: 25px 25px 0px 0px;
                opacity: 1;
        }
        .fd-email-body{
            position: absolute;
            padding-left: 45px;
            padding-top: 36px;
            font-size:10px
        }


        .fd-card{
                position: relative;
                top: 78px;
                left: 51px;
                width: 498px;
                height: 422px;
                /* UI Properties */
                background: #FFFFFF 0% 0% no-repeat padding-box;
                border: 1px solid #7070708c;
                border-radius: 25px;
                opacity: 1;
        }
        .fd-email-footer{
                width: 498px;
                clear: both;
        }
        .fd-welcome-text{
            position: absolute;
            text-align: left;
            letter-spacing: 0px;
            color: #FFFFFF;
            opacity: 1;
        }
        .fd-email-text{
            position: absolute;
            margin-left: auto;
            margin-right: auto;
            /* UI Properties */
            text-align: left;
            letter-spacing: 0px;
            color: #000000;
            opacity: 1;
        }
        .fd-button{
            position: absolute;
            left: 202px;
            width: 197px;
            height: 35px;
            background: #21A67D 0% 0% no-repeat padding-box;
            border: 1px solid #7070708c;
            border-radius: 50px;
            opacity: 1;
            font-size:11px;
            padding-top: 18px;
            margin-top: 42px;
            margin-left: 106px;
            margin-right: 73px;

        }
        .fd-email-image{
            position: absolute;
            margin-left: auto;
            margin-right: auto;
            margin-top: 5px;
            width: 60px;
            height: 60px;
            /* UI Properties */
            background: no-repeat url("https://i.ibb.co/gDB0K0J/Icon.png");
            opacity: 1;
        }

        .fd-email-message{
            
            /* top: 412px;
            left: 96px;
            width: 376px;
            height: 59px;
            opacity: 1; */
        }

        /* ----------- responsivity ----------- */

        @media only screen and (max-width: 640px) {
            /*------ top header ------ */
            .main-header {
                font-size: 20px !important;
            }
            .main-section-header {
                font-size: 28px !important;
            }
            .show {
                display: block !important;
            }
            .hide {
                display: none !important;
            }
            .align-center {
                text-align: center !important;
            }
            .no-bg {
                background: none !important;
            }
                 
            /* ====== divider ====== */
            .divider img {
                width: 440px !important;
            }
            /*-------- container --------*/
            .container590 {
                width: 440px !important;
            }
            .container580 {
                width: 400px !important;
            }
            .main-button {
                width: 220px !important;
            }
            
        }
        
        @media only screen and (max-width: 479px) {
            /*------ top header ------ */
            .main-header {
                font-size: 18px !important;

            }
            .main-section-header {
                font-size: 26px !important;
            }
            
            /*-------- container --------*/
            .container590 {
                width: 210px !important;
            }
            .container590 {
                width: 210px !important;
            }
            .container580 {
                width: 260px !important;
            }
        }
    </style>
</head>
<body class="respond" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="background-color:#D1CDCD">

    <div class="container">
        <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="D1CDCD" style="width:60%; margin: 0 auto;" class="bg_color">
            <tr>
                <td align="center">
                    <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                        <tr>
                        </tr>

                        <tr>
                            <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                        </tr>

                        <tr>
                            @yield('content')
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
            </tr>
        </table>
    </div>
    <!-- end section -->
</body>
</html>