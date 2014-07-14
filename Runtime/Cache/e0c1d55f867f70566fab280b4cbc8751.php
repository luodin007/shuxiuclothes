<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
     <title></title>
     <meta charset="utf-8"/>
     <link rel="stylesheet" href="../Public/css/bootstrap.css">
     <link rel="stylesheet" type="text/css" href="../Public/css/menu.css">
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../Public/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
</head>
<body>
<div class="panel-group width-control" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          存货管理
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
        <ul>
        	<li>
        		<a href="positive_manage.html" target="mainframe">正装管理</a>
        	</li>
        	<li>
        		<a href="other_manage.html" target="mainframe">配件管理</a>
        	</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          查看订单
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        <ul>
        	<li>
        		<a href="<?php echo U("Admin/order_on");?>" target="mainframe">未付款订单</a>
        	</li>
        	<li>
            <a href="#">已付款进行中</a>
          </li>
        	<li>
        		<a href="<?php echo U("Admin/order_complete");?>" target="mainframe">已完成订单</a>
        	</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          用户管理
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        <ul>
        	<li>
        		<a href="user_manage.html" target="mainframe">用户信息管理</a>
        	</li>
        </ul>	
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
          门店信息
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse">
      <div class="panel-body">
        暂无
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
          操作人员管理
        </a>
      </h4>
    </div>
    <div id="collapseFive" class="panel-collapse collapse">
      <div class="panel-body">
        <ul>
          <li>
            <a href="<?php echo U("Admin/adminList");?>" target="mainframe">操作人员列表</a>
          </li>
          <li>
            <a href="adminAdd.html" target="mainframe">新建人员</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
          前端信息管理
        </a>
      </h4>
    </div>
    <div id="collapseSix" class="panel-collapse collapse">
      <div class="panel-body">
        <ul>
        	<li>
        		<a href="changephoto.html" target="mainframe">前端图片更换</a>
        	</li>
        	<li>
        		<a href="<?php echo U("Admin/item_up");?>" target="mainframe">货品上架</a>
        	</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a href="<?php echo U("Admin/article");?>" target="mainframe">
          发布文章
        </a>
      </h4>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a   target="_top" href="<?php echo U("Admin/login_out");?>" >
          退出后台
        </a>
      </h4>
    </div>
  </div>
</div>
</body>
</html>