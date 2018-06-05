@include('inc.header')

<div id="content" class="content-wrapper">
	<div class="page-title">
    <div>
      <h1>Bill</h1>            
    </div>
    <div>
      <ul class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home fa-lg"></i></a></li>
        <li><a href="/purchase">Purchase</a></li>
      </ul>
    </div>
  </div>    

  <div class="card">       
   <div class="card-body">             
    <div class="box-content">
     <div class="col-sm-8 col-md-4">
       <form class="form-horizontal" id="form-validate" method="post" enctype="multipart/form-data">

        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

        <input type="hidden" id="cname" name="cname"/>

        <!-- name -->
        <div class="control-group form-group">
         <div class="container max-width: 100%;">
           <div class="row">

             
             
             <div class="col-md-3">
              <label class="control-label" for="cname">Customer Name*</label>
              <input class="input-xlarge form-control" id="cname" name="cname" type="text" >
            </div>
            <div class="col-md-3">
              <label class="control-label" for="date">Date</label>                        
              <input class="input-xlarge form-control" id="date" name="date" type="text" value=<?php
              echo(date("Y-m-d"));
              ?> readonly>	
            </div>
            <div class="col-md-3">
              <label class="control-label">Time</label>                        
              <input class="input-xlarge form-control" id="time" name="time" type="text" value=<?php
              echo(date("h-i-s"));
              ?> readonly >	
            </div>

          </div>
        </div>
      </div>
      
      <!-- image -->
      <div class="control-group form-group" id="catalog_images">

        <label class="control-label"><span>Billing</span></label>

        <div class="controls" style="width: 900px;">

          <table id="tbl_catalog_images" style="" class="responsive display table table-bordered">
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
          </table>
        </div>
      </div>

      <!-- meta title -->
      

      <!-- meta desc -->
      <div class="control-group form-group">
        <label class="control-label" for="Billing statement">Delivery Address</label>

        <div class="controls">
          <textarea id="meta_description" name="meta_description" style="display: inline-block">
          </textarea>
        </div>
      </div>



      

      <!-- submit  -->
      <div class="form-actions form-group">
        <a href="/print" class="btn btn-primary">Print</a>
        <a href="/purchase" class="btn btn-primary">Cancel</a>
      </div>

    </form>

  </div>

  <div class="clearfix"></div>
</div>
</div>              
</div>
</div><!-- end: Content -->		


















@include('inc.footer')