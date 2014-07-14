<?php
	class IndexAction extends BaseAction 
	{
	    public function index()
	    {
			//$this->assign("count",intval($_GET['count']));
			if(isset($_COOKIE['user']))
			{
				$_SESSION['user'] = unserialize($_COOKIE['user']);
				$this->display();
				return;
			}
			$this->display();
		}

		public function request()
		{
			if(IS_POST)
			{
				foreach($_REQUEST as $key=>$value)
				{
					echo $key." -> ";
					print_r(is_array($value)?$value:$this->RecoverRequest($value));
					echo "</br>";
				}
				print_r($_FILES);
			}
			else
				$this->display();
		}
	}