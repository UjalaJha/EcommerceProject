@include('inc.header')
<head>

  <!-- Fonts -->

  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
  <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
  
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

</head>

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
      <div class="clearfix"></div>
      <div class="card-body">
        <div class="box-content">
            <div class="table-responsive scroll-table">
                <table id="test" class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th>City</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                </table> 
            </div>           
        </div> 
      </div>
    </div>        
    
</div><!-- end: Content -->			
<script>
  $('#test').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url":"/cityTest/list",
      "dataType":"json",
      "type":"POST",
      "data":{"_token":"<?= csrf_token() ?>"}
    },
    "columns":[
      {"data":"city_name"},
      {"data":"status"},
      {"data":"action","searchable":false,"orderable":false}
    ]
  } );
</script>

@include('inc.footer')