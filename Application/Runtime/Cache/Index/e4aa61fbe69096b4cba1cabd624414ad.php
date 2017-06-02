<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<script type="text/javascript" src="__PUBLIC__/index/js/flexible.js"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/index/css/css.css" />
	<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js" ></script>
</head>

<body class="list">
<div class="listheader">
<div class="title">我的书签</div>
	<div class="search">
		<form action="<?php echo U('index/index/query_list');?>" method="post" id="queryForm">
			<input type="text" placeholder="文书关键词" name="titleKeyWords">
			<input type="button" value="检索">
		</form>
	</div>
</div>
<div class="news">
	<a class="list">
		<div class="time">发文：2017-03-05</div>
		<div class="title">文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题</div>
		<div class="form">渝 公干安561561</div>
		
	</a><a class="list">
		<div class="time">发文：2017-03-05</div>
		<div class="title">文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题</div>
		<div class="form">渝 公干安561561</div>
		
	</a><a class="list">
		<div class="time">发文：2017-03-05</div>
		<div class="title">文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题文章标题</div>
		<div class="form">渝 公干安561561</div>
	</a>
</div>
<script>
	$("#queryForm").on("click","input[type='button']",function () {
		var _this = $(this);
		var keyWords = _this.prev().val();
		keyWords = keyWords.replace(/(^\s*)|(\s*$)/g, "");
		if (keyWords == ''){
			alert("请输入关键字")
		}else {
			$("#queryForm").submit();
		}

	})
</script>
<div class="footer"></div>
</body>
</html>