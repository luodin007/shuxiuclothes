function alert_ajax($url,$type,$data,func)
{
	var $result = 0;
	$.ajax({
			type:$type,
			url:$url,
			data:$data,
			success:function(data)
			{
				//var result = eval('('+data+')');
				if(func!=null)
					func(data);
			}
			});
}

function getParams($ids,$data)
{
	var $obj = new Object();
	for($index in $ids)
	{
		$obj[$index] = $('#'+$ids[$index]).val();
	}
	for($index in $data)
	{
		$obj[$index] = $data[$index];
	}
	
	return $obj;
}