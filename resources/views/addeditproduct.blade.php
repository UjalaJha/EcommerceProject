@include('inc.header')
<!-- start: Content -->
<div id="content" class="content-wrapper">

	<div class="page-title">
    <div>
      <h1>Add/Edit Product</h1>            
    </div>
    <div>
      <ul class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home fa-lg"></i></a></li>
        <li><a href="/products">Products</a></li>
      </ul>
    </div>
  </div>    

  <div class="card">       
   <div class="card-body">             
    <div class="box-content">
     <div class="col-sm-8 col-md-4">
       <form class="form-horizontal" id="form-validate" method="post" enctype="multipart/form-data">

        <!-- Laravel session csrf token -->
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <!-- check product id -->
        <input  type="hidden" id="product_id" name="product_id" value={!!$data->product_id!!}>

        <!-- name -->
        <div class="control-group form-group">
          <label class="control-label" for="product_name">Product Name*</label>
          <div class="controls">
            <input class="input-xlarge form-control" id="product_name" name="product_name" type="text" value={!!$data->product_name!!} readonly>
          </div>
        </div>

        <!-- product code -->
        <div class="control-group form-group">
          <label class="control-label" for="product_code">Product Code*</label>
          <div class="controls">
            <input class="input-xlarge form-control" id="product_code" name="product_code" type="text" value={!!$data->product_code!!}  readonly>  
          </div>
        </div>

        <!-- price -->
        <div class="control-group form-group">
          <label class="control-label" for="product_price">Product Price*</label>
          <div class="controls">
            <input class="input-xlarge form-control" id="product_price" name="product_price" type="text" value={!!$data->product_price!!} >  
          </div>
        </div>

        <!-- quantity -->
        <div class="control-group form-group">
          <label class="control-label" for="quantity">Quantity*</label>
          <div class="controls">
            <input class="input-xlarge form-control" id="quantity" name="quantity" type="text" value={!!$data->quantity!!} > 
          </div>
        </div>

        <!-- long desc -->
        <div class="control-group form-group">
          <label class="control-label" for="product_description">Product Long Description</label>
          <div class="controls">
            <textarea id="product_description" name="product_description" style="display: inline-block" class="editor">{!!$data->product_description!!}</textarea>
          </div>
        </div>

        <!-- short desc -->
        <div class="control-group form-group">
          <label class="control-label" for="product_short_description">Product Short Description</label>
          <div class="controls">
            <textarea id="product_short_description" name="product_short_description" style="display: inline-block" class="editor">{!!$data->product_short_description!!}</textarea>
          </div>
        </div>

        <!-- image -->
        <div class="control-group form-group" id="catalog_images">

          <label class="control-label"><span>Product Images*</span></label>

          <div class="controls" style="width: 900px;">

            <table id="tbl_catalog_images" style="" class="responsive display table table-bordered">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Title</th>
                  <th>Price</th>
                  <th>Default Image</th>
                  <th>Status</th>
                  <th>#</th>
                </tr>
              </thead>

              <tbody>

                @if(!empty($images) && count($images) > 0)
                  <?php $i = 0; ?>
                  @foreach($images as $image)
                  <?php $i++; ?>   
                  <tr>
                    <td>
                      @if(!empty($image['product_image_name']))
                      <strong>Uploaded image</strong> <img src= "{{ asset('cover_images/'.$image['product_image_name']) }} "  width="60" height="60">
                      @endif

                      <input  type="file" id="filec" name="filec" class="form-control" />

                      <input type="hidden" name="product_image_name[{{<?php echo $i;?>}}]" value="<?php if(!empty($image['product_image_name'])) echo $image['product_image_name']; ?>">

                      <input name="product_image_id[<?php echo $i;?>]" id=productimageid value="<?php if(!empty($image['product_image_id'])) echo $image['product_image_id']; ?>">
                    </td>

                    <td>
                      <input type="text" id="product_image_title<?php echo $i;?>" name="product_image_title[<?php echo $i;?>]" class="form-control product_image_title required" value="<?php if(!empty($image['product_image_title'])) echo $image['product_image_title']; ?>" />
                    </td>

                    <td>
                      <input type="number" id="product_image_price<?php echo $i;?>" name="product_image_price[<?php echo $i;?>]" class="form-control required" value="<?php if(!empty($image['product_image_price'])) echo $image['product_image_price']; ?>"  />
                    </td>

                    <td>
                      <select type="text" id="default<?php echo $i;?>" name="default[<?php echo $i;?>]" class="form-control default required">
                        <option <?php if(!empty($image['default_img']) && $image['default_img'] == 0) echo "selected='selected'"; ?> value="0">No</option>
                        <option <?php if(!empty($image['default_img']) && $image['default_img'] == 1) echo "selected='selected'"; ?> value="1">Yes</option>
                      </select>
                    </td>

                    <td>
                      <select type="text" id="product_image_status<?php echo $i;?>" name="product_image_status[<?php echo $i;?>]" class="form-control required">
                        <option <?php if(!empty($image['product_image_status']) && $image['product_image_status'] == "Active") echo "selected='selected'"; ?> value="Active">Active</option>
                        <option  <?php if(!empty($image['product_image_status']) && $image['product_image_status'] == "Inactive") echo "selected='selected'"; ?> value="Inactive">In-Active</option>
                      </select>
                    </td>

                    <td>
                      <!-- for add button at end of row -->
                      @if($i == 1)

                      <button type="button" class="addCatalogImage btn-primary"><i class="fa fa-plus"></i></button>

                      <!-- for remove button at end of row -->
                      @else
                      <button type="button" class="btn-primary remove_uploaded_image" id=imageid value=<?php echo $image['product_image_id']; ?>>
                        <i class="fa fa-remove"></i>
                      </button>
                      @endif

                    </td>
                  </tr>
                  @endforeach

                @else
                  <tr>
                    <td>
                      <!-- <input type="file" id="catalog_image1" name="catalog_image[1]" class="form-control required" /> -->

                      <input  type="file" id="file1" name="file1" class="form-control required" />
                      <input type="hidden" name="catalog_image_name[1]" id="catalog_image_name1">
                      <input type="hidden" name="catalog_image_id[1]" id="catalog_image_id1">
                    </td>

                    <td>
                      <input type="text" id="catalog_image_title1" name="catalog_image_title[1]" class="form-control required catalog_image_title" />
                    </td>

                    <td>
                      <input type="number" id="catalog_image_price1" name="catalog_image_price[1]" class="form-control required" />
                    </td>

                    <td>
                      <select type="text" id="default1" name="default[1]" class="form-control default required">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                      </select>
                    </td>

                    <td>
                      <select type="text" id="catalog_image_status1" name="catalog_image_status[1]" class="form-control required">
                        <option value="Active">Active</option>
                        <option value="Inactive">In-Active</option>
                      </select>
                    </td>

                    <td>
                      <button type="button" class="addCatalogImage btn-primary"><i class="fa fa-plus"></i></button>
                    </td>
                  </tr>

                @endif 

              </tbody>
            </table>
          </div>
        </div>

        <!-- meta title -->
        <div class="control-group form-group">
          <label class="control-label" for="meta_title">Meta Title</label>
          <div class="controls">
            <textarea id="meta_title" name="meta_title" style="display: inline-block" class="input-xlarge form-control">{!!$data->meta_title!!}</textarea>
          </div>
        </div>

        <!-- meta desc -->
        <div class="control-group form-group">
          <label class="control-label" for="meta_description">Meta Description</label>
          <div class="controls">
            <textarea id="meta_description" name="meta_description" style="display: inline-block" class="input-xlarge form-control">{!!$data->meta_description!!}</textarea>
          </div>
        </div>

        <!-- meta keyword -->
        <div class="control-group form-group">
          <label class="control-label" for="meta_keywords">Meta Keywords</label>
          <div class="controls">
            <textarea id="meta_title" name="meta_keywords" style="display: inline-block" class="input-xlarge form-control">{!!$data->meta_keywords!!}</textarea>
          </div>
        </div>


        <!-- status -->
        <div class="control-group form-group">
          <label class="control-label" for="fix_comission">Status*</label>
          <div class="controls">
            <select name="status" class="input-xlarge form-control">
              <option value="Active" <?php if(!empty($data->status) && $data->status=="Active"){ echo "selected='selected'"; } ?>>Active</option>
              <option value="In-active" <?php if(!empty($data->status) && $data->status=="In-active"){ echo "selected='selected'"; } ?>>Inactive</option>
            </select>
          </div>
        </div>


        <!-- submit  -->
        <div class="form-actions form-group">
          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="/products" class="btn btn-primary">Cancel</a>
        </div>

      </form>

    </div>

    <div class="clearfix"></div>
  </div>
