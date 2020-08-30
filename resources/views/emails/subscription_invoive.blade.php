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
        table { font-size: 78%; table-layout: fixed; width: 100%; }
        table { border-collapse: separate; border-spacing: 1px; }
        th, td { border-width: 1px; padding: 0.3em; position: relative; text-align: center; }
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
       
        table.inventory td:nth-child(3) { text-align: right; width: 30%; }
        table.inventory td:nth-child(4) { text-align: right; width: 30%; }
        table.inventory td:nth-child(5) { text-align: right; width: 30%; }
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
                           <td style="text-align:left;"><br>
                           <p><b>  CR 1010569681  <br>
                               VAT NO 310053727200003 <br>
                               <a style="color:#5F5F5F" href="https://www.shapelist.com">www.shapelist.com</a><br>
                               KSA-RYADH PO-BOX 13321  <br>
                               TEL +966 11 810 2260 </b></p> <br> <br>
                               <b style="font-size:14px;color: #5F5F5F;" > Bill To </b><br>
                             <span style="font-size:14px;"> {{$first_name}} </span></b><br> <br>
                           </td>
                          

                       </table>     
                           
                        <div>
                         <div  style="margin-top:-300px;float:right;">
                              <b style="font-size:40px;">INVOICE  </b><br>
                              <b style="font-size:12px;" > INVOICE NO.{{ $Invoice_Number }}</b>
                              <br> <br>
                           <p>
                            
                             <b style="font-size:14px;color: #5F5F5F;" > DATE :&nbsp;&nbsp;&nbsp;&nbsp;{{$date}}</b><br>
                             
                            
                             
                           </p>
                           
                           
                         </div> 
            
                     </div></div>
                       
                    

                    

                    <!--Items -->
                    <table>
                     <tr style="color:#fff;background-color:#333333;">
                        <th style ="border: 1px solid ;
  border-radius: 10px 0px 0px 10px; ">Plan </th>
                        <th>Purchase Points</th>
                        <th>Free Points</th>
                        <th>Discount</th>
                        <th>Duration</th>
                        <th style ="border: 1px solid ;
  border-radius: 0px 10px 10px 0px; ">Unit Price</th>
                     </tr>   
                        <td>
                          <p style="font-size:12px;color: #5F5F5F;">{{$subscription_name}}</p>
                        </td>
                        <td>
                          <p style="font-size:12px;color: #5F5F5F;">{{$purchase_points}}</p>
                        </td>
                        <td >
                          <p style="font-size:12px;color: #5F5F5F;">{{$free_points}}</p>
                        </td>
                        <td >
                          <p style="font-size:12px;color: #5F5F5F;">{{$discount}}%</p>
                        </td>
                        <td >
                          <p style="font-size:12px;color: #5F5F5F;">{{$duration}} Months</p>
                        </td>
                         <td >
                          <p style="font-size:12px;color: #5F5F5F;">{{$sub_total}} SAR</p>
                        </td>
                    </table>

                                   
                                                       
                   <div class="row">
                        <div class="col-sm-4" style="margin-top:20px; float:right"> 
                        
                            <p style="font-size:14px;color: #5F5F5F;"> 
                              <b style="margin-right:38px;">Subtotal:</b> {{$sub_total}} SAR  <br><br>
                              <b style="margin-right:38px;">VAT( {{ $vatPercentage }} %):</b> {{$vatValue}} SAR <br><br>
                              <div style="background-color:#d9d9d9;height:40px;line-height: 40px;border-radius: 10px;text-align: center;"><b>Total:  {{ $total_price }} SAR</b>
                            </div></div></p>
                  
                    </div><br><br><br><br>

                    <div  style="margin-top:171px; margin-bottom:20px;">
                          <p>
                          <span font-size:12px;color:#5F5F5F>Notes:<br> 
                          <b style="font-size:14px;color: #000;"> Thank you for being our customer and have a great day </b></span> <br>
                    
                    <span font-size:12px;color:#5F5F5F> Terms: <br><b><a style="color: #000;" href="https://www.shapelist.com/terms">www.shapelist.com/terms</a> </b></span>
                    
                           </p>
                    </div>
                    
                  

            </div>
        </div>
    </div>
         </div>

               
</body>
</html>
