<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="/css/bootstrap.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <br><br>
    <center>
      <h1>Billing Info</h1>
    </center>
    <br><br>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-6">
          <div class="form-group">
            <label for="usr">Name:</label>
            <input type="text" class="form-control" id="usr">
          </div>
        </div>
        <div class="container-fluid">
        <div class="col-xs-6">
          <div class="form-group">
          <label for="usr">Date:</label>
          <input type="text" class="form-control" id="usr" value=<?php
          echo(date("Y-m-d"));
          ?> >
          </div>
        </div>
      </div>
      </div>
    </div>
  
    <br><br><br><br>

   <div class="container">
      
      <center>
        <table class="table" >

          <thead>
            <tr>
              <th>No</th>
              <th>Product</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>total</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td>1</td>
              <td>Data1</td>
              <td class="text-center">10.99</td>
              <td class="text-center">1</td>
              <td class="text-right">10.99</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Data2</td>
              <td class="text-center">20.00</td>
              <td class="text-center">3</td>
              <td class="text-right">60.00</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Data3</td>
              <td class="text-center">600.00</td>
              <td class="text-center">1</td>
              <td class="text-right">600.00</td>
            </tr>
            <tr>
              <td></td>
              <td class="thick-line"></td>
              <td class="thick-line"></td>
              <td class="thick-line text-center"><strong>Subtotal</strong></td>
              <td class="thick-line text-right">670.99</td>
            </tr>
            <tr>
              <td></td>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line text-center"><strong>Shipping</strong></td>
              <td class="no-line text-right">15</td>
            </tr>
            <tr>
              <td></td>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line text-center"><strong>Total</strong></td>
              <td class="no-line text-right">685.99</td>
            </tr>
          </tbody>



        </center>

    </div>


</body>

</html>