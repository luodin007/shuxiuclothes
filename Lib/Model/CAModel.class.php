<?php
	class CAModel extends CommonModel
	{
		protected $tableName = 'clothes_accessory';
		private $keyMapCA = array("type","accessory_type","price","gender","description","status","total","serial"); 
		private $keyMapColor = array("color");
		private $keyMapSize = array("size");
		private $keyMapImg = array("img");
		private $PK=0;

		public function addCA()
		{
			$map = $this->getKeyMap($this->keyMapCA);
			$mapColor = $this->getKeyMap($this->keyMapColor);
			$mapSize = $this->getKeyMap($this->keyMapSize);
			$mapImg = $this->getKeyMap($this->keyMapImg,$_POST);
			$result = $this->add($map);
			if($result!==false)
				$this->PK = $result;
			else
				return false;
			$this->addExtra("color",$mapColor['color']);
			$this->addExtra("size",$mapSize['size']);
			$this->addExtra("clothes_accessory_image",$mapImg['img'],'imgurl');
			return true;
		}

		public function addExtra($tablename,$arr,$pr=null,$model=null)
		{
			if($this->PK==0||$this->PK==false)
				return false;
			$data = array();
			$pr = empty($pr)?$tablename:$pr;
			foreach($arr as $value)
			{
				$data[] = array('id'=>$this->PK,$pr=>$value);
			}
			return empty($model)?M($tablename)->addAll($data):$model->addAll($data);
		}

		public function delCA($id)
		{
			$map = "id=".$id;
			if($this->where($map)->delete()===false)
				return false;
			else
				return true;
		}

		public function getPaginateData($type,$maparr,$num=30)
		{
			import('ORG.Util.Page');
			$map = array('status'=>1,'type'=>$type);
			$map = array_merge($map,$maparr);
			$count = $this->where($map)->count();
			$Page  = new Page($count,$num);
			$Page->setConfig("theme","<li>%upPage%</li>  <li>%linkPage%</li> <li>%downPage%</li>");
			$show  = $Page->show();
			$list = $this->where($map)->order("id desc")->limit($Page->firstRow.','.$Page->listRows)->select();
			return array("show"=>$show,"list"=>$list);
		}

		public function getImgs($id)
		{
			return M("clothes_accessory_image")->where(array("id"=>$id))->select();
		}
	}