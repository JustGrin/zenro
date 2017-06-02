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
<div class="title1">检索列表</div>
</div>
<div class="news">
	<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="list" href="<?php echo U('index/index/info',array('artId'=>$vo['id']));?>">
			<div class="time"><span class='catname'><?php echo ($vo["category_name"]); ?></span> 发文：<?php echo (date('Y-m-d',$vo['add_time'])); ?></div>
			<div class="title"><?php echo ($vo['title']); ?></div>
			<div class="form"><?php echo ($vo['author']); ?></div>
		</a><?php endforeach; endif; else: echo "" ;endif; ?>
	<?php if(empty($data)): ?><p style="text-align: center; font-size: 1rem; color: #999; font-weight: 100; margin-top: 2rem;">没有查询结果</p><?php endif; ?>
</div>
	<div class="footer"><img src="/Public/index/img/logo.jpg"/>
		<span>重庆市公安消防总队制</span><b>2017</b>
		
</div></body>
</html>