<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>submit</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8"/>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../Public/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../Public/css/header.css">
    <link rel="stylesheet" type="text/css" href="../Public/css/submit.css">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../Public/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
  	<script src="../Public/js/jquery.slides.min.js"></script>
  	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
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
        <li><a href="<?php echo U("Order/info");?>">信息发布</a></li>
        <li><a href="#">公司介绍</a></li>
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
          <label for="inputCheck" class="col-sm-2 control-label"><img style="width:149px;height:49px;" src="__APP__/Index/verify/"></label>
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
    <div id="select-order">
    	<ul>
    		<li><a><img src="../Public/images/selected1.jpg"></a></li>
    		<li><a><img src="../Public/images/selected2.jpg"></a></li>
    		<li><a><img src="../Public/images/select3.jpg"></a></li>
    	</ul>    		
    </div>
    <div class="clear"></div>

    <!--main content-->
    <div class="main-content">
    	<div class="ad">
 			<span class="ad-content">
    		感谢您对蜀秀的支持！
    		</span>
    	</div>
    	<div class="order">
    		<div class="order-detail">订单详情</div>
    		<div class="tab-pane" id="other">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>订单编号</th>
                <th>姓名</th>
                <th>电话</th>
                <th>衣服信息</th>
                <th>尺寸</th>
                <th>颜色</th>
                <th>租赁时间</th>
                <th>价格</th>
              </tr>
        </thead>
        <tbody>
          <tr>
            <td>201410101</td>
            <td>张兆鑫</td>
            <td>18380421239</td>
            <td>花纹领带正装</td>
            <td>170</td>
            <td>黑色</td>
            <td>2014-3-14到2014-3-17</td>
            <td>30/天</td>
          </tr>
        </tbody>
    </table>
 </div>
			<div class="order-send1">
				我们的订单会以短信形式发送到您的手机上，请输入您的手机号：
			</div>
			<div class="order-send2">
				<input type="text" name="phone-number" class="order-send2-detail0" />
				<input type="button" value="验证" class="order-send2-detail1">
			</div>
			<div class="order-send3">
				输入手机验证码：
				<input type="text" class="order-send3-detail">
			</div>
			<div class="order-submit">
				<div class="submit"><a href="success-message.html">确认完成订单</a></div>
			</div>
    	</div>
    </div>
</body>
</html>