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
        table { border-collapse: separate; border-spacing: 1px; table-layout: fixed; width: 100%;  }
      
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
                             <span> {{$first_name}} </span></b><br> <br>
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
                     <tr style="color:#fff;background-color:#000;">
                        <th>Plan </th>
                        <th>Purchase Points</th>
                        <th>Free Points</th>
                        <th>Discount</th>
                        <th>Duration</th>
                        <th>Unit Price</th>
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
