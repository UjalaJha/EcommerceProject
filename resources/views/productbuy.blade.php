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
          <form class="form-horizontal" id="form-validate" method="post" enctype="multipart/form-data" action="/pdfupdate">

            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <input type="hidden" id="cname" name="cname"/>

            <!-- name -->
            <div class="control-group form-group">
             <div class="container max-width: 100%;">
                <div class="row">
                  <div class="col-md-3">
                    <label class="control-label" for="cname">Customer Name*</label>
                    <input class="input-xlarge form-control cname" id="cname" name="cname" type="text" >
                  </div>
                  <div class="col-md-3">
                    <label class="control-label" for="date">Date</label>                        
                    <input class="input-xlarge form-control date" id="date" name="date" type="text" value=<?php
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

                <table class="table">
                  <thead>
                    <tr class="item-row">
                      <th>Item</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr id="hiderow">
                      <td colspan="4">
                        <a id="addRow"  title="Add a row" class="btn btn-primary">Add a row</a>
                      </td>
                    </tr>
                    <!-- Here should be the item row -->
                    <!-- <tr class="item-row">
                        <td><input class="form-control item" placeholder="Item" type="text"></td>
                        <td><input class="form-control price" placeholder="Price" type="text"></td>
                        <td><input class="form-control qty" placeholder="Quantity" type="text"></td>
                        <td><span class="total">0.00</span></td>
                      </tr> -->
                    <tr>
                      <td></td>
                      <td></td>
                      <td class="text-right"><strong>Sub Total</strong></td>
                      <td><input class="form-control discount" id="subtotal" name="subtotal" value="0.00" type="text" readonly></td>
                  </tr>

                    <tr>
                      <td><strong>Total Quantity: </strong><span id="totalQty" style="color: red; font-weight: bold">0</span> Units</td>
                      <td></td>
                      <td class="text-right" ><strong>Discount</strong></td>
                      <td class="discount"><input class="form-control discount" id="discount" name="discount" value="0" type="text"></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td class="text-right" ><strong>Shipping</strong></td>
                      <td class="shipping"><input class="form-control shipping" id="shipping" name="shipping" value="0" type="text"></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td class="text-right" ><strong>Grand Total</strong></td>
                      <td class="totalrs"><input class="form-control totalrs" id="totalrs" name="totalrs" value="0.00" type="text" readonly></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>


            <div class="control-group form-group">
              <label class="control-label" for="Billing statement">Delivery Address</label>

              <div class="controls">
                <textarea id="meta_description" name="meta_description" style="display: inline-block">
                </textarea>
              </div>
            </div>

      
            <div class="form-actions form-group">
              <!-- <button class="printpdf btn btn-primary" id="printpdf">Print</button> -->

              <button type="submit" class=" btn btn-primary">Submit</button>

              <a href="/purchase" class="btn btn-primary">Cancel</a>
            </div>
          </form>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>              
  </div>
</div><!-- end: Content -->		





<!-- <script>
  $( document ).ready(function() 
  {

    //To Add a row in product image section
    $(".printpdf").click(function(){
      $.ajax({
        type: 'post',
        url: '/pdfupdate',
        data: {
          '_token':"<?= csrf_token() ?>",
          'subtotal': $('.subtotal').text(),
          'shipping': $('.shipping').val(),
          'discount': $('.discount').val(),
          'totalrs': $('.totalrs').text(),
          'cname': $('.cname').val(),
          'date' :$('.date').val(),
        },
        success: function(data) {
              //data = $.trim(data);
              //console.log('received this response: '+data);
              //alert(id);
              //setTimeout("location.reload(true);",50);
              // va.fadeOut('slow', function() {$(va).remove();});
              //clearSearchFilters();
              //displayMsg("success","Done!");
            }
          });
    });
  });
</script> -->
<script>
  jQuery(document).ready(function(){
    jQuery().invoice({
      addRow : "#addRow",
      delete : ".delete",
      parentClass : ".item-row",

      price : ".price",
      qty : ".qty",
      total : ".total",
      totalQty: "#totalQty",

      subtotal : "#subtotal",
      discount: "#discount",
      shipping : "#shipping",
      grandTotal : "#grandTotal"
    });
  });
</script>







@include('inc.footer')