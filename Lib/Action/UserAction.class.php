<?php
	class UserAction extends BaseAction
	{
		public function _initialize()
		{}
		
		//表单数据名=>用户信息表列名
		private $tableName = array('userName'=>'real_name',
									'email'=>'email',
									'phone'=>'phone',
									'pass'=>'password',
									'regi_time'=>'regi_time',
									'checked'=>'checked'
									);
		public function UserMenu()
		{
			if($this->logined())
			{
				$data = D("Order")->getOrderByUid($_SESSION['user']['uid']);
				foreach ($data['list'] as $key => $value) {
					$data['list'][$key]["ca"] = M("clothes_accessory")->where(array("id"=>$value['caid']))->limit("0,1")->select();
					$data['list'][$key]["ca"] = $data['list'][$key]["ca"][0];
					$data['list'][$key]['color'] = M("color")->where(array("id"=>$value['cacolor']))->limit("0,1")->select();
					$data['list'][$key]['color'] = $data['list'][$key]['color'][0];
				}
				$this->assign("list",$data['list']);
				$this->assign("page",$data['show']);
				$this->display();
			}
			else
				header("location:".U("Index/index"));
		}

		public function logined()
		{
			if(isset($_SESSION['user']))
				return true;
			else
				return false;
		}

		public function ajax_logined()
		{
			if($this->logined())
				$this->ajaxReturn("logined",0,1);
			else
				$this->ajaxReturn("unlogined",1,0);
		}

		public function loginout()
		{
			unset($_SESSION['user']);
			setcookie("user","",time()-3600);
			$this->success("退出成功");
			return true;
		}

		public function login($userData=null)
		{
			/**
			 *email
			 *pass
			*/
			$userData = $_REQUEST;
			$user = new UserModel();
			$result = $user->checkLogin($userData);
			if(!is_numeric($result))
			{
				$_SESSION['user'] = $result;
				$result = 0;
				if(!empty($_REQUEST['rememberme']))
					setcookie('user',serialize($_SESSION['user']),time()+604800);
				$this->success("登陆成功");
				return;
			}
			$this->error("登陆失败，请检查填写的信息");
			//$this->ajaxEcho($result);
			return;
		}
		
		public function register($userData=null)
		{
			$this->checkVerify();
			$userData = $_REQUEST;
			//未验证标注
			$userData['checked'] = 0;
			//注册时间
			$userData['regi_time'] = time();
			/*
				$err
					0 无异常
					20 未知错误 数据库
					21 未知错误 邮件
					3 信息不完整
					4 重复注册
			*/
			$err = 0;
			//验证信息是否完整
			foreach($this->tableName as $key=>$value)
			{
				if(empty($userData[$key])&&$key!="checked")
				{
					$err = 3;
					$this->ajaxEcho($err,array("key"=>$key),true,"信息不完整",2);
					return;
				}
			}
			$user = new UserModel();
			//验证是否重复注册
			$udata = $user->where("`email` = '%s'",$userData['email'])->select();
			if(!empty($udata))
			{
				if($udata[0]['checked']!=0)
				{
					$err = 4;
					$this->ajaxEcho($err,null,true,"已存在此用户",2);
					return;
				}
				else
				{
					$user->where("`email` = '%s'",$userData['email'])->delete();
				}
			}
			//密码加密
			$userData['pass'] = md5($userData['pass']);
			
			$userData = $this->UserDataWrap($userData);
			
			$err = $user->register($userData);
			$this->ajaxEcho($err,null,true,"注册成功",1);
			return;
		}
		
		//找回密码
		public function forgetPW($uname,$email)
		{
			$err = 0;
			$user = new UserModel();
			$udata = $user->where("`email` = '%s'",array($email))->limit(1)->select();
			if(empty($udata)||$udata[0]['checked']==0)
			{
				$err = 5;
				$this->ajaxEcho($err);
				return;
			}
			if($uname!=$udata[0]['real_name'])
			{
				$err =7;
				$this->ajaxEcho($err);
				return;
			}
			$user_extra = new CommonModel("user_extra");
			$key = time();
			$uextra = $user_extra->where("`uid` = '%d'",array($udata[0]['uid']))->limit(1)->select();
			if(empty($uextra))
				$user_extra->add(array('uid'=>$udata[0]['uid'],'PWId'=>$key));
			else
				$user_extra->save(array('uid'=>$udata[0]['uid'],'PWId'=>$key));
			$user->sendFindPassEmail($udata[0]['email'],$udata[0]['real_name'],$udata[0]['uid'],$key);
			$this->ajaxEcho($err);
			return;
		}
		
		//显示修改密码页面
		public function changePWPage($ukey,$key)
		{
			$err = 0;
			if(!$this->checkChangePWParam($ukey,$key))
			{
				$err = 8;
				$this->ajaxEcho($err);
				return;
			}
			//test
			//$this->ajaxEcho($err);
			$url = "http://".$_SERVER['HTTP_HOST'].'/'.APPNAME."/index.php/User/changePW/ukey/".$ukey."/key/".$key."/newPW/111"; 
			$this->show("</br><a href='$url'>$url</a>");
			return;
		}
		
		//更改密码
		public function changePW()
		{
			/*
				userData:
					ukey
					key
					newPW
			*/
			$userData = $_REQUEST;
			$ukey = $userData['ukey'];
			$key = $userData['key'];
			$newPW = $userData['newPW'];
			$err = 0;
			//安全参数验证
			if(!$this->checkChangePWParam($ukey,$key))
			{
				$err = 8;
				$this->ajaxEcho($err);
				return;
			}
			$user = new UserModel();
			$user->where("`uid` = '%d'",array($ukey))->save(array('password'=>md5($newPW)));//修改密码
			$user_extra = new CommonModel("user_extra",'txl_');
			$user_extra->where("`uid` = '%d'",array($ukey))->save(array('PWId'=>"NO"));
			$this->ajaxEcho($err);
			return;
		}

		//修改密码参数验证
		private function checkChangePWParam($ukey,$key)
		{
			$user_extra = new CommonModel("user_extra");
			$user_extradata = $user_extra->where("`uid` = '%d'",array($ukey))->select();
			if(empty($user_extradata)||$key!=$user_extradata[0]['PWId']||$key=="NO")
				return false;
			if((time()-intval($user_extradata[0]['PWId']))>1800)
			{
				$user_extra->where("`uid` = '%d'",array($ukey))->save(array('PWId'=>"NO"));
				return false;
			}
			return true;
		}
		
		
		//注册邮件验证
		public function emailcheck($ukey,$key,$mail)
		{
			//检查数据是否被篡改
			if(md5($ukey+$mail)!=$key)
			{
				echo "数据错误";
				return;
			}
			$user = new UserModel();
			$udata = $user->where("uid = %d",$ukey)->select();
			//检测链接是否过期 3天 
			if((time()-intval($udata[0]['regi_time']))>259200)
			{
				$user->where("uid = %d",$ukey)->delete();
				echo "验证链接过期，请重新注册";
				return;
			}
			$data['uid'] = $ukey;
			$data['checked'] = 1;
			$user->save($data);
			echo "验证成功";
		}

		/*
			type: 0 redirect , 1 success , 2 error	
		*/
		private function ajaxEcho($errorCode,$arr,$jump=false,$msg=null,$type=0)
		{
			if($jump===true)
			{
				switch ($type) {
					case 0:
						
						break;
					case 1:
						$this->success($msg);
						break;
					case 2:
						$ths->error($msg);
						break;
				}
				return;
			}
			$error = "";
			foreach($arr as $key=>$value)
				$error = $key."->".$value." | ";
			switch($errorCode)
			{
				case 0:
					$this->ajaxReturn("注册成功 ".$error,0,1);
					break;
				case 20:
					$this->ajaxReturn("数据写入错误 ".$error,20,0);
					break;
				case 21:
					$this->ajaxReturn("邮件发送失败 ".$error,21,0);
					break;
				case 3:
					$this->ajaxReturn("用户数据错误 ".$error,3,0);
					break;
				case 4:
					$this->ajaxReturn("该邮箱已被使用 ".$error,4,0);
					break;
				case 5:
					$this->ajaxReturn("无此用户 ".$error,5,0);
					break;
				case 6:
					$this->ajaxReturn("密码错误 ".$error,6,0);
					break;
				case 7:
					$this->ajaxReturn("用户名和邮箱不匹配 ".$error,7,0);
					break;
				case 8:
					$this->ajaxReturn("修改密码失败 ".$error,8,0);
					break;
			}
		}
		
		private function UserDataWrap($userData)
		{
			$data = array();
			foreach($this->tableName as $key=>$value)
			{
				$data[$value] = $userData[$key];
			}
			return $data;
		}
	}