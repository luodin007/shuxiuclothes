<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
     <title></title>
     <meta charset="utf-8"/>
     <style type="text/css">
     .position{
     	width: 500px;
     	height: 200px;
     	border:1px dotted #CCC;
     	border-radius: 8px;
     	margin:auto;
     	position: relative;
     	top: 200px;
     }
     .word{
     	font-size: 24px;
     	font-weight: bold;
     	margin-top:70px;
     	margin-left: 20px;
     	margin-right: 20px;
     }
     </style>
</head>
<body>
<div class="position">
	<div class="word">
          <?php echo ($msgTitle); ?></br>
		<?php if($status == 1): echo ($message); ?></br>
          <?php else: echo ($error); ?></br><?php endif; ?>
          <span id="wait"><?php echo ($waitSecond); ?></span>秒跳转，或点击<b><a id="href" href="<?php echo ($jumpUrl); ?>">这里</a></b>跳转
	</div>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
     var time = --wait.innerHTML;
     if(time <= 0) {
          location.href = href;
          clearInterval(interval);
     };
}, 1000);
})();
</script>
</body>
</html>