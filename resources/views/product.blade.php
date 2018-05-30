@include('inc.header')
<div id="content" class="content-wrapper">
    <div class="page-title">
      <div>
        <h1>Products</h1>            
      </div>
      <div>
        <ul class="breadcrumb">
          <li><a href="/home"><i class="fa fa-home fa-lg"></i></a></li>
          <li><a href="/products">Products</a></li>
        </ul>
      </div>
    </div>    
	 <div class="card">
     	 <div class="page-title-border">
         	 <div class="col-sm-12">
             	<div class="box-content">
                	<div class="col-sm-4 dataTables_filter searchFilterClass form-group">
                        <label for="firstname" class="control-label">Product Name</label>
                        <input id="sSearch_0" name="sSearch_0" type="text" class="searchInput form-control"/>
                    </div>
                	<div class="col-sm-4 dataTables_filter searchFilterClass form-group">
                        <label for="firstname" class="control-label">Product Code</label>
                        <input id="sSearch_0" name="sSearch_0" type="text" class="searchInput form-control"/>
                    </div>
                    
                    <div class="col-sm-4 dataTables_filter searchFilterClass form-group" style="margin-top: 3%;">
                        <div class="controls">
                            <a href="/products"><button class="btn btn-primary">Clear Search</button></a>
                        </div>
                    </div>
                  <p style="float: right;margin-top: 3%;"><a href="/productaddedit" class="btn btn-primary icon-btn"><i class="fa fa-plus"></i>Add Product</a></p>
                </div>
             	<div class="clearfix"></div>
             </div>
             <div class="col-sm-12 col-md-6 right-button-top">
             	<div class="clearfix"></div>
             </div>
         </div>
         <div class="clearfix"></div>
         <div class="card-body">
         	<div class="box-content">
            	<div class="table-responsive scroll-table">
                	<table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product code</th>
                                <th>Product Price</th>
                                <th>Product Quantity</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
         </div>
     </div>
</div><!-- end: Content -->
			
<script>
$( document ).ready(function() {
	
});

	function changestatus(id)
	{
    	var r=confirm("Are you sure you want to change status for this record?");
    	if (r==true)
   		{
			$.ajax({
				url: "/changestatus/"+id,
				async: false,
				type: "get",
                // _token:"<?= csrf_token() ?>",
				success: function(data2){
					data2 = $.trim(data2);
					if(data2 == "1")
					{
						displayMsg("success","Record has been updated!");
						setTimeout("location.reload(true);",1000);
						
					}
					else
					{
						displayMsg("error","Oops something went wrong!");
						setTimeout("location.reload(true);",1000);
					}
				}
			});
    	}
    }
	document.title = "Products";
</script>
@include('inc.footer')