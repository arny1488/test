<!DOCTYPE html
        PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>HTML Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet"/>
    {literal}
        <style type="text/css">
            * {
                box-sizing: border-box;
            }

            body {
                width: 100% !important;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
                margin: 0;
                padding: 0;
                line-height: 100%;
            }

            [style*="Open Sans"] {
                font-family: 'Open Sans', sans-serif !important;
            }

            img {
                outline: none;
                text-decoration: none;
                border: none;
                -ms-interpolation-mode: bicubic;
                max-width: 100% !important;
                margin: 0;
                padding: 0;
                display: block;
            }

            table td {
                border-collapse: collapse;
            }

            table {
                border-collapse: collapse;
                mso-table-lspace: 0;
                mso-table-rspace: 0;
            }

            p {
                margin: 0;
            }

            .main-title {
                font-size: 24px;
                font-weight: bold;
                line-height: 1.3;
                margin-top: 35px;
                margin-bottom: 25px;
            }

            .main-text {
                font-size: 18px;
                line-height: 1.6;
            }

            .main-link {
                display: block;
                margin-top: 25px;
                margin-bottom: 25px;
                font-size: 18px;
                color: #8A88FF;
                text-decoration: none;
                transition: .5s;
            }

            .main-link:hover {
                color: #272724;
            }

            .main-link-wrapper a {
                color: #8A88FF;
            }

            .main-unsubscribe {
                display: block;
                padding: 20px;
                background-color: #8A88FF;
                font-size: 14px;
                font-weight: 600;
                color: #ffffff;
                text-decoration: none;
                transition: .5s;
            }

            .main-unsubscribe:hover {
                background-color: #272724;
            }

            .main-unsubscribe-wrapper a {
                color: #ffffff;
            }

            .main-code {
                box-shadow: 0 0 7px 0 rgba(32, 32, 37, 0.3);
                border-top: 1px solid #e3e3e3;
                border-bottom: 1px solid #e3e3e3;
                border-left: 1px solid #e3e3e3;
                border-right: 1px solid #e3e3e3;
                margin-top: 35px;
                margin-bottom: 15px;
            }

            .main-code-left {
                width: 45%;
                padding-top: 40px;
                padding-bottom: 40px;
                padding-left: 70px;
            }

            .main-code-title {
                font-size: 18px;
                font-weight: bold;
            }

            .main-code-right {
                width: 55%;
                padding: 25px 70px 25px 10px;
            }

            .main-code-value {
                background-color: #f4f4f4;
                padding: 10px;
                border-top: 1px solid #e3e3e3;
                border-right: 1px solid #e3e3e3;
                border-bottom: 1px solid #e3e3e3;
                border-left: 1px solid #e3e3e3;
                font-size: 18px;
            }

            .main-bottom-text {
                font-size: 14px;
                color: #8f8f8f;
                margin-bottom: 20px;
            }

            .main-bottom-text a {
                color: #8A88FF;
                text-decoration: none;
                transition: .5s;
            }

            .main-bottom-text a:hover {
                color: #272724;
            }

            .footer {
                background-color: #272724;
            }

            .footer-wrap {
                padding-top: 20px;
                padding-bottom: 20px;
            }

            .footer-phone {
                margin-bottom: 20px;
            }

            .footer-phone a {
                margin-left: 10px;
                font-size: 14px;
                color: #ffffff;
                text-decoration: none;
            }

            .footer-address {
                margin-bottom: 20px;
            }

            .footer-address p {
                margin-left: 10px;
                font-size: 14px;
                color: #ffffff;
            }

            .footer-email a {
                margin-left: 10px;
                font-size: 14px;
                color: #ffffff;
                text-decoration: none;
            }

            @media (max-width: 1020px) {
                .container-1000 {
                    width: 800px !important;
                }
            }

            @media (max-width: 820px) {
                .container-1000 {
                    width: 100% !important;
                }
            }

            @media (max-width: 620px) {
                .container-600 {
                    width: 400px !important;
                }

                .main-title {
                    font-size: 22px;
                }

                .main-code td {
                    display: block;
                }

                .main-code-left {
                    width: 100%;
                    padding: 20px 20px 15px;
                }

                .main-code-right {
                    width: 100%;
                    padding: 0 20px 25px;
                }
            }

            @media (max-width: 460px) {
                .container-600 {
                    width: 290px !important;
                }

                .main-title {
                    margin-top: 25px;
                    margin-bottom: 15px;
                    font-size: 16px;
                }

                .main-text {
                    font-size: 16px;
                }

                .main-link {
                    margin-top: 10px;
                    margin-bottom: 15px;
                    font-size: 14px;
                }

                .main-bottom-text {
                    text-align: center;
                    line-height: 1.6;
                }

                .main-bottom-text a {
                    display: block;
                }

                .footer-phone {
                    margin-bottom: 15px;
                }

                .footer-address {
                    margin-bottom: 15px;
                }
            }
        </style>
    {/literal}
</head>

<body style="margin: 0; padding: 0;">
<table cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff">
    <tr>
        <td>
            <table class="main container-1000" cellpadding="0" cellspacing="0" width="1000" bgcolor="#ffffff" align="center">
                <tr>
                    <td height="30" width="1000"></td>
                </tr>
                <tr>
                    <td>
                        <table class="container-600" cellpadding="0" cellspacing="0" width="600" bgcolor="#ffffff" align="center">
                            <tr>
                                <td>
                                    <p class="main-title" style="font-family: Arial, sans-serif, 'Open Sans';">{#login_reset_mail_title#}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="main-text" style="font-family: Arial, sans-serif, 'Open Sans';">{#login_reset_mail_body_1#} {$ip}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="main-text" style="font-family: Arial, sans-serif, 'Open Sans';">{#login_reset_mail_body_2#}</p>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" class="main-link-wrapper">
                                    <a href="{$link}" class="main-link" style="font-family: Arial, sans-serif, 'Open Sans';">{#login_reset_mail_link_text#}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="main-text" style="font-family: Arial, sans-serif, 'Open Sans';">{#login_reset_mail_body_3#} {$expired}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="main-title" style="font-family: Arial, sans-serif, 'Open Sans';">{#login_reset_mail_body_4#}</p>
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
