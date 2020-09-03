<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BigStore: Shopping Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <style>
        
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
        .meta { float: right; width: 35%; }
        /* .meta:after, table.balance:after { clear: both; content: ""; display: table; }  */
        /* table meta */
        /* table.meta th { width: 40%; }
        table.meta td { width: 60%; } */
        /* table items */
        table.inventory { clear: both; width: 100%; margin-top:30% }
        table.inventory th { font-weight: bold; text-align: center; }
        table.inventory td:nth-child(1) { width: 26%; }
        table.inventory td:nth-child(2) { width: 38%; }
        table.inventory td:nth-child(3) { text-align: right; width: 12%; }
        table.inventory td:nth-child(4) { text-align: right; width: 12%; }
        table.inventory td:nth-child(5) { text-align: right; width: 12%; }
        /* table balance */
        table.balance th, table.balance td { width: 50%; margin-top:60% }
        table.balance td { text-align: right; }
        /* aside */
        aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
        aside h1 { border-color: #999; border-bottom-style: solid; }
        aside p  {margin-left:40%}
        /* javascript */
        .add, .cut
        {
            border-width: 1px;
            display: block;
            font-size: .8rem;
            padding: 0.25em 0.5em;
            float: left;
            text-align: center;
            width: 0.6em;
        }
        .add, .cut
        {
            background: #9AF;
            box-shadow: 0 1px 2px rgba(0,0,0,0.2);
            background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
            background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
            border-radius: 0.5em;
            border-color: #0076A3;
            color: #FFF;
            cursor: pointer;
            font-weight: bold;
            text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
        }
        .add { margin: -2.5em 0 0; }
        .add:hover { background: #00ADEE; }
        .cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
        .cut { -webkit-transition: opacity 100ms ease-in; }
        tr:hover .cut { opacity: 1; }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <article>
                        <div class="col-sm-12">

                                <div class="col-sm-6 meta" >
                                    <p style="margin-top:35px;font-size:50px;margin-left:25px;letter-spacing: 0px;color: #5F5F5F;text-transform: uppercase;">{{ trans('labels.backend.orders.Invoice_to') }}</p>
                                    <p style="font-size:20px; color:#5F5F5F; margin-left:30px;text-transform: capitalize;"> # {{$Invoice_Number}} </p>
                                    
                                    <p style="margin-top:35px;margin-left:30px;font-size:20px;letter-spacing: 0px;color: #8F8F8F;">{{ trans('labels.backend.orders.Date') }} :  
                                        <span style="font-size:15px;letter-spacing:0px;color: #8F8F8F;text-transform: capitalize;">{{$date}}</span>
                                    </p>

                                    <p style="margin-top:35px;margin-left:30px;font-size:20px;letter-spacing: 0px;color: #8F8F8F;">{{ trans('labels.backend.orders.table.paymentStatus') }} : 
                                        <span style="font-size:15px;letter-spacing:0px;color: #8F8F8F;text-transform: capitalize;">Visa</span>

                                    </p>

                                    <h6 style="margin-top:35px;
                                        margin-left:30px;
                                        font-size:20px;
                                        letter-spacing: 0px;
                                        border-radius: 25px;
                                        background: #21a67d;  
                                        padding: 20px;
                                        width: 200px;
                                        height: 40px;
                                        "> {{ trans('labels.backend.orders.Price') }} :
                                    
                                        <span style="font-size:20px;letter-spacing:0px;text-transform: capitalize;">  <b>  {{ $grandTotal }} SAR  </b> </span> 

                                     </h6>

                                </div> <!-- col-md-6 -->

                                <div>

                                </div>

                                <div class="col-sm-6">
                                    <img src="http://shapelistapp.com/img/logo.png"  style="margin-bottom:10px" width="200px" height="200px" /> 
                                    <p> <b> CR 1010569681 </b> </p>
                                    <p>  VAT-NO 310053727200003  </p>
                                    <p>  TEL +966 11 810 2260 </p>
                                    <p>  KSA-RYADH PO-BOX 13321 </p> 
                                    <p style="text-transform: uppercase;"> www.shapelist.com </p> 

                                    <p style="margin-top:20px;margin-right:50%"> {{ trans('labels.backend.orders.Bill-To') }} :
                                       <br/> <b> {{$first_name}} {{ $last_name}} </b>
                                    </p>

                                    <p style="margin-top:-70px;margin-left:50%"> {{ trans('labels.backend.orders.Deliver-To') }} : <br/>
                                        @foreach($locationInfo as $locationObj)
                                            <b> {{ $locationObj->location->city }} - {{ $locationObj->location->address }} </b>
                                        @endforeach
                                    </p>
                                    
                                </div>
                        </div> 

                       
                        </div>

                    </article> 

                    

                    <!--Items -->
                    <div class="row">
                        <table class="table">
                            <thead  class="thead-dark">  
                                <tr style="text-align: left;font: Bold 12px/26px Montserrat;letter-spacing: 0px;color: #5F5F5F;text-transform: capitalize;opacity: 1;">
                                    <th scope="col">{{ trans('labels.backend.orders.services') }}</th>
                                    <th scope="col">{{ trans('labels.backend.orders.productType') }}</th>
                                    <th scope="col">{{ trans('labels.backend.orders.Quantity') }}</th>
                                    <th scope="col">{{ trans('labels.backend.orders.Amount') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productsInfo as $productsObj)
                                    <tr style="background-color:#f8f8f8; text-align: left;font: Medium 12px/26px Montserrat;letter-spacing: 0px;color: #5F5F5F;text-transform: capitalize;opacity: 1;">
                                        <td>{{ $productsObj->services }} </td>
                                        <td> {{ $productsObj->productType  }} </td>
                                        <td> {{$productsObj->quantity}}</td>
                                        <td> {{$productsObj->totalPrice}}   </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-4" style="margin-top:60px;margin-left:70px;float:right;color: #5F5F5F;text-transform: capitalize;opacity: 1;">
                            <p> SubTotal [After Discount] :  {{ $sub_total }} SAR </p>
                            <p> VAT( {{ $vatPercentage }} %):    {{ $vat_value }} SAR </p>
                            <p> Total:     {{ $grandTotal }} SAR    </p>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-sm-12" style="margin-top:45%">
                                <p> <b> Notes: </b> <br/>  <b style="text-decoration:none;color: #5F5F5F;"> Thank you for being our customer and have a great day </b> </p>
                                <p> <b> Terms: </b> <br/> <b> <a style="text-decoration:none;color: #5F5F5F;" href="https://www.shapelist.com">www.shapelist.com/terms</a> </b> </p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>