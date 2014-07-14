<?php
	class CommonModel extends Model
	{
		public function getArticlePosition($id)
		{
        	$type = M('category')->where('status=1')->find($id);
        	if($type['pid']==0){
        	        $position[] = array('id'=>$id,'catname'=>$type['name']);
        	}else{
        	        $position =$this->getPosition($type['pid']);
        	        $position[]=array('id'=>$id,'catname'=>$type['name']);
        	}
        	return $position;
    	}

        protected function getKeyMap($arr,$target=null)
        {
            $map = array();
            if(empty($target))
                $target = $_REQUEST;
            foreach ($target as $key => $value) {
                if(in_array($key, $arr))
                    $map[$key] = $value;
            }
            return $map;
        }
	}