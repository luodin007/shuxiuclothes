<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
  <head>
    <title>蜀绣</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8"/>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../Public/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../Public/css/header.css">
    <link rel="stylesheet" type="text/css" href="../Public/css/main-page.css">
    <link rel="stylesheet" type="text/css" href="../Public/css/jquery.validator.css">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../Public/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
  	<script src="../Public/js/jquery.slides.min.js"></script>
  	<script src="../Public/js/jquery.validator.js"></script>
  	<script src="../Public/js/local/zh_CN.js"></script>
  	<script>
  	$(function() {
    	$('#slides').slidesjs({
        	width: 1300,
        	height: 430,
        	navigation: false,
        	start: 3,
        	play: {
          	auto: true
        	}
      	});
    });  	
  	</script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    #slides {
      display:none;
    }
  	</style>
  <!-- End SlidesJS Optional-->

  <!-- SlidesJS Required: These styles are required if you'd like a responsive slideshow -->
  </head>
  <body>
    <div id="zzx-header-top">
      <div class="zzx-header-top-logo">
        <img src="../Public/images/logo.png">
        <img src="../Public/images/head.png">
      </div>
      <ul class="nav nav-tabs">
        <?php if(isset($_SESSION['user'])): ?><li><a href="#" data-toggle="modal">你好，<?=$_SESSION['user']['real_name']?></a></li>
          <li><a href="<?php echo U('User/loginout');?>">退出</a></li>
          <li><a href="<?php echo U('User/UserMenu');?>">用户中心</a></li>
        <?php else: ?>
          <li><a href="#" data-toggle="modal" data-target="#myModal">登录</a></li>
          <li><a href="#" data-toggle="modal" data-target="#myModal2">注册</a></li><?php endif; ?>
        <li class="dropdown zzx-hide">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">我的蜀秀 <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">我的衣服</a></li>
            <li><a href="#">我的裤子</a></li>
            <li class="divider"></li>
            <li><a href="#">联系商家</a></li>
          </ul>
      </li>
      </ul>  
    </div>
    <div class="zzx-nav" id="active">
      <ul>
        <li><a href="__APP__">首页</a></li>
        <li><a href="<?php echo U("Order/index");?>">正装租赁</a></li>
        <li><a href="<?php echo U("SPage/view",array("type"=>0,"cat"=>2));?>">信息发布</a></li>
        <li><a href="<?php echo U("SPage/view",array("type"=>1,"cat"=>3));?>">公司介绍</a></li>
      </ul>
      <span class="zzx-contact zzx-hide">联系电话：028-12580002</span>
    </div>

    <!--登陆模态框-->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" style="background-color:rgba(0,0,0,0.5); width:500px;height:350px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 class="modal-title" id="myModalLabel" style="text-align:center;color:#F5FFFA;font-style:bold;">登陆Suitshow</h3>
          </div>
          <div class="modal-body">
            <form method="post" action="<?php echo U("User/login");?>" class="form-horizontal" role="form" style="width:450px;position:relative;left:80px;top:30px">
          <div class="form-group">
            <label for="inputEmail1" class="col-sm-2 control-label" style="color:#F5FFFA"><img src="../Public/images/user.png"></label>
              <div class="col-sm-10">
                  <input type="email" name="email" class="form-control" id="inputEmail1" placeholder="Email or Phone-number">
              </div>
          </div>
          <div class="form-group">
            <label for="inputPassword1" class="col-sm-2 control-label"style="color:#F5FFFA"><img src="../Public/images/lock.png"></label>
              <div class="col-sm-10">
                  <input type="password" name="pass" class="form-control" id="inputPassword1" placeholder="Password">
              </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                  <label style="color:#F5FFFA">
                      <input name="rememberme" type="checkbox"> 记住我
                  </label>
                </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10" style="position:relative;left:50px;">
                <button type="submit" class="btn btn-default">登陆</button>
            </div>
          </div>
      </form>
          </div>
        <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        </div>-->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!--注册模态框-->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" style="background-color:rgba(0,0,0,0.5); width:500px;height:480px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 class="modal-title" id="myModalLabel" style="text-align:center;color:#F5FFFA;font-style:bold;">注册Suitshow</h3>
          </div>
          <div class="modal-body">
          <form class="form-horizontal" method="post" action="<?php echo U("User/register");?>" role="form">
            <div class="form-group">
              <label for="inputUsername" class="col-sm-2 control-label"><img src="../Public/images/user.png"></label>
              <div class="col-sm-10">
              <input type="name" class="form-control" name="userName" id="inputUsername" placeholder="请输入您的姓名">
             </div>
            </div>
            <div class="form-group">
              <label for="inputEmail2" class="col-sm-2 control-label"><img src="../Public/images/user.png"></label>
              <div class="col-sm-10">
              <input type="email" class="form-control" name="email" id="inputEmail2" placeholder="请输入您的电子邮箱">
             </div>
            </div>
            <div class="form-group">
              <label for="inputMobile2" class="col-sm-2 control-label"><img src="../Public/images/mobile.png" ></label>
              <div class="col-sm-10">
              <input type="phonenumber" class="form-control" name="phone" id="inputMobile2" placeholder="请输入您的电话号码">
             </div>
            </div>
            <div class="form-group">
               <label for="inputPassword2" class="col-sm-2 control-label"style="color:#F5FFFA"><img src="../Public/images/lock.png"></label>
               <div class="col-sm-10">
                <input type="password" class="form-control" name="pass" id="inputPassword2" placeholder="请输入您的密码">
                </div>
           </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label"style="color:#F5FFFA"><img src="../Public/images/lock.png"></label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" placeholder="请再一次输入您的密码">
            </div>
        </div>
        <div class="form-group">
          <script language="JavaScript">
            function changeVerify(){
            document.getElementById('verifyImg').src='__URL__/verify/';
            }
          </script>
          <label for="inputCheck" class="col-sm-2 control-label"><img id='verifyImg' style="width:149px;height:49px;" src="__APP__/Index/verify/" onClick="changeVerify()" title="点击刷新验证码"></label>
          <div class="col-sm-10" style="position:relative;left:80px;top:15px;">
                <input type="checkcode" class="form-control" name="verify" id="inputCheckcode" placeholder="请输入验证码">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10" style="position:relative;left:250px;">
                <button type="submit" class="btn btn-default">注册</button>
            </div>
        </div>
          </form>
          </div>
        <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        </div>-->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
	<!--slider-->
	<div id="slides">
    	<img src="../Public/img/example-slide-1.jpg" alt="Photo by: Missy S Link: http://www.flickr.com/photos/listenmissy/5087404401/" width="900px"
    	height="480px">
      	<img src="../Public/img/example-slide-2.jpg" alt="Photo by: Daniel Parks Link: http://www.flickr.com/photos/parksdh/5227623068/" width="900px"
    	height="480px">
      	<img src="../Public/img/example-slide-3.jpg" alt="Photo by: Mike Ranweiler Link: http://www.flickr.com/	photos/27874907@N04/4833059991/" width="900px"
    	height="480px">
      	<img src="../Public/img/example-slide-4.jpg" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/" width="900px"
    	height="480px">
      	<a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right"></i></a>
  	</div>

    <!--登陆模态框-->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" style="background-color:rgba(0,0,0,0.5); width:500px;height:350px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 class="modal-title" id="myModalLabel" style="text-align:center;color:#F5FFFA;font-style:bold;">登陆Suitshow</h3>
          </div>
          <div class="modal-body">
          	<form class="form-horizontal" role="form" style="width:450px;position:relative;left:80px;top:30px">
  				<div class="form-group">
    				<label for="inputEmail1" class="col-sm-2 control-label" style="color:#F5FFFA"><img src="../Public/images/user.png"></label>
    					<div class="col-sm-10">
      						<input type="email" class="form-control" id="inputEmail1" placeholder="Email or Phone-number">
    					</div>
  				</div>
  				<div class="form-group">
    				<label for="inputPassword1" class="col-sm-2 control-label"style="color:#F5FFFA"><img src="../Public/images/lock.png"></label>
    					<div class="col-sm-10">
      						<input type="password" class="form-control" id="inputPassword1" placeholder="Password">
   			 			</div>
  				</div>
  				<div class="form-group">
    				<div class="col-sm-offset-2 col-sm-10">
     		 			<div class="checkbox">
        					<label style="color:#F5FFFA">
          						<input type="checkbox"> 记住我
        					</label>
      					</div>
    				</div>
  				</div>
  				<div class="form-group">
    				<div class="col-sm-offset-2 col-sm-10" style="position:relative;left:50px;">
      					<button type="submit" class="btn btn-default">登陆</button>
    				</div>
  				</div>
			</form>
          </div>
        <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        </div>-->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!--注册模态框-->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" style="background-color:rgba(0,0,0,0.5); width:500px;height:500px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 class="modal-title" id="myModalLabel" style="text-align:center;color:#F5FFFA;font-style:bold;">注册Suitshow</h3>
          </div>
          <div class="modal-body">
          <form class="form-horizontal" method="post" action="<?php echo U("User/register");?>" role="form">
            <div class="form-group">
              <label for="inputUsername" class="col-sm-2 control-label"><img src="../Public/images/user.png"></label>
              <div class="col-sm-10">
              <input type="name" class="form-control" name="user[name]" id="inputUsername" placeholder="请输入您的姓名" data-rule="required;username">
             </div>
            </div>
          	<div class="form-group">
          		<label for="inputEmail2" class="col-sm-2 control-label"><img src="../Public/images/user.png"></label>
          		<div class="col-sm-10">
      				<input type="email" class="form-control" name="email" id="inputEmail2" placeholder="请输入您的电子邮箱">
    			   </div>
          	</div>
          	<div class="form-group">
          		<label for="inputMobile2" class="col-sm-2 control-label"><img src="../Public/images/mobile.png" ></label>
          		<div class="col-sm-10">
      				<input type="phonenumber" class="form-control" name="phone" id="inputMobile2" placeholder="请输入您的电话号码">
    			   </div>
          	</div>
          	<div class="form-group">
    			     <label for="inputPassword2" class="col-sm-2 control-label"style="color:#F5FFFA"><img src="../Public/images/lock.png"></label>
    			     <div class="col-sm-10">
      				  <input type="password" class="form-control" name="pass" id="inputPassword2" placeholder="请输入您的密码">
   			 	      </div>
  			   </div>
  			<div class="form-group">
    				<label for="inputPassword3" class="col-sm-2 control-label"style="color:#F5FFFA"><img src="../Public/images/lock.png"></label>
    				<div class="col-sm-10">
      					<input type="password" class="form-control" id="inputPassword3" placeholder="请再一次输入您的密码">
   			 		</div>
  			</div>
        <div class="form-group">
          <label for="inputCheck" class="col-sm-2 control-label"><img src="__APP__/Index/verify/"></label>
          <div class="col-sm-10" style="position:relative;left:80px;top:15px;">
                <input type="checkcode" class="form-control" name="verify" id="inputCheckcode" placeholder="请输入验证码">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10" style="position:relative;left:250px;">
                <button type="submit" class="btn btn-default">注册</button>
            </div>
        </div>
          </form>
          </div>
        <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        </div>-->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!--Footer-->

    <div id="footer">
    	Copyright 2014
    </div>
    
  </body>
<script type="text/javascript">
    var oActive=document.getElementById("active");
    var oUl=oActive.getElementsByTagName("ul");
    var aLi=oUl[0].getElementsByTagName("li");

    aLi[0].className+="zzx-active";
</script>    
</html>