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
    </style>
</head>
<body>
<div>
    <div style="font-size:24px;font-weight:bold;">
    	首页大图轮播更换
    </div>
    <form role="form">
        <div class="form-group">
            <label for="First">第一张</label>
            <input type="file" id="firstInputFile">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
    <form role="form">
        <div class="form-group">
            <label for="Second">第二张</label>
            <input type="file" id="secondInputFile">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
    <form role="form">
        <div class="form-group">
            <label for="Third">第三张</label>
            <input type="file" id="thirdInputFile">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
    <form role="form">
        <div class="form-group">
            <label for="Fourth">第四张</label>
            <input type="file" id="fourthInputFile">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
    <div style="display:none;">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>现有图片名称</th>
                        <th>更改</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>第一张大图</td>
                        <td>1010101.jpg</td>
                        <td>
                            <div class="form-group">
                                <input type="file" id="FirstInputFile">
                            </div>
                        </td>
                        <td><a>上传</a></td>
                    </tr>
                    <tr>
                        <td>第二张大图</td>
                        <td>12122.jpg</td>
                        <td>
                            <div class="form-group">
                                <input type="file" id="SecondInputFile">
                            </div>
                        </td>
                        <td><a>上传</a></td>
                    </tr>
                    <tr>
                        <td>第三张大图</td>
                        <td>144654642.jpg</td>
                        <td>
                            <div class="form-group">
                                <input type="file" id="ThirdInputFile">
                            </div>
                        </td>
                        <td><a>上传</a></td>
                    </tr>
                    <tr>
                        <td>第四张大图</td>
                        <td>123424.jpg</td>
                        <td>
                            <div class="form-group">
                                <input type="file" id="FourthInputFile">
                            </div>
                        </td>
                        <td><a>上传</a></td>
                    </tr>
                </tbody>
            </table>
    </div>
 </div>
</body>
</html>