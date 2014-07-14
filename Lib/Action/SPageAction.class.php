<?php
	class SPageAction extends BaseAction 
	{

		public $curTheme = "default";
		public $tplPath = "./Tpl/SPage/theme/";

		private $category_table_name = "category";
		private $content_table_name = "content";
		private $admin_table_name = "admin_user";

		private $category = null;
		private $content = null;
		private $adminDB = null;
		private $adminUser = null;

		public function _initialize()
		{
			parent::_initialize();
			$this->category = new CommonModel($this->category_table_name);
			$this->content = new CommonModel($this->content_table_name);
			$this->adminDB = new CommonModel($this->admin_table_name);
			$this->adminUser = new AdminUser();
		}

		/**
		* /cat/1/cont/1
		* /栏目id/文章id
		* /栏目id
		*/
	    public function view()
	    {
	    	if(empty($_REQUEST['cat']))
	    	{
	    		$this->show404(array('info'=>"栏目解析错误"));
	    		return;
	    	}

	    	$cid = $_REQUEST['cat'];
			if(!empty($_REQUEST['cont']))
	    	{
	    		$aid = $_REQUEST['cont'];
	    		$contentData = $this->content->where("aid=%d",array($aid))->find();
	    		if($contentData===false||empty($contentData))
	    		{
	    			$this->show404(array('info'=>"内容解析错误"));
	    			return;
	    		}
	    		$this->content->where("aid=%d",array($aid))->save(array("views"=>intval($contentData["views"])+1));
	    		$contentData['content'] = $this->RecoverRequest($contentData['content']);
	    		$prev = $this->content->where(array("cid"=>$cid,"aid"=>array("GT",$aid)))->order("aid asc")->limit("0,1")->select();
	    		$prev = $prev[0];
	    		$next = $this->content->where(array("cid"=>$cid,"aid"=>array("LT",$aid)))->order("aid desc")->limit("0,1")->select();
	    		$next = $next[0];
	    		if(empty($prev))
	    		{
	    			$prev["name"] = "无";
	    			$prev["url"] = "#";
	    		}
	    		else
	    		{
	    			$prev["name"] = $prev["title"];
	    			$prev["url"] = U("SPage/view",array("cat"=>$cid,"cont"=>$prev['aid']));

	    		}
	    		if(empty($next))
	    		{
	    			$next["name"] = "无";
	    			$next["url"] = "#";
	    		}
	    		else
	    		{
	    			$next["name"] = $next["title"];
	    			$next["url"] = U("SPage/view",array("cat"=>$cid,"cont"=>$next['aid']));
	    		}
	    		$prev["link"] = "<a href='".$prev["url"]."'>".$prev["name"]."</a>";
	    		$next["link"] = "<a href='".$next["url"]."'>".$next["name"]."</a>";
	    		$this->assign($contentData);
	    		$this->assign("prev",$prev);
	    		$this->assign("next",$next);
	    		$this->displayTpl($contentData['tplname']);
	    	}
	    	else
	    	{
	    		$categoryData = $this->category->where("cid=%d",array($cid))->find();
	    		$this->assign($categoryData);
	    		if($categoryData["type"]==0)//列表栏目
	    		{
	    			import('ORG.Util.Page');
	    			$LinksperPage = 30;//每页链接条数

	    			$extraArr = array();
	    			$count = $this->content->where("cid=%d",array($cid))->count();
	    			$extraArr['count'] = $count;
	    			$page = new Page($count,$LinksperPage);
	    			$page->setConfig("theme","<li>%upPage%</li>  <li>%linkPage%</li> <li>%downPage%</li>");
	    			$extraArr['page'] = $page->show();
	    			$showString = "aid,cid,title,description,updatetime,inputtime,views";
	    			$contentsData = $this->content->where("cid=%d AND `show`='1'",array($cid))->limit($page->firstRow.','.$page->listRows)->order("aid desc")->getField($showString);
	    			foreach ($contentsData as $key=>$value) {
	    				$contentsData[$key]["url"] = __ACTION__."/cat/$cid/cont/".$contentsData[$key]["aid"];
	    			}
	    			$this->assign($extraArr);
	    			$this->assign("contentsData",$contentsData);
	    		}
	    		else if($categoryData["type"]==1)//单页面栏目
	    		{
	    			$contentData = $this->content->where("cid=%d",array($cid))->find();
	    			$this->content->where("cid=%d",array($cid))->save(array("views"=>intval($contentData["views"])+1));
	    			$contentData['content'] = $this->RecoverRequest($contentData['content']);
	    			$prev["link"] = "无";
	    			$next["link"] = "无";
	    			$this->assign("prev",$prev);
	    			$this->assign("next",$next);
	    			$this->assign($contentData);
	    		}
	    		else
	    		{
	    			$this->show404(array('info'=>"栏目类型解析错误"));
	    			return;
	    		}
	    		$this->displayTpl($categoryData['tplname']);
	    	}
	    }

	    /**
	    *OPE:操作名
	    *info:参数 "key1,value1;key2,value2"
	    */
	    public function exec()
	    {
	    	$err = 0;
	    	if($this->adminUser->logined())
	    	{
	    		$info = $this->info($_REQUEST['info']);

	    		switch($_REQUEST['OPE'])
	    		{
	    			case "addCategory"://info("pid,1;sequence,0;show,1;tplname,list.html;type,0;name,name")
	    				if($this->addCategory($info)===false)
	    					$err = 3;
	    				break;
	    			case "updateCategory"://info("cid,2;pid,1;sequence,20")
	    				if($this->updateCategory($info)===false)
	    					$err = 4;
	    				break;
	    			case "deleteCategory"://info("cid,1")
	    				if($this->deleteCategory($info)===false)
	    					$err = 5;
	    				break;
	    			case "addContent"://info("cid,title,content,show,sequence,tplname")
	    				$info['content'] = $_REQUEST['content'];//content 通过POST单独传送 ，不放在info中
	    				if($this->addContent($info)===false)
	    					$err = 6;
	    				break;
	    			case "updateContent":
	    				$info['content'] = $_REQUEST['content'];
	    				if($this->updateContent($info)===false)
	    					$err = 7;
	    				break;
	    			case "deleteContent":
	    				if($this->deleteContent($info)===false)
	    					$err = 8;
	    				break;
	    		}
	    	}
	    	else
	    	{
	    		$err = 1;
	    	}

	    	$this->ajaxEcho($err);
	    } 

	    //管理员
	    public function admin()
	    {
	    	$err = 0;
	    	switch ($_REQUEST['OPE']) {
	    		case 'register':
	    			$this->adminUser->init($this->adminDB,$_REQUEST['user'],$_REQUEST['password'],$_REQUEST['gid'],$_REQUEST['status']);
	    			if(!$this->adminUser->register())
	    				$this->ajaxEcho($err,null,true,"注册失败".$this->adminUser->adminDB->getError(),2);
	    			break;
	    		case 'modify':
	    			$this->adminUser->init($this->adminDB,$_REQUEST['user'],$_REQUEST['password'],$_REQUEST['gid'],$_REQUEST['status'],$_REQUEST['id']);
	    			if(!$this->adminUser->modify())
	    				$this->ajaxEcho($err,null,true,"修改失败".$this->adminUser->adminDB->getError(),2);
	    			break;
	    		case 'login':
	    			$this->adminUser->init($this->adminDB,$_REQUEST['user'],$_REQUEST['password']);
	    			if(!$this->adminUser->login())
	    			{
	    				$this->ajaxEchoBase(null,null,true,"登陆失败，请检查填写的信息",2);
	    				$err = 10;
	    			}
	    			$this->ajaxEchoBase(null,null,true,"登陆成功",1);
	    			return;
	    			break;
	    		case 'loginOut':
	    			$this->adminUser->login_out();
	    			break;
	    	}

	    	$this->ajaxEcho($err,null,true,"操作成功",1);
	    }

	    /**
	    *request parse
	    *"key1,value1;key2,value2"
	    */
	    private function info($info)
	    {
			$arr1 = explode(";", $info);
	    	$arr = array();
	    	foreach($arr1 as $value)
	    	{
	    		$arr3 = explode(",", $value,2);
	    		$arr = array_merge($arr,array($arr3[0]=>$arr3[1]));
	    	}
	    	//echo $info;
	    	//var_dump($arr1);
	    	//var_dump($arr);
	    	return $arr;
	    }

	    /**
	    *type: 0:普通栏目 1:单页面栏目
	    */
	    private function addCategory($arr)
	    {
	    	return $this->category->add($arr);
	    }

	    //更新栏目数据
	    private function updateCategory($arr)
	    {
	    	return $this->category->save($arr);
	    }

	    //删除栏目
	    private function deleteCategory($cid)
	    {
	    	return $this->category->delete(array("cid"=>$cid));
	    }

	    //创建文章
	    private function addContent($arr)
	    {
	    	$descLen = 250;//简介字数 0~250
	    	$arr['description'] = iconv_substr($arr['content'],0,$descLen,"utf-8");
	    	$arr["inputtime"] = time();
	    	$arr["updatetime"] = time();
	    	return $this->content->add($arr);
	    }

	    //更新文章
	    private function updateContent($arr)
	    {
	    	$arr["updatetime"] = time();
	    	return $this->content->save($arr);
	    }

	    //删除文章
	    private function deleteContent($arr)
	    {
	    	return $this->content->delete($arr);
	    }

	    private function show404($arr=array())
	    {
	    	$this->assign($arr);
	    	$this->display($this->tplPath.$this->curTheme."/404.html");
	    }

	    private function displayTpl($tpl)
	    {
	    	$this->display($this->tplPath.$this->curTheme.'/'.$tpl);
	    }

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
						$this->error($msg);
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
					$this->ajaxReturn("操作成功 ".$error,0,1);
					break;
				case 1:
					$this->ajaxReturn("未登录 ".$error,1,0);
					break;
				case 2:
					$this->ajaxReturn("操作失败 ".$error,2,0);
					break;
				case 3:
					$this->ajaxReturn("操作失败 ".$error,3,0);
					break;
				case 4:
					$this->ajaxReturn("操作失败 ".$error,4,0);
					break;
				case 5:
					$this->ajaxReturn("操作失败 ".$error,5,0);
					break;
				case 6:
					$this->ajaxReturn("操作失败 ".$error,6,0);
					break;
				case 7:
					$this->ajaxReturn("操作失败 ".$error,7,0);
					break;
				case 8:
					$this->ajaxReturn("操作失败 ".$error,8,0);
					break;
				case 9:
					$this->ajaxReturn("注册失败 ".$error,9,0);
					break;
				case 10:
					$this->ajaxReturn("用户名或密码错误 ".$error,10,0);
					break;
			}
		}

	}

	class AdminUser
	{
		private $username = null;
		private $password = null;
		private $logintime = 0;
		private $ip = 0;
		private $gid = 1;
		private $status = 1;
		private $id = 0;

		public $adminDB = null;

		public function init($adminDB,$username,$password,$gid=1,$status=1,$id=0)
		{
			$this->adminDB = $adminDB;
			$this->username = $username;
			$this->password = $password;
			$this->gid = $gid;
			$this->status = $status;
			$this->id = $id;
			$this->logintime = time();
			$this->ip = getIP();
		}

		public function register()
		{
			$count = $this->adminDB->where("`user`='%s'",array($this->username))->find();
			if(!empty($count))
				return false;
			return $this->adminDB->add(array("gid"=>$this->gid,"user"=>$this->username,"password"=>md5($this->password),"logintime"=>$this->logintime,"ip"=>$this->ip,"status"=>$this->status));
		}

		public function modify()
		{
			$map = array("gid"=>$this->gid,"user"=>$this->username,"logintime"=>$this->logintime,"ip"=>$this->ip,"status"=>$this->status);
			if(!empty($this->password))
				$map = array_merge($map,array("password"=>md5($this->password)));
			return $this->adminDB->where(array('id'=>$this->id))->save($map);
		}

		public function login()
		{
			$result = $this->adminDB->where("`user`='%s' AND `status`='1'",array($this->username))->find();
			if(empty($result))
				return false;
			if(md5($this->password)!=$result['password'])
				return false;
			$_SESSION['admin_user'] = $result;

			return true;
		}

		public function logined()
		{
			return isset($_SESSION['admin_user']);
		}

		public function login_out()
		{
			$_SESSION['admin_user'] = null;
		}
	}