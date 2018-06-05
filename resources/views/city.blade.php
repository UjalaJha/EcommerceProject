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
      <div class="col-sm-12">
        <div class="box-content">
          <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
              @if(Session::has('alert-' . $msg))

              <p class="alert alert-{{ $msg }} fade in">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
              @endif
            @endforeach
          </div> <!-- end .flash-message -->
          <div class="col-sm-4 dataTables_filter searchFilterClass form-group">
            <label for="firstname" class="control-label">Search</label>
            <input id="sSearch_0" name="sSearch_0" type="text" class="searchInput form-control"/>
          </div>

          <div class="col-sm-4 dataTables_filter searchFilterClass form-group" style="margin-top: 3%;">
              <div class="controls">
                  <a href="/test"><button class="btn btn-primary">Clear Search</button></a>
              </div>
          </div>

            <p style="float: right;margin-top: 3%;"><a href="/export"><button class="btn btn-primary">Export to Excel</button></a></p> 
            
            <p style="float: left;margin-right: 0%;">
              <form class="form-horizontal" action="{{ URL::to('import') }}" method="post" enctype="multipart/form-data">
                <button class="btn btn-primary">Import to Excel</button>
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <!-- <input id="file1" name="import_file" class="form-control required" type="file"> -->
              <!-- <input type="file"name="import_file" /> -->
              <div class="float">
              
              <input type="file"name="import_file" /> 
              </div>
              </form>
            </p>

        </div>

        <div class="clearfix"></div>
      </div>

      <div class="clearfix"></div>
    </div>
      <div class="clearfix"></div>
      <div class="card-body">
        <div class="box-content">
          <div class="table-responsive scroll-table">
            <table class="dynamicTable example display table table-bordered non-bootstrap">
              <thead>
                  <tr>
                      <th>CITY</th>
                      <th>STATUS</th>
                      <th>ACTION</th>
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

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>

        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form">
            <div class="form-group">
              <label class="control-label col-sm-2" for="city_id">ID</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="id" disabled>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="city_name">City Name</label>
              <div class="col-sm-10">
                <input type="name" class="form-control" id="cityname">
              </div>
            </div>
            <p class="fname_error error text-center alert alert-danger hidden"></p>
            <div class="form-group">
              <label class="control-label col-sm-2" for="status">Status</label>
              <div class="col-sm-10">
                <select class="form-control" id="status" name="status">
                  <option value="" disabled selected>Choose your option</option>
                  <option value="Active">Active</option>
                  <option value="In-active">In-active</option>
                </select>
              </div>
            </div>
          </form>
          <div class="deleteContent">
            Are you Sure you want to delete <span class="dname"></span> ? <span
              class="hidden did"></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn actionBtn" data-dismiss="modal">
              <span id="footer_action_button" class='glyphicon'> </span>
            </button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">
              <span class='glyphicon glyphicon-remove'></span> Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>  
<script>
$( document ).ready(function() {
  
});
document.title = "Cities";
</script>

<script >
  let vb;
  $(document).on('click', '.edit-modal', function() {
        //alert("hello");
        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').removeClass('delete');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        var stuff = $(this).data('info').split(',');
        $('.did').text($(this).data('identity'));
        //alert(stuff);
        vb = $(this).parent().parent();
        //console.log(vb);
        fillmodalData(stuff)
        $('#myModal').modal('show');
    });
  function fillmodalData(details){
    $('#id').val(details[0]);
    $('#cityname').val(details[1]);
    $('#status').val(details[2]);
}
$('.modal-footer').on('click', '.edit', function() {
  // var status=$('#status').val();
  // alert(status);
        $.ajax({
            type: 'post',
            url: '/edititem',
            data: {
                '_token':"<?= csrf_token() ?>",
                'city_id': $("#id").val(),
                'city_name': $('#cityname').val(),
                'status': $('#status').val()
                
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
    });
</script>



<script>
  let va;
  $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').removeClass('edit');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.did').text($(this).data('identity'));
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.dname').html($(this).data('name'));
        va = $(this).parent().parent();
        console.log("THIS:", va);
        $('#myModal').modal('show');
    });
      $('.modal-footer').on('click', '.delete', function() {
          var id = $('.did').text();
          var data = 'recordToDelete='+ id;
          var parent = $('.did')
          console.log(parent);
          $.ajax({
          type: 'post',
          url: '/deleteitem',
          data: {
              '_token':"<?= csrf_token() ?>",
              'id': $('.did').text()
          },
          success: function(data) {
              //data = $.trim(data);
              //console.log('received this response: '+data);
              //alert(id);
              //setTimeout("location.reload(true);",50);
              // va.fadeOut('slow', function() {$(va).remove();});
              //clearSearchFilters();
              $(va).remove();
          }
      });
    });
</script>
@include('inc.footer')