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
<div class="header">	<h2>消防文库</h2>
</div>
	<div class="pagetitle">文书系统登录</div>
<div class="main">
	<div class="login">
		<form action="<?php echo U('Index/index/index');?>" method="post" id="loginForm">
			<div class="title clearfix">
				用户名:
				<input type="text" name="userName" placeholder="用户名">
			</div>
			<div class="info clearfix">
				密&nbsp;&nbsp;&nbsp;码:
				<input type="text" name="mem_password" placeholder="密  码">

					
			</div>
			<span id="error_msg" class="hidden"></span>
			<div>
			<input type="button" value="登 陆" id="login" class="btn" >
				
			</div>
			<a href="<?php echo U('Index/Login/register');?>">注册</a>
		</form>
	</div>
</div>
<script>
	var error_box = $("#error_msg");
	$("#loginForm").on("click","#login",function () {
		var $userName = $("input[name='userName']").val();
		var $mem_password = $("input[name='mem_password']").val();
		if($userName == ''){
			showError("用户名不能为空");
			return false
		}
		if($mem_password == ''){
			showError("密码不能为空");
			return false
		}
		var loginData ={"userName":$userName,"mem_password":$mem_password};
		verifyOption = {
			url:"<?php echo U('Index/Login/dologin');?>",
			type:"post",
			data:loginData,
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
	<div class="footer"><img src="/Public/index/img/logo.jpg"/>
		<span>重庆市公安消防总队制</span><b>2017</b>
		
</div></body>
</html>