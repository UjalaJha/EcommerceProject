@include('inc.header')

<div id="content" class="content-wrapper">
	<div class="page-title">
      <div>
        <h1>TEST PAGE</h1>            
      </div>
      <div>
        <ul class="breadcrumb">
          <li><a href="/home"><i class="fa fa-home fa-lg"></i></a></li>
          <li><a href="/test">TEST</a></li>
        </ul>
      </div>
    </div>      	      	
    <div class="card">
      <div class="page-title-border">
      <div class="col-sm-12 col-md-6">
        <div class="box-content form-inline">
            <div class="dataTables_filter searchFilterClass form-group">
                <label for="firstname" class="control-label">Search</label>
                <input id="sSearch_0" name="sSearch_0" type="text" class="searchInput form-control"/>
            </div>
            <div class="control-group clearFilter form-group" style="margin-left:5px;">
                <div class="controls">
                    <a href="/test"><button class="btn btn-primary">Clear Search</button></a>
                </div>
            </div>
         </div>
         <div class="clearfix"></div>
      </div>
      </div>
      <div class="clearfix"></div>
      <div class="card-body">
        <div class="box-content">
            <div class="table-responsive scroll-table">
                <table class="dynamicTable display table table-bordered non-bootstrap">
                    <thead>
                        <tr>
                            <th>CITY</th>
                            <th>STATUS</th>
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
$.fn.dataTable.ext.legacy.ajax = true;
$( document ).ready(function() {
	
});
document.title = "Cities";
</script>
@include('inc.footer')