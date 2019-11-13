
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta name="x-apple-disable-message-reformatting" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="https://growth.lyft.com.s3.amazonaws.com/lyft%20favicon.ico" type="image/gif" sizes="32x32">
  <title>Atlantic</title>
  <style type="text/css">
    @import url(http://lyft-assets.s3.amazonaws.com/font/Lyft%20Pro/LyftPro-Bold.otf);
    @font-face {
      font-family: 'LyftPro-Bold';
      src: url(https://lyft-assets.s3.amazonaws.com/font/Lyft%20Pro/LyftPro-Bold.otf) format("opentype");
      font-weight: bold;
      font-style: normal;
    }

    @import url(http://lyft-assets.s3.amazonaws.com/font/Lyft%20Pro/LyftPro-Regular.otf);
    @font-face {
      font-family: 'LyftPro-Regular';
      src: url(https://lyft-assets.s3.amazonaws.com/font/Lyft%20Pro/LyftPro-Regular.otf) format("opentype");
      font-weight: normal;
      font-style: normal;
    }

    @import url(https://lyft-assets.s3.amazonaws.com/font/Lyft%20Pro/LyftPro-SemiBold.otf);
    @font-face {
      font-family: 'LyftPro-SemiBold';
      src: url(https://lyft-assets.s3.amazonaws.com/font/Lyft%20Pro/LyftPro-SemiBold.otf) format("opentype");
      font-weight: normal;
      font-style: normal;
    }

    body {
      width: 100%;
      background-color: #FFFFFF;
      margin: 0;
      padding: 0;
      -webkit-font-smoothing: antialiased;
      font-family: 'Open Sans', Arial, sans-serif;
    }

    table {
      border-collapse: collapse;
    }

    img {
      border: 0;
      outline: none !important;
    }

    .hideDesktop {
      display: none;
    }
    .cta-shadow {
      padding: 14px 35px;
      -webkit-box-shadow: 0px 5px 0px rgba(0, 0, 0, 0.2);
      -moz-box-shadow: 0px 5px 0px rgba(0, 0, 0, 0.2);
      box-shadow: 0px 5px 0px rgba(0, 0, 0, 0.2);
      -moz-border-radius: 25px;
      -webkit-border-radius: 25px;
      font-size: 16px;
      font-weight: normal;
      letter-spacing: 0px;
      text-decoration: none;
      display: block;
    }

    body[yahoo] .hideDeviceDesktop {
      display: none;
    }

    @media only screen and (max-width: 640px) {

      div[class=mobilecontent] {
        display: block !important;
        max-height: none !important;
      }

      body[yahoo] .fullScreen {
        width: 100% !important;
        padding: 0px;
        height: auto;
      }

      body[yahoo] .halfScreen {
        width: 50% !important;
        padding: 0px;
        height: auto;
      }

      body[yahoo] .mobileView {
        width: 100% !important;
        padding: 0 4px;
        height: auto;
      }

      body[yahoo] .center {
        text-align: center !important;
        height: auto;
      }

      body[yahoo] .hideDevice {
        display: none;
      }

      body[yahoo] .hideDevice640 {
        display: none;
      }

      body[yahoo] .showDevice {
        display: table-cell !important;
      }

      body[yahoo] .showDevice640 {
        display: table !important;
      }


      body[yahoo] .googleCenter {
        margin: 0 auto;
      }

      .mobile-LR-padding-reset {
        padding-left: 0 !important;
        padding-right: 0 !important;
      }
      .side-padding-mobile {
        padding-left: 40px;
        padding-right: 40px;
      }
      .RF-padding-mobile {
        padding-top: 0 !important;
        padding-bottom: 25px !important;
      }
      .wrapper {
        width: 100% !important;
      }
      .two-col-above {
        display: table-header-group;
      }
      .two-col-below {
        display: table-footer-group;
      }
      .hideDesktop {
        display: block !important;
      }
    }

    @media only screen and (max-width: 520px) {
      .mobileHeader {
        font-size: 50px !important;
      }
      .mobileBody {
        font-size: 16px !important;
      }
      .mobileSubheader {
        font-size: 30px !important;
      }
    }

    @media only screen and (max-width: 479px) {

      body[yahoo] .fullScreen {
        width: 100% !important;
        padding: 0px;
        height: auto;
      }

      body[yahoo] .mobileView {
        width: 100% !important;
        padding: 0 4px;
        height: auto;
      }

      body[yahoo] .center {
        text-align: center !important;
        height: auto;
      }

      body[yahoo] .hideDevice {
        display: none;
      }

      body[yahoo] .hideDevice479 {
        display: none;
      }

      body[yahoo] .showDevice {
        display: table-cell !important;
      }

      body[yahoo] .showDevice479 {
        display: table !important;
      }

      .mobile-LR-padding-reset {
        padding-left: 0 !important;
        padding-right: 0 !important;
      }
      .side-padding-mobile {
        padding-left: 40px;
        padding-right: 40px;
      }
      .RF-padding-mobile {
        padding-top: 0 !important;
        padding-bottom: 25px !important;
      }
      .wrapper {
        width: 100% !important;
      }
      .two-col-above {
        display: table-header-group;
      }
      .two-col-below {
        display: table-footer-group;
      }
      .mobileButton {
        width: 150px !important !
      }

    }

    @media only screen and (max-width: 385px) {
      .mobileHeaderSmall {
        font-size: 18px !important;
        padding-right: none;
      }
      .mobileBodySmall {
        font-size: 14px !important;
        padding-right: none;
      }
    }


    a[x-apple-data-detectors] {

      color: inherit !important;

      text-decoration: none !important;

      font-size: inherit !important;

      font-family: inherit !important;

      font-weight: inherit !important;

      line-height: inherit !important;

    }

    a[href^="x-apple-data-detectors:"] {
      color: inherit;
      text-decoration: inherit;
    }

    .footerLinks {
      text-decoration: none;
      color: #384049;
      font-family: 'LyftPro-Regular', 'Helvetica Neue', Helvetica, Arial, sans-serif;
      font-size: 12px;
      line-height: 18px;
      font-weight: normal;
    }

    .roundButton {
      border-radius: 5px;
    }

    .contact a {
      color: #88888f !important !;
      text-decoration: none;
    }

    u+#body a {
      color: inherit;
      text-decoration: none;
      font-size: inherit;
      font-family: inherit;
      font-weight: inherit;
      line-height: inherit;
    }
  </style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: 'Open Sans', Arial, sans-serif;" align="center" id="body">
  <custom type="content" name="ampscript">
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td align="center" bgcolor="#f3f3f5" valign="top" width="100%">
          <table align="center" border="0" cellpadding="0" cellspacing="0" class="mobileView" width="600" style="">
            <tr>
              <td align="center" bgcolor="#FFFFFF" style="padding:0px;" width="100%">

                <table align="center" bgcolor="" border="0" cellpadding="0" cellspacing="0" class="fullScreen" style="width:100% !important;background-color:#625a9c;" width="600">
                  <tr>
                    <td bgcolor="#FFD6E5" class="" style="width:100% !important; padding: 0;background-color:#ffffff;">
                      <table cellspacing="0" cellpadding="0" align="center" border="0" width="100%" bgcolor="#F3F3F5">
                        <tr>
                          <td class="divider" align="center" height="16px" style="background-color: #F3F3F5;">
                          </td>
                        </tr>
                      </table>
                      <table cellspacing="0" cellpadding="0" align="center" border="0" width="100%" bgcolor="#F3F3F5">
                        <tr>
                          <td align="center" height="25px" style="background-color: #FFFFFF;">
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                <table align="center" bgcolor="" border="0" cellpadding="0" cellspacing="0" class="fullScreen" style="width:100% !important;" width="600">
                  <tr>
                    <td bgcolor="" class="" style="width:100% !important; padding: 0;">
                      <custom type="content" name="hero_image">
                        <table cellspacing="0" cellpadding="0" align="left" border="0" width="100%" bgcolor="#ffffff">
                          <tr>
                            <td valign="top" align="center" width="100%" style="padding-right: 25px; padding-left: 25px;">
                              <img width="100%" style="max-width: 600px; height: auto" src="https://s3.amazonaws.com/growth.lyft.com/Business/Images/Hero%20Images/Verifyemail_hero%402x.png" alt="Lyft business profile" />
                            </td>
                          </tr>
                        </table>
                        <table cellspacing="0" cellpadding="0" align="center" border="0" width="100%" bgcolor="#F3F3F5">
                          <tr>
                            <td align="center" height="25px" style="background-color: #FFFFFF;">
                            </td>
                          </tr>
                        </table>

                        <table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" style="max-width: 600px;">
                          <tr>
                            <td style="font-family: 'LyftPro-Bold', Arial, Helvetica, sans-serif; font-size: 14px; line-height: 1.0; color: #000000; font-weight: bolder; text-transform: uppercase; padding: 25px 25px 5px 25px;" class="mso-line-solid">
                              HI {{ $fullName }} ! CÒN 1 BƯỚC CUỐI CÙNG ĐỂ LÀ THÀNH VIÊN CỦA ATLANTIC!
                            </td>
                          </tr>
                          <tr>
                            <td style="font-family: 'LyftPro-Bold', Arial, Helvetica, sans-serif; font-size: 52px; line-height: 1.0; color: #000000; font-weight: bolder; padding: 0 25px 15px 25px;" class="mso-line-solid mobile-headline">
                              Xác minh địa chỉ email của bạn!
                            </td>
                          </tr>
                          <tr>
                            <td style="font-family: 'LyftPro-Regular', Arial, Helvetica, sans-serif; font-size: 18px; line-height: 1.4; color: #000000; padding: 0 25px 50px 25px;">
                             Để hoàn thành hồ sơ của bạn và bắt đầu thực hiện các chức năng với Atlantic, bạn sẽ cần xác minh địa chỉ email của mình.
                            </td>
                          </tr>
                          <tr>
                            <td align="center" style="padding: 0 25px 30px 25px; background-color: #ffffff;">
                              <table align="center" cellpadding="0" cellspacing="0" border="0" class="full-width">
                                <tr>
                                  <td class="cta-shadow" align="center" bgcolor="#FF00BF" style="border-radius: 40px; -webkit-border-radius: 40px; -moz-border-radius: 40px;">
                                    <a href="http://localhost/hotel/public/user/active?token={{$activeToken}}" target="_blank" style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 1.0; font-weight: bold; color: #ffffff; text-transform: uppercase; text-decoration: none; border-radius: 30px; -webkit-border-radius: 30px; -moz-border-radius: 30px; display: block; padding: 12px 25px 12px 25px;">
                                                VERIFY
                                            </a>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
      <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script></body>

</html>