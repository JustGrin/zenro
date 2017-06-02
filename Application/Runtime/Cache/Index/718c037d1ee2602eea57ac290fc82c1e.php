<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>无标题文档</title>
	<script type="text/javascript" src="__PUBLIC__/index/js/flexible.js"></script>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/index/css/css.css" />
	<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js" ></script>
</head>
<body>
<div class="header"></div>
<h1>注册</h1>
<div class="main">
	<div class="search">
		<form action="<?php echo U('Index/index/index');?>" method="post" id="loginForm">
			<div style="height: 60px">
				<span id="error_msg" class="hidden">错误提示:</span>
			</div>
			<div class="title">
				用户名:
				<input type="text" name="userName" placeholder="用户名">
			</div>
			<div class="info">
				密  码:
				<input type="text" name="mem_password" placeholder="密  码">
			</div>
			<div class="info">
				重复密码:
				<input type="text" name="rep_password" placeholder="重复密码">
			</div>
			<div class="info">
					<input type="button" value="注册" id="login">
			</div>

		</form>
	</div>
</div>
<script>
	var error_box = $("#error_msg");
	$("#loginForm").on("click","#login",function () {
		var $userName = $("input[name='userName']").val();
		var $mem_password = $("input[name='mem_password']").val();
		var $rep_password = $("input[name='rep_password']").val();
		if($userName == ''){
			showError("用户名不能为空");
			return false
		}
		if($mem_password == ''){
			showError("密码不能为1空");
			return false
		}
		if($mem_password.length < 6){
			showError("密码长度不能小于6位");
			return false
		}
		if($rep_password == ''){
			showError("重复密码不能为空");
			return false
		}
		if($rep_password !==  $mem_password){
			showError("两次密码不一致");
			return false
		}
		var registerData ={"userName":$userName,"mem_password":$mem_password,"rep_password":$rep_password};
		verifyOption = {
			url:"<?php echo U('Index/Login/doregister');?>",
			type:"post",
			data:registerData,
			dataType:"json",
			success:function (res) {
				console.log(res);
				if(res.status == 1){
					window.location.href =res.return_url;
				}else {
					showError(res.error)
				}
			}
		};
		$.ajax(verifyOption);
	});

	function showError(error) {
		error_box.text(error);
		error_box.show();
		setTimeout(function () {
			error_box.hide()
		},5000)
	}
</script>
<div class="footer"></div>
</body>
</html>