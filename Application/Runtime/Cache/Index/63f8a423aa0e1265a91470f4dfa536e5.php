<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>无标题文档</title>
	<script type="text/javascript" src="__PUBLIC__/index/js/flexible.js"></script>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/index/css/css.css" />
	<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js" ></script>
</head>
<meta http-equiv="Expires" CONTENT="0">
<meta http-equiv="Cache-Control" CONTENT="no-cache">
<meta http-equiv="Pragma" CONTENT="no-cache">
<body class="list">
<div class="listheader">
	<div class="title1">我的书签</div>
</div>
<div class="news">
	<?php if(is_array($collect_list)): $i = 0; $__LIST__ = $collect_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="list load_collect"
		   data-url = "<?php echo U('Index/index/info',array('artId'=>$vo['article_id']));?>"
		   data-targe="<?php echo ($vo['collect_tag']); ?>"
		   href="<?php echo U('Index/index/info',array('artId'=>$vo['article_id'],'collect_id'=>$vo['id']));?>">
			<div class="time">发文：<?php echo (date("Y-m-d",$vo["add_time"])); ?></div>
			<div class="title"><?php echo ($vo["title"]); ?></div>
			<div class="form"><?php echo ($vo["author"]); ?></div>
		</a><?php endforeach; endif; else: echo "" ;endif; ?>

</div>
<script>
	$(document).on("click",".load_collect",function () {
		var _this = $(this);
		var url =_this.data('url');
		var targe = _this.data('targe');
		window.location.href = url+targe;
	});
</script>
	<div class="footer"><img src="/Public/index/img/logo.jpg"/>
		<span>重庆市公安消防总队制</span><b>2017</b>
		
</div></body>
</html>