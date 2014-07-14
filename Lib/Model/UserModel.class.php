<?php
	class UserModel extends Model
	{
		protected $trueTableName = "sx_user";
		private $checkUser = false;

		public function register($userData)
		{
			if(!$this->checkUser)
				$userData['checked'] = 1;
			$PK = $this->add($userData);
			if($PK===false)
				return 20;//未知错误
			if($this->checkUser)
			{
				$mail_ok = $this->sendRegiEmail($userData['email'],$userData['real_name'],$PK);
				if($mail_ok===false)
					return 21;//邮件发送错误,标记为未知错误
			}
			return 0;
		}
		
		public function checkLogin($userData)
		{
			$udata = $this->where("`email` = '%s'",$userData['email'])->find();
			if(empty($udata)||intval($udata['checked'])==0)
				return 5;//无此用户
			if(md5($userData['pass'])!=$udata['password'])
				return 6;//密码错误
			return $udata;
		}
		
		public function sendFindPassEmail($email,$userName,$uid,$key)
		{
			Vendor("PHPmailer.class#phpmailer");
			
			$_REQUEST_URI = explode('/',$_SERVER["REQUEST_URI"]);
			$APPNAME = $_REQUEST_URI[1];
			$subject = "蜀绣租衣密码找回";
			$message = "亲爱的:".$userName."</br>".
			"如果您没有提交密码重置的请求或不是 蜀绣租衣 的注册用户，请立即忽略 并删除这封邮件。只有在您确认需要重置密码的情况下，才需要继续阅读下面的 内容。</br>".
			"为了您的帐号安全，请点击如下链接完成安全邮箱密码找回，或把下面网页地址复制到浏览器的地址栏中打开:</br>".
			"http://".$_SERVER['HTTP_HOST'].'/'.$APPNAME."/index.php/User/changePWPage/ukey/".$uid."/key/".$key."</br>".
			"温馨提示:</br>".
			"密码找回链接30分钟内有效</br>"
			;
			//echo $message;
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host = "smtp.163.com";
			$mail->Port = 25;
			$mail->SMTPAuth = true;
			$mail->CharSet='UTF-8';
			$mail->Username = "m18782246522@163.com";
			$mail->Password = "zyjsyqgz2012";
			$mail->From = "m18782246522@163.com";
			$mail->FromName = "蜀绣租衣";
			$mail->AddAddress($email,$userName);
			$mail->Subject = $subject;
			$mail->Body = $message;
			$mail->IsHTML(true);
			
			$t = $mail->send();//mail( $email , $subject , $message,$header,$additional);
			return $t;
		}
		
		public function sendRegiEmail($email,$userName,$uid)
		{
			Vendor("PHPmailer.class#phpmailer");
			
			$_REQUEST_URI = explode('/',$_SERVER["REQUEST_URI"]);
			$APPNAME = $_REQUEST_URI[1];
			$subject = "蜀绣租衣注册验证";
			$message = "亲爱的:".$userName."</br>".
			"恭喜你注册成功！</br>".
			"您的蜀绣租衣账号为:".$email."</br>".
			"为了您的帐号安全，请点击如下链接完成安全邮箱激活，或把下面网页地址复制到浏览器的地址栏中打开:</br>".
			"http://".$_SERVER['HTTP_HOST'].'/'.$APPNAME."/index.php/User/emailcheck/ukey/".$uid."/key/".md5($uid+$email)."/mail/".$email."</br>".
			"温馨提示:</br>".
			"激活链接3天内有效，过期需重新注册</br>"
			;
			//echo $message;
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host = "smtp.163.com";
			$mail->Port = 25;
			$mail->SMTPAuth = true;
			$mail->CharSet='UTF-8';
			$mail->Username = "m18782246522@163.com";
			$mail->Password = "zyjsyqgz2012";
			$mail->From = "m18782246522@163.com";
			$mail->FromName = "蜀绣租衣";
			$mail->AddAddress($email,$userName);
			$mail->Subject = $subject;
			$mail->Body = $message;
			$mail->IsHTML(true);
			
			$t = $mail->send();//mail( $email , $subject , $message,$header,$additional);
			return $t;
		}

		public function getPaginateUserList($order="",$map=array())
		{
			import('ORG.Util.Page');
			$count = $this->where($map)->count();
			$Page  = new Page($count,50);

			$show  = $Page->show();
			$list = $this->where($map)->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();
			return array("show"=>$show,"list"=>$list);
		}
	}