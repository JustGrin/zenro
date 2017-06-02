<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>无标题文档</title>
	<script type="text/javascript" src="__PUBLIC__/index/js/flexible.js"></script>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/index/css/css.css" />
	<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js" ></script>
</head>
<body class="info">
<div class="infotitle">
	<div class="time">发文：<?php echo (date('Y-m-d',$data['add_time'])); ?></div>
	<div class="title"><?php echo ($data['title']); ?></div>
	<div class="form"><?php echo ($data['author']); ?></div>
</div>
<?php if(empty($data['sub'])): else: ?>
	<div class="list">
		<?php if(is_array($data['sub'])): $i = 0; $__LIST__ = $data['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('index/index/info',array('artId'=>$vo['id']));?>"><?php echo ($vo['title']); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
	</div><?php endif; ?>
<div class="content">
	<div class="addf"  id="add_collect">加入收藏</div>
	<p><?php echo ($data['content']); ?></p>
</div>
sfdsfd
<br>
<div style="height: 1000px;width: 100px;background-color: #00a0e9">
</div>

<div style="height: 1000px;width: 100px;background-color: #00a0e9">
</div>
<div class="collect_label" id="collect_2">
	收藏标签2
</div>
<div style="height: 1000px;width: 100px;background-color: #00a0e9">
</div>
<div class="collect_label" id="collect_3">
	收藏标签3
</div>
<div style="height: 1000px;width: 100px;background-color: #00a0e9">
</div>
<div class="collect_label" id="collect_4">
	收藏标签4
</div>
<div style="height: 1000px;width: 100px;background-color: #00a0e9">
</div>
<div class="collect_label" id="collect_5">
	收藏标签5
</div>
<div style="height: 1000px;width: 100px;background-color: #00a0e9">
</div>
<div class="collect_label" id="collect_6">
	收藏标签6
</div>
<div style="height: 1000px;width: 100px;background-color: #00a0e9">
</div>
<div class="collect_label" id="collect_7">
	收藏标签7
</div>
<div style="height: 1000px;width: 100px;background-color: #00a0e9">
</div>
<div class="collect_label" id="collect_8">
	收藏标签8
</div>
	<div class="footer"><img src="/Public/index/img/logo.jpg"/>
		<span>重庆市公安消防总队制</span><b>2017</b>
		
</div>


<script>


	var artId = "<?php echo ($data['id']); ?>";
	var collect_tag = "<?php echo ($data['collect_tag']); ?>";
	//滚动到收藏的位置
	setTimeout(function () {
		window.scrollTo(0,collect_tag);
	},500);
//点击收藏
	$(document).on("click","#add_collect",function () {
		var scrollInfo = getPageScroll();
		data = {artId:artId,collect_tag:scrollInfo.Y};
		console.log(data);
		cllect_this(data);
	});
	function cllect_this(data) {
		var option ={
			url:"<?php echo U('Index/User/collect_article');?>",
			data:data,
			type:"post",
			dataType:"json",
			success:function (res) {
				console.log(res);
				try{
					if(res.code =='loginOutTime' ){
						if(confirm(res.msg)){
							window.location.href ='<?php echo U("Index/Login/index");?>';
						}else {}
					}else {
						alert(res.msg);
					}
				} catch(ex){}
			}
		};
		$.ajax(option);
	}
	//获取当前位置
	function getPageScroll() {
		var x, y;
		if(window.pageYOffset) {    // all except IE
			y = window.pageYOffset;
			x = window.pageXOffset;
		} else if(document.documentElement && document.documentElement.scrollTop) {    // IE 6 Strict
			y = document.documentElement.scrollTop;
			x = document.documentElement.scrollLeft;
		} else if(document.body) {    // all other IE
			y = document.body.scrollTop;
			x = document.body.scrollLeft;
		}
		return {X:x, Y:y};
	}

</script>
</body>
</html>