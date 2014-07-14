<?php
	class OrderModel extends CommonModel
	{
		public function getUnCompleteOrder()
		{
			import('ORG.Util.Page');
			$Page  = new Page($this->table('sx_order o,sx_color c,sx_user u,sx_accessory_type t,sx_clothes_accessory ca')->where("o.caid=ca.id AND ca.accessory_type=t.id AND o.cacolor=c.id AND o.uid=u.uid AND o.complete=0")->count(),50);
			$show = $Page->show();
			$list = $this->table('sx_order o,sx_color c,sx_user u,sx_accessory_type t,sx_clothes_accessory ca')->where("o.caid=ca.id AND ca.accessory_type=t.id AND o.cacolor=c.id AND o.uid=u.uid AND o.complete=0")->field("o.*,u.*,t.type,c.color")->order("o.id")->limit($Page->firstRow.','.$Page->listRows)->select();
			//echo $this->getLastSql();
			return array("show"=>$show,"list"=>$list);
		}

		public function getCompleteOrder()
		{
			import('ORG.Util.Page');
			$Page  = new Page($this->table('sx_order o,sx_color c,sx_user u,sx_accessory_type t,sx_clothes_accessory ca')->where("o.caid=ca.id AND ca.accessory_type=t.id AND o.cacolor=c.id AND o.uid=u.uid AND o.complete=0")->count(),50);
			$show = $Page->show();
			$list = $this->table('sx_order o,sx_color c,sx_user u,sx_accessory_type t,sx_clothes_accessory ca')->where("o.caid=ca.id AND ca.accessory_type=t.id AND o.cacolor=c.id AND o.uid=u.uid AND o.complete=1")->field("o.*,u.*,t.type,c.color")->order("o.id")->limit($Page->firstRow.','.$Page->listRows)->select();
			//echo $this->getLastSql();
			return array("show"=>$show,"list"=>$list);
		}

		public function getOrderByUid($uid)
		{
			import('ORG.Util.Page');
			$Page  = new Page($this->table('sx_order o,sx_color c,sx_user u,sx_accessory_type t,sx_clothes_accessory ca')->where("o.caid=ca.id AND ca.accessory_type=t.id AND o.cacolor=c.id AND o.uid=u.uid AND o.uid=$uid")->count(),50);
			$show = $Page->show();
			$list = $this->table('sx_order o,sx_color c,sx_user u,sx_accessory_type t,sx_clothes_accessory ca')->where("o.caid=ca.id AND ca.accessory_type=t.id AND o.cacolor=c.id AND o.uid=u.uid AND o.uid=$uid")->field("o.*,u.*,t.type,c.color")->order("o.id")->limit($Page->firstRow.','.$Page->listRows)->select();
			//echo $this->getLastSql();
			return array("show"=>$show,"list"=>$list);
		}
	}