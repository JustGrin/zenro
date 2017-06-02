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
<div class="title">消防文库</div>
	<div class="search">
		<form action="<?php echo U('index/index/query_list');?>" method="post" id="queryForm">
			<input type="text" placeholder="名称关键字" name="titleKeyWords">
			<input type="button" value="检索">
		</form>
	</div>
</div>
<div class="news">
	<?php if(is_array($art_list)): $i = 0; $__LIST__ = $art_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="list" href="<?php echo U('Index/index/info',array('artId'=>$vo['id']));?>">
			<div class="time"><span class='catname'><?php echo ($vo["category_name"]); ?></span> 发文：<?php echo (date("Y-m-d",$vo["add_time"])); ?></div>
			<div class="title"><?php echo ($vo["title"]); ?></div>
			<div class="form"><?php echo ($vo["author"]); ?></div>
		</a><?php endforeach; endif; else: echo "" ;endif; ?>
	
</div>
	<div class="footer"><img src="/Public/index/img/logo.jpg"/>
		<span>重庆市公安消防总队制</span><b>2017</b>
		
</div><script>
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
</body>
</html>