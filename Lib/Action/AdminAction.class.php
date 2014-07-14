<?php
	class AdminAction extends BaseAction
	{

		private $noLoginCheck = array("login");

		public function _initialize()
		{
			parent::_initialize();
			if(in_array(ACTION_NAME, $this->noLoginCheck))
			{}
			else
			if(!isset($_SESSION['admin_user']))
			{
				$this->displayTpl("login");
			}
		}

		public function index()
		{
			$this->login();
		}

		public function login()
		{
			if(isset($_SESSION['admin_user']))
			{
				$this->redirect("Admin/main",0);
				return;
			}
			if(IS_POST)
			{
				$this->displayTpl("main");
			}
			else
			{
				$this->displayTpl("login");
			}
		}

		public function main()
		{
			$this->displayTpl();
		}

		public function menu()
		{
			$this->displayTpl();
		}

		public function stock()
		{
			//$this->displayTpl();
		}

		public function changephoto()
		{
			$data = M('slide')->select();
			$this->assign('data',$data);
			$this->displayTpl();
		}

		public function item_up()
		{
			$this->displayTpl();
		}

		public function other_manage()
		{
			$_REQUEST['type'] = empty($_REQUEST['type'])?1:$_REQUEST['type'];
			$ca = D("CA");
			$data = $ca->getPaginateData(1,array('accessory_type'=>$_REQUEST['type']));
			$this->assign('list',$data["list"]);
			$this->assign('page',$data["show"]);
			$this->displayTpl();
		}

		public function positive_manage()
		{
			$gender = empty($_REQUEST['gender'])?0:1;
			$ca = D("CA");
			$data = $ca->getPaginateData(0,array('gender'=>$gender));
			$this->assign('list',$data["list"]);
			$this->assign('page',$data["show"]);
			$this->displayTpl();
		}

		public function user_manage()
		{
			$data = D("User")->getPaginateUserList();
			$this->assign('list',$data["list"]);
			$this->assign('page',$data["show"]);
			$this->displayTpl();
		}

		public function adminList()
		{
			$right = empty($_GET['right'])?1:$_GET['right'];
			$m = new Model();
			$data = $m->table('sx_admin_user a,sx_usergroup u')->where("a.gid=u.id AND u.right=$right")->field("a.*,u.name")->select();
			$this->assign("list",$data);
			$this->displayTpl("adminList");
		}

		public function send_passage()
		{
			$this->displayTpl();
		}

		public function edit()
		{
			if(empty($_GET['id'])){echo "链接错误";return;}
			$data = D("CA")->where(array("id"=>$_GET['id']))->select();
			$this->assign("item",$data[0]);
			$this->assign("edit",true);
			$this->displayTpl('item_up');
		}

		public function article()
		{
			$this->displayTpl('edit');
		}

		protected function logined()
		{
			return isset($_SESSION['admin_user']);
		}

		public function login_out()
		{
			$_SESSION['admin_user'] = null;
			$this->redirect("Admin/login",0);
		}

		public function order_on()
		{
			$data = D("Order")->getUnCompleteOrder();
			$this->assign("list",$data['list']);
			$this->assign("page",$data['show']);
			$this->displayTpl("order_on");
		}

		public function order_complete()
		{
			$data = D("Order")->getCompleteOrder();
			$this->assign("list",$data['list']);
			$this->assign("page",$data['show']);
			$this->displayTpl();
		}

		public function adminAdd()
		{

			$this->displayTpl("adminAdd");
		}

		public function adminModify()
		{
			if(empty($_GET['id'])){echo "链接错误";return;}
			$data = M("admin_user")->where(array("id"=>$_GET['id']))->select();
			$this->assign("item",$data[0]);
			$this->assign("edit",true);
			$this->displayTpl('adminAdd');
		}

		private function displayTpl($tplName=null)
		{
			if(empty($tplName))
			{
				$tplName = ACTION_NAME;
			}
			$path = APP_PATH."./Tpl/SPage/admin/".$tplName.'.html';
			$this->display($path);
		}
	}