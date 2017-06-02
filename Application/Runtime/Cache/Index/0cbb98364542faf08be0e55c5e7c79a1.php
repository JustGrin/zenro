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
<div class="title1">文章分类</div>
</div>
<div class="news">
	<?php if(is_array($cat_list)): $i = 0; $__LIST__ = $cat_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="list" href="<?php echo U('index/index/cat_art',array('catId'=>$vo['id']));?>">
			<div class="time"></div>
			<div class="title"><?php echo ($vo['category_name']); ?></div>
			<div class="form"></div>
						
		</a><?php endforeach; endif; else: echo "" ;endif; ?>

	
	
</div>
	<div class="footer"><img src="/Public/index/img/logo.jpg"/>
		<span>重庆市公安消防总队制</span><b>2017</b>
		
</div>
</body>
</html>