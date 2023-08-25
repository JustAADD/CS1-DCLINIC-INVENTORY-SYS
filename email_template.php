<!DOCTYPE html>
<html>

<head>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
  <style>
    .rollover:hover .rollover-first {
      max-height: 0px !important;
      display: none !important;
    }

    .rollover:hover .rollover-second {
      max-height: none !important;
      display: inline-block !important;
    }

    .rollover div {
      font-size: 0px;
    }

    @media only screen and (max-width: 3000px) {
      .rollover-amp>div {
        font-size: 0;
        margin-top: -1px;
        position: absolute;
      }

      .rollover-amp:hover .rollover-first+div {
        position: relative;
      }

      .rollover-amp:hover amp-img.rollover-first,
      .rollover-amp amp-img.rollover-first+div,
      .rollover-amp:hover amp-img.rollover-first *,
      .rollover-amp amp-img.rollover-first+div * {
        height: 1px;
        width: 1px;
        opacity: 0;
      }

      .rollover-amp:hover amp-img.rollover-first {
        max-height: 0;
      }

      .rollover-amp:hover amp-img.rollover-first+div,
      .rollover-amp amp-img.rollover-first+div * {
        width: 100%;
        height: auto;
        opacity: 1;
      }
    }

    u~div img+div>div {
      display: none;
    }

    #outlook a {
      padding: 0;
    }

    span.MsoHyperlink,
    span.MsoHyperlinkFollowed {
      color: inherit;
      mso-style-priority: 99;
    }

    a.es-button {
      mso-style-priority: 100 !important;
      text-decoration: none !important;
    }

    a[x-apple-data-detectors] {
      color: inherit !important;
      text-decoration: none !important;
      font-size: inherit !important;
      font-family: inherit !important;
      font-weight: inherit !important;
      line-height: inherit !important;
    }

    .es-desk-hidden {
      display: none;
      float: left;
      overflow: hidden;
      width: 0;
      max-height: 0;
      line-height: 0;
      mso-hide: all;
    }

    .es-header-body a:hover {
      color: #f8f9fb !important;
    }

    .es-content-body a:hover {
      color: #001523 !important;
    }

    .es-footer-body a:hover {
      color: #f8f9fb !important;
    }

    .es-infoblock a:hover {
      color: #cccccc !important;
    }

    .es-button-border:hover>a.es-button {
      color: #ffffff !important;
    }

    /*
    END OF IMPORTANT
  */
    body {
      width: 100%;
      height: 100%;
    }

    table {
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
      border-collapse: collapse;
      border-spacing: 0px;
    }

    table td,
    body,
    .es-wrapper {
      padding: 0;
      Margin: 0;
    }

    .es-content,
    .es-header,
    .es-footer {
      width: 100%;
      table-layout: fixed !important;
    }

    img {
      display: block;
      font-size: 16px;
      border: 0;
      outline: none;
      text-decoration: none;
    }

    p,
    hr {
      Margin: 0;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      Margin: 0;
      font-family: 'Josefin Sans', helvetica, arial, sans-serif;
      mso-line-height-rule: exactly;
      letter-spacing: 0;
    }

    p,
    a {
      mso-line-height-rule: exactly;
    }

    .es-left {
      float: left;
    }

    .es-right {
      float: right;
    }

    .es-menu td {
      border: 0;
    }

    .es-menu td a img {
      display: inline !important;
      vertical-align: middle;
    }

    /*
    END CONFIG STYLES
    */
    s {
      text-decoration: line-through;
    }

    a {
      text-decoration: underline;
    }

    .es-menu td a {
      font-family: 'Josefin Sans', helvetica, arial, sans-serif;
      text-decoration: none;
      display: block;
    }

    .es-wrapper {
      width: 100%;
      height: 100%;
      background-repeat: repeat;
      background-position: center top;
    }

    .es-wrapper-color,
    .es-wrapper {
      background-color: #e1ecf7;
    }

    .es-content-body p,
    .es-footer-body p,
    .es-header-body p,
    .es-infoblock p {
      font-family: 'Josefin Sans', helvetica, arial, sans-serif;
      line-height: 150%;
      letter-spacing: 0;
    }

    .es-header {
      background-color: transparent;
      background-repeat: repeat;
      background-position: center top;
    }

    .es-header-body {
      background-color: #00406c;
    }

    .es-header-body p {
      color: #f8f9fb;
      font-size: 12px;
    }

    .es-header-body a {
      color: #f8f9fb;
      font-size: 12px;
    }

    .es-footer {
      background-color: transparent;
      background-repeat: repeat;
      background-position: center top;
    }

    .es-footer-body {
      background-color: #00406c;
    }

    .es-footer-body p {
      color: #f8f9fb;
      font-size: 12px;
    }

    .es-footer-body a {
      color: #f8f9fb;
      font-size: 12px;
    }

    .es-content-body {
      background-color: #f8f9fb;
    }

    .es-content-body p {
      color: #001523;
      font-size: 16px;
    }

    .es-content-body a {
      color: #001523;
      font-size: 16px;
    }

    .es-infoblock p {
      font-size: 12px;
      color: #cccccc;
    }

    .es-infoblock a {
      font-size: 12px;
      color: #cccccc;
    }

    h1 {
      font-size: 40px;
      font-style: normal;
      font-weight: normal;
      line-height: 120%;
      color: #001523;
    }

    h2 {
      font-size: 32px;
      font-style: normal;
      font-weight: normal;
      line-height: 120%;
      color: #001523;
    }

    h3 {
      font-size: 20px;
      font-style: normal;
      font-weight: normal;
      line-height: 120%;
      color: #001523;
    }

    h4 {
      font-size: 24px;
      font-style: normal;
      font-weight: normal;
      line-height: 120%;
      color: #333333;
    }

    h5 {
      font-size: 20px;
      font-style: normal;
      font-weight: normal;
      line-height: 120%;
      color: #333333;
    }

    h6 {
      font-size: 16px;
      font-style: normal;
      font-weight: normal;
      line-height: 120%;
      color: #333333;
    }

    .es-header-body h1 a,
    .es-content-body h1 a,
    .es-footer-body h1 a {
      font-size: 40px;
    }

    .es-header-body h2 a,
    .es-content-body h2 a,
    .es-footer-body h2 a {
      font-size: 32px;
    }

    .es-header-body h3 a,
    .es-content-body h3 a,
    .es-footer-body h3 a {
      font-size: 20px;
    }

    .es-header-body h4 a,
    .es-content-body h4 a,
    .es-footer-body h4 a {
      font-size: 24px;
    }

    .es-header-body h5 a,
    .es-content-body h5 a,
    .es-footer-body h5 a {
      font-size: 20px;
    }

    .es-header-body h6 a,
    .es-content-body h6 a,
    .es-footer-body h6 a {
      font-size: 16px;
    }

    a.es-button,
    button.es-button {
      padding: 10px 20px 10px 20px;
      display: inline-block;
      background: #f4ac32;
      border-radius: 15px 15px 15px 15px;
      font-size: 18px;
      font-family: 'Josefin Sans', helvetica, arial, sans-serif;
      font-weight: normal;
      font-style: normal;
      line-height: 120%;
      color: #ffffff;
      text-decoration: none !important;
      width: auto;
      text-align: center;
      letter-spacing: 0;
      mso-padding-alt: 0;
      mso-border-alt: 10px solid #f4ac32;
    }

    .es-button-border {
      border-style: solid;
      border-color: #2cb543 #2cb543 #2cb543 #2cb543;
      background: #f4ac32;
      border-width: 0px 0px 0px 0px;
      display: inline-block;
      border-radius: 15px 15px 15px 15px;
      width: auto;
      mso-hide: all;
    }

    .es-button img {
      display: inline-block;
      vertical-align: middle;
    }

    .es-fw,
    .es-fw .es-button {
      display: block;
    }

    .es-il,
    .es-il .es-button {
      display: inline-block;
    }

    /*
    RESPONSIVE STYLES
    Please do not delete and edit CSS styles below.
  
    If you don't need responsive layout, please delete this section.
    */
    @media only screen and (max-width: 600px) {
      *[class="gmail-fix"] {
        display: none !important;
      }

      p,
      a {
        line-height: 150% !important;
      }

      h1,
      h1 a {
        line-height: 120% !important;
      }

      h2,
      h2 a {
        line-height: 120% !important;
      }

      h3,
      h3 a {
        line-height: 120% !important;
      }

      h4,
      h4 a {
        line-height: 120% !important;
      }

      h5,
      h5 a {
        line-height: 120% !important;
      }

      h6,
      h6 a {
        line-height: 120% !important;
      }

      .es-header-body p {}

      .es-content-body p {}

      .es-footer-body p {}

      .es-infoblock p {}

      h1 {
        font-size: 30px !important;
        text-align: left;
      }

      h2 {
        font-size: 24px !important;
        text-align: left;
      }

      h3 {
        font-size: 20px !important;
        text-align: left;
      }

      h4 {
        font-size: 24px !important;
        text-align: left;
      }

      h5 {
        font-size: 20px !important;
        text-align: left;
      }

      h6 {
        font-size: 16px !important;
        text-align: left;
      }

      .es-header-body h1 a,
      .es-content-body h1 a,
      .es-footer-body h1 a {
        font-size: 30px !important;
      }

      .es-header-body h2 a,
      .es-content-body h2 a,
      .es-footer-body h2 a {
        font-size: 24px !important;
      }

      .es-header-body h3 a,
      .es-content-body h3 a,
      .es-footer-body h3 a {
        font-size: 20px !important;
      }

      .es-header-body h4 a,
      .es-content-body h4 a,
      .es-footer-body h4 a {
        font-size: 24px !important;
      }

      .es-header-body h5 a,
      .es-content-body h5 a,
      .es-footer-body h5 a {
        font-size: 20px !important;
      }

      .es-header-body h6 a,
      .es-content-body h6 a,
      .es-footer-body h6 a {
        font-size: 16px !important;
      }

      .es-menu td a {
        font-size: 14px !important;
      }

      .es-header-body p,
      .es-header-body a {
        font-size: 14px !important;
      }

      .es-content-body p,
      .es-content-body a {
        font-size: 14px !important;
      }

      .es-footer-body p,
      .es-footer-body a {
        font-size: 14px !important;
      }

      .es-infoblock p,
      .es-infoblock a {
        font-size: 12px !important;
      }

      .es-m-txt-c,
      .es-m-txt-c h1,
      .es-m-txt-c h2,
      .es-m-txt-c h3,
      .es-m-txt-c h4,
      .es-m-txt-c h5,
      .es-m-txt-c h6 {
        text-align: center !important;
      }

      .es-m-txt-r,
      .es-m-txt-r h1,
      .es-m-txt-r h2,
      .es-m-txt-r h3,
      .es-m-txt-r h4,
      .es-m-txt-r h5,
      .es-m-txt-r h6 {
        text-align: right !important;
      }

      .es-m-txt-j,
      .es-m-txt-j h1,
      .es-m-txt-j h2,
      .es-m-txt-j h3,
      .es-m-txt-j h4,
      .es-m-txt-j h5,
      .es-m-txt-j h6 {
        text-align: justify !important;
      }

      .es-m-txt-l,
      .es-m-txt-l h1,
      .es-m-txt-l h2,
      .es-m-txt-l h3,
      .es-m-txt-l h4,
      .es-m-txt-l h5,
      .es-m-txt-l h6 {
        text-align: left !important;
      }

      .es-m-txt-r img,
      .es-m-txt-c img,
      .es-m-txt-l img,
      .es-m-txt-r .rollover:hover .rollover-second,
      .es-m-txt-c .rollover:hover .rollover-second,
      .es-m-txt-l .rollover:hover .rollover-second {
        display: inline !important;
      }

      .es-m-txt-r .rollover div,
      .es-m-txt-c .rollover div,
      .es-m-txt-l .rollover div {
        line-height: 0 !important;
        font-size: 0 !important;
      }

      .es-spacer {
        display: inline-table;
      }

      a.es-button,
      button.es-button {
        font-size: 18px !important;
      }

      a.es-button,
      button.es-button,
      .es-button-border {
        display: inline-block !important;
      }

      .es-m-fw,
      .es-m-fw.es-fw,
      .es-m-fw .es-button {
        display: block !important;
      }

      .es-m-il,
      .es-m-il .es-button,
      .es-social,
      .es-social td,
      .es-menu {
        display: inline-block !important;
      }

      .es-adaptive table,
      .es-left,
      .es-right {
        width: 100% !important;
      }

      .es-content table,
      .es-header table,
      .es-footer table,
      .es-content,
      .es-footer,
      .es-header {
        width: 100% !important;
        max-width: 600px !important;
      }

      .adapt-img {
        width: 100% !important;
        height: auto !important;
      }

      .es-mobile-hidden,
      .es-hidden {
        display: none !important;
      }

      .es-desk-hidden {
        width: auto !important;
        overflow: visible !important;
        float: none !important;
        max-height: inherit !important;
        line-height: inherit !important;
      }

      tr.es-desk-hidden {
        display: table-row !important;
      }

      table.es-desk-hidden {
        display: table !important;
      }

      td.es-desk-menu-hidden {
        display: table-cell !important;
      }

      .es-menu td {
        width: 1% !important;
      }

      table.es-table-not-adapt,
      .esd-block-html table {
        width: auto !important;
      }

      .es-social td {
        padding-bottom: 10px;
      }

      .h-auto {
        height: auto !important;
      }
    }
  </style>
