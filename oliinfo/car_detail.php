<?php
header("Content-Type:text/html;charset=utf-8");
$dsn = "mysql:host=localhost;dbname=zenro";
$username = "zenro";
$password = "zn112233";
$pdo = new PDO($dsn,$username,$password);//获取数据库对象
$pdo->query("SET NAMES 'utf8'");
$where = '';
if(isset($_POST['version_id'])){
	$where = "WHERE version_id = ".$_POST['version_id'];
}
$query_brand = "SELECT * FROM zncars " .$where;
$pdoS_brand=$pdo->query($query_brand);//品牌数组对象
$data=$pdoS_brand->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>基本信息</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="format-detection" content="telephone=no">
</head>
<body class="login">
<style>
	
	html,body{ max-width: 480px; padding: 0;margin: 0 auto; height: 100%;}
	.head{ height: 200px; background-image: url( ../statics/images/zenro/xyzs.png); background-repeat: no-repeat; background-size:100% auto; position: relative;}
			.head a{ position: relative;z-index: 10; padding-top: 20px; display: block}


	.head .logo{ padding: 20px 0 0 20px;}
	.head h2{ position: absolute; bottom:-9px; color: #fff; font-size:40px; font-family: "microsoft yahei"; font-weight: 400;  padding: 0 0 0 20px; margin: 0}
	.info{ padding:20px; position: absolute; height: 100%; padding-top: 120px;top: 0; box-sizing: border-box; width: 100%;max-width: 480px;}
	.submit{ width: 100%;max-width: 480px; padding:20px 0 ; box-sizing:border-box; float: left}
	.submit a{ display: block; width: 100%;  height: 46px;line-height: 46px; text-align: center; border-radius: 3px; color: #fff; background-color: #f90; border:none; font-size: 20px; text-decoration: none}
	.field { height: 40px; line-height: 40px; border-bottom: 1px dotted #e0e0e0; font-family: 'microsoft yahei'; font-size: 16px; font-weight: 100;}
	.field .label{ width: auto; display: inline;line-height: 40px; float: left; text-align: center; color: #999; font-size: 14px;}
	.field .field-control{ width:auto; float:left; color: #666}
	.clearfix:after { visibility: hidden; display: block; font-size: 0; content: " "; clear: both; height: 0; }
.clearfix { *zoom:1;
}

	</style>
<div class="head">
<!--	<a href="/" class="logo"><img src="../statics/images/zenro/logo.png"/ width="140px"></a>
-->
<h2 >查询结果</h2>
</div>
<div class="info">
<div class="field clearfix">
		<div class="label">品牌：</div>
		<div class="field-control">
			<?php echo $data['brand'];?>
		</div>
	</div>
<div class="field clearfix">
		<div class="label">车系：</div>
		<div class="field-control">
			<?php echo $data['series'];?>
		</div>
	</div>
<div class="field clearfix">
		<div class="label">车型：</div>
		<div class="field-control">
			<?php echo $data['version'];?>
		</div>
	</div>
<div class="field clearfix">
		<div class="label">档位描述：</div>
		<div class="field-control">
			<?php echo $data['gear_desc'];?>
		</div>
	</div>
<div class="field clearfix">
		<div class="label">变速箱品牌：</div>
		<div class="field-control">
			<?php echo $data['gearbox_brand'];?>
		</div>
	</div>
<div class="field clearfix">
		<div class="label">波箱型号：</div>
		<div class="field-control">
			<?php echo $data['gear_version'];?>
		</div>
	</div>
<div class="field clearfix">
		<div class="label">建议使用油品：</div>
		<div class="field-control">
			<?php echo $data['recommend_oil'];?>
		</div>
	</div>
<div class="field clearfix">
		<div class="label">原厂初装用量：</div>
		<div class="field-control">
			<?php echo $data['original_d'];?>
		</div>
	</div>
<div class="field clearfix">
		<div class="label">重力更换推荐用量：</div>
		<div class="field-control">
			<?php echo $data['gravity_c_d'];?>
		</div>
	</div>
<div class="field clearfix">
		<div class="label">机器循环清洗更换推荐用量：</div>
		<div class="field-control">
			<?php echo $data['clean_c_d'];?>
		</div>
	</div>
	<div class="field clearfix">
		<div class="label">机油型号：</div>
		<div class="field-control">
			<?php echo $data['engine_oil_v'];?>
		</div>
	</div>
	<div class="field clearfix">
		<div class="label">机油量：</div>
		<div class="field-control">
			<?php echo $data['oid_dosage'];?>
		</div>
	</div>

<div class="submit" >
	<a href="index.php">继续查询</a>
		</div></div>

</body>
</html>
