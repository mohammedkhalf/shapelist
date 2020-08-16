<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Subscription Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>
<body>
   <style>
                @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600&display=swap');

        *[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }
        *[contenteditable] { cursor: pointer; }
        *[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }
        span[contenteditable] { display: inline-block; }
        /* heading */
        h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }
        /* table */
        table { font-size: 75%; table-layout: fixed; width: 100%; }
        table { border-collapse: separate; border-spacing: 2px; }
        th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: center; }
        /* th, td { border-radius: 0.25em; border-style: solid; }
        th { background: #EEE; border-color: #BBB; } */
        td { border-color: #DDD; }
        /* page */
        /*html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }*/
        /*html { background: #999; cursor: default; }*/
        /*body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }*/
        /*body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }*/
        /* header */
        header { margin: 0 0 3em; }
        header:after { clear: both; content: ""; display: table; }
        header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
        header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
        header address p { margin: 0 0 0.25em; }
        header span, header img { display: block; float: right; }
        header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
        header img { max-height: 100%; max-width: 100%; }
        header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }
        /* article */
        article, article address, table.meta, table.inventory { margin: 0 0 3em; }
        article:after { clear: both; content: ""; display: table; }
        article h1 { clip: rect(0 0 0 0); position: absolute; }
        article address { float: left; font-size: 125%; font-weight: bold; }
        /* table meta & balance */
        .meta { float: right; width: 30%; margin-right:-70px !important; margin-top:-150px !important;}
        /* .meta:after, table.balance:after { clear: both; content: ""; display: table; }  */
        /* table meta */
        /* table.meta th { width: 40%; }
        table.meta td { width: 60%; } */
        /* table items */
        table.inventory { clear: both; width: 100%; margin-top:30% }
       
        table.inventory td:nth-child(3) { text-align: right; width: 12%; }
        table.inventory td:nth-child(4) { text-align: right; width: 12%; }
        table.inventory td:nth-child(5) { text-align: right; width: 12%; }
        /* table balance */
        table.balance td { text-align: right; }
     
       
    </style>


    <br/>
    <div style="font-family: 'Montserrat', sans-serif;">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body" style="margin-left:44px;">
                     <div style="margin-top:30px">
                            <img src="http://backend.shapelist.com/img/frontend/dashboard_images/ShapeList_Logo2_RGB.jpg"   width="141px"/>
                       <table>
                           <td style="text-align:left;">
                              <p>  CR 1010569681  <br>
                               VAT NO 310053727200003 <br>
                               <a style="color:#5F5F5F" href="https://www.shapelist.com">www.shapelist.com</a> </p>
                           </td>
                           <td style="text-align:left;">
                              <p> KSA-RYADH PO-BOX 13321  <br>
                               TEL +966 11 810 2260 </p>
                           </td>
                           <td></td>
                       </table>     
                           
                        <div>
                         <div  style="margin-top:-117px;float:right;">
                           <p>
                             <b style="font-size:14px;color: #5F5F5F;" > INVOICE TO </b><br>
                             <span style="font-size:10px;"> {{$first_name}} 
                             </span><br>
                             <b style="font-size:14px;color: #5F5F5F;" > INVOICE DATE </b><br>
                             <span style="font-size:10px;"> {{$date}} </span><br>
                             <b style="font-size:14px;color: #5F5F5F;" > TOTAL </b><br>
                             <span style="font-size:10px;">{{ $total_price }} SAR </span>
                             
                           </p>
                           
                           
                         </div> 
            
                     </div></div>
                       
                    

                    <div style="color: #5F5F5F;margin-top:32px;">
                      <p>
                      <b style="font-size:47px;">INVOICE  </b><br>
                      <b style="font-size:12px;" > INVOICE #{{ $Invoice_Number }}</b>
                      </p>
                    </div>

                    <!--Items -->
                    <table>
                        <td>
                          <b style="font-size:12px;color: #5F5F5F;"> Plan </b>
                          <p style="font-size:12px;color: #5F5F5F;">{{$subscription_name}}</p>
                        </td>
                        <td>
                          <b style="font-size:12px;color: #5F5F5F;">Purchase Points  </b>
                          <p style="font-size:12px;color: #5F5F5F;">{{$purchase_points}}</p>
                        </td>
                        <td >
                          <b style="font-size:12px;color: #5F5F5F;"> Free Points </b>
                          <p style="font-size:12px;color: #5F5F5F;">{{$free_points}}</p>
                        </td>
                        <td >
                          <b style="font-size:12px;color: #5F5F5F;"> Discount </b>
                          <p style="font-size:12px;color: #5F5F5F;">{{$discount}}%</p>
                        </td>
                        <td >
                          <b style="font-size:12px;color: #5F5F5F;"> Duration </b>
                          <p style="font-size:12px;color: #5F5F5F;">{{$duration}} Months</p>
                        </td>
                         <td >
                          <b style="font-size:12px;color: #5F5F5F;"> Unit Price</b>
                          <p style="font-size:12px;color: #5F5F5F;">{{$sub_total}} SAR</p>
                        </td>
                    </table>

                                   
                                                       
                    <div style="margin-top:38px;float:right;">
                        
                            <p style="font-size:11px;color: #5F5F5F;"> 
                              <b>Subtotal:</b> {{$sub_total}} SAR  <br>
                              <b>VAT( {{ $vatPercentage }} %):</b> {{$vatValue}} SAR <br>
                              <b>Total:</b>  {{ $total_price }} SAR
                            </p>
                  
                    </div>

                    <div  style="margin-top:171px; margin-bottom:20px;">
                          <p>
                                <b style="font-size:14px;"> Thank you for being our customer and have a great day </b> <br>
                    
                    <span font-size:12px;><b> Terms: </b><a style="color:#5F5F5F" href="https://www.shapelist.com/terms">www.shapelist.com/terms</a> </span>
                    
                           </p>
                    </div>
                    
                  

            </div>
        </div>
    </div>
    <div style=" position:fixed; bottom: 0px; width: 100%;
         height: 12px;background: #21A67D 0% 0% no-repeat padding-box;">
         
         </div>
         </div>

               
</body>
</html>
