<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>汽车查询</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="format-detection" content="telephone=no">
	<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
	<link rel="stylesheet" href="__PUBLIC__/index/css/index.css" />
</head>
<body >
<div class="head">
	<a href="/" class="logo"><img src="__PUBLIC__/index/css/logo.png" width="140px"></a>

	<h2 >汽车机油查询</h2>
</div>
<div>
	<form  id="form_2"  action="<?php echo U('index/index/car_detail');?>" method="post" role="form"  multiple="multiple" SIZE="2" class="info">
		<div class="field clearfix">
			<div class="label">品牌</div>
			<div class="field-control">
				<a class="btn-select">
					<select name="brand_id" id="brand" class="car_info" data_type="brand">
						<option value=" " style="background: #fff;">请选择品牌</option>
						<?php if(is_array($brandList)): $i = 0; $__LIST__ = $brandList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['brand_id']); ?>"><?php echo ($vo['brand']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select></a>
			</div>
		</div>
		<div class="field clearfix">
			<div class="label">车系</div>
			<div class="field-control"><a class="btn-select">
				<select name="series_id"  id="series" class="car_info" data_type="series">
					<option value=" ">请选择车系</option>
				</select></a>
			</div>
		</div>
		<div class="field clearfix">
			<div class="label">车型</div>
			<div class="field-control"><a class="btn-select">
				<select name="version_id" id='version' style="width: 100%">
					<option value=" ">请选择车型</option>
				</select></a>
			</div>
		</div>
		<div class="submit" >
			<button type="button" id="form_submit">查询</button>
		</div>
	</form>
</div>
<script>
	$(function(){
		//alert(1);
		$('.car_info').change(function () {
			var _this = $(this);
			var type = _this.attr('data_type');
			var id = _this.val();
			$.ajax({
				url:"<?php echo U('index/index/getSeriesVersion');?>",
				dataType : 'JSON',
				data:{type: type , id : id},
				type : 'POST',
				success : function(res){
					if(res.status){
						$("#"+res.type).html(res.list);
						//console.log(res);
					}else{
						layer.msg(res.msg, {icon: 5});
					}
				}
			});

		});
		$('#form_submit').click(function () {
			var brand_id = $('#brand').val();
			var series_id = $('#series').val();
			var version_id = $('#version').val();
			if(brand_id > 0){
				if(series_id > 0){
					if(version_id > 0){
						$('#form_2').submit();
					}else {
						alert('请选择车型');
					}
				}else {
					alert('请选择车系');
				}
			}else {
				alert('请选择品牌');
			}
		});
	});
</script>
</body>
</html>