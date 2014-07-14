<?php
	class BaseAction extends Action
	{

		public $version = 0;

		public function _initialize()
		{
			$this->version = 0.01;
			$this->CleanRequest();
		}

		private function CleanRequest()
		{
			foreach($_REQUEST as $key=>$value)
				if(!is_array($value))
					if(!get_magic_quotes_gpc())
						$_REQUEST[$key] = htmlspecialchars(addslashes($value));
					else
						$_REQUEST[$key] = htmlspecialchars($value);
		}

		protected function RecoverRequest($content)
		{
			if(!get_magic_quotes_gpc())
				return stripslashes(htmlspecialchars_decode($content));
			else
				return htmlspecialchars_decode($content);
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

        public function verify()
        {
            import('ORG.Util.Image');
            Image::buildImageVerify();
        }

        protected function checkVerify()
        {
            if($_SESSION['verify'] != md5($_POST['verify'])) 
            {
                 $this->error('验证码错误！');
            }
        }

		//上传图片
    	protected function _upload($name)
    	{
       		 if(!empty($_FILES))
       		 {
                
       		 	if(!empty($name))
       		 		$this->handleFiles($name);
        	    import("@.ORG.Util.Image");
            	import("@.ORG.UploadFile");
            	//导入上传类
            	$upload = new UploadFile();
            	//设置上传文件大小
            	$upload->maxSize = 524288;
            	//设置上传文件类型
            	$upload->allowExts = explode(',', 'jpg,gif,png,jpeg');
            	//设置附件上传目录
            	$y = date('Y',time());
            	$m = date('m',time());
            	$d = date('d',time());
            
            	$dir='./Public/upload';
            
            	if (!is_dir($dir)) {
             	   mkdir($dir, 0777);
            	}
            	$dir.='/'.$y;
            	if (!is_dir($dir)) {
            	    mkdir($dir, 0777);
           	 }
           	 $dir.='/'.$m;
           	 if (!is_dir($dir)) {
           	     mkdir($dir, 0777);
           	 }
            	$dir.='/'.$d;
           		if (!is_dir($dir)) {
            	    mkdir($dir, 0777);
            	}
            	$dir.='/';
            	$upload->savePath =$dir;//'../Uploads/';
            
            	// 设置引用图片类库包路径
            	$upload->imageClassPath = '@.ORG.Util.Image';
            	//设置需要生成缩略图，仅对图像文件有效
            	//$upload->thumb = true;
            	//设置需要生成缩略图的文件后缀
            	//$upload->thumbPrefix = 'm_,s_';  //生产2张缩略图
            	//设置缩略图最大宽度
            	//$upload->thumbMaxWidth = '150';
            	//设置缩略图最大高度
            	//$upload->thumbMaxHeight = '150';
            	//设置上传文件规则
            	$upload->saveRule = uniqid;
            	//删除原图
            	$upload->thumbRemoveOrigin = false;
            
            	if (!$upload->upload()) {
            	    //捕获上传异常
            	    $strerror=$upload->getErrorMsg();
            	    if($strerror!="没有选择上传文件"){
            	        $this->error($strerror);
            	    }
                
            	} else {
            	    //取得成功上传的文件信息
                	$uploadList = $upload->getUploadFileInfo();
                	//var_dump($uploadList);
                	$tmp_file_post = array();
                	foreach ($uploadList as $key => $value) {
                	    foreach ($_FILES as $key1 => $value1) {
                	        if($value['name']===$value1['name']){
                	            	$tmp_file_post[$key1] = '/'.$y.'/'.$m.'/'.$d.'/'.$value['savename'];
                   	     	}
                    	}
                	}
                	if(!empty($name))
                		$_POST[$name] = $tmp_file_post;
                	else
                		$_POST = array_merge($_POST,$tmp_file_post);
                    return $uploadList;
            	}      
        	}
    	}

        /*
            type: 0 redirect , 1 success , 2 error  
        */
        protected function ajaxEchoBase($errorCode,$arr,$jump=false,$msg=null,$type=0,$url="")
        {
            if($jump===true)
            {
                switch ($type) {
                    case 0:
                        $this->redirect($url,3,$msg);
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
        }

    	protected function handleFiles($name)
    	{
    		$files = $_FILES[$name];
    		if(!empty($files))
    		{
    			$file_num = count($files["name"]);
    			for($i=0;$i<$file_num;$i++)
    			{
    				$_FILES[$name.strval($i)] = array("name"=>$files["name"][$i],"type"=>$files["type"][$i],"tmp_name"=>$files["tmp_name"][$i],"error"=>$files["error"][$i],"size"=>$files["size"][$i]);
    			}
    			$_FILES[$name] = null;
    		}
    		return $name;
    	}

        //可以扩展
        public function addExtra($tablename,$arr,$pr=null,$model=null)
        {
            $data = array();
            $pr = empty($pr)?$tablename:$pr;
            foreach($arr as $value)
            {
                $data[] = array($pr=>$value);
            }
            return empty($model)?M($tablename)->addAll($data):$model->addAll($data);
        }
	}