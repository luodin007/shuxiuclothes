<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8"/>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../Public/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../Public/css/header.css">
    <link rel="stylesheet" type="text/css" href="../Public/css/page1.2.css">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../Public/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
  	<script>
    function btnColorchange(){
      // console.log(btn);
      //alert(getComputedStyle(this,null)['background-color']);
      //alert(typeof(getComputedStyle(this,null)['background-color']));
      if (getComputedStyle(this,null)['background-color']=='rgb(255, 255, 255)')
      {
        //alert('a');
        this.style.backgroundColor = 'rgb(61, 118, 219)';
        this.style.color='rgb(255,255,255)';
      }
      else
      {
        //alert('b');
        this.style.backgroundColor='rgb(255,255,255)';
        this.style.color="rgb(61, 118, 219)";
      }
      }   
    window.onload=function(){
      var odiv=document.getElementById('item-size');
      var abtn=odiv.getElementsByTagName('span');
      //alert( window.getComputedStyle(abtn[1])["background-color"])
      for( var i=1 ; i<abtn.length ; i++)
      {
        abtn[i].onclick=btnColorchange;
        //abtn[i].addEventListener("click",btnColorchange,false);

      }
  }
    
  	</script>

    <script type="text/javascript">
function HS_DateAdd(interval,number,date){
  number = parseInt(number);
  if (typeof(date)=="string"){var date = new Date(date.split("-")[0],date.split("-")[1],date.split("-")[2])}
  if (typeof(date)=="object"){var date = date}
  switch(interval){
  case "y":return new Date(date.getFullYear()+number,date.getMonth(),date.getDate()); break;
  case "m":return new Date(date.getFullYear(),date.getMonth()+number,checkDate(date.getFullYear(),date.getMonth()+number,date.getDate())); break;
  case "d":return new Date(date.getFullYear(),date.getMonth(),date.getDate()+number); break;
  case "w":return new Date(date.getFullYear(),date.getMonth(),7*number+date.getDate()); break;
  }
}
function checkDate(year,month,date){
  var enddate = ["31","28","31","30","31","30","31","31","30","31","30","31"];
  var returnDate = "";
  if (year%4==0){enddate[1]="29"}
  if (date>enddate[month]){returnDate = enddate[month]}else{returnDate = date}
  return returnDate;
}

