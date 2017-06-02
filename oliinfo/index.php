<?php
header("Content-Type:text/html;charset=utf-8");

/*$brand_list = M('cars')->field(' brand_id,brand ')->where($where)->group('brand_id')->select();*/
$dsn = "mysql:host=localhost;dbname=zenro";
$username = "zenro";
$password = "zn112233";
$pdo = new PDO($dsn,$username,$password);//获取数据库对象
$pdo->query("SET NAMES 'utf8'");
if (isset($_POST['type'])){
	$data = array();
	$data['status'] = 0;
	if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'brand'){
		$query_series = "SELECT series_id,series FROM zncars WHERE version_id <> 0  AND brand_id = ". $_REQUEST['id']." GROUP BY series_id";
		$pdoS_series=$pdo->query($query_series);
		$series_options= '<option value="null">请选择车系</option>';
		foreach ($pdoS_series as $k => $v){
			$series_options .= '<option value="'.$v['series_id'].'">'.$v['series'].'</option>';
		}

		$data['status'] = 1;
		$data['type'] = 'series';
		$data['list'] = $series_options;
		echo json_encode($data);die();
	}elseif(isset($_REQUEST['type']) && $_REQUEST['type'] == 'series'){
		$query_version = "SELECT version_id,version FROM zncars WHERE version_id <> 0  AND series_id = ". $_REQUEST['id']." GROUP BY version_id";
		$pdoS_version=$pdo->query($query_version);
		$version_options= '<option value="null">请选择车型</option>';
		foreach ($pdoS_version as $k => $v){
			$version_options .= '<option value="'.$v['version_id'].'">'.$v['version'].'</option>';
		}

		$data['status'] = 1;
		$data['type'] = 'version';
		$data['list'] = $version_options;
		echo json_encode($data);die();
	}
	$data['msg'] = '请先选择品牌';
	echo json_encode($data);die();
}
$query_brand = "SELECT brand_id,brand FROM zncars WHERE version_id <> 0 GROUP BY brand_id";
$pdoS_brand=$pdo->query($query_brand);//品牌数组对象


?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>汽车查询</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="format-detection" content="telephone=no">
	<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body >
<style>
	
	html,body{ max-width: 480px; padding: 0;margin: 0 auto; height: 100%}
	.head{ height: 200px; background-image: url( ../statics/images/zenro/xyzs.png); background-repeat: no-repeat; background-size:100% auto; position: relative;}
	.head .logo{ padding: 20px 0 0 20px; display: none;}
	.head a{ position: relative;z-index: 10; padding-top: 20px; display: block}
	.head h2{ position: absolute; bottom:-9px; color: #fff; font-size:40px; font-family: "microsoft yahei"; font-weight: 400;  padding: 0 0 0 20px; margin: 0; display: none}
	.info{ padding:20px; position: absolute; height: 100%; padding-top: 120px;top: 0; box-sizing: border-box; width: 100%;max-width: 480px;}
	.submit{ width: 100%;max-width: 480px; position: absolute; bottom:0; padding: 20px; box-sizing:border-box; left: 0}
	button{ display: block; position:relative; width: 100%;  height: 46px;line-height: 46px; text-align: center; border-radius: 3px; color: #fff; background-color: #f90; border:none; font-size: 20px;}
	.field { height: 60pxp; line-height: 60px; border-bottom: 1px dotted #e0e0e0; padding: 10px 0; font-family: 'microsoft yahei'; font-size: 16px; font-weight: 100;}
	.field .label{ width: 20%; line-height: 40px; padding: 10px 0; float: left; text-align: center}
	.field .field-control{ width: 76%; float:left; padding: 10px 0}
	.field .field-control a {
    height: 40px;
    border-radius: 20px;
    background-color: #f4f4f4;
    display: block;
    width: 100%;
    line-height: 40px;
    padding:0 20px; box-sizing: border-box
}
	select{ border: none; background: #f2f2f2; width: 100%}
	.clearfix:after { visibility: hidden; display: block; font-size: 0; content: " "; clear: both; height: 0; }
.clearfix { *zoom:1;
}

	</style>
<div class="head">
	<a href="/" class="logo"><img src="../statics/images/zenro/logo.png"/ width="140px"></a>

<h2 >汽车机油查询</h2>
</div>
<div>
	<form  id="form_2"  action="car_detail.php" method="post" role="form"  multiple="multiple" SIZE="2" class="info">
		<div class="field clearfix">
			<div class="label">品牌</div>
			<div class="field-control">
			<a class="btn-select"> 
				<select name="brand_id" id="brand" class="car_info" data_type="brand">
					<option value=" " style="background: #fff;">请选择品牌</option>
					<?php
					foreach($pdoS_brand as $value){
						echo '<option value="'.$value['brand_id'].'">'.$value['brand'].'</option>';
					};
					?>
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
				url:"index.php",
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
