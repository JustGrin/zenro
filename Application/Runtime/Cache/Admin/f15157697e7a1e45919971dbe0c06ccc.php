<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="__PUBLIC__/dist/css/public.min.css" />
    <link rel="stylesheet" href="__PUBLIC__/dist/css/bootstrap.min.css" />
    <script src="__PUBLIC__/js/jquery.min.js" type="text/javascript"></script>
    <script>
        var jsPath ="";
    </script>
    <script src="__PUBLIC__/dist/js/public.min.js" type="text/javascript"></script>
    <style>
        .row {
            margin: 20px;
        }
    </style>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="col-md-8" id="addInto">

				</div>
				<div class="col-md-3 ">
					<button type="button" id="add" class="btn btn-info">添加文章标题</button>
				</div>
			</div>
		</div>
		<div role="row">
			<div class="col-md-8">
				<table class="table " id="categoryTable">
					<?php if(is_array($categoryList)): $i = 0; $__LIST__ = $categoryList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr data-id="<?php echo ($vo["id"]); ?>">
							<th class="col-md-8 category_name" ><?php echo ($vo["category_name"]); ?></th>
							<th>
								<button type="button" class="btn btn-success edit">编辑</button>
								&nbsp;
								<button type="button" class="btn btn-danger del">删除</button>
							</th>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</table>
			</div>
		</div>
	</div>
	<input type="hidden" id="editState" value="0">
<script>
	$(function () {
		var editState = $("#editState");
		event();

		function event() {
			//编辑按钮事件
			$(document).on("click",".edit",function () {
				var $tr = $(this).parent().parent();
				var editting = editState.val();
				if(editting != 1){
					var $category_name = $tr.find(".category_name").text();
					$tr.find(".category_name").html('<input type="text" class="form-control" data-old="'+$category_name+'" id="category_name" value="'+$category_name+'" placeholder="请输入分类名">');
					$("#category_name").focus();
					editState.val(1);
					bindeditinput();
				}

			});
			//删除事件
			$(document).on("click",".del",function () {
				var $tr = $(this).parent().parent();
				var $id = $tr.data("id");
				var $data ={id:$id};
				submitChange(0,$data);
				$tr.remove();
			});

			//点击添加按钮事件
			$(document).on("click","#add",function () {
				var _parent = $("#addInto");
				var editting = editState.val();
				if(editting != 1){
					var inputOption = '<input type="text" class="form-control"  id="category_name"  placeholder="请输入分类名"/>';
					_parent.html(inputOption);
					_parent.find("input").focus();
					editState.val(1);
					bindaddinput();
				}
			});
		}
		//修改框
		function bindeditinput() {
			$(document).on("blur","#category_name",function () {
				var $tr = $(this).parent().parent();
				var $id = $tr.data("id");
				var $category_name = $(this).val();
				var $data ={id:$id,category_name:$category_name};
					$category_name = $category_name.replace(/(^\s*)|(\s*$)/g, "");
				if($category_name != ""){
					console.log(111);
					submitChange(1,$data);
				}else {
					$category_name = $(this).data("old");
				}
				console.log($category_name);
				$(this).parent().html($category_name);
				editState.val(0);
			});
		}
		//添加框
		function bindaddinput() {
			$(document).on("blur","#category_name",function () {
				var $category_name = $(this).val();
				$category_name = $category_name.replace(/(^\s*)|(\s*$)/g, "");
				if($category_name != ""){
					var $data ={category_name:$category_name};
					submitChange(1,$data);
				}
					$(this).parent().html("");
					editState.val(0);
			});
		}

		function submitChange(type,data) {
			var url = type ? "<?php echo U('admin/edit/categoryedit');?>" : "<?php echo U('admin/edit/categorydel');?>";
			var option = {
				url:url,
				data:data,
				type:"post",
				dataType:"json",
				success:function (res) {
					Talert(res.msg);
					if(res.id > 0){
						var newItem ='<tr data-id="'+ res.id+'">'+
								'<th class="col-md-8 category_name" >'+res.category_name+'</th>'+
								'<th> <button type="button" class="btn btn-success edit">编辑</button>'+
								'&nbsp;&nbsp;<button type="button" class="btn btn-danger del">删除</button> </th> </tr>'
						$("#categoryTable").append(newItem);
					}
				}
			};
			Talert({
				msg:'确定'+(type ? "编辑" : "删除")+'？',//确认框标题
				confirm:function(){
					$.ajax(option);
				}
			});
		}
	})

</script>
</body>
</html>