function WeekDay(date){
  var theDate;
  if (typeof(date)=="string"){theDate = new Date(date.split("-")[0],date.split("-")[1],date.split("-")[2]);}
  if (typeof(date)=="object"){theDate = date}
  return theDate.getDay();
}
function HS_calender(){
  var lis = "";
  var style = "";
  style +="<style type='text/css'>";
  style +=".calender { width:170px; height:auto; font-size:12px; margin-right:14px; background:url(calenderbg.gif) no-repeat right center #fff; border:1px solid #397EAE; padding:1px ;position:relative; z-index:10;}";
  style +=".calender ul {list-style-type:none; margin:0; padding:0;}";
  style +=".calender .day { background-color:#EDF5FF; height:20px;}";
  style +=".calender .day li,.calender .date li{ float:left; width:14%; height:20px; line-height:20px; text-align:center}";
  style +=".calender li a { text-decoration:none; font-family:Tahoma; font-size:11px; color:#333}";
  style +=".calender li a:hover { color:#f30; text-decoration:underline}";
  style +=".calender li a.hasArticle {font-weight:bold; color:#f60 !important}";
  style +=".lastMonthDate, .nextMonthDate {color:#bbb;font-size:11px}";
  style +=".selectThisYear a, .selectThisMonth a{text-decoration:none; margin:0 2px; color:#000; font-weight:bold}";
  style +=".calender .LastMonth, .calender .NextMonth{ text-decoration:none; color:#000; font-size:18px; font-weight:bold; line-height:16px;}";
  style +=".calender .LastMonth { float:left;}";
  style +=".calender .NextMonth { float:right;}";
  style +=".calenderBody {clear:both}";
  style +=".calenderTitle {text-align:center;height:20px; line-height:20px; clear:both}";
  style +=".today { background-color:#ffffaa;border:1px solid #f60; padding:2px}";
  style +=".today a { color:#f30; }";
  style +=".calenderBottom {clear:both; border-top:1px solid #ddd; padding: 3px 0; text-align:left}";
  style +=".calenderBottom a {text-decoration:none; margin:2px !important; font-weight:bold; color:#000}";
  style +=".calenderBottom a.closeCalender{float:right}";
  style +=".closeCalenderBox {float:right; border:1px solid #000; background:#fff; font-size:9px; width:11px; height:11px; line-height:11px; text-align:center;overflow:hidden; font-weight:normal !important}";
  style +="</style>";

  var now;
  if (typeof(arguments[0])=="string"){
    selectDate = arguments[0].split("-");
    var year = selectDate[0];
    var month = parseInt(selectDate[1])-1+"";
    var date = selectDate[2];
    now = new Date(year,month,date);
  }else if (typeof(arguments[0])=="object"){
    now = arguments[0];
  }
  var lastMonthEndDate = HS_DateAdd("d","-1",now.getFullYear()+"-"+now.getMonth()+"-01").getDate();
  var lastMonthDate = WeekDay(now.getFullYear()+"-"+now.getMonth()+"-01");
  var thisMonthLastDate = HS_DateAdd("d","-1",now.getFullYear()+"-"+(parseInt(now.getMonth())+1).toString()+"-01");
  var thisMonthEndDate = thisMonthLastDate.getDate();
  var thisMonthEndDay = thisMonthLastDate.getDay();
  var todayObj = new Date();
  today = todayObj.getFullYear()+"-"+todayObj.getMonth()+"-"+todayObj.getDate();
  
  for (i=0; i<lastMonthDate; i++){  // Last Month's Date
    lis = "<li class='lastMonthDate'>"+lastMonthEndDate+"</li>" + lis;
    lastMonthEndDate--;
  }
  for (i=1; i<=thisMonthEndDate; i++){ // Current Month's Date

    if(today == now.getFullYear()+"-"+now.getMonth()+"-"+i){
      var todayString = now.getFullYear()+"-"+(parseInt(now.getMonth())+1).toString()+"-"+i;
      lis += "<li><a href=javascript:void(0) class='today' onclick='_selectThisDay(this)' title='"+now.getFullYear()+"-"+(parseInt(now.getMonth())+1)+"-"+i+"'>"+i+"</a></li>";
    }else{
      lis += "<li><a href=javascript:void(0) onclick='_selectThisDay(this)' title='"+now.getFullYear()+"-"+(parseInt(now.getMonth())+1)+"-"+i+"'>"+i+"</a></li>";
    }
    
  }
  var j=1;
  for (i=thisMonthEndDay; i<6; i++){  // Next Month's Date
    lis += "<li class='nextMonthDate'>"+j+"</li>";
    j++;
  }
  lis += style;

  var CalenderTitle = "<a href='javascript:void(0)' class='NextMonth' onclick=HS_calender(HS_DateAdd('m',1,'"+now.getFullYear()+"-"+now.getMonth()+"-"+now.getDate()+"'),this) title='Next Month'>&raquo;</a>";
  CalenderTitle += "<a href='javascript:void(0)' class='LastMonth' onclick=HS_calender(HS_DateAdd('m',-1,'"+now.getFullYear()+"-"+now.getMonth()+"-"+now.getDate()+"'),this) title='Previous Month'>&laquo;</a>";
  CalenderTitle += "<span class='selectThisYear'><a href='javascript:void(0)' onclick='CalenderselectYear(this)' title='Click here to select other year' >"+now.getFullYear()+"</a></span>年<span class='selectThisMonth'><a href='javascript:void(0)' onclick='CalenderselectMonth(this)' title='Click here to select other month'>"+(parseInt(now.getMonth())+1).toString()+"</a></span>月"; 

  if (arguments.length>1){
    arguments[1].parentNode.parentNode.getElementsByTagName("ul")[1].innerHTML = lis;
    arguments[1].parentNode.innerHTML = CalenderTitle;

  }else{
    var CalenderBox = style+"<div class='calender'><div class='calenderTitle'>"+CalenderTitle+"</div><div class='calenderBody'><ul class='day'><li>日</li><li>一</li><li>二</li><li>三</li><li>四</li><li>五</li><li>六</li></ul><ul class='date' id='thisMonthDate'>"+lis+"</ul></div><div class='calenderBottom'><a href='javascript:void(0)' class='closeCalender' onclick='closeCalender(this)'>×</a><span><span><a href=javascript:void(0) onclick='_selectThisDay(this)' title='"+todayString+"'>Today</a></span></span></div></div>";
    return CalenderBox;
  }
}
function _selectThisDay(d){
  var boxObj = d.parentNode.parentNode.parentNode.parentNode.parentNode;
    boxObj.targetObj.value = d.title;
    boxObj.parentNode.removeChild(boxObj);
}
function closeCalender(d){
  var boxObj = d.parentNode.parentNode.parentNode;
    boxObj.parentNode.removeChild(boxObj);
}

