<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ShapleList: Shopping Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>

        <div class="container">
            <div class="row">
                <!-- Logo -->
                <div class="col-sm-8">
                     <img src="{{url('/img/logo.png')}}" width="200px" height="200px" alt="Image"/><br/>
                     <div style="margin-top:15px">
                        <p> <b> CR 1010569681 </b> </p>
                        <p> VAT NO 310053727200003 </p>
                        <p> KSA-RYADH PO-BOX 13321 </p>
                        <p> TEL +966 11 810 2260 </p>
                        <p> <a href="https://www.shapelist.com">www.shapelist.com</a> </p>
                     </div>
                </div>
                <!-- Invoice -->
                <div class="col-sm-4"> 
                    <h1> INVOICE </h1> <br/> #    <br/> <br/> <br/>
                    <p>Date :  </p>
                    <p>Payment Method :     VISA </p>
                    <div class="alert alert-secondary" role="alert">
                        <h5> <b> Price :     </b> </h5>
                    </div>
                 </div>
            </div> <br/>
            <div class="row">
                    <div  class="col-sm-3">
                        <p> Bill To :  </p>
                        <p> <b> User Name </b> </p>
                    </div>
                    <div  class="col-sm-3">
                        <p> Deliver To :  </p>
                        <p> <b> Riyadh , KSA </b> </p>
                    </div>
            </div>

        </div>
       
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>