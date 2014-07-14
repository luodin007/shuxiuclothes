<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
     <title></title>
     <meta charset="utf-8"/>
     <link rel="stylesheet" href="../Public/css/bootstrap.css">
     <link rel="stylesheet" type="text/css" href="../Public/css/item-down.css">
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../Public/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <style type="text/css">
    body{
        background:url('../Public/images/light_honey.png');
    }
    </style>
</head>
<body>
<div class="position">
<ul class="nav nav-tabs">
  <li><a href="<?php echo U('Admin/positive_manage',array('gender'=>1));?>">女正装</a></li>
  <li><a href="<?php echo U('Admin/positive_manage',array('gender'=>0));?>">男正装</a></li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
  	<div class="tab-pane active" id="positive">
  		<table class="table table-striped">
  			<thead>
  				<tr>
  					<th>#</th>
  					<th>编号</th>
  					<th>描述</th>
            <th>价格</th>
  					<th>剩余套数</th>
  					<th></th>
            <th></th>
  				</tr>
  			</thead>
  			<tbody>
          <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($vo["id"]); ?></td>
            <td><?php echo ($vo["serial"]); ?></td>
            <td><?php echo ($vo["description"]); ?></td>
            <td><?php echo ($vo["price"]); ?></td>
            <td><?php echo ($vo['total']-$vo['sold']); ?>套</td>
            <td><a href="<?php echo U("Admin/edit",array('id'=>$vo['id']));?>">编辑</a></td>
            <td><a href="<?php echo U("CA/delete",array('id'=>$vo['id']));?>">删除</a></td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  			</tbody> 
		</table>
  	</div>
    
</div>
<div class="pagination-position">
	<ul class="pagination">
      <?php echo ($page); ?>
	</ul>
</div>
</div>

</body>
</html>