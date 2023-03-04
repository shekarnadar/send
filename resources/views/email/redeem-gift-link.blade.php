 <?php
   if(getAuthGaurd() == 'client_admin'){
      $urlPrefix = 'client-admin';
   }else {
      $urlPrefix = 'manager';
   }
    $logoUrl  = @$data['logo'];

?>
<!DOCTYPE html>
<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
   <head>
      <title></title>
      <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
      <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
      <!--[if mso]>
      <xml>
         <o:OfficeDocumentSettings>
            <o:PixelsPerInch>96</o:PixelsPerInch>
            <o:AllowPNG/>
         </o:OfficeDocumentSettings>
      </xml>
      <![endif]-->
      <style>
         * {
         box-sizing: border-box;
         }
         body {
         margin: 0;
         padding: 0;
         }
         a[x-apple-data-detectors] {
         color: inherit !important;
         text-decoration: inherit !important;
         }
         #MessageViewBody a {
         color: inherit;
         text-decoration: none;
         }
         p {
         line-height: inherit
         }
         .desktop_hide,
         .desktop_hide table {
         mso-hide: all;
         display: none;
         max-height: 0px;
         overflow: hidden;
         }
         @media (max-width:700px) {
         .desktop_hide table.icons-inner {
         display: inline-block !important;
         }
         .icons-inner {
         text-align: center;
         }
         .icons-inner td {
         margin: 0 auto;
         }
         .row-content {
         width: 100% !important;
         }
         .mobile_hide {
         display: none;
         }
         .stack .column {
         width: 100%;
         display: block;
         }
         .mobile_hide {
         min-height: 0;
         max-height: 0;
         max-width: 0;
         overflow: hidden;
         font-size: 0px;
         }
         .desktop_hide,
         .desktop_hide table {
         display: table !important;
         max-height: none !important;
         }
         }
      </style>
   </head>
   <body style="background-color: #000000; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
      <table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #000000;" width="100%">
      <tbody>
         <tr>
            <td>
               <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #7a7a7a;" width="100%">
                  <tbody>
                     <tr>
                        <td>
                           <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-radius: 0; color: #000000; width: 680px;" width="680">
                              <tbody>
                                 <tr>
                                    <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                       <div class="spacer_block" style="height:20px;line-height:20px;font-size:1px;"> </div>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
               <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; background-size: auto;" width="100%">
                  <tbody>
                     <tr>
                        <td>
                           <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-size: auto; color: #000000; width: 680px;" width="680">
                              <tbody>
                                 <tr>
                                    <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                       <table border="0" cellpadding="0" cellspacing="0" class="icons_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                          <tr>
                                             <td class="pad" style="vertical-align: middle; color: #000000; font-family: inherit; font-size: 14px; text-align: center;">
                                                <table align="center" cellpadding="0" cellspacing="0" class="alignment" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                   <tr>
                                                      <td style="vertical-align: middle; text-align: center; padding-top: 0px; padding-bottom: 0px; padding-left: 0px; padding-right: 0px;">
                                                         
                                                        
                                                         @if(!empty($data['logo']))
                                                         <img align="center" alt="LOGO" class="icon" height="128" src="{{url($logoUrl)}}" style="display: block; height: auto; margin: 0 auto; border: 0;" width="128"/>
                                                         @else
                                                         <img align="center" alt="LOGO" class="icon" height="128" src="{{url('assets/images/ekmatra-logo.jpeg')}}" style="display: block; height: auto; margin: 0 auto; border: 0;" width="128"/>
                                                         @endif
                                                         </td>
                                                   </tr>
                                                </table>
                                             </td>
                                          </tr>
                                       </table>
                                      <!--  <table border="0" cellpadding="0" cellspacing="0" class="heading_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                          <tr>
                                             <td class="pad" style="padding-bottom:10px;padding-top:10px;text-align:center;width:100%;">
                                                <h1 style="margin: 0; color: #000000; direction: ltr; font-family: TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif; font-size: 35px; font-weight: 400; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>Congratulations!</strong></h1>
                                             </td>
                                          </tr>
                                       </table> -->
                                       <table border="0" cellpadding="0" cellspacing="0" class="heading_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                          <tr>
                                             <td class="pad" style="padding-bottom:10px;padding-top:10px;text-align:center;width:100%;">
                                                <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 36px;"><span style="font-size:20px;">{!! nl2br($data['email_description']) !!}</span></p>
                                             </td>
                                          </tr>
                                       </table>
                                      <!--  <table border="0" cellpadding="10" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                          <tr>
                                             <td class="pad">
                                                <div style="font-family: sans-serif">
                                                   <div class="txtTinyMce-wrapper" style="font-size: 14px; mso-line-height-alt: 25.2px; color: #363333; line-height: 1.8; font-family: TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;">
                                                      <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 36px;"><span style="font-size:20px;">You have been selected for a gift from</span></p>
                                                      <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 36px;"><span style="font-size:20px;"><strong>{{$data['client_name']}}</strong></span></p>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                       </table> -->
                                       <table border="0" cellpadding="0" cellspacing="0" class="button_block block-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                          <tr>
                                             <td class="pad" style="padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:30px;text-align:center;">
                                                <div align="center" class="alignment">
                                                               <a href="{{$data['redeem_link']}}" style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#c31919;border-radius:4px;width:auto;border-top:0px solid #0B4E63;font-weight:400;border-right:0px solid #0B4E63;border-bottom:0px solid #0B4E63;border-left:0px solid #0B4E63;padding-top:5px;padding-bottom:5px;font-family:TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;text-align:center;mso-border-alt:none;word-break:keep-all;" target="_blank"><span style="padding-left:35px;padding-right:35px;font-size:16px;display:inline-block;letter-spacing:normal;"><span dir="ltr" style="word-break: break-word; line-height: 32px;"><strong>Select your gift</strong></span></span></a>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
               <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;" width="100%">
                  <tbody>
                     <tr>
                        <td>
                           <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-radius: 0; color: #000000; width: 680px;" width="680">
                              <tbody>
                                 <tr>
                                    <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                       <div class="spacer_block" style="height:60px;line-height:60px;font-size:1px;"> </div>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
               <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #6d6d6d;" width="100%">
                  <tbody>
                     <tr>
                        <td>
                           <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
                              <tbody>
                                 <tr>
                                    <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                       <div class="spacer_block" style="height:65px;line-height:65px;font-size:1px;"> </div>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
               <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #6d6d6d;" width="100%">
                  <tbody>
                     <tr>
                        <td>
                           <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
                              <tbody>
                                 <tr>
                                    <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="33.333333333333336%">
                                       <table border="0" cellpadding="0" cellspacing="0" class="heading_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                          <tr>
                                             <td class="pad" style="padding-left:20px;text-align:center;width:100%;padding-top:5px;">
                                                <h1 style="margin: 0; color: #ffffff; direction: ltr; font-family: TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif; font-size: 18px; font-weight: normal; line-height: 200%; text-align: left; margin-top: 0; margin-bottom: 0;"><strong>About Us</strong></h1>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border="0" cellpadding="0" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                          <tr>
                                             <td class="pad" style="padding-bottom:15px;padding-left:20px;padding-right:20px;padding-top:10px;">
                                                <div style="font-family: sans-serif">
                                                   <div class="txtTinyMce-wrapper" style="font-size: 12px; mso-line-height-alt: 24px; color: #ffffff; line-height: 2; font-family: TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;">
                                                      <p style="margin: 0; font-size: 14px;">We are an enterprise focussed gifting automation company.</p>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                    </td>
                                    <td class="column column-2" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="33.333333333333336%">
                                       <table border="0" cellpadding="0" cellspacing="0" class="heading_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                          <tr>
                                             <td class="pad" style="padding-left:20px;text-align:center;width:100%;padding-top:5px;">
                                                <h1 style="margin: 0; color: #ffffff; direction: ltr; font-family: TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif; font-size: 18px; font-weight: normal; line-height: 200%; text-align: left; margin-top: 0; margin-bottom: 0;"><strong>Links</strong></h1>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border="0" cellpadding="0" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                          <tr>
                                             <td class="pad" style="padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:10px;">
                                                <div style="font-family: sans-serif">
                                                   <div class="txtTinyMce-wrapper" style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #ffffff; line-height: 1.2; font-family: TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;">
                                                      <!-- <p style="margin: 0; font-size: 14px;">How enterprise gifting works</p> -->
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border="0" cellpadding="0" cellspacing="0" class="text_block block-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                          <tr>
                                             <td class="pad" style="padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:10px;">
                                                <div style="font-family: sans-serif">
                                                   <div class="txtTinyMce-wrapper" style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #a9a9a9; line-height: 1.2; font-family: TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;">
                                                      <!-- <p style="margin: 0; font-size: 14px;"><a href="http://www.example.com" rel="noopener" style="text-decoration: none; color: #ffffff;" target="_blank">The Team</a></p> -->
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border="0" cellpadding="0" cellspacing="0" class="text_block block-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                          <tr>
                                             <td class="pad" style="padding-bottom:15px;padding-left:20px;padding-right:20px;padding-top:10px;">
                                                <div style="font-family: sans-serif">
                                                   <div class="txtTinyMce-wrapper" style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #a9a9a9; line-height: 1.2; font-family: TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;">
                                                      <p style="margin: 0; font-size: 14px;"><a href="https://send1.in/" rel="noopener" style="text-decoration: none; color: #ffffff;" target="_blank">ekmatra.store</a></p>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                    </td>
                                    <td class="column column-3" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="33.333333333333336%">
                                       <table border="0" cellpadding="0" cellspacing="0" class="heading_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                          <tr>
                                             <td class="pad" style="padding-left:20px;text-align:center;width:100%;padding-top:5px;">
                                                <h1 style="margin: 0; color: #ffffff; direction: ltr; font-family: TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif; font-size: 18px; font-weight: normal; line-height: 200%; text-align: left; margin-top: 0; margin-bottom: 0;"><strong>Contact</strong></h1>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border="0" cellpadding="0" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                          <tr>
                                             <td class="pad" style="padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:10px;">
                                                <div style="font-family: sans-serif">
                                                   <div class="txtTinyMce-wrapper" style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #a9a9a9; line-height: 1.2; font-family: TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;">
                                                      <p style="margin: 0; font-size: 14px;"><a href="http://www.example.com" rel="noopener" style="text-decoration: none; color: #ffffff;" target="_blank">Info@send1.in | +91-8655906999</a></p>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border="0" cellpadding="0" cellspacing="0" class="text_block block-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
                                          <tr>
                                             <td class="pad" style="padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:10px;">
                                                <div style="font-family: sans-serif">
                                                   <div class="txtTinyMce-wrapper" style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #a9a9a9; line-height: 1.2; font-family: TimesNewRoman, Times New Roman, Times, Beskerville, Georgia, serif;">
                                                     <!--  <p style="margin: 0; font-size: 14px;"><a href="http://www.example.com" rel="noopener" style="text-decoration: none; color: #ffffff;" target="_blank">Help Center</a></p> -->
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                       <table border="0" cellpadding="0" cellspacing="0" class="social_block block-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                          <tr>
                                             <td class="pad" style="padding-bottom:15px;padding-left:20px;padding-right:10px;padding-top:10px;text-align:left;">
                                                <div class="alignment" style="text-align:left;">
                                                   <table border="0" cellpadding="0" cellspacing="0" class="social-table" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block;" width="144px">

