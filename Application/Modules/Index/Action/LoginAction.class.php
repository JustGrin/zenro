<?php
// 前台控制器，继承公共目录下的HomeAction，方便公共数据调用
class LoginAction extends BaseAction {
	//魔术方法
	public function __construct(){
		parent::__construct();
		$this->check_login();
	}
	public function  index(){

		$this->display();
	}
	//检测是否登陆
	public function check_login(){

		///$url=GROUP_NAME.'/'.MODULE_NAME.'/'.ACTION_NAME;

		$url=GROUP_NAME.'/'.MODULE_NAME;
		$url=strtolower($url);//大写转成小写
		$not_check=array(
			'index/login',
		);
		if(!in_array($url, $not_check)){
			if(IS_AJAX){
				$data['status']=0;
				$data['code']='loginOutTime';
				$data['error']="登录超时，请重新登录，";
				$data['msg']="登录超时，请重新登录，";
				if(empty($_SESSION["user"])){
					echo json_encode($data);
					exit();
				}
				if(empty($_SESSION["user"]['uid'])){
					echo json_encode($data);
					exit();
				}
			}
			if(empty($_SESSION["user"])||empty($_SESSION["user"]['uid'])){
				$this->redirect("index/login/index");
				exit();
			}
		}
	}
	///登录
	public function dologin(){
		$data['status']=0;
		$userName = isset($_POST['userName']) ? $_POST['userName'] : '';
		$mem_password = isset($_POST['mem_password']) ? $_POST['mem_password'] : '';
		if(empty($userName)){
			$data['error']="用户名不能为空";
			echo json_encode($data);die;
		}
		if(empty($mem_password)){
			$data['error']="密码不能为空";
			echo json_encode($data);die;
		}

		$where['userName']=$userName;
		$userInfo= M("admin")->where($where)->find();
		if(empty($userInfo)) {
			$data['error']="用户名不存在";
			echo json_encode($data);die;
		}
		if($userInfo['password']!=md5($mem_password)) {
			$data['error']="密码错误";
			echo json_encode($data);die;
		}
		//记录session信息
		$user_data['uid']=$userInfo['id'];
		$user_data['userName']=$userInfo['userName'];
		$_SESSION['user']=$user_data;
		$this->set_session_id();//重设 session_id 时间
		$data['return_url']=$this->get_return_url();
		$data['status']=1;
		echo json_encode($data);die;
	}

	public function get_return_url(){
		$get_return_url=session('wap_login_return');
		if(empty($get_return_url) || strpos("$get_return_url","index/login/")  ){
			$get_return_url=U('index/user/index');
		}
		return $get_return_url;

	}
	public function loginout(){
		unset($_SESSION['user']);
		session('wap_login_return',null);
		redirect(U('Index/Login/index'));
	}


	//注册界面
	public function register(){
		$this->display();
	}

	//注册
	public function doregister(){

		$data['status']=0;
		$mem_password=$_POST['mem_password'];
		$rep_password=$_POST['rep_password'];
		$userName=$_POST['userName'];

		//检测用户名
		$userName_return=$this->check_userName_return();
		if(isset($userName_return['error']) && $userName_return['error']){
			$data['error']=$userName_return['error'];
			echo json_encode($data);die;
		}

		//注册验证 密码 是否为空 两次密码是否一致
		$password_return=$this->check_password_return();
		if($password_return['error']){
			$data['error']=$password_return['error'];
			echo json_encode($data);die;
		}

		//注册
		$u_data['userName'] = $userName;
		$u_data['add_time']=time();
		$u_data['password']=md5($mem_password);

		$user_model=M("admin");
		$user_detail_model=M('user_detail');

		$user_model->startTrans();//开起事务
		$user_detail_model->startTrans();//开起事务

		$add=$user_model->add($u_data);

		$u_data_detail['user_id']=$add;//
		$user_detail_add=$user_detail_model->add($u_data_detail);

		if($add!==false && $user_detail_add!==false){
			//注册成功
			$data['status']=1;
			$user_model->commit();//提交事务
			$user_detail_model->commit();//提交事务
			$this->dologin();
		}else{
			$user_model->rollback();//回滚事务
			$user_detail_model->rollback();//回滚事务
			$data['error']="系统错误请稍候再试";
		}
		echo json_encode($data);
	}
	//注册验证 密码 是否为空 两次密码是否一致
	public function check_password_return(){
		$mem_password=$_POST['mem_password'];
		$rep_password=$_POST['rep_password'];

		if(empty($mem_password)){
			$data['error']="密码不能为空";
			return $data;
		}
		if(strlen($mem_password) < 6){
			$data['error']="密码至少为六位数";
			return $data;
		}
		if(empty($rep_password)){
			$data['error']="重复密码不能为空";
			return $data;
		}
		if($rep_password != $mem_password){
			$data['error']="两次密码不一致";
			return $data;
		}
		return array('status'=>1);
	}
	public function check_userName_return(){
		$userName = $_POST['userName'];
		if(empty($userName)){
			$data['error']="用户名不能为空";
			return $data;
		};
		$where['userName'] =$userName;
		$is_exist = M("admin")->where($where)->count();
		if($is_exist >= 1){
			$data['error']="该用户名已被注册";
			return $data;
		}
		return true;
	}


}