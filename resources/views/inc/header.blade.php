<!DOCTYPE html>
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
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" 
        crossorigin="anonymous">
	</script>	
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
	<script type='text/javascript' src="/js/jquery.invoice.js"></script>
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

<body class="sidebar-mini fixed">	     
<div class="wrapper"><!-- Wrapper Start -->	
<!-- Navbar-->
     <header class="main-header hidden-print">
		<a class="logo" href="/home">
      		<h3 style="color:black;">Montana</h3>
		</a>
		<nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->

          <a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
          
          <!-- Navbar Right Menu-->
			<div class="navbar-custom-menu">
				<ul class="top-nav">
				<!-- User Menu-->
					<li class="dropdown">
						<a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-user fa-lg"></i> 
						</a>
						<ul class="dropdown-menu settings-menu">
							<li><a href="/changepassword/addEdit"><i class="fa fa-user fa-lg"></i> Change Password</a></li>
							<li><a href="/home/logout"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
        </nav>
     </header>
     <!-- Side-Nav-->
     <aside class="main-sidebar hidden-print">
		<section class="sidebar">          
		<!-- Sidebar Menu-->
          <ul class="sidebar-menu">
				<li class="active"><a href="/home"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
				<li class="treeview"><a href="#"><i class="fa fa-users"></i><span style="font-size: 100%;"> UAC</span><i class="fa fa-angle-right"></i></a>
					<ul class="treeview-menu">
						<li><a href="/permission"><i class="fa fa-tasks"></i> Permissions</a></li>					
						<li><a href="/roles"><i class="fa fa-exchange"></i> Roles</a></li>					
						<li><a href="/users"><i class="fa fa-user-plus"></i> Admin Users</a></li>
					</ul>
				</li>
				
				<li class="treeview"><a href="#"><i class="fa fa-laptop"></i><span style="font-size: 100%;">Master's</span><i class="fa fa-angle-right"></i></a>
					<ul class="treeview-menu">
						<li class="active"><a href="/products"><i class="fa fa-dashboard"></i><span>Products</span></a></li>
						<li class="active"><a href="/city"><i class="fa fa-dashboard"></i><span>City</span></a></li>
						<li class="active"><a href="/purchase"><i class="fa fa-dashboard"></i><span>Purchase</span></a></li>
					</ul>
				</li>   
          </ul>
		</section>
     </aside>	
 		
<noscript>
	<div class="alert alert-block span10">
		<h4 class="alert-heading">Warning!</h4>
		<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
	</div>
</noscript>
