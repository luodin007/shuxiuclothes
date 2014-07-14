<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
     <title></title>
     <meta charset="utf-8"/>
     <link rel="stylesheet" href="../Public/css/bootstrap.css">
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../Public/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <style type="text/css">
    body{
        background:url('../Public/images/light_honey.png');
    }
    .pagination-position{
      position: relative;
      left: 650px;
}
    </style>
</head>
<body>
	<table class="table table-striped">
  		<thead>
  			<tr>
  				<th>#</th>
  				<th>用户名</th>
  				<th>电话</th>
  				<th>电子邮箱</th>
  				<th></th>
  			</tr>
  		</thead>
  		<tbody>
  			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($vo["uid"]); ?></td>
            <td><?php echo ($vo["real_name"]); ?></td>
            <td><?php echo ($vo["phone"]); ?></td>
            <td><?php echo ($vo["email"]); ?></td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  		</tbody>
	</table>
  <?php echo ($page); ?>
  <!--<div class="pagination-position">
    <ul class="pagination">
        <li><a href="#">&laquo;</a></li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">&raquo;</a></li>
    </ul>
  </div>-->
<!--<form method="POST" action="<?php echo U("Slide/add");?>" enctype="multipart/form-data">
    <input type="file" name="img"/>
    listorder:<input type="text" name="listorder"/>
    <input type="submit" value="Submit"/>
  </form>-->
</body>
</html>