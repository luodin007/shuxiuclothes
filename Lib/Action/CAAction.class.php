<?php
	//Clothes and Accessory
	//后台管理 衣服配件
 	class CAAction extends AdminAction
 	{
 		private $CAModel = null;

		public function _initialize()
		{
			parent::_initialize();
			$this->CAModel = D("CA");
		}

		public function add()
		{
			if(IS_POST)
			{
				//upload img
				$this->_upload("img");
				if($this->CAModel->addCA()==false)
					$this->error("提交失败 ".$this->CAModel->getError());
				$this->success('提交成功');
			}
			else
			{
				$this->display();
			}
		}

		public function delete()
		{
				$id = $_REQUEST['id'];	
				//delete
				$result = D("CA")->delCA($id);
				if($result === true)
					$this->success("删除成功");
				else
					$this->error("删除失败");
		}

		public function edit()
		{
			$id = $_REQUEST['id'];
			//get data
			if(IS_POST)
			{
				//save changes
			}
		}
 	}