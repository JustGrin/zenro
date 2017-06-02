<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>基本信息</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="__PUBLIC__/index/css/car_detail.css" />
</head>
<body class="login">
<div class="head">
	<h2 >查询结果</h2>
</div>
<div class="info">
	<div class="field clearfix">
		<div class="label">品牌：</div>
		<div class="field-control">
			<?php echo ($data['brand']); ?>
		</div>
	</div>
	<div class="field clearfix">
		<div class="label">车系：</div>
		<div class="field-control">
			<?php echo ($data['series']); ?>
		</div>
	</div>
	<div class="field clearfix">
		<div class="label">车型：</div>
		<div class="field-control">
			<?php echo ($data['version']); ?>
		</div>
	</div>
	<div class="field clearfix">
		<div class="label">档位描述：</div>
		<div class="field-control">
			<?php echo ($data['gear_desc']); ?>
		</div>
	</div>
	<div class="field clearfix">
		<div class="label">变速箱品牌：</div>
		<div class="field-control">
			<?php echo ($data['gearbox_brand']); ?>
		</div>
	</div>
	<div class="field clearfix">
		<div class="label">波箱型号：</div>
		<div class="field-control">
			<?php echo ($data['gear_version']); ?>
		</div>
	</div>
	<div class="field clearfix">
		<div class="label">建议使用油品：</div>
		<div class="field-control">
			<?php echo ($data['recommend_oil']); ?>
		</div>
	</div>
	<div class="field clearfix">
		<div class="label">原厂初装用量：</div>
		<div class="field-control">
			<?php echo ($data['original_d']); ?>
		</div>
	</div>
	<div class="field clearfix">
		<div class="label">重力更换推荐用量：</div>
		<div class="field-control">
			<?php echo ($data['gravity_c_d']); ?>
		</div>
	</div>
	<div class="field clearfix">
		<div class="label">机器循环清洗更换推荐用量：</div>
		<div class="field-control">
			<?php echo ($data['clean_c_d']); ?>
		</div>
	</div>
	<div class="field clearfix">
		<div class="label">机油型号：</div>
		<div class="field-control">
			<?php echo ($data['engine_oil_v']); ?>
		</div>
	</div>
	<div class="field clearfix">
		<div class="label">机油量：</div>
		<div class="field-control">
			<?php echo ($data['oid_dosage']); ?>
		</div>
	</div>

	<div class="submit" >
		<a href="<?php echo U('index/index/index');?>">继续查询</a>
	</div></div>

</body>
</html>