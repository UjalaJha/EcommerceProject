@include('inc.loginheader')
		<section class="material-half-bg">
			<div class="cover"></div>
		</section>
		<section class="login-content">
			<div class="logo">
				<h1>Montana</h1>
			</div>
			<div class="login-wrapper">
			<div class="login-form">
				<form class="login-form" id="form-validate" method="post">
				  <h3 class="login-head">Sign in to start your session</h3>
				  <div class="form-group has-feedback">
						<!--<label class="control-label">USERNAME</label> -->
						<input class="form-control" name="username" id="username" type="text" placeholder="Enter Username" autofocus>
            <!--<i class="fa fa-lg fa-fw fa-user form-control-feedback"></i>-->
					</div>
				  <div class="form-group has-feedback">
						<!--<label class="control-label">PASSWORD</label> -->
						<input class="form-control" name="password" id="password" type="password" placeholder="Enter password">
            <!--<i class="fa fa-lock form-control-feedback" style="font-size:18px;"></i>-->
				  </div>
				  <div class="form-group">
						<div class="utility">
						  <p class="semibold-text mb-0"><a id="forgotpass" href="#">Forgot Password ?</a></p>
						</div>
				  </div>
				  <div class="form-group btn-container button-login">
						<button type="submit" class="btn btn-primary btn-block">LOGIN <i class="fa fa-sign-in fa-lg"></i></button>
				  </div>
          <div class="clearfix"></div>
          <div id="show_msg"></div>
				</form>
			</div>
				<div class="forgot-password">
				<form class="forget-form" id="formforgot-validate" method="post">
				  <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
				  <div class="form-group has-feedback">
						<!--<label class="control-label">EMAIL</label> -->
						<input class="form-control" type="text" name="email_id" id="email_id" placeholder="Email">
          	<!--<i class="fa fa-envelope form-control-feedback" style="font-size:18px;"></i>-->
				  </div>
				  <div class="form-group btn-container">
					<button type="submit" class="btn btn-primary btn-block">RESET <i class="fa fa-unlock fa-lg"></i></button>
				  </div>
                  <div class="clearfix"></div>
                  <div id="show_msg1"></div>
				  <div class="form-group mt-20">
					<p class="semibold-text mb-0"><a id="backtologin" href="#"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
				  </div>
				</form>
				</div>
		    </div>
			</div>
		</section>
<script>

var vRules = {
		username:{required:true},
		password:{required:true}
};
var vMessages = {
		username:{required:"Please enter username."},
		password:{required:"Please enter password."}
};

$("#form-validate").validate({
	rules: vRules,
	messages: vMessages,
	submitHandler: function(form)
	{
		var act = "/login/loginvalidate";
		$("#form-validate").ajaxSubmit({
			url: act,
			type: 'post',
			cache: false,
			clearForm: false,
			success: function (response) {
				var res = eval('('+response+')');
				//alert("jlf: "+ res['success']);
				if(res['success'] == "1")
				{
					$("#show_msg").html('<span style="color:#339900;">'+res['msg']+'</span>');
					setTimeout(function(){
						window.location = "/home";
					},2000);

				}
				else
				{
					$("#show_msg").html('<span style="color:#ff0000;">'+res['msg']+'</span>');
					return false;
				}
			}
		});
	}
});

var vvRules = {
		email_id:{required:true,email:true},

};
var vvMessages = {
		email_id:{required:"Please enter email."}
};
$("#formforgot-validate").validate({
	rules: vvRules,
	messages: vvMessages,
	submitHandler: function(form)
	{
		var act = "/login/forgotpassword";
		$("#formforgot-validate").ajaxSubmit({
			url: act,
			type: 'post',
			cache: false,
			clearForm: false,
			success: function (response) {
				var res = eval('('+response+')');
				//alert("jlf: "+ res['success']);
				if(res['success'] == "1")
				{
					$("#show_msg1").html('<span style="color:#339900;">'+res['msg']+'</span>');
					setTimeout(function(){
						window.location = "/login";
					},2000);

				}
				else
				{
					$("#show_msg1").html('<span style="color:#ff0000;">'+res['msg']+'</span>');
					return false;
				}
			}
		});
	}
});
$(document).ready(function(){
	$('#forgotpass').click(function(){
		$('.login-form').hide();
		$('.forgot-password').fadeIn(100);
	});
	$('#backtologin').click(function(){
		$('.forgot-password').hide();
		$('.login-form').fadeIn(100);
	});
});

</script>
@include('inc.loginfooter')