</head>

<body style="margin: 0; padding: 0; font-family: 'Josefin Sans', sans-serif;">
  <div class="es-wrapper-color">
    <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
      <!-- Header Section -->
      <tbody>
        <tr>
          <td class="esd-email-paddings" valign="top">
            <table cellpadding="0" cellspacing="0" class="esd-header-popover es-header" align="center">
              <tbody>
                <tr>
                  <td class="esd-stripe" align="center">
                    <table bgcolor="#ffffff" class="es-header-body" align="center" cellpadding="0" cellspacing="0" width="600">
                      <tbody>
                        <tr>
                          <td class="esd-structure es-p40" align="left" background="https://sokdov.stripocdn.email/content/guids/CABINET_0fa486e736790bd0e3fdb2f0eb814a76/images/hectorjrivas1fxmet2u5duunsplash_1.png" esd-img-prev-position="center top" style="background-image: url(https://sokdov.stripocdn.email/content/guids/CABINET_0fa486e736790bd0e3fdb2f0eb814a76/images/hectorjrivas1fxmet2u5duunsplash_1.png); background-repeat: no-repeat; background-position: center top;">
                            <table cellpadding="0" cellspacing="0" class="es-left" align="left">
                              <tbody>
                                <tr>
                                  <td width="156" class="es-m-p0r es-m-p20b esd-container-frame" valign="top" align="center">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                      <tbody>
                                        <tr>
                                          <td align="center" class="esd-block-image" style="font-size: 0">
                                            <a target="_blank">
                                              <img class="adapt-img" src="https://sokdov.stripocdn.email/content/guids/CABINET_8f58c6b21335b3e80c9b7cd9f560522031c75e1aec81616e24ec9c3516d0149c/images/dalino_logo.png" alt="" width="121">
                                            </a>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <table class="es-right" cellpadding="0" cellspacing="0" align="right">
                              <tbody>
                                <tr>
                                  <td width="344" align="left" class="esd-container-frame">
                                    <table cellpadding="0" cellspacing="0" width="100%">
                                      <tbody>
                                        <tr>
                                          <td align="right" class="esd-block-text es-p15t es-m-txt-c">
                                            <p>
                                              <a target="_blank" href="tel:(000)123-456-789">09560734201</a>
                                            </p>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td align="right" class="esd-block-text es-p10t es-m-txt-c" esd-links-underline="underline">
                                            <p>
                                              <a target="_blank" href="mailto:realagency@email" style="text-decoration: underline;">dalinomercedita@gmail.com</a>
                                            </p>
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
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- Content Section -->
    <table cellpadding="0" cellspacing="0" class="es-content" align="center">
      <tbody>
        <tr>
          <td class="esd-stripe" align="center">
            <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600">
              <tbody>
                <tr>
                  <td class="esd-structure es-p40t es-p30b es-p40r es-p40l es-m-p0b" align="left">
                    <table cellpadding="0" cellspacing="0" width="100%">
                      <tbody>
                        <tr>
                          <td width="520" align="left" class="esd-container-frame">
                            <table cellpadding="0" cellspacing="0" width="100%">
                              <tbody>
                                <tr>
                                  <td align="center" class="esd-block-text">
                                    <h1>WELCOME TO DALINO DENTAL CLINIC🌟</h1>
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
                <tr>
                  <td class="esd-structure es-p30b es-p40r es-p40l" align="left">
                    <table cellpadding="0" cellspacing="0" width="100%">
                      <tbody>
                        <tr>
                          <td width="520" class="esd-container-frame" align="center" valign="top">
                            <table cellpadding="0" cellspacing="0" width="100%">
                              <tbody>
                                <tr>
                                  <td align="center" class="esd-block-text">
                                    <p style="line-height: 200%;">You have registered with Dalino Dental Clinic as a user.</p>
                                    <p style="line-height: 200%;"><br></p>
                                    <p style="line-height: 200%;">Verify your email address to login with the below given link.<br></p>
                                  </td>
                                </tr>
                                <tr>
                                  <td align="center" class="esd-block-button es-p20">
                                    <span class="es-button-border" style="border-width: 20px; border-color: #3d85c6; background: #3d85c6;">
                                    <a href='http://localhost/cs1-dclinic-inventory-sys/main-everification.php?token=$verify_token' style="color: #ffffff; text-decoration: none; display: inline-block;">Verify Account</a>
                                    </span>
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
          </td>
        </tr>
      </tbody>
    </table>
    <!-- Footer Section -->
    <table cellpadding="0" cellspacing="0" class="es-footer" align="center">
      <tbody>
        <tr>
          <td class="esd-stripe" align="center">
            <table bgcolor="#ffffff" class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600">
              <tbody>
                <tr>
                  <td class="esd-structure es-p50r es-p20t es-p20b es-p40l" align="left" background="https://sokdov.stripocdn.email/content/guids/CABINET_0fa486e736790bd0e3fdb2f0eb814a76/images/hectorjrivas1fxmet2u5duunsplash_1.png" esd-img-prev-position="center top" style="background-image: url(https://sokdov.stripocdn.email/content/guids/CABINET_0fa486e736790bd0e3fdb2f0eb814a76/images/hectorjrivas1fxmet2u5duunsplash_1.png); background-repeat: no-repeat; background-position: center top;">
                    <table cellpadding="0" cellspacing="0" class="es-left" align="left">
                      <tbody>
                        <tr>
                          <td width="228" align="left" class="esd-container-frame es-m-p20b">
                            <table cellpadding="0" cellspacing="0" width="100%">
                              <tbody>
                                <tr>
                                  <td align="center" class="esd-block-image" style="font-size: 0">
                                    <a target="_blank">
                                      <img class="adapt-img" src="https://sokdov.stripocdn.email/content/guids/CABINET_8f58c6b21335b3e80c9b7cd9f560522031c75e1aec81616e24ec9c3516d0149c/images/dalino_logo.png" alt="" width="153">
                                    </a>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table cellpadding="0" cellspacing="0" class="es-right" align="right">
                      <tbody>
                        <tr>
                          <td width="227" align="left" class="esd-container-frame">
                            <table cellpadding="0" cellspacing="0" width="100%">
                              <tbody>
                                <tr>
                                  <td align="center" class="esd-block-text es-p5t es-p15b">
                                    <h2><b style="color:#cfe2f3">Mercedita Batoc-Dalino Dental Clinic</b></h2>
                                  </td>
                                </tr>
                                <tr>
                                  <td align="center" class="esd-block-text es-p5b">
                                    <p>
                                      <span style="color:#ffffff">“</span>
                                      <b style="color:#ffffff">Thank you for being our customer!</b>
                                      <span style="color:#ffffff">”</span><br>
                                    </p>
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
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</body>

</html>