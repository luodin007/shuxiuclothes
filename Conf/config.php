<?php
	$_REQUEST_URI = explode('/',$_SERVER["REQUEST_URI"]);
	define("APPNAME",$_REQUEST_URI[1]);
	define("ROOT",'/'.APPNAME);
	define("__PUBLIC__",ROOT."/Public");
	return array(
		'SHOW_PAGE_TRACE' 	 => True, 								 // 显示页面Trace信息
		//'配置项'=>'配置值'
		'TMPL_PARSE_STRING'  =>array(
		'__ROOT__'			 =>'/'.APPNAME,
		'__TPL__'			 =>'/'.APPNAME.'/Tpl',
		'__PUBLIC__'		 =>__PUBLIC__,
		'__JS__' 			 =>ROOT.'/Tpl/Public/js', 				 // 增加新的JS路径替换规则
		'__CSS__'            =>ROOT.'/Tpl/Public/css',				 // 增加新的css路径替换规则
		'__IMAGE__'		 	 =>ROOT.'/Tpl/Public/image',			 // 增加新的image路径替换规则
		'__UPLOAD__'		 =>__PUBLIC__.'/upload', 				 // 增加新的上传路径替换规则
		'__DOMAIN__'		 =>$_SERVER['HTTP_HOST'],
		'__APPNAME__'		 =>APPNAME,
		'__TPLADDR__'		 =>"http://".$_SERVER['HTTP_HOST']."/".$APPNAME."/Tpl"
		),
		//数据库配置
		'DB_TYPE' 		     => 'mysql', 							  // 数据库类型
		'DB_HOST'            => 'localhost', 						  // 服务器地址
		'DB_NAME'   		 => 'shuxiuclothes', 				      // 数据库名
		'DB_USER'  			 => 'root', 				 			  // 用户名
		'DB_PWD'  			 => '123', 			  					  // 密码
		'DB_PORT'  			 => 3306, 								  // 端口
		'DB_PREFIX'			 => 'sx_', 							      // 数据库表前缀
		//URL
		'URL_MODEL'          => '1', 								  //URL模式
		'SESSION_AUTO_START' => true, 								  //是否开启session
		'TAGLIB_PRE_LOAD'    => 'why',
		'APP_AUTOLOAD_PATH'  => '@.TagLib',						      //TagLib路径
		//'TAGLIB_BUILD_IN'    => 'Cx,Why',							  //并入核心库
		//默认错误跳转对应的模板文件
 		'TMPL_ACTION_ERROR' => 'Public:success',
 		//默认成功跳转对应的模板文件
 		'TMPL_ACTION_SUCCESS' => 'Public:success',
	);
?>