</div>              
</div>
</div><!-- end: Content -->		


<script>


  //Validation Rules
  var vRules = {
    product_name:{required:true},
    product_code:{required:true},
    product_price:{required:true,number: true,min:0 },
    quantity:{required:true,number: true,min:0 },
    status:{required:true}

  };

  //Validation Messages
  var vMessages = {
    product_name:{required:"Please enter product name."},
    product_code:{required:"Please enter product code."},
    product_price:{required:"Please enter product price.",number: "Please enter valid price.", min: "Product price must be atleast 0 or more."},
    quantity:{required:"Please enter quantity",number: "Please enter valid quantity" ,min: "Product quantity must be atleast 0 or more."},
    status:{required:"Please select product status" }
  };

  //Validation
  $.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-z]+$/i.test(value);
  }, "Letters only please");




  //Submiting Form
  $("#form-validate").validate({
    rules: vRules,
    messages: vMessages,
    submitHandler: function(form) 
    {
      var act = "/productsubmitForm";
      $("#form-validate").ajaxSubmit({
        url: '/productsubmitForm', 
        type: 'POST',
        cache: false,
        clearForm: false, 
        _token: $('#token').val(), //laravel session token
        beforeSubmit : function(arr, $form, options){
          $(".btn-primary").prop('disabled',true);
      },
      success: function (response) {

        //Decoding the encoded response json
        var res = eval('('+response+')');
        if(res['success'] == "1")
        {
          displayMsg("success",res['msg']);
          $(".btn-primary").show();
          setTimeout(function(){
            window.location = "/products";
          },2000); 

        }
        else
        { 
          displayMsg("error",res['msg']);
          $(".btn-primary").prop('disabled',false);
          return false;
        }
        $(".btn-primary").prop('disabled',false);
      },

      error: function(response){

      //  Laravel Validator generates a json inclding all fields:error
      var text = response.responseJSON
      var msg = ""; 
        //console.log(response.responseJSON);
        for (var key in text) {
          if (text.hasOwnProperty(key)) 
          {
            //console.log(key + " -> " + text[key]);
            msg =text[key] + "\n";
            if (msg.length > 0) 
            {
              displayMsg("success",msg);
              $(".btn-primary").show();
              // alert(msg)  
            }
          }
        } 
        //console.log(msg);
        //To use alert
        // if (msg.length > 0) 
        // {
        //   displayMsg("success",msg);
        //   $(".btn-primary").show();
        //   // alert(msg)  
        // }
        $(".btn-primary").prop('disabled',false);
      } 

    });
    }
  });

  document.title = "Add/Edit Product";



  $( document ).ready(function() 
  {

    //To Add a row in product image section
    $(".addCatalogImage").click(function(){
      var index = 1;
      
      $("#tbl_catalog_images tbody tr").each(function(){
        index = index + 1;
      });
      
      $html = "<tr>"+
      "<td>"+
      "<input type='file' id='file"+index+"' name='file"+index+"' class='form-control required' />"+

      "<input type='hidden' name='catalog_image_name["+index+"]' id='catalog_image_name"+index+"'>"+
      "<input type='hidden' name='catalog_image_id["+index+"]' id='catalog_image_id"+index+"'>"+
      "</td>"+

      "<td>"+
      "<input type='text' id='catalog_image_title"+index+"' name='catalog_image_title["+index+"]' class='form-control catalog_image_title required' />"+
      "</td>"+

      "<td>"+
      "<input type='number' id='catalog_image_price"+index+"' name='catalog_image_price["+index+"]' class='form-control required' />"+
      "</td>"+

      "<td>"+
      "<select type='text' id='default"+index+"' name='default["+index+"]' class='form-control default required'>"+
      "<option value='0'>No</option>"+
      "<option value='1'>Yes</option>"+
      "</select>"+
      "</td>"+

      "<td>"+
      "<select type='text' id='catalog_image_status"+index+"' name='catalog_image_status["+index+"]' class='form-control required'>"+
      "<option value='Active'>Active</option>"+
      "<option value='Inactive'>In-Active</option>"+
      "</select>"+
      "</td>"+

      "<td>"+
      "<button type='button' class='btn-primary remove'>"+
      "<i class='fa fa-remove'></i>"+
      "</button>"+
      "</td>"+
      "</tr>";
      $('#tbl_catalog_images').find("tbody").append($html);
    });
    

    //Deleting the newly added row as not yet in db remove() used
    $('#tbl_catalog_images').on('click', '.remove', function () {
      $(this).closest('tr').remove();
    });
    

    //Deleting existing entry of image from database
    $('#tbl_catalog_images').on('click', '.remove_uploaded_image', function () {
      var ans = confirm("Are you sure you want to delete this image ?");
      if(ans)
      { 
        $(this).closest('tr').remove();
        var label = $(this).text(); 
        $(this).text('');
        var buttonValue = $(this).val();
        $(this).text(label);
        console.log(buttonValue)
        $.ajax({
          type: 'post',
          url: '/deletepicture',
          data: {
            '_token':"<?= csrf_token() ?>",
            'product_image_id': buttonValue,

          },
          success: function(data) {

            // var oTable = $('.example').dataTable();
            // console.log("Table:",oTable);

            // var data = oTable
            //     .row("0")
            //     .data();
            // console.log(data);
            setTimeout("location.reload(true);",50);
          }
        });
      }
    });
    
    //check for duplicate catalog image title (not changed)
    $('#tbl_catalog_images').on('click, blur, onkeyup', '.catalog_image_title', function () {
      var $elements = $('.catalog_image_title');
      var flag = false;
      
      $elements.each(function () {
        var selectedValue = this.value;
        if(selectedValue != "")
        {
          $elements
          .not(this)
          .filter(function() {
            if(!flag)
            {
              if(this.value.trim() == selectedValue.trim())
              {
                flag  = true;
                $(this).val("");
                alert('Duplicate title');
                return false;
              } 
            } 
          });
        }
      });
    });
    
    //check for default image - only one image can be set as default (not changed)
    $('#tbl_catalog_images').on('click', '.default', function () {
      var $elements = $('.default');

      var flag = false;
      
      $elements.each(function () {
        var selectedValue = this.value;
        if(selectedValue == "1")
        {
            // alert(selectedValue);
            $elements
            .not(this)
            .filter(function() {
              if(!flag)
              {
                if(this.value == selectedValue)
                {
                  flag  = true;
                  $(this).val(0);
                  alert('Already selected default image');
                  return false;
                } 
              } 
            });
          }
          
        });
    });
    
    
  });




</script>











@include('inc.footer')