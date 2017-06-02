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
<div class="main">
	<div class="search">
		<form action="<?php echo U('Index/index/index');?>" method="post" id="loginForm">
			<div class="title">
				用户名:
				<input type="text" name="user_name" placeholder="用户名">
			</div>
			<div class="info">
				密  码:
				<input type="text" name="password" placeholder="密  码">
			</div>
			<div class="info">
					<input type="button" value="登陆" id="login">
			</div>
		</form>
	</div>
</div>
<script>
	$("#loginForm").on("click","#login",function () {
		var $user_name = $("input[name='user_name']");
		var $password = $("input[name='password']");
		var loginData ={"user_name":$user_name,"password":$password};
		verifyOption = {
			url:
		}
	})
</script>
<div class="footer"></div>
</body>
</html>