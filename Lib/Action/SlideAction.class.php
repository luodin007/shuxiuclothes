<?php
	class SlideAction extends AdminAction
	{
		private $slideModel = null;
		private $keyMap = array("title","img","url","listorder","status");

		public function _initialize()
		{
			parent::_initialize();
			$this->slideModel = new CommonModel("slide");
		}

		public function add()
		{
			$info = $this->_upload();
			$mapImg = $this->getKeyMap($this->keyMap,$_POST);
			if($this->slideModel->where(array('id'=>$_POST['listorder']))->save(array('img'=>$_POST['img'],'title'=>$info[0]['name']))===false)
			{
				$this->error("添加失败 ".$this->slideModel->getError());
				return;
			}
			$this->success("提交成功");
		}

		public function del()
		{
			$map = "id=".$_REQUEST["id"];
			if($this->slideModel->where($map)->delete())
				$this->success("删除成功");
			else
				$this->error("删除失败 ".$this->slideModel->getError());
		}
	}