<!--                                                       <tr>
                                                         <td style="padding:0 4px 0 0;"><a href="https://www.facebook.com/" target="_blank"><img alt="Facebook" height="32" src="images/facebook2x.png" style="display: block; height: auto; border: 0;" title="facebook" width="32"/></a></td>
                                                         <td style="padding:0 4px 0 0;"><a href="https://www.twitter.com/" target="_blank"><img alt="Twitter" height="32" src="images/twitter2x.png" style="display: block; height: auto; border: 0;" title="twitter" width="32"/></a></td>
                                                         <td style="padding:0 4px 0 0;"><a href="https://www.linkedin.com/" target="_blank"><img alt="Linkedin" height="32" src="images/linkedin2x.png" style="display: block; height: auto; border: 0;" title="linkedin" width="32"/></a></td>
                                                         <td style="padding:0 4px 0 0;"><a href="https://www.instagram.com/" target="_blank"><img alt="Instagram" height="32" src="images/instagram2x.png" style="display: block; height: auto; border: 0;" title="instagram" width="32"/></a></td>
                                                      </tr> -->
                                                   </table>
                                                </div>
                                             </td>
                                          </tr>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
               <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-6" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #0b4e63;" width="100%">
                  <tbody>
                     <tr>
                        <td>
                           <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
                              <tbody>
                                 <tr>
                                    <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                       <div class="spacer_block" style="height:65px;line-height:65px;font-size:1px;"> </div>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
               <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-7" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                  <tbody>
                     <tr>
                        <td>
                           <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
                              <tbody>
                                 <tr>
                                    <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
                                       <table border="0" cellpadding="0" cellspacing="0" class="icons_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                          <tr>
                                             <td class="pad" style="vertical-align: middle; color: #9d9d9d; font-family: inherit; font-size: 15px; padding-bottom: 5px; padding-top: 5px; text-align: center;">
                                                <table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                                                   <tr>
                                                      <td class="alignment" style="vertical-align: middle; text-align: center;">
                                                         <!--[if vml]>
                                                         <table align="left" cellpadding="0" cellspacing="0" role="presentation" style="display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                                                            <![endif]-->
                                                            <!--[if !vml]><!-->
                                                            <table cellpadding="0" cellspacing="0" class="icons-inner" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block; margin-right: -4px; padding-left: 0px; padding-right: 0px;">
                                                               <!--<![endif]-->
                                                            </table>
                                                            </td>
                                                            </tr>
                                                         </table>
                                                      </td>
                                                   </tr>
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
               <!-- End -->
   </body>
</html>