function CalenderselectYear(obj){
    var opt = "";
    var thisYear = obj.innerHTML;
    for (i=1970; i<=2020; i++){
      if (i==thisYear){
        opt += "<option value="+i+" selected>"+i+"</option>";
      }else{
        opt += "<option value="+i+">"+i+"</option>";
      }
    }
    opt = "<select onblur='selectThisYear(this)' onchange='selectThisYear(this)' style='font-size:11px'>"+opt+"</select>";
    obj.parentNode.innerHTML = opt;
}

function selectThisYear(obj){
  HS_calender(obj.value+"-"+obj.parentNode.parentNode.getElementsByTagName("span")[1].getElementsByTagName("a")[0].innerHTML+"-1",obj.parentNode);
}

function CalenderselectMonth(obj){
    var opt = "";
    var thisMonth = obj.innerHTML;
    for (i=1; i<=12; i++){
      if (i==thisMonth){
        opt += "<option value="+i+" selected>"+i+"</option>";
      }else{
        opt += "<option value="+i+">"+i+"</option>";
      }
    }
    opt = "<select onblur='selectThisMonth(this)' onchange='selectThisMonth(this)' style='font-size:11px'>"+opt+"</select>";
    obj.parentNode.innerHTML = opt;
}
function selectThisMonth(obj){
  HS_calender(obj.parentNode.parentNode.getElementsByTagName("span")[0].getElementsByTagName("a")[0].innerHTML+"-"+obj.value+"-1",obj.parentNode);
}
function HS_setDate(inputObj){
  var calenderObj = document.createElement("span");
  calenderObj.innerHTML = HS_calender(new Date());
  calenderObj.style.position = "absolute";
  calenderObj.targetObj = inputObj;
  inputObj.parentNode.insertBefore(calenderObj,inputObj.nextSibling);
}
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

    <!--maincontent-->

    <div class="main-content">
      <!-- indexCon start -->
      <div class="indexCon">
        <div class="flashBanner">
          <a href="#myPhoto" data-toggle="modal" id="changeHref">
          <img class="bigImg" width="300" height="200" src="../Public/images/1.jpg" id="bigImg" />
          </a>
          <div class="mask">
        
            <img src="../Public/images/1.jpg" width="40" height="22" id="imgBtn1" />
        
            <img src="../Public/images/2.jpg" width="40" height="22" id="imgBtn2" />
        
          </div>
        </div>
      </div>
<!-- indexCon end -->
      <div class="intro">
        <div class="item-price">
          <span class="item-price-detail1">租赁价格：</span><span class="item-price-detail2">20</span>
          <span class="item-price-detail3">RMB</span><span class="item-price-detail4">/天</span>
        </div>
        <div class="item-size" id="item-size">
          <span class="item-size-detail1">型号:</span>
          <span class="item-size-detail2">160cm</span>
          <span class="item-size-detail2">165cm</span>
          <span class="item-size-detail2">170cm</span>
          <span class="item-size-detail2">175cm</span>
          <span class="item-size-detail2">180cm</span>
          <div class="clear"></div>
        </div>
        <div class="item-time">
          开始时间：<input type="text" style="width:70px;border-radius:4px;font-size:14px;" onfocus="HS_setDate(this)">
          结束时间：<input type="text" style="width:70px;border-radius:4px;font-size:14px;" onfocus="HS_setDate(this)">
        </div>
        <div class="item-goto">
          <span class="item-goto-shoppingcar"><a href="page1.html">加入购物车，再去看看别的</a></span>
          <span class="item-goto-shoppingcar item-distance"><a href="submit.html">我选好了，去提交订单</a></span>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- 图片模态化-->

<div class="modal fade" id="myPhoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <img src="../Public/images/1.jpg" width="800px" height="500px" style="position:relative;top:100px;left:20%;">
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
</div><!-- /.modal-content -->

<div class="modal fade" id="myPhoto1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <img src="../Public/images/2.jpg" width="800px" height="500px" style="position:relative;top:100px;left:20%;">
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
</div><!-- /.modal-content -->
	


    <!--Footer-->
<script type="text/javascript">
  //图像改变
  	var obtn1=document.getElementById("imgBtn1");
  	var obtn2=document.getElementById("imgBtn2");
  	var obigImg=document.getElementById("bigImg");
  	var link=document.getElementById("changeHref")

  	obtn1.onclick=function(){
  		bigImg.src="../Public/images/1.jpg"
  	}
  	obtn2.onclick=function(){
  		bigImg.src="../Public/images/2.jpg"
  		link.href="#myPhoto1"
  	}
</script>
  </body>
</html>