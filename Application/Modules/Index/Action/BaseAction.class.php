<?php

class BaseAction extends CommonAction {

	public function __construct(){
		parent::__construct();

		$cook_time="604800";//7天 7*24*60*60
		$s_session_id=session('session_id');
		$c_session_id=cookie('session_id');
		if($s_session_id){
			$user = session('user');
			$this->uid = $user['uid'];
			$this->userName = $user['userName'];

		}else{
			if(empty($c_session_id)){
				$c_session_id=makeSessionID();
				$c_session_id=md5($c_session_id);
				cookie('session_id',$c_session_id,$cook_time);
			}
			session('session_id',$c_session_id);
		}
		if(!IS_AJAX){
			$this->wap_login_return();
		}
    }

	//重设 session_id 时间
	public function set_session_id(){
		$cook_time=604800*2;//7*2天 7*24*60*60*2
		$s_session_id=session('session_id');
		cookie('session_id',$s_session_id,$cook_time);
	}

  //检查是否记住密码
  public function check_login_rember(){

    if(empty($_SESSION["member"]['uid'])){
        $s_session_id=session('session_id');
       //记录session信息
       $cook_time=604800*2;
       $time=time()-$cook_time;
       $where=array('session_id'=>$s_session_id);
       $where['add_time']=array('gt',$time);
       $member=M('member_rember_token')->where($where)->find();
       if($member){
        $user_open_id=$member['openid'];
        $member=M('member')->where(array('id'=>$member['member_id']))//
        ->field('id,member_name,member_card,mobile')->find();
        if($member){
          if($user_open_id){
            session('user_open_id',$user_open_id);
              //openod 默认绑定openid
             M('member')->where(array('id'=>$member['id']))->save(array('openid'=>$user_open_id));
          }
           $user_data['uid']=$member['id'];
          $user_data['member_card']=$member['member_card'];
          $user_data['member_name']=$member['member_name'];
          $user_data['mobile']=$member['mobile'];
          $_SESSION['member']=$user_data;
        }
       }
    }
  }

  ///获取上次url
  public function wap_login_return(){
       $REQUEST_URI=$_SERVER['REQUEST_URI'];
       $notcheck=array(
        'wap/login',
         'wap/index/get_thumbs',
         'wap/member/updatepwd'
        );
       if ($REQUEST_URI) {
         $chk=1;
         foreach ($notcheck as $key => $value) {
           if(stristr($REQUEST_URI,$value)){
             $chk=0;
             break;
           }
         }
         if($chk){
          $url='HTTP://'.$_SERVER['HTTP_HOST'].$REQUEST_URI;
          session('wap_login_return',$url);
         }
       }
       //当前记录的url 是login里面的清空
        $wap_login_return=session('wap_login_return');
        if ($wap_login_return) {
         $chk_y=0;
         foreach ($notcheck as $key => $value) {
           if(stristr($wap_login_return,$value)){
             $chk_y=1;
             break;
           }
         }
         if($chk_y){
          session('wap_login_return',null);
         }
       }

    }
	//获取登录状态
    public function get_member_login(){
		if(empty($_SESSION["user"])){
			return false;
		}
		if(empty($_SESSION["user"]['uid'])){
			return false;
		}
		return true;
    }


    ///获取用户信息
    public function getUserInfo(){
        //
        if(empty($this->uid)){
			return array();die;
		}
		$where['id']=$this->uid;
		$userinfo=M('user')->where($where)->find();
		return $userinfo;
    }
}