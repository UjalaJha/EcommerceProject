  <html lang="en">
  <head>
    <!-- start: Meta -->
    <meta charset="utf-8">
    <title>Webpanel</title>
    <meta name="description" content="Web Panel Dashboard"> 
    <!-- end: Meta -->  
    <!-- start: Mobile Specific -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end: Mobile Specific --> 
    <!-- start: CSS --> 
    <link id="base-style-responsive" href="/css/main.css" rel="stylesheet">     
    <link href="https://fonts.googleapis.com/css?family=Niconne" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700" rel="stylesheet">
    <link href="/css/jquery.dataTables.css" rel="stylesheet">
    <link href="/css/jquery.noty.css" rel="stylesheet">
    <link href="/css/noty_theme_default.css" rel="stylesheet">
    <link href="/css/adminLTE.min.css" rel="stylesheet">
    <link href="/css/ionicons.min.css" rel="stylesheet">


    <link rel="manifest" href="/css/manifest.json">
    <link href="/css/select2.css" type="text/css" rel="stylesheet" />
    <!-- start: JavaScript -->  
    <script type='text/javascript' src="/js/jquery-2.1.4.min.js"></script>
    <script type='text/javascript' src="/js/plugins/jquery-ui.custom.min.js"></script>
    <script type='text/javascript' src="/js/essential-plugins.js"></script>
    <script type='text/javascript' src="/js/bootstrap.min.v3.3.6.js"></script>
    <!-- <script type='text/javascript' src="/js/main.js"></script> -->
    <script type='text/javascript' src="/js/plugins/pace.min.js"></script>  
    <script type='text/javascript' src="/js/jquery.form.js"></script>
    <script type='text/javascript' src="/js/jquery.validate.js"></script>
    <script type='text/javascript' src="/js/additional-methods.js"></script>
    <script type='text/javascript' src="/js/plugins/bootstrap-datepicker.min.js"></script>
    <!-- Datatable plugin-->
    <script type='text/javascript' src='/js/jquery.dataTables.min.js'></script>
    <script type='text/javascript' src='/js/datatable.js'></script>
    <script type='text/javascript' src="/js/jquery.noty.js"></script>
    <!-- Datatable plugin-->
    
    <!-- CK Editor plugins -->
    <script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/js/ckeditor/adapters/jquery.js"></script>    
    <!-- CK Editor plugins -->
    
    <script type="text/javascript" src="/js/moment.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js"></script>
    <link type="text/css" rel="stylesheet" href="/css/bootstrap-datetimepicker.min.css"/>

    <!-- Start: Select2-->

    <script type="text/javascript" src="/js/select2.min.js"></script>

    <!-- end: Select2-->
    <!-- end: JavaScript -->

    <link href="/css/bootstrap-glyphicons.css" rel="stylesheet">

    
    <script>
      function setTabIndex(){
        var tabindex = 1;
        $('input,select,textarea,.icon-plus,.icon-minus,button,a').each(function() {
          if (this.type != "hidden") {
            var $input = $(this);
            $input.attr("tabindex", tabindex);
            tabindex++;
          }
        });
      }
      
      $(function(){
        setTabIndex();
        $(".select2").each(function(){
          $(this).select2({
            placeholder: "Select",
            allowClear: true
          });
          $("#s2id_"+$(this).attr("id")).removeClass("searchInput");
        });
        $(".dataTables_filter input.hasDatepicker").change( function () {       
          oTable.fnFilter( this.value, oTable.oApi._fnVisibleToColumnIndex(oTable.fnSettings(), $(".searchInput").index(this) ) );
        });     
        window.scrollTo(0,0);
      });
      
      function displayMsg(type,msg)
      {

        $.noty({
          text:msg,
          layout:"topRight",
          type:type
        });
      }


    </script> 
    <!-- Old CSS & JS Files-->
  </head>

  <div class="container">
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
                      <td>BS-200</td>
                      <td class="text-center">$10.99</td>
                      <td class="text-center">1</td>
                      <td class="text-right">$10.99</td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>BS-400</td>
                      <td class="text-center">$20.00</td>
                      <td class="text-center">3</td>
                      <td class="text-right">$60.00</td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>BS-1000</td>
                      <td class="text-center">$600.00</td>
                      <td class="text-center">1</td>
                      <td class="text-right">$600.00</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td class="thick-line"></td>
                      <td class="thick-line"></td>
                      <td class="thick-line text-center"><strong>Subtotal</strong></td>
                      <td class="thick-line text-right">$670.99</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td class="no-line"></td>
                      <td class="no-line"></td>
                      <td class="no-line text-center"><strong>Shipping</strong></td>
                      <td class="no-line text-right">$15</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td class="no-line"></td>
                      <td class="no-line"></td>
                      <td class="no-line text-center"><strong>Total</strong></td>
                      <td class="no-line text-right">$685.99</td>
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
          </form>

        </div>

        <div class="clearfix"></div>
      </div>
    </div>              
  </div>